#!/usr/bin/env bash

# Check for wp
WP=`which wp`
if [ ! -x "$WP" ]
then
  echo -e "\nError: executable wp not found on path"
  exit 1
fi
