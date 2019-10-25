-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2019 at 01:06 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

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
  `memberpoint` int(6) NOT NULL DEFAULT '0',
  `idmember` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `memberdb`
--

INSERT INTO `memberdb` (`memberpoint`, `idmember`) VALUES
(0, '5gg'),
(0, 'jiahui'),
(0, 'jiahuiii');

-- --------------------------------------------------------

--
-- Table structure for table `menuitems`
--

CREATE TABLE `menuitems` (
  `itemno` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menuitems`
--

INSERT INTO `menuitems` (`itemno`, `name`, `price`, `discount`, `category`) VALUES
(1, 'Tea', '2.00', 0, 'Beverage'),
(2, 'Coffee', '2.00', 0, 'Beverage'),
(3, 'Noodles', '6.00', 0, 'Food'),
(4, 'Rice', '6.00', 0, 'Food'),
(5, 'Toast', '4.00', 0, 'Food'),
(6, 'Egg', '1.00', 0, 'Food'),
(7, 'Cake', '7.00', 0, 'Food'),
(8, 'Milo', '2.20', 0, 'Beverage');

-- --------------------------------------------------------

--
-- Table structure for table `orderdb`
--

CREATE TABLE `orderdb` (
  `orderid` int(5) NOT NULL,
  `itemno` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `idtable` int(4) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderdb`
--

INSERT INTO `orderdb` (`orderid`, `itemno`, `qty`, `idtable`, `subtotal`) VALUES
(203, 3, 2, 0, '12.00'),
(203, 4, 1, 0, '6.00'),
(203, 5, 2, 0, '8.00');

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
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`orderid`, `food`, `amount`, `date`) VALUES
(200, ',Coffee5,Rice2,Milo6', '35.20', '2019-10-25 10:44:01'),
(201, ',Tea5,Coffee5', '20.00', '2019-10-25 11:03:12'),
(202, ',Noodles2,Rice1', '18.00', '2019-10-25 11:04:04'),
(204, ',Noodles2,Rice1,Toast2,Egg2', '28.00', '2019-10-25 10:51:38'),
(204, ',Noodles2,Rice1,Toast2,Egg2', '28.00', '2019-10-25 10:51:48'),
(204, ',Noodles2,Rice1,Toast2,Egg2', '28.00', '2019-10-25 10:53:48'),
(204, ',Noodles2,Rice1', '18.00', '2019-10-25 10:54:18');

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
  ADD PRIMARY KEY (`itemno`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `itemno` int(5) NOT NULL AUTO_INCREMENT;

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
