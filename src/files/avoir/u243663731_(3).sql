-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 10 mai 2021 à 08:50
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
-- Structure de la table `acte`
--

DROP TABLE IF EXISTS `acte`;
CREATE TABLE IF NOT EXISTS `acte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_entreprise` varchar(25) NOT NULL,
  `tel_entreprise` varchar(255) NOT NULL,
  `email_entreprise` varchar(255) NOT NULL,
  `one` varchar(11) DEFAULT NULL,
  `verif_one` varchar(255) NOT NULL,
  `two` varchar(11) DEFAULT NULL,
  `three` varchar(11) DEFAULT NULL,
  `four` varchar(11) DEFAULT NULL,
  `five` varchar(11) DEFAULT NULL,
  `six` varchar(11) DEFAULT NULL,
  `seven` varchar(11) DEFAULT NULL,
  `eight` varchar(11) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `dte` varchar(255) NOT NULL,
  `forme` varchar(255) NOT NULL,
  `progression` int(255) NOT NULL,
  `frais` varchar(255) NOT NULL DEFAULT '0!no',
  `honoraire` varchar(255) NOT NULL DEFAULT '0!no',
  `depo_greffe` varchar(255) NOT NULL DEFAULT 'no',
  `depo_cfe` varchar(255) NOT NULL DEFAULT 'no',
  `article_three` varchar(255) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acte`
--

INSERT INTO `acte` (`id`, `name_entreprise`, `tel_entreprise`, `email_entreprise`, `one`, `verif_one`, `two`, `three`, `four`, `five`, `six`, `seven`, `eight`, `code`, `dte`, `forme`, `progression`, `frais`, `honoraire`, `depo_greffe`, `depo_cfe`, `article_three`) VALUES
(35, 'antoimmo', '06.00.00.00.00', 'anto@gmail.com', 'on', '&verif_one=off&', 'on', 'off', 'off', 'off', 'off', 'off', 'off', 'kc6HPiQ7su', '25/03/2021', 'morale', 38, '0!no', '0!no', '', '', 'no'),
(34, 'iskimmo', '123', '123@123.com', 'off', '&verif_one=off&', 'off', 'off', 'on', 'off', 'off', 'off', 'off', 'h7fL8y897Y', '25/03/2021', 'morale', 75, '0!no', '0!no', '', '', 'no'),
(36, 'iskimmo', '123', '123@123.com', 'off', '&verif_one=off&', 'on', 'off', 'off', 'off', 'off', 'off', 'off', 'si6tXOThH1', '25/03/2021', 'morale', 17, '0!no', '0!no', '', '', 'no'),
(37, 'iskimmo', '123', '123@123.com', 'off', '&verif_one=off&', 'off', 'off', 'off', 'on', 'off', 'off', 'off', 'rdUD93BB1j', '30/03/2021', 'morale', 100, '97!yes', '153!yes', '2021-03-30!yes', '2021-03-18!yes', 'yes'),
(38, 'CHUPACHUPS', '0600000', 'CHUPA@GMAIL.com', 'on', '&verif_one=off&', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'Y9L6m430cd', '30/03/2021', 'morale', 100, '10!no', '10!yes', '2021-03-17!yes', '2021-03-03!yes', 'yes'),
(39, 'iskimmo', '123', '123@123.com', 'off', '&verif_one=off&', 'off', 'off', 'off', 'off', 'off', 'off', 'on', 'okhhEAFBsA', '30/03/2021', 'morale', 0, '10!yes', '10!no', 'no', 'no', 'no'),
(40, 'iskimmo', '123', '123@123.com', '', '', '', '', '', '', '', '', NULL, 'MZVUajclZ1', '30/03/2021', '', 0, '0!no', '0!no', 'no', 'no', 'no'),
(41, 'Krougie', '0651089247', '12@EE.com', 'off', '&verif_one=off&', 'on', 'off', 'off', 'off', 'off', 'off', 'off', 'iXXdlmaO70', '01/04/2021', 'morale', 17, '0!yes', '100!yes', 'no', 'no', 'no'),
(42, 'antoimmo', '06.00.00.00.00', 'anto@gmail.com', '', '', '', '', '', '', '', '', NULL, 'Ic83kFiBjd', '06/04/2021', '', 0, '0!no', '0!no', 'no', 'no', 'no'),
(43, 'antoimmo', '06.00.00.00.00', 'anto@gmail.com', '', '', '', '', '', '', '', '', NULL, '2EspJi3UbK', '26/04/2021', '', 0, '0!no', '0!no', 'no', 'no', 'no'),
(44, 'antoimmo', '06.00.00.00.00', 'anto@gmail.com', '', '', '', '', '', '', '', '', NULL, 'pWsbJvArY8', '28/04/2021', '', 0, '0!no', '0!no', 'no', 'no', 'no'),
(45, 'antoimmo', '06.00.00.00.00', 'anto@gmail.com', '', '', '', '', '', '', '', '', NULL, 'G2BOJhQSx0', '29/04/2021', '', 0, '0!no', '0!no', 'no', 'no', 'no'),
(46, 'antoimmo', '06.00.00.00.00', 'anto@gmail.com', 'off', '&verif_one=off&', 'off', 'off', 'on', 'off', 'off', 'off', 'off', 'u6r6VtiDK9', '07/05/2021', 'morale', 0, '0!no', '0!no', 'no', 'no', 'no');

-- --------------------------------------------------------

--
-- Structure de la table `acte_doc`
--

DROP TABLE IF EXISTS `acte_doc`;
CREATE TABLE IF NOT EXISTS `acte_doc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_age` varchar(255) NOT NULL,
  `doc_edit` varchar(255) NOT NULL,
  `doc_acte` varchar(255) NOT NULL,
  `doc_M0` varchar(255) NOT NULL,
  `doc_MBE` varchar(255) NOT NULL,
  `doc_M3` varchar(255) NOT NULL,
  `doc_jal` varchar(255) NOT NULL,
  `doc_attestation` varchar(255) NOT NULL,
  `doc_pieceid` varchar(255) NOT NULL,
  `doc_justificatif` varchar(255) NOT NULL,
  `doc_cerfaM2` varchar(255) NOT NULL,
  `doc_tns` varchar(255) NOT NULL,
  `doc_rcsas` varchar(255) NOT NULL,
  `doc_cerfaAC` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acte_doc`
--

INSERT INTO `acte_doc` (`id`, `doc_age`, `doc_edit`, `doc_acte`, `doc_M0`, `doc_MBE`, `doc_M3`, `doc_jal`, `doc_attestation`, `doc_pieceid`, `doc_justificatif`, `doc_cerfaM2`, `doc_tns`, `doc_rcsas`, `doc_cerfaAC`, `code`) VALUES
(26, 'RAPPORT DE BUG-11-48-06.txt', 'RAPPORT DE BUG-11-48-12.txt', 'RAPPORT DE BUG-11-48-19.txt', 'off', 'RAPPORT DE BUG-11-48-33.txt', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'off', 'Y9L6m430cd'),
(25, 'RAPPORT DE BUG-10-35-56.txt', 'RAPPORT DE BUG-10-36-05.txt', 'off', 'off', 'off', 'off', 'RAPPORT DE BUG-10-36-14.txt', 'off', 'off', 'off', 'RAPPORT DE BUG-10-36-22.txt', 'RAPPORT DE BUG-10-36-30.txt', 'RAPPORT DE BUG-10-36-39.txt', 'off', 'rdUD93BB1j'),
(24, 'astro2-12-57-57.gif', 'on', 'off', 'off', 'off', 'on', 'on', 'on', 'on', 'off', 'off', 'off', 'off', 'off', 'si6tXOThH1'),
(23, 'RAPPORT BUG-13-03-45.txt', 'on', 'astro2-11-14-08.gif', 'off', 'RAPPORT BUG-13-04-57.txt', 'on', 'on', 'on', 'on', 'off', 'off', 'off', 'off', 'off', 'kc6HPiQ7su'),
(22, 'on', 'astro1-10-38-50.gif', 'off', 'off', 'off', 'off', 'astro4-10-39-07.gif', 'off', 'off', 'off', 'astro1-10-42-19.gif', 'off', 'off', 'off', 'h7fL8y897Y'),
(27, 'off', 'off', 'off', 'off', 'off', 'off', 'on', 'off', 'off', 'off', 'on', 'off', 'off', 'off', 'okhhEAFBsA'),
(28, 'on', 'on', 'off', 'off', 'off', 'on', 'on', 'on', 'RAPPORT DE BUG-19-01-01.txt', 'off', 'off', 'off', 'off', 'off', 'iXXdlmaO70'),
(29, 'on', 'on', 'off', 'off', 'off', 'off', 'on', 'off', 'off', 'off', 'on', 'off', 'off', 'off', 'u6r6VtiDK9');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameentreprise` varchar(255) NOT NULL DEFAULT 'Nom de l''entreprise',
  `passwordentreprise` varchar(255) DEFAULT NULL,
  `numerosssiret` varchar(255) DEFAULT '000000',
  `iban_entreprise` varchar(255) DEFAULT NULL,
  `adresseentreprise` varchar(255) DEFAULT 'Adresse de l''entreprise',
  `emailentreprise` varchar(255) NOT NULL DEFAULT 'Monentreprise@entreprise.com',
  `telentreprise` varchar(255) NOT NULL DEFAULT '06.00.00.00.00',
  `img_entreprise` varchar(255) DEFAULT 'coqpix.png',
  `link_website` varchar(255) NOT NULL DEFAULT 'www.google.com',
  `datecreation` varchar(255) DEFAULT NULL,
  `pays_entreprise` varchar(255) NOT NULL DEFAULT 'France',
  `desc_entreprise` varchar(255) DEFAULT NULL,
  `new_user` varchar(255) NOT NULL DEFAULT 'Désactiver',
  `nom_diri` varchar(255) NOT NULL DEFAULT 'Mon nom',
  `prenom_diri` varchar(255) NOT NULL DEFAULT 'Mon prenom',
  `adresse_diri` varchar(255) NOT NULL DEFAULT 'Mon adresse',
  `tel_diri` varchar(255) NOT NULL DEFAULT '06.00.00.00.00',
  `email_diri` varchar(255) NOT NULL DEFAULT 'monemail@mail.com',
  `perms` varchar(255) NOT NULL DEFAULT 'semiall',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nameentreprise`, `passwordentreprise`, `numerosssiret`, `iban_entreprise`, `adresseentreprise`, `emailentreprise`, `telentreprise`, `img_entreprise`, `link_website`, `datecreation`, `pays_entreprise`, `desc_entreprise`, `new_user`, `nom_diri`, `prenom_diri`, `adresse_diri`, `tel_diri`, `email_diri`, `perms`) VALUES
(1, 'Auditactionplus', 'password', '', '', '8 Ter Boulevard Bonrepos, 31000 Toulouse', 'contact@auditactionplus.com', '05 34 26 08 43', '', 'auditaction.com', '', 'France', 'Cabinet d\'expert comptable', 'nonnew', 'Nomkarim', 'Karim', '', '0661931316', 'karimmail@gmail.com', 'all');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` varchar(255) NOT NULL,
  `referencearticle` varchar(255) NOT NULL,
  `prixvente` varchar(255) NOT NULL,
  `coutachat` varchar(255) NOT NULL,
  `tvavente` varchar(255) NOT NULL,
  `tvaachat` varchar(255) NOT NULL,
  `umesure` varchar(255) NOT NULL,
  `typ` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `article`, `referencearticle`, `prixvente`, `coutachat`, `tvavente`, `tvaachat`, `umesure`, `typ`, `id_session`) VALUES
(1, 'Gratuit', '', '0', '', '20', '20', '', 'Ventes', 2),
(2, 'Article N°0', 'E0042', '10', '5', '20', '20', 'L', 'Ventes et Achats', 2);

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` varchar(255) NOT NULL,
  `referencearticle` varchar(255) NOT NULL,
  `cout` varchar(255) NOT NULL,
  `quantite` varchar(255) NOT NULL,
  `umesure` varchar(255) DEFAULT NULL,
  `tva` varchar(255) NOT NULL,
  `remise` varchar(255) NOT NULL,
  `numeros` varchar(255) NOT NULL,
  `typ` varchar(255) NOT NULL,
  `id_session` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `article`, `referencearticle`, `cout`, `quantite`, `umesure`, `tva`, `remise`, `numeros`, `typ`, `id_session`) VALUES
