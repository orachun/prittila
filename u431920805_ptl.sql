
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 10, 2014 at 01:00 PM
-- Server version: 5.1.69
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u431920805_ptl`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `product_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`product_cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`product_cat_id`, `name`) VALUES
(1, 'ชุด dress'),
(2, 'เสื้อ'),
(3, 'กางเกง'),
(4, 'กระโปรง'),
(5, 'กระเป๋า'),
(9, 'ชุดว่ายน้ำ'),
(10, 'เสื้อผ้าผู้ชาย');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('61bd0827addc3c7a1b303e0dea90843a', '110.164.80.23', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.137 Safari/537.36', 1406016949, ''),
('070b44dc0fe924e44373ddd5e471bf62', '110.164.80.23', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.137 Safari/537.36', 1406016943, ''),
('af118b3a00f849b04fe42123185a5be1', '110.164.80.23', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.137 Safari/537.36', 1406016939, ''),
('c60c26ccbd7ff26ad6060ed113eeacde', '61.90.65.237', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 1406382498, ''),
('e985ab2261c1a7f5f89240bd6bd653ad', '61.90.65.237', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 1406382504, ''),
('c1eeb25a324bec704930debea54eed57', '199.30.228.156', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/534.34 (KHTML, like Gecko) Qt/4.8.4 Safari/534.34', 1406360180, ''),
('6e167d396a83f2297308741b92b426a0', '199.30.228.156', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/534.34 (KHTML, like Gecko) Qt/4.8.4 Safari/534.34', 1406360173, ''),
('39082abbd4844413f5fba69effa229bb', '61.90.94.194', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 1406292216, ''),
('3141cef7965950c59ae274d7c8ce7b04', '110.164.80.23', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.137 Safari/537.36', 1406016952, ''),
('4f3f8a7397e126dbdd117cfce6305e21', '61.90.94.194', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 1406292206, ''),
('fb5d117d6982f5ea90c589f09e5540d3', '110.164.80.23', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.137 Safari/537.36', 1406016950, '');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `color_en` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `color_th` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`color_en`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_en`, `color_th`) VALUES
('black', 'ดำ'),
('blue', 'นำ้เงิน'),
('brown', 'น้ำตาล'),
('gold', 'ทอง'),
('gray', 'เทา'),
('green', 'เขียว'),
('lightblue', 'ฟ้า'),
('pink', 'ชมพู'),
('purple', 'ม่วง'),
('red', 'แดง'),
('white', 'ขาว'),
('yellow', 'เหลือง'),
('orange', 'ส้ม');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addr` mediumtext COLLATE utf8_unicode_ci,
  `tel` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registered_date` date DEFAULT NULL,
  `receive_update` tinyint(1) DEFAULT NULL COMMENT '1=Y, 0=N',
  `pass` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `fullname`, `addr`, `tel`, `email`, `registered_date`, `receive_update`, `pass`) VALUES
