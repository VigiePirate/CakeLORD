-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql:3306
-- Généré le : sam. 22 avr. 2023 à 16:51
-- Version du serveur :  10.5.18-MariaDB-0+deb11u1
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `artelord`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `subtitle` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `subtitle`, `content`, `created`, `modified`, `category_id`) VALUES
(1, 'Centre d’accueil', 'Aide', 'Les basiques : à quoi sert le LORD, tous les moyens d\'obtenir de l\'aide, liens vers les rubriques et articles. Peut-être une vidéo de présentation ?\r\n ', '2023-04-20 19:19:02', '2023-04-22 15:50:47', 1),
(2, 'Code de conduite', 'Aide', 'Afin que le LORD demeure un outil utile et un espace agréable pour tous, nous souhaitons que chaque utilisateur, simple propriétaire ou membre de l\'équipe, s\'engage à respecter ces quelques règles de bon sens.\r\n\r\n## Respect mutuel\r\nL\'équipe du LORD est entièrement bénévole, et maintient l\'outil sur son temps libre. Les utilisateurs sont priés de s\'adresser à ses membres de manière courtoise, et à faire preuve de patience face au traitement de leurs demandes.\r\n\r\nEn retour, les membres de l\'équipe traitent les données et les tâches qui leur sont confiées avec la plus grande intégrité, et respectent la même courtoisie dans leurs échanges avec les utilisateurs.\r\n\r\nAucun comportement s\'apparentant à l\'insulte, au harcèlement ou à la discrimination ne sera toléré.\r\n\r\n## Respect des lois en vigueur\r\nAucun propos injurieux, diffamatoire, discriminatoire, faisant l\'éloge de l’alcool, de la drogue, ou de pratiques ou comportements illégaux n\'est toléré sur le LORD.\r\n\r\nAfin de protéger les mineurs il est également interdit de tenir des propos à caractère violent ou sexuel, de donner des liens qui ne seraient pas « tout public », ou d\'utiliser des images relevant de tels registres.\r\n\r\nVous devez également détenir les droits des photographies et textes que vous enregistrez sur le LORD.\r\n\r\n## Respect des règles du LORD\r\nNous vous demandons également de respecter quelques règles spécifiques au LORD afin de garantir son bon fonctionnement et la qualité de ses données :\r\n* **Entrez une adresse email valide :** nous avons parfois besoin de vous contacter. Sans cette adresse, c’est impossible.\r\n* **Ne créez pas de double compte :** si vous ne parvenez pas à vous connecter à votre compte, utilisez la fonction de récupération de mot de passe, ou rendez-vous sur le [forum de correction](https://www.srfa.info/forums/forum/229-lord/) pour nous exposer votre problème. \r\n* **Entrez les informations obligatoires sur les origines des rats :** suivez les indications du formulaire d\'enregistrement et en particulier, entrez un commentaire informatif sur la provenance des rats d\'affixe dit \"générique\" (animalerie, sauvetage...). L\'équipe vérifiera la présence de ce commentaire et pourra supprimer la fiche en son absence. *Dans la version précédentes du LORD, 70% des fiches bloquées à la modération l\'était à cause du non-respect cette clause, tout particulièrement pour les rats issus d\'éleveurs indépendants (affixe IND). Pensez à nos bénévoles !* \r\n* **Entrez une date de naissance et une cause de décès :** jour, mois et année doivent impérativement être entrés, même si ce n\'est qu\'une date estimée.\r\n* **Entrez une date et une cause de décès :** en cas de décès, il est également obligatoire d\'indiquer une date et une cause. Des indications et des options sont disponibles dans les formulaires pour les causes inconnues et les rats \"perdus de vue\".\r\n* **Entrez tous les petits de vos portées :** même s\'il est tentant de n\'enregistrer que vos reproducteurs, c\'est totalement contraire à l\'esprit du LORD et fausse les statistiques. Les rateries ne respectant pas cette règle ne pourront prétendre au statut \"certifié\" et pourront être exclues des statistiques.\r\n* **Ne contournez pas les règles :** les erreurs de bonne foi sont toujours possibles, mais aucune tentative de bidouillage ou de détournement de l\'outil ne sera acceptée. Si le site ne fonctionne pas comme vous pensez qu\'il devrait, contactez-nous.\r\n\r\nDe manière générale : demandez avant d\'agir lorsque vous avez un doute ! une réponse vous serez vite donnée, et cela évitera bien des désagréments.', '2023-04-20 19:22:33', '2023-04-22 16:49:41', 1),
(3, 'Contribuer au LORD', 'Aide', '## Actualiser ses fiches\r\nLe plus grand service à rendre au LORD est d\'avoir toutes ses fiches à jour ! N\'oubliez pas non plus de passer sur vos anciennes fiches pour compléter les informations que vous n\'avez pas pu enregistrer à l\'époque et qui sont désormais disponibles, comme la date de saillie des portées ou les causes de décès précises.\r\n\r\n## Signaler les problèmes\r\nGrâce au bouton de signalement, vous pouvez nous alerter facilement sur tout problème. \r\n\r\n## Faire connaître l’outil\r\nParler du LORD autour de soi, à ses adoptants, dans ses réseaux sociaux... Marche à suivre pour devenir partenaire ou apparaître dans les liens.\r\n \r\n## Soutenir ses infrastructures\r\nLe LORD est gratuit, mais il a un coût ! Adhésion ou association.\r\n\r\n ## Contribuer à gérer le site\r\n ### Curation des anciennes données\r\n Corriger et compléter les données importées de la V1.\r\n \r\n ### Modération des nouvelles fiches\r\n \r\n ## Contribuer à développer le site\r\n ### Traductions\r\n \r\n ### Programmation\r\n \r\n', '2023-04-20 19:32:36', '2023-04-20 19:32:36', 1),
(4, 'Adapter le LORD', 'Aide', '*English version below for our international guests!*\r\n\r\nLe LORD est un logiciel open source, sous licence libre. Cela signifie que vous pouvez l\'adapter à vos propres besoins et déployer votre propre application, à la seule condition de respecter les termes de la licence.\r\n\r\nVous pouvez par exemple :\r\n* créer un livre des origines **pour une autre espèce** ;\r\n* créer un livre des origines **pour votre pays**, si les traductions ne suffisent pas ou que vous préférez garder une base de données séparée de la nôtre.\r\n\r\nCette adaptation requiert des compétences en informatique. \r\n\r\nVoici les grandes étapes que vous nous conseillons de suivre :\r\n1. Sur [Github](https://github.com/), créer un embranchement *(\"fork\")* du projet [CakeLORD](https://github.com/VigiePirate/CakeLORD/)\r\n2. etc.\r\n\r\nMerci de noter que l\'équipe du LORD n\'est pas en mesure de fournir du support technique à la création ou la maintenance d\'une copie dérivée.\r\n\r\n### English version\r\nLORD is an open-source, free software...', '2023-04-21 10:25:59', '2023-04-21 10:42:00', 1),
(5, 'Historique', 'À propos', '## Le Registre\r\nLe Livre des Origines du Rat Domestique est né d\'une version précédente, connue sous le nom de \"Registre français du rat domestique\", ou plus simplement \"Registre\".\r\n\r\nLe concept de ce projet a été développé en 2005, à la suite de plusieurs années de réflexion. Il était porté par L\'Association Méditerranéenne du Rat de Compagnie et a nécessité la collaboration de plusieurs passionnés du rat domestique permettant ainsi de mutualiser leurs compétences. Son lancement public a eu lieu en septembre 2006.\r\n\r\nEn 2008 le registre ferme ses portes, et le projet se trouve repris par l\'association Ratibus.\r\n\r\n## Le LORD V1\r\n\r\n\r\n## Le LORD V2\r\n### La campagne de financement participatif\r\n### Les équipes se succèdent\r\n### Les dernières lignes droites\r\n\r\n## Le futur du LORD\r\n', '2023-04-21 10:48:16', '2023-04-21 10:48:16', 2),
(6, 'Nouveautés', 'À propos', ' ', '2023-04-21 10:48:35', '2023-04-21 15:03:28', 2),
(7, 'L’équipe', 'À propos', ' ', '2023-04-21 10:48:50', '2023-04-21 15:03:35', 2),
(8, 'Remerciements', 'À propos', 'Le LORD n\'existerait pas sans les très nombreux bénévoles qui se sont succédé pour le faire vivre et l\'améliorer, mais aussi tous ceux qui nous ont soutenus, ou y ont contribué d\'une manière ou d\'une autre.\r\n\r\nQu\'ils soient encore à nos côtés ou aient vogué vers d\'autres aventure, qu\'ils soient ici remerciés.\r\n\r\n## Gestion du site \r\n* Modération des fiches : Cajou\r\n* Documentation :\r\n* Curation des données :\r\n\r\n## Développement logiciel\r\n* Base de données :\r\n* Administration système :\r\n* Programmation :\r\n* Graphisme :\r\n* Beta test :\r\n\r\n## Financement participatif ', '2023-04-21 10:53:37', '2023-04-21 18:44:02', 2),
(9, 'Mentions légales', 'À propos', '## Objet\r\n\r\nLes présentes Conditions Générales ont pour objet de définir les modalités de mise à disposition des services du site lord-rat.org , ci-après nommé « le Service » et les conditions d\'utilisation du Service par l\'utilisateur.\r\n\r\nTout accès et/ou Utilisation du site lord-rat.org suppose l\'acceptation et le respect de l\'ensemble des termes des présentes Conditions et leur acceptation inconditionnelle. Elles constituent donc un contrat entre le Service et l’Utilisateur.\r\n\r\nDans le cas où l’Utilisateur ne souhaite pas accepter tout ou partie des présentes conditions générales, il lui est demandé de renoncer à tout usage du Service.\r\n\r\n## Mentions légales\r\n\r\nLe site lord-rat.org est édité par :\r\n\r\nSRFA,\r\nAssociation loi 1901,\r\ndont le siège social est établi\r\n\r\nXXXXXX\r\n\r\nLe site lord-rat.org est hébergé par :\r\n\r\nOVH,\r\nSAS au capital de 500 K€\r\nRCS Roubaix – Tourcoing 424 761 419 00011\r\nCode APE 6202A\r\nN° TVA : FR 22 424 761 419\r\nSiège social : 2 rue Kellermann - 59100 Roubaix - France.\r\n\r\n\r\n## Définitions\r\n\r\n* Utilisateur : L\'Utilisateur est toute personne qui utilise le Site ou l\'un des services proposés sur le Site.\r\n* Contenu Utilisateur : Le terme « Contenu Utilisateur » désigne les données transmises par l\'Utilisateur dans les différentes rubriques du Site.\r\n* Membre : Le terme « Membre » désigne un utilisateur identifié sur le site.\r\n* Identifiant : Le terme « Identifiant » recouvre les informations nécessaires à l\'identification d\'un utilisateur sur le site pour accéder aux zones réservées aux membres.\r\n* Mot de passe : Le « Mot de passe » est une information confidentielle, dont l\'Utilisateur doit garder le secret, lui permettant, utilisé conjointement avec son Identifiant, de prouver l\'identité.\r\n\r\n## Accès au service\r\nLe Service est accessible gratuitement à tout Utilisateur disposant d\'un accès à internet. Tous les coûts afférents à l\'accès au Service, que ce soient les frais matériels, logiciels ou d\'accès à internet sont exclusivement à la charge de l\'utilisateur. Il est seul responsable du bon fonctionnement de son équipement informatique ainsi que de son accès à internet.\r\n\r\nCertaines sections du site sont réservées aux Membres après identification à l\'aide de leur Identifiant et de leur Mot de passe.\r\n\r\nSRFA se réserve le droit de refuser l\'accès au Service, unilatéralement et sans notification préalable, à tout Utilisateur ne respectant pas les présentes conditions d\'utilisation.\r\n\r\nSRFA met en œuvre tous les moyens raisonnables à sa disposition pour assurer un accès de qualité au Service, mais n\'est tenu à aucune obligation d\'y parvenir.\r\n\r\nSRFA ne peut, en outre, être tenue responsable de tout dysfonctionnement du réseau ou des serveurs ou de tout autre évènement échappant au contrôle raisonnable, qui empêcherait ou dégraderait l\'accès au Service.\r\n\r\nSRFA se réserve la possibilité d\'interrompre, de suspendre momentanément ou de modifier sans préavis l\'accès à tout ou partie du Service, afin d\'en assurer la maintenance, ou pour toute autre raison, sans que l\'interruption n\'ouvre droit à aucune obligation ni indemnisation.\r\n\r\n## Propriété intellectuelle\r\n\r\nLe site lord-rat.org, notamment son contenu, est protégé par le droit en vigueur en France. SRFA est le titulaire exclusif de l\'intégralité des droits de propriété intellectuelle sur le site et son contenu (textes, photographies, illustrations, images, logos, etc.).\r\n\r\nLe contenu reproduit sur le Site fait l’objet d’un droit d\'auteur et sa reproduction ou sa diffusion, sans autorisation expresse écrite de SRFA, constitue une contrefaçon passible de sanctions pénales. Les textes et illustrations dont la mention le précise sont soumis à la licence Creative Commons et peuvent sous certaines conditions être reproduits, distribués ou modifiés et ce, sans nécessairement en demander l\'autorisation.\r\n\r\nL’Utilisateur est seul responsable du Contenu Utilisateur qu’il met en ligne via le Service, ainsi que des textes et/ou opinions qu’il formule. L\'Utilisateur cède expressément et gracieusement à SRFA tous droits de propriété intellectuelle y afférant et notamment le droit de reproduction, de représentation et d\'adaptation, pour la durée légale de protection des droits d\'auteur. Il s’engage notamment à ce que ces données ne soient pas de nature à porter\r\natteinte aux intérêts légitimes de tiers quels qu’ils soient. A ce titre, il garantit SRFA contre tous recours, fondés directement ou indirectement sur ces propos et/ou données, susceptibles d’être intentés par quiconque à l’encontre de SRFA.\r\n\r\nSRFA se réserve le droit de supprimer tout ou partie du Contenu Utilisateur, à tout moment et pour quelque raison que ce soit, sans avertissement ou justification préalable. L\'Utilisateur ne pourra faire valoir aucune réclamation à ce titre.\r\n\r\n## Données personnelles\r\n\r\nDans une logique de respect de la vie privée de ses Utilisateurs, SRFA s\'engage à ce que la collecte et le traitement d\'informations personnelles, effectués au sein du présent site, soient effectués conformément à la loi n°78-17 du 6 janvier 1978 relative à l\'informatique, aux fichiers et aux libertés, dite Loi « Informatique et Libertés ». A ce titre, le site Lord-rat.org fait l\'objet d\'une déclaration à la CNIL, en cours de validation.\r\n\r\nConformément à l\'article 34 de la loi « Informatique et Libertés », SRFA garantit à l\'Utilisateur un droit d\'opposition, d\'accès et de rectification sur les données nominatives le concernant.\r\n\r\nL\'Utilisateur a la possibilité d\'exercer ce droit :\r\n\r\n* sur le site, dans l\'Espace membres ;\r\n* en rentrant directement en contact par l\'adresse suivante : contact@lord-rat.org\r\n* en écrivant au siège de l\'association\r\n\r\n## Limites de responsabilité\r\n\r\nLe site lord-rat.org est une base de données portant sur le rat domestique.\r\n\r\nLes informations diffusées sur le site lord-rat.org proviennent de sources réputées fiables. Toutefois, SRFA ne peut garantir l\'exactitude ou la pertinence de ces données. En outre, les informations mises à disposition sur ce site le sont uniquement à titre purement informatif et ne sauraient constituer en aucun cas une obligation de quelque nature que ce soit.\r\n\r\nEn conséquence, l\'Utilisation des informations et contenus disponibles sur l\'ensemble du site, ne sauraient en aucun cas engager la responsabilité de SRFA, à quelque titre que ce soit. L\'Utilisateur est seul maître de la bonne utilisation, avec discernement et esprit, des informations mises à sa disposition sur le Site.\r\n\r\nL\'accès à certaines sections du site lord-rat.org nécessite l\'utilisation d\'un Identifiant et d\'un Mot de passe. Le Mot de passe, choisi par l\'utilisateur, est personnel et confidentiel. L\'utilisateur s\'engage à conserver secret son mot de passe et à ne pas le divulguer sous quelque forme que ce soit. L\'utilisation de son Identifiant et de son Mot de passe à travers internet se fait aux risques et périls de l\'Utilisateur. Il appartient à l\'Utilisateur de prendre toutes les dispositions nécessaires permettant de protéger ses propres données contre toute atteinte.\r\n\r\nSRFA s\'engage néanmoins à mettre en place tous les moyens nécessaires pour garantir la sécurité et la confidentialité des données transmises.\r\n\r\nL\'Utilisateur admet connaitre les limitations et contraintes propres au réseau internet et, à ce titre, reconnait notamment l\'impossibilité d\'une garantie totale de la sécurisation des échanges de données. SRFA ne pourra pas être tenue responsable des préjudices découlant de la transmission de toute information, y compris de celle de son identifiant et/ou de son mot de passe, via le Service.\r\n\r\nSRFA ne pourra en aucun cas, dans la limite du droit applicable, être tenue responsable des dommages et/ou préjudices, directs ou indirects, matériels ou immatériels, ou de quelque nature que ce soit, résultant d\'une indisponibilité du Service ou de toute Utilisation du Service. Le terme « Utilisation » doit être entendu au sens large, c\'est-à-dire tout usage du site quel qu\'il soit, licite ou non.\r\n\r\nL\'Utilisateur s\'engage, d\'une manière générale, à respecter l\'ensemble de la règlementation en vigueur en France.\r\n\r\n## Liens hypertextes\r\n\r\nlord-rat.org propose des liens hypertextes vers des sites web édités et/ou gérés par des tiers.\r\n\r\nDans la mesure où aucun contrôle n\'est exercé sur ces ressources externes, l\'Utilisateur reconnait que SRFA n\'assume aucune responsabilité relative à la mise à disposition de ces ressources, et ne peut être tenue responsable quant à leur contenu.\r\n\r\n## Force majeure\r\n\r\nLa responsabilité de SRFA ne pourra être engagée en cas de force majeure ou de faits indépendants de sa volonté.\r\n\r\n\r\n## Évolution du présent contrat\r\n\r\nSRFA se réserve le droit de modifier les termes, conditions et mentions du présent contrat à tout moment.\r\n\r\nIl est ainsi conseillé à l\'Utilisateur de consulter régulièrement la dernière version des Conditions d\'Utilisation disponible sur le site www.lord-rat.org\r\n\r\n\r\n## Durée et résiliation\r\n\r\nLe présent contrat est conclu pour une durée indéterminée à compter de l\'Utilisation du Service par l’Utilisateur.\r\n\r\n\r\n## Droit applicable et juridiction compétente\r\n\r\nLes règles en matière de droit, applicables aux contenus et aux transmissions de données sur et autour du site, sont déterminées par la loi française. En cas de litige, n\'ayant pu faire l\'objet d\'un accord à l\'amiable, seuls les tribunaux français du ressort de la cour d\'appel de Paris sont compétents.\r\n', '2023-04-21 10:57:36', '2023-04-21 10:57:36', 2),
(10, 'Sites web', 'Liens', ' ', '2023-04-21 15:00:47', '2023-04-21 15:00:47', 3),
(11, 'Forums', 'Liens', ' ', '2023-04-21 15:01:00', '2023-04-21 15:01:00', 3),
(12, 'Associations', 'Liens', ' ', '2023-04-21 15:03:06', '2023-04-21 15:03:06', 3),
(13, 'Réseaux sociaux', 'Liens', ' ', '2023-04-21 15:05:02', '2023-04-21 15:05:02', 3),
(14, 'Partenaires', 'Liens', ' ', '2023-04-21 15:05:22', '2023-04-21 15:05:22', 3),
(15, 'S’inscrire', 'Notice', ' ', '2023-04-21 16:36:42', '2023-04-21 17:29:46', 4),
(16, 'Comprendre une fiche rat', 'Notice', ' ', '2023-04-21 17:04:39', '2023-04-21 17:27:37', 4),
(17, 'Comprendre une fiche portée', 'Notice', ' ', '2023-04-21 17:04:52', '2023-04-21 17:27:28', 4),
(18, 'Comprendre une fiche raterie', 'Notice', ' ', '2023-04-21 17:05:06', '2023-04-21 17:27:23', 4),
(19, 'Comprendre une fiche variété', 'Notice', ' ', '2023-04-21 17:05:20', '2023-04-21 17:27:17', 4),
(20, 'Comprendre une fiche décès', 'Notice', ' ', '2023-04-21 17:05:50', '2023-04-21 17:27:08', 4),
(21, 'Comprendre les statistiques', 'Notice', ' ', '2023-04-21 17:08:18', '2023-04-21 17:26:58', 4),
(22, 'Faire une recherche', 'Notice', ' ', '2023-04-21 17:41:34', '2023-04-21 17:42:14', 4),
(23, 'Compléter mon profil', 'Notice', ' ', '2023-04-21 17:42:35', '2023-04-21 17:42:35', 5),
(24, 'Mon tableau de bord', 'Notice', ' ', '2023-04-21 17:42:53', '2023-04-21 17:42:53', 5),
(25, 'Enregistrer un rat', 'Notice', ' ', '2023-04-21 17:45:43', '2023-04-21 17:45:43', 6),
(26, 'Modifier une fiche rat', 'Notice', ' ', '2023-04-21 17:46:29', '2023-04-21 17:46:29', 6),
(27, 'Déclarer le décès d\'un rat', 'Notice', ' ', '2023-04-21 17:46:57', '2023-04-21 17:46:57', 6),
(28, 'Enregistrer une raterie', 'Notice', ' ', '2023-04-21 17:47:36', '2023-04-21 17:47:37', 7),
(29, 'Modifier ma raterie', 'Notice', ' ', '2023-04-21 17:48:06', '2023-04-21 17:48:19', 7);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `position`) VALUES
(1, 'Aide', 1),
(2, 'À propos', 2),
(3, 'Liens', 3),
(4, 'Démarrer', 4),
(5, 'Mon compte', 5),
(6, 'Mes rats', 6),
(7, 'Ma raterie', 7),
(8, 'Mes portées', 8),
(9, 'Sécurité et confidentialité', 9),
(10, 'J’ai un problème !', 10);

