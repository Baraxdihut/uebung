-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 06. Sep 2020 um 22:08
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db_lap2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_beleuchtungen`
--

CREATE TABLE `tbl_beleuchtungen` (
  `IDBeleuchtung` int(10) UNSIGNED NOT NULL,
  `Bezeichnung` varchar(64) NOT NULL,
  `Preis` decimal(5,2) UNSIGNED NOT NULL,
  `Lagerstand` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_beleuchtungen`
--

INSERT INTO `tbl_beleuchtungen` (`IDBeleuchtung`, `Bezeichnung`, `Preis`, `Lagerstand`) VALUES
(1, 'Standardbeleuchtung vorne und hinten', '69.90', 1982);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_bestellungen`
--

CREATE TABLE `tbl_bestellungen` (
  `IDBestellung` int(10) UNSIGNED NOT NULL,
  `FIDKunde` int(10) UNSIGNED NOT NULL,
  `FIDRahmentyp` int(10) UNSIGNED NOT NULL,
  `FIDFarbe` int(10) UNSIGNED NOT NULL,
  `FIDMotor` int(10) UNSIGNED NOT NULL,
  `FIDBremse` int(10) UNSIGNED NOT NULL,
  `FIDBeleuchtung` int(10) UNSIGNED DEFAULT NULL,
  `DatumBestellung` timestamp NOT NULL DEFAULT current_timestamp(),
  `DatumBezahlung` date DEFAULT NULL,
  `DatumAuslieferung` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_bestellungen`
--

