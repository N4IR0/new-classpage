-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 22. Mai 2014 um 19:04
-- Server Version: 5.5.37-0ubuntu0.14.04.1
-- PHP-Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `fi13a`
--

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
