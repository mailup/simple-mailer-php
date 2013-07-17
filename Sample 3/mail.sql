-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2013 at 01:57 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mail`
--

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `IdGroup` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `insertDate` varchar(100) NOT NULL,
  `updateDate` varchar(100) NOT NULL,
  PRIMARY KEY (`IdGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE IF NOT EXISTS `interest` (
  `interest` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `InsertDate` varchar(100) NOT NULL,
  `UpdateDate` varchar(100) NOT NULL,
  PRIMARY KEY (`interest`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`interest`, `description`, `InsertDate`, `UpdateDate`) VALUES
(1, 'sport', '', ''),
(2, 'xxxx_1', '', ''),
(3, 'xxxx_2\n', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `idCity` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `insertDate` varchar(100) NOT NULL,
  `updateDate` varchar(100) NOT NULL,
  PRIMARY KEY (`idCity`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`idCity`, `state`, `city`, `insertDate`, `updateDate`) VALUES
(2, 'y', 'x2', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `state` int(11) NOT NULL AUTO_INCREMENT,
  `insertData` varchar(100) NOT NULL,
  `updateData` varchar(100) NOT NULL,
  PRIMARY KEY (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user-interest`
--

CREATE TABLE IF NOT EXISTS `user-interest` (
  `interest` int(11) NOT NULL,
  `idRecipient` int(11) NOT NULL AUTO_INCREMENT,
  `score` varchar(100) NOT NULL,
  `insertDate` varchar(100) NOT NULL,
  `updateDate` varchar(100) NOT NULL,
  PRIMARY KEY (`idRecipient`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user-interest`
--

INSERT INTO `user-interest` (`interest`, `idRecipient`, `score`, `insertDate`, `updateDate`) VALUES
(1, 1, '', '', ''),
(1, 2, '', '', ''),
(1, 3, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE IF NOT EXISTS `userdata` (
  `IdRecipient` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `display` varchar(100) NOT NULL,
  `emailaddress` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `idCity` varchar(100) NOT NULL,
  `optin` varchar(100) NOT NULL,
  `optOut` varchar(100) NOT NULL,
  `note` varchar(500) NOT NULL,
  `enabled` varchar(100) NOT NULL,
  `insertData` varchar(100) NOT NULL,
  `updateData` varchar(100) NOT NULL,
  PRIMARY KEY (`IdRecipient`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`IdRecipient`, `name`, `surname`, `display`, `emailaddress`, `age`, `idCity`, `optin`, `optOut`, `note`, `enabled`, `insertData`, `updateData`) VALUES
(1, 'dj', 'dc', 'dd', '', '20', '2', '', '', '', '', '', ''),
(2, 'aj', 'ac', 'aa', '', '20', '2', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `usergroup`
--

CREATE TABLE IF NOT EXISTS `usergroup` (
  `IdRecipient` int(11) NOT NULL AUTO_INCREMENT,
  `IdGroup` int(11) NOT NULL,
  `InsertDate` varchar(100) NOT NULL,
  `UpdateDate` varchar(100) NOT NULL,
  PRIMARY KEY (`IdRecipient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
