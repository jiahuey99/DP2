-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2019 at 12:30 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabletable`
--

-- --------------------------------------------------------

--
-- Table structure for table `memberdb`
--

CREATE TABLE `memberdb` (
  `memberpoint` int(6) NOT NULL DEFAULT 0,
  `idmember` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `memberdb`
--

INSERT INTO `memberdb` (`memberpoint`, `idmember`) VALUES
(12, '5gg'),
(0, 'jiahui'),
(0, 'jiahuiii');

-- --------------------------------------------------------

--
-- Table structure for table `menuitems`
--

CREATE TABLE `menuitems` (
  `ITEMNO` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menuitems`
--

INSERT INTO `menuitems` (`ITEMNO`, `name`, `price`, `discount`, `category`, `img`) VALUES
(1, 'Tea', '2.00', 0, 'Beverage', 'tea.jpg'),
(2, 'Coffee', '2.00', 0, 'Beverage', 'coffee.png'),
(3, 'Noodles', '6.00', 0, 'Food', 'tea.jpg'),
(4, 'Rice', '6.00', 0, 'Food', 'tea.jpg'),
(5, 'Toast', '4.00', 0, 'Food', 'tea.jpg\r\n'),
(6, 'Egg', '1.00', 0, 'Food', 'tea.jpg'),
(7, 'Cake', '2.30', 0, 'Food', 'coffee.png\r\n'),
(8, 'Pepsi', '2.20', 0, 'Beverage', 'coffee.png'),
(9, 'yy', '2.00', 0, 'Food', '');

-- --------------------------------------------------------

--
-- Table structure for table `orderdb`
--

CREATE TABLE `orderdb` (
  `orderid` int(5) NOT NULL,
  `itemno` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `idtable` int(4) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `comment` text NOT NULL,
  `discount` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table`
--

CREATE TABLE `table` (
  `idtable` int(4) UNSIGNED NOT NULL,
  `reservename` char(30) DEFAULT NULL,
  `reservetime` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tabledb`
--

CREATE TABLE `tabledb` (
  `idtable` int(4) UNSIGNED NOT NULL,
  `reservename` char(40) DEFAULT NULL,
  `reservetime` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tabledb`
--

INSERT INTO `tabledb` (`idtable`, `reservename`, `reservetime`) VALUES
(0, NULL, NULL),
(20, NULL, NULL),
(21, NULL, NULL),
(43, NULL, NULL),
(211, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `orderid` int(5) NOT NULL,
  `food` varchar(200) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`orderid`, `food`, `amount`, `date`) VALUES
(1, ',Tea2,Noodles1', '10.00', '2019-11-15 11:28:03'),
(3, ',Noodles4,Rice3,Toast3', '54.00', '2019-11-04 14:50:51'),
(3, ',Noodles4,Rice1,Egg3', '33.00', '2019-11-05 14:18:20'),
(3, ',Rice1,Toast3,Cake4', '27.20', '2019-11-06 08:17:26'),
(3, ',Egg5,Cake7', '21.10', '2019-11-06 09:09:23'),
(3, ',Noodles3,Rice3', '36.00', '2019-11-06 17:52:43'),
(3, ',Rice4,Toast2', '32.00', '2019-11-07 03:18:48'),
(3, ',Rice3', '18.00', '2019-11-08 08:35:01'),
(4, ',Tea2,Coffee3,Milo4', '18.80', '2019-11-04 14:50:53'),
(4, ',Coffee3,Toast3,Egg4,Cake5', '57.00', '2019-11-05 14:18:23'),
(4, ',Cake2', '4.60', '2019-11-08 08:34:59'),
(5, ',Tea1,Toast2,Egg4,Cake1', '21.00', '2019-11-04 14:50:55'),
(5, ',Tea2,Toast3,Milo4', '24.80', '2019-11-05 14:18:25'),
(5, ',Noodles3', '18.00', '2019-11-08 08:35:03'),
(6, ',Noodles3', '18.00', '2019-11-08 08:35:05'),
(6, ',Noodles6', '36.00', '2019-11-15 08:38:05'),
(300, ',Toast5,Tea6', '5.00', '2019-09-20 14:50:50'),
(400, ',Coffee3,Toast40', '100.00', '2019-10-20 14:50:51'),
(600, ',Coffee50', '100.00', '2019-12-11 14:50:50'),
(709, ',Toast60', '100.00', '2020-01-10 14:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `userpass`
--

CREATE TABLE `userpass` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `type` enum('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userpass`
--

INSERT INTO `userpass` (`id`, `user`, `pass`, `type`) VALUES
(1, 'abcd', '1234', 'User'),
(2, 'abcd1234', '12345678', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `memberdb`
--
ALTER TABLE `memberdb`
  ADD PRIMARY KEY (`idmember`);

--
-- Indexes for table `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`ITEMNO`);

--
-- Indexes for table `orderdb`
--
ALTER TABLE `orderdb`
  ADD PRIMARY KEY (`orderid`,`itemno`),
  ADD KEY `itemno` (`itemno`);

--
-- Indexes for table `table`
--
ALTER TABLE `table`
  ADD PRIMARY KEY (`idtable`);

--
-- Indexes for table `tabledb`
--
ALTER TABLE `tabledb`
  ADD PRIMARY KEY (`idtable`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`orderid`,`date`);

--
-- Indexes for table `userpass`
--
ALTER TABLE `userpass`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `ITEMNO` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userpass`
--
ALTER TABLE `userpass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdb`
--
ALTER TABLE `orderdb`
  ADD CONSTRAINT `orderdb_ibfk_1` FOREIGN KEY (`itemno`) REFERENCES `menuitems` (`ITEMNO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
