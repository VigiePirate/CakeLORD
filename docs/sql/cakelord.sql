-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: testlord
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `subtitle` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coats`
--

DROP TABLE IF EXISTS `coats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des poils';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coats`
--

LOCK TABLES `coats` WRITE;
/*!40000 ALTER TABLE `coats` DISABLE KEYS */;
INSERT INTO `coats` VALUES (1,'Unknown','Unknown.png','?/?','Undetermined or not visible (naked rat)',1),(2,'Straight','Unknown.png','re/re','Straight, wildtype coat',0),(3,'Rex','Unknown.png','Re/re','Rexoid rat (can be more or less curly)',0);
/*!40000 ALTER TABLE `coats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `genotype` varchar(70) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
INSERT INTO `colors` VALUES (1,'Unknown','?/?','Unknown.png','Undetermined or unvisible color (due to albinism or overmarking, for instance)',1),(2,'Agouti','A/-','Unknown.png','Agouti (wild type)',0),(3,'Ambre','A/- p/p','Unknown.png','Agouti based pink-eyed dilute',0),(4,'Ambre bleu','A/- p/p g/g','Unknown.png','Ambre + Bleu US',1);
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compatibilities`
--

DROP TABLE IF EXISTS `compatibilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compatibilities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `left_genotype` varchar(255) NOT NULL,
  `operator_id` int(10) unsigned NOT NULL,
  `right_genotype` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `genotype1.idx` (`left_genotype`,`right_genotype`),
  KEY `genotype2.idx` (`right_genotype`,`left_genotype`),
  KEY `fk_compatibilities_compatibility_relations1` (`operator_id`),
  CONSTRAINT `fk_compatibilities_compatibility_relations1` FOREIGN KEY (`operator_id`) REFERENCES `operators` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Recensement des relations entre gènes.\nÀ améliorer ultérieurement. Pour référence : rgd.mcw.edu';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compatibilities`
--

LOCK TABLES `compatibilities` WRITE;
/*!40000 ALTER TABLE `compatibilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `compatibilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rat_id` int(10) unsigned DEFAULT NULL,
  `rattery_id` int(10) unsigned DEFAULT NULL,
  `litter_id` int(10) unsigned DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_conversations_ratteries1` (`rattery_id`),
  KEY `fk_conversations_litters1` (`litter_id`),
  KEY `fk_conversations_rats1` (`rat_id`),
  CONSTRAINT `fk_conversations_litters1` FOREIGN KEY (`litter_id`) REFERENCES `litters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_conversations_rats1` FOREIGN KEY (`rat_id`) REFERENCES `rats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_conversations_ratteries1` FOREIGN KEY (`rattery_id`) REFERENCES `ratteries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT=' ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversations`
--

LOCK TABLES `conversations` WRITE;
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `iso3166` char(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `iso3166_UNIQUE` (`iso3166`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Zombie Zone','ZZ'),(2,'France','FR'),(3,'Switzerland','CH');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `death_primary_causes`
--

DROP TABLE IF EXISTS `death_primary_causes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `death_primary_causes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des causes de décès';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `death_primary_causes`
--

LOCK TABLES `death_primary_causes` WRITE;
/*!40000 ALTER TABLE `death_primary_causes` DISABLE KEYS */;
INSERT INTO `death_primary_causes` VALUES (1,'1. Cause Inconnue','\'\''),(2,'2. Accidents, traumatismes, intoxications','\'\'');
/*!40000 ALTER TABLE `death_primary_causes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `death_secondary_causes`
--

DROP TABLE IF EXISTS `death_secondary_causes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `death_secondary_causes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `death_primary_cause_id` int(10) unsigned NOT NULL,
  `description` text NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_deces_secondaire_deces_principal1` (`death_primary_cause_id`),
  CONSTRAINT `fk_deces_secondaire_deces_principal1` FOREIGN KEY (`death_primary_cause_id`) REFERENCES `death_primary_causes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `death_secondary_causes`
--

LOCK TABLES `death_secondary_causes` WRITE;
/*!40000 ALTER TABLE `death_secondary_causes` DISABLE KEYS */;
INSERT INTO `death_secondary_causes` VALUES (1,'1.1. Aucune information (présumé mort)',1,'\'\''),(2,'1.2. Cause indéterminée (date connue)',1,'\'\''),(3,'2.1. Accident domestique (écrasement, accident de porte...)',2,'\'\''),(4,'2.2. Accident vétérinaire (anesthésie lors d’une opération mineure, erreur médicale...)',2,'\'\'');
/*!40000 ALTER TABLE `death_secondary_causes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dilutions`
--

DROP TABLE IF EXISTS `dilutions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dilutions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des dilutions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dilutions`
--

LOCK TABLES `dilutions` WRITE;
/*!40000 ALTER TABLE `dilutions` DISABLE KEYS */;
INSERT INTO `dilutions` VALUES (1,'None','Unknown.png','C/C','No dilution',0),(2,'Albino','Unknown.png','c/c','Unpigmented. Usually with pink or red eyes.',0);
/*!40000 ALTER TABLE `dilutions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `earsets`
--

DROP TABLE IF EXISTS `earsets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `earsets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `earsets`
--

LOCK TABLES `earsets` WRITE;
/*!40000 ALTER TABLE `earsets` DISABLE KEYS */;
INSERT INTO `earsets` VALUES (1,'Unknown','Unknown.png','?/?','Unknown',1),(2,'Standard','Unknown.png','Dmbo/-','Top eared (wild type)',0),(3,'Dumbo','Unknown.png','dmbo/dmbo','Dumbo ears',0);
/*!40000 ALTER TABLE `earsets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eyecolors`
--

DROP TABLE IF EXISTS `eyecolors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eyecolors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='Table contenant la liste des yeux';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eyecolors`
--

LOCK TABLES `eyecolors` WRITE;
/*!40000 ALTER TABLE `eyecolors` DISABLE KEYS */;
INSERT INTO `eyecolors` VALUES (1,'Unknown','Unknown.png','?/?','Undetermined or non visible (enucleated rat...)',1),(2,'Black','Unknown.png','BlackEyed','Normal black eyes',0),(3,'Ruby','Unknown.png','RubyEyed','Including so called Dark Ruby. Typical of r/r rats.',0),(4,'Red','Unknown.png','RedEyed','Typical of dilutions',0),(5,'Pink','Unknown.png','PinkEyed','Typical of p/p rats',0),(6,'Odd Eyed','Unknown.png','OddEyed','The two eyes have a different color (any combination, describe in comments.)',0);
/*!40000 ALTER TABLE `eyecolors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `i18n`
--

DROP TABLE IF EXISTS `i18n`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `i18n` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  KEY `I18N_FIELD` (`model`,`foreign_key`,`field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table conforme à l''utilisation de la classe Cake\\ORM\\Behavior\\TranslateBehavior de type EAV.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `i18n`
--

LOCK TABLES `i18n` WRITE;
/*!40000 ALTER TABLE `i18n` DISABLE KEYS */;
/*!40000 ALTER TABLE `i18n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `litter_snapshots`
--

DROP TABLE IF EXISTS `litter_snapshots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `litter_snapshots` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `litter_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_litter_snapshots_litters1` (`litter_id`),
  KEY `fk_litter_snapshots_states1` (`state_id`),
  CONSTRAINT `fk_litter_snapshots_litters1` FOREIGN KEY (`litter_id`) REFERENCES `litters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_litter_snapshots_states1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `litter_snapshots`
--

LOCK TABLES `litter_snapshots` WRITE;
/*!40000 ALTER TABLE `litter_snapshots` DISABLE KEYS */;
/*!40000 ALTER TABLE `litter_snapshots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `litters`
--

DROP TABLE IF EXISTS `litters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `litters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mating_date` date DEFAULT NULL,
  `birth_date` date NOT NULL,
  `pups_number` tinyint(3) unsigned NOT NULL,
  `pups_number_stillborn` tinyint(3) unsigned DEFAULT 0,
  `comments` text DEFAULT NULL,
  `creator_user_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT '1981-08-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '1981-08-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_itter_breeder_user` (`creator_user_id`),
  KEY `fk_litters_states1` (`state_id`),
  CONSTRAINT `fk_itter_breeder_user` FOREIGN KEY (`creator_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_litters_states1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `litters`
--

LOCK TABLES `litters` WRITE;
/*!40000 ALTER TABLE `litters` DISABLE KEYS */;
INSERT INTO `litters` VALUES (1,'2010-06-01','2010-06-22',12,1,'',3,1,'2020-03-02 21:04:18','2020-03-21 19:26:23'),(2,'2011-06-01','2011-06-22',5,0,'',3,1,'2020-03-02 21:18:01','2020-03-21 19:32:10');
/*!40000 ALTER TABLE `litters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `litters_contributions`
--

DROP TABLE IF EXISTS `litters_contributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `litters_contributions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `priority` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `priority_UNIQUE` (`priority`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `litters_contributions`
--

LOCK TABLES `litters_contributions` WRITE;
/*!40000 ALTER TABLE `litters_contributions` DISABLE KEYS */;
INSERT INTO `litters_contributions` VALUES (1,'Main',1),(2,'Mother',2),(3,'Father',3);
/*!40000 ALTER TABLE `litters_contributions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `markings`
--

DROP TABLE IF EXISTS `markings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `markings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des marquages';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `markings`
--

LOCK TABLES `markings` WRITE;
/*!40000 ALTER TABLE `markings` DISABLE KEYS */;
INSERT INTO `markings` VALUES (1,'Unknown','Unknown.png','?/?','Undetermined or invisible marking (dilution, naked)',0),(2,'Baldie','Unknown.png','H^ro/h','Essex with more white',1),(3,'Bareback','Unknown.png','h/h hs/hs ⊕ h/h^e ⊕ h/H^ms ⊕ h/h^i','Colored head and shoulders',0),(4,'Berkshire','Unknown.png','H/h ⊕ h/h(e) ⊕ h(i)/h(i) ⊕ h(i)/h(n)','Colored rat, white belly up to the flanks',0),(5,'Capped','Unknown.png','h(n)/h(n)','Only head colored, usually with a spot',0);
/*!40000 ALTER TABLE `markings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `from_user_id` int(10) unsigned NOT NULL COMMENT 'Émetteur du message.',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`,`conversation_id`),
  KEY `fk_messages_conversations1` (`conversation_id`),
  KEY `fk_messages_users1` (`from_user_id`),
  CONSTRAINT `fk_messages_conversations1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_users1` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operators`
--

DROP TABLE IF EXISTS `operators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `symbol` char(2) NOT NULL,
  `meaning` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operators`
--

LOCK TABLES `operators` WRITE;
/*!40000 ALTER TABLE `operators` DISABLE KEYS */;
/*!40000 ALTER TABLE `operators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rat_snapshots`
--

DROP TABLE IF EXISTS `rat_snapshots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rat_snapshots` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `rat_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rat_snapshots_rats1` (`rat_id`),
  KEY `fk_rat_snapshots_states1` (`state_id`),
  CONSTRAINT `fk_rat_snapshots_rats1` FOREIGN KEY (`rat_id`) REFERENCES `rats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rat_snapshots_states1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rat_snapshots`
--

LOCK TABLES `rat_snapshots` WRITE;
/*!40000 ALTER TABLE `rat_snapshots` DISABLE KEYS */;
/*!40000 ALTER TABLE `rat_snapshots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rats`
--

DROP TABLE IF EXISTS `rats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pedigree_identifier` varchar(16) DEFAULT NULL,
  `is_pedigree_custom` tinyint(1) NOT NULL DEFAULT 0,
  `owner_user_id` int(10) unsigned NOT NULL,
  `name` varchar(70) NOT NULL,
  `pup_name` varchar(70) DEFAULT NULL,
  `sex` enum('M','F') NOT NULL,
  `birth_date` date NOT NULL,
  `rattery_id` int(10) unsigned NOT NULL DEFAULT 1,
  `litter_id` int(10) unsigned DEFAULT NULL,
  `color_id` int(10) unsigned NOT NULL DEFAULT 1,
  `eyecolor_id` int(10) unsigned NOT NULL DEFAULT 1,
  `dilution_id` int(10) unsigned NOT NULL DEFAULT 1,
  `marking_id` int(10) unsigned NOT NULL DEFAULT 1,
  `earset_id` int(10) unsigned NOT NULL DEFAULT 1,
  `coat_id` int(10) unsigned NOT NULL DEFAULT 1,
  `is_alive` tinyint(1) NOT NULL DEFAULT 1,
  `death_date` date DEFAULT NULL,
  `death_primary_cause_id` int(10) unsigned DEFAULT NULL,
  `death_secondary_cause_id` int(10) unsigned DEFAULT NULL,
  `death_euthanized` tinyint(1) DEFAULT NULL,
  `death_diagnosed` tinyint(1) DEFAULT NULL,
  `death_necropsied` tinyint(1) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT 'Unknown.png',
  `picture_thumbnail` varchar(255) DEFAULT NULL,
  `creator_user_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT '1981-08-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '1981-08-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `Pedigree_identifier_UNIQUE` (`pedigree_identifier`),
  KEY `Fk_owner` (`owner_user_id`),
  KEY `FK_color` (`color_id`),
  KEY `FK_earset` (`earset_id`),
  KEY `FK_eyecolor` (`eyecolor_id`),
  KEY `fk_dilution` (`dilution_id`),
  KEY `fk_coat` (`coat_id`),
  KEY `fk_marking` (`marking_id`),
  KEY `FK_death_primary_cause` (`death_primary_cause_id`),
  KEY `FK_creator` (`creator_user_id`),
  KEY `fk_death_secondary_cause` (`death_secondary_cause_id`),
  KEY `fk_state` (`state_id`),
  KEY `fk_rats_ratteries1` (`rattery_id`),
  KEY `fk_rats_litters1` (`litter_id`),
  CONSTRAINT `FK_color` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_creator` FOREIGN KEY (`creator_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_death_primary_cause` FOREIGN KEY (`death_primary_cause_id`) REFERENCES `death_primary_causes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_earset` FOREIGN KEY (`earset_id`) REFERENCES `earsets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_eyecolor` FOREIGN KEY (`eyecolor_id`) REFERENCES `eyecolors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Fk_owner` FOREIGN KEY (`owner_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_coat` FOREIGN KEY (`coat_id`) REFERENCES `coats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_death_secondary_cause` FOREIGN KEY (`death_secondary_cause_id`) REFERENCES `death_secondary_causes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_dilution` FOREIGN KEY (`dilution_id`) REFERENCES `dilutions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_marking` FOREIGN KEY (`marking_id`) REFERENCES `markings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rats_litters1` FOREIGN KEY (`litter_id`) REFERENCES `litters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rats_ratteries1` FOREIGN KEY (`rattery_id`) REFERENCES `ratteries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_state` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='Table centrale, qui contient l''ensemble des rats enregistrés\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rats`
--

LOCK TABLES `rats` WRITE;
/*!40000 ALTER TABLE `rats` DISABLE KEYS */;
INSERT INTO `rats` VALUES (1,'INC1F',0,5,'Grandmother','','F','2010-01-01',1,NULL,2,2,1,4,2,2,1,NULL,NULL,NULL,0,0,0,'','','',3,1,'2020-02-29 21:48:06','2020-03-14 12:12:43'),(2,'IND2M',0,2,'Grandfather','','M','2010-01-01',2,NULL,3,5,1,4,3,3,0,'2012-01-01',2,4,0,1,0,'','','',3,2,'2020-02-29 21:49:10','2020-03-02 21:20:16'),(3,'INC3M',0,2,'Father','','M','2010-06-22',1,1,1,2,2,3,3,3,1,NULL,NULL,NULL,0,0,0,'','',NULL,3,1,'2020-03-02 21:09:04','2020-03-21 19:22:34'),(4,'LAB4F',0,7,'Mother','','F','2011-01-01',4,NULL,1,5,2,1,3,2,1,NULL,NULL,NULL,0,0,0,'','',NULL,7,1,'2020-03-02 21:15:42','2020-03-02 21:17:28'),(5,'ARN5M',0,3,'Child','Jean-Merguez','M','2011-06-22',7,2,2,2,1,5,3,2,1,NULL,NULL,NULL,0,0,0,'','',NULL,3,1,'2020-03-02 21:19:17','2020-03-21 19:23:47'),(6,'HELL666F',1,4,'Girlfriend','','F','2012-01-01',9,NULL,3,5,1,4,3,2,1,NULL,NULL,NULL,0,0,0,'','',NULL,3,1,'2020-03-02 21:37:21','2020-03-02 21:37:53');
/*!40000 ALTER TABLE `rats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rats_litters`
--

DROP TABLE IF EXISTS `rats_litters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rats_litters` (
  `rat_id` int(10) unsigned NOT NULL,
  `litter_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`rat_id`,`litter_id`),
  KEY `fk_rats_has_litters_litters1` (`litter_id`),
  CONSTRAINT `fk_rats_has_litters_litters1` FOREIGN KEY (`litter_id`) REFERENCES `litters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rats_has_litters_rats1` FOREIGN KEY (`rat_id`) REFERENCES `rats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='These rats are siring a litter.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rats_litters`
--

LOCK TABLES `rats_litters` WRITE;
/*!40000 ALTER TABLE `rats_litters` DISABLE KEYS */;
INSERT INTO `rats_litters` VALUES (1,1),(2,1),(3,2),(4,2);
/*!40000 ALTER TABLE `rats_litters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rats_singularities`
--

DROP TABLE IF EXISTS `rats_singularities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rats_singularities` (
  `rat_id` int(10) unsigned NOT NULL,
  `singularity_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`rat_id`,`singularity_id`),
  KEY `singularities_key` (`singularity_id`),
  CONSTRAINT `rats_key` FOREIGN KEY (`rat_id`) REFERENCES `rats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `singularities_key` FOREIGN KEY (`singularity_id`) REFERENCES `singularities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rats_singularities`
--

LOCK TABLES `rats_singularities` WRITE;
/*!40000 ALTER TABLE `rats_singularities` DISABLE KEYS */;
INSERT INTO `rats_singularities` VALUES (3,3);
/*!40000 ALTER TABLE `rats_singularities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratteries`
--

DROP TABLE IF EXISTS `ratteries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratteries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prefix` varchar(6) NOT NULL,
  `name` varchar(70) NOT NULL,
  `owner_user_id` int(10) unsigned NOT NULL,
  `birth_year` year(4) DEFAULT NULL,
  `is_alive` tinyint(1) NOT NULL DEFAULT 1,
  `is_generic` tinyint(1) NOT NULL DEFAULT 0,
  `district` varchar(70) DEFAULT NULL,
  `zip_code` varchar(12) DEFAULT NULL,
  `country_id` int(10) unsigned NOT NULL DEFAULT 1,
  `website` varchar(255) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `wants_statistic` tinyint(1) NOT NULL DEFAULT 1,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `state_id` int(10) unsigned NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT '1981-08-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '1981-08-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `prefix_UNIQUE` (`prefix`),
  UNIQUE KEY `prefix` (`prefix`),
  KEY `fk_lord_ratteries_lord_users1` (`owner_user_id`),
  KEY `fk_ratteries_states1` (`state_id`),
  KEY `fk_ratteries_countries1` (`country_id`),
  CONSTRAINT `fk_lord_ratteries_lord_users1` FOREIGN KEY (`owner_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratteries_countries1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratteries_states1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratteries`
--

LOCK TABLES `ratteries` WRITE;
/*!40000 ALTER TABLE `ratteries` DISABLE KEYS */;
INSERT INTO `ratteries` VALUES (1,'INC','Petshop',1,1956,1,1,'','',1,'','',1,'Unknown.png',1,'2020-02-28 19:25:58','2020-02-28 19:25:58'),(2,'IND','Freelance',1,2006,1,1,'','',1,'','',1,'Unknown.png',1,'2020-02-28 19:29:09','2020-02-28 19:38:18'),(3,'ETR','Foreign',1,2006,1,1,'','',1,'','',1,'Unknown.png',1,'2020-02-28 19:31:14','2020-02-28 19:39:30'),(4,'LAB','Laboratory',1,2006,1,1,'','',1,'','',1,'Unknown.png',1,'2020-02-28 19:31:45','2020-02-28 19:38:37'),(5,'SOS','Rescue',1,2006,1,1,'','',1,'','',1,'Unknown.png',1,'2020-02-28 19:33:50','2020-02-28 19:33:50'),(6,'SVG','Wild',1,2006,1,1,'','',1,'','',1,'Unknown.png',1,'2020-02-28 19:37:41','2020-02-28 19:37:41'),(7,'ARN','A Rattery Name',3,2008,1,0,'35','',2,'https://www.myratterysite.com','',1,'Unknown.png',1,'2020-02-28 19:51:29','2020-03-14 12:21:22'),(8,'ADR','A Discrete Rattery',7,2006,1,0,'Some Region','',2,'','',0,'Unknown.png',2,'2020-02-28 20:02:48','2020-03-14 12:22:44'),(9,'BOFH','Bastard Operator From Hell',4,2020,1,0,'','',3,'','',1,'Unknown.png',1,'2020-02-28 20:10:20','2020-03-14 12:20:09');
/*!40000 ALTER TABLE `ratteries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratteries_litters`
--

DROP TABLE IF EXISTS `ratteries_litters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratteries_litters` (
  `rattery_id` int(10) unsigned NOT NULL,
  `litter_id` int(10) unsigned NOT NULL,
  `litters_contribution_id` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`rattery_id`,`litter_id`),
  KEY `fk_ratteries_has_litters_litters1` (`litter_id`),
  KEY `fk_ratteries_litters_litters_contributions1` (`litters_contribution_id`),
  CONSTRAINT `fk_ratteries_has_litters_litters1` FOREIGN KEY (`litter_id`) REFERENCES `litters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratteries_has_litters_ratteries1` FOREIGN KEY (`rattery_id`) REFERENCES `ratteries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratteries_litters_litters_contributions1` FOREIGN KEY (`litters_contribution_id`) REFERENCES `litters_contributions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratteries_litters`
--

LOCK TABLES `ratteries_litters` WRITE;
/*!40000 ALTER TABLE `ratteries_litters` DISABLE KEYS */;
INSERT INTO `ratteries_litters` VALUES (2,1,1),(7,2,1);
/*!40000 ALTER TABLE `ratteries_litters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rattery_snapshots`
--

DROP TABLE IF EXISTS `rattery_snapshots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rattery_snapshots` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `rattery_id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rattery_snapshots_ratteries1` (`rattery_id`),
  KEY `fk_rattery_snapshots_states1` (`state_id`),
  CONSTRAINT `fk_rattery_snapshots_ratteries1` FOREIGN KEY (`rattery_id`) REFERENCES `ratteries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rattery_snapshots_states1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rattery_snapshots`
--

LOCK TABLES `rattery_snapshots` WRITE;
/*!40000 ALTER TABLE `rattery_snapshots` DISABLE KEYS */;
/*!40000 ALTER TABLE `rattery_snapshots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (2,'Admin'),(5,'Guest'),(1,'Root'),(3,'Staff'),(4,'User');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `singularities`
--

DROP TABLE IF EXISTS `singularities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `singularities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des particularités';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `singularities`
--

LOCK TABLES `singularities` WRITE;
/*!40000 ALTER TABLE `singularities` DISABLE KEYS */;
INSERT INTO `singularities` VALUES (1,'Down Under','Unknown.png','DU/du','Same marking on belly and back',1),(2,'Dwarf','Unknown.png','dw/dw','Dwarf rat',0),(3,'Headspot','Unknown.png','hs/hs','White spot on the head',0);
/*!40000 ALTER TABLE `singularities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `color` char(6) NOT NULL COMMENT 'Codage hexadécimal de la composition RVB (par exemple f8d345)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'OK','90e40c'),(2,'Pending Staff Action','fab109'),(3,'Pending User Action','e62c18'),(4,'Unverified','393939');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(70) NOT NULL,
  `password` varchar(70) NOT NULL,
  `username` varchar(45) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `sex` enum('M','F','') DEFAULT '',
  `localization` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `about_me` text DEFAULT NULL,
  `wants_newsletter` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` int(10) unsigned NOT NULL DEFAULT 4,
  `failed_login_attempts` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `failed_login_last_date` datetime DEFAULT NULL,
  `is_locked` tinyint(1) NOT NULL DEFAULT 0,
  `staff_comments` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '1981-08-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '1981-08-01 00:00:00',
  `passkey` char(23) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_users_roles` (`role_id`),
  CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'lord@example.com','$2y$10$Qxn8Jd3S9ZaD/oLobGuxi.McdeRsJVXJxpjvZRfp9gO0R6wefOrl.','LORD','','','1981-08-01','','','LogoLord.png','',1,1,0,NULL,0,'','2020-02-28 17:00:33','2020-03-14 12:08:33','5e760c2a046250.91135739'),(2,'unregistered@example.com','$2y$10$bK54f/ZiYS3OiiSnnIxzIOdeXmR0LP7F07.UeuigaeHnhiBvF6Wbu','Unregistered','','',NULL,'','','Unknown.png','Generic account for ownership of generic ratteries and rats without registered owners.',0,4,0,NULL,0,'','2020-02-28 17:08:52','2020-03-14 12:10:08',NULL),(3,'admin@example.com','$2y$10$Z9xazIIqXxFnvqXXbathsO7yZhdgEgOxg92j6r0HWvhCAQ568RnKu','Admin','Prénom','Nom','1981-08-01','F','99','Unknown.png','',1,2,0,NULL,0,'','2020-02-28 17:17:42','2020-03-14 12:16:16',NULL),(4,'staff@example.com','$2y$10$Ys0kKEfNGl2xRqlc9//WCeIDn7LR9oObePr92HBZMn0vkBvThIhnG','Staff','Staff','Member',NULL,'','','Unknown.png','',0,3,0,NULL,0,'','2020-02-28 17:20:07','2020-03-14 12:14:51',NULL),(5,'user@example.com','$2y$10$6g5qWSe6KnokjrXJBAdkuOiXCBudtQn08UGDdDVJ/3ou3OLLCTNHa','User','User','Lambda',NULL,'','','Unknown.png','',0,4,0,NULL,0,'','2020-02-28 17:22:31','2020-03-14 12:11:58','5e7660dace3693.77666803'),(6,'anotheruser@example.com','$2y$10$WTovz1alU6LGoIgUKTwyAufAiuauNo4i1bVkgnhpKr0xSYmdDEK3y','AnotherUser','Another','User',NULL,'M','','Unknown.png','',0,4,0,NULL,0,'','2020-02-28 17:26:03','2020-03-14 12:14:22',NULL),(7,'yetanotheruser@example.com','$2y$10$LX.hNVWCLpFHBB4DoNx83e65DETVePySQZ8EsynHIZeR3DTZhZyDK','Yet Another User','Yet','Another User',NULL,'M','Some place','Unknown.png','',0,2,0,NULL,0,'This user is a pain in the *ss!','2020-02-28 19:53:20','2020-03-14 12:28:43',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_conversations`
--

DROP TABLE IF EXISTS `users_conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_conversations` (
  `user_id` int(10) unsigned NOT NULL,
  `conversation_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`conversation_id`),
  KEY `fk_users_has_conversations_conversations1` (`conversation_id`),
  CONSTRAINT `fk_users_has_conversations_conversations1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_conversations_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_conversations`
--

LOCK TABLES `users_conversations` WRITE;
/*!40000 ALTER TABLE `users_conversations` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_conversations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-21 19:47:32
