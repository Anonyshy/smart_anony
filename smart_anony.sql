-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 28, 2023 at 04:02 PM
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
  `Cat_Name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Cat_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cus_ID`, `Username`, `Email`, `PN`, `Address`, `Pwd`, `Position`) VALUES
(1, 'Admin', 'shyamansuresh@gmail.com', '+94719242999', 'Tissamaharama', '202cb962ac59075b964b07152d234b70', 'Admin'),
(2, 'Shyaman', 'anonyshy@ms.ac.lk', '0719242999', 'Tissamaharama', '202cb962ac59075b964b07152d234b70', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `fines`
--

DROP TABLE IF EXISTS `fines`;
CREATE TABLE IF NOT EXISTS `fines` (
  `Cus_ID` int NOT NULL,
  `Pro_ID` int NOT NULL,
  `Date` date NOT NULL,
  `Amount` varchar(10) NOT NULL,
  `State` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=10006 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`Inv_ID`, `Order_ID`, `Date`, `Amount`) VALUES
(10000, 50000, '2023-07-14', '550'),
(10001, 50001, '2023-07-14', '250'),
(10002, 50002, '2023-08-24', '300'),
(10003, 50003, '2023-08-28', '300');

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
  `Status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Order_ID`,`Pro_ID`),
  KEY `Pro_ID` (`Pro_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`Order_ID`, `Pro_ID`, `Unit_price`, `Due_Date`, `Status`) VALUES
(50000, 4, '300', '2023-07-17', 'Finished'),
(50000, 6, '250', '2023-07-17', 'Finished'),
(50001, 6, '250', '2023-07-17', 'Finished'),
(50002, 10, '300', '2023-08-27', 'ToDeliver'),
(50003, 4, '300', '2023-08-31', 'Ordered');

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
  KEY `Cus_ID` (`Cus_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=50007 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`Order_ID`, `Cus_ID`, `Date_Created`) VALUES
(50000, 2, '2023-07-14'),
(50001, 2, '2023-07-14'),
(50002, 2, '2023-08-24'),
(50003, 2, '2023-08-28');

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
  `url` varchar(150) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  PRIMARY KEY (`Pro_ID`),
  KEY `Cat_ID` (`Cat_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Pro_ID`, `Pro_name`, `Qty_available`, `Cat_ID`, `Cost`, `Description`, `url`, `file_name`) VALUES
(4, 'Tenet (2020)', 2, 2, '300', 'Armed with only one word, Tenet, and fighting for the survival of the entire world, a Protagonist journeys through a twilight world of international espionage on a mission that will unfold in something beyond real time.<br><br>Director: Christopher Nolan | Stars: John David Washington, Robert Pattin', 'https://www.youtube.com/embed/zpOULjyy-n8?rel=0', 'img_649027cdb93c14.99742400.jpg'),
(6, ' Uncut Gems (2019)', 2, 1, '250', 'With his debts mounting and angry collectors closing in, a fast-talking New York City jeweler risks everything in hope of staying afloat and alive.<br><br>Directors: Benny Safdie, Josh Safdie | Stars: Adam Sandler, Julia Fox, Idina Menzel, Mesfin Lamengo', 'https://www.youtube.com/embed/vTfJp2Ts9X8', 'img_649027cdb93c14.99742401.jpg'),
(7, 'The Trial of the Chicago 7 (2020)', 3, 1, '300', 'The story of 7 people on trial stemming from various charges surrounding the uprising at the 1968 Democratic National Convention in Chicago, Illinois.Director: Aaron Sorkin | Stars: Eddie Redmayne, Alex Sharp, Sacha Baron Cohen, Jeremy Strong', 'https://www.youtube.com/embed/zpOULjyy-n8?rel=0', 'img_649027cdb93c14.99742402.jpg'),
(8, 'Rewind (III) (2019)', 2, 2, '250', 'Digging through the vast collection of his father', 'https://www.youtube.com/embed/zpOULjyy-n8?rel=0', 'img_649027cdb93c14.99742459.jpg'),
(9, 'Soul (2020)', 0, 1, '300', 'After landing the gig of a lifetime, a New York jazz pianist suddenly finds himself trapped in a strange land between Earth and the afterlife.\n\nDirectors: Pete Docter, Kemp Powers | Stars: Jamie Foxx, Tina Fey, Graham Norton, Rachel House', 'https://www.youtube.com/embed/zpOULjyy-n8?rel=0', 'img_649027cdb93c14.99742403.jpg'),
(10, 'Beastie Boys Story (2020)', 1, 4, '300', 'Here', 'https://www.youtube.com/embed/ZCyqR2RXoQU', 'img_649027cdb93c14.99742404.jpg'),
(11, 'The Outpost (2019)', 0, 2, '250', 'A small team of U.S. soldiers battles against hundreds of Taliban fighters in Afghanistan.\n\nDirector: Rod Lurie | Stars: Scott Eastwood, Caleb Landry Jones, Orlando Bloom, Jack Kesy', 'https://www.youtube.com/embed/zpOULjyy-n8?rel=0', 'img_649027cdb93c14.99742405.jpg'),
(12, 'Wolfwalkers (2020)', 3, 4, '300', 'A young apprentice hunter and her father journey to Ireland to help wipe out the last wolf pack. But everything changes when she befriends a free-spirited girl from a mysterious tribe rumored to transform into wolves by night.\n\nDirectors: Tomm Moore, Ross Stewart | Stars: Honor Kneafsey, Eva Whittak', 'https://www.youtube.com/embed/zpOULjyy-n8?rel=0', 'img_649027cdb93c14.99742406.jpg'),
(13, 'Richard Jewell (2019)', 2, 3, '250', 'Security guard Richard Jewell is an instant hero after foiling a bomb attack at the 1996 Atlanta Olympics, but his life becomes a nightmare when the FBI leaks to the media that he is a suspect in the case.\n\nDirector: Clint Eastwood | Stars: Paul Walter Hauser, Sam Rockwell, Brandon Stanley, Ryan Boz', 'https://www.youtube.com/embed/zpOULjyy-n8?rel=0', 'img_649027cdb93c14.99742407.jpg'),
(14, 'The Gentlemen (2019)', 0, 4, '200', 'An American expat tries to sell off his highly profitable marijuana empire in London, triggering plots, schemes, bribery and blackmail in an attempt to steal his domain out from under him.\n\nDirector: Guy Ritchie | Stars: Matthew McConaughey, Charlie Hunnam, Michelle Dockery, Jeremy Strong', 'https://www.youtube.com/embed/zpOULjyy-n8?rel=0', 'img_649027cdb93c14.99742408.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_temp`
--

DROP TABLE IF EXISTS `product_temp`;
CREATE TABLE IF NOT EXISTS `product_temp` (
  `id` int NOT NULL,
  `Username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`,`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int NOT NULL,
  `Username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`,`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
