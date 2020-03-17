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
