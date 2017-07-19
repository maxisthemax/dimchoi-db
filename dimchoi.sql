-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2017 at 05:04 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dimchoi`
--

-- --------------------------------------------------------

--
-- Table structure for table `beverage`
--

CREATE TABLE `beverage` (
  `i_bev_id` int(11) NOT NULL,
  `i_menu_id` int(11) NOT NULL DEFAULT '2',
  `va_bev_name` varchar(100) NOT NULL,
  `i_bev_type_id` int(11) DEFAULT NULL,
  `va_bev_size` int(11) DEFAULT NULL,
  `va_bev_CH` int(11) DEFAULT NULL,
  `va_bev_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beverage`
--

INSERT INTO `beverage` (`i_bev_id`, `i_menu_id`, `va_bev_name`, `i_bev_type_id`, `va_bev_size`, `va_bev_CH`, `va_bev_price`) VALUES
(1, 1, 'Honey Lemon Juice', NULL, NULL, NULL, 5),
(2, 1, 'Ice Plum Drink', NULL, NULL, NULL, 4),
(3, 1, 'Ice Fruit Tea', NULL, NULL, NULL, 4),
(4, 1, 'Fresh Brewed Cold Tea', NULL, NULL, NULL, 3.5);

-- --------------------------------------------------------

--
-- Table structure for table `beverage_type`
--

CREATE TABLE `beverage_type` (
  `i_bev_type_id` int(11) NOT NULL,
  `i_bev_type_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `i_city_id` int(11) NOT NULL,
  `va_city_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`i_city_id`, `va_city_name`) VALUES
(1, 'Subang Jaya'),
(2, 'Cheras'),
(3, 'Shah Alam'),
(4, 'Kelana Jaya'),
(5, 'Ampang');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `i_food_id` int(11) NOT NULL,
  `i_menu_id` int(11) NOT NULL,
  `va_food_name` varchar(100) NOT NULL,
  `i_food_type_id` int(11) DEFAULT NULL,
  `va_food_size` varchar(10) DEFAULT NULL,
  `d_food_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`i_food_id`, `i_menu_id`, `va_food_name`, `i_food_type_id`, `va_food_size`, `d_food_price`) VALUES
(1, 1, 'SPA Chicken Cutlet', 1, '', 10),
(2, 1, 'Spicy Chicken Boxing + Wing', 1, '', 10),
(3, 1, 'Signature Crispy Chicken Nugget', 1, 'S', 9),
(4, 1, 'Signature Crispy Chicken Nugget', 1, 'L', 15),
(5, 1, 'QQ Deepsea Squid', 2, 'S', 12),
(6, 1, 'QQ Deepsea Squid', 2, 'L', 20),
(7, 1, 'Crispy Garlic - Flavored King Oyster Mushroom', 2, '', 7),
(8, 1, 'Golden French Fries With TarTar Sauces', 2, '', 7);

-- --------------------------------------------------------

--
-- Table structure for table `food_type`
--

CREATE TABLE `food_type` (
  `i_food_type_id` int(11) NOT NULL,
  `va_food_type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_type`
--

INSERT INTO `food_type` (`i_food_type_id`, `va_food_type_name`) VALUES
(1, 'main'),
(2, 'side dish');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `i_menu_id` int(11) NOT NULL,
  `i_res_id` int(11) NOT NULL,
  `va_menu_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`i_menu_id`, `i_res_id`, `va_menu_code`) VALUES
(1, 1, 'JDFG_M01');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `i_res_id` int(11) NOT NULL,
  `va_res_name` varchar(100) NOT NULL,
  `va_res_code` varchar(20) NOT NULL,
  `i_state_id` int(11) NOT NULL,
  `i_city_id` int(11) NOT NULL,
  `i_res_stat` int(11) NOT NULL DEFAULT '1',
  `va_res_logo` varchar(500) DEFAULT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `i_feature` int(11) NOT NULL DEFAULT '99',
  `va_feature_ad` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`i_res_id`, `va_res_name`, `va_res_code`, `i_state_id`, `i_city_id`, `i_res_stat`, `va_res_logo`, `dt_create`, `i_feature`, `va_feature_ad`) VALUES
(1, 'J&G Fried Chicken', 'JGFC_01', 1, 1, 1, 'http://i.imgur.com/6vOQGnI.jpg', '2017-06-27 00:20:14', 1, ''),
(2, 'KFC', 'KFC_01', 1, 1, 1, 'https://upload.wikimedia.org/wikipedia/en/thumb/b/bf/KFC_logo.svg/1024px-KFC_logo.svg.png', '2017-06-27 00:20:14', 1, 'https://storage.googleapis.com/mf_media/2016/02/KFC-Super-Jimat-Box-Promotion-2016.png'),
(3, 'MCD', 'MCD_01', 1, 1, 1, 'http://1.bp.blogspot.com/-0tIvR0r5AXM/VCJpO4GZBHI/AAAAAAAABXQ/V3BaBKftBN4/s1600/mcd-logo.png', '2017-06-27 00:20:14', 2, ''),
(4, 'OLD TOWN', 'OLD_01', 1, 1, 1, 'http://whitecoffeemarket.com/wp-content/uploads/sites/5/2013/10/xOLDTOWN-Logo.png.pagespeed.ic.fw3AzRvr2Q.png', '2017-06-27 00:20:14', 0, ''),
(5, 'Burger King', 'BK_01', 1, 1, 1, 'https://img.shopcoupons.my/files/burger%20king%20logo.1437562381.png', '2017-06-27 00:20:14', 1, ''),
(6, 'Tealive', 'TL_01', 2, 2, 1, 'http://www.kwiknews.my/sites/default/files/3db0.png', '2017-06-27 00:20:14', 0, ''),
(7, 'testing max', '12', 1, 5, 1, 'test123', '2017-07-13 23:13:40', 0, ''),
(8, 'testing max 1', '123', 1, 5, 1, '123', '2017-07-15 23:48:20', 99, '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `va_name` varchar(100) DEFAULT NULL,
  `va_value` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`va_name`, `va_value`) VALUES
('dev', '{\"dev\":\"3\"}');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `i_state_id` int(11) NOT NULL,
  `va_state_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`i_state_id`, `va_state_name`) VALUES
