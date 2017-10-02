#!/usr/bin/env bash

set -o errexit
set -o pipefail
set -o nounset
# set -o xtrace

# Get current git branch
GIT_BRANCH=${1:-}
if [[ -z "${GIT_BRANCH}" ]]; then
  GIT_BRANCH=`git rev-parse --abbrev-ref HEAD`
fi
export GIT_BRANCH

export COMMIT_PREV=$(git log --pretty=format:'%h %s' -n 1)

# Check if we are in the right directory
[ -e "web/wp-config.php" ] || { echo "Something's wrong"; exit; } # <-- detect that the directory is a wordpress root

# Make sure .sh files in bin folder are executable
find scripts/ -name "*.sh" -exec chmod +x {} \;

# Add dotenv configs
[ -f '.env' ] && export $(egrep -v '^#' .env | xargs)

# Check for uncommitted files
if [[ ! -z `git diff-index --quiet HEAD` ]]; then
  echo "You have uncommitted changes. Commit your latest changes first.";
  exit 1
fi

# Install dependencies
. ./scripts/check-deploy-pantheon-dependencies.sh

echo "Git reset back to HEAD. This will reset last deploy build."
git reset HEAD

echo
echo "Building assets for deployment"
echo

# Build for deployment
./scripts/deploy.sh

# Remove any and all other git repos
find . -mindepth 2 -type d -name ".git" -exec rm -rf {} +

echo "Pushing code to ${TERMINUS_SITE}.${TERMINUS_ENV} using branch ${GIT_BRANCH}."
echo "Deploying lastest commit \"${COMMIT_PREV}\"."

if [[ -n "${PANTHEON_GIT_REPO}" ]]; then
  GIT_REMOTE=$PANTHEON_GIT_REPO
else
  GIT_REMOTE=`$TERMINUS connection:info ${TERMINUS_SITE}.${TERMINUS_ENV} --fields='Git Command' --format=string`
  GIT_REMOTE=`sed "s/git clone //g" <<<"$GIT_REMOTE"`
  GIT_REMOTE=${GIT_REMOTE%% *}
fi


if [[ -n "$(git remote show | grep pantheon)" ]]; then
  echo
  echo "Removing Pantheon remote"
  git remote remove pantheon
fi

echo
echo "Adding Pantheon remote"
git remote add pantheon ${GIT_REMOTE}

echo
echo "Switch to ${GIT_BRANCH} branch"
git checkout -B ${GIT_BRANCH}

echo
echo "Forcefully adding all files"
git add --force -A .

# Don't mess with this file
echo
echo "Remove git tracked files that should really be ignored"
echo "Removing web/wp-content/uploads from git tracked files"
git reset --quiet web/wp-content/uploads
git rm -r --cached --quiet web/wp-content/uploads

# Remove files listed in .gitignore.pantheon from deployment
[ -f '.gitignore.pantheon' ] && echo "Using .gitignore.pantheon to remove git tracked files"
[ -f '.gitignore.pantheon' ] && git rm --cached --quiet $(git ls-files -ci --exclude-from=.gitignore.pantheon)

echo
echo "Switching .gitignore and .git.pantheon for Pantheon deployment"
git rm --cached --quiet .gitignore
git rm --cached --quiet .gitignore.pantheon

[ -f '.gitignore' ] && mv .gitignore .gitignore.tmp
[ -f '.gitignore.pantheon' ] && mv .gitignore.pantheon .gitignore

git add .gitignore

echo
echo "Git files are ready for committing"
echo

git commit -q -m "Auto Deploy: ${COMMIT_PREV}"

echo
echo "Using Terminus switch site connection to git"
echo
$TERMINUS connection:set ${TERMINUS_SITE}.${TERMINUS_ENV} git

echo
echo "Git push files changes to Pantheon git remote"
echo
git push --force -q pantheon ${GIT_BRANCH}

# Reset these changes
[ -f '.gitignore' ] && mv .gitignore .gitignore.pantheon
[ -f '.gitignore.tmp' ] && mv .gitignore.tmp .gitignore

echo
echo "Removing Pantheon remote"
git remote remove pantheon

git reset HEAD^

echo
echo "Using Terminus clear site cache"
echo
$TERMINUS env:clear-cache ${TERMINUS_SITE}.${TERMINUS_ENV}

# terminus env:deploy ${TERMINUS_SITE}.test --sync-content --note="Deploy core and contrib updates" --cc

#Clone database and files from Live into Dev
# echo "Importing database and files from Live into Dev...";
# terminus env:clone-content $SITE.live dev

echo "Deployment success"
exit
