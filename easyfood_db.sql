-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 02. 05 2024 kl. 08:57:44
-- Serverversion: 10.4.28-MariaDB
-- PHP-version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easyfood_db`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `breakfast_recipes`
--

CREATE TABLE `breakfast_recipes` (
  `recipe_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `calories` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `ingredients` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ingredients`)),
  `allergies_and_preferences` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data dump for tabellen `breakfast_recipes`
--

INSERT INTO `breakfast_recipes` (`recipe_id`, `name`, `description`, `time`, `calories`, `price`, `ingredients`, `allergies_and_preferences`) VALUES
(1, 'Havregrød med Blåbær og Mandler', '1. Tilføj vand og havregryn til en gryde ved mellem-lav varme.\r\n2. Bring den op at simre under omrøring. Tilføj vand efter behov.\r\n3. Lad det simre og rør rundt indtil den ønskede konsistens er nået. Pynt med mandler og blåbær.', 15, 455, 40.00, '{\"havregryn\": \"105\", \"blåbær\": \"72\", \"mandler\": \"72\"}', 'gluten, nødder, veganer'),
(2, 'Græsk yoghurt med Frugt og Nødder', '1. Skær æblet i tern.\n2. Hak valnødderne groft.\n3. Læg et lag æbletern i bunden af et glas. Kom et lag valnødder og et lag græsk yoghurt oven på.\n4. Gentag lagene til alle ingredienser er brugt.', 8, 380, 60.00, '{\"yoghurt\": \"2\", \"valnødder\": \"50\", \"æble\": \"1\"}', 'mælk, nødder, veganer'),
(10, 'Græsk yoghurt med Musli', '1. bla bla bla\r\n2. bla alba la', 8, 400, 10.00, '{\"æble\":\"2\"}', ', '),
(11, 'Havregrød med Kanel', '1. bla bla bla\r\n2. bla alba la', 8, 450, 10.00, '{\"æble\":\"2\"}', 'mælk'),
(12, 'Frugtsalat', '1. bla bla bla\r\n2. bla alba la', 8, 500, 10.00, '{\"æble\":\"2\"}', 'vegetar');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `dinner_recipes`
--

CREATE TABLE `dinner_recipes` (
  `recipe_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `calories` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `ingredients` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ingredients`)),
  `allergies_and_preferences` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data dump for tabellen `dinner_recipes`
--

INSERT INTO `dinner_recipes` (`recipe_id`, `name`, `description`, `time`, `calories`, `price`, `ingredients`, `allergies_and_preferences`) VALUES
(5, 'Stegt Laks med Broccoli og Quinoa', 'Ume nume', 8, 720, 30.00, '{\"fisk\":\"2\"}', ', '),
(6, 'Kyllingebryst med Bagte Grøntsager', 'Ume nume', 8, 720, 30.00, '{\"fisk\":\"2\"}', ', '),
(7, 'Grøntsagscurry med Tofu', 'Ume nume', 8, 720, 30.00, '{\"fisk\":\"2\"}', ', '),
(8, 'Spaghetti Bolognese med Fuldkornspasta', 'Ume nume', 8, 720, 30.00, '{\"fisk\":\"2\"}', ', '),
(9, 'Fiskefileter med Grønne Ærter og Kartofler', 'Ume nume', 8, 720, 30.00, '{\"fisk\":\"2\"}', ', '),
(10, 'Kylling Wok med Grøntsager', 'Ume nume', 8, 720, 30.00, '{\"fisk\":\"2\"}', ', ');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `lunch_recipes`
--

CREATE TABLE `lunch_recipes` (
  `recipe_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `calories` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `ingredients` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ingredients`)),
  `allergies_and_preferences` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data dump for tabellen `lunch_recipes`
--

INSERT INTO `lunch_recipes` (`recipe_id`, `name`, `description`, `time`, `calories`, `price`, `ingredients`, `allergies_and_preferences`) VALUES
(5, 'Tunmadder med Salat', 'Rugbrød med fisk', 2, 600, 40.00, '{\"fisk\":\"2\"}', 'fisk, '),
(6, 'Quinoasalat med Grillet Kylling', 'Salat med kylling', 4, 550, 40.00, '{\"kylling\":\"2\"}', 'fisk, '),
(7, 'Rugbrød med Avocado og Røget Laks', 'Avocado mad med fisk', 18, 620, 50.00, '{\"fisk\":\"2\"}', 'fisk, '),
(8, 'Kikærtesalat med Feta og Agurk', 'Lækkert salat', 10, 520, 30.00, '{\"salat\":\"2\"}', ', '),
(9, 'Pasta med Pesto og Cherrytomater', 'Ume nume', 8, 320, 30.00, '{\"salat\":\"2\"}', ', ');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `saved_shopping_lists`
--

CREATE TABLE `saved_shopping_lists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shopping_list_json` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data dump for tabellen `saved_shopping_lists`
--

INSERT INTO `saved_shopping_lists` (`id`, `user_id`, `shopping_list_json`, `created_at`) VALUES
(1, 5, '<br />\n<b>Warning</b>:  Undefined variable $list_of_dishes_per_day_json in <b>C:\\Users\\sofuk\\Desktop\\EasyFood-Teknologi\\generated_shopping_list.php</b> on line <b>44</b><br />\n', '2024-04-29 10:31:17'),
(2, 5, '[{\"breakfast_id\":\"10\",\"breakfast_drink\":\"mandel_m\\u00e6lk\",\"lunch_id\":\"3\",\"dinner_id\":null},{\"breakfast_id\":\"16\",\"breakfast_drink\":\"mandel_m\\u00e6lk\",\"lunch_id\":\"4\",\"dinner_id\":\"2\"}]', '2024-04-29 10:37:26'),
(3, 5, '[{\"breakfast_id\":\"10\",\"breakfast_drink\":\"mandel_m\\u00e6lk\",\"lunch_id\":\"3\",\"dinner_id\":null},{\"breakfast_id\":\"16\",\"breakfast_drink\":\"mandel_m\\u00e6lk\",\"lunch_id\":\"4\",\"dinner_id\":\"2\"}]', '2024-04-29 10:37:32'),
(4, 5, '[{\"breakfast_id\":\"10\",\"breakfast_drink\":\"mandel_m\\u00e6lk\",\"lunch_id\":\"3\",\"dinner_id\":null},{\"breakfast_id\":\"16\",\"breakfast_drink\":\"mandel_m\\u00e6lk\",\"lunch_id\":\"4\",\"dinner_id\":\"2\"}]', '2024-04-29 10:38:11'),
(5, 5, '[{\"breakfast_id\":\"10\",\"breakfast_drink\":\"mandel_m\\u00e6lk\",\"lunch_id\":\"3\",\"dinner_id\":null},{\"breakfast_id\":\"16\",\"breakfast_drink\":\"mandel_m\\u00e6lk\",\"lunch_id\":\"4\",\"dinner_id\":\"2\"}]', '2024-04-29 10:38:17');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `period` int(11) DEFAULT NULL,
  `budget` int(11) DEFAULT NULL,
  `allergies_and_preferences` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `age`, `gender`, `weight`, `height`, `period`, `budget`, `allergies_and_preferences`) VALUES
(5, 'Sofus', 'Sørensen', 'sofus@aphx.dk', 'Sofusun1', 17, 'M', 72, 182, 2, 300, '{\"allergies\":[\"mælk\"],\"preferences\":[\"veganer\"]}'),
(6, 'Fritjof', 'Bruun', 'frit@gmail.com', 'Neggerman69', 18, 'M', 70, 174, 2, 300, '{\"allergies\":[\"nødder\"],\"preferences\":[]}'),
(7, 'Jesper', 'Mortersen', 'Sofusmorerdejlig@knephende.dk', 'BollerSofusMor', 18, 'M', 73, 181, 7, 1000, '{\"allergies\":[],\"preferences\":[]}'),
(8, 'carl', 'BENDIXEN', 'CARLbendixen@icloud.com', 'Carlbx24', 20, 'M', 75, 184, 3, 300, '{\"allergies\":[\"mælk\"],\"preferences\":[]}'),
(9, 'Frederikke', 'Lange', 'frederikke.c.lange@gmail.com', 'Kage', 19, 'F', 68, 169, 5, 300, '{\"allergies\":[],\"preferences\":[]}');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `breakfast_recipes`
--
ALTER TABLE `breakfast_recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indeks for tabel `dinner_recipes`
--
ALTER TABLE `dinner_recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indeks for tabel `lunch_recipes`
--
ALTER TABLE `lunch_recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indeks for tabel `saved_shopping_lists`
--
ALTER TABLE `saved_shopping_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `breakfast_recipes`
--
ALTER TABLE `breakfast_recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tilføj AUTO_INCREMENT i tabel `dinner_recipes`
--
ALTER TABLE `dinner_recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tilføj AUTO_INCREMENT i tabel `lunch_recipes`
--
ALTER TABLE `lunch_recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tilføj AUTO_INCREMENT i tabel `saved_shopping_lists`
--
ALTER TABLE `saved_shopping_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `saved_shopping_lists`
--
ALTER TABLE `saved_shopping_lists`
  ADD CONSTRAINT `saved_shopping_lists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