(60, 'Article N°0', 'E0042', '10', '1', 'L', '20 %', '0 %', '001', 'facturevente', 2),
(61, 'Article N°0', 'E0042', '10', '1', NULL, '20 %', '0 %', '001', 'avoirvente', 2);

-- --------------------------------------------------------

--
-- Structure de la table `attestation_fiscale`
--

DROP TABLE IF EXISTS `attestation_fiscale`;
CREATE TABLE IF NOT EXISTS `attestation_fiscale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_entreprise` varchar(255) NOT NULL,
  `date_demande` varchar(255) NOT NULL,
  `date_donner` varchar(255) NOT NULL,
  `statut_attestation` varchar(255) NOT NULL,
  `message_attestation` varchar(255) NOT NULL,
  `files_attestation` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `attestation_fiscale`
--

INSERT INTO `attestation_fiscale` (`id`, `name_entreprise`, `date_demande`, `date_donner`, `statut_attestation`, `message_attestation`, `files_attestation`, `id_session`) VALUES
(7, 'iskimmo', '28/04/2021', '', 'En cours', '', '', 2),
(6, 'iskimmo', '24/04/2021', '', 'En cours', '', '', 2);

-- --------------------------------------------------------

--
-- Structure de la table `attestation_sociale`
--

DROP TABLE IF EXISTS `attestation_sociale`;
CREATE TABLE IF NOT EXISTS `attestation_sociale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_entreprise` varchar(255) NOT NULL,
  `date_demande` varchar(255) NOT NULL,
  `date_donner` varchar(255) NOT NULL,
  `type_attestation` varchar(255) NOT NULL,
  `statut_attestation` varchar(255) NOT NULL DEFAULT 'en cours',
  `message_attestation` varchar(255) NOT NULL,
  `files_attestation` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `attestation_sociale`
--

INSERT INTO `attestation_sociale` (`id`, `name_entreprise`, `date_demande`, `date_donner`, `type_attestation`, `statut_attestation`, `message_attestation`, `files_attestation`, `id_session`) VALUES
(12, 'iskimmo', '24/04/2021', '', 'CIBTP', 'En cours', '', '', 2),
(10, 'iskimmo', '19/04/2021', '19/04/2021', 'URSSAF/MSA', 'Terminée', '', 'Sans titre-9-31-07.png', 2),
(11, 'iskimmo', '21/04/2021', '21/04/2021', 'PRO BTP', 'Terminée', '', 'Sans titre-9-39-41.png', 2);

-- --------------------------------------------------------

--
-- Structure de la table `avoir`
--

DROP TABLE IF EXISTS `avoir`;
CREATE TABLE IF NOT EXISTS `avoir` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `numerosavoir` varchar(255) NOT NULL,
  `dte` varchar(255) NOT NULL,
  `dateecheance` varchar(255) NOT NULL,
  `nomproduit` varchar(255) NOT NULL,
  `avoirpour` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `departement` varchar(255) NOT NULL,
  `modalite` varchar(255) NOT NULL,
  `monnaie` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `status_avoir` varchar(255) NOT NULL,
  `status_color` varchar(255) NOT NULL,
  `etiquette` varchar(255) NOT NULL,
  `numerosfacture` varchar(255) NOT NULL,
  `id_session` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avoir`
--

INSERT INTO `avoir` (`id`, `numerosavoir`, `dte`, `dateecheance`, `nomproduit`, `avoirpour`, `adresse`, `email`, `tel`, `departement`, `modalite`, `monnaie`, `note`, `status_avoir`, `status_color`, `etiquette`, `numerosfacture`, `id_session`) VALUES
(2, '002', '2020-12-05', '2020-12-15', '1232', 'Google', '&amp;é&quot;&amp;é&quot;', 'quot@gmail.com', '&amp;é&quot;&amp;é&quot;', '31100', '1', '€', '112', 'NON PAYE', 'badge badge-light-danger badge-pill', 'Inconnue', '1', 1),
(3, '008', '2020-12-05', '2020-12-15', '1232', 'Google', '&amp;é&quot;&amp;é&quot;', 'quot@gmail.com', '&amp;é&quot;&amp;é&quot;', '31100', '1', '€', '112', 'NON PAYE', 'badge badge-light-danger badge-pill', 'Inconnue', '1', 1),
(5, '001', '00-00-00', '', 'TEST', '123', '12334', '123@123.com', '123', '31100', 'CB', '€', 'Pas de commentaire', 'NON PAYE', 'badge badge-light-danger badge-pill', 'Inconnue', '34', 2);

-- --------------------------------------------------------

--
-- Structure de la table `bilan`
--

DROP TABLE IF EXISTS `bilan`;
CREATE TABLE IF NOT EXISTS `bilan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_bilan` varchar(255) NOT NULL,
  `dte` varchar(255) NOT NULL,
  `date_j` varchar(255) NOT NULL,
  `date_m` varchar(255) NOT NULL,
  `date_a` varchar(255) NOT NULL,
  `files_bilan` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bilan`
--

INSERT INTO `bilan` (`id`, `email_bilan`, `dte`, `date_j`, `date_m`, `date_a`, `files_bilan`, `id_session`) VALUES
(2, '', '28/04/2021', '28', '04', '2021', 'Numeros INE-11-15-50.txt', 1),
(5, '123@123.com', '1/12/2020', '1', '12', '2020', 'Numeros INE-11-24-31.txt', 2),
(6, '123@123.com', '1/12/2016', '1', '12', '2020', 'Numeros INE-13-37-06.txt', 4);

-- --------------------------------------------------------

--
-- Structure de la table `bon`
--

DROP TABLE IF EXISTS `bon`;
CREATE TABLE IF NOT EXISTS `bon` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `numerosbon` varchar(255) NOT NULL,
  `dte` varchar(255) NOT NULL,
  `dateecheance` varchar(255) NOT NULL,
  `nomproduit` varchar(255) NOT NULL,
  `bonpour` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `departement` varchar(255) NOT NULL,
  `modalite` varchar(255) NOT NULL,
  `monnaie` varchar(50) NOT NULL,
  `note` varchar(255) NOT NULL,
  `status_bon` varchar(255) NOT NULL,
  `status_color` varchar(255) NOT NULL,
  `etiquette` varchar(255) NOT NULL,
  `id_session` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bon`
--

INSERT INTO `bon` (`id`, `numerosbon`, `dte`, `dateecheance`, `nomproduit`, `bonpour`, `adresse`, `email`, `tel`, `departement`, `modalite`, `monnaie`, `note`, `status_bon`, `status_color`, `etiquette`, `id_session`) VALUES
(1, '999', '00-00-00', '', 'nom produit', 'Facture pour', 'Adresse', 'email@email.com', '06.00.00.00.00', '31100', 'CB', '€', 'Pas de commentaire', 'NON PAYE', 'badge badge-light-danger badge-pill', 'Inconnue', 1);

-- --------------------------------------------------------

--
-- Structure de la table `bon_commande`
--

DROP TABLE IF EXISTS `bon_commande`;
CREATE TABLE IF NOT EXISTS `bon_commande` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `numerosbon` varchar(255) NOT NULL,
  `dte` varchar(255) NOT NULL,
  `dateecheance` varchar(255) NOT NULL,
  `nomproduit` varchar(255) NOT NULL,
  `bonpour` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `departement` varchar(255) NOT NULL,
  `modalite` varchar(255) NOT NULL,
  `monnaie` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `status_bon` varchar(255) NOT NULL,
  `status_color` varchar(255) NOT NULL,
  `etiquette` varchar(255) NOT NULL,
  `id_session` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bon_commande`
--

INSERT INTO `bon_commande` (`id`, `numerosbon`, `dte`, `dateecheance`, `nomproduit`, `bonpour`, `adresse`, `email`, `tel`, `departement`, `modalite`, `monnaie`, `note`, `status_bon`, `status_color`, `etiquette`, `id_session`) VALUES
(1, '006', '00-00-00', '', 'nom produit', 'Facture pour', 'Adresse', 'email@email.com', '06.00.00.00.00', '31100', 'CB', '€', 'Pas de commentaire', 'NON PAYE', 'badge badge-light-danger badge-pill', 'Inconnue', 1);

-- --------------------------------------------------------

--
-- Structure de la table `bookmark`
--

DROP TABLE IF EXISTS `bookmark`;
CREATE TABLE IF NOT EXISTS `bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_search` varchar(255) NOT NULL,
  `url_search` varchar(255) NOT NULL,
  `description_search` varchar(255) NOT NULL,
  `date_search` varchar(255) NOT NULL,
  `etiquette_search` varchar(255) NOT NULL,
  `favorite_search` varchar(255) NOT NULL,
  `statut_search` varchar(255) NOT NULL,
  `img_search` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bookmark`
--

INSERT INTO `bookmark` (`id`, `name_search`, `url_search`, `description_search`, `date_search`, `etiquette_search`, `favorite_search`, `statut_search`, `img_search`, `id_session`) VALUES
(1, 'Coqpix', 'http://localhost/html/ltr/coqpix/bookmark.php#', 'un descrp', '01/04/2021', 'Mes recherches', 'yes', 'En cours', 'lightgallry/01.jpg', 2),
(3, 'test', 'coqpix.com', 'ae', '01/04/2021', 'o', 'no', 'En cours', 'lightgallry/01.jpg', 2),
(4, 'Fonctionnement Woo commerce', 'https://wpformation.com/installer-configurer-utiliser-woocommerce/', 'Comment integrer rapidement Woo commerce', '01/04/2021', 'Woo Commerce', 'yes', 'En cours', 'lightgallry/01.jpg', 2),
(5, 'aze', 'azeaze', 'aze', '06/04/2021', 'Woo Commerce', 'no', 'En cours', 'lightgallry/01.jpg', 2),
(6, 'aze', 'www.toufik.com', 'aze', '21/04/2021', 'Test', 'no', 'En cours', 'lightgallry/01.jpg', 2),
(7, 'Youtube', 'www.youtube.com', 'aze', '24/04/2021', 'Woo Commerce', 'yes', 'En cours', 'lightgallry/01.jpg', 2),
(9, 'test', 'www.muskane.com', 'test', '04/05/2021', 'Inconnue', 'yes', 'En cours', 'lightgallry/01.jpg', 2);

-- --------------------------------------------------------

--
-- Structure de la table `bulletin_salaire`
--

DROP TABLE IF EXISTS `bulletin_salaire`;
CREATE TABLE IF NOT EXISTS `bulletin_salaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_entreprise` varchar(255) NOT NULL,
  `name_membre` varchar(255) NOT NULL,
  `date_demande` varchar(255) NOT NULL,
  `date_donner` varchar(255) NOT NULL,
  `statut_bulletin` varchar(255) NOT NULL,
  `message_bulletin` varchar(255) NOT NULL,
  `files_bulletin` varchar(255) NOT NULL,
  `secteur_activité` varchar(255) NOT NULL,
  `salairedebase` varchar(255) NOT NULL,
  `heuresupp_tp` varchar(255) NOT NULL,
  `heurecompl_tpartiel` varchar(255) NOT NULL,
  `heuredenuit` varchar(255) NOT NULL,
  `repas` varchar(255) NOT NULL,
  `indemnitesdet_1A` varchar(255) NOT NULL,
  `indemnitesdet_1B` varchar(255) NOT NULL,
  `indemnitesdet_2` varchar(255) NOT NULL,
  `indemnitesdet_3` varchar(255) NOT NULL,
  `indemnitesdet_4` varchar(255) NOT NULL,
  `indemnitesdet_5` varchar(255) NOT NULL,
  `indemnitesdetr_1A` varchar(255) NOT NULL,
  `indemnitesdetr_1B` varchar(255) NOT NULL,
  `indemnitesdetr_2` varchar(255) NOT NULL,
  `indemnitesdetr_3` varchar(255) NOT NULL,
  `indemnitesdetr_4` varchar(255) NOT NULL,
  `indemnitesdetr_5` varchar(255) NOT NULL,
  `primes` varchar(255) NOT NULL,
  `remboursementtransport` varchar(255) NOT NULL,
  `congespayes` varchar(255) NOT NULL,
  `congessanssolde` varchar(255) NOT NULL,
  `congesmaternite` varchar(255) NOT NULL,
  `congespaternite` varchar(255) NOT NULL,
  `avantagenature` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `calculs`
--

DROP TABLE IF EXISTS `calculs`;
CREATE TABLE IF NOT EXISTS `calculs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `facture_nb` int(255) DEFAULT NULL,
  `facture_all` decimal(65,2) DEFAULT NULL,
  `facture_all_achat` decimal(65,2) DEFAULT NULL,
  `devis_all` decimal(65,2) DEFAULT NULL,
  `lastdte` varchar(255) NOT NULL,
  `nb_facture_achats` int(100) DEFAULT NULL,
  `nb_facture_ventes` int(100) DEFAULT NULL,
  `nb_note` int(100) DEFAULT NULL,
  `nb_avoir` int(100) DEFAULT NULL,
  `nb_caisse` int(100) DEFAULT NULL,
  `nb_banque` int(100) DEFAULT NULL,
  `size_achats` int(255) DEFAULT NULL,
  `size_ventes` int(255) DEFAULT NULL,
  `size_note` int(255) DEFAULT NULL,
  `size_avoir` int(255) DEFAULT NULL,
  `size_caisse` int(255) DEFAULT NULL,
  `size_banque` int(255) DEFAULT NULL,
  `id_session` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `calculs`
