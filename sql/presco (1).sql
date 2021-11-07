-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2021 at 01:42 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presco`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`first_name`, `last_name`, `email`, `username`, `password`, `created_date`, `modified_date`) VALUES
('John Cyrus', 'Patungan', 'superadmin@gmail.com', 'superadmin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '2021-11-05 22:06:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `email` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`email`, `product_id`, `quantity`, `price`, `total_price`) VALUES
('cypatungan@gmail.com', 2, 69, 105.99, 6969);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` varchar(256) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `product_id`, `email`, `message`, `created_date`, `modified_date`) VALUES
(7, 2, 'cypatungan@gmail.com', 'hue hue pumasok', '2021-11-07 16:27:15', '2021-11-15 19:08:25'),
(8, 2, 'cypatungan@gmail.com', 'hue hue pumasok', '2021-11-07 17:49:49', '2021-11-15 19:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `image` varchar(500) NOT NULL,
  `price` double NOT NULL,
  `stocks` int(11) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `image`, `price`, `stocks`, `description`, `email`, `created_date`, `modified_date`) VALUES
(2, 'Candle baho', 'images/product/hello.png', 999, 80, 'This is good Candle', 'superadmin@gmail.com', '2021-11-05 21:02:37', '2021-11-15 19:08:25 '),
(3, 'Candle Scent', 'images/product/hello.png', 105.99, 80, 'This is good Candle', 'superadmin@gmail.com', '2021-11-07 15:09:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `feedback_id` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL,
  `message` varchar(256) NOT NULL,
  `email` varchar(200) NOT NULL,
  `type` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`feedback_id`, `reply_id`, `message`, `email`, `type`, `created_date`, `modified_date`) VALUES
(7, 1, 'hue hue pumasok ulit', 'superadmin@gmail.com', 0, '2021-11-07 17:05:32', '2021-11-15 19:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `tracking_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`tracking_id`, `transaction_id`, `status`, `created_date`) VALUES
(1, 2, 'ongoing', '2021-11-07 10:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `total_price` double NOT NULL,
  `created_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `email`, `product_id`, `price`, `total_price`, `created_date`) VALUES
(1, 'cypatungan@gmail.com', 2, 105.99, 6969, '2021-11-07 17:50:59'),
(2, 'cypatungan@gmail.com', 2, 105.99, 6969, '2021-11-07 18:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`username`, `password`, `created_date`) VALUES
('kupoc', '9aedefc01a154c2188e3f680b9ac9680c705f7dc2340c112a73a33e879f15218', '2021-11-07 12:39:04'),
('magressMatulog', '8db45b18051a7adc6377fba6d8d6586b32f594c8c8c14677686967337aeb4cf6', '2021-11-07 12:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `email` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`email`, `address`, `created_date`) VALUES
('cypatungan@gmail.com', 'quezonCityABS', '2021-11-07 12:40:46'),
('jack22@yahoo.com', 'quezoncity', '2021-11-07 12:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `full_name` varchar(200) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`full_name`, `birthdate`, `gender`, `email`, `username`) VALUES
('John Cyrus Combate Patungan', '1999-07-21', 'male', 'cypatungan@gmail.com', 'kupoc'),
('jake howell', '1999-11-15', 'male', 'jack22@yahoo.com', 'magressMatulog');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `email` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`email`, `product_id`) VALUES
('cypatungan@gmail.com', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`email`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `feedback_ibfk_2` (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `feedback_id` (`feedback_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`tracking_id`),
  ADD KEY `tracking_ibfk_1` (`transaction_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `email` (`email`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`email`,`address`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`email`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`email`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `tracking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_info` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`email`) REFERENCES `user_info` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`email`) REFERENCES `admin_account` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`feedback_id`) REFERENCES `feedback` (`feedback_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`email`) REFERENCES `admin_account` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tracking`
--
ALTER TABLE `tracking`
  ADD CONSTRAINT `tracking_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_info` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_info` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user_account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_info` (`email`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
