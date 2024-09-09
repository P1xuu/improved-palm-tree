-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Wrz 2024, 09:48
-- Wersja serwera: 10.4.13-MariaDB
-- Wersja PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `panstwa_miasta`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `jezyk_narodowy`
--

CREATE TABLE `jezyk_narodowy` (
  `kod_kraju` char(3) DEFAULT NULL,
  `jezyk_urzedowy` char(30) DEFAULT NULL,
  `czy_jezyk_urzedowy_jest_oficjalny` enum('T','N') DEFAULT NULL,
  `jaki_procent_ludnosci_uzywa_jezyka_urzedowego` decimal(4,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kraje`
--

CREATE TABLE `kraje` (
  `id_kraju` char(3) NOT NULL,
  `nazwa` char(52) DEFAULT NULL,
  `kontynent` enum('azja','europa','ameryka p??nocna','ameryka po?udniowa','afryka','antarktyda','oceania') DEFAULT NULL,
  `region_swiata` char(26) DEFAULT NULL,
  `powierzchnia` decimal(10,2) DEFAULT NULL,
  `rok_uzyskania_niepodleglosci` smallint(6) DEFAULT NULL,
  `ilosc_ludnosci` int(11) DEFAULT NULL,
  `sredni_dozywany_wiek` decimal(3,1) DEFAULT NULL,
  `PNB` decimal(10,2) DEFAULT NULL,
  `stolica` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stolica_krajowa`
--

CREATE TABLE `stolica_krajowa` (
  `ID` int(11) NOT NULL,
  `nazwa` char(35) DEFAULT NULL,
  `kod_kraju` char(3) DEFAULT NULL,
  `populacja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `jezyk_narodowy`
--
ALTER TABLE `jezyk_narodowy`
  ADD KEY `kod_kraju` (`kod_kraju`);

--
-- Indeksy dla tabeli `kraje`
--
ALTER TABLE `kraje`
  ADD PRIMARY KEY (`id_kraju`);

--
-- Indeksy dla tabeli `stolica_krajowa`
--
ALTER TABLE `stolica_krajowa`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `kod_kraju` (`kod_kraju`);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `jezyk_narodowy`
--
ALTER TABLE `jezyk_narodowy`
  ADD CONSTRAINT `jezyk_narodowy_ibfk_1` FOREIGN KEY (`kod_kraju`) REFERENCES `kraje` (`id_kraju`);

--
-- Ograniczenia dla tabeli `stolica_krajowa`
--
ALTER TABLE `stolica_krajowa`
  ADD CONSTRAINT `stolica_krajowa_ibfk_1` FOREIGN KEY (`kod_kraju`) REFERENCES `kraje` (`id_kraju`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
