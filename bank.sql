-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 03, 2020 at 04:43 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  `secured_password` char(32) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `password`, `secured_password`) VALUES
(1, 'A_AIRAT', 'rolayo', 'c91e8a3ab7e9d2e1c88df79222354855'),
(2, 'Y_ADEDOLAPO', 'adedolapo', '4b3a9ae46ee8f890c9162d42e88d836a'),
(3, 'A_ROLAKE', 'rolake', 'f858e81f2d8d92f0fd31cfcefc05068d');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `date_of_birth` char(10) NOT NULL,
  `sex` varchar(7) NOT NULL,
  `account_type` varchar(15) NOT NULL,
  `opening_balance` float(10,2) NOT NULL,
  `account_balance` float(10,2) NOT NULL,
  `account_number` varchar(10) NOT NULL,
  `password` char(32) NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `firstName`, `lastName`, `address`, `date_of_birth`, `sex`, `account_type`, `opening_balance`, `account_balance`, `account_number`, `password`, `admin_id`) VALUES
(1, 'Fortune', 'Okon', 'berger', '2018-06-07', 'M', 'savings', 100000.00, 115000.00, '1008388607', 'forte', 1),
(2, 'Daniel', 'John', 'Oshodi apapa', '2014-04-05', 'M', 'savings', 5000.00, 10000.00, '1008388608', 'clemnt', 1),
(3, 'mercy', 'danmadammi', 'barnawa, kaduna', '1993-03-04', 'F', 'fixed', 1000000.00, 1020000.00, '1008388609', 'medanma123', 1),
(4, 'Grace', 'Andrews', 'Banana Island', '1993-06-07', 'F', 'savings', 5000000.00, 5000000.00, '1008388610', 'Ganders', 1),
(5, 'Mary ', 'Okon', 'Constitution Road.', '1987-06-07', 'F', 'current', 60000000.00, 59960000.00, '1008388611', 'Mary123', 1),
(6, 'femi', 'awolesi', 'praGUE', '1999-02-05', 'M', 'savings', 100000.00, 100000.00, '1410065408', 'femi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_date` datetime NOT NULL,
  `transaction_type` varchar(10) NOT NULL,
  `sender_name` varchar(40) NOT NULL,
  `recipient_name` varchar(40) NOT NULL,
  `transaction_amount` float(10,2) NOT NULL,
  `previous_balance` float(10,2) NOT NULL,
  `new_balance` float(10,2) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_date`, `transaction_type`, `sender_name`, `recipient_name`, `transaction_amount`, `previous_balance`, `new_balance`, `customer_id`) VALUES
(1, '2018-06-12 10:00:59', 'debit', 'self', 'Daniel John', 1000.00, 100000.00, 99000.00, 1),
(2, '2018-06-12 10:00:59', 'credit', '', 'self', 1000.00, 5000.00, 6000.00, 2),
(3, '2018-06-12 10:50:15', 'debit', 'self', 'Daniel John', 1000.00, 99000.00, 98000.00, 1),
(4, '2018-06-12 10:50:15', 'credit', '', 'self', 1000.00, 6000.00, 7000.00, 2),
(5, '2018-06-12 10:51:33', 'debit', 'self', 'Daniel John', 1000.00, 98000.00, 97000.00, 1),
(6, '2018-06-12 10:51:33', 'credit', '', 'self', 1000.00, 7000.00, 8000.00, 2),
(7, '2018-06-12 11:00:58', 'debit', 'self', 'Fortune Okon', 20000.00, 60000000.00, 59980000.00, 5),
(8, '2018-06-12 11:00:58', 'credit', '', 'self', 20000.00, 97000.00, 117000.00, 1),
(9, '2018-06-12 11:36:05', 'debit', 'Fortune Okon', 'Daniel John', 1000.00, 117000.00, 116000.00, 1),
(10, '2018-06-12 11:36:05', 'credit', '', 'Daniel John', 1000.00, 8000.00, 9000.00, 2),
(11, '2018-06-12 11:40:38', 'debit', 'Fortune Okon', 'Daniel John', 1000.00, 116000.00, 115000.00, 1),
(12, '2018-06-12 11:40:38', 'credit', 'Fortune Okon', 'Daniel John', 1000.00, 9000.00, 10000.00, 2),
(13, '2018-06-12 12:10:33', 'debit', 'Daniel John', 'Fortune Okon', 1000.00, 10000.00, 9000.00, 2),
(14, '2018-06-12 12:10:33', 'credit', 'Daniel John', 'Fortune Okon', 1000.00, 115000.00, 116000.00, 1),
(15, '2018-06-13 10:03:29', 'debit', 'Mary  Okon', 'mercy danmadammi', 20000.00, 59980000.00, 59960000.00, 5),
(16, '2018-06-13 10:03:29', 'credit', 'Mary  Okon', 'mercy danmadammi', 20000.00, 1000000.00, 1020000.00, 3),
(17, '2018-06-13 11:17:01', 'debit', 'Fortune Okon', 'Daniel John', 1000.00, 116000.00, 115000.00, 1),
(18, '2018-06-13 11:17:01', 'credit', 'self', 'Daniel John', 1000.00, 9000.00, 10000.00, 2);
