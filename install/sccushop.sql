-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- เวอร์ชั่นของเซิร์ฟเวอร์: 5.6.12-log
-- รุ่นของ PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- ฐานข้อมูล: `sccushop`
--
CREATE DATABASE IF NOT EXISTS `sccushop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sccushop`;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `buyproduct`
--

CREATE TABLE IF NOT EXISTS `buyproduct` (
  `orderid` int(5) NOT NULL,
  `productid` int(5) NOT NULL,
  `piece` int(5) NOT NULL,
  PRIMARY KEY (`orderid`,`productid`),
  KEY `prodIDFK` (`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `buyproduct`
--

INSERT INTO `buyproduct` (`orderid`, `productid`, `piece`) VALUES
(1, 11, 1),
(2, 10, 1),
(3, 5, 1),
(4, 24, 1),
(6, 37, 1);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `catid` int(2) NOT NULL AUTO_INCREMENT COMMENT 'ID หมวดหมู่',
  `description` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ชื่อหมวดหมู่',
  `ranking` int(3) NOT NULL,
  PRIMARY KEY (`catid`),
  UNIQUE KEY `description` (`description`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- dump ตาราง `category`
--

INSERT INTO `category` (`catid`, `description`, `ranking`) VALUES
(1, 'เสื้อผ้านิสิตชาย', 0),
(2, 'เสื้อผ้านิสิตหญิง', 0),
(3, 'อุปกรณ์นิสิตชาย', 0),
(4, 'อุปกรณ์นิสิตหญิง', 0),
(5, 'แพ็กเกจ', 0);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `membcontrolor`
--

CREATE TABLE IF NOT EXISTS `membcontrolor` (
  `orderid` int(5) NOT NULL,
  `memberid` int(5) NOT NULL,
  PRIMARY KEY (`orderid`,`memberid`),
  KEY `membIDFK` (`memberid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `membcontrolor`
--

INSERT INTO `membcontrolor` (`orderid`, `memberid`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 3),
(6, 3);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `member_staff`
--

CREATE TABLE IF NOT EXISTS `member_staff` (
  `memberid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `studentID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `major` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`memberid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- dump ตาราง `member_staff`
--

INSERT INTO `member_staff` (`memberid`, `username`, `password`, `firstname`, `lastname`, `nickname`, `phone`, `email`, `position`, `studentID`, `major`) VALUES
(2, 'cashier01', 'cashier01', 'cashier', '01', 'cash', '0888888888', 'cartoonst@gmail.com', 'M', 'test', 'none'),
(3, 'nppi3enz', '326207', 'nipitpon', 'chantada', 'benz', '0882288335', 'cartoonst@gmail.com', 'A', '5533684623', 'math-com'),
(4, 'test', 'test', 'test', 'test', 'เทส', '0888888888', 'cartoonst@gmail.com', 'C', '5555555555', 'วิชานั้นแหละ');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `orderid` int(5) NOT NULL AUTO_INCREMENT,
  `total` decimal(7,2) NOT NULL,
  `pay` decimal(7,2) NOT NULL,
  `discount` decimal(7,2) DEFAULT NULL,
  `status` int(2) NOT NULL,
  `dateOrder` datetime NOT NULL,
  `dateReceive` datetime DEFAULT NULL,
  `print` int(2) NOT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- dump ตาราง `order`
--

INSERT INTO `order` (`orderid`, `total`, `pay`, `discount`, `status`, `dateOrder`, `dateReceive`, `print`) VALUES
(1, '18.00', '50.00', '0.00', 2, '2014-06-06 09:23:40', NULL, 0),
(2, '25.00', '50.00', '0.00', 2, '2014-06-06 09:23:48', NULL, 0),
(3, '35.00', '50.00', '0.00', 4, '2014-06-06 09:23:58', '2014-06-06 09:26:31', 0),
(4, '310.00', '2000.00', '0.00', 2, '2014-06-13 14:27:48', NULL, 0),
(6, '230.00', '300.00', '0.00', 2, '2014-06-13 14:29:07', NULL, 0);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `productid` int(10) NOT NULL AUTO_INCREMENT,
  `pname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `catid` int(3) NOT NULL,
  `pic` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `stock` int(5) NOT NULL,
  `type` int(2) NOT NULL,
  `barcode` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parentid` int(10) DEFAULT NULL,
  PRIMARY KEY (`productid`),
  KEY `catid` (`catid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=64 ;

--
-- dump ตาราง `product`
--

INSERT INTO `product` (`productid`, `pname`, `catid`, `pic`, `price`, `cost`, `stock`, `type`, `barcode`, `parentid`) VALUES
(1, 'เสื้อนิสิตชายแขนยาว', 1, '496002.jpg', '160.00', '105.00', 1, 2, '', 0),
(2, 'กางเกงนิสิตชาย สีดำ', 1, '612854.jpg', '300.00', '240.00', 1, 2, '', 0),
(3, 'กางเกงนิสิตชาย สีขาว', 1, '300415.jpg', '310.00', '250.00', 1, 2, '', 0),
(4, 'สายเข็มขัดนิสิตชาย', 3, '471527.jpg', '90.00', '84.00', 1, 2, '', 0),
(5, 'หัวเข็มขัดนิสิตชาย', 3, '551300.jpg', '35.00', '32.00', 0, 1, '', 0),
(6, 'เนคไทชายปี 1', 3, '170440.jpg', '97.00', '92.00', 1, 1, '', 0),
(7, 'ถุงเท้าสีดำแพ็ค 3 คู่', 3, '459381.jpg', '70.00', '60.00', 100, 1, '', 0),
(8, 'เสื้อนิสิตหญิง', 2, '130004.jpg', '160.00', '105.00', 1, 2, '', 0),
(9, 'กระโปรงพลีทสีกรมท่า', 2, '681640.jpg', '0.00', '0.00', 1, 2, '', 0),
(10, 'พระเกี้ยวติดอก', 4, '48767.jpg', '25.00', '20.00', 9, 1, '', 0),
(11, 'ตุ๊งติ๊ง', 4, '675567.jpg', '18.00', '17.00', 0, 1, '', 0),
(12, 'กระดุมสีเงิน 5 เม็ด', 4, '702667.jpg', '35.00', '30.00', 1, 1, '', 0),
(13, 'ถุงเท้าสีขาวแพ็ค 3 คู่', 4, '281799.jpg', '45.00', '42.00', 10, 1, '', 0),
(14, 'เสื้อนิสิตชายแขนยาว size S', 1, '826843.jpg', '200.00', '160.00', 1, 3, '', 1),
(15, 'เสื้อนิสิตชายแขนยาว size M', 1, '463012.jpg', '200.00', '160.00', 1, 3, '', 1),
(16, 'เสื้อนิสิตชายแขนยาว size L', 1, '61614.jpg', '200.00', '160.00', 1, 3, '', 1),
(17, 'เสื้อนิสิตชายแขนยาว size XL', 1, '61614.jpg', '200.00', '160.00', 1, 3, '', 1),
(18, 'กางเกงนิสิตชาย สีดำ size 28', 1, '371154.jpg', '300.00', '240.00', 10, 3, '', 2),
(19, 'กางเกงนิสิตชาย สีดำ size 29', 1, '371154.jpg', '300.00', '240.00', 1, 3, '', 2),
(22, ' เสื้อนิสิตชายแขนยาว size XXL', 1, '688446.jpg', '200.00', '160.00', 1, 3, '', 1),
(23, 'กางเกงนิสิตชาย สีดำ size 29', 1, '371154.jpg', '300.00', '240.00', 1, 3, '', 2),
(24, 'กางเกงนิสิตชาย สีขาว size 28', 1, '473602.jpg', '310.00', '250.00', 99, 3, '', 3),
(25, 'กางเกงนิสิตชาย สีขาว size 29', 1, '473602.jpg', '310.00', '250.00', 88, 3, '', 3),
(26, 'กางเกงนิสิตชาย สีขาว size 30', 1, '473602.jpg', '310.00', '250.00', 51, 3, '', 3),
(27, 'กางเกงนิสิตชาย สีขาว size 31', 1, '473602.jpg', '310.00', '250.00', 1, 3, '', 3),
(28, 'กางเกงนิสิตชาย สีขาว size 32', 1, '473602.jpg', '310.00', '250.00', 1, 3, '', 3),
(29, 'กางเกงนิสิตชาย สีขาว size 33', 1, '473602.jpg', '310.00', '250.00', 1, 3, '', 3),
(30, 'กางเกงนิสิตชาย สีขาว size 34', 1, '473602.jpg', '310.00', '250.00', 1, 3, '', 3),
(31, 'กางเกงนิสิตชาย สีขาว size 35', 1, '473602.jpg', '310.00', '250.00', 1, 3, '', 3),
(32, 'กางเกงนิสิตชาย สีขาว size 36', 1, '473602.jpg', '360.00', '300.00', 1, 3, '', 3),
(33, 'กางเกงนิสิตชาย สีขาว size 37', 1, '473602.jpg', '360.00', '300.00', 1, 3, '', 3),
(34, 'กางเกงนิสิตชาย สีขาว size 38', 1, '473602.jpg', '360.00', '300.00', 1, 3, '', 3),
(35, 'กางเกงนิสิตชาย สีขาว size 39', 1, '473602.jpg', '360.00', '300.00', 1, 3, '', 3),
(36, 'กางเกงนิสิตชาย สีขาว size 40', 1, '473602.jpg', '360.00', '300.00', 1, 3, '', 3),
(37, 'กระโปรงพลีทสีกรมท่า size 14', 2, '307983.jpg', '230.00', '165.50', 0, 3, '', 9),
(38, 'กระโปรงพลีทสีกรมท่า size 15', 2, '307983.jpg', '230.00', '165.50', 1, 3, '', 9),
(39, 'กระโปรงพลีทสีกรมท่า size 16', 2, '307983.jpg', '230.00', '165.50', 1, 3, '', 9),
(40, 'กระโปรงพลีทสีกรมท่า size 17', 2, '307983.jpg', '230.00', '165.50', 1, 3, '', 9),
(41, 'กระโปรงพลีทสีกรมท่า size 18', 2, '307983.jpg', '230.00', '165.50', 1, 3, '', 9),
(42, 'กระโปรงพลีทสีกรมท่า size 19', 2, '307983.jpg', '230.00', '165.50', 1, 3, '', 9),
(43, 'กระโปรงพลีทสีกรมท่า size 20', 2, '307983.jpg', '230.00', '165.50', 1, 3, '', 9),
(44, 'กระโปรงพลีทสีกรมท่า size 21', 2, '307983.jpg', '240.00', '172.80', 1, 3, '', 9),
(45, 'กระโปรงพลีทสีกรมท่า size 22', 2, '307983.jpg', '250.00', '180.00', 1, 3, '', 9),
(46, 'กระโปรงพลีทสีกรมท่า size 23', 2, '307983.jpg', '260.00', '187.20', 1, 3, '', 9),
(47, 'กระโปรงพลีทสีกรมท่า size 24', 2, '307983.jpg', '270.00', '194.40', 1, 3, '', 9),
(48, 'กระโปรงพลีทสีกรมท่า size 25', 2, '307983.jpg', '280.00', '201.60', 1, 3, '', 9),
(49, 'กระโปรงพลีทสีกรมท่า size 26', 2, '307983.jpg', '280.00', '201.60', 1, 3, '', 9),
(50, 'กระโปรงพลีทสีกรมท่า size 27', 2, '307983.jpg', '290.00', '208.80', 1, 3, '', 9),
(51, 'กระโปรงพลีทสีกรมท่า size 28', 2, '307983.jpg', '290.00', '208.80', 1, 3, '', 9),
(52, 'กระโปรงพลีทสีกรมท่า size 30', 2, '307983.jpg', '300.00', '216.00', 1, 3, '', 9),
(53, 'กระโปรงพลีทสีกรมท่า size 32', 2, '307983.jpg', '350.00', '252.00', 1, 3, '', 9),
(54, 'กระโปรงพลีทสีกรมท่า size 33', 2, '307983.jpg', '350.00', '252.00', 1, 3, '', 9),
(55, 'กระโปรงพลีทสีกรมท่า size 34', 2, '307983.jpg', '350.00', '252.00', 1, 3, '', 9),
(56, 'กระโปรงพลีทสีกรมท่า size 36', 2, '307983.jpg', '400.00', '288.00', 1, 3, '', 9),
(57, 'กระโปรงพลีทสีกรมท่า size 37', 2, '307983.jpg', '400.00', '288.00', 1, 3, '', 9),
(58, 'กระโปรงพลีทสีกรมท่า size 38', 2, '307983.jpg', '400.00', '288.00', 1, 3, '', 9),
(59, 'กระโปรงพลีทสีกรมท่า size 39', 2, '307983.jpg', '400.00', '288.00', 1, 3, '', 9),
(60, 'กระโปรงพลีทสีกรมท่า size 40', 2, '307983.jpg', '400.00', '288.00', 0, 3, '', 9),
(61, 'หัวเข็มขัดนิสิตหญิง', 4, '282623.jpg', '35.00', '32.00', 10, 1, '', 0),
(63, 'สายเข็มขัดนิสิตหญิง', 4, '991790.jpg', '69.00', '64.00', 1, 2, '', 0);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `warehouse`
--

CREATE TABLE IF NOT EXISTS `warehouse` (
  `warehouseid` int(10) NOT NULL AUTO_INCREMENT,
  `wname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`warehouseid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- dump ตาราง `warehouse`
--

INSERT INTO `warehouse` (`warehouseid`, `wname`, `address`, `phone`, `email`, `website`) VALUES
(1, 'ร้านสหกรณ์จุฬาลงกรณ์มหาวิทยาลัย จำกัด', 'จุฬาลงกรณ์มหาวิทยาลัย', '', 'https://www.facebook.com/chula.cooperative/', '');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `whmakeproduct`
--

CREATE TABLE IF NOT EXISTS `whmakeproduct` (
  `productid` int(5) NOT NULL,
  `warehouseid` int(5) NOT NULL,
  PRIMARY KEY (`warehouseid`,`productid`),
  KEY `productidFK` (`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- dump ตาราง `whmakeproduct`
--

INSERT INTO `whmakeproduct` (`productid`, `warehouseid`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(63, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyproduct`
--
ALTER TABLE `buyproduct`
  ADD CONSTRAINT `prodIDFK` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prodORFK` FOREIGN KEY (`orderid`) REFERENCES `order` (`orderid`) ON DELETE CASCADE;

--
-- Constraints for table `membcontrolor`
--
ALTER TABLE `membcontrolor`
  ADD CONSTRAINT `membIDFK` FOREIGN KEY (`memberid`) REFERENCES `member_staff` (`memberid`),
  ADD CONSTRAINT `memodIDFK` FOREIGN KEY (`orderid`) REFERENCES `order` (`orderid`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_catid_c` FOREIGN KEY (`catid`) REFERENCES `category` (`catid`) ON UPDATE CASCADE;

--
-- Constraints for table `whmakeproduct`
--
ALTER TABLE `whmakeproduct`
  ADD CONSTRAINT `productidFK` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `warehouseidFK` FOREIGN KEY (`warehouseid`) REFERENCES `warehouse` (`warehouseid`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
