-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: mysql    Database: cakelord
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
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  KEY `fk_articles_categories1_idx` (`category_id`),
  CONSTRAINT `fk_articles_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `position` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des poils';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coats`
--

LOCK TABLES `coats` WRITE;
/*!40000 ALTER TABLE `coats` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
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
  KEY `fk_operator1_idx` (`operator_id`),
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
-- Table structure for table `contribution_types`
--

DROP TABLE IF EXISTS `contribution_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contribution_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `priority` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `priority_UNIQUE` (`priority`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contribution_types`
--

LOCK TABLES `contribution_types` WRITE;
/*!40000 ALTER TABLE `contribution_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `contribution_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contributions`
--

DROP TABLE IF EXISTS `contributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contributions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rattery_id` int(10) unsigned NOT NULL,
  `litter_id` int(10) unsigned NOT NULL,
  `contribution_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ratteries_litters_litters1_idx` (`litter_id`),
  KEY `fk_ratteries_litters_ratteries1_idx` (`rattery_id`),
  KEY `fk_contributions_contribution_types1_idx` (`contribution_type_id`),
  CONSTRAINT `fk_contributions_has_contribution_types1` FOREIGN KEY (`contribution_type_id`) REFERENCES `contribution_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratteries_has_litters_litters1` FOREIGN KEY (`litter_id`) REFERENCES `litters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratteries_has_litters_ratteries1` FOREIGN KEY (`rattery_id`) REFERENCES `ratteries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contributions`
--

LOCK TABLES `contributions` WRITE;
/*!40000 ALTER TABLE `contributions` DISABLE KEYS */;
/*!40000 ALTER TABLE `contributions` ENABLE KEYS */;
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
  KEY `fk_conversations_ratteries1_idx` (`rattery_id`),
  KEY `fk_conversations_litters1_idx` (`litter_id`),
  KEY `fk_conversations_rats1_idx` (`rat_id`),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
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
  `is_infant` tinyint(1) NOT NULL DEFAULT 0,
  `is_accident` tinyint(1) NOT NULL DEFAULT 0,
  `is_oldster` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des causes de décès';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `death_primary_causes`
--

LOCK TABLES `death_primary_causes` WRITE;
/*!40000 ALTER TABLE `death_primary_causes` DISABLE KEYS */;
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
  `is_tumor` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_deces_secondaire_deces_principal_idx` (`death_primary_cause_id`),
  CONSTRAINT `fk_deces_secondaire_deces_principal1` FOREIGN KEY (`death_primary_cause_id`) REFERENCES `death_primary_causes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `death_secondary_causes`
--

LOCK TABLES `death_secondary_causes` WRITE;
/*!40000 ALTER TABLE `death_secondary_causes` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des dilutions';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dilutions`
--

LOCK TABLES `dilutions` WRITE;
/*!40000 ALTER TABLE `dilutions` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `earsets`
--

LOCK TABLES `earsets` WRITE;
/*!40000 ALTER TABLE `earsets` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table contenant la liste des yeux';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eyecolors`
--

LOCK TABLES `eyecolors` WRITE;
/*!40000 ALTER TABLE `eyecolors` DISABLE KEYS */;
/*!40000 ALTER TABLE `eyecolors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_faqs_categories1_idx` (`category_id`),
  CONSTRAINT `fk_faqs_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table conforme à l’utilisation de la classe Cake\\ORM\\Behavior\\TranslateBehavior de type EAV.';
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
  KEY `fk_litter_snapshots_litters1_idx` (`litter_id`),
  KEY `fk_litter_snapshots_states1_idx` (`state_id`),
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
  KEY `fk_itter_breeder_user_idx` (`creator_user_id`),
  KEY `fk_litters_states1_idx` (`state_id`),
  CONSTRAINT `fk_itter_breeder_user` FOREIGN KEY (`creator_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_litters_states1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `litters`
--

LOCK TABLES `litters` WRITE;
/*!40000 ALTER TABLE `litters` DISABLE KEYS */;
/*!40000 ALTER TABLE `litters` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des marquages';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `markings`
--

LOCK TABLES `markings` WRITE;
/*!40000 ALTER TABLE `markings` DISABLE KEYS */;
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
  KEY `fk_messages_conversations1_idx` (`conversation_id`),
  KEY `fk_messages_users1_idx` (`from_user_id`),
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
  KEY `fk_rat_snapshots_rats1_idx` (`rat_id`),
  KEY `fk_rat_snapshots_states1_idx` (`state_id`),
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
  KEY `Fk_owner_idx` (`owner_user_id`),
  KEY `FK_color_idx` (`color_id`),
  KEY `FK_earset_idx` (`earset_id`),
  KEY `FK_eyecolor_idx` (`eyecolor_id`),
  KEY `fk_dilution_idx` (`dilution_id`),
  KEY `fk_coat_idx` (`coat_id`),
  KEY `fk_marking_idx` (`marking_id`),
  KEY `FK_death_primary_cause_idx` (`death_primary_cause_id`),
  KEY `FK_creator_idx` (`creator_user_id`),
  KEY `fk_death_secondary_cause_idx` (`death_secondary_cause_id`),
  KEY `fk_states_idx` (`state_id`),
  KEY `fk_rats_ratteries1_idx` (`rattery_id`),
  KEY `fk_rats_litters1_idx` (`litter_id`),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table centrale, qui contient l’ensemble des rats enregistrés\n';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rats`
