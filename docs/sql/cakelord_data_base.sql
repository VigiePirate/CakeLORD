-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 21 mars 2020 à 17:02
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cakelord`
--

--
-- Déchargement des données de la table `countries`
--

INSERT INTO `countries` (`name`, `iso3166`) VALUES
('Zombie Zone', 'ZZ'),
('France', 'FR'),
('Suisse', 'CH'),
('Belgique', 'BE');

--
-- Déchargement des données de la table `coats`
--

INSERT INTO `coats` (`name`, `picture`, `genotype`, `description`, `is_picture_mandatory`) VALUES
('Unknown', 'Unknown.png', '?/?', 'Undetermined or not visible (naked rat)', 1),
('Lisse', 'Unknown.png', 're/re', 'Straight, wildtype coat', 0),
('Rex', 'Unknown.png', 'Re/re', 'Rexoid rat (can be more or less curly)', 0),
('Double-rex', 'Unknown.png', '', '', 0),
('Velours', 'Unknown.png', '', '', 0),
('Nu', 'Unknown.png', '', '', 0),
('Satin', 'Unknown.png', '', '', 0),
('Harley', 'Unknown.png', '', '', 0);

--
-- Déchargement des données de la table `colors`
--

INSERT INTO `colors` (`name`, `genotype`, `picture`, `description`, `is_picture_mandatory`) VALUES
('Inconnue', '?/?', 'Unknown.png', 'Undetermined or unvisible color (due to albinism or overmarking, for instance)', 1),
('Agouti', 'A/-', 'Unknown.png', 'Agouti (wild type)', 0),
('Ambre', 'A/- p/p', 'Unknown.png', 'Agouti based pink-eyed dilute', 0),
('Ambre bleu', 'A/- p/p g/g', 'Unknown.png', 'Ambre + Bleu US', 1),
('Ambre dove', 'Agouti + PED + Mink + Br', 'Unknown.png', 'Ambre dove', 0),
('Ambre dove mock', 'Agouti + PED + Mock + Br', 'Unknown.png', 'Ambre dove mock', 0),
('Ambre lavande', 'Agouti + PED + Mink + Bus', 'Unknown.png', 'Ambre lavande', 0),
('Ambre lavande mock', 'Agouti + PED + Mock + Bus', 'Unknown.png', 'Ambre lavande mock', 0),
('Ambre mink', 'Agouti + PED + Mink', 'Unknown.png', 'Ambre mink', 0),
('Ambre mock', 'Agouti + PED + Mock', 'Unknown.png', 'Ambre mock', 0),
('Ambre russe', 'Agouti + PED + Br', 'Unknown.png', 'Ambre russe', 0),
('Beige', 'a/a r/r', 'Unknown.png', 'Beige', 0),
('Beige dove', 'Noir + RED + Mink + Br', 'Unknown.png', 'Beige dove', 0),
('Beige dove mock', 'Noir + RED + Mock + Br', 'Unknown.png', 'Beige dove mock', 0),
('Beige mink', 'Noir + RED + Mink', 'Unknown.png', 'Beige mink', 0),
('Beige mock', 'Noir + RED + Mock', 'Unknown.png', 'Beige mock', 0),
('Beige russe', 'a/a rb/rb r/r', 'Unknown.png', 'Beige russe', 0),
('Bleu russe', 'a/a rb/rb', 'Unknown.png', 'Bleu russe', 0),
('Bleu russe agouti', 'A/- rb/rb', 'Unknown.png', 'Bleu russe agouti', 0),
('Bleu us', 'a/a d/d', 'Unknown.png', 'Bleu us', 0),
('Bleu us agouti', 'A/- d/d', 'Unknown.png', 'Bleu us agouti', 0),
('Cannelle', 'A/- m/m', 'Unknown.png', 'Cannelle', 0),
('Cannelle mock', 'A/- mo/mo', 'Unknown.png', 'Cannelle mock', 0),
('Champagne', 'Noir + PED', 'Unknown.png', 'Champagne', 0),
('Champagne mink', 'Noir + PED + Mink', 'Unknown.png', 'Champagne mink', 0),
('Champagne mock', 'Noir + PED + Mock', 'Unknown.png', 'Champagne mock', 0),
('Champagne russe', 'Noir + PED + Br', 'Unknown.png', 'Champagne russe', 0),
('Chocolat', 'Chocolat', 'Unknown.png', 'Chocolat', 0),
('Double bleu', 'a/a d/d rb/rb', 'Unknown.png', 'Double bleu', 0),
('Double bleu agouti', 'Agouti + Bus + Br', 'Unknown.png', 'Double bleu agouti', 0),
('Double cannelle bleu', 'Agouti + Mink + Mock + Bus', 'Unknown.png', 'Double cannelle bleu', 0),
('Double cannelle russe', 'Agouti + Mink + Mock + Br', 'Unknown.png', 'Double cannelle russe', 0),
('Double cannelle', 'Agouti + Mink + Mock', 'Unknown.png', 'Double cannelle', 0),
('Double havane', 'Noir + Mink + Mock + porteur RED', 'Unknown.png', 'Double havane', 0),
('Double havane agouti', 'Agouti + Mink + Mock + porteur RED', 'Unknown.png', 'Double havane agouti', 0),
('Double havane russe', 'Noir + Mink + Mock + Br + porteur RED', 'Unknown.png', 'Double havane russe', 0),
('Double havane russe agouti', 'Agouti + Mink + Mock + Br + porteur RED', 'Unknown.png', 'Double havane russe agouti', 0),
('Double lilas', 'Noir + Mink + Mock + Bus + porteur RED', 'Unknown.png', 'Double lilas', 0),
('Double lilas agouti', 'Agouti + Mink + Mock + Bus + porteur RED', 'Unknown.png', 'Double lilas agouti', 0),
('Double mink', 'Noir + Mink + Mock', 'Unknown.png', 'Double mink', 0),
('Double mink bleu', 'Noir + Mink + Mock + Bus', 'Unknown.png', 'Double mink bleu', 0),
('Double mink russe', 'Noir + Mink + Mock + Br', 'Unknown.png', 'Double mink russe', 0),
('Double moka', 'Noir + Mink + Mock + porteur PED', 'Unknown.png', 'Double moka', 0),
('Double moka agouti', 'Agouti + Mink + Mock + porteur PED', 'Unknown.png', 'Double moka agouti', 0),
('Double moka bleu', 'Noir + Mink + Mock + Bus + porteur PED', 'Unknown.png', 'Double moka bleu', 0),
('Double moka bleu agouti', 'Agouti + Mink + Mock + Bus + porteur PED', 'Unknown.png', 'Double moka bleu agouti', 0),
('Double moka russe', 'Noir + Mink + Mock + Br + porteur PED', 'Unknown.png', 'Double moka russe', 0),
('Double moka russe agouti', 'Agouti + Mink + Mock + Br + porteur PED', 'Unknown.png', 'Double moka russe agouti', 0),
('Dove', 'a/a rb/rb m/m', 'Unknown.png', 'Dove', 0),
('Dove agouti', 'A/- rb/rb m/m', 'Unknown.png', 'Dove agouti', 0),
('Dove mock', 'a/a rb/rb mo/mo', 'Unknown.png', 'Dove mock', 0),
('Dove mock agouti', 'TBD', 'Unknown.png', 'Dove mock agouti', 0),
('Graphite', 'TBD', 'Unknown.png', 'Graphite', 0),
('Havane', 'Noir + Mink + porteur RED', 'Unknown.png', 'Havane', 0),
('Havane agouti', 'Agouti + Mink + porteur RED', 'Unknown.png', 'Havane agouti', 0),
('Havane mock', 'Noir + Mock + porteur RED', 'Unknown.png', 'Havane mock', 0),
('Havane mock agouti', 'Agouti + Mock + porteur RED', 'Unknown.png', 'Havane mock agouti', 0),
('Havane russe', 'Noir + Mink + Br + porteur RED', 'Unknown.png', 'Havane russe', 0),
('Havane russe agouti', 'Agouti + Mink + Br + porteur RED', 'Unknown.png', 'Havane russe agouti', 0),
('Havane russe mock', 'Noir + Mock + Br + porteur RED', 'Unknown.png', 'Havane russe mock', 0),
('Havane russe mock agouti', 'Agouti + Mock + Br + porteur RED', 'Unknown.png', 'Havane russe mock agouti', 0),
('Ice', 'Noir + PED + Bus', 'Unknown.png', 'Ice', 0),
('Ice mink', 'Noir + PED + Mink + Bus', 'Unknown.png', 'Ice mink', 0),
('Ice mock', 'Noir + PED + Mock + Bus', 'Unknown.png', 'Ice mock', 0),
('Lavande', 'Noir + Mink + Bus', 'Unknown.png', 'Lavande', 0),
('Lavande agouti', 'Agouti + Mink + Bus', 'Unknown.png', 'Lavande agouti', 0),
('Lavande mock', 'Noir + Mock + Bus', 'Unknown.png', 'Lavande mock', 0),
('Lavande mock agouti', 'Agouti + Mock + Bus', 'Unknown.png', 'Lavande mock agouti', 0),
('Lilas', 'Noir + Mink + Bus + porteur RED', 'Unknown.png', 'Lilas', 0),
('Lilas agouti', 'Agouti + Mink + Bus + porteur RED', 'Unknown.png', 'Lilas agouti', 0),
('Lilas mock', 'Noir + Mock + Bus + porteur RED', 'Unknown.png', 'Lilas mock', 0),
('Lilas mock agouti', 'Agouti + Mock + Bus + porteur RED', 'Unknown.png', 'Lilas mock agouti', 0),
('Mink', 'TBD', 'Unknown.png', 'Mink', 0),
('Mock', 'TBD', 'Unknown.png', 'Mock', 0),
('Moka', 'Noir + Mink + porteur PED', 'Unknown.png', 'Moka', 0),
('Moka agouti', 'Agouti + Mink + porteur PED', 'Unknown.png', 'Moka agouti', 0),
('Moka bleu', 'Noir + Mink + Bus + porteur PED', 'Unknown.png', 'Moka bleu', 0),
('Moka bleu agouti', 'Agouti + Mink + Bus + porteur PED', 'Unknown.png', 'Moka bleu agouti', 0),
('Moka bleu mock', 'Noir + Mock + Bus + porteur PED', 'Unknown.png', 'Moka bleu mock', 0),
('Moka bleu mock agouti', 'Agouti + Mock + Bus + porteur PED', 'Unknown.png', 'Moka bleu mock agouti', 0),
('Moka mock', 'Noir + Mock + porteur PED', 'Unknown.png', 'Moka mock', 0),
('Moka mock agouti', 'Agouti + Mock + porteur PED', 'Unknown.png', 'Moka mock agouti', 0),
('Moka russe', 'Noir + Mink + Br + porteur PED', 'Unknown.png', 'Moka russe', 0),
('Moka russe agouti', 'Agouti + Mink + Br + porteur PED', 'Unknown.png', 'Moka russe agouti', 0),
('Moka russe mock', 'Noir + Mock + Br + porteur PED', 'Unknown.png', 'Moka russe mock', 0),
('Moka russe mock agouti', 'Agouti + Mock + Br + porteur PED', 'Unknown.png', 'Moka russe mock agouti', 0),
('Noir', 'a/a', 'Unknown.png', 'Noir', 0),
('Platine', 'Noir + RED + Bus', 'Unknown.png', 'Platine', 0),
('Platine mink', 'Noir + RED + Mink + Bus', 'Unknown.png', 'Platine mink', 0),
('Platine mock', 'Noir + RED + Mock + Bus', 'Unknown.png', 'Platine mock', 0),
('Topaze', 'Agouti + RED', 'Unknown.png', 'Topaze', 0),
('Topaze bleu', 'Agouti + RED + Bus', 'Unknown.png', 'Topaze bleu', 0),
('Topaze dove', 'Agouti + RED + Mink + Br', 'Unknown.png', 'Topaze dove', 0),
('Topaze dove mock', 'Agouti + RED + Mock + Br', 'Unknown.png', 'Topaze dove mock', 0),
('Topaze mink', 'Agouti + Mink + RED', 'Unknown.png', 'Topaze mink', 0),
('Topaze mock', 'Agouti + RED + Mock', 'Unknown.png', 'Topaze mock', 0),
('Topaze russe', 'Agouti + RED + Br', 'Unknown.png', 'Topaze russe', 0);

--
-- Déchargement des données de la table `death_primary_causes`
--

INSERT INTO `death_primary_causes` (`id`,`name`, `description`) VALUES
(1,'Cause inconnue', ''),
(2,'Accidents, traumatismes, intoxications', ''),
(3,'Cardio-vasculaire', ''),
(4,'Digestif', ''),
(5,'Mortalité infantile (moins de 6 semaines)', ''),
(6,'Muscles et squelette', ''),
(7,'Neurologique (cerveau, moelle épinière, nerfs)', ''),
(8,'Œil, oreille, bouche, face', ''),
(9,'Peau', ''),
(10,'Respiratoire', ''),
(11,'Système reproducteur', ''),
(12,'Système urinaire (reins, vessie)', ''),
(13,'Vieillesse, mort naturelle (24 mois minimum)', ''),
(14,'Autres', '');

--
-- Déchargement des données de la table `death_secondary_causes`
--

INSERT INTO `death_secondary_causes` (`name`, `death_primary_cause_id`, `description`) VALUES
('Aucune information (présumé mort)', 1, ''),
('Cause indéterminée (date connue)', 1, ''),
('Accident domestique (écrasement, accident de porte... )', 2, ''),
('Accident vétérinaire (anesthésie lors d’une opération mineure, erreur médicale...)', 2, ''),
('Bagarres, blessures, morsures graves, hémorragie consécutive (hors hémorragie anormale)', 2, ''),
('Brûlures thermiques ou chimiques', 2, ''),
('Chutes, fractures, traumatisme crânien ou de la moelle épinière (hors bagarres)', 2, ''),
('Coup de chaleur', 2, ''),
('Étouffement, fausse route', 2, ''),
('Empoisonnement (produits ménagers, poisons, médicaments volés...)', 2, ''),
('Intoxication alimentaire', 2, ''),
('Surdosage médicamenteux (médicaments vétérinaires prescrits)', 2, ''),
('Autre accident ou traumatisme', 2, ''),
('Crise cardiaque, infarctus, embolie pulmonaire', 3, ''),
('Insuffisance cardiaque, valvulopathie', 3, ''),
('Hémorragie (exagérée par rapport au contexte, anomalie de la coagulation, hémophilie)', 3, ''),
('Autre problème cardiaque ou vasculaire', 3, ''),
('Abcès digestif', 4, ''),
('Gastro-entérite, diarrhée', 4, ''),
('Hémorragie digestive', 4, ''),
('Insuffisance hépatique', 4, ''),
('Malnutrition', 4, ''),
('Mégacôlon héréditaire', 4, ''),
('Occlusion intestinale (hors mégacôlon)', 4, ''),
('Prolapsus rectal', 4, ''),
('Tumeur digestive (estomac, foie, pancréas, intestins...)', 4, ''),
('Autre problème digestif', 4, ''),
('Malformation, hydrocéphalie', 5, ''),
('Manque de lait', 5, ''),
('Mort-né', 5, ''),
('Autre cause de mort infantile', 5, ''),
('Infection / abcès musculaire', 6, ''),
('Infection articulaire ou osseuse, arthrite septique', 6, ''),
('Tumeur musculaire', 6, ''),
('Tumeur osseuse', 6, ''),
('Autre problème du système locomoteur', 6, ''),
('Accident vasculaire cérébral', 7, ''),
('Atteinte progressive de la moelle épinière, paralysie dégénérative', 7, ''),
('Epilepsie', 7, ''),
('Infection du cerveau, encéphalite, méningite', 7, ''),
('Tumeur cérébrale', 7, ''),
('Tumeur hypophysaire (pituitaire)', 7, ''),
('Autre problème neurologique', 7, ''),
('Abcès dentaire', 8, ''),
('Abcès facial (hors dentaire et Zymbal)', 8, ''),
('Abcès rétro-orbitaire', 8, ''),
('Glaucome', 8, ''),
('Malocclusion dentaire', 8, ''),
('Otite, abcès dans l’oreille', 8, ''),
('Tumeur de la glande de Zymbal', 8, ''),
('Tumeur de la face (hors Zymbal)', 8, ''),
('Tumeur rétro-orbitaire', 8, ''),
('Autre problème touchant la tête', 8, ''),
('Abcès sous-cutané', 9, ''),
('Infection étendue de la peau (pyodermite, escarres...)', 9, ''),
('Pododermatite', 9, ''),
('Tumeur cutanée, cancer de la peau', 9, ''),
('Autre problème de peau', 9, ''),
('Bronchite, pneumonie', 10, ''),
('Œdème pulmonaire', 10, ''),
('Tumeur pulmonaire, métastases pulmonaires', 10, ''),
('Autre problème respiratoire', 10, ''),
('Complications de gestation ou de mise-bas', 11, ''),
('Infection de l’utérus (métrite, pyomètre)', 11, ''),
('Prolapsus vaginal (hors tumeurs et postpartum)', 11, ''),
('Tumeur mammaire', 11, ''),
('Tumeur ovarienne', 11, ''),
('Tumeur utérine', 11, ''),
('Tumeur vaginale', 11, ''),
('Tumeur de la prostate', 11, ''),
('Tumeur testiculaire', 11, ''),
('Tumeur des glandes préputiales', 11, ''),
('Autre problème du système reproducteur', 11, ''),
('Infection urinaire ou rénale', 12, ''),
('Insuffisance rénale', 12, ''),
('Obstruction de l’urètre, rétention urinaire, calculs', 12, ''),
('Tumeur de la vessie', 12, ''),
('Tumeur du rein', 12, ''),
('Autre problème du système urinaire', 12, ''),
('Allergie, choc anaphylactique', 14, ''),
('Cancer généralisé, leucémie, lymphome', 14, ''),
('Diabète', 14, ''),
('Euthanasie sans cause médicale', 14, ''),
('Infection / abcès indéterminé', 14, ''),
('Parasites', 14, ''),
('Septicémie', 14, ''),
('Tumeur autre (salivaire, splénique, surrénale, thyroïde...)', 14, ''),
('Tumeur indéterminée (organe atteint inconnu)', 14, ''),
('Virus, épidémie, déficience immunitaire (SDA, Sendaï, Tyzzer...)', 14, ''),
('Autre cause connue ne rentrant dans aucune catégorie', 14, '');

--
-- Déchargement des données de la table `dilutions`
--

INSERT INTO `dilutions` (`name`, `picture`, `genotype`, `description`, `is_picture_mandatory`) VALUES
('Aucune', 'Unknown.png', 'C/C', 'No dilution', 0),
('Albinos', 'Unknown.png', 'c/c', 'Unpigmented. Usually with pink or red eyes.', 0),
('Biscuit', 'Unknown.png', '', '', 0),
('Burmese himalayen', 'Unknown.png', '', '', 0),
('Burmese marbré', 'Unknown.png', '', '', 0),
('Burmese marbré pointé', 'Unknown.png', '', '', 0),
('Burmese siamois', 'Unknown.png', '', '', 0),
('Devil', 'Unknown.png', '', '', 0),
('Devil pointé', 'Unknown.png', '', '', 0),
('Himalayen', 'Unknown.png', '', '', 0),
('Sable himalayen', 'Unknown.png', '', '', 0),
('Sable marbré', 'Unknown.png', '', '', 0),
('Sable marbré pointé', 'Unknown.png', '', '', 0),
('Sable siamois', 'Unknown.png', '', '', 0),
('Siamois', 'Unknown.png', '', '', 0);

--
-- Déchargement des données de la table `earsets`
--

INSERT INTO `earsets` (`name`, `picture`, `genotype`, `description`, `is_picture_mandatory`) VALUES
('Unknown', 'Unknown.png', '?/?', 'Unknown', 1),
('Standard', 'Unknown.png', 'Dmbo/-', 'Top eared (wild type)', 0),
('Dumbo', 'Unknown.png', 'dmbo/dmbo', 'Dumbo ears', 0);

--
-- Déchargement des données de la table `eyecolors`
--

INSERT INTO `eyecolors` (`name`, `picture`, `genotype`, `description`, `is_picture_mandatory`) VALUES
('Unknown', 'Unknown.png', '?/?', 'Undetermined or non visible (enucleated rat...)', 1),
('Noir', 'Unknown.png', 'BlackEyed', 'Normal black eyes', 0),
('Dark rubis', 'Unknown.png', 'RubyEyed', 'Including so called Dark Ruby. Typical of r/r rats.', 0),
('Rouge', 'Unknown.png', 'RedEyed', 'Typical of dilutions', 0),
('Rose', 'Unknown.png', 'PinkEyed', 'Typical of p/p rats', 0),
('Vairon', 'Unknown.png', 'OddEyed', 'The two eyes have a different color (any combination, describe in comments.)', 0);

--
-- Déchargement des données de la table `markings`
--

INSERT INTO `markings` (`name`, `picture`, `genotype`, `description`, `is_picture_mandatory`) VALUES
('Unknown', 'Unknown.png', '?/?', 'Undetermined or invisible marking (dilution, naked)', 0),
('Uni', 'Unknown.png', 'H/H', 'Uni', 0),
('Irish', 'Unknown.png', 'H/hi', 'Irish', 0),
('Hooded', 'Unknown.png', 'h/h hl/hl', 'Hooded', 0),
('Varieberk', 'Unknown.png', 'TBD', 'Varieberk', 0),
('Capé', 'Unknown.png', 'He/He', 'Capé', 0),
('Berkshire', 'Unknown.png', 'H/h', 'Berkshire', 0),
('Varihooded', 'Unknown.png', 'TBD', 'Varihooded', 0),
('Bareback', 'Unknown.png', 'h/h hs/hs', 'Bareback', 0),
('Variegated', 'Unknown.png', 'He/hi', 'Variegated', 0),
('Masqué', 'Unknown.png', 'He/He', 'Masqué', 0),
('Dalmatien', 'Unknown.png', 'He/hi', 'Dalmatien', 1),
('Patché', 'Unknown.png', 'TBD', 'Patché', 0),
('Oppossum', 'Unknown.png', 'TBD', 'Oppossum', 1),
('Husky', 'Unknown.png', 'TBD', 'Husky', 0),
('Essex', 'Unknown.png', 'H/Hro', 'Essex', 1),
('Baldie', 'Unknown.png', 'Hro/h', 'Baldie', 1),
('Surmarqué', 'Unknown.png', 'He/He', 'Surmarqué', 1);

--
-- Déchargement des données de la table `singularities`
--

INSERT INTO `singularities` (`name`, `picture`, `genotype`, `description`, `is_picture_mandatory`) VALUES
('Down Under', 'Unknown.png', 'DU/du', 'Same marking on belly and back', 1),
('Dwarf', 'Unknown.png', 'dw/dw', 'Dwarf rat', 0),
('Etoilé', 'Unknown.png', 'hs/hs', 'White spot on the head', 0),
('Fléché', 'Unknown.png', '', '', 0),
('Gants', 'Unknown.png', '', '', 0),
('Perle', 'Unknown.png', '', '', 0),
('Merle', 'Unknown.png', 'TBD', 'Merle', 0),
('Manx', 'Unknown.png', 'TBD', 'Manx', 1),
('Golden', 'Unknown.png', 'TBD', 'Golden', 1),
('Stippel', 'Unknown.png', 'He/hi', 'Stippel', 1),
('Silvermane', 'Unknown.png', 'TBD', 'Silvermane', 0),
('Marble', 'Unknown.png', 'TBD', 'Marble', 0);


--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` (`id`, `name`, `color`,`symbol`) VALUES
(1,'OK','1f9d55','✓'),
(2,'Pending Staff Action','ff8c1b','✗'),
(3,'Pending User Action','cc1f1a','✗'),
(4,'Unverified','663300','✗');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
(1,'Root'),
(2,'Admin'),
(3,'Staff'),
(4,'User'),
(5,'Guest');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Déchargement des données de la table `contribution_types`
--

