-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cakelord
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des causes de décès';
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des dilutions';
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Table contenant la liste des yeux';
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des marquages';
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Table centrale, qui contient l''ensemble des rats enregistrés\n';
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Table référençant la liste des particularités';
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `symbol` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  KEY `fk_users_roles` (`role_id`),
  CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-21 19:52:18
