-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 15 juin 2023 à 13:11
-- Version du serveur : 8.0.32
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `livreor`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `id_user` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `comment`, `id_user`, `date`) VALUES
(1, 'Super site j\'adore ', 1, '2023-06-07'),
(3, 'J\'adore !', 1, '2023-06-06'),
(4, 'SHEEEEEEEEEEESH', 2, '2023-06-06'),
(5, 'Salut à tous c\'est tritri !', 2, '2023-06-07'),
(6, 'Saliut à tous c mimi', 3, '2023-06-08'),
(7, 'S', 4, '2023-06-08'),
(8, 'Salut à tous c lassale', 4, '2023-06-08'),
(9, '', 4, '2023-06-08'),
(10, '', 4, '2023-06-08'),
(11, '', 4, '2023-06-08'),
(12, 'Salut à tous c\'est Jojo ', 1, '2023-06-09'),
(13, 'LEEEEEEEEEEEEEROYYYYYY', 8, '2023-06-15'),
(14, 'Hola\r\n', 8, '2023-06-15');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(1, 'Jojo130', '$2y$10$ZZCRc/tm1UeM6tCRjm4Rl.jDGtkruL/6/V2V9BczmoYY4.kUvYX2.'),
(2, 'Tristan', '$2y$10$4fnUjLuTtlE4Z.kvYNg8cusoE9kCzn3P5rPGIoa38JIu7UT8xniLS'),
(3, 'Michel', '$2y$10$P/uBw85V0l6m8Ma4bSpgnu/OLuJM0pGcTi2kN1kcUmmqB6eVqHLIi'),
(4, 'Tristano', '$2y$10$RjVj43ZPTt3nA861tNnmUOks/OHt.iXhQ0.kI3Gt422tDO9Df8ZU.'),
(5, 'Sysy', '$2y$10$xlhjfnKbHsrTrD90xmprDuXNVMGySBa9IWgVGRGm/loZlTeMWaUom'),
(8, 'Keiran', '$2y$10$5PFO3GuZ56tMQ.rRRpLl6ujGdL0czSfNGZEY1HvDxohYLWhlKIa4q');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
