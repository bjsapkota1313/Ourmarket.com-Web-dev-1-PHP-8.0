-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 21, 2023 at 01:04 PM
-- Server version: 10.9.4-MariaDB-1:10.9.4+maria~ubu2204
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `OurMarketDB`
--
CREATE DATABASE IF NOT EXISTS `OurMarketDB` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `OurMarketDB`;

-- --------------------------------------------------------

--
-- Table structure for table `Ads`
--

CREATE TABLE `Ads` (
  `id` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `postedDate` date NOT NULL DEFAULT current_timestamp(),
  `price` decimal(10,2) NOT NULL,
  `userID` int(11) NOT NULL,
  `imageURI` varchar(1000) NOT NULL,
  `status` enum('Available','Sold','Expired') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Ads`
--

INSERT INTO `Ads` (`id`, `productName`, `description`, `postedDate`, `price`, `userID`, `imageURI`, `status`) VALUES
(8, 'Honda Crf 250', 'New Honda CRf -250 ,2000km run only&amp;quot; Newly', '2022-12-30', '9500.00', 1, '/img/Honda Crf 250-2022-12-30-Test.jpg', 'Expired'),
(13, 'Ktm Duke-390', 'The KTM 790 DUKE is as surgical as its nickname suggests. With the agility, you expect from a single, combined playground. Newly New', '2023-01-01', '900.00', 1, '/img/Ktm Duke-390-2023-01-01-Test.jpg', 'Sold'),
(14, 'Honda Crf 250', 'New Honda CRf -250 ,2000km run only', '2022-12-30', '9000.00', 1, '/img/Honda Crf 250-2022-12-30-Test.jpg', 'Available'),
(21, 'CrossFireNew ', 'Bijay  ', '2023-01-06', '900.00', 1, '/img/CrossFireNew -2023-01-06-Test.jpg', 'Sold'),
(23, 'cxcxcxc', 'dffffffffffffff', '2023-01-09', '9000.20', 1, '/img/OurMarket-2023-01-09-Test.jpg', 'Sold'),
(24, 'CrossFire new', 'Bijay', '2023-01-09', '9000.00', 1, '/img/OurMarket-2023-01-09-1673296197-Test.jpg', 'Sold'),
(25, 'Bijay', 'sdsdsdsd', '2023-01-12', '90000.00', 1, '/img/OurMarket-2023-01-12-1673562154-Test.jpg', 'Sold'),
(26, 'Newly New Bike', 'hvbv b hvv', '2023-01-15', '900.00', 1, '/img/OurMarket-2023-01-15-1673781376-Test.png', 'Available'),
(27, 'Electric Bike-2022 ', 'Americans Bike ', '2023-01-15', '1200.00', 1, '/img/OurMarket-2023-01-15-1673794055-Test.png', 'Expired'),
(28, 'Benelli Tnt- 300', 'Mode Benelli TNT-300 ', '2023-01-16', '5000.60', 1, '/img/OurMarket-2023-01-16-1673912055-Test.png', 'Available'),
(30, 'Yatri Bike ', 'Brand New', '2023-01-20', '900.00', 4, '/img/OurMarket-2023-01-20-1674226194-Muna.png', 'Available'),
(31, 'fcv', 'cvcvcvcv', '2023-01-20', '900.50', 4, '/img/OurMarket-2023-01-20-1674236314-Muna.jpg', 'Sold');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `HashPassword` varchar(255) NOT NULL,
  `Salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `firstName`, `lastName`, `email`, `HashPassword`, `Salt`) VALUES
(1, 'Test', 'Inholland', 'test@inholland.nl', '$argon2i$v=19$m=65536,t=4,p=1$N1RxQVBSOFowY0hlY09LLg$Rqrkc89iZO5Y4eM8ZfLQxiVYq4ivqo39d+d+Ru5Z/SI', '355d378154265e840889f2a394337f9061b68dac95f1331d6b4ba562ac0a56a1'),
(2, 'Bijay', 'Sapkota', 'bijay@inholland.nl', '$argon2i$v=19$m=65536,t=4,p=1$RmNaaEt1dDVNNXZQZFhiaA$iJ69sxER++TaC40D1VrpQdCMNb2o8cUZuW1uc6x0n3Y', 'defb4a15b13f74b82bab20461ab6ff4508886f92ade08431db5a9b241853d1cf'),
(3, 'Durga Devi', 'Sapkota', 'Durga@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$Y1ZGdzl5UTZ5dVRvWThDYw$w3isE1URIXsowejxrO7VlnyaN4ru1IfJw1ZF5UTK8Wc', '845ec4e7be54c9b75906bc797df2a276e620e09e7eef436e90528a831c897230'),
(4, 'Muna', 'Kandel', 'Muna@inholland.nl', '$argon2i$v=19$m=65536,t=4,p=1$Nktxay9RUUpqNUl0Z3ZiSw$Ol7kNEd1CbQXWi5kO7Kq+EMGe3emQDZ2XsGdKDxSv1Y', '18f9edfefb4f4e991e5ea215fcfc500ee6d89e89dcf5a49d24893a4b305dcb14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Ads`
--
ALTER TABLE `Ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Ads_fk` (`userID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Ads`
--
ALTER TABLE `Ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Ads`
--
ALTER TABLE `Ads`
  ADD CONSTRAINT `Ads_fk` FOREIGN KEY (`userID`) REFERENCES `Users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
