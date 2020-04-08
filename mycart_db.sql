-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2020 at 09:10 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mycart_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bal_tab`
--

CREATE TABLE `bal_tab` (
  `bal_id` int(11) NOT NULL,
  `ses_id` varchar(500) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bal_tab`
--

INSERT INTO `bal_tab` (`bal_id`, `ses_id`, `total`) VALUES
(1, 'tlfpuk2rc8vrdm84gvk9etk836', '33.75'),
(2, 'e9s4c76q9imjmmlu3le0d5vfq4', '3.75'),
(3, 'tlfpuk2rc8vrdm84gvk9etk836', '1.00'),
(4, 'tlfpuk2rc8vrdm84gvk9etk836', '3.00'),
(5, '08rij0facbjea3e0a6mdr5eb11', '9.40'),
(6, 'tlfpuk2rc8vrdm84gvk9etk836', '1.00'),
(7, 'tlfpuk2rc8vrdm84gvk9etk836', '1.00'),
(8, 'tlfpuk2rc8vrdm84gvk9etk836', '1.00'),
(9, '08rij0facbjea3e0a6mdr5eb11', '9.40'),
(10, 'tlfpuk2rc8vrdm84gvk9etk836', '6.90'),
(11, 'tlfpuk2rc8vrdm84gvk9etk836', '4.60'),
(12, 'tlfpuk2rc8vrdm84gvk9etk836', '1.00'),
(13, 'tlfpuk2rc8vrdm84gvk9etk836', '6.05'),
(14, 'tlfpuk2rc8vrdm84gvk9etk836', '3.60'),
(15, 'tlfpuk2rc8vrdm84gvk9etk836', '5.75'),
(16, '', '0.00'),
(17, '', '0.00'),
(18, 'tlfpuk2rc8vrdm84gvk9etk836', '1.00'),
(19, 'tlfpuk2rc8vrdm84gvk9etk836', '1.00'),
(20, 'tlfpuk2rc8vrdm84gvk9etk836', '5.75'),
(21, 'tlfpuk2rc8vrdm84gvk9etk836', '1.30'),
(22, '', '0.00'),
(23, 'e9s4c76q9imjmmlu3le0d5vfq4', '2.00'),
(24, 'e9s4c76q9imjmmlu3le0d5vfq4', '2.00'),
(25, 'e9s4c76q9imjmmlu3le0d5vfq4', '4.00'),
(26, 'tlfpuk2rc8vrdm84gvk9etk836', '4.75'),
(27, 'jmf2mkral77u6qir9tc15hd807', '4.00');

-- --------------------------------------------------------

--
-- Table structure for table `item_tab`
--

CREATE TABLE `item_tab` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `item_code` varchar(5) NOT NULL,
  `item_description` varchar(500) NOT NULL,
  `item_image` varchar(500) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `rate_avg` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_tab`
--

INSERT INTO `item_tab` (`item_id`, `item_name`, `item_code`, `item_description`, `item_image`, `item_price`, `rate_avg`) VALUES
(1, 'Apple', 'A1', 'A type of Fruit', 'image/apple.jpg', '0.30', 4.00),
(2, 'Beer', 'B1', 'A type of drink', 'image/beer.jpg', '2.00', 3.73),
(3, 'Water', 'W1', 'A type of natural drink', 'image/water.jpg', '1.00', 3.33),
(4, 'Cheese', 'C1', 'A dairy product', 'image/cheese.jpg', '3.75', 3.60);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rate_id` int(11) NOT NULL,
  `ses_id` varchar(500) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rate_id`, `ses_id`, `item_id`, `item_rating`) VALUES
(1, 'e9s4c76q9imjmmlu3le0d5vfq4', 1, 4),
(2, 'e9s4c76q9imjmmlu3le0d5vfq4', 2, 5),
(3, 'e9s4c76q9imjmmlu3le0d5vfq4', 3, 5),
(4, 'e9s4c76q9imjmmlu3le0d5vfq4', 4, 3),
(5, 'e9s4c76q9imjmmlu3le0d5vfq4', 1, 5),
(6, 'jmf2mkral77u6qir9tc15hd807', 2, 3),
(7, 'jmf2mkral77u6qir9tc15hd807', 2, 3),
(8, 'jmf2mkral77u6qir9tc15hd807', 2, 2),
(9, 'jmf2mkral77u6qir9tc15hd807', 2, 3),
(10, 'jmf2mkral77u6qir9tc15hd807', 1, 4),
(11, 'jmf2mkral77u6qir9tc15hd807', 3, 3),
(12, 'jmf2mkral77u6qir9tc15hd807', 3, 5),
(13, 'jmf2mkral77u6qir9tc15hd807', 2, 3),
(14, 'jmf2mkral77u6qir9tc15hd807', 4, 4),
(15, 'jmf2mkral77u6qir9tc15hd807', 3, 3),
(16, 'jmf2mkral77u6qir9tc15hd807', 2, 3),
(17, 'jmf2mkral77u6qir9tc15hd807', 4, 3),
(18, 'jmf2mkral77u6qir9tc15hd807', 3, 3),
(19, 'jmf2mkral77u6qir9tc15hd807', 3, 3),
(20, 'jmf2mkral77u6qir9tc15hd807', 3, 1),
(21, 'jmf2mkral77u6qir9tc15hd807', 4, 3),
(22, 'jmf2mkral77u6qir9tc15hd807', 4, 5),
(23, 'jmf2mkral77u6qir9tc15hd807', 2, 4),
(24, 'jmf2mkral77u6qir9tc15hd807', 2, 3),
(25, 'jmf2mkral77u6qir9tc15hd807', 3, 3),
(26, 'jmf2mkral77u6qir9tc15hd807', 2, 3),
(27, 'jmf2mkral77u6qir9tc15hd807', 2, 5),
(28, 'jmf2mkral77u6qir9tc15hd807', 2, 5),
(29, 'jmf2mkral77u6qir9tc15hd807', 2, 5),
(30, 'jmf2mkral77u6qir9tc15hd807', 2, 5),
(31, 'jmf2mkral77u6qir9tc15hd807', 3, 4),
(32, 'jmf2mkral77u6qir9tc15hd807', 2, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bal_tab`
--
ALTER TABLE `bal_tab`
  ADD PRIMARY KEY (`bal_id`);

--
-- Indexes for table `item_tab`
--
ALTER TABLE `item_tab`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bal_tab`
--
ALTER TABLE `bal_tab`
  MODIFY `bal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `item_tab`
--
ALTER TABLE `item_tab`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
