-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2017 at 02:15 AM
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
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `i_area_id` int(11) NOT NULL,
  `va_area_name` varchar(500) NOT NULL,
  `i_city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`i_area_id`, `va_area_name`, `i_city_id`) VALUES
(1, 'Sunway Pyramid', 1),
(2, 'SS15', 1),
(3, 'Paradigm Mall', 2),
(4, 'Tropicana City Mall', 2),
(5, 'One Utama', 3),
(6, 'Jaya Shopping Centre', 2),
(7, 'Seapark', 2),
(8, 'Quill City Mall', 4);

-- --------------------------------------------------------

--
-- Table structure for table `bev`
--

CREATE TABLE `bev` (
  `i_bev_id` int(11) NOT NULL,
  `i_menu_id` int(11) NOT NULL DEFAULT '2',
  `va_bev_name` varchar(100) NOT NULL,
  `va_bev_desc` longtext NOT NULL,
  `i_bev_type_id` int(11) DEFAULT NULL,
  `va_bev_pic_url` varchar(500) DEFAULT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bev`
--

INSERT INTO `bev` (`i_bev_id`, `i_menu_id`, `va_bev_name`, `va_bev_desc`, `i_bev_type_id`, `va_bev_pic_url`, `dt_create`) VALUES
(1, 1, 'Honey Lemon Juice', '', 1, '', '2017-09-09 17:25:40'),
(2, 1, 'Ice Plum Drink', '', 1, '', '2017-09-09 17:25:40'),
(3, 1, 'Ice Fruit Tea', '', 1, '', '2017-09-09 17:25:40'),
(4, 1, 'Fresh Brewed Cold Tea', '', 1, '', '2017-09-09 17:25:40'),
(5, 2, 'Pudding', 'Entirely home-made, our puddings are incredibly light, refreshing & delicious! It\'s a sweet sweet end any good meal.', 2, '', '2017-09-12 23:49:15'),
(6, 3, 'Mineral Water', '', 1, '', '2017-09-28 10:46:48'),
(7, 3, 'Longan', '', 1, '', '2017-09-28 10:52:38'),
(8, 3, 'Homesoy', '', 1, '', '2017-09-28 10:52:51'),
(9, 3, 'Lemon Tea', '', 1, '', '2017-09-28 10:53:09'),
(10, 3, 'Ipoh White Coffe', '', 1, '', '2017-09-28 10:53:26'),
(11, 3, 'Teh Susu', '', 1, '', '2017-09-28 10:54:54'),
(12, 3, 'Cham', '', 1, '', '2017-09-28 10:55:06'),
(13, 3, 'Milo', '', 1, '', '2017-09-28 10:55:24'),
(14, 6, 'Plain Water', '', 1, '', '2017-10-19 00:36:21'),
(15, 6, 'Chinese Tea', '', 1, '', '2017-10-19 00:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `bev_price`
--

CREATE TABLE `bev_price` (
  `i_price_id` int(11) NOT NULL,
  `i_bev_id` int(11) NOT NULL,
  `i_menu_id` int(11) DEFAULT NULL,
  `va_bev_size` varchar(50) DEFAULT NULL,
  `d_bev_price` double DEFAULT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bev_price`
--

INSERT INTO `bev_price` (`i_price_id`, `i_bev_id`, `i_menu_id`, `va_bev_size`, `d_bev_price`, `dt_create`) VALUES
(1, 1, 1, '', 5, '2017-09-09 17:27:44'),
(2, 2, 1, '', 4, '2017-09-09 17:27:44'),
(3, 3, 1, '', 4, '2017-09-09 17:27:44'),
(4, 4, 1, '2', 2, '2017-09-09 17:27:44'),
(5, 5, 2, '', 3.8, '2017-09-12 23:49:15'),
(6, 6, 3, '', 2.5, '2017-09-28 10:46:48'),
(7, 7, 3, '', 3.5, '2017-09-28 10:52:38'),
(8, 8, 3, '', 3.5, '2017-09-28 10:52:51'),
(9, 9, 3, '', 3.5, '2017-09-28 10:53:09'),
(10, 10, 3, '', 3.5, '2017-09-28 10:53:26'),
(11, 11, 3, '', 3.5, '2017-09-28 10:54:54'),
(12, 12, 3, '', 3.5, '2017-09-28 10:55:06'),
(13, 13, 3, '', 3.9, '2017-09-28 10:55:24'),
(14, 14, 6, '', 0.5, '2017-10-19 00:36:21'),
(15, 15, 6, '', 0.8, '2017-10-19 00:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `bev_type`
--

CREATE TABLE `bev_type` (
  `i_bev_type_id` int(11) NOT NULL,
  `va_bev_type_name` varchar(300) NOT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `va_bev_type_pic_url` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `bev_type`
--

INSERT INTO `bev_type` (`i_bev_type_id`, `va_bev_type_name`, `dt_create`, `va_bev_type_pic_url`) VALUES
(1, 'Drink', '2017-09-09 17:29:20', 'drink.jpg'),
(2, 'Dessert', '2017-09-09 17:29:20', 'dessert.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `i_city_id` int(11) NOT NULL,
  `va_city_name` varchar(20) NOT NULL,
  `i_state_id` int(11) NOT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`i_city_id`, `va_city_name`, `i_state_id`, `dt_create`) VALUES
(1, 'Subang Jaya', 1, '2017-09-09 17:29:20'),
(2, 'Kelana Jaya', 1, '2017-09-09 17:29:20'),
(3, 'Damansara', 1, '2017-09-09 17:29:20'),
(4, 'Kuala Lumpur', 2, '2017-09-22 01:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `i_food_id` int(11) NOT NULL,
  `i_menu_id` int(11) NOT NULL,
  `va_food_name` varchar(100) NOT NULL,
  `va_food_desc` longtext NOT NULL,
  `i_food_type_id` int(11) DEFAULT NULL,
  `va_food_pic_url` varchar(500) DEFAULT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`i_food_id`, `i_menu_id`, `va_food_name`, `va_food_desc`, `i_food_type_id`, `va_food_pic_url`, `dt_create`) VALUES
(1, 1, 'SPA Chicken Cutlet', '', 1, 'chickencutlet.png', '2017-09-09 17:29:20'),
(2, 1, 'Spicy Chicken Boxing + Wing', '', 1, 'boxingwing.png', '2017-09-09 17:29:20'),
(3, 1, 'Signature Crispy Chicken Nugget', '', 1, 'crispychickennugget.png', '2017-09-09 17:29:20'),
(4, 1, 'QQ Deepsea Squid', '', 1, 'squid.png', '2017-09-09 17:29:20'),
(5, 1, 'Crispy Garlic - Flavored King Oyster Mushroom', '', 2, 'mushroom.png', '2017-09-09 17:29:20'),
(6, 1, 'Golden French Fries With TarTar Sauces', '', 1, 'fries.png', '2017-09-09 17:29:20'),
(7, 2, 'Bolognaise', 'A rich meaty tomato sauce, our base is made entirely from scratch, seasoned with Italian herbs, lots of juicy tomatoes, fresh veggies and meat.\r\n\r\nEvery bite is packed with a punch!\r\n\r\n*Available in Chicken & Beef', 1, 'bolognaise.png', '2017-09-09 17:29:20'),
(8, 2, 'Carbonara', 'Ranking No.1 on our Slurp-ablity scale, our Carbonara is made from 100% fresh Australian cream! We perfected this delicious sauce, irresistably creamy yet light enough so it leaves you wanting more!\r\n \r\n*Available in Chicken or Beef', 1, 'carbonara.png', '2017-09-09 17:29:20'),
(9, 2, 'Sausage Spinach Bacchamel		', 'Creamy and delicious, our Bacchamel sauce is the mother of all sauces! \n \nMeaty and it\'s even healthy with added greens - our Sausage Spinach Bacchamel is everything you want in a pasta!', 1, 'bechamel.png', '2017-09-09 17:29:20'),
(10, 2, 'Chicken Mushroom Mornay', 'A delectable, cheesy cream sauce infused with brown mushrooms & chicken ham. Light, tangy & incredibly satisfying - our Chicken Mushroom Mornay is a must try for all cheese and mushroom lovers!\r\n \r\nYou won\'t regret this one!', 1, 'mornay.png', '2017-09-09 17:29:20'),
(11, 2, 'Chicken Meatball', 'Home made chicken meatballs with creamy chicken mushroom cheese sauce on top a bed of mash potatoes.', 1, 'meatball.png', '2017-09-09 17:29:20'),
(12, 2, 'Chicken Confit', 'Cured & confit for at least 24 hours, this beautiful whole leg of chicken is sooo delicious & tender, we don\'t give you a knife! All this goodness is served on a bed of creamy mash potatoes.', 1, 'chickenconfit.png', '2017-09-09 17:29:20'),
(13, 2, 'Dory Fillet', 'Seasoned & cooked to perfection, this slice of dory fish is served on a bed of mash potato and drizzled with a delicious, irresistible zesty sauce.', 1, 'doryfillet.png', '2017-09-09 17:29:20'),
(14, 2, 'Mashed Potatoes', 'Deliciously mashed pototes with a brown sauce to die for!', 2, '', '2017-09-09 17:29:20'),
(15, 3, 'Asam Laksa', '', 1, 'asamlaksa.jpg', '2017-09-26 00:40:01'),
(16, 3, 'Asam Laksa + Fish', '', 1, 'asamlaksa.jpg', '2017-09-28 00:03:29'),
(17, 3, 'Curry Laksa', '', 1, 'currylaksa.jpg', '2017-09-28 00:35:51'),
(18, 3, 'Pan Mee', '', 1, 'panmee.jpg', '2017-09-28 00:39:27'),
(19, 3, 'Nasi Lemak Rendang', '', 1, 'nasilemak.jpg', '2017-09-28 00:56:33'),
(20, 3, 'Herbal Chicken Soup With Rice', '', 1, 'herbalchicken.jpg', '2017-09-28 00:56:57'),
(21, 3, 'Curry Chicken With Rice', '', 1, 'currychicken.jpg', '2017-09-28 00:57:12'),
(22, 5, 'Double Trouble', '2x sharp cheddar, 2x patty, x-sauce', 1, 'doubletrouble.jpg', '2017-10-06 17:56:58'),
(23, 8, 'New York Chicken', '', 1, 'newyorkchicken.jpg', '2017-10-18 23:38:46'),
(24, 4, 'Original Pretzel', '', 1, 'originalpretzel.jpg', '2017-10-18 23:54:30'),
(25, 4, 'Specialty Pretzel', '', 1, 'cinnamonsugar.jpg', '2017-10-18 23:54:48'),
(26, 6, 'Rice + L.F.C. Drumstick + Vege', '', 1, 'f1.jpg', '2017-10-19 00:06:06'),
(27, 6, 'Rice + L.F.C. Chicken Wing + Vege', '', 1, '', '2017-10-19 00:14:18'),
(28, 6, 'Rice + L.F.C. Drumstick + Egg + Vege', '', 1, 'f2.jpg', '2017-10-19 00:14:42'),
(29, 5, '123', '', 1, '', '2017-10-20 00:30:55'),
(30, 9, 'Dave\'s Deli 1/4 Roast Chicken', '', 1, 'quaterchickenset.jpg', '2017-10-20 00:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `food_price`
--

CREATE TABLE `food_price` (
  `i_price_id` int(11) NOT NULL,
  `i_food_id` int(11) NOT NULL,
  `i_menu_id` int(11) DEFAULT NULL,
  `va_food_size` varchar(50) DEFAULT NULL,
  `d_food_price` double DEFAULT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `food_price`
--

INSERT INTO `food_price` (`i_price_id`, `i_food_id`, `i_menu_id`, `va_food_size`, `d_food_price`, `dt_create`) VALUES
(1, 1, 1, '', 10, '2017-09-09 17:29:20'),
(2, 2, 1, '', 10, '2017-09-09 17:29:20'),
(3, 3, 1, 'S', 9, '2017-09-09 17:29:20'),
(4, 3, 1, 'L', 15, '2017-09-09 17:29:20'),
(5, 4, 1, 'S', 15, '2017-09-09 17:29:20'),
(6, 4, 1, 'L', 25, '2017-09-09 17:29:20'),
(7, 5, 1, '', 8, '2017-09-09 17:29:20'),
(8, 1, 1, 'L', 9, '2017-09-09 17:29:20'),
(9, 6, 1, '', 7, '2017-09-09 17:29:20'),
(10, 7, 2, '', 6, '2017-09-09 17:29:20'),
(11, 8, 2, '', 6, '2017-09-09 17:29:20'),
(12, 9, 2, '', 6, '2017-09-09 17:29:20'),
(13, 10, 2, '', 6, '2017-09-09 17:29:20'),
(14, 11, 2, '', 13.8, '2017-09-09 17:29:20'),
(15, 12, 2, '', 13.8, '2017-09-09 17:29:20'),
(16, 13, 2, '', 13.8, '2017-09-09 17:29:20'),
(17, 14, 2, '', 3.8, '2017-09-09 17:29:20'),
(18, 15, 3, 'Regular', 8.9, '2017-09-26 00:40:01'),
(19, 15, 3, 'Junior', 6.3, '2017-09-26 00:40:01'),
(20, 16, 3, 'Regular', 11.8, '2017-09-28 00:03:29'),
(21, 17, 3, 'Regular', 8.9, '2017-09-28 00:35:51'),
(22, 17, 3, 'Junior', 6.3, '2017-09-28 00:35:51'),
(23, 18, 3, 'Regular', 8.9, '2017-09-28 00:39:27'),
(24, 19, 3, 'Regular', 9.9, '2017-09-28 00:56:33'),
(25, 20, 3, 'Regular', 9.9, '2017-09-28 00:56:57'),
(26, 21, 3, 'Regular', 9.9, '2017-09-28 00:57:12'),
(27, 22, 5, '', 23.9, '2017-10-06 17:56:58'),
(28, 23, 8, 'Regular', 8.9, '2017-10-18 23:38:46'),
(29, 23, 8, 'Great', 9.9, '2017-10-18 23:38:46'),
(30, 24, 4, '', 3.2, '2017-10-18 23:54:30'),
(31, 25, 4, 'Cinnamon Sugar', 3.8, '2017-10-18 23:54:48'),
(32, 26, 6, '', 9.8, '2017-10-19 00:06:06'),
(33, 27, 6, '', 8, '2017-10-19 00:14:18'),
(34, 28, 6, '', 10, '2017-10-19 00:14:42'),
(35, 29, 5, '', 3.6, '2017-10-20 00:30:55'),
(36, 30, 9, '', 20.8, '2017-10-20 00:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `food_type`
--

CREATE TABLE `food_type` (
  `i_food_type_id` int(11) NOT NULL,
  `va_food_type_name` varchar(20) NOT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `va_food_type_pic_url` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_type`
--

INSERT INTO `food_type` (`i_food_type_id`, `va_food_type_name`, `dt_create`, `va_food_type_pic_url`) VALUES
(1, 'Main', '2017-09-09 17:29:20', 'main.jpg'),
(2, 'Side Dish', '2017-09-09 17:29:20', 'side.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `i_menu_id` int(11) NOT NULL,
  `i_res_id` int(11) NOT NULL,
  `va_menu_code` varchar(20) NOT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`i_menu_id`, `i_res_id`, `va_menu_code`, `dt_create`) VALUES
(1, 1, 'JGFCMY_M01', '2017-09-09 17:29:20'),
(2, 2, 'LFDDS1_M01', '2017-09-09 17:29:20'),
(3, 3, 'ACLKJ1_M01', '2017-09-19 18:03:29'),
(4, 6, 'AADS1_M01', '2017-09-21 00:31:21'),
(5, 9, 'BLSJ1_M01', '2017-09-21 00:31:21'),
(6, 12, 'LFCSJ1_M01', '2017-09-21 00:31:21'),
(7, 13, 'ILYDS1_M01', '2017-09-21 00:31:21'),
(8, 14, '1901HDSJ1_M01', '2017-10-06 01:36:33'),
(9, 17, 'DDDS1_M01', '2017-10-20 00:01:11');

-- --------------------------------------------------------

--
-- Table structure for table `qrcode`
--

CREATE TABLE `qrcode` (
  `i_qr_id` int(11) NOT NULL,
  `i_res_id` int(11) NOT NULL,
  `i_user_id` int(200) DEFAULT NULL,
  `i_qr_type_id` int(11) NOT NULL,
  `va_qr_data_1` longtext NOT NULL,
  `va_qr_data_2` longtext NOT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qrcode`
--

INSERT INTO `qrcode` (`i_qr_id`, `i_res_id`, `i_user_id`, `i_qr_type_id`, `va_qr_data_1`, `va_qr_data_2`, `dt_create`) VALUES
(1, 5, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"},{\"quantity\":1,\"size\":\"Junior\",\"price\":\"6.30\"}],\"id\":\"15\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa + Fish\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"11.80\"}],\"id\":\"16\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/currylaksa.jpg\",\"name\":\"Curry Laksa\",\"order\":[{\"quantity\":2,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"17\"}]},{\"menu_type\":\"Drink\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Mineral Water\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"2.50\"}],\"id\":\"6\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Homesoy\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"3.50\"}],\"id\":\"8\"}]}]', '', '2017-10-16 22:43:43'),
(2, 5, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"},{\"quantity\":1,\"size\":\"Junior\",\"price\":\"6.30\"}],\"id\":\"15\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa + Fish\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"11.80\"}],\"id\":\"16\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/currylaksa.jpg\",\"name\":\"Curry Laksa\",\"order\":[{\"quantity\":2,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"17\"}]},{\"menu_type\":\"Drink\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Mineral Water\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"2.50\"}],\"id\":\"6\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Homesoy\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"3.50\"}],\"id\":\"8\"}]}]', '', '2017-10-16 22:43:52'),
(3, 1, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/chickencutlet.png\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"10.00\"},{\"quantity\":1,\"size\":\"L\",\"price\":\"9.00\"}],\"id\":\"1\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/squid.png\",\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"15.00\"}],\"id\":\"4\"}]},{\"menu_type\":\"Side Dish\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/mushroom.png\",\"name\":\"Crispy Garlic - Flavored King Oyster Mushroom\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"8.00\"}],\"id\":\"5\"}]},{\"menu_type\":\"Drink\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/\",\"name\":\"Ice Fruit Tea\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"4.00\"}],\"id\":\"3\"}]}]', '', '2017-10-17 00:09:53'),
(4, 9, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/BLSJ1/doubletrouble.jpg\",\"name\":\"Double Trouble\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"23.90\"}],\"id\":\"22\"}]}]', '', '2017-10-17 00:14:00'),
(5, 5, 2, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Pan Mee\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/panmee.jpg\",\"id\":\"18\"}]}]', '', '2017-10-17 10:48:14'),
(6, 5, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":2,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"15\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/panmee.jpg\",\"name\":\"Pan Mee\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"18\"}]},{\"menu_type\":\"Drink\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Mineral Water\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"2.50\"}],\"id\":\"6\"}]}]', '', '2017-10-18 16:39:32'),
(7, 5, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"15\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/panmee.jpg\",\"name\":\"Pan Mee\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"18\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/currylaksa.jpg\",\"name\":\"Curry Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"17\"}]},{\"menu_type\":\"Drink\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Homesoy\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.50\"}],\"id\":\"8\"}]}]', '', '2017-10-18 16:55:35'),
(8, 4, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa + Fish\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"11.80\"}],\"id\":\"16\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/currylaksa.jpg\",\"name\":\"Curry Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"17\"}]},{\"menu_type\":\"Drink\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Longan\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.50\"}],\"id\":\"7\"}]}]', '', '2017-10-18 17:24:11'),
(9, 5, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa + Fish\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"11.80\"}],\"id\":\"16\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/currylaksa.jpg\",\"name\":\"Curry Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"17\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/herbalchicken.jpg\",\"name\":\"Herbal Chicken Soup With Rice\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"9.90\"}],\"id\":\"20\"}]}]', '', '2017-10-18 17:44:57'),
(10, 5, 1, 1, '[{\"menu_type\":\"Drink\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Longan\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.50\"}],\"id\":\"7\"}]}]', '', '2017-10-18 20:28:22'),
(11, 5, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa + Fish\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"11.80\"}],\"id\":\"16\"}]}]', '', '2017-10-18 21:43:20'),
(12, 5, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/panmee.jpg\",\"name\":\"Pan Mee\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"18\"}]}]', '', '2017-10-18 21:44:00'),
(13, 5, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa + Fish\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"11.80\"}],\"id\":\"16\"}]}]', '', '2017-10-18 21:49:17'),
(14, 5, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"15\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/currylaksa.jpg\",\"name\":\"Curry Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"17\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/panmee.jpg\",\"name\":\"Pan Mee\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"18\"}]},{\"menu_type\":\"Drink\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Homesoy\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.50\"}],\"id\":\"8\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Longan\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.50\"}],\"id\":\"7\"}]}]', '', '2017-10-18 21:56:16'),
(15, 5, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"},{\"quantity\":1,\"size\":\"Junior\",\"price\":\"6.30\"}],\"id\":\"15\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa + Fish\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"11.80\"}],\"id\":\"16\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/currylaksa.jpg\",\"name\":\"Curry Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"},{\"quantity\":1,\"size\":\"Junior\",\"price\":\"6.30\"}],\"id\":\"17\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/panmee.jpg\",\"name\":\"Pan Mee\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"18\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/nasilemak.jpg\",\"name\":\"Nasi Lemak Rendang\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"9.90\"}],\"id\":\"19\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/herbalchicken.jpg\",\"name\":\"Herbal Chicken Soup With Rice\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"9.90\"}],\"id\":\"20\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/currychicken.jpg\",\"name\":\"Curry Chicken With Rice\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"9.90\"}],\"id\":\"21\"}]},{\"menu_type\":\"Drink\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Mineral Water\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"2.50\"}],\"id\":\"6\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Longan\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.50\"}],\"id\":\"7\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Homesoy\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.50\"}],\"id\":\"8\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Lemon Tea\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.50\"}],\"id\":\"9\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Ipoh White Coffe\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.50\"}],\"id\":\"10\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Teh Susu\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.50\"}],\"id\":\"11\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Cham\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.50\"}],\"id\":\"12\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"name\":\"Milo\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.90\"}],\"id\":\"13\"}]}]', '', '2017-10-18 22:16:41'),
(16, 14, 2, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"New York Chicken\",\"order\":[{\"quantity\":1,\"size\":\"Great\",\"price\":\"9.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/1901HDSJ1/newyorkchicken.jpg\",\"id\":\"23\"}]}]', '', '2017-10-19 00:16:00'),
(17, 4, 14, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"id\":\"15\"}]}]', '', '2017-10-19 22:06:19'),
(18, 4, 14, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"id\":\"15\"}]}]', '', '2017-10-19 22:06:25'),
(19, 4, 14, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"id\":\"15\"},{\"name\":\"Pan Mee\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/panmee.jpg\",\"id\":\"18\"}]}]', '', '2017-10-19 22:07:08'),
(20, 4, 14, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"id\":\"15\"},{\"name\":\"Pan Mee\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/panmee.jpg\",\"id\":\"18\"}]}]', '', '2017-10-19 22:07:17'),
(21, 4, 14, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"id\":\"15\"},{\"name\":\"Pan Mee\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/panmee.jpg\",\"id\":\"18\"}]}]', '', '2017-10-19 22:07:23'),
(22, 1, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/chickencutlet.png\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10.00\"}],\"id\":\"1\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/squid.png\",\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"15.00\"}],\"id\":\"4\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/crispychickennugget.png\",\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"9.00\"}],\"id\":\"3\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/fries.png\",\"name\":\"Golden French Fries With TarTar Sauces\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"7.00\"}],\"id\":\"6\"}]}]', '', '2017-10-19 22:41:40'),
(23, 12, 2, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Rice + L.F.C. Drumstick + Vege\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"9.80\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFCSJ1/f1.jpg\",\"id\":\"26\"},{\"name\":\"Rice + L.F.C. Drumstick + Egg + Vege\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10.00\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFCSJ1/f2.jpg\",\"id\":\"28\"}]},{\"menu_type\":\"Drink\",\"menu\":[{\"name\":\"Plain Water\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"0.50\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFCSJ1/\",\"id\":\"14\"},{\"name\":\"Chinese Tea\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"0.80\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFCSJ1/\",\"id\":\"15\"}]}]', '', '2017-10-21 09:29:30'),
(24, 5, 2, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Asam Laksa + Fish\",\"order\":[{\"quantity\":10,\"size\":\"Regular\",\"price\":\"11.80\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"id\":\"16\"},{\"name\":\"Curry Laksa\",\"order\":[{\"quantity\":15,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/currylaksa.jpg\",\"id\":\"17\"}]}]', '', '2017-10-21 10:22:21'),
(25, 5, 2, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"id\":\"15\"}]}]', '', '2017-10-21 10:22:40'),
(26, 5, 2, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Pan Mee\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/panmee.jpg\",\"id\":\"18\"},{\"name\":\"Curry Chicken With Rice\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"9.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/currychicken.jpg\",\"id\":\"21\"},{\"name\":\"Nasi Lemak Rendang\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"9.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/nasilemak.jpg\",\"id\":\"19\"}]},{\"menu_type\":\"Drink\",\"menu\":[{\"name\":\"Longan\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.50\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/\",\"id\":\"7\"}]}]', '', '2017-10-21 10:24:46'),
(27, 5, 2, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Curry Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/currylaksa.jpg\",\"id\":\"17\"},{\"name\":\"Pan Mee\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/panmee.jpg\",\"id\":\"18\"}]}]', '', '2017-10-21 10:25:51'),
(28, 1, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/boxingwing.png\",\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10.00\"}],\"id\":\"2\"}]},{\"menu_type\":\"Side Dish\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/mushroom.png\",\"name\":\"Crispy Garlic - Flavored King Oyster Mushroom\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"8.00\"}],\"id\":\"5\"}]},{\"menu_type\":\"Drink\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/\",\"name\":\"Fresh Brewed Cold Tea\",\"order\":[{\"quantity\":1,\"size\":\"2\",\"price\":\"2.00\"}],\"id\":\"4\"}]}]', '', '2017-10-22 15:41:11'),
(29, 11, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFDDS1/mornay.png\",\"name\":\"Chicken Mushroom Mornay\",\"order\":[{\"quantity\":5,\"size\":\"\",\"price\":\"6.00\"}],\"id\":\"10\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFDDS1/meatball.png\",\"name\":\"Chicken Meatball\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"13.80\"}],\"id\":\"11\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFDDS1/doryfillet.png\",\"name\":\"Dory Fillet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"13.80\"}],\"id\":\"13\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFDDS1/chickenconfit.png\",\"name\":\"Chicken Confit\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"13.80\"}],\"id\":\"12\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFDDS1/bechamel.png\",\"name\":\"Sausage Spinach Bchamel\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"6.00\"}],\"id\":\"9\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFDDS1/carbonara.png\",\"name\":\"Carbonara\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"6.00\"}],\"id\":\"8\"}]},{\"menu_type\":\"Side Dish\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFDDS1/\",\"name\":\"Mashed Potatoes\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.80\"}],\"id\":\"14\"}]},{\"menu_type\":\"Dessert\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFDDS1/\",\"name\":\"Pudding\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"3.80\"}],\"id\":\"5\"}]}]', '', '2017-10-22 16:01:48'),
(30, 14, 2, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"New York Chicken\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/1901HDSJ1/newyorkchicken.jpg\",\"id\":\"23\"}]}]', '', '2017-10-22 20:16:01'),
(31, 8, 14, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Specialty Pretzel\",\"order\":[{\"quantity\":1,\"size\":\"Cinnamon Sugar\",\"price\":\"3.80\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/AADS1/cinnamonsugar.jpg\",\"id\":\"25\"}]}]', '', '2017-10-24 15:52:20'),
(32, 4, 1, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"id\":\"15\"}]}]', '', '2017-10-24 19:40:22'),
(33, 5, 11, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Asam Laksa\",\"order\":[{\"quantity\":1,\"size\":\"Regular\",\"price\":\"8.90\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/ACLKJ1/asamlaksa.jpg\",\"id\":\"15\"}]}]', '', '2017-10-24 21:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `qrcode_type`
--

CREATE TABLE `qrcode_type` (
  `i_qr_type_id` int(11) NOT NULL,
  `va_qr_type_name` varchar(200) NOT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qrcode_type`
--

INSERT INTO `qrcode_type` (`i_qr_type_id`, `va_qr_type_name`, `dt_create`) VALUES
(1, 'order', '2017-09-09 17:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `i_res_id` int(11) NOT NULL,
  `i_hq_id` int(11) NOT NULL,
  `va_res_name` varchar(100) NOT NULL,
  `va_res_code` varchar(20) NOT NULL,
  `va_res_add1` mediumtext NOT NULL,
  `va_res_add2` mediumtext NOT NULL,
  `d_lat` double NOT NULL,
  `d_long` double NOT NULL,
  `i_area_id` int(11) DEFAULT NULL,
  `i_city_id` int(11) NOT NULL,
  `i_state_id` int(11) NOT NULL,
  `i_res_stat` int(11) NOT NULL DEFAULT '1',
  `va_res_logo` varchar(500) DEFAULT NULL,
  `va_res_desc` longtext NOT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `i_feature` int(11) DEFAULT '99',
  `i_res_ad` int(10) NOT NULL DEFAULT '0',
  `va_feature_ad` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`i_res_id`, `i_hq_id`, `va_res_name`, `va_res_code`, `va_res_add1`, `va_res_add2`, `d_lat`, `d_long`, `i_area_id`, `i_city_id`, `i_state_id`, `i_res_stat`, `va_res_logo`, `va_res_desc`, `dt_create`, `i_feature`, `i_res_ad`, `va_feature_ad`) VALUES
(1, 1, 'J&G Fried Chicken', 'JGFCMY', '', '', 3.1267927, 101.7250182, 1, 1, 1, 1, 'http://103.233.1.196/dimchoi/file/res/JGFCMY/logo.png', '', '2017-06-27 00:20:14', 1, 0, 'null'),
(2, 2, 'Little Fat Duck', 'LFDDS1', '', '', 0, 0, 5, 3, 1, 1, 'http://103.233.1.196/dimchoi/file/res/LFDDS1/logo.JPG', '', '2017-08-27 16:39:25', 1, 1, 'http://103.233.1.196/dimchoi/file/res/LFDDS1/ad.jpg'),
(3, 3, 'Ah Cheng Laksa', 'ACLKJ1', '', '', 0, 0, 6, 2, 1, 1, 'http://103.233.1.196/dimchoi/file/res/ACLKJ1/logo.jpg', '', '2017-09-19 18:03:29', 1, 0, 'null'),
(4, 3, 'Ah Cheng Laksa', 'ACLKJ2', '', '', 12, 21, 4, 2, 1, 1, 'http://103.233.1.196/dimchoi/file/res/ACLKJ1/logo.jpg', '', '2017-09-20 00:20:10', 1, 0, 'null'),
(5, 3, 'Ah Cheng Laksa', 'ACLSJ1', '', '', 0, 0, 1, 1, 1, 1, 'http://103.233.1.196/dimchoi/file/res/ACLKJ1/logo.jpg', '', '2017-09-20 00:21:58', 1, 0, 'null'),
(6, 6, 'Auntie Anne\'s', 'AADS1', '', '', 0, 0, 5, 3, 1, 1, 'http://103.233.1.196/dimchoi/file/res/AADS1/logo.jpg', '', '2017-09-21 00:31:21', 1, 0, 'null'),
(7, 6, 'Auntie Anne\'s', 'AAKJ1', '', '', 0, 0, 3, 2, 1, 1, 'http://103.233.1.196/dimchoi/file/res/AADS1/logo.jpg', '', '2017-09-21 00:31:21', 1, 0, 'null'),
(8, 6, 'Auntie Anne\'s', 'AASJ1', '', '', 0, 0, 1, 1, 1, 1, 'http://103.233.1.196/dimchoi/file/res/AADS1/logo.jpg', '', '2017-09-21 00:31:21', 1, 1, 'http://103.233.1.196/dimchoi/file/res/AADS1/ad.jpg'),
(9, 9, 'Burger Lab', 'BLSJ1', '', '', 0, 0, 1, 1, 1, 1, 'http://103.233.1.196/dimchoi/file/res/BLSJ1/logo.jpg', '', '2017-09-21 00:31:21', 1, 1, 'http://103.233.1.196/dimchoi/file/res/BLSJ1/ad.jpg'),
(10, 9, 'Burger Lab', 'BLKJ1', '', '', 0, 0, 7, 2, 1, 1, 'http://103.233.1.196/dimchoi/file/res/BLSJ1/logo.jpg', '', '2017-09-21 00:31:21', 1, 0, 'null'),
(11, 2, 'Little Fat Duck', 'LFDKJ1', '', '', 0, 0, 4, 2, 1, 1, 'http://103.233.1.196/dimchoi/file/res/LFDDS1/logo.JPG', '', '2017-08-27 16:39:25', 1, 0, NULL),
(12, 12, 'Lim Fried Chicken', 'LFCSJ1', '', '', 0, 0, 2, 1, 1, 1, 'http://103.233.1.196/dimchoi/file/res/LFCSJ1/logo.jpg', '', '2017-08-27 16:39:25', 1, 0, 'null'),
(13, 13, 'I Love Yoo! 老油鬼鬼', 'ILYDS1', '', '', 0, 0, 5, 3, 1, 1, 'http://103.233.1.196/dimchoi/file/res/ILYDS1/logo.jpg', '', '2017-08-27 16:39:25', 1, 0, 'null'),
(14, 14, '1901 Hot Dogs', '1901HDSJ1', '', '', 0, 0, 1, 1, 1, 1, 'http://103.233.1.196/dimchoi/file/res/1901HDSJ1/logo.jpg', '', '2017-10-06 01:36:33', 1, 0, 'null'),
(17, 17, 'Dave\'s Deli', 'DDDS1', '', '', 0, 0, 5, 3, 1, 1, 'http://103.233.1.196/dimchoi/file/res/DDDS1/logo.jpg', '', '2017-10-20 00:01:11', 1, 0, 'null');

-- --------------------------------------------------------

--
-- Table structure for table `resuser`
--

CREATE TABLE `resuser` (
  `i_res_id` int(11) NOT NULL,
  `va_username` varchar(100) NOT NULL,
  `va_password` varchar(1000) NOT NULL,
  `i_status` int(11) NOT NULL DEFAULT '1',
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resuser`
--

INSERT INTO `resuser` (`i_res_id`, `va_username`, `va_password`, `i_status`, `dt_create`) VALUES
(1, 'JNGFC', 'test123', 1, '2017-10-26 22:23:36');

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
('dev', '{\"dev\":\"2\"}');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `i_state_id` int(11) NOT NULL,
  `va_state_name` varchar(20) NOT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`i_state_id`, `va_state_name`, `dt_create`) VALUES
(1, 'Selangor', '2017-09-09 17:30:11'),
(2, 'Wilayah Persekutuan', '2017-09-09 17:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `i_user_id` int(11) NOT NULL,
  `va_first_name` varchar(3000) NOT NULL,
  `va_last_name` varchar(3000) NOT NULL,
  `va_gender` varchar(10) NOT NULL,
  `va_country_code` varchar(10) NOT NULL,
  `va_phone_code` varchar(20) NOT NULL,
  `va_phone` varchar(3000) NOT NULL,
  `dt_dob` date DEFAULT NULL,
  `va_email` varchar(3000) NOT NULL,
  `va_pass` varchar(3000) NOT NULL,
  `va_facebook` varchar(3000) NOT NULL,
  `va_google` varchar(3000) NOT NULL,
  `i_status` int(11) NOT NULL DEFAULT '1',
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`i_user_id`, `va_first_name`, `va_last_name`, `va_gender`, `va_country_code`, `va_phone_code`, `va_phone`, `dt_dob`, `va_email`, `va_pass`, `va_facebook`, `va_google`, `i_status`, `dt_create`) VALUES
(1, 'Yin Kiet', 'Cheok', 'Male', '1', '', '+60126065223', '0000-00-00', 'y_kcheok@hotmail.com', '1234', '10154937613678997', '', 1, '2017-09-16 15:50:50'),
(2, 'Max', 'Leong', 'Male', '2', '', '', '0000-00-00', 'maxisthemax89@gmail.com', '123', '10155767872673624', '', 1, '2017-09-22 14:29:48'),
(3, '', 'n', '', '', '', '', '0000-00-00', '', '11', '', '', 1, '2017-09-22 23:40:27'),
(4, 'Cheok', 'Yin', '', '', '', '', '1987-03-12', 'y.k.cheok@gmail', '1234', '', '104884438423381586668', 1, '2017-10-02 22:31:22'),
(5, 'che', '222', '', '', '', '2', '0000-00-00', '2', '2', '2', '2', 1, '2017-10-02 22:42:59'),
(6, 'Cheok', 'Yin', '', '', '', '', '1987-03-12', 'y.k.cheok@gmail.co', '12354332', '', '104884438423381586668', 1, '2017-10-02 22:50:10'),
(7, 'Cheok', 'Yin', '', '', '', '', '1987-03-12', 'y.k.cheok@gm', 'chre4f', '', '104884438423381586668', 1, '2017-10-02 22:56:00'),
(8, 'xxxx', 'xxxx', '', 'x', 'x', 'x', '0000-00-00', 'xxx@xx.com', '', '', '', 1, '2017-10-02 23:35:25'),
(9, '万', '进', '', '', '', '', '1987-03-12', 'wanjinyoong@live.com.my', 'test', '1678211805524288', '', 1, '2017-10-04 00:14:53'),
(10, 'KahLun', 'Soo', '', '', '', '', '1987-03-12', 'klsoo_23@hotmail.com', 'ahga0615', '10154763891182274', '', 1, '2017-10-06 13:41:47'),
(11, 'Teng', 'Yi', '', '', '', '', '1987-03-12', 'tengjingyi_1989@yahoo.com', '890801tjydimchoi', '10207776995262497', '', 1, '2017-10-10 21:27:48'),
(12, 'Cheok', 'Yin', '', '', '', '', '1987-03-12', 'y.k.cheok@', '19873', '', '104884438423381586668', 1, '2017-10-14 14:51:44'),
(13, 'User', 'CHEOK', '', '', '', '', '1987-03-12', 'testttttt', 'hhgft67hgy', '', '', 1, '2017-10-14 16:11:14'),
(14, 'Xin', 'Thai', '', '', '', '', '1987-03-12', 'lxt777@msn.com', 'asdfgh1', '10155162154253380', '', 1, '2017-10-19 22:06:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`i_area_id`),
  ADD KEY `i_city_id` (`i_city_id`);

--
-- Indexes for table `bev`
--
ALTER TABLE `bev`
  ADD PRIMARY KEY (`i_bev_id`),
  ADD KEY `i_menu_id` (`i_menu_id`),
  ADD KEY `i_bev_type_id` (`i_bev_type_id`);

--
-- Indexes for table `bev_price`
--
ALTER TABLE `bev_price`
  ADD PRIMARY KEY (`i_price_id`);

--
-- Indexes for table `bev_type`
--
ALTER TABLE `bev_type`
  ADD PRIMARY KEY (`i_bev_type_id`),
  ADD KEY `i_bev_type_id` (`i_bev_type_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`i_city_id`),
  ADD KEY `i_state_id` (`i_state_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`i_food_id`),
  ADD KEY `i_menu_id` (`i_menu_id`),
  ADD KEY `i_food_type` (`i_food_type_id`);

--
-- Indexes for table `food_price`
--
ALTER TABLE `food_price`
  ADD PRIMARY KEY (`i_price_id`);

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
-- Indexes for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD PRIMARY KEY (`i_qr_id`),
  ADD KEY `i_qr_type_id` (`i_qr_type_id`),
  ADD KEY `i_res_id` (`i_res_id`);

--
-- Indexes for table `qrcode_type`
--
ALTER TABLE `qrcode_type`
  ADD PRIMARY KEY (`i_qr_type_id`),
  ADD KEY `i_qr_type_id` (`i_qr_type_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`i_res_id`),
  ADD UNIQUE KEY `va_res_code` (`va_res_code`),
  ADD KEY `i_res_id` (`i_res_id`),
  ADD KEY `i_city_id` (`i_city_id`),
  ADD KEY `i_state_id` (`i_state_id`),
  ADD KEY `i_area_id` (`i_area_id`);

--
-- Indexes for table `resuser`
--
ALTER TABLE `resuser`
  ADD PRIMARY KEY (`i_res_id`),
  ADD UNIQUE KEY `va_user_name` (`va_username`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`i_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `i_area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `bev`
--
ALTER TABLE `bev`
  MODIFY `i_bev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `bev_price`
--
ALTER TABLE `bev_price`
  MODIFY `i_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `bev_type`
--
ALTER TABLE `bev_type`
  MODIFY `i_bev_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `i_city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `i_food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `food_price`
--
ALTER TABLE `food_price`
  MODIFY `i_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `food_type`
--
ALTER TABLE `food_type`
  MODIFY `i_food_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `i_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `qrcode`
--
ALTER TABLE `qrcode`
  MODIFY `i_qr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `qrcode_type`
--
ALTER TABLE `qrcode_type`
  MODIFY `i_qr_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `i_res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `i_state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `i_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `area_ibfk_1` FOREIGN KEY (`i_city_id`) REFERENCES `city` (`i_city_id`);

--
-- Constraints for table `bev`
--
ALTER TABLE `bev`
  ADD CONSTRAINT `bev_ibfk_1` FOREIGN KEY (`i_menu_id`) REFERENCES `menu` (`i_menu_id`),
  ADD CONSTRAINT `bev_ibfk_2` FOREIGN KEY (`i_bev_type_id`) REFERENCES `bev_type` (`i_bev_type_id`);

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`i_state_id`) REFERENCES `state` (`i_state_id`);

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
-- Constraints for table `qrcode`
--
ALTER TABLE `qrcode`
  ADD CONSTRAINT `qrcode_ibfk_1` FOREIGN KEY (`i_qr_type_id`) REFERENCES `qrcode_type` (`i_qr_type_id`);

--
-- Constraints for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`i_state_id`) REFERENCES `state` (`i_state_id`),
  ADD CONSTRAINT `restaurant_ibfk_2` FOREIGN KEY (`i_city_id`) REFERENCES `city` (`i_city_id`),
  ADD CONSTRAINT `restaurant_ibfk_3` FOREIGN KEY (`i_area_id`) REFERENCES `area` (`i_area_id`);

--
-- Constraints for table `resuser`
--
ALTER TABLE `resuser`
  ADD CONSTRAINT `resuser_ibfk_1` FOREIGN KEY (`i_res_id`) REFERENCES `restaurant` (`i_res_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
