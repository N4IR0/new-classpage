-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 22. Mai 2014 um 19:43
-- Server Version: 5.5.37-0ubuntu0.14.04.1
-- PHP-Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `fi13a`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin_category`
--

CREATE TABLE IF NOT EXISTS `admin_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(30) NOT NULL,
  `user_lvl` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `admin_category`
--

INSERT INTO `admin_category` (`id`, `name`, `url`, `user_lvl`) VALUES
(1, 'Dashboard', 'dashboard', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin_pages`
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
-- Daten für Tabelle `admin_pages`
--

INSERT INTO `admin_pages` (`id`, `name`, `url`, `cat`, `user_lvl`) VALUES
(1, 'Home', 'home', 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `name`, `url`) VALUES
(1, 'Dashboard', 'dashboard'),
(2, 'Stundenplan', 'timetable');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `homework_group1`
--

CREATE TABLE IF NOT EXISTS `homework_group1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(20) DEFAULT NULL,
  `description` text,
  `date` varchar(15) DEFAULT NULL,
  `notify_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `homework_group1`
--

INSERT INTO `homework_group1` (`id`, `subject`, `description`, `date`, `notify_date`) VALUES
(1, 'Englisch', 'Aufsatz', '1419445833', '20141220'),
(2, 'Deutsch', 'Lernen', '1419445833', '20151220'),
(3, 'Englisch', 'Aufsatz', '1401211873', '20141220'),
(4, 'Deutsch', 'Lernen', '1400866273', '20151220');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `homework_group2`
--

CREATE TABLE IF NOT EXISTS `homework_group2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(20) DEFAULT NULL,
  `description` text,
  `date` varchar(15) DEFAULT NULL,
  `notify_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `homework_group2`
--

INSERT INTO `homework_group2` (`id`, `subject`, `description`, `date`, `notify_date`) VALUES
(1, 'Englisch', 'Aufsatz', '1419445833', '20141220'),
(2, 'Deutsch', 'Lernen', '1419445833', '20151220'),
(3, 'Englisch', 'Aufsatz', '1401211873', '20141220'),
(4, 'Deutsch', 'Lernen', '1400866273', '20151220');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(30) NOT NULL,
  `cat` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `pages`
--

INSERT INTO `pages` (`id`, `name`, `url`, `cat`) VALUES
(1, 'Home', 'home', 1),
(2, 'Gruppe 1', 'group1', 2),
(3, 'Gruppe 2', 'group2', 2),
(4, 'Gruppe 1', 'group1', 1),
(5, 'Gruppe 2', 'group2', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(200) NOT NULL,
  `setting` varchar(200) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Daten für Tabelle `settings`
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
(24, 'notify', 'confirmtext', 'Hallo!\r\n	 \r\ndu hast dich auf der {TITLE} registriert und bekommst nun immer eine Benachrichtigung, wenn Hausaufgaben und Arbeiten anstehen. \r\n\r\nHier deine FTP-Logindaten:\r\n	\r\nServer: {FTPSERVER}\r\nPort: {FTPPORT}\r\nBenutzername: {FTPUSER}\r\nKennwort: {FTPPASSWORD}\r\n \r\nDer FTP ist NICHT fuer private Daten oder Aehnliches gedacht, sondern nur fuer unsere Schulsachen.\r\nBitte auch kein Weitergabe der Daten an andere, vor allem nicht Lehrer!\r\n \r\nDeine {TITLE}\r\n\r\n- Dies ist eine automatisch generierte E-Mail! -'),
(25, 'updates', 'substitution', '1400773056'),
(26, 'updates', 'homework', ''),
(27, 'updates', 'tests', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `substitution`
--

CREATE TABLE IF NOT EXISTS `substitution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) DEFAULT NULL,
  `date` varchar(15) DEFAULT NULL,
  `lesson` varchar(50) DEFAULT NULL,
  `hours` varchar(150) DEFAULT NULL,
  `teacher` varchar(200) DEFAULT NULL,
  `group` tinyint(4) DEFAULT NULL,
  `notify_date` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Daten für Tabelle `substitution`
--

