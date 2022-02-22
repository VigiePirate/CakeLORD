# CakeLORD

## Installation

1. Install Mysql or MariaDB, PHP (minimum 8.1, with extensions mbstring, PDO, intl and simplexml) and composer for your system: https://getcomposer.org/download/

2. Initialize a local git repository and clone this project:

       $ git clone https://github.com/VigiePirate/CakeLORD.git

3. Go in the CakeLORD directory and run:

       $ composer install

4. Edit the file `config/app_local.php`, `Datasources` section, with the name, user and password of your default database.

5. Run:

       $ bin/cake server

6. Taste on http://localhost:8765.

## Git Workflow

Proposed project workflow is a branch-often, merge-often model similar to the centralized topic model: https://git-scm.com/book/en/v2/Git-Branching-Branching-Workflows. Rather than forking, everyone is invited to work on his own branch and create specific feature branches from these. Once your feature is complete, merge with your branch and destroy. Once your branch is in a stable state, pull a request on master. Repeat.

Rebase and squash if you want on your branch, always merge on master (directly, or when accepting a pull request.) Corollary: don't work on others' branches, ask them to merge with master if you need their improvements.

### How to merge directly with master? (not recommended)

Please, refrain to merge directly with master, since the other contributors won't be actively alerted that you did, and your modifications won't be reviewed by another contributor (which is a healthy practice for everyone.)

So let's say you worked on `yourbranch` and you are ready to push your modifications in master.

1. First make sure ALL YOUR WORK IN YOUR BRANCH IS COMMITED with `git status`

1. `git checkout master` (jump on master branch)

1. `git pull` (fetch and merge master's modifications)

1. `git merge yourbranch` (merge your branch modifications in master: solve conflicts if there are any)

1. `git push` (DO NOT FORGET THIS, or it will not be published)

1. Now to make your own branch up-to-date:
    * `git checkout yourbranch`
    * `git merge master` (there should be no conflict as you already did the work)

1. Your branch should now be perfectly synchronized with master and a `git branch -vv` should show both are pointing to the same commit.

### How to work on a feature and offer it to others (recommended workflow)

1. Merge master on your main branch (e.g. "wodewood"). See above for a clean merge (don't forget to commit, pull, push everywhere!)

1. Create a feature branch with an explicit name (e.g. "doubleprefix")

1. Work on your feature branch as you like. (Commit often! Your internal small commits can be squashed later if you don't want them to appear later in the master history.)

1. If you want to clean your commit history from time to time, you can squash. The typical workflow would be:
    * a bunch of commit & push in your feature branch (possibly a lot, and that's ok)
    * when ready, merge to your main branch with a squash option

        * `git checkout mymainbranch`
        * `git merge --squash myfeaturebranch`
        * `git commit -m 'message about the feature included in the squash'`
        * `git push`

1. Repeat steps 3 and 4 as long as you work on your feature.

1. When your ready, create a pull request on master, with a message describing all the shipped features. Typically, there should be a small number of commits (such as a dozen - not hundreds!) to merge from your main branch to the master branch, if you squashed wisely between your feature branch and your main branch.

1. Whenever possible, wait for someone else to review and accept your pull request.