INSERT INTO `tbl_bestellungen` (`IDBestellung`, `FIDKunde`, `FIDRahmentyp`, `FIDFarbe`, `FIDMotor`, `FIDBremse`, `FIDBeleuchtung`, `DatumBestellung`, `DatumBezahlung`, `DatumAuslieferung`) VALUES
(3, 1, 1, 1, 1, 2, NULL, '2020-09-01 19:15:39', NULL, NULL),
(4, 1, 3, 3, 2, 2, 1, '2020-09-04 19:17:56', NULL, NULL),
(5, 2, 2, 3, 2, 1, 1, '2020-09-02 19:55:06', NULL, NULL),
(6, 3, 3, 2, 2, 2, NULL, '2020-09-04 19:56:09', NULL, NULL),
(7, 4, 1, 2, 2, 2, 1, '2020-09-06 20:03:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_bremsen`
--

CREATE TABLE `tbl_bremsen` (
  `IDBremse` int(10) UNSIGNED NOT NULL,
  `Bezeichnung` varchar(32) NOT NULL,
  `Preis` decimal(5,2) UNSIGNED NOT NULL,
  `Lagerstand` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_bremsen`
--

INSERT INTO `tbl_bremsen` (`IDBremse`, `Bezeichnung`, `Preis`, `Lagerstand`) VALUES
(1, 'mechanisch', '0.00', 389),
(2, 'hydraulisch', '100.00', 97);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_farben`
--

CREATE TABLE `tbl_farben` (
  `IDFarbe` int(10) UNSIGNED NOT NULL,
  `Bezeichnung` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_farben`
--

INSERT INTO `tbl_farben` (`IDFarbe`, `Bezeichnung`) VALUES
(1, 'Rot'),
(2, 'Schwarz'),
(3, 'Weiß');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_kunden`
--

CREATE TABLE `tbl_kunden` (
  `IDKunde` int(10) UNSIGNED NOT NULL,
  `Nachname` varchar(64) NOT NULL,
  `Vorname` varchar(32) NOT NULL,
  `GebDatum` date DEFAULT NULL,
  `Adresse` varchar(64) NOT NULL,
  `PLZ` varchar(8) NOT NULL,
  `Ort` varchar(64) NOT NULL,
  `FIDStaat` int(10) UNSIGNED NOT NULL,
  `Emailadresse` varchar(128) NOT NULL,
  `Telefon` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_kunden`
--

INSERT INTO `tbl_kunden` (`IDKunde`, `Nachname`, `Vorname`, `GebDatum`, `Adresse`, `PLZ`, `Ort`, `FIDStaat`, `Emailadresse`, `Telefon`) VALUES
(1, 'Mutz', 'Uwe', '1972-10-17', 'Holzwindenerstr. 38', '4221', 'Steyregg', 1, 'uwe.mutz@syne.at', ''),
(2, 'Mutz', 'Silvia', '1978-05-02', 'Holzwindenerstr. 38', '4221', 'Steyregg', 1, 'silvia.mutz@syne.at', ''),
(3, 'Mutz', 'Jakob', '1997-08-01', 'Untere Bergstr. 7/2', '4300', 'St. Valentin', 1, 'jakob.mutz@syne.at', ''),
(4, 'Mutz', 'Uwe', '1972-10-17', 'Teststr. 1', '4020', 'Linz', 1, 'uwe.mutz@syne.at', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_motoren`
--

CREATE TABLE `tbl_motoren` (
  `IDMotor` int(10) UNSIGNED NOT NULL,
  `Bezeichnung` varchar(32) NOT NULL,
  `Preis` decimal(5,2) UNSIGNED NOT NULL,
  `Lagerstand` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_motoren`
--

INSERT INTO `tbl_motoren` (`IDMotor`, `Bezeichnung`, `Preis`, `Lagerstand`) VALUES
(1, '250W', '0.00', 51),
(2, '750W', '250.00', -2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_rahmenfarbkombinationen`
--

CREATE TABLE `tbl_rahmenfarbkombinationen` (
  `IDRahmenfarbkombination` int(10) UNSIGNED NOT NULL,
  `FIDRahmentyp` int(10) UNSIGNED NOT NULL,
  `FIDFarbe` int(10) UNSIGNED NOT NULL,
  `Lagerstand` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_rahmenfarbkombinationen`
--

INSERT INTO `tbl_rahmenfarbkombinationen` (`IDRahmenfarbkombination`, `FIDRahmentyp`, `FIDFarbe`, `Lagerstand`) VALUES
(1, 1, 1, 5),
(2, 1, 2, 67),
(3, 1, 3, 19),
(4, 2, 1, 0),
(5, 2, 3, 64),
(6, 3, 2, 181),
(7, 3, 3, 46);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_rahmentypen`
--

CREATE TABLE `tbl_rahmentypen` (
  `IDRahmentyp` int(10) UNSIGNED NOT NULL,
  `Bezeichnung` varchar(64) NOT NULL,
  `Beschreibung` text DEFAULT NULL,
  `Preis` decimal(6,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_rahmentypen`
--

INSERT INTO `tbl_rahmentypen` (`IDRahmentyp`, `Bezeichnung`, `Beschreibung`, `Preis`) VALUES
(1, 'Brettl', 'ungefederter Rahmen', '1500.00'),
(2, 'Hoibwach', 'Hardtail, nur vorne gefedert', '1800.00'),
(3, 'Supawach', 'Fully, vollgefedert', '2200.00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_staaten`
--

CREATE TABLE `tbl_staaten` (
  `IDStaat` int(10) UNSIGNED NOT NULL,
  `Bezeichnung` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_staaten`
--

INSERT INTO `tbl_staaten` (`IDStaat`, `Bezeichnung`) VALUES
(1, 'Österreich'),
(2, 'Deutschland'),
(3, 'Spanien'),
(4, 'Italien');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_beleuchtungen`
--
ALTER TABLE `tbl_beleuchtungen`
  ADD PRIMARY KEY (`IDBeleuchtung`);

--
-- Indizes für die Tabelle `tbl_bestellungen`
--
ALTER TABLE `tbl_bestellungen`
  ADD PRIMARY KEY (`IDBestellung`),
  ADD KEY `FIDKunde` (`FIDKunde`),
  ADD KEY `FIDRahmenfarbkombination` (`FIDRahmentyp`),
  ADD KEY `FIDMotor` (`FIDMotor`),
  ADD KEY `FIDBremse` (`FIDBremse`),
  ADD KEY `FIDBeleuchtung` (`FIDBeleuchtung`),
  ADD KEY `FIDFarbe` (`FIDFarbe`);

--
-- Indizes für die Tabelle `tbl_bremsen`
--
ALTER TABLE `tbl_bremsen`
  ADD PRIMARY KEY (`IDBremse`);

--
-- Indizes für die Tabelle `tbl_farben`
--
ALTER TABLE `tbl_farben`
  ADD PRIMARY KEY (`IDFarbe`);

--
-- Indizes für die Tabelle `tbl_kunden`
--
ALTER TABLE `tbl_kunden`
  ADD PRIMARY KEY (`IDKunde`),
  ADD KEY `FIDStaat` (`FIDStaat`);

--
-- Indizes für die Tabelle `tbl_motoren`
--
ALTER TABLE `tbl_motoren`
  ADD PRIMARY KEY (`IDMotor`);

--
-- Indizes für die Tabelle `tbl_rahmenfarbkombinationen`
--
ALTER TABLE `tbl_rahmenfarbkombinationen`
  ADD PRIMARY KEY (`IDRahmenfarbkombination`),
  ADD KEY `FIDRahmen` (`FIDRahmentyp`),
  ADD KEY `FIDFarbe` (`FIDFarbe`);

--
-- Indizes für die Tabelle `tbl_rahmentypen`
--
ALTER TABLE `tbl_rahmentypen`
  ADD PRIMARY KEY (`IDRahmentyp`);

--
-- Indizes für die Tabelle `tbl_staaten`
--
ALTER TABLE `tbl_staaten`
  ADD PRIMARY KEY (`IDStaat`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_beleuchtungen`
--
ALTER TABLE `tbl_beleuchtungen`
  MODIFY `IDBeleuchtung` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `tbl_bestellungen`
--
ALTER TABLE `tbl_bestellungen`
  MODIFY `IDBestellung` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `tbl_bremsen`
--
ALTER TABLE `tbl_bremsen`
  MODIFY `IDBremse` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `tbl_farben`
--
ALTER TABLE `tbl_farben`
  MODIFY `IDFarbe` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `tbl_kunden`
--
ALTER TABLE `tbl_kunden`
  MODIFY `IDKunde` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `tbl_motoren`
--
ALTER TABLE `tbl_motoren`
  MODIFY `IDMotor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `tbl_rahmenfarbkombinationen`
--
ALTER TABLE `tbl_rahmenfarbkombinationen`
  MODIFY `IDRahmenfarbkombination` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `tbl_rahmentypen`
--
ALTER TABLE `tbl_rahmentypen`
  MODIFY `IDRahmentyp` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `tbl_staaten`
--
ALTER TABLE `tbl_staaten`
  MODIFY `IDStaat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tbl_bestellungen`
--
ALTER TABLE `tbl_bestellungen`
  ADD CONSTRAINT `tbl_bestellungen_ibfk_1` FOREIGN KEY (`FIDKunde`) REFERENCES `tbl_kunden` (`IDKunde`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_bestellungen_ibfk_3` FOREIGN KEY (`FIDMotor`) REFERENCES `tbl_motoren` (`IDMotor`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_bestellungen_ibfk_4` FOREIGN KEY (`FIDBremse`) REFERENCES `tbl_bremsen` (`IDBremse`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_bestellungen_ibfk_5` FOREIGN KEY (`FIDBeleuchtung`) REFERENCES `tbl_beleuchtungen` (`IDBeleuchtung`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_bestellungen_ibfk_6` FOREIGN KEY (`FIDRahmentyp`) REFERENCES `tbl_rahmentypen` (`IDRahmentyp`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_bestellungen_ibfk_7` FOREIGN KEY (`FIDFarbe`) REFERENCES `tbl_farben` (`IDFarbe`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_rahmenfarbkombinationen`
--
ALTER TABLE `tbl_rahmenfarbkombinationen`
  ADD CONSTRAINT `tbl_rahmenfarbkombinationen_ibfk_1` FOREIGN KEY (`FIDFarbe`) REFERENCES `tbl_farben` (`IDFarbe`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_rahmenfarbkombinationen_ibfk_2` FOREIGN KEY (`FIDRahmentyp`) REFERENCES `tbl_rahmentypen` (`IDRahmentyp`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
