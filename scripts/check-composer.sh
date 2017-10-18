#!/usr/bin/env bash

# Check for composer
COMPOSER=`which composer`
if [ ! -x "$COMPOSER" ]
then

  echo Error: executable composer not found on path
  exit 1

else
	echo Success: executable composer was found on path. Nothing to install.
fi
