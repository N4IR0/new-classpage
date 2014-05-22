-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 22, 2014 at 08:24 AM
-- Server version: 5.5.37-0+wheezy1-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fi13a_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_category`
--

CREATE TABLE IF NOT EXISTS `admin_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(30) NOT NULL,
  `user_lvl` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_category`
--

INSERT INTO `admin_category` (`id`, `name`, `url`, `user_lvl`) VALUES
(1, 'Dashboard', 'dashboard', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_pages`
--

CREATE TABLE IF NOT EXISTS `admin_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(30) NOT NULL,
  `cat` int(2) NOT NULL,
  `user_lvl` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_pages`
--

INSERT INTO `admin_pages` (`id`, `name`, `url`, `cat`, `user_lvl`) VALUES
(1, 'Home', 'home', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `url`) VALUES
(1, 'Dashboard', 'dashboard'),
(2, 'Stundenplan', 'timetable');

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE IF NOT EXISTS `homework` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(20) DEFAULT NULL,
  `description` text,
  `date` varchar(15) DEFAULT NULL,
  `notify_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(30) NOT NULL,
  `cat` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `url`, `cat`) VALUES
(1, 'Home', 'home', 1),
(2, 'Gruppe 1', 'group1', 2),
(3, 'Gruppe 2', 'group2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_group1`
--

CREATE TABLE IF NOT EXISTS `schedule_group1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mon` varchar(20) DEFAULT NULL,
  `tue` varchar(20) DEFAULT NULL,
  `wed` varchar(20) DEFAULT NULL,
  `thu` varchar(20) DEFAULT NULL,
  `fri` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_group2`
--

CREATE TABLE IF NOT EXISTS `schedule_group2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mon` varchar(20) DEFAULT NULL,
  `tue` varchar(20) DEFAULT NULL,
  `wed` varchar(20) DEFAULT NULL,
  `thu` varchar(20) DEFAULT NULL,
  `fri` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(200) NOT NULL,
  `setting` varchar(200) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `setting`, `value`) VALUES
(1, 'website', 'title', 'FI_13A Infoseite'),
(2, 'website', 'class', 'FI_13A'),
(3, 'website', 'url', 'http://www.fi13a.de'),
(4, 'website', 'adminurl', 'http://admin.fi13a.de'),
(5, 'ftp', 'server', 'ftp.fi13a.de'),
(6, 'ftp', 'port', '21'),
(7, 'ftp', 'user', 'fi13'),
(8, 'ftp', 'password', 'changeme'),
(9, 'smtp', 'server', 'ssl://localhost'),
(10, 'smtp', 'port', '465'),
(11, 'smtp', 'user', 'noreply@fi13a.de'),
(12, 'smtp', 'password', 'changeme'),
(13, 'notify', 'mail', 'noreply@fi13a.de'),
(14, 'notify', 'prefix', '[FI_13A]'),
(15, 'notify', 'sender', 'Infowebsite'),
(16, 'notify', 'logpath', '/var/www/vhosts/fi13a.de/httpdocs/notification_log'),
(17, 'notify', 'confirmsubject', 'Infowebsite - Anmeldung'),
(18, 'notify', 'remindersubject', 'Erinnerung: {DAYS}'),
(19, 'notify', 'reminderbegin', 'Dies ist eine Erinnerungsmail fuer anstehende Hausaufgaben oder Arbeiten.\n'),
(20, 'notify', 'testreminder', 'Folgende Arbeiten sind in {DAYS}:\n\r'),
(21, 'notify', 'hwreminder', 'Folgende Hausaufgaben sind in {DAYS} fällig:\n\r'),
(22, 'notify', 'reminderend', '\r\n\r\nWeitere Informationen unter {URL}\r\nDein Erinnerungsservice der {TITLE}\r\n\r\n- Dies ist eine automatisch generierte E-Mail! -'),
(23, 'notify', 'newreg', 'Hallo!\r\n\r\nes sind neue E-Mailadressen vorhanden, welche auf eine Freischaltung warten.\r\n\r\nBitte autorisiere diese im Adminpanel unter {ADMURL} unter "E-Mails".\r\n\r\nDeine {TITLE}\r\n\r\n- Dies ist eine automatisch generierte E-Mail! -'),
(24, 'notify', 'confirmtext', 'Hallo!\r\n	 \r\ndu hast dich auf der {TITLE} registriert und bekommst nun immer eine Benachrichtigung, wenn Hausaufgaben und Arbeiten anstehen. \r\n\r\nHier deine FTP-Logindaten:\r\n	\r\nServer: {FTPSERVER}\r\nPort: {FTPPORT}\r\nBenutzername: {FTPUSER}\r\nKennwort: {FTPPASSWORD}\r\n \r\nDer FTP ist NICHT fuer private Daten oder Aehnliches gedacht, sondern nur fuer unsere Schulsachen.\r\nBitte auch kein Weitergabe der Daten an andere, vor allem nicht Lehrer!\r\n \r\nDeine {TITLE}\r\n\r\n- Dies ist eine automatisch generierte E-Mail! -');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `user_lvl` int(1) NOT NULL,
  `activ` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_lvl`
--

CREATE TABLE IF NOT EXISTS `user_lvl` (
  `level` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_lvl`
--

INSERT INTO `user_lvl` (`level`, `name`) VALUES
(1, 'Benutzer'),
(2, 'Moderator'),
(3, 'Administrator'),
(4, 'Super Administrator');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
