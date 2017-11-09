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
  # Run npm run dist
  echo -e "\nInvoking: 'npm run dist-allow-lint-errors'"
  npm run dist-allow-lint-errors

  # This removes dev node_modules and only leaves production requirred packages
  echo -e "\nInvoking: 'npm install --only=production'"
  npm install --only=production

else
  # Run npm run dev
  echo -e "\nInvoking: 'npm run dev'"
  npm run dev
fi
