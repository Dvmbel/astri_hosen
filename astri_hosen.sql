-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Mrz 2022 um 15:32
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `astri_hosen`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitarbeiter`
--

CREATE TABLE `mitarbeiter` (
  `mitarbeiter_id` int(255) NOT NULL,
  `mitarbeiter_vorname` varchar(255) NOT NULL,
  `mitarbeiter_nachname` varchar(255) NOT NULL,
  `mitarbeiter_benutzername` varchar(255) NOT NULL,
  `mitarbeiter_passwort` varchar(10000) NOT NULL,
  `mitarbeiter_role` varchar(255) NOT NULL,
  `mitarbeiter_datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `mitarbeiter`
--

INSERT INTO `mitarbeiter` (`mitarbeiter_id`, `mitarbeiter_vorname`, `mitarbeiter_nachname`, `mitarbeiter_benutzername`, `mitarbeiter_passwort`, `mitarbeiter_role`, `mitarbeiter_datum`) VALUES
(0, 'Webseiten', 'Besucher', 'besucher', 'Njg0NjA0ZWY4M2ZiY2EwMzMwNTIzYTZjZWQzYWFiMDAzNjBmNWYzOThlZDc5NzA3ZTg4YTc3ZTdlZjFiYzQxOQ==', 'viewer', '2021-09-10'),
(1, 'Dominik', 'Mitosinka', 'dominik.mitosinka', 'OTEyMDdiYzExZWRhNDJhZWIyMmM1MmZiZWQ1NmJhMjdiNmZhODA4ZDMwYmNmOTQ3NjFmZWMzZDIxZTllNjAzNQ==', 'mitarbeiter', '2021-09-01'),
(2, 'David', 'Ladner', 'david.ladner', 'OTEyMDdiYzExZWRhNDJhZWIyMmM1MmZiZWQ1NmJhMjdiNmZhODA4ZDMwYmNmOTQ3NjFmZWMzZDIxZTllNjAzNQ==', 'mitarbeiter', '2021-09-09'),
(3, 'Matteo', 'Suitner', 'matteo.suitner', 'OTEyMDdiYzExZWRhNDJhZWIyMmM1MmZiZWQ1NmJhMjdiNmZhODA4ZDMwYmNmOTQ3NjFmZWMzZDIxZTllNjAzNQ==', 'mitarbeiter', '2021-09-19'),
(4, 'Clemens', 'Strigl', 'clemens.strigl', 'OTEyMDdiYzExZWRhNDJhZWIyMmM1MmZiZWQ1NmJhMjdiNmZhODA4ZDMwYmNmOTQ3NjFmZWMzZDIxZTllNjAzNQ==', 'admin', '2021-10-08'),
(5, 'Eva', 'Suitner', 'eva.suitner', 'OTEyMDdiYzExZWRhNDJhZWIyMmM1MmZiZWQ1NmJhMjdiNmZhODA4ZDMwYmNmOTQ3NjFmZWMzZDIxZTllNjAzNQ==', 'admin', '2021-10-08'),
(92, 'Michael', 'Netzer', 'michael.netzer', '', 'admin', '2022-03-22'),
(95, 'Michael', 'Netzer', 'michael.netzer.2', '', 'mitarbeiter', '2022-03-22');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkt`
--

CREATE TABLE `produkt` (
  `produkt_id` int(255) NOT NULL,
  `produkt_bez` varchar(30) NOT NULL,
  `produkt_menge` int(255) NOT NULL,
  `produkt_preis` double NOT NULL,
  `produkt_bild` varchar(255) DEFAULT NULL,
  `produkt_datum` date NOT NULL,
  `produkt_beschreibung` text DEFAULT NULL,
  `produkt_link` varchar(10000) DEFAULT NULL,
  `produkt_mindest_menge` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `produkt`
--

INSERT INTO `produkt` (`produkt_id`, `produkt_bez`, `produkt_menge`, `produkt_preis`, `produkt_bild`, `produkt_datum`, `produkt_beschreibung`, `produkt_link`, `produkt_mindest_menge`) VALUES
(1000, 'Grandl 767', 19, 179, 'https://www.astri.at/shop/a13_content/uploads/2020/09/astri_Grandl_767_1.jpg', '2021-09-01', 'Zweifärbige Hose aus Schoeller Shape mit hohem Baumwoll- Anteil.', 'https://www.astri.at/shop/produkt/grandl-767/', 20),
(2000, 'SIKA 888/08', 30, 175, 'https://www.astri.at/shop/a13_content/uploads/2020/09/astri_sika_888_1.jpg', '2021-09-01', 'Die technische Jagdhose aus Loden & BW-Stretch.', 'https://www.astri.at/shop/produkt/sika-888/', 10),
(3000, 'TEUFELSHORN 696', 20, 139, 'https://www.astri.at/shop/a13_content/uploads/2020/09/astri_Teufelshorn_696_1.jpg', '2021-10-08', 'Leichte funktionelle Hose für den täglichen Einsatz.', 'https://www.astri.at/shop/produkt/rax-696/', 0),
(4000, 'ARLBERG 788/08', 20, 199, 'https://www.astri.at/shop/a13_content/uploads/2021/02/astri_arlberg_888_2.jpg', '2021-10-08', 'Der Klassiker ..die Jagdhose für jeden Einsatz x-fach bewährt.', 'https://www.astri.at/shop/produkt/arlberg-788-08/', 0),
(5000, 'SIKA 696/08', 20, 159, 'https://www.astri.at/shop/a13_content/uploads/2020/09/astri_sika_696_1.jpg', '2021-10-08', 'Die technische Jagdhose aus leichtem Soft-Shell.', 'https://www.astri.at/shop/produkt/sika-696/', 0),
(6000, 'RAX 696/08', 21, 155, 'https://www.astri.at/shop/a13_content/uploads/2020/09/astri_rax_696_1.jpg', '2021-10-08', 'Robuste funktionelle Jagdhose für den täglichen Einsatz.', 'https://www.astri.at/shop/produkt/rax_696_08/', 20);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  ADD PRIMARY KEY (`mitarbeiter_id`);

--
-- Indizes für die Tabelle `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`produkt_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  MODIFY `mitarbeiter_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
