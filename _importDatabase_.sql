-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2019 at 03:52 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testimport`
--

-- --------------------------------------------------------

--
-- Table structure for table `completer`
--

CREATE TABLE IF NOT EXISTS `completer` (
  `idPersonne` int(8) NOT NULL DEFAULT '0',
  `idQcm` int(8) NOT NULL DEFAULT '0',
  `resultat` int(8) DEFAULT NULL,
  `dateSoumis` datetime DEFAULT NULL,
  PRIMARY KEY (`idPersonne`,`idQcm`),
  KEY `FK_CompleterQcm` (`idQcm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `completer`
--

INSERT INTO `completer` (`idPersonne`, `idQcm`, `resultat`, `dateSoumis`) VALUES
(9, 5, 5, '2019-06-26 13:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `contient`
--

CREATE TABLE IF NOT EXISTS `contient` (
  `idQuestion` int(8) NOT NULL DEFAULT '0',
  `idQcm` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idQuestion`,`idQcm`),
  KEY `FK_ContientQcm` (`idQcm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contient`
--

INSERT INTO `contient` (`idQuestion`, `idQcm`) VALUES
(37, 5),
(39, 5),
(40, 5),
(41, 5),
(44, 5),
(36, 6),
(37, 6),
(42, 6),
(44, 6);

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `idPersonne` int(8) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) DEFAULT NULL,
  `prenom` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `motDePasse` varchar(200) DEFAULT NULL,
  `statut` char(3) DEFAULT NULL,
  PRIMARY KEY (`idPersonne`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` (`idPersonne`, `nom`, `prenom`, `email`, `motDePasse`, `statut`) VALUES
(8, 'MAMALIOGKAS', 'Petros', 'petros.mamaliogas@gmail.com', '$2y$07$gpHa455Gj4jko3wNyccyK.ZTS/srTvGu23qlgJ7Sa13AoFnZ3UxFG', 'PRO'),
(9, 'ALIOGAS', 'NIKOS', 'liogas77@windowslive.com', '$2y$07$VzfIsKavnzGMOQvaRp3O6ew1agASFV2P2vOabfDk55s4OmHlRKd9S', 'ELE'),
(10, 'PAPADOPOULOS', 'NIKOS', 'np@gmail.com', '$2y$07$5rWrE8rDYjnVJIWBT.FhtuOjFM1wGoQ/4b1i0q7DEzUk7Fiuw5mai', 'PRO');

-- --------------------------------------------------------

--
-- Table structure for table `qcm`
--

CREATE TABLE IF NOT EXISTS `qcm` (
  `idQcm` int(8) NOT NULL AUTO_INCREMENT,
  `createur` int(8) NOT NULL,
  `designation` varchar(80) DEFAULT NULL,
  `dateLimite` datetime DEFAULT NULL,
  `publication` tinyint(1) DEFAULT '0',
  `publieResultats` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idQcm`),
  KEY `FK_QcmPersonne` (`createur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `qcm`
--

INSERT INTO `qcm` (`idQcm`, `createur`, `designation`, `dateLimite`, `publication`, `publieResultats`) VALUES
(5, 8, 'Evaluation premier semestre', '2019-06-26 14:20:00', -1, 0),
(6, 8, 'Test d''evaluation 15 semaine', '2019-06-29 12:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `idQuestion` int(8) NOT NULL AUTO_INCREMENT,
  `auteur` int(8) NOT NULL,
  `theme` int(8) NOT NULL,
  `reponseCorrect` tinyint(1) DEFAULT NULL,
  `texteQuestion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idQuestion`),
  KEY `FK_QuestionPersonne` (`auteur`),
  KEY `FK_QuestionTheme` (`theme`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`idQuestion`, `auteur`, `theme`, `reponseCorrect`, `texteQuestion`) VALUES
(36, 10, 12, 2, 'Quel est la somme de 3+8'),
(37, 10, 12, 3, 'Quelle est la racine de 36'),
(38, 10, 13, 3, 'Quand la deuxieme guerre mondiale a declenche'),
(39, 10, 13, 2, 'Quelle annee la deuxieme guere mondiale a termine '),
(40, 10, 14, 1, 'Quelle est la signification de  Fe'),
(41, 10, 14, 3, 'En Francais le H2O'),
(42, 10, 15, 2, 'En PHP le ! ca va dire '),
(43, 10, 15, 1, 'try ....... finally repmlir la phrase'),
(44, 8, 17, 1, 'Pour changer le type de data dans une ligne on utilise '),
(45, 8, 17, 3, 'Quelle est la comand pour executer une query prepare en PDO'),
(46, 8, 19, 2, 'Quelle la meilleur equipe de la Grece'),
(47, 8, 19, 3, 'Quel est le mailleur jouer de tennis en Serbie'),
(48, 8, 20, 2, 'Qui est le roi de Pop'),
(49, 8, 20, 3, 'Live and let .... Completer le titre de chanson');

-- --------------------------------------------------------

--
-- Table structure for table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `idQuestion` int(8) NOT NULL DEFAULT '0',
  `idReponse` int(8) NOT NULL AUTO_INCREMENT,
  `texte` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idQuestion`,`idReponse`),
  UNIQUE KEY `idReponse` (`idReponse`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `reponse`
--

INSERT INTO `reponse` (`idQuestion`, `idReponse`, `texte`) VALUES
(36, 61, '15'),
(36, 62, '11'),
(36, 63, '12'),
(37, 64, '4'),
(37, 65, '8'),
(37, 66, '6'),
(38, 67, '1940'),
(38, 68, '1938'),
(38, 69, '1939'),
(39, 70, '1944'),
(39, 71, '1945'),
(39, 72, '1946'),
(40, 73, 'Fer'),
(40, 74, 'Farine'),
(40, 75, 'cafe'),
(41, 76, 'Hydorgen'),
(41, 77, 'Oxygen'),
(41, 78, 'Eau'),
(42, 79, 'AND'),
(42, 80, 'NOT'),
(42, 81, 'OR'),
(43, 82, 'catch'),
(43, 83, 'untry'),
(43, 84, 'retry'),
(44, 85, 'ALTER TABLE'),
(44, 86, 'MODIFY TABLE'),
(44, 87, 'SELECT'),
(45, 88, 'start()'),
(45, 89, 'run()'),
(45, 90, 'execute()'),
(46, 91, 'OSFP'),
(46, 92, 'PAOK'),
(46, 93, 'AEK'),
(47, 94, 'Petrovic'),
(47, 95, 'Nikolic'),
(47, 96, 'Jogovic'),
(48, 97, 'Prince'),
(48, 98, 'Michael Jackson'),
(48, 99, 'Michael Sumaher'),
(49, 100, 'fly'),
(49, 101, 'by'),
(49, 102, 'die');

-- --------------------------------------------------------

--
-- Table structure for table `reponsesqcm`
--

CREATE TABLE IF NOT EXISTS `reponsesqcm` (
  `idQuestion` int(8) NOT NULL DEFAULT '0',
  `idPersonne` int(8) NOT NULL DEFAULT '0',
  `idQcm` int(8) NOT NULL DEFAULT '0',
  `reponseDonne` int(8) DEFAULT NULL,
  PRIMARY KEY (`idQuestion`,`idPersonne`,`idQcm`),
  KEY `FK_ReponsesQcmCompleter01` (`idPersonne`),
  KEY `FK_ReponsesQcmCompleter02` (`idQcm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reponsesqcm`
--

INSERT INTO `reponsesqcm` (`idQuestion`, `idPersonne`, `idQcm`, `reponseDonne`) VALUES
(37, 9, 5, 66),
(39, 9, 5, 71),
(40, 9, 5, 73),
(41, 9, 5, 78),
(44, 9, 5, 85);

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `idTheme` int(8) NOT NULL AUTO_INCREMENT,
  `designation` varchar(30) DEFAULT NULL,
  `createur` int(8) DEFAULT NULL,
  PRIMARY KEY (`idTheme`),
  KEY `FK_ThemePersonne` (`createur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`idTheme`, `designation`, `createur`) VALUES
(12, 'mathematiques', 8),
(13, 'histoire', 8),
(14, 'chimie', 8),
(15, 'Programmation', 8),
(16, 'Reseaux', 8),
(17, 'Bases des donness', 8),
(18, 'economy', 8),
(19, 'sports', 10),
(20, 'musique', 10),
(21, 'Biologie', 10);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `completer`
--
ALTER TABLE `completer`
  ADD CONSTRAINT `FK_CompleterPersonne` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`idPersonne`),
  ADD CONSTRAINT `FK_CompleterQcm` FOREIGN KEY (`idQcm`) REFERENCES `qcm` (`idQcm`);

--
-- Constraints for table `contient`
--
ALTER TABLE `contient`
  ADD CONSTRAINT `FK_ContientQcm` FOREIGN KEY (`idQcm`) REFERENCES `qcm` (`idQcm`),
  ADD CONSTRAINT `FK_ContientQuestion` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`idQuestion`);

--
-- Constraints for table `qcm`
--
ALTER TABLE `qcm`
  ADD CONSTRAINT `FK_QcmPersonne` FOREIGN KEY (`createur`) REFERENCES `personne` (`idPersonne`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_QuestionPersonne` FOREIGN KEY (`auteur`) REFERENCES `personne` (`idPersonne`),
  ADD CONSTRAINT `FK_QuestionTheme` FOREIGN KEY (`theme`) REFERENCES `theme` (`idTheme`);

--
-- Constraints for table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_ReponseQuestion` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`idQuestion`);

--
-- Constraints for table `reponsesqcm`
--
ALTER TABLE `reponsesqcm`
  ADD CONSTRAINT `FK_ReponsesQcmCompleter01` FOREIGN KEY (`idPersonne`) REFERENCES `completer` (`idPersonne`),
  ADD CONSTRAINT `FK_ReponsesQcmCompleter02` FOREIGN KEY (`idQcm`) REFERENCES `completer` (`idQcm`);

--
-- Constraints for table `theme`
--
ALTER TABLE `theme`
  ADD CONSTRAINT `FK_ThemePersonne` FOREIGN KEY (`createur`) REFERENCES `personne` (`idPersonne`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
