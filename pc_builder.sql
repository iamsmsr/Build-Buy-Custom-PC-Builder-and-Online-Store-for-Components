-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2025 at 09:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pc_builder`
--

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE `components` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) DEFAULT 5,
  `power` int(11) DEFAULT 50
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`id`, `name`, `type`, `brand`, `price`, `created_at`, `updated_at`, `quantity`, `power`) VALUES
(2, 'Core i5-12400F', 'CPU', 'Intel', 199.00, '2024-11-28 18:19:19', '2024-12-18 03:29:53', 6, 50),
(3, 'Ryzen 7 5800X', 'CPU', 'AMD', 329.99, '2024-11-28 18:19:19', '2024-12-01 06:41:04', 4, 50),
(4, 'Core i7-12700K', 'CPU', 'Intel', 399.99, '2024-11-28 18:19:19', '2024-11-28 18:19:19', 5, 50),
(5, 'Ryzen 9 5900X', 'CPU', 'AMD', 449.99, '2024-11-28 18:19:19', '2024-11-28 18:19:19', 5, 50),
(6, 'Corsair Vengeance 16GB', 'Memory', 'Corsair', 79.89, '2024-11-28 18:19:19', '2024-12-01 07:43:24', 5, 50),
(7, 'G.SKILL Trident Z 32GB', 'Memory', 'G.SKILL', 159.99, '2024-11-28 18:19:19', '2024-11-28 18:19:19', 5, 50),
(8, 'Kingston HyperX Fury 16GB', 'Memory', 'Kingston', 74.99, '2024-11-28 18:19:19', '2024-11-28 18:19:19', 5, 50),
(9, 'Patriot Viper Steel 32GB', 'Memory', 'Patriot', 149.99, '2024-11-28 18:19:19', '2024-11-28 18:19:19', 5, 50),
(10, 'Crucial Ballistix 16GB', 'Memory', 'Crucial', 69.99, '2024-11-28 18:19:19', '2024-11-28 18:19:19', 5, 50),
(11, 'Samsung 970 EVO Plus 1TB', 'SSD', 'Samsung', 129.99, '2024-11-28 18:19:19', '2024-11-30 21:29:53', 1, 50),
(12, 'WD Black SN850 1TB', 'SSD', 'Western Digital', 149.99, '2024-11-28 18:19:19', '2024-11-28 18:19:19', 5, 50),
(13, 'Kingston A2000 1TB', 'SSD', 'Kingston', 99.99, '2024-11-28 18:19:19', '2024-11-28 18:19:19', 5, 50),
(14, 'Crucial P5 Plus 1TB', 'SSD', 'Crucial', 119.99, '2024-11-28 18:19:19', '2024-11-28 18:19:19', 5, 50),
(15, 'Seagate FireCuda 530 1TB', 'SSD', 'Seagate', 159.99, '2024-11-28 18:19:19', '2024-11-28 18:19:19', 5, 50),
(16, 'demo', 'ssd', 'demo', 111.00, '2024-11-30 21:30:14', '2024-11-30 21:30:14', 11, 50),
(17, 'demo2', 'ssd', 'demo2', 111.00, '2024-12-01 01:02:43', '2024-12-01 01:02:43', 1, 50),
(18, 'demo', 'cpu', 'demo', 1111.00, '2024-12-01 07:28:05', '2024-12-01 07:28:05', 2, 50),
(19, 'DEMO6', 'Memory', 'DEMO6', 9999.00, '2024-12-01 09:57:02', '2024-12-09 02:31:23', 999, 50),
(20, 'Dell UltraSharp U2720Q', 'Monitor', 'Dell', 600.00, '2024-12-05 17:28:38', '2024-12-05 17:28:38', 10, 50),
(21, 'Samsung Odyssey G7', 'Monitor', 'Samsung', 550.00, '2024-12-05 17:28:38', '2024-12-05 17:28:38', 15, 50),
(22, 'LG 27GN950-B', 'Monitor', 'LG', 700.00, '2024-12-05 17:28:38', '2024-12-05 17:28:38', 12, 50),
(23, 'Acer Predator X34', 'Monitor', 'Acer', 800.00, '2024-12-05 17:28:38', '2024-12-05 17:28:38', 8, 50),
(24, 'BenQ Zowie XL2411P', 'Monitor', 'BenQ', 250.00, '2024-12-05 17:28:38', '2024-12-05 17:28:38', 9, 50),
(25, 'SanDisk Ultra 64GB USB 3.0', 'Accessories', 'SanDisk', 15.00, '2024-12-05 17:28:38', '2024-12-05 17:28:38', 50, 50),
(26, 'Kingston DataTraveler 32GB', 'Accessories', 'Kingston', 18.00, '2024-12-05 17:28:38', '2024-12-05 17:28:38', 40, 50),
(27, 'Sony WH-1000XM4 Wireless Headphones', 'Accessories', 'Sony', 350.00, '2024-12-05 17:28:38', '2024-12-05 17:28:38', 30, 50),
(28, 'Bose QuietComfort 35 II', 'Accessories', 'Bose', 300.00, '2024-12-05 17:28:38', '2024-12-05 17:28:38', 25, 50),
(29, 'Logitech MX Master 3 Wireless Mouse', 'Accessories', 'Logitech', 100.00, '2024-12-05 17:28:38', '2024-12-05 17:28:38', 20, 50),
(30, 'demo88', 'cpu', 'dem0', 222.00, '2025-01-01 09:13:56', '2025-01-01 09:13:56', 2, 50);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `discount_percentage` decimal(5,2) DEFAULT 0.00,
  `discount` decimal(10,2) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `usage_limit` int(11) DEFAULT 1,
  `previous_total` decimal(10,2) DEFAULT NULL,
  `after_total` decimal(10,2) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `discount_percentage`, `discount`, `expiry_date`, `usage_limit`, `previous_total`, `after_total`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'HNY2025', 0.00, 25.00, NULL, 1, NULL, NULL, 1, '2024-12-18 06:03:43', '2024-12-18 06:06:33');

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
(1, '2024_11_28_175906_create_components_table', 1),
(2, '2024_11_29_170305_create_users_table', 2),
(3, '2024_12_07_141155_create_orders_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','shipped','completed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_details` text DEFAULT NULL,
  `discounted_price` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `status`, `created_at`, `updated_at`, `order_details`, `discounted_price`) VALUES
