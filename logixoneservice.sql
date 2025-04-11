-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 02 avr. 2025 à 13:07
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `logixoneservice`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int NOT NULL AUTO_INCREMENT,
  `code_article` varchar(10) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `quantite` int NOT NULL,
  `prix_unitaire` int DEFAULT NULL,
  `image_article` varchar(255) NOT NULL,
  `id_categorie` int DEFAULT NULL,
  PRIMARY KEY (`id_article`),
  UNIQUE KEY `code_article` (`code_article`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `code_article`, `designation`, `quantite`, `prix_unitaire`, `image_article`, `id_categorie`) VALUES
(8, 'A3878', '4X4', 4, 1000, 'img_67c0a48115b851.38282903.jpg', 8),
(9, 'A8029', '5X5 physique', 4, 2000, 'img_67c0a45bbcf185.05560984.jpg', 8),
(10, 'A1430', '5X7 physique', 5, 3000, 'img_67c595fb988ef1.57018278.jpg', 8),
(11, 'A1271', '24X30', 1, 5000, 'img_67c0494c5c2772.36306861.jpg', 8),
(13, 'A5308', 'T-Shirt', 1, 4000, 'img_67dfd3da3f55a8.06125413.PNG', 8);

-- --------------------------------------------------------

--
-- Structure de la table `banque`
--

