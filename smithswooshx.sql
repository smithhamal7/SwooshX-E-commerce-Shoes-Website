-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2025 at 01:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smith`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'smithhamal', 'smithhamal001@gmail.com', 's'),
(2, 'smith', 'smithhamal3@gmail.com', 'smith');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(33, 12, 12, 1),
(34, 20, 18, 1),
(35, 19, 18, 1),
(36, 10, 16, 1),
(37, 23, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `address`, `message`, `created_at`) VALUES
(5, 'Smith Hamal', 'smithamal001@gmail.com', '123', 'krishna mandir imadol gwarko', 'asd', '2025-02-23 06:20:38'),
(6, 'subash', 'subash@gmail.com', '123344', 'balkumari', 'Order ID: order_67bac71164c71\r\n\r\nTransaction ID: 2CZngKYtyuJjDWX82ShLFa', '2025-02-23 06:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('Pending','Paid','Failed') DEFAULT 'Pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `purchase_order_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `total_amount`, `payment_status`, `transaction_id`, `created_at`, `updated_at`, `purchase_order_id`) VALUES
(64, 12, 0, 0, 100.00, 'Paid', 'iqYkstY2qhjgA8kCbosaQQ', '2025-02-22 17:54:56', '2025-02-22 17:55:16', 'order_67ba0f716fcc2'),
(65, 12, 0, 0, 200.00, 'Paid', 'LQw668DVRA93kpZPkATzcm', '2025-02-23 06:21:06', '2025-02-23 06:21:36', 'order_67babe54928c3'),
(66, 20, 0, 0, 100.00, 'Paid', '2CZngKYtyuJjDWX82ShLFa', '2025-02-23 06:58:23', '2025-02-23 06:58:52', 'order_67bac71164c71'),
(67, 19, 0, 0, 100.00, 'Paid', 'JdtNURcLuzDsjKwzdHQGT8', '2025-02-23 07:03:14', '2025-02-23 07:05:34', 'order_67bac836ece6d'),
(68, 10, 0, 0, 120.00, 'Paid', 'H8arJpDa8weNdatgrnHtdS', '2025-02-23 09:36:36', '2025-02-23 09:37:14', 'order_67baec2ac1018'),
(69, 23, 0, 0, 111.00, 'Pending', NULL, '2025-05-06 05:16:39', '2025-05-06 05:16:39', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `size` varchar(50) DEFAULT 'N/A',
  `brand` varchar(100) DEFAULT NULL,
  `sizes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`, `created_at`, `size`, `brand`, `sizes`) VALUES
(12, 'Nike V2K Run', NULL, 200.00, 'https://images.footlocker.com/is/image/EBFL2/F0736100?wid=931&hei=931&fmt=png-alpha', '2025-02-22 17:29:43', '8 9 10 11 12 13 14', 'NIKE', NULL),
(15, 'New Balance 530', NULL, 100.00, 'https://images.footlocker.com/is/image/EBFL2/MR530LA?wid=931&hei=931&fmt=png-alpha', '2025-02-22 17:31:32', '8 9 10 11 12 13 14', 'new balance', NULL),
(16, 'New Balance 327', NULL, 120.00, 'https://images.footlocker.com/is/image/EBFL2/WS327FE?wid=931&hei=931&fmt=png-alpha', '2025-02-22 17:32:11', 'N/A', 'puma', NULL),
(18, 'New Balance 530', NULL, 100.00, 'https://images.footlocker.com/is/image/EBFL2/MR530CK?wid=931&hei=931&fmt=png-alpha', '2025-02-22 17:35:44', 'N/A', NULL, NULL),
(19, 'Nike Air Force 1 \'07', 'nike is very good', 111.00, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/b7d9211c-26e7-431a-ac24-b0540fb3c00f/AIR+FORCE+1+%2707.png', '2025-02-23 09:38:43', '10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `role`) VALUES
(8, 'Smith', 'smithamal001@gmail.com', '$2y$10$wlvJdPuw7idz9GgWT3tiDOSpMZRp8pqBz5xPnhkWzJF5PmMvKDqDi', '2025-02-16 05:31:53', 'admin'),
(10, 'Saroj', 'sarojoffl@gmail.com', '$2y$10$RLSgNd17N.hHHMioqWh9vuy9stVTb1Yb1fc3XfBJ9u1BKLd.M32BG', '2025-02-18 06:28:17', 'admin'),
(11, 'Prabesh', 'prabesh@gmail.com', '$2y$10$JcIAqnV8afSMh5aM/RAP9e5mHVILgBdDaxY5BRJEG6lrW3q0Eiplm', '2025-02-19 09:34:54', 'user'),
(12, 'Bindu', 'binduhamal1@gmail.com', '$2y$10$sQ3/R5a1M1V7ik.9DzTuuOSojoYUGTJk6AvOmw0H3Q8Z4EJPdSwAO', '2025-02-20 16:06:20', 'user'),
(17, '', 'asdf@ghjk.zxc', '$2y$10$geYdNiQTMkFki/aEx/eZcurjDhQatD8Acy4OF7EaGk2tC50fKTnfe', '2025-02-23 06:38:26', 'user'),
(18, 'Test Name', 'test@example.com', 'testpassword', '2025-02-23 06:42:34', 'user'),
(19, 'zen', 'zen@daya.tom', '$2y$10$qCx9ADT0s.9UGjAcRDFkA.XWEPO6MPCBF1xuPDWlTLti.ZENyfupq', '2025-02-23 06:55:53', 'user'),
(20, 'subash', 'subash@gmail.com', '$2y$10$ZP86FVSXjzJd36FvSnhxMOTWX.gFncalYUIeFxvTqwqH5ca0UtPQW', '2025-02-23 06:57:59', 'user'),
(21, 'smithhamal', 'smithhamal@gmail.com', 'smith123', '2025-02-23 08:48:17', 'admin'),
(22, 'alix', 'alix@gmail.com', '$2y$10$21mWl7a51QBMS8/8PIV5bus8pi8UGzS36Z1ukY4BWTKnoqZYBZa06', '2025-05-03 15:13:35', 'user'),
(23, 'smithhamal', 'smith111@gmail.com', '$2y$10$cCTbQTAo3e/VRbioXByY4uQ9WEeCGvArvQKANf9fdFVa8eJLanlT.', '2025-05-06 05:16:16', 'user'),
(24, 'smith', 'smith0@gmail.com', '$2y$10$uoP7tWPONhjVB2W436r/uO3LVkQsSRZwlYtNvaxVqBiV8tvTAMnVK', '2025-05-08 10:36:09', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_user` (`user_id`),
  ADD KEY `fk_cart_product` (`product_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_order_id` (`purchase_order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
