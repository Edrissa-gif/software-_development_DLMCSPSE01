-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 06:50 PM
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
-- Database: `tempsclothing`
--
CREATE DATABASE IF NOT EXISTS `tempsclothing` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tempsclothing`;

-- --------------------------------------------------------

--
-- Table structure for table `card_details`
--

CREATE TABLE `card_details` (
  `product_id` int(11) NOT NULL,
  `quantity` int(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card_details`
--

INSERT INTO `card_details` (`product_id`, `quantity`, `user_id`) VALUES
(7, 1, 1),
(10, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_title` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keyword` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_title`, `product_title`, `product_description`, `product_keyword`, `product_id`, `product_image`, `product_price`, `date`, `status`) VALUES
(0, 'Light Blue Trackies', 'Get flashy with our Tracksuits', 'tracksuit', 1, 'track suit 3.webp', '80', '2025-02-18 19:37:33', 'true'),
(0, 'Bkack Round Neck Shirt', 'elevate your style with our unique black shirts', 'shirt', 2, 'neck shirt3.webp', '19.99', '2025-02-07 15:42:15', 'true'),
(0, 'Grey Tracksuit', 'Highly stylish outfit, suitable for both summer and winter', 'tracksuit', 3, 'tracksuit 2.webp', '60.99', '2025-02-07 15:43:48', 'true'),
(0, 'Light Green Shirt', 'Stay Clean with our ultimately flashy  light green colour shirts', 'shirt', 4, 'neck shirts 1.webp', '15.99', '2025-02-07 15:46:05', 'true'),
(0, 'Cosy Jacket', 'flamboyant stylist jacket for fancy looks', 'jacket', 5, 'jacket 3.jpg', '12.99', '2025-02-07 15:48:57', 'true'),
(0, 'Black Front Print', 'A front design that can elevate your style', 'shirt', 6, 'tshirt 2.webp', '34.99', '2025-02-18 21:00:50', 'true'),
(0, 'Stylish white Tee', 'Comfy and Flashy for your daily looks', 'shirt', 7, 'tshirt 1.webp', '20.99', '2025-02-21 16:57:51', 'true'),
(0, 'Brown Tee Shirt', 'Stylish Tee Shirt with a front print', 'shirt', 8, 'tshirt 4.webp', '23.98', '2025-02-21 16:59:10', 'true'),
(0, 'Black Jacky', 'Standout with or zipped design Jacket', 'jacket', 9, 'jacket 1.jpg', '23.99', '2025-02-21 17:01:24', 'true'),
(0, 'Green Cowboy Jacket', 'Wonderful classy jacket for night outs', 'jacket', 10, 'jacket 2.jpg', '30.99', '2025-02-21 17:02:37', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `address`, `total`, `order_date`) VALUES
(5, 1, 'amie', 'schillerstrasse 30,10627', 334, '2025-02-24 20:37:04'),
(6, 1, 'enebdhr', 'turmstrasse, 20 10789', 55, '2025-02-24 20:42:22'),
(7, 1, 'james', 'schillerstrasse,20 10627', 41, '2025-02-24 20:55:17'),
(8, 1, 'Osman Jallow', 'alexanderplatz, 39 19867', 47, '2025-02-24 20:59:12'),
(9, 1, 'busso', 'washauerstr,30 10833', 92, '2025-02-24 21:07:39'),
(10, 1, 'john', 'john65gmail.com', 56, '2025-02-24 21:24:20'),
(11, 1, 'juju babeh', 'deustcher oper 20,109832', 184, '2025-02-24 22:26:16'),
(12, 1, 'emily kelling', 'indian. 32 10292', 543, '2025-02-25 16:10:29'),
(13, 1, 'edi', 'schillerstrasse 30,10627', 13, '2025-02-25 16:24:37'),
(14, 1, 'busso', 'sbdhfk, 12. 2223', 37, '2025-02-25 17:29:54'),
(15, 1, 'busso', 'jzi7t 56, 8999', 108, '2025-02-25 18:11:44'),
(16, 1, 'busso', ',hjgfkulj 8j', 316, '2025-02-25 20:02:36'),
(17, 1, 'edrr', 'turmstrasse 12, berlin ', 226, '2025-03-07 22:42:00'),
(18, 1, 'busso', 'jjserwu0erui 56 19273', 210, '2025-04-07 10:48:52'),
(19, 1, 'emily kelling', 'wdshkjsh 378.joreie', 41, '2025-04-07 12:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 5, 2, 1),
(2, 5, 3, 3),
(3, 5, 7, 1),
(4, 5, 9, 2),
(5, 5, 10, 2),
(6, 6, 9, 1),
(7, 6, 10, 1),
(8, 7, 2, 1),
(9, 7, 7, 1),
(10, 8, 4, 1),
(11, 8, 10, 1),
(12, 9, 3, 1),
(13, 9, 10, 1),
(14, 10, 6, 1),
(15, 10, 7, 1),
(16, 11, 3, 1),
(17, 11, 4, 1),
(18, 11, 7, 1),
(19, 11, 8, 1),
(20, 11, 10, 2),
(21, 12, 1, 1),
(22, 12, 2, 1),
(23, 12, 3, 4),
(24, 12, 4, 2),
(25, 12, 5, 3),
(26, 12, 7, 2),
(27, 12, 9, 1),
(28, 12, 10, 2),
(29, 13, 5, 1),
(30, 14, 5, 1),
(31, 14, 9, 1),
(32, 15, 3, 1),
(33, 15, 4, 1),
(34, 15, 10, 1),
(35, 16, 1, 1),
(36, 16, 3, 1),
(37, 16, 4, 2),
(38, 16, 5, 2),
(39, 16, 7, 1),
(40, 16, 8, 2),
(41, 16, 9, 2),
(42, 17, 1, 1),
(43, 17, 3, 1),
(44, 17, 4, 1),
(45, 17, 5, 1),
(46, 17, 6, 1),
(47, 17, 7, 1),
(48, 18, 1, 1),
(49, 18, 3, 1),
(50, 18, 7, 1),
(51, 18, 9, 2),
(52, 19, 2, 1),
(53, 19, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`) VALUES
(1, 'Shirts'),
(2, 'Jackets'),
(3, 'Tracksuits');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'bussonjie@gmail.com', '123456789'),
(2, 'osman76@gmail.com', '199909'),
(3, 'emily@gmail.com', '246810'),
(4, 'osman78@gmail.com', '1234567'),
(5, 'jesmine2@gmail.com', 'jallow'),
(6, 'abdul@gmail.com', '123456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_details`
--
ALTER TABLE `card_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card_details`
--
ALTER TABLE `card_details`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
