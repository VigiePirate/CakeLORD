# CakeLORD

## Installation

1. Install Mysql or MariaDB, PHP (minimum 7.2, with extensions mbstring, PDO, intl and simplexml) and composer for your system: https://getcomposer.org/download/

2. Initialize a local git repository and clone this project:

       $ git clone https://github.com/VigiePirate/CakeLORD.git

3. Go in the CakeLORD directory and run:

       $ composer install

4. Edit the file `config/app_local.php`, `Datasources` section, with the name, user and password of your default database.

5. Run:

       $ bin/cake server

6. Taste on http://localhost:8765.

## Git Workflow

Proposed project workflow is a branch-often, merge-often model similar to the centralized topic model: https://git-scm.com/book/en/v2/Git-Branching-Branching-Workflows. Rather than forking, everyone is invited to work on his own branch and create specific feature branches from these. Once your feature is complete, merge with your branch and destroy. Once your branch is in a stable state, merge with master. Repeat.

Rebase and squash if you want on your branch, always merge on master. Corollary: don't work on others' branches.

### How to merge with master?

So let's say you worked on `yourbranch` and you are ready to push your modifications in master.

1. First make sure ALL YOUR WORK IN YOUR BRANCH IS COMMITED with `git status`

2. `git checkout master` (jump on master branch)

3. `git pull` (fetch and merge master's modifications)

4. `git checkout yourbranch` (back on your branch)

5. `git merge master` (merge master's modifications in your branch: solve conflicts if there are any)

6. You can stop here if you just wanted to get your own branch up to date with master. Add the following if you are ready to add your own modifications in master:
    * `git checkout master`
    * `git merge yourbranch` (there should be no conflict as you already did the work)
    * `git push origin master` (DO NOT FORGET THIS, or it will not be published)
    * `git checkout yourbranch` (back to work in your branch)

7. Your branch should now be perfectly synchronized with master and a `git branch -vv` should show both are pointing to the same commit.