(1, 'Selangor'),
(2, 'Kuala Lumpur');

-- --------------------------------------------------------

--
-- Table structure for table `state_city`
--

CREATE TABLE `state_city` (
  `id` int(11) NOT NULL,
  `i_state_id` int(11) NOT NULL,
  `i_city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state_city`
--

INSERT INTO `state_city` (`id`, `i_state_id`, `i_city_id`) VALUES
(1, 1, 1),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(2, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beverage`
--
ALTER TABLE `beverage`
  ADD PRIMARY KEY (`i_bev_id`),
  ADD KEY `i_menu_id` (`i_menu_id`),
  ADD KEY `i_bev_type_id` (`i_bev_type_id`);

--
-- Indexes for table `beverage_type`
--
ALTER TABLE `beverage_type`
  ADD PRIMARY KEY (`i_bev_type_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`i_city_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`i_food_id`),
  ADD KEY `i_menu_id` (`i_menu_id`),
  ADD KEY `i_food_type` (`i_food_type_id`);

--
-- Indexes for table `food_type`
--
ALTER TABLE `food_type`
  ADD PRIMARY KEY (`i_food_type_id`),
  ADD KEY `i_food_type_id` (`i_food_type_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`i_menu_id`),
  ADD KEY `i_res_id` (`i_res_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`i_res_id`),
  ADD UNIQUE KEY `va_res_code` (`va_res_code`),
  ADD KEY `i_res_id` (`i_res_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD UNIQUE KEY `Name` (`va_name`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`i_state_id`);

--
-- Indexes for table `state_city`
--
ALTER TABLE `state_city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `i_state_id` (`i_state_id`,`i_city_id`),
  ADD KEY `i_city_id` (`i_city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beverage`
--
ALTER TABLE `beverage`
  MODIFY `i_bev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `beverage_type`
--
ALTER TABLE `beverage_type`
  MODIFY `i_bev_type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `i_city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `i_food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `food_type`
--
ALTER TABLE `food_type`
  MODIFY `i_food_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `i_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `i_res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `i_state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `state_city`
--
ALTER TABLE `state_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `beverage`
--
ALTER TABLE `beverage`
  ADD CONSTRAINT `beverage_ibfk_1` FOREIGN KEY (`i_menu_id`) REFERENCES `menu` (`i_menu_id`),
  ADD CONSTRAINT `beverage_ibfk_2` FOREIGN KEY (`i_bev_type_id`) REFERENCES `beverage_type` (`i_bev_type_id`);

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`i_menu_id`) REFERENCES `menu` (`i_menu_id`),
  ADD CONSTRAINT `food_ibfk_2` FOREIGN KEY (`i_food_type_id`) REFERENCES `food_type` (`i_food_type_id`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`i_res_id`) REFERENCES `restaurant` (`i_res_id`);

--
-- Constraints for table `state_city`
--
ALTER TABLE `state_city`
  ADD CONSTRAINT `state_city_ibfk_1` FOREIGN KEY (`i_city_id`) REFERENCES `city` (`i_city_id`),
  ADD CONSTRAINT `state_city_ibfk_2` FOREIGN KEY (`i_state_id`) REFERENCES `state` (`i_state_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