-- --------------------------------------------------------

--
-- Structure de la table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `faqs`
--

INSERT INTO `faqs` (`id`, `category_id`, `question`, `answer`) VALUES
(1, 4, 'Le LORD est-il gratuit ?', 'Oui, le Livre des Origines du Rat Domestique est gratuit et ouvert à tous. Les inscriptions de rats sont illimitées tant qu\'elles respectent les règles mises en place. Toutefois, le LORD a un coût ! Vous pouvez nous soutenir financièrement par [une adhésion ou un don libre à l\'association SRFA](https://www.srfa.info/association/adhesion.php/).'),
(2, 4, 'Dois-je créer un compte pour pouvoir utiliser le LORD ?', 'Une grande partie des informations enregistrées dans le LORD peuvent être consultées sans inscription. Un compte est nécessaire pour enregistrer des informations, comme vos rats ou votre raterie, et pour certaines fonctionnalités coûteuses en ressources informatiques, comme la consultation de la carte des rateries ou certaines statistiques.'),
(3, 6, 'Je ne connais pas la date de naissance de mon rat, comment faire ?', 'La date de naissance est une information obligatoire pour enregistrer un rat : si vous l\'ignorez, estimez-la au plus juste et indiquez en commentaire que cette date est incertaine.'),
(4, 7, 'Ma raterie change de nom, dois-je créer un nouveau compte ?', 'Vous pouvez attacher plusieurs rateries à votre compte, mais vous ne pouvez avoir qu’une seule raterie ouverte à la fois. Pour changer de raterie, déclarez votre ancienne raterie **« inactive »** (depuis votre tableau de bord ou directement depuis la fiche de la raterie), puis créez la nouvelle.'),
(5, 7, 'Comment puis-je choisir mon affixe ?', 'Vous pouvez consulter la [liste des rateries par ordre alphabétique](https://lord-beta.srfa.info/ratteries?sort=prefix&direction=asc), pour vérifier que l’affixe de votre choix est disponible et qu’aucune raterie ne porte un nom trop proche.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title_UNIQUE` (`title`),
  ADD KEY `fk_articles_categories1_idx` (`category_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_faqs_categories1_idx` (`category_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_articles_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `fk_faqs_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
