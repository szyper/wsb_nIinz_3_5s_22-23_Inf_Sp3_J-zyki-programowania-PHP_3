-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Cze 2023, 09:38
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wsb_niinz_3_5s_22-23_inf_sp2_j-zyki-programowania-php-3_register`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `state_id` int(10) UNSIGNED NOT NULL,
  `cityName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `cityName`) VALUES
(1, 1, 'Poznań'),
(2, 2, 'Wrocław'),
(3, 1, 'Gniezno');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `stateName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `states`
--

INSERT INTO `states` (`id`, `stateName`) VALUES
(1, 'Wielkopolskie'),
(2, 'Dolnośląskie'),
(3, 'Pomorskie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(60) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `city_id`, `email`, `firstName`, `lastName`, `birthday`, `password`, `created_at`) VALUES
(1, 1, 'jan@o2.pl', 'Janusz', 'Nowak', '2023-03-04', 'a', '2023-05-28 15:39:04'),
(2, 1, 'a@o2.pl', 'Krystyna', 'Nowak', '2023-12-31', 'j', '2023-05-28 15:43:42'),
(6, 1, 'a@o2.pl1', 'Krystyna', 'Nowak', '2023-12-31', 'k', '2023-05-28 15:56:47'),
(8, 1, 'a@o2.pl12', 'Krystyna', 'Nowak', '2023-12-31', '$argon2id$v=19$m=65536,t=4,p=1$OTlDeDk3U2drZWxhVGl1bg$s3fdHUJtCRBR9UbWNcfP90Hq0ogF1tUlwnoxH6ZL2a8', '2023-05-28 16:12:43'),
(9, 1, 'a@o2.pl124', 'Krystyna', 'Nowak', '2023-12-31', '$argon2id$v=19$m=65536,t=4,p=1$cFVjOHAvODl2aGQ5UXZqUQ$kQgSQ2dDeP2SJBwUnFqBAmKduk0gbABaRcxhYB2/ymM', '2023-05-28 16:28:12'),
(11, 1, 'a@o2.pl1245', 'Krystyna', 'Nowak', '2023-12-31', '$argon2id$v=19$m=65536,t=4,p=1$WUJidC4yVmNkN3dVNGRNag$4lCpugGwN8kIzJxscZg7jUizHmZKGeR94pnEBR1wkY4', '2023-05-28 16:29:37'),
(12, 1, 'a@o2.pl12456', 'Krystyna', 'Nowak', '2023-12-31', '$argon2id$v=19$m=65536,t=4,p=1$bGJBek5lZ3BYdVFodDlQTw$vOeQ5JU4XqyCBmm8fJLexe+EOq0wFEN7nm2Ma4pAppk', '2023-05-28 16:30:06'),
(13, 1, 'admin@o2.pl', 'Krystyna', 'Nowak', '2023-12-31', '$argon2id$v=19$m=65536,t=4,p=1$cGdMWnRYTTR4Q0t5OFFMZA$RyQENL5OJ4jwcxkBgbGfLwCQDwqqNO6WX6W8XV9cQwM', '2023-05-28 16:32:53'),
(14, 1, 'user@o2.pl', 'Krystyna', 'Nowak', '2023-12-31', '$argon2id$v=19$m=65536,t=4,p=1$N0NUeW1xSUtGdFIwdk9WMQ$+f8LrBkrMuHe5hTkXy3uHFYrg+cwGhwLbhwtyfvAb0I', '2023-05-28 16:56:22'),
(15, 1, 'admin@o2.pl3', 'Krystyna1', 'Nowak1', '2023-12-31', '$argon2id$v=19$m=65536,t=4,p=1$dEpSdWEyNkhnb3VGUzdWaQ$r0nrujZHxZghRddgHK+pDniEm1ms2/7W0QReGHupDjA', '2023-06-05 09:32:00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indeksy dla tabeli `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `city_id` (`city_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