(2, 'orachun udo', '123kow daaozzzzzaa', '1234567890', 'orachun.chun@gmail.com', '2013-08-25', NULL, '81dc9bdb52d04dc20036dbd8313ed055'),
(3, NULL, '', '', '', '2014-09-10', NULL, NULL),
(4, NULL, 'b', '123', 'ora@a.com', '2014-09-10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_coupon`
--

CREATE TABLE IF NOT EXISTS `customer_coupon` (
  `customer_coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `received_amount` int(11) DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  PRIMARY KEY (`customer_coupon_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE IF NOT EXISTS `customer_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `display_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `customer_id` int(11) DEFAULT NULL,
  `store_order_id` int(11) DEFAULT NULL,
  `customer_coupon_id` int(11) DEFAULT NULL,
  `net_total` decimal(10,2) DEFAULT NULL,
  `receiver_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_addr` mediumtext COLLATE utf8_unicode_ci,
  `ordered_datetime` datetime DEFAULT NULL,
  `delivery_type` tinyint(4) DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '''W'' = wait for payment, ''P'' = payment is informed, ''C'' = payment is checked, ''D''=delivered',
  `remark` mediumtext COLLATE utf8_unicode_ci,
  `delivered_date` date DEFAULT NULL,
  `tracking_no` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_note` text COLLATE utf8_unicode_ci,
  `store_note` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `display_id`, `customer_id`, `store_order_id`, `customer_coupon_id`, `net_total`, `receiver_name`, `delivery_addr`, `ordered_datetime`, `delivery_type`, `status`, `remark`, `delivered_date`, `tracking_no`, `customer_note`, `store_note`) VALUES
(1, 'D0910-1-3', 3, NULL, -1, '330.00', '', '', '2014-09-10 12:55:58', 3, 'W', NULL, NULL, NULL, NULL, NULL),
(2, 'D0910-2-4', 4, NULL, -1, '330.00', 'a', 'b', '2014-09-10 12:57:07', 3, 'W', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_type`
--

CREATE TABLE IF NOT EXISTS `delivery_type` (
  `delivery_type_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_cost` decimal(10,0) DEFAULT NULL,
  `free_threshold` decimal(10,0) DEFAULT NULL COMMENT 'no delivering cost if exceed this value',
  `is_discarded` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`delivery_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `delivery_type`
--

INSERT INTO `delivery_type` (`delivery_type_id`, `name`, `unit_cost`, `free_threshold`, `is_discarded`) VALUES
(3, 'EMS', '50', '3', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `discount_coupon`
--

CREATE TABLE IF NOT EXISTS `discount_coupon` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_type` char(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '''P'' = percent discount, ''F'' = fixed discount',
  `coupon_type` char(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(REMOVED) ''U'' = User coupon, ''S''= Store coupon',
  `amount` decimal(10,2) DEFAULT NULL,
  `amount_threshold` decimal(10,2) DEFAULT NULL,
  `valid_day` tinyint(4) DEFAULT NULL COMMENT 'number of days before expired',
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT '''A''=active, ''I''=inactive',
  PRIMARY KEY (`coupon_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `size` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 's,m,l,xl',
  `color` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `unit_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`order_item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `product_id`, `order_id`, `size`, `color`, `amount`, `unit_price`) VALUES
(1, 28, 1, 'M', 'brown', 1, '280.00'),
(2, 28, 2, 'M', 'brown', 1, '280.00');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `edited_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link_name` (`link_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `link_name`, `name`, `content`, `edited_datetime`) VALUES
(3, 'conditions', 'ข้อตกลงและเงื่อนไขการสั่งซื้อสินค้า', '<p>ขอความกรุณาลูกค้าอ่านเพื่อทำความเข้าใจกข้อตกลงและเงื่อนไขการสั่งซื้อสินค้านะคะ เพื่อไม่ให้เกิดปัญหาขึ้นภายหลังค่ะ</p>\n<p>1. สินค้า Pre-order สามารถสั่งซื้อได้ตั้งแต่ 1 ตัวค่ะ ไม่มีขั้นต่ำ สั่งซื้อกี่ชิ้นก็ได้</p>\n<p>2. ทางร้านเป็นตัวกลางในการสั่งเท่านั้นนะคะ ไม่เคยได้เห็นและสัมผัสจริง จึงไม่สามารถตรวจสอบสินค้าให้ก่อนได้ ทางร้านทำได้แค่เพียงสั่งสินค้าตามที่ลูกค้าสั่งมาก&nbsp;ดังนั้นเราไม่รับเปลี่ยนหรือคืนสินค้าทุกกรณีนะคะ ยกเว้นกรณีเป็นความผิดพลาดจากร้าน เนื่องจาก&nbsp;ผิดขนาด ผิดสีโดยสิ้นเชิง (ยกเว้นสีเพี้ยน) สามารถเปลี่ยนหรือขอคืนเงินได้ค่ะ โดยสินค้าต้องคงสภาพเดิม ไม่แกะป้ายออก</p>\n<p>3.ราคาสินค้าที่แสดงไม่รวมค่าจัดส่งในประเทศนะคะ ค่าจัดส่งจะแสดงอีกครั้งขณะทำการส่งคำสั่งซื้อสินค้าค่ะ</p>\n<p>4.ทางร้านไม่สามารถยืนยันได้ว่าจะได้สินค้าครบทุกชิ้นหรือไม่ เพราะบางครั้งทาง Supplier&nbsp;ในต่างประเทศไม่ได้ Update Stock ทำให้ร้านค้าคิดว่าสินค้ายังมีอยู่จริง พอได้รับสินค้าจึงไม่ได้ครบตามที่สั่ง ลูกค้าที่ได้รับสินค้าไม่ครบ ทางร้านค้าจะคืนเงินให้ทันทีค่ะ</p>\n<p>5. ทางร้านขอรับเฉพาะลูกค้าที่สามารถรอได้นะคะ เพราะระยะเวลาที่สินค้าจะถึงลูกค้าคือ 20- 25 วัน หรืออาจเร็วกว่านั้น เพราะขอต้องส่งจากต่างประเทศมาทางเรือ ทำให้อาจมีช้าบ้าง ต้องขออภัยไว้ด้วยนะคะ และขอความร่วมมือก่อนสั่งสินค้าควรตัดสินใจให้ดีรอบคอบ ก่อนตัดสินใจสั่งซื้อนะคะ</p>\n<p>6. กำหนดการส่งของที่แจ้งล่วงหน้าไว้ อาจมีการเปลี่ยนแปลง เนื่องจากการสั่งสินค้าจากต่างประเทศ อาจะมีความคลาดเคลื่อนในเรื่องของระยะเวลา ด้วยสาเหตุที่อยู่เหนือการควบคุม ดังนั้นทางร้านจะขอรับเฉพาะลูกค้าที่สามารถยอมรับกับข้อตกลงเหล่านี้ได้</p>\n<p>&nbsp;</p>', '0000-00-00 00:00:00'),
(4, 'order_info', 'วิธีการสั่งซื้อและชำระเงิน', '<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n<p style="text-align: left;">1. เลือกชมสินค้า เลือกขนาด สี จำนวน แล้วคลิกปุ่ม "ซื้อ" ระบบจะแจ้งว่าได้เพิ่มรายการสินค้าแล้ว</p>\n<p>2. หากเลือกซื้อสินค้าครบทุกชิ้นแล้ว ให้คลิกที่เมนู Order ด้านขวา</p>\n<p>3. ในส่วนนี้หากต้องการแก้ไขจำนวนสินค้าที่ซื้อ ให้พิมพ์ตัวเลขลงในกล่องข้อความข้างรูปสินค้าที่เลือก แล้วคลิกปุ่มแก้ไขจำนวน(รูปดินสอ) หากต้องการลบสินค้าที่เลือก คลิกที่ปุ่มลบ(รูปกากบาท)</p>\n<p>4. คลิกที่ปุ่ม "ส่งคำสั่งซื้อสินค้า"</p>\n<p>5. ตรวจสอบรายการสินค้า แล้วคลิกปุ่ม "ต่อไป"</p>\n<p>6. เลือกคูปองส่วนลดที่ต้องการใช้ (ถ้ามี) หรือทำการลงชื่อเข้าใช้เพื่อเลือกใช้คูปอง&nbsp;หลังจากนั้น เลือกวิธีการจัดส่งสินค้า แล้วคลิกปุ่ม "ต่อไป"</p>\n<p><span style="line-height: 1.6em;">7. กรอกรายละเอียดผู้รับสินค้า ตรวจสอบให้ถูกต้องและคลิกปุ่ม "ต่อไป"</span></p>\n<p>8. ตรวจสอบรายละเอียดให้ถูกต้อง หากไม่ถูกต้องให้คลิกปุ่ม "กลับ" เพื่อกลับไปแก้ไข หากถูกต้องแล้ว ให้คลิก "ยอมรับเงื่อนไขและยืนยันคำสั่งซื้อสินค้า"</p>\n<p>9. ระบบจะแสดงใบสั่งซื้อสินค้า และส่งอีเมล์ไปยังอีเมล์แอดเดรสที่ใส่ไว้ในขั้นตอนที่ 7.</p>\n<p>10. โอนเงินชำระค่าสินค้า รายละเอียดการชำระเงินดูได้ที่&nbsp;<a href="../others/page/payment_method">รายละเอียดการชำระเงิน</a>&nbsp;</p>\n<p>11. เมื่อโอนเงินชำระค่าสินค้าแล้ว ให้คลิกที่เมนู Payment ด้านขวา กรอกรายละเอียดการชำระเงินและไฟล์หลักฐานการโอนเงิน แล้วคลิกปุ่ม "แจ้งชำระเงิน" เป็นอันเสร็จสิ้น</p>\n<p>12. หลังจากทางร้านได้รับสินค้า จะทำการจัดส่งให้ตามที่อยู่ที่กรอกไว้ให้เร็วที่สุด</p>\n</body>\n</html>', '0000-00-00 00:00:00'),
(5, 'payment_method', 'รายละเอียดการชำระเงิน', '<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n<p style="text-align: center;"><span style="font-size: large;"><strong><span style="text-decoration: underline;">&nbsp;</span></strong></span></p>\n<p>......</p>\n</body>\n</html>', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_inform`
--

CREATE TABLE IF NOT EXISTS `payment_inform` (
  `order_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `inform_date` datetime DEFAULT NULL,
  `paid_date` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT '0',
  `display_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` mediumtext COLLATE utf8_unicode_ci,
  `cost` decimal(10,2) DEFAULT '0.00' COMMENT 'ราคาทุน',
  `unit_price` decimal(10,2) DEFAULT NULL,
  `price_before_sale` decimal(10,2) DEFAULT NULL,
  `added_date` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `supplier_product_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT 'NULL',
  `supplier_product_url` varchar(256) COLLATE utf8_unicode_ci DEFAULT '',
  `views` int(11) DEFAULT '0',
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `cat_id`, `display_id`, `name`, `desc`, `cost`, `unit_price`, `price_before_sale`, `added_date`, `supplier_id`, `supplier_product_code`, `supplier_product_url`, `views`, `status`) VALUES
(28, 1, 'P0910-28', 'ชุดกระโปรงลายเสือเอวจั๊ม', 'Size,	Bust,	Length	 \nM,	78cm~86cm,	78cm	\nL,	83cm~90cm,	81cm	\nXL,	90cm~96cm,	83cm	', '110.00', '280.00', '-1.00', '2014-09-10', 0, 'NULL', 'http://item.taobao.com/item.htm?spm=a1z10.1.w4004-8331749902.14.0aTNZ0&id=39155771273', 40, 'A'),
(27, 1, 'P0910-27', 'ชุดกระโปรงลายเสือเอวจั๊ม', '', '110.00', '280.00', '-1.00', '2014-09-10', 0, 'NULL', 'http://item.taobao.com/item.htm?spm=a1z10.1.w4004-8331749902.14.0aTNZ0&id=39155771273', 2, 'A'),
(26, 1, 'P0910-26', 'ชุดกระโปรงลายเสือเอวจั๊ม', '', '110.00', '280.00', '-1.00', '2014-09-10', 0, 'NULL', 'http://item.taobao.com/item.htm?spm=a1z10.1.w4004-8331749902.14.0aTNZ0&id=39155771273', 3, 'A'),
(25, 1, 'P0910-25', 'ชุดกระโปรงลายเสือเอวจั๊ม', '', '110.00', '280.00', '-1.00', '2014-09-10', 0, 'NULL', 'http://item.taobao.com/item.htm?spm=a1z10.1.w4004-8331749902.14.0aTNZ0&id=39155771273', 7, 'A'),
(24, 1, 'P0910-24', 'ชุดกระโปรงลายเสือเอวจั้ม', '', '110.00', '280.00', '-1.00', '2014-09-10', 0, 'NULL', 'http://item.taobao.com/item.htm?spm=a1z10.1.w4004-8331749902.14.0aTNZ0&id=39155771273', 0, 'A'),
(23, 1, 'P0910-23', 'ชุดกระโปรงลายเสือเอวจั้ม', '', '110.00', '280.00', '-1.00', '2014-09-10', 0, 'NULL', 'http://item.taobao.com/item.htm?spm=a1z10.1.w4004-8331749902.14.0aTNZ0&id=39155771273', 0, 'A'),
(22, 1, 'P0910-22', 'ชุดกระโปรงลายเสือเอวจั้ม', '', '110.00', '280.00', '-1.00', '2014-09-10', 0, 'NULL', 'http://item.taobao.com/item.htm?spm=a1z10.1.w4004-8331749902.14.0aTNZ0&id=39155771273', 0, 'A'),
(19, 0, 'P0910-19', '0', '0', '0.00', '0.00', '-1.00', '2014-09-10', 0, 'NULL', '0', 0, 'A'),
(20, 0, 'P0910-20', '0', '0', '0.00', '0.00', '-1.00', '2014-09-10', 0, 'NULL', '0', 0, 'A'),
(21, 1, 'P0910-21', 'ชุดกระโปรงลายเสือเอวจั้ม', '', '110.00', '280.00', '-1.00', '2014-09-10', 0, 'NULL', 'http://item.taobao.com/item.htm?spm=a1z10.1.w4004-8331749902.14.0aTNZ0&id=39155771273', 0, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

CREATE TABLE IF NOT EXISTS `product_cat` (
  `product_id` int(11) NOT NULL,
  `product_cat_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`product_cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_property`
--

CREATE TABLE IF NOT EXISTS `product_property` (
  `prop_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`prop_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `product_property`
--

INSERT INTO `product_property` (`prop_id`, `product_id`, `key`, `value`, `value2`, `value3`) VALUES
(1, 21, 'size', 'M', NULL, NULL),
(2, 21, 'size', 'L', NULL, NULL),
(3, 21, 'size', 'XL', NULL, NULL),
(4, 21, 'color', 'brown', 'น้ำตาล', NULL),
(5, 22, 'size', 'M', NULL, NULL),
(6, 22, 'size', 'L', NULL, NULL),
(7, 22, 'size', 'XL', NULL, NULL),
(8, 22, 'color', 'brown', 'น้ำตาล', NULL),
(9, 23, 'size', 'M', NULL, NULL),
(10, 23, 'size', 'L', NULL, NULL),
(11, 23, 'size', 'XL', NULL, NULL),
(12, 23, 'color', 'brown', 'น้ำตาล', NULL),
(13, 24, 'size', 'M', NULL, NULL),
(14, 24, 'size', 'L', NULL, NULL),
(15, 24, 'size', 'XL', NULL, NULL),
(16, 24, 'color', 'brown', 'น้ำตาล', NULL),
(17, 25, 'size', 'M', NULL, NULL),
(18, 25, 'size', 'L', NULL, NULL),
(19, 25, 'size', 'XL', NULL, NULL),
(20, 25, 'color', 'brown', 'น้ำตาล', NULL),
(21, 26, 'size', 'M', NULL, NULL),
(22, 26, 'size', 'L', NULL, NULL),
(23, 26, 'size', 'XL', NULL, NULL),
(24, 26, 'color', 'brown', 'น้ำตาล', NULL),
(25, 27, 'size', 'M', NULL, NULL),
(26, 27, 'size', 'L', NULL, NULL),
(27, 27, 'size', 'XL', NULL, NULL),
(28, 27, 'color', 'brown', 'น้ำตาล', NULL),
(29, 28, 'size', 'M', NULL, NULL),
(30, 28, 'size', 'L', NULL, NULL),
(31, 28, 'size', 'XL', NULL, NULL),
(32, 28, 'color', 'brown', 'น้ำตาล', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE IF NOT EXISTS `product_tag` (
  `product_tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `tag` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`product_tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='sale, featured, etc.' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE IF NOT EXISTS `slideshow` (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`slide_id`, `img`, `link`) VALUES
(5, 'uploads/slides/521f72be7d70c96205114x4z]9(s[c0mHulutech-Banner-Application.jpg', 'index.html'),
(6, 'uploads/slides/521f72d9d64cd61131795x4z]9(s[c0mJob_Fair_banner_by_javachipdoodle.jpg', 'index.php/product/detail/37'),
(8, 'uploads/slides/52d51f1fab40190611226(][)Screenshot from 2014-01-03 12:59:50.png', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `store_order`
--

CREATE TABLE IF NOT EXISTS `store_order` (
  `store_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `close_date` date DEFAULT NULL COMMENT 'วันที่ปิดรับ order',
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(REMOVED!)''C''=ปิดรับ order,  ''O''= เปิดรับอยู่, ''D''=ส่งของแล้ว',
  PRIMARY KEY (`store_order_id`),
  UNIQUE KEY `close_date` (`close_date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `store_order`
--

INSERT INTO `store_order` (`store_order_id`, `close_date`, `status`) VALUES
(1, '2014-02-01', NULL),
(2, '2014-02-16', NULL),
(3, '2014-03-01', NULL),
(4, '2014-03-16', NULL),
(5, '2014-04-01', NULL),
(6, '2014-04-16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `name`, `url`, `note`) VALUES
(24, 'http://magic-g.taobao.com/', 'http://magic-g.taobao.com/', '<img src="http://pics.taobaocdn.com/newrank/s_cap_4.gif" border="0" align="absmiddle" class="rank">'),
(25, 'http://dj2007.taobao.com', 'http://dj2007.taobao.com', '<img class="rank" border="0" align="absmiddle" src="http://pics.taobaocdn.com/newrank/s_crown_2.gif">'),
(26, 'http://tiantian666999.taobao.com', 'http://tiantian666999.taobao.com/', '<img class="rank" border="0" align="absmiddle" src="http://pics.taobaocdn.com/newrank/s_cap_5.gif">'),
(27, 'http://88208.taobao.com/', 'http://88208.taobao.com/', '<img class="rank" border="0" align="absmiddle" src="http://pics.taobaocdn.com/newrank/s_crown_2.gif">'),
(28, 'http://momobag.taobao.com/', 'http://momobag.taobao.com/', '(bag)<img class="rank" border="0" align="absmiddle" src="http://pics.taobaocdn.com/newrank/s_crown_4.gif">'),
(29, 'http://tamtambeach.taobao.com/', 'http://tamtambeach.taobao.com/', '(swimware)<img class="rank" border="0" align="absmiddle" src="http://pics.taobaocdn.com/newrank/s_cap_4.gif">'),
(30, 'http://catworld.taobao.com', 'http://catworld.taobao.com', '<img class="rank" border="0" align="absmiddle" src="http://pics.taobaocdn.com/newrank/s_crown_3.gif">'),
(31, 'http://fashion-bay.taobao.com/', 'http://fashion-bay.taobao.com/', '<img class="rank" border="0" align="absmiddle" src="http://pics.taobaocdn.com/newrank/s_blue_5.gif">');

-- --------------------------------------------------------

--
-- Table structure for table `view_sql`
--

CREATE TABLE IF NOT EXISTS `view_sql` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sql` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`(191))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `view_sql`
--

INSERT INTO `view_sql` (`id`, `name`, `sql`) VALUES
(1, '_product_info', 'SELECT p.product_id, display_id, p.name,  `desc` , unit_price, price_before_sale, added_date, views, p.cat_id, c.name AS category\r\nFROM product p\r\nJOIN category c ON c.product_cat_id = p.cat_id\r\nWHERE p.status = "A"'),
(2, '_coupon_usage', 'SELECT cc.customer_id, cc.customer_coupon_id, cc.coupon_id, cc.received_amount AS received, COUNT( co.order_id ) AS used, cc.received_amount - COUNT( co.order_id ) AS remain, received_date, expired_date\nFROM customer_order co\nRIGHT JOIN customer_coupon cc ON co.customer_coupon_id = cc.customer_coupon_id\nGROUP BY cc.customer_coupon_id'),
(3, '_customer_coupon_info', 'SELECT cc.customer_coupon_id, cc.customer_id, dc.coupon_id, dc.discount_type, coupon_type, amount, amount_threshold\nFROM customer_coupon cc\nJOIN discount_coupon dc ON cc.coupon_id = dc.coupon_id'),
(4, '_customer_coupon_display', 'SELECT customer_id,\r\ncustomer_coupon_id,\r\ndc.coupon_id,\r\nreceived,\r\nused,\r\nremain,\r\nreceived_date,\r\nexpired_date,\r\nname,\r\n`desc`,\r\ndiscount_type,\r\ncoupon_type,\r\namount,\r\namount_threshold\r\n\r\nFROM `_coupon_usage` cu join discount_coupon dc on cu.coupon_id = dc.coupon_id'),
(5, '_customer_ordered_item', 'SELECT p.display_id, p.name, i . * \r\nFROM product p\r\nJOIN  `order_item` i ON p.product_id = i.product_id'),
(6, '_sold_product', 'SELECT p . * , IFNULL( SUM( amount ) , 0 ) AS bought\r\nFROM order_item oi\r\nRIGHT JOIN product p ON oi.product_id = p.product_id\r\nGROUP BY p.product_id'),
(7, '_customer_order', 'SELECT co . * , pi.paid_date\r\nFROM  `customer_order` co\r\nLEFT JOIN payment_inform pi ON co.order_id = pi.order_id'),
(8, '_store_order', 'select o.product_id, o.size, o.color, o.amount, p.supplier_product_url from\n(\nSELECT product_id, size, color, sum(oi.amount) as amount\nFROM customer_order co \njoin order_item oi on co.order_id = oi.order_id\nwhere co.status = ''C''\ngroup by oi.product_id, oi.size, oi.color\n) o\njoin product p on o.product_id = p.product_id');

-- --------------------------------------------------------

--
-- Stand-in structure for view `_coupon_usage`
--
CREATE TABLE IF NOT EXISTS `_coupon_usage` (
`customer_id` int(11)
,`customer_coupon_id` int(11)
,`coupon_id` int(11)
,`received` int(11)
,`used` bigint(21)
,`remain` bigint(22)
,`received_date` date
,`expired_date` date
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_customer_coupon_display`
--
CREATE TABLE IF NOT EXISTS `_customer_coupon_display` (
`customer_id` int(11)
,`customer_coupon_id` int(11)
,`coupon_id` int(11)
,`received` int(11)
,`used` bigint(21)
,`remain` bigint(22)
,`received_date` date
,`expired_date` date
,`name` varchar(255)
,`desc` varchar(255)
,`discount_type` char(1)
,`coupon_type` char(1)
,`amount` decimal(10,2)
,`amount_threshold` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_customer_coupon_info`
--
CREATE TABLE IF NOT EXISTS `_customer_coupon_info` (
`customer_coupon_id` int(11)
,`customer_id` int(11)
,`coupon_id` int(11)
,`discount_type` char(1)
,`coupon_type` char(1)
,`amount` decimal(10,2)
,`amount_threshold` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_customer_order`
--
CREATE TABLE IF NOT EXISTS `_customer_order` (
`order_id` int(11)
,`display_id` varchar(32)
,`customer_id` int(11)
,`store_order_id` int(11)
,`customer_coupon_id` int(11)
,`net_total` decimal(10,2)
,`receiver_name` varchar(255)
,`delivery_addr` mediumtext
,`ordered_datetime` datetime
,`delivery_type` tinyint(4)
,`status` char(1)
,`remark` mediumtext
,`delivered_date` date
,`tracking_no` varchar(32)
,`paid_date` datetime
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_customer_ordered_item`
--
CREATE TABLE IF NOT EXISTS `_customer_ordered_item` (
`display_id` varchar(32)
,`name` varchar(256)
,`order_item_id` int(11)
,`product_id` int(11)
,`order_id` int(11)
,`size` varchar(3)
,`color` varchar(15)
,`amount` int(11)
,`unit_price` decimal(10,2)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_product_info`
--
CREATE TABLE IF NOT EXISTS `_product_info` (
`product_id` int(11)
,`display_id` varchar(32)
,`name` varchar(256)
,`desc` mediumtext
,`unit_price` decimal(10,2)
,`price_before_sale` decimal(10,2)
,`added_date` date
,`views` int(11)
,`cat_id` int(11)
,`category` varchar(255)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_sold_product`
--
CREATE TABLE IF NOT EXISTS `_sold_product` (
`product_id` int(11)
,`cat_id` int(11)
,`display_id` varchar(32)
,`name` varchar(256)
,`desc` mediumtext
,`cost` decimal(10,2)
,`unit_price` decimal(10,2)
,`price_before_sale` decimal(10,2)
,`added_date` date
,`supplier_id` int(11)
,`supplier_product_code` varchar(32)
,`supplier_product_url` varchar(256)
,`views` int(11)
,`status` char(1)
,`bought` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_unordered_store_items`
--
CREATE TABLE IF NOT EXISTS `_unordered_store_items` (
`product_id` int(11)
,`size` varchar(3)
,`color` varchar(15)
,`amount` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `_unordered_store_product`
--
CREATE TABLE IF NOT EXISTS `_unordered_store_product` (
`product_id` int(11)
,`size` varchar(3)
,`color` varchar(15)
,`amount` decimal(32,0)
,`supplier_product_url` varchar(256)
);
-- --------------------------------------------------------

--
-- Structure for view `_coupon_usage`
--
DROP TABLE IF EXISTS `_coupon_usage`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u431920805_ptl`@`localhost` SQL SECURITY DEFINER VIEW `_coupon_usage` AS select `cc`.`customer_id` AS `customer_id`,`cc`.`customer_coupon_id` AS `customer_coupon_id`,`cc`.`coupon_id` AS `coupon_id`,`cc`.`received_amount` AS `received`,count(`co`.`order_id`) AS `used`,(`cc`.`received_amount` - count(`co`.`order_id`)) AS `remain`,`cc`.`received_date` AS `received_date`,`cc`.`expired_date` AS `expired_date` from (`customer_coupon` `cc` left join `customer_order` `co` on((`co`.`customer_coupon_id` = `cc`.`customer_coupon_id`))) group by `cc`.`customer_coupon_id`;

-- --------------------------------------------------------

--
-- Structure for view `_customer_coupon_display`
--
DROP TABLE IF EXISTS `_customer_coupon_display`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u431920805_ptl`@`localhost` SQL SECURITY DEFINER VIEW `_customer_coupon_display` AS select `cu`.`customer_id` AS `customer_id`,`cu`.`customer_coupon_id` AS `customer_coupon_id`,`dc`.`coupon_id` AS `coupon_id`,`cu`.`received` AS `received`,`cu`.`used` AS `used`,`cu`.`remain` AS `remain`,`cu`.`received_date` AS `received_date`,`cu`.`expired_date` AS `expired_date`,`dc`.`name` AS `name`,`dc`.`desc` AS `desc`,`dc`.`discount_type` AS `discount_type`,`dc`.`coupon_type` AS `coupon_type`,`dc`.`amount` AS `amount`,`dc`.`amount_threshold` AS `amount_threshold` from (`_coupon_usage` `cu` join `discount_coupon` `dc` on((`cu`.`coupon_id` = `dc`.`coupon_id`)));

-- --------------------------------------------------------

--
-- Structure for view `_customer_coupon_info`
--
DROP TABLE IF EXISTS `_customer_coupon_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u431920805_ptl`@`localhost` SQL SECURITY DEFINER VIEW `_customer_coupon_info` AS select `cc`.`customer_coupon_id` AS `customer_coupon_id`,`cc`.`customer_id` AS `customer_id`,`dc`.`coupon_id` AS `coupon_id`,`dc`.`discount_type` AS `discount_type`,`dc`.`coupon_type` AS `coupon_type`,`dc`.`amount` AS `amount`,`dc`.`amount_threshold` AS `amount_threshold` from (`customer_coupon` `cc` join `discount_coupon` `dc` on((`cc`.`coupon_id` = `dc`.`coupon_id`)));

-- --------------------------------------------------------

--
-- Structure for view `_customer_order`
--
DROP TABLE IF EXISTS `_customer_order`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u431920805_ptl`@`localhost` SQL SECURITY DEFINER VIEW `_customer_order` AS select `co`.`order_id` AS `order_id`,`co`.`display_id` AS `display_id`,`co`.`customer_id` AS `customer_id`,`co`.`store_order_id` AS `store_order_id`,`co`.`customer_coupon_id` AS `customer_coupon_id`,`co`.`net_total` AS `net_total`,`co`.`receiver_name` AS `receiver_name`,`co`.`delivery_addr` AS `delivery_addr`,`co`.`ordered_datetime` AS `ordered_datetime`,`co`.`delivery_type` AS `delivery_type`,`co`.`status` AS `status`,`co`.`remark` AS `remark`,`co`.`delivered_date` AS `delivered_date`,`co`.`tracking_no` AS `tracking_no`,`pi`.`paid_date` AS `paid_date` from (`customer_order` `co` left join `payment_inform` `pi` on((`co`.`order_id` = `pi`.`order_id`)));

-- --------------------------------------------------------

--
-- Structure for view `_customer_ordered_item`
--
DROP TABLE IF EXISTS `_customer_ordered_item`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u431920805_ptl`@`localhost` SQL SECURITY DEFINER VIEW `_customer_ordered_item` AS select `p`.`display_id` AS `display_id`,`p`.`name` AS `name`,`i`.`order_item_id` AS `order_item_id`,`i`.`product_id` AS `product_id`,`i`.`order_id` AS `order_id`,`i`.`size` AS `size`,`i`.`color` AS `color`,`i`.`amount` AS `amount`,`i`.`unit_price` AS `unit_price` from (`product` `p` join `order_item` `i` on((`p`.`product_id` = `i`.`product_id`))) where 1;

-- --------------------------------------------------------

--
-- Structure for view `_product_info`
--
DROP TABLE IF EXISTS `_product_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u431920805_ptl`@`localhost` SQL SECURITY DEFINER VIEW `_product_info` AS select `p`.`product_id` AS `product_id`,`p`.`display_id` AS `display_id`,`p`.`name` AS `name`,`p`.`desc` AS `desc`,`p`.`unit_price` AS `unit_price`,`p`.`price_before_sale` AS `price_before_sale`,`p`.`added_date` AS `added_date`,`p`.`views` AS `views`,`p`.`cat_id` AS `cat_id`,`c`.`name` AS `category` from (`product` `p` join `category` `c` on((`c`.`product_cat_id` = `p`.`cat_id`))) where (`p`.`status` = '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0A');

-- --------------------------------------------------------

--
-- Structure for view `_sold_product`
--
DROP TABLE IF EXISTS `_sold_product`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u431920805_ptl`@`localhost` SQL SECURITY DEFINER VIEW `_sold_product` AS select `p`.`product_id` AS `product_id`,`p`.`cat_id` AS `cat_id`,`p`.`display_id` AS `display_id`,`p`.`name` AS `name`,`p`.`desc` AS `desc`,`p`.`cost` AS `cost`,`p`.`unit_price` AS `unit_price`,`p`.`price_before_sale` AS `price_before_sale`,`p`.`added_date` AS `added_date`,`p`.`supplier_id` AS `supplier_id`,`p`.`supplier_product_code` AS `supplier_product_code`,`p`.`supplier_product_url` AS `supplier_product_url`,`p`.`views` AS `views`,`p`.`status` AS `status`,ifnull(sum(`oi`.`amount`),0) AS `bought` from (`product` `p` left join `order_item` `oi` on((`oi`.`product_id` = `p`.`product_id`))) group by `p`.`product_id`;

-- --------------------------------------------------------

--
-- Structure for view `_unordered_store_items`
--
DROP TABLE IF EXISTS `_unordered_store_items`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u431920805_ptl`@`localhost` SQL SECURITY DEFINER VIEW `_unordered_store_items` AS select `oi`.`product_id` AS `product_id`,`oi`.`size` AS `size`,`oi`.`color` AS `color`,sum(`oi`.`amount`) AS `amount` from (`customer_order` `co` join `order_item` `oi` on((`co`.`order_id` = `oi`.`order_id`))) where (`co`.`status` = '\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0C') group by `oi`.`product_id`,`oi`.`size`,`oi`.`color`;

-- --------------------------------------------------------

--
-- Structure for view `_unordered_store_product`
--
DROP TABLE IF EXISTS `_unordered_store_product`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u431920805_ptl`@`localhost` SQL SECURITY DEFINER VIEW `_unordered_store_product` AS select `si`.`product_id` AS `product_id`,`si`.`size` AS `size`,`si`.`color` AS `color`,`si`.`amount` AS `amount`,`p`.`supplier_product_url` AS `supplier_product_url` from (`_unordered_store_items` `si` join `product` `p` on((`si`.`product_id` = `p`.`product_id`))) where 1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