LOCK TABLES `contribution_types` WRITE;
/*!40000 ALTER TABLE `contribution_types` DISABLE KEYS */;
INSERT INTO `contribution_types` (`id`, `name`, `priority`) VALUES
(1, 'Lieu de naissance', 1),
(2, 'Propriétaire de la mère (portée externe)', 2),
(3, 'Propriétaire du père (portée externe)', 3),
(4, 'Association ayant géré le sauvetage', 4);
/*!40000 ALTER TABLE `contribution_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `firstname`, `lastname`, `birth_date`, `sex`, `localization`, `avatar`, `about_me`, `wants_newsletter`, `role_id`, `failed_login_attempts`, `failed_login_last_date`, `is_locked`, `staff_comments`, `created`, `modified`, `passkey`) VALUES
(1,'lord@example.com','$2y$10$Qxn8Jd3S9ZaD/oLobGuxi.McdeRsJVXJxpjvZRfp9gO0R6wefOrl.','LORD','','','1981-08-01','','','LogoLord.png','',1,1,0,NULL,0,'','2020-02-28 17:00:33','2020-03-14 12:08:33','5e760c2a046250.91135739'),
(2,'unregistered@example.com','$2y$10$bK54f/ZiYS3OiiSnnIxzIOdeXmR0LP7F07.UeuigaeHnhiBvF6Wbu','Unregistered','','',NULL,'','','Unknown.png','Generic account for ownership of generic ratteries and rats without registered owners.',0,4,0,NULL,1,'','2020-02-28 17:08:52','2020-03-14 12:10:08',NULL);

--
-- Dumping data for table `ratteries`
--

LOCK TABLES `ratteries` WRITE;
/*!40000 ALTER TABLE `ratteries` DISABLE KEYS */;
INSERT INTO `ratteries` (`id`, `prefix`, `name`, `owner_user_id`, `birth_year`, `is_alive`, `is_generic`, `district`, `zip_code`, `country_id`, `website`, `comments`, `wants_statistic`, `picture`, `state_id`, `created`, `modified`) VALUES
(1, 'INC', '*Animalerie*', 2, 1956, 1, 1, '', '', 1, '', '', 1, 'Unknown.png', 1, '2020-02-28 19:25:58', '2020-02-28 19:25:58'),
(2, 'IND', '* Eleveur indépendant *', 2, 2006, 1, 1, '', '', 1, '', '', 1, 'Unknown.png', 1, '2020-02-28 19:29:09', '2020-02-28 19:38:18'),
(3, 'ETR', '* Eleveur étranger *', 2, 2006, 1, 1, '', '', 1, '', '', 1, 'Unknown.png', 1, '2020-02-28 19:31:14', '2020-02-28 19:39:30'),
(4, 'LAB', '* Lignée de laboratoire *', 2, 2006, 1, 1, '', '', 1, '', '', 1, 'Unknown.png', 1, '2020-02-28 19:31:45', '2020-02-28 19:38:37'),
(5, 'SOS', '*Sauvetage*', 2, 2006, 1, 1, '', '', 1, '', '', 1, 'Unknown.png', 1, '2020-02-28 19:33:50', '2020-02-28 19:33:50'),
(6, 'SVG', '* Rat Sauvage *', 2, 2006, 1, 1, '', '', 1, '', '', 1, 'Unknown.png', 1, '2020-02-28 19:37:41', '2020-02-28 19:37:41');
/*!40000 ALTER TABLE `ratteries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Déchargement des données de la table `rats`
--

INSERT INTO `rats` (`id`, `pedigree_identifier`, `is_pedigree_custom`, `owner_user_id`, `name`, `pup_name`, `sex`, `birth_date`, `rattery_id`, `litter_id`, `color_id`, `eyecolor_id`, `dilution_id`, `marking_id`, `earset_id`, `coat_id`, `is_alive`, `death_date`, `death_primary_cause_id`, `death_secondary_cause_id`, `death_euthanized`, `death_diagnosed`, `death_necropsied`, `comments`, `picture`, `picture_thumbnail`, `creator_user_id`, `state_id`, `created`, `modified`) VALUES
(1, 'INC1F', 0, 1, 'Mère inconnue', NULL, 'F', '2020-04-26', 1, NULL, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Femelle générique - Maman inconnue', 'Unknown.png', NULL, 1, 1, '2020-04-26 00:00:00', '2020-04-26 00:00:00'),
(2, 'INC2M', 0, 1, 'Père inconnu', NULL, 'M', '2020-04-26', 1, NULL, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Mâle générique - Papa inconnu', 'Unknown.png', NULL, 1, 1, '2020-04-26 00:00:00', '2020-04-26 00:00:00');
COMMIT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