(1, 2, 3700.00, 'processing', '2024-12-07 08:39:55', '2024-12-07 10:57:32', '[{\"name\":\"Dell UltraSharp U2720Q\",\"quantity\":\"2\",\"total_price\":1200},{\"name\":\"Samsung Odyssey G7\",\"quantity\":\"2\",\"total_price\":1100},{\"name\":\"LG 27GN950-B\",\"quantity\":\"2\",\"total_price\":1400}]', NULL),
(3, 1, 974.99, 'pending', '2024-12-07 11:17:39', '2024-12-07 11:17:39', '[{\"name\":\"Kingston HyperX Fury 16GB\",\"quantity\":1,\"total_price\":74.99},{\"name\":\"Samsung Odyssey G7\",\"quantity\":1,\"total_price\":550},{\"name\":\"Sony WH-1000XM4 Wireless Headphones\",\"quantity\":1,\"total_price\":350}]', NULL),
(4, 2, 299.97, 'processing', '2024-12-07 11:19:31', '2024-12-07 11:20:48', '[{\"name\":\"Kingston HyperX Fury 16GB\",\"quantity\":\"2\",\"total_price\":149.98},{\"name\":\"Patriot Viper Steel 32GB\",\"quantity\":1,\"total_price\":149.99}]', NULL),
(5, 2, 619.95, 'processing', '2024-12-09 02:29:23', '2024-12-09 02:29:58', '[{\"name\":\"G.SKILL Trident Z 32GB\",\"quantity\":\"2\",\"total_price\":319.98},{\"name\":\"Kingston HyperX Fury 16GB\",\"quantity\":\"2\",\"total_price\":149.98},{\"name\":\"Patriot Viper Steel 32GB\",\"quantity\":1,\"total_price\":149.99}]', NULL),
(6, 2, 1869.99, 'processing', '2024-12-09 02:37:08', '2024-12-09 02:37:25', '[{\"name\":\"Dell UltraSharp U2720Q\",\"quantity\":\"2\",\"total_price\":1200},{\"name\":\"Samsung Odyssey G7\",\"quantity\":1,\"total_price\":550},{\"name\":\"Crucial P5 Plus 1TB\",\"quantity\":1,\"total_price\":119.99}]', NULL),
(7, 2, 1500.00, 'processing', '2024-12-18 03:53:09', '2024-12-18 06:18:24', '[{\"name\":\"LG 27GN950-B\",\"quantity\":1,\"total_price\":700},{\"name\":\"Acer Predator X34\",\"quantity\":1,\"total_price\":800}]', 1125),
(8, 2, 399.99, 'processing', '2024-12-18 07:50:09', '2025-01-03 10:57:58', '[{\"name\":\"Core i7-12700K\",\"quantity\":1,\"total_price\":399.99}]', 300),
(9, 2, 99.99, 'processing', '2025-01-04 10:23:58', '2025-01-04 10:26:03', '[{\"name\":\"Kingston A2000 1TB\",\"quantity\":1,\"total_price\":99.99}]', NULL),
(10, 2, 700.00, 'processing', '2025-01-05 01:08:19', '2025-01-05 01:08:50', '[{\"name\":\"LG 27GN950-B\",\"quantity\":1,\"total_price\":700}]', NULL),
(11, 2, 117.99, 'processing', '2025-01-05 01:19:30', '2025-01-05 01:30:42', '[{\"name\":\"Kingston DataTraveler 32GB\",\"quantity\":1,\"total_price\":18},{\"name\":\"Kingston A2000 1TB\",\"quantity\":1,\"total_price\":99.99}]', NULL),
(12, 2, 700.00, 'processing', '2025-01-05 02:25:41', '2025-01-05 02:26:23', '[{\"name\":\"LG 27GN950-B\",\"quantity\":1,\"total_price\":700}]', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` bigint(20) NOT NULL,
  `type` enum('poll','vote') NOT NULL,
  `poll_id` bigint(20) DEFAULT NULL,
  `question` text NOT NULL,
  `option1` text DEFAULT NULL,
  `option2` text DEFAULT NULL,
  `option3` text DEFAULT NULL,
  `option4` text DEFAULT NULL,
  `vote_count1` int(11) DEFAULT 0,
  `vote_count2` int(11) DEFAULT 0,
  `vote_count3` int(11) DEFAULT 0,
  `vote_count4` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `type`, `poll_id`, `question`, `option1`, `option2`, `option3`, `option4`, `vote_count1`, `vote_count2`, `vote_count3`, `vote_count4`, `is_active`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 'poll', NULL, 'BRACU', 'bracu', 'hiu', 'seeu', 'niceu', 2, 0, 0, 0, 1, NULL, '2024-12-17 13:41:49', '2024-12-18 03:33:04'),
(5, 'poll', NULL, 'what is the name of the admin', 'saidur', 'saidur', 'saidur', 'saidur', 1, 3, 0, 0, 1, NULL, '2024-12-17 21:05:08', '2024-12-18 03:33:29'),
(6, 'poll', NULL, 'How ,much discount do you want ?', '10%', '20%', '30%', '40%', 0, 1, 0, 0, 1, NULL, '2024-12-18 07:47:26', '2024-12-18 07:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_type` enum('complaint','comment','request') NOT NULL,
  `star` tinyint(1) DEFAULT NULL CHECK (`star` between 1 and 5),
  `remark` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `review_type`, `star`, `remark`, `comment`, `created_at`, `updated_at`) VALUES
