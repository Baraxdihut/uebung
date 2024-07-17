-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Apr 2024 um 16:58
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db_kfz`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_anreden`
--

CREATE TABLE `tbl_anreden` (
  `IDAnrede` int(10) NOT NULL,
  `Anrede` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_anreden`
--

INSERT INTO `tbl_anreden` (`IDAnrede`, `Anrede`) VALUES
(1, 'Herr'),
(2, 'Frau'),
(3, 'Divers');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_ersatzteile`
--

CREATE TABLE `tbl_ersatzteile` (
  `IDErsatzteile` int(10) NOT NULL,
  `FIDLieferant` int(10) NOT NULL,
  `Ersatzteilname` varchar(255) NOT NULL,
  `Einkauf` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_ersatzteile`
--

INSERT INTO `tbl_ersatzteile` (`IDErsatzteile`, `FIDLieferant`, `Ersatzteilname`, `Einkauf`) VALUES
(1, 1, 'Ölfilter', 5.00),
(2, 1, 'Luftfilter', 10.00),
(3, 2, 'Zündkerzen', 2.00),
(4, 3, 'Bremsbeläge', 30.00),
(5, 4, 'Scheibenwischer ', 15.00),
(6, 5, 'Batterie', 100.00),
(7, 5, 'Stoßdömpfer', 40.00),
(8, 4, 'Kupplungssatz', 150.00),
(9, 3, 'Wasserpumpe', 40.00),
(10, 3, 'Auspuffanlage', 300.00);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_karosserieform`
--

CREATE TABLE `tbl_karosserieform` (
  `IDKarosserieform` int(10) NOT NULL,
  `Karosserieform` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_karosserieform`
--

INSERT INTO `tbl_karosserieform` (`IDKarosserieform`, `Karosserieform`) VALUES
(1, 'Limousine'),
(2, 'Kombi'),
(3, 'SUV'),
(4, 'Cabrio'),
(5, 'Coupé'),
(6, 'Van'),
(7, 'Pick-up'),
(8, 'Kleinwagen'),
(9, 'Kompakt-SUV'),
(10, 'Roadster');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_kfz`
--

CREATE TABLE `tbl_kfz` (
  `IDKfz` int(10) NOT NULL,
  `FIDKunde` int(10) NOT NULL,
  `Kennzeichen` varchar(50) NOT NULL,
  `FIDMarke` int(10) NOT NULL,
  `FIDKarosserieform` int(10) NOT NULL,
  `FIDKraftstoff` int(10) NOT NULL,
  `Baujahr` int(4) NOT NULL,
  `Kilometerstand` int(11) NOT NULL,
  `Leistung` int(11) NOT NULL,
  `Zulassung` date NOT NULL,
  `Erstzulassung` date NOT NULL,
  `VIN` varchar(50) NOT NULL,
  `Motornummer` varchar(50) NOT NULL,
  `Hubraum` int(11) NOT NULL,
  `FIDTueren` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_kfz`
--

INSERT INTO `tbl_kfz` (`IDKfz`, `FIDKunde`, `Kennzeichen`, `FIDMarke`, `FIDKarosserieform`, `FIDKraftstoff`, `Baujahr`, `Kilometerstand`, `Leistung`, `Zulassung`, `Erstzulassung`, `VIN`, `Motornummer`, `Hubraum`, `FIDTueren`) VALUES
(7, 4, 'vb-alsda', 8, 8, 8, 2010, 25000, 160, '2024-03-18', '2024-03-25', '123456789', '123456789', 1, 3),
(10, 3, 'wl-askdas', 5, 1, 2, 2020, 1000, 200, '2024-04-01', '2024-04-08', '123456789', '123456789', 4, 3),
(11, 3, 'vb-5165', 2, 1, 4, 3000, 3000, 4, '2024-04-15', '2024-04-18', '12345', '12345', 4, 3),
(12, 4, 'xdgsdg', 7, 9, 9, 2150, 2150, 300, '2024-04-08', '2024-04-10', '12345', '12345', 5, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_konto`
--

CREATE TABLE `tbl_konto` (
  `IDKonto` int(10) NOT NULL,
  `Kontobezeichnung` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_konto`
--

INSERT INTO `tbl_konto` (`IDKonto`, `Kontobezeichnung`) VALUES
(1, 'Hauptkonto'),
(2, 'Sparbuch'),
(3, 'Gehaltskonto'),
(4, 'Gemeinschaftskonto'),
(5, 'Notfallfonds');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_kraftstoff`
--

CREATE TABLE `tbl_kraftstoff` (
  `IDKraftstoff` int(10) NOT NULL,
  `Kraftstoff` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_kraftstoff`
--

INSERT INTO `tbl_kraftstoff` (`IDKraftstoff`, `Kraftstoff`) VALUES
(1, 'Benzin'),
(2, 'Diesel'),
(3, 'Elektro'),
(4, 'Hybrid'),
(5, 'Erdgas'),
(6, 'Wasserstoff'),
(7, 'Biodiesel'),
(8, 'Autogas'),
(9, 'Bioethanol'),
(10, 'Synthetischer Kraftstoff');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_kunden`
--

CREATE TABLE `tbl_kunden` (
  `IDKunde` int(10) NOT NULL,
  `FIDAnrede` int(10) DEFAULT NULL,
  `Titel` varchar(20) DEFAULT NULL,
  `Vorname` varchar(255) DEFAULT NULL,
  `Nachname` varchar(255) DEFAULT NULL,
  `Firma` varchar(255) DEFAULT NULL,
  `Ort` varchar(255) DEFAULT NULL,
  `Plz` int(10) DEFAULT NULL,
  `Strasse` varchar(255) DEFAULT NULL,
  `Telefonnr` varchar(255) DEFAULT NULL,
  `Telefonnr2` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Kundeseit` date DEFAULT curdate(),
  `Fax` varchar(255) DEFAULT NULL,
  `Kommentar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_kunden`
--

INSERT INTO `tbl_kunden` (`IDKunde`, `FIDAnrede`, `Titel`, `Vorname`, `Nachname`, `Firma`, `Ort`, `Plz`, `Strasse`, `Telefonnr`, `Telefonnr2`, `Email`, `Kundeseit`, `Fax`, `Kommentar`) VALUES
(3, 3, 'test3', 'test3', 'test3', 'test3', 'test3', 1234, 'test3', '123456', '123456', 'test3@test3.com', '2024-03-20', '', 'test3'),
(4, 1, 'dr dr', 'Walter', 'White', 'Loco ', 'test1', 12345, 'test1', '123456', '123456', 'test1@test1.com', '2024-03-25', '', 'test1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_leistungen`
--

CREATE TABLE `tbl_leistungen` (
  `IDLeistungen` int(10) NOT NULL,
  `FIDRechnungen` int(10) DEFAULT NULL,
  `FIDKonto` int(10) DEFAULT NULL,
  `FIDErsatzteile` int(10) DEFAULT NULL,
  `FIDStatus` int(10) NOT NULL,
  `Verkauf` decimal(10,2) NOT NULL,
  `Menge` decimal(10,2) NOT NULL,
  `Bezeichnung` varchar(255) NOT NULL,
  `Steuersatz` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_leistungen`
--

INSERT INTO `tbl_leistungen` (`IDLeistungen`, `FIDRechnungen`, `FIDKonto`, `FIDErsatzteile`, `FIDStatus`, `Verkauf`, `Menge`, `Bezeichnung`, `Steuersatz`) VALUES
(4, 11, 1, 3, 2, 40.00, 2.00, '', '20%'),
(5, 18, 1, 4, 2, 50.00, 4.00, '', '20%'),
(6, 18, 1, 5, 1, 30.00, 2.00, '', '20%'),
(7, 16, 1, 1, 1, 70.00, 1.00, '', '20%'),
(8, 16, 1, 10, 1, 1000.00, 1.00, '', '20%'),
(9, 16, 1, 8, 1, 100.00, 1.00, '', '20%'),
(10, 16, 1, 2, 1, 500.00, 1.00, '', '20%'),
(11, 16, 1, 7, 1, 150.00, 4.00, '', '20%'),
(12, 16, 1, 4, 1, 66.00, 4.00, '', '20%');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_lieferant`
--

CREATE TABLE `tbl_lieferant` (
  `IDLieferant` int(10) NOT NULL,
  `Lieferant` varchar(255) NOT NULL,
  `Ort` varchar(255) NOT NULL,
  `Strasse` varchar(255) NOT NULL,
  `PLZ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_lieferant`
--

INSERT INTO `tbl_lieferant` (`IDLieferant`, `Lieferant`, `Ort`, `Strasse`, `PLZ`) VALUES
(1, 'Lieferant A', 'Berlin', 'Musterstraße 1', 12345),
(2, 'Lieferant B', 'Hamburg', 'Beispielweg 2', 54321),
(3, 'Lieferant C', 'München', 'Testgasse 3', 98765),
(4, 'Lieferant D', 'Köln', 'Musterweg 4', 67890),
(5, 'Lieferant E', 'Frankfurt', 'Beispielstraße 5', 13579);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_marke`
--

CREATE TABLE `tbl_marke` (
  `IDMarke` int(10) NOT NULL,
  `Marke` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_marke`
--

INSERT INTO `tbl_marke` (`IDMarke`, `Marke`) VALUES
(1, 'Volkswagen'),
(2, 'Toyota'),
(3, 'Ford'),
(4, 'BMW'),
(5, 'Mercedes-Benz'),
(6, 'Audi'),
(7, 'Honda'),
(8, 'Nissan'),
(9, 'Chevrolet'),
(10, 'Hyundai');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_rechnungen`
--

CREATE TABLE `tbl_rechnungen` (
  `IDRechnungen` int(10) NOT NULL,
  `FIDKfz` int(10) DEFAULT NULL,
  `FIDTaetigkeiten` int(10) DEFAULT NULL,
  `Rechnungsnummer` varchar(20) NOT NULL,
  `Rechnungsdatum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_rechnungen`
--

INSERT INTO `tbl_rechnungen` (`IDRechnungen`, `FIDKfz`, `FIDTaetigkeiten`, `Rechnungsnummer`, `Rechnungsdatum`) VALUES
(11, 7, 1, 'R-11', '2024-04-08 16:27:53'),
(13, 7, 8, 'R-13', '2024-04-08 16:31:35'),
(15, 12, 6, 'R-14', '2024-04-08 17:01:34'),
(16, 11, 8, 'R-16', '2024-04-08 17:02:05'),
(17, 12, 3, 'R-17', '2024-04-08 17:04:55'),
(18, 12, 4, 'R-18', '2024-04-12 07:28:23');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_status`
--

CREATE TABLE `tbl_status` (
  `IDStatus` int(10) NOT NULL,
  `Statusbezeichnung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_status`
--

INSERT INTO `tbl_status` (`IDStatus`, `Statusbezeichnung`) VALUES
(1, 'Offen'),
(2, 'Teilbezahlt'),
(3, 'Bezahlt');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_taetigkeiten`
--

CREATE TABLE `tbl_taetigkeiten` (
  `IDTaetigkeiten` int(10) NOT NULL,
  `Taetigkeiten` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_taetigkeiten`
--

INSERT INTO `tbl_taetigkeiten` (`IDTaetigkeiten`, `Taetigkeiten`) VALUES
(1, 'Inspektionen und Wartung'),
(2, 'Reparaturen und Diagnose'),
(3, 'Elektronische Diagnose und Reparaturen'),
(4, 'Karosseriearbeiten'),
(5, 'Reifenwechsel und -reparatur'),
(6, 'Fahrzeugtuning und Leistungssteigerung'),
(7, 'Fahrzeugwartung vor der Hauptuntersuchung (HU)'),
(8, 'Kundenberatung und -service');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_tueren`
--

CREATE TABLE `tbl_tueren` (
  `IDTueren` int(10) NOT NULL,
  `Anzahl` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_tueren`
--

INSERT INTO `tbl_tueren` (`IDTueren`, `Anzahl`) VALUES
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `view_rechnung_leistungen`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `view_rechnung_leistungen` (
`IDRechnungen` int(10)
,`IDLeistungen` int(10)
,`Bezeichnung` varchar(255)
,`Verkauf` decimal(10,2)
,`Menge` decimal(10,2)
,`Steuersatz` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur des Views `view_rechnung_leistungen`
--
DROP TABLE IF EXISTS `view_rechnung_leistungen`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_rechnung_leistungen`  AS SELECT `r`.`IDRechnungen` AS `IDRechnungen`, `l`.`IDLeistungen` AS `IDLeistungen`, `l`.`Bezeichnung` AS `Bezeichnung`, `l`.`Verkauf` AS `Verkauf`, `l`.`Menge` AS `Menge`, `l`.`Steuersatz` AS `Steuersatz` FROM (`tbl_rechnungen` `r` join `tbl_leistungen` `l` on(`r`.`IDRechnungen` = `l`.`FIDRechnungen`)) ;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_anreden`
--
ALTER TABLE `tbl_anreden`
  ADD PRIMARY KEY (`IDAnrede`);

--
-- Indizes für die Tabelle `tbl_ersatzteile`
--
ALTER TABLE `tbl_ersatzteile`
  ADD PRIMARY KEY (`IDErsatzteile`),
  ADD KEY `tbl_ersatzteile_ibfk_1` (`FIDLieferant`);

--
-- Indizes für die Tabelle `tbl_karosserieform`
--
ALTER TABLE `tbl_karosserieform`
  ADD PRIMARY KEY (`IDKarosserieform`);

--
-- Indizes für die Tabelle `tbl_kfz`
--
ALTER TABLE `tbl_kfz`
  ADD PRIMARY KEY (`IDKfz`),
  ADD KEY `tbl_kfz_ibfk_2` (`FIDMarke`),
  ADD KEY `tbl_kfz_ibfk_3` (`FIDKarosserieform`),
  ADD KEY `tbl_kfz_ibfk_4` (`FIDKraftstoff`),
  ADD KEY `tbl_kfz_ibfk_5` (`FIDTueren`),
  ADD KEY `tbl_kfz_ibfk_6` (`FIDKunde`);

--
-- Indizes für die Tabelle `tbl_konto`
--
ALTER TABLE `tbl_konto`
  ADD PRIMARY KEY (`IDKonto`);

--
-- Indizes für die Tabelle `tbl_kraftstoff`
--
ALTER TABLE `tbl_kraftstoff`
  ADD PRIMARY KEY (`IDKraftstoff`);

--
-- Indizes für die Tabelle `tbl_kunden`
--
ALTER TABLE `tbl_kunden`
  ADD PRIMARY KEY (`IDKunde`),
  ADD KEY `FIDAnrede` (`FIDAnrede`);

--
-- Indizes für die Tabelle `tbl_leistungen`
--
ALTER TABLE `tbl_leistungen`
  ADD PRIMARY KEY (`IDLeistungen`),
  ADD KEY `FIDRechnungen` (`FIDRechnungen`,`FIDKonto`,`FIDErsatzteile`),
  ADD KEY `tbl_leistungen_ibfk_2` (`FIDErsatzteile`),
  ADD KEY `tbl_leistungen_ibfk_3` (`FIDKonto`),
  ADD KEY `FIDStatus` (`FIDStatus`);

--
-- Indizes für die Tabelle `tbl_lieferant`
--
ALTER TABLE `tbl_lieferant`
  ADD PRIMARY KEY (`IDLieferant`);

--
-- Indizes für die Tabelle `tbl_marke`
--
ALTER TABLE `tbl_marke`
  ADD PRIMARY KEY (`IDMarke`);

--
-- Indizes für die Tabelle `tbl_rechnungen`
--
ALTER TABLE `tbl_rechnungen`
  ADD PRIMARY KEY (`IDRechnungen`),
  ADD KEY `FIDKfz` (`FIDKfz`,`FIDTaetigkeiten`),
  ADD KEY `FIDTaetigkeiten` (`FIDTaetigkeiten`);

--
-- Indizes für die Tabelle `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`IDStatus`);

--
-- Indizes für die Tabelle `tbl_taetigkeiten`
--
ALTER TABLE `tbl_taetigkeiten`
  ADD PRIMARY KEY (`IDTaetigkeiten`);

--
-- Indizes für die Tabelle `tbl_tueren`
--
ALTER TABLE `tbl_tueren`
  ADD PRIMARY KEY (`IDTueren`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_anreden`
--
ALTER TABLE `tbl_anreden`
  MODIFY `IDAnrede` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `tbl_ersatzteile`
--
ALTER TABLE `tbl_ersatzteile`
  MODIFY `IDErsatzteile` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `tbl_karosserieform`
--
ALTER TABLE `tbl_karosserieform`
  MODIFY `IDKarosserieform` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `tbl_kfz`
--
ALTER TABLE `tbl_kfz`
  MODIFY `IDKfz` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `tbl_konto`
--
ALTER TABLE `tbl_konto`
  MODIFY `IDKonto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `tbl_kraftstoff`
--
ALTER TABLE `tbl_kraftstoff`
  MODIFY `IDKraftstoff` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `tbl_kunden`
--
ALTER TABLE `tbl_kunden`
  MODIFY `IDKunde` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `tbl_leistungen`
--
ALTER TABLE `tbl_leistungen`
  MODIFY `IDLeistungen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `tbl_lieferant`
--
ALTER TABLE `tbl_lieferant`
  MODIFY `IDLieferant` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `tbl_marke`
--
ALTER TABLE `tbl_marke`
  MODIFY `IDMarke` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `tbl_rechnungen`
--
ALTER TABLE `tbl_rechnungen`
  MODIFY `IDRechnungen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `IDStatus` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `tbl_taetigkeiten`
--
ALTER TABLE `tbl_taetigkeiten`
  MODIFY `IDTaetigkeiten` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `tbl_tueren`
--
ALTER TABLE `tbl_tueren`
  MODIFY `IDTueren` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tbl_ersatzteile`
--
ALTER TABLE `tbl_ersatzteile`
  ADD CONSTRAINT `tbl_ersatzteile_ibfk_1` FOREIGN KEY (`FIDLieferant`) REFERENCES `tbl_lieferant` (`IDLieferant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_kfz`
--
ALTER TABLE `tbl_kfz`
  ADD CONSTRAINT `tbl_kfz_ibfk_2` FOREIGN KEY (`FIDMarke`) REFERENCES `tbl_marke` (`IDMarke`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kfz_ibfk_3` FOREIGN KEY (`FIDKarosserieform`) REFERENCES `tbl_karosserieform` (`IDKarosserieform`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kfz_ibfk_4` FOREIGN KEY (`FIDKraftstoff`) REFERENCES `tbl_kraftstoff` (`IDKraftstoff`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kfz_ibfk_5` FOREIGN KEY (`FIDTueren`) REFERENCES `tbl_tueren` (`IDTueren`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kfz_ibfk_6` FOREIGN KEY (`FIDKunde`) REFERENCES `tbl_kunden` (`IDKunde`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_kunden`
--
ALTER TABLE `tbl_kunden`
  ADD CONSTRAINT `tbl_kunden_ibfk_1` FOREIGN KEY (`FIDAnrede`) REFERENCES `tbl_anreden` (`IDAnrede`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_leistungen`
--
ALTER TABLE `tbl_leistungen`
  ADD CONSTRAINT `tbl_leistungen_ibfk_1` FOREIGN KEY (`FIDRechnungen`) REFERENCES `tbl_rechnungen` (`IDRechnungen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_leistungen_ibfk_3` FOREIGN KEY (`FIDKonto`) REFERENCES `tbl_konto` (`IDKonto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_leistungen_ibfk_4` FOREIGN KEY (`FIDErsatzteile`) REFERENCES `tbl_ersatzteile` (`IDErsatzteile`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_leistungen_ibfk_5` FOREIGN KEY (`FIDStatus`) REFERENCES `tbl_status` (`IDStatus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_rechnungen`
--
ALTER TABLE `tbl_rechnungen`
  ADD CONSTRAINT `tbl_rechnungen_ibfk_2` FOREIGN KEY (`FIDKfz`) REFERENCES `tbl_kfz` (`IDKfz`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_rechnungen_ibfk_3` FOREIGN KEY (`FIDTaetigkeiten`) REFERENCES `tbl_taetigkeiten` (`IDTaetigkeiten`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
