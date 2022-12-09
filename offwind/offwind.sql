-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2022 at 12:17 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `offwind`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(12, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_album`
--

DROP TABLE IF EXISTS `tbl_album`;
CREATE TABLE IF NOT EXISTS `tbl_album` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `group_id` int UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_album`
--

INSERT INTO `tbl_album` (`id`, `title`, `description`, `price`, `image_name`, `group_id`, `featured`, `active`) VALUES
(10, 'Blue;s', '8th Mini Album', '13.50', '9_album_8621.jpg', 9, 'Yes', 'Yes'),
(12, 'Red Moon', '9th Mini Album', '14.50', '9_album_840.jpg', 9, 'Yes', 'Yes'),
(13, 'Yellow Flower', '5th Mini Album', '13.50', '9_album_964.jpg', 9, 'Yes', 'Yes'),
(14, 'White Wind', '9th Mini Album', '13.50', '9_album_511.jpg', 9, 'Yes', 'Yes'),
(15, 'WAW', '11th Mini Album', '20.00', '9_album_414.jpg', 9, 'Yes', 'Yes'),
(16, 'Reality in Black', '2nd Full Album', '22.50', '9_album_532.png', 9, 'Yes', 'Yes'),
(17, 'Rookie', '4th Mini Album', '13.50', '10_album_897.jpg', 10, 'Yes', 'Yes'),
(18, 'Perfect Velvet', '2nd Album', '22.50', '10_album_943.jpg', 10, 'No', 'Yes'),
(19, 'Signal', '4th Mini Album', '15.50', '12_album_832.jpg', 12, 'Yes', 'Yes'),
(20, 'I Love', '5th Mini Album', '22.50', '11_album_742.jpg', 11, 'Yes', 'Yes'),
(21, 'Staydom', '2nd Single Album', '19.50', '13_album_13.jpg', 13, 'Yes', 'Yes'),
(22, 'Guess Who', '4th Mini Album', '14.50', '14_album_189.jpg', 14, 'Yes', 'Yes'),
(23, 'Mic On', '12th Mini Album', '20.50', '9_album_42.jpg', 9, 'Yes', 'Yes'),
(24, 'Forever 1', '7th Album', '19.50', '16_album_14.jpg', 16, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

DROP TABLE IF EXISTS `tbl_group`;
CREATE TABLE IF NOT EXISTS `tbl_group` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(9, 'Mamamoo', 'Mamamoo_490.jpg', 'Yes', 'Yes'),
(10, 'Red Velvet', 'Red Velvet_448.jpg', 'Yes', 'Yes'),
(11, '(G)Idle', '(G)Idle_236.jpg', 'Yes', 'Yes'),
(12, 'Twice', 'Twice_686.jpg', 'Yes', 'Yes'),
(13, 'StayC', 'StayC_419.jpg', 'Yes', 'Yes'),
(14, 'Itzy', 'Itzy_177.jpg', 'Yes', 'Yes'),
(16, 'SNSD', 'SNSD_659.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `album` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `album`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(4, 'Mic On', '11.50', 3, '34.50', '2022-12-08 00:00:00', 'Delivered', 'test', '01234253', 'example@example.com', '14343dc'),
(5, 'WAW', '20.00', 1, '20.00', '2022-12-09 00:00:00', 'Ordered', 'Test', '012 231 123', 'example@example.com', 'No Address'),
(6, 'WAW', '20.00', 2, '40.00', '2022-12-09 00:00:00', 'Delivered', 'Test', '0123456789', 'example@example.com', 'house # 123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
