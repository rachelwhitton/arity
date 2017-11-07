#!/usr/bin/env bash

# Check for composer
NODE=`which node`
if [ ! -x "$NODE" ]
then
  echo -e "\nError: executable node not found on path"
  exit 1
fi

# Check for npm
NPM=`which npm`
if [ ! -x "$NPM" ]
then
  echo -e "\nError: executable npm not found on path"
  echo -e "\nRunning 'npm install --global npm'"
	npm install --global npm
fi

# Check for gulp
GULP=`which gulp`
if [ ! -x "$GULP" ]
then
	echo -e "\nError: executable gulp not found on path"
  echo -e "\nRunning 'npm install --global gulp'"
	npm install --global gulp
fi
