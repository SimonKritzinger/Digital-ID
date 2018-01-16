-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Jan 2018 um 21:17
-- Server-Version: 10.1.26-MariaDB
-- PHP-Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `digitalid`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `aktionbuerger`
--

CREATE TABLE `aktionbuerger` (
  `abnummer` int(11) NOT NULL,
  `enummer` int(11) NOT NULL,
  `bnummer` int(11) NOT NULL,
  `abaktion` enum('hinzufügen','bearbeiten','löschen') COLLATE latin1_german1_ci NOT NULL,
  `abzeitpunkt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `beamten`
--

CREATE TABLE `beamten` (
  `enummer` int(11) NOT NULL,
  `bnummer` int(11) NOT NULL,
  `eemailadresse` varchar(50) COLLATE latin1_german1_ci NOT NULL,
  `epasswort` varchar(60) COLLATE latin1_german1_ci NOT NULL,
  `eletzerlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `everwalter` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buerger`
--

CREATE TABLE `buerger` (
  `bnummer` int(11) NOT NULL,
  `bkartennummer` binary(7) NOT NULL,
  `bvorname` varchar(50) COLLATE latin1_german1_ci NOT NULL,
  `bnachname` varchar(50) COLLATE latin1_german1_ci NOT NULL,
  `bsteuernummer` varchar(50) COLLATE latin1_german1_ci NOT NULL,
  `bhash` varchar(60) COLLATE latin1_german1_ci NOT NULL,
  `bgeburtsdatum` date NOT NULL,
  `bgeburtsort` int(11) NOT NULL,
  `bstrasse` varchar(50) COLLATE latin1_german1_ci NOT NULL,
  `bstrassennummer` varchar(10) COLLATE latin1_german1_ci NOT NULL,
  `onummer` int(11) NOT NULL,
  `bfamilienstand` enum('ledig','verheiratet','verwitwet','geschieden','Ehe aufgehoben','eingetragene Lebenspartnerschaft','durch Tod aufgelöste Lebenspartnerschaft','aufgehobene Lebenspartnerschaft','durch Todeserklärung aufgelöste Lebenspartnerschaft') COLLATE latin1_german1_ci DEFAULT 'ledig',
  `bberuf` varchar(50) COLLATE latin1_german1_ci DEFAULT NULL,
  `bgroesse` tinyint(3) UNSIGNED NOT NULL,
  `bhaare` varchar(30) COLLATE latin1_german1_ci NOT NULL,
  `baugen` varchar(30) COLLATE latin1_german1_ci NOT NULL,
  `bbeskennzeichen` varchar(150) COLLATE latin1_german1_ci DEFAULT NULL,
  `bbild` mediumblob NOT NULL,
  `bstatus` enum('lebendig','verschwunden','gesucht','verstorben') COLLATE latin1_german1_ci DEFAULT NULL,
  `bgeschlecht` tinyint(1) NOT NULL,
  `bgelöscht` tinyint(1) DEFAULT '0',
  `blöschdatum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buergeraccount`
--

CREATE TABLE `buergeraccount` (
  `anummer` int(11) NOT NULL,
  `bnummer` int(11) NOT NULL,
  `aemailadresse` varchar(50) COLLATE latin1_german1_ci NOT NULL,
  `apassword` varchar(60) COLLATE latin1_german1_ci NOT NULL,
  `aletzerlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nutzer`
--

CREATE TABLE `nutzer` (
  `nnummer` int(11) NOT NULL,
  `bnummer` int(11) NOT NULL,
  `nemailadresse` varchar(50) COLLATE latin1_german1_ci NOT NULL,
  `npasswort` varchar(60) COLLATE latin1_german1_ci NOT NULL,
  `aletzerlogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orte`
--

CREATE TABLE `orte` (
  `onummer` int(11) NOT NULL,
  `oname` varchar(50) COLLATE latin1_german1_ci NOT NULL,
  `pnummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `provinzen`
--

CREATE TABLE `provinzen` (
  `pnummer` int(11) NOT NULL,
  `pname` varchar(50) COLLATE latin1_german1_ci NOT NULL,
  `snummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `staaten`
--

CREATE TABLE `staaten` (
  `snummer` int(11) NOT NULL,
  `sname` varchar(50) COLLATE latin1_german1_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `staatsbuegerschaften`
--

CREATE TABLE `staatsbuegerschaften` (
  `bnummer` int(11) NOT NULL,
  `snummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `aktionbuerger`
--
ALTER TABLE `aktionbuerger`
  ADD PRIMARY KEY (`abnummer`),
  ADD KEY `enummer` (`enummer`),
  ADD KEY `bnummer` (`bnummer`);

--
-- Indizes für die Tabelle `beamten`
--
ALTER TABLE `beamten`
  ADD PRIMARY KEY (`enummer`),
  ADD UNIQUE KEY `bnummer` (`bnummer`),
  ADD UNIQUE KEY `eemailadresse` (`eemailadresse`),
  ADD KEY `bnummer_2` (`bnummer`);

--
-- Indizes für die Tabelle `buerger`
--
ALTER TABLE `buerger`
  ADD PRIMARY KEY (`bnummer`),
  ADD UNIQUE KEY `bkartennummer` (`bkartennummer`),
  ADD UNIQUE KEY `bsteuernummer` (`bsteuernummer`),
  ADD KEY `onummer` (`onummer`),
  ADD KEY `bgeburtsort` (`bgeburtsort`);

--
-- Indizes für die Tabelle `buergeraccount`
--
ALTER TABLE `buergeraccount`
  ADD PRIMARY KEY (`anummer`),
  ADD UNIQUE KEY `bnummer` (`bnummer`),
  ADD UNIQUE KEY `aemailadresse` (`aemailadresse`),
  ADD KEY `bnummer_2` (`bnummer`);

--
-- Indizes für die Tabelle `nutzer`
--
ALTER TABLE `nutzer`
  ADD PRIMARY KEY (`nnummer`),
  ADD UNIQUE KEY `nemailadresse` (`nemailadresse`),
  ADD UNIQUE KEY `bnummer` (`bnummer`) USING BTREE;

--
-- Indizes für die Tabelle `orte`
--
ALTER TABLE `orte`
  ADD PRIMARY KEY (`onummer`),
  ADD KEY `pnummer` (`pnummer`);

--
-- Indizes für die Tabelle `provinzen`
--
ALTER TABLE `provinzen`
  ADD PRIMARY KEY (`pnummer`),
  ADD KEY `snummer` (`snummer`);

--
-- Indizes für die Tabelle `staaten`
--
ALTER TABLE `staaten`
  ADD PRIMARY KEY (`snummer`);

--
-- Indizes für die Tabelle `staatsbuegerschaften`
--
ALTER TABLE `staatsbuegerschaften`
  ADD PRIMARY KEY (`bnummer`,`snummer`),
  ADD KEY `bnummer` (`bnummer`),
  ADD KEY `snummer` (`snummer`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `aktionbuerger`
--
ALTER TABLE `aktionbuerger`
  MODIFY `abnummer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `beamten`
--
ALTER TABLE `beamten`
  MODIFY `enummer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `buerger`
--
ALTER TABLE `buerger`
  MODIFY `bnummer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `buergeraccount`
--
ALTER TABLE `buergeraccount`
  MODIFY `anummer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `nutzer`
--
ALTER TABLE `nutzer`
  MODIFY `nnummer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `orte`
--
ALTER TABLE `orte`
  MODIFY `onummer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `provinzen`
--
ALTER TABLE `provinzen`
  MODIFY `pnummer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `staaten`
--
ALTER TABLE `staaten`
  MODIFY `snummer` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `aktionbuerger`
--
ALTER TABLE `aktionbuerger`
  ADD CONSTRAINT `aktionbuerger_ibfk_1` FOREIGN KEY (`enummer`) REFERENCES `beamten` (`enummer`) ON UPDATE CASCADE,
  ADD CONSTRAINT `aktionbuerger_ibfk_2` FOREIGN KEY (`bnummer`) REFERENCES `buerger` (`bnummer`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `beamten`
--
ALTER TABLE `beamten`
  ADD CONSTRAINT `beamten_ibfk_1` FOREIGN KEY (`bnummer`) REFERENCES `buerger` (`bnummer`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `buerger`
--
ALTER TABLE `buerger`
  ADD CONSTRAINT `buerger_ibfk_1` FOREIGN KEY (`onummer`) REFERENCES `orte` (`onummer`) ON UPDATE CASCADE,
  ADD CONSTRAINT `buerger_ibfk_2` FOREIGN KEY (`bgeburtsort`) REFERENCES `orte` (`onummer`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `buergeraccount`
--
ALTER TABLE `buergeraccount`
  ADD CONSTRAINT `buergeraccount_ibfk_1` FOREIGN KEY (`bnummer`) REFERENCES `buerger` (`bnummer`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `nutzer`
--
ALTER TABLE `nutzer`
  ADD CONSTRAINT `nutzer_ibfk_1` FOREIGN KEY (`bnummer`) REFERENCES `buerger` (`bnummer`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `orte`
--
ALTER TABLE `orte`
  ADD CONSTRAINT `orte_ibfk_1` FOREIGN KEY (`pnummer`) REFERENCES `provinzen` (`pnummer`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `provinzen`
--
ALTER TABLE `provinzen`
  ADD CONSTRAINT `provinzen_ibfk_1` FOREIGN KEY (`snummer`) REFERENCES `staaten` (`snummer`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `staatsbuegerschaften`
--
ALTER TABLE `staatsbuegerschaften`
  ADD CONSTRAINT `staatsbuegerschaften_ibfk_1` FOREIGN KEY (`bnummer`) REFERENCES `buerger` (`bnummer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staatsbuegerschaften_ibfk_2` FOREIGN KEY (`snummer`) REFERENCES `staaten` (`snummer`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
