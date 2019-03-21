-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2019 at 05:30 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `companyapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `basesalary` int(11) NOT NULL,
  `bonuspercentage` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `added_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `basesalary`, `bonuspercentage`, `created_at`, `updated_at`, `added_by_id`) VALUES
(1, 'Sales Stuff', 1000, 10, '2019-03-21 02:00:37', '2019-03-21 02:00:37', 13),
(2, 'Technology', 4000, 10, '2019-03-21 02:19:22', '2019-03-21 02:19:22', 13);

-- --------------------------------------------------------

--
-- Table structure for table `departments_employees`
--

CREATE TABLE `departments_employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `departmentID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments_employees`
--

INSERT INTO `departments_employees` (`id`, `departmentID`, `employeeID`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-03-21 02:01:00', '2019-03-21 02:01:00'),
(2, 1, 2, '2019-03-21 02:19:01', '2019-03-21 02:19:01');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` int(11) NOT NULL,
  `bonuspercentage` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `added_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `salary`, `bonuspercentage`, `email`, `created_at`, `updated_at`, `added_by_id`) VALUES
(1, 'Employee 1', 1000, 0, 'employee1@email.com', '2019-03-21 02:01:00', '2019-03-21 02:01:00', 13),
(2, 'Employee 3', 2000, 20, 'employee3@email.com', '2019-03-21 02:19:01', '2019-03-21 02:19:01', 13);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(22, '2014_10_12_000000_create_users_table', 1),
(23, '2014_10_12_100000_create_password_resets_table', 1),
(24, '2019_03_16_070127_create_employees_table', 1),
(25, '2019_03_17_101959_create_departments_table', 1),
(26, '2019_03_17_103556_create_departments_employees_table', 1),
(27, '2019_03_17_173113_add_user_id_to_employees', 1),
(28, '2019_03_17_173457_add_user_id_to_departments', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `api_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'sandra', 'sandra.estafanous@gmail.com', '$2y$10$ZhoF1cwtdKt6/xB7REBDtOLCwTi8mH5OkKGF.4CvRZzrh4B86NHzq', NULL, 'oCLoUmwGt3QD2GA3wtlukYtjmvOPOnGDulfORGGMmmLiI5pEnaMucJjMSRiw', '2019-03-20 16:38:59', '2019-03-20 16:38:59'),
(2, 'sandra', 'sandra.estafanous2@gmail.com', '$2y$10$U6hdcMbwnhIxGhAudvHCQ.qJuF8gXKIYM8wxMSPAuq90O82oxWZCq', NULL, 'pSpFirljA5PGXoTBOJWAI6uwJHxtgeqDYtwPXfxDvtQw627vMETuBIV9l6cs', '2019-03-20 16:40:24', '2019-03-20 16:40:25'),
(3, 'sandra', 'sandra.estafanous3@gmail.com', '$2y$10$81kqcRhBJ6iSQ.OU.diUzeKjYkr60XRMNjUR2.eMTbTdtay/aK.Gm', NULL, '2aVXzC9ch0tMC97hI64TajU1Esn98mwFBFnoHdMEvzO2VO1XVqkFzuE3NZ9v', '2019-03-20 16:40:55', '2019-03-20 16:40:55'),
(4, 'sandra', 'sandra.estafanous4@gmail.com', '$2y$10$/TsqwSyovffbG2KYJYUCpeBqQLv6hdM/cioy/jElDkbC9tz9YhKKu', NULL, 'NLfTXOt17WEhkHZLvJV42rv1h3N9rCqg92FowSG6OB4Um0wSH8A6UJ0eKzhE', '2019-03-20 16:42:44', '2019-03-20 16:47:49'),
(5, 'sandra', 'sandra.estafanous16@gmail.com', '$2y$10$SnPp0X33Mh/Ae85daMoXbO1Mx/.g/kIG3AfTn9KgKpVVLHZ42AIPi', NULL, '1LwtMrd1cTCIjrIcP34xZGVVUhqE73tQPm8vG3SlyjDRnZzm90hkCynk2SXa', '2019-03-20 16:43:08', '2019-03-20 16:43:22'),
(6, 'sandra', 'sandra.estafanous5@gmail.com', '$2y$10$p45QLLJgI25SWMHrsQgawupY/BX2tD05k.fI2oMbuL/hL0URKTl2y', '5BeNHL3Z3UzbpOoXoa9B8k67klAkLawmCmAFLTLYK2Cfvf6Dj04WLSVecCMz', NULL, '2019-03-20 16:52:39', '2019-03-20 16:52:39'),
(7, 'sandra', 'sandra.estafanous6@gmail.com', '$2y$10$WCQxT0cS5zP35R0KE2ZOb.097BTdAMjQlwwsmbGXFiNlm7D3y5jH2', 'StJMZAO8cunZ5EuLkr2qTgUmXhc5Ra7357EbfoxYxwJeKaE5HNsAglX9Y9ee', NULL, '2019-03-20 16:54:32', '2019-03-20 16:54:32'),
(8, 'sandra', 'sandra.estafanous7@gmail.com', '$2y$10$FOPSE6lOuXHSvJBY.dTnEOc641uzsihgWGfPRmujaDro3sV6eg7cm', 'xAVXs7JjHJsNSJjUbWmOKydixL16BwHRzvPKMNW6NiH3mhVjqaUNLRgfuVm6', NULL, '2019-03-20 16:54:59', '2019-03-20 16:54:59'),
(9, 'sandra', 'sandra.estafanous8@gmail.com', '$2y$10$GXnLaiNEcFDJ/ov7uT52EeyzkN5ciwaXge4/Gr2WU2bCdYNr3xCYi', 'FQCyWiLdfJQam6Kw8vAGXVRlkAz2u14kXqTEny7wXnmljnNl4MAfjXuXLy25', NULL, '2019-03-20 16:55:25', '2019-03-20 16:55:25'),
(10, 'sandra', 'sandra.estafanous9@gmail.com', '$2y$10$xAwRndmaENJrkhBi3/PK9ObbC6xBc0XcwRmQyd8nBn48KI408ztQ2', 'BKOHqxvCn5ak3jkQ9jmr5zka6VF86RtoavOSr8gwH75VFbknZ6XrFQwp01yz', NULL, '2019-03-20 16:55:52', '2019-03-20 16:55:52'),
(11, 'sandra', 'sandra.estafanous10@gmail.com', '$2y$10$0WiC4Dr3f9x0DwHjvo4mZ.nSWuf109CodOgpGsStN.oQwt9U8m2t2', '8CAv2rabgJpoBeC0c0RT1uq9bmB2vKwt3oqogv9SxhzzSlUHtTJztTgh9oer', NULL, '2019-03-20 16:59:22', '2019-03-20 16:59:22'),
(12, 'sandra', 'sandra.estafanous11@gmail.com', '$2y$10$Shi5rwnqsmTCUZWNcTmDrOjTAz0056O8J3mWbqxXFnKFArSebJBcC', 'lhNjQwS2hjbLdzebdMxyhgwNdEt0SvjX0HxHpDOMOh1XfFOhLs6P9Mj6VrAP', NULL, '2019-03-20 17:00:55', '2019-03-20 17:01:23'),
(13, 'sandra3', 'sandra2@email.com', '$2y$10$28cj2A.OR4Cq2RyjE06K0OcOqzfg5bJVEqqXjnCXQCh4F.e6Fibau', 'Jsl54Jl95X3lC7c0Ju5V0JZvParenvKqzOljlTazdhDjD7VowxAJBohKRMV9', NULL, '2019-03-21 01:58:15', '2019-03-21 01:58:15'),
(14, 'sandra', 'sandra.estafanous12@gmail.com', '$2y$10$uzhdwcRm1lDYSxscUz9Pu.TveWIdnSs5KpfmzTY1W47z1XEffXKHK', 'kvOxDqjkelMN5o16rsRIrk4A2fegmEPJFbCUsF3XiopgaC3RhelIXOzMBs71', NULL, '2019-03-21 02:06:57', '2019-03-21 02:06:58'),
(15, 'sandra', 'sandra.estafanous14@gmail.com', '$2y$10$omb0IO13UuXcnBUhy.0CAudkam6DKpv1IKJR.iU0W4ywmcy7Wypza', 'grFQIUi2drUKeG2ZB5pPZYLuAZ6pQ6Sk0QV2N9B8kfhDa72TiMeq0ga5HEor', NULL, '2019-03-21 02:12:44', '2019-03-21 02:17:05'),
(16, 'sandra', 'sandra.estafanous15@gmail.com', '$2y$10$kjSEzlcnpUKtoRWfYkadvONQlPhIY5wKH3yV60SN5uDlxrwWEHyIS', '4J2t6heSluI60ywkLetTV7dFr71OlIBdzjJtw0GJkOf32Q7hPMoj97Bioaft', NULL, '2019-03-21 02:18:06', '2019-03-21 02:18:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments_employees`
--
ALTER TABLE `departments_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_remember_token_unique` (`remember_token`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `departments_employees`
--
ALTER TABLE `departments_employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
