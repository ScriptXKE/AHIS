-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2013 at 10:14 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ahis`
--
CREATE DATABASE IF NOT EXISTS `ahis` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ahis`;

-- --------------------------------------------------------

--
-- Table structure for table `animaltype`
--

CREATE TABLE IF NOT EXISTS `animaltype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `animaltype`
--

INSERT INTO `animaltype` (`ID`, `Type`) VALUES
(1, 'Cattle'),
(2, 'Goat'),
(3, 'Sheep'),
(4, 'Camel');

-- --------------------------------------------------------

--
-- Table structure for table `case`
--

CREATE TABLE IF NOT EXISTS `case` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CaseID` int(11) DEFAULT NULL,
  `CaseNumber` int(11) DEFAULT NULL,
  `AnimalType_ID` int(11) NOT NULL,
  `Sms_ID` int(11) NOT NULL,
  `Reporter_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `CaseNotes` text,
  `Tags` text,
  `Location_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`AnimalType_ID`,`Sms_ID`,`Reporter_ID`,`User_ID`,`Location_ID`),
  KEY `fk_Case_AnimalType1_idx` (`AnimalType_ID`),
  KEY `fk_Case_Sms1_idx` (`Sms_ID`),
  KEY `fk_Case_Reporter1_idx` (`Reporter_ID`),
  KEY `fk_Case_User1_idx` (`User_ID`),
  KEY `fk_Case_Location1_idx` (`Location_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `casediseases`
--

CREATE TABLE IF NOT EXISTS `casediseases` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Case_ID` int(11) NOT NULL,
  `Disease_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`Case_ID`,`Disease_ID`),
  KEY `fk_CaseDiseases_Case1_idx` (`Case_ID`),
  KEY `fk_CaseDiseases_Disease1_idx` (`Disease_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `casesymptoms`
--

CREATE TABLE IF NOT EXISTS `casesymptoms` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Case_ID` int(11) NOT NULL,
  `Symptom_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`Case_ID`,`Symptom_ID`),
  KEY `fk_CaseSymptoms_Case1_idx` (`Case_ID`),
  KEY `fk_CaseSymptoms_Symptom1_idx` (`Symptom_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('7e6aa384d34678dd99fd18475746141a', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1374309002, ''),
('89f36fe5e80ceef5fd0e2134e455c36b', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1374310328, 'a:5:{s:9:"user_data";s:0:"";s:7:"user_id";s:1:"3";s:8:"fullname";s:14:"Andrew Onyango";s:8:"username";s:6:"andrew";s:6:"avatar";s:18:"missing.avatar.jpg";}');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Country` varchar(45) DEFAULT NULL,
  `Nationality` varchar(45) DEFAULT NULL,
  `Zone_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`Zone_ID`),
  KEY `fk_Country_Zone1_idx` (`Zone_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE IF NOT EXISTS `diseases` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `animaltypeid` int(11) NOT NULL,
  `Disease` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`ID`, `animaltypeid`, `Disease`) VALUES
