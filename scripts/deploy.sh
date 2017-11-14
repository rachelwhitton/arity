#!/usr/bin/env bash

set -o errexit
set -o pipefail
set -o nounset
# set -o xtrace

./scripts/build.sh --dist --skip-tests

echo -e "\nDeploy Success"
echo -e "\n"
