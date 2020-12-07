-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 07 déc. 2020 à 14:45
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
-- Base de données : `esport`
--
CREATE DATABASE IF NOT EXISTS `esport` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `esport`;

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

DROP TABLE IF EXISTS `equipes`;
CREATE TABLE IF NOT EXISTS `equipes` (
  `idEquipe` int(11) NOT NULL,
  `LibelleEquipe` varchar(50) NOT NULL,
  `Marque` varchar(50) NOT NULL,
  `NbMembres` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

DROP TABLE IF EXISTS `jeux`;
CREATE TABLE IF NOT EXISTS `jeux` (
  `IdJeux` int(11) NOT NULL AUTO_INCREMENT,
  `LibelleJeux` varchar(50) NOT NULL,
  PRIMARY KEY (`IdJeux`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

DROP TABLE IF EXISTS `participation`;
CREATE TABLE IF NOT EXISTS `participation` (
  `IdEquipe` int(11) NOT NULL,
  `IdTournois` int(11) NOT NULL,
  `Classement` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdEquipe`,`IdTournois`),
  KEY `IdTournois` (`IdTournois`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `idUtilisateur` int(11) NOT NULL,
  `idEquipe` int(11) NOT NULL,
  `LibelleRole` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`,`idEquipe`),
  KEY `idEquipe` (`idEquipe`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tournois`
--

DROP TABLE IF EXISTS `tournois`;
CREATE TABLE IF NOT EXISTS `tournois` (
  `idTournois` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `DateHeure` datetime DEFAULT NULL,
  `Jeux` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idTournois`),
  KEY `Jeux` (`Jeux`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Pseudo` varchar(50) NOT NULL,
  `Discord` varchar(50) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `Mdp` varchar(250) NOT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
