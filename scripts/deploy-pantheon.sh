#!/usr/bin/env bash

set -o errexit
set -o pipefail
set -o nounset
# set -o xtrace

export BRANCH=`git rev-parse --abbrev-ref HEAD`

export COMMIT_PREV=$(git log --pretty=format:'%h %s' -n 1)

# Check if we are in the right directory
[ -e "web/wp-config.php" ] || { echo "Something's wrong"; exit; } # <-- detect that the directory is a wordpress root

# Make sure .sh files in bin folder are executable
find scripts/ -name "*.sh" -exec chmod +x {} \;

# Add dotenv configs
[ -f '.env' ] && export $(egrep -v '^#' .env | xargs)

# Check for uncommitted files
# git diff-index --quiet HEAD -- || echo "You have uncommitted changes. Commit your latest changes first.";
# git diff-index --quiet HEAD -- || exit

# Install dependencies
. ./scripts/check-deploy-pantheon-dependencies.sh

echo "Git reset back to HEAD. This will reset last deploy build."
[ -f ".git/index.lock" ] && rm -f .git/index.lock
git -C $(pwd) reset HEAD

# Build for deployment
./scripts/deploy.sh

# Remove any and all other git repos
find . -type d -name ".git" -mindepth 2 -exec rm -rf {} +

echo "Pushing code to ${TERMINUS_SITE}.${TERMINUS_ENV} using branch ${BRANCH}."
echo "Deploying lastest commit \"${COMMIT_PREV}\"."

if [[ -n "${PANTHEON_GIT_REPO}" ]]; then
  GIT_REMOTE=$PANTHEON_GIT_REPO
else
  GIT_REMOTE=`$TERMINUS connection:info ${TERMINUS_SITE}.${TERMINUS_ENV} --fields='Git Command' --format=string`
  GIT_REMOTE=`sed "s/git clone //g" <<<"$GIT_REMOTE"`
  GIT_REMOTE=${GIT_REMOTE%% *}
fi


if [[ -n "$(git remote show | grep pantheon)" ]]; then
  git -C $(pwd) remote remove pantheon
fi

git -C $(pwd) remote add pantheon ${GIT_REMOTE}
git -C $(pwd) checkout -B ${BRANCH}

git -C $(pwd) add --force -A .

# Don't mess with this file
git -C $(pwd) reset web/wp-content/uploads
git -C $(pwd) rm -r --cached web/wp-content/uploads

# Remove files listed in .gitignore.pantheon from deployment
[ -f '.gitignore.pantheon' ] && git -C $(pwd) rm --cached --quiet $(git ls-files -i --exclude-from=.gitignore.pantheon)

git rm --cached --quiet .gitignore
git rm --cached --quiet .gitignore.pantheon

mv .gitignore .gitignore.tmp
mv .gitignore.pantheon .gitignore

git -C $(pwd) add --force .gitignore

git -C $(pwd) commit -q -m "Auto Deploy: ${COMMIT_PREV}"

# $TERMINUS connection:set ${TERMINUS_SITE}.${TERMINUS_ENV} git

git -C $(pwd) push --force -q pantheon ${BRANCH}

# Reset these changes
mv .gitignore .gitignore.pantheon
mv .gitignore.tmp .gitignore

git -C $(pwd) reset HEAD^

# $TERMINUS env:clear-cache ${TERMINUS_SITE}.${TERMINUS_ENV}

# terminus env:deploy ${TERMINUS_SITE}.test --sync-content --note="Deploy core and contrib updates" --cc

#Clone database and files from Live into Dev
# echo "Importing database and files from Live into Dev...";
# terminus env:clone-content $SITE.live dev

echo "Deployment success"
exit
