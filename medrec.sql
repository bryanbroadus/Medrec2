-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 11, 2015 at 12:06 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `medrec`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_details`
--

CREATE TABLE IF NOT EXISTS `category_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(120) NOT NULL,
  `category_description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE IF NOT EXISTS `customer_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(8) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `sex` char(6) NOT NULL,
  `patient_dob` date DEFAULT NULL,
  `insurance` varchar(25) NOT NULL,
  `customer_address` varchar(500) NOT NULL,
  `customer_contact1` varchar(100) NOT NULL,
  `customer_contact2` varchar(100) NOT NULL,
  `patient_email` varchar(30) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `balance` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `patient_id`, `customer_name`, `sex`, `patient_dob`, `insurance`, `customer_address`, `customer_contact1`, `customer_contact2`, `patient_email`, `balance`) VALUES
(3, 'P001', 'Hannah Serwadda', 'F', '1985-02-20', 'Self', 'Plot 20 Kisugu Lane', '0788811288', '0414228811', 'serwhanna@yahoo.co.uk', 210000),
(4, 'P003', 'Grace Nalwadda', 'F', '1975-12-16', 'Self', 'Plot 6 buula lane, Tenywa Village, Busia', '0787876786', '0703018334', 'gracen@shell.ug', 380000),
(5, 'P004', 'Sam Sendi', 'M', '1978-09-10', 'Jubilee', 'Plot 6 Kintu Lane, Luzira', '0002499921000', '0021244454', 'samsendi@gmail.com', 0),
(6, 'P008', 'Doriss Luwagga', 'F', '1996-01-10', 'Sanlam', 'Plot 6 nlalalldsds', '0782700503', '0701700283', 'dluwagga@live.com', 1700000),
(7, 'P009', 'Richard Mukolwe', 'M', '1981-12-19', 'Self', 'Plot 4 Bethesda Road, Luzira', '0703836968', '0791836098', 'rmukolwe@hotmail.com', 0),
(8, 'P005', 'Mary Luwalira', 'F', '1988-02-03', 'Jubilee', 'Plot 6 Sentogo Close, Bukoto', '0703836988', '0791847598', 'luwary@bhs.co.ug', 0),
(9, 'P010', 'Andrew Phillip Luswata', 'M', '1983-06-10', 'Sanlam', 'Plot 45 Bazarabusa drive, Bugolobi', '0703387654', '07955984471', 'philloswats@gmail.com', 0),
(10, 'P011', 'Reagan Okumu', 'M', '1990-03-08', 'Jubilee', 'Plot 6 abura avenue, nebbi', '0709545562', '0794442598', 'okumureagan@gmail.com', 0),
(11, 'P002', 'Darius Karumuna', 'M', '1987-01-22', 'Jubilee', 'Plot 8, Mbuya Close, Mbuya, Kampala', '0709866968', '0794034667', 'dkarum@stanbic.co.ug', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient_treatment`
--

CREATE TABLE IF NOT EXISTS `patient_treatment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trt_date` date NOT NULL,
  `patient_id` varchar(10) CHARACTER SET latin1 NOT NULL,
  `patient_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `treatment` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `doc` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `next_appointment` date DEFAULT NULL,
  `invoice_id` varchar(10) CHARACTER SET latin1 NOT NULL,
  `cost` int(10) DEFAULT NULL,
  `paid` int(10) DEFAULT NULL,
  `balance` int(10) DEFAULT NULL,
  `pc` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `hpc` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `pmh` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `oe` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `dx` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `username` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `patient_treatment`
--

INSERT INTO `patient_treatment` (`id`, `trt_date`, `patient_id`, `patient_name`, `treatment`, `doc`, `next_appointment`, `invoice_id`, `cost`, `paid`, `balance`, `pc`, `hpc`, `pmh`, `oe`, `dx`, `username`) VALUES
(3, '2015-03-02', 'P004', 'Sam Sendi', 'Extraction, Cleaning', 'Dr. Edgar', '2015-05-06', 'Inv 001', 70000, 70000, 0, NULL, NULL, NULL, NULL, NULL, ''),
(4, '2015-03-02', 'P009', 'Richard Mukolwe', 'Difficult Extraction', 'Dr. Rachel', '2015-04-08', 'Inv 002', 75000, 75000, 0, NULL, NULL, NULL, NULL, NULL, 'admin'),
(5, '2015-02-02', 'P004', 'Sam Sendi', 'Bridge', 'Dr. Davis', '2015-03-27', 'Inv 003', 100000, 95000, 5000, NULL, NULL, NULL, NULL, NULL, 'admin'),
(6, '2015-01-01', 'P004', 'Sam Sendi', 'Zirconium Crown', 'Dr. Edgar', '2015-05-26', 'Inv 004', 270000, 270000, 0, NULL, NULL, NULL, NULL, NULL, 'admin'),
(7, '2015-03-04', 'P010', 'Andrew Phillip Luswata', 'Crowns, Extraction, Cleaning', 'Dr. Rachel', '2015-04-01', 'Inv 005', 260000, 200000, 60000, NULL, NULL, NULL, NULL, NULL, 'admin'),
(8, '2015-03-05', 'P001', 'Hannah Serwadda', 'Extraction', 'Dr. Davis', '2015-03-05', '0011', 500000, 300000, 200000, NULL, NULL, NULL, NULL, NULL, 'admin'),
(9, '2015-03-05', 'P010', 'Andrew Phillip Luswata', 'Zirconium Crown', 'Dr. Rachel', '2015-04-13', '0012', 850000, 450000, 400000, NULL, NULL, NULL, NULL, NULL, 'admin'),
(10, '2013-05-02', 'P003', 'Grace Nalwadda', 'Simple Extraction', 'Dr. Davis', '2015-04-01', '0013', 140000, 140000, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'admin'),
(11, '2013-05-02', 'P003', 'Grace Nalwadda', 'Cleaning (Adults)', 'Dr. Davis', '2015-04-01', '0013', 140000, 140000, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'admin'),
(12, '2015-03-03', 'P009', 'Richard Mukolwe', 'Difficult Extraction', 'Dr. Edgar', '2015-04-07', '0014', 470000, 470000, 0, 'Presented with the pc condition on the outset', 'Presented with the pc condition on the outset', 'Presented with the pc condition on the outset', 'Presented with the pc condition on the outset', 'Presented with the pc condition on the outset', 'admin'),
(13, '2015-03-03', 'P009', 'Richard Mukolwe', 'Cleaning (Minors)', 'Dr. Edgar', '2015-04-07', '0014', 470000, 470000, 0, 'Presented with the pc condition on the outset', 'Presented with the pc condition on the outset', 'Presented with the pc condition on the outset', 'Presented with the pc condition on the outset', 'Presented with the pc condition on the outset', 'admin'),
(14, '2015-04-01', 'P002', 'Darius Karumuna', 'Simple Extraction', 'Dr. Ham', '2015-04-07', '0016', 300000, 300000, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'admin'),
(15, '2015-04-01', 'P002', 'Darius Karumuna', 'Bridge (simple)', 'Dr. Ham', '2015-04-07', '0016', 300000, 300000, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'admin'),
(16, '2015-04-01', 'P002', 'Darius Karumuna', 'Cleaning (Teenagers)', 'Dr. Ham', '2015-04-07', '0016', 300000, 300000, 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.|Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `stock_avail`
--

CREATE TABLE IF NOT EXISTS `stock_avail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `stock_avail`
--

INSERT INTO `stock_avail` (`id`, `name`, `quantity`) VALUES
(28, 'Simple Extraction', 0),
(29, 'Simple Extraction', 0),
(30, 'Simple Extraction', 0),
(31, 'Simple Extraction', 0),
(32, 'Simple Extraction', 0),
(33, 'Mouth Wash', 0),
(34, 'Mouth Wash', 0),
(35, 'Simple Extraction', 0),
(36, 'Simple Extraction', 0),
(37, 'Mouth Wash', 0),
(38, 'Mouth Wash', 0),
(39, 'Difficult Extraction', 0),
(40, 'Whitening', 0),
(41, 'Cleaning (Minors)', 0),
(42, 'Cleaning (Teenagers)', 0),
(43, 'Cleaning (Adults)', 0),
(44, 'Cleaning (Minors)', 0),
(45, 'Cleaning (Minors)', 0),
(46, 'Cleaning (Minors)', 0),
(47, 'Cleaning (Minors)', 0),
(48, 'Cleaning (Minors)', 0),
(49, 'Cleaning (Minors)', 0),
(50, 'Cleaning (Teenagers)', 0),
(51, 'Cleaning (Teenagers)', 0),
(52, 'Cleaning (Adults)', 0),
(53, 'Zirconium Crown', 0),
(54, 'Bridge (simple)', 0),
(55, 'Bridge (medium)', 0),
(56, 'Cleaning (Minors)', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_details`
--

CREATE TABLE IF NOT EXISTS `stock_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stock_id` varchar(120) NOT NULL,
  `stock_name` varchar(120) NOT NULL,
  `stock_quatity` int(11) NOT NULL,
  `supplier_id` varchar(250) NOT NULL,
  `company_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `category` varchar(120) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expire_date` datetime NOT NULL,
  `uom` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `stock_details`
--

INSERT INTO `stock_details` (`id`, `stock_id`, `stock_name`, `stock_quatity`, `supplier_id`, `company_price`, `selling_price`, `category`, `date`, `expire_date`, `uom`) VALUES
(48, 'SR125', 'Simple Extraction', 0, '', 0.00, 45000.00, 'Service', '2015-02-26 11:26:18', '0000-00-00 00:00:00', ''),
(49, 'PR122', 'Mouth Wash', 0, '', 0.00, 25000.00, 'Product', '2015-02-26 11:28:59', '0000-00-00 00:00:00', ''),
(51, 'SR126', 'Difficult Extraction', 0, '', 0.00, 150000.00, 'Service', '2015-02-26 11:41:39', '0000-00-00 00:00:00', ''),
(52, 'SR127', 'Whitening', 0, '', 0.00, 100000.00, 'Service', '2015-02-26 11:59:46', '0000-00-00 00:00:00', ''),
(53, 'SR128', 'Cleaning (Minors)', 0, '', 0.00, 21800.00, 'Service', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(54, 'SR129', 'Cleaning (Teenagers)', 0, '', 0.00, 25000.00, 'Service', '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(55, 'SR130', 'Cleaning (Adults)', 0, '', 0.00, 50000.00, 'Service', '2015-02-26 12:23:41', '0000-00-00 00:00:00', ''),
(56, 'SR131', 'Zirconium Crown', 0, '', 0.00, 850000.00, 'Service', '2015-03-06 15:01:16', '0000-00-00 00:00:00', ''),
(57, 'SR132', 'Bridge (simple)', 0, '', 0.00, 100000.00, 'Service', '2015-03-06 15:03:32', '0000-00-00 00:00:00', ''),
(58, 'SR133', 'Bridge (medium)', 0, '', 0.00, 250000.00, 'Service', '2015-03-06 15:04:33', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `stock_entries`
--

CREATE TABLE IF NOT EXISTS `stock_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stock_id` varchar(120) NOT NULL,
  `stock_name` varchar(260) NOT NULL,
  `stock_supplier_name` varchar(200) NOT NULL,
  `category` varchar(120) NOT NULL,
  `quantity` int(11) NOT NULL,
  `company_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `opening_stock` int(11) NOT NULL,
  `closing_stock` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `username` varchar(120) NOT NULL,
  `type` varchar(50) NOT NULL,
  `salesid` varchar(120) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `mode` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `due` datetime NOT NULL,
  `subtotal` int(11) NOT NULL,
  `count1` int(11) NOT NULL,
  `billnumber` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `stock_entries`
--

INSERT INTO `stock_entries` (`id`, `stock_id`, `stock_name`, `stock_supplier_name`, `category`, `quantity`, `company_price`, `selling_price`, `opening_stock`, `closing_stock`, `date`, `username`, `type`, `salesid`, `total`, `payment`, `balance`, `mode`, `description`, `due`, `subtotal`, `count1`, `billnumber`) VALUES
(1, 'SR126', 'Difficult Extraction', '', 'Service', 2, 0.00, 150000.00, 0, 0, '2015-02-27 00:00:00', 'admin', 'sales', 'SD1', 300000.00, 300000.00, 0.00, '', '', '2015-02-27 00:00:00', 0, 1, '001'),
(2, 'PR122', 'Mouth Wash', '', 'Product', 1, 0.00, 25000.00, 0, 0, '2015-02-27 00:00:00', 'admin', 'sales', 'SD2', 25000.00, 100000.00, 15000.00, '', '', '2015-02-27 00:00:00', 0, 1, '002'),
(3, 'SR125', 'Simple Extraction', '', 'Service', 2, 0.00, 45000.00, 0, 0, '2015-02-27 00:00:00', 'admin', 'sales', 'SD2', 90000.00, 100000.00, 15000.00, '', '', '2015-02-27 00:00:00', 0, 2, '002'),
(4, 'SR130', 'Cleaning (Adults)', '', 'Service', 1, 0.00, 50000.00, 0, 0, '2015-02-27 00:00:00', 'admin', 'sales', 'SD4', 50000.00, 200000.00, 0.00, '', '', '2015-02-27 00:00:00', 0, 1, '003'),
(5, 'SR127', 'Whitening', '', 'Service', 1, 0.00, 100000.00, 0, 0, '2015-02-27 00:00:00', 'admin', 'sales', 'SD4', 100000.00, 200000.00, 0.00, '', '', '2015-02-27 00:00:00', 0, 2, '003'),
(6, 'PR122', 'Mouth Wash', '', 'Product', 3, 0.00, 25000.00, 0, 0, '2015-02-27 00:00:00', 'admin', 'sales', 'SD4', 75000.00, 200000.00, 0.00, '', '', '2015-02-27 00:00:00', 0, 3, '003'),
(7, 'PR122', 'Mouth Wash', '', 'Product', 3, 0.00, 25000.00, 0, 0, '2015-02-27 00:00:00', 'admin', 'sales', 'SD7', 75000.00, 106740.00, 0.00, '', '', '2015-02-27 00:00:00', 0, 1, '004'),
(8, 'SR128', 'Cleaning (Minors)', '', 'Service', 2, 0.00, 21800.00, 0, 0, '2015-02-27 00:00:00', 'admin', 'sales', 'SD7', 43600.00, 106740.00, 0.00, '', '', '2015-02-27 00:00:00', 0, 2, '004'),
(9, 'SR128', 'Cleaning (Minors)', '', 'Service', 2, 0.00, 21800.00, 0, 0, '2015-02-28 00:00:00', 'admin', 'sales', 'SD9', 43600.00, 330000.00, 8600.00, '', '', '2015-02-28 00:00:00', 0, 1, '1990'),
(10, 'SR126', 'Difficult Extraction', '', 'Service', 2, 0.00, 150000.00, 0, 0, '2015-02-28 00:00:00', 'admin', 'sales', 'SD9', 300000.00, 330000.00, 8600.00, '', '', '2015-02-28 00:00:00', 0, 2, '1990'),
(11, 'SR131', 'Zirconium Crown', '', 'Service', 2, 0.00, 850000.00, 0, 0, '2015-02-02 00:00:00', 'admin', 'sales', 'SD11', 1700000.00, 0.00, 1700000.00, '', '', '2015-02-02 00:00:00', 0, 1, '135'),
(12, 'SR125', 'Simple Extraction', '', 'Service', 2, 0.00, 45000.00, 0, 0, '2013-05-02 00:00:00', 'admin', 'sales', '', 90000.00, 140000.00, 0.00, '', '', '2013-05-02 00:00:00', 0, 1, ''),
(13, 'SR130', 'Cleaning (Adults)', '', 'Service', 1, 0.00, 50000.00, 0, 0, '2013-05-02 00:00:00', 'admin', 'sales', '', 50000.00, 140000.00, 0.00, '', '', '2013-05-02 00:00:00', 0, 2, ''),
(14, 'SR126', 'Difficult Extraction', '', 'Service', 3, 0.00, 150000.00, 0, 0, '2015-03-03 00:00:00', 'admin', 'sales', '0014', 450000.00, 470000.00, 0.00, '', '', '2015-03-03 00:00:00', 0, 1, ''),
(15, 'SR128', 'Cleaning (Minors)', '', 'Service', 1, 0.00, 21800.00, 0, 0, '2015-03-03 00:00:00', 'admin', 'sales', '0014', 21800.00, 470000.00, 0.00, '', '', '2015-03-03 00:00:00', 0, 2, ''),
(16, 'SR125', 'Simple Extraction', '', 'Service', 2, 0.00, 45000.00, 0, 0, '2015-04-01 00:00:00', 'admin', 'sales', '0016', 90000.00, 300000.00, 0.00, '', '', '2015-04-01 00:00:00', 0, 1, ''),
(17, 'SR132', 'Bridge (simple)', '', 'Service', 2, 0.00, 100000.00, 0, 0, '2015-04-01 00:00:00', 'admin', 'sales', '0016', 200000.00, 300000.00, 0.00, '', '', '2015-04-01 00:00:00', 0, 2, ''),
(18, 'SR129', 'Cleaning (Teenagers)', '', 'Service', 3, 0.00, 25000.00, 0, 0, '2015-04-01 00:00:00', 'admin', 'sales', '0016', 75000.00, 300000.00, 0.00, '', '', '2015-04-01 00:00:00', 0, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `stock_sales`
--

CREATE TABLE IF NOT EXISTS `stock_sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transactionid` varchar(250) NOT NULL,
  `stock_name` varchar(200) NOT NULL,
  `category` varchar(120) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(120) NOT NULL,
  `customer_id` varchar(120) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `tax_dis` varchar(100) NOT NULL,
  `dis_amount` decimal(10,0) NOT NULL,
  `grand_total` decimal(10,0) NOT NULL,
  `due` date NOT NULL,
  `mode` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `count1` int(11) NOT NULL,
  `billnumber` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `stock_sales`
--

INSERT INTO `stock_sales` (`id`, `transactionid`, `stock_name`, `category`, `supplier_name`, `selling_price`, `quantity`, `amount`, `date`, `username`, `customer_id`, `subtotal`, `payment`, `balance`, `discount`, `tax`, `tax_dis`, `dis_amount`, `grand_total`, `due`, `mode`, `description`, `count1`, `billnumber`) VALUES
(1, 'SD1', 'Difficult Extraction', 'Service', '', 150000.00, 2, 300000.00, '2015-02-27', 'admin', 'Hannah Serwadda', 300000.00, 300000.00, 0.00, 0, 0, '', 0, 300000, '2015-02-27', 'cash', '', 1, '001'),
(2, 'SD2', 'Mouth Wash', 'Product', '', 25000.00, 1, 25000.00, '2015-02-27', 'admin', 'Sam Sendi', 115000.00, 100000.00, 15000.00, 0, 0, '', 0, 115000, '2015-02-27', 'cash', '', 1, '002'),
(3, 'SD2', 'Simple Extraction', 'Service', '', 45000.00, 2, 90000.00, '2015-02-27', 'admin', 'Sam Sendi', 115000.00, 100000.00, 15000.00, 0, 0, '', 0, 115000, '2015-02-27', 'cash', '', 2, '002'),
(4, 'SD4', 'Cleaning (Adults)', 'Service', '', 50000.00, 1, 50000.00, '2015-02-27', 'admin', 'Sam Sendi', 200000.00, 200000.00, 0.00, 0, 0, '', 25000, 225000, '2015-02-27', 'cash', '', 1, '003'),
(5, 'SD4', 'Whitening', 'Service', '', 100000.00, 1, 100000.00, '2015-02-27', 'admin', 'Sam Sendi', 200000.00, 200000.00, 0.00, 0, 0, '', 25000, 225000, '2015-02-27', 'cash', '', 2, '003'),
(6, 'SD4', 'Mouth Wash', 'Product', '', 25000.00, 3, 75000.00, '2015-02-27', 'admin', 'Sam Sendi', 200000.00, 200000.00, 0.00, 0, 0, '', 25000, 225000, '2015-02-27', 'cash', '', 3, '003'),
(7, 'SD7', 'Mouth Wash', 'Product', '', 25000.00, 3, 75000.00, '2015-02-27', 'admin', 'Grace Nalwadda', 106740.00, 106740.00, 0.00, 10, 0, '', 11860, 118600, '2015-02-27', 'cash', '', 1, '004'),
(8, 'SD7', 'Cleaning (Minors)', 'Service', '', 21800.00, 2, 43600.00, '2015-02-27', 'admin', 'Grace Nalwadda', 106740.00, 106740.00, 0.00, 10, 0, '', 11860, 118600, '2015-02-27', 'cash', '', 2, '004'),
(9, 'SD9', 'Cleaning (Minors)', 'Service', '', 21800.00, 2, 43600.00, '2015-02-28', 'admin', 'Sam Sendi', 338600.00, 330000.00, 8600.00, 0, 0, '', 5000, 343600, '2015-02-28', 'cash', '', 1, '1990'),
(10, 'SD9', 'Difficult Extraction', 'Service', '', 150000.00, 2, 300000.00, '2015-02-28', 'admin', 'Sam Sendi', 338600.00, 330000.00, 8600.00, 0, 0, '', 5000, 343600, '2015-02-28', 'cash', '', 2, '1990'),
(11, 'SD11', 'Zirconium Crown', 'Service', '', 850000.00, 2, 1700000.00, '2015-02-02', 'admin', 'Doriss Luwagga', 1700000.00, 0.00, 1700000.00, 0, 0, '', 0, 1700000, '2015-02-02', 'cheque', '', 1, '135'),
(12, '', 'Simple Extraction', 'Service', '', 45000.00, 2, 90000.00, '2013-05-02', 'admin', 'Grace Nalwadda', 140000.00, 140000.00, 0.00, 0, 0, '', 0, 140000, '2013-05-02', 'cash', '', 0, ''),
(13, '', 'Cleaning (Adults)', 'Service', '', 50000.00, 1, 50000.00, '2013-05-02', 'admin', 'Grace Nalwadda', 140000.00, 140000.00, 0.00, 0, 0, '', 0, 140000, '2013-05-02', 'cash', '', 1, ''),
(14, '0014', 'Difficult Extraction', 'Service', '', 150000.00, 3, 450000.00, '2015-03-03', 'admin', 'Richard Mukolwe', 470000.00, 470000.00, 0.00, 0, 0, '', 1800, 471800, '2015-03-03', 'cash', '', 0, ''),
(15, '0014', 'Cleaning (Minors)', 'Service', '', 21800.00, 1, 21800.00, '2015-03-03', 'admin', 'Richard Mukolwe', 470000.00, 470000.00, 0.00, 0, 0, '', 1800, 471800, '2015-03-03', 'cash', '', 1, ''),
(16, '0016', 'Simple Extraction', 'Service', '', 45000.00, 2, 90000.00, '2015-04-01', 'admin', 'Darius Karumuna', 300000.00, 300000.00, 0.00, 0, 0, '', 65000, 365000, '2015-04-01', 'cash', '', 0, ''),
(17, '0016', 'Bridge (simple)', 'Service', '', 100000.00, 2, 200000.00, '2015-04-01', 'admin', 'Darius Karumuna', 300000.00, 300000.00, 0.00, 0, 0, '', 65000, 365000, '2015-04-01', 'cash', '', 1, ''),
(18, '0016', 'Cleaning (Teenagers)', 'Service', '', 25000.00, 3, 75000.00, '2015-04-01', 'admin', 'Darius Karumuna', 300000.00, 300000.00, 0.00, 0, 0, '', 65000, 365000, '2015-04-01', 'cash', '', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `stock_user`
--

CREATE TABLE IF NOT EXISTS `stock_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `answer` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `stock_user`
--

INSERT INTO `stock_user` (`id`, `username`, `password`, `user_type`, `answer`) VALUES
(1, 'admin', 'kazimedialtd12', 'admin', 'who is minda?');

-- --------------------------------------------------------

--
-- Table structure for table `store_details`
--

CREATE TABLE IF NOT EXISTS `store_details` (
  `name` varchar(100) NOT NULL,
  `log` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `web` varchar(100) NOT NULL,
  `pin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_details`
--

INSERT INTO `store_details` (`name`, `log`, `type`, `address`, `place`, `city`, `phone`, `email`, `web`, `pin`) VALUES
('MedRec International', 'posnic.png', 'png', 'Plot 6 / 6A Nile Avenue', 'Suite 41 Grand Imperial Mall', 'Kampala', '0701206663', 'info@medrec.ug', 'www.medrec.ug', '600020');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_details`
--

CREATE TABLE IF NOT EXISTS `supplier_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(200) NOT NULL,
  `supplier_address` varchar(500) NOT NULL,
  `supplier_contact1` varchar(100) NOT NULL,
  `supplier_contact2` varchar(100) NOT NULL,
  `balance` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `customer` varchar(250) NOT NULL,
  `supplier` varchar(250) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `due` datetime NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rid` varchar(120) NOT NULL,
  `receiptid` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `uom_details`
--

CREATE TABLE IF NOT EXISTS `uom_details` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `spec` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `uom_details`
--

INSERT INTO `uom_details` (`id`, `name`, `spec`) VALUES
(0000000006, 'UOM1', 'UOM1 Specification'),
(0000000007, 'UOM2', 'UOM2 Specification'),
(0000000008, 'UOM3', 'UOM3 Specification'),
(0000000009, 'UOM4', 'UOM4 Specification');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