INSERT INTO `substitution` (`id`, `type`, `date`, `lesson`, `hours`, `teacher`, `group`, `notify_date`) VALUES
(1, 1, '1400450400', 'ITS-GDI', '1;2;3', 'Möller', 0, ''),
(2, 1, '1400450400', 'ITS-BS', '4;5;6', 'Gaugenrieder', 0, ''),
(3, 0, '1400450400', NULL, '7;8', NULL, 0, ''),
(4, 1, '1400536800', 'Sp', '3;4', 'Papritz', 0, ''),
(5, 1, '1400536800', 'EBA-Projekt', '5;6', 'Begerock', 0, ''),
(6, 0, '1400536800', NULL, '7;8', NULL, 0, ''),
(7, 0, '1400623200', NULL, '3;4', NULL, 1, ''),
(8, 1, '1400623200', 'EBA-Java', '1;2;3;4', 'Schumann', 2, ''),
(9, 0, '1400796000', NULL, '1;2', NULL, 1, ''),
(10, 1, '1400796000', 'EBA-Java', '4;5;6', 'Schumann', 1, ''),
(11, 1, '1400796000', 'ITS-GDI', '4;5;6', 'Möller', 2, ''),
(12, 1, '1401055200', 'ITS-BS', '4;5;6', 'Gaugenrieder', 0, NULL),
(13, 2, '1401314400', 'Himmelfahrt', '1;2;3;4;5;6;7;8', NULL, 0, NULL),
(14, 2, '1401400800', 'Brückentag', '1;2;3;4;5;6;7;8', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `lessons` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Daten für Tabelle `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `lessons`) VALUES
(5, 'Gaugenrieder', 'ITS-BS'),
(6, 'Möller', 'ITS-GDI'),
(7, 'Schulz', 'ITS-HW;ITS-Inst'),
(8, 'Gehrenz', 'ITS-AM'),
(9, 'Schmidt', 'BWG'),
(10, 'Papritz', 'Sp'),
(11, 'Stüber', 'Eng'),
(12, 'Schumann', 'EBA-Java'),
(13, 'Neubert', 'Deu'),
(14, 'Taschik', 'EBA-HTML'),
(15, 'Begerock', 'EBA-Projekt');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `timetable_group1`
--

CREATE TABLE IF NOT EXISTS `timetable_group1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mon` varchar(20) DEFAULT NULL,
  `tue` varchar(20) DEFAULT NULL,
  `wed` varchar(20) DEFAULT NULL,
  `thu` varchar(20) DEFAULT NULL,
  `fri` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `timetable_group1`
--

INSERT INTO `timetable_group1` (`id`, `mon`, `tue`, `wed`, `thu`, `fri`) VALUES
(1, 'ITS-GDI', 'ITS-AM', NULL, 'EBA-HTML', 'EBA-Java'),
(2, 'ITS-GDI', 'ITS-AM', NULL, 'EBA-HTML', 'EBA-Java'),
(3, 'ITS-GDI', 'BWG', 'BWG', 'EBA-Projekt', 'Deu'),
(4, 'ITS-BS', 'BWG', 'BWG', 'EBA-Projekt', 'BWG'),
(5, 'ITS-BS', 'SP', 'Deu', 'ITS-Inst', 'BWG'),
(6, 'ITS-BS', 'Sp', 'Deu', 'ITS-Inst', 'BWG'),
(7, 'ITS-HW', 'Eng', 'ITS-HW', NULL, NULL),
(8, 'ITS-HW', 'Eng', 'ITS-Inst', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `timetable_group2`
--

CREATE TABLE IF NOT EXISTS `timetable_group2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mon` varchar(20) DEFAULT NULL,
  `tue` varchar(20) DEFAULT NULL,
  `wed` varchar(20) DEFAULT NULL,
  `thu` varchar(20) DEFAULT NULL,
  `fri` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `timetable_group2`
--

INSERT INTO `timetable_group2` (`id`, `mon`, `tue`, `wed`, `thu`, `fri`) VALUES
(1, 'ITS-BS', 'ITS-AM', 'EBA-Java', 'EBA-Projekt', NULL),
(2, 'ITS-BS', 'ITS-AM', 'EBA-Java', 'EBA-Projekt', NULL),
(3, 'ITS-BS', 'BWG', 'BWG', 'EBA-HTML', 'Deu'),
(4, 'ITS-GDI', 'BWG', 'BWG', 'EBA-HTML', 'BWG'),
(5, 'ITS-GDI', 'SP', 'Deu', 'ITS-Inst', 'BWG'),
(6, 'ITS-GDI', 'Sp', 'Deu', 'ITS-Inst', 'BWG'),
(7, 'ITS-HW', 'Eng', 'ITS-HW', NULL, NULL),
(8, 'ITS-HW', 'Eng', 'ITS-Inst', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
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
-- Tabellenstruktur für Tabelle `user_lvl`
--

CREATE TABLE IF NOT EXISTS `user_lvl` (
  `level` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user_lvl`
--

INSERT INTO `user_lvl` (`level`, `name`) VALUES
(1, 'Benutzer'),
(2, 'Moderator'),
(3, 'Administrator'),
(4, 'Super Administrator');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