(1, 21, 2, 'complaint', NULL, NULL, NULL, '2024-12-16 13:54:49', '2024-12-16 13:54:49'),
(2, 21, 2, 'complaint', NULL, NULL, NULL, '2024-12-16 13:55:26', '2024-12-16 13:55:26'),
(3, 21, 2, 'comment', NULL, NULL, NULL, '2024-12-16 14:44:57', '2024-12-16 14:44:57'),
(4, 21, 2, 'complaint', NULL, NULL, NULL, '2024-12-16 14:45:18', '2024-12-16 14:45:18'),
(5, 21, 2, 'request', NULL, NULL, NULL, '2024-12-16 14:45:28', '2024-12-16 14:45:28'),
(6, 27, 2, 'comment', NULL, NULL, NULL, '2024-12-16 14:47:22', '2024-12-16 14:47:22'),
(7, 22, 2, 'comment', NULL, NULL, NULL, '2024-12-16 15:51:19', '2024-12-16 15:51:19'),
(8, 21, 1, 'comment', NULL, NULL, 'hi this is demo comment as comment by the admin', '2024-12-17 08:22:12', '2024-12-17 08:22:12'),
(9, 21, 1, 'comment', 3, NULL, 'demo10', '2024-12-17 08:35:00', '2024-12-17 08:35:00'),
(10, 4, 2, 'comment', 4, NULL, 'this product is good', '2024-12-18 07:44:09', '2024-12-18 07:44:09'),
(11, 4, 2, 'comment', 5, NULL, 'this is a good product', '2024-12-18 07:44:50', '2024-12-18 07:44:50'),
(12, 8, 2, 'comment', 4, NULL, 'this is my product review', '2025-01-04 09:55:19', '2025-01-04 09:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  `phone_number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `phone_number`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@example.com', '$2y$12$g0kVDEXdBjqU2XbGtX/thOifOUzoYENYSQyBRqz2D.FsvI/rtINn6', 'admin', NULL, NULL, NULL, NULL, NULL),
(2, 'demo', 'demo@example.com', '$2y$12$mmzmjnH4Pw1cmrBBuq4C5.zsstIugHmdXClqbBcR1Mv6gCIG3rCS6', 'customer', '123456789', 'none', NULL, '2024-12-07 07:04:58', '2024-12-07 07:04:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
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
-- AUTO_INCREMENT for table `components`
--
ALTER TABLE `components`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