DROP TABLE IF EXISTS `banque`;
CREATE TABLE IF NOT EXISTS `banque` (
  `id_banque` int NOT NULL AUTO_INCREMENT,
  `code_banque` varchar(50) DEFAULT NULL,
  `montant_banque` int DEFAULT NULL,
  `date_banque` date DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  PRIMARY KEY (`id_banque`),
  UNIQUE KEY `code_banque` (`code_banque`),
  KEY `FK_banque_utilisateur` (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `banque`
--

INSERT INTO `banque` (`id_banque`, `code_banque`, `montant_banque`, `date_banque`, `id_utilisateur`) VALUES
(1, 'BK', 5600, '2025-01-08', 5),
(2, 'BK1', 6400, '2025-01-08', 5),
(3, 'BK2', 0, '2025-03-17', 10);

-- --------------------------------------------------------

--
-- Structure de la table `c1`
--

DROP TABLE IF EXISTS `c1`;
CREATE TABLE IF NOT EXISTS `c1` (
  `c1_id` int NOT NULL AUTO_INCREMENT,
  `c1_code` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`c1_id`)
) ENGINE=InnoDB AUTO_INCREMENT=311 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `c1`
--

INSERT INTO `c1` (`c1_id`, `c1_code`, `date`) VALUES
(301, 1292678, '2024-09-30'),
(302, 1192904, '2024-08-30'),
(303, 1332284, '2024-09-30'),
(304, 4112201, '2024-09-30'),
(305, 18112494, '2024-08-30'),
(306, 12122487, '2024-09-30'),
(307, 2062020, '2024-11-30'),
(308, 29122476, '2024-11-30'),
(309, 1292665, '2024-10-30'),
(310, 1662940, '2024-09-30');

-- --------------------------------------------------------

--
-- Structure de la table `caisse`
--

DROP TABLE IF EXISTS `caisse`;
CREATE TABLE IF NOT EXISTS `caisse` (
  `id_caisse` int NOT NULL AUTO_INCREMENT,
  `code_caisse` varchar(10) DEFAULT NULL,
  `montant_caisse` int DEFAULT NULL,
  `date_caisse` date DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  PRIMARY KEY (`id_caisse`),
  UNIQUE KEY `code_caisse` (`code_caisse`),
  KEY `FK_caisse_utilisateur` (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `caisse`
--

INSERT INTO `caisse` (`id_caisse`, `code_caisse`, `montant_caisse`, `date_caisse`, `id_utilisateur`) VALUES
(1, 'BK', 1400, '2025-01-08', 5),
(2, 'BK1', 1600, '2025-01-08', 5),
(3, 'CS2', -6000, '2025-01-08', 5),
(4, 'CS3', -30000, '2025-01-18', 5),
(5, 'CS4', -50000, '2025-01-18', 5),
(6, 'CS5', -50000, '2025-01-18', 5),
(7, 'CS6', -50000, '2025-02-03', 5),
(8, 'CS7', 0, '2025-03-17', 10);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL,
  `nom_categorie` varchar(255) DEFAULT NULL,
  `description_categorie` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`, `description_categorie`) VALUES
(0, 'Photo minute', '4X4, 5X5, 5X7, Photo numerique'),
(8, 'Agrandissement ', '30X45, 50X75, 40X60, Photo ');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `cni_client` varchar(10) DEFAULT NULL,
  `prenom_client` varchar(255) DEFAULT NULL,
  `adresse_client` varchar(255) DEFAULT NULL,
  `tel_client` varchar(20) DEFAULT NULL,
  `nom_client` varchar(50) NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `cni_client`, `prenom_client`, `adresse_client`, `tel_client`, `nom_client`) VALUES
(24, '102119848', 'ISSA TENGEN', 'Ngwelle-BonabÃ©ri', '680369185', 'TENGEN'),
(25, '10213454', 'UNIVERSITY', 'Rail-Bonaberi', '652002812', 'PHIBMAT'),
(27, '3454545', 'MIJONGUE', 'YAOUNDE', '678640622', 'SYLVANIA'),
(28, '75365874', 'Claude', 'Nkongsamba', '680369185', 'Jean'),
(29, '54567', 'Paul', 'Ndobo-BonabÃ©ri', '680369185', 'Jean '),
(30, '11111111', 'Junior', 'BonabÃ©ri', '680369185', 'Abena'),
(31, '2121334', 'Leticia', 'BonabÃ©ri', '673407922', 'Merveille'),
(32, '32', 'Ismael', 'Ngwelle', '680369185', 'Junior'),
(33, '33', 'AYA HENSON', 'Ngwelle-Bonabéri', '672023149', 'PURITY '),
(34, '34', 'TRESOR', 'Rail-Bonaberi', '691234576', 'KAYAP');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int NOT NULL AUTO_INCREMENT,
  `date_depot` date DEFAULT NULL,
  `date_estimatrice` date DEFAULT NULL,
  `date_retrait` date DEFAULT NULL,
  `id_client` int DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  `code_commande` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_commande`),
  UNIQUE KEY `code_commande` (`code_commande`),
  KEY `id_client` (`id_client`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `date_depot`, `date_estimatrice`, `date_retrait`, `id_client`, `id_utilisateur`, `code_commande`) VALUES
(1, '2024-09-05', '2024-09-07', NULL, 31, 7, 'CMD9043'),
(2, '2024-09-20', '2024-09-22', NULL, 31, 5, 'CMD398'),
(3, '2024-09-20', '2024-09-21', '2024-11-27', 27, 5, 'CMD9337'),
(4, '2024-09-20', '2024-09-22', NULL, 29, 5, 'CMD3238'),
(5, '2024-09-20', '2024-09-22', '2024-11-27', 30, 5, 'CMD9175'),
(6, '2025-03-01', '2025-03-15', NULL, 29, 5, 'CMD5143'),
(7, '2025-03-02', '2025-03-09', NULL, 32, 5, 'CMD8078'),
(8, '2025-03-09', '2025-03-16', NULL, 33, 5, 'CMD9103'),
(9, '2025-03-23', '2025-03-25', NULL, 29, 5, 'CMD6488'),
(10, '2025-03-29', '2025-04-02', NULL, 34, 10, 'CMD1759');

-- --------------------------------------------------------

--
-- Structure de la table `commande_article`
--

DROP TABLE IF EXISTS `commande_article`;
CREATE TABLE IF NOT EXISTS `commande_article` (
  `id_commande` int DEFAULT NULL,
  `id_article` int DEFAULT NULL,
  `quantite_art` int DEFAULT NULL,
  `prix_unitaire_art` int DEFAULT NULL,
  `montant` int NOT NULL,
  KEY `id_commande` (`id_commande`),
  KEY `id_article` (`id_article`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande_article`
--

INSERT INTO `commande_article` (`id_commande`, `id_article`, `quantite_art`, `prix_unitaire_art`, `montant`) VALUES
(1, 8, 8, 250, 2000),
(2, 9, 4, 500, 2000),
(2, 8, 8, 250, 2000),
(3, 9, 9, 500, 4500),
(3, 8, 8, 250, 2000),
(4, 9, 12, 500, 6000),
(4, 8, 8, 250, 2000),
(5, 9, 5, 500, 2500),
(5, 8, 8, 250, 2000),
(6, 11, 5, 5000, 25000),
(6, 9, 4, 2000, 8000),
(7, 11, 2, 5000, 10000),
(7, 10, 8, 3000, 24000),
(7, 9, 4, 2000, 8000),
(8, 11, 4, 5000, 20000),
(8, 8, 1, 1000, 1000),
(9, 8, 4, 1000, 4000),
(9, 13, 4, 4000, 16000),
(10, 13, 2, 4000, 8000),
(10, 10, 5, 3000, 15000);

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

DROP TABLE IF EXISTS `depense`;
CREATE TABLE IF NOT EXISTS `depense` (
  `id_depense` int NOT NULL AUTO_INCREMENT,
  `code_depense` varchar(10) NOT NULL,
  `libelle_depense` varchar(50) NOT NULL,
  `montant_depense` int NOT NULL,
  `raison_depense` text NOT NULL,
  `date_depense` date NOT NULL,
  `id_utilisateur` int NOT NULL,
  `image_depense` varchar(255) NOT NULL,
  PRIMARY KEY (`id_depense`),
  UNIQUE KEY `code_depense` (`code_depense`),
  KEY `fk_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `depense`
--

INSERT INTO `depense` (`id_depense`, `code_depense`, `libelle_depense`, `montant_depense`, `raison_depense`, `date_depense`, `id_utilisateur`, `image_depense`) VALUES
(4, 'EXP-649', 'Light bill', 10000, 'Electric bill', '2024-06-27', 5, ''),
(5, 'DP-557', 'Facture d\'eau', 5000, '               Payement de facture d\'eau post paid\r\n                    ', '2024-07-10', 5, ''),
(6, 'DP-120', 'Electricity', 2000, '                      Eneo prepaid                    ', '2024-08-26', 5, ''),
(7, 'DP-624', 'All expenses', 6000, 'Eneo prepaid', '2025-01-08', 5, ''),
(8, 'DP-828', 'Achat produit', 30000, 'Achat des produits', '2025-01-18', 5, ''),
(9, 'DP-506', 'Achat produit', 50000, 'achat', '2025-01-18', 5, ''),
(10, 'DP-2', 'Achat produit', 50000, 'hyfkjty', '2025-01-18', 5, ''),
(11, 'DP-668', 'Achat produit', 50000, 'Achat de lait', '2025-02-03', 5, ''),
(18, 'DP-8611', 'Électricité ', 6000, 'ddd', '2025-03-01', 5, 'img_67c3599f7a9208.10037944.PNG'),
(19, 'DP-56518', 'Achat produit', 50000, 'Achat de produits', '2025-03-01', 5, 'img_67c35a2201b6b5.78927895.jpg'),
(20, 'DP-27319', 'Connexion internet', 500, 'Connexion internet', '2025-03-26', 10, 'img_67e3fd762d8c33.75265922.jpg'),
(21, 'DP-61420', 'Nourriture', 500, 'Nourriture du matin', '2025-03-26', 10, 'img_67e3ff1d864805.94248432.PNG');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int NOT NULL AUTO_INCREMENT,
  `code_facture` varchar(10) DEFAULT NULL,
  `date_facture` date DEFAULT NULL,
  `id_commande` int DEFAULT NULL,
  `montant_total` int DEFAULT NULL,
  `reduction` int NOT NULL,
  `montant_verse` int DEFAULT NULL,
  `reste` int DEFAULT NULL,
  PRIMARY KEY (`id_facture`),
  UNIQUE KEY `code_facture` (`code_facture`),
  KEY `commande_facture` (`id_commande`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id_facture`, `code_facture`, `date_facture`, `id_commande`, `montant_total`, `reduction`, `montant_verse`, `reste`) VALUES
(1, 'FCT-1', '2024-09-05', 1, 1000, 0, 1000, 0),
(2, 'FCT-2', '2024-09-20', 2, 4000, 0, 4000, 0),
(3, 'FCT-3', '2024-09-20', 3, 6500, 0, 6500, 0),
(4, 'FCT-4', '2024-09-20', 4, 8000, 0, 8000, 0),
(5, 'FCT-5', '2024-09-20', 5, 3500, 0, 3500, 0),
(7, 'FCT-6', '2025-02-16', 5, 4500, 500, 4000, 0),
(9, 'FCT-67', '2025-03-01', 6, 33000, 0, 33000, 0),
(10, 'FCT-79', '2025-03-05', 7, 42000, 2000, 40000, 0),
(11, 'FCT-810', '2025-03-09', 8, 21000, 2100, 18900, 0),
(12, 'FCT-911', '2025-03-23', 9, 20000, 2000, 18000, 0),
(13, 'FCT-1012', '2025-03-29', 10, 23000, 2300, 20700, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_promotion`
--

DROP TABLE IF EXISTS `ligne_promotion`;
CREATE TABLE IF NOT EXISTS `ligne_promotion` (
  `id_promotion` int DEFAULT NULL,
  `id_article` int DEFAULT NULL,
  `pourcentage_reduction` int DEFAULT NULL,
  KEY `FK_article_promo` (`id_article`),
  KEY `FK_promotion` (`id_promotion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `profile_picture`
--

DROP TABLE IF EXISTS `profile_picture`;
CREATE TABLE IF NOT EXISTS `profile_picture` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `image_name` varchar(255) NOT NULL,
  `image_tmp_name` longblob NOT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `FK_profil_picture` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `profile_picture`
--

INSERT INTO `profile_picture` (`image_id`, `image_name`, `image_tmp_name`, `id_utilisateur`) VALUES
(13, 'issa.jpg', 0x433a5c77616d705c746d705c706870313646322e746d70, 5),
(14, 'Moi 1.jpg', 0x433a5c77616d705c746d705c7068703338462e746d70, 6),
(16, 'images (9).jpg', 0x433a5c77616d705c746d705c706870444230322e746d70, 10),
(19, 'Logix.png', 0x433a5c77616d705c746d705c706870353333302e746d70, 16);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

DROP TABLE IF EXISTS `promotion`;
CREATE TABLE IF NOT EXISTS `promotion` (
  `id_promotion` int NOT NULL AUTO_INCREMENT,
  `code_promotion` varchar(10) DEFAULT NULL,
  `libelle_promotion` varchar(255) NOT NULL,
  `date_debut_promo` date DEFAULT NULL,
  `date_fin_promo` date DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  PRIMARY KEY (`id_promotion`),
  UNIQUE KEY `code_promotion` (`code_promotion`),
  KEY `FK_utilisateur_promo` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id_promotion`, `code_promotion`, `libelle_promotion`, `date_debut_promo`, `date_fin_promo`, `id_utilisateur`) VALUES
(1, 'PROMO38', 'Promo jeans', '2024-07-27', '2024-08-03', 5),
(2, 'PROMO886', 'Promo T-Shirt', '2024-07-27', '2024-08-03', 5),
(3, 'PROMO438', 'Promo Chemise', '2024-07-27', '2024-08-03', 5),
(4, 'PROMO175', 'Promo Jeans', '2024-08-03', '2024-09-03', 6);

-- --------------------------------------------------------

--
-- Structure de la table `recette_journaliere`
--

DROP TABLE IF EXISTS `recette_journaliere`;
CREATE TABLE IF NOT EXISTS `recette_journaliere` (
  `id_recette` int NOT NULL AUTO_INCREMENT,
  `code_recette` varchar(10) DEFAULT NULL,
  `date_recette` date NOT NULL,
  `montant_recette` int DEFAULT NULL,
  `banque` int NOT NULL,
  `caisse` int NOT NULL,
  `id_utilisateur` int DEFAULT NULL,
  PRIMARY KEY (`id_recette`),
  UNIQUE KEY `code_recette` (`code_recette`),
  KEY `fk_uts_recette` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recette_journaliere`
--

INSERT INTO `recette_journaliere` (`id_recette`, `code_recette`, `date_recette`, `montant_recette`, `banque`, `caisse`, `id_utilisateur`) VALUES
(1, 'INC101', '2024-10-01', 4000, 0, 0, 5),
(2, 'INC102', '2024-10-01', 70000, 0, 0, 5),
(3, 'INC103', '2024-10-01', 23000, 0, 0, 5),
(4, 'INC104', '2024-10-01', 23500, 0, 0, 5),
(5, 'INC105', '2024-10-01', 20000, 0, 0, 5),
(6, 'INC106', '2024-10-12', 15000, 0, 0, 5),
(8, 'INC017', '2025-01-06', 25600, 23040, 2560, 5),
(9, 'INC019', '2025-01-08', 7000, 5600, 1400, 5),
(11, 'INC0110', '2025-01-08', 8000, 6400, 1600, 5),
(12, 'INC0312', '2025-03-17', 15000, 0, 0, 10);

-- --------------------------------------------------------

--
-- Structure de la table `registre_presence`
--

DROP TABLE IF EXISTS `registre_presence`;
CREATE TABLE IF NOT EXISTS `registre_presence` (
  `id_presence` int NOT NULL AUTO_INCREMENT,
  `date_presence` date DEFAULT NULL,
  `heure_entree` time DEFAULT NULL,
  `heure_sortie` time NOT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_presence`),
  UNIQUE KEY `heure_entree` (`heure_entree`),
  KEY `FK_user` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `registre_presence`
--

INSERT INTO `registre_presence` (`id_presence`, `date_presence`, `heure_entree`, `heure_sortie`, `id_utilisateur`) VALUES
(1, '2024-08-28', '05:21:30', '00:00:00', 5),
(21, '2024-08-08', '03:20:20', '08:41:17', 5),
(23, '2024-08-28', '12:00:00', '05:56:20', 6),
(26, '2024-09-02', '16:13:09', '04:17:15', 5),
(27, '2024-09-02', '16:31:44', '10:34:03', 6),
(29, '2024-09-03', '14:53:41', '00:00:00', 5),
(30, '2024-09-04', '09:14:23', '00:00:00', 6),
(31, '2024-09-08', '21:20:47', '21:35:18', 7),
(33, '2024-09-11', '08:38:05', '00:00:00', 7),
(34, '2024-09-18', '16:42:39', '16:54:34', 6),
(35, '2024-09-21', '14:43:17', '14:43:34', 5),
(36, '2024-09-30', '23:54:32', '00:00:00', 5),
(37, '2024-10-01', '00:20:26', '00:00:00', 5),
(38, '2024-10-23', '16:02:50', '00:00:00', 6),
(39, '2024-11-12', '08:30:30', '08:30:30', 5),
(40, '2024-11-27', '05:13:24', '05:51:18', 5),
(41, '2024-11-28', '21:53:01', '00:00:00', 5),
(42, '2025-01-10', '11:46:16', '00:00:00', 5),
(43, '2025-01-17', '22:05:18', '00:00:00', 6),
(44, '2025-02-14', '20:45:12', '00:00:00', 5),
(45, '2025-02-27', '20:06:37', '00:00:00', 5),
(46, '2025-03-23', '17:58:21', '00:58:59', 5),
(47, '2025-03-26', '19:22:31', '19:23:31', 10),
(48, '2025-03-29', '05:40:47', '00:00:00', 10);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL DEFAULT '0',
  `libelle` varchar(50) NOT NULL,
  `code_role` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `libelle`, `code_role`) VALUES
(0, 'Administrateur', 'ADMIN'),
(1, 'Utilisateur simple', 'UTS');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `code_utilisateur` varchar(10) DEFAULT NULL,
  `nom_utilisateur` varchar(255) DEFAULT NULL,
  `prenom_utilisateur` varchar(255) DEFAULT NULL,
  `about` text NOT NULL,
  `job` varchar(255) NOT NULL,
  `company` varchar(100) NOT NULL,
  `adresse_utilisateur` varchar(255) DEFAULT NULL,
  `tel_utilisateur` varchar(20) DEFAULT NULL,
  `email_utilisateur` varchar(150) DEFAULT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_role` int DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email_utilisateur` (`email_utilisateur`),
  KEY `role_utilisateur` (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `code_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `about`, `job`, `company`, `adresse_utilisateur`, `tel_utilisateur`, `email_utilisateur`, `pass`, `id_role`) VALUES
(5, 'ADMIN', 'TENGEN', 'Issa T.', 'Je m\'appelle TENGEN ISSA TENGEN passionné de technologie de l\'information et de la communication auteur de plusieurs projets logiciels à mon actif notamment LogixOne un logiciel web de gestion de PME, LogixTask un logiciel de gestion des tâche quotidienne.', 'Web developper', 'Foncham & Sons', 'Ngwelle-Bonaberi', '+237 698 40 41 17', 'issatengen@outlook.com', 'admin', 0),
(6, 'UTS', 'TENGEN', 'OTTO', 'Passionate of technology ', 'Web programmer', 'Foncham And Sons', 'Ngwelle-Bonaberi', '+237 698 40 41 18', 'ottotengen@outlook.com', 'T.otto', 1),
(7, 'STG', 'Ismael', 'Issa', '', '', '', 'Douala', '680369185', 'issatengen12@gmail.com', 'admin2', 1),
(10, 'ADMIN', 'TENGEN', 'MAXWELL', 'My name is TENGEN MAXWELL I\'m a passionate of computer science and engineering', 'CTO', 'Team global', 'Douala', '680369187', 'maxwelltengen@outlook.com', 'maxwell', 0),
(13, 'USER11', 'TENGEN', 'Issa', 'Passionné du développement d\'application en particulier et de la TIC en générale, Je suis titulaire d\'une Licence en génie logiciel et ai à mon actif deux applications web de gestion fonctionnelles notamment LogixOne un logiciel de facturation per,ettant de gérer les PME et LogixTC un logiciel de gestion des taches quotidiennes et de budget', '', '', 'Chateau Bonaberi', '680369185', 'issatengen123@gmail.com', '$2y$10$IwMbJ97PQE7MN7eUSqDW.OwkUWivRZNFMKKYHQ1j0oF3xz5vXUjIq', 0),
(15, 'USER14', 'uuuu', 'iiiii', 'iiiiiiiiii', '', '', 'Chateau Bonaberi', '67202314800', 'issatengen777@outlook.com', '$2y$10$THb/wXtUekE6CWjKFi69FeNGebBreQxxF.5jGannokwJ.mj41C6sG', 0),
(16, 'USER16', 'Logix', 'Issa', 'Hi I\'m Logix👍', '', '', 'BONABERI-DOUALA', '678671841', 'maxwelltengen2@outlook.com', '$2y$10$9kdvwHqYUm87koz0vDUtlemsOfbgis.7Kc3SUsOWov7BnMYXKWcDC', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `commande_article`
--
ALTER TABLE `commande_article`
  ADD CONSTRAINT `article_commande_articl` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `commande_article_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`);

--
-- Contraintes pour la table `depense`
--
ALTER TABLE `depense`
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `commande_facture` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`);

--
-- Contraintes pour la table `ligne_promotion`
--
ALTER TABLE `ligne_promotion`
  ADD CONSTRAINT `FK_article_promo` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`),
  ADD CONSTRAINT `FK_promotion` FOREIGN KEY (`id_promotion`) REFERENCES `promotion` (`id_promotion`);

--
-- Contraintes pour la table `profile_picture`
--
ALTER TABLE `profile_picture`
  ADD CONSTRAINT `FK_profil_picture` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `FK_utilisateur_promo` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `recette_journaliere`
--
ALTER TABLE `recette_journaliere`
  ADD CONSTRAINT `fk_uts_recette` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `registre_presence`
--
ALTER TABLE `registre_presence`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `role_utilisateur` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