--

INSERT INTO `calculs` (`id`, `facture_nb`, `facture_all`, `facture_all_achat`, `devis_all`, `lastdte`, `nb_facture_achats`, `nb_facture_ventes`, `nb_note`, `nb_avoir`, `nb_caisse`, `nb_banque`, `size_achats`, `size_ventes`, `size_note`, `size_avoir`, `size_caisse`, `size_banque`, `id_session`) VALUES
(5, 0, '0.00', '0.00', '0.00', '21-04-2021', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 1, '10.00', '0.00', '284.00', '01-05-2021', 1, 2, 0, 0, 0, 1, 43144, 2888, 0, 0, 0, 285, 2),
(4, 0, '0.00', '0.00', '0.00', '05-02-2021', 1, 2, 0, 0, 0, 1, 43144, 2888, 0, 0, 0, 285, 0);

-- --------------------------------------------------------

--
-- Structure de la table `charge`
--

DROP TABLE IF EXISTS `charge`;
CREATE TABLE IF NOT EXISTS `charge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_charge` varchar(255) NOT NULL,
  `dte` varchar(255) NOT NULL,
  `date_j` varchar(255) NOT NULL,
  `date_m` varchar(255) NOT NULL,
  `date_a` varchar(255) NOT NULL,
  `files_charge` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `charge`
--

INSERT INTO `charge` (`id`, `email_charge`, `dte`, `date_j`, `date_m`, `date_a`, `files_charge`, `id_session`) VALUES
(1, '123@123.com', '23/03/2021', '23', '03', '2021', 'Rapport de BUG-12-38-35.txt', 2);

-- --------------------------------------------------------

--
-- Structure de la table `chat_crea`
--

DROP TABLE IF EXISTS `chat_crea`;
CREATE TABLE IF NOT EXISTS `chat_crea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destination` varchar(255) DEFAULT NULL,
  `date_crea` varchar(255) DEFAULT NULL,
  `date_h` varchar(255) DEFAULT NULL,
  `date_m` varchar(255) DEFAULT NULL,
  `message_crea` varchar(255) DEFAULT NULL,
  `you` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chat_crea`
--

INSERT INTO `chat_crea` (`id`, `destination`, `date_crea`, `date_h`, `date_m`, `message_crea`, `you`) VALUES
(1, 'coqpixpromoimmo', '06-01-2021', '13', '06', 'Bonjour', 'promoimmo'),
(2, 'coqpixpromoimmo', '06-01-2021', '13', '07', 'Bonjour audit action plus', 'coqpix'),
(3, 'coqpixpromoimmo', '06-01-2021', '13', '07', 'J\'ai une question à vous posez ?', 'promoimmo'),
(4, 'promoimmo', '06-01-2021', '15', '44', 'J\'ai une question', 'promoimmo'),
(5, 'promoimmo', '06-01-2021', '15', '44', 'azaze', 'coqpix'),
(6, 'promoimmo', '07-01-2021', '11', '59', '123', 'promoimmo'),
(7, 'promoimmo', '07-01-2021', '11', '59', 'AZE', 'coqpix'),
(8, 'promoimmo', '08-01-2021', '18', '29', 'BONJOUR', 'promoimmo'),
(9, 'promoimmo', '08-01-2021', '18', '29', 'ookok', 'coqpix'),
(10, 'Smart build', '11-01-2021', '9', '30', 'test morale', 'coqpix'),
(11, 'Smart build', '11-01-2021', '9', '38', 'test', 'coqpix'),
(12, 'Smart build', '11-01-2021', '11', '44', 'je test', 'Smart build'),
(13, 'Smart build', '11-01-2021', '11', '55', 'retest', 'coqpix'),
(14, 'Smart build', '11-01-2021', '12', '22', 'Par exemple', 'Smart build'),
(15, 'Smart build', '11-01-2021', '12', '22', 'je re test', 'Smart build'),
(16, 'Smart build', '11-01-2021', '12', '23', 'ouou', 'Smart build'),
(17, 'Smart build', '11-01-2021', '12', '25', 'test', 'Smart build'),
(18, 'coqpixSmart build', '11-01-2021', '13', '01', '2', 'coqpix'),
(19, 'coqpixSmart build', '11-01-2021', '13', '02', '3', 'coqpix'),
(20, 'coqpixSmart build', '11-01-2021', '13', '02', '4', 'coqpix'),
(21, 'coqpixSmart build', '11-01-2021', '13', '31', 'l', 'coqpix'),
(22, 'coqpixSmart build', '11-01-2021', '18', '54', 'okok', 'coqpix'),
(23, 'coqpix3', '11-01-2021', '18', '56', 'ici', '3'),
(24, 'coqpixSmart build', '11-01-2021', '19', '31', 'ici 2 fois', 'Smart build'),
(25, 'coqpixSmart build', '11-01-2021', '19', '33', 'smart', 'coqpix'),
(26, 'coqpixSmart build', '11-01-2021', '19', '33', 'et oh', 'Smart build'),
(27, 'coqpixSmart build', '11-01-2021', '19', '38', 'Text ...', 'Smart build'),
(28, 'coqpix3', '11-01-2021', '19', '39', '1234', 'coqpix'),
(29, 'coqpixentreprise test', '12-01-2021', '10', '07', 'Bonjour', 'entreprise test'),
(30, 'coqpixentreprise test', '12-01-2021', '10', '08', 'Bonjour audit action plus vous souhaite bonne années', 'coqpix'),
(31, 'coqpixScream', '16-01-2021', '23', '21', 'Bonjour', 'Scream'),
(32, 'coqpixScream', '16-01-2021', '23', '21', 'zae', 'coqpix'),
(33, 'coqpixScream', '16-01-2021', '23', '21', 'azeazeaze', 'coqpix'),
(34, 'coqpixazeaze', '26-01-2021', '12', '13', 'AZEAZE', 'azeaze'),
(35, 'coqpixazeaze', '26-01-2021', '12', '14', 'AZEAZE', 'coqpix'),
(36, 'coqpixazeaze', '28-01-2021', '23', '09', 'AZEAZE', 'azeaze'),
(37, 'coqpixYouness tech', '03-03-2021', '17', '09', 'Bonjour', 'Youness tech'),
(38, 'coqpixYouness tech', '03-03-2021', '17', '09', 'Bonjour vous allez bien?', 'coqpix'),
(39, 'coqpixYouness tech', '03-03-2021', '17', '09', '', 'coqpix'),
(40, 'coqpixYouness tech', '03-03-2021', '17', '10', '', 'Youness tech'),
(41, 'coqpixYouness tech', '03-03-2021', '17', '10', '', 'Youness tech'),
(42, 'coqpixYouness tech', '03-03-2021', '17', '10', '', 'Youness tech'),
(43, 'coqpixYouness tech', '03-03-2021', '17', '10', '', 'Youness tech'),
(44, 'coqpixYouness tech', '03-03-2021', '17', '10', '', 'Youness tech'),
(45, 'coqpixYouness tech', '03-03-2021', '17', '17', 'aze', 'Youness tech'),
(46, 'coqpixYouness tech', '03-03-2021', '17', '17', 'azeaze', 'Youness tech'),
(47, 'coqpixYouness tech', '03-03-2021', '17', '18', 'zerz', 'coqpix'),
(48, 'coqpixYouness tech', '04-03-2021', '10', '26', 'je re test', 'coqpix'),
(49, 'coqpixYouness tech', '25-03-2021', '15', '13', 'QSDQSD', 'Youness tech'),
(50, 'coqpixYouness tech', '25-03-2021', '15', '13', '12', 'coqpix'),
(51, 'coqpixYouness tech', '25-03-2021', '15', '13', '', 'coqpix'),
(52, 'coqpixYouness tech', '25-03-2021', '15', '13', 'AZ', 'Youness tech'),
(53, 'coqpixYouness tech', '09-04-2021', '10', '33', 'Bonjout', 'Youness tech');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_client` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `numsiret` varchar(255) NOT NULL,
  `tvaintracom` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `departement` varchar(255) NOT NULL,
  `secteur` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `siteweb` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `iban` varchar(255) NOT NULL,
  `nom_diri` varchar(255) NOT NULL,
  `email_diri` varchar(255) NOT NULL,
  `tel_diri` varchar(255) NOT NULL,
  `cat` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `name_client`, `prenom`, `numsiret`, `tvaintracom`, `pays`, `adresse`, `departement`, `secteur`, `tel`, `siteweb`, `email`, `iban`, `nom_diri`, `email_diri`, `tel_diri`, `cat`, `id_session`) VALUES
(1, 'Google', 'é&quot;&amp;', '', '', 'grece', '&amp;é&quot;&amp;é&quot;', '31100', 'Métallurgie / Travail du métal', '&amp;é&quot;&amp;é&quot;', '&amp;é&quot;&amp;é&quot;', '&amp;é&quot;', '&amp;é&quot;', '', '', '', 'Particulier', 1),
(2, 'test', 'yOU', '00121', '', 'france', '63 chemin de truc la ', '31', 'Plastique / Caoutchouc', '02102121', 'www.azeaze.com', 'youness@akdk.com', '', 'AZE', '', '', 'Professionnel', 2);

-- --------------------------------------------------------

--
-- Structure de la table `comptable`
--

DROP TABLE IF EXISTS `comptable`;
CREATE TABLE IF NOT EXISTS `comptable` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password_comptable` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `role_comptable` varchar(255) NOT NULL,
  `new_user` varchar(255) NOT NULL DEFAULT 'new',
  `perms` varchar(255) NOT NULL,
  `id_session` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comptable`
--

INSERT INTO `comptable` (`id`, `email`, `password_comptable`, `nom`, `prenom`, `role_comptable`, `new_user`, `perms`, `id_session`) VALUES
(1, 'contact@auditaction.com', '1234', 'Coqpix', 'PIX', '', 'Activé', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `comptable_list`
--

DROP TABLE IF EXISTS `comptable_list`;
CREATE TABLE IF NOT EXISTS `comptable_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_societe` varchar(255) NOT NULL,
  `tel_societe` varchar(255) NOT NULL,
  `email_societe` varchar(255) NOT NULL,
  `date_crea` varchar(255) NOT NULL,
  `id_comptable` int(11) NOT NULL,
  `perms` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comptable_list`
--

INSERT INTO `comptable_list` (`id`, `name_societe`, `tel_societe`, `email_societe`, `date_crea`, `id_comptable`, `perms`) VALUES
(13, 'antoimmo', '06.00.00.00.00', 'anto@gmail.com', '05-02-2021', 1, 'none'),
(12, 'iskimmo', '123', '123@123.com', '2021-01-13', 1, 'none');

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `crea_societe`
--

INSERT INTO `crea_societe` (`id`, `name_crea`, `email_crea`, `password_crea`, `img_crea`, `date_crea`, `date_crea_j`, `date_crea_j_lettre`, `date_crea_d`, `date_crea_a`, `date_crea_h`, `date_crea_m`, `nom_diri`, `prenom_diri`, `tel_diri`, `email_diri`, `status_crea`, `favorite_crea`, `new_user`, `message_crea`, `note_crea`, `notification_crea`, `notification_admin`, `doc_statuts`, `doc_nomination`, `doc_depot`, `doc_pouvoir`, `doc_pieceid`, `doc_cerfaM0`, `doc_annonce`, `doc_cerfaMBE`, `doc_attestation`, `doc_justificatifss`, `doc_justificatifd`, `doc_xp`, `doc_peirl`, `doc_affectation`, `frais`, `honoraire`, `depo_greffe`, `depo_cfe`, `article_three`) VALUES
(20, 'aze', '123@123.com', '12345', 'crea.png', '06-04-2021', '06', 'Tue', '04', '2021', '10', '14', 'A', 'ZAE', '123123', '123@123.com', 'Micro-entreprise', '', 'crea_societe', 'Dossier en cours de traitement ...', '', '0', '0', '', '', '', '', 'RAPPORT DE BUG-08-14-51.txt', '', '', '', '', '', NULL, '', '', '', '156!yes', '39!yes', '', '', ''),
(13, 'Youness tech', 'youness@youness.com', '1234', 'crea.png', '03-03-2021', '03', 'Wed', '03', '2021', '15', '17', 'Haddou', 'Youness', '0600000000', 'youness@youness.com', 'SAS', '', 'crea_societe', 'Dossier en cours de traitement ...', '', NULL, '1', '', '', '', '', 'astro1-14-09-44.gif', 'peirl-coqpix-15-24-00-14-12-01.pdf', '', '', '', '', NULL, '', '', '', '131!yes', '123!yes', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `delete_societe`
--

DROP TABLE IF EXISTS `delete_societe`;
CREATE TABLE IF NOT EXISTS `delete_societe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_crea` varchar(255) NOT NULL,
  `email_crea` varchar(255) NOT NULL,
  `password_crea` varchar(255) NOT NULL,
  `img_crea` varchar(255) NOT NULL,
  `date_crea` varchar(255) NOT NULL,
  `date_crea_j` varchar(255) NOT NULL,
  `date_crea_j_lettre` varchar(255) NOT NULL,
  `date_crea_d` varchar(255) NOT NULL,
  `date_crea_a` varchar(255) NOT NULL,
  `date_crea_h` varchar(255) NOT NULL,
  `date_crea_m` varchar(255) NOT NULL,
  `nom_diri` varchar(255) NOT NULL,
  `prenom_diri` varchar(255) NOT NULL,
  `tel_diri` varchar(255) NOT NULL,
  `email_diri` varchar(255) NOT NULL,
  `status_crea` varchar(255) NOT NULL,
  `favorite_crea` varchar(255) NOT NULL,
  `new_user` varchar(255) NOT NULL,
  `message_crea` varchar(255) NOT NULL,
  `note_crea` varchar(255) NOT NULL,
  `notification_crea` varchar(255) NOT NULL,
  `notification_admin` varchar(255) NOT NULL,
  `doc_statuts` varchar(255) NOT NULL,
  `doc_nomination` varchar(255) NOT NULL,
  `doc_depot` varchar(255) NOT NULL,
  `doc_pouvoir` varchar(255) NOT NULL,
  `doc_pieceid` varchar(255) NOT NULL,
  `doc_cerfaM0` varchar(255) NOT NULL,
  `doc_annonce` varchar(255) NOT NULL,
  `doc_cerfaMBE` varchar(255) NOT NULL,
  `doc_attestation` varchar(255) NOT NULL,
  `doc_justificatifss` varchar(255) NOT NULL,
  `doc_justificatifd` varchar(255) NOT NULL,
  `doc_xp` varchar(255) NOT NULL,
  `doc_peirl` varchar(255) NOT NULL,
  `doc_affectation` varchar(255) NOT NULL,
  `frais` varchar(255) NOT NULL,
  `honoraire` varchar(255) NOT NULL,
  `depo_greffe` varchar(255) NOT NULL,
  `depo_cfe` varchar(255) NOT NULL,
  `article_three` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `delete_societe`
--

INSERT INTO `delete_societe` (`id`, `name_crea`, `email_crea`, `password_crea`, `img_crea`, `date_crea`, `date_crea_j`, `date_crea_j_lettre`, `date_crea_d`, `date_crea_a`, `date_crea_h`, `date_crea_m`, `nom_diri`, `prenom_diri`, `tel_diri`, `email_diri`, `status_crea`, `favorite_crea`, `new_user`, `message_crea`, `note_crea`, `notification_crea`, `notification_admin`, `doc_statuts`, `doc_nomination`, `doc_depot`, `doc_pouvoir`, `doc_pieceid`, `doc_cerfaM0`, `doc_annonce`, `doc_cerfaMBE`, `doc_attestation`, `doc_justificatifss`, `doc_justificatifd`, `doc_xp`, `doc_peirl`, `doc_affectation`, `frais`, `honoraire`, `depo_greffe`, `depo_cfe`, `article_three`) VALUES
(2, 'zae', 'test@test.com', '1234', 'crea.png', '22-02-2021', '22', 'Mon', '02', '2021', '14', '39', 'aze', 'aze', '0600000000', 'test@test.com', 'SARL', '1', 'crea_societe', 'Dossier en cours de traitement ...', '', '1', '0', '', '', '', '', 'load-cs-client-16-00-30.php', '', '', '', '', '', '', '', '', '', '10!yes', '100!no', '2021-03-16!yes', '', 'no');

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

DROP TABLE IF EXISTS `devis`;
CREATE TABLE IF NOT EXISTS `devis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numerosdevis` varchar(255) NOT NULL,
  `dte` varchar(20) NOT NULL,
  `dateecheance` varchar(20) NOT NULL,
  `nomproduit` varchar(255) NOT NULL,
  `devispour` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `departement` varchar(255) NOT NULL,
  `modalite` varchar(255) NOT NULL,
  `monnaie` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `status_devis` varchar(255) NOT NULL,
  `status_color` varchar(255) NOT NULL,
  `etiquette` varchar(255) NOT NULL,
  `id_session` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dsn`
--

DROP TABLE IF EXISTS `dsn`;
CREATE TABLE IF NOT EXISTS `dsn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_dsn` varchar(255) NOT NULL,
  `dte` varchar(255) NOT NULL,
  `date_j` int(255) NOT NULL,
  `date_m` varchar(255) NOT NULL,
  `date_a` varchar(255) NOT NULL,
  `files_dsn` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dsn`
--

INSERT INTO `dsn` (`id`, `email_dsn`, `dte`, `date_j`, `date_m`, `date_a`, `files_dsn`, `id_session`) VALUES
(8, '123@123.com', '01/01/2021', 1, '01', '2021', 'dsn-upload-18-02-51.css', 2),
(7, '123@123.com', '01/04/2021', 1, '04', '2021', 'faq-18-00-51.css', 2),
(6, '123@123.com', '19/02/2021', 19, '02', '2021', 'HIT.-11-33-36.docx', 2),
(9, '123@123.com', '24/02/2021', 24, '02', '2021', 'Coqpix.-18-35-10.docx', 2),
(10, '123@123.com', '11/02/2021', 11, '02', '2021', 'Coqpix.-18-35-23.docx', 2),
(11, '123@123.com', '01/10/2021', 1, '10', '2021', 'Sans titre-15-50-49.png', 2);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameentreprise` varchar(255) NOT NULL DEFAULT 'Mon entreprise',
  `passwordentreprise` varchar(255) NOT NULL,
  `numerossiret` varchar(20) DEFAULT NULL,
  `iban_entreprise` varchar(255) NOT NULL DEFAULT 'FR - ',
  `adresseentreprise` varchar(255) NOT NULL DEFAULT 'Adresse de mon entreprise',
  `emailentreprise` varchar(255) NOT NULL DEFAULT 'Monentreprise@entreprise.fr',
  `telentreprise` varchar(255) NOT NULL DEFAULT '06.00.00.00.00',
  `img_entreprise` varchar(255) NOT NULL DEFAULT 'astro1.gif',
  `link_website` varchar(255) NOT NULL DEFAULT 'www.monsite.com',
  `datecreation` varchar(20) DEFAULT NULL,
  `datedecloture` varchar(255) NOT NULL,
  `pays_entreprise` varchar(255) NOT NULL DEFAULT 'France',
  `descr_entreprise` varchar(255) DEFAULT NULL,
  `new_user` varchar(10) NOT NULL DEFAULT 'New',
  `color` varchar(255) NOT NULL DEFAULT 'badge badge-light-info badge-pill',
  `nom_diri` varchar(20) DEFAULT 'Mon nom',
  `prenom_diri` varchar(20) NOT NULL DEFAULT 'Mon prénom',
  `adresse_diri` varchar(20) DEFAULT NULL,
  `tel_diri` varchar(20) NOT NULL DEFAULT 'Mon téléphone',
  `email_diri` varchar(255) NOT NULL DEFAULT 'Monmail@mail.com',
  `forme_cloud` varchar(255) NOT NULL DEFAULT 'max',
  `theme_web` varchar(255) NOT NULL DEFAULT 'light',
  `forme_tva` varchar(255) NOT NULL DEFAULT 'mensuelle;off',
  `support_notif` int(255) NOT NULL DEFAULT '0',
  `helpdesk_notif` int(255) NOT NULL DEFAULT '0',
  `frais_bilan` varchar(255) NOT NULL DEFAULT '45!no!no',
  `greffe_bilan` varchar(255) NOT NULL DEFAULT '49!no!no',
  `age_bilan` varchar(255) NOT NULL DEFAULT '99!no!no',
  `statut_dette` varchar(5) NOT NULL DEFAULT 'yes',
  `incrementation` varchar(255) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `nameentreprise`, `passwordentreprise`, `numerossiret`, `iban_entreprise`, `adresseentreprise`, `emailentreprise`, `telentreprise`, `img_entreprise`, `link_website`, `datecreation`, `datedecloture`, `pays_entreprise`, `descr_entreprise`, `new_user`, `color`, `nom_diri`, `prenom_diri`, `adresse_diri`, `tel_diri`, `email_diri`, `forme_cloud`, `theme_web`, `forme_tva`, `support_notif`, `helpdesk_notif`, `frais_bilan`, `greffe_bilan`, `age_bilan`, `statut_dette`, `incrementation`) VALUES
(2, 'iskimmo', '12345', '000000000', 'FR76 6765 6764 7642 56', '8 Boulevard de Bonrepos 31000 Toulouse', 'contact@auditactionplus.com', 'Mon téléphone', 'astro1.gif', 'http://auditaction.eu/', '2021-01-13', '2021-05-29', 'france', 'Commerce / Négoce / Distribution', 'Activé', 'badge badge-light-info badge-pill', 'aze', 'ISKANDER', '62 chemin de tucaut', 'Mon téléphone', 'TEST@TEST.com', 'max', 'light', 'trimestriel;on', 0, 3, '45!yes!no', '49!no!no', '99!no!no', 'no', 'no'),
(4, 'antoimmo', '1234', NULL, 'FR - ', 'Adresse de mon entreprise', 'anto@gmail.com', '06.00.00.00.00', 'astro1.gif', 'www.monsite.com', '05-02-2021', '2021-06-20', 'France', NULL, 'Bloqué', 'badge badge-light-secondary badge-pill', 'antonio', 'aze', NULL, 'Mon téléphone', 'Monmail@mail.com', 'max', 'light', 'trimestriel;on', 0, 0, '45!yes!no', '49!no!no', '99!no!no', 'no', 'yes'),
(5, 'TOUFIK SARL', '1234', NULL, 'FR - ', 'Adresse de mon entreprise', 'Toufik@gmail.com', '06.00.00.00.00', 'astro1.gif', 'www.monsite.com', '21-04-2021', '', 'France', NULL, 'Désactivé', 'badge badge-light-warning badge-pill', 'OM TOUFIK', 'PRENOM TOUFIK', NULL, 'Mon téléphone', 'Monmail@mail.com', 'max', 'light', 'mensuelle;off', 0, 0, '45!no!no', '49!no!no', '99!no!no', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Structure de la table `etiquette`
--

DROP TABLE IF EXISTS `etiquette`;
CREATE TABLE IF NOT EXISTS `etiquette` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_etiq` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etiquette`
--

INSERT INTO `etiquette` (`id`, `name_etiq`, `color`, `id_session`) VALUES
(11, 'Dev', '#ffc874', 2);

-- --------------------------------------------------------

--
-- Structure de la table `etiquette_bookmark`
--

DROP TABLE IF EXISTS `etiquette_bookmark`;
CREATE TABLE IF NOT EXISTS `etiquette_bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_etiq` varchar(255) NOT NULL,
  `color_etiq` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numerosfacture` varchar(255) NOT NULL,
  `dte` varchar(20) NOT NULL,
  `dateecheance` varchar(20) NOT NULL,
  `nomproduit` varchar(255) NOT NULL,
  `facturepour` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `departement` varchar(255) NOT NULL,
  `modalite` varchar(255) NOT NULL,
  `monnaie` varchar(255) NOT NULL,
  `accompte` varchar(255) NOT NULL DEFAULT '0',
  `note` text NOT NULL,
  `status_facture` varchar(255) NOT NULL,
  `status_color` varchar(255) NOT NULL,
  `etiquette` varchar(255) NOT NULL,
  `id_session` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id`, `numerosfacture`, `dte`, `dateecheance`, `nomproduit`, `facturepour`, `adresse`, `email`, `tel`, `departement`, `modalite`, `monnaie`, `accompte`, `note`, `status_facture`, `status_color`, `etiquette`, `id_session`) VALUES
(34, '001', '00-00-00', '', 'TEST', '123', '12334', '123@123.com', '123', '31100', 'CB', '€', '0', 'Pas de commentaire', 'NON PAYE', 'badge badge-light-danger badge-pill', 'Inconnue', 2);

-- --------------------------------------------------------

--
-- Structure de la table `facture_achat`
--

DROP TABLE IF EXISTS `facture_achat`;
CREATE TABLE IF NOT EXISTS `facture_achat` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name_facture` varchar(255) NOT NULL,
  `num_facture` varchar(255) NOT NULL,
  `name_fournisseur` varchar(255) NOT NULL,
  `dte` varchar(255) NOT NULL,
  `doc_facture` varchar(255) NOT NULL,
  `id_session` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture_achat`
--

INSERT INTO `facture_achat` (`id`, `name_facture`, `num_facture`, `name_fournisseur`, `dte`, `doc_facture`, `id_session`) VALUES
(2, 'Fac du mois de janvier', '001', 'Fournisseur', '2020-12-15', 'aa2.png', 1),
(3, 'Exemple 2', '002', 'Fournisseur', '2020-12-16', 'Coqpix - logo.png', 1),
(5, 'AZE', 'AZE', 'AZE', '2021-02-04', '', 2),
(6, '123', '15555', '123', '2021-01-29', '', 2),
(7, '123', '15555', '123', '2021-01-29', '', 2),
(8, '123', '1244', '123', '2021-02-24', '', 2),
(9, '123', '1244', '123', '2021-02-24', '', 2),
(10, '123', '1244', '123', '2021-02-24', '', 2),
(11, '123', '1244', '123', '2021-02-24', '', 2),
(12, '123', '1244', '123', '2021-02-24', '', 2),
(13, '123', '1244', '123', '2021-02-24', '', 2),
(14, '123', '1244', '123', '2021-02-24', '', 2),
(15, '123', '1244', '123', '2021-02-24', '', 2),
(16, '123', '1244', '123', '2021-02-24', '', 2),
(17, '123', '1244', '123', '2021-02-24', '', 2),
(18, '123', '1244', '123', '2021-02-24', '', 2),
(19, '123', '1244', '123', '2021-02-24', '20200819_104708_440x431-14-44-02.jpg', 2),
(20, '123', '1244', '123', '2021-02-24', '', 2),
(21, '909', '909', 'GG', '2021-02-11', '404x404-1_1_404x404-14-45-23.jpg', 2),
(22, '909', '909', 'GG', '2021-02-11', '', 2),
(23, '909', '909', 'GG', '2021-02-11', '404x404-1_1_404x404-14-45-51.jpg', 2),
(24, '909', '909', 'GG', '2021-02-11', '', 2),
(25, '909', '909', 'GG', '2021-02-11', '404x404-1_1_404x404-14-46-33.jpg', 2),
(26, '123', '1234124', '123123', '2021-02-18', 'ciboulette-herbes-aromatiques_440x440-15-17-10.jpg', 2);

-- --------------------------------------------------------

--
-- Structure de la table `flash`
--

DROP TABLE IF EXISTS `flash`;
CREATE TABLE IF NOT EXISTS `flash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_flash` varchar(255) NOT NULL,
  `size_files` varchar(255) NOT NULL,
  `dte_files` varchar(255) NOT NULL,
  `dte_j` varchar(255) NOT NULL,
  `dte_m` varchar(255) NOT NULL,
  `dte_a` varchar(255) NOT NULL,
  `img_files` varchar(255) NOT NULL,
  `recent` int(30) NOT NULL,
  `name_entreprise` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `flash`
--

INSERT INTO `flash` (`id`, `doc_flash`, `size_files`, `dte_files`, `dte_j`, `dte_m`, `dte_a`, `img_files`, `recent`, `name_entreprise`, `id_session`) VALUES
(4, 'anto@gmail.com', '0', '0', '0', '0', '0', '0', 0, '0', 0),
(2, 'test@test.com', '0', '0', '0', '0', '0', '0', 4, '0', 0),
(5, 'Toufik@gmail.com', '0', '0', '0', '0', '0', '0', 0, '0', 0);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_fournisseur` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse_diri` varchar(255) NOT NULL,
  `tel_diri` varchar(255) NOT NULL,
  `email_diri` varchar(255) NOT NULL,
  `numsiret` varchar(255) NOT NULL,
  `tvaintracom` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `secteur` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `siteweb` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `iban` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `name_fournisseur`, `nom`, `prenom`, `adresse_diri`, `tel_diri`, `email_diri`, `numsiret`, `tvaintracom`, `pays`, `adresse`, `secteur`, `tel`, `siteweb`, `email`, `iban`, `id_session`) VALUES
(1, 'Fournisseur', '123', '123', '123', '123', '', '&amp;é&quot;', '&amp;é&quot;', 'france', '123', 'Informatique / Télécoms', '123', '123', '123@13.com', '123', 1);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `images` varchar(255) NOT NULL,
  `name_entreprise` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `images`, `name_entreprise`, `id_session`) VALUES
(2, 'astro4.gif', 'iskimmo', 0),
(4, 'astro4.gif', 'antoimmo', 0),
(5, 'astro4.gif', 'TOUFIK SARL', 0);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL DEFAULT 'Nom membre',
  `prenom` varchar(255) NOT NULL DEFAULT 'Prénom membre',
  `email` varchar(255) NOT NULL DEFAULT 'membres@membres.com',
  `tel` varchar(255) NOT NULL,
  `dtenaissance` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL DEFAULT 'France',
  `langue` varchar(255) NOT NULL DEFAULT 'Française',
  `img_membres` varchar(255) NOT NULL DEFAULT 'astro4.gif',
  `name_entreprise` varchar(255) NOT NULL,
  `status_membres` varchar(255) NOT NULL,
  `role_membres` varchar(255) NOT NULL,
  `startdte` varchar(255) NOT NULL,
  `note_nb` int(50) NOT NULL DEFAULT '0',
  `note_nb_cout` int(50) NOT NULL DEFAULT '0',
  `perms_ventes` varchar(10) NOT NULL DEFAULT 'view',
  `perms_achats` varchar(10) NOT NULL DEFAULT 'view',
  `perms_projets` varchar(10) NOT NULL DEFAULT 'non',
  `perms_inventaires` varchar(10) NOT NULL DEFAULT 'non',
  `doc_note` varchar(255) NOT NULL,
  `doc_note_2` varchar(255) NOT NULL,
  `doc_note_3` varchar(255) NOT NULL,
  `doc_note_4` varchar(255) NOT NULL,
  `doc_note_5` varchar(255) NOT NULL,
  `nb_doc_note` int(50) DEFAULT '0',
  `id_session` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `nom`, `prenom`, `email`, `tel`, `dtenaissance`, `pays`, `langue`, `img_membres`, `name_entreprise`, `status_membres`, `role_membres`, `startdte`, `note_nb`, `note_nb_cout`, `perms_ventes`, `perms_achats`, `perms_projets`, `perms_inventaires`, `doc_note`, `doc_note_2`, `doc_note_3`, `doc_note_4`, `doc_note_5`, `nb_doc_note`, `id_session`) VALUES
(5, 'antonio', 'aze', 'anto@gmail.com', '', '', '', '', 'astro1.gif', 'antoimmo', 'Active', 'Manager', '05-02-2021', 0, 0, '', '', '', '', '', '', '', '', '', 0, 0),
(6, 'OM TOUFIK', 'PRENOM TOUFIK', 'Toufik@gmail.com', '', '', '', '', 'astro1.gif', 'TOUFIK SARL', 'Active', 'Manager', '21-04-2021', 0, 0, '', '', '', '', '', '', '', '', '', 0, 0),
(2, 'aze', 'ISKANDER', 'test@test.com', '', '', '', '', 'astro1.gif', 'iskimmo', 'Active', 'Manager', '04-01-2021', 0, 0, '', '', '', '', '', '', '', '', '', 0, 2),
(4, 'isk', '123', '12312@AE.com', '0123123', '2001-01-13', 'france', 'Francais', 'astro4.gif', 'iskimmo', 'Active', 'Employer', '29-01-2021', 0, 0, 'view', 'write', 'view', 'view', '', '', '', '', '', 0, 2),
(7, 'Haddou', 'Youness', 'younesshaddou31@gmail.com', '0656691615', '2001-06-28', 'france', 'FR', 'astro4.gif', 'Linkall', 'Active', 'Employer', '23-04-2021', 0, 0, 'all', 'all', 'all', 'all', '', '', '', '', '', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

DROP TABLE IF EXISTS `mission`;
CREATE TABLE IF NOT EXISTS `mission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_mission` varchar(255) NOT NULL,
  `colorback_mission` varchar(255) NOT NULL,
  `commentaire_mission` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mission`
--

INSERT INTO `mission` (`id`, `name_mission`, `colorback_mission`, `commentaire_mission`, `id_session`) VALUES
(1, 'Ressource humaine', '#ffc874', 'a faire bientot', 2);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objet` varchar(255) NOT NULL,
  `name_membres` varchar(255) NOT NULL,
  `img_membres` varchar(255) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `dte` varchar(255) NOT NULL,
  `etiquette` varchar(255) NOT NULL,
  `doc_note` varchar(255) NOT NULL,
  `doc_note_2` varchar(255) NOT NULL,
  `doc_note_3` varchar(255) NOT NULL,
  `doc_note_4` varchar(255) NOT NULL,
  `doc_note_5` varchar(255) NOT NULL,
  `zip_name` varchar(244) NOT NULL,
  `id_session` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `objet`, `name_membres`, `img_membres`, `montant`, `dte`, `etiquette`, `doc_note`, `doc_note_2`, `doc_note_3`, `doc_note_4`, `doc_note_5`, `zip_name`, `id_session`) VALUES
