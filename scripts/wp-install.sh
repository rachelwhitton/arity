#!/usr/bin/env bash

echo "Installing Wordpress"

# Check dependencies
./scripts/check-wp-cli.sh

if [[ ! $(wp db check --quiet) ]]; then
  wp_not_installed=1
  echo -e "\n"
  echo -e "Could not find database"
  echo -e "Invoking: wp db create"
  wp db create
fi

if ! $(wp core is-installed); then
  wp_not_installed=1
  echo -e "\n"
  echo -e "Wordpress is not installed"
  echo -e "Invoking: wp core install"
  wp core install --url=http://localhost/ --title=Wordpress --admin_user=wpadmin --admin_email=_wpadmin@vsapartners.com
fi

if [[ -n ${wp_not_installed:-} ]]; then
  echo -e "\n"
  wp option update permalink_structure '/%postname%/'
  wp plugin activate --all

  echo -e "\n"
  echo "Wordpress Installation Success"
  echo -e "\n"
else
  echo -e "\n"
  echo "Wordpress already installed"
  echo -e "\n"
fi
