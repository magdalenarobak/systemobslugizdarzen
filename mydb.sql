-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Sty 2020, 01:36
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mydb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `idKategorii` int(11) NOT NULL,
  `nazwa` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`idKategorii`, `nazwa`) VALUES
(1, 'do zrobienia'),
(2, 'w trakcie'),
(3, 'zrobione');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `priorytety`
--

CREATE TABLE `priorytety` (
  `idPriorytetu` int(11) NOT NULL,
  `nazwa` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `priorytety`
--

INSERT INTO `priorytety` (`idPriorytetu`, `nazwa`) VALUES
(1, 'normalne'),
(2, 'krytyczne'),
(3, 'ważne'),
(4, 'mało ważne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `idUzytkownika` int(11) NOT NULL,
  `imie` varchar(45) NOT NULL,
  `nazwisko` varchar(45) NOT NULL,
  `login` varchar(45) NOT NULL,
  `haslo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`idUzytkownika`, `imie`, `nazwisko`, `login`, `haslo`) VALUES
(1, 'Karolina', 'Nowak', 'k.nowak', 'k.nowak123'),
(2, 'Michał', 'Kowal', 'm.kowal', 'm.kowal123'),
(3, 'Lena', 'Suchocka', 'l.suchocka', 'l.suchocka123'),
(4, 'Blanka', 'Janowska', 'b.janowska', 'b.janowska123'),
(5, 'Cezary', 'Homski', 'c.homski', 'c.homski123'),
(6, 'Ewa', 'Bachowska', 'e.bachowska', 'e.bachowska123'),
(7, 'Igor', 'Andrzejewicz', 'i.andrzejewicz', 'i.andrzejewicz123');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdarzenia`
--

CREATE TABLE `zdarzenia` (
  `idZdarzenia` int(11) NOT NULL,
  `idUzytkownika` int(11) NOT NULL,
  `idPriorytetu` int(11) NOT NULL,
  `idKategorii` int(11) NOT NULL,
  `zdarzenie` varchar(200) NOT NULL,
  `opis` varchar(1000) NOT NULL,
  `nr_pokoju` int(5) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `zdarzenia`
--

INSERT INTO `zdarzenia` (`idZdarzenia`, `idUzytkownika`, `idPriorytetu`, `idKategorii`, `zdarzenie`, `opis`, `nr_pokoju`, `data`) VALUES
(1, 1, 1, 1, 'Problem z komunikacją w systemie firmowym', 'Podczas wysyłania wiadomości do innego współpracownika wiadomość zostaje wysłana, ale nie pojawia się w konwersacji', 200, '2020-01-08 12:39:12'),
(2, 3, 2, 2, 'Niedziałająca drukarka', 'Drukarka włącza się, ale nie drukuje', 101, '2020-01-12 15:25:48'),
(3, 2, 3, 1, 'Uprawnienia do programu', 'Nie mogę korzystać z programu X, gdyż nie mam odpowiednich uprawnień', 5, '2019-12-27 13:39:28'),
(4, 2, 3, 3, 'Instalacja programu Y', 'Potrzebna pomoc w instalacji programu Y', 120, '2020-01-03 13:39:40'),
(5, 3, 2, 2, 'Niedziałająca klawiatura', 'Klawiatura wcześniej działała bez zarzutu, ale teraz niestety nie działa', 12, '2020-01-09 16:27:10');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`idKategorii`);

--
-- Indeksy dla tabeli `priorytety`
--
ALTER TABLE `priorytety`
  ADD PRIMARY KEY (`idPriorytetu`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`idUzytkownika`);

--
-- Indeksy dla tabeli `zdarzenia`
--
ALTER TABLE `zdarzenia`
  ADD PRIMARY KEY (`idZdarzenia`),
  ADD KEY `fk_Zdarzenia_Uzytkownicy1_idx` (`idUzytkownika`),
  ADD KEY `fk_Zdarzenia_Priorytety1_idx` (`idPriorytetu`),
  ADD KEY `fk_Zdarzenia_Kategorie1_idx` (`idKategorii`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `idKategorii` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `priorytety`
--
ALTER TABLE `priorytety`
  MODIFY `idPriorytetu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `idUzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `zdarzenia`
--
ALTER TABLE `zdarzenia`
  MODIFY `idZdarzenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `zdarzenia`
--
ALTER TABLE `zdarzenia`
  ADD CONSTRAINT `fk_Zdarzenia_Kategorie1` FOREIGN KEY (`idKategorii`) REFERENCES `kategorie` (`idKategorii`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Zdarzenia_Priorytety1` FOREIGN KEY (`idPriorytetu`) REFERENCES `priorytety` (`idPriorytetu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Zdarzenia_Uzytkownicy1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`idUzytkownika`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