(1, 'AEAZE', 'isk', 'astro4.gif', '123', '2021-02-10', 'Déplacement', 'WI.txt', 'WI.txt', 'Tache.txt', '', '', 'isk - AEAZE - 2021-02-10', 2),
(2, '11', 'aze', 'astro1.gif', '123', '2021-01-22', 'Nourriture', 'Tache.txt', '', '', '', '', 'aze - 11 - 2021-01-22', 2);

-- --------------------------------------------------------

--
-- Structure de la table `other_declaration`
--

DROP TABLE IF EXISTS `other_declaration`;
CREATE TABLE IF NOT EXISTS `other_declaration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dte` varchar(255) NOT NULL,
  `date_j` varchar(255) NOT NULL,
  `date_m` varchar(255) NOT NULL,
  `date_a` varchar(255) NOT NULL,
  `files_other` varchar(255) NOT NULL,
  `type_declaration` varchar(255) NOT NULL,
  `id_session` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `portefeuille`
--

DROP TABLE IF EXISTS `portefeuille`;
CREATE TABLE IF NOT EXISTS `portefeuille` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_entreprise` varchar(255) NOT NULL,
  `nom_diri` varchar(255) NOT NULL,
  `prenom_diri` varchar(255) NOT NULL,
  `tel_diri` varchar(255) NOT NULL,
  `email_diri` varchar(255) NOT NULL,
  `estimation` varchar(255) NOT NULL,
  `prix` varchar(255) NOT NULL,
  `lettredemission` varchar(255) NOT NULL,
  `rib` varchar(255) NOT NULL,
  `date_crea` varchar(255) NOT NULL,
  `date_crea_d` varchar(11) NOT NULL,
  `date_crea_m` varchar(11) NOT NULL,
  `date_crea_a` varchar(11) NOT NULL,
  `date_charge` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `dette` varchar(255) NOT NULL DEFAULT '0!01§0!02§0!03§0!04§0!05§0!06§0!07§0!08§0!09§0!10§0!11§0!12',
  `prevelement` varchar(255) NOT NULL DEFAULT '0',
  `raison` varchar(255) NOT NULL,
  `date_leave` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `portefeuille`
--

INSERT INTO `portefeuille` (`id`, `name_entreprise`, `nom_diri`, `prenom_diri`, `tel_diri`, `email_diri`, `estimation`, `prix`, `lettredemission`, `rib`, `date_crea`, `date_crea_d`, `date_crea_m`, `date_crea_a`, `date_charge`, `statut`, `dette`, `prevelement`, `raison`, `date_leave`) VALUES
(9, 'NTT', 'NNT NOM', 'NNT PRENOM', '0600000000', 'NTM@gmail.com', '200', '0', 'SEMAINE_19.04_En_cours-16-24-46.txt', 'SEMAINE_19.04_En_cours-16-28-40.txt', '22/04/2021', '', '01', '', '', 'passif', '567!01§0!02§0!03§0!04§0!05§0!06§0!07§0!08§0!09§0!10§0!11§0!12', '0', 'Liquidation', ''),
(8, 'MA SOCIETE', 'HADDOU', 'Youness', '0600000000', '123@gmail.com', '124', '0', 'SEMAINE_19.04_En_cours-16-16-08.txt', 'ip graber-11-42-55.txt', '22/04/2021', '', '03', '', '', 'actif', '0!01§0!02§0!03§0!04§0!05§0!06§0!07§0!08§0!09§0!10§0!11§0!12', '0', '', ''),
(10, 'Bonjour', 'pokokp', 'jkhhhbn', '222222', '123@gmail.com', '51', '0', 'SEMAINE_19.04_En_cours-16-33-45.txt', 'SEMAINE_19.04_En_cours-16-34-05.txt', '23/04/2021', '', '01', '', '', 'passif', '0!01§0!02§0!03§0!04§0!05§0!06§0!07§0!08§0!09§0!10§0!11§0!12', '0', 'Liquidation', ''),
(11, 'MON ENTREPRISE', 'MON', 'ENTREPRISE', '0600000000', 'monentreprise@gmail.com', '134', '0', 'no', 'no', '24/04/2021', '', '04', '', '', 'prospect', '0!01§0!02§0!03§0!04§0!05§0!06§0!07§0!08§0!09§0!10§0!11§0!12', '0', '', ''),
(12, 'MON CABINET', 'MON', 'CABINET', '0600000000', 'moncabinet@gmail.com', '142', '0', 'SEMAINE_19.04_En_cours-9-58-06.txt', 'no', '24/04/2021', '', '04', '', '', 'encours', '0!01§0!02§0!03§0!04§0!05§0!06§0!07§0!08§0!09§0!10§0!11§0!12', '0', '', ''),
(13, 'MA CHAMBRE', 'MA', 'CHAMBRE', '0600000000', 'machambre@gmail.com', '123', '12', 'no', 'no', '24/04/2021', '', '02', '', '', 'prospect', '0!01§0!02§0!03§0!04§0!05§0!06§0!07§0!08§0!09§0!10§0!11§0!12', '0', '', ''),
(14, 'NABIL INTERNATIONAL', 'Moufekkir', 'Nabil', '080000000', 'nabil@gmail.com', '241', '0', 'rvz4dl2b-15-02-07.png', 'no', '24/04/2021', '', '02', '', '', 'encours', '0!01§0!02§0!03§0!04§0!05§0!06§0!07§0!08§0!09§0!10§0!11§0!12', '0', '', ''),
(15, 'test', 'test', 'test', '0656691415', 'TEST@TEST.com', '140', '0', 'no', 'no', '05/05/2021', '05', '05', '2021', '', 'prospect', '0', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `portefeuille_social`
--

DROP TABLE IF EXISTS `portefeuille_social`;
CREATE TABLE IF NOT EXISTS `portefeuille_social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_entreprise` varchar(255) NOT NULL,
  `nom_diri` varchar(255) NOT NULL,
  `prenom_diri` varchar(255) NOT NULL,
  `tel_diri` varchar(255) NOT NULL,
  `email_diri` varchar(255) NOT NULL,
  `rib` varchar(255) NOT NULL,
  `date_crea` varchar(255) NOT NULL,
  `date_crea_d` varchar(255) NOT NULL,
  `date_crea_m` varchar(255) NOT NULL,
  `date_crea_a` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `portefeuille_social`
--

INSERT INTO `portefeuille_social` (`id`, `name_entreprise`, `nom_diri`, `prenom_diri`, `tel_diri`, `email_diri`, `rib`, `date_crea`, `date_crea_d`, `date_crea_m`, `date_crea_a`, `statut`) VALUES
(1, 'test', 'test', 'test', '4545', 'TEST@TEST.com', 'ip graber-15-23-01.txt', '07/05/2021', '07', '05', '2021', 'actif');

-- --------------------------------------------------------

--
-- Structure de la table `prelevement`
--

DROP TABLE IF EXISTS `prelevement`;
CREATE TABLE IF NOT EXISTS `prelevement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_prelevement` varchar(255) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `dte` varchar(255) NOT NULL,
  `dte_m` varchar(11) NOT NULL,
  `dte_a` varchar(11) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `dte_rejet` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `prelevement`
--

INSERT INTO `prelevement` (`id`, `name_prelevement`, `montant`, `dte`, `dte_m`, `dte_a`, `statut`, `dte_rejet`, `id_session`) VALUES
(14, '', '1', 'Mon, 03 May 2021 08:40:12 +0000', '05', '2021', 'Payé', '', 12),
(15, '', '1', 'Mon, 03 May 2021 08:52:51 +0000', '05', '2021', 'Rejeté', '', 12);

-- --------------------------------------------------------

--
-- Structure de la table `prelevement_social`
--

DROP TABLE IF EXISTS `prelevement_social`;
CREATE TABLE IF NOT EXISTS `prelevement_social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_prelevement` varchar(255) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `dte` varchar(255) NOT NULL,
  `dte_m` varchar(255) NOT NULL,
  `dte_a` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `dte_rejet` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rh_annonce`
--

DROP TABLE IF EXISTS `rh_annonce`;
CREATE TABLE IF NOT EXISTS `rh_annonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_annonce` varchar(255) NOT NULL,
  `description_annonce` varchar(255) NOT NULL,
  `img_annonce` varchar(255) NOT NULL,
  `code_annonce` varchar(255) NOT NULL,
  `email_annonce` varchar(255) NOT NULL,
  `tel_annonce` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `poste` varchar(255) NOT NULL,
  `niveau` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `temps` varchar(255) NOT NULL,
  `qcm` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `color_annonce` varchar(255) NOT NULL DEFAULT '#000000',
  `statut` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rh_annonce`
--

INSERT INTO `rh_annonce` (`id`, `name_annonce`, `description_annonce`, `img_annonce`, `code_annonce`, `email_annonce`, `tel_annonce`, `age`, `poste`, `niveau`, `pays`, `temps`, `qcm`, `link`, `color_annonce`, `statut`, `id_session`) VALUES
(11, 'Recrutement pour journaliste', 'Je recherche un journaliste pour la création d\'article.', '', '13123', '123@gmail.com', '123123', '16 - 18', 'Journaliste', 'BAC +5', 'France', '1 mois', '', 'annonce=Recrutementpourjournaliste&mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJmnoTUzS5678kVvwxy9WXYZRNCDEFrslq41Gtu&num=11&aHIJKpOPQA23LcdefghiBMbj0KpOPQA23LcdefghiBMbj0', '#000000', 'pause', 2),
(16, 'test', 'aze', '', '123', '123@gmail.com', '123123', '16 - 18', '123', 'Niveau 4 (BAC +0)', 'France', '2 ans, , 1 jours', '', 'zeaeazeaze', '#000000', 'actif', 2),
(17, 'Annonce imane', 'test', '', '123', 'TESTT@TEST.com', '060000000', '18 - 20', 'RH', 'Niveau 8 (BAC +8 et plus)', 'Etranger', '9 ans,1 mois,2 jours', '', 'zeaeazeaze', '#80ffff', 'actif', 2),
(18, 'Recherche un informaticien ', 'test', '', '123', '123@gmail.com', '123123123123', 'Age indéterminé', 'WEB DIPZEAZE', 'Niveau 1 et 2', 'France', ' jours', '', 'zeaeazeaze', '#ff8000', 'pause', 2),
(15, 'Recherche comptable experimenté', 'Je recherche un journaliste pour la création d\'article.', '', '23124', 'aze@aze.com', '123412', '20 - +', 'comptable', 'BAC+5', 'France', '1 mois', '', '', '#ff0080', 'actif', 2);

-- --------------------------------------------------------

--
-- Structure de la table `rh_candidature`
--

DROP TABLE IF EXISTS `rh_candidature`;
CREATE TABLE IF NOT EXISTS `rh_candidature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_annonce` varchar(255) NOT NULL,
  `num_candidat` varchar(255) NOT NULL,
  `sexe_candidat` varchar(255) NOT NULL,
  `nom_candidat` varchar(255) NOT NULL,
  `prenom_candidat` varchar(255) NOT NULL,
  `age_candidat` varchar(255) NOT NULL,
  `specialite_candidat` varchar(255) NOT NULL,
  `image_candidat` varchar(255) NOT NULL,
  `time_candidat` varchar(255) NOT NULL,
  `logiciel` varchar(255) NOT NULL,
  `langue` varchar(255) NOT NULL,
  `formationetude` varchar(255) NOT NULL,
  `interet` varchar(255) NOT NULL,
  `qualite` varchar(255) NOT NULL,
  `default_candi` varchar(255) NOT NULL,
  `cv_doc` varchar(255) NOT NULL,
  `lettredemotivation_doc` varchar(255) NOT NULL,
  `other_doc` varchar(255) NOT NULL,
  `qcm` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL DEFAULT 'En cours',
  `key_candidat` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rh_candidature`
--

