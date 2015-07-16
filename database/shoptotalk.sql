-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2015 at 02:22 AM
-- Server version: 5.5.43
-- PHP Version: 5.5.26-1~dotdeb+7.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shoptotalk`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `valid` int(11) NOT NULL DEFAULT '1',
  `rdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(254) COLLATE utf8_bin NOT NULL,
  `createDate` datetime NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`_id`, `valid`, `rdate`, `title`, `createDate`) VALUES
(1, 1, '2015-06-27 10:14:35', 'Fashion', '0000-00-00 00:00:00'),
(2, 1, '2015-06-27 10:14:35', 'Computers', '0000-00-00 00:00:00'),
(3, 1, '2015-07-02 15:22:47', 'Cars', '0000-00-00 00:00:00'),
(4, 1, '2015-07-02 15:23:52', 'Kids', '0000-00-00 00:00:00'),
(5, 1, '2015-07-02 21:09:07', 'Cell Phones', '0000-00-00 00:00:00'),
(6, 1, '2015-07-04 10:15:56', 'Gadgets', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `valid` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `rdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createDate` datetime NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`_id`, `valid`, `user_id`, `post_id`, `rdate`, `createDate`, `text`) VALUES
(1, 1, 4, 2, '2015-07-05 17:58:31', '0000-00-00 00:00:00', 'tester! :)'),
(2, 1, 1, 2, '2015-07-05 17:58:44', '0000-00-00 00:00:00', 'ok nice :)'),
(3, 1, 4, 2, '2015-07-05 17:58:52', '0000-00-00 00:00:00', 'thanks a lot'),
(4, 1, 1, 2, '2015-07-05 18:01:04', '0000-00-00 00:00:00', 'ok its working'),
(5, 1, 4, 2, '2015-07-05 18:01:17', '0000-00-00 00:00:00', 'yes it is ! i think its very good thing to do right now'),
(6, 1, 4, 7, '2015-07-05 18:04:31', '0000-00-00 00:00:00', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.'),
(7, 1, 4, 11, '2015-07-05 18:12:38', '0000-00-00 00:00:00', 'very very nice'),
(8, 1, 4, 14, '2015-07-06 19:49:22', '0000-00-00 00:00:00', 'test'),
(9, 1, 1, 14, '2015-07-11 08:53:10', '0000-00-00 00:00:00', 'test+'),
(10, 1, 1, 17, '2015-07-11 20:05:32', '0000-00-00 00:00:00', 'etasdad'),
(11, 1, 1, 17, '2015-07-11 20:05:33', '0000-00-00 00:00:00', 'test'),
(12, 1, 1, 17, '2015-07-11 20:05:34', '0000-00-00 00:00:00', 'tesrad'),
(13, 1, 1, 12, '2015-07-11 20:05:42', '0000-00-00 00:00:00', 'סבבה'),
(14, 1, 1, 7, '2015-07-11 20:06:05', '0000-00-00 00:00:00', 'זה סבבה אבל מה עם להעביר את זסה לצד שני כי זה עברית וזה נכתב משמאל לימין');

-- --------------------------------------------------------

--
-- Table structure for table `loves`
--

CREATE TABLE IF NOT EXISTS `loves` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `rdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createDate` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `valid` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `loves`
--

INSERT INTO `loves` (`_id`, `rdate`, `createDate`, `user_id`, `post_id`, `valid`) VALUES
(1, '2015-07-05 17:57:24', '2015-07-05 17:57:24', 4, 1, 1),
(2, '2015-07-05 18:02:10', '2015-07-05 18:02:10', 4, 3, 1),
(3, '2015-07-05 18:03:56', '2015-07-05 18:03:56', 1, 5, 1),
(4, '2015-07-05 18:12:34', '2015-07-05 18:12:34', 4, 11, 1),
(5, '2015-07-06 19:49:11', '2015-07-06 19:49:11', 4, 14, 1),
(6, '2015-07-11 19:47:39', '2015-07-11 19:47:39', 1, 13, 1),
(7, '2015-07-11 20:05:25', '2015-07-11 20:05:25', 1, 17, 1),
(8, '2015-07-11 20:05:47', '2015-07-11 20:05:47', 1, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `loves_comments`
--

CREATE TABLE IF NOT EXISTS `loves_comments` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `rdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createDate` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `valid` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `loves_comments`
--

INSERT INTO `loves_comments` (`_id`, `rdate`, `createDate`, `user_id`, `comment_id`, `valid`) VALUES
(1, '2015-07-05 17:58:45', '2015-07-05 17:58:45', 1, 1, 1),
(2, '2015-07-05 18:01:29', '2015-07-05 17:58:53', 4, 3, 0),
(3, '2015-07-05 17:58:55', '2015-07-05 17:58:54', 4, 2, 1),
(4, '2015-07-05 18:01:30', '2015-07-05 18:01:30', 4, 4, 1),
(5, '2015-07-05 18:01:30', '2015-07-05 18:01:30', 4, 5, 1),
(6, '2015-07-11 20:05:46', '2015-07-11 20:05:46', 1, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `rdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createDate` datetime NOT NULL,
  `valid` int(11) NOT NULL DEFAULT '1',
  `msg` varchar(254) COLLATE utf8_bin NOT NULL,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `type` varchar(254) COLLATE utf8_bin NOT NULL,
  `type_id` int(11) NOT NULL,
  `socketResponse` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`_id`, `rdate`, `createDate`, `valid`, `msg`, `from_user`, `to_user`, `type`, `type_id`, `socketResponse`) VALUES
(1, '2015-07-05 17:57:42', '2015-07-05 17:57:39', 0, ' loved your post', 4, 1, 'posts', 1, '{"socket_id":"7y_oPZ4G0mj4rBSvAAAA","alertUser":"1","userMakeAction":"Mor Levanon","userMakeActionID":"4","post_id":"1","msg":" loved your post","type":"posts"}'),
(2, '2015-07-05 17:58:36', '2015-07-05 17:58:32', 0, ' commented on your post', 4, 1, 'posts', 2, '{"socket_id":"HGWfW0VQObEExHWYAAAD","alertUser":"1","userMakeAction":"Mor Levanon","userMakeActionID":"4","post_id":"2","msg":" commented on your post","type":"posts"}'),
(3, '2015-07-05 18:04:04', '2015-07-05 17:58:46', 0, ' loved your comment', 1, 4, 'posts', 2, '{"socket_id":"zUCruVF1I_rok-NZAAAE","alertUser":"4","userMakeAction":"Yossi Shaish","userMakeActionID":"1","post_id":"2","msg":" loved your comment","type":"posts"}'),
(4, '2015-07-05 18:02:15', '2015-07-05 17:58:55', 0, ' loved your comment', 4, 1, 'posts', 2, '{"socket_id":"HGWfW0VQObEExHWYAAAD","alertUser":"1","userMakeAction":"Mor Levanon","userMakeActionID":"4","post_id":"2","msg":" loved your comment","type":"posts"}'),
(5, '2015-07-05 18:02:15', '2015-07-05 18:02:10', 0, ' loved your post', 4, 1, 'posts', 3, '{"socket_id":"fU-PyNWnEQXRvKK1AAAT","alertUser":"1","userMakeAction":"Mor Levanon","userMakeActionID":"4","post_id":"3","msg":" loved your post","type":"posts"}'),
(6, '2015-07-05 18:04:04', '2015-07-05 18:03:56', 0, ' loved your post', 1, 4, 'posts', 5, '{"socket_id":"yWJPyO30pupgm-OKAAAW","alertUser":"4","userMakeAction":"Yossi Shaish","userMakeActionID":"1","post_id":"5","msg":" loved your post","type":"posts"}'),
(7, '2015-07-05 18:12:42', '2015-07-05 18:12:34', 0, ' loved your post', 4, 1, 'posts', 11, '{"socket_id":"ECo4rBPOOcsht9vRAAAY","alertUser":"1","userMakeAction":"Mor Levanon","userMakeActionID":"4","post_id":"11","msg":" loved your post","type":"posts"}'),
(8, '2015-07-05 18:12:42', '2015-07-05 18:12:38', 0, ' commented on your post', 4, 1, 'posts', 11, '{"socket_id":"ECo4rBPOOcsht9vRAAAY","alertUser":"1","userMakeAction":"Mor Levanon","userMakeActionID":"4","post_id":"11","msg":" commented on your post","type":"posts"}');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `rdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createDate` datetime NOT NULL,
  `valid` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `item_title` varchar(254) COLLATE utf8_bin NOT NULL,
  `item_price` double NOT NULL,
  `item_site` varchar(254) COLLATE utf8_bin NOT NULL,
  `item_image` varchar(254) COLLATE utf8_bin NOT NULL,
  `item_moreImages` text COLLATE utf8_bin NOT NULL,
  `item_url` varchar(254) COLLATE utf8_bin NOT NULL,
  `user_experience` text COLLATE utf8_bin NOT NULL,
  `user_price` double NOT NULL,
  `user_itemCategory` varchar(254) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`_id`, `rdate`, `createDate`, `valid`, `user_id`, `item_title`, `item_price`, `item_site`, `item_image`, `item_moreImages`, `item_url`, `user_experience`, `user_price`, `user_itemCategory`) VALUES
(1, '2015-07-05 17:55:34', '2015-07-05 17:55:34', 1, 1, 'So Jelly Bracelet Set', 3.21, 'Nasty Gal', 'http://i.ngimg.com/resources/nastygal/images/products/processed/54338.0.detail.jpg', 'http://i.ngimg.com/resources/nastygal/images/products/processed/54338.0.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/54338.2.detail.jpg', 'http://www.nastygal.com/product/so-jelly-bracelet-set', '', 3.21, '1'),
(2, '2015-07-05 17:58:21', '2015-07-05 17:58:21', 1, 1, 'CA by Vitamin A Tamarindo Reversible Bikini Bottom', 3.21, 'Nasty Gal', 'http://i.ngimg.com/resources/nastygal/images/products/processed/50718.0.detail.jpg', 'http://i.ngimg.com/resources/nastygal/images/products/processed/50718.0.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/50718.1.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/50718.2.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/50718.3.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/54338.0.browse-l.jpg', 'http://www.nastygal.com/product/ca-by-vitamin-a-tamarindo-reversible-bikini-bottom?fromStyleId=58439', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3.21, '1'),
(3, '2015-07-05 18:01:55', '2015-07-05 18:01:55', 1, 1, 'Vitamin A Olivia Bikini Bottom', 54.59, 'Nasty Gal', 'http://i.ngimg.com/resources/nastygal/images/products/processed/58439.0.detail.jpg', 'http://i.ngimg.com/resources/nastygal/images/products/processed/58439.0.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/58439.1.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/58439.2.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/58439.3.detail.jpg', 'http://www.nastygal.com/product/vitamin-a-olivia-bikini-bottom?fromStyleId=50717', '', 54.59, '1'),
(4, '2015-07-05 18:03:09', '2015-07-05 18:03:09', 1, 4, 'Minimale Animale The Mangrove American Flag Bikini Bottoms', 77.06, 'Nasty Gal', 'http://i.ngimg.com/resources/nastygal/images/products/processed/55695.0.detail.jpg', 'http://i.ngimg.com/resources/nastygal/images/products/processed/55695.0.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/55695.1.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/55695.2.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/55695.3.detail.jpg', 'http://www.nastygal.com/clothes-swimwear/minimale-animale-the-mangrove-american-flag-bikini-bottoms', '', 77.06, '1'),
(5, '2015-07-05 18:03:18', '2015-07-05 18:03:18', 1, 4, 'Minimale Animale Treachery Bikini Bottom', 77.06, 'Nasty Gal', 'http://i.ngimg.com/resources/nastygal/images/products/processed/55702.0.detail.jpg', 'http://i.ngimg.com/resources/nastygal/images/products/processed/55702.0.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/55702.1.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/55702.2.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/55702.3.detail.jpg', 'http://www.nastygal.com/product/minimale-animale-treachery-bikini-bottom?fromStyleId=55695', '', 77.06, '1'),
(6, '2015-07-05 18:03:28', '2015-07-05 18:03:28', 1, 1, 'CA by Vitamin A Chiara Metallic Bikini Tank Top', 3.21, 'Nasty Gal', 'http://i.ngimg.com/resources/nastygal/images/products/processed/50716.0.detail.jpg', 'http://i.ngimg.com/resources/nastygal/images/products/processed/50716.0.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/50716.1.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/50716.2.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/50716.3.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/54338.0.browse-l.jpg', 'http://www.nastygal.com/product/ca-by-vitamin-a-chiara-metallic-bikini-tank-top?fromStyleId=58439', '', 3.21, '1'),
(7, '2015-07-05 18:04:16', '2015-07-05 18:04:16', 1, 4, 'Nasty Gal x Minimale Animale Treachery Bikini', 141.28, 'Nasty Gal', 'http://i.ngimg.com/resources/nastygal/images/products/processed/48365.0.detail.jpg', 'http://i.ngimg.com/resources/nastygal/images/products/processed/48365.0.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/48365.1.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/48365.2.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/48365.3.detail.jpg', 'http://www.nastygal.com/product/nasty-gal-x-minimale-animale-treachery-bikini?fromStyleId=55702', '', 141.28, '1'),
(8, '2015-07-05 18:04:50', '2015-07-05 18:04:50', 1, 4, 'Minimale Animale The Showstopper Bikini Bottom', 3.21, 'Nasty Gal', 'http://i.ngimg.com/resources/nastygal/images/products/processed/50192.0.detail.jpg', 'http://i.ngimg.com/resources/nastygal/images/products/processed/50192.0.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/50192.1.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/50192.2.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/50192.3.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/54338.0.browse-l.jpg', 'http://www.nastygal.com/product/minimale-animale-the-showstopper-bikini-bottom?fromStyleId=48365', 'adable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n\n \nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\n\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a han', 3.21, '1'),
(9, '2015-07-05 18:06:40', '2015-07-05 18:06:40', 1, 4, 'Original Cube T9 Dual 4G Tablet PC 9.7'''' 2048x1536 Retina MTK8752 Octa Core 2G/32G Android 4.4  GPS 13MP BT TF card-in Tablet PCs from Computer & Office on Aliexpress.com | Alibaba Group', 223.66, 'aliexpress.com', 'http://g02.a.alicdn.com/kf/HTB1ScJXIFXXXXXOXXXXq6xXFXXXo/Original-Cube-T9-Dual-4G-Tablet-PC-9-7-2048x1536-Retina-MTK8752-Octa-Core-2G-32G.jpg', 'http://g02.a.alicdn.com/kf/HTB1ScJXIFXXXXXOXXXXq6xXFXXXo/Original-Cube-T9-Dual-4G-Tablet-PC-9-7-2048x1536-Retina-MTK8752-Octa-Core-2G-32G.jpg_350x350.jpg', 'http://www.aliexpress.com/item/Original-Cube-T9-Dual-4G-Tablet-PC-9-7-2048x1536-Retina-MTK8752-Octa-Core-2G-32G/32319068903.html', '', 223.66, '2'),
(10, '2015-07-05 18:07:22', '2015-07-05 18:07:22', 1, 1, 'Aliexpress.com : Buy Fanless Intel Compute Stick MeLE PCG01 Quad Core Mini PC Atom Z3735F 2GB DDR3 32GB eMMC HDMI WiFi Bluetooth Genuine Windows 8.1 from Reliable Mini PCs suppliers on Shenzhen MeLE Digital Technology Ltd.  | Alibaba Group', 169, 'aliexpress.com', 'http://g01.a.alicdn.com/kf/HTB1EXv7IpXXXXbdXpXXq6xXFXXXO/Fanless-Intel-Compute-Stick-MeLE-PCG01-Quad-Core-Mini-PC-Atom-Z3735F-2GB-DDR3-32GB-eMMC.jpg', '', 'http://www.aliexpress.com/store/product/Fanless-Intel-Compute-Stick-MeLE-PCG01-Quad-Core-Mini-PC-Atom-Z3735F-2GB-DDR3-32GB-eMMC/715968_32339140548.html?spm=5261.7681326.1998483377.43.U6gBgw', 'ble content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 169, '2'),
(11, '2015-07-05 18:08:27', '2015-07-05 18:08:27', 1, 1, 'Nasty Gal Vanity Pleated Dress', 7.71, 'Nasty Gal', 'http://i.ngimg.com/resources/nastygal/images/products/processed/51003.0.detail.jpg', 'http://i.ngimg.com/resources/nastygal/images/products/processed/51003.0.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/51003.1.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/51003.2.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/51003.3.detail.jpg,http://i.ngimg.com/resources/nastygal/images/products/processed/45537.0.browse-s.jpg', 'http://www.nastygal.com/sale/nasty-gal-vanity-pleated-dress', '', 7.71, '1'),
(12, '2015-07-05 18:10:48', '2015-07-05 18:10:48', 1, 1, 'נעלי בובה בשילוב קשירה', 149, 'adikastyle', 'http://cdn.adikastyle.com/media/catalog/product/cache/2/image/265x/9df78eab33525d08d6e5fb8d27136e95/a/d/adika_11-06-15_-15220.jpg', 'http://cdn.adikastyle.com/media/catalog/product/cache/2/thumbnail/322x485/9df78eab33525d08d6e5fb8d27136e95/i/m/img_0611.jpg,http://cdn.adikastyle.com/media/catalog/product/cache/2/thumbnail/322x485/9df78eab33525d08d6e5fb8d27136e95/i/m/img_0468_5.jpg,http://cdn.adikastyle.com/media/catalog/product/cache/2/thumbnail/322x485/9df78eab33525d08d6e5fb8d27136e95/a/d/adika_11-06-15_-15330_2.jpg,http://www.adikastyle.com/skin/frontend/adika/default/images/payment.gif,http://www.adikastyle.com/skin/frontend/adika/default/images/payment.gif', 'http://www.adikastyle.com/shoes/neli-bvbh-bwilvb-qwirh.html', '', 149, '1'),
(13, '2015-07-05 18:12:20', '2015-07-05 18:12:20', 1, 4, 'Aliexpress.com : Buy PIPO X7 Mini PC TV BOX Quad Core Intel Atom Z3736F  Windows 8.1 OS With Bing TV Player 2GB/32GB  HDMI Cable from Reliable windows xbox suppliers on Bloomberg Mikki  | Alibaba Group', 117.99, 'aliexpress.com', 'http://g02.a.alicdn.com/kf/HTB1fUSvHFXXXXb4aXXXq6xXFXXXe/PIPO-X7-Mini-PC-TV-BOX-Quad-Core-Intel-Atom-Z3736F-Windows-8-1-OS-With.jpg', '', 'http://www.aliexpress.com/store/product/PIPO-X7-Mini-PC-TV-stick-Quad-Core-Intel-Atom-Z3736F-Windows-8-1-with-Bing/321958_32266506413.html?spm=5261.7681326.1998483377.27.U6gBgw', 'ry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n\n \nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of', 117.99, '2'),
(14, '2015-07-05 18:13:37', '2015-07-05 18:13:37', 1, 1, 'חולצת מיראז'' בגזרת קרופ', 129, 'adikastyle', 'http://cdn.adikastyle.com/media/catalog/product/cache/2/image/265x/9df78eab33525d08d6e5fb8d27136e95/i/m/img_6647_2.jpg', '', 'http://www.adikastyle.com/new/hvlct-miraz-bgzrt-qrvp-18694.html', '', 129, '1'),
(15, '2015-07-11 20:03:28', '2015-07-11 20:03:28', 1, 1, 'Aliexpress.com : Buy NEW Sport Action Camera S55/S55W WIFI 1080P FULL HD 1.5 LTPS micro Camcorder Helmet Bike Outdoor Sports DV DVR Gopro Style from Reliable camera plane suppliers on Bloomberg Mikki  | Alibaba Group', 79.99, 'aliexpress.com', 'http://i01.i.aliimg.com/wsphoto/v0/32310404191_1/NEW-Sport-Action-Camera-S55-S55W-WIFI-1080P-FULL-HD-1-5-LTPS-micro-Camcorder-Helmet.jpg', '', 'http://www.aliexpress.com/store/product/NEW-Sport-Action-Camera-S55-S55W-WIFI-1080P-FULL-HD-1-5-LTPS-micro-Camcorder-Helmet/321958_32310404191.html', '', 79.99, '2'),
(16, '2015-07-11 20:04:07', '2015-07-11 20:04:07', 1, 1, 'טופ ביקיני משולשים אוליב', 79, 'adikastyle', 'http://cdn.adikastyle.com/media/catalog/product/cache/2/image/265x/9df78eab33525d08d6e5fb8d27136e95/i/m/img_7538_2.jpg', '', 'http://www.adikastyle.com/clothes/swimsuit/tvp-biqini-mwvlwim-avlib-18084.html', '', 79, '1'),
(17, '2015-07-11 20:05:11', '2015-07-11 20:05:11', 1, 1, 'Sunding Electronic Bicycle Computer/Speedometer', 3.3, 'DX.com', '//img.dxcdn.com/productimages/sku_24075_1.jpg', '', 'http://www.dx.com/p/sunding-electronic-bicycle-computer-speedometer-24075#.VaF26_mqpBc', '', 3.3, '6');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(254) COLLATE utf8_bin NOT NULL,
  `lname` varchar(254) COLLATE utf8_bin NOT NULL,
  `nickname` varchar(254) COLLATE utf8_bin NOT NULL,
  `email` varchar(254) COLLATE utf8_bin NOT NULL,
  `password` varchar(254) COLLATE utf8_bin NOT NULL,
  `gender` tinytext COLLATE utf8_bin NOT NULL,
  `age` int(11) NOT NULL,
  `birthDate` date NOT NULL,
  `country` varchar(2) COLLATE utf8_bin NOT NULL,
  `city` varchar(254) COLLATE utf8_bin NOT NULL,
  `bestShop` varchar(254) COLLATE utf8_bin NOT NULL,
  `valid` int(11) NOT NULL DEFAULT '1',
  `regDate` datetime NOT NULL,
  `createDate` datetime NOT NULL,
  `profilePicture` varchar(254) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`_id`, `fname`, `lname`, `nickname`, `email`, `password`, `gender`, `age`, `birthDate`, `country`, `city`, `bestShop`, `valid`, `regDate`, `createDate`, `profilePicture`) VALUES
(1, 'Yossi', 'Shaish', '', 'utQWClluxEDFVZ+/b3EqFImcToE28jkM7yTw6CkvM8M=', 'gV3rQZIo6GL+MgxWgt5Z5xL0EpQt2pRzJUnRUJZanyA=', 'male', 26, '1989-04-04', 'IL', 'Rishon LeZion', 'Ebay', 1, '2015-06-23 07:39:12', '0000-00-00 00:00:00', '/uploads/profilePictures/0.d1fe004cbf.jpg?1436605502'),
(4, 'Mor', 'Levanon', '', 'bhXBkDFVzTxr8UzJaUtdQQHTv8SQ5svSw8zNz9U+yLw=', 'gV3rQZIo6GL+MgxWgt5Z5xL0EpQt2pRzJUnRUJZanyA=', 'female', 26, '2015-11-30', 'IL', '', 'NastyGal', 1, '2015-06-24 05:38:47', '0000-00-00 00:00:00', '/uploads/profilePictures/0.2e4356355b.jpg?1436006756');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
