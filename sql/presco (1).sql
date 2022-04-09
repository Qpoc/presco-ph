-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2022 at 07:44 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.25

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
('Jake Howell', 'Lubrica', 'jake@gmail.com', 'jake', 'cdf30c6b345276278bedc7bcedd9d5582f5b8e0c1dd858f46ef4ea231f92731d', '2022-02-08 02:45:43', '2022-02-07 19:44:47'),
('Jheymie Nicole', 'Lintingco', 'jheymie.lintingco@gmail.com', 'jheymie', 'faec542f9edef11c755d4ba09f06cf754328cd1b1ccf76b08ead6f4599acb34f', '2022-02-08 02:45:43', '2022-02-07 19:44:47'),
('Renwell jean', 'Angel', 'renwell@gmail.com', 'renwell', 'f3482c692aa50a56fccecb2b309277c22666e4ef44081ff73afef554eb183622', '2022-02-08 02:46:11', '2022-02-07 19:45:48'),
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
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`email`, `product_id`, `quantity`, `price`, `created_date`) VALUES
('cypatungan@gmail.com', 23, 1, 300, '2022-02-13 19:10:27'),
('cypatungan@gmail.com', 24, 1, 350, '2022-02-13 19:10:28'),
('cypatungan@gmail.com', 25, 1, 400, '2022-02-13 19:10:27'),
('womaderet@mailinator.com', 23, 1, 300, '2022-02-15 05:27:58'),
('womaderet@mailinator.com', 24, 1, 350, '2022-02-15 05:27:56'),
('womaderet@mailinator.com', 25, 1, 400, '2022-02-15 05:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_type` varchar(200) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `category_icon` varchar(500) DEFAULT NULL,
  `category_bg` varchar(500) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_date` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_type`, `category_name`, `category_icon`, `category_bg`, `message`, `created_date`, `modified_date`) VALUES
('Candles', 'Coconut Blend Candles', 'uploads/categories/category_icon/62015df5544b4.jpg', 'uploads/categories/category_type/62015df649fdc.jpg', 'Blend in Scented Candles', '2022-02-07 17:59:18', NULL),
('Candles', 'Flora Collection', 'uploads/categories/category_icon/61a6269d668fc.png', 'uploads/categories/category_type/61a6269d69592.jpg', 'This is one of our best seller', '2022-02-06 17:15:51', NULL),
('Candles', 'Home Collection', 'uploads/categories/category_icon/6200015e08a8e.png', 'uploads/categories/category_type/6200015e0b4d6.jpg', 'Perfect for you home', '2022-02-06 17:15:03', NULL),
('Candles', 'Play Collection', 'uploads/categories/category_icon/62015a8248bf7.jpg', 'uploads/categories/category_type/62015a825067b.jpg', 'Play collection for you.', '2022-02-07 17:44:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `message` varchar(256) DEFAULT NULL,
  `rating` float NOT NULL,
  `feedback_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `transaction_id`, `product_id`, `message`, `rating`, `feedback_created_date`, `modified_date`) VALUES
(107, '3sycxf51i1644771883', 30, 'This is one of the best candle I\'ve ever had. Recommended definitely will buy again.', 5, '2022-02-14 03:20:29', ''),
(108, '3sycxf51i1644771883', 42, 'Perfect for holiday season.\n', 1, '2022-02-14 03:20:40', ''),
(109, '3sycxf51i1644771883', 41, 'Barely acceptable, still love it though.', 1, '2022-02-14 03:20:53', ''),
(110, 'u5jqnahkc1644779438', 25, 'Decent candle. I will buy again.', 4, '2022-02-14 03:37:29', ''),
(111, 'u5jqnahkc1644779438', 23, 'This is one of my favorite.', 5, '2022-02-14 03:37:38', ''),
(112, 'u5jqnahkc1644779438', 24, 'Packaging is not good.', 2, '2022-02-14 03:37:46', '');

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
  `category_type` varchar(200) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `featured` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `product_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `image`, `price`, `stocks`, `description`, `category_type`, `category_name`, `featured`, `email`, `product_created_date`, `modified_date`) VALUES
