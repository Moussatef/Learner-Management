-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 12, 2021 at 08:15 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brief4_conception`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID_ADMIN` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_ADMIN`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_ADMIN`, `NOM`, `EMAIL`, `PASSWORD`) VALUES
(1, 'Moussatef', 'otman.moussetaf@gmail.com', 'd025fa80acd4a04221bc9b913c5b7543f64d3f2b');

-- --------------------------------------------------------

--
-- Table structure for table `box_message`
--

DROP TABLE IF EXISTS `box_message`;
CREATE TABLE IF NOT EXISTS `box_message` (
  `id_Msg` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `Telephon` varchar(50) DEFAULT NULL,
  `Message` text,
  `Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_Msg`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `box_message`
--

INSERT INTO `box_message` (`id_Msg`, `NOM`, `EMAIL`, `Telephon`, `Message`, `Date`) VALUES
(1, 'otman', '0637274172', 'otman.moussetaf@gmail.com', 'Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test', '2021-02-27 10:34:28'),
(2, 'MOUSSATEF', '0637274172', 'idhem.bissaoui@gmail.com', 'Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test', '2021-02-27 10:35:58'),
(4, 'MOUSSATEF', '0637274172', 'AMINE.ELITEE@GAMAIL.COM', 'Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test', '2021-03-04 12:49:49'),
(5, 'MOUSSATEF', '0637274172', 'ahmad.charki@gmail.com', 'Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test', '2021-03-09 13:02:02'),
(6, 'Aymane Hlamnach', '0637274172', 'dara-@outlook.jp', 'salamu aleikum', '2021-03-10 10:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `classe_etd`
--

DROP TABLE IF EXISTS `classe_etd`;
CREATE TABLE IF NOT EXISTS `classe_etd` (
  `ID_CLASSE_ETD` int(11) NOT NULL AUTO_INCREMENT,
  `ID_FORMATEUR` int(11) NOT NULL,
  `NOM` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_CLASSE_ETD`,`ID_FORMATEUR`),
  KEY `FK_Formateur_Classe` (`ID_FORMATEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classe_etd`
--

INSERT INTO `classe_etd` (`ID_CLASSE_ETD`, `ID_FORMATEUR`, `NOM`) VALUES
(1, 1, 'ADA LOVELACE'),
(2, 3, 'YC_ABC');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `ID_MODULE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_MODULE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_MODULE`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`ID_MODULE`, `NOM_MODULE`) VALUES
(1, 'Langues De Conception'),
(2, 'Alghoriteme'),
(5, 'POO');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `ID_NOTE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_FORMATEUR` int(11) NOT NULL,
  `ID_ETUDIANT` int(11) NOT NULL,
  `ID_MODULE` int(11) NOT NULL,
  `NOTE` float DEFAULT NULL,
  PRIMARY KEY (`ID_NOTE`),
  KEY `FK_Formateur_note` (`ID_FORMATEUR`),
  KEY `FK_Etudiant_note` (`ID_ETUDIANT`),
  KEY `FK_Module_note` (`ID_MODULE`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`ID_NOTE`, `ID_FORMATEUR`, `ID_ETUDIANT`, `ID_MODULE`, `NOTE`) VALUES
(1, 1, 1, 1, 18),
(2, 1, 1, 2, 19),
(3, 1, 1, 5, 16),
(4, 1, 2, 1, 16),
(5, 1, 2, 2, 19),
(6, 1, 2, 5, 20);

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `ID_PERSON` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `AGE` int(11) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_PERSON`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` (`ID_PERSON`, `NOM`, `PRENOM`, `AGE`, `EMAIL`, `PASSWORD`) VALUES
(1, 'Sedraoui', ' Fatimaezzahra', 20, 'sedraoui.fm@gmail.com', '123456'),
(2, 'GARICH', 'SALIM', 20, 'smail.garich@gmail.com', 'garich11'),
(3, 'MHSAWI', 'MMMMM', 20, 'mmmm.sss@gmail.com', 'garich'),
(5, 'mabrouk', 'karss', 20, 'mabrouk@gmail.com', '2020'),
(9, 'saad', 'sorih', 20, 'saad.sorih@gmail.com', 'lmlm'),
(10, 'AYOB', 'SALIMANI', 30, 'ayoub@gmail.com', '12344');

-- --------------------------------------------------------

--
-- Table structure for table `personne_etud`
--

DROP TABLE IF EXISTS `personne_etud`;
CREATE TABLE IF NOT EXISTS `personne_etud` (
  `ID_ETUDIANT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PERSON` int(11) NOT NULL,
  `ID_ClasseETD` int(11) NOT NULL,
  PRIMARY KEY (`ID_ETUDIANT`,`ID_PERSON`),
  KEY `FK_Etudiant_Personne` (`ID_PERSON`),
  KEY `FK_Classe_Etudiant` (`ID_ClasseETD`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personne_etud`
--

INSERT INTO `personne_etud` (`ID_ETUDIANT`, `ID_PERSON`, `ID_ClasseETD`) VALUES
(1, 2, 1),
(2, 3, 1),
(4, 9, 1),
(3, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `personne_formateur`
--

DROP TABLE IF EXISTS `personne_formateur`;
CREATE TABLE IF NOT EXISTS `personne_formateur` (
  `ID_FORMATEUR` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PERSON` int(11) NOT NULL,
  PRIMARY KEY (`ID_FORMATEUR`,`ID_PERSON`),
  KEY `FK_Formateur_Personne` (`ID_PERSON`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personne_formateur`
--

INSERT INTO `personne_formateur` (`ID_FORMATEUR`, `ID_PERSON`) VALUES
(1, 1),
(3, 10);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classe_etd`
--
ALTER TABLE `classe_etd`
  ADD CONSTRAINT `FK_Formateur_Classe` FOREIGN KEY (`ID_FORMATEUR`) REFERENCES `personne_formateur` (`ID_FORMATEUR`) ON DELETE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `FK_Etudiant_note` FOREIGN KEY (`ID_ETUDIANT`) REFERENCES `personne_etud` (`ID_ETUDIANT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Formateur_note` FOREIGN KEY (`ID_FORMATEUR`) REFERENCES `personne_formateur` (`ID_FORMATEUR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Module_note` FOREIGN KEY (`ID_MODULE`) REFERENCES `module` (`ID_MODULE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `personne_etud`
--
ALTER TABLE `personne_etud`
  ADD CONSTRAINT `FK_Classe_Etudiant` FOREIGN KEY (`ID_ClasseETD`) REFERENCES `classe_etd` (`ID_CLASSE_ETD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Etudiant_Personne` FOREIGN KEY (`ID_PERSON`) REFERENCES `personne` (`ID_PERSON`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `personne_formateur`
--
ALTER TABLE `personne_formateur`
  ADD CONSTRAINT `FK_Formateur_Personne` FOREIGN KEY (`ID_PERSON`) REFERENCES `personne` (`ID_PERSON`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
