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
-- Structure de la table `death_primary_causes`
--

CREATE TABLE `death_primary_causes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL DEFAULT '',
  `is_infant` tinyint(1) NOT NULL DEFAULT 0,
  `is_accident` tinyint(1) NOT NULL DEFAULT 0,
  `is_oldster` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table référençant la liste des causes de décès';

--
-- Déchargement des données de la table `death_primary_causes`
--

INSERT INTO `death_primary_causes` (`id`, `name`, `description`, `is_infant`, `is_accident`, `is_oldster`) VALUES
(1, 'Cause inconnue', 'Choisissez Cause inconnue si vous ne savez pas de quoi est mort votre rat. Si vous savez de quoi est mort votre rat mais que cela ne vous semble correspondre à aucune autre des catégories proposées, choisissez Autres.', 0, 0, 0),
(2, 'Accidents, traumatismes, intoxications', 'Si vous ne savez pas exactement de quoi votre rat est mort dans cette catégorie, ne choisissez pas de niveau 2. Si vous savez exactement de quoi votre rat est mort mais que cela ne vous semble correspondre à aucune autre des catégories proposées, choisissez Autre (dernier item de la liste) et ajoutez un commentaire à la fin de votre enregistrement.', 0, 1, 0),
(3, 'Cardio-vasculaire', 'Si vous ne savez pas exactement de quoi votre rat est mort dans cette catégorie, ne choisissez pas de niveau 2. Si vous savez exactement de quoi votre rat est mort mais que cela ne vous semble correspondre à aucune autre des catégories proposées, choisissez Autre (dernier item de la liste) et ajoutez un commentaire à la fin de votre enregistrement.', 0, 0, 0),
(4, 'Digestif', 'Si vous ne savez pas exactement de quoi votre rat est mort dans cette catégorie, ne choisissez pas de niveau 2. Si vous savez exactement de quoi votre rat est mort mais que cela ne vous semble correspondre à aucune autre des catégories proposées, choisissez Autre (dernier item de la liste) et ajoutez un commentaire à la fin de votre enregistrement.', 0, 0, 0),
(5, 'Mortalité infantile (moins de 6 semaines)', 'Si vous ne savez pas exactement de quoi votre rat est mort dans cette catégorie, ne choisissez pas de niveau 2. Si vous savez exactement de quoi votre rat est mort mais que cela ne vous semble correspondre à aucune autre des catégories proposées, choisissez Autre (dernier item de la liste) et ajoutez un commentaire à la fin de votre enregistrement.', 1, 0, 0),
(6, 'Muscles et squelette', 'Si vous ne savez pas exactement de quoi votre rat est mort dans cette catégorie, ne choisissez pas de niveau 2. Si vous savez exactement de quoi votre rat est mort mais que cela ne vous semble correspondre à aucune autre des catégories proposées, choisissez Autre (dernier item de la liste) et ajoutez un commentaire à la fin de votre enregistrement.', 0, 0, 0),
(7, 'Neurologique (cerveau, moelle épinière, nerfs)', 'Si vous ne savez pas exactement de quoi votre rat est mort dans cette catégorie, ne choisissez pas de niveau 2. Si vous savez exactement de quoi votre rat est mort mais que cela ne vous semble correspondre à aucune autre des catégories proposées, choisissez Autre (dernier item de la liste) et ajoutez un commentaire à la fin de votre enregistrement.', 0, 0, 0),
(8, 'Œil, oreille, bouche, face', 'Si vous ne savez pas exactement de quoi votre rat est mort dans cette catégorie, ne choisissez pas de niveau 2. Si vous savez exactement de quoi votre rat est mort mais que cela ne vous semble correspondre à aucune autre des catégories proposées, choisissez Autre (dernier item de la liste) et ajoutez un commentaire à la fin de votre enregistrement.', 0, 0, 0),
(9, 'Peau', 'Si vous ne savez pas exactement de quoi votre rat est mort dans cette catégorie, ne choisissez pas de niveau 2. Si vous savez exactement de quoi votre rat est mort mais que cela ne vous semble correspondre à aucune autre des catégories proposées, choisissez Autre (dernier item de la liste) et ajoutez un commentaire à la fin de votre enregistrement.', 0, 0, 0),
(10, 'Respiratoire', 'Si vous ne savez pas exactement de quoi votre rat est mort dans cette catégorie, ne choisissez pas de niveau 2. Si vous savez exactement de quoi votre rat est mort mais que cela ne vous semble correspondre à aucune autre des catégories proposées, choisissez Autre (dernier item de la liste) et ajoutez un commentaire à la fin de votre enregistrement.', 0, 0, 0),
(11, 'Système reproducteur', 'Si vous ne savez pas exactement de quoi votre rat est mort dans cette catégorie, ne choisissez pas de niveau 2. Si vous savez exactement de quoi votre rat est mort mais que cela ne vous semble correspondre à aucune autre des catégories proposées, choisissez Autre (dernier item de la liste) et ajoutez un commentaire à la fin de votre enregistrement.', 0, 0, 0),
(12, 'Système urinaire (reins, vessie)', 'Si vous ne savez pas exactement de quoi votre rat est mort dans cette catégorie, ne choisissez pas de niveau 2. Si vous savez exactement de quoi votre rat est mort mais que cela ne vous semble correspondre à aucune autre des catégories proposées, choisissez Autre (dernier item de la liste) et ajoutez un commentaire à la fin de votre enregistrement.', 0, 0, 0),
(13, 'Vieillesse, mort naturelle (24 mois minimum)', 'Cette cause implique que le rat montrait des signes de vieillesse depuis au moins plusieurs semaines, avec une dégradation lente et progressive de son état général (par exemple perte de poids modérée régulière, perte de mobilité, perte d’autonomie pour boire ou manger, allongement des périodes de sommeil, baisse de l’acuité visuelle ou auditive…), sans pathologie particulièrement identifiée. Dans le cas contraire, choisir la pathologie principale. En cas de mort brutale sur un rat en pleine forme, même âgé, choisir « Cause inconnue. »', 0, 0, 1),
(14, 'Autres', 'Choisissez cette catégorie si vous savez de quoi est mort votre rat mais que cela ne vous semble correspondre à aucune autre des catégories proposées. Si vous ne savez pas de quoi est mort votre rat, choisissez Cause inconnue.', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `death_secondary_causes`
--

CREATE TABLE `death_secondary_causes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `death_primary_cause_id` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL DEFAULT '',
  `is_tumor` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `death_secondary_causes`
