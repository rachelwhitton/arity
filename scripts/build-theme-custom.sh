#!/usr/bin/env bash

# Accept arguments
while [ $# -ne 0 ]
do
    arg="$1"
    case "$arg" in
        --dist)
            _dist=true
            ;;
        *)
            ;;
    esac
    shift
done

if [[ -n "${_dist:-}" ]]; then
  # Run yarn run dist
  echo -e "\nInvoking: 'yarn run dist-allow-lint-errors'"
  yarn run dist-allow-lint-errors

  # This removes dev node_modules and only leaves production requirred packages
  echo -e "\nInvoking: 'npm install --only=production'"
  yarn install --only=production

else
  # Run yarn run dev
  echo -e "\nInvoking: 'yarn run dev'"
  yarn run dev
fi