(23, 'Silang', 'uploads/products/61881b8867dc1.jpg', 300, 100, '<p>A mouthwatering combination of light delicious chocolate and peppermint, just like the real deal.<br />\nComes in cute 60ml travel-friendly tins!</p>\n', 'Candles', 'Flora Collection', 1, 'superadmin@gmail.com', '2021-11-08 02:31:36', NULL),
(24, 'Sweet Pea', 'uploads/products/61881c7cb0619.jpg', 350, 35, '<p>The true layered pear captures the natural scent of the brandied sweet pears!</p>\n', 'Candles', 'Home Collection', 1, 'superadmin@gmail.com', '2021-11-08 02:35:40', NULL),
(25, 'English Pear and Freesia', 'uploads/products/61881c93ea049.jpg', 400, 20, '<p>This scent provides a healthy balance of relaxing and uplifting! It can envelop your room, without overpowering it, providing that vibe of calming productivity.</p>\n', 'Candles', 'Home Collection', 1, 'superadmin@gmail.com', '2021-11-08 02:36:03', NULL),
(26, 'Floral Fusion Soy Candle', 'uploads/products/61a63113118af.png', 799, 100, '<p>Floral Fusion is a gorgeous but relaxing blend with topnotes of bergamot and thyme, middle notes of clove, white flower, lilac and ylang ylang and dry notes of light musk, vanilla bean and white cedar.</p>\n', 'Candles', 'Flora Collection', 0, 'superadmin@gmail.com', '2021-11-30 22:11:31', NULL),
(30, 'Soy Wax Candle', 'uploads/products/620164fce4266.jpg', 1320, 100, '<p>Bathe your room with the soft natural light and clean scent of our Soy Wax Candle, hand-poured using pure soy wax and a lead-free cotton wick. With a total burn time of 70-100 hours, this candle fills the room with the right amount of scent without diminishing air quality.<br />\r\n<br />\r\n<strong>Contains:</strong><br />\r\n(1) 11-oz scented soy candle in a reusable black jar<br />\r\n<br />\r\n<strong>Perfect for:</strong><br />\r\nLovely homeowners wanting to set a tranquil and refreshing ambiance with the candle&rsquo;s clean burn and dim glow. Ideal for people who can keep an eye on the burning candle.<br />\r\n<br />\r\n<strong>How to use:</strong><br />\r\nTrim the wick to a fourth of an inch before each lighting. For best results, burn the candle for 2-3 hours at a time. Be sure to always burn candles within sight and away from anything flammable. Keep it out of reach from children and pets.</p>\r\n', 'Candles', 'Play Collection', 1, 'superadmin@gmail.com', '2022-02-06 23:58:37', NULL),
(40, 'Aroma Machine 150mL Capacity', 'uploads/products/6201656a1972f.jpg', 2300, 100, '<p>Disperse the soothing aroma of essential oils into the air with our Aroma Machine. Its continuous mist provides any room with a consistent and balanced fragrance in just a&nbsp; couple of minutes.</p>\r\n\r\n<p><strong>Contains:</strong><br />\r\n(1) aroma diffuser machine with a water capacity of your choice<br />\r\n*Oil diffusers not included<br />\r\n<br />\r\n<strong>Perfect for:</strong><br />\r\nLovely homeowners looking to scent up their home within a short period. You can also adjust the fragrance strength and intensity to your desire.<br />\r\n<br />\r\n<strong>How to use:</strong><br />\r\nSet up the machine near a wall outlet and at least two feet above the floor to ensure proper moisture distribution. Fill it up using filtered water, then add 5-8 drops of oil diffuser or as desired. Adjust the settings as needed.</p>\r\n', 'Candles', 'Coconut Blend Candles', 0, 'superadmin@gmail.com', '2022-02-08 02:31:06', NULL),
(41, 'Soy Wax Candle with Snuffer', 'uploads/products/620165cc8ea8f.jpg', 1920, 100, '<p>Bathe your room with the soft natural light and clean scent of our Soy Wax Candle, hand-poured using pure soy wax and a lead-free cotton wick. With a total burn time of 70-100 hours, this candle fills the room with the right amount of scent without diminishing air quality. Easily extinguish your candle with our stylish black chrome snuffer.<br />\r\n<br />\r\n<em>Our Soy Wax Candle with Snuffer comes in a gift box with nestings, so you can instantly give them as gifts for friends and family.</em><br />\r\n<br />\r\n<strong>Contains:</strong><br />\r\n(1) 11-oz scented soy candle in a reusable black jar<br />\r\n(1) candle snuffer<br />\r\n<br />\r\n<strong>Perfect for:</strong><br />\r\nLovely homeowners wanting to set a tranquil and refreshing ambiance with the candle&rsquo;s clean burn and dim glow. Ideal for people who can keep an eye on the burning candle.<br />\r\n<br />\r\n<strong>How to use:</strong><br />\r\nTrim the wick to a fourth of an inch before each lighting. For best results, burn the candle for 2-3 hours at a time. Be sure to always burn candles within sight and away from anything flammable. Keep it out of reach from children and pets.</p>\r\n', 'Candles', 'Coconut Blend Candles', 1, 'superadmin@gmail.com', '2022-02-08 02:32:44', NULL),
(42, 'Soy Wax Candle (Holiday Edition)', 'uploads/products/6201662a7e491.png', 1390, 100, '<p>Available in Warm Vanilla and Cinnamon Apple fragrances, the soy wax candle is the perfect Lovely gift for the friend who loves the holiday atmosphere created by the candle&rsquo;s clean burn and soft natural light.<br />\r\n<br />\r\n<em>Our Soy Wax Candle (Holiday Edition) comes wrapped in our signature Lovely holiday packaging, so you can instantly give them as gifts for friends and family. It is available in two limited edition scents: Cinnamon Apple and Warm Vanilla.</em><br />\r\n<br />\r\n<strong>Contains:</strong><br />\r\n(1) 11-oz scented soy candle in a reusable black jar<br />\r\n<br />\r\n<strong>Perfect for:</strong><br />\r\nLovely friends wanting to immerse themselves in the holiday atmosphere with scents that remind them of early Christmas morning: Warm Vanilla and Cinnamon Apple.<br />\r\n<br />\r\n<strong>How to use:</strong><br />\r\nTrim the wick to a fourth of an inch before each lighting. For best results, burn the candle for 2-3 hours at a time. Be sure to always burn candles within sight and away from anything flammable. Keep it out of reach from children and pets.</p>\r\n', 'Candles', 'Play Collection', 1, 'superadmin@gmail.com', '2022-02-08 02:34:18', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `tracking_id` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`tracking_id`, `transaction_id`, `status`, `created_date`, `modified_date`) VALUES
('5eh2pmuio1644776384', 'sqwtk5znx1644776384', 1, '2022-02-13 18:19:44', '2022-02-14 02:19:44'),
('b36j0n9xk1644780110', 'e1gw72ypi1644780110', 1, '2022-02-13 19:21:50', '2022-02-14 03:21:50'),
('cmg91azqn1644780115', 's4mxwjger1644780115', 1, '2022-02-13 19:21:55', '2022-02-14 03:21:55'),
('kcyhv7bp11644779438', 'u5jqnahkc1644779438', 5, '2022-02-13 19:10:38', '2022-02-14 03:10:38'),
('mlj2a83rx1644903412', 'xe5ms64on1644903412', 1, '2022-02-15 05:36:52', '2022-02-15 13:36:52'),
('n12k8p7i41644780127', 'x4sez59yv1644780127', 1, '2022-02-13 19:22:07', '2022-02-14 03:22:07'),
('nogkjscfb1644780120', 'bsm9rcop71644780120', 1, '2022-02-13 19:22:00', '2022-02-14 03:22:00'),
('sz38ai7mh1644771883', '3sycxf51i1644771883', 5, '2022-02-13 17:04:43', '2022-02-14 01:04:43'),
('x32gafwjd1644774625', '9pxir1alu1644774625', 3, '2022-02-13 17:50:25', '2022-02-14 02:32:00'),
('xm9kw6il11644780103', 'jocg0u2r11644780103', 1, '2022-02-13 19:21:43', '2022-02-14 03:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `delivery_fee` double NOT NULL,
  `total_price` double NOT NULL,
  `mode_payment` int(11) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `email`, `price`, `delivery_fee`, `total_price`, `mode_payment`, `created_date`) VALUES
