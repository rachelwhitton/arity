#!/usr/bin/env bash

# Run npm run dev
echo -e "\nRunning 'npm run dev'"
npm run dev

# Run npm run dist
# echo -e "\nRunning 'npm run dist-allow-lint-errors'"
# npm run dist-allow-lint-errors

# Run yarn install production
# This removes dev node_modules and only leaves production requirred packages
# echo -e "\nRunning 'npm install --production=true'"
# npm install --production=true
