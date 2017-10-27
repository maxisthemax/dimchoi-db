-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2017 at 05:06 PM
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
-- Indexes for dumped tables
--

--
-- Indexes for table `resuser`
--
ALTER TABLE `resuser`
  ADD PRIMARY KEY (`i_res_id`),
  ADD UNIQUE KEY `va_user_name` (`va_username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `resuser`
--
ALTER TABLE `resuser`
  ADD CONSTRAINT `resuser_ibfk_1` FOREIGN KEY (`i_res_id`) REFERENCES `restaurant` (`i_res_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
