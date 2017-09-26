#!/usr/bin/env bash

set -o errexit
set -o pipefail
set -o nounset
# set -o xtrace

# Set magic variables for current file & dir
__dir="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
__file="${__dir}/$(basename "${BASH_SOURCE[0]}")"
__base="$(basename ${__file} .sh)"
__root="$(cd "$(dirname "${__dir}")" && pwd)" # <-- change this as it depends on your app
__branch=${1:-master}

cd ${__root}

# Check if we are in the right directory
[ -e "${__root}/web/wp-config.php" ] || { echo "Something's wrong"; exit; } # <-- detect that the directory is a wordpress root

# WP Build
composer install -o --prefer-dist --no-interaction

# WP Theme Build
cd ${__root}/web/app/themes/arity/
composer install -o --prefer-dist --no-interaction

yarn

if [[ $__branch == 'develop' ]]; then
  npm run dist-develop
else
  npm run dist
fi

cd ${__root}
