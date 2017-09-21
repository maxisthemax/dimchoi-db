-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2017 at 02:39 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(5, 2, 'Pudding', 'Entirely home-made, our puddings are incredibly light, refreshing & delicious! It\'s a sweet sweet end any good meal.', 2, '', '2017-09-12 23:49:15');

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
(5, 5, 2, '', 3.8, '2017-09-12 23:49:15');

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
(3, 'Damansara', 1, '2017-09-09 17:29:20');

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
(9, 2, 'Sausage Spinach BÃ©chamel		', 'Creamy and delicious, our BÃ©chamel sauce is the mother of all sauces! \r\n \r\nMeaty and it\'s even healthy with added greens - our Sausage Spinach BÃ©chamel is everything you want in a pasta!', 1, 'bechamel.png', '2017-09-09 17:29:20'),
(10, 2, 'Chicken Mushroom Mornay', 'A delectable, cheesy cream sauce infused with brown mushrooms & chicken ham. Light, tangy & incredibly satisfying - our Chicken Mushroom Mornay is a must try for all cheese and mushroom lovers!\r\n \r\nYou won\'t regret this one!', 1, 'mornay.png', '2017-09-09 17:29:20'),
(11, 2, 'Chicken Meatball', 'Home made chicken meatballs with creamy chicken mushroom cheese sauce on top a bed of mash potatoes.', 1, 'meatball.png', '2017-09-09 17:29:20'),
(12, 2, 'Chicken Confit', 'Cured & confit for at least 24 hours, this beautiful whole leg of chicken is sooo delicious & tender, we don\'t give you a knife! All this goodness is served on a bed of creamy mash potatoes.', 1, 'chickenconfit.png', '2017-09-09 17:29:20'),
(13, 2, 'Dory Fillet', 'Seasoned & cooked to perfection, this slice of dory fish is served on a bed of mash potato and drizzled with a delicious, irresistible zesty sauce.', 1, 'doryfillet.png', '2017-09-09 17:29:20'),
(14, 2, 'Mashed Potatoes', 'Deliciously mashed pototes with a brown sauce to die for!', 2, '', '2017-09-09 17:29:20');

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
(17, 14, 2, '', 3.8, '2017-09-09 17:29:20');

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
(2, 2, 'LFDMY_M01', '2017-09-09 17:29:20'),
(3, 3, 'ACLKJ1_M01', '2017-09-19 18:03:29'),
(4, 4, 'ACLKJ2_M01', '2017-09-20 00:20:10'),
(5, 5, 'ACLSJ1_M01', '2017-09-20 00:21:58'),
(6, 6, 'AADS1_M01', '2017-09-21 00:31:21');

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
(1, 1, NULL, 1, '[  \r\n   {  \r\n      \"menu_type\":\"main\",\r\n      \"food_menu\":[  \r\n         {  \r\n            \"food_id\":\"1\",\r\n            \"food_name\":\"test\",\r\n            \"food_pic_url\":\"\",\r\n            \"order\":[  \r\n               {  \r\n                  \"size\":\"M\",\r\n                  \"price\":\"8.00\",\r\n                  \"quantity\":\"5\"\r\n               }\r\n            ]\r\n         },\r\n         {  \r\n            \"food_id\":\"2\",\r\n            \"food_name\":\"test\",\r\n            \"food_pic_url\":\"\",\r\n            \"order\":[  \r\n               {  \r\n                  \"size\":\"\",\r\n                  \"price\":\"6.00\",\r\n                  \"quantity\":\"1\"\r\n               }\r\n            ]\r\n         }\r\n      ]\r\n   },\r\n   {  \r\n      \"menu_type\":\"side_dish\",\r\n      \"food_menu\":[  \r\n         {  \r\n            \"food_id\":\"3\",\r\n            \"food_name\":\"test\",\r\n            \"food_pic_url\":\"\",\r\n            \"order\":[  \r\n               {  \r\n                  \"size\":\"M\",\r\n                  \"price\":\"8.00\",\r\n                  \"quantity\":\"5\"\r\n               },\r\n               {  \r\n                  \"size\":\"L\",\r\n                  \"price\":\"12.00\",\r\n                  \"quantity\":\"1\"\r\n               }\r\n            ]\r\n         }\r\n      ]\r\n   }\r\n]', '', '2017-09-02 15:08:37'),
(2, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:06:47'),
(3, 1, NULL, 1, 'hhhy', '', '2017-09-03 15:18:15'),
(4, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:27:01'),
(5, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:40:24'),
(6, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:42:00'),
(7, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:42:05'),
(8, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:42:31'),
(9, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:42:41'),
(10, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:42:42'),
(11, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:42:42'),
(12, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:42:43'),
(13, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:42:44'),
(14, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:42:44'),
(15, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:42:44'),
(16, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:43:32'),
(17, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:46:36'),
(18, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:48:02'),
(19, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:48:05'),
(20, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:48:08'),
(21, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 15:49:55'),
(22, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 16:13:58'),
(23, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 16:13:58'),
(24, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 16:16:37'),
(25, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 16:20:04'),
(26, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 16:25:07'),
(27, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 16:26:35'),
(28, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 16:39:25'),
(29, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 16:47:37'),
(30, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 16:51:02'),
(31, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 16:51:49'),
(32, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '', '2017-09-03 19:05:06'),
(33, 1, NULL, 1, '[ { \"menu_type\":\"main\", \"food_menu\":[ { \"food_id\":\"1\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" } ] }, { \"food_id\":\"2\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"\", \"price\":\"6.00\", \"quantity\":\"1\" } ] } ] }, { \"menu_type\":\"side_dish\", \"food_menu\":[ { \"food_id\":\"3\", \"food_name\":\"test\", \"food_pic_url\":\"\", \"order\":[ { \"size\":\"M\", \"price\":\"8.00\", \"quantity\":\"5\" }, { \"size\":\"L\", \"price\":\"12.00\", \"quantity\":\"1\" } ] } ] } ]', '12312312312', '2017-09-03 22:07:49'),
(34, 1, NULL, 1, '[{\"food_menu\":[{\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"12\"}],\"image_url\":\"https://3.bp.blogspot.com/-ygzOnGmSwWo/VG0F1ShE5eI/AAAAAAAARBQ/IsEUEbdNW3A/s1600/IMG_1611.JPG\",\"id\":\"1\"},{\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"image_url\":\"null\",\"id\":\"2\"},{\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":1,\"size\":\"Small\",\"price\":\"9\"}],\"image_url\":\"http://www.mydailysales.com/wp-content/uploads/2016/06/20166171640134084662.jpg\",\"id\":\"3\"}],\"menu_type\":\"main\"},{\"food_menu\":[{\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"15\"}],\"image_url\":\"https://img.grouponcdn.com/deal/YDqoAtxW7wkWhBegQ3Q6mTSXq91/t620x376/YD-1000x600.jpg\",\"id\":\"5\"}],\"menu_type\":\"side dish\"}]', '[{\"beverage_menu\":[{\"name\":\"Honey Lemon Juice\",\"order\":[{\"quantity\":1,\"size\":\"L\",\"price\":\"5\"}],\"image_url\":\"\",\"id\":\"1\"},{\"name\":\"Ice Plum Drink\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"4\"}],\"image_url\":\"\",\"id\":\"5\"},{\"name\":\"Ice Fruit Tea\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"4\"}],\"image_url\":\"\",\"id\":\"6\"},{\"name\":\"Fresh Brewed Cold Tea\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"4\"}],\"image_url\":\"\",\"id\":\"7\"}],\"menu_type\":\"DRINK\"}]', '2017-09-03 22:32:06'),
(35, 1, NULL, 1, '', '', '2017-09-03 22:49:39'),
(36, 1, NULL, 1, '[{\"food_menu\":[{\"image_url\":\"https://3.bp.blogspot.com/-ygzOnGmSwWo/VG0F1ShE5eI/AAAAAAAARBQ/IsEUEbdNW3A/s1600/IMG_1611.JPG\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"12\"}],\"id\":\"1\"},{\"image_url\":\"null\",\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"id\":\"2\"},{\"image_url\":\"http://www.mydailysales.com/wp-content/uploads/2016/06/20166171640134084662.jpg\",\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":1,\"size\":\"Small\",\"price\":\"9\"}],\"id\":\"3\"}],\"menu_type\":\"main\"},{\"food_menu\":[{\"image_url\":\"null\",\"name\":\"Crispy Garlic - Flavored King Oyster Mushroom\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"8\"}],\"id\":\"7\"},{\"image_url\":\"null\",\"name\":\"Golden French Fries With TarTar Sauces\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"7\"}],\"id\":\"8\"},{\"image_url\":\"https://img.grouponcdn.com/deal/YDqoAtxW7wkWhBegQ3Q6mTSXq91/t620x376/YD-1000x600.jpg\",\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"15\"}],\"id\":\"5\"}],\"menu_type\":\"side dish\"}]', '[{\"beverage_menu\":[{\"image_url\":\"\",\"name\":\"Ice Plum Drink\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"4\"}],\"id\":\"5\"},{\"image_url\":\"\",\"name\":\"Ice Fruit Tea\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"4\"}],\"id\":\"6\"},{\"image_url\":\"\",\"name\":\"Fresh Brewed Cold Tea\",\"order\":[{\"quantity\":6,\"size\":\"\",\"price\":\"4\"}],\"id\":\"7\"},{\"image_url\":\"\",\"name\":\"Honey Lemon Juice\",\"order\":[{\"quantity\":1,\"size\":\"L\",\"price\":\"5\"}],\"id\":\"1\"}],\"menu_type\":\"DRINK\"}]', '2017-09-04 01:46:31'),
(37, 1, NULL, 1, '[{\"food_menu\":[{\"image_url\":\"https://3.bp.blogspot.com/-ygzOnGmSwWo/VG0F1ShE5eI/AAAAAAAARBQ/IsEUEbdNW3A/s1600/IMG_1611.JPG\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"12\"}],\"id\":\"1\"},{\"image_url\":\"null\",\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"id\":\"2\"},{\"image_url\":\"http://www.mydailysales.com/wp-content/uploads/2016/06/20166171640134084662.jpg\",\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":1,\"size\":\"Small\",\"price\":\"9\"},{\"quantity\":1,\"size\":\"Large\",\"price\":\"15\"}],\"id\":\"3\"}],\"menu_type\":\"main\"},{\"food_menu\":[{\"image_url\":\"null\",\"name\":\"Golden French Fries With TarTar Sauces\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"7\"}],\"id\":\"8\"},{\"image_url\":\"null\",\"name\":\"Crispy Garlic - Flavored King Oyster Mushroom\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"8\"}],\"id\":\"7\"},{\"image_url\":\"https://img.grouponcdn.com/deal/YDqoAtxW7wkWhBegQ3Q6mTSXq91/t620x376/YD-1000x600.jpg\",\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"15\"},{\"quantity\":1,\"size\":\"L\",\"price\":\"25\"}],\"id\":\"5\"}],\"menu_type\":\"side dish\"}]', '[]', '2017-09-04 01:54:56'),
(38, 1, NULL, 1, '[{\"food_menu\":[{\"image_url\":\"https://3.bp.blogspot.com/-ygzOnGmSwWo/VG0F1ShE5eI/AAAAAAAARBQ/IsEUEbdNW3A/s1600/IMG_1611.JPG\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"12\"}],\"id\":\"1\"},{\"image_url\":\"null\",\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"id\":\"2\"},{\"image_url\":\"http://www.mydailysales.com/wp-content/uploads/2016/06/20166171640134084662.jpg\",\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":1,\"size\":\"Small\",\"price\":\"9\"},{\"quantity\":1,\"size\":\"Large\",\"price\":\"15\"}],\"id\":\"3\"}],\"menu_type\":\"main\"},{\"food_menu\":[{\"image_url\":\"null\",\"name\":\"Golden French Fries With TarTar Sauces\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"7\"}],\"id\":\"8\"},{\"image_url\":\"null\",\"name\":\"Crispy Garlic - Flavored King Oyster Mushroom\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"8\"}],\"id\":\"7\"},{\"image_url\":\"https://img.grouponcdn.com/deal/YDqoAtxW7wkWhBegQ3Q6mTSXq91/t620x376/YD-1000x600.jpg\",\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"15\"},{\"quantity\":1,\"size\":\"L\",\"price\":\"25\"}],\"id\":\"5\"}],\"menu_type\":\"side dish\"}]', '[]', '2017-09-04 01:56:21'),
(39, 1, NULL, 1, '[{\"food_menu\":[{\"image_url\":\"https://3.bp.blogspot.com/-ygzOnGmSwWo/VG0F1ShE5eI/AAAAAAAARBQ/IsEUEbdNW3A/s1600/IMG_1611.JPG\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"12\"}],\"id\":\"1\"},{\"image_url\":\"null\",\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"id\":\"2\"},{\"image_url\":\"http://www.mydailysales.com/wp-content/uploads/2016/06/20166171640134084662.jpg\",\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":1,\"size\":\"Small\",\"price\":\"9\"},{\"quantity\":3,\"size\":\"Large\",\"price\":\"15\"}],\"id\":\"3\"}],\"menu_type\":\"main\"},{\"food_menu\":[{\"image_url\":\"https://img.grouponcdn.com/deal/YDqoAtxW7wkWhBegQ3Q6mTSXq91/t620x376/YD-1000x600.jpg\",\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"15\"},{\"quantity\":1,\"size\":\"L\",\"price\":\"25\"}],\"id\":\"5\"},{\"image_url\":\"null\",\"name\":\"Crispy Garlic - Flavored King Oyster Mushroom\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"8\"}],\"id\":\"7\"},{\"image_url\":\"null\",\"name\":\"Golden French Fries With TarTar Sauces\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"7\"}],\"id\":\"8\"}],\"menu_type\":\"side dish\"}]', '[]', '2017-09-04 22:54:01'),
(40, 1, NULL, 1, '[{\"food_menu\":[{\"image_url\":\"https://3.bp.blogspot.com/-ygzOnGmSwWo/VG0F1ShE5eI/AAAAAAAARBQ/IsEUEbdNW3A/s1600/IMG_1611.JPG\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"12\"}],\"id\":\"1\"},{\"image_url\":\"null\",\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"id\":\"2\"},{\"image_url\":\"http://www.mydailysales.com/wp-content/uploads/2016/06/20166171640134084662.jpg\",\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":1,\"size\":\"Small\",\"price\":\"9\"},{\"quantity\":3,\"size\":\"Large\",\"price\":\"15\"}],\"id\":\"3\"}],\"menu_type\":\"main\"},{\"food_menu\":[{\"image_url\":\"https://img.grouponcdn.com/deal/YDqoAtxW7wkWhBegQ3Q6mTSXq91/t620x376/YD-1000x600.jpg\",\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"15\"},{\"quantity\":1,\"size\":\"L\",\"price\":\"25\"}],\"id\":\"5\"},{\"image_url\":\"null\",\"name\":\"Crispy Garlic - Flavored King Oyster Mushroom\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"8\"}],\"id\":\"7\"},{\"image_url\":\"null\",\"name\":\"Golden French Fries With TarTar Sauces\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"7\"}],\"id\":\"8\"}],\"menu_type\":\"side dish\"}]', '[]', '2017-09-04 22:54:16'),
(41, 1, NULL, 1, '[{\"food_menu\":[{\"image_url\":\"http://www.mydailysales.com/wp-content/uploads/2016/06/20166171640134084662.jpg\",\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":1,\"size\":\"Small\",\"price\":\"9\"},{\"quantity\":1,\"size\":\"Large\",\"price\":\"15\"}],\"id\":\"3\"},{\"image_url\":\"https://3.bp.blogspot.com/-ygzOnGmSwWo/VG0F1ShE5eI/AAAAAAAARBQ/IsEUEbdNW3A/s1600/IMG_1611.JPG\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"12\"}],\"id\":\"1\"},{\"image_url\":\"null\",\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"id\":\"2\"}],\"menu_type\":\"main\"},{\"food_menu\":[{\"image_url\":\"null\",\"name\":\"Golden French Fries With TarTar Sauces\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"7\"}],\"id\":\"8\"},{\"image_url\":\"null\",\"name\":\"Crispy Garlic - Flavored King Oyster Mushroom\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"8\"}],\"id\":\"7\"},{\"image_url\":\"https://img.grouponcdn.com/deal/YDqoAtxW7wkWhBegQ3Q6mTSXq91/t620x376/YD-1000x600.jpg\",\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"15\"}],\"id\":\"5\"}],\"menu_type\":\"side dish\"}]', '[{\"beverage_menu\":[{\"image_url\":\"\",\"name\":\"Honey Lemon Juice\",\"order\":[{\"quantity\":1,\"size\":\"L\",\"price\":\"5\"}],\"id\":\"1\"},{\"image_url\":\"\",\"name\":\"Ice Plum Drink\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"4\"}],\"id\":\"5\"},{\"image_url\":\"\",\"name\":\"Ice Fruit Tea\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"4\"}],\"id\":\"6\"},{\"image_url\":\"\",\"name\":\"Fresh Brewed Cold Tea\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"4\"}],\"id\":\"7\"}],\"menu_type\":\"DRINK\"}]', '2017-09-04 23:11:01'),
(42, 1, NULL, 1, '[{\"food_menu\":[{\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"12\"}],\"image_url\":\"https://3.bp.blogspot.com/-ygzOnGmSwWo/VG0F1ShE5eI/AAAAAAAARBQ/IsEUEbdNW3A/s1600/IMG_1611.JPG\",\"id\":\"1\"},{\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"image_url\":\"null\",\"id\":\"2\"},{\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":1,\"size\":\"Small\",\"price\":\"9\"},{\"quantity\":1,\"size\":\"Large\",\"price\":\"15\"}],\"image_url\":\"http://www.mydailysales.com/wp-content/uploads/2016/06/20166171640134084662.jpg\",\"id\":\"3\"}],\"menu_type\":\"main\"},{\"food_menu\":[{\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"15\"}],\"image_url\":\"https://img.grouponcdn.com/deal/YDqoAtxW7wkWhBegQ3Q6mTSXq91/t620x376/YD-1000x600.jpg\",\"id\":\"5\"}],\"menu_type\":\"side dish\"}]', '[]', '2017-09-05 00:48:01'),
(43, 2, NULL, 1, '', '', '2017-09-06 20:56:31'),
(44, 1, NULL, 1, '[{\"food_menu\":[{\"image_url\":\"\",\"name\":\"Crispy Garlic - Flavored King Oyster Mushroom\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"8\"}],\"id\":\"5\"}],\"menu_type\":\"Side Dish\"}]', '[]', '2017-09-06 21:39:56'),
(45, 2, NULL, 1, '', '', '2017-09-06 22:31:53'),
(46, 1, NULL, 1, '[{\"food_menu\":[{\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"10\"}],\"image_url\":\"https://b.zmtcdn.com/data/menus/655/18192655/90aac50a26baf4e23865d1d2e900fbfe.jpg\",\"id\":\"1\"},{\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"15\"}],\"image_url\":\"\",\"id\":\"4\"}],\"menu_type\":\"Main\"}]', '[{\"beverage_menu\":[{\"name\":\"Ice Fruit Tea\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"4\"}],\"image_url\":\"\",\"id\":\"3\"}],\"menu_type\":\"Drink\"}]', '2017-09-07 21:10:56'),
(47, 2, NULL, 1, '', '', '2017-09-09 19:27:57'),
(48, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"image_url\":\"https://b.zmtcdn.com/data/menus/655/18192655/90aac50a26baf4e23865d1d2e900fbfe.jpg\",\"id\":\"1\"}]}]', '', '2017-09-10 16:54:04'),
(49, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"image_url\":\"https://b.zmtcdn.com/data/menus/655/18192655/90aac50a26baf4e23865d1d2e900fbfe.jpg\",\"id\":\"1\"}]}]', '', '2017-09-10 16:54:43'),
(50, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"image_url\":\"https://b.zmtcdn.com/data/menus/655/18192655/90aac50a26baf4e23865d1d2e900fbfe.jpg\",\"id\":\"1\"},{\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"9\"}],\"image_url\":\"\",\"id\":\"3\"}]}]', '', '2017-09-10 16:54:52'),
(51, 2, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"https://static.wixstatic.com/media/6931b6_f0976cb1da2d41d9af41a6e8b89ef3ad.png/v1/fill/w_222,h_148,al_c,usm_0.66_1.00_0.01/6931b6_f0976cb1da2d41d9af41a6e8b89ef3ad.png\",\"name\":\"Carbonara\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"6\"}],\"id\":\"8\"},{\"image_url\":\"https://static.wixstatic.com/media/6931b6_fed8f42733ab43c8a81cf6e8d86b2630~mv2.png/v1/fill/w_179,h_118,al_c,usm_0.66_1.00_0.01/6931b6_fed8f42733ab43c8a81cf6e8d86b2630~mv2.png\",\"name\":\"Bolognaise\",\"order\":[{\"quantity\":3,\"size\":\"\",\"price\":\"6\"}],\"id\":\"7\"},{\"image_url\":\"https://static.wixstatic.com/media/6931b6_5445b89bbcd14db29e30a0fd69793e1a.png/v1/fill/w_189,h_123,al_c,usm_0.66_1.00_0.01/6931b6_5445b89bbcd14db29e30a0fd69793e1a.png\",\"name\":\"Chicken Mushroom Mornay\",\"order\":[{\"quantity\":3,\"size\":\"\",\"price\":\"6\"}],\"id\":\"10\"},{\"image_url\":\"https://static.wixstatic.com/media/f4c7f4_ac7049e2442c45ada8bfcf16faab6d1d~mv2_d_5260_2960_s_4_2.png/v1/fill/w_237,h_131,al_c,usm_0.66_1.00_0.01/f4c7f4_ac7049e2442c45ada8bfcf16faab6d1d~mv2_d_5260_2960_s_4_2.png\",\"name\":\"Chicken Meatball\",\"order\":[{\"quantity\":3,\"size\":\"\",\"price\":\"13.8\"}],\"id\":\"11\"}]},{\"menu_type\":\"Side Dish\",\"menu\":[{\"image_url\":\"\",\"name\":\"Mashed Potatoes\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"3.8\"}],\"id\":\"14\"}]}]', '', '2017-09-10 16:56:11'),
(52, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"image_url\":\"https://b.zmtcdn.com/data/menus/655/18192655/90aac50a26baf4e23865d1d2e900fbfe.jpg\",\"id\":\"1\"}]}]', '', '2017-09-10 18:49:33'),
(53, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"image_url\":\"https://b.zmtcdn.com/data/menus/655/18192655/90aac50a26baf4e23865d1d2e900fbfe.jpg\",\"id\":\"1\"}]}]', '', '2017-09-10 18:50:57'),
(54, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"image_url\":\"https://b.zmtcdn.com/data/menus/655/18192655/90aac50a26baf4e23865d1d2e900fbfe.jpg\",\"id\":\"1\"}]}]', '', '2017-09-10 18:54:20'),
(55, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"\",\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"id\":\"2\"}]}]', '', '2017-09-10 18:55:57'),
(56, 2, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"https://static.wixstatic.com/media/6931b6_fed8f42733ab43c8a81cf6e8d86b2630~mv2.png/v1/fill/w_179,h_118,al_c,usm_0.66_1.00_0.01/6931b6_fed8f42733ab43c8a81cf6e8d86b2630~mv2.png\",\"name\":\"Bolognaise\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"6\"}],\"id\":\"7\"},{\"image_url\":\"https://static.wixstatic.com/media/6931b6_8762920b31d140c781374cf534de062c.png/v1/fill/w_198,h_119,al_c,usm_0.66_1.00_0.01/6931b6_8762920b31d140c781374cf534de062c.png\",\"name\":\"Sausage Spinach BÃ©chamel		\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"6\"}],\"id\":\"9\"},{\"image_url\":\"https://static.wixstatic.com/media/6931b6_f0976cb1da2d41d9af41a6e8b89ef3ad.png/v1/fill/w_222,h_148,al_c,usm_0.66_1.00_0.01/6931b6_f0976cb1da2d41d9af41a6e8b89ef3ad.png\",\"name\":\"Carbonara\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"6\"}],\"id\":\"8\"}]}]', '', '2017-09-10 21:32:34'),
(57, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"image_url\":\"https://b.zmtcdn.com/data/menus/655/18192655/90aac50a26baf4e23865d1d2e900fbfe.jpg\",\"id\":\"1\"}]}]', '', '2017-09-10 22:33:43'),
(58, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"image_url\":\"https://b.zmtcdn.com/data/menus/655/18192655/90aac50a26baf4e23865d1d2e900fbfe.jpg\",\"id\":\"1\"},{\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10\"}],\"image_url\":\"\",\"id\":\"2\"},{\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"9\"}],\"image_url\":\"\",\"id\":\"3\"},{\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":1,\"size\":\"S\",\"price\":\"15\"}],\"image_url\":\"\",\"id\":\"4\"}]}]', '', '2017-09-10 22:33:59'),
(59, 2, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"https://static.wixstatic.com/media/f4c7f4_7859e8e01bbe4601b936c26ea60e99c1~mv2.png/v1/crop/x_2,y_0,w_448,h_285/fill/w_223,h_140,al_c,usm_0.66_1.00_0.01/f4c7f4_7859e8e01bbe4601b936c26ea60e99c1~mv2.png\",\"name\":\"Dory Fillet\",\"order\":[{\"quantity\":10,\"size\":\"\",\"price\":\"13.80\"}],\"id\":\"13\"}]}]', '', '2017-09-11 12:40:17'),
(60, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/boxingwing.png\",\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10.00\"}],\"id\":\"2\"}]}]', '', '2017-09-12 00:35:07'),
(61, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/boxingwing.png\",\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":6,\"size\":\"\",\"price\":\"10.00\"}],\"id\":\"2\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/squid.png\",\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":2,\"size\":\"S\",\"price\":\"15.00\"}],\"id\":\"4\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/crispychickennugget.png\",\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":3,\"size\":\"L\",\"price\":\"15.00\"}],\"id\":\"3\"}]}]', '', '2017-09-12 02:00:24'),
(62, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/boxingwing.png\",\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"10.00\"}],\"id\":\"2\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/chickencutlet.png\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10.00\"}],\"id\":\"1\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/squid.png\",\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":2,\"size\":\"S\",\"price\":\"15.00\"}],\"id\":\"4\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/crispychickennugget.png\",\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":4,\"size\":\"S\",\"price\":\"9.00\"}],\"id\":\"3\"}]}]', '', '2017-09-12 07:52:22'),
(63, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/chickencutlet.png\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"10.00\"}],\"id\":\"1\"}]}]', '', '2017-09-14 13:55:16'),
(64, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/chickencutlet.png\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"10.00\"},{\"quantity\":1,\"size\":\"L\",\"price\":\"9.00\"}],\"id\":\"1\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/crispychickennugget.png\",\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":3,\"size\":\"S\",\"price\":\"9.00\"}],\"id\":\"3\"}]},{\"menu_type\":\"Side Dish\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/mushroom.png\",\"name\":\"Crispy Garlic - Flavored King Oyster Mushroom\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"8.00\"}],\"id\":\"5\"}]}]', '', '2017-09-14 23:03:27'),
(65, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"Spicy Chicken Boxing + Wing\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10.00\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/boxingwing.png\",\"id\":\"2\"}]}]', '', '2017-09-15 14:21:13'),
(66, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":1,\"size\":\"\",\"price\":\"10.00\"}],\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/chickencutlet.png\",\"id\":\"1\"}]}]', '', '2017-09-15 14:23:17'),
(67, 2, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFDMY/meatball.png\",\"name\":\"Chicken Meatball\",\"order\":[{\"quantity\":3,\"size\":\"\",\"price\":\"13.80\"}],\"id\":\"11\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFDMY/bechamel.png\",\"name\":\"Sausage Spinach BÃ©chamel		\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"6.00\"}],\"id\":\"9\"}]}]', '', '2017-09-17 18:18:27'),
(68, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/chickencutlet.png\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":3,\"size\":\"\",\"price\":\"10.00\"}],\"id\":\"1\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/crispychickennugget.png\",\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":3,\"size\":\"S\",\"price\":\"9.00\"}],\"id\":\"3\"}]}]', '', '2017-09-18 21:41:43'),
(69, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/chickencutlet.png\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":3,\"size\":\"\",\"price\":\"10.00\"}],\"id\":\"1\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/crispychickennugget.png\",\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":2,\"size\":\"S\",\"price\":\"9.00\"}],\"id\":\"3\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/squid.png\",\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":3,\"size\":\"S\",\"price\":\"15.00\"}],\"id\":\"4\"}]}]', '', '2017-09-18 22:44:11'),
(70, 2, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/LFDMY/bolognaise.png\",\"name\":\"Bolognaise\",\"order\":[{\"quantity\":2,\"size\":\"\",\"price\":\"6.00\"}],\"id\":\"7\"}]}]', '', '2017-09-19 00:12:07'),
(71, 1, NULL, 1, '[{\"menu_type\":\"Main\",\"menu\":[{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/chickencutlet.png\",\"name\":\"SPA Chicken Cutlet\",\"order\":[{\"quantity\":3,\"size\":\"\",\"price\":\"10.00\"}],\"id\":\"1\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/squid.png\",\"name\":\"QQ Deepsea Squid\",\"order\":[{\"quantity\":2,\"size\":\"S\",\"price\":\"15.00\"}],\"id\":\"4\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/fries.png\",\"name\":\"Golden French Fries With TarTar Sauces\",\"order\":[{\"quantity\":3,\"size\":\"\",\"price\":\"7.00\"}],\"id\":\"6\"},{\"image_url\":\"http://103.233.1.196/dimchoi/file/res/JGFCMY/crispychickennugget.png\",\"name\":\"Signature Crispy Chicken Nugget\",\"order\":[{\"quantity\":3,\"size\":\"S\",\"price\":\"9.00\"}],\"id\":\"3\"}]}]', '', '2017-09-19 15:12:07');

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
  `va_res_name` varchar(100) NOT NULL,
  `va_res_code` varchar(20) NOT NULL,
  `va_res_add1` mediumtext NOT NULL,
  `va_res_add2` mediumtext NOT NULL,
  `va_area` varchar(500) NOT NULL,
  `d_lat` double NOT NULL,
  `d_long` double NOT NULL,
  `i_city_id` int(11) NOT NULL,
  `i_state_id` int(11) NOT NULL,
  `i_res_stat` int(11) NOT NULL DEFAULT '1',
  `va_res_logo` varchar(500) DEFAULT NULL,
  `va_res_desc` longtext NOT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `i_feature` int(11) DEFAULT '99',
  `va_feature_ad` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`i_res_id`, `va_res_name`, `va_res_code`, `va_res_add1`, `va_res_add2`, `va_area`, `d_lat`, `d_long`, `i_city_id`, `i_state_id`, `i_res_stat`, `va_res_logo`, `va_res_desc`, `dt_create`, `i_feature`, `va_feature_ad`) VALUES
(1, 'J&G Fried Chicken', 'JGFCMY', '', '', '', 3.1267927, 101.7250182, 2, 1, 1, 'http://103.233.1.196/dimchoi/file/res/JGFCMY/logo.png', 'Founded in 1973, Taiwan\'s No. 1 fried chicken, which comes with a strong seal of approval by CNN; focuses on the healthy aspects of making fried chicken by only using skinless fresh breast meat (never frozen), fried with fresh oil daily, in an exclusively made fryer that ensures healthy and clean fried chicken are churned out.', '2017-06-27 00:20:14', 1, 'null'),
(2, 'Little Fat Duck', 'LFDMY', '', '', '', 0, 0, 1, 1, 1, 'http://103.233.1.196/dimchoi/file/res/LFDMY/Logo.JPG', '', '2017-08-27 16:39:25', 1, 'null'),
(3, 'Ah Cheng Laksa', 'ACLKJ1', '', '', 'Tropicana City Mall', 0, 0, 2, 1, 1, 'http://103.233.1.196/dimchoi/file/res/ACLSJ1/logo.jpg', '', '2017-09-19 18:03:29', 1, 'null'),
(4, 'Ah Cheng Laksa', 'ACLKJ2', '', '', 'Jaya Shopping Centre', 12, 21, 1, 1, 1, 'http://103.233.1.196/dimchoi/file/res/ACLSJ1/logo.jpg', '', '2017-09-20 00:20:10', 1, 'null'),
(5, 'Ah Cheng Laksa', 'ACLSJ1', '', '', 'Sunway Pyramid', 0, 0, 2, 1, 1, 'http://103.233.1.196/dimchoi/file/res/ACLSJ1/logo.jpg', '', '2017-09-20 00:21:58', 1, 'null'),
(6, 'Auntie Anne\'s', 'AADS1', '', '', '', 0, 0, 3, 1, 1, '', '', '2017-09-21 00:31:21', 99, 'null');

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
-- Table structure for table `state_city`
--

CREATE TABLE `state_city` (
  `id` int(11) NOT NULL,
  `i_state_id` int(11) NOT NULL,
  `i_city_id` int(11) NOT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state_city`
--

INSERT INTO `state_city` (`id`, `i_state_id`, `i_city_id`, `dt_create`) VALUES
(1, 1, 1, '2017-09-09 17:30:11'),
(2, 1, 2, '2017-09-09 17:30:11'),
(3, 1, 3, '2017-09-09 17:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `i_user_id` int(11) NOT NULL,
  `va_first_name` varchar(3000) NOT NULL,
  `va_last_name` varchar(3000) NOT NULL,
  `va_gender` varchar(10) NOT NULL,
  `va_phone` varchar(3000) NOT NULL,
  `dt_dob` date NOT NULL,
  `va_email` varchar(3000) NOT NULL,
  `va_pass` varchar(3000) NOT NULL,
  `va_facebook` varchar(3000) NOT NULL,
  `va_google` varchar(3000) NOT NULL,
  `dt_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`i_user_id`, `va_first_name`, `va_last_name`, `va_gender`, `va_phone`, `dt_dob`, `va_email`, `va_pass`, `va_facebook`, `va_google`, `dt_create`) VALUES
(1, 'Alfred', 'Cheok', 'Female', '016-9999999', '1980-09-05', 'alfredcheok@gmail.com', '123', 'alfredcheok', 'alfredcheok', '2017-09-16 15:50:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`i_area_id`);

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
  ADD PRIMARY KEY (`i_city_id`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`i_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bev`
--
ALTER TABLE `bev`
  MODIFY `i_bev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bev_price`
--
ALTER TABLE `bev_price`
  MODIFY `i_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bev_type`
--
ALTER TABLE `bev_type`
  MODIFY `i_bev_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `i_city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `i_food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `food_price`
--
ALTER TABLE `food_price`
  MODIFY `i_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `food_type`
--
ALTER TABLE `food_type`
  MODIFY `i_food_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `i_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `qrcode`
--
ALTER TABLE `qrcode`
  MODIFY `i_qr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `qrcode_type`
--
ALTER TABLE `qrcode_type`
  MODIFY `i_qr_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `i_res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `i_state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `state_city`
--
ALTER TABLE `state_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `i_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bev`
--
ALTER TABLE `bev`
  ADD CONSTRAINT `bev_ibfk_1` FOREIGN KEY (`i_menu_id`) REFERENCES `menu` (`i_menu_id`),
  ADD CONSTRAINT `bev_ibfk_2` FOREIGN KEY (`i_bev_type_id`) REFERENCES `bev_type` (`i_bev_type_id`);

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
  ADD CONSTRAINT `qrcode_ibfk_1` FOREIGN KEY (`i_qr_type_id`) REFERENCES `qrcode_type` (`i_qr_type_id`),
  ADD CONSTRAINT `qrcode_ibfk_2` FOREIGN KEY (`i_res_id`) REFERENCES `restaurant` (`i_res_id`);

--
-- Constraints for table `state_city`
--
ALTER TABLE `state_city`
  ADD CONSTRAINT `state_city_ibfk_1` FOREIGN KEY (`i_city_id`) REFERENCES `city` (`i_city_id`),
  ADD CONSTRAINT `state_city_ibfk_2` FOREIGN KEY (`i_state_id`) REFERENCES `state` (`i_state_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
