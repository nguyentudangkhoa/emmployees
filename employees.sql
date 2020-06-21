-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2020 at 04:30 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employees`
--

-- --------------------------------------------------------

--
-- Table structure for table `absence_letter`
--

CREATE TABLE `absence_letter` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reason` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `reason_disapprove` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `absence_letter`
--

INSERT INTO `absence_letter` (`id`, `user_id`, `reason`, `from_date`, `to_date`, `status`, `reason_disapprove`, `created_at`, `updated_at`) VALUES
(5, 1, 'I have got covid-19', '2020-06-12', '2020-06-19', 'approved', NULL, '2020-06-11 09:09:16', '2020-06-11 09:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_ot` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` int(11) NOT NULL,
  `place_ot` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `task_name` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `note` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity_card` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_place` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `university` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `granduate_year` year(4) DEFAULT NULL,
  `start_job_at` datetime DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_holidays` bigint(20) NOT NULL DEFAULT 14,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` int(12) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `identity_card`, `issue_place`, `issue_date`, `university`, `granduate_year`, `start_job_at`, `birthday`, `avatar`, `note`, `role`, `position`, `gender`, `total_holidays`, `email_verified_at`, `password`, `salary`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyen Tu Dang Khoa', 'nguyentudangkhoa@gmail.com', 'Hồ Chí Minh', '261530344', 'Bình Thuận', '2017-07-28', 'Nguyễn Tất Thành', 1910, '2020-06-01 15:55:00', '1997-06-03', 'avatar04.png', 'Nhân Viên', 'user', 'Software Engineer', 'Male', 6, NULL, '$2y$10$BSxGHqSOOUTIhsIX3LIjvOk1fPRhRSfwrp6FZu5PHbcXGnxiFadr6', 7000000, 'RmYnghHGpoxzgS4CEhirdWNNBWBeJ5TyJtLGzUL2OsmcIZnJXw6RPSemkPVR', '2020-05-28 01:39:28', '2020-06-13 04:14:33'),
(2, 'Nguyen Tu Dang Khoa', 'khoakute1997@gmail.com', 'Hồ Chí Minh', '123123123123', 'Công An Tp. Hồ Chí Minh', '2018-02-14', 'Nguyễn Tất Thành', 2020, '2020-06-01 17:10:00', '1997-06-03', 'avatar.png', 'Nhân viên chính thức', 'user', 'QC-tester', 'Male', 14, NULL, '$2y$10$eXZDGfsvJEOHBrcQdSVWr.Qn/toanzN5TZP688y.DN1HTKRrKsxcO', 12000000, 'URmBn7xL4BWThfNW7mEf5S5zoSHARQA3SFwzfSmfJJmnMvbKyDBSUUvHkh2u', '2020-05-29 23:03:19', '2020-06-12 10:05:08'),
(3, 'admin', 'admin@gmail.com', 'Hồ Chí Minh', '123123123123', 'Công An Tp. Hồ Chí Minh', '2020-06-02', 'Tôn Đức Thắng', 1910, '2020-06-12 08:55:00', '1994-06-12', NULL, 'admin hệ thống', 'admin', NULL, 'Male', 14, NULL, '$2y$10$w.lF9tS4AzNbECrpD6UB9uC33t1FxPaXl7S3W9Swg07aSIl9hXOp6', NULL, 'YeXlwyKQmaoZ0PgvXhkOJlHOq36sCXb1s8ai7GYZVVvLHjnLHPUD60r8x6Cb', '2020-06-01 06:32:34', '2020-06-12 01:55:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absence_letter`
--
ALTER TABLE `absence_letter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_adsence_users` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ot_users` (`user_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absence_letter`
--
ALTER TABLE `absence_letter`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absence_letter`
--
ALTER TABLE `absence_letter`
  ADD CONSTRAINT `fk_adsence_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `overtime`
--
ALTER TABLE `overtime`
  ADD CONSTRAINT `fk_ot_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
