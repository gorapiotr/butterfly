-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 12 Sty 2018, 18:37
-- Wersja serwera: 10.1.24-MariaDB-cll-lve
-- Wersja PHP: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `v119154_zad6`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `jezyk`
--

CREATE TABLE `jezyk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nazwa` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `archiwum` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `jezyk`
--

INSERT INTO `jezyk` (`id`, `nazwa`, `archiwum`) VALUES
(1, 'polski', 0),
(2, 'angielski', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nazwa` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `opis` text COLLATE utf8_polish_ci NOT NULL,
  `obrazek` blob,
  `archiwum` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kategoria`
--

INSERT INTO `kategoria` (`id`, `nazwa`, `opis`, `obrazek`, `archiwum`) VALUES
(1, 'Zwierzęta', 'Opis', '', 0),
(2, 'Ludzie', 'Bla bla', '', 0),
(3, 'Rzeczy', 'lalala', '', 0),
(4, 'Czynności', 'lalala', '', 0),
(5, 'Prywatne', 'Ukryta kategoria prywatna', NULL, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konto`
--

CREATE TABLE `konto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rola_id` bigint(20) UNSIGNED DEFAULT '4',
  `imie` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `login` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `archiwum` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `konto`
--

INSERT INTO `konto` (`id`, `rola_id`, `imie`, `nazwisko`, `email`, `login`, `haslo`, `archiwum`) VALUES
(2, 1, 'Adam', 'Adamski', 'admin@admin.pl', 'admin', 'admin', 0),
(3, 2, 'Roman', 'Romanowski', 'roman@rr.pl', 'roman', 'roman', 0),
(4, 3, 'Stefan', 'Stefański', 'ste.fan@rr.pl', 'stefan', 'stefan', 0),
(5, 4, 'Ula', 'Ulanowska', 'ula@rr.pl', 'ula', 'ula', 0),
(6, 4, 'Test', 'Test', 'olek@olek.pl', 'olek', 'olek', 0),
(7, 4, 'Franek', 'Frankowski', 'ula@wp.pl', 'franek', 'franek', 0),
(8, 4, 'Alicja', 'Szafrańska', 'ala@ala.pl', 'ala', 'ala', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `podkategoria`
--

CREATE TABLE `podkategoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategoria_id` bigint(20) UNSIGNED NOT NULL,
  `nazwa` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `opis` text COLLATE utf8_polish_ci NOT NULL,
  `obrazek` blob,
  `archiwum` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `podkategoria`
--

INSERT INTO `podkategoria` (`id`, `kategoria_id`, `nazwa`, `opis`, `obrazek`, `archiwum`) VALUES
(4, 1, 'Ptaki', 'bla', '', 0),
(5, 1, 'Pancerniki', 'aa', '', 0),
(6, 2, 'Rodzina', 'bla bla', '', 0),
(8, 3, 'Pojazdy', 'opis', '', 0),
(9, 5, 'PRYWATNE ZESTAWY', 'Ukryta podkategoria prywatna', NULL, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rola`
--

CREATE TABLE `rola` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nazwa` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `opis` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `archiwum` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rola`
--

INSERT INTO `rola` (`id`, `nazwa`, `opis`, `archiwum`) VALUES
(1, 'Administrator', 'Posiada pełne uprawnienia, może logować się do zaplecza', 0),
(2, 'Redaktor', 'Może dodawać zestawy do wybranych podkategorii, może edytować i usuwać własne zestawy', 0),
(3, 'SuperRedaktor', 'Może edytować wszystkie zestawy do których ma dostęp', 0),
(4, 'Użytkownik', 'Może zapisywać wyniki, może oglądać postępu nauki, może tworzyć własne zestawy', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uprawnienia`
--

CREATE TABLE `uprawnienia` (
  `konto_id` bigint(20) UNSIGNED NOT NULL,
  `podkategoria_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uprawnienia`
--

INSERT INTO `uprawnienia` (`konto_id`, `podkategoria_id`) VALUES
(2, 4),
(3, 5),
(4, 5),
(4, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wynik`
--

CREATE TABLE `wynik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `konto_id` bigint(20) UNSIGNED NOT NULL,
  `zestaw_id` bigint(20) UNSIGNED NOT NULL,
  `data_wyniku` date NOT NULL,
  `wynik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wynik`
--

INSERT INTO `wynik` (`id`, `konto_id`, `zestaw_id`, `data_wyniku`, `wynik`) VALUES
(6, 2, 2, '2017-12-31', 86),
(7, 2, 4, '2017-12-31', 50),
(8, 2, 4, '2017-12-31', 100),
(9, 2, 3, '2017-12-31', 80),
(10, 2, 5, '2017-12-31', 75),
(11, 2, 5, '2017-12-31', 100),
(12, 3, 12, '2018-01-10', 67),
(13, 3, 12, '2018-01-10', 100),
(14, 5, 11, '2018-01-10', 100),
(15, 5, 2, '2018-01-10', 57),
(16, 2, 4, '2018-01-11', 75),
(17, 2, 14, '2018-01-11', 75),
(18, 2, 14, '2018-01-11', 75),
(19, 2, 14, '2018-01-11', 100),
(20, 2, 14, '2018-01-11', 25),
(21, 8, 15, '2018-01-11', 100),
(22, 8, 15, '2018-01-11', 80),
(23, 8, 17, '2018-01-12', 100);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zestaw`
--

CREATE TABLE `zestaw` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `konto_id` bigint(20) UNSIGNED NOT NULL,
  `jezyk1_id` bigint(20) UNSIGNED NOT NULL,
  `jezyk2_id` bigint(20) UNSIGNED NOT NULL,
  `podkategoria_id` bigint(20) UNSIGNED NOT NULL,
  `nazwa` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `zestaw` text COLLATE utf8_polish_ci NOT NULL,
  `ilosc_slowek` int(11) NOT NULL,
  `data_dodania` date NOT NULL,
  `data_edycji` date DEFAULT NULL,
  `archiwum` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zestaw`
--

INSERT INTO `zestaw` (`id`, `konto_id`, `jezyk1_id`, `jezyk2_id`, `podkategoria_id`, `nazwa`, `zestaw`, `ilosc_slowek`, `data_dodania`, `data_edycji`, `archiwum`) VALUES
(2, 3, 1, 2, 5, 'Mięsożerne', 'starożytny;ancient astronom;astronomer wierzyć;believe obliczyć;calculate centrum;centre zmienić;change obwód;circumference ', 7, '2018-01-01', '2018-01-12', 0),
(3, 3, 1, 2, 8, 'Roślinożerne', 'dokładnie;exactly płaski;flat głupiec;fool grób;grave obliczyć;calculate ', 5, '2018-01-01', '2018-01-12', 0),
(4, 4, 1, 2, 5, 'Wszystkożerne', 'dokładnie;exactly płaski;flat głupiec;fool grób;grave ', 4, '2018-01-01', '2018-01-12', 0),
(5, 4, 1, 2, 8, 'Latające', 'dokładnie;exactly płaski;flat głupiec;fool grób;grave ', 4, '2017-12-19', '2018-01-12', 0),
(6, 4, 2, 1, 8, 'Poduszkowce', 'door;drzwi tree;drzewo ', 2, '2018-01-08', '2018-01-12', 0),
(9, 2, 2, 1, 4, 'Transportowe', 'door;drzwi ', 1, '2018-01-09', '2018-01-12', 0),
(10, 2, 2, 1, 4, 'Test', 'starożytny;ancient astronom;astronomer wierzyć;believe ', 3, '2018-01-08', '2018-01-12', 0),
(11, 5, 2, 1, 9, 'Moje', 'print;drukować eat;jeść set;ustawić,zestaw ', 3, '2018-01-10', '2018-01-11', 0),
(12, 3, 1, 2, 9, 'Do-nauczenia', 'olej;oil mięso;meat trawa;grass ', 3, '2018-01-10', '2018-01-12', 0),
(13, 4, 1, 2, 9, 'Kolory', 'biały;white czarny;black zielony;green niebieski;blue ', 4, '2018-01-10', '2018-01-12', 0),
(14, 2, 2, 1, 9, 'Mój-zestaw', 'red;czerwony green;zielony white;biały black;czarny ', 4, '2018-01-11', '2018-01-12', 0),
(15, 8, 2, 1, 9, 'Mój-pierwszy-zestaw', 'one;jeden two;dwa three;trzy four;cztery five;pięć ', 5, '2018-01-11', '2018-01-12', 0),
(16, 3, 2, 1, 9, 'Test', 'test;test new;nowy ', 2, '2018-01-12', '2018-01-12', 0),
(17, 8, 2, 1, 9, 'Mój-drugi-zestaw', 'one;jeden two;dwa ', 2, '2018-01-12', '2018-01-12', 0);

--
-- Wyzwalacze `zestaw`
--
DELIMITER $$
CREATE TRIGGER `SlowkaInsert` BEFORE INSERT ON `zestaw` FOR EACH ROW SET NEW.ilosc_slowek= LENGTH(trim(NEW.zestaw)) - LENGTH(REPLACE(trim(NEW.zestaw), ';', ''))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `SlowkaUpdate` BEFORE UPDATE ON `zestaw` FOR EACH ROW SET NEW.ilosc_slowek= LENGTH(trim(NEW.zestaw)) - LENGTH(REPLACE(trim(NEW.zestaw), ';', ''))
$$
DELIMITER ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `jezyk`
--
ALTER TABLE `jezyk`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `konto`
--
ALTER TABLE `konto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rola_id` (`rola_id`);

--
-- Indeksy dla tabeli `podkategoria`
--
ALTER TABLE `podkategoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategoria_id` (`kategoria_id`);

--
-- Indeksy dla tabeli `rola`
--
ALTER TABLE `rola`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uprawnienia`
--
ALTER TABLE `uprawnienia`
  ADD PRIMARY KEY (`konto_id`,`podkategoria_id`),
  ADD KEY `podkategoria_id` (`podkategoria_id`);

--
-- Indeksy dla tabeli `wynik`
--
ALTER TABLE `wynik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zestaw_id` (`zestaw_id`),
  ADD KEY `konto_id` (`konto_id`);

--
-- Indeksy dla tabeli `zestaw`
--
ALTER TABLE `zestaw`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `jezyk1_id` (`jezyk1_id`),
  ADD KEY `jezyk2_id` (`jezyk2_id`),
  ADD KEY `podkategoria_id` (`podkategoria_id`),
  ADD KEY `konto_id` (`konto_id`),
  ADD KEY `nazwa` (`nazwa`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `jezyk`
--
ALTER TABLE `jezyk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `konto`
--
ALTER TABLE `konto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `podkategoria`
--
ALTER TABLE `podkategoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `rola`
--
ALTER TABLE `rola`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `wynik`
--
ALTER TABLE `wynik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT dla tabeli `zestaw`
--
ALTER TABLE `zestaw`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `konto`
--
ALTER TABLE `konto`
  ADD CONSTRAINT `konto_ibfk_1` FOREIGN KEY (`rola_id`) REFERENCES `rola` (`id`);

--
-- Ograniczenia dla tabeli `podkategoria`
--
ALTER TABLE `podkategoria`
  ADD CONSTRAINT `podkategoria_ibfk_1` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoria` (`id`);

--
-- Ograniczenia dla tabeli `uprawnienia`
--
ALTER TABLE `uprawnienia`
  ADD CONSTRAINT `uprawnienia_ibfk_1` FOREIGN KEY (`konto_id`) REFERENCES `konto` (`id`),
  ADD CONSTRAINT `uprawnienia_ibfk_2` FOREIGN KEY (`podkategoria_id`) REFERENCES `podkategoria` (`id`);

--
-- Ograniczenia dla tabeli `wynik`
--
ALTER TABLE `wynik`
  ADD CONSTRAINT `wynik_ibfk_1` FOREIGN KEY (`zestaw_id`) REFERENCES `zestaw` (`id`),
  ADD CONSTRAINT `wynik_ibfk_2` FOREIGN KEY (`konto_id`) REFERENCES `konto` (`id`);

--
-- Ograniczenia dla tabeli `zestaw`
--
ALTER TABLE `zestaw`
  ADD CONSTRAINT `zestaw_ibfk_1` FOREIGN KEY (`jezyk1_id`) REFERENCES `jezyk` (`id`),
  ADD CONSTRAINT `zestaw_ibfk_2` FOREIGN KEY (`jezyk2_id`) REFERENCES `jezyk` (`id`),
  ADD CONSTRAINT `zestaw_ibfk_3` FOREIGN KEY (`podkategoria_id`) REFERENCES `podkategoria` (`id`),
  ADD CONSTRAINT `zestaw_ibfk_4` FOREIGN KEY (`konto_id`) REFERENCES `konto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
