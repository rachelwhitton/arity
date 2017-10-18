#!/usr/bin/env bash

#
# Check for project deploy dependencies
#

# Make sure .sh files in bin folder are executable
find scripts/ -name "*.sh" -exec chmod +x {} \;

# Add dotenv configs
[ -f '.env' ] && export $(egrep -v '^#' .env | xargs)

#===============================
# Composer Dependencies
#===============================

# Check for composer
./scripts/check-composer.sh

COMPOSER_ALLOW_XDEBUG=0

# Enable Composer parallel downloads
composer global require -n "hirak/prestissimo:^0.3"

#===============================
# Node Dependencies
#===============================

# Check for node
./scripts/check-node.sh

#===============================
# Terminus Plugins & Dependencies
#===============================

# Check for terminus
. ./scripts/check-terminus.sh

if [[ -x "$TERMINUS" ]] && [[ -z "${TERMINUS_TOKEN}" ]]; then
  echo Error: Missing TERMINUS_TOKEN variable
  exit 1
fi

if [[ -z "${TERMINUS_SITE}" ]]; then
  echo Error: Missing TERMINUS_SITE variable
  exit 1
fi

export TERMINUS_TOKEN
export TERMINUS_SITE
export TERMINUS_ENV=${TERMINUS_ENV:-dev}

INSTALL_TERMINUS_PLUGINS() {
  false
  ## composer create-project -n -d $HOME/.terminus/plugins pantheon-systems/terminus-build-tools-plugin:$BUILD_TOOLS_VERSION
}

# Create Terminus plugins directory and install plugins if needed
if [ ! -d $HOME/.terminus/plugins ]
then
	mkdir -p $HOME/.terminus/plugins
	INSTALL_TERMINUS_PLUGINS
fi

# Bail on errors
set +ex

# Make sure Terminus is installed
$TERMINUS --version

# Authenticate with Terminus
$TERMINUS auth:login -n --machine-token="$TERMINUS_TOKEN"

#===============================
# Server SSH/Git Config
#===============================

# Disable host checking
touch $HOME/.ssh/config
echo "StrictHostKeyChecking no" >> "$HOME/.ssh/config"

if [[ -z "$(git config --global user.email)" ]]; then
	if [[ -n "$GIT_EMAIL" ]]; then
		git config --global user.email "$GIT_EMAIL"
	fi
fi

if [[ -z "$(git config --global user.name)" ]]; then
	if [[ -n "$GIT_NAME" ]]; then
		git config --global user.name "$GIT_NAME"
	fi
fi

echo "Git Settings:"
echo "user.email: $(git config --global user.email)"
echo "user.name: $(git config --global user.name)"

# Ignore file permissions.
git config --global core.fileMode false
git config --global core.safecrlf false
