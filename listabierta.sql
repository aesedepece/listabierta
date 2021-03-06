-- phpMyAdmin SQL Dump
-- version 3.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2012 at 07:00 PM
-- Server version: 5.1.52
-- PHP Version: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `admin_la`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `candidatures`
--

CREATE TABLE IF NOT EXISTS `candidatures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process` int(11) NOT NULL,
  `region` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `secret` int(5) NOT NULL,
  `pin` int(8) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `zip` int(5) NOT NULL,
  `news` tinyint(1) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE IF NOT EXISTS `periods` (
  `process` int(11) NOT NULL,
  `acandidates` int(11) NOT NULL,
  `zcandidates` int(11) NOT NULL,
  `aquestions` int(11) NOT NULL,
  `zquestions` int(11) NOT NULL,
  `aanswers` int(11) NOT NULL,
  `zanswers` int(11) NOT NULL,
  `avoting` int(11) NOT NULL,
  `zvoting` int(11) NOT NULL,
  PRIMARY KEY (`process`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `processes`
--

CREATE TABLE IF NOT EXISTS `processes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `parity` enum('none','simple','zip') COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `topic` int(11) DEFAULT NULL,
  `text` text COLLATE utf8_spanish_ci NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(2) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `seats` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `enabled`, `seats`) VALUES
(1, 'Álava', 0, 0),
(2, 'Albacete', 0, 0),
(3, 'Alicante', 0, 0),
(4, 'Almería', 0, 0),
(5, 'Ávila', 0, 0),
(6, 'Badajoz', 0, 0),
(7, 'Illes Balears', 0, 0),
(8, 'Barcelona', 0, 0),
(9, 'Burgos', 0, 0),
(10, 'Cáceres', 0, 0),
(11, 'Cádiz', 0, 0),
(12, 'Castellón', 0, 0),
(13, 'Ciudad Real', 0, 0),
(14, 'Córdoba', 0, 0),
(15, 'A Coruña', 0, 0),
(16, 'Cuenca', 0, 0),
(17, 'Girona', 0, 0),
(18, 'Granada', 0, 0),
(19, 'Guadalajara', 0, 0),
(20, 'Guipúzcoa', 0, 0),
(21, 'Huelva', 0, 0),
(22, 'Huesca', 0, 0),
(23, 'Jaén', 0, 0),
(24, 'León', 0, 0),
(25, 'Lleida', 0, 0),
(26, 'La Rioja', 0, 0),
(27, 'Lugo', 0, 0),
(28, 'Madrid', 0, 0),
(29, 'Málaga', 0, 0),
(30, 'Murcia', 0, 0),
(31, 'Navarra', 0, 0),
(32, 'Ourense', 0, 0),
(33, 'Asturias', 0, 0),
(34, 'Palencia', 0, 0),
(35, 'Las Palmas', 0, 0),
(36, 'Pontevedra', 0, 0),
(37, 'Salamanca', 0, 0),
(38, 'Santa Cruz de Tenerife', 0, 0),
(39, 'Cantabria', 0, 0),
(40, 'Segovia', 0, 0),
(41, 'Sevilla', 0, 0),
(42, 'Soria', 0, 0),
(43, 'Tarragona', 0, 0),
(44, 'Teruel', 0, 0),
(45, 'Toledo', 0, 0),
(46, 'Valencia', 0, 0),
(47, 'Valladolid', 0, 0),
(48, 'Vizcaya', 0, 0),
(49, 'Zamora', 0, 0),
(50, 'Zaragoza', 0, 0),
(51, 'Ceuta', 0, 0),
(52, 'Melilla', 0, 0);

-- --------------------------------------------------------

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`) VALUES
(1, 'Administraciones Públicas y transparencia'),
(2, 'Agricultura y pesca'),
(3, 'Cultura'),
(4, 'Economía'),
(5, 'Educación'),
(6, 'Empleo'),
(7, 'Igualdad y bienestar social'),
(8, 'Justicia'),
(9, 'Medio ambiente'),
(10, 'Obras públicas y vivienda'),
(11, 'Sanidad'),
(12, 'Turismo y deporte');