INSERT INTO `rh_candidature` (`id`, `name_annonce`, `num_candidat`, `sexe_candidat`, `nom_candidat`, `prenom_candidat`, `age_candidat`, `specialite_candidat`, `image_candidat`, `time_candidat`, `logiciel`, `langue`, `formationetude`, `interet`, `qualite`, `default_candi`, `cv_doc`, `lettredemotivation_doc`, `other_doc`, `qcm`, `statut`, `key_candidat`, `id_session`) VALUES
(10, 'Recrutement pour journaliste', '003', 'femme', 'aze', 'azeaze', '12', 'azeaze', '', '1 mois', 'AZEA', 'AZEA', 'EAEA', 'EAZE', 'AEAE', 'AZEAEZ', '', '', '', '', 'En cours', 'lx9qJZertf;2;11', 2),
(11, 'Recrutement pour journaliste', '004', 'homme', 'HADDOU', 'Youness', '19', 'INFO', '', '1 mois', 'VS CODE', 'EN FR MA', 'DIT INFO', 'EAZEA', 'AZE', 'AZE', '20200416_001850(1)-11-25-22.jpg', '20200416_001858(1)-11-25-30.jpg', '', '', 'En cours', 'Iw0ThEOqxB;2;11', 2),
(9, 'Recrutement pour journaliste', '002', 'femme', 'Abkadri', 'Imane', '20', 'TEST', '', '1 mois', 'EXCEL', 'FR, MA, ES', 'ETUDE', 'AZE', 'AZE', 'AZE', 'CV HADDOU YOUNESS-10-24-45.odt', 'Lettre de motivation Haddou Y-10-24-58.odt', '', '', 'En cours', 'aLgmf0AM9c;2;11', 2),
(8, 'Recrutement pour journaliste', '001', 'homme', '', 'Youness', '1', 'aze1', '', '1 mois', '123123', '123', '13', '13213', '1313', '13', 'email-16-32-23.txt', 'Desinstaller HyperV-16-44-31.txt', 'email-16-46-46.txt', '', 'En cours', 'ic4A3laEje;2;11', 2);

-- --------------------------------------------------------

--
-- Structure de la table `stockage`
--

DROP TABLE IF EXISTS `stockage`;
CREATE TABLE IF NOT EXISTS `stockage` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name_files` varchar(255) NOT NULL,
  `size_files` varchar(255) NOT NULL DEFAULT '?mo',
  `dte_files` varchar(255) NOT NULL,
  `dte_j` varchar(255) NOT NULL,
  `dte_m` varchar(255) NOT NULL,
  `dte_a` varchar(255) NOT NULL,
  `img_files` varchar(255) NOT NULL DEFAULT 'doc.png',
  `type_files_note` varchar(255) NOT NULL,
  `type_files_avoir` varchar(255) NOT NULL,
  `type_files_fac_achat` varchar(255) NOT NULL,
  `type_files_fac_ventes` varchar(255) NOT NULL,
  `type_files_caisse_ventes` varchar(255) NOT NULL,
  `banque` varchar(255) NOT NULL,
  `send_files` varchar(255) NOT NULL DEFAULT '#ff2906',
  `id_session` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stockage`
--

INSERT INTO `stockage` (`id`, `name_files`, `size_files`, `dte_files`, `dte_j`, `dte_m`, `dte_a`, `img_files`, `type_files_note`, `type_files_avoir`, `type_files_fac_achat`, `type_files_fac_ventes`, `type_files_caisse_ventes`, `banque`, `send_files`, `id_session`) VALUES
(9, 'articles.sql', '22795', '2020-12-23', '23', '12', '2020', 'doc.png', '', '', '', 'fac_ventes', '', '', '#03f322', 1),
(14, 'Tache.txt', '272', '2021-05-12', '12', '05', '2021', 'doc.png', '', '', '', '', '', 'banque', '#FF0000', 2),
(12, 'contact-reponse.sql', '1444', '2021-02-03', '03', '02', '2021', 'doc.png', '', '', '', 'fac_ventes', '', '', '#03f322', 2),
(13, 'WI.txt', '285', '2021-02-03', '03', '02', '2021', 'doc.png', '', '', '', '', '', 'banque', '#03f322', 2),
(15, 'isk - AEAZE - 2021-02-10.zip', '', '2021-02-10', '', '', '', '.zip', 'note', '', '', '', '', '', '#03f322', 2),
(16, 'aze - 11 - 2021-01-22.zip', '', '2021-01-22', '', '', '', '.zip', 'note', '', '', '', '', '', '#03f322', 2),
(17, 'rambutan_440x440-15-12-47.jpg', '43144', '2021-02-11', '11', '02', '2021', '.jpg', '', '', 'fac_achat', '', '', '', '#03f322', 2),
(18, 'ciboulette-herbes-aromatiques_440x440-15-17-10.jpg', '11674', '2021-02-18', '18', '02', '2021', '.jpg', '', '', 'fac_achat', '', '', '', '#FF0000', 2),
(19, 'CV - Google Docs.pdf', '57830', '2021-02-11', '11', '02', '2021', 'pdf.png', '', 'avoir', '', '', '', '', '#FF0000', 2),
(20, 'Code TeamSpeak.txt', '44', '2021-02-11', '11', '02', '2021', 'doc.png', '', '', '', '', 'cas_ventes', '', '#FF0000', 2),
(21, 'mdp STRIPE.txt', '2092', '2021-02-04', '04', '02', '2021', 'doc.png', '', '', '', '', '', 'banque', '#FF0000', 2),
(22, 'ip graber.txt', '3423', '2021-05-22', '22', '05', '2021', 'doc.png', '', '', '', '', '', 'banque', '#FF0000', 2);

-- --------------------------------------------------------

--
-- Structure de la table `stockage_admin`
--

DROP TABLE IF EXISTS `stockage_admin`;
CREATE TABLE IF NOT EXISTS `stockage_admin` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name_entreprise` varchar(255) NOT NULL,
  `name_files` varchar(255) NOT NULL,
  `size_files` varchar(255) NOT NULL,
  `dte_files` varchar(255) NOT NULL,
  `dte_j` varchar(255) NOT NULL,
  `dte_m` varchar(255) NOT NULL,
  `dte_a` varchar(255) NOT NULL,
  `num_saisie` varchar(100) NOT NULL,
  `img_files` varchar(255) NOT NULL,
  `type_files_note` varchar(255) NOT NULL,
  `type_files_avoir` varchar(255) NOT NULL,
  `type_files_fac_achat` varchar(255) NOT NULL,
  `type_files_fac_ventes` varchar(255) NOT NULL,
  `type_files_caisse_ventes` varchar(255) NOT NULL,
  `banque` varchar(255) NOT NULL,
  `send_files` varchar(255) NOT NULL DEFAULT 'FF0000',
  `recent` int(30) NOT NULL,
  `favo` varchar(30) NOT NULL,
  `id_session` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stockage_admin`
--

INSERT INTO `stockage_admin` (`id`, `name_entreprise`, `name_files`, `size_files`, `dte_files`, `dte_j`, `dte_m`, `dte_a`, `num_saisie`, `img_files`, `type_files_note`, `type_files_avoir`, `type_files_fac_achat`, `type_files_fac_ventes`, `type_files_caisse_ventes`, `banque`, `send_files`, `recent`, `favo`, `id_session`) VALUES
(5, 'iskimmo', 'rambutan_440x440-15-12-47.jpg', '43144', '2021-02-11', '11', '02', '2021', '123', '.jpg', '', '', 'fac_achat', '', '', '', 'valide', 4, '', 2),
(2, 'iskimmo', 'contact-reponse.sql', '1444', '2021-02-03', '03', '02', '2021', '242', 'doc.png', '', '', '', 'fac_ventes', '', '', 'valide', 1, '', 2),
(3, 'iskimmo', 'contact-reponse.sql', '1444', '2021-02-03', '03', '02', '2021', '2825', 'doc.png', '', '', '', 'fac_ventes', '', '', 'valide', 2, '', 2),
(4, 'iskimmo', 'WI.txt', '285', '2021-02-03', '03', '02', '2021', 'pas de numeros', 'doc.png', '', '', '', '', '', 'banque', 'nonvalide', 3, '', 2);

-- --------------------------------------------------------

--
-- Structure de la table `stockage_delete`
--

DROP TABLE IF EXISTS `stockage_delete`;
CREATE TABLE IF NOT EXISTS `stockage_delete` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name_files` varchar(255) NOT NULL,
  `size_files` varchar(255) NOT NULL,
  `dte_files` varchar(255) NOT NULL,
  `dte_j` varchar(255) NOT NULL,
  `dte_m` varchar(255) NOT NULL,
  `dte_a` varchar(255) NOT NULL,
  `img_files` varchar(255) NOT NULL,
  `type_files_note` varchar(255) NOT NULL,
  `type_files_avoir` varchar(255) NOT NULL,
  `type_files_fac_achat` varchar(255) NOT NULL,
  `type_files_fac_ventes` varchar(255) NOT NULL,
  `type_files_caisse_ventes` varchar(255) NOT NULL,
  `banque` varchar(255) NOT NULL,
  `send_files` varchar(255) NOT NULL,
  `id_session` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stockage_delete`
--

INSERT INTO `stockage_delete` (`id`, `name_files`, `size_files`, `dte_files`, `dte_j`, `dte_m`, `dte_a`, `img_files`, `type_files_note`, `type_files_avoir`, `type_files_fac_achat`, `type_files_fac_ventes`, `type_files_caisse_ventes`, `banque`, `send_files`, `id_session`) VALUES
(6, 'photocerfaM0.png', '201848', '2021-01-05', '05', '01', '2021', 'doc.png', '', '', '', 'fac_ventes', '', '', '#FF0000', 2),
(7, 'contact-reponse.sql', '1444', '2021-02-03', '03', '02', '2021', 'doc.png', '', '', '', 'fac_ventes', '', '', '#03f322', 2);

-- --------------------------------------------------------

--
-- Structure de la table `support_message`
--

DROP TABLE IF EXISTS `support_message`;
CREATE TABLE IF NOT EXISTS `support_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destination` varchar(255) NOT NULL,
  `date_message` varchar(255) NOT NULL,
  `date_h` varchar(2555) NOT NULL,
  `date_m` varchar(255) NOT NULL,
  `message_support` varchar(255) NOT NULL,
  `you` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `support_message`
--