('3sycxf51i1644771883', 'cypatungan@gmail.com', 4630, 90, 4720, 2, '2022-02-14 01:04:43'),
('9pxir1alu1644774625', 'cypatungan@gmail.com', 350, 90, 440, 1, '2022-02-14 01:50:25'),
('bsm9rcop71644780120', 'jheymie@gmail.com', 1390, 90, 1480, 1, '2022-02-14 03:22:00'),
('e1gw72ypi1644780110', 'jheymie@gmail.com', 799, 90, 889, 1, '2022-02-14 03:21:50'),
('jocg0u2r11644780103', 'jheymie@gmail.com', 2300, 90, 2390, 1, '2022-02-14 03:21:43'),
('s4mxwjger1644780115', 'jheymie@gmail.com', 400, 90, 490, 1, '2022-02-14 03:21:55'),
('sqwtk5znx1644776384', 'jheymie@gmail.com', 300, 90, 390, 1, '2022-02-14 02:19:44'),
('u5jqnahkc1644779438', 'cypatungan@gmail.com', 1650, 90, 1740, 1, '2022-02-14 03:10:38'),
('x4sez59yv1644780127', 'jheymie@gmail.com', 400, 90, 490, 1, '2022-02-14 03:22:07'),
('xe5ms64on1644903412', 'cypatungan@gmail.com', 3150, 90, 3240, 1, '2022-02-15 13:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_product`
--

CREATE TABLE `transaction_product` (
  `product_id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `quantity` double NOT NULL,
  `reviewed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_product`
--

INSERT INTO `transaction_product` (`product_id`, `transaction_id`, `quantity`, `reviewed`) VALUES
(23, 'sqwtk5znx1644776384', 1, 0),
(23, 'u5jqnahkc1644779438', 3, 1),
(23, 'xe5ms64on1644903412', 8, 0),
(24, '9pxir1alu1644774625', 1, 0),
(24, 'u5jqnahkc1644779438', 1, 1),
(24, 'xe5ms64on1644903412', 1, 0),
(25, 's4mxwjger1644780115', 1, 0),
(25, 'u5jqnahkc1644779438', 1, 1),
(25, 'x4sez59yv1644780127', 1, 0),
(25, 'xe5ms64on1644903412', 1, 0),
(26, 'e1gw72ypi1644780110', 1, 0),
(30, '3sycxf51i1644771883', 1, 1),
(40, 'jocg0u2r11644780103', 1, 0),
(41, '3sycxf51i1644771883', 1, 1),
(42, '3sycxf51i1644771883', 1, 1),
(42, 'bsm9rcop71644780120', 1, 0);

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
('jheymie', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2022-01-20 10:11:28'),
('kupoc', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2021-11-07 14:34:58'),
('qucady', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2022-02-15 04:08:47');

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
('cypatungan@gmail.com', 'Ermin Garcia St.', '2022-02-07 17:18:33'),
('jheymie@gmail.com', 'Caloocan City', '2022-01-20 10:11:28'),
('womaderet@mailinator.com', 'Delectus quia est q', '2022-02-15 04:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `ban` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`first_name`, `last_name`, `birthdate`, `gender`, `email`, `contact_number`, `username`, `ban`) VALUES
('John Cyrus', 'Patungan', '1999-07-21', 'Male', 'cypatungan@gmail.com', '09948987869', 'kupoc', 0),
('Jheymie Nicole', 'Lintingco', '2022-01-05', 'Female', 'jheymie@gmail.com', '09557485685', 'jheymie', 0),
('Genevieve', 'Richard', '2022-02-07', 'Female', 'womaderet@mailinator.com', '127', 'qucady', 0);

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
('cypatungan@gmail.com', 24),
('cypatungan@gmail.com', 25),
('jheymie@gmail.com', 24);

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
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_type`,`category_name`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `transaction_id` (`transaction_id`);

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
  ADD KEY `email` (`email`);

--
-- Indexes for table `transaction_product`
--
ALTER TABLE `transaction_product`
  ADD PRIMARY KEY (`product_id`,`transaction_id`),
  ADD KEY `transaction_product_ibfk_2` (`transaction_id`);

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
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_info` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_product`
--
ALTER TABLE `transaction_product`
  ADD CONSTRAINT `transaction_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_product_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_info` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