--

INSERT INTO `death_secondary_causes` (`id`, `name`, `death_primary_cause_id`, `description`, `is_tumor`) VALUES
(1, 'Aucune information (présumé mort)', 1, 'Cette cause est à choisir uniquement et obligatoirement si vous ne savez pas ce qu’est devenu le rat, mais pouvez raisonnablement supposer qu’il est mort. Dans ce cas, estimez la date de décès à la dernière date à laquelle vous êtes certain que le rat était en vie (jour de sa disparition, dernier envoi de photo…).', 0),
(2, 'Cause indéterminée (date connue)', 1, 'Cette cause est à choisir si le décès a été constaté mais que vous ne savez pas du tout pourquoi le rat est mort.', 0),
(3, 'Accident domestique (écrasement, accident de porte... )', 2, 'Les accidents domestiques concernent uniquement les traumatismes (pas les empoisonnements) où un humain de la maison est impliqué (exemple : vous vous êtes assis sur votre rat.) ', 0),
(4, 'Accident vétérinaire (anesthésie lors d’une opération mineure, erreur médicale...)', 2, 'Les accidents vétérinaires concernent uniquement les rats en bonne santé ou souffrant de problèmes mineurs qui ne l’auraient probablement pas tué (exemple : gale, castration de confort…), lorsque l’anesthésie ou la prescription médicale sont clairement la cause du décès (prescription d’une molécule non tolérée par le rat, coup de bistouri raté pendant une stérilisation préventive…). Un rat opéré d’une tumeur infiltrante et mal placée et qui ne se réveille pas de l’anesthésie n’est pas un accident vétérinaire (choisir le motif de l’intervention.)', 0),
(5, 'Bagarres, blessures, morsures graves, hémorragie consécutive (hors hémorragie anormale)', 2, 'Choisir cette cause pour tous les traumatismes graves causés par d’autres rats. En cas d’hémorragie, elle doit sembler « normale » par rapport au contexte : lésion d’un gros vaisseau comme la veine jugulaire par exemple, morsures profondes et nombreuses... Si elle semblait exagérée (rat qui se vide de son sang après un simple coup de dents), choisissez la cause primaire « Cardio-vasculaire » et la cause secondaire « Hémorragie ».', 0),
(6, 'Brûlures thermiques ou chimiques', 2, '-', 0),
(7, 'Chutes, fractures, traumatisme crânien ou de la moelle épinière (hors bagarres)', 2, 'Choisir cette cause pour les traumatismes qui n’ont été causés ni par des humains, ni par d’autres rats.', 0),
(8, 'Coup de chaleur', 2, '-', 0),
(9, 'Étouffement, fausse route', 2, 'Cette cause ne concerne pas les détresses respiratoires causées par une infection ou une tumeur pulmonaire, mais uniquement le passage accidentel de nourriture ou d’objets dans les voies respiratoires, avec ou sans obstruction totale.', 0),
(10, 'Empoisonnement (produits ménagers, poisons, médicaments volés...)', 2, 'Cette cause concerne uniquement les empoisonnements malveillants et les empoisonnements où le rat a ingéré une substance dangereuse « dans votre dos ».', 0),
(11, 'Intoxication alimentaire', 2, 'Cette cause est à choisir en cas d’ingestion d’aliments avariés ou contaminés par des germes.', 0),
(12, 'Surdosage médicamenteux (médicaments vétérinaires prescrits)', 2, 'Cette cause concerne uniquement les rats ayant reçu par votre faute ou celle du vétérinaire une trop grande quantité d’un médicament qui lui avait été prescrit pour un problème mineur.', 0),
(13, 'Autre accident ou traumatisme', 2, 'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez « Cause inconnue » (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un accident sans savoir précisément choisir un item dans la liste détaillée.)', 0),
(14, 'Crise cardiaque, infarctus, embolie pulmonaire', 3, 'Attention, cette cause ne peut être choisie que si une autopsie a confirmé le diagnostic. Les morts brutales inexpliquées ne sont pas à renseigner comme « arrêts cardiaques » mais comme « Cause inconnue. »', 0),
(15, 'Insuffisance cardiaque, valvulopathie', 3, '-', 0),
(16, 'Hémorragie (exagérée par rapport au contexte, anomalie de la coagulation, hémophilie)', 3, 'Cette cause est à choisir si votre rat s’est « vidé de son sang » alors qu’il ne souffrait que d’une blessure mineure qui n’aurait pas dû causer autant de saignements. Dans le cas contraire, choisir la cause accidentelle ou traumatique appropriée (catégorie « Accidents, traumatismes, intoxications. »)', 0),
(17, 'Autre problème cardiaque ou vasculaire', 3, 'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème cardiaque ou vasculaire sans savoir précisément choisir un item dans la liste détaillée.)', 0),
(18, 'Abcès digestif', 4, '-', 0),
(19, 'Gastro-entérite, diarrhée', 4, '-', 0),
(20, 'Hémorragie digestive', 4, '-', 0),
(21, 'Insuffisance hépatique', 4, '-', 0),
(22, 'Malnutrition', 4, '-', 0),
(23, 'Mégacôlon héréditaire', 4, 'Cette cause n’est à choisir qu’en cas de mégacôlon familial (aganglionnaire), pouvant être suspecté en fonction de l’âge (rats très jeunes), l’atteinte d’autres membres de la même famille, le marquage (rats très blancs), l’absence d’une autre cause d’occlusion. Attention, certains vétérinaires emploient parfois le terme « mégacôlon » dans un sens symptomatique en cas d’occlusion (dans ce cas, choisir « Occlusion intestinale ».)', 0),
(24, 'Occlusion intestinale (hors mégacôlon)', 4, 'Cette cause est à choisir en cas d’occlusion causée par une constipation chronique grave, une torsion de l’intestin, une tumeur mammaire bénigne mal placée causant un obstacle mécanique… à l’exclusion du mégacôlon héréditaire (choisir « Mégacôlon héréditaire ») et des tumeurs de l’intestin (choisir « Tumeur digestive ».)', 0),
(25, 'Prolapsus rectal', 4, '-', 0),
(26, 'Tumeur digestive (estomac, foie, pancréas, intestins...)', 4, 'Cette cause est à choisir lorsque la tumeur atteignait un organe du système digestif (mais pas les tumeurs abdominales non liées au système digestif.)', 1),
(27, 'Autre problème digestif', 4, 'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème digestif sans savoir précisément choisir un item dans la liste détaillée.)', 0),
(28, 'Malformation, hydrocéphalie', 5, 'Cette cause est à choisir si le raton est né vivant mais décédé par la suite en raisons de malformations. S’il était mort-né, choisir « Mort-né ».', 0),
(29, 'Manque de lait', 5, '-', 0),
(30, 'Mort-né', 5, '-', 0),
(31, 'Autre cause de mort infantile', 5, 'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’une mort en bas âge sans savoir précisément choisir un item dans la liste détaillée.)', 0),
(32, 'Infection, abcès musculaire', 6, '-', 0),
(33, 'Infection articulaire ou osseuse, arthrite septique', 6, '-', 0),
(34, 'Tumeur musculaire', 6, '-', 1),
(35, 'Tumeur osseuse', 6, '-', 1),
(36, 'Autre problème du système locomoteur', 6, 'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème osseux, musculaire ou de locomotion, sans savoir précisément choisir un item dans la liste détaillée.)', 0),
(37, 'Accident vasculaire cérébral', 7, '-', 0),
(38, 'Atteinte progressive de la moelle épinière, paralysie dégénérative', 7, 'Cette cause ne concerne pas les paralysies brutales et les atteintes traumatiques de la moelle épinière (choisir la cause du traumatisme dans la catégorie « Accidents, traumatismes, intoxications. »)', 0),
(39, 'Epilepsie', 7, '. Cette cause est à choisir uniquement en cas d’épilepsie essentielle / primaire (c’est-à-dire non causée par un autre problème sous-jacent tel qu’une tumeur au cerveau.)', 0),
(40, 'Infection du cerveau, encéphalite, méningite', 7, '-', 0),
(41, 'Tumeur cérébrale', 7, '-', 1),
(42, 'Tumeur hypophysaire (pituitaire)', 7, '-', 1),
(43, 'Autre problème neurologique', 7, 'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème neurologique sans savoir précisément choisir un item dans la liste détaillée.)', 0),
(44, 'Abcès dentaire', 8, '', 0),
(45, 'Abcès facial (hors dentaire et Zymbal)', 8, '', 0),
(46, 'Abcès rétro-orbitaire', 8, '-', 0),
(47, 'Glaucome', 8, '-', 0),
(48, 'Malocclusion dentaire', 8, 'Cette cause concerne les défauts d’implantation des dents et de conformation de la mâchoire non causés par un autre problème (malocclusion primaire.) Si la malocclusion était consécutive à une tumeur ayant déformé la mâchoire, choisir la tumeur concernée.', 0),
(49, 'Otite, abcès dans l’oreille', 8, '-', 0),
(50, 'Tumeur de la glande de Zymbal', 8, '-', 1),
(51, 'Tumeur de la face (hors Zymbal)', 8, '-', 1),
(52, 'Tumeur rétro-orbitaire', 8, '-', 1),
(53, 'Autre problème touchant la tête', 8, 'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème concernant la tête sans savoir précisément choisir un item dans la liste détaillée.)', 0),
(54, 'Abcès sous-cutané', 9, '-', 0),
(55, 'Infection étendue de la peau (pyodermite, escarres...)', 9, '-', 0),
(56, 'Pododermatite', 9, '-', 0),
(57, 'Tumeur cutanée, cancer de la peau', 9, '-', 1),
(58, 'Autre problème de peau', 9, '-', 0),
(59, 'Bronchite, pneumonie', 10, '-', 0),
(60, 'Œdème pulmonaire', 10, '-', 0),
(61, 'Tumeur pulmonaire', 10, 'Cette cause est à choisir pour les tumeurs primaires du poumon. En cas de métastases causées par une tumeur d’un autre organe, choisir la tumeur principale et préciser en commentaires « présence de métastases pulmonaires. »', 1),
(62, 'Autre problème respiratoire', 10, 'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème respiratoire sans savoir précisément choisir un item dans la liste détaillée.)', 0),
(63, 'Complications de gestation ou de mise-bas', 11, 'Cette cause est à choisir en cas de décès de la mère avant, pendant ou après la mise-bas : toxémie gravidique, éclampsie, hémorragie, complications sur césarienne…) Les petits décédés à cette occasion doivent être enregistrés dans la catégorie Mortalité infantile.', 0),
(64, 'Infection de l’utérus (métrite, pyomètre)', 11, '-', 0),
(65, 'Prolapsus vaginal (hors tumeurs et postpartum)', 11, 'En cas de prolapsus cette cause n’est à choisir que si la rate était à distance d’une mise-bas (sinon choisir « Complications de mise-bas ») et ne souffrait pas d’une tumeur dans la région pelvienne qui aurait pu déclencher le prolapsus (dans ce cas, choisir la tumeur concernée.)', 0),
(66, 'Tumeur mammaire', 11, '-', 1),
(67, 'Tumeur ovarienne', 11, '-', 1),
(68, 'Tumeur utérine', 11, '-', 1),
(69, 'Tumeur vaginale', 11, '-', 1),
(70, 'Tumeur de la prostate', 11, '-', 1),
(71, 'Tumeur testiculaire', 11, '-', 1),
(72, 'Tumeur des glandes préputiales', 11, '-', 1),
(73, 'Autre problème du système reproducteur', 11, 'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème du système reproducteur sans savoir précisément choisir un item dans la liste détaillée.)', 0),
(74, 'Infection urinaire ou rénale', 12, '-', 0),
(75, 'Insuffisance rénale', 12, '-', 0),
(76, 'Obstruction de l’urètre, rétention urinaire, calculs', 12, '-', 0),
(77, 'Tumeur de la vessie', 12, '-', 1),
(78, 'Tumeur du rein', 12, '-', 1),
(79, 'Autre problème du système urinaire', 12, 'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il s’agit d’un problème urinaire ou rénal sans savoir précisément choisir un item dans la liste détaillée.)', 0),
(80, 'Allergie, choc anaphylactique', 14, '-', 0),
(81, 'Cancer généralisé, leucémie, lymphome', 14, '-', 1),
(82, 'Diabète', 14, '-', 0),
(83, 'Euthanasie sans cause médicale', 14, 'Cette cause est réservée aux euthanasies réalisées sur des animaux en bonne santé, dont l’état médical ne justifiait pas une euthanasie (rat utilisé pour l’alimentation d’un autre animal, euthanasie de convenance…) Pour tous les autres cas d’euthanasie (animal malade), choisir la cause ayant amené à son état et à la décision d’euthanasier, et cocher la case « Euthanasie ».', 0),
(84, 'Infection, abcès indéterminé', 14, 'Cette cause est destinée aux anciennes fiches et ne devrait pas être choisie en général.', 0),
(85, 'Parasites', 14, 'Cette cause ne concerne que les parasitoses très graves. Les rats qui souffraient d’un parasite mineur (poux, gale) au moment de leur décès doivent être enregistrés à la cause principale de leur décès.', 0),
(86, 'Septicémie', 14, '-', 0),
(87, 'Tumeur autre (salivaire, splénique, surrénale, thyroïde...)', 14, '-', 1),
(88, 'Tumeur indéterminée (organe atteint inconnu)', 14, 'Cette cause est destinée aux anciennes fiches et ne devrait pas être choisie en général.', 1),
(89, 'Virus, épidémie, déficience immunitaire (SDA, Sendaï, Tyzzer...)', 14, '-', 0),
(90, 'Autre cause connue ne rentrant dans aucune catégorie', 14, 'Réservé aux cas où vous connaissez la cause du décès, mais que celle-ci n’est disponible nulle part dans la liste. Si vous ne savez pas ce qui a tué votre rat, choisissez Cause inconnue (si vous ne savez pas du tout) ou ne choisissez pas de niveau 2 (si vous savez qu’il ne s’agit pas d’une des catégories précédentes, sans savoir précisément choisir un item dans la liste détaillée.)', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `death_primary_causes`
--
ALTER TABLE `death_primary_causes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Index pour la table `death_secondary_causes`
--
ALTER TABLE `death_secondary_causes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_deces_secondaire_deces_principal_idx` (`death_primary_cause_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `death_primary_causes`
--
ALTER TABLE `death_primary_causes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `death_secondary_causes`
--
ALTER TABLE `death_secondary_causes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `death_secondary_causes`
--
ALTER TABLE `death_secondary_causes`
  ADD CONSTRAINT `fk_deces_secondaire_deces_principal1` FOREIGN KEY (`death_primary_cause_id`) REFERENCES `death_primary_causes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
