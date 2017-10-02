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

echo "Permissions: Repairing permissions..."

WP_ROOT=${1:-.} # <-- wordpress root directory, current directory by default
[ -e "$WP_ROOT/wp-config.php" ] || { echo "Usage: $0 /path/to/wordpress"; exit; } # <-- detect that the directory is a wordpress root
WP_OWNER=deploy
WP_GROUP=deploy
WS_GROUP=www-data

echo "Permissions: Fixing permissions on $WP_ROOT"
echo "Permissions: Owner/Group - $WP_OWNER:$WP_GROUP"
echo "Permissions: Webserver Group - $WS_GROUP"

echo "Permissions: Reset to safe defaults"
sudo find ${WP_ROOT} -exec chown ${WP_OWNER}:${WP_GROUP} {} \; # owner:owner
sudo find ${WP_ROOT} -type d -not -path "*/node_modules/*" -exec chmod 755 {} \; # 755
sudo find ${WP_ROOT} -type f -not -path "*/node_modules/*" -exec chmod 644 {} \; # 644

echo "Permissions: Allow wordpress to manage wp-config.php (but prevent world access)"
sudo chgrp ${WS_GROUP} ${WP_ROOT}/wp-config.php
sudo chmod 660 ${WP_ROOT}/wp-config.php # 660

echo "Permissions: Allow wordpress to manage wp-content"
sudo find ${WP_ROOT}/wp-content -not -path "*/node_modules/*" -exec chgrp ${WS_GROUP} {} \;
sudo find ${WP_ROOT}/wp-content -type d -not -path "*/node_modules/*" -exec chmod 775 {} \; # 775 or 777
sudo find ${WP_ROOT}/wp-content -type f -not -path "*/node_modules/*" -exec chmod 664 {} \; # 664 or 666

echo "Permissions: Repairing permissions finished"
