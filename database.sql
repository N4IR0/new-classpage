-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 07. Jun 2014 um 03:10
-- Server Version: 5.6.16
-- PHP-Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
  `external` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `admin_category`
--

INSERT INTO `admin_category` (`id`, `name`, `url`, `user_lvl`, `external`) VALUES
(1, 'Dashboard', 'dashboard', 1, 0),
(2, 'Termine', 'dates', 2, 0),
(3, 'Stundeplan', 'timetable', 2, 0),
(4, 'Einstellungen', 'settings', 3, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `admin_pages`
--

INSERT INTO `admin_pages` (`id`, `name`, `url`, `cat`, `user_lvl`) VALUES
(1, 'Home', 'home', 1, 1),
(2, 'Account', 'account', 1, 1),
(3, 'Benutzerverwaltung', 'users', 1, 3),
(4, 'Gruppe 1', 'group1', 2, 2),
(5, 'Gruppe 2', 'group2', 2, 2),
(6, 'Allgemein', 'general', 3, 3),
(7, 'Gruppe 1', 'group1', 3, 3),
(8, 'Gruppe 2', 'group2', 3, 3),
(9, 'Website', 'website', 4, 3),
(10, 'FTP', 'ftp', 4, 3),
(11, 'SMTP', 'smtp', 4, 3),
(12, 'Benachrichtigung', 'notify', 4, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(30) NOT NULL,
  `user_lvl` int(11) NOT NULL DEFAULT '0',
  `external` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `name`, `url`, `user_lvl`, `external`) VALUES
(1, 'Dashboard', 'dashboard', 0, 0),
(2, 'Stundenplan', 'timetable', 0, 0),
(3, 'FTP-Server', 'ftp://ftp.fi13a.de', 0, 1),
(4, 'Statistiken', 'statistics', 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `homework`
--

CREATE TABLE IF NOT EXISTS `homework` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(20) DEFAULT NULL,
  `topic` text NOT NULL,
  `description` text,
  `date` varchar(15) DEFAULT NULL,
  `notify_date` varchar(15) DEFAULT NULL,
  `link` text,
  `group` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `homework`
--

INSERT INTO `homework` (`id`, `subject`, `topic`, `description`, `date`, `notify_date`, `link`, `group`) VALUES
(2, 'Fach 1', 'Test', 'Test', '1404079200', NULL, NULL, '0'),
(4, 'Fach 2', 'Test', 'Test', '1403647200', NULL, NULL, '0'),
(6, 'Fach 3', 'Test', 'Test', '1408917600', NULL, NULL, '0'),
(8, 'Fach 4', 'Test', 'Test', '1403474400', NULL, NULL, '0'),
(10, 'Fach 5', 'Test', 'Test', '1406412000', NULL, NULL, '0'),
(12, 'Fach 6', 'Test', 'Test', '1411768800', NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(30) NOT NULL,
  `cat` int(2) NOT NULL,
  `user_lvl` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `pages`
--

INSERT INTO `pages` (`id`, `name`, `url`, `cat`, `user_lvl`) VALUES
(2, 'Gruppe 1', 'group1', 2, 0),
(3, 'Gruppe 2', 'group2', 2, 0),
(4, 'Gruppe 1', 'group1', 1, 0),
(5, 'Gruppe 2', 'group2', 1, 0),
(6, 'Übersicht', 'home', 4, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schooltime`
--

CREATE TABLE IF NOT EXISTS `schooltime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(15) DEFAULT NULL,
  `to` varchar(15) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `schooltime`
--

INSERT INTO `schooltime` (`id`, `from`, `to`, `year`) VALUES
(1, '1379887200', '1380664800', 1),
(2, '1384729200', '1385679600', 1),
(3, '1390172400', '1391122800', 1),
(4, '1395010800', '1395961200', 1),
(5, '1400450400', '1402005600', 1),
(6, '1404079200', '1405634400', 1),
(7, '1410732000', '1411682400', 2),
(8, '1416783600', '1417734000', 2),
(9, '1421622000', '1422572400', 2),
(10, '1427065200', '1427752800', 2),
(11, '1431900000', '1433455200', 2),
(12, '1434924000', '1435874400', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Daten für Tabelle `settings`
--

INSERT INTO `settings` (`id`, `key`, `setting`, `value`) VALUES
(1, 'website', 'title', 'FI_13A Infoseite'),
(2, 'website', 'class', 'FI_13A'),
(3, 'website', 'url', 'http://dev.fi13a.de'),
(4, 'website', 'admin_url', 'http://dev.fi13a.de'),
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
(25, 'updates', 'substitution', '1401918296'),
(26, 'updates', 'homework', ''),
(27, 'updates', 'tests', '1401918296'),
(28, 'website', 'path', '/'),
(29, 'website', 'admin_path', '/admin/');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

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
(14, 2, '1401400800', 'Brückentag', '1;2;3;4;5;6;7;8', NULL, 0, NULL),
(15, 0, '1400536800', NULL, '1;2', NULL, 0, NULL),
(16, 1, '1401055200', 'ITS-GDI', '1;2;3', 'Möller', 0, NULL),
(17, 1, '1401141600', 'Aufgabenstellung', '3', 'Gehrenz', 0, NULL),
(18, 1, '1401141600', 'ITS-GDI', '4', 'Möller', 0, NULL),
(19, 0, '1401228000', NULL, '3', NULL, 1, NULL),
(20, 1, '1401228000', 'EBA-Java', '3', 'Schumann', 2, NULL),
(21, 1, '1401228000', 'ITS-BS', '4', 'Gaugenrieder', 0, NULL),
(22, 1, '1401660000', 'ITS-HW', '1;2;3', 'Schulz', 0, NULL),
(23, 1, '1401660000', 'ITS-BS', '4;5;6', 'Gaugenrieder', 0, NULL),
(26, 1, '1401746400', 'Eng', '3;4', 'Stüber', 0, NULL),
(28, 0, '1401746400', NULL, '7;8', NULL, 0, NULL),
(30, 0, '1401832800', NULL, '1;2;3', NULL, 0, NULL),
(32, 1, '1401832800', 'ITS-GDI', '4', 'Möller', 0, NULL),
(34, 1, '1402005600', 'EBA-Java', '1;2;3', 'Schumann', 1, NULL),
(36, 1, '1402005600', 'EBA-Java', '4;5;6', 'Schumann', 2, NULL),
(38, 0, '1401832800', NULL, '7;8', NULL, 0, NULL),
(40, 1, '1401919200', 'EBA-Projekt', '1;2', 'Begerock', 1, NULL),
(42, 0, '1401919200', NULL, '1;2', NULL, 2, NULL),
(44, 0, '1402005600', NULL, '1;2;3', NULL, 2, NULL),
(46, 0, '1402005600', NULL, '4;5;6', NULL, 1, NULL);

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
-- Tabellenstruktur für Tabelle `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(20) DEFAULT NULL,
  `topic` text NOT NULL,
  `description` text,
  `date` varchar(15) DEFAULT NULL,
  `notify_date` varchar(15) DEFAULT NULL,
  `link` text,
  `group` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `tests`
--

INSERT INTO `tests` (`id`, `subject`, `topic`, `description`, `date`, `notify_date`, `link`, `group`) VALUES
(5, 'ITS-BS', 'Klassenarbeit', 'Themen: Prozesssteuerung, Ein-/Ausgabesteuerung', '1401660000', NULL, NULL, '0'),
(6, 'ITS-AM', 'Team', 'nA', '1401746400', NULL, NULL, '0'),
(8, 'ITS-GDI', 'Netzwerkberechnung', 'nA', '1401832800', NULL, NULL, '0'),
(10, 'ITS-Inst', 'Verlegearten, Kabellänge/-querschnittsberechnung', 'nA', '1401919200', NULL, NULL, '0'),
(12, 'EBA-Java', 'Grundlagen Java', 'nA', '1402005600', NULL, NULL, '0');

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
  `password` varchar(64) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `user_lvl` int(1) NOT NULL,
  `activ` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
(3, 'Administrator');