-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 22 mars 2021 à 12:40
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
-- Structure de la table `crea_societe`
--

DROP TABLE IF EXISTS `crea_societe`;
CREATE TABLE IF NOT EXISTS `crea_societe` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name_crea` varchar(255) DEFAULT NULL,
  `email_crea` varchar(255) DEFAULT NULL,
  `password_crea` varchar(255) NOT NULL,
  `img_crea` varchar(255) NOT NULL DEFAULT 'crea.png',
  `date_crea` varchar(255) DEFAULT NULL,
  `date_crea_j` varchar(255) DEFAULT NULL,
  `date_crea_j_lettre` varchar(255) DEFAULT NULL,
  `date_crea_d` varchar(255) DEFAULT NULL,
  `date_crea_a` varchar(255) DEFAULT NULL,
  `date_crea_h` varchar(255) DEFAULT NULL,
  `date_crea_m` varchar(255) DEFAULT NULL,
  `nom_diri` varchar(255) DEFAULT NULL,
  `prenom_diri` varchar(255) DEFAULT NULL,
  `tel_diri` varchar(255) DEFAULT NULL,
  `email_diri` varchar(255) DEFAULT NULL,
  `status_crea` varchar(255) DEFAULT NULL,
  `favorite_crea` varchar(255) DEFAULT NULL,
  `new_user` varchar(255) DEFAULT NULL,
  `message_crea` varchar(255) DEFAULT NULL,
  `note_crea` varchar(255) DEFAULT NULL,
  `notification_crea` varchar(11) DEFAULT NULL,
  `notification_admin` varchar(11) NOT NULL,
  `doc_statuts` varchar(255) DEFAULT NULL,
  `doc_nomination` varchar(255) DEFAULT NULL,
  `doc_depot` varchar(255) DEFAULT NULL,
  `doc_pouvoir` varchar(255) DEFAULT NULL,
  `doc_pieceid` varchar(255) DEFAULT NULL,
  `doc_cerfaM0` varchar(255) DEFAULT NULL,
  `doc_annonce` varchar(255) DEFAULT NULL,
  `doc_cerfaMBE` varchar(255) DEFAULT NULL,
  `doc_attestation` varchar(255) DEFAULT NULL,
  `doc_justificatifss` varchar(255) DEFAULT NULL,
  `doc_justificatifd` varchar(255) DEFAULT NULL,
  `doc_xp` varchar(255) DEFAULT NULL,
  `doc_peirl` varchar(255) DEFAULT NULL,
  `doc_affectation` varchar(255) DEFAULT NULL,
  `frais` varchar(255) NOT NULL,
  `honoraire` varchar(255) NOT NULL,
  `depo_greffe` varchar(255) NOT NULL,
  `depo_cfe` varchar(255) NOT NULL,
  `article_three` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `crea_societe`
--

INSERT INTO `crea_societe` (`id`, `name_crea`, `email_crea`, `password_crea`, `img_crea`, `date_crea`, `date_crea_j`, `date_crea_j_lettre`, `date_crea_d`, `date_crea_a`, `date_crea_h`, `date_crea_m`, `nom_diri`, `prenom_diri`, `tel_diri`, `email_diri`, `status_crea`, `favorite_crea`, `new_user`, `message_crea`, `note_crea`, `notification_crea`, `notification_admin`, `doc_statuts`, `doc_nomination`, `doc_depot`, `doc_pouvoir`, `doc_pieceid`, `doc_cerfaM0`, `doc_annonce`, `doc_cerfaMBE`, `doc_attestation`, `doc_justificatifss`, `doc_justificatifd`, `doc_xp`, `doc_peirl`, `doc_affectation`, `frais`, `honoraire`, `depo_greffe`, `depo_cfe`, `article_three`) VALUES
(12, 'zae', 'test@test.com', '1234', 'crea.png', '22-02-2021', '22', 'Mon', '02', '2021', '14', '39', 'aze', 'aze', '0600000000', 'test@test.com', 'SARL', '1', 'crea_societe', 'Dossier en cours de traitement ...', '', '1', '0', '', '', '', '', 'load-cs-client-16-00-30.php', '', '', '', '', '', NULL, '', '', '', '10!yes', '100!no', 'no', '2021-03-03!yes', 'yes'),
(11, 'azeaze', '1234@123.com', '123', 'crea.png', '27-01-2021', '27', 'Wed', '01', '2021', '18', '15', 'hommex', 'hh', '123123', '1234@123.com', 'SARL', '', 'crea_societe', 'Dossier en cours de traitement ...', '', NULL, '0', '', '', '', '', 'Numeros INE-13-45-59.txt', 'Firefox-16-03-57.lnk', '', '', '', '', NULL, '', '', '', '', '', 'no', '', ''),
(10, 'azeaze', 'karim@gmail.com', '1234', 'crea.png', '25-01-2021', '25', 'Mon', '01', '2021', '11', '45', 'Karim', 'aze', '0600000000', 'karim@gmail.com', 'SASU', '', 'crea_societe', 'Dossier en cours de traitement ...', '', NULL, '0', 'boutique-13-41-27.php', 'index-13-41-35.php', 'succeed.-13-42-04.html', 'partner-13-41-46.php', 'contact-reponse-11-17-44.sql', '_.coqpix.com_private_key-11-19-48.key', 'contact-admin-13-42-25.php', 'resume_ligne_commande_install_glpi-11-22-59.txt', 'about-13-41-55.php', 'boutique-13-41-14.php', NULL, '', '', '', '100!no', '23!yes', '2021-03-10!yes', '2021-03-10!yes', 'yes'),
(9, 'Scream', 'Scream@Scream.com', '1234', 'crea.png', '16-01-2021', '16', 'Sat', '01', '2021', '22', '18', 'Scream', 'Scream', '123123', 'Scream@Scream.com', 'EI', '', 'crea_societe', 'Dossier en cours de traitement ...', '', '2', '0', '', '', '', 'email-11-45-51-16-41-05.txt', 'about-12-04-11.php', 'email-11-45-51.txt', '', '', 'email-11-45-51-16-57-06.txt', '', 'Numeros INE-16-38-53.txt', 'Nuage-16-38-44.txt', 'lien envato-16-39-16.txt', 'Numeros INE-16-40-47.txt', '100!yes', '0!yes', '2021-02-24!yes', '2021-02-23!yes', ''),
(13, 'Youness tech', 'youness@youness.com', '1234', 'crea.png', '03-03-2021', '03', 'Wed', '03', '2021', '15', '17', 'Haddou', 'Youness', '0600000000', 'youness@youness.com', 'SAS', '', 'crea_societe', 'Dossier en cours de traitement ...', '', NULL, '0', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '131!yes', '123!yes', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
