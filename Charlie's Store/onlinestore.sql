-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2023 at 09:05 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `productSeller` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `time`, `productSeller`, `username`, `productID`) VALUES
(1, 1682362953, 'seller', 'Clark Kent', 1),
(2, 1682362953, 'Bruce Wayne', 'Clark Kent', 10),
(3, 1682363023, 'seller', 'Clark Kent', 2),
(4, 1682363023, 'seller', 'Clark Kent', 5),
(5, 1682363023, 'Bruce Wayne', 'Clark Kent', 9),
(6, 1682363023, 'Bruce Wayne', 'Clark Kent', 7),
(7, 1682363023, 'Bruce Wayne', 'Clark Kent', 8),
(8, 1682363072, 'seller', 'customer', 1),
(9, 1682363072, 'seller', 'customer', 2),
(10, 1682363072, 'Bruce Wayne', 'customer', 10),
(11, 1682363072, 'Bruce Wayne', 'customer', 9);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(20) NOT NULL,
  `productPrice` varchar(20) NOT NULL,
  `productSeller` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `productName`, `productPrice`, `productSeller`) VALUES
(1, 'Virus', '500', 'seller'),
(2, 'trojan horse', '200', 'seller'),
(3, 'Ransomware', '450', 'seller'),
(4, 'Keylogger', '200', 'seller'),
(5, 'Worm', '25', 'seller'),
(6, 'Rootkit', '30', 'seller'),
(7, 'SQL Injection', '150', 'Bruce Wayne'),
(8, 'Network Mapper', '50', 'Bruce Wayne'),
(9, 'Password Cracker', '250', 'Bruce Wayne'),
(10, 'Port Scanner', '35', 'Bruce Wayne');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `userpass` varchar(20) NOT NULL,
  `usertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `userpass`, `usertype`) VALUES
('Bruce Wayne', '123', 'seller'),
('Clark Kent', '123', 'customer'),
('customer', '123', 'customer'),
('seller', '123', 'seller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
