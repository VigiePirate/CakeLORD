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
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `compatibilities`
--

LOCK TABLES `compatibilities` WRITE;
/*!40000 ALTER TABLE `compatibilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `compatibilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `conversations`
--

LOCK TABLES `conversations` WRITE;
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `i18n`
--

LOCK TABLES `i18n` WRITE;
/*!40000 ALTER TABLE `i18n` DISABLE KEYS */;
/*!40000 ALTER TABLE `i18n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `litter_snapshots`
--

LOCK TABLES `litter_snapshots` WRITE;
/*!40000 ALTER TABLE `litter_snapshots` DISABLE KEYS */;
/*!40000 ALTER TABLE `litter_snapshots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `litters`
--

LOCK TABLES `litters` WRITE;
/*!40000 ALTER TABLE `litters` DISABLE KEYS */;
INSERT INTO `litters` (`id`, `mating_date`, `birth_date`, `pups_number`, `pups_number_stillborn`, `comments`, `creator_user_id`, `state_id`, `created`, `modified`) VALUES (1,'2010-06-01','2010-06-22',12,1,'',3,1,'2020-03-02 21:04:18','2020-03-21 19:26:23'),
(2,'2011-06-01','2011-06-22',5,0,'',3,1,'2020-03-02 21:18:01','2020-03-21 19:32:10');
/*!40000 ALTER TABLE `litters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `operators`
--

LOCK TABLES `operators` WRITE;
/*!40000 ALTER TABLE `operators` DISABLE KEYS */;
/*!40000 ALTER TABLE `operators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rat_snapshots`
--

LOCK TABLES `rat_snapshots` WRITE;
/*!40000 ALTER TABLE `rat_snapshots` DISABLE KEYS */;
/*!40000 ALTER TABLE `rat_snapshots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rats`
--

LOCK TABLES `rats` WRITE;
/*!40000 ALTER TABLE `rats` DISABLE KEYS */;
INSERT INTO `rats` (`id`, `pedigree_identifier`, `is_pedigree_custom`, `owner_user_id`, `name`, `pup_name`, `sex`, `birth_date`, `rattery_id`, `litter_id`, `color_id`, `eyecolor_id`, `dilution_id`, `marking_id`, `earset_id`, `coat_id`, `is_alive`, `death_date`, `death_primary_cause_id`, `death_secondary_cause_id`, `death_euthanized`, `death_diagnosed`, `death_necropsied`, `comments`, `picture`, `picture_thumbnail`, `creator_user_id`, `state_id`, `created`, `modified`) VALUES (1,'INC1F',0,5,'Grandmother','','F','2010-01-01',1,NULL,2,2,1,4,2,2,1,NULL,NULL,NULL,0,0,0,'','','',3,1,'2020-02-29 21:48:06','2020-03-14 12:12:43'),
(2,'IND2M',0,2,'Grandfather','','M','2010-01-01',2,NULL,3,5,1,4,3,3,0,'2012-01-01',2,4,0,1,0,'','','',3,2,'2020-02-29 21:49:10','2020-03-02 21:20:16'),
(3,'INC3M',0,2,'Father','','M','2010-06-22',1,1,1,2,2,3,3,3,1,NULL,NULL,NULL,0,0,0,'','',NULL,3,1,'2020-03-02 21:09:04','2020-03-21 19:22:34'),
(4,'LAB4F',0,7,'Mother','','F','2011-01-01',4,NULL,1,5,2,1,3,2,1,NULL,NULL,NULL,0,0,0,'','',NULL,7,1,'2020-03-02 21:15:42','2020-03-02 21:17:28'),
(5,'ARN5M',0,3,'Child','Jean-Merguez','M','2011-06-22',7,2,2,2,1,5,3,2,1,NULL,NULL,NULL,0,0,0,'','',NULL,3,1,'2020-03-02 21:19:17','2020-03-21 19:23:47'),
(6,'HELL666F',1,4,'Girlfriend','','F','2012-01-01',9,NULL,3,5,1,4,3,2,1,NULL,NULL,NULL,0,0,0,'','',NULL,3,1,'2020-03-02 21:37:21','2020-03-02 21:37:53');
/*!40000 ALTER TABLE `rats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rats_litters`
--

LOCK TABLES `rats_litters` WRITE;
/*!40000 ALTER TABLE `rats_litters` DISABLE KEYS */;
INSERT INTO `rats_litters` (`rat_id`, `litter_id`) VALUES (1,1),
(2,1),
(3,2),
(4,2);
/*!40000 ALTER TABLE `rats_litters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rats_singularities`
--

LOCK TABLES `rats_singularities` WRITE;
/*!40000 ALTER TABLE `rats_singularities` DISABLE KEYS */;
INSERT INTO `rats_singularities` (`rat_id`, `singularity_id`) VALUES (3,3);
/*!40000 ALTER TABLE `rats_singularities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `ratteries`
--

LOCK TABLES `ratteries` WRITE;
/*!40000 ALTER TABLE `ratteries` DISABLE KEYS */;
INSERT INTO `ratteries` (`id`, `prefix`, `name`, `owner_user_id`, `birth_year`, `is_alive`, `is_generic`, `district`, `zip_code`, `country_id`, `website`, `comments`, `wants_statistic`, `picture`, `state_id`, `created`, `modified`) VALUES
(7,'ARN','A Rattery Name',3,2008,1,0,'35','',2,'https://www.myratterysite.com','',1,'Unknown.png',1,'2020-02-28 19:51:29','2020-03-14 12:21:22'),
(8,'ADR','A Discrete Rattery',7,2006,1,0,'Some Region','',2,'','',0,'Unknown.png',2,'2020-02-28 20:02:48','2020-03-14 12:22:44'),
(9,'BOFH','Bastard Operator From Hell',4,2020,1,0,'','',3,'','',1,'Unknown.png',1,'2020-02-28 20:10:20','2020-03-14 12:20:09');
/*!40000 ALTER TABLE `ratteries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `ratteries_litters`
--

LOCK TABLES `ratteries_litters` WRITE;
/*!40000 ALTER TABLE `ratteries_litters` DISABLE KEYS */;
INSERT INTO `ratteries_litters` (`rattery_id`, `litter_id`, `litters_contribution_id`) VALUES (2,1,1),
(7,2,1);
/*!40000 ALTER TABLE `ratteries_litters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rattery_snapshots`
--

LOCK TABLES `rattery_snapshots` WRITE;
/*!40000 ALTER TABLE `rattery_snapshots` DISABLE KEYS */;
/*!40000 ALTER TABLE `rattery_snapshots` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `password`, `username`, `firstname`, `lastname`, `birth_date`, `sex`, `localization`, `avatar`, `about_me`, `wants_newsletter`, `role_id`, `failed_login_attempts`, `failed_login_last_date`, `is_locked`, `staff_comments`, `created`, `modified`, `passkey`) VALUES
(3,'admin@example.com','$2y$10$Z9xazIIqXxFnvqXXbathsO7yZhdgEgOxg92j6r0HWvhCAQ568RnKu','Admin','Prénom','Nom','1981-08-01','F','99','Unknown.png','',1,2,0,NULL,0,'','2020-02-28 17:17:42','2020-03-14 12:16:16',NULL),
(4,'staff@example.com','$2y$10$Ys0kKEfNGl2xRqlc9//WCeIDn7LR9oObePr92HBZMn0vkBvThIhnG','Staff','Staff','Member',NULL,'','','Unknown.png','',0,3,0,NULL,0,'','2020-02-28 17:20:07','2020-03-14 12:14:51',NULL),
(5,'user@example.com','$2y$10$6g5qWSe6KnokjrXJBAdkuOiXCBudtQn08UGDdDVJ/3ou3OLLCTNHa','User','User','Lambda',NULL,'','','Unknown.png','',0,4,0,NULL,0,'','2020-02-28 17:22:31','2020-03-14 12:11:58','5e7660dace3693.77666803'),
(6,'anotheruser@example.com','$2y$10$WTovz1alU6LGoIgUKTwyAufAiuauNo4i1bVkgnhpKr0xSYmdDEK3y','AnotherUser','Another','User',NULL,'M','','Unknown.png','',0,4,0,NULL,0,'','2020-02-28 17:26:03','2020-03-14 12:14:22',NULL),
(7,'yetanotheruser@example.com','$2y$10$LX.hNVWCLpFHBB4DoNx83e65DETVePySQZ8EsynHIZeR3DTZhZyDK','Yet Another User','Yet','Another User',NULL,'M','Some place','Unknown.png','',0,2,0,NULL,0,'This user is a pain in the *ss!','2020-02-28 19:53:20','2020-03-14 12:28:43',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-21 19:54:24
