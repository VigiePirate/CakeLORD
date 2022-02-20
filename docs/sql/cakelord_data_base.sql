-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: mysql    Database: wodelord
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
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `coats`
--

LOCK TABLES `coats` WRITE;
/*!40000 ALTER TABLE `coats` DISABLE KEYS */;
INSERT INTO `coats` VALUES (1,'Unknown','Unknown.png','?/?','Undetermined or not visible (naked rat)',1),(2,'Lisse','Unknown.png','re/re','Straight, wildtype coat',0),(3,'Rex','Unknown.png','Re/re','Rexoid rat (can be more or less curly)',0),(4,'Double-rex','Unknown.png','','',0),(5,'Velours','Unknown.png','','',0),(6,'Nu','Unknown.png','','',0),(7,'Satin','Unknown.png','','',0),(8,'Harley','Unknown.png','','',0);
/*!40000 ALTER TABLE `coats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
INSERT INTO `colors` VALUES (1,'Inconnue','?/?','Unknown.png','Undetermined or unvisible color (due to albinism or overmarking, for instance)',1),(2,'Agouti','A/-','Unknown.png','Agouti (wild type)',0),(3,'Ambre','A/- p/p','Unknown.png','Agouti based pink-eyed dilute',0),(4,'Ambre bleu','A/- p/p g/g','Unknown.png','Ambre + Bleu US',1),(5,'Ambre dove','Agouti + PED + Mink + Br','Unknown.png','Ambre dove',0),(6,'Ambre dove mock','Agouti + PED + Mock + Br','Unknown.png','Ambre dove mock',0),(7,'Ambre lavande','Agouti + PED + Mink + Bus','Unknown.png','Ambre lavande',0),(8,'Ambre lavande mock','Agouti + PED + Mock + Bus','Unknown.png','Ambre lavande mock',0),(9,'Ambre mink','Agouti + PED + Mink','Unknown.png','Ambre mink',0),(10,'Ambre mock','Agouti + PED + Mock','Unknown.png','Ambre mock',0),(11,'Ambre russe','Agouti + PED + Br','Unknown.png','Ambre russe',0),(12,'Beige','a/a r/r','Unknown.png','Beige',0),(13,'Beige dove','Noir + RED + Mink + Br','Unknown.png','Beige dove',0),(14,'Beige dove mock','Noir + RED + Mock + Br','Unknown.png','Beige dove mock',0),(15,'Beige mink','Noir + RED + Mink','Unknown.png','Beige mink',0),(16,'Beige mock','Noir + RED + Mock','Unknown.png','Beige mock',0),(17,'Beige russe','a/a rb/rb r/r','Unknown.png','Beige russe',0),(18,'Bleu russe','a/a rb/rb','Unknown.png','Bleu russe',0),(19,'Bleu russe agouti','A/- rb/rb','Unknown.png','Bleu russe agouti',0),(20,'Bleu us','a/a d/d','Unknown.png','Bleu us',0),(21,'Bleu us agouti','A/- d/d','Unknown.png','Bleu us agouti',0),(22,'Cannelle','A/- m/m','Unknown.png','Cannelle',0),(23,'Cannelle mock','A/- mo/mo','Unknown.png','Cannelle mock',0),(24,'Champagne','Noir + PED','Unknown.png','Champagne',0),(25,'Champagne mink','Noir + PED + Mink','Unknown.png','Champagne mink',0),(26,'Champagne mock','Noir + PED + Mock','Unknown.png','Champagne mock',0),(27,'Champagne russe','Noir + PED + Br','Unknown.png','Champagne russe',0),(28,'Chocolat','Chocolat','Unknown.png','Chocolat',0),(29,'Double bleu','a/a d/d rb/rb','Unknown.png','Double bleu',0),(30,'Double bleu agouti','Agouti + Bus + Br','Unknown.png','Double bleu agouti',0),(31,'Double cannelle bleu','Agouti + Mink + Mock + Bus','Unknown.png','Double cannelle bleu',0),(32,'Double cannelle russe','Agouti + Mink + Mock + Br','Unknown.png','Double cannelle russe',0),(33,'Double cannelle','Agouti + Mink + Mock','Unknown.png','Double cannelle',0),(34,'Double havane','Noir + Mink + Mock + porteur RED','Unknown.png','Double havane',0),(35,'Double havane agouti','Agouti + Mink + Mock + porteur RED','Unknown.png','Double havane agouti',0),(36,'Double havane russe','Noir + Mink + Mock + Br + porteur RED','Unknown.png','Double havane russe',0),(37,'Double havane russe agouti','Agouti + Mink + Mock + Br + porteur RED','Unknown.png','Double havane russe agouti',0),(38,'Double lilas','Noir + Mink + Mock + Bus + porteur RED','Unknown.png','Double lilas',0),(39,'Double lilas agouti','Agouti + Mink + Mock + Bus + porteur RED','Unknown.png','Double lilas agouti',0),(40,'Double mink','Noir + Mink + Mock','Unknown.png','Double mink',0),(41,'Double mink bleu','Noir + Mink + Mock + Bus','Unknown.png','Double mink bleu',0),(42,'Double mink russe','Noir + Mink + Mock + Br','Unknown.png','Double mink russe',0),(43,'Double moka','Noir + Mink + Mock + porteur PED','Unknown.png','Double moka',0),(44,'Double moka agouti','Agouti + Mink + Mock + porteur PED','Unknown.png','Double moka agouti',0),(45,'Double moka bleu','Noir + Mink + Mock + Bus + porteur PED','Unknown.png','Double moka bleu',0),(46,'Double moka bleu agouti','Agouti + Mink + Mock + Bus + porteur PED','Unknown.png','Double moka bleu agouti',0),(47,'Double moka russe','Noir + Mink + Mock + Br + porteur PED','Unknown.png','Double moka russe',0),(48,'Double moka russe agouti','Agouti + Mink + Mock + Br + porteur PED','Unknown.png','Double moka russe agouti',0),(49,'Dove','a/a rb/rb m/m','Unknown.png','Dove',0),(50,'Dove agouti','A/- rb/rb m/m','Unknown.png','Dove agouti',0),(51,'Dove mock','a/a rb/rb mo/mo','Unknown.png','Dove mock',0),(52,'Dove mock agouti','TBD','Unknown.png','Dove mock agouti',0),(53,'Graphite','TBD','Unknown.png','Graphite',0),(54,'Havane','Noir + Mink + porteur RED','Unknown.png','Havane',0),(55,'Havane agouti','Agouti + Mink + porteur RED','Unknown.png','Havane agouti',0),(56,'Havane mock','Noir + Mock + porteur RED','Unknown.png','Havane mock',0),(57,'Havane mock agouti','Agouti + Mock + porteur RED','Unknown.png','Havane mock agouti',0),(58,'Havane russe','Noir + Mink + Br + porteur RED','Unknown.png','Havane russe',0),(59,'Havane russe agouti','Agouti + Mink + Br + porteur RED','Unknown.png','Havane russe agouti',0),(60,'Havane russe mock','Noir + Mock + Br + porteur RED','Unknown.png','Havane russe mock',0),(61,'Havane russe mock agouti','Agouti + Mock + Br + porteur RED','Unknown.png','Havane russe mock agouti',0),(62,'Ice','Noir + PED + Bus','Unknown.png','Ice',0),(63,'Ice mink','Noir + PED + Mink + Bus','Unknown.png','Ice mink',0),(64,'Ice mock','Noir + PED + Mock + Bus','Unknown.png','Ice mock',0),(65,'Lavande','Noir + Mink + Bus','Unknown.png','Lavande',0),(66,'Lavande agouti','Agouti + Mink + Bus','Unknown.png','Lavande agouti',0),(67,'Lavande mock','Noir + Mock + Bus','Unknown.png','Lavande mock',0),(68,'Lavande mock agouti','Agouti + Mock + Bus','Unknown.png','Lavande mock agouti',0),(69,'Lilas','Noir + Mink + Bus + porteur RED','Unknown.png','Lilas',0),(70,'Lilas agouti','Agouti + Mink + Bus + porteur RED','Unknown.png','Lilas agouti',0),(71,'Lilas mock','Noir + Mock + Bus + porteur RED','Unknown.png','Lilas mock',0),(72,'Lilas mock agouti','Agouti + Mock + Bus + porteur RED','Unknown.png','Lilas mock agouti',0),(73,'Mink','TBD','Unknown.png','Mink',0),(74,'Mock','TBD','Unknown.png','Mock',0),(75,'Moka','Noir + Mink + porteur PED','Unknown.png','Moka',0),(76,'Moka agouti','Agouti + Mink + porteur PED','Unknown.png','Moka agouti',0),(77,'Moka bleu','Noir + Mink + Bus + porteur PED','Unknown.png','Moka bleu',0),(78,'Moka bleu agouti','Agouti + Mink + Bus + porteur PED','Unknown.png','Moka bleu agouti',0),(79,'Moka bleu mock','Noir + Mock + Bus + porteur PED','Unknown.png','Moka bleu mock',0),(80,'Moka bleu mock agouti','Agouti + Mock + Bus + porteur PED','Unknown.png','Moka bleu mock agouti',0),(81,'Moka mock','Noir + Mock + porteur PED','Unknown.png','Moka mock',0),(82,'Moka mock agouti','Agouti + Mock + porteur PED','Unknown.png','Moka mock agouti',0),(83,'Moka russe','Noir + Mink + Br + porteur PED','Unknown.png','Moka russe',0),(84,'Moka russe agouti','Agouti + Mink + Br + porteur PED','Unknown.png','Moka russe agouti',0),(85,'Moka russe mock','Noir + Mock + Br + porteur PED','Unknown.png','Moka russe mock',0),(86,'Moka russe mock agouti','Agouti + Mock + Br + porteur PED','Unknown.png','Moka russe mock agouti',0),(87,'Noir','a/a','Unknown.png','Noir',0),(88,'Platine','Noir + RED + Bus','Unknown.png','Platine',0),(89,'Platine mink','Noir + RED + Mink + Bus','Unknown.png','Platine mink',0),(90,'Platine mock','Noir + RED + Mock + Bus','Unknown.png','Platine mock',0),(91,'Topaze','Agouti + RED','Unknown.png','Topaze',0),(92,'Topaze bleu','Agouti + RED + Bus','Unknown.png','Topaze bleu',0),(93,'Topaze dove','Agouti + RED + Mink + Br','Unknown.png','Topaze dove',0),(94,'Topaze dove mock','Agouti + RED + Mock + Br','Unknown.png','Topaze dove mock',0),(95,'Topaze mink','Agouti + Mink + RED','Unknown.png','Topaze mink',0),(96,'Topaze mock','Agouti + RED + Mock','Unknown.png','Topaze mock',0),(97,'Topaze russe','Agouti + RED + Br','Unknown.png','Topaze russe',0);
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `compatibilities`
--

LOCK TABLES `compatibilities` WRITE;
/*!40000 ALTER TABLE `compatibilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `compatibilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `contribution_types`
--

LOCK TABLES `contribution_types` WRITE;
/*!40000 ALTER TABLE `contribution_types` DISABLE KEYS */;
INSERT INTO `contribution_types` VALUES (1,'Lieu de naissance',1),(2,'Propriétaire de la mère (portée externe)',2),(3,'Propriétaire du père (portée externe)',3),(4,'Association ayant géré le sauvetage',4);
/*!40000 ALTER TABLE `contribution_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `contributions`
--

LOCK TABLES `contributions` WRITE;
/*!40000 ALTER TABLE `contributions` DISABLE KEYS */;
/*!40000 ALTER TABLE `contributions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `conversations`
--

LOCK TABLES `conversations` WRITE;
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'France','FR'),(2,'Suisse','CH'),(3,'Belgique','BE');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `death_primary_causes`
--

LOCK TABLES `death_primary_causes` WRITE;
/*!40000 ALTER TABLE `death_primary_causes` DISABLE KEYS */;
INSERT INTO `death_primary_causes` VALUES (1,'Cause inconnue','-',0,0,0),(2,'Accidents, traumatismes, intoxications','-',0,1,0),(3,'Cardio-vasculaire','-',0,0,0),(4,'Digestif','-',0,0,0),(5,'Mortalité infantile (moins de 6 semaines)','-',1,0,0),(6,'Muscles et squelette','-',0,0,0),(7,'Neurologique (cerveau, moelle épinière, nerfs)','-',0,0,0),(8,'Œil, oreille, bouche, face','-',0,0,0),(9,'Peau','-',0,0,0),(10,'Respiratoire','-',0,0,0),(11,'Système reproducteur','-',0,0,0),(12,'Système urinaire (reins, vessie)','-',0,0,0),(13,'Vieillesse, mort naturelle (24 mois minimum)','Cette cause implique que le rat montrait des signes de vieillesse depuis au moins plusieurs semaines, avec une dégradation lente et progressive de son état général (par exemple perte de poids modérée régulière, perte de mobilité, perte d’autonomie pour boire ou manger, allongement des périodes de sommeil, baisse de l’acuité visuelle ou auditive…), sans pathologie particulièrement identifiée. Dans le cas contraire, choisir la pathologie principale. En cas de mort brutale sur un rat en pleine forme, même âgé, choisir « Cause inconnue. »',0,0,1),(14,'Autres','-',0,0,0);
/*!40000 ALTER TABLE `death_primary_causes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `death_secondary_causes`
--

LOCK TABLES `death_secondary_causes` WRITE;
/*!40000 ALTER TABLE `death_secondary_causes` DISABLE KEYS */;
INSERT INTO `death_secondary_causes` VALUES
(1,'Aucune information (présumé mort)',1,'Cette cause est à choisir uniquement et obligatoirement si vous ne savez pas ce qu’est devenu le rat, mais pouvez raisonnablement supposer qu’il est mort. Dans ce cas, estimez la date de décès à la dernière date à laquelle vous êtes certain que le rat était en vie (jour de sa disparition, dernier envoi de photo…).',0),
(2,'Cause indéterminée (date connue)',1,'Cette cause est à choisir si le décès a été constaté mais que vous ne savez pas du tout pourquoi le rat est mort.',0),
(3,'Accident domestique (écrasement, accident de porte... )',2,'Les accidents domestiques concernent uniquement les traumatismes (pas les empoisonnements) où un humain de la maison est impliqué (exemple : vous vous êtes assis sur votre rat.) ',0),
(4,'Accident vétérinaire (anesthésie lors d’une opération mineure, erreur médicale...)',2,'Les accidents vétérinaires concernent uniquement les rats en bonne santé ou souffrant de problèmes mineurs qui ne l’auraient probablement pas tué (exemple : gale, castration de confort…), lorsque l’anesthésie ou la prescription médicale sont clairement la cause du décès (prescription d’une molécule non tolérée par le rat, coup de bistouri raté pendant une stérilisation préventive…). Un rat opéré d’une tumeur infiltrante et mal placée et qui ne se réveille pas de l’anesthésie n’est pas un accident vétérinaire (choisir le motif de l’intervention.)',0),
(5,'Bagarres, blessures, morsures graves, hémorragie consécutive (hors hémorragie anormale)',2,'Choisir cette cause pour tous les traumatismes graves causés par d’autres rats. En cas d’hémorragie, elle doit sembler « normale » par rapport au contexte : lésion d’un gros vaisseau comme la veine jugulaire par exemple, morsures profondes et nombreuses... Si elle semblait exagérée (rat qui se vide de son sang après un simple coup de dents), choisissez la cause primaire « Cardio-vasculaire » et la cause secondaire « Hémorragie ».',0),
(6,'Brûlures thermiques ou chimiques',2,'-',0),
(7,'Chutes, fractures, traumatisme crânien ou de la moelle épinière (hors bagarres)',2,'Choisir cette cause pour les traumatismes qui n’ont été causés ni par des humains, ni par d’autres rats.',0),
(8,'Coup de chaleur',2,'-',0),
(9,'Étouffement, fausse route',2,'Cette cause ne concerne pas les détresses respiratoires causées par une infection ou une tumeur pulmonaire, mais uniquement le passage accidentel de nourriture ou d’objets dans les voies respiratoires, avec ou sans obstruction totale.',0),
(10,'Empoisonnement (produits ménagers, poisons, médicaments volés...)',2,'Cette cause concerne uniquement les empoisonnements malveillants et les empoisonnements où le rat a ingéré une substance dangereuse « dans votre dos ».',0),
(11,'Intoxication alimentaire',2,'Cette cause est à choisir en cas d’ingestion d’aliments avariés ou contaminés par des germes.',0),
(12,'Surdosage médicamenteux (médicaments vétérinaires prescrits)',2,'Cette cause concerne uniquement les rats ayant reçu par votre faute ou celle du vétérinaire une trop grande quantité d’un médicament qui lui avait été prescrit pour un problème mineur.',0),
(13,'Autre accident ou traumatisme',2,'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez « Cause inconnue » (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un accident sans savoir précisément choisir un item dans la liste détaillée.)',0),
(14,'Crise cardiaque, infarctus, embolie pulmonaire',3,'Attention, cette cause ne peut être choisie que si une autopsie a confirmé le diagnostic. Les morts brutales inexpliquées ne sont pas à renseigner comme « arrêts cardiaques » mais comme « Cause inconnue. »',0),
(15,'Insuffisance cardiaque, valvulopathie',3,'-',0),
(16,'Hémorragie (exagérée par rapport au contexte, anomalie de la coagulation, hémophilie)',3,'Cette cause est à choisir si votre rat s’est « vidé de son sang » alors qu’il ne souffrait que d’une blessure mineure qui n’aurait pas dû causer autant de saignements. Dans le cas contraire, choisir la cause accidentelle ou traumatique appropriée (catégorie « Accidents, traumatismes, intoxications. »)',0),
(17,'Autre problème cardiaque ou vasculaire',3,'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème cardiaque ou vasculaire sans savoir précisément choisir un item dans la liste détaillée.)',0),
(18,'Abcès digestif',4,'-',0),
(19,'Gastro-entérite, diarrhée',4,'-',0),
(20,'Hémorragie digestive',4,'-',0),
(21,'Insuffisance hépatique',4,'-',0),
(22,'Malnutrition',4,'-',0),
(23,'Mégacôlon héréditaire',4,'Cette cause n’est à choisir qu’en cas de mégacôlon familial (aganglionnaire), pouvant être suspecté en fonction de l’âge (rats très jeunes), l’atteinte d’autres membres de la même famille, le marquage (rats très blancs), l’absence d’une autre cause d’occlusion. Attention, certains vétérinaires emploient parfois le terme « mégacôlon » dans un sens symptomatique en cas d’occlusion (dans ce cas, choisir « Occlusion intestinale ».)',0),
(24,'Occlusion intestinale (hors mégacôlon)',4,'Cette cause est à choisir en cas d’occlusion causée par une constipation chronique grave, une torsion de l’intestin, une tumeur mammaire bénigne mal placée causant un obstacle mécanique… à l’exclusion du mégacôlon héréditaire (choisir « Mégacôlon héréditaire ») et des tumeurs de l’intestin (choisir « Tumeur digestive ».)',0),
(25,'Prolapsus rectal',4,'-',0),
(26,'Tumeur digestive (estomac, foie, pancréas, intestins...)',4,'Cette cause est à choisir lorsque la tumeur atteignait un organe du système digestif (mais pas les tumeurs abdominales non liées au système digestif.)',1),
(27,'Autre problème digestif',4,'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème digestif sans savoir précisément choisir un item dans la liste détaillée.)',0),
(28,'Malformation, hydrocéphalie',5,'Cette cause est à choisir si le raton est né vivant mais décédé par la suite en raisons de malformations. S’il était mort-né, choisir « Mort-né ».' ,0),
(29,'Manque de lait',5,'-',0),
(30,'Mort-né',5,'-',0),
(31,'Autre cause de mort infantile',5,'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’une mort en bas âge sans savoir précisément choisir un item dans la liste détaillée.)',0),
(32,'Infection, abcès musculaire',6,'-',0),
(33,'Infection articulaire ou osseuse, arthrite septique',6,'-',0),
(34,'Tumeur musculaire',6,'-',1),
(35,'Tumeur osseuse',6,'-',1),
(36,'Autre problème du système locomoteur',6,'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème osseux, musculaire ou de locomotion, sans savoir précisément choisir un item dans la liste détaillée.)',0),
(37,'Accident vasculaire cérébral',7,'-',0),
(38,'Atteinte progressive de la moelle épinière, paralysie dégénérative',7,'Cette cause ne concerne pas les paralysies brutales et les atteintes traumatiques de la moelle épinière (choisir la cause du traumatisme dans la catégorie « Accidents, traumatismes, intoxications. »)',0),
(39,'Epilepsie',7,'. Cette cause est à choisir uniquement en cas d’épilepsie essentielle / primaire (c’est-à-dire non causée par un autre problème sous-jacent tel qu’une tumeur au cerveau.)',0),
(40,'Infection du cerveau, encéphalite, méningite',7,'-',0),
(41,'Tumeur cérébrale',7,'-',1),
(42,'Tumeur hypophysaire (pituitaire)',7,'-',1),
(43,'Autre problème neurologique',7,'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème neurologique sans savoir précisément choisir un item dans la liste détaillée.)',0),
(44,'Abcès dentaire',8,'',0),
(45,'Abcès facial (hors dentaire et Zymbal)',8,'',0),
(46,'Abcès rétro-orbitaire',8,'-',0),
(47,'Glaucome',8,'-',0),
(48,'Malocclusion dentaire',8,'Cette cause concerne les défauts d’implantation des dents et de conformation de la mâchoire non causés par un autre problème (malocclusion primaire.) Si la malocclusion était consécutive à une tumeur ayant déformé la mâchoire, choisir la tumeur concernée.',0),
(49,'Otite, abcès dans l’oreille',8,'-',0),
(50,'Tumeur de la glande de Zymbal',8,'-',1),
(51,'Tumeur de la face (hors Zymbal)',8,'-',1),
(52,'Tumeur rétro-orbitaire',8,'-',1),
(53,'Autre problème touchant la tête',8,'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème concernant la tête sans savoir précisément choisir un item dans la liste détaillée.)',0),
(54,'Abcès sous-cutané',9,'-',0),
(55,'Infection étendue de la peau (pyodermite, escarres...)',9,'-',0),
(56,'Pododermatite',9,'-',0),
(57,'Tumeur cutanée, cancer de la peau',9,'-',1),
(58,'Autre problème de peau',9,'-',0),
(59,'Bronchite, pneumonie',10,'-',0),
(60,'Œdème pulmonaire',10,'-',0),
(61,'Tumeur pulmonaire',10,'Cette cause est à choisir pour les tumeurs primaires du poumon. En cas de métastases causées par une tumeur d’un autre organe, choisir la tumeur principale et préciser en commentaires « présence de métastases pulmonaires. »',1),
(62,'Autre problème respiratoire',10,'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème respiratoire sans savoir précisément choisir un item dans la liste détaillée.)',0),
(63,'Complications de gestation ou de mise-bas',11,'-',0),
(64,'Infection de l’utérus (métrite, pyomètre)',11,'-',0),
(65,'Prolapsus vaginal (hors tumeurs et postpartum)',11,'En cas de prolapsus cette cause n’est à choisir que si la rate était à distance d’une mise-bas (sinon choisir « Complications de mise-bas ») et ne souffrait pas d’une tumeur dans la région pelvienne qui aurait pu déclencher le prolapsus (dans ce cas, choisir la tumeur concernée.)',0),
(66,'Tumeur mammaire',11,'-',1),
(67,'Tumeur ovarienne',11,'-',1),
(68,'Tumeur utérine',11,'-',1),
(69,'Tumeur vaginale',11,'-',1),
(70,'Tumeur de la prostate',11,'-',1),
(71,'Tumeur testiculaire',11,'-',1),
(72,'Tumeur des glandes préputiales',11,'-',1),
(73,'Autre problème du système reproducteur',11,'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème du système reproducteur sans savoir précisément choisir un item dans la liste détaillée.)',0),
(74,'Infection urinaire ou rénale',12,'-',0),
(75,'Insuffisance rénale',12,'-',0),
(76,'Obstruction de l’urètre, rétention urinaire, calculs',12,'-',0),
(77,'Tumeur de la vessie',12,'-',1),
(78,'Tumeur du rein',12,'-',1),
(79,'Autre problème du système urinaire',12,'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème urinaire ou rénal sans savoir précisément choisir un item dans la liste détaillée.)',0),
(80,'Allergie, choc anaphylactique',14,'-',0),
(81,'Cancer généralisé, leucémie, lymphome',14,'-',1),
(82,'Diabète',14,'-',0),
(83,'Euthanasie sans cause médicale',14,'Cette cause est réservée aux euthanasies réalisées sur des animaux en bonne santé, dont l’état médical ne justifiait pas une euthanasie (rat utilisé pour l’alimentation d’un autre animal, euthanasie de convenance…) Pour tous les autres cas d’euthanasie (animal malade), choisir la cause ayant amené à son état et à la décision d’euthanasier, et cocher la case « Euthanasie ».',0),
(84,'Infection / abcès indéterminé',14,'Cette cause est destinée aux anciennes fiches et ne devrait pas être choisie en général.',0),
(85,'Parasites',14,'Cette cause ne concerne que les parasitoses très graves. Les rats qui souffraient d’un parasite mineur (poux, gale) au moment de leur décès doivent être enregistrés à la cause principale de leur décès.',0),
(86,'Septicémie',14,'-',0),
(87,'Tumeur autre (salivaire, splénique, surrénale, thyroïde...)',14,'-',1),
(88,'Tumeur indéterminée (organe atteint inconnu)',14,'Cette cause est destinée aux anciennes fiches et ne devrait pas être choisie en général.',1),
(89,'Virus, épidémie, déficience immunitaire (SDA, Sendaï, Tyzzer...)',14,'-',0),
(90,'Autre cause connue ne rentrant dans aucune catégorie',14,'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il ne s’agit pas d’une des catégories précédentes, sans savoir précisément choisir un item dans la liste détaillée.)',0);
/*!40000 ALTER TABLE `death_secondary_causes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `dilutions`
--

LOCK TABLES `dilutions` WRITE;
/*!40000 ALTER TABLE `dilutions` DISABLE KEYS */;
INSERT INTO `dilutions` VALUES (1,'Aucune','Unknown.png','C/C','No dilution',0),(2,'Albinos','Unknown.png','c/c','Unpigmented. Usually with pink or red eyes.',0),(3,'Biscuit','Unknown.png','','',0),(4,'Burmese himalayen','Unknown.png','','',0),(5,'Burmese marbré','Unknown.png','','',0),(6,'Burmese marbré pointé','Unknown.png','','',0),(7,'Burmese siamois','Unknown.png','','',0),(8,'Devil','Unknown.png','','',0),(9,'Devil pointé','Unknown.png','','',0),(10,'Himalayen','Unknown.png','','',0),(11,'Sable himalayen','Unknown.png','','',0),(12,'Sable marbré','Unknown.png','','',0),(13,'Sable marbré pointé','Unknown.png','','',0),(14,'Sable siamois','Unknown.png','','',0),(15,'Siamois','Unknown.png','','',0);
/*!40000 ALTER TABLE `dilutions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `earsets`
--

LOCK TABLES `earsets` WRITE;
/*!40000 ALTER TABLE `earsets` DISABLE KEYS */;
INSERT INTO `earsets` VALUES (1,'Unknown','Unknown.png','?/?','Unknown',1),(2,'Standard','Unknown.png','Dmbo/-','Top eared (wild type)',0),(3,'Dumbo','Unknown.png','dmbo/dmbo','Dumbo ears',0);
/*!40000 ALTER TABLE `earsets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `eyecolors`
--

LOCK TABLES `eyecolors` WRITE;
/*!40000 ALTER TABLE `eyecolors` DISABLE KEYS */;
INSERT INTO `eyecolors` VALUES (1,'Unknown','Unknown.png','?/?','Undetermined or non visible (enucleated rat...)',1),(2,'Noir','Unknown.png','BlackEyed','Normal black eyes',0),(3,'Dark rubis','Unknown.png','RubyEyed','Including so called Dark Ruby. Typical of r/r rats.',0),(4,'Rouge','Unknown.png','RedEyed','Typical of dilutions',0),(5,'Rose','Unknown.png','PinkEyed','Typical of p/p rats',0),(6,'Vairon','Unknown.png','OddEyed','The two eyes have a different color (any combination, describe in comments.)',0);
/*!40000 ALTER TABLE `eyecolors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
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
-- Dumping data for table `markings`
--

LOCK TABLES `markings` WRITE;
/*!40000 ALTER TABLE `markings` DISABLE KEYS */;
INSERT INTO `markings` VALUES (1,'Unknown','Unknown.png','?/?','Undetermined or invisible marking (dilution, naked)',0),(2,'Uni','Unknown.png','H/H','Uni',0),(3,'Irish','Unknown.png','H/hi','Irish',0),(4,'Hooded','Unknown.png','h/h hl/hl','Hooded',0),(5,'Varieberk','Unknown.png','TBD','Varieberk',0),(6,'Capé','Unknown.png','He/He','Capé',0),(7,'Berkshire','Unknown.png','H/h','Berkshire',0),(8,'Varihooded','Unknown.png','TBD','Varihooded',0),(9,'Bareback','Unknown.png','h/h hs/hs','Bareback',0),(10,'Variegated','Unknown.png','He/hi','Variegated',0),(11,'Masqué','Unknown.png','He/He','Masqué',0),(12,'Dalmatien','Unknown.png','He/hi','Dalmatien',1),(13,'Patché','Unknown.png','TBD','Patché',0),(14,'Oppossum','Unknown.png','TBD','Oppossum',1),(15,'Husky','Unknown.png','TBD','Husky',0),(16,'Essex','Unknown.png','H/Hro','Essex',1),(17,'Baldie','Unknown.png','Hro/h','Baldie',1),(18,'Surmarqué','Unknown.png','He/He','Surmarqué',1);
/*!40000 ALTER TABLE `markings` ENABLE KEYS */;
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
INSERT INTO `rats` VALUES (1,'INC1F',0,1,'Mère inconnue',NULL,'F','2020-04-26',1,NULL,1,1,1,1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,'Femelle générique - Maman inconnue','Unknown.png',NULL,1,1,'2020-04-26 00:00:00','2020-04-26 00:00:00'),(2,'INC2M',0,1,'Père inconnu',NULL,'M','2020-04-26',1,NULL,1,1,1,1,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,'Mâle générique - Papa inconnu','Unknown.png',NULL,1,1,'2020-04-26 00:00:00','2020-04-26 00:00:00');
/*!40000 ALTER TABLE `rats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rats_litters`
--

LOCK TABLES `rats_litters` WRITE;
/*!40000 ALTER TABLE `rats_litters` DISABLE KEYS */;
/*!40000 ALTER TABLE `rats_litters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rats_singularities`
--

LOCK TABLES `rats_singularities` WRITE;
/*!40000 ALTER TABLE `rats_singularities` DISABLE KEYS */;
/*!40000 ALTER TABLE `rats_singularities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `ratteries`
--

LOCK TABLES `ratteries` WRITE;
/*!40000 ALTER TABLE `ratteries` DISABLE KEYS */;
INSERT INTO `ratteries` VALUES (1,'INC','*Animalerie*',2,1956,1,1,'','',1,NULL,NULL,'','',1,'Unknown.png',1,'2020-02-28 19:25:58','2020-02-28 19:25:58'),(2,'IND','* Eleveur indépendant *',2,2006,1,1,'','',1,NULL,NULL,'','',1,'Unknown.png',1,'2020-02-28 19:29:09','2020-02-28 19:38:18'),(3,'ETR','* Eleveur étranger *',2,2006,1,1,NULL,NULL,'','',1,'','',1,'Unknown.png',1,'2020-02-28 19:31:14','2020-02-28 19:39:30'),(4,'LAB','* Lignée de laboratoire *',2,2006,1,1,NULL,NULL,'','',1,'','',1,'Unknown.png',1,'2020-02-28 19:31:45','2020-02-28 19:38:37'),(5,'SOS','*Sauvetage*',2,2006,1,1,NULL,NULL,'','',1,'','',1,'Unknown.png',1,'2020-02-28 19:33:50','2020-02-28 19:33:50'),(6,'SVG','* Rat Sauvage *',2,2006,1,1,NULL,NULL,'','',1,'','',1,'Unknown.png',1,'2020-02-28 19:37:41','2020-02-28 19:37:41');
/*!40000 ALTER TABLE `ratteries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rattery_snapshots`
--

LOCK TABLES `rattery_snapshots` WRITE;
/*!40000 ALTER TABLE `rattery_snapshots` DISABLE KEYS */;
/*!40000 ALTER TABLE `rattery_snapshots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Root',1,1,1,1,1,1,1,1,1),(2,'Admin',0,1,1,1,1,1,1,1,1),(3,'Staff',0,0,1,1,1,0,0,0,1),(4,'User',0,0,0,0,0,0,0,0,0),(5,'Guest',0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `singularities`
--

LOCK TABLES `singularities` WRITE;
/*!40000 ALTER TABLE `singularities` DISABLE KEYS */;
INSERT INTO `singularities` VALUES (1,'Down Under','Unknown.png','DU/du','Same marking on belly and back',1),(2,'Dwarf','Unknown.png','dw/dw','Dwarf rat',0),(3,'Etoilé','Unknown.png','hs/hs','White spot on the head',0),(4,'Fléché','Unknown.png','','',0),(5,'Gants','Unknown.png','','',0),(6,'Perle','Unknown.png','','',0),(7,'Merle','Unknown.png','TBD','Merle',0),(8,'Manx','Unknown.png','TBD','Manx',1),(9,'Golden','Unknown.png','TBD','Golden',1),(10,'Stippel','Unknown.png','He/hi','Stippel',1),(11,'Silvermane','Unknown.png','TBD','Silvermane',0),(12,'Marble','Unknown.png','TBD','Marble',0);
/*!40000 ALTER TABLE `singularities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'Certifié','1f9d55','✪','',0,0,0,1,1,1,1,NULL,NULL,NULL,3),(2,'Validé','1f9d55','✓','',0,0,0,1,1,1,0,2,3,1,NULL),(3,'En attente de validation par le staff','ff8c1b','✗','',0,0,1,0,1,1,0,2,4,6,NULL),(4,'En attente de modification par l\'utilisateur','cc1f1a','✗','',0,1,0,0,1,1,0,3,3,NULL,NULL),(5,'Non vérifié','663300','✗','',1,0,1,0,1,1,0,2,4,NULL,NULL),(6,'Invalide','663300','♺','',0,0,0,0,1,1,1,NULL,NULL,NULL,3);
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'lord@example.com','$2y$10$Qxn8Jd3S9ZaD/oLobGuxi.McdeRsJVXJxpjvZRfp9gO0R6wefOrl.','LORD','','','1981-08-01','','','LogoLord.png','',1,1,0,NULL,0,'5e760c2a046250.91135739','','2020-02-28 17:00:33','2020-06-14 21:08:38'),(2,'unregistered@example.com','$2y$10$bK54f/ZiYS3OiiSnnIxzIOdeXmR0LP7F07.UeuigaeHnhiBvF6Wbu','Unregistered','','',NULL,'','','Unknown.png','Generic account for ownership of generic ratteries and rats without registered owners.',0,4,0,NULL,1,NULL,'','2020-02-28 17:08:52','2020-03-14 12:10:08');
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

-- Dump completed on 2020-06-14 23:15:47
