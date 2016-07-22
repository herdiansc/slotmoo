-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 28, 2013 at 12:15 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `billboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created`) VALUES
(1, 'Pakaian', 'pakaian', NULL),
(2, 'Otomotif', 'otomotif', NULL),
(3, 'Elektronik', 'elektronik', NULL),
(4, 'Gadget', 'gadget', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `image_listings`
--

CREATE TABLE IF NOT EXISTS `image_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  `listing_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `image_listings`
--

INSERT INTO `image_listings` (`id`, `filename`, `is_default`, `listing_id`) VALUES
(1, 'aafcc6603f66747201c2fb09cba634b47733c14e_1.jpg', 1, 17),
(2, '29a2a3d4b98951e7e013d6481d3ad894678c8feb_1.jpg', 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE IF NOT EXISTS `listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `user_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`id`, `title`, `description`, `user_id`, `price`, `category_id`, `slug`, `created`) VALUES
(17, 'Jual Baju Baru', 'Jual Baju Baru', 1, 23000, 1, 'Jual_Baju_Baru', '2013-06-28 06:28:59'),
(18, 'Baju Batik Modern dengan Harga Murah', '- Baju ini sangat bagus dipakai buat ngantor.<br />\r\n- Terbuat dari bahan yang enak dipakai.<br />\r\n- Warna tidak gampang luntur.<br />\r\n<br />\r\nUntuk pemesanan silahkan hubungi nomor telepon yang tercantum di bawah ini:<br />\r\n<br />\r\nTelp: 089999728374<br />\r\nYM: herdiansc<br />\r\n', 1, 56000, 1, 'Baju_Batik_Modern_dengan_Harga_Murah', '2013-06-28 07:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `password_token` varchar(128) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT '0',
  `email_token` varchar(255) DEFAULT NULL,
  `email_token_expires` datetime DEFAULT NULL,
  `tos` tinyint(1) DEFAULT '0',
  `active` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_action` datetime DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `role` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `fbid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `BY_USERNAME` (`username`),
  KEY `BY_EMAIL` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `slug`, `password`, `password_token`, `email`, `email_verified`, `email_token`, `email_token_expires`, `tos`, `active`, `last_login`, `last_action`, `is_admin`, `role`, `created`, `modified`, `fbid`) VALUES
(1, 'Herdian', 'herdian', '2e881ce7aa630631c2b6ec6b7735a7f3f8f7c5d6', NULL, 'herdiansc@gmail.com', 1, NULL, NULL, 1, 1, '2013-06-28 09:53:27', NULL, 0, 'registered', '2013-06-28 04:28:28', '2013-06-28 09:53:27', 1466636228);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` varchar(36) NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `position` float NOT NULL DEFAULT '1',
  `field` varchar(255) NOT NULL,
  `value` text,
  `input` varchar(16) NOT NULL,
  `data_type` varchar(16) NOT NULL,
  `label` varchar(128) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_PROFILE_PROPERTY` (`field`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

