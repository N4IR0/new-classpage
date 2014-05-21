-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 21. Mai 2014 um 02:20
-- Server Version: 5.5.37-0ubuntu0.14.04.1
-- PHP-Version: 5.5.9-1ubuntu4

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `name`, `url`) VALUES
(1, 'Dashboard', 'dashboard');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `pages`
--

INSERT INTO `pages` (`id`, `name`, `url`, `cat`) VALUES
(1, 'Home', 'home', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Daten für Tabelle `settings`
--

INSERT INTO `settings` (`id`, `key`, `setting`, `value`) VALUES
(1, 'website', 'title', 'FI_13A Infoseite'),
(2, 'website', 'url', 'http://www.fi13a.de'),
(3, 'website', 'adminurl', 'http://admin.fi13a.de'),
(4, 'ftp', 'server', 'ftp.fi13a.de'),
(5, 'ftp', 'port', '21'),
(6, 'ftp', 'user', 'fi13'),
(7, 'ftp', 'password', 'changeme'),
(8, 'smtp', 'server', 'ssl://localhost'),
(9, 'smtp', 'port', '465'),
(10, 'smtp', 'user', 'noreply@fi13a.de'),
(11, 'smtp', 'password', 'changeme'),
(12, 'notify', 'mail', 'noreply@fi13a.de'),
(13, 'notify', 'prefix', '[FI_13A]'),
(14, 'notify', 'sender', 'Infowebsite'),
(15, 'notify', 'logpath', '/var/www/vhosts/fi13a.de/httpdocs/notification_log'),
(16, 'notify', 'confirmsubject', 'Infowebsite - Anmeldung'),
(17, 'notify', 'remindersubject', 'Erinnerung: {DAYS}'),
(18, 'notify', 'reminderbegin', 'Dies ist eine Erinnerungsmail fuer anstehende Hausaufgaben oder Arbeiten.\n'),
(19, 'notify', 'testreminder', 'Folgende Arbeiten sind in {DAYS}:\n\r'),
(20, 'notify', 'hwreminder', 'Folgende Hausaufgaben sind in {DAYS} fällig:\n\r'),
(21, 'notify', 'reminderend', '\r\n\r\nWeitere Informationen unter {URL}\r\nDein Erinnerungsservice der {TITLE}\r\n\r\n- Dies ist eine automatisch generierte E-Mail! -'),
(22, 'notify', 'newreg', 'Hallo!\r\n\r\nes sind neue E-Mailadressen vorhanden, welche auf eine Freischaltung warten.\r\n\r\nBitte autorisiere diese im Adminpanel unter {ADMURL} unter "E-Mails".\r\n\r\nDeine {TITLE}\r\n\r\n- Dies ist eine automatisch generierte E-Mail! -'),
(23, 'notify', 'confirmtext', 'Hallo!\r\n	 \r\ndu hast dich auf der {TITLE} registriert und bekommst nun immer eine Benachrichtigung, wenn Hausaufgaben und Arbeiten anstehen. \r\n\r\nHier deine FTP-Logindaten:\r\n	\r\nServer: {FTPSERVER}\r\nPort: {FTPPORT}\r\nBenutzername: {FTPUSER}\r\nKennwort: {FTPPASSWORD}\r\n \r\nDer FTP ist NICHT fuer private Daten oder Aehnliches gedacht, sondern nur fuer unsere Schulsachen.\r\nBitte auch kein Weitergabe der Daten an andere, vor allem nicht Lehrer!\r\n \r\nDeine {TITLE}\r\n\r\n- Dies ist eine automatisch generierte E-Mail! -');

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