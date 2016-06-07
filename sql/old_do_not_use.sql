-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2015 at 09:07 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `1phpbeginnercrudlevel2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'Sports', 'Products you use for sports.', '2015-08-02 23:56:46', '2015-08-03 05:59:36'),
(2, 'Personal', 'Products for you personal needs.', '2015-08-02 23:56:46', '2015-08-03 05:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `category_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `created`, `modified`) VALUES
(1, 'Basketball', 'A ball used in the NBA.', 49.99, 1, '2015-08-02 12:04:03', '2015-08-02 15:57:13'),
(3, 'Gatorade', 'This is a very good drink for athletes.', 1.99, 1, '2015-08-02 12:14:29', '2015-08-02 15:57:13'),
(4, 'Eye Glasses', 'It will make you read better.', 6, 1, '2015-08-02 12:15:04', '2015-08-02 15:57:13'),
(5, 'Trash Can', 'It will help you maintain cleanliness.', 3.95, 1, '2015-08-02 12:16:08', '2015-08-02 15:57:13'),
(6, 'Mouse', 'Very useful if you love your computer.', 11.35, 2, '2015-08-02 12:17:58', '2015-08-02 15:57:38'),
(7, 'Earphone', 'You need this one if you love music.', 9, 2, '2015-08-02 12:18:21', '2015-08-03 06:40:41'),
(8, 'Pillow', 'Sleeping well is important.', 8.99, 2, '2015-08-02 12:18:56', '2015-08-02 15:57:38'),
(13, 'Cellphone Stand', 'Very useful if you are a developer.', 5.55, 2, '2015-08-03 08:00:16', '2015-08-03 06:00:42');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
