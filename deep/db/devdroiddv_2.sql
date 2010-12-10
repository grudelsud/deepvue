-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- Host: 173.201.217.62
-- Generation Time: Sep 11, 2010 at 04:49 AM
-- Server version: 5.0.91
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `devdroiddv`
--

-- --------------------------------------------------------

--
-- Table structure for table `dv_comment`
--

CREATE TABLE `dv_comment` (
  `id_comment` int(10) unsigned NOT NULL auto_increment,
  `id_element` int(10) unsigned default NULL,
  `id_user` int(10) unsigned default NULL,
  `user_email` varchar(45) default NULL COMMENT 'just in case, commenting user not registered on the website',
  `comment_approved` varchar(45) default NULL,
  `comment_content` text,
  PRIMARY KEY  (`id_comment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dv_comment`
--


-- --------------------------------------------------------

--
-- Table structure for table `dv_element`
--

CREATE TABLE `dv_element` (
  `id_element` int(10) unsigned NOT NULL auto_increment,
  `id_event` int(10) unsigned default NULL,
  `id_user` int(10) unsigned default NULL,
  `filename` varchar(255) default NULL,
  `ext` varchar(10) NOT NULL,
  `is_best` tinyint(4) default NULL,
  `id_place` int(10) unsigned default NULL,
  `lat` float default NULL,
  `lon` float default NULL,
  `caption` varchar(255) default NULL,
  `description` mediumtext,
  `relevance` float default NULL,
  `metric` float default NULL,
  `is_geo_precise` tinyint(4) default NULL,
  `is_manual` tinyint(4) default NULL,
  `is_public` tinyint(4) default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `device_version` varchar(45) default NULL,
  `app_version` varchar(45) default NULL,
  PRIMARY KEY  (`id_element`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=189 ;

--
-- Dumping data for table `dv_element`
--

INSERT INTO `dv_element` VALUES(1, 0, 3, '2f532fc318628c3f8fe311d316e5370d', 'jpeg', 0, 0, 43.7962, 11.0513, 'Crashes', NULL, NULL, 392.81, NULL, NULL, 1, '2010-09-07 19:58:49', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(2, 1, 2, 'd5ab3e2774fd58ed27f1a88aaa3c1cf3', 'jpeg', 1, 0, 11.111, 11.222, 'pappognagno', NULL, NULL, 666.666, NULL, NULL, 0, '2010-08-08 14:14:14', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(3, 1, 2, NULL, '', 1, 0, 11.111, 11.222, 'nullamelo', NULL, NULL, 666.666, NULL, NULL, 0, '2010-08-08 14:14:14', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(4, 2, 3, '9cce1bf72d15a0a95e5c079f0d1e6a86', 'jpeg', 0, 0, 43.7964, 11.0512, NULL, NULL, NULL, 378.426, NULL, NULL, 1, '2010-09-07 13:03:36', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(5, 2, 3, '0fd8341bdf970f209e3617488d3ecb33', 'jpeg', 0, 0, 43.7961, 11.0511, NULL, NULL, NULL, 309.435, NULL, NULL, 1, '2010-09-07 15:17:30', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(6, 2, 3, '4a4da5b5c22c3ee2c3cbdb9b71acc356', 'jpeg', 0, 0, 43.7962, 11.0513, NULL, NULL, NULL, 323.442, NULL, NULL, 1, '2010-09-07 15:23:40', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(7, 2, 3, '97a5765c1396fb84697329d1952855dd', 'jpeg', 0, 0, 43.7959, 11.0509, NULL, NULL, NULL, 281.093, NULL, NULL, 1, '2010-09-07 15:47:51', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(8, 3, 3, NULL, '', 0, 0, 666, 666, NULL, NULL, NULL, 0, NULL, NULL, 1, '2010-09-07 15:49:19', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(9, 4, 3, NULL, '', 0, 0, 666, 666, NULL, NULL, NULL, 0, NULL, NULL, 1, '2010-09-07 15:51:05', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(10, 5, 3, '233c9d844e6dc46eae3d0d00c026b7c9', 'jpeg', 0, 0, 43.7962, 11.0511, NULL, NULL, NULL, 388.659, NULL, NULL, 1, '2010-09-07 16:13:02', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(11, 5, 3, '36c4381aa5d72e7f89eded5e942c6968', 'jpeg', 0, 0, 43.796, 11.0511, NULL, NULL, NULL, 186.046, NULL, NULL, 1, '2010-09-07 16:18:59', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(12, 6, 3, NULL, '', 0, 0, 666, 666, NULL, NULL, NULL, 0, NULL, NULL, 1, '2010-09-07 16:18:30', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(13, 7, 3, '98d2c6eeabdb04653887afc5c9f0a490', 'jpeg', 0, 0, 43.797, 11.0659, NULL, NULL, NULL, 417.79, NULL, NULL, 1, '2010-09-07 16:26:19', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(14, 8, 3, '0f97426ba91c8fa71527dba8976037a5', 'jpeg', 0, 0, 43.7939, 11.0598, 'Back home. ', NULL, NULL, 387.904, NULL, NULL, 1, '2010-09-07 16:32:21', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(15, 9, 3, NULL, '', 0, 0, 666, 666, 'Back home. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-07 16:38:33', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(16, 9, 3, NULL, '', 0, 0, 666, 666, 'Crashes', NULL, NULL, 0, NULL, NULL, 1, '2010-09-07 16:38:33', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(17, 9, 3, NULL, '', 0, 0, 666, 666, 'Crashes', NULL, NULL, 0, NULL, NULL, 1, '2010-09-07 16:38:33', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(18, 9, 3, '61ac5ed4ecb2775ac6d452e42df3bb8e', 'jpeg', 0, 0, 43.7961, 11.0512, 'Crashes', NULL, NULL, 303.779, NULL, NULL, 1, '2010-09-07 17:36:00', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(19, 9, 3, '3389eb804aa02bd13bfbb7ba0b566999', 'jpeg', 0, 0, 43.7961, 11.0512, 'Crashes', NULL, NULL, 386.865, NULL, NULL, 1, '2010-09-07 17:46:09', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(20, 9, 3, '0aa6206d31bd5026b9234ccc2bc017f8', 'jpeg', 0, 0, 43.796, 11.0512, 'Crashes', NULL, NULL, 326.849, NULL, NULL, 1, '2010-09-07 17:51:12', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(21, 9, 3, '5437daa10f2cb4799246d648defd2356', 'jpeg', 0, 0, 43.7961, 11.0512, 'Crashes', NULL, NULL, 419.245, NULL, NULL, 1, '2010-09-07 17:55:02', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(22, 10, 3, '750574a865823c2971953f6496a85f79', 'jpeg', 0, 0, 43.8133, 11.0541, 'Crashes', NULL, NULL, 351.499, NULL, NULL, 1, '2010-09-07 18:10:21', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(23, 10, 3, NULL, '', 0, 0, 666, 666, 'Crashes', NULL, NULL, 0, NULL, NULL, 1, '2010-09-07 18:00:57', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(24, 11, 3, '31d586aee3fea51832319883652fdcd5', 'jpeg', 0, 0, 43.8214, 11.0497, 'Crashes', NULL, NULL, 332.994, NULL, NULL, 1, '2010-09-07 18:16:44', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(25, 12, 3, 'a8fa97869e74946dbb599960315f0f69', 'jpeg', 0, 0, 43.8196, 11.0511, 'Crashes', NULL, NULL, 340.089, NULL, NULL, 1, '2010-09-07 18:23:48', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(26, 12, 3, NULL, '', 0, 0, 666, 666, 'Crashes', NULL, NULL, 0, NULL, NULL, 1, '2010-09-07 18:20:21', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(27, 13, 3, '667b9ca7f116bfa0b4d9faf466e4e08d', 'jpeg', 0, 0, 43.7961, 11.0511, 'Crashes', NULL, NULL, 329.047, NULL, NULL, 1, '2010-09-07 18:29:45', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(28, 13, 3, '5054667903d001ce0b8de9913b4ab411', 'jpeg', 0, 0, 43.7963, 11.051, 'Crashes', NULL, NULL, 365.055, NULL, NULL, 1, '2010-09-07 19:23:24', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(29, 13, 3, '19b49584de61cc42c7e9fcd27917b9b4', 'jpeg', 0, 0, 43.7962, 11.0513, 'Crashes', NULL, NULL, 392.81, NULL, NULL, 1, '2010-09-07 19:58:49', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(30, 13, 3, NULL, '', 0, 0, 666, 666, 'Crashes', NULL, NULL, 0, NULL, NULL, 1, '2010-09-07 18:29:21', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(31, 13, 3, NULL, '', 0, 0, 666, 666, 'Crashes', NULL, NULL, 0, NULL, NULL, 1, '2010-09-07 18:29:21', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(32, 13, 3, NULL, '', 0, 0, 666, 666, 'Jump!', NULL, NULL, 0, NULL, NULL, 1, '2010-09-07 22:37:34', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(33, 14, 3, '51f24e2c9d1d79e597ea786d2d8a9572', 'jpeg', 0, 0, 43.7962, 11.0511, 'Crashes', NULL, NULL, 222.646, NULL, NULL, 1, '2010-09-08 09:36:19', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(34, 14, 3, '12e207b5c5434224d37f302bf8d31fab', 'jpeg', 0, 0, 43.7962, 11.0513, 'Crashes', NULL, NULL, 267.709, NULL, NULL, 1, '2010-09-08 10:58:31', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(35, 14, 3, NULL, '', 0, 0, 666, 666, '    ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-08 09:36:11', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(36, 14, 3, NULL, '', 0, 0, 666, 666, '    ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-08 09:36:11', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(37, 14, 3, NULL, '', 0, 0, 666, 666, '...', NULL, NULL, 0, NULL, NULL, 1, '2010-09-08 09:36:11', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(38, 14, 3, 'dac43c4999b3acd07686e22b4eacc1e9', 'jpeg', 0, 0, 43.7961, 11.0512, '...', NULL, NULL, 413.857, NULL, NULL, 1, '2010-09-08 11:49:40', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(39, 14, 3, '9b58ba891ea331f4a9a9021b1788d7c9', 'jpeg', 0, 0, 43.7961, 11.0512, '...', NULL, NULL, 413.857, NULL, NULL, 1, '2010-09-08 11:49:40', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(40, 14, 3, '35f1083c2fb4188a62a3de88453fd2fc', 'jpeg', 0, 0, 43.7961, 11.0512, '...', NULL, NULL, 413.857, NULL, NULL, 1, '2010-09-08 11:49:40', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(41, 14, 3, NULL, '', 0, 0, 666, 666, 'Ghiggolando. Ghhhhhhvv bv.   Hbhhhh', NULL, NULL, 0, NULL, NULL, 1, '2010-09-08 09:36:11', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(42, 14, 3, NULL, '', 0, 0, 666, 666, 'Ghiggolando. Ghhhhhhvv bv.   Hbhhhh', NULL, NULL, 0, NULL, NULL, 1, '2010-09-08 09:36:11', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(43, 14, 3, NULL, '', 0, 0, 666, 666, 'Ghiggolando. Ghhhhhhvv bv.   Hbhhhh', NULL, NULL, 0, NULL, NULL, 1, '2010-09-08 09:36:11', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(44, 14, 3, 'ed9e8d4d49c8c3f51bd42f581de1d509', 'jpeg', 0, 0, 43.7962, 11.0511, 'Prove mask. ', NULL, NULL, 453.203, NULL, NULL, 1, '2010-09-08 13:48:30', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(45, 14, 3, NULL, '', 0, 0, 666, 666, 'Prove mask. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-08 09:36:11', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(46, 14, 3, 'a2828c473852bc60ed0582ac26c4024c', 'jpeg', 0, 0, 43.796, 11.0511, 'Sono a casa. ', NULL, NULL, 180.433, NULL, NULL, 1, '2010-09-08 14:53:19', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(47, 14, 3, 'a258e6f5afe6fbacfaf20f527328b874', 'jpeg', 0, 0, 43.7961, 11.0514, 'Sono a casa. ', NULL, NULL, 437.935, NULL, NULL, 1, '2010-09-08 15:03:53', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(48, 15, 3, NULL, '', 0, 0, 666, 666, 'Mi fermo qui.', NULL, NULL, 0, NULL, NULL, 1, '2010-09-08 15:04:57', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(49, 16, 3, 'eb7c269e1838851e4d2a8fde4b9b85cb', 'jpeg', 0, 0, 43.7962, 11.048, 'Mi fermo qui.', NULL, NULL, 388.449, NULL, NULL, 1, '2010-09-08 15:08:56', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(50, 17, 3, NULL, '', 0, 0, 666, 666, 'A casa di nuovo. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-08 15:12:53', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(51, 18, 3, '92f05fc90725e35dc707a35ac7af21f0', 'jpeg', 0, 0, 43.7962, 11.0513, 'A casa di nuovo. ', NULL, NULL, 406.943, NULL, NULL, 1, '2010-09-08 15:17:59', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(52, 18, 3, '416db06635a98145cdef8bfde29ee20f', 'jpeg', 0, 0, 43.7961, 11.0511, 'A casa di nuovo. ', NULL, NULL, 291.181, NULL, NULL, 1, '2010-09-08 16:21:39', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(53, 19, 3, NULL, '', 0, 0, 666, 666, 'A casa di nuovo. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-08 16:24:22', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(54, 20, 3, NULL, '', 0, 0, 666, 666, 'A casa di nuovo. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-08 16:25:58', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(55, 21, 3, 'c5302d3abc8913f8c02bcd7e922b6f68', 'jpeg', 0, 0, 43.7961, 11.0512, 'A casa di nuovo. ', NULL, NULL, 147.641, NULL, NULL, 1, '2010-09-08 16:30:38', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(56, 21, 3, '029e27649857d865f436dcadf5dd215b', 'jpeg', 0, 0, 43.7961, 11.0512, 'Ghj', NULL, NULL, 323.671, NULL, NULL, 1, '2010-09-08 16:35:18', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(57, 21, 3, 'f77e070a039e4b2c7536b4741e1a601c', 'jpeg', 0, 0, 43.7959, 11.0512, 'H', NULL, NULL, 346.302, NULL, NULL, 1, '2010-09-08 17:10:16', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(58, 21, 3, 'db251726cd947a090921674acc3cd418', 'jpeg', 0, 0, 43.7959, 11.0512, 'H', NULL, NULL, 346.302, NULL, NULL, 1, '2010-09-08 17:10:16', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(59, 21, 3, '39aa4c609897b1b7a052c86849f3c8f8', 'jpeg', 0, 0, 43.7959, 11.0512, 'H', NULL, NULL, 346.302, NULL, NULL, 1, '2010-09-08 17:10:16', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(60, 21, 3, 'dff57b25362841e133a1d6202a5823a2', 'jpeg', 0, 0, 43.7962, 11.0511, 'H', NULL, NULL, 305.28, NULL, NULL, 1, '2010-09-08 17:25:11', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(61, 21, 3, 'b29e7684acfe14005421bd679fdba4ca', 'jpeg', 0, 0, 43.7961, 11.051, 'Rrr', NULL, NULL, 393.002, NULL, NULL, 1, '2010-09-08 18:06:06', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(62, 21, 3, 'ebe6cf30ab394367d11c9ca3ab43acec', 'jpeg', 0, 0, 43.7961, 11.051, 'Rrr', NULL, NULL, 393.002, NULL, NULL, 1, '2010-09-08 18:06:06', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(63, 21, 3, '9bbd9515cc9a2e86f77bb991459387e0', 'jpeg', 0, 0, 43.7961, 11.051, 'Rrr', NULL, NULL, 393.002, NULL, NULL, 1, '2010-09-08 18:06:06', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(64, 21, 3, 'dcf8b1289634c4cbe6c5db03bba81cab', 'jpeg', 0, 0, 43.7961, 11.051, 'Rrr', NULL, NULL, 393.002, NULL, NULL, 1, '2010-09-08 18:06:06', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(65, 21, 3, 'a494d2eecf52875a2174cbc28b11099b', 'jpeg', 0, 0, 43.7961, 11.051, 'Rrr', NULL, NULL, 393.002, NULL, NULL, 1, '2010-09-08 18:06:06', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(66, 21, 3, 'b1bcb80857d56e6c412eb3d60ac58036', 'jpeg', 0, 0, 43.7961, 11.051, 'Rrr', NULL, NULL, 393.002, NULL, NULL, 1, '2010-09-08 18:06:06', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(67, 21, 3, 'd855f7aa9f770a07941e805061ae294f', 'jpeg', 0, 0, 43.7961, 11.051, 'Rrr', NULL, NULL, 393.002, NULL, NULL, 1, '2010-09-08 18:06:06', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(68, 21, 3, 'd7f4e52b487c994fcaf69a30a6352906', 'jpeg', 0, 0, 43.7961, 11.051, 'Rrr', NULL, NULL, 393.002, NULL, NULL, 1, '2010-09-08 18:06:06', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(69, 21, 3, 'b9a2dd6bd3a0938aac34de7581a382ce', 'jpeg', 0, 0, 43.7961, 11.051, 'Rrr', NULL, NULL, 393.002, NULL, NULL, 1, '2010-09-08 18:06:06', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(70, 21, 3, 'b0dd3c94537a95308c42e1ee25fb2f37', 'jpeg', 0, 0, 43.7961, 11.051, 'Rrr', NULL, NULL, 393.002, NULL, NULL, 1, '2010-09-08 18:06:06', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(71, 21, 3, '1a23a2f0e546ec59e6961ddee0a6fbb5', 'jpeg', 0, 0, 43.7961, 11.0512, 'Rrr', NULL, NULL, 142.722, NULL, NULL, 1, '2010-09-08 19:26:27', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(72, 21, 3, '6cdd1443495b225b76f8e08e98748295', 'jpeg', 0, 0, 43.7961, 11.0512, 'Rrr', NULL, NULL, 142.722, NULL, NULL, 1, '2010-09-08 19:26:27', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(73, 21, 3, '7461eb136381c23b130fe3022d10a8ff', 'jpeg', 0, 0, 43.7953, 11.0508, 'Ggfc', NULL, NULL, 453.681, NULL, NULL, 0, '2010-09-08 19:50:44', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(74, 21, 3, 'ea42a83142083a9dbe9944981b93e7bd', 'jpeg', 0, 0, 43.7953, 11.0508, 'Ggfc', NULL, NULL, 453.681, NULL, NULL, 0, '2010-09-08 19:50:44', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(75, 21, 3, '4591ae5a2d247da2aba12999b090a8fe', 'jpeg', 0, 0, 43.7987, 11.0506, 'Buonanotte. ', NULL, NULL, 152.089, NULL, NULL, 1, '2010-09-09 01:05:03', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(76, 21, 3, '2ee4b2d857ce4d05b122c16a3d80c527', 'jpeg', 0, 0, 43.796, 11.051, 'Giorno. ', NULL, NULL, 348.482, NULL, NULL, 1, '2010-09-09 10:01:54', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(77, 21, 3, NULL, '', 0, 0, 666, 666, 'Giorno. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-08 16:27:31', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(78, 21, 3, 'e21390dd32c3faed7731257822a207ea', 'jpeg', 0, 0, 43.7963, 11.0515, 'Giorno. ', NULL, NULL, 289.687, NULL, NULL, 0, '2010-09-09 10:10:12', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(79, 21, 3, NULL, '', 0, 0, 666, 666, 'Giorno. ', NULL, NULL, 0, NULL, NULL, 0, '2010-09-08 16:27:31', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(80, 22, 3, NULL, '', 0, 0, 666, 666, 'Giorno. ', NULL, NULL, 0, NULL, NULL, 0, '2010-09-09 10:25:16', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(81, 23, 3, NULL, '', 0, 0, 666, 666, 'Giorno. ', NULL, NULL, 0, NULL, NULL, 0, '2010-09-09 10:25:16', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(82, 24, 3, 'f82ffc0c6e25ae4906f9de2323a49760', 'jpeg', 0, 0, 43.7962, 11.0518, 'Giorno. ', NULL, NULL, 345.833, NULL, NULL, 0, '2010-09-09 10:29:29', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(83, 25, 3, NULL, '', 0, 0, 666, 666, 'Giorno. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 10:31:13', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(84, 26, 3, '92119c3003489c8bc8cf3bc2da383a1a', 'jpeg', 0, 0, 43.7961, 11.0512, 'Giorno. ', NULL, NULL, 454.295, NULL, NULL, 1, '2010-09-09 11:46:38', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(85, 26, 3, '28dd88eab7876070dd18934e9be921b9', 'jpeg', 0, 0, 43.7963, 11.0513, 'Giorno. ', NULL, NULL, 395.041, NULL, NULL, 1, '2010-09-09 12:28:52', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(86, 26, 3, NULL, '', 0, 0, 666, 666, 'Giorno. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 11:44:31', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(87, 27, 3, NULL, '', 0, 0, 666, 666, 'Giorno. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 12:36:00', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(88, 27, 3, NULL, '', 0, 0, 666, 666, 'Giorno. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 12:36:00', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(89, 28, 3, '19f91db7e11e93e12414be5bf4344514', 'jpeg', 0, 0, 43.7961, 11.051, 'Giorno. ', NULL, NULL, 404.345, NULL, NULL, 1, '2010-09-09 13:09:56', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(90, 28, 3, 'b3e6aa5a92f0ad19bb068034a36e12e0', 'jpeg', 0, 0, 43.7963, 11.0509, 'Bip e bop. ', NULL, NULL, 371.891, NULL, NULL, 1, '2010-09-09 13:13:28', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(91, 28, 3, NULL, '', 0, 0, 666, 666, 'Bip e bop. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 12:48:02', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(92, 29, 3, NULL, '', 0, 0, 666, 666, 'Bip e bop. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 13:20:13', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(93, 29, 3, NULL, '', 0, 0, 666, 666, 'Bip e bop. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 13:20:13', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(94, 30, 3, NULL, '', 0, 0, 666, 666, 'Bip e bop. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 13:25:13', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(95, 30, 3, NULL, '', 0, 0, 666, 666, 'Bip e bop. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 13:25:13', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(96, 30, 3, NULL, '', 0, 0, 666, 666, 'Bip e bop. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 13:25:13', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(97, 31, 3, NULL, '', 0, 0, 666, 666, 'Bip e bop. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 13:54:18', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(98, 32, 3, NULL, '', 0, 0, 666, 666, 'Bip e bop. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 13:59:25', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(99, 33, 3, 'dc254f1f6046b88da373e7bf24ec24ec', 'jpeg', 0, 0, 43.796, 11.052, 'Bip e bop. ', NULL, NULL, 376.996, NULL, NULL, 1, '2010-09-09 14:08:23', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(100, 34, 3, NULL, '', 0, 0, 666, 666, 'Bip e bop. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 14:09:16', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(101, 34, 3, NULL, '', 0, 0, 666, 666, 'Bip e bop. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 14:09:16', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(102, 35, 3, NULL, '', 0, 0, 666, 666, 'Bip e bop. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 14:18:46', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(103, 35, 3, '74fa833f8bdd41a10c70604f25e6048e', 'jpeg', 0, 0, 43.796, 11.0513, 'Bip e bop. ', NULL, NULL, 206.429, NULL, NULL, 1, '2010-09-09 15:18:39', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(104, 35, 3, '38eb5f4d18536e10137deadd04b0b27d', 'jpeg', 0, 0, 43.7961, 11.0512, 'Deve essere privata lampada', NULL, NULL, 168.535, NULL, NULL, 0, '2010-09-09 15:24:14', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(105, 35, 3, NULL, '', 0, 0, 666, 666, '[82] Deve essere privata lampada', NULL, NULL, 0, NULL, NULL, 0, '2010-09-09 14:18:46', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(106, 35, 3, '6e324d37a8fb40953e262013f20d9182', 'jpeg', 0, 0, 43.7962, 11.0512, '[83] Pub', NULL, NULL, 312.116, NULL, NULL, 1, '2010-09-09 15:49:26', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(107, 35, 3, 'c571d8e4304d34f398479a6cf75464d0', 'jpeg', 0, 0, 43.7961, 11.0512, '[84] Pub', NULL, NULL, 192.817, NULL, NULL, 1, '2010-09-09 15:59:34', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(108, 35, 3, '4b7ac0d95be0da603f19be2652f2a00b', 'jpeg', 0, 0, 43.7961, 11.0512, '[85] Pouch poi spengo e riaccendo', NULL, NULL, 313.77, NULL, NULL, 1, '2010-09-09 16:09:01', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(109, 35, 3, NULL, '', 0, 0, 666, 666, '[86] Pouch poi spengo e riaccendo', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 14:18:46', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(110, 36, 3, '33c33163c46fdd16bdbf1feafbe5d05d', 'jpeg', 1, 0, 43.7942, 11.051, '[87] Gamma 1.3', NULL, NULL, 385.452, NULL, NULL, 1, '2010-09-09 16:26:06', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(111, 37, 3, NULL, '', 1, 0, 666, 666, '[88] Gamma 1.3', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 16:29:57', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(112, 38, 3, NULL, '', 1, 0, 666, 666, '[89] Gamma 1.3', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 16:31:57', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(113, 39, 3, '8e05e62a893888d054653d0442d5626e', 'jpeg', 1, 0, 43.7962, 11.0513, '[90] Gamma 1.3', NULL, NULL, 377.262, NULL, NULL, 1, '2010-09-09 16:52:20', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(114, 39, 3, NULL, '', 0, 0, 666, 666, '[91] Gamma 1.3', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 16:42:43', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(115, 39, 3, NULL, '', 0, 0, 666, 666, '[91] Gamma 1.3', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 16:42:43', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(116, 39, 3, NULL, '', 0, 0, 666, 666, '[91] Gamma 1.3', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 16:42:43', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(117, 39, 3, '726828a88ea54eb44e470f846600d7e5', 'jpeg', 0, 0, 43.7962, 11.0512, '[92] Gamma 1.3', NULL, NULL, 395.016, NULL, NULL, 1, '2010-09-09 17:12:53', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(118, 39, 3, '5666f0a915c60500371f155b643165a1', 'jpeg', 0, 0, 43.7961, 11.0512, '[93] Gamma 1.3', NULL, NULL, 237.898, NULL, NULL, 1, '2010-09-09 17:27:12', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(119, 39, 3, 'cee2e08da72e38ac79586289dead451a', 'jpeg', 0, 0, 43.7959, 11.0507, '[94] Gamma 1.3', NULL, NULL, 453.848, NULL, NULL, 1, '2010-09-09 17:34:11', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(120, 39, 3, 'd6479ec228dd8ea949bf7c3adf9d9f79', 'jpeg', 0, 0, 43.7962, 11.0514, '[95] Spuntino. ', NULL, NULL, 292.464, NULL, NULL, 1, '2010-09-09 17:51:20', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(121, 39, 3, NULL, '', 0, 0, 666, 666, '[96] Spuntino. ', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 16:42:43', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(122, 40, 3, 'b03a731f7073e6482a7b3187e9f91dfa', 'jpeg', 1, 0, 43.7966, 11.0544, '[97] Ovm', NULL, NULL, 251.296, NULL, NULL, 1, '2010-09-09 19:04:26', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(123, 40, 3, NULL, '', 0, 0, 666, 666, '[98] Carwash', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 19:03:50', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(124, 41, 3, '78984fd0ddaf40ede71856b54fbe7c86', 'jpeg', 1, 0, 43.8213, 11.05, '[99] Carwash', NULL, NULL, 345.828, NULL, NULL, 1, '2010-09-09 19:11:15', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(125, 41, 3, '1dcd1965f6b52d07c497b54b3cfe926d', 'jpeg', 0, 0, 43.8214, 11.0494, '[100] Riparto', NULL, NULL, 312.787, NULL, NULL, 1, '2010-09-09 19:23:21', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(126, 42, 3, NULL, '', 1, 0, 666, 666, '[101] Benz', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 19:23:50', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(127, 43, 3, '57b305003cfc151cb4d76990e5264255', 'jpeg', 1, 0, 43.813, 11.0666, '[102] Benz', NULL, NULL, 364.635, NULL, NULL, 1, '2010-09-09 19:30:22', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(128, 43, 3, NULL, '', 0, 0, 666, 666, '[103] Benz', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 19:28:51', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(129, 44, 3, NULL, '', 1, 0, 666, 666, '[104] Ikea arrivo', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 19:37:29', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(130, 45, 3, '75ce08778df104e4103ac438135ff8f0', 'jpeg', 1, 0, 43.8077, 11.1881, '[105] Ikea arrivo', NULL, NULL, 377.527, NULL, NULL, 1, '2010-09-09 19:56:12', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(131, 45, 3, '94dc09e7630f1856710246b593cbe13d', 'jpeg', 0, 0, 43.8078, 11.1879, '[106] Ik', NULL, NULL, 433.489, NULL, NULL, 1, '2010-09-09 20:09:48', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(132, 46, 3, NULL, '', 1, 0, 666, 666, '[107] Ik', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 20:42:24', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(133, 47, 3, NULL, '', 1, 0, 666, 666, '[108] Ik', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 20:51:25', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(134, 48, 3, '65f92bd4852a38ec6f3d7ad157849195', 'jpeg', 1, 0, 43.8327, 11.1813, '[109] Mv', NULL, NULL, 229.287, NULL, NULL, 1, '2010-09-09 20:55:16', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(135, 49, 3, NULL, '', 1, 0, 666, 666, '[110] Mv', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 20:55:55', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(136, 50, 3, 'f2f1b6a489f8a64b03a54974e232279c', 'jpeg', 1, 0, 43.8318, 11.1803, '[111] Mv', NULL, NULL, 374.792, NULL, NULL, 1, '2010-09-09 21:06:36', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(137, 50, 3, '3a4df829d88cb35d45af3bd5fd0f7b4e', 'jpeg', 0, 0, 43.8321, 11.1801, '[112] Chat', NULL, NULL, 350.743, NULL, NULL, 0, '2010-09-09 22:08:13', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(138, 50, 3, NULL, '', 0, 0, 666, 666, '[113] Chat', NULL, NULL, 0, NULL, NULL, 0, '2010-09-09 20:55:55', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(139, 50, 3, '34f72d65a764d4fff0f4d9ffd20c4ee4', 'jpeg', 0, 0, 43.8316, 11.1785, '[114] Pulizia prese', NULL, NULL, 444.509, NULL, NULL, 0, '2010-09-09 22:25:59', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(140, 51, 3, NULL, '', 1, 0, 666, 666, '[115] Pulizia prese', NULL, NULL, 0, NULL, NULL, 0, '2010-09-09 22:33:32', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(141, 52, 3, 'f0976f552391d86c6ffbffce518b52b3', 'jpeg', 1, 0, 43.8191, 11.1887, '[116] Pulizia prese', NULL, NULL, 309.485, NULL, NULL, 0, '2010-09-09 22:44:01', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(142, 53, 3, '8f3f146492f85d9e2009fdda7a0980be', 'jpeg', 1, 0, 43.8089, 11.0928, '[117] Mcv', NULL, NULL, 292.105, NULL, NULL, 0, '2010-09-09 22:58:53', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(143, 53, 3, NULL, '', 0, 0, 666, 666, '[118] Mcv', NULL, NULL, 0, NULL, NULL, 0, '2010-09-09 22:44:34', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(144, 54, 3, NULL, '', 1, 0, 666, 666, '[119] Mcv', NULL, NULL, 0, NULL, NULL, 0, '2010-09-09 23:06:05', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(145, 55, 3, NULL, '', 1, 0, 666, 666, '[120] Home', NULL, NULL, 0, NULL, NULL, 0, '2010-09-09 23:18:36', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(146, 56, 3, NULL, '', 1, 0, 666, 666, '[121] Home', NULL, NULL, 0, NULL, NULL, 1, '2010-09-09 23:20:47', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(147, 57, 3, '069bcab867bc2390a08ed9651b57c477', 'jpeg', 1, 0, 43.796, 11.0512, '[122] Home', NULL, NULL, 267.214, NULL, NULL, 1, '2010-09-09 23:54:10', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(148, 57, 3, '0fd151b068c898553df251908b1bd3cd', 'jpeg', 0, 0, 43.7963, 11.0509, '[123] Buonanotte al secchio', NULL, NULL, 292.364, NULL, NULL, 1, '2010-09-10 00:36:53', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(149, 57, 3, 'a6d7e80828bfc80f9ca6ff1b2fee4d66', 'jpeg', 0, 0, 43.796, 11.0511, '[124] E buondi', NULL, NULL, 342.187, NULL, NULL, 1, '2010-09-10 09:26:22', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(150, 57, 3, '93d4afa3c250a6be7230d64efa79e2dc', 'jpeg', 0, 0, 43.7961, 11.0513, '[125] Cool morning. ', NULL, NULL, 419.195, NULL, NULL, 0, '2010-09-10 11:03:02', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(151, 57, 3, '466dae1442bb75cda7505754fc0552c6', 'jpeg', 0, 0, 43.7961, 11.0511, '[126] O h things', NULL, NULL, 275.834, NULL, NULL, 0, '2010-09-10 13:03:17', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(152, 57, 3, NULL, '', 0, 0, 666, 666, '[127] O h things', NULL, NULL, 0, NULL, NULL, 0, '2010-09-09 23:22:47', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(153, 57, 3, '40e14ea02250180d1264b1deb0cb9d92', 'jpeg', 0, 0, 43.7959, 11.0512, '[128] O h things', NULL, NULL, 193.313, NULL, NULL, 0, '2010-09-10 16:26:34', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(154, 57, 3, '428218c64ae9f25e8b2f5543598cb654', 'jpeg', 0, 0, 43.7962, 11.0512, '[129] Dopo qs foto spengo app per provare jump con movimento', NULL, NULL, 297.909, NULL, NULL, 0, '2010-09-10 17:36:36', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(155, 57, 3, NULL, '', 0, 0, 666, 666, '[130] Ora vo davvero. Scatto spengo e vo', NULL, NULL, 0, NULL, NULL, 0, '2010-09-09 23:22:47', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(156, 58, 3, NULL, '', 1, 0, 666, 666, '[131] Ora vo davvero. Scatto spengo e vo', NULL, NULL, 0, NULL, NULL, 0, '2010-09-10 19:56:39', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(157, 59, 3, NULL, '', 1, 0, 666, 666, '[132] Ora vo davvero. Scatto spengo e vo', NULL, NULL, 0, NULL, NULL, 0, '2010-09-10 20:14:01', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(158, 60, 3, '8dea8b95aeb027f12899205bbe09ee7a', 'jpeg', 1, 0, 43.77, 11.1128, '[133] Ora vo davvero. Scatto spengo e vo', NULL, NULL, 255.216, NULL, NULL, 0, '2010-09-10 20:20:13', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(159, 60, 3, NULL, '', 0, 0, 666, 666, '[134] Traffico', NULL, NULL, 0, NULL, NULL, 0, '2010-09-10 20:16:09', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(160, 61, 3, '5bf00706578a0d986670df697d57edf1', 'jpeg', 1, 0, 43.7742, 11.2218, '[135] Traffico', NULL, NULL, 441.13, NULL, NULL, 0, '2010-09-10 20:34:56', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(161, 62, 3, NULL, '', 1, 0, 666, 666, '[136] Traffico', NULL, NULL, 0, NULL, NULL, 0, '2010-09-10 20:37:02', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(162, 63, 3, NULL, '', 1, 0, 666, 666, '[137] Traffico', NULL, NULL, 0, NULL, NULL, 0, '2010-09-10 21:07:04', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(163, 64, 3, NULL, '', 1, 0, 666, 666, '[138] Traffico', NULL, NULL, 0, NULL, NULL, 0, '2010-09-10 21:09:12', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(164, 65, 3, '7dfe79e788fdc02f697f778fd527644d', 'jpeg', 1, 0, 43.7654, 11.2412, '[139] Traffico', NULL, NULL, 303.703, NULL, NULL, 0, '2010-09-10 21:15:14', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(165, 66, 3, NULL, '', 1, 0, 666, 666, '[140] Ss', NULL, NULL, 0, NULL, NULL, 0, '2010-09-10 21:16:34', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(166, 67, 3, 'b9339dcead0dd9cc1d0e20479f585e3d', 'jpeg', 1, 0, 43.7668, 11.2478, '[141] Ss', NULL, NULL, 236.751, NULL, NULL, 0, '2010-09-10 21:42:19', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(167, 67, 3, '66bd2018c6e391db12b0a37e4bf533da', 'jpeg', 0, 0, 43.7668, 11.2482, '[142] Scalini. ', NULL, NULL, 269.464, NULL, NULL, 0, '2010-09-10 21:57:28', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(168, 67, 3, 'bc1fb770745794ed594da2e4b0516feb', 'jpeg', 0, 0, 43.7669, 11.2482, '[143] Ancora', NULL, NULL, 301.956, NULL, NULL, 0, '2010-09-10 22:20:37', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(169, 67, 3, '0310980138ffb5447165e37eac2ebabd', 'jpeg', 0, 0, 43.7667, 11.2477, '[144] Ancora', NULL, NULL, 339.848, NULL, NULL, 0, '2010-09-10 23:05:00', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(170, 67, 3, '2e50088ec71da90c223457446a3a7ff3', 'jpeg', 0, 0, 43.7667, 11.2475, '[145] Ancora', NULL, NULL, 364.374, NULL, NULL, 0, '2010-09-10 23:17:38', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(171, 67, 3, '8f86dba593bed98cc2419925f81d9437', 'jpeg', 0, 0, 43.7667, 11.2475, '[146] Ancora', NULL, NULL, 451.33, NULL, NULL, 0, '2010-09-10 23:36:10', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(172, 67, 3, 'a64a54d43eefc27b048fee81285fa20b', 'jpeg', 0, 0, 43.7667, 11.2475, '[147] Ancora', NULL, NULL, 443.505, NULL, NULL, 0, '2010-09-10 23:52:32', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(173, 67, 3, '7f34a2c7804ad4ae71371599469494f5', 'jpeg', 0, 0, 43.7667, 11.2473, '[148] Ancora', NULL, NULL, 415.527, NULL, NULL, 0, '2010-09-11 00:15:30', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(174, 67, 3, '81ab8040527360324170781cac75c5fd', 'jpeg', 0, 0, 43.7667, 11.2472, '[149] Ancora', NULL, NULL, 355.553, NULL, NULL, 0, '2010-09-11 00:28:17', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(175, 67, 3, '8cac6689e4568e57337de42b03738502', 'jpeg', 0, 0, 43.7667, 11.2472, '[150] Fazoleto', NULL, NULL, 221.143, NULL, NULL, 0, '2010-09-11 00:36:39', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(176, 67, 3, '6f0bc66dfc560ed60c3dea826cd15483', 'jpeg', 0, 0, 43.7668, 11.2471, '[151] Gelosi rui', NULL, NULL, 265.697, NULL, NULL, 0, '2010-09-11 01:23:23', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(177, 67, 3, 'a42e8ef2c4d1024ece08ad4edf38ad17', 'jpeg', 0, 0, 43.7668, 11.2472, '[152] Culo', NULL, NULL, 305.732, NULL, NULL, 0, '2010-09-11 01:41:59', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(178, 67, 3, '0cd0c71f1083301dd111cce11f15309b', 'jpeg', 0, 0, 43.7667, 11.2472, '[153] Culo', NULL, NULL, 220.997, NULL, NULL, 0, '2010-09-11 02:03:45', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(179, 67, 3, 'df56622d08c62c7c1eee12e56f41ac92', 'jpeg', 0, 0, 43.7667, 11.2472, '[154] Culo', NULL, NULL, 303.723, NULL, NULL, 0, '2010-09-11 02:10:16', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(180, 67, 3, NULL, '', 0, 0, 666, 666, '[155] Culo', NULL, NULL, 0, NULL, NULL, 0, '2010-09-10 21:27:35', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(181, 67, 3, NULL, '', 0, 0, 666, 666, '[156] Culo', NULL, NULL, 0, NULL, NULL, 0, '2010-09-10 21:27:35', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(182, 67, 3, NULL, '', 0, 0, 666, 666, '[157] Culo', NULL, NULL, 0, NULL, NULL, 0, '2010-09-10 21:27:35', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(183, 68, 3, NULL, '', 1, 0, 666, 666, '[158] Culo', NULL, NULL, 0, NULL, NULL, 0, '2010-09-11 03:36:06', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(184, 69, 3, NULL, '', 1, 0, 666, 666, '[159] Culo', NULL, NULL, 0, NULL, NULL, 0, '2010-09-11 03:37:54', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(185, 69, 3, NULL, '', 0, 0, 666, 666, '[160] Culo', NULL, NULL, 0, NULL, NULL, 0, '2010-09-11 03:37:54', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(186, 70, 3, '4a3272bec0f727ce29105996e69e21fc', 'jpeg', 1, 0, 43.7663, 11.2412, '[161] Culo', NULL, NULL, 263.312, NULL, NULL, 0, '2010-09-11 03:44:54', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(187, 70, 3, NULL, '', 0, 0, 666, 666, '[162] Morning', NULL, NULL, 0, NULL, NULL, 0, '2010-09-11 03:43:02', NULL, NULL, '0');
INSERT INTO `dv_element` VALUES(188, 71, 3, '7dc3f0ccbed32234aa360bd84a1e8ec2', 'jpeg', 1, 0, 43.7961, 11.0512, '[163] Morning', NULL, NULL, 267.554, NULL, NULL, 0, '2010-09-11 12:09:53', NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `dv_event`
--

CREATE TABLE `dv_event` (
  `id_event` int(10) unsigned NOT NULL auto_increment,
  `id_user` int(10) unsigned default NULL,
  `running` tinyint(4) default NULL,
  `id_place_start` int(10) unsigned default NULL,
  `lat_start` float default NULL,
  `lon_start` float default NULL,
  `id_place_end` int(10) unsigned default NULL,
  `lat_end` float default NULL,
  `lon_end` float default NULL,
  `time_start` datetime default NULL,
  `time_end` datetime default NULL,
  `text` varchar(255) default NULL,
  `description` mediumtext,
  PRIMARY KEY  (`id_event`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `dv_event`
--

INSERT INTO `dv_event` VALUES(1, 2, 1, 0, 1111, 1111, 0, 1111, 1111, '2010-08-08 13:13:13', '2010-08-08 15:15:15', NULL, NULL);
INSERT INTO `dv_event` VALUES(2, 3, 0, 0, 43.7962, 11.0511, 0, 43.7962, 11.0511, '2010-09-07 13:02:57', '2010-09-07 15:47:53', NULL, NULL);
INSERT INTO `dv_event` VALUES(3, 3, 0, 0, 43.7966, 11.051, 0, 43.7966, 11.051, '2010-09-07 15:49:19', '2010-09-07 15:51:05', NULL, NULL);
INSERT INTO `dv_event` VALUES(4, 3, 0, 0, 43.7966, 11.051, 0, 43.7962, 11.051, '2010-09-07 15:51:05', '2010-09-07 15:52:54', NULL, NULL);
INSERT INTO `dv_event` VALUES(5, 3, 0, 0, 43.7961, 11.051, 0, 43.7961, 11.051, '2010-09-07 15:52:54', '2010-09-07 16:18:30', NULL, NULL);
INSERT INTO `dv_event` VALUES(6, 3, 0, 0, 43.7961, 11.051, 0, 43.7969, 11.0659, '2010-09-07 16:18:30', '2010-09-07 16:21:06', NULL, NULL);
INSERT INTO `dv_event` VALUES(7, 3, 0, 0, 43.7969, 11.0659, 0, 43.7969, 11.0659, '2010-09-07 16:21:06', '2010-09-07 16:27:39', NULL, NULL);
INSERT INTO `dv_event` VALUES(8, 3, 0, 0, 43.7969, 11.0659, 0, 43.7961, 11.0511, '2010-09-07 16:27:39', '2010-09-07 16:38:33', NULL, NULL);
INSERT INTO `dv_event` VALUES(9, 3, 0, 0, 43.7961, 11.0512, 0, 43.7961, 11.0512, '2010-09-07 16:38:33', '2010-09-07 18:00:57', NULL, NULL);
INSERT INTO `dv_event` VALUES(10, 3, 0, 0, 43.7961, 11.0512, 0, 43.8214, 11.0498, '2010-09-07 18:00:57', '2010-09-07 18:16:21', NULL, NULL);
INSERT INTO `dv_event` VALUES(11, 3, 0, 0, 43.8214, 11.0498, 0, 43.8214, 11.0498, '2010-09-07 18:16:21', '2010-09-07 18:20:21', NULL, NULL);
INSERT INTO `dv_event` VALUES(12, 3, 0, 0, 43.8214, 11.0498, 0, 43.7961, 11.0511, '2010-09-07 18:20:21', '2010-09-07 18:29:21', NULL, NULL);
INSERT INTO `dv_event` VALUES(13, 3, 0, 0, 43.7961, 11.0511, 0, 43.7962, 11.0511, '2010-09-07 22:37:27', '2010-09-08 09:36:11', NULL, NULL);
INSERT INTO `dv_event` VALUES(14, 3, 0, 0, 43.7961, 11.0513, 0, 43.7961, 11.0513, '2010-09-08 09:36:11', '2010-09-08 15:04:57', NULL, NULL);
INSERT INTO `dv_event` VALUES(15, 3, 0, 0, 43.7961, 11.0513, 0, 43.7961, 11.048, '2010-09-08 15:04:57', '2010-09-08 15:08:19', NULL, NULL);
INSERT INTO `dv_event` VALUES(16, 3, 0, 0, 43.7961, 11.048, 0, 43.7961, 11.048, '2010-09-08 15:08:19', '2010-09-08 15:12:53', NULL, NULL);
INSERT INTO `dv_event` VALUES(17, 3, 0, 0, 43.7961, 11.048, 0, 43.7961, 11.0513, '2010-09-08 15:12:53', '2010-09-08 15:16:22', NULL, NULL);
INSERT INTO `dv_event` VALUES(18, 3, 0, 0, 43.7961, 11.0512, 0, 43.7961, 11.0512, '2010-09-08 15:16:22', '2010-09-08 16:22:59', NULL, NULL);
INSERT INTO `dv_event` VALUES(19, 3, 0, 0, 43.7967, 11.0512, 0, 43.7967, 11.0512, '2010-09-08 16:24:22', '2010-09-08 16:25:58', NULL, NULL);
INSERT INTO `dv_event` VALUES(20, 3, 0, 0, 43.7967, 11.0512, 0, 43.7961, 11.0511, '2010-09-08 16:25:58', '2010-09-08 16:27:31', NULL, NULL);
INSERT INTO `dv_event` VALUES(21, 3, 0, 0, 43.7961, 11.0512, 0, 43.7961, 11.0512, '2010-09-08 16:27:31', '2010-09-09 10:25:16', NULL, NULL);
INSERT INTO `dv_event` VALUES(22, 3, 0, 0, 43.7961, 11.0512, 0, 43.7962, 11.0519, '2010-09-09 10:25:16', '2010-09-09 10:29:05', NULL, NULL);
INSERT INTO `dv_event` VALUES(23, 3, 0, 0, 43.7961, 11.0512, 0, 43.7962, 11.0519, '2010-09-09 10:25:16', '2010-09-09 10:29:05', NULL, NULL);
INSERT INTO `dv_event` VALUES(24, 3, 0, 0, 43.7962, 11.0519, 0, 43.7962, 11.0519, '2010-09-09 10:29:05', '2010-09-09 10:31:13', NULL, NULL);
INSERT INTO `dv_event` VALUES(25, 3, 0, 0, 43.7962, 11.0519, 0, 43.7961, 11.0513, '2010-09-09 10:31:13', '2010-09-09 11:44:31', NULL, NULL);
INSERT INTO `dv_event` VALUES(26, 3, 0, 0, 43.7961, 11.0512, 0, 43.7961, 11.0512, '2010-09-09 11:44:31', '2010-09-09 12:34:59', NULL, NULL);
INSERT INTO `dv_event` VALUES(27, 3, 0, 0, 43.7965, 11.0511, 0, 43.7965, 11.0511, '2010-09-09 12:36:00', '2010-09-09 12:47:59', NULL, NULL);
INSERT INTO `dv_event` VALUES(28, 3, 0, 0, 43.7961, 11.0511, 0, 43.7961, 11.0511, '2010-09-09 12:48:02', '2010-09-09 13:19:44', NULL, NULL);
INSERT INTO `dv_event` VALUES(29, 3, 0, 0, 43.7964, 11.0505, 0, 43.7964, 11.0505, '2010-09-09 13:20:13', '2010-09-09 13:24:24', NULL, NULL);
INSERT INTO `dv_event` VALUES(30, 3, 0, 0, 43.7962, 11.0509, 0, 43.7962, 11.0509, '2010-09-09 13:25:13', '2010-09-09 13:54:18', NULL, NULL);
INSERT INTO `dv_event` VALUES(31, 3, 0, 0, 43.7962, 11.0509, 0, 43.7966, 11.0513, '2010-09-09 13:54:18', '2010-09-09 13:59:25', NULL, NULL);
INSERT INTO `dv_event` VALUES(32, 3, 0, 0, 43.7966, 11.0513, 0, 43.7966, 11.0513, '2010-09-09 13:59:25', '2010-09-09 14:03:21', NULL, NULL);
INSERT INTO `dv_event` VALUES(33, 3, 0, 0, 43.7966, 11.0513, 0, 43.7958, 11.0512, '2010-09-09 14:03:21', '2010-09-09 14:09:16', NULL, NULL);
INSERT INTO `dv_event` VALUES(34, 3, 0, 0, 43.7958, 11.0513, 0, 43.7958, 11.0513, '2010-09-09 14:09:16', '2010-09-09 14:17:57', NULL, NULL);
INSERT INTO `dv_event` VALUES(35, 3, 0, 0, 43.7961, 11.0512, 0, 43.7961, 11.0512, '2010-09-09 14:18:46', '2010-09-09 16:25:08', NULL, NULL);
INSERT INTO `dv_event` VALUES(36, 3, 0, 0, 43.7961, 11.0512, 0, 43.7967, 11.0512, '2010-09-09 16:25:08', '2010-09-09 16:29:57', NULL, NULL);
INSERT INTO `dv_event` VALUES(37, 3, 0, 0, 43.7967, 11.0512, 0, 43.7967, 11.0512, '2010-09-09 16:29:57', '2010-09-09 16:31:57', NULL, NULL);
INSERT INTO `dv_event` VALUES(38, 3, 0, 0, 43.7967, 11.0512, 0, 43.7961, 11.0512, '2010-09-09 16:31:57', '2010-09-09 16:42:43', NULL, NULL);
INSERT INTO `dv_event` VALUES(39, 3, 0, 0, 43.7961, 11.0512, 0, 43.7961, 11.0512, '2010-09-09 16:42:43', '2010-09-09 19:03:50', NULL, NULL);
INSERT INTO `dv_event` VALUES(40, 3, 0, 0, 43.7961, 11.0512, 0, 43.8213, 11.05, '2010-09-09 19:03:50', '2010-09-09 19:10:50', NULL, NULL);
INSERT INTO `dv_event` VALUES(41, 3, 0, 0, 43.8214, 11.0499, 0, 43.8214, 11.0499, '2010-09-09 19:10:50', '2010-09-09 19:23:50', NULL, NULL);
INSERT INTO `dv_event` VALUES(42, 3, 0, 0, 43.8214, 11.0499, 0, 43.8131, 11.0664, '2010-09-09 19:23:50', '2010-09-09 19:28:51', NULL, NULL);
INSERT INTO `dv_event` VALUES(43, 3, 0, 0, 43.8132, 11.0664, 0, 43.8132, 11.0664, '2010-09-09 19:28:51', '2010-09-09 19:37:29', NULL, NULL);
INSERT INTO `dv_event` VALUES(44, 3, 0, 0, 43.8132, 11.0664, 0, 43.8076, 11.188, '2010-09-09 19:37:29', '2010-09-09 19:54:22', NULL, NULL);
INSERT INTO `dv_event` VALUES(45, 3, 0, 0, 43.8077, 11.188, 0, 43.8077, 11.188, '2010-09-09 19:54:22', '2010-09-09 20:42:24', NULL, NULL);
INSERT INTO `dv_event` VALUES(46, 3, 0, 0, 43.8077, 11.188, 0, 43.8348, 11.1891, '2010-09-09 20:42:24', '2010-09-09 20:51:25', NULL, NULL);
INSERT INTO `dv_event` VALUES(47, 3, 0, 0, 43.8348, 11.1891, 0, 43.8348, 11.1891, '2010-09-09 20:51:25', '2010-09-09 20:53:33', NULL, NULL);
INSERT INTO `dv_event` VALUES(48, 3, 0, 0, 43.8348, 11.1891, 0, 43.8318, 11.1802, '2010-09-09 20:53:33', '2010-09-09 20:55:55', NULL, NULL);
INSERT INTO `dv_event` VALUES(49, 3, 0, 0, 43.8318, 11.1802, 0, 43.8318, 11.1802, '2010-09-09 20:55:55', '2010-09-09 21:00:03', NULL, NULL);
INSERT INTO `dv_event` VALUES(50, 3, 0, 0, 43.8318, 11.18, 0, 43.8318, 11.18, '2010-09-09 20:55:55', '2010-09-09 22:33:32', NULL, NULL);
INSERT INTO `dv_event` VALUES(51, 3, 0, 0, 43.8318, 11.18, 0, 43.8191, 11.1888, '2010-09-09 22:33:32', '2010-09-09 22:40:38', NULL, NULL);
INSERT INTO `dv_event` VALUES(52, 3, 0, 0, 43.8191, 11.1888, 0, 43.8191, 11.1888, '2010-09-09 22:40:38', '2010-09-09 22:44:34', NULL, NULL);
INSERT INTO `dv_event` VALUES(53, 3, 0, 0, 43.8191, 11.1888, 0, 43.7961, 11.0509, '2010-09-09 22:44:34', '2010-09-09 23:06:05', NULL, NULL);
INSERT INTO `dv_event` VALUES(54, 3, 0, 0, 43.7961, 11.0509, 0, 43.7961, 11.0509, '2010-09-09 23:06:05', '2010-09-09 23:17:14', NULL, NULL);
INSERT INTO `dv_event` VALUES(55, 3, 0, 0, 43.7934, 11.0472, 0, 43.7934, 11.0472, '2010-09-09 23:18:36', '2010-09-09 23:20:47', NULL, NULL);
INSERT INTO `dv_event` VALUES(56, 3, 0, 0, 43.7934, 11.0472, 0, 43.796, 11.0512, '2010-09-09 23:20:47', '2010-09-09 23:22:47', NULL, NULL);
INSERT INTO `dv_event` VALUES(57, 3, 0, 0, 43.7961, 11.0512, 0, 43.7961, 11.0512, '2010-09-09 23:22:47', '2010-09-10 19:56:39', NULL, NULL);
INSERT INTO `dv_event` VALUES(58, 3, 0, 0, 43.7961, 11.0512, 0, 43.772, 11.096, '2010-09-10 19:56:39', '2010-09-10 20:14:01', NULL, NULL);
INSERT INTO `dv_event` VALUES(59, 3, 0, 0, 43.772, 11.096, 0, 43.772, 11.096, '2010-09-10 20:14:01', '2010-09-10 20:16:09', NULL, NULL);
INSERT INTO `dv_event` VALUES(60, 3, 0, 0, 43.772, 11.096, 0, 43.7742, 11.2218, '2010-09-10 20:16:09', '2010-09-10 20:33:02', NULL, NULL);
INSERT INTO `dv_event` VALUES(61, 3, 0, 0, 43.7742, 11.2218, 0, 43.7742, 11.2218, '2010-09-10 20:33:02', '2010-09-10 20:37:02', NULL, NULL);
INSERT INTO `dv_event` VALUES(62, 3, 0, 0, 43.7742, 11.2218, 0, 43.7606, 11.2421, '2010-09-10 20:37:02', '2010-09-10 21:07:04', NULL, NULL);
INSERT INTO `dv_event` VALUES(63, 3, 0, 0, 43.7606, 11.2421, 0, 43.7606, 11.2421, '2010-09-10 21:07:04', '2010-09-10 21:09:12', NULL, NULL);
INSERT INTO `dv_event` VALUES(64, 3, 0, 0, 43.7606, 11.2421, 0, 43.7654, 11.2412, '2010-09-10 21:09:12', '2010-09-10 21:12:04', NULL, NULL);
INSERT INTO `dv_event` VALUES(65, 3, 0, 0, 43.7654, 11.2412, 0, 43.7654, 11.2412, '2010-09-10 21:12:04', '2010-09-10 21:16:34', NULL, NULL);
INSERT INTO `dv_event` VALUES(66, 3, 0, 0, 43.7654, 11.2412, 0, 43.767, 11.2478, '2010-09-10 21:16:34', '2010-09-10 21:27:35', NULL, NULL);
INSERT INTO `dv_event` VALUES(67, 3, 0, 0, 43.7666, 11.2456, 0, 43.7666, 11.2456, '2010-09-10 21:27:35', '2010-09-11 03:36:06', NULL, NULL);
INSERT INTO `dv_event` VALUES(68, 3, 0, 0, 43.7666, 11.2456, 0, 43.7666, 11.2409, '2010-09-11 03:36:06', '2010-09-11 03:37:54', NULL, NULL);
INSERT INTO `dv_event` VALUES(69, 3, 0, 0, 43.7658, 11.2411, 0, 43.7658, 11.2411, '2010-09-11 03:37:54', '2010-09-11 03:43:02', NULL, NULL);
INSERT INTO `dv_event` VALUES(70, 3, 0, 0, 43.7658, 11.2411, 0, 43.7961, 11.0508, '2010-09-11 03:43:02', '2010-09-11 04:12:55', NULL, NULL);
INSERT INTO `dv_event` VALUES(71, 3, 1, 0, 43.7961, 11.0508, 0, 43.7961, 11.0508, '2010-09-11 04:12:55', '2010-09-11 12:10:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dv_place`
--

CREATE TABLE `dv_place` (
  `id_place` int(10) unsigned NOT NULL auto_increment,
  `id_user` int(10) unsigned default NULL,
  `lat` float default NULL,
  `lon` float default NULL,
  `text` varchar(255) default NULL,
  PRIMARY KEY  (`id_place`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dv_place`
--


-- --------------------------------------------------------

--
-- Table structure for table `dv_user`
--

CREATE TABLE `dv_user` (
  `id_user` int(10) unsigned NOT NULL auto_increment,
  `oauth_id` text,
  `oauth_token` text,
  `oauth_secret` text,
  `user_login` varchar(45) default NULL,
  `user_pass` varchar(45) default NULL,
  `user_email` varchar(45) default NULL,
  PRIMARY KEY  (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dv_user`
--

INSERT INTO `dv_user` VALUES(2, '36017645', '36017645-Xju5mwqzuGPdWtgwkadBQHcINtoxKs9MdbJBZpd2G', 'a3tjm4Y6ZNFWvRbMpqHDisQi6Md0r9cZ1lGwFhZnHyQ', 'grudelsud', NULL, NULL);
INSERT INTO `dv_user` VALUES(3, '18936853', '18936853-DiISBCDg9rze0UkqV2STMqkDClN1O6No4XFylbzUM', '3ic6jINxvvv2BRxSqEm6xYfRlCtE07c71STaq1Brxt0', 'liquene', NULL, NULL);
