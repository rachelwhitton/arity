#!/usr/bin/env bash

set -o errexit
set -o pipefail
set -o nounset
# set -o xtrace

# Define Theme location
THEME_PATH=web/wp-content/themes
if [ -n "${WP_THEME:-}" ]; then
  THEME_PATH="${THEME_PATH}/${WP_THEME}"
fi

# Set magic variables for current file & dir
__dir="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
__file="${__dir}/$(basename "${BASH_SOURCE[0]}")"
__base="$(basename ${__file} .sh)"
__root="$(cd "$(dirname "${__dir}")" && pwd)" # <-- change this as it depends on your app

#
# Build composer dependencies
#

# Look for composer.json and exclude node_modules/, .git/, vendor/
echo -e "\nLooking for composer.json in themes directory.."
FILE=composer.json
for d in `find $THEME_PATH \( -name node_modules -or -name .git -or -name vendor \) -prune -o -name "$FILE" | grep "$FILE"`
do
	# Change into containing directory
	echo -e "\ncomposer.json found, changing directories into: ${d%/*}"
	cd ${d%/*}

	# Run composer install with --no-dev.
	echo -e "\nInvoking: 'composer install'"
  composer install --no-dev --no-ansi --no-interaction --optimize-autoloader --no-progress

	# Change back again
	echo -e "\nchanged directories back into:"
	cd -
done

#
# Build assets with gulp
#

# Look for package.json and exclude node_modules/, .git/, vendor/
echo -e "\nLooking for package.json in themes directory..."
FILE=package.json
for d in `find $THEME_PATH \( -name node_modules -or -name .git -or -name vendor \) -prune -o -name "$FILE" | grep "$FILE"`
do
  # Change into containing directory
	echo -e "\npackage.json found, changing directories into: ${d%/*}"
	cd ${d%/*}

  # Run npm install
	echo -e "\nInvoking: 'npm install'"
  npm install

  if [ -e "${__root}/scripts/build-theme-custom.sh" ]; then
    echo -e "\nFound custom theme build file"
    ${__root}/scripts/build-theme-custom.sh $@
  fi

	# Change back again
	echo -e "\nchanged directories back into:"
	cd -
done
