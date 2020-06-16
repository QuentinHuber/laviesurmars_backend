-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 16 juin 2020 à 11:35
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
-- Structure de la table `t_admins_adm`
--

DROP TABLE IF EXISTS `t_admins_adm`;
CREATE TABLE IF NOT EXISTS `t_admins_adm` (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_sPseudo` varchar(255) NOT NULL,
  `adm_sEmail` varchar(255) NOT NULL,
  `adm_sPwd` varchar(255) NOT NULL,
  PRIMARY KEY (`adm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_admins_adm`
--

INSERT INTO `t_admins_adm` (`adm_id`, `adm_sPseudo`, `adm_sEmail`, `adm_sPwd`) VALUES
(1, 'admin', 'admin@hetic.net', 'f4af5c548220efbf7ecf45f4e7eff9594828a1c1c4daa729a8dc17098331da42fca157d7818301e6f09ea2d12d72faa95413a168ed5c22abe1aebb456a2fd6e9');

-- --------------------------------------------------------

--
-- Structure de la table `t_article_art`
--

DROP TABLE IF EXISTS `t_article_art`;
CREATE TABLE IF NOT EXISTS `t_article_art` (
  `art_id` int(11) NOT NULL AUTO_INCREMENT,
  `art_sTitre` varchar(255) NOT NULL,
  `tya_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `art_sVideo_1` varchar(255) DEFAULT NULL,
  `art_sVideo_2` varchar(255) DEFAULT NULL,
  `art_sAudio` varchar(255) DEFAULT NULL,
  `art_sImage_1` varchar(255) DEFAULT NULL,
  `art_sImage_2` varchar(255) DEFAULT NULL,
  `art_sPar_1` varchar(255) NOT NULL,
  `art_sPar_2` varchar(255) DEFAULT NULL,
  `art_sPar_3` varchar(255) DEFAULT NULL,
  `art_sPar_4` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`art_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_article_art`
--

INSERT INTO `t_article_art` (`art_id`, `art_sTitre`, `tya_id`, `sub_id`, `art_sVideo_1`, `art_sVideo_2`, `art_sAudio`, `art_sImage_1`, `art_sImage_2`, `art_sPar_1`, `art_sPar_2`, `art_sPar_3`, `art_sPar_4`) VALUES
(6, 'test', 20, 2, NULL, NULL, NULL, NULL, NULL, 'c&#039;est un test', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_features_fea`
--

DROP TABLE IF EXISTS `t_features_fea`;
CREATE TABLE IF NOT EXISTS `t_features_fea` (
  `fea_id` int(11) NOT NULL AUTO_INCREMENT,
  `fea_sVideo` varchar(255) DEFAULT NULL,
  `fea_iDiametre` int(11) NOT NULL,
  `fea_iDistanceSoleil` float NOT NULL,
  `fea_sRotation` varchar(255) NOT NULL,
  `fea_iTemperatue` int(11) NOT NULL,
  `fea_iPhobos` int(11) NOT NULL,
  `fea_iDistance` int(11) NOT NULL,
  PRIMARY KEY (`fea_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_features_fea`
--

INSERT INTO `t_features_fea` (`fea_id`, `fea_sVideo`, `fea_iDiametre`, `fea_iDistanceSoleil`, `fea_sRotation`, `fea_iTemperatue`, `fea_iPhobos`, `fea_iDistance`) VALUES
(1, NULL, 6792, 1, '24 heures et 37 minutes', -63, 2, 78);

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
-- Structure de la table `t_subject_sub`
--

DROP TABLE IF EXISTS `t_subject_sub`;
CREATE TABLE IF NOT EXISTS `t_subject_sub` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_iSta` int(11) NOT NULL,
  `sub_sTitre` varchar(255) NOT NULL,
  `sub_sDescriptif` longtext NOT NULL,
  `sub_sImage` varchar(255) NOT NULL,
  `sub_sRealimage` varchar(255) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_subject_sub`
--

INSERT INTO `t_subject_sub` (`sub_id`, `sub_iSta`, `sub_sTitre`, `sub_sDescriptif`, `sub_sImage`, `sub_sRealimage`) VALUES
(1, 1, 'test', 'ce n&amp;#039;est qu&amp;#039;un test en attendant épatant', 'http://192.168.0.48:80/laviesurmars_backend/assets/subject/1591911935.png', 'screenshotv2.png'),
(2, 1, 'un deuxième test', 'deuxième test et ça marche top top !!!!!!', 'http://192.168.0.48:80/laviesurmars_backend/assets/subject/1592217156.png', 'screenshot.png');

-- --------------------------------------------------------

--
-- Structure de la table `t_type_article_tya`
--

DROP TABLE IF EXISTS `t_type_article_tya`;
CREATE TABLE IF NOT EXISTS `t_type_article_tya` (
  `tya_id` int(11) NOT NULL AUTO_INCREMENT,
  `tya_sLib` varchar(255) NOT NULL,
  PRIMARY KEY (`tya_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_type_article_tya`
--

INSERT INTO `t_type_article_tya` (`tya_id`, `tya_sLib`) VALUES
(1, 'Introduction'),
(2, 'Exploration'),
(3, 'Relief plat'),
(4, 'Dark'),
(5, 'Dark 2'),
(6, 'Surface planete'),
(7, 'Relief montagneux'),
(8, 'Background vidéo'),
(9, 'Portion planète'),
(10, 'Orbit'),
(11, 'Montagne'),
(12, 'Espace sombre'),
(13, 'Fusée'),
(14, 'Espace sombre avec une petite planète'),
(15, 'espace bleu'),
(16, 'Terrain vaste'),
(17, 'Torchant'),
(18, 'Cité futuriste'),
(19, 'Industrie futuriste'),
(20, 'Color'),
(21, 'Colonisateur'),
(22, 'planète jaune'),
(23, 'Climat planète');

-- --------------------------------------------------------

--
-- Structure de la table `t_user_usr`
--

DROP TABLE IF EXISTS `t_user_usr`;
CREATE TABLE IF NOT EXISTS `t_user_usr` (
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
