#!/usr/bin/env bash

# Check for composer
export NODE=`which node`
if [ ! -x "$NODE" ]
then

  if [[ ! -x `which apt-get` ]]; then
    echo Error: not able to install node using apt-get
    exit 1
  fi

  # Install node, npm and yarn
  curl -sL https://deb.nodesource.com/setup_6.x | sudo -E bash -
  apt-get install -y nodejs

	# Check for node
	export NODE=`which node`
	if [ ! -x "$NODE" ]
	then
		echo Error: executable node not found on path
		exit 1
	else
		echo Success: executable node was found on path. Installation was successful.
	fi

else
	echo Success: executable node was found on path. Nothing to install.
fi

# Install global npm packages
npm install --global gulp yarn
