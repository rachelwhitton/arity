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
_args=$@
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
        --install)
            _install=true
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

if [[ -z "${_skipTests:-}" ]]; then

  echo -e "\nInvoking: composer build-assets"
  composer build-assets

else

  echo -e "\nInvoking: composer build-assets-dist"
  composer build-assets-dist
fi

echo -e "\nInvoking: composer build-theme-assets -- $_args"
composer build-theme-assets -- $_args

echo -e "\nBuild Success"
echo -e "\n"

if [[ ! -z "${_install:-}" ]]; then
  # Check dependencies
  ./scripts/wp-install.sh
fi

if [[ -z "${_skipTests:-}" ]]; then

  echo -e "\nInvoking: composer test"
  composer test

  echo -e "\nTesting Success"
  echo -e "\n"
fi
