#!/usr/bin/env bash

#
# Check for project deploy dependencies
#

# Make sure .sh files in bin folder are executable
find scripts/ -name "*.sh" -exec chmod +x {} \;

# Add dotenv configs
[ -f '.env' ] && export $(egrep -v '^#' .env | xargs)

if [[ -z "${TERMINUS_SITE}" ]]; then
  echo Error: Missing TERMINUS_SITE variable
  exit 1
fi

export TERMINUS_SITE
export TERMINUS_ENV=${TERMINUS_ENV:-dev}

#===============================
# Composer Dependencies
#===============================

# Check for composer
./scripts/check-install-composer.sh

COMPOSER_ALLOW_XDEBUG=0

# Enable Composer parallel downloads
composer global require -n "hirak/prestissimo:^0.3"

#===============================
# Node Dependencies
#===============================

# Check for node
./scripts/check-install-node.sh

#===============================
# Server SSH/Git Config
#===============================

# Disable host checking
touch $HOME/.ssh/config
echo "StrictHostKeyChecking no" >> "$HOME/.ssh/config"

if [[ -z "$(git config --global user.email)" ]]; then
	if [[ -n "${GIT_EMAIL:-}" ]]; then
		git config --global user.email "$GIT_EMAIL"
	fi
fi

if [[ -z "$(git config --global user.name)" ]]; then
	if [[ -n "${GIT_NAME:-}" ]]; then
		git config --global user.name "$GIT_NAME"
	fi
fi

echo "Git Settings:"
echo "user.email: $(git config --global user.email)"
echo "user.name: $(git config --global user.name)"

# Ignore file permissions.
git config --global core.fileMode false
git config --global core.safecrlf false
