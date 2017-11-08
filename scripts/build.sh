#!/usr/bin/env bash

set -o errexit
set -o pipefail
set -o nounset
# set -o xtrace

# Check if we are in the right directory
[ -e "web/wp-config.php" ] || { echo "Something's wrong"; exit; } # <-- detect that the directory is a wordpress root

# Add dotenv configs
[ -f '.env' ] && export $(egrep -v '^#' .env | xargs)

# Make sure .sh files in bin folder are executable
find scripts/ -name "*.sh" -exec chmod +x {} \;

# Accept arguments
while [ $# -ne 0 ]
do
    arg="$1"
    case "$arg" in
        --skip-tests)
            _skipTests=true
            ;;
        --dist)
            _dist=true
            ;;
        *)
            ;;
    esac
    shift
done

#
# Main
#

echo -e "\nStart Build"

# Check dependencies
./scripts/check-build-dependencies.sh

echo -e "\nInvoking: composer build-assets"
composer build-assets

if [[ -n "${_dist:-}" ]]; then

  echo -e "\nInvoking: composer build-theme-assets --dist"
  composer build-theme-assets --dist

else

  echo -e "\nInvoking: composer build-theme-assets"
  composer build-theme-assets

fi

echo -e "\nBuild Success"
echo -e "\n"

if [[ -z "${_skipTests:-}" ]]; then

  echo -e "\nInvoking: composer test"
  composer test

  echo -e "\nTesting Success"
  echo -e "\n"

fi
