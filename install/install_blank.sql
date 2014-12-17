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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `member_staff`
--
INSERT INTO `sccushop`.`member_staff` (`memberid`, `username`, `password`, `firstname`, `lastname`, `nickname`, `phone`, `email`, `position`) VALUES (NULL, 'nppi3enz', '326207', 'นิพิฐพนธ์', 'จันทร์ธาดา', 'เบนซ์', '0882288335', 'cartoonst@gmail.com', 'A', '5533684623', 'math-com');
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- dump ตาราง `warehouse`
--

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