--

LOCK TABLES `rats` WRITE;
/*!40000 ALTER TABLE `rats` DISABLE KEYS */;
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
  KEY `fk_rats_litters_litters1_idx` (`litter_id`),
  CONSTRAINT `fk_rats_has_litters_litters1` FOREIGN KEY (`litter_id`) REFERENCES `litters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rats_has_litters_rats1` FOREIGN KEY (`rat_id`) REFERENCES `rats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='These rats are siring a litter.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rats_litters`
--

LOCK TABLES `rats_litters` WRITE;
/*!40000 ALTER TABLE `rats_litters` DISABLE KEYS */;
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
  KEY `singularities_key_idx` (`singularity_id`),
  CONSTRAINT `rats_key` FOREIGN KEY (`rat_id`) REFERENCES `rats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `singularities_key` FOREIGN KEY (`singularity_id`) REFERENCES `singularities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rats_singularities`
--

LOCK TABLES `rats_singularities` WRITE;
/*!40000 ALTER TABLE `rats_singularities` DISABLE KEYS */;
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
  KEY `fk_ratteries_users_idx` (`owner_user_id`),
  KEY `fk_ratteries_states_idx` (`state_id`),
  KEY `fk_ratteries_countries1_idx` (`country_id`),
  CONSTRAINT `fk_lord_ratteries_lord_users1` FOREIGN KEY (`owner_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratteries_countries1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ratteries_states1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratteries`
--

LOCK TABLES `ratteries` WRITE;
/*!40000 ALTER TABLE `ratteries` DISABLE KEYS */;
/*!40000 ALTER TABLE `ratteries` ENABLE KEYS */;
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
  KEY `fk_rattery_snapshots_ratteries1_idx` (`rattery_id`),
  KEY `fk_rattery_snapshots_states1_idx` (`state_id`),
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
  `is_root` tinyint(1) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_staff` tinyint(1) NOT NULL DEFAULT 0,
  `can_change_state` tinyint(1) NOT NULL DEFAULT 0,
  `can_edit_others` tinyint(1) NOT NULL DEFAULT 0,
  `can_edit_frozen` tinyint(1) NOT NULL DEFAULT 0,
  `can_delete` tinyint(1) NOT NULL DEFAULT 0,
  `can_configure` tinyint(1) NOT NULL DEFAULT 0,
  `can_restore` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des particularités';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `singularities`
--

LOCK TABLES `singularities` WRITE;
/*!40000 ALTER TABLE `singularities` DISABLE KEYS */;
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
  `color` char(6) DEFAULT NULL COMMENT 'Codage hexadécimal de la composition RVB (par exemple f8d345)',
  `symbol` char(1) NOT NULL,
  `css_property` varchar(45) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `needs_user_action` tinyint(1) NOT NULL DEFAULT 0,
  `needs_staff_action` tinyint(1) NOT NULL DEFAULT 0,
  `is_reliable` tinyint(1) NOT NULL DEFAULT 0,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `is_searchable` tinyint(1) NOT NULL DEFAULT 1,
  `is_frozen` tinyint(1) NOT NULL DEFAULT 0,
  `next_ok_state_id` int(10) unsigned DEFAULT NULL,
  `next_ko_state_id` int(10) unsigned DEFAULT NULL,
  `next_frozen_state_id` int(10) unsigned DEFAULT NULL,
  `next_thawed_state_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_states_states1_idx` (`next_ok_state_id`),
  KEY `fk_states_states2_idx` (`next_ko_state_id`),
  KEY `fk_states_states3_idx` (`next_frozen_state_id`),
  KEY `fk_states_states4_idx` (`next_thawed_state_id`),
  CONSTRAINT `fk_states_states1` FOREIGN KEY (`next_ok_state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_states_states2` FOREIGN KEY (`next_ko_state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_states_states3` FOREIGN KEY (`next_frozen_state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_states_states4` FOREIGN KEY (`next_thawed_state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
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
  `passkey` char(23) DEFAULT NULL,
  `staff_comments` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '1981-08-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '1981-08-01 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_users_roles_idx` (`role_id`),
  CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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
  KEY `fk_users_has_conversations_conversations1_idx` (`conversation_id`),
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

-- Dump completed on 2020-06-14 22:34:36
