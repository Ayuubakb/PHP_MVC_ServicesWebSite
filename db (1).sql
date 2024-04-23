-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 avr. 2024 à 18:23
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `LastName` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Telephone` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `LastName`, `FirstName`, `Address`, `Telephone`, `image`, `email`) VALUES
(1, 'Akoubri', 'Ayoubos', 'Marrakechh', '0700824100', NULL, NULL),
(2, 'jone', 'doe', 'england', '0662202873', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message` varchar(255) DEFAULT NULL,
  `Rating` float DEFAULT NULL,
  `Date_post` date DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `Id_R` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Id_R` (`Id_R`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `message`, `Rating`, `Date_post`, `publisher`, `published`, `Id_R`) VALUES
(1, 'Very Good', 5, '2024-04-20', 'client', 1, 1),
(2, 'Pas mal', 3, '2024-04-20', 'partenaire', 1, 1),
(3, 'I LIKED IT', 4, '2024-04-21', 'client', 0, 2),
(4, 'GOOD JOB', 4, '2024-04-21', 'partenaire', 1, 3),
(5, 'I recommend it', 5, '2024-04-21', 'client', 1, 3),
(6, 'Very Good', 5, '2024-04-20', 'client', 1, 1),
(7, 'Excellent Client', 5, '2024-04-20', 'partenaire', 1, 1),
(8, 'I LIKED IT', 4, '2024-04-21', 'client', 0, 2),
(9, 'GOOD JOB', 4, '2024-04-21', 'partenaire', 1, 3),
(10, 'I recommend it', 5, '2024-04-21', 'client', 1, 3),
(11, 'Very Good', 5, '2024-04-20', 'client', 1, 1),
(12, 'Client precis', 4, '2024-04-20', 'partenaire', 1, 1),
(13, 'I LIKED IT', 4, '2024-04-21', 'client', 0, 2),
(14, 'GOOD JOB', 4, '2024-04-21', 'partenaire', 1, 3),
(15, 'I recommend it', 5, '2024-04-21', 'client', 1, 3),
(16, 'Very Good', 5, '2024-04-20', 'client', 1, 1),
(17, 'Mauvais Traitement', 1, '2024-04-20', 'partenaire', 1, 1),
(18, 'I LIKED IT', 4, '2024-04-21', 'client', 0, 2),
(19, 'GOOD JOB', 4, '2024-04-21', 'partenaire', 1, 3),
(20, 'I recommend it', 5, '2024-04-21', 'client', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

DROP TABLE IF EXISTS `partenaire`;
CREATE TABLE IF NOT EXISTS `partenaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `LastName` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `Metier` varchar(255) DEFAULT NULL,
  `Ville` varchar(255) DEFAULT NULL,
  `Creneaux` varchar(255) DEFAULT NULL,
  `YearExperience` int DEFAULT NULL,
  `Note` float DEFAULT NULL,
  `Nbr_commande` int DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Telephone` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `partenaire`
--

INSERT INTO `partenaire` (`id`, `LastName`, `FirstName`, `Metier`, `Ville`, `Creneaux`, `YearExperience`, `Note`, `Nbr_commande`, `Email`, `Telephone`, `image`) VALUES
(1, 'lionel', 'messi', 'menage', 'Marrakech', NULL, 5, 3, 2, 'lionel@gmail.com', '0600284520', NULL),
(2, 'cristiano', 'ronaldo', 'jardinage', 'marrakech', NULL, 12, 5, 15, 'cristiano@gmail.com', '0500241222', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reclamations`
--

DROP TABLE IF EXISTS `reclamations`;
CREATE TABLE IF NOT EXISTS `reclamations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `dateReclamations` int NOT NULL,
  `status` int NOT NULL,
  `Id_T` int NOT NULL,
  `motif` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Id_S` int DEFAULT NULL,
  `Id_C` int DEFAULT NULL,
  `Date_reserv` date DEFAULT NULL,
  `Statuts` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Id_S` (`Id_S`),
  KEY `Id_C` (`Id_C`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `Id_S`, `Id_C`, `Date_reserv`, `Statuts`) VALUES
(1, 1, 1, '2024-04-19', 0),
(2, 2, 1, '2024-04-20', 1),
(3, 2, 2, '2024-04-21', 0),
(4, 1, 2, '2024-04-22', 0),
(5, 1, 1, '2024-04-19', 0),
(6, 1, 1, '2024-04-19', 0),
(7, 2, 1, '2024-04-20', 1),
(8, 2, 2, '2024-04-21', 0),
(9, 1, 2, '2024-04-22', 0),
(10, 1, 1, '2024-04-19', 0);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Id_P` int DEFAULT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Prix` float DEFAULT NULL,
  `Note` float DEFAULT NULL,
  `Nbr_commande` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `sousCategorie` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Id_P` (`Id_P`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `Id_P`, `Nom`, `Description`, `Prix`, `Note`, `Nbr_commande`, `image`, `categorie`, `sousCategorie`) VALUES
(1, 1, 'Nettoyage general', 'nettoyer bien votre maison', 150, 4, 1, NULL, NULL, NULL),
(2, 1, 'nettoyage de canape', 'nettoyer votre canape', 200, 2, 2, NULL, NULL, NULL),
(3, 2, 'Entretien de Gazon et Pelouse', 'Prendre soin de votre jardin', 100, 5, 12, NULL, NULL, NULL),
(4, 2, 'Traitement de jardin', 'prendre soin de tous votre jardin', 250, 5, 3, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
