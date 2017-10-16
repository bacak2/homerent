-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 16 Paź 2017, 14:37
-- Wersja serwera: 5.7.19-0ubuntu0.17.04.1
-- Wersja PHP: 7.0.21-1~ubuntu17.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `homerent`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `apartaments`
--

CREATE TABLE `apartaments` (
  `id` int(10) UNSIGNED NOT NULL,
  `apartament_geo_x` double(10,5) NOT NULL,
  `apartament_geo_y` double(10,5) NOT NULL,
  `apartament_address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartament_address_2` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartament_city` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartament_rooms_number` int(11) NOT NULL,
  `apartament_beds` int(11) NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `apartaments`
--

INSERT INTO `apartaments` (`id`, `apartament_geo_x`, `apartament_geo_y`, `apartament_address`, `apartament_address_2`, `apartament_city`, `apartament_rooms_number`, `apartament_beds`, `group_id`, `owner_id`, `created_at`, `updated_at`) VALUES
(1, 34554.32456, 32314.12124, 'Albatrosów 1', '31-120', 'Kraków', 10, 30, 1, 1, NULL, NULL),
(2, 34554.32456, 33314.12124, 'Jakaś 3/4', '30-120', 'Katowice', 10, 30, 1, 1, NULL, NULL),
(3, 34554.32456, 33314.12124, 'Ulica 3/4', '33-150', 'Warszawa', 10, 30, 2, 1, NULL, NULL),
(4, 34554.32456, 33314.12124, 'Kielecka 3/4', '30-120', 'Kielce', 10, 30, 1, 1, NULL, NULL),
(5, 34554.32456, 33314.12124, 'Krakowska 3/4', '1-120', 'Kraków', 10, 30, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `apartament_addons`
--

CREATE TABLE `apartament_addons` (
  `id` int(10) UNSIGNED NOT NULL,
  `apartament_id` int(10) UNSIGNED NOT NULL,
  `language_id` int(10) UNSIGNED NOT NULL,
  `apartament_addons_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartament_addons_price` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `apartament_descriptions`
--

CREATE TABLE `apartament_descriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `apartament_id` int(10) UNSIGNED NOT NULL,
  `language_id` int(10) UNSIGNED NOT NULL,
  `apartament_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartament_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `apartament_descriptions`
--

INSERT INTO `apartament_descriptions` (`id`, `apartament_id`, `language_id`, `apartament_name`, `apartament_description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Apartament Albatrosów', 'Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam ', NULL, NULL),
(2, 5, 1, 'Testowiec Zakopane', 'Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam ', NULL, NULL),
(3, 1, 2, 'Albatrosów apartament', 'English test coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam ', NULL, NULL),
(4, 2, 1, 'Apartament Jeszcze Jak', 'Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam ', NULL, NULL),
(5, 3, 1, 'Najlepszy apartament', 'Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam ', NULL, NULL),
(6, 4, 1, 'Zakopiański cud', 'Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam Lorem ipsum coś tam coś tam ', NULL, NULL),
(7, 2, 2, 'Papay Apartament', 'English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo ', NULL, NULL),
(8, 3, 2, 'Best apartament', 'English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo ', NULL, NULL),
(9, 4, 2, 'Amazing Zakopane', 'English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo ', NULL, NULL),
(10, 5, 2, 'Testing Zakop', 'English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo English testo ', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `apartament_discounts`
--

CREATE TABLE `apartament_discounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `apartament_id` int(10) UNSIGNED NOT NULL,
  `discount_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` double(8,2) NOT NULL,
  `discount_days_counter` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `apartament_groups`
--

CREATE TABLE `apartament_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `apartament_groups`
--

INSERT INTO `apartament_groups` (`id`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'Apartamenty małopolskie', NULL, NULL),
(2, 'Apartamenty inne', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `apartament_prices`
--

CREATE TABLE `apartament_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `apartament_id` int(10) UNSIGNED NOT NULL,
  `language_id` int(10) UNSIGNED NOT NULL,
  `price_value` double(8,2) NOT NULL,
  `date_of_price` date NOT NULL,
  `price_discount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `currency_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_value` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `language_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_flag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `languages`
--

INSERT INTO `languages` (`id`, `language_name`, `language_code`, `language_flag`, `currency_id`, `created_at`, `updated_at`) VALUES
(1, 'Polski', 'pl', 'pl.gif', 1, NULL, NULL),
(2, 'Angielski', 'en', 'en.gif', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(14, '2014_10_12_000000_create_users_table', 1),
(15, '2014_10_12_100000_create_password_resets_table', 1),
(16, '2017_09_28_115657_create_currencies_table', 1),
(17, '2017_09_28_115704_create_languages_table', 1),
(18, '2017_09_28_115725_create_apartament_groups_table', 1),
(19, '2017_09_28_115736_create_owners_table', 1),
(20, '2017_09_28_115745_create_apartaments_table', 1),
(21, '2017_09_28_115810_create_apartament_descriptions_table', 1),
(22, '2017_09_28_115834_create_apartament_prices_table', 1),
(23, '2017_09_28_115843_create_apartament_addons_table', 1),
(24, '2017_09_28_115856_create_apartament_discounts_table', 1),
(25, '2017_09_28_115919_create_reservation_promotion_codes_table', 1),
(26, '2017_09_28_115927_create_reservations_table', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `owners`
--

CREATE TABLE `owners` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_first_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_second_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

CREATE TABLE `reservations` (
  `id` int(10) UNSIGNED NOT NULL,
  `apartament_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `reservation_arrive_date` date NOT NULL,
  `reservation_departure_date` date NOT NULL,
  `reservation_persons` int(11) NOT NULL,
  `reservation_kids` int(11) NOT NULL,
  `reservation_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `reservations`
--

INSERT INTO `reservations` (`id`, `apartament_id`, `user_id`, `reservation_arrive_date`, `reservation_departure_date`, `reservation_persons`, `reservation_kids`, `reservation_status`, `created_at`, `updated_at`) VALUES
(1, 1, 12, '2017-10-15', '2017-10-22', 3, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservation_promotion_codes`
--

CREATE TABLE `reservation_promotion_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `promotion_code_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_code_value` double(8,2) NOT NULL,
  `promotion_code_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promotion_code_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Arkadiusz', 'arkadiusz.adamczyk@artplus.pl', '$2y$10$nrtGkiQqmW/AQLFaILNyLuWTsHmkfz/K1qhgDS.7kHji9vYYvmQgG', 'CHlHeX4OrBopqlJRJCSWdpxkT6yIS2ONOufMpTN7v9DyP21sEenkxdJIFPHB', '2017-10-05 05:18:45', '2017-10-05 05:18:45'),
(2, 'Tomasz', 'tomasz@id.pl', '$2y$10$ovGh.Wi625IVF47MXMlUx.6rIGBJAkO8vIeH5iQcHrzFvEu691Zji', '7FYsYKeFiw4e20X63hdEpxqHvEmx3Rw1K7WwUTfU2vzp9LGjJkqmMnP0E3ss', '2017-10-12 10:03:26', '2017-10-12 10:03:26'),
(3, 'Test', 'tester@test.pl', '$2y$10$7JfJpQ8c//AcR4reXgppF.WMo3vcq5gpv4RjHG5iqP3GdsJSfOm4W', 'wr3Ce3khJW8wzMmPpVbYTZ4tOXuz0Y24yY1URxwxGhLeH68EjOI4uOMQsH08', '2017-10-12 10:10:53', '2017-10-12 10:10:53');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `apartaments`
--
ALTER TABLE `apartaments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apartament_addons`
--
ALTER TABLE `apartament_addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apartament_descriptions`
--
ALTER TABLE `apartament_descriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apartament_discounts`
--
ALTER TABLE `apartament_discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apartament_groups`
--
ALTER TABLE `apartament_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apartament_prices`
--
ALTER TABLE `apartament_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation_promotion_codes`
--
ALTER TABLE `reservation_promotion_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `apartaments`
--
ALTER TABLE `apartaments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `apartament_addons`
--
ALTER TABLE `apartament_addons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `apartament_descriptions`
--
ALTER TABLE `apartament_descriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT dla tabeli `apartament_discounts`
--
ALTER TABLE `apartament_discounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `apartament_groups`
--
ALTER TABLE `apartament_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `apartament_prices`
--
ALTER TABLE `apartament_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT dla tabeli `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `reservation_promotion_codes`
--
ALTER TABLE `reservation_promotion_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
