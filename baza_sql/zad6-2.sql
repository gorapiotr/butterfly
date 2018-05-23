-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 18 Lut 2018, 17:32
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
(1, 'Życie codzienne', '', '', 0),
(2, 'Człowiek', '', '', 0),
(3, 'Emocje i Uczucia', '', '', 0),
(4, 'Czynności', '', '', 0),
(5, 'Kultura', '', NULL, 0);

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
  `archiwum` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `password_reset_token` varchar(200) COLLATE utf8_polish_ci DEFAULT '',
  `account_activate_token` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `konto`
--

INSERT INTO `konto` (`id`, `rola_id`, `imie`, `nazwisko`, `email`, `login`, `haslo`, `archiwum`, `status`, `password_reset_token`, `account_activate_token`) VALUES
(2, 1, 'Robert', 'Fidytek', 'robert.fidytek@inf.ug.edu.pl', 'admin', '8c0d31064d115a0a9b71a147723173364f534948', 0, 1, NULL, NULL),
(3, 2, 'Roman', 'Romanowski', 'roman@rr.pl', 'roman', 'roman', 1, 0, '', NULL),
(4, 3, 'Stefan', 'Stefański', 'ste.fan@rr.pl', 'stefan', 'stefan', 1, 0, '', NULL),
(5, 4, 'Ula', 'Ulanowska', 'ula@rr.pl', 'ula', 'ula', 1, 0, '', NULL),
(6, 4, 'Test', 'Test', 'olek@olek.pl', 'olek', 'olek', 1, 0, '', NULL),
(7, 4, 'Franek', 'Frankowski', 'ula@wp.pl', 'franek', 'franek', 1, 0, '', NULL),
(8, 4, 'Alicja', 'Szafrańska', 'ala@ala.pl', 'ala', 'ala', 1, 0, '', NULL),
(9, 4, 'Wojciech', 'Grabowski', 'fer@dek.dek', 'ferdek', '80ed5d02a2cf8f46d10467517fe505b4e92ad24c', 1, 1, NULL, NULL),
(12, 4, 'Wojciech', 'Dunia', 'w.dunia@gmail.com', 'wdunia', '15985e73bfe2e61c83c1b328087be49992d25081', 0, 0, '', NULL);

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
(4, 1, 'Rodzina', '', '', 0),
(5, 1, 'Dom i mieszkanie', '', '', 0),
(6, 1, 'W mieszkaniu', '', '', 0),
(8, 1, 'Podstawy', '', '', 0),
(9, 5, 'PRYWATNE ZESTAWY', 'Ukryta podkategoria prywatna', NULL, 0),
(10, 2, 'Części ciała', '', NULL, 0),
(11, 2, 'Cechy charakteru', '', NULL, 0),
(12, 2, 'Wygląd', '', NULL, 0),
(13, 3, 'Strach', '', NULL, 0),
(14, 3, 'Radość', '', NULL, 0),
(16, 3, 'Wzajemne relacje', '', NULL, 0),
(17, 5, 'Film', '', NULL, 0);

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
(23, 8, 17, '2018-01-12', 100),
(24, 4, 13, '2018-01-12', 75),
(25, 4, 13, '2018-01-12', 100),
(26, 4, 19, '2018-01-12', 33),
(27, 4, 19, '2018-01-12', 100),
(28, 4, 13, '2018-01-13', 75);

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
(23, 2, 2, 1, 4, 'Zestaw', 'marriage;małżeństwo married;zamężna mother;mama mother-in-law;teściowa niece;siostrzenica orphan;sierota parents;rodzice relatives;krewni sister;siostra sister-in-law;bratowa son;syn son-in-law;zięć step-father;ojczym step-mother;macocha twin;bliźniak uncle;wujek upbringing;wychowanie widow;wdowa widower;wdowiec wife;żona', 20, '2018-02-08', '2018-02-08', 0),
(24, 2, 2, 1, 5, 'Zestaw', 'balcony;balkon bathroom;łazienka bedroom;sypialnia ceiling;sufit cellar;piwnica corridor;korytarz door;drzwi gate;furtka hall;przedpokój hedge;żywopłot kitchen;kuchnia rent;czynsz roof;dach room;pokój toilet;toaleta wall;ściana window;okno', 17, '2018-02-08', '2018-02-08', 0),
(25, 2, 2, 1, 6, 'Zestaw', 'bed;łóżko floor;podłoga fork;widelec glass;szklanka heater;grzejnik knife;nóż lamp;lampa lock;zamek mirror;lustro mug;kubek oven;piekarnik pan;patelnia table;stół colander;durszlak corkscrew;korkociąg cutlery;sztućce funnel;lejek ladle;chochla peeler;obieraczka pepperpot;pieprzniczka plate;talerz saucer;spodek sifter;przesiewacz skimmer;cedzidło spoon;łyżka strainer;sitko whisk;trzepaczka', 27, '2018-02-08', '2018-02-08', 0),
(26, 2, 2, 1, 8, 'Podstawowe słówka', 'bidet;bidet black-head;wągier dirt;brud dirty;brudny hygienic;higieniczny bag;saszetka briefcase;aktówka calendar;kalendarz cap;czapka comb;grzebień diary;terminarz', 11, '2018-02-08', '2018-02-08', 0),
(27, 2, 2, 1, 10, 'Zestaw', 'fist;pięść elbow;łokieć face;twarz fist;pięść forehead;czoło gum;dziąsło hair;włosy hand;ręka head;głowa heart;serce hip;biodro knee;kolano larynx;krtań ', 13, '0000-00-00', NULL, 0),
(28, 2, 2, 1, 11, 'Zestaw', 'bore;nudziarz boring;nudny carefree;beztroski character;charakter cheeky;bezczelny clever;zdolny conceited;zarozumiały courageous;odważny coward;tchórz cowardly;tchórzliwy cruel;okrutny dishonest;nieuczciwy faithful;wierny ', 13, '0000-00-00', NULL, 0),
(29, 2, 2, 1, 12, 'Zestaw', 'blackhead;wągier blond;blondyn blonde;blondynka braid;warkoczyk charm;wdzięk chubby;pucołowaty corpulent;korpulentny spotty;pryszczaty squint;zez stocky;krępy stout;tęgi strong;silny suntan;opalenizna suntanned;opalony ', 14, '2018-02-08', '2018-02-08', 0),
(30, 2, 2, 1, 13, 'Zestaw', 'aghast;przerażony dread;lęk fear;strach jittery;roztrzęsiony panic;panika restless;niespokojny restlessly;niespokojnie ', 7, '0000-00-00', NULL, 0),
(31, 2, 2, 1, 14, 'Zestaw', 'elated;rozradowany elation;rozradowanie enthusiasm;entuzjazm exhilarating;radosny exultant;rozradowany gaiety;wesołość gaily;wesoło glee;radość gleeful;rozradowany happy;szczęśliwy ', 10, '0000-00-00', NULL, 0),
(32, 2, 2, 1, 16, 'Zestaw', 'enemy;wróg enmity;wrogość lover;kochanek malevolence;wrogość malevolent;wrogi quarrel;kłótnia rancour;nienawiść reluctance;niechęć respect;szacunek ', 9, '0000-00-00', NULL, 0),
(33, 2, 2, 1, 17, 'Zestaw', 'montage;montaż premiere;premiera producer;producent screen;ekran scenario;scenariusz stuntman;kaskader subtitles;napisy western;western cast;obsada cinema;kino clapper;klaps crew;sztab ', 12, '0000-00-00', NULL, 0);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `podkategoria`
--
ALTER TABLE `podkategoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `rola`
--
ALTER TABLE `rola`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `wynik`
--
ALTER TABLE `wynik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT dla tabeli `zestaw`
--
ALTER TABLE `zestaw`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
