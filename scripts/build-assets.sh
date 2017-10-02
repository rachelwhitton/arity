#!/bin/bash

#
# Build assets with gulp
#

export BRANCH=`git rev-parse --abbrev-ref HEAD`

# Check for gulp
GULP=`which gulp`
if [ ! -x "$GULP" ]
then
	echo Error: executable gulp not found on path
	exit 1
fi

# Check for yarn
YARN=`which yarn`
if [ ! -x "$YARN" ]
then
	echo Error: executable yarn not found on path
	exit 1
fi

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
  composer install --no-ansi --no-interaction --optimize-autoloader --no-progress

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

  # Run yarn install
	echo -e "\nRunning 'yarn install'"
  $YARN install

  if [[ $BRANCH == 'master' ]]; then

    # Run npm run dist
  	echo -e "\nRunning 'npm run dist'"
  	npm run dist
  else

    # Run npm run dist
  	echo -e "\nRunning 'npm run dist-allow-lint-errors'"
  	npm run dist-allow-lint-errors
  fi

	# Change back again
	echo -e "\nchanged directories back into:"
	cd -
done
