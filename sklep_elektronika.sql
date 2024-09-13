-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Wrz 2024, 11:08
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
-- Baza danych: `sklep_elektronika`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dostawcy`
--

CREATE TABLE `dostawcy` (
  `id_dostawcy` char(10) NOT NULL,
  `nazwa_dostawcy` char(50) DEFAULT NULL,
  `adres_urzedowania` char(50) DEFAULT NULL,
  `miasto` char(50) DEFAULT NULL,
  `wojewodztwo` char(20) DEFAULT NULL,
  `kod_pocztowy` char(10) DEFAULT NULL,
  `kraj` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `dostawcy`
--

INSERT INTO `dostawcy` (`id_dostawcy`, `nazwa_dostawcy`, `adres_urzedowania`, `miasto`, `wojewodztwo`, `kod_pocztowy`, `kraj`) VALUES
('D001', 'Dostawca Laptop?w', 'ul. Komputerowa 20', 'Warszawa', 'Mazowieckie', '00-002', 'Polska'),
('D002', 'Dostawca Smartfon?w', 'ul. Telefonowa 15', 'Krak?w', 'Ma?opolskie', '30-002', 'Polska');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id_klienta` char(10) NOT NULL,
  `nazwa_klienta` char(50) DEFAULT NULL,
  `adres_bilingowy` char(50) DEFAULT NULL,
  `adres_dostawy` enum('T','N') DEFAULT NULL,
  `miasto` char(50) DEFAULT NULL,
  `kod_pocztowy` char(10) DEFAULT NULL,
  `wojewodztwo` char(25) DEFAULT NULL,
  `kraj` char(25) DEFAULT NULL,
  `numer_kontaktowy` char(20) DEFAULT NULL,
  `email` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id_klienta`, `nazwa_klienta`, `adres_bilingowy`, `adres_dostawy`, `miasto`, `kod_pocztowy`, `wojewodztwo`, `kraj`, `numer_kontaktowy`, `email`) VALUES
('001', 'Klient 1', 'ul. Przyk?adowa 10', 'T', 'Warszawa', '00-001', 'Mazowieckie', 'Polska', '123456789', 'klient1@example.com'),
('002', 'Klient 2', 'ul. Testowa 15', 'N', 'Krak?w', '30-001', 'Ma?opolskie', 'Polska', '987654321', 'klient2@example.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `magazyn`
--

CREATE TABLE `magazyn` (
  `id_zamowienia` int(11) NOT NULL,
  `data_zamowienia` datetime DEFAULT NULL,
  `id_klienta` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `magazyn`
--

INSERT INTO `magazyn` (`id_zamowienia`, `data_zamowienia`, `id_klienta`) VALUES
(1, '2024-09-13 12:00:00', '001'),
(2, '2024-09-14 14:30:00', '002');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id_produktu` char(10) NOT NULL,
  `id_dostawcy` char(10) DEFAULT NULL,
  `nazwa_produktu` char(255) DEFAULT NULL,
  `cena_produktu` decimal(8,2) DEFAULT NULL,
  `opis_produktu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id_produktu`, `id_dostawcy`, `nazwa_produktu`, `cena_produktu`, `opis_produktu`) VALUES
('P001', 'D001', 'Laptop XYZ', '2500.00', 'Laptop z 16GB RAM, procesor Intel i7, 512GB SSD'),
('P002', 'D002', 'Smartfon ABC', '1500.00', 'Smartfon z 8GB RAM, 128GB pami?ci, ekran AMOLED');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id_zamowienia` int(11) NOT NULL,
  `data_zamowienia` datetime DEFAULT NULL,
  `id_klienta` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id_zamowienia`, `data_zamowienia`, `id_klienta`) VALUES
(1, '2024-09-13 12:00:00', '001'),
(2, '2024-09-14 14:30:00', '002');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dostawcy`
--
ALTER TABLE `dostawcy`
  ADD PRIMARY KEY (`id_dostawcy`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id_klienta`);

--
-- Indeksy dla tabeli `magazyn`
--
ALTER TABLE `magazyn`
  ADD PRIMARY KEY (`id_zamowienia`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id_produktu`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id_zamowienia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