INSERT INTO `support_message` (`id`, `destination`, `date_message`, `date_h`, `date_m`, `message_support`, `you`) VALUES
(41, 'supportiskimmo', '02-04-2021', '16', '34', 'Bonjour', 'support'),
(40, 'supportiskimmo', '02-04-2021', '16', '14', 'aaz', 'support'),
(39, 'supportiskimmo', '02-04-2021', '16', '13', 'aze', 'support'),
(37, 'supportiskimmo', '02-04-2021', '12', '51', 'Voila', 'iskimmo'),
(36, 'supportiskimmo', '02-04-2021', '11', '36', 'aze', 'iskimmo'),
(34, 'supportiskimmo', '01-04-2021', '10', '45', 'zz', 'iskimmo'),
(27, 'supportiskimmo', '01-02-2021', '10', '12', 'Yop', 'iskimmo'),
(38, 'supportiskimmo', '02-04-2021', '16', '13', 'azeaze', 'support'),
(33, 'supportiskimmo', '01-04-2021', '10', '45', 'zz', 'iskimmo'),
(31, 'supportiskimmo', '01-04-2021', '10', '26', 'azeazeaze', 'iskimmo'),
(35, 'supportiskimmo', '01-04-2021', '11', '36', 'aze', 'iskimmo'),
(30, 'supportiskimmo', '01-04-2021', '10', '26', 'zzzz', 'iskimmo'),
(28, 'supportiskimmo', '01-04-2021', '10', '13', 'TSTé', 'support'),
(29, 'supportiskimmo', '01-04-2021', '10', '26', 'é', 'iskimmo'),
(42, 'supportiskimmo', '02-04-2021', '16', '35', 'Bonjoour monsieur', 'iskimmo'),
(43, 'supportiskimmo', '02-04-2021', '16', '53', 'j4AI CA', 'iskimmo'),
(44, 'supportiskimmo', '02-04-2021', '16', '53', 'AZEAYZE', 'support'),
(45, 'supportiskimmo', '02-04-2021', '16', '56', 'P', 'support'),
(46, 'supportiskimmo', '02-04-2021', '16', '56', 'PP', 'support'),
(47, 'supportiskimmo', '02-04-2021', '16', '57', ' ', 'support'),
(48, 'supportiskimmo', '02-04-2021', '16', '57', '                   ', 'support'),
(49, 'supportiskimmo', '02-04-2021', '16', '57', '                                           ', 'support'),
(50, 'supportiskimmo', '06-04-2021', '17', '06', 'z', 'iskimmo'),
(51, 'supportiskimmo', '06-04-2021', '17', '21', '12', 'iskimmo'),
(52, 'supportiskimmo', '06-04-2021', '17', '21', '12', 'iskimmo'),
(53, 'supportiskimmo', '06-04-2021', '17', '22', '12', 'iskimmo'),
(54, 'supportiskimmo', '06-04-2021', '17', '25', 'TEST', 'iskimmo'),
(55, 'supportiskimmo', '06-04-2021', '17', '27', '12', 'iskimmo'),
(56, 'supportiskimmo', '06-04-2021', '17', '27', '1', 'iskimmo'),
(57, 'supportiskimmo', '06-04-2021', '17', '29', '1', 'iskimmo'),
(58, 'supportiskimmo', '06-04-2021', '17', '30', '1', 'iskimmo'),
(59, 'supportiskimmo', '06-04-2021', '17', '30', '1', 'iskimmo'),
(60, 'supportiskimmo', '06-04-2021', '17', '33', 'Oui xD', 'support'),
(61, 'supportiskimmo', '06-04-2021', '17', '35', 'test', 'support'),
(62, 'supportiskimmo', '21-04-2021', '14', '29', 'okok', 'support'),
(63, 'supportiskimmo', '21-04-2021', '14', '29', 'zeze', 'support');

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_task` varchar(255) NOT NULL,
  `date_task` varchar(255) NOT NULL,
  `dateecheance_task` varchar(255) NOT NULL,
  `status_task` varchar(255) NOT NULL DEFAULT 'encour',
  `favorite` varchar(255) NOT NULL DEFAULT '0',
  `assignation_task` varchar(255) NOT NULL,
  `description_task` varchar(255) NOT NULL,
  `etiquette_task` varchar(255) NOT NULL,
  `color_etiq` varchar(255) NOT NULL,
  `date_crea` varchar(255) NOT NULL,
  `commentaire_task` varchar(255) NOT NULL,
  `lastcommentaire_task` varchar(255) NOT NULL,
  `projet_task` varchar(255) NOT NULL,
  `id_session` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id`, `name_task`, `date_task`, `dateecheance_task`, `status_task`, `favorite`, `assignation_task`, `description_task`, `etiquette_task`, `color_etiq`, `date_crea`, `commentaire_task`, `lastcommentaire_task`, `projet_task`, `id_session`) VALUES
(11, 'test', '18/04/2021', 'Sun, 31 Dec 2021 00:00:00  +0000', 'terminée', '1', 'isk 123', 'test', 'Coqpix', '#000000', '18/04/21', 'aazeaze', 'Fri, 07 May 2021 14:59:46 +0000', '', '2');

-- --------------------------------------------------------

--
-- Structure de la table `task_commentaire`
--

DROP TABLE IF EXISTS `task_commentaire`;
CREATE TABLE IF NOT EXISTS `task_commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `par` varchar(255) NOT NULL,
  `date_jm` varchar(255) NOT NULL,
  `date_hmin` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `task_num` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `task_commentaire`
--

INSERT INTO `task_commentaire` (`id`, `par`, `date_jm`, `date_hmin`, `content`, `task_num`, `id_session`) VALUES
(20, 'Inconnue', '07/05', '15:59', 'azeaze', '11', 2),
(19, 'isk 123', '21/04', '9:57', 'uyrf', '11', 2),
(18, 'isk 123', '18/04', '12:57', 'aze', '11', 2);

-- --------------------------------------------------------

--
-- Structure de la table `task_delete`
--

DROP TABLE IF EXISTS `task_delete`;
CREATE TABLE IF NOT EXISTS `task_delete` (
  `id` int(11) NOT NULL,
  `name_task` varchar(255) NOT NULL,
  `date_task` varchar(255) NOT NULL,
  `dateecheance_task` varchar(255) NOT NULL,
  `status_task` varchar(255) NOT NULL,
  `favorite` varchar(255) NOT NULL,
  `assignation_task` varchar(255) NOT NULL,
  `description_task` varchar(255) NOT NULL,
  `etiquette_task` varchar(255) NOT NULL,
  `color_etiq` varchar(255) NOT NULL,
  `date_crea` varchar(255) NOT NULL,
  `commentaire_task` varchar(255) NOT NULL,
  `lastcommentaire_task` varchar(255) NOT NULL,
  `projet_task` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `task_doc`
--

DROP TABLE IF EXISTS `task_doc`;
CREATE TABLE IF NOT EXISTS `task_doc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namedoc_task` varchar(255) NOT NULL,
  `date_jm` varchar(255) NOT NULL,
  `date_hmin` varchar(255) NOT NULL,
  `task_num` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `task_doc`
--

INSERT INTO `task_doc` (`id`, `namedoc_task`, `date_jm`, `date_hmin`, `task_num`, `id_session`) VALUES
(12, 'SEMAINE_19.04_En_cours-10-06-03.txt', '23/04', '11:06', '11', 2),
(11, '20200416_001858(1)-11-58-25.jpg', '18/04', '12:58', '11', 2);

-- --------------------------------------------------------

--
-- Structure de la table `task_fisca`
--

DROP TABLE IF EXISTS `task_fisca`;
CREATE TABLE IF NOT EXISTS `task_fisca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_task` varchar(255) NOT NULL,
  `favo_task` varchar(255) NOT NULL DEFAULT 'no',
  `dte_crea` varchar(255) NOT NULL,
  `dte_echeance` varchar(255) NOT NULL,
  `pour_task` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `task_fisca`
--

INSERT INTO `task_fisca` (`id`, `name_task`, `favo_task`, `dte_crea`, `dte_echeance`, `pour_task`) VALUES
(1, 'Faire une dsn', 'yes', '', '10/06/2001', 'Louise');

-- --------------------------------------------------------

--
-- Structure de la table `task_recent`
--

DROP TABLE IF EXISTS `task_recent`;
CREATE TABLE IF NOT EXISTS `task_recent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `par` varchar(255) NOT NULL,
  `type_task` varchar(255) NOT NULL,
  `date_j` varchar(255) NOT NULL,
  `date_m` varchar(255) NOT NULL,
  `date_a` varchar(255) NOT NULL,
  `date_h` varchar(255) NOT NULL,
  `date_min` varchar(255) NOT NULL,
  `img_profile` varchar(255) NOT NULL,
  `task_num` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `task_recent`
--

INSERT INTO `task_recent` (`id`, `par`, `type_task`, `date_j`, `date_m`, `date_a`, `date_h`, `date_min`, `img_profile`, `task_num`, `id_session`) VALUES
(16, 'Inconnue', 'commentaire', '07', '05', '2021', '15', '59', '', '11', 2),
(15, '', 'upload', '23', '04', '2021', '11', '06', '', '11', 2),
(14, 'isk 123', 'commentaire', '21', '04', '2021', '9', '57', '', '11', 2),
(13, '', 'upload', '18', '04', '2021', '12', '58', '', '11', 2),
(12, 'isk 123', 'commentaire', '18', '04', '2021', '12', '57', '', '11', 2);

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_team` varchar(255) NOT NULL,
  `tags_name` varchar(255) NOT NULL,
  `email_team` varchar(255) NOT NULL,
  `tel_team` varchar(255) NOT NULL,
  `date_crea` varchar(255) NOT NULL,
  `projet` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `teams`
--

INSERT INTO `teams` (`id`, `name_team`, `tags_name`, `email_team`, `tel_team`, `date_crea`, `projet`, `id_session`) VALUES
(28, 'TESTX', 'AZE', 'azeaze@zae.com', '123123', '18/04/2021', '', 2),
(29, 'Developpeur', '13', 'contact@auditactionplus.com', '0600000000', '23/04/2021', '', 2),
(30, 'aze', 'aze', 'azeaze@zae.com', '123123', '26/04/2021', '', 2);

-- --------------------------------------------------------

--
-- Structure de la table `teams_membres`
--

DROP TABLE IF EXISTS `teams_membres`;
CREATE TABLE IF NOT EXISTS `teams_membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_membre` varchar(255) NOT NULL,
  `img_membre` varchar(255) NOT NULL DEFAULT 'team_img.png',
  `date_add` varchar(255) NOT NULL,
  `team_num` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `teams_membres`
--

INSERT INTO `teams_membres` (`id`, `name_membre`, `img_membre`, `date_add`, `team_num`, `id_session`) VALUES
(37, 'aze ISKANDER', 'team_img.png', '18/04/2021', '27', 2),
(34, 'aze ISKANDER', 'team_img.png', '18/04/2021', '24', 2),
(36, 'aze ISKANDER', 'team_img.png', '18/04/2021', '26', 2),
(38, 'isk 123', 'team_img.png', '18/04/2021', '28', 2),
(39, 'Haddou Youness', 'team_img.png', '23/04/2021', '29', 2),
(41, 'aze ISKANDER', 'team_img.png', '26/04/2021', '30', 2),
(42, 'isk 123', 'team_img.png', '26/04/2021', '30', 2);

-- --------------------------------------------------------

--
-- Structure de la table `tva`
--

DROP TABLE IF EXISTS `tva`;
CREATE TABLE IF NOT EXISTS `tva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_tva` varchar(255) NOT NULL,
  `dte` varchar(255) NOT NULL,
  `date_j` varchar(255) NOT NULL,
  `date_m` varchar(255) NOT NULL,
  `date_a` varchar(255) NOT NULL,
  `files_tva` varchar(255) NOT NULL,
  `periode` varchar(255) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tva`
--

INSERT INTO `tva` (`id`, `email_tva`, `dte`, `date_j`, `date_m`, `date_a`, `files_tva`, `periode`, `id_session`) VALUES
(21, 'anto@gmail.com', '31-02-2021', '', '02', '2021', 'RAPPORT DE BUG-08-58-08.txt', '', 4),
(19, 'anto@gmail.com', '', '', '', '', 'RAPPORT DE BUG-08-57-26.txt', '', 4),
(17, '123@123.com', '13/08/2021', '13', '08', '2021', 'crea_societe-08-55-04.sql', '', 2),
(20, 'anto@gmail.com', '31-01-2021', '', '01', '2021', 'RAPPORT DE BUG-08-58-01.txt', '', 4),
(16, '123@123.com', '16/03/2021', '16', '03', '2021', 'Rapport de BUG-08-53-20.txt', '', 2),
(15, '123@123.com', '25/03/2021', '25', '03', '2021', 'DataTables - Frest - Bootstrap HTML admin template-08-48-28.pdf', '', 2),
(22, 'anto@gmail.com', '31-12-2021', '', '12', '2021', 'RAPPORT DE BUG-09-00-35.txt', '', 4),
(23, 'anto@gmail.com', '31-06-2021', '', '06', '2021', 'RAPPORT DE BUG-09-01-09.txt', '', 4),
(24, 'anto@gmail.com', '31-05-2021', '', '05', '2021', 'RAPPORT DE BUG-09-01-59.txt', '', 4),
(25, 'anto@gmail.com', '01-12-2021', '', '12', '2021', 'RAPPORT DE BUG-09-03-23.txt', '', 4),
(26, 'anto@gmail.com', '01-03-01', '', '03', '01', 'RAPPORT DE BUG-09-05-14.txt', 'annuel', 4),
(27, 'anto@gmail.com', '01-03-01', '', '03', '01', 'RAPPORT DE BUG-09-10-29.txt', 'annuel', 4),
(28, 'anto@gmail.com', '01-03-2020', '', '03', '2020', 'RAPPORT DE BUG-09-12-37.txt', 'annuel', 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
