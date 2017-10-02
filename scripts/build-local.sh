#!/usr/bin/env bash

set -o errexit
set -o pipefail
set -o nounset
# set -o xtrace

# Check if we are in the right directory
[ -e "web/wp-config.php" ] || { echo "Something's wrong"; exit; } # <-- detect that the directory is a wordpress root

# Make sure .sh files in bin folder are executable
find scripts/ -name "*.sh" -exec chmod +x {} \;

# Add dotenv configs
[ -f '.env' ] && export $(egrep -v '^#' .env | xargs)

# Install dependencies
./scripts/check-build-dependencies.sh

# Check for composer.json file
if [ ! -f "composer.json" ]
then
	echo Error: No composer.json file found
	exit 1
fi

# CI options
export COMPOSER_DISCARD_CHANGES=1
export COMPOSER_NO_INTERACTION=1

# Install Composer dependencies
COMPOSER=`which composer`

echo -e "\nInvoking: $COMPOSER build-dev-assets"
$COMPOSER build-dev-assets

echo -e "\nInvoking: $COMPOSER build-theme-assets"
$COMPOSER build-theme-assets

echo -e "\nInvoking: $COMPOSER test"
$COMPOSER test