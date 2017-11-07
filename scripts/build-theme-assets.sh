#!/usr/bin/env bash

set -o errexit
set -o pipefail
set -o nounset
# set -o xtrace

#
# Build assets with gulp
#

# Look for composer.json
echo -e "\nLooking for composer.json in themes directory.."
FILE=composer.json
for d in `find ./web/wp-content/themes \( -name node_modules -or -name .git -or -name vendor \) -prune -o -name "$FILE" | grep "$FILE"`
do
	# Change into containing directory
	echo -e "\ncomposer.json found, changing directories into: ${d%/*}"
	cd ${d%/*}

	# Run gulp
	echo -e "\nRunning 'composer install'"
  composer install --no-dev --no-ansi --no-interaction --optimize-autoloader --no-progress

	# Change back again
	echo -e "\nchanged directories back into:"
	cd -
done

# Look for package.json occurrences NOT in node_modules
echo -e "\nLooking for package.json in themes directory..."
FILE=package.json
for d in `find ./web/wp-content/themes \( -name node_modules -or -name .git -or -name vendor \) -prune -o -name "$FILE" | grep "$FILE"`
do
  # Change into containing directory
	echo -e "\npackage.json found, changing directories into: ${d%/*}"
	cd ${d%/*}

  # Run npm install
	echo -e "\nRunning 'npm install'"
  npm install

  #
  # Customize
  #

  # Run npm run dist
  echo -e "\nRunning 'npm run dist-allow-lint-errors'"
  npm run dist-allow-lint-errors

  # Run yarn install production
  # This removes dev node_modules and only leaves production requirred packages
	echo -e "\nRunning 'npm install --production=true'"
  npm install --production=true

  #
  # End Customize
  #

	# Change back again
	echo -e "\nchanged directories back into:"
	cd -
done
