-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- เวอร์ชั่นของเซิร์ฟเวอร์: 5.6.12-log
-- รุ่นของ PHP: 5.4.12

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
(75, 5, 1),
(75, 59, 1),
(75, 63, 1),
(76, 52, 1),
(76, 82, 1),
(76, 87, 1),
(77, 10, 1),
(77, 28, 1),
(78, 52, 1),
(78, 85, 1),
(79, 49, 1),
(80, 5, 1),
(80, 38, 1),
(81, 61, 1),
(81, 62, 1),
(81, 64, 1),
(81, 65, 1),
(81, 70, 1),
(81, 71, 1),
(82, 24, 1),
(82, 26, 2),
(82, 28, 3),
(83, 51, 1),
(84, 49, 1),
(85, 9, 1),
(85, 24, 1),
(85, 45, 1),
(86, 9, 1),
(87, 29, 2),
(88, 29, 1),
(88, 40, 1),
(88, 46, 1),
(88, 52, 1),
(88, 53, 1),
(89, 42, 1),
(89, 45, 1),
(89, 46, 1),
(90, 53, 1),
(91, 28, 1),
(91, 29, 1),
(91, 45, 1),
(92, 51, 1),
(93, 10, 2),
(93, 52, 1),
(93, 90, 1),
(96, 5, 1),
(97, 5, 1),
(97, 9, 1),
(143, 5, 1),
(144, 5, 1),
(145, 5, 2),
(146, 5, 1),
(147, 1, 0),
(147, 5, 9),
(151, 5, 1),
(154, 1, 4),
(154, 5, 1),
(155, 5, 1),
(156, 5, 1),
(157, 5, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- dump ตาราง `category`
--

INSERT INTO `category` (`catid`, `description`, `ranking`) VALUES
(1, 'อาหาร', 0),
(2, 'เครื่องดื่ม', 1),
(3, 'เสื้อผ้า', 2),
(4, 'สมุนไพรที่ไม่ใช่อาหาร', 3),
(5, 'ศิลปะและของที่ระลึก', 4),
(6, 'ของใช้และของตกแต่ง', 5),
(8, 'แพ็กเกจ', 7),
(14, 'อื่นๆ', 6);

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
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(86, 1),
(87, 1),
(93, 1),
(96, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(151, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(89, 2),
(90, 2),
(91, 2),
(92, 2),
(85, 4),
(97, 4),
(88, 5);

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
  PRIMARY KEY (`memberid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- dump ตาราง `member_staff`
--

INSERT INTO `member_staff` (`memberid`, `username`, `password`, `firstname`, `lastname`, `nickname`, `phone`, `email`, `position`) VALUES
(1, 'cashier01', 'cashier01', 'Firstname', 'Lastname', 'Nick', '0888888888', 'test@test.com', 'C'),
(2, 'test', 'test', 'test', 'TT', 'T', '0888888888', 'test@test.com', 'A'),
(3, 'admin', 'admin', 'admin', 'testsystem', 'admin', '0899999999', 'test@admin.com', 'A');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=158 ;

--
-- dump ตาราง `order`
--

INSERT INTO `order` (`orderid`, `total`, `pay`, `discount`, `status`, `dateOrder`, `dateReceive`, `print`) VALUES
(75, '215.00', '300.00', '0.00', 3, '2014-02-10 22:05:49', NULL, 1),
(76, '290.00', '300.00', '0.00', 2, '2014-02-10 22:06:08', NULL, 1),
(77, '900.00', '1000.00', '0.00', 3, '2014-02-10 22:06:41', NULL, 1),
(78, '4585.00', '5000.00', '0.00', 2, '2014-02-10 22:06:58', '2014-02-20 18:14:20', 1),
(79, '550.00', '550.00', '0.00', 3, '2014-02-10 22:07:08', NULL, 1),
(80, '180.00', '200.00', '0.00', 2, '2014-02-10 22:07:54', '2014-02-20 18:10:39', 1),
(81, '675.00', '700.00', '0.00', 2, '2014-02-10 22:08:21', NULL, 1),
(82, '3120.00', '3500.00', '0.00', 2, '2014-02-10 22:08:37', '2014-02-20 17:45:30', 1),
(83, '720.00', '800.00', '0.00', 2, '2014-02-10 22:08:45', '2014-02-20 17:30:02', 1),
(84, '550.00', '550.00', '0.00', 2, '2014-02-10 22:09:01', '2014-02-18 15:13:17', 1),
(85, '3740.00', '4000.00', '0.00', 3, '2014-02-18 14:59:37', NULL, 1),
(86, '450.00', '500.00', '0.00', 2, '2014-02-20 17:34:27', NULL, 1),
(87, '1100.00', '1100.00', '0.00', 3, '2014-02-20 17:36:00', NULL, 0),
(88, '4740.00', '5000.00', '0.00', 3, '2014-02-20 18:12:07', '2014-02-20 18:14:21', 1),
(89, '6050.00', '6100.00', '0.00', 1, '2014-02-20 19:21:09', NULL, 0),
(90, '655.00', '700.00', '0.00', 1, '2014-02-20 19:21:16', NULL, 0),
(91, '3700.00', '4000.00', '0.00', 1, '2014-02-20 19:21:34', NULL, 0),
(92, '720.00', '800.00', '0.00', 1, '2014-02-20 19:21:42', NULL, 0),
(93, '1335.00', '1500.00', '0.00', 4, '2014-02-20 21:28:44', '2014-02-20 21:29:05', 0),
(96, '100.00', '100.00', '0.00', 4, '2014-02-21 08:19:07', '2014-02-21 09:39:14', 0),
(97, '550.00', '600.00', '0.00', 3, '2014-02-21 09:27:54', NULL, 0),
(143, '100.00', '100.00', '0.00', 1, '2014-02-25 20:29:31', NULL, 0),
(144, '100.00', '100.00', '0.00', 1, '2014-02-25 20:31:13', NULL, 0),
(145, '200.00', '200.00', '0.00', 1, '2014-02-26 03:33:05', NULL, 0),
(146, '100.00', '100.00', '0.00', 1, '2014-02-26 03:33:32', NULL, 0),
(147, '45.00', '100.00', '0.00', 1, '2014-02-26 03:33:54', NULL, 0),
(151, '100.00', '100.00', '0.00', 1, '2014-02-26 03:36:54', NULL, 0),
(154, '120.00', '120.00', '0.00', 1, '2014-02-26 03:38:28', NULL, 0),
(155, '100.00', '100.00', '0.00', 1, '2014-02-26 03:38:51', NULL, 0),
(156, '100.00', '100.00', '0.00', 1, '2014-02-26 03:42:45', NULL, 0),
(157, '100.00', '150.00', '0.00', 1, '2014-02-26 03:42:53', NULL, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=92 ;

--
-- dump ตาราง `product`
--

INSERT INTO `product` (`productid`, `pname`, `catid`, `pic`, `price`, `cost`, `stock`, `type`, `barcode`, `parentid`) VALUES
(1, 'ข้าวเหนียว', 1, 'ข้าวเหนียวบำรุงม้าม.jpg', '5.00', '2.00', 0, 1, NULL, NULL),
(3, 'หมูปิ้ง', 1, 'หมูปิ้ง.jpg', '30.00', '10.00', 0, 1, '', NULL),
(5, 'ไก่ย่าง', 1, '667724.jpg', '100.00', '60.00', 12, 1, '', 0),
(7, 'เสื้อม่อฮ่อม', 3, '256744.jpg', '450.00', '200.00', 55, 2, '', NULL),
(9, 'เสื้อม่อฮ่อม size m', 3, '256744.jpg', '450.00', '200.00', 51, 3, '', 7),
(10, 'เสื้อม่อฮ่อม size l', 3, '256744.jpg', '450.00', '200.00', 52, 3, '', 7),
(11, 'เสื้อม่อฮ่อม size xl', 3, '256744.jpg', '450.00', '200.00', 0, 3, '', 7),
(14, 'เสื้อพื้นเมืองเชียงใหม่ size s', 3, '137115.jpg', '550.00', '250.00', 40, 3, '', 13),
(16, 'เสื้อพื้นเมืองเชียงใหม่ size m', 3, '868469.jpg', '550.00', '250.00', 40, 3, '', 13),
(19, 'เสื้อพื้นเมืองเชียงใหม่ size l', 3, '633636.jpg', '550.00', '250.00', 38, 3, '', 13),
(20, 'เสื้อพื้นเมืองเชียงใหม่ size xl', 3, '896240.jpg', '550.00', '250.00', 44, 3, '', 13),
(21, 'กระโปรงผ้าฝ้ายพื้นเมือง สีน้ำตาล', 3, '223144.jpg', '650.00', '350.00', 30, 1, '', NULL),
(22, 'กระเป๋าชาวเขา', 6, '449493.jpg', '380.00', '200.00', 66, 1, '', NULL),
(23, 'โจงกระเบนผ้าไหม', 3, '855895.jpg', '590.00', '350.00', 80, 2, '', NULL),
(24, 'โจงกระเบนผ้าไหม size s', 3, '752044.jpg', '590.00', '350.00', 41, 3, '', 23),
(25, 'โจงกระเบนผ้าไหม size m', 3, '878753.jpg', '590.00', '350.00', 55, 3, '', 0),
(26, 'โจงกระเบนผ้าไหม size l', 3, '55938.jpg', '590.00', '350.00', 38, 3, '', 23),
(27, 'โจงกระเบนผ้าไหม size xl', 3, '200653.jpg', '590.00', '350.00', 35, 3, '', 23),
(28, 'โจงกระเบนลายไทย', 3, '458435.jpg', '450.00', '300.00', 22, 1, '', NULL),
(29, 'โจงกระเบนทอง', 3, '34912.jpg', '550.00', '380.00', 37, 1, '', NULL),
(38, 'เมี่ยงคำ', 1, '550811.jpg', '80.00', '50.00', 98, 1, '', NULL),
(40, 'เครื่องเคลือบดินเผา', 5, '963348.jpg', '750.00', '550.00', 78, 1, '', NULL),
(42, 'เครื่องปั้นดินเผาลายไทย', 5, '522338.jpg', '650.00', '450.00', 54, 1, '', NULL),
(45, 'ชุดเครื่องปั้นดินเผา', 5, '403381.jpg', '2700.00', '2200.00', 57, 1, '', NULL),
(46, 'รูปปั้นหญิงสาวตั้งโชว์', 5, '777648.jpg', '2700.00', '2400.00', 12, 1, '', NULL),
(47, 'กาดินเผา', 5, '342376.jpg', '450.00', '350.00', 25, 1, '', NULL),
(49, 'โอ่งดินเผามีลาย', 5, '234222.jpg', '550.00', '390.00', 77, 1, '', NULL),
(51, 'โอ่งเผาลายช้าง', 5, '24597.jpg', '720.00', '550.00', 42, 1, '', NULL),
(52, 'ตู้ไปรษณีย์', 6, '547180.jpg', '85.00', '70.00', 96, 1, '', NULL),
(53, ' เครื่องดื่มรังนกสำเร็จรูปตราฮ่องเต้(ของขวัญ)', 2, '113128.jpg', '655.00', '420.00', 98, 1, '', NULL),
(54, 'น้ำเสาวรส', 2, '660888.jpg', '70.00', '60.00', 299, 1, '', NULL),
(55, 'ไวน์ ภูอมร', 2, '38604.jpg', '350.00', '100.00', 100, 1, '', NULL),
(57, 'สไบสีแดง', 3, '43823.jpg', '250.00', '150.00', 45, 1, '', NULL),
(58, 'สไบสีขาว', 3, '408386.jpeg', '299.00', '150.00', 55, 1, '', NULL),
(59, 'ชุดลูกชุป', 1, '930908.jpg', '60.00', '35.00', 159, 1, '', NULL),
(60, 'ชุดขนมชั้น', 1, '547088.jpg', '55.00', '30.00', 85, 1, '', NULL),
(61, 'ชุดฝอยทอง', 1, '220733.jpg', '45.00', '30.00', 98, 1, '', NULL),
(62, 'ชุดทองหยอด', 1, '160949.jpg', '50.00', '30.00', 89, 1, '', NULL),
(63, 'ชุดทองม้วน', 1, '46081.jpg', '55.00', '30.00', 55, 1, '', NULL),
(64, 'กล้วยอบเนย', 1, '480224.jpg', '45.00', '30.00', 59, 1, '', NULL),
(65, 'กุนเชียงปลาสมุนไพร', 1, '846221.jpg', '45.00', '30.00', 41, 1, '', NULL),
(67, ' เปลือกไข่วิจิตรศิลป์ ', 5, '50170.jpg', '550.00', '300.00', 78, 1, '', NULL),
(68, 'กล้วยม้วนอบเนย', 1, '842041.jpg', '40.00', '25.00', 44, 1, '', NULL),
(70, 'ถั่วทอดสมุนไพร', 1, '215026.jpg', '40.00', '29.00', 74, 1, '', NULL),
(71, 'เครื่องปั้นดินเผาชนิดไม่เคลือบ', 6, '625244.jpg', '450.00', '300.00', 54, 1, '', NULL),
(72, 'โลชั่นกันยุงสมุนไพรตะไคร้หอม', 4, '974304.jpg', '30.00', '15.00', 69, 1, '', NULL),
(73, 'หัวโขน', 5, '403350.jpg', '550.00', '350.00', 30, 1, '', NULL),
(74, 'ไข่นกกระทาแปรรูป', 1, '451354.jpg', '40.00', '29.00', 33, 1, '', NULL),
(75, 'กล้วยเบรคแตก', 1, '230682.jpg', '30.00', '17.00', 59, 1, '', NULL),
(76, 'กล้วยแผ่นอบม้วน', 1, '320312.jpg', '25.00', '12.00', 70, 1, '', NULL),
(77, 'น้ำปลาปลาสร้อย', 1, '470916.jpg', '18.00', '10.00', 55, 1, '', NULL),
(78, 'น้ำผึ้งดอกทานตะวัน ', 1, '482147.jpg', '65.00', '45.00', 77, 1, '', NULL),
(79, 'ปลาช่อนแดดเดียว', 1, '786743.jpg', '50.00', '30.00', 45, 1, '', NULL),
(80, 'เปลือกส้มโอเชื่อม', 1, '657867.jpg', '30.00', '17.00', 56, 1, '', NULL),
(81, 'ไข่เค็มพอกดินภูเขาสารพัดดี ', 1, '446411.jpg', '50.00', '35.00', 78, 1, '', NULL),
(82, 'แชมพูสมุนไพรว่านหางจระเข้ผสมอัญชัญ', 4, '381164.jpg', '35.00', '20.00', 63, 1, '', NULL),
(83, 'ผลิตภัณฑ์จักสานเชือกมัดฟาง ', 6, '819244.jpg', '300.00', '185.00', 77, 1, '', NULL),
(84, 'เกษตรซอสพริก ', 1, '346252.jpg', '20.00', '12.00', 0, 1, '', NULL),
(85, 'เรือจำลองสักทอง เรือนไทยประดิษฐ์จากกระดาษ ', 5, '973052.jpg', '4500.00', '3000.00', 49, 1, '', NULL),
(86, 'น้ำพริกแกงเผ็ด', 1, '17425.jpg', '12.00', '8.00', 70, 1, '', NULL),
(87, 'ทุเรียนทอด', 1, '972290.jpg', '170.00', '140.00', 91, 1, '', NULL),
(88, 'ชมพู่สามรส', 1, '361389.jpg', '120.00', '75.00', 54, 1, '', NULL),
(90, 'โจงกระเบนผ้าไหม size XXL', 6, '477966.jpg', '350.00', '590.00', 6, 3, '', 23),
(91, 'กางเกงมวยไทย', 3, '112030.jpg', '100.00', '80.00', 10, 1, '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- dump ตาราง `warehouse`
--

INSERT INTO `warehouse` (`warehouseid`, `wname`, `address`, `phone`, `email`, `website`) VALUES
(1, 'บริษัท ห้างหุ้นส่วน ก จำกัด', 'กรุงเทพ 10330', '088-222222', '', ''),
(3, 'บริษัท สหกรณ์จุฬาลงกรณ์มหาวิทยาลัย จำกัด', 'จุฬาลงกรณ์', '088-123456', '', ''),
(4, 'บริษัท กอ ไก่ ฮ่งฮวด จำกัด', '149/11 จ.เชียงใหม่', '087-456789', 'Korkai@gmail.com', 'http://www.korkai.com');

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
(3, 1),
(5, 1),
(7, 3),
(10, 1),
(38, 4),
(40, 1),
(42, 1),
(45, 1),
(46, 1),
(47, 1),
(49, 1),
(51, 1),
(52, 3),
(53, 3),
(54, 1),
(55, 3),
(57, 1),
(58, 3),
(59, 3),
(60, 3),
(61, 3),
(62, 3),
(63, 3),
(64, 3),
(65, 3),
(67, 3),
(68, 3),
(70, 3),
(71, 4),
(72, 3),
(73, 1),
(74, 3),
(75, 3),
(76, 3),
(77, 3),
(78, 3),
(79, 3),
(80, 3),
(81, 3),
(82, 3),
(83, 3),
(84, 3),
(85, 3),
(86, 3),
(87, 3),
(88, 3),
(90, 4),
(91, 3);

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

 
