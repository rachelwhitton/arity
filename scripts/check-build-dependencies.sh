#!/usr/bin/env bash

#
# Check for project dev dependencies
#

# Make sure .sh files in bin folder are executable
find scripts/ -name "*.sh" -exec chmod +x {} \;

# Check for composer
. ./scripts/check-composer.sh

# Check for node
. ./scripts/check-node.sh
