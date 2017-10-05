#!/usr/bin/env bash

# Check for composer
export NODE=`which node`
if [ ! -x "$NODE" ]
then

  echo Error: executable node not found on path
  exit 1

else
	echo Success: executable node was found on path. Nothing to install.
fi

# Install global npm packages
npm install --global gulp yarn