(1, 1, 'Bovine babesiosis'),
(2, 1, 'Bovine spongiform encephalopathy'),
(3, 1, 'Bovine tuberculosis'),
(4, 1, 'Contagious bovine pleuropneumonia '),
(5, 1, 'Haemorrhagic septicaemia'),
(6, 1, 'Lumpy skin disease'),
(7, 1, 'Theileriosis'),
(8, 1, 'Trypanosomosis (tsetse-transmitted)'),
(9, 1, 'Anthrax'),
(10, 1, 'Bluetongue'),
(11, 1, 'Brucellosis (Brucella abortus) '),
(12, 1, 'Brucellosis (Brucella melitensis) '),
(13, 1, 'Epizootic haemorrhagic disease'),
(14, 1, 'Foot and mouth disease '),
(15, 1, 'Heartwater '),
(16, 1, 'Paratuberculosis '),
(17, 1, 'Q fever '),
(18, 1, 'Rabies'),
(19, 1, 'Rift Valley fever'),
(20, 1, 'Rinderpest'),
(21, 1, 'Surra'),
(22, 2, 'Anthrax'),
(23, 2, 'Bluetongue'),
(24, 2, 'Brucellosis (Brucella abortus) '),
(25, 2, 'Brucellosis (Brucella melitensis) '),
(26, 2, 'Epizootic haemorrhagic disease'),
(27, 2, 'Foot and mouth disease '),
(28, 2, 'Heartwater '),
(29, 2, 'Paratuberculosis '),
(30, 2, 'Q fever '),
(31, 2, 'Rabies'),
(35, 2, 'Rift Valley fever'),
(36, 2, 'Rinderpest'),
(37, 2, 'Surra'),
(38, 3, 'Anthrax'),
(39, 3, 'Bluetongue'),
(40, 3, 'Brucellosis (Brucella abortus) '),
(41, 3, 'Brucellosis (Brucella melitensis) '),
(42, 3, 'Epizootic haemorrhagic disease'),
(43, 3, 'Foot and mouth disease '),
(44, 3, 'Heartwater '),
(45, 3, 'Paratuberculosis '),
(46, 3, 'Q fever '),
(47, 3, 'Rabies'),
(48, 3, 'Rift Valley fever'),
(49, 3, 'Rinderpest'),
(50, 3, 'Surra'),
(51, 4, 'Anthrax'),
(52, 4, 'Bluetongue'),
(53, 4, 'Brucellosis (Brucella abortus) '),
(54, 4, 'Brucellosis (Brucella melitensis) '),
(55, 4, 'Epizootic haemorrhagic disease'),
(56, 4, 'Foot and mouth disease '),
(57, 4, 'Heartwater '),
(58, 4, 'Paratuberculosis '),
(59, 4, 'Q fever '),
(60, 4, 'Rabies'),
(61, 4, 'Rift Valley fever'),
(62, 4, 'Rinderpest'),
(63, 4, 'Surra'),
(64, 2, 'Contagious caprine pleuropneumonia'),
(65, 3, 'Contagious caprine pleuropneumonia'),
(66, 2, 'Maedi-visna'),
(67, 3, 'Maedi-visna'),
(68, 2, 'Nairobi sheep disease'),
(69, 3, 'Nairobi sheep disease'),
(70, 2, 'Peste des petits ruminants'),
(71, 3, 'Peste des petits ruminants'),
(72, 2, 'Salmonellosis (S. abortusovis)'),
(73, 3, 'Salmonellosis (S. abortusovis)'),
(74, 2, 'Sheep pox'),
(75, 3, 'Goat pox'),
(76, 4, 'Camel pox');

-- --------------------------------------------------------

--
-- Table structure for table `diseasesymptom`
--

