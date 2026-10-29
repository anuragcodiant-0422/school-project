-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2026 at 08:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_enquiries`
--

CREATE TABLE `admission_enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `class_applying_for` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'new',
  `crm_status` varchar(20) NOT NULL DEFAULT 'pending',
  `crm_response` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admission_enquiries`
--

INSERT INTO `admission_enquiries` (`id`, `parent_name`, `student_name`, `class_applying_for`, `mobile`, `email`, `message`, `status`, `crm_status`, `crm_response`, `created_at`, `updated_at`) VALUES
(1, 'Shashi', 'Ambika', 'Nursery', '7987660778', NULL, NULL, 'new', 'sent', '579772484330', '2026-10-28 17:44:06', '2026-10-28 17:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('the-manthan-school-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1793229306),
('the-manthan-school-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1793229306;', 1793229306),
('the-manthan-school-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1793228501),
('the-manthan-school-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1793228501;', 1793228501);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_28_100000_create_news_events_table', 1),
(5, '2026_10_28_100100_create_admission_enquiries_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_events`
--

CREATE TABLE `news_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(32) NOT NULL,
  `item_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_description` varchar(500) NOT NULL,
  `content` longtext NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_events`
--

INSERT INTO `news_events` (`id`, `title`, `slug`, `category`, `item_date`, `image`, `short_description`, `content`, `is_published`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Annual Sports Day: Little Champions on the Field', 'annual-sports-day-little-champions-on-the-field', 'Event', '2026-10-18', 'https://images.unsplash.com/photo-1471295253337-3ceaaedca402?auto=format&fit=crop&w=1200&q=80', 'Our students celebrated teamwork, courage and joy at this year’s Sports Day on the Noida campus.', '<p>The grounds came alive with colour, music and cheering families as every class took part in age-appropriate races, relays and cooperative games.</p><p>Teachers designed stations that mixed movement with problem-solving, so children practised listening, turn-taking and resilience as much as running.</p><p>Medals were awarded for effort, sportsmanship and improvement. Photographs from the day are now up in the Event Diary.</p>', 1, 'Annual Sports Day: Little Champions on the Field | The Manthan School', 'Our students celebrated teamwork, courage and joy at this year’s Sports Day on the Noida campus.', '2026-10-28 17:26:32', '2026-10-28 17:26:32'),
(2, 'Sciencee Week Sparks Curious Minds', 'sciencee-week-sparks-curious-minds', 'News', '2026-10-08', 'news-events/ECqjvpmkVyq2kZoRPhtQ5As7T4poz2N6oBs6QPRy.jpg', 'Classrooms turned into mini labs as children explored magnets, plants, water and simple machines.', '<p>Science Week invited every learner to ask “what if?” through hands-on experiments rather than worksheets.</p><p>Nursery children mixed colours and observed floating objects. Older classes built marble runs and recorded predictions before testing them.</p><p>Parents joined a Friday showcase where students explained their favourite discovery in their own words.</p>', 1, 'Science Week Sparks Curious Minds | The Manthan School', 'Classrooms turned into mini labs as children explored magnets, plants, water and simple machines.', '2026-10-28 17:26:32', '2026-10-28 17:32:26'),
(3, 'Art Exhibition: Colours of Childhood', 'art-exhibition-colours-of-childhood', 'Achievement', '2026-09-26', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1200&q=80', 'Original paintings, clay work and story collages from every grade filled the atrium this month.', '<p>The exhibition celebrated process over product. Each display card described the child’s idea, the materials used and what they enjoyed most.</p><p>Visitors walked through galleries themed around monsoon, friendship and “my neighbourhood”. Several artworks will travel to our partner community centre.</p>', 1, 'Art Exhibition: Colours of Childhood | The Manthan School', 'Original paintings, clay work and story collages from every grade filled the atrium this month.', '2026-10-28 17:26:32', '2026-10-28 17:26:32'),
(4, 'Founders’ Day Assembly & Community Picnic', 'founders-day-assembly-community-picnic', 'Event', '2026-09-12', 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?auto=format&fit=crop&w=1200&q=80', 'Students, teachers and families gathered to honour the school’s founding story with song, food and outdoor play.', '<p>The morning assembly featured student-led storytelling about kindness and courage. In the afternoon, families shared a picnic on the lawns.</p><p>Alumni parents volunteered at craft stalls and a book swap. It was a reminder that Manthan is a community, not only a campus.</p>', 1, 'Founders’ Day Assembly & Community Picnic | The Manthan School', 'Students, teachers and families gathered to honour the school’s founding story with song, food and outdoor play.', '2026-10-28 17:26:32', '2026-10-28 17:26:32'),
(5, 'Reading Festival Opens a New Library Corner', 'reading-festival-opens-a-new-library-corner', 'News', '2026-08-29', 'news-events/kZsDYOsOK4DkSP8i4jXD8GHWM2fxab5fBPRXSqrn.jpg', 'A week of read-alouds, author visits and quiet reading nooks launched our expanded early-years library.', '<p>Children voted on cushion colours, labelled shelves and practised borrowing books with picture cards.</p><p>Guest storytellers visited in Hindi and English. Families can now borrow weekend book bags from the front office.</p>', 1, 'Reading Festival Opens a New Library Corner | The Manthan School', 'A week of read-alouds, author visits and quiet reading nooks launched our expanded early-years library.', '2026-10-28 17:26:32', '2026-10-28 17:32:53'),
(6, 'Green Campus Award for Waste-Wise Classrooms', 'green-campus-award-for-waste-wise-classrooms', 'Achievement', '2026-08-14', 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=1200&q=80', 'Student eco-monitors helped the school earn a city recognition for composting and plastic-free snack days.', '<p>Each class tracks food waste and runs a small compost bin. UKG children named the worms; Class 4 graphed weekly totals.</p><p>The award belongs to the children who reminded all of us — including adults — to carry steel bottles and reusable tiffin boxes.</p>', 1, 'Green Campus Award for Waste-Wise Classrooms | The Manthan School', 'Student eco-monitors helped the school earn a city recognition for composting and plastic-free snack days.', '2026-10-28 17:26:32', '2026-10-28 17:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('e8ipIqEEMRuwfdswepDOs5V0S4gdjIKVO0Dn06dZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQm1XY2c5dUlRSHdmV0FCUVlWaGxOcldSVHdtaUdUaW1PZlJWQmlSaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1793257282);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'School Admin', 'admin@gmail.com', NULL, '$2y$12$BcPG/EVCiKlfGG.UIQMtKOYts02NyX6GZYsNZzGSOxNWKlZnEb8r6', NULL, '2026-10-28 17:26:32', '2026-10-28 17:26:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_enquiries`
--
ALTER TABLE `admission_enquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admission_enquiries_mobile_index` (`mobile`),
  ADD KEY `admission_enquiries_mobile_class_applying_for_created_at_index` (`mobile`,`class_applying_for`,`created_at`),
  ADD KEY `admission_enquiries_status_index` (`status`),
  ADD KEY `admission_enquiries_crm_status_index` (`crm_status`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_events`
--
ALTER TABLE `news_events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_events_slug_unique` (`slug`),
  ADD KEY `news_events_is_published_item_date_index` (`is_published`,`item_date`),
  ADD KEY `news_events_category_is_published_index` (`category`,`is_published`),
  ADD KEY `news_events_category_index` (`category`),
  ADD KEY `news_events_item_date_index` (`item_date`),
  ADD KEY `news_events_is_published_index` (`is_published`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `admission_enquiries`
--
ALTER TABLE `admission_enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news_events`
--
ALTER TABLE `news_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
