-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2020 at 05:06 PM
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
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `id` int(11) NOT NULL,
  `house_name` varchar(300) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `house_type` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `house_details` varchar(300) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `house_address` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `id_Location` int(11) DEFAULT NULL,
  `house_image` varchar(225) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `disable` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`id`, `house_name`, `house_type`, `house_details`, `house_address`, `id_Location`, `house_image`, `disable`, `created_at`, `updated_at`) VALUES
(33, 'Phòng trọ 30m2, full tiện nghi, an ninh trung tâm Tô Hiến Thành', 'Phòng trọ', '30m2, 2 toilet', 'Tô Hiến Thành', 10, 'house2.jpg', 1, '2020-05-19 06:45:27', '2020-07-03 07:19:06'),
(34, 'Phòng trọ 30m2, full tiện nghi, an ninh trung tâm Tô Hiến Thành', 'Phòng trọ', '30m2, 2 toilet', 'Tô Hiến Thành', 11, 'house2.jpg', NULL, '2020-05-20 02:03:07', '2020-05-20 02:03:07'),
(39, 'Nhà ở 30m2, full tiện nghi, an ninh trung tâm Tô Hiến Thành', 'Nhà ở', '30m2, 2 toilet', 'Tô Hiến Thành', 16, 'house2.jpg', NULL, '2020-05-20 03:17:47', '2020-05-20 03:17:47'),
(40, 'Phòng trọ 30m2, full tiện nghi, an ninh trung tâm Tô Hiến Thành', 'Phòng trọ', '30m2, 2 toilet', 'Tô Hiến Thành', 12, 'house2.jpg', NULL, '2020-05-20 03:18:08', '2020-05-20 03:18:08'),
(41, 'Phòng trọ 30m2, full tiện nghi, an ninh trung tâm Tô Hiến Thành', 'Phòng trọ', '30m2, 2 toilet', 'Tô Hiến Thành', 12, 'house.jpg', NULL, '2020-05-20 03:18:23', '2020-05-20 03:18:23'),
(42, 'Phòng trọ 30m2, full tiện nghi, an ninh trung tâm Tô Hiến Thành', 'Phòng trọ', '30m2, 2 toilet', 'Tô Hiến Thành', 10, 'house.jpg', NULL, '2020-05-20 03:18:23', '2020-05-20 04:54:55'),
(43, 'Nhà ở 30m2, full tiện nghi, an ninh trung tâm Tô Hiến Thành', 'Nhà ở', '30m2, 2 toilet', 'Tô Hiến Thành', 10, 'house2.jpg', NULL, '2020-05-20 03:18:50', '2020-05-20 07:16:12'),
(44, 'Nhà ở 30m2, full tiện nghi, an ninh trung tâm Tô Hiến Thành', 'Nhà ở', '30m2, 2 toilet', 'Tô Hiến Thành', 18, 'house.jpg', NULL, '2020-05-20 03:19:09', '2020-05-20 03:19:09'),
(45, 'Nhà trọ 30m2, full tiện nghi, an ninh trung tâm Tô Hiến Thành', 'Nhà trọ', '30m2, 2 toilet', '123 Trần Hưng Đạo', 10, 'photo-1512917774080-9991f1c4c750.jpg', NULL, '2020-06-24 11:10:50', '2020-06-24 11:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `location_name` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `disable` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location_name`, `parent_id`, `disable`, `updated_at`, `created_at`) VALUES
(10, 'Phường 10, Quận 8', 2, 1, '2020-07-03 04:51:47', '2020-05-19 02:48:59'),
(11, 'Phường 11, Quận 8', 2, 1, '2020-07-03 05:06:40', '2020-05-19 02:48:52'),
(12, 'Phường 12, Quận 8', 2, 1, '2020-07-03 05:06:48', '2020-05-19 02:48:37'),
(13, 'Phường 3, Quận 8', 2, NULL, '2020-05-19 02:46:17', '2020-05-19 02:46:17'),
(15, 'Phường 3, Quận 9', 2, NULL, '2020-05-19 02:47:02', '2020-05-19 02:47:02'),
(16, 'Phường 4, Quận 8', 2, NULL, '2020-05-19 04:05:28', '2020-05-19 04:05:28'),
(18, 'Phường 4, Quận 9', 2, NULL, '2020-05-19 04:25:12', '2020-05-19 04:25:12');

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
  `end_time` time NOT NULL,
  `place_ot` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `task_name` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `note` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`id`, `user_id`, `date_ot`, `start_time`, `end_time`, `place_ot`, `task_name`, `note`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-06-26', '18:30:00', '21:34:00', 'Back end', 'Login Ajax and verified', 'Good job', 'Success', '2020-06-26 14:36:07', '2020-07-01 07:33:12');

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
  `login_at` datetime DEFAULT NULL,
  `logout_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `identity_card`, `issue_place`, `issue_date`, `university`, `granduate_year`, `start_job_at`, `birthday`, `avatar`, `note`, `role`, `position`, `gender`, `total_holidays`, `email_verified_at`, `password`, `salary`, `remember_token`, `login_at`, `logout_at`, `created_at`, `updated_at`) VALUES
(1, 'Nguyen Tu Dang Khoa', 'nguyentudangkhoa@gmail.com', 'Hồ Chí Minh', '261530344', 'Bình Thuận', '2017-07-28', 'Nguyễn Tất Thành', 1910, '2020-06-01 15:55:00', '1997-06-03', 'avatar.png', 'Nhân Viên', 'user', 'Software Engineer', 'Male', 6, NULL, '$2y$10$BSxGHqSOOUTIhsIX3LIjvOk1fPRhRSfwrp6FZu5PHbcXGnxiFadr6', 12000000, '3YbiHcojosboQDzUZPz6qIO2hKO1I8MBZA63I2W7vLjeFvzJhxzCh9EgMfrZ', '2020-06-28 16:46:10', '2020-06-28 16:51:36', '2020-05-28 01:39:28', '2020-07-01 07:34:09'),
(2, 'Nguyen Tu Dang Khoa', 'khoakute1997@gmail.com', 'Hồ Chí Minh', '123123123123', 'Công An Tp. Hồ Chí Minh', '2018-02-14', 'Nguyễn Tất Thành', 2020, '2020-06-01 17:10:00', '1997-06-03', 'avatar.png', 'Nhân viên chính thức', 'user', 'QC-tester', 'Male', 14, NULL, '$2y$10$eXZDGfsvJEOHBrcQdSVWr.Qn/toanzN5TZP688y.DN1HTKRrKsxcO', 12000000, 'URmBn7xL4BWThfNW7mEf5S5zoSHARQA3SFwzfSmfJJmnMvbKyDBSUUvHkh2u', NULL, NULL, '2020-05-29 23:03:19', '2020-06-12 10:05:08'),
(3, 'admin', 'admin@gmail.com', 'Hồ Chí Minh', '123123123123', 'Công An Tp. Hồ Chí Minh', '2020-06-02', 'Tôn Đức Thắng', 1910, '2020-06-12 08:55:00', '1994-06-12', 'avatar5.png', 'admin hệ thống', 'admin', NULL, 'Male', 14, NULL, '$2y$10$w.lF9tS4AzNbECrpD6UB9uC33t1FxPaXl7S3W9Swg07aSIl9hXOp6', NULL, '20XkwUcnXFlwZZfV74umwsRyN2lbORQwVsfK3RjdRKn9lUvGQYHnYXTPNAme', '2020-06-28 16:51:49', '2020-06-28 16:46:04', '2020-06-01 06:32:34', '2020-07-01 08:35:31');

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
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_House_Location` (`id_Location`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
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
-- AUTO_INCREMENT for table `house`
--
ALTER TABLE `house`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Constraints for table `house`
--
ALTER TABLE `house`
  ADD CONSTRAINT `FK_House_Location` FOREIGN KEY (`id_Location`) REFERENCES `location` (`id`);

--
-- Constraints for table `overtime`
--
ALTER TABLE `overtime`
  ADD CONSTRAINT `fk_ot_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
