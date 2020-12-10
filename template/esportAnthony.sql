-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 10 déc. 2020 à 10:22
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `esport`
--

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

DROP TABLE IF EXISTS `equipes`;
CREATE TABLE IF NOT EXISTS `equipes` (
  `idEquipe` int(11) NOT NULL AUTO_INCREMENT,
  `LibelleEquipe` varchar(50) NOT NULL,
  `Marque` varchar(50) NOT NULL,
  `NbMembres` int(11) NOT NULL,
  PRIMARY KEY (`idEquipe`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`idEquipe`, `LibelleEquipe`, `Marque`, `NbMembres`) VALUES
(1, 'Team Pirates', 'CsGo Valorant', 4),
(2, 'Team Pirates Test', 'CsGo Valorant', 4);

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

DROP TABLE IF EXISTS `jeux`;
CREATE TABLE IF NOT EXISTS `jeux` (
  `IdJeux` int(11) NOT NULL AUTO_INCREMENT,
  `LibelleJeux` varchar(50) NOT NULL,
  PRIMARY KEY (`IdJeux`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`IdJeux`, `LibelleJeux`) VALUES
(1, 'CsGo'),
(2, 'Valorant');

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

--
-- Déchargement des données de la table `participation`
--

INSERT INTO `participation` (`IdEquipe`, `IdTournois`, `Classement`) VALUES
(1, 6, NULL),
(1, 1, NULL),
(2, 4, NULL),
(1, 2, NULL);

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

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`idUtilisateur`, `idEquipe`, `LibelleRole`) VALUES
(1, 1, '1'),
(2, 1, '0'),
(3, 1, '0'),
(4, 1, '0'),
(1, 2, '1'),
(2, 2, '0'),
(3, 2, '0'),
(4, 2, '0');

-- --------------------------------------------------------

--
-- Structure de la table `tournois`
--

DROP TABLE IF EXISTS `tournois`;
CREATE TABLE IF NOT EXISTS `tournois` (
  `idTournois` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) DEFAULT NULL,
  `DateHeure` datetime DEFAULT NULL,
  `NombreEquipe` int(11) NOT NULL,
  `NombrePersonneEquipe` int(11) NOT NULL,
  `Jeux` int(11) DEFAULT NULL,
  `IdUserOrganisateur` int(11) NOT NULL,
  PRIMARY KEY (`idTournois`),
  KEY `Jeux` (`Jeux`),
  KEY `IdUserOrganisateur` (`IdUserOrganisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tournois`
--

INSERT INTO `tournois` (`idTournois`, `Nom`, `DateHeure`, `NombreEquipe`, `NombrePersonneEquipe`, `Jeux`, `IdUserOrganisateur`) VALUES
(1, 'Tournoi 1', '2020-12-23 10:30:00', 6, 4, 1, 1),
(2, 'Tournoi 2', '2020-12-12 10:30:00', 4, 3, 2, 1),
(3, 'Tournoi 3', '2020-12-12 10:30:00', 4, 3, 2, 1),
(4, 'Tournoi 4', '2020-12-08 10:30:00', 6, 4, 1, 1),
(5, 'Tournoi 5', '2020-12-12 10:30:00', 4, 3, 2, 1),
(6, 'Tournoi 6', '2020-12-12 10:30:00', 4, 4, 2, 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `Nom`, `Prenom`, `Pseudo`, `Discord`, `Mail`, `Mdp`) VALUES
(1, 'Leclercq', 'Anthony', 'AnthonyL', '', 'a.leclercq55@live.fr', 'test'),
(6, 'Leclercq1', 'Anthony1', 'LeclercqA', '', 'a.leclercq55@live.fr', 'test'),
(3, 'Chassaing', 'Julien', 'Roberto Blanco', '', 'julien@gmail.com', 'test'),
(4, 'Michniewizc', 'Steeven', 'Meach', '', 'steeven@gmail.com', 'test'),
(2, 'Steeven', 'Mich', 'Reberto Dorado', '', 'steeven@gmail.com', 'test');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
