#!/usr/bin/env bash

# Check for composer
COMPOSER=`which composer`
if [ ! -x "$COMPOSER" ]
then
  echo Error: executable composer not found on path
  exit 1
fi

# Check for composer.json file
if [ ! -f "composer.json" ]
then
	echo Error: No composer.json file found
	exit 1
fi

# CI options
export COMPOSER_DISCARD_CHANGES=1
export COMPOSER_NO_INTERACTION=1
export COMPOSER_ALLOW_XDEBUG=0

# Enable Composer parallel downloads
if [[ ! $(composer global show | grep "hirak/prestissimo") ]]; then
  echo -e "\nInstalling hirak/prestissimo for faster parallel composer downloads"
  echo -e "Invoking: composer global require hirak/prestissimo"
  composer global require "hirak/prestissimo"
fi
