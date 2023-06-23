-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 23, 2023 at 12:20 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_anony`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `Cat_ID` int NOT NULL AUTO_INCREMENT,
  `Cat_Name` varchar(15) NOT NULL,
  PRIMARY KEY (`Cat_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Cat_ID`, `Cat_Name`) VALUES
(1, 'Actions'),
(2, 'Adventure'),
(3, 'Animated'),
(4, 'Comedy'),
(5, 'Drama'),
(6, 'Fantasy'),
(7, 'Historical'),
(8, 'Horror'),
(9, 'Musical'),
(10, 'Romance'),
(11, 'Science fiction'),
(12, 'Western');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `Cus_ID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PN` varchar(14) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Pwd` varchar(50) NOT NULL,
  `Position` varchar(8) NOT NULL,
  PRIMARY KEY (`Cus_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cus_ID`, `Username`, `Email`, `PN`, `Address`, `Pwd`, `Position`) VALUES
(1, 'Admin', 'shyamansuresh@gmail.com', '+94719242999', 'Tissamaharama', '202cb962ac59075b964b07152d234b70', 'Admin'),
(6, 'Shyaman', 'fishingwithsuresh@gmail.com', '0719242999', '1150/1a', '202cb962ac59075b964b07152d234b70', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `Inv_ID` int NOT NULL AUTO_INCREMENT,
  `Order_ID` int NOT NULL,
  `Date` date NOT NULL,
  `Amount` varchar(15) NOT NULL,
  PRIMARY KEY (`Inv_ID`),
  KEY `Order_ID` (`Order_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `Order_ID` int NOT NULL,
  `Pro_ID` int NOT NULL,
  `Unit_price` varchar(15) NOT NULL,
  `Due_Date` date NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`Order_ID`,`Pro_ID`),
  KEY `Pro_ID` (`Pro_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

DROP TABLE IF EXISTS `order_tbl`;
CREATE TABLE IF NOT EXISTS `order_tbl` (
  `Order_ID` int NOT NULL AUTO_INCREMENT,
  `Cus_ID` int NOT NULL,
  `Date_Created` date NOT NULL,
  PRIMARY KEY (`Order_ID`),
  UNIQUE KEY `Cus_ID` (`Cus_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `Pro_ID` int NOT NULL AUTO_INCREMENT,
  `Pro_name` varchar(50) NOT NULL,
  `Qty_available` int NOT NULL,
  `Cat_ID` int NOT NULL,
  `Cost` varchar(15) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  PRIMARY KEY (`Pro_ID`),
  KEY `Cat_ID` (`Cat_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Pro_ID`, `Pro_name`, `Qty_available`, `Cat_ID`, `Cost`, `Description`, `file_name`) VALUES
(4, 'AA', 10, 5, '200', 'sfa sf', 'img_649027cdb93c14.99742459.jpg'),
(6, 'AD', 9, 4, '300', 'eda', 'img_649027cdb93c14.99742459.jpg'),
(7, 'AD', 8, 4, '300', 'eda', 'img_649027cdb93c14.99742459.jpg'),
(8, 'AD', 7, 4, '300', 'eda', 'img_649027cdb93c14.99742459.jpg'),
(9, 'AD', 0, 4, '300', 'eda', 'img_649027cdb93c14.99742459.jpg'),
(10, 'AD', 5, 4, '300', 'eda', 'img_649027cdb93c14.99742459.jpg'),
(11, 'AD', 4, 4, '300', 'eda', 'img_649027cdb93c14.99742459.jpg'),
(12, 'AD', 3, 4, '300', 'eda', 'img_649027cdb93c14.99742459.jpg'),
(13, 'AD', 2, 4, '300', 'eda', 'img_649027cdb93c14.99742459.jpg'),
(14, 'AD', 1, 4, '300', 'eda', 'img_649027cdb93c14.99742459.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `search_counter`
--

DROP TABLE IF EXISTS `search_counter`;
CREATE TABLE IF NOT EXISTS `search_counter` (
  `Cus_ID` int NOT NULL,
  `Pro_ID` int NOT NULL,
  `Cat_ID` int NOT NULL,
  `Count` int NOT NULL,
  PRIMARY KEY (`Cus_ID`,`Pro_ID`),
  KEY `Pro_ID` (`Pro_ID`),
  KEY `Cat_ID` (`Cat_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`Order_ID`) REFERENCES `order_details` (`Order_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`Order_ID`) REFERENCES `order_tbl` (`Order_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`Pro_ID`) REFERENCES `product` (`Pro_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD CONSTRAINT `order_tbl_ibfk_1` FOREIGN KEY (`Cus_ID`) REFERENCES `customer` (`Cus_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Cat_ID`) REFERENCES `category` (`Cat_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `search_counter`
--
ALTER TABLE `search_counter`
  ADD CONSTRAINT `search_counter_ibfk_1` FOREIGN KEY (`Cus_ID`) REFERENCES `customer` (`Cus_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `search_counter_ibfk_2` FOREIGN KEY (`Pro_ID`) REFERENCES `product` (`Pro_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `search_counter_ibfk_3` FOREIGN KEY (`Cat_ID`) REFERENCES `category` (`Cat_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
