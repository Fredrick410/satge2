-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 10 mai 2021 à 13:43
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `u243663731_`
--

-- --------------------------------------------------------

--
-- Structure de la table `task_sociale`
--

DROP TABLE IF EXISTS `task_sociale`;
CREATE TABLE IF NOT EXISTS `task_sociale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_task` varchar(255) NOT NULL,
  `favo_task` varchar(255) NOT NULL DEFAULT 'no',
  `dte_crea` varchar(255) NOT NULL,
  `dte_echeance` varchar(255) NOT NULL,
  `pour_task` varchar(255) NOT NULL,
  `statut_task` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
