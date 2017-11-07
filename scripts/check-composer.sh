#!/usr/bin/env bash

# Check for composer
COMPOSER=`which composer`
if [ ! -x "$COMPOSER" ]
then
  echo Error: executable composer not found on path
  exit 1
fi
