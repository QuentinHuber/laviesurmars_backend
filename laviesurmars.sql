-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 05 juin 2020 à 15:11
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
-- Base de données :  `laviesurmars`
--

-- --------------------------------------------------------

--
-- Structure de la table `tj_autor_article_jar`
--

DROP TABLE IF EXISTS `tj_autor_article_jar`;
CREATE TABLE IF NOT EXISTS `tj_autor_article_jar` (
  `aar_id` int(11) NOT NULL AUTO_INCREMENT,
  `art_id` int(11) NOT NULL,
  `aut` int(11) NOT NULL,
  PRIMARY KEY (`aar_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_admin_adm`
--

DROP TABLE IF EXISTS `t_admin_adm`;
CREATE TABLE IF NOT EXISTS `t_admin_adm` (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_sPseudo` varchar(255) NOT NULL,
  `adm_sEmail` varchar(255) NOT NULL,
  `adm_sPwd` varchar(255) NOT NULL,
  PRIMARY KEY (`adm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_article_art`
--

DROP TABLE IF EXISTS `t_article_art`;
CREATE TABLE IF NOT EXISTS `t_article_art` (
  `art_id` int(11) NOT NULL AUTO_INCREMENT,
  `art_iSta` int(11) NOT NULL,
  `art_dDate` date NOT NULL,
  `art_sSource` varchar(255) NOT NULL,
  `art_sMotCle` varchar(255) NOT NULL,
  `art_sAPI` varchar(255) NOT NULL,
  `sub_id` int(11) NOT NULL,
  PRIMARY KEY (`art_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_autors_aut`
--

DROP TABLE IF EXISTS `t_autors_aut`;
CREATE TABLE IF NOT EXISTS `t_autors_aut` (
  `aut_id` int(11) NOT NULL AUTO_INCREMENT,
  `aut_sId` varchar(255) DEFAULT NULL,
  `aut_sNom` varchar(255) DEFAULT NULL,
  `aut_sPseudo` varchar(255) DEFAULT NULL,
  `aut_sAPI` varchar(255) NOT NULL,
  PRIMARY KEY (`aut_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_login_log`
--

DROP TABLE IF EXISTS `t_login_log`;
CREATE TABLE IF NOT EXISTS `t_login_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_iSta` int(11) NOT NULL,
  `log_dDate` datetime NOT NULL,
  `usr_id` int(11) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_media_subject_msu`
--

DROP TABLE IF EXISTS `t_media_subject_msu`;
CREATE TABLE IF NOT EXISTS `t_media_subject_msu` (
  `msu_id` int(11) NOT NULL AUTO_INCREMENT,
  `msu_iSta` int(11) NOT NULL,
  `msu_sMedia` varchar(255) NOT NULL,
  `msu_sNomMedia` varchar(255) NOT NULL,
  `msu_sExt` varchar(255) NOT NULL,
  `sub_id` int(11) NOT NULL,
  PRIMARY KEY (`msu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_subject_sub`
--

DROP TABLE IF EXISTS `t_subject_sub`;
CREATE TABLE IF NOT EXISTS `t_subject_sub` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_iSta` int(11) NOT NULL,
  `sub_sTitre` varchar(255) NOT NULL,
  `sub_sDescriptif` longtext NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_users_usr`
--

DROP TABLE IF EXISTS `t_users_usr`;
CREATE TABLE IF NOT EXISTS `t_users_usr` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_sEmail` varchar(255) NOT NULL,
  `usr_sCle` varchar(255) DEFAULT NULL,
  `usr_iSta` int(11) NOT NULL,
  `usr_sToken` varchar(255) NOT NULL,
  `usr_dDate` date DEFAULT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
