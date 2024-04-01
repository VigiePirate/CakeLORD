![GitHub License](https://img.shields.io/github/license/VigiePirate/CakeLORD)

# Livre des Origines du Rat Domestique

## Presentation

The ***"Livre des Origines du Rat Domestique"*** (abbreviated as *LORD*) is the French translation for ***"Pet Rat Book of Origins"***. It is an open [breed registry](https://en.wikipedia.org/wiki/Breed_registry) dedicated to pet rats. Its purpose is to keep track of pedigrees, to record ratteries, to monitor pet rat population especially by means of statistics, and to help breeders and owners to keep track of their rats and their families.

To give a few examples, collected information about animal origins allows: to avoid unwanted inbreeding, to prevent hereditary disease, to generate complete and fully accessible family trees, to compute coefficients of inbreeding from them, to derive all kind of statistics (lifespan, death causes, varieties...) so as to monitor the livestock.

LORD first deployment concerns pet rats in France and neighbouring countries, but source code is open to allow for any one interested to adapt and deploy a studbook for other areas or other species.

## Installation

1. Install Mysql or MariaDB, PHP (minimum 8.2, with extensions mbstring, PDO, intl and simplexml) and composer for your system: https://getcomposer.org/download/

2. Initialize a local git repository and clone this project:

       $ git clone https://github.com/VigiePirate/CakeLORD.git

3. Go in the CakeLORD directory and run:

       $ composer install

4. Edit the file `config/app_local.php`, `Datasources` section, with the name, user and password of your default database.

5. Run:

       $ bin/cake server

6. Taste on http://localhost:8765.

## Support

LORD is a free project hosted by a non-profit association and developed by a handful of volunteers. We cannot guarantee support, but might be able to answer issues here or questions posted on the project's [support forum](https://www.srfa.info/forums/forum/229-lord/) from time to time.

## Demo

Our live site can be visited at https://lord.srfa.info

## Contributions

All contributions are welcome.
