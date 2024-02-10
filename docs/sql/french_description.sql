-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql:3306
-- Généré le : sam. 10 fév. 2024 à 17:47
-- Version du serveur : 10.11.4-MariaDB-1~deb12u1
-- Version de PHP : 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `betalord`
--

-- --------------------------------------------------------

--
-- Structure de la table `coats`
--

CREATE TABLE `coats` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(70) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table référençant la liste des poils';

--
-- Déchargement des données de la table `coats`
--

INSERT INTO `coats` (`id`, `name`, `picture`, `genotype`, `description`, `is_picture_mandatory`) VALUES
(1, 'Inconnu', 'Unknown.png', '?/?', 'Indéterminé (par exemple en raison d\'une mort en bas âge).', 1),
(2, 'Lisse', 'Unknown.png', 're/re', 'Straight, wildtype coat', 0),
(3, 'Rex', 'Unknown.png', 'Re/re', 'Rexoid rat (can be more or less curly)', 0),
(4, 'Double-rex', 'Unknown.png', 'Re/Re', 'Double rex', 0),
(5, 'Velours', 'Unknown.png', 'Re/re', 'Velours', 0),
(6, 'Nu', 'Unknown.png', '', '', 0),
(7, 'Satin', 'Unknown.png', '', '', 0),
(8, 'Harley', 'Unknown.png', '', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(70) NOT NULL,
  `genotype` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `colors`
--

INSERT INTO `colors` (`id`, `name`, `genotype`, `picture`, `description`, `is_picture_mandatory`) VALUES
(1, 'Inconnue', '?/?', 'Unknown.png', 'Couleur non déterminée : mort infantile, albinisme, surmarquage, etc.', 1),
(2, 'Agouti', 'A/-', 'Unknown.png', 'Agouti. ', 0),
(3, 'Ambre', 'A/- p/p', 'Unknown.png', 'Agouti + PED.', 0),
(4, 'Ambre bleu', 'A/- p/p d/d', 'Unknown.png', 'Agouti + PED + Bleu us.', 1),
(5, 'Ambre dove', 'A/- p/p m/m rb/rb', 'Unknown.png', 'Agouti + PED + Mink + Bleu russe.', 0),
(6, 'Ambre dove mock', 'A/- p/p mo/mo rb/rb', 'Unknown.png', 'Agouti + PED + Mock + Bleu russe.', 0),
(7, 'Ambre lavande', 'A/- p/p m/m d/d', 'Unknown.png', 'Agouti + PED + Mink + Bleu us.', 0),
(8, 'Ambre lavande mock', 'A/- p/p mo/mo d/d', 'Unknown.png', 'Agouti + PED + Mock + Bleu us.', 0),
(9, 'Ambre mink', 'A/- p/p m/m', 'Unknown.png', 'Agouti + PED + Mink.', 0),
(10, 'Ambre mock', 'A/- p/p mo/mo', 'Unknown.png', 'Agouti + PED + Mock.', 0),
(11, 'Ambre russe', 'A/- p/p rb/rb', 'Unknown.png', 'Agouti + PED + Bleu russe.', 0),
(12, 'Beige', 'a/a r/r', 'Unknown.png', 'Noir + RED.', 0),
(13, 'Beige dove', 'a/a r/r m/m rb/rb', 'Unknown.png', 'Noir + RED + Mink + Bleu russe.', 0),
(14, 'Beige dove mock', 'a/a r/r mo/mo rb/rb', 'Unknown.png', 'Noir + RED + Mock + Bleu russe.', 0),
(15, 'Beige mink', 'a/a r/r m/m', 'Unknown.png', 'Noir + RED + Mink.', 0),
(16, 'Beige mock', 'a/a r/r mo/mo', 'Unknown.png', 'Noir + RED + Mock.', 0),
(17, 'Beige russe', 'a/a rb/rb r/r', 'Unknown.png', 'Noir + Bleu russe + RED.', 0),
(18, 'Bleu russe', 'a/a rb/rb', 'Unknown.png', 'Noir + Bleu russe.', 0),
(19, 'Bleu russe agouti', 'A/- rb/rb', 'Unknown.png', 'Agouti + Bleu russe.', 0),
(20, 'Bleu us', 'a/a d/d', 'Unknown.png', 'Noir + Bleu us.', 0),
(21, 'Bleu us agouti', 'A/- d/d', 'Unknown.png', 'Agouti + Bleu us.', 0),
(22, 'Cannelle', 'A/- m/m', 'Unknown.png', 'Agouti + Mink.', 0),
(23, 'Cannelle mock', 'A/- mo/mo', 'Unknown.png', 'Agouti + Mock.', 0),
(24, 'Champagne', 'a/a p/p', 'Unknown.png', 'Noir + PED.', 0),
(25, 'Champagne mink', 'a/a p/p m/m', 'Unknown.png', 'Noir + PED + Mink.', 0),
(26, 'Champagne mock', 'a/a p/p mo/mo', 'Unknown.png', 'Noir + PED + Mock.', 0),
(27, 'Champagne russe', 'a/a p/p rb/rb', 'Unknown.png', 'Noir + PED + Bleu russe.', 0),
(28, 'Chocolat', 'a/a b/b', 'Unknown.png', 'Noir + Chocolat.', 0),
(29, 'Double bleu', 'a/a d/d rb/rb', 'Unknown.png', 'Noir + Bleu us + Bleu russe.', 0),
(30, 'Double bleu agouti', 'A/- d/d rb/rb', 'Unknown.png', 'Agouti + Bleu us + Bleu russe.', 0),
(31, 'Double cannelle bleu', 'A/- m/m mo/mo d/d', 'Unknown.png', 'Agouti + Mink + Mock + Bleu us.', 0),
(32, 'Double cannelle russe', 'A/- m/m mo/mo rb/rb', 'Unknown.png', 'Agouti + Mink + Mock + Bleu russe.', 0),
(33, 'Double cannelle', 'A/- m/m mo/mo', 'Unknown.png', 'Agouti + Mink + Mock.', 0),
(34, 'Double havane', 'a/a m/m mo/mo R/r', 'Unknown.png', 'Noir + Mink + Mock + porteur RED.', 0),
(35, 'Double havane agouti', 'A/- m/m mo/mo R/r', 'Unknown.png', 'Agouti + Mink + Mock + porteur RED.', 0),
(36, 'Double havane russe', 'a/a m/m mo/mo R/r', 'Unknown.png', 'Noir + Mink + Mock + porteur RED.', 0),
(37, 'Double havane russe agouti', 'A/- m/m mo/mo rb/rb R/r', 'Unknown.png', 'Agouti + Mink + Mock + Bleu russe + porteur RED.', 0),
(38, 'Double lilas', 'a/a m/m mo/mo d/d R/r', 'Unknown.png', 'Noir + Mink + Mock + Bleu us + porteur RED.', 0),
(39, 'Double lilas agouti', 'A/- m/m mo/mo d/d R/r', 'Unknown.png', 'Agouti + Mink + Mock + Bleu us + porteur RED.', 0),
(40, 'Double mink', 'a/a m/m mo/mo', 'Unknown.png', 'Noir + Mink + Mock.', 0),
(41, 'Double mink bleu', 'a/a m/m mo/mo d/d', 'Unknown.png', 'Noir + Mink + Mock + Bleu us.', 0),
(42, 'Double mink russe', 'a/a m/m mo/mo rb/rb', 'Unknown.png', 'Noir + Mink + Mock + Bleu russe.', 0),
(43, 'Double moka', 'a/a m/m mo/mo P/p', 'Unknown.png', 'Noir + Mink + Mock + porteur PED.', 0),
(44, 'Double moka agouti', 'A/- m/m mo/mo P/p', 'Unknown.png', 'Agouti + Mink + Mock + porteur PED.', 0),
(45, 'Double moka bleu', 'a/a m/m mo/mo d/d P/p', 'Unknown.png', 'Noir + Mink + Mock + Bleu us + porteur PED.', 0),
(46, 'Double moka bleu agouti', 'A/- m/m mo/mo d/d P/p', 'Unknown.png', 'Agouti + Mink + Mock + Bleu us + porteur PED.', 0),
(47, 'Double moka russe', 'a/a m/m mo/mo rb/rb P/p', 'Unknown.png', 'Noir + Mink + Mock + Bleu russe + porteur PED.', 0),
(48, 'Double moka russe agouti', 'A/- m/m mo/mo rb/rb P/p', 'Unknown.png', 'Agouti + Mink + Mock + Bleu russe + porteur PED.', 0),
(49, 'Dove', 'a/a rb/rb m/m', 'Unknown.png', 'Noir + Bleu russe + Mink.', 0),
(50, 'Dove agouti', 'A/- rb/rb m/m', 'Unknown.png', 'Agouti + Bleu russe + Mink.', 0),
(51, 'Dove mock', 'a/a rb/rb mo/mo', 'Unknown.png', 'Noir + Bleu russe + Mock.', 0),
(52, 'Dove mock agouti', 'A/- rb/rb mo/mo', 'Unknown.png', 'Agouti + Bleu russe + Mock.', 0),
(53, 'Graphite', 'a/a gr/gr', 'Unknown.png', 'Noir + Graphite.', 0),
(54, 'Havane', 'a/a m/m R/r', 'Unknown.png', 'Noir + Mink + porteur RED.', 0),
(55, 'Havane agouti', 'A/- m/m R/r', 'Unknown.png', 'Agouti + Mink + porteur RED.', 0),
(56, 'Havane mock', 'a/a mo/mo R/r', 'Unknown.png', 'Noir + Mock + porteur RED.', 0),
(57, 'Havane mock agouti', 'A/a mo/mo R/r', 'Unknown.png', 'Agouti + Mock + porteur RED.', 0),
(58, 'Havane russe', 'a/a m/m rb/rb R/r', 'Unknown.png', 'Noir + Mink + Bleu russe + porteur RED.', 0),
(59, 'Havane russe agouti', 'A/- m/m rb/rb R/r', 'Unknown.png', 'Agouti + Mink + Bleu russe + porteur RED.', 0),
(60, 'Havane russe mock', 'a/a mo/mo rb/rb R/r', 'Unknown.png', 'Noir + Mock + Bleu russe + porteur RED.', 0),
(61, 'Havane russe mock agouti', 'A/- mo/mo rb/rb R/r', 'Unknown.png', 'Agouti + Mock + Bleu russe + porteur RED.', 0),
(62, 'Ice', 'a/a p/p d/d', 'Unknown.png', 'Noir + PED + Bleu us.', 0),
(63, 'Ice mink', 'a/a p/p m/m d/d', 'Unknown.png', 'Noir + PED + Mink + Bleu us.', 0),
(64, 'Ice mock', 'a/a p/p mo/mo d/d', 'Unknown.png', 'Noir + PED + Mock + Bleu us.', 0),
(65, 'Lavande', 'a/a m/m d/d', 'Unknown.png', 'Noir + Mink + Bleu us.', 0),
(66, 'Lavande agouti', 'A/- m/m d/d', 'Unknown.png', 'Agouti + Mink + Bleu us.', 0),
(67, 'Lavande mock', 'a/a mo/mo d/d', 'Unknown.png', 'Noir + Mock + Bleu us.', 0),
(68, 'Lavande mock agouti', 'A/- mo/mo d/d', 'Unknown.png', 'Agouti + Mock + Bleu us.', 0),
(69, 'Lilas', 'a/a m/m d/d R/r', 'Unknown.png', 'Noir + Mink + Bleu us + porteur RED.', 0),
(70, 'Lilas agouti', 'A/- m/m d/d R/r', 'Unknown.png', 'Agouti + Mink + Bleu us + porteur RED.', 0),
(71, 'Lilas mock', 'a/a mo/mo d/d R/r', 'Unknown.png', 'Noir + Mock + Bleu us + porteur RED.', 0),
(72, 'Lilas mock agouti', 'A/- mo/mo d/d R/r', 'Unknown.png', 'Agouti + Mock + Bleu us + porteur RED.', 0),
(73, 'Mink', 'm/m', 'Unknown.png', 'Noir + Mink.', 0),
(74, 'Mock', 'a/a mo/mo', 'Unknown.png', 'Noir + Mock.', 0),
(75, 'Moka', 'a/a m/m P/p', 'Unknown.png', 'Noir + Mink + porteur PED.', 0),
(76, 'Moka agouti', 'A/- m/m P/p', 'Unknown.png', 'Agouti + Mink + porteur PED.', 0),
(77, 'Moka bleu', 'a/a m/m d/d P/p', 'Unknown.png', 'Noir + Mink + Bleu us + porteur PED.', 0),
(78, 'Moka bleu agouti', 'A/- m/m d/d P/p', 'Unknown.png', 'Agouti + Mink + Bleu us + porteur PED.', 0),
(79, 'Moka bleu mock', 'a/a mo/mo d/d P/p', 'Unknown.png', 'Noir + Mock + Bleu us + porteur PED.', 0),
(80, 'Moka bleu mock agouti', 'A/- mo/mo d/d P/p', 'Unknown.png', 'Agouti + Mock + Bleu us + porteur PED.', 0),
(81, 'Moka mock', 'a/a mo/mo P/p', 'Unknown.png', 'Noir + Mock + porteur PED.', 0),
(82, 'Moka mock agouti', 'A/- mo/mo P/p', 'Unknown.png', 'Agouti + Mock + porteur PED.', 0),
(83, 'Moka russe', 'a/a m/m rb/rb P/p', 'Unknown.png', 'Noir + Mink + Bleu russe + porteur PED.', 0),
(84, 'Moka russe agouti', 'A/- m/m rb/rb P/p', 'Unknown.png', 'Agouti + Mink + Bleu russe + porteur PED.', 0),
(85, 'Moka russe mock', 'a/a mo/mo rb/rb P/p', 'Unknown.png', 'Noir + Mock + Bleu russe + porteur PED.', 0),
(86, 'Moka russe mock agouti', 'A/- mo/mo rb/rb P/p', 'Unknown.png', 'Agouti + Mock + Bleu russe + porteur PED.', 0),
(87, 'Noir', 'a/a', 'Unknown.png', 'Noir.', 0),
(88, 'Platine', 'a/a r/r d/d', 'Unknown.png', 'Noir + RED + Bleu us.', 0),
(89, 'Platine mink', 'a/a r/r m/m d/d', 'Unknown.png', 'Noir + RED + Mink + Bleu us.', 0),
(90, 'Platine mock', 'a/a r/r mo/mo d/d', 'Unknown.png', 'Noir + RED + Mock + Bleu us.', 0),
(91, 'Topaze', 'A/- r/r', 'Unknown.png', 'Agouti + RED.', 0),
(92, 'Topaze bleu', 'A/- r/r d/d', 'Unknown.png', 'Agouti + RED + Bleu us.', 0),
(93, 'Topaze dove', 'A/- r/r m/m rb/rb', 'Unknown.png', 'Agouti + RED + Mink + Bleu russe.', 0),
(94, 'Topaze dove mock', 'A/- r/r mo/mo rb/rb', 'Unknown.png', 'Agouti + RED + Mock + Bleu russe.', 0),
(95, 'Topaze mink', 'A/- r/r m/m', 'Unknown.png', 'Agouti + RED + Mink.', 0),
(96, 'Topaze mock', 'A/- r/r mo/mo', 'Unknown.png', 'Agouti + RED + Mock.', 0),
(97, 'Topaze russe', 'A/- r/r rb/rb', 'Unknown.png', 'Agouti + RED + Bleu russe.', 0);

-- --------------------------------------------------------

--
-- Structure de la table `dilutions`
--

CREATE TABLE `dilutions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(70) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table référençant la liste des dilutions';

--
-- Déchargement des données de la table `dilutions`
--

INSERT INTO `dilutions` (`id`, `name`, `picture`, `genotype`, `description`, `is_picture_mandatory`) VALUES
(1, 'Aucune', 'Unknown.png', 'C/C', 'No dilution', 0),
(2, 'Albinos', 'Unknown.png', 'c/c', 'Aucune pigmentation.', 0),
(3, 'Biscuit', 'Unknown.png', 'c/c Be<sup>Bu</sup>/be', 'Burmese base albinos.\r\n\r\nBurmese hétérozygote, de base albinos, donc sans pointe. Sur base agoutie, parfois désigné sous le terme \"biscuit cream\".', 0),
(4, 'Burmese himalayen', 'Unknown.png', 'c<sup>h</sup>/c Be<sup>Bu</sup>/be', 'Burmese himalayen.', 0),
(5, 'Burmese marbré', 'Unknown.png', 'c<sup>m</sup>/(c ou c<sup>m</sup>) Be<sup>Bu</sup>/be<sup>Bu</sup>', 'Burmese hétérozygote + devil.', 0),
(6, 'Burmese marbré pointé', 'Unknown.png', 'c<sup>m</sup>/c<sup>h</sup> Be<sup>Bu</sup>/be', 'Burmese marbré pointé.', 0),
(7, 'Burmese siamois', 'Unknown.png', 'c<sup>h</sup>/c<sup>h</sup> Be<sup>Bu</sup>/be', 'Burmese siamois.', 0),
(8, 'Devil', 'Unknown.png', 'c<sup>m</sup>/c<sup>m</sup> ou c/c<sup>m</sup>', 'Devil sans pointe.', 0),
(9, 'Devil pointé', 'Unknown.png', 'c<sup>m</sup>/c<sup>h</sup>', 'Devil pointé.', 0),
(10, 'Himalayen', 'Unknown.png', 'c<sup>h</sup>/c', 'Himalayen.', 0),
(11, 'Sable himalayen', 'Unknown.png', 'c<sup>h</sup>/c Be<sup>Bu</sup>/Be<sup>Bu</sup>', 'Burmese homozygote + base himalayenne.', 0),
(12, 'Sable marbré', 'Unknown.png', 'c<sup>m</sup>/(c ou c<sup>m</sup>) Be<sup>Bu</sup>/Be<sup>Bu</sup>', 'Burmese homozygote + devil sans pointe.', 0),
(13, 'Sable marbré pointé', 'Unknown.png', 'c<sup>m</sup>/c<sup>h</sup> Be<sup>Bu</sup>/Be<sup>Bu</sup>', 'Burmese homozygote + devil + pointe.', 0),
(14, 'Sable siamois', 'Unknown.png', 'c<sup>h</sup>/c<sup>h</sup> Be<sup>Bu</sup>/Be<sup>Bu</sup>', 'Burmese homozygote + siamois.', 0),
(15, 'Siamois', 'Unknown.png', 'c<sup>h</sup>/c<sup>h</sup>', 'Siamois.', 0);

-- --------------------------------------------------------

--
-- Structure de la table `earsets`
--

CREATE TABLE `earsets` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(70) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `earsets`
--

INSERT INTO `earsets` (`id`, `name`, `picture`, `genotype`, `description`, `is_picture_mandatory`) VALUES
(1, 'Inconnu', 'Unknown.png', '?/?', 'Non déterminé (par exemple en raison d\'une mort en bas âge).', 1),
(2, 'Standard', 'Unknown.png', 'Dmbo/-', 'Top eared (wild type)', 0),
(3, 'Dumbo', 'Unknown.png', 'dmbo/dmbo', 'Dumbo ears', 0);

-- --------------------------------------------------------

--
-- Structure de la table `eyecolors`
--

CREATE TABLE `eyecolors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(70) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table contenant la liste des yeux';

--
-- Déchargement des données de la table `eyecolors`
--

INSERT INTO `eyecolors` (`id`, `name`, `picture`, `genotype`, `description`, `is_picture_mandatory`) VALUES
(1, 'Inconnu', 'Unknown.png', '?/?', 'Non déterminé ou non visible (par exemple anophtalmie ou énucléation).', 1),
(2, 'Noir', 'Unknown.png', '?/? ou Be<sup>be</sup>/? ', 'Type sauvage, sauf dans le cas des rats dilués.\r\n\r\n\"Par défaut\" (en l\'absence de mutations récessives de couleur ou dilution, mais aussi en présence d\'une partie d\'entre elles comme le bleu ou le bleu russe), les rats ont les yeux noirs.\r\n\r\nLes rats \"dilués\" (albinos, siamois, himalayen, devil), à l\'exclusion des rats burmese et sable, font exception. Ils ont \"normalement\" les yeux rouge ou rubis, *sauf* s\'ils possèdent également l\'allèle muté du gène \"black-eyed\" Be<sup>be</sup> qui est dominant et hypostatique du locus C.\r\n\r\nLes rats PED (champagne, ambre) et RED (beige, topaze) ne voient pas leur phénotype affecté par leur génotype au locus BlackEyed.', 0),
(3, 'Rubis', 'Unknown.png', 'r/r', 'Parfois appelé \"dark ruby\" ou \"dark rubis\" ; typique des rats r/r (topaze, beige).', 0),
(4, 'Rouge', 'Unknown.png', '?/? ou non C/C', 'Typique des rats \"dilués\" (albinos, siamois, hymalayen, devil).\r\n\r\nSe rencontre également chez les rats dits \"à double dilution\" c\'est-à-dire porteurs de deux paires de mutations récessives de couleur (par exemple le platine d/d r/r).', 0),
(5, 'Rose', 'Unknown.png', 'p/p', 'Typique des rats PED (champagne, ambre).\r\n\r\nSe rencontre également chez les rats dits \"à triple dilution\" c\'est-à-dire porteurs de trois paires de mutations récessives de couleur (par exemple le platine mink a/a r/r m/m d/d).', 0),
(6, 'Vairon', 'Unknown.png', '?/?', 'Les deux yeux ont une couleur différente. Souvent associé à un marquage facial (flèche, étoile). Toutes les combinaisons sont possibles (noir et rouge, rubis et rose, etc.) Il est recommandé aux propriétaires d\'indiquer la combinaison sur la fiche des rats concernés.', 0);

-- --------------------------------------------------------

--
-- Structure de la table `markings`
--

CREATE TABLE `markings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(70) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table référençant la liste des marquages';

--
-- Déchargement des données de la table `markings`
--

INSERT INTO `markings` (`id`, `name`, `picture`, `genotype`, `description`, `is_picture_mandatory`) VALUES
(1, 'Inconnu', 'Unknown.png', '?/?', 'Undetermined or invisible marking (dilution, naked)', 0),
(2, 'Uni', 'Unknown.png', 'H/H', 'Pas de marquage.', 0),
(3, 'Irish', 'Unknown.png', 'H/h ou h<sup>i</sup>/(H ou h<sup>i</sup> ou h)', 'Présence d\'une tâche blanche sur le ventre.', 0),
(4, 'Hooded', 'Unknown.png', 'h/(h ou h<sup>e</sup>)', 'Hooded', 0),
(5, 'Varieberk', 'Unknown.png', 'H/H<sup>e</sup>', 'Varieberk', 0),
(6, 'Capé', 'Unknown.png', 'H<sup>e</sup>/(H<sup>e</sup> ou h) ou H<sup>n</sup>/H<sup>n</sup>, h/h', 'Capé', 0),
(7, 'Berkshire', 'Unknown.png', 'H/h ou h<sup>i</sup>/(H ou h<sup>i</sup> ou h<sup>n</sup>)', 'Ventre entièrement blanc.', 0),
(8, 'Varihooded', 'Unknown.png', 'H/H<sup>e</sup>', 'Varihooded', 0),
(9, 'Bareback', 'Unknown.png', 'h/(h ou h<sup>n</sup>)', 'Bareback', 0),
(10, 'Variegated', 'Unknown.png', 'H/H<sup>e</sup>', 'Variegated', 0),
(11, 'Masqué', 'Unknown.png', 'H<sup>e</sup>/H<sup>e</sup>', 'Masqué', 0),
(12, 'Dalmatien', 'Unknown.png', 'TBD', 'Dalmatien', 1),
(13, 'Patché', 'Unknown.png', 'H<sup>e</sup>/H<sup>e</sup>', 'Patché', 0),
(14, 'Oppossum', 'Unknown.png', 'TBD', 'Oppossum', 1),
(15, 'Husky', 'Unknown.png', 'ro/ro', 'Husky', 0),
(16, 'Essex', 'Unknown.png', 'H/H<sup>ro</sup>', 'Essex', 1),
(17, 'Baldie', 'Unknown.png', 'H<sup>ro</sup>/h', 'Baldie', 1),
(18, 'Surmarqué', 'Unknown.png', 'H<sup>e</sup>/H<sup>e</sup>', 'Le rat est entièrement blanc.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `singularities`
--

CREATE TABLE `singularities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(70) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT 'Unknown.png',
  `genotype` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `is_picture_mandatory` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table référençant la liste des particularités';

--
-- Déchargement des données de la table `singularities`
--

INSERT INTO `singularities` (`id`, `name`, `picture`, `genotype`, `description`, `is_picture_mandatory`) VALUES
(1, 'Down Under', 'Unknown.png', 'Du/du', 'Same marking on belly and back', 1),
(2, 'Dwarf', 'Unknown.png', 'dw/dw', 'Dwarf rat', 0),
(3, 'Étoilé', 'Unknown.png', 'hs/hs', 'White spot on the head', 0),
(4, 'Fléché', 'Unknown.png', 'hs/hs', 'Fléché', 0),
(5, 'Gants', 'Unknown.png', 'H/H, H/h, h<sup>i</sup>/H, h<sup>i</sup>/h<sup>i</sup>, h<sup>i</sup>h', 'Présence de poils blancs à l\'extrémité des pattes avant sur un rat uni.\r\n\r\nLes gants font implicitement partie intégrante du marquage irish, tout comme la tache sur le ventre. Ils n\'ont pas à être spécifiés dans ce cas : enregistrer uniquement *\"Marquage : Irish\"*, sans particularité.\r\n\r\nUn rat sans tache sur le ventre, sans chaussettes et dont la queue est unie, mais qui possède des poils blancs sur les mains et les poignets est le plus souvent un rat \"génétiquement irish\", mais l\'usage veut qu\'il soit considéré comme un rat uni c\'est-à-dire \"sans marquage\".', 0),
(6, 'Perle', 'Unknown.png', 'Pe/pe', 'Perle', 0),
(7, 'Merle', 'Unknown.png', 'TBD', 'Merle', 0),
(8, 'Manx', 'Unknown.png', 'TBD', 'Manx', 1),
(9, 'Golden', 'Unknown.png', 'TBD', 'Golden', 1),
(10, 'Stippel', 'Unknown.png', 'He/hi', 'Stippel', 1),
(11, 'Silvermane', 'Unknown.png', 'TBD', 'Silvermane', 0),
(12, 'Marble', 'Unknown.png', 'TBD', 'Marble', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `coats`
--
ALTER TABLE `coats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Index pour la table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Index pour la table `dilutions`
--
ALTER TABLE `dilutions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Index pour la table `earsets`
--
ALTER TABLE `earsets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Index pour la table `eyecolors`
--
ALTER TABLE `eyecolors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Index pour la table `markings`
--
ALTER TABLE `markings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Index pour la table `singularities`
--
ALTER TABLE `singularities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `coats`
--
ALTER TABLE `coats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT pour la table `dilutions`
--
ALTER TABLE `dilutions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `earsets`
--
ALTER TABLE `earsets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `eyecolors`
--
ALTER TABLE `eyecolors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `markings`
--
ALTER TABLE `markings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `singularities`
--
ALTER TABLE `singularities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