CREATE TABLE IF NOT EXISTS `diseasesymptom` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Disease_ID` int(11) NOT NULL,
  `Symptom_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`Symptom_ID`,`Disease_ID`),
  KEY `fk_DiseaseSymptom_Symptom_idx` (`Symptom_ID`),
  KEY `fk_DiseaseSymptom_Disease1_idx` (`Disease_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=283 ;

--
-- Dumping data for table `diseasesymptom`
--

INSERT INTO `diseasesymptom` (`ID`, `Disease_ID`, `Symptom_ID`) VALUES
(10, 2, 1),
(58, 6, 2),
(57, 6, 3),
(90, 8, 3),
(115, 10, 3),
(117, 11, 3),
(124, 12, 3),
(147, 13, 3),
(221, 21, 3),
(231, 22, 3),
(244, 24, 3),
(257, 25, 3),
(282, 28, 3),
(184, 17, 4),
(49, 6, 5),
(81, 7, 6),
(86, 8, 6),
(157, 14, 7),
(4, 1, 8),
(48, 6, 8),
(67, 7, 8),
(132, 13, 8),
(225, 22, 8),
(240, 23, 8),
(281, 28, 8),
(166, 15, 9),
(189, 18, 9),
(119, 11, 10),
(126, 12, 10),
(2, 1, 11),
(271, 27, 12),
(158, 14, 13),
(114, 10, 14),
(180, 16, 15),
(116, 10, 16),
(172, 15, 18),
(77, 7, 19),
(249, 25, 20),
(242, 24, 21),
(269, 27, 21),
(70, 7, 22),
(174, 15, 23),
(183, 16, 23),
(187, 18, 23),
(191, 18, 23),
(258, 25, 24),
(156, 14, 26),
(222, 22, 28),
(42, 6, 29),
(211, 20, 29),
(232, 22, 30),
(182, 16, 31),
(233, 22, 31),
(91, 8, 32),
(13, 2, 33),
(210, 20, 34),
(47, 6, 35),
(107, 10, 35),
(151, 14, 35),
(192, 18, 35),
(239, 23, 35),
(19, 3, 37),
(28, 4, 37),
(73, 7, 37),
(162, 15, 37),
(175, 16, 37),
(205, 19, 37),
(238, 24, 37),
(280, 28, 37),
(142, 13, 38),
(208, 20, 39),
(206, 19, 40),
(31, 5, 41),
(72, 7, 42),
(75, 7, 42),
(141, 13, 42),
(163, 15, 42),
(94, 8, 43),
(50, 6, 44),
(60, 6, 44),
(95, 8, 44),
(89, 8, 45),
(270, 27, 46),
(145, 13, 47),
(207, 20, 48),
(43, 6, 49),
(202, 19, 49),
(53, 6, 50),
(150, 14, 50),
(243, 24, 51),
(30, 5, 52),
(65, 7, 52),
(100, 10, 52),
(131, 13, 52),
(196, 19, 52),
(212, 21, 52),
(237, 24, 52),
(17, 3, 53),
(26, 4, 53),
(226, 22, 54),
(173, 15, 55),
(230, 22, 55),
(228, 22, 58),
(144, 13, 59),
(84, 7, 60),
(266, 27, 61),
(101, 10, 62),
(1, 1, 63),
(97, 9, 63),
(223, 22, 63),
(76, 7, 64),
(199, 19, 65),
(245, 24, 65),
(262, 27, 66),
(7, 2, 68),
(171, 15, 68),
(215, 21, 69),
(160, 15, 70),
(3, 1, 71),
(120, 11, 72),
(127, 12, 72),
(104, 10, 73),
(85, 8, 74),
(18, 3, 75),
(27, 4, 75),
(80, 7, 76),
(56, 6, 77),
(273, 27, 78),
(227, 22, 79),
(234, 23, 79),
(11, 2, 80),
(69, 7, 81),
(88, 8, 81),
(278, 28, 81),
(105, 10, 82),
(139, 13, 82),
(20, 3, 83),
(29, 4, 83),
(259, 26, 84),
(217, 21, 86),
(224, 22, 86),
(161, 15, 87),
(15, 3, 88),
(24, 4, 88),
(92, 8, 88),
(153, 14, 88),
(203, 19, 88),
(248, 25, 88),
(68, 7, 89),
(82, 7, 89),
(155, 14, 90),
(179, 16, 90),
(93, 8, 91),
(263, 27, 92),
(181, 16, 93),
(62, 6, 95),
(261, 26, 96),
(272, 27, 97),
(279, 28, 97),
(55, 6, 98),
(241, 24, 100),
(37, 5, 101),
(98, 9, 102),
(83, 7, 103),
(178, 16, 103),
(190, 18, 104),
(136, 13, 105),
(33, 5, 106),
(35, 5, 106),
(71, 7, 106),
(201, 19, 106),
(250, 25, 106),
(103, 10, 107),
(63, 6, 108),
(6, 2, 109),
(164, 15, 110),
(54, 6, 111),
(170, 15, 113),
(149, 14, 115),
(52, 6, 116),
(87, 8, 116),
(143, 13, 116),
(34, 5, 117),
(36, 5, 117),
(218, 21, 118),
(169, 15, 119),
(59, 6, 120),
(45, 6, 121),
(265, 27, 122),
(267, 27, 123),
(195, 18, 124),
(194, 18, 125),
(168, 15, 126),
(66, 7, 127),
(220, 21, 128),
(46, 6, 129),
(61, 6, 129),
(113, 10, 129),
(235, 23, 129),
(256, 25, 129),
(5, 1, 131),
(109, 10, 132),
(209, 20, 132),
(213, 21, 133),
(186, 18, 134),
(216, 21, 135),
(177, 16, 136),
(40, 6, 137),
(159, 15, 137),
(74, 7, 138),
(167, 15, 138),
(135, 13, 139),
(44, 6, 140),
(133, 13, 140),
(38, 5, 141),
(165, 15, 142),
(121, 11, 143),
(128, 12, 143),
(260, 26, 143),
(41, 6, 144),
(268, 27, 144),
(229, 22, 145),
(32, 5, 146),
(102, 10, 146),
(138, 13, 146),
(152, 14, 146),
(277, 28, 146),
(275, 27, 148),
(247, 25, 149),
(254, 25, 150),
(236, 23, 152),
(264, 27, 153),
(276, 27, 154),
(146, 13, 155),
(122, 11, 156),
(129, 12, 156),
(148, 13, 156),
(137, 13, 158),
(78, 7, 159),
(185, 18, 160),
(39, 5, 161),
(96, 9, 161),
(188, 18, 161),
(246, 25, 162),
(51, 6, 163),
(64, 6, 164),
(118, 11, 165),
(125, 12, 165),
(140, 13, 166),
(134, 13, 168),
(274, 27, 169),
(252, 25, 170),
(9, 2, 173),
(79, 7, 174),
(8, 2, 175),
(253, 25, 176),
(99, 9, 177),
(176, 16, 178),
(193, 18, 179),
(219, 21, 180),
(110, 10, 181),
(14, 3, 182),
(23, 4, 182),
(106, 10, 182),
(197, 19, 182),
(204, 19, 182),
(12, 2, 183),
(16, 3, 183),
(25, 4, 183),
(108, 10, 183),
(154, 14, 183),
(214, 21, 183),
(255, 25, 183),
(251, 25, 185),
(200, 19, 190),
(198, 19, 191),
(123, 11, 192),
(130, 12, 192);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `District_PCode_ID` varchar(45) DEFAULT NULL,
  `Coordinates` varchar(45) DEFAULT NULL,
  `Region_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`Region_ID`),
  KEY `fk_District_Region1_idx` (`Region_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `escalation`
--

CREATE TABLE IF NOT EXISTS `escalation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DateEscalated` datetime DEFAULT NULL,
  `EscalationList_ID` int(11) NOT NULL,
  `Case_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`EscalationList_ID`,`Case_ID`),
  KEY `fk_Escalation_EscalationList1_idx` (`EscalationList_ID`),
  KEY `fk_Escalation_Case1_idx` (`Case_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `escalationlist`
--

CREATE TABLE IF NOT EXISTS `escalationlist` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ListName` varchar(45) DEFAULT NULL,
  `ListAddresses` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `CreationDate` datetime DEFAULT NULL,
  `DeletionDate` datetime DEFAULT NULL,
  `Town_ID` int(11) NOT NULL,
  `District_ID` int(11) NOT NULL,
  `Settlement_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`Town_ID`,`District_ID`,`Settlement_ID`),
  KEY `fk_Location_Town1_idx` (`Town_ID`),
  KEY `fk_Location_District1_idx` (`District_ID`),
  KEY `fk_Location_Settlement1_idx` (`Settlement_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `modulelist`
--

CREATE TABLE IF NOT EXISTS `modulelist` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ModuleID` int(11) DEFAULT NULL,
  `Module` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CanCreate` tinyint(1) DEFAULT NULL,
  `CanView` tinyint(1) DEFAULT NULL,
  `CanUpdate` tinyint(1) DEFAULT NULL,
  `CanDelete` tinyint(1) DEFAULT NULL,
  `CanCreateReport` tinyint(1) DEFAULT NULL,
  `CanReadReport` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `Coordinates` varchar(45) DEFAULT NULL,
  `ULatitude` varchar(45) DEFAULT NULL,
  `ILongitude` varchar(45) DEFAULT NULL,
  `Ilatitude` varchar(45) DEFAULT NULL,
  `rlongitude` varchar(45) DEFAULT NULL,
  `Zone_ID` int(11) NOT NULL,
  `Country_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`Zone_ID`,`Country_ID`),
  KEY `fk_Region_Zone1_idx` (`Zone_ID`),
  KEY `fk_Region_Country1_idx` (`Country_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reporter`
--

CREATE TABLE IF NOT EXISTS `reporter` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `LocationID` int(11) DEFAULT NULL,
  `DateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settlement`
--

CREATE TABLE IF NOT EXISTS `settlement` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `PCode` varchar(45) DEFAULT NULL,
  `Longitude` varchar(45) DEFAULT NULL,
  `Latitude` varchar(45) DEFAULT NULL,
  `District_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`District_ID`),
  KEY `fk_Settlement_District1_idx` (`District_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE IF NOT EXISTS `sms` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Number` varchar(45) DEFAULT NULL,
  `Message` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `symptom`
--

CREATE TABLE IF NOT EXISTS `symptom` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Symptom` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=193 ;

--
-- Dumping data for table `symptom`
--

INSERT INTO `symptom` (`ID`, `Symptom`) VALUES
(1, 'Abnormal posture'),
(2, 'Aborted fetuses being covered in nodules. '),
(3, 'Abortion'),
(4, 'Abortions late in the pregnancy'),
(5, 'Agalactia '),
(6, 'Anaemia'),
(7, 'Animal usually collapses and dies 6–24 hours after the first signs are seen'),
(8, 'Anorexia '),
(9, 'Anxious, highly excitable and/or aggressive with intermittent periods  of depression, sudden behavior changes, and attack without provocation. '),
(10, 'Arthritis'),
(11, 'Ataxia'),
(12, 'Blepharitis of varying severity'),
(13, 'Blisters usually heal within 7 days or longer.'),
(14, 'Blue tongue as a result of cyanosis (rare)'),
(15, 'Bottle jaw, a swelling under the jaw'),
(16, 'Break in wool growth in recovering sheep resulting in partial or complete loss of wool.'),
(17, 'Cattle may push their heads against a wall or present aggressive or anxious behavior'),
(18, 'Chewing movements'),
(19, 'Chronic wasting disease'),
(20, 'Clear to thick yellow  nasal discharge'),
(21, 'Conjunctivitis'),
(22, 'Corneal opacity\r\n'),
(23, 'Death'),
(24, 'Death can occur within 5 to 10 days of the onset of fever.'),
(25, 'Death following such an attack.'),
(26, 'Death in young animals '),
(27, 'Death results from progressive paralysis. '),
(28, 'Death within  1 to 3 days with minimal clinical signs'),
(29, 'Death within 10 to 15 days. '),
(30, 'Death within 7  to 10 days.'),
(31, 'Debilitation.'),
(32, 'Decreased fertility '),
(33, 'Decreased milk production'),
(34, 'Dehydration'),
(35, 'Depression'),
(36, 'Development of blisters'),
(37, 'Diarrhoea '),
(38, 'Difficulty swallowing'),
(39, 'Discharge from the nose and eyes'),
(40, 'Disease shows signs of illness in humans ( fever, weakness, myalgia (muscle pain),back ache, dizziness, liver abnormalities, and weight loss)'),
(41, 'Dullness and reluctance to move'),
(42, 'Dyspnoea'),
(43, 'Early death '),
(44, 'Emaciation'),
(45, 'Enlarged lymph nodes'),
(46, 'Enlargement of all superficial lymph nodes, especially prescapular lymph nodes.'),
(47, 'Erosions and ulcerations may be seen in the mouth, on the lips, and around the coronets'),
(48, 'Erosive lesions in the mouth'),
(49, 'Excessive salivation '),
(50, 'Extreme lameness and reluctance to move or eat'),
(51, 'Fetid dysentery that causes painful straining'),
(52, 'Fever'),
(53, 'Fluctuating fever'),
(54, 'Frequent, violent and productive cough '),
(55, 'Frothing at the mouth'),
(56, 'Frothy nasal discharge and stringy saliva may be seen terminally. '),
(57, 'Generalised loss of condition and muscle wasting'),
(58, 'Goat may not be able to move and stands with its front legs wide apart and its neck stiff and extended. '),
(59, 'Haemorrhages'),
(60, 'Haemorrhagic diarrhoea in the terminal stages'),
(61, 'Hard swellings of between 0.5 and 1 cm in Diameter'),
(62, 'Hemorrhages and ulcerations of the oral and nasal tissue'),
(63, 'High fever'),
(64, 'High mortality in fully susceptible cattle can be nearly 100%'),
(65, 'High mortality rate.'),
(66, 'High rectal temperature'),
(67, 'Hyperaesthesia'),
(68, 'Hypersensitive to sound and touch'),
(69, 'Icterus'),
(70, 'Inappetence'),
(71, 'Incoordination'),
(72, 'Infertility'),
(73, 'Inflammation of the coronary band '),
(74, 'Intermittent fever'),
(75, 'Intermittent hacking cough'),
(76, 'Jaundice'),
(77, 'Keratitis may develop'),
(78, 'Labored noisy breathing'),
(79, 'Laboured breathing / respiration'),
(80, 'lack of co-ordination and difficulty in rising from a lying position'),
(81, 'Lacrimation '),
(82, 'Lameness'),
(83, 'large prominent lymph nodes'),
(84, 'Late abortions'),
(85, 'Lateral recumbency'),
(86, 'Lethargy '),
(87, 'Listlessness'),
(88, 'loss of appetite'),
(89, 'loss of condition '),
(90, 'Low milk yield'),
(91, 'Lowered body condition and productivity '),
(92, 'Macules '),
(93, 'Malnutrition'),
(94, 'Marked reduction in milk yield in lactating cattle'),
(95, 'Mastitis'),
(96, 'Mortality of lambs'),
(97, 'Mucopurulent discharge'),
(98, 'Mucopurulent discharge from the eyes and nose '),
(99, 'Mucopurulent nasal discharge'),
(100, 'Mucopurulent, blood-stained, nasal discharge'),
(101, 'Mucous membranes are congested'),
(102, 'Muscle tremors and difficult breathing seen shortly before the animal collapses and dies. '),
(103, 'Muscle wasting'),
(104, 'Muscular weakness, in coordination and seizures are common.'),
(105, 'Nasal and ocular discharge'),
(106, 'Nasal discharge'),
(107, 'Nasal discharge and swelling of lips, tongue, and jaw'),
(108, 'Necrotic skin plugs, which are subject to fly strike and shed leaving deep holes in the hide.'),
(109, 'Nervous or aggressive behaviour'),
(110, 'Nervous signs develop gradually'),
(111, 'Nodules on the mucous membranes of the eyes, nose, mouth, rectum, udder and genitalia quickly ulcerate, and all secretions contain LSD virus'),
(112, 'Numerous abortions and mortalities among young animals'),
(113, 'Nystagmus'),
(114, 'Occasional conjunctivitis'),
(115, 'Occurrence of blisters (or vesicles) on the nose, tongue, lips, oral cavity,\r\nbetween the toes, above the hooves, teats and pressure points on the skin'),
(116, 'Oedema\r\n'),
(117, 'Oedematous swellings in the pharyngeal region. These swellings spread to the ventral cervical region and brisket'),
(118, 'Oedematous swellings of the lower parts of the body: legs, briskets and abdomen (gravity dependent)'),
(119, 'Opisthotonos'),
(120, 'Orchitis and testicular atrophy'),
(121, 'Painful nodules of 2–5 cm in diameter develop over the entire body, particularly on the head, neck, udder and perineum,  nodules initially exude serum eventually may become necrotic plugs that penetrate the full thickness of the hide (“sit-fasts”).'),
(122, 'Papules develop from macules'),
(123, 'Papules may be covered by fluid-filled vesicles'),
(124, 'Paralysis may affect the body, first affecting the hind legs. The paralysis progresses rapidly to the whole body with subsequent coma and death'),
(125, 'Paralysis, generally of the face, throat and neck, causing abnormal facial expressions, drooling and inability to swallow. '),
(126, 'Pedaling'),
(127, 'Petechial and ecchymotic haemorrhage on most mucous membranes of the conjunctiva and the buccal cavity'),
(128, 'Petechial haemorrhages of the serous membranes (eyelids, nostrils and anus)'),
(129, 'Pneumonia'),
(130, 'pregnant sheep and cattle  abort (80-100%)'),
(131, 'Production of dark red or brown-colored urine'),
(132, 'Profuse diarrhea'),
(133, 'progressive anaemia'),
(134, 'progressive paralysis '),
(135, 'Progressive weakness'),
(136, 'Progressive weight loss'),
(137, 'Pyrexia'),
(138, 'Recumbent'),
(139, 'Redness and scaling of the nose and lips'),
(140, 'Reduced milk production'),
(141, 'Respiratory distress occurs'),
(142, 'Restless, walks in circles, makes sucking movements and stands rigidly with tremors of the superficial muscles.'),
(143, 'Retention of placenta'),
(144, 'Rhinitis'),
(145, 'Saliva can drip continuously from the mouth, and the animal may grunt or bleat in pain. '),
(146, 'Salivation'),
(147, 'Salivation and a serous nasal discharge develops'),
(148, 'Scabs'),
(149, 'Severe depression'),
(150, 'Severe diarrhea '),
(151, 'Severe Dyspnoea'),
(152, 'Shrinkage or  wasting'),
(153, 'Small circumscribed areas of hyperaemia'),
(154, 'Small scars'),
(155, 'Stiff and lame'),
(156, 'Still births.\r\n'),
(157, 'Stillbirth or birth of weak offspring'),
(158, 'Stomatitis'),
(159, 'Stunted growth in calves and lack of productivity in adult cattle'),
(160, 'Sudden behavioral changes '),
(161, 'Sudden death with no indication that they had been ill\r\n'),
(162, 'Sudden onset of fever'),
(163, 'Superficial lymph nodes are enlarged.\r\n'),
(164, 'Swelling of the draining lymph nodes (parotid, prescapular, and prefemoral lymph nodes), can easily be seen and palpated'),
(165, 'Swelling of the testicles '),
(166, 'Swelling of the tongue'),
(167, 'Swelling ssure points on the skin. '),
(168, 'Swollen conjunctivae'),
(169, 'Swollen retropharyngeal lymph nodes\r\n'),
(170, 'The eyes may also become infected, causing eyelids to mat together with discharge.'),
(171, 'The mortality rate in young animals is very high whereas mortality in adult\r\nsheep is about 20 per cent and about 10 per cent in adult cattle.'),
(172, 'The nasal discharge ,  a crust that blocks the nostrils causing respiratory distress. '),
(173, 'Tremors\r\n'),
(174, 'Turning sickness'),
(175, 'Twitching\r\n'),
(176, 'Swelling snd ulcers form on the lower gums , dental pad, hard palate, cheeks and tongue.\r\n'),
(177, 'Unclotted blood may exude from body openings and the body may not stiffen after death.'),
(178, 'Unthrifty animals'),
(179, 'Unusually docile'),
(180, 'Urticarial plaques in the skin'),
(181, 'Vomiting'),
(182, 'weakness'),
(183, 'Weight-loss\r\n'),
(184, 'Young lambs and calves develop a fever, become weak and die very suddenly. '),
(185, 'A crust that blocks the nostrils causing respiratory\r\ndistress'),
(186, 'Liver abnormalities'),
(187, 'Dizziness'),
(188, 'Back ache'),
(189, 'Myalgia (muscle pain)'),
(190, 'Mortality in adult sheep is about 20% and about 10% in adult cattle'),
(191, 'Die very suddenly'),
(192, 'Birth of weak offspring');

-- --------------------------------------------------------

--
-- Table structure for table `town`
--

CREATE TABLE IF NOT EXISTS `town` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `PCode` varchar(45) DEFAULT NULL,
  `District_PCode_ID` varchar(45) DEFAULT NULL,
  `Coordinates` varchar(45) DEFAULT NULL,
  `Longitude` varchar(45) DEFAULT NULL,
  `Latitude` varchar(45) DEFAULT NULL,
  `District_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`District_ID`),
  KEY `fk_Town_District1_idx` (`District_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `UserRole_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`UserRole_ID`),
  KEY `fk_User_UserRole1_idx` (`UserRole_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE IF NOT EXISTS `userrole` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Role` varchar(45) DEFAULT NULL,
  `Permissions_ID` int(11) NOT NULL,
  `ModuleList_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`Permissions_ID`,`ModuleList_ID`),
  KEY `fk_UserRole_Permissions1_idx` (`Permissions_ID`),
  KEY `fk_UserRole_ModuleList1_idx` (`ModuleList_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `othernames` varchar(30) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `biodata` text NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0',
  `is_admin` enum('0','1') NOT NULL DEFAULT '0',
  `avatar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `surname`, `othernames`, `email`, `username`, `password`, `gender`, `biodata`, `active`, `is_admin`, `avatar`) VALUES
(1, 'Nicholas', 'Kerandi', '', 'nkerandi@gmail.com', 'nicholas', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'male', 'Nick is just there ...', '1', '1', ''),
(2, 'Germain', 'Mirindi', '', 'gmirindi@gmail.com', 'germain', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'male', 'Germain runs the show on behalf of FAO Somalia', '1', '1', ''),
(3, 'Andrew', 'Onyango', '', 'andrew.onyango@yahoo.co.uk', 'andrew', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'male', 'Andrew is the don from ScriptX ... when he sneezes, everyone in ScriptX catches a flu', '1', '1', ''),
(4, 'Obed', 'Mubia', '', 'mubiaobed@gmail.com', 'obed', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'male', 'Oh-who? Am not familiar with that vocabulary ... :)', '1', '1', ''),
(5, 'Titus', 'Nderitu', '', 'titus.nderitu@gmail.com', 'titus', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'male', 'He does crazy stuff that qualifies as art ... it''s still a mystery I tell ya!', '1', '1', 'tito-nderitu.png');

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE IF NOT EXISTS `zone` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `case`
--
ALTER TABLE `case`
  ADD CONSTRAINT `fk_Case_AnimalType1` FOREIGN KEY (`AnimalType_ID`) REFERENCES `animaltype` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Case_Location1` FOREIGN KEY (`Location_ID`) REFERENCES `location` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Case_Reporter1` FOREIGN KEY (`Reporter_ID`) REFERENCES `reporter` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Case_Sms1` FOREIGN KEY (`Sms_ID`) REFERENCES `sms` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Case_User1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `casediseases`
--
ALTER TABLE `casediseases`
  ADD CONSTRAINT `fk_CaseDiseases_Case1` FOREIGN KEY (`Case_ID`) REFERENCES `case` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CaseDiseases_Disease1` FOREIGN KEY (`Disease_ID`) REFERENCES `diseases` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `casesymptoms`
--
ALTER TABLE `casesymptoms`
  ADD CONSTRAINT `fk_CaseSymptoms_Case1` FOREIGN KEY (`Case_ID`) REFERENCES `case` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CaseSymptoms_Symptom1` FOREIGN KEY (`Symptom_ID`) REFERENCES `symptom` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `country`
--
ALTER TABLE `country`
  ADD CONSTRAINT `fk_Country_Zone1` FOREIGN KEY (`Zone_ID`) REFERENCES `zone` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `diseasesymptom`
--
ALTER TABLE `diseasesymptom`
  ADD CONSTRAINT `fk_DiseaseSymptom_Disease1` FOREIGN KEY (`Disease_ID`) REFERENCES `diseases` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DiseaseSymptom_Symptom` FOREIGN KEY (`Symptom_ID`) REFERENCES `symptom` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `fk_District_Region1` FOREIGN KEY (`Region_ID`) REFERENCES `region` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `escalation`
--
ALTER TABLE `escalation`
  ADD CONSTRAINT `fk_Escalation_Case1` FOREIGN KEY (`Case_ID`) REFERENCES `case` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Escalation_EscalationList1` FOREIGN KEY (`EscalationList_ID`) REFERENCES `escalationlist` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `fk_Location_District1` FOREIGN KEY (`District_ID`) REFERENCES `district` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Location_Settlement1` FOREIGN KEY (`Settlement_ID`) REFERENCES `settlement` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Location_Town1` FOREIGN KEY (`Town_ID`) REFERENCES `town` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `fk_Region_Country1` FOREIGN KEY (`Country_ID`) REFERENCES `country` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Region_Zone1` FOREIGN KEY (`Zone_ID`) REFERENCES `zone` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `settlement`
--
ALTER TABLE `settlement`
  ADD CONSTRAINT `fk_Settlement_District1` FOREIGN KEY (`District_ID`) REFERENCES `district` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `town`
--
ALTER TABLE `town`
  ADD CONSTRAINT `fk_Town_District1` FOREIGN KEY (`District_ID`) REFERENCES `district` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_User_UserRole1` FOREIGN KEY (`UserRole_ID`) REFERENCES `userrole` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userrole`
--
ALTER TABLE `userrole`
  ADD CONSTRAINT `fk_UserRole_ModuleList1` FOREIGN KEY (`ModuleList_ID`) REFERENCES `modulelist` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_UserRole_Permissions1` FOREIGN KEY (`Permissions_ID`) REFERENCES `permissions` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
