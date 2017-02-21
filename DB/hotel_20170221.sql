-- phpMyAdmin SQL Dump
-- version 4.0.10.17
-- https://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成日時: 2017 年 2 月 19 日 06:57
-- サーバのバージョン: 5.5.52
-- PHP のバージョン: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `hotel`
--
CREATE DATABASE IF NOT EXISTS `hotel` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `hotel`;

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_activity`
--

DROP TABLE IF EXISTS `pm_activity`;
CREATE TABLE IF NOT EXISTS `pm_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `hotels` varchar(250) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `max_children` int(11) DEFAULT '1',
  `max_adults` int(11) DEFAULT '1',
  `max_people` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `descr` longtext,
  `duration` float DEFAULT '0',
  `duration_unit` varchar(50) DEFAULT NULL,
  `price` double DEFAULT '0',
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `activity_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 挿入前にテーブルを空にする `pm_activity`
--

TRUNCATE TABLE `pm_activity`;
--
-- テーブルのデータのダンプ `pm_activity`
--

INSERT INTO `pm_activity` (`id`, `lang`, `hotels`, `id_user`, `max_children`, `max_adults`, `max_people`, `title`, `subtitle`, `alias`, `descr`, `duration`, `duration_unit`, `price`, `lat`, `lng`, `home`, `checked`, `rank`) VALUES
(1, 2, '1', 1, 3, 3, 3, '11/30 System ', 'subsystem', 'prosen', '<p>dshashabsakfjsaljfsjffg</p>\r\n', 4, 'hour(s)', 2000, 45, 67, 0, 1, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_activity_file`
--

DROP TABLE IF EXISTS `pm_activity_file`;
CREATE TABLE IF NOT EXISTS `pm_activity_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `activity_file_fkey` (`id_item`,`lang`),
  KEY `activity_file_lang_fkey` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 挿入前にテーブルを空にする `pm_activity_file`
--

TRUNCATE TABLE `pm_activity_file`;
-- --------------------------------------------------------

--
-- テーブルの構造 `pm_activity_session`
--

DROP TABLE IF EXISTS `pm_activity_session`;
CREATE TABLE IF NOT EXISTS `pm_activity_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_activity` int(11) NOT NULL,
  `days` varchar(20) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `price` double DEFAULT '0',
  `price_child` double DEFAULT '0',
  `discount` double DEFAULT '0',
  `vat_rate` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_session_fkey` (`id_activity`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 挿入前にテーブルを空にする `pm_activity_session`
--

TRUNCATE TABLE `pm_activity_session`;
--
-- テーブルのデータのダンプ `pm_activity_session`
--

INSERT INTO `pm_activity_session` (`id`, `id_activity`, `days`, `start_date`, `end_date`, `id_user`, `price`, `price_child`, `discount`, `vat_rate`) VALUES
(1, 1, '1', 1477958400, 1479340800, 1, 10, 5, 0, 100);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_activity_session_hour`
--

DROP TABLE IF EXISTS `pm_activity_session_hour`;
CREATE TABLE IF NOT EXISTS `pm_activity_session_hour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_activity_session` int(11) NOT NULL,
  `start_h` int(11) DEFAULT NULL,
  `start_m` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_session_hour_fkey` (`id_activity_session`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 挿入前にテーブルを空にする `pm_activity_session_hour`
--

TRUNCATE TABLE `pm_activity_session_hour`;
-- --------------------------------------------------------

--
-- テーブルの構造 `pm_article`
--

DROP TABLE IF EXISTS `pm_article`;
CREATE TABLE IF NOT EXISTS `pm_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `text` longtext,
  `url` varchar(250) DEFAULT NULL,
  `tags` varchar(250) DEFAULT NULL,
  `id_page` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `publish_date` int(11) DEFAULT NULL,
  `unpublish_date` int(11) DEFAULT NULL,
  `comment` int(11) DEFAULT '0',
  `rating` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `article_lang_fkey` (`lang`),
  KEY `article_page_fkey` (`id_page`,`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 挿入前にテーブルを空にする `pm_article`
--

TRUNCATE TABLE `pm_article`;
--
-- テーブルのデータのダンプ `pm_article`
--

INSERT INTO `pm_article` (`id`, `lang`, `title`, `subtitle`, `alias`, `text`, `url`, `tags`, `id_page`, `id_user`, `home`, `checked`, `rank`, `add_date`, `edit_date`, `publish_date`, `unpublish_date`, `comment`, `rating`) VALUES
(1, 2, 'Dive into unknown waters!', '', 'scuba-diving', '<p><img alt="" src="/medias/article/tmp/13d5d4b85d61bbbfe53cf060d3255ab0/2/5895b4c520553/20131226-164820000-ios.jpg" style="height:480px; width:359px" />Lorem ipsum dolor sit amet consectetur adipiscing elit. Nullam molestie, nunc eu consequat varius, nisi metus iaculis nulla, nec ornare odio leo quis eros. Donec gravida eget velit eget pulvinar. Phasellus eget est quis est faucibus condimentum. Morbi tellus turpis, posuere vel tincidunt non, varius ac ante. Suspendisse in sem neque. Donec et faucibus justo. Nulla vitae nisl lacus. Fusce tincidunt quam nec vestibulum vestibulum. Vivamus vulputate, nunc non ullamcorper mattis, nunc orci imperdiet nulla, at laoreet ipsum nisl non leo. Aenean dapibus aliquet sem, ut lacinia magna mattis in.</p>\r\n\r\n<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur tempor arcu eu sapien ullamcorper sodales. Aenean eu massa in ante commodo scelerisque vitae sed sapien. Aenean eu dictum arcu. Mauris ultricies dolor eu molestie egestas.<br />\r\nProin feugiat, nunc at pellentesque fringilla, ex purus efficitur dolor, ac pretium odio lacus id leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse eu ipsum viverra dolor tempus vehicula eu eu risus. Praesent rutrum dapibus odio, nec accumsan justo fermentum in. Ut quis neque a ante facilisis bibendum.</p>\r\n', '', '', 5, 1, 0, 1, 1, 1477450356, 1486206154, NULL, NULL, 1, 0),
(4, 2, 'First gallery', '', 'first-gallery', '<p><img alt="" src="/medias/article/big/10/20140130-130542000-ios.jpg" style="height:848px; width:600px" /></p>\r\n', '', '', 7, 1, 0, 1, 2, 1477450356, 1486206453, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_article_file`
--

DROP TABLE IF EXISTS `pm_article_file`;
CREATE TABLE IF NOT EXISTS `pm_article_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `article_file_fkey` (`id_item`,`lang`),
  KEY `article_file_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 挿入前にテーブルを空にする `pm_article_file`
--

TRUNCATE TABLE `pm_article_file`;
--
-- テーブルのデータのダンプ `pm_article_file`
--

INSERT INTO `pm_article_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(4, 2, 4, 0, 1, 4, 'sample4.jpg', '', 'image'),
(5, 2, 1, 0, 1, 5, 'diving.jpg', '', 'image'),
(6, 2, 1, NULL, 1, 6, 'dragon.jpg', '', 'image'),
(7, 2, 1, NULL, 1, 7, '20131217-082151000-ios.jpg', '', 'image'),
(8, 2, 1, NULL, 1, 8, '20131217-084240000-ios.jpg', '', 'image'),
(9, 2, 1, NULL, 1, 9, '20131226-164820000-ios.jpg', NULL, 'image'),
(10, 2, 4, NULL, 1, 10, '20140130-130542000-ios.jpg', '', 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_booking`
--

DROP TABLE IF EXISTS `pm_booking`;
CREATE TABLE IF NOT EXISTS `pm_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_room` int(11) NOT NULL,
  `room` varchar(100) DEFAULT NULL,
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `from_date` int(11) DEFAULT NULL,
  `to_date` int(11) DEFAULT NULL,
  `nights` int(11) DEFAULT '1',
  `adults` int(11) DEFAULT '1',
  `children` int(11) DEFAULT '1',
  `amount` float DEFAULT NULL,
  `tourist_tax` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `down_payment` float DEFAULT NULL,
  `extra_services` text,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `comments` text,
  `status` int(11) DEFAULT '1',
  `trans` varchar(50) DEFAULT NULL,
  `payment_date` int(11) DEFAULT NULL,
  `payment_method` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- 挿入前にテーブルを空にする `pm_booking`
--

TRUNCATE TABLE `pm_booking`;
--
-- テーブルのデータのダンプ `pm_booking`
--

INSERT INTO `pm_booking` (`id`, `id_room`, `room`, `add_date`, `edit_date`, `from_date`, `to_date`, `nights`, `adults`, `children`, `amount`, `tourist_tax`, `total`, `down_payment`, `extra_services`, `firstname`, `lastname`, `email`, `company`, `address`, `postcode`, `city`, `phone`, `mobile`, `country`, `comments`, `status`, `trans`, `payment_date`, `payment_method`) VALUES
(1, 1, '新宿民宿', 1485180271, 1485180536, 1485129600, 1485129600, 1, 2, 2, 145, 1.08, 200, 0, '', 'yuefuquan', '11', 'yuefuquan@gmail.com', '', 'dddd', '2400001', '344', '090-9898089', '', '中国', '', 3, '201701231005215661', NULL, '只预约'),
(17, 7, '桥本旅店', 1485850684, NULL, 1486857600, 1487116800, 3, 1, 0, NULL, NULL, 0, NULL, NULL, 'yuefuquanf', NULL, NULL, NULL, NULL, NULL, NULL, '090-9898089', NULL, '中国', '', 1, '201701310418065217', NULL, '只预约'),
(18, 2, '四季旅馆 尾之间', 1485899624, 1485901073, 1486857600, 1487203200, 4, 1, 0, 400, NULL, 0, NULL, NULL, 'TEST-WK', NULL, NULL, NULL, NULL, NULL, NULL, '13612341234', '', '中国', '', 4, '201702010614086928', NULL, '只预约'),
(19, 7, '桥本旅店', 1485901382, NULL, 1487289600, 1487548800, 3, 1, 0, NULL, NULL, 0, NULL, NULL, 'TEST-WK', NULL, NULL, NULL, NULL, NULL, NULL, '13612341234', NULL, '中国', '带条狗', 1, '201702010623091222', NULL, '只预约'),
(20, 6, 'YAGURA', 1485901425, 1486505001, 1487376000, 1487808000, 5, 2, 1, 400, NULL, 0, NULL, NULL, 'TEST-WK', NULL, NULL, NULL, NULL, NULL, NULL, '13612341234', '', '中国', '带两条狗', 2, '201702010623488714', NULL, '只预约'),
(24, 6, 'YAGURA', 1486006286, NULL, 1486166400, 1486598400, 5, 1, 0, NULL, NULL, 25000, NULL, NULL, 'yuefuquanf', NULL, NULL, NULL, NULL, NULL, NULL, '090-9898089', NULL, '中国', '', 1, '201702021131307712', NULL, '只预约'),
(25, 6, 'YAGURA', 1486006319, NULL, 1486166400, 1486771200, 7, 1, 0, NULL, NULL, 35000, NULL, NULL, 'yuefuquanf', NULL, NULL, NULL, NULL, NULL, NULL, '090-9898089', NULL, '中国', '', 4, '201702021132029089', NULL, 'paypal'),
(26, 7, '桥本旅店', 1486007146, NULL, 1486166400, 1486771200, 7, 1, 0, NULL, NULL, 42000, NULL, NULL, 'yuefuquanf', NULL, NULL, NULL, NULL, NULL, NULL, '090-9898089', NULL, '中国', '', 4, '201702021145488645', NULL, 'paypal'),
(29, 4, '厚岸旅店', 1486007312, NULL, 1486166400, 1486771200, 7, 1, 0, NULL, NULL, 42000, NULL, NULL, 'yuefuquanf', NULL, NULL, NULL, NULL, NULL, NULL, '090-9898089', NULL, '中国', '', 4, '201702021148373355', NULL, 'paypal'),
(30, 7, '桥本旅店', 1486007375, NULL, 1487203200, 1487289600, 1, 1, 0, NULL, NULL, 6000, NULL, NULL, 'yuefuquanf', NULL, NULL, NULL, NULL, NULL, NULL, '090-9898089', NULL, '中国', '', 4, '201702021149371610', NULL, 'paypal'),
(31, 7, '桥本旅店', 1486008331, NULL, 1485993600, 1486080000, 1, 1, 0, NULL, NULL, 6000, NULL, NULL, 'yuefuquanf', NULL, NULL, NULL, NULL, NULL, NULL, '090-9898089', NULL, '中国', '', 4, '201702021205353620', NULL, 'paypal'),
(32, 7, '桥本旅店', 1486074761, NULL, 1487980800, 1488067200, 1, 1, 1, NULL, NULL, 6000, NULL, NULL, 'TEST-WK', NULL, NULL, NULL, NULL, NULL, NULL, '13612341234', NULL, '中国', '测试19', 4, '201702030632482040', NULL, 'paypal'),
(33, 7, '桥本旅店', 1486196186, NULL, 1486857600, 1486944000, 1, 1, 0, NULL, NULL, 6000, NULL, NULL, 'TEST-WK', NULL, NULL, NULL, NULL, NULL, NULL, '13612341234', NULL, '中国', '', 4, '201702040416335482', NULL, 'paypal'),
(34, 5, '厚岸旅店', 1486197628, NULL, 1486339200, 1486425600, 1, 1, 0, NULL, NULL, 4500, NULL, NULL, 'TEST-WK', NULL, NULL, NULL, NULL, NULL, NULL, '13612341234', NULL, '中国', '', 1, '201702040440321788', NULL, '只预约'),
(35, 5, '桥本旅店', 1486337213, 1486420339, 1487635200, 1487721600, 1, 1, 0, 400, NULL, 6000, NULL, NULL, '三王', NULL, NULL, NULL, NULL, NULL, NULL, '13835506122', '', '中国', '手机版信息录入时，看不到任何录入信息。一片白屏！', 3, '201702060727142002', NULL, '只预约'),
(36, 6, 'YAGURA', 1486347267, NULL, 1486857600, 1486857600, 1, 2, 1, NULL, NULL, 5000, NULL, NULL, 'yuefuquanf', NULL, NULL, NULL, NULL, NULL, NULL, '090-9898089', NULL, '中国', '', 1, '201702061014329911', NULL, '只预约'),
(37, 6, 'YAGURA', 1486420414, NULL, 1487980800, 1488067200, 1, 1, 0, NULL, NULL, 5000, NULL, NULL, '三王', NULL, NULL, NULL, NULL, NULL, NULL, '13835506122', NULL, '中国', 'pc登陆', 1, '201702070633429855', NULL, '只预约'),
(38, 4, '厚岸旅店', 1486420479, NULL, 1487376000, 1487462400, 1, 1, 0, NULL, NULL, 6000, NULL, NULL, '三王', NULL, NULL, NULL, NULL, NULL, NULL, '13835506122', NULL, '中国', 'PC登陆2', 4, '201702070634459523', NULL, 'paypal'),
(39, 6, 'YAGURA', 1486469840, NULL, 1487980800, 1488067200, 1, 2, 0, NULL, NULL, 5000, NULL, NULL, '三王', NULL, NULL, NULL, NULL, NULL, NULL, '13835506122', NULL, '中国', '手机登陆', 4, '201702070817345656', NULL, 'paypal'),
(40, 4, '厚岸旅店', 1486469967, 1486505270, 1488153600, 1488240000, 1, 5, 2, 200, NULL, 6000, NULL, NULL, '三王', NULL, NULL, NULL, NULL, NULL, NULL, '13835506122', '', '中国', '手机用户2', 3, '201702070819365657', NULL, '只预约'),
(41, 4, '厚岸旅店', 1486477905, NULL, 1486857600, 1487116800, 3, 1, 0, NULL, NULL, 18000, NULL, NULL, 'yuefuquanf', NULL, NULL, NULL, NULL, NULL, NULL, '090-9898089', NULL, '中国', '', 1, '201702071031498026', NULL, '只预约'),
(42, 6, 'YAGURA', 1487221471, NULL, 1487203200, 1487894400, 8, 1, 0, NULL, NULL, 40000, NULL, NULL, 'yuefuquanf', NULL, NULL, NULL, NULL, NULL, NULL, '090-9898089', NULL, '中国', '', 1, '201702160104332193', NULL, '只预约');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_booking_activity`
--

DROP TABLE IF EXISTS `pm_booking_activity`;
CREATE TABLE IF NOT EXISTS `pm_booking_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_booking` int(11) NOT NULL,
  `id_activity` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `children` int(11) DEFAULT '0',
  `adults` int(11) DEFAULT '0',
  `duration` varchar(50) DEFAULT NULL,
  `amount` double DEFAULT '0',
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_activity_fkey` (`id_booking`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 挿入前にテーブルを空にする `pm_booking_activity`
--

TRUNCATE TABLE `pm_booking_activity`;
-- --------------------------------------------------------

--
-- テーブルの構造 `pm_category`
--

DROP TABLE IF EXISTS `pm_category`;
CREATE TABLE IF NOT EXISTS `pm_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `value` varchar(250) DEFAULT NULL,
  `category` varchar(250) DEFAULT NULL,
  `pages` varchar(250) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `category_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 挿入前にテーブルを空にする `pm_category`
--

TRUNCATE TABLE `pm_category`;
--
-- テーブルのデータのダンプ `pm_category`
--

INSERT INTO `pm_category` (`id`, `lang`, `value`, `category`, `pages`, `checked`, `rank`) VALUES
(1, 2, '1', '通知', NULL, 1, 0),
(2, 2, '2', '提醒', NULL, 1, 0),
(3, 2, '3', '优惠', NULL, 1, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter`
--

DROP TABLE IF EXISTS `pm_charter`;
CREATE TABLE IF NOT EXISTS `pm_charter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charter_type` int(11) NOT NULL DEFAULT '1',
  `lang` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `city` int(11) DEFAULT NULL COMMENT '接送城市',
  `destination` varchar(250) DEFAULT NULL COMMENT '目的地',
  `lat` double DEFAULT NULL COMMENT '纬度',
  `lng` double DEFAULT NULL COMMENT '经度',
  `descr` longtext,
  `facilities` varchar(250) DEFAULT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `add_date` int(11) DEFAULT NULL COMMENT '作成时间',
  `edit_date` int(11) DEFAULT NULL COMMENT '更新时间',
  `comment_count` int(11) DEFAULT '0' COMMENT '评论数',
  `like_count` int(11) DEFAULT '0' COMMENT '赞的个数',
  `book_count` int(11) DEFAULT '0' COMMENT '预约个数',
  `score_count` double(8,1) DEFAULT '0.0' COMMENT '顾客评分',
  `default_charter` int(11) DEFAULT '0' COMMENT '默认车主',
  `recommend` int(11) DEFAULT '0' COMMENT '是否推荐',
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 挿入前にテーブルを空にする `pm_charter`
--

TRUNCATE TABLE `pm_charter`;
--
-- テーブルのデータのダンプ `pm_charter`
--

INSERT INTO `pm_charter` (`id`, `charter_type`, `lang`, `id_user`, `title`, `subtitle`, `alias`, `city`, `destination`, `lat`, `lng`, `descr`, `facilities`, `home`, `checked`, `rank`, `add_date`, `edit_date`, `comment_count`, `like_count`, `book_count`, `score_count`, `default_charter`, `recommend`) VALUES
(1, 1, 2, 1, '京都送迎', '京都送迎服务', 'jingdou01', 1, '机场', NULL, NULL, '<p>京都（Kyoto），位于日本西部近畿京都府南部，是一座内陆城市，坐落在京都盆地（山城）的北半部和丹波高原的东部山区，总面积为827.90km2，占京都府总面积的17.9%。是京都府各县市中土地面积最大的一座城市。 京都为京都府府厅所在地，也是政令指定都市之一，是日本人口第八多的都市。京都市还和京都府南部、滋贺县西部及大阪府的部分地区共同组成了京都都市圈，其人口数约有256万。</p>\r\n', NULL, 1, 1, 1, 1480836089, 1487108842, 0, 0, 0, 0.0, 1, 1),
(2, 2, 2, 1, '大阪一日游', '大阪一日游', 'daban01', 2, '机场', NULL, NULL, '<p>大阪（Osaka），位于日本西部近畿地方大阪府的都市，是大阪府的府厅所在地，也是政令指定都市之一。大阪市面积223平方公里，总人口约有267万人，是日本次于东京、横滨人口第三多的城市。<br />\r\n“大阪”在古代多称为“大坂”，而“大坂”一词最早出现在室町时代。自奈良时代开始，大阪就因其临海的地理位置成为贸易港口。丰臣秀吉修建大阪城，并以大阪作为丰臣政权的统治核心城市。在江户时代，大阪和京都江户并称为“三都”，是当时日本经济活动最为旺盛的商业都市。在战后，仍是西日本的大都市。<br />\r\n大阪拥有以钢铁、机械制造、金属加工为主的重工业和以纺织、印刷、食品、造纸和化工为主的轻工业。全市有10万余家各类商店。大阪也以独特的文化而著称。在城市的阪急区，还有繁华的地下街。工商活动规模和大众运输捷运铁道密度均居日本前茅。</p>\r\n', NULL, 0, 1, 2, 1480844210, 1486948186, 0, 0, 0, 0.0, 1, 0),
(3, 2, 2, 1, '冲绳三日游', '冲绳三日游', 'chongshen01', 3, '机场', NULL, NULL, '<p>冲绳县处于日本九州岛和中国台湾省之间，是受美国托管行政权的日本自治海岛县，以冲绳诸岛为中心，由宫古诸岛、八重山诸岛等岛屿组成，众多小的岛屿沿中国大陆围成一个弧线，土地面积占日本总面积的0.6%左右，在47个都道府县中位于第44位。富有独特的自然环境，除了具有东南亚、中国、日本的民俗风情建筑外，较日本本土更具有独特的美式风情，有“日本的夏威夷”之称，是空手道的故乡。气候温暖宜人，是亚热带海洋性气候地区。经济以旅游业最为发达，由于处在太平洋的大陆架上，其附近水域鱼获丰富，渔业为冲绳人多从事的行业。</p>\r\n', NULL, 0, 1, 3, 1480909505, 1480909505, 0, 0, 0, 0.0, 0, 0),
(4, 2, 2, 1, '京都一日游', '京都一日游', 'jingdou02', 1, '机场', NULL, NULL, '<p>京都盆地东部也因其地势较高且较为干燥适宜居住，成为京都市内最早开发的地区。京都市东南部的山科区和伏见区的醍醐地区则位于山科盆地，其和京都盆地之间由清水山、稻荷山等山峰隔开。京都市的北部地区则多为山地，其中较为知名的有大文字山、比睿山、岚山等。京都市内的最高点是爱宕山，海拔924米。京都盆地三面环山，分别是东山、北山和西山，各山的海拔为1000米以下，整个盆地是东北为高，西南较低。</p>\r\n', NULL, 1, 1, 4, 1480910513, 1480922404, 0, 0, 0, 0.0, 0, 0),
(5, 1, 2, 1, '冲绳送迎', '冲绳送迎服务', 'chongshen02', 3, '机场', NULL, NULL, '<p>冲绳本原名叫“オキナワ，汉语称为“”琉球“（琉球本是台湾古称，后借指オキナワ）”，据鉴真东渡记载，唐宋时期为九州南藩阿儿奈波，宋末时建立独立国家。明清时代为中国的附属国，明末亦成为日本藩属国。冲绳是日本根据琉球本土译音而形成的称呼，而“”琉球“”是中国明朝时期中国人用台湾古称借指该群岛。自古以来与中国、日本、朝鲜及东南亚国家保持紧密的文化交流和海外贸易，所以和日本本部的风俗文化、食物、材料、建筑风格与日本有着很大的差异。</p>\r\n', NULL, 1, 1, 5, 1480918030, 1487108891, 0, 0, 0, 0.0, 1, 0),
(6, 1, 2, 1, '大阪送迎', '大阪送迎服务', 'daban02', 2, '机场', NULL, NULL, '<p>大阪市历史悠久，在森之宫附近发现的遗迹证明大阪自绳文时代中期就开始有人居住。古坟时代时，大阪地区因河内湖的湖水淡化变得适合耕作。加上临海的地理环境使得大阪成为贸易港口。</p>\r\n', NULL, 0, 1, 6, 1480918917, 1487108949, 5, 0, 0, 4.2, 1, 0),
(7, 1, 2, 1, '神户送迎服务', '机场送迎', 'airport-service', 4, '关西机场', NULL, NULL, '', NULL, 1, 1, 7, 1487195680, 1487195680, NULL, NULL, NULL, NULL, 2, 1),
(8, 2, 2, 1, '神户二日游', '近郊旅游', 'travle', 4, '神户酒店', NULL, NULL, '<p>神户市是位于日本西部近畿地区兵库县的都市，为兵库县县厅所在地，也是政令指定城市之一，下辖有9个区。神户市的面积为552.83平方公里。2016年6月，神户市有人口1,538,053人，是日本人口第七多的都市。神户市和大阪市、京都市并为京阪神都会区的核心都市，同时神户市也和其附近的卫星都市组成神户都市圈。</p>\r\n\r\n<p>“神户”这一地名是起源于现在神户市中心的三宫、元町地区在古代曾是生田神社的领地，并居住有生田神社的神封户。神户地处大阪湾沿岸，风浪平缓且沿岸水深较深，地形极为适宜建设港口。在古代时期，神户就是京都及大阪的外港之一。1868年，神户成为日本最早开放对外国通商的五个港口之一，之后神户迅速发展为日本最重要的港湾都市之一。也正因其是日本最早的通商港口，神户以开放和国际化的气氛而闻名。1995年的阪神大地震虽然给神户带来巨大的打击，然而经过多年的重建，神户的都市建设和人口都已超过地震之前的水准。神户也是一座宜居都市，并曾在2007年入选福布斯杂志评出的“世界最清洁的25座城市”，其后也于2012年在瑞士的咨询公司ECA国际评选出的世界宜居都市排名中排名第五位，是唯一入选前10位的日本都市。</p>\r\n', NULL, 1, 1, 8, 1487197336, 1487197336, NULL, NULL, NULL, NULL, 2, 1),
(9, 3, 2, 1, '神户特色一日游', '特色旅游', 'travle-service', 4, '神户王子酒店', NULL, NULL, '<p>神户是日本重要的观光都市。六甲山的自然景观和有马温泉度假区、充满异国风情的市区、港湾景观是神户最重要的观光资源。六甲山虽位于都市近郊，却保有丰富的自然景观。早在开港初期，欧美人就在这里修建别庄和高尔夫球场，开始将六甲山建设为日本最早的都市近郊型度假地。六甲山还是日本近代登山运动的发祥地。今日的六甲山也仍然是深受神户市民喜爱的郊游地。而位于六甲山地北侧的有马温泉是日本三大温泉之一，也是日本最早得到开发的温泉疗养地，在古代就有众多达官贵人和文人墨客到访这里。今日的有马温泉亦凭借其靠近大都市圈的优越地理位置吸引众多游客到访。2012年时，有马温泉的游客数达到152万人。神户市内最能体验异国风情的地区则是集中众多西洋建筑的北野町山本通、旧居留地，以及唐人街南京町。北野町山本通的异人馆中，以风见鸡馆最为闻名，其屋顶的鸡型风向标现在已经成为神户的象征。虽然阪神大地震使得北野的不少异人馆严重毁坏，然而受损的建筑之后大多按照原样忠实重建。北野的一些洋馆现在更被改建为餐厅或者咖啡厅，成为热门的观光景点。南京町则和横滨中华街、长崎新地中华街并列日本三大中华街之一。在神户开港之初，因清朝并未和日本缔结条约，使得中国人无法居住在居留地内而多聚居在靠近居留地的南京町。南京町聚集了众多中餐馆，并且在春节等中国传统节日举办节庆活动。神户港湾区、美利坚公园、神户港塔和神户海洋博物馆则是神户港一带地区最著名的旅游景点。神户港湾区是神户重要的都市更新区域之一，仓库等部分昔日港口设施现在也改建为观光景点，使得昔日的工业区呈现出完全不同于过往的气氛，成为港湾都市神户独具特色的旅游资源。美利坚公园紧邻神户港湾区，内有鱼舞、绣球花之钟（オルタンシアの鐘）等雕塑和电影纪念碑、移民纪念碑等象征性纪念物。公园东侧的部分地区在阪神淡路大地震之后并未重建而是保留原貌，是记录地震的重要记忆遗产。神户港塔和神户海洋博物馆位于神户港湾区和美利坚公园之间，两座建筑均因其独特的外形成为神户的地标。</p>\r\n', NULL, 0, 1, 9, 1487198095, 1487198095, 13, NULL, NULL, 4.8, 2, 1),
(10, 1, 2, 1, '札幌－新千岁机场送迎', '机场送迎', 'airport-service-send', 5, '札幌王子酒店', NULL, NULL, '<p>新千岁机场位于日本北海道千岁市与苫小牧市交界，是札幌市的主机场，也是日本国内面积第一大的机场。航空自卫队千岁基地位于新千岁机场主场站的西北方，两单位实际上是共用相同的跑道与滑行道设施。</p>\r\n\r\n<p>新千岁机场以其独特的“C”字形半圆构造的航站楼而闻名，由0号至19号登机口的方向分别为供国际航班、全日空集团（包括Air Do）及日本航空集团使用之服务区域。航站楼一楼是国际线与国内线的入境大厅，二楼则为出境大厅。机场附属的餐厅、商店与各航空公司的贵宾室则设置在更上层的三、四楼。新千岁机场国内线航站的地下层则设有由北海道旅客铁道（JR北海道）所经营的新千岁机场车站（新千歳空港駅），有机场专用快车与札幌、旭川等邻近地区的主要城市连结。</p>\r\n', NULL, 0, 1, 10, 1487283776, 1487283776, NULL, NULL, NULL, NULL, 2, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_booking`
--

DROP TABLE IF EXISTS `pm_charter_booking`;
CREATE TABLE IF NOT EXISTS `pm_charter_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gwc_id` int(11) DEFAULT NULL,
  `trans` varchar(64) NOT NULL,
  `charter_id` int(11) NOT NULL,
  `charter_class_id` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `charter_type` int(11) DEFAULT '1',
  `charter_class_name` varchar(250) DEFAULT NULL,
  `arrive_time` int(11) DEFAULT NULL,
  `adults` int(11) DEFAULT NULL,
  `children` int(11) DEFAULT '0',
  `charter_owner` int(11) DEFAULT NULL,
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `tourist_tax` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `booking_user_id` int(11) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `comments` text,
  `status` int(11) DEFAULT '1',
  `payment_date` int(11) DEFAULT NULL,
  `payment_method` varchar(250) DEFAULT NULL,
  `payment_total` float DEFAULT NULL,
  `pay_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 挿入前にテーブルを空にする `pm_charter_booking`
--

TRUNCATE TABLE `pm_charter_booking`;
--
-- テーブルのデータのダンプ `pm_charter_booking`
--

INSERT INTO `pm_charter_booking` (`id`, `gwc_id`, `trans`, `charter_id`, `charter_class_id`, `title`, `charter_type`, `charter_class_name`, `arrive_time`, `adults`, `children`, `charter_owner`, `add_date`, `edit_date`, `price`, `tourist_tax`, `total`, `booking_user_id`, `firstname`, `lastname`, `mobile`, `country`, `comments`, `status`, `payment_date`, `payment_method`, `payment_total`, `pay_id`) VALUES
(1, 85, '201702160104185092', 9, 3, '神户特色一日游', 3, '商务10座', 1487260800, 2, 1, 2, 1487221458, 1487221458, 2000, 0, 2000, 5, 'yuefuquanf', NULL, '090-9898089', '中国', NULL, 1, NULL, '只预约', NULL, 0),
(2, 87, '201702170515036694', 8, 5, '神户二日游', 2, '豪华七座', 1487433600, 6, 1, 2, 1487279703, 1487279703, 1000, 0, 1000, 8, 'TEST-WK', NULL, '13612341234', '中国', NULL, 1, NULL, '只预约', NULL, 0),
(3, 89, '201702170542535027', 7, 2, '神户送迎服务', 1, '舒适七座', 1487520000, 5, 1, 2, 1487281373, 1487281373, 600, 0, 600, 8, 'TEST-WK', NULL, '13612341234', '中国', NULL, 1, NULL, '只预约', NULL, 0),
(4, 88, '201702170534275456', 9, 1, '神户特色一日游', 3, '舒适五座', 1487520000, 3, 1, 2, 1487314522, 1487314522, 1200, 0, 1200, 8, 'TEST-WK', NULL, '13612341234', '中国', NULL, 4, 1487314522, 'paypal', 1200, 3);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_city`
--

DROP TABLE IF EXISTS `pm_charter_city`;
CREATE TABLE IF NOT EXISTS `pm_charter_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL COMMENT '城市名称',
  `rank` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_city_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 挿入前にテーブルを空にする `pm_charter_city`
--

TRUNCATE TABLE `pm_charter_city`;
--
-- テーブルのデータのダンプ `pm_charter_city`
--

INSERT INTO `pm_charter_city` (`id`, `lang`, `name`, `rank`, `checked`) VALUES
(1, 2, '东京', NULL, 1),
(2, 2, '大阪', NULL, 1),
(3, 2, '冲绳', NULL, 1),
(4, 2, '神户', NULL, 1),
(5, 2, '札幌', NULL, 1),
(6, 2, '名古屋', NULL, 1),
(7, 2, '日立', NULL, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_class`
--

DROP TABLE IF EXISTS `pm_charter_class`;
CREATE TABLE IF NOT EXISTS `pm_charter_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `note` text,
  `id_user` int(11) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_class_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 挿入前にテーブルを空にする `pm_charter_class`
--

TRUNCATE TABLE `pm_charter_class`;
--
-- テーブルのデータのダンプ `pm_charter_class`
--

INSERT INTO `pm_charter_class` (`id`, `lang`, `title`, `note`, `id_user`, `checked`, `rank`, `add_date`, `edit_date`) VALUES
(1, 2, '舒适五座', '舒适五座', 1, 1, 1, 1486281292, 1486281292),
(2, 2, '舒适七座', '丰田埃尔法或同级\r\n推荐6人或者7人，12岁以下儿童需要儿童座椅！', 1, 1, 2, 1487110693, 1487110816),
(3, 2, '商务10座', '丰田海狮或同级\r\n', 1, 1, 3, 1487110879, 1487110879),
(4, 2, '豪华五座', '宾利欧陆或同级', 1, 1, 4, 1487194470, 1487194470),
(5, 2, '豪华七座', '丰田埃尔法豪华版或者同等', 1, 1, 5, 1487194542, 1487194542),
(6, 2, '团体30座', '大巴出游，30～40座', 1, 0, 6, 1487194597, 1487194597);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_classes`
--

DROP TABLE IF EXISTS `pm_charter_classes`;
CREATE TABLE IF NOT EXISTS `pm_charter_classes` (
  `charter_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`charter_id`,`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 挿入前にテーブルを空にする `pm_charter_classes`
--

TRUNCATE TABLE `pm_charter_classes`;
--
-- テーブルのデータのダンプ `pm_charter_classes`
--

INSERT INTO `pm_charter_classes` (`charter_id`, `class_id`, `price`) VALUES
(1, 1, 1000),
(2, 1, 1000),
(5, 1, 500),
(6, 1, 500),
(7, 2, 600),
(8, 1, 500),
(8, 2, 600),
(8, 3, 1000),
(8, 4, 600),
(8, 5, 1000),
(9, 1, 1200),
(9, 2, 1300),
(9, 3, 2000),
(9, 4, 1500),
(9, 5, 2000),
(10, 1, 500),
(10, 2, 700),
(10, 3, 1000),
(10, 4, 700),
(10, 5, 950);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_cost`
--

DROP TABLE IF EXISTS `pm_charter_cost`;
CREATE TABLE IF NOT EXISTS `pm_charter_cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_cost_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 挿入前にテーブルを空にする `pm_charter_cost`
--

TRUNCATE TABLE `pm_charter_cost`;
--
-- テーブルのデータのダンプ `pm_charter_cost`
--

INSERT INTO `pm_charter_cost` (`id`, `lang`, `name`, `rank`) VALUES
(1, 2, 'WIFI', 1),
(2, 2, '小费', 2),
(3, 2, '停车费', 3),
(4, 2, '燃油费', 4),
(5, 2, '门票', 5),
(6, 2, '过路费', 6),
(7, 2, '伙食费', 7),
(8, 2, '雨伞', 8),
(9, 2, '举牌迎接', 9);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_file`
--

DROP TABLE IF EXISTS `pm_charter_file`;
CREATE TABLE IF NOT EXISTS `pm_charter_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_file_fkey` (`id_item`,`lang`),
  KEY `charter_file_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- 挿入前にテーブルを空にする `pm_charter_file`
--

TRUNCATE TABLE `pm_charter_file`;
--
-- テーブルのデータのダンプ `pm_charter_file`
--

INSERT INTO `pm_charter_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(2, 2, 1, NULL, 1, 1, 'service-headimg-3.jpg', NULL, 'image'),
(3, 2, 2, NULL, 1, 1, '1a56c008-6c22-4ed6-ab7c-f125d6199a4f.jpeg', '', 'image'),
(4, 2, 2, NULL, 1, 2, '36145729-9.jpg', NULL, 'image'),
(5, 2, 2, NULL, 1, 3, 'cghzgvw-oriafwvuaajeoom0acg182.jpg', NULL, 'image'),
(6, 2, 2, NULL, 1, 4, '138-140922094310.jpg', NULL, 'image'),
(7, 2, 2, NULL, 1, 5, 'wkgbpvuwngmabjllaaerobfz00c92.jpeg', NULL, 'image'),
(8, 2, 3, NULL, 1, 6, '0b55b319ebc4b745a0fd9852cffc1e178a82150c.jpg', NULL, 'image'),
(9, 2, 3, NULL, 1, 7, '4d086e061d950a7b057561800ad162d9f2d3c935.jpg', NULL, 'image'),
(10, 2, 3, NULL, 1, 8, '7af40ad162d9f2d35b680baba9ec8a136327cc7c.jpg', NULL, 'image'),
(11, 2, 3, NULL, 1, 9, 'b3119313b07eca80aaad948f912397dda144832a.jpg', NULL, 'image'),
(12, 2, 4, NULL, 1, 10, 'cghzfft68f-av2tcaajquomguwc035.jpg', '', 'image'),
(13, 2, 4, NULL, 1, 11, 'cggyhvyjem6auweeaaldlirqmbm460.jpg', '', 'image'),
(14, 2, 4, NULL, 1, 12, 'service-headimg-3.jpg', '', 'image'),
(15, 2, 5, NULL, 1, 13, '0b55b319ebc4b745a0fd9852cffc1e178a82150c.jpg', NULL, 'image'),
(16, 2, 5, NULL, 1, 14, '7af40ad162d9f2d35b680baba9ec8a136327cc7c.jpg', NULL, 'image'),
(17, 2, 6, NULL, 1, 15, '1a56c008-6c22-4ed6-ab7c-f125d6199a4f.jpeg', NULL, 'image'),
(18, 2, 6, NULL, 1, 16, '36145729-9.jpg', NULL, 'image'),
(19, 2, 6, NULL, 1, 17, 'cghzgvw-oriafwvuaajeoom0acg182.jpg', NULL, 'image'),
(20, 2, 6, NULL, 1, 18, '138-140922094310.jpg', NULL, 'image'),
(21, 2, 6, NULL, 1, 19, 'wkgbpvuwngmabjllaaerobfz00c92.jpeg', NULL, 'image'),
(22, 2, 1, NULL, 1, 20, '5-11.png', '', 'image'),
(23, 2, 1, NULL, 1, 21, 'guide-1-03.jpg', '', 'image'),
(24, 2, 7, NULL, 1, 22, 'u11594p1dt20141021094735.jpg', NULL, 'image'),
(25, 2, 7, NULL, 1, 23, 'u11594p1dt20141021094903.jpg', NULL, 'image'),
(26, 2, 8, NULL, 1, 24, '20150721101009808.png', NULL, 'image'),
(27, 2, 8, NULL, 1, 25, 't-autohomecar-wkjbyfhinucaa-8faaelebkw-ey948.jpg', NULL, 'image'),
(28, 2, 9, NULL, 1, 26, '800px-view-of-kikuseidai-from-mount-maya-kobe.jpg', NULL, 'image'),
(29, 2, 10, NULL, 1, 27, 'images-4.jpeg', NULL, 'image'),
(30, 2, 10, NULL, 1, 28, 'images-5.jpeg', NULL, 'image'),
(31, 2, 10, NULL, 1, 29, 'images-3.jpeg', NULL, 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_guaranteed`
--

DROP TABLE IF EXISTS `pm_charter_guaranteed`;
CREATE TABLE IF NOT EXISTS `pm_charter_guaranteed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL COMMENT '担保名称',
  `content` text COMMENT '担保内容',
  `rank` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_guaranteed_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 挿入前にテーブルを空にする `pm_charter_guaranteed`
--

TRUNCATE TABLE `pm_charter_guaranteed`;
--
-- テーブルのデータのダンプ `pm_charter_guaranteed`
--

INSERT INTO `pm_charter_guaranteed` (`id`, `lang`, `name`, `content`, `rank`, `checked`) VALUES
(2, 2, ' 交易担保', '<p> 交易担保： 游客在平台购买任何消费服务均享受平台交易担保的保障服务，即游客端预定了产品后，所付款项并未直接到达平台账户，而是处在平台的监管中，消费资金会先从个人账户打入平台专用担保交易账户，只有当游客享受该项服务完成评价后，再由平台将服务金额从专用账户划入平台账户。</p>\r\n', NULL, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_guaranteed_file`
--

DROP TABLE IF EXISTS `pm_charter_guaranteed_file`;
CREATE TABLE IF NOT EXISTS `pm_charter_guaranteed_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_guaranteed_file_fkey` (`id_item`,`lang`),
  KEY `charter_guaranteedfile_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 挿入前にテーブルを空にする `pm_charter_guaranteed_file`
--

TRUNCATE TABLE `pm_charter_guaranteed_file`;
--
-- テーブルのデータのダンプ `pm_charter_guaranteed_file`
--

INSERT INTO `pm_charter_guaranteed_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(2, 2, 2, NULL, 1, 2, '7854-tmp.jpg', NULL, 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_info`
--

DROP TABLE IF EXISTS `pm_charter_info`;
CREATE TABLE IF NOT EXISTS `pm_charter_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_charter` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `car_brand` varchar(250) DEFAULT NULL COMMENT '汽车品牌',
  `car_model` varchar(250) DEFAULT NULL COMMENT '汽车型号',
  `car_type` tinyint(3) DEFAULT '1' COMMENT '汽车车型（1：舒适轿车 2:情侣跑车 3:家庭3箱车  4:全能越野车）',
  `car_no` varchar(250) DEFAULT NULL COMMENT '车牌号',
  `car_seat` smallint(5) DEFAULT '0' COMMENT '汽车座位',
  `driving_year` smallint(5) DEFAULT '0' COMMENT '驾龄',
  `luggage` smallint(5) DEFAULT '0' COMMENT '行李数量',
  `safe` varchar(250) DEFAULT '官方赠送' COMMENT '乘客保险',
  `fee` double DEFAULT NULL,
  `fee_item` varchar(250) DEFAULT NULL,
  `note1` text COMMENT '注意事项',
  `note2` text COMMENT '注意事项（备用字段）',
  `note3` text COMMENT '注意事项（备用字段）',
  `note4` text COMMENT '注意事项（备用字段）',
  `note5` text COMMENT '注意事项（备用字段）',
  `add_date` int(11) DEFAULT NULL COMMENT '作成时间',
  `edit_date` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 挿入前にテーブルを空にする `pm_charter_info`
--

TRUNCATE TABLE `pm_charter_info`;
--
-- テーブルのデータのダンプ `pm_charter_info`
--

INSERT INTO `pm_charter_info` (`id`, `id_charter`, `id_user`, `car_brand`, `car_model`, `car_type`, `car_no`, `car_seat`, `driving_year`, `luggage`, `safe`, `fee`, `fee_item`, `note1`, `note2`, `note3`, `note4`, `note5`, `add_date`, `edit_date`) VALUES
(1, 1, 1, '丰田', '凯美瑞2.0', 1, '苏E12345', 5, 6, 2, '官方赠送', 200, '7,3,2,4', '', '注意事项', '', '', '', 1480839793, 1480839793),
(2, 2, 1, '丰田', '丰田2.0', 4, '苏E12300', 5, 6, 2, '2', 500, '7,3,2,4,6,5', '', '查看平台详情', '', '', '', 1480844548, 1480844548),
(3, 6, 1, '宝马530', '宝马530', 1, '苏E12388', 5, 2, 2, '2', 500, '9,7,3,2,4', '', '遵守平台相关规定', '', '', '', 1480920070, 1480920070),
(4, 4, 1, '奔驰', '奔驰S300', 1, '苏E1W21', 5, 6, 2, '2', 600, '1,9,7,3,2,4,6', '', '1、注意个人钱财安全\r\n2、贵重物品请随身携带\r\n3、遵守平台相关规定', '', '', '', 1480922174, 1480922174),
(5, 3, 1, '法拉利', '法拉利6.0', 2, '苏E18888', 5, 6, 2, '2', 600, '1,9,7,3,2,4,6', '', '1、自行保管贵重物品\r\n2、遵守平台相关规定', '', '', '', 1480922711, 1480922711),
(6, 5, 1, '丰田', '丰田2.0', 3, '苏E18423', 5, 2, 2, '2', 800, '1,9,7,3,2,4,6,5', '', '1、自行保管私人物品\r\n2、贵重物品请随身携带\r\n3、遵守平台相关规定', '', '', '', 1480922958, 1480922958);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_item`
--

DROP TABLE IF EXISTS `pm_charter_item`;
CREATE TABLE IF NOT EXISTS `pm_charter_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL COMMENT '项目名称',
  `rank` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_item_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 挿入前にテーブルを空にする `pm_charter_item`
--

TRUNCATE TABLE `pm_charter_item`;
--
-- テーブルのデータのダンプ `pm_charter_item`
--

INSERT INTO `pm_charter_item` (`id`, `lang`, `name`, `rank`, `checked`) VALUES
(1, 2, '服务明细', NULL, 1),
(2, 2, '费用设置', NULL, 1),
(4, 2, '注意事项', NULL, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_item_file`
--

DROP TABLE IF EXISTS `pm_charter_item_file`;
CREATE TABLE IF NOT EXISTS `pm_charter_item_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_item_file_fkey` (`id_item`,`lang`),
  KEY `charter_item_file_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 挿入前にテーブルを空にする `pm_charter_item_file`
--

TRUNCATE TABLE `pm_charter_item_file`;
--
-- テーブルのデータのダンプ `pm_charter_item_file`
--

INSERT INTO `pm_charter_item_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(1, 2, 1, NULL, 1, 1, '.jpg', NULL, 'image'),
(3, 2, 2, NULL, 1, 2, '.jpg', NULL, 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_line`
--

DROP TABLE IF EXISTS `pm_charter_line`;
CREATE TABLE IF NOT EXISTS `pm_charter_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_charter` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `line_name` varchar(250) DEFAULT NULL COMMENT '行程名称',
  `arrive_time` varchar(250) DEFAULT NULL COMMENT '到达时间',
  `line_description` longtext COMMENT '路线介绍',
  `note` longtext COMMENT '注意事项',
  `add_date` int(11) DEFAULT NULL COMMENT '作成时间',
  `edit_date` int(11) DEFAULT NULL COMMENT '更新时间',
  `rank` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 挿入前にテーブルを空にする `pm_charter_line`
--

TRUNCATE TABLE `pm_charter_line`;
--
-- テーブルのデータのダンプ `pm_charter_line`
--

INSERT INTO `pm_charter_line` (`id`, `id_charter`, `id_user`, `line_name`, `arrive_time`, `line_description`, `note`, `add_date`, `edit_date`, `rank`) VALUES
(1, 1, 1, '东京迪士尼海洋乐园', '10：00', '<p>京都酒店</p>\r\n', '1、本产品不包含发票服务，如需要，请联系客服确认相关细节。发票仅在您出行之后才会开具，请知悉。\r\n2、蜜柚建议您可根据自身需求，进行其他增值个人境外旅游保险购买。若您因自身原因决定不购买，将自愿承担因未购买保险造成的一切后果。\r\n3、行程确认单将会在您出发前以邮件或短信的方式发送给您，请在出行前记下蜜柚客服和当地服务人员联系电话电话，以便应对突发情况。\r\n4、机票酒店信息实时变动，请以客服核价以及实际行程单为准。', 1480836465, 1486947864, NULL),
(2, 2, 1, '大阪环球影城', '10：00', '<p>大阪酒店</p>\r\n', '1、本产品不包含发票服务，如需要，请联系客服确认相关细节。发票仅在您出行之后才会开具，请知悉。\r\n\r\n2、蜜柚建议您可根据自身需求，进行其他增值个人境外旅游保险购买。若您因自身原因决定不购买，将自愿承担因未购买保险造成的一切后果。\r\n\r\n3、行程确认单将会在您出发前以邮件或短信的方式发送给您，请在出行前记下蜜柚客服和当地服务人员联系电话电话，以便应对突发情况。\r\n\r\n4、机票酒店信息实时变动，请以客服核价以及实际行程单为准。', 1480845532, 1486947890, NULL),
(3, 3, 1, '冲绳宫古岛高尔夫之旅', '10：00', '<p>冲绳酒店</p>\r\n', '遵守平台相关规定', 1480919722, 1480919722, 0),
(4, 7, 1, '关西机场送迎', '', '<p>大阪湾人工岛屿上的关西国际机场通过跨海大桥与大阪相连，是一座24小时全天候运营机场，从建成至今已有20周年。作为日本首个“海上机场”，关西国际机场被寄予厚望，在落成时被视作是关西经济走向世界的标志。</p>\r\n\r\n<p> </p>\r\n', '', 1487196375, 1487196375, 0),
(5, 8, 1, '第一天：神户大阪美食之旅', '10:00', '<p>神户美食闻名天下，尤其以神户牛最为著名！</p>\r\n', '遵守平台规定', 1487279531, 1487282957, NULL),
(6, 8, 1, '第二天：濑户内海一周游', '10:00', '<p>神户被誉为日本「西海正门」，是日本著名的国际贸易港口城市，属于“京阪神都市圈”中的重要一环。城市位于大阪西侧，西枕六甲山、面向濑户内海，地理位置优越。</p>\r\n\r\n<p>神户是日本最有异国风情的港口城市之一。从古至今频繁的对外贸易，让这座城市充满了异域风情和特别的魅力。这里有世界第一座人工岛——港岛人工岛、世界最长的吊桥——明石海峡大桥的开通，拥有繁华大都市的风貌。</p>\r\n', '', 1487282890, 1487282890, 2),
(7, 9, 1, '神户周游', '10:00', '<p>神户的存在已经有千年历史。这里古时是个小渔村，由于对外贸易频繁，成为当时日本的海上门户。二战时期，神户的城市建筑和港湾设备均被严重损毁。而今天的神户城，则是在战后废墟中兴建起来的。现已成为世界大型港口之一。</p>\r\n\r\n<p>神户是日本最有异国风情的港口城市之一。从古至今频繁的对外贸易，让这座城市充满了异域风情和特别的魅力。这里有世界第一座人工岛——港岛人工岛、世界最长的吊桥——明石海峡大桥的开通，拥有繁华大都市的风貌。</p>\r\n', '遵守平台各种规章', 1487283155, 1487283155, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_line_file`
--

DROP TABLE IF EXISTS `pm_charter_line_file`;
CREATE TABLE IF NOT EXISTS `pm_charter_line_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- 挿入前にテーブルを空にする `pm_charter_line_file`
--

TRUNCATE TABLE `pm_charter_line_file`;
--
-- テーブルのデータのダンプ `pm_charter_line_file`
--

INSERT INTO `pm_charter_line_file` (`id`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(1, 1, NULL, 1, 1, '54ae43af880dc-web.jpg', NULL, 'image'),
(2, 1, NULL, 1, 2, '54ae43b6f0f71-web.jpg', NULL, 'image'),
(3, 1, NULL, 1, 3, '54ae437d804c0-web.jpg', NULL, 'image'),
(4, 2, NULL, 1, 4, '54521a9b1d8aa-web.jpg', NULL, 'image'),
(5, 2, NULL, 1, 5, '54521a8e9320c-web.jpg', NULL, 'image'),
(6, 2, NULL, 1, 6, '54521aa05a561-web.jpg', NULL, 'image'),
(7, 2, NULL, 1, 7, '54521a95c4a8d-web.jpg', NULL, 'image'),
(8, 3, NULL, 1, 8, '56824d181c0b5-web.jpg', NULL, 'image'),
(9, 3, NULL, 1, 9, 'b3119313b07eca80aaad948f912397dda144832a.jpg', NULL, 'image'),
(10, 3, NULL, 1, 10, '568230cdcd4ff-web.jpg', NULL, 'image'),
(11, 3, NULL, 1, 11, '56823ce5b7195-web.jpg', NULL, 'image'),
(12, 3, NULL, 1, 12, '5682450c680ce-web.jpg', NULL, 'image'),
(13, 1, NULL, 1, 13, '5-11.png', NULL, 'image'),
(14, 2, NULL, 1, 14, 'guide-4-03.png', NULL, 'image'),
(15, 4, NULL, 1, 15, '1-550-367.jpg', NULL, 'image'),
(16, 4, NULL, 1, 16, 'images.jpeg', NULL, 'image'),
(17, 5, NULL, 1, 17, 'images-2.jpeg', '', 'image'),
(18, 5, NULL, 1, 18, '400x250.jpg', '', 'image'),
(19, 6, NULL, 1, 19, '5.jpg', NULL, 'image'),
(20, 6, NULL, 1, 20, '1-155.jpg', NULL, 'image'),
(21, 7, NULL, 1, 21, '127879832448816119430-dsc-2439.jpg', NULL, 'image'),
(22, 7, NULL, 1, 22, 'c0188757-22345272.jpg', NULL, 'image'),
(23, 7, NULL, 1, 23, '8f2b0241.jpg', NULL, 'image'),
(24, 7, NULL, 1, 24, '5.jpg', NULL, 'image'),
(25, 7, NULL, 1, 25, '1367397959-4094892315.jpg', NULL, 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_log`
--

DROP TABLE IF EXISTS `pm_charter_log`;
CREATE TABLE IF NOT EXISTS `pm_charter_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `context` text,
  `source_id` int(11) DEFAULT NULL,
  `add_date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `other_data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 挿入前にテーブルを空にする `pm_charter_log`
--

TRUNCATE TABLE `pm_charter_log`;
-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_pl`
--

DROP TABLE IF EXISTS `pm_charter_pl`;
CREATE TABLE IF NOT EXISTS `pm_charter_pl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` float(11,2) DEFAULT '0.00',
  `text` longtext,
  `uid` int(11) DEFAULT '0',
  `userip` longtext,
  `dtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 挿入前にテーブルを空にする `pm_charter_pl`
--

TRUNCATE TABLE `pm_charter_pl`;
--
-- テーブルのデータのダンプ `pm_charter_pl`
--

INSERT INTO `pm_charter_pl` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `text`, `uid`, `userip`, `dtime`) VALUES
(1, 2, 6, 0, 1, 4.00, '很不错的汽车！', 8, '126.218.138.71', '2017-02-14 21:40:42'),
(2, 2, 6, 0, 1, 5.00, '大阪是关西最大的城市。', 8, '126.218.138.71', '2017-02-14 21:41:44'),
(3, 2, 6, 0, 1, 5.00, '大阪美食甲天下', 8, '126.218.138.71', '2017-02-14 21:42:09'),
(4, 2, 6, 0, 1, 5.00, '车主很和善！车主很和善！车主很和善！车主很和善！车主很和善！车主很和善！车主很和善！', 8, '126.218.138.71', '2017-02-14 21:42:58'),
(5, 2, 6, 0, 1, 2.00, '大阪的交通状况很不错！', 8, '126.218.138.71', '2017-02-14 21:43:29'),
(6, 2, 9, 0, 1, 5.00, '神户很美1', 8, '126.218.138.71', '2017-02-16 21:52:59'),
(7, 2, 9, 0, 1, 5.00, '神户牛更美！', 8, '126.218.138.71', '2017-02-16 21:53:14'),
(8, 2, 9, 0, 1, 4.00, '神户的夜是寂静的夜！', 8, '126.218.138.71', '2017-02-16 22:00:21'),
(9, 2, 9, 0, 1, 5.00, '神户的夜是寂静的夜！', 8, '126.218.138.71', '2017-02-16 22:00:27'),
(10, 2, 9, 0, 1, 3.00, '神户的夜是寂静的夜！', 8, '126.218.138.71', '2017-02-16 22:00:34'),
(11, 2, 9, 0, 1, 5.00, '神户的夜是寂静的夜！', 8, '126.218.138.71', '2017-02-16 22:00:39'),
(12, 2, 9, 0, 1, 5.00, '神户的夜是寂静的夜！', 8, '126.218.138.71', '2017-02-16 22:00:42'),
(13, 2, 9, 0, 1, 5.00, '神户的夜是寂静的夜！', 8, '126.218.138.71', '2017-02-16 22:00:48'),
(14, 2, 9, 0, 1, 5.00, '神户的夜是寂静的夜！', 8, '126.218.138.71', '2017-02-16 22:00:53'),
(15, 2, 9, 0, 1, 5.00, '神户的夜是寂静的夜！', 8, '126.218.138.71', '2017-02-16 22:00:57'),
(16, 2, 9, 0, 1, 5.00, '神户的夜是寂静的夜！', 8, '126.218.138.71', '2017-02-16 22:01:03'),
(17, 2, 9, 0, 1, 5.00, '神户的夜是寂静的夜！', 8, '126.218.138.71', '2017-02-16 22:01:08'),
(18, 2, 9, 0, 1, 5.00, '神户的海是蓝蓝的海', 8, '126.218.138.71', '2017-02-16 22:01:48');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_type`
--

DROP TABLE IF EXISTS `pm_charter_type`;
CREATE TABLE IF NOT EXISTS `pm_charter_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL COMMENT '名称',
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_type_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 挿入前にテーブルを空にする `pm_charter_type`
--

TRUNCATE TABLE `pm_charter_type`;
--
-- テーブルのデータのダンプ `pm_charter_type`
--

INSERT INTO `pm_charter_type` (`id`, `lang`, `name`, `rank`) VALUES
(1, 2, '包车接送', NULL),
(2, 2, '包车游玩', NULL),
(3, 2, '特色路线', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_type_file`
--

DROP TABLE IF EXISTS `pm_charter_type_file`;
CREATE TABLE IF NOT EXISTS `pm_charter_type_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_type_file_fkey` (`id_item`,`lang`),
  KEY `charter_type_file_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 挿入前にテーブルを空にする `pm_charter_type_file`
--

TRUNCATE TABLE `pm_charter_type_file`;
--
-- テーブルのデータのダンプ `pm_charter_type_file`
--

INSERT INTO `pm_charter_type_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(4, 2, 1, NULL, 1, 1, '12.png', NULL, 'image'),
(5, 2, 2, NULL, 1, 2, '11.png', NULL, 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_user`
--

DROP TABLE IF EXISTS `pm_charter_user`;
CREATE TABLE IF NOT EXISTS `pm_charter_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(250) DEFAULT NULL COMMENT '姓名',
  `drive_year` varchar(250) DEFAULT NULL COMMENT '在当地年限',
  `mobile` varchar(250) DEFAULT NULL COMMENT '手机号码',
  `alipay` varchar(250) DEFAULT NULL COMMENT '支付宝账号',
  `identity` varchar(250) DEFAULT NULL COMMENT '您在当地的身份',
  `self_comment` text COMMENT '请用几句话形容自己',
  `friend_comment` text COMMENT '朋友如何评价您',
  `why_comment` text COMMENT '您为什么来到这座城市',
  `service_comment` text COMMENT '您可以提供什么样的特色服务',
  `checked_comment` text COMMENT '审批不通过的理由',
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 挿入前にテーブルを空にする `pm_charter_user`
--

TRUNCATE TABLE `pm_charter_user`;
--
-- テーブルのデータのダンプ `pm_charter_user`
--

INSERT INTO `pm_charter_user` (`id`, `user_id`, `user_name`, `drive_year`, `mobile`, `alipay`, `identity`, `self_comment`, `friend_comment`, `why_comment`, `service_comment`, `checked_comment`, `add_date`, `edit_date`, `checked`) VALUES
(1, 5, '测试', '10', '1909090', '', '', '', '', '', '', NULL, 1486431509, 1486431509, 1),
(2, 8, '大王', '10', '13833888833', '', '白领', '勤劳，勇敢，正直', '基本还行', '山好，水好，空气好', '贴心提示，小礼物惊喜！', NULL, 1487195019, 1487195019, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_charter_user_file`
--

DROP TABLE IF EXISTS `pm_charter_user_file`;
CREATE TABLE IF NOT EXISTS `pm_charter_user_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 挿入前にテーブルを空にする `pm_charter_user_file`
--

TRUNCATE TABLE `pm_charter_user_file`;
--
-- テーブルのデータのダンプ `pm_charter_user_file`
--

INSERT INTO `pm_charter_user_file` (`id`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(1, 2, NULL, 1, 1, '800x0-1-q87-autohomecar-wkghzlfdctuayefjaano3epf9kq252.jpg', NULL, 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_comment`
--

DROP TABLE IF EXISTS `pm_comment`;
CREATE TABLE IF NOT EXISTS `pm_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_type` varchar(30) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `msg` longtext,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 挿入前にテーブルを空にする `pm_comment`
--

TRUNCATE TABLE `pm_comment`;
-- --------------------------------------------------------

--
-- テーブルの構造 `pm_country`
--

DROP TABLE IF EXISTS `pm_country`;
CREATE TABLE IF NOT EXISTS `pm_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=251 ;

--
-- 挿入前にテーブルを空にする `pm_country`
--

TRUNCATE TABLE `pm_country`;
--
-- テーブルのデータのダンプ `pm_country`
--

INSERT INTO `pm_country` (`id`, `name`, `code`) VALUES
(1, 'Afghanistan', 'AF'),
(2, 'Åland', 'AX'),
(3, 'Albania', 'AL'),
(4, 'Algeria', 'DZ'),
(5, 'American Samoa', 'AS'),
(6, 'Andorra', 'AD'),
(7, 'Angola', 'AO'),
(8, 'Anguilla', 'AI'),
(9, 'Antarctica', 'AQ'),
(10, 'Antigua and Barbuda', 'AG'),
(11, 'Argentina', 'AR'),
(12, 'Armenia', 'AM'),
(13, 'Aruba', 'AW'),
(14, 'Australia', 'AU'),
(15, 'Austria', 'AT'),
(16, 'Azerbaijan', 'AZ'),
(17, 'Bahamas', 'BS'),
(18, 'Bahrain', 'BH'),
(19, 'Bangladesh', 'BD'),
(20, 'Barbados', 'BB'),
(21, 'Belarus', 'BY'),
(22, 'Belgium', 'BE'),
(23, 'Belize', 'BZ'),
(24, 'Benin', 'BJ'),
(25, 'Bermuda', 'BM'),
(26, 'Bhutan', 'BT'),
(27, 'Bolivia', 'BO'),
(28, 'Bonaire', 'BQ'),
(29, 'Bosnia and Herzegovina', 'BA'),
(30, 'Botswana', 'BW'),
(31, 'Bouvet Island', 'BV'),
(32, 'Brazil', 'BR'),
(33, 'British Indian Ocean Territory', 'IO'),
(34, 'British Virgin Islands', 'VG'),
(35, 'Brunei', 'BN'),
(36, 'Bulgaria', 'BG'),
(37, 'Burkina Faso', 'BF'),
(38, 'Burundi', 'BI'),
(39, 'Cambodia', 'KH'),
(40, 'Cameroon', 'CM'),
(41, 'Canada', 'CA'),
(42, 'Cape Verde', 'CV'),
(43, 'Cayman Islands', 'KY'),
(44, 'Central African Republic', 'CF'),
(45, 'Chad', 'TD'),
(46, 'Chile', 'CL'),
(47, 'China', 'CN'),
(48, 'Christmas Island', 'CX'),
(49, 'Cocos [Keeling] Islands', 'CC'),
(50, 'Colombia', 'CO'),
(51, 'Comoros', 'KM'),
(52, 'Cook Islands', 'CK'),
(53, 'Costa Rica', 'CR'),
(54, 'Croatia', 'HR'),
(55, 'Cuba', 'CU'),
(56, 'Curacao', 'CW'),
(57, 'Cyprus', 'CY'),
(58, 'Czech Republic', 'CZ'),
(59, 'Democratic Republic of the Congo', 'CD'),
(60, 'Denmark', 'DK'),
(61, 'Djibouti', 'DJ'),
(62, 'Dominica', 'DM'),
(63, 'Dominican Republic', 'DO'),
(64, 'East Timor', 'TL'),
(65, 'Ecuador', 'EC'),
(66, 'Egypt', 'EG'),
(67, 'El Salvador', 'SV'),
(68, 'Equatorial Guinea', 'GQ'),
(69, 'Eritrea', 'ER'),
(70, 'Estonia', 'EE'),
(71, 'Ethiopia', 'ET'),
(72, 'Falkland Islands', 'FK'),
(73, 'Faroe Islands', 'FO'),
(74, 'Fiji', 'FJ'),
(75, 'Finland', 'FI'),
(76, 'France', 'FR'),
(77, 'French Guiana', 'GF'),
(78, 'French Polynesia', 'PF'),
(79, 'French Southern Territories', 'TF'),
(80, 'Gabon', 'GA'),
(81, 'Gambia', 'GM'),
(82, 'Georgia', 'GE'),
(83, 'Germany', 'DE'),
(84, 'Ghana', 'GH'),
(85, 'Gibraltar', 'GI'),
(86, 'Greece', 'GR'),
(87, 'Greenland', 'GL'),
(88, 'Grenada', 'GD'),
(89, 'Guadeloupe', 'GP'),
(90, 'Guam', 'GU'),
(91, 'Guatemala', 'GT'),
(92, 'Guernsey', 'GG'),
(93, 'Guinea', 'GN'),
(94, 'Guinea-Bissau', 'GW'),
(95, 'Guyana', 'GY'),
(96, 'Haiti', 'HT'),
(97, 'Heard Island and McDonald Islands', 'HM'),
(98, 'Honduras', 'HN'),
(99, 'Hong Kong', 'HK'),
(100, 'Hungary', 'HU'),
(101, 'Iceland', 'IS'),
(102, 'India', 'IN'),
(103, 'Indonesia', 'ID'),
(104, 'Iran', 'IR'),
(105, 'Iraq', 'IQ'),
(106, 'Ireland', 'IE'),
(107, 'Isle of Man', 'IM'),
(108, 'Israel', 'IL'),
(109, 'Italy', 'IT'),
(110, 'Ivory Coast', 'CI'),
(111, 'Jamaica', 'JM'),
(112, 'Japan', 'JP'),
(113, 'Jersey', 'JE'),
(114, 'Jordan', 'JO'),
(115, 'Kazakhstan', 'KZ'),
(116, 'Kenya', 'KE'),
(117, 'Kiribati', 'KI'),
(118, 'Kosovo', 'XK'),
(119, 'Kuwait', 'KW'),
(120, 'Kyrgyzstan', 'KG'),
(121, 'Laos', 'LA'),
(122, 'Latvia', 'LV'),
(123, 'Lebanon', 'LB'),
(124, 'Lesotho', 'LS'),
(125, 'Liberia', 'LR'),
(126, 'Libya', 'LY'),
(127, 'Liechtenstein', 'LI'),
(128, 'Lithuania', 'LT'),
(129, 'Luxembourg', 'LU'),
(130, 'Macao', 'MO'),
(131, 'Macedonia', 'MK'),
(132, 'Madagascar', 'MG'),
(133, 'Malawi', 'MW'),
(134, 'Malaysia', 'MY'),
(135, 'Maldives', 'MV'),
(136, 'Mali', 'ML'),
(137, 'Malta', 'MT'),
(138, 'Marshall Islands', 'MH'),
(139, 'Martinique', 'MQ'),
(140, 'Mauritania', 'MR'),
(141, 'Mauritius', 'MU'),
(142, 'Mayotte', 'YT'),
(143, 'Mexico', 'MX'),
(144, 'Micronesia', 'FM'),
(145, 'Moldova', 'MD'),
(146, 'Monaco', 'MC'),
(147, 'Mongolia', 'MN'),
(148, 'Montenegro', 'ME'),
(149, 'Montserrat', 'MS'),
(150, 'Morocco', 'MA'),
(151, 'Mozambique', 'MZ'),
(152, 'Myanmar [Burma]', 'MM'),
(153, 'Namibia', 'NA'),
(154, 'Nauru', 'NR'),
(155, 'Nepal', 'NP'),
(156, 'Netherlands', 'NL'),
(157, 'New Caledonia', 'NC'),
(158, 'New Zealand', 'NZ'),
(159, 'Nicaragua', 'NI'),
(160, 'Niger', 'NE'),
(161, 'Nigeria', 'NG'),
(162, 'Niue', 'NU'),
(163, 'Norfolk Island', 'NF'),
(164, 'North Korea', 'KP'),
(165, 'Northern Mariana Islands', 'MP'),
(166, 'Norway', 'NO'),
(167, 'Oman', 'OM'),
(168, 'Pakistan', 'PK'),
(169, 'Palau', 'PW'),
(170, 'Palestine', 'PS'),
(171, 'Panama', 'PA'),
(172, 'Papua New Guinea', 'PG'),
(173, 'Paraguay', 'PY'),
(174, 'Peru', 'PE'),
(175, 'Philippines', 'PH'),
(176, 'Pitcairn Islands', 'PN'),
(177, 'Poland', 'PL'),
(178, 'Portugal', 'PT'),
(179, 'Puerto Rico', 'PR'),
(180, 'Qatar', 'QA'),
(181, 'Republic of the Congo', 'CG'),
(182, 'Réunion', 'RE'),
(183, 'Romania', 'RO'),
(184, 'Russia', 'RU'),
(185, 'Rwanda', 'RW'),
(186, 'Saint Barthélemy', 'BL'),
(187, 'Saint Helena', 'SH'),
(188, 'Saint Kitts and Nevis', 'KN'),
(189, 'Saint Lucia', 'LC'),
(190, 'Saint Martin', 'MF'),
(191, 'Saint Pierre and Miquelon', 'PM'),
(192, 'Saint Vincent and the Grenadines', 'VC'),
(193, 'Samoa', 'WS'),
(194, 'San Marino', 'SM'),
(195, 'São Tomé and Príncipe', 'ST'),
(196, 'Saudi Arabia', 'SA'),
(197, 'Senegal', 'SN'),
(198, 'Serbia', 'RS'),
(199, 'Seychelles', 'SC'),
(200, 'Sierra Leone', 'SL'),
(201, 'Singapore', 'SG'),
(202, 'Sint Maarten', 'SX'),
(203, 'Slovakia', 'SK'),
(204, 'Slovenia', 'SI'),
(205, 'Solomon Islands', 'SB'),
(206, 'Somalia', 'SO'),
(207, 'South Africa', 'ZA'),
(208, 'South Georgia and the South Sandwich Islands', 'GS'),
(209, 'South Korea', 'KR'),
(210, 'South Sudan', 'SS'),
(211, 'Spain', 'ES'),
(212, 'Sri Lanka', 'LK'),
(213, 'Sudan', 'SD'),
(214, 'Suriname', 'SR'),
(215, 'Svalbard and Jan Mayen', 'SJ'),
(216, 'Swaziland', 'SZ'),
(217, 'Sweden', 'SE'),
(218, 'Switzerland', 'CH'),
(219, 'Syria', 'SY'),
(220, 'Taiwan', 'TW'),
(221, 'Tajikistan', 'TJ'),
(222, 'Tanzania', 'TZ'),
(223, 'Thailand', 'TH'),
(224, 'Togo', 'TG'),
(225, 'Tokelau', 'TK'),
(226, 'Tonga', 'TO'),
(227, 'Trinidad and Tobago', 'TT'),
(228, 'Tunisia', 'TN'),
(229, 'Turkey', 'TR'),
(230, 'Turkmenistan', 'TM'),
(231, 'Turks and Caicos Islands', 'TC'),
(232, 'Tuvalu', 'TV'),
(233, 'U.S. Minor Outlying Islands', 'UM'),
(234, 'U.S. Virgin Islands', 'VI'),
(235, 'Uganda', 'UG'),
(236, 'Ukraine', 'UA'),
(237, 'United Arab Emirates', 'AE'),
(238, 'United Kingdom', 'GB'),
(239, 'United States', 'US'),
(240, 'Uruguay', 'UY'),
(241, 'Uzbekistan', 'UZ'),
(242, 'Vanuatu', 'VU'),
(243, 'Vatican City', 'VA'),
(244, 'Venezuela', 'VE'),
(245, 'Vietnam', 'VN'),
(246, 'Wallis and Futuna', 'WF'),
(247, 'Western Sahara', 'EH'),
(248, 'Yemen', 'YE'),
(249, 'Zambia', 'ZM'),
(250, 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_currency`
--

DROP TABLE IF EXISTS `pm_currency`;
CREATE TABLE IF NOT EXISTS `pm_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) DEFAULT NULL,
  `sign` varchar(5) DEFAULT NULL,
  `main` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 挿入前にテーブルを空にする `pm_currency`
--

TRUNCATE TABLE `pm_currency`;
--
-- テーブルのデータのダンプ `pm_currency`
--

INSERT INTO `pm_currency` (`id`, `code`, `sign`, `main`, `rank`) VALUES
(1, 'USD', '$', 1, 1),
(2, 'EUR', '€', 0, 2),
(3, 'GBP', '£', 0, 3),
(4, 'INR', '₹', 0, 4),
(5, 'AUD', 'A$', 0, 5),
(6, 'CAD', 'C$', 0, 6),
(7, 'CNY', '¥', 0, 7),
(8, 'TRY', '₺', 0, 8);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_destination`
--

DROP TABLE IF EXISTS `pm_destination`;
CREATE TABLE IF NOT EXISTS `pm_destination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 挿入前にテーブルを空にする `pm_destination`
--

TRUNCATE TABLE `pm_destination`;
--
-- テーブルのデータのダンプ `pm_destination`
--

INSERT INTO `pm_destination` (`id`, `name`, `checked`) VALUES
(1, '关东', 1),
(2, '关西', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_destination2`
--

DROP TABLE IF EXISTS `pm_destination2`;
CREATE TABLE IF NOT EXISTS `pm_destination2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 挿入前にテーブルを空にする `pm_destination2`
--

TRUNCATE TABLE `pm_destination2`;
--
-- テーブルのデータのダンプ `pm_destination2`
--

INSERT INTO `pm_destination2` (`id`, `name`, `checked`) VALUES
(1, '民宿', 1),
(2, '酒店', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_facility`
--

DROP TABLE IF EXISTS `pm_facility`;
CREATE TABLE IF NOT EXISTS `pm_facility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `facility_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- 挿入前にテーブルを空にする `pm_facility`
--

TRUNCATE TABLE `pm_facility`;
--
-- テーブルのデータのダンプ `pm_facility`
--

INSERT INTO `pm_facility` (`id`, `lang`, `name`, `rank`) VALUES
(1, 2, '空调', NULL),
(2, 2, '婴儿床', NULL),
(3, 2, '阳台', NULL),
(4, 2, '烧烤', NULL),
(7, 2, '厨房', NULL),
(8, 2, '书桌', NULL),
(9, 2, '洗碗机', NULL),
(10, 2, '风扇', NULL),
(12, 2, '冰箱', NULL),
(13, 2, '吹风机', NULL),
(15, 2, '熨斗', NULL),
(16, 2, '微波炉', NULL),
(17, 2, '小吧台', NULL),
(18, 2, '禁烟', NULL),
(19, 2, '有料停车场', NULL),
(20, 2, '可携带宠物', NULL),
(21, 2, '不可带宠物', NULL),
(22, 2, '收音机', NULL),
(23, 2, '保险箱', NULL),
(24, 2, '卫星频道', NULL),
(25, 2, '淋浴', NULL),
(26, 2, '休息室', NULL),
(27, 2, '电话', NULL),
(28, 2, '电视', NULL),
(29, 2, '太阳伞', NULL),
(30, 2, '洗衣机', NULL),
(31, 2, '轮椅', NULL),
(32, 2, 'WiFi', NULL),
(37, 2, '免费停车场', NULL),
(38, 2, '互联网', NULL),
(40, 2, '泡浴', NULL),
(41, 2, '咖啡机', NULL),
(42, 2, 'DVD', NULL),
(43, 2, '收音机', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_facility_file`
--

DROP TABLE IF EXISTS `pm_facility_file`;
CREATE TABLE IF NOT EXISTS `pm_facility_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `facility_file_fkey` (`id_item`,`lang`),
  KEY `facility_file_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- 挿入前にテーブルを空にする `pm_facility_file`
--

TRUNCATE TABLE `pm_facility_file`;
--
-- テーブルのデータのダンプ `pm_facility_file`
--

INSERT INTO `pm_facility_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(40, 2, 1, NULL, 1, 35, 'icon-1.png', NULL, 'image'),
(41, 2, 2, NULL, 1, 36, 'icon-2.png', NULL, 'image'),
(42, 2, 31, NULL, 1, 37, 'icon-26.png', NULL, 'image'),
(43, 2, 32, NULL, 1, 38, 'icon-34.png', NULL, 'image'),
(44, 2, 25, NULL, 1, 39, 'icon-20.png', NULL, 'image'),
(45, 2, 19, NULL, 1, 40, 'icon-14.png', '', 'image'),
(46, 2, 20, NULL, 1, 41, 'icon-15.png', NULL, 'image'),
(47, 2, 27, NULL, 1, 42, 'icon-22.png', NULL, 'image'),
(48, 2, 37, NULL, 1, 43, 'icon-12.png', NULL, 'image'),
(49, 2, 28, NULL, 1, 44, 'icon-23.png', NULL, 'image'),
(50, 2, 21, NULL, 1, 45, 'icon-16.png', NULL, 'image'),
(51, 2, 30, NULL, 1, 46, 'icon-25.png', NULL, 'image'),
(52, 2, 38, NULL, 1, 47, 'icon-30.png', NULL, 'image'),
(53, 2, 18, NULL, 1, 48, 'icon-33.png', NULL, 'image'),
(54, 2, 26, NULL, 1, 49, 'icon-21.png', NULL, 'image'),
(55, 2, 23, NULL, 1, 50, 'icon-18.png', NULL, 'image'),
(56, 2, 24, NULL, 1, 51, 'icon-19.png', NULL, 'image'),
(57, 2, 29, NULL, 1, 52, 'icon-24.png', NULL, 'image'),
(58, 2, 40, NULL, 1, 53, 'icon-5.png', NULL, 'image'),
(59, 2, 41, NULL, 1, 54, 'icon-6.png', '', 'image'),
(60, 2, 42, NULL, 1, 55, 'icon-10.png', NULL, 'image'),
(61, 2, 43, NULL, 1, 56, 'icon-17.png', NULL, 'image'),
(62, 2, 17, NULL, 1, 57, 'icon-32.png', NULL, 'image'),
(63, 2, 22, NULL, 1, 58, 'icon-17.png', NULL, 'image'),
(64, 2, 16, NULL, 1, 59, 'icon-27.png', NULL, 'image'),
(65, 2, 15, NULL, 1, 60, 'icon-31.png', NULL, 'image'),
(66, 2, 3, NULL, 1, 61, 'icon-3.png', NULL, 'image'),
(67, 2, 4, NULL, 1, 62, 'icon-4.png', NULL, 'image'),
(68, 2, 7, NULL, 1, 63, 'icon-7.png', NULL, 'image'),
(69, 2, 8, NULL, 1, 64, 'icon-8.png', '', 'image'),
(70, 2, 9, NULL, 1, 65, 'icon-9.png', NULL, 'image'),
(71, 2, 10, NULL, 1, 66, 'icon-11.png', '', 'image'),
(72, 2, 12, NULL, 1, 67, 'icon-13.png', NULL, 'image'),
(73, 2, 13, NULL, 1, 68, 'icon-28.png', NULL, 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_gallery`
--

DROP TABLE IF EXISTS `pm_gallery`;
CREATE TABLE IF NOT EXISTS `pm_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `subtitle` varchar(250) NOT NULL,
  `beds` varchar(250) NOT NULL,
  `establishmentday` varchar(250) NOT NULL,
  `text` longtext NOT NULL,
  `id_page` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `publish_date` int(11) DEFAULT NULL,
  `unpublish_date` int(11) DEFAULT NULL,
  `comment` int(11) DEFAULT '0',
  `rating` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `gallery_lang_fkey` (`lang`),
  KEY `gallery_page_fkey` (`id_page`,`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 挿入前にテーブルを空にする `pm_gallery`
--

TRUNCATE TABLE `pm_gallery`;
-- --------------------------------------------------------

--
-- テーブルの構造 `pm_gallery_file`
--

DROP TABLE IF EXISTS `pm_gallery_file`;
CREATE TABLE IF NOT EXISTS `pm_gallery_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `gallery_file_fkey` (`id_item`,`lang`),
  KEY `gallery_file_lang_fkey` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 挿入前にテーブルを空にする `pm_gallery_file`
--

TRUNCATE TABLE `pm_gallery_file`;
-- --------------------------------------------------------

--
-- テーブルの構造 `pm_gwc`
--

DROP TABLE IF EXISTS `pm_gwc`;
CREATE TABLE IF NOT EXISTS `pm_gwc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onum` longtext,
  `wxnum` longtext,
  `text` longtext,
  `paynum` longtext,
  `room` int(11) DEFAULT '0',
  `price` double DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `tai` int(11) DEFAULT '0',
  `pay` int(11) DEFAULT '0',
  `hotels` int(11) DEFAULT '0',
  `userip` longtext,
  `dtime` datetime DEFAULT NULL,
  `ont` datetime DEFAULT NULL,
  `paytime` datetime DEFAULT NULL,
  `yytime` datetime DEFAULT NULL,
  `offt` datetime DEFAULT NULL,
  `adults` varchar(255) DEFAULT NULL,
  `children` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT '0' COMMENT '类别(0：名宿  1:车导）',
  `charter_id` int(11) DEFAULT '0' COMMENT '车导ID',
  `charter_class_id` int(11) DEFAULT '0' COMMENT '车导规格ID',
  `charter_title` varchar(255) DEFAULT NULL,
  `charter_class_name` varchar(255) DEFAULT NULL,
  `arrive_time` datetime DEFAULT NULL COMMENT '到达时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=90 ;

--
-- 挿入前にテーブルを空にする `pm_gwc`
--

TRUNCATE TABLE `pm_gwc`;
--
-- テーブルのデータのダンプ `pm_gwc`
--

INSERT INTO `pm_gwc` (`id`, `onum`, `wxnum`, `text`, `paynum`, `room`, `price`, `uid`, `tai`, `pay`, `hotels`, `userip`, `dtime`, `ont`, `paytime`, `yytime`, `offt`, `adults`, `children`, `type`, `charter_id`, `charter_class_id`, `charter_title`, `charter_class_name`, `arrive_time`) VALUES
(1, '201701190146476493', '201701190146435550', '', NULL, 1, 0, 5, 2, 0, 1, '218.221.108.190', '2017-01-19 05:46:43', '2017-01-19 00:00:00', NULL, '2017-01-19 05:46:47', '2017-01-20 00:00:00', '1', '1', 0, 0, 0, NULL, NULL, NULL),
(2, '201701190147088097', '201701190147058073', '', NULL, 1, 0, 5, 2, 0, 1, '218.221.108.190', '2017-01-19 05:47:05', '2017-01-19 00:00:00', NULL, '2017-01-19 05:47:08', '2017-01-20 00:00:00', '1', '1', 0, 0, 0, NULL, NULL, NULL),
(3, '201701190147444139', '201701190147397129', '', NULL, 1, 0, 5, 2, 0, 1, '218.221.108.190', '2017-01-19 05:47:39', '2017-01-19 00:00:00', NULL, '2017-01-19 05:47:44', '2017-01-21 00:00:00', '1', '1', 0, 0, 0, NULL, NULL, NULL),
(4, '201701190237548148', '201701190237512263', '', NULL, 1, 0, 5, 0, 0, 1, '218.221.108.190', '2017-01-19 05:52:07', '2017-01-19 00:00:00', NULL, NULL, '2017-01-27 00:00:00', '1', '1', 0, 0, 0, NULL, NULL, NULL),
(5, '201701231005215661', '201701231004321175', '', NULL, 1, 0, 5, 2, 0, 1, '106.133.97.237', '2017-01-23 14:04:31', '2017-01-23 00:00:00', NULL, '2017-01-23 14:05:21', '2017-01-23 00:00:00', '2', '2', 0, 0, 0, NULL, NULL, NULL),
(6, '201701251008064355', '201701251007383354', '', NULL, 1, 0, 5, 2, 0, 1, '106.181.80.33', '2017-01-25 02:07:38', '2017-01-25 00:00:00', NULL, '2017-01-25 02:08:06', '2017-01-28 00:00:00', '1', '1', 0, 0, 0, NULL, NULL, NULL),
(7, '201701251012317531', '201701251012283046', '', NULL, 1, 0, 5, 2, 0, 1, '106.181.80.33', '2017-01-25 02:12:28', '2017-01-25 00:00:00', NULL, '2017-01-25 02:12:31', '2017-01-28 00:00:00', '1', '1', 0, 0, 0, NULL, NULL, NULL),
(8, '201701251133532978', '201701251133504094', '', NULL, 1, 0, 5, 2, 0, 1, '106.181.80.33', '2017-01-25 03:33:49', '2017-01-29 00:00:00', NULL, '2017-01-25 03:33:53', '2017-01-30 00:00:00', '2', '2', 0, 0, 0, NULL, NULL, NULL),
(10, '201701291054063131', '201701291053569937', '', NULL, 4, 0, 5, 0, 0, 9, '106.181.81.127', '2017-01-29 14:53:56', '2017-01-29 00:00:00', NULL, NULL, '2017-01-31 00:00:00', '1', '1', 0, 0, 0, NULL, NULL, NULL),
(11, '201701300625354478', '201701300625273331', '', NULL, 4, 0, 8, 2, 0, 9, '126.218.138.71', '2017-01-29 22:25:27', '2017-01-30 00:00:00', NULL, '2017-01-29 22:25:35', '2017-01-31 00:00:00', '1', '1', 0, 0, 0, NULL, NULL, NULL),
(12, '201701301134198370', '201701301134168368', '', NULL, 4, 0, 5, 2, 0, 9, '218.221.108.190', '2017-01-30 03:34:16', '2017-02-01 00:00:00', NULL, '2017-01-30 03:34:19', '2017-02-28 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(13, '201701300408318819', '201701300408283979', '', NULL, 4, 0, 5, 0, 0, 9, '106.181.66.240', '2017-01-30 08:08:28', '2017-02-01 00:00:00', NULL, NULL, '2017-02-03 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(14, '201701310613104629', '201701310612555757', '', NULL, 6, 0, 8, 2, 0, 10, '126.218.138.71', '2017-01-30 22:12:55', '2017-02-01 00:00:00', NULL, '2017-01-30 22:13:10', '2017-02-02 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(15, '201701310618417650', '201701310618377710', '', NULL, 2, 0, 8, 2, 0, 8, '126.218.138.71', '2017-01-30 22:18:37', '2017-02-11 00:00:00', NULL, '2017-01-30 22:18:41', '2017-02-12 00:00:00', '6', '0', 0, 0, 0, NULL, NULL, NULL),
(16, '201701310621037041', '201701310620596025', '', NULL, 7, 0, 8, 2, 0, 11, '126.218.138.71', '2017-01-30 22:20:59', '2017-03-01 00:00:00', NULL, '2017-01-30 22:21:03', '2017-03-31 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(17, '201701311008067521', '201701311008045249', '', NULL, 4, 0, 5, 0, 0, 9, '218.221.108.190', '2017-01-31 02:08:04', '2017-02-01 00:00:00', NULL, NULL, '2017-02-02 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(18, '201701311016468937', '201701311016432118', '', NULL, 4, 0, 5, 0, 0, 9, '218.221.108.190', '2017-01-31 02:16:43', '2017-02-01 00:00:00', NULL, NULL, '2017-02-04 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(19, '201701311027126160', '201701311027101758', '', NULL, 4, 0, 5, 0, 0, 9, '218.221.108.190', '2017-01-31 02:27:10', '2017-02-01 00:00:00', NULL, NULL, '2017-02-03 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(20, '201701311037302836', '201701311037271711', '', NULL, 4, 0, 5, 0, 0, 9, '218.221.108.190', '2017-01-31 02:37:27', '2017-02-01 00:00:00', NULL, NULL, '2017-02-04 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(21, '201701311048087448', '201701311048065560', '', NULL, 4, 0, 5, 0, 0, 9, '218.221.108.190', '2017-01-31 02:48:06', '2017-02-08 00:00:00', NULL, NULL, '2017-02-11 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(22, '201701311054064989', '201701311054038359', '', NULL, 4, 0, 5, 0, 0, 9, '218.221.108.190', '2017-01-31 02:54:03', '2017-02-01 00:00:00', NULL, NULL, '2017-02-03 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(23, '201701311102055589', '201701311102037021', '', NULL, 4, 0, 5, 0, 0, 9, '218.221.108.190', '2017-01-31 03:02:02', '2017-02-01 00:00:00', NULL, NULL, '2017-02-02 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(24, '201701311105304926', '201701311105288050', '', NULL, 4, 0, 5, 0, 0, 9, '218.221.108.190', '2017-01-31 03:05:28', '2017-02-01 00:00:00', NULL, NULL, '2017-02-03 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(25, '201701311133523188', '201701311133462200', '', NULL, 4, 0, 5, 0, 0, 9, '218.221.108.190', '2017-01-31 03:33:46', '2017-02-01 00:00:00', NULL, NULL, '2017-02-03 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(26, '201701311135554501', '201701311135518636', '', NULL, 4, 0, 5, 0, 0, 9, '218.221.108.190', '2017-01-31 03:35:51', '2017-02-01 00:00:00', NULL, NULL, '2017-02-09 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(27, '201701311146313856', '201701311146299896', '', NULL, 4, 0, 5, 0, 0, 9, '218.221.108.190', '2017-01-31 03:46:28', '2017-02-01 00:00:00', NULL, NULL, '2017-02-04 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(28, '201701311239144277', '201701311239112953', '', NULL, 4, 0, 5, 0, 0, 9, '218.221.108.190', '2017-01-31 04:39:11', '2017-02-01 00:00:00', NULL, NULL, '2017-02-03 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(29, '201701311245097147', '201701311245085865', '', '4SU46646CF894945T', 4, 0, 5, 3, 1, 9, '218.221.108.190', '2017-01-31 04:45:07', '2017-02-01 00:00:00', '2017-01-31 04:45:31', NULL, '2017-02-04 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(30, '201701311252412404', '201701311252379297', '', '58P406919A889081T', 4, 0, 5, 3, 1, 9, '218.221.108.190', '2017-01-31 04:52:37', '2017-02-01 00:00:00', '2017-01-31 04:53:04', NULL, '2017-02-04 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(31, '201701311258374293', '201701311258349674', '', '5R691618PX915151P', 4, 0, 5, 3, 1, 9, '218.221.108.190', '2017-01-31 04:58:34', '2017-01-31 00:00:00', '2017-01-31 04:58:59', NULL, '2017-02-03 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(32, '201701310101518666', '201701310101481798', '', '098842650L6819722', 4, 0, 5, 3, 1, 9, '218.221.108.190', '2017-01-31 05:01:48', '2017-01-31 00:00:00', '2017-01-31 05:02:11', NULL, '2017-01-31 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(33, '201701310102424359', '201701310102408893', '', '08G510858R5993209', 4, 0, 5, 3, 1, 9, '218.221.108.190', '2017-01-31 05:02:39', '2017-02-01 00:00:00', '2017-01-31 05:02:59', NULL, '2017-02-03 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(34, '201701310103364618', '201701310103332478', '', '4EH96853SM565740M', 5, 0, 5, 3, 1, 9, '218.221.108.190', '2017-01-31 05:03:33', '2017-02-04 00:00:00', '2017-01-31 05:03:53', NULL, '2017-02-08 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(35, '201701310104509226', '201701310104482070', '', NULL, 4, 0, 5, 0, 0, 9, '218.221.108.190', '2017-01-31 05:04:48', '2017-02-09 00:00:00', NULL, NULL, '2017-02-17 00:00:00', '3', '0', 0, 0, 0, NULL, NULL, NULL),
(37, '201701310353045181', '201701310353025517', '', '2V552936896502248', 4, 9000, 5, 3, 1, 9, '218.221.108.190', '2017-01-31 07:53:01', '2017-02-09 00:00:00', '2017-01-31 07:53:47', NULL, '2017-02-11 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(38, '201701310408209894', '201701310408194850', '', NULL, 4, 4500, 5, 2, 0, 9, '218.221.108.190', '2017-01-31 08:08:19', '2017-02-12 00:00:00', NULL, '2017-01-31 08:08:20', '2017-02-13 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(39, '201701310418065217', '201701310418044805', '', NULL, 7, 0, 5, 2, 0, 11, '218.221.108.190', '2017-01-31 08:18:04', '2017-02-12 00:00:00', NULL, '2017-01-31 08:18:06', '2017-02-15 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(40, '201702010614086928', '201702010553441440', '', NULL, 2, 0, 8, 2, 0, 8, '126.218.138.71', '2017-01-31 21:53:44', '2017-02-12 00:00:00', NULL, '2017-01-31 22:14:08', '2017-02-16 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(41, '201702010623091222', '201702010623026111', '带条狗', NULL, 7, 0, 8, 2, 0, 11, '126.218.138.71', '2017-01-31 22:23:02', '2017-02-17 00:00:00', NULL, '2017-01-31 22:23:09', '2017-02-20 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(42, '201702010623488714', '201702010623467204', '带两条狗', NULL, 6, 0, 8, 2, 0, 10, '126.218.138.71', '2017-01-31 22:23:45', '2017-02-18 00:00:00', NULL, '2017-01-31 22:23:48', '2017-02-23 00:00:00', '2', '1', 0, 0, 0, NULL, NULL, NULL),
(43, '201702010624378354', '201702010624177284', '带三条狗', NULL, 4, 22500, 8, 0, 0, 9, '126.218.138.71', '2017-01-31 22:24:17', '2017-02-19 00:00:00', NULL, NULL, '2017-02-24 00:00:00', '3', '2', 0, 0, 0, NULL, NULL, NULL),
(44, '201702010632054581', '201702010631492209', '带了三条狗', NULL, 4, 13500, 8, 0, 0, 9, '126.218.138.71', '2017-01-31 22:31:49', '2017-02-19 00:00:00', NULL, NULL, '2017-02-22 00:00:00', '5', '2', 0, 0, 0, NULL, NULL, NULL),
(45, '201702010638212539', '201702010638171209', '', NULL, 4, 13500, 8, 0, 0, 9, '126.218.138.71', '2017-01-31 22:38:17', '2017-02-19 00:00:00', NULL, NULL, '2017-02-22 00:00:00', '4', '1', 0, 0, 0, NULL, NULL, NULL),
(46, '201702010639148745', '201702010639124592', '带了三条狗', NULL, 4, 13500, 8, 2, 0, 9, '126.218.138.71', '2017-01-31 22:39:12', '2017-02-19 00:00:00', NULL, '2017-01-31 22:39:15', '2017-02-22 00:00:00', '3', '1', 0, 0, 0, NULL, NULL, NULL),
(47, '201702011223552614', '201702011223535686', '', '57N32187TJ1277703', 4, 36000, 5, 3, 1, 9, '218.221.108.190', '2017-02-01 04:23:53', '2017-02-17 00:00:00', '2017-02-01 04:29:00', NULL, '2017-02-25 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(48, '201702011225541623', '201702011225513249', '', NULL, 4, 9000, 5, 0, 0, 9, '218.221.108.190', '2017-02-01 04:25:51', '2017-02-17 00:00:00', NULL, NULL, '2017-02-19 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(49, '201702010949585234', '201702010949542032', '', NULL, 4, 9000, 5, 0, 0, 9, '106.133.98.136', '2017-02-01 13:49:53', '2017-02-26 00:00:00', NULL, NULL, '2017-02-28 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(53, '201702011111293696', '201702011111086074', '住宿1', '4502804243598884B', 4, 4500, 8, 3, 1, 9, '126.218.138.71', '2017-02-01 15:11:08', '2017-02-27 00:00:00', '2017-02-01 15:13:01', NULL, '2017-02-28 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(54, '201702021131307712', '201702021131272494', '', NULL, 6, 25000, 5, 2, 0, 10, '218.221.108.190', '2017-02-02 03:31:26', '2017-02-04 00:00:00', NULL, '2017-02-02 03:31:30', '2017-02-09 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(55, '201702021132029089', '201702021132003415', '', '7AC86853PN372801G', 6, 35000, 5, 3, 1, 10, '218.221.108.190', '2017-02-02 03:31:59', '2017-02-04 00:00:00', '2017-02-02 03:32:32', NULL, '2017-02-11 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(56, '201702021145488645', '201702021145461511', '', '44G08224NS8450241', 7, 42000, 5, 3, 1, 11, '218.221.108.190', '2017-02-02 03:45:46', '2017-02-04 00:00:00', '2017-02-02 03:46:13', NULL, '2017-02-11 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(57, '201702021146569617', '201702021146524888', '', NULL, 4, 24000, 5, 2, 0, 9, '218.221.108.190', '2017-02-02 03:46:52', '2017-02-12 00:00:00', NULL, '2017-02-02 03:46:56', '2017-02-16 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(58, '201702021147386262', '201702021147357353', '', NULL, 4, 24000, 5, 2, 0, 9, '218.221.108.190', '2017-02-02 03:47:35', '2017-02-04 00:00:00', NULL, '2017-02-02 03:47:38', '2017-02-08 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(59, '201702021148373355', '201702021148327340', '', '49U7124627194400F', 4, 42000, 5, 3, 1, 9, '218.221.108.190', '2017-02-02 03:48:32', '2017-02-04 00:00:00', '2017-02-02 03:49:01', NULL, '2017-02-11 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(60, '201702021149371610', '201702021149356972', '', '7JW70610HG057883N', 7, 6000, 5, 3, 1, 11, '218.221.108.190', '2017-02-02 03:49:35', '2017-02-16 00:00:00', '2017-02-02 03:49:53', NULL, '2017-02-17 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(61, '201702021205353620', '201702021205313381', '', '6J128085MH609350R', 7, 6000, 5, 3, 1, 11, '106.171.48.10', '2017-02-02 04:05:31', '2017-02-02 00:00:00', '2017-02-02 04:06:16', NULL, '2017-02-03 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(62, '201702030632482040', '201702030632411372', '测试19', '0XY96281VV338262T', 7, 6000, 8, 3, 1, 11, '126.218.138.71', '2017-02-02 22:32:41', '2017-02-25 00:00:00', '2017-02-02 22:33:15', NULL, '2017-02-26 00:00:00', '1', '1', 0, 0, 0, NULL, NULL, NULL),
(63, '201702040416335482', '201702040416265829', '', '3WY7851181714193B', 7, 6000, 8, 3, 1, 11, '126.152.209.143', '2017-02-04 08:16:26', '2017-02-12 00:00:00', '2017-02-04 08:18:51', NULL, '2017-02-13 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(64, '201702040440321788', '201702040440284007', '', NULL, 5, 4500, 8, 2, 0, 9, '126.152.209.143', '2017-02-04 08:40:28', '2017-02-06 00:00:00', NULL, '2017-02-04 08:40:32', '2017-02-07 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(65, '201702060727142002', '201702060726545999', '手机版信息录入时，看不到任何录入信息。一片白屏！', NULL, 7, 6000, 10, 2, 0, 11, '126.254.193.187', '2017-02-05 23:26:53', '2017-02-21 00:00:00', NULL, '2017-02-05 23:27:14', '2017-02-22 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(66, '201702061014329911', '201702061014292174', '', NULL, 6, 5000, 5, 2, 0, 10, '116.2.5.105', '2017-02-06 02:14:27', '2017-02-12 00:00:00', NULL, '2017-02-06 02:14:32', '2017-02-12 00:00:00', '2', '1', 0, 0, 0, NULL, NULL, NULL),
(67, '201702070633429855', '201702070633351719', 'pc登陆', NULL, 6, 5000, 10, 2, 0, 10, '126.218.138.71', '2017-02-06 22:33:34', '2017-02-25 00:00:00', NULL, '2017-02-06 22:33:42', '2017-02-26 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(68, '201702070634459523', '201702070634391236', 'PC登陆2', '9FR62306PY214483E', 4, 6000, 10, 3, 1, 9, '126.218.138.71', '2017-02-06 22:34:39', '2017-02-18 00:00:00', '2017-02-06 22:36:09', NULL, '2017-02-19 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(70, '201702071123278182', '201702071123218678', '', NULL, 2, 400, 5, 0, 0, 8, '218.221.108.190', '2017-02-07 03:23:21', '2017-02-10 00:00:00', NULL, NULL, '2017-02-11 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(72, '201702070817345656', '201702070817204333', '手机登陆', '52Y66094CF5733348', 6, 5000, 10, 3, 1, 10, '126.199.72.90', '2017-02-07 12:17:20', '2017-02-25 00:00:00', '2017-02-07 12:18:11', NULL, '2017-02-26 00:00:00', '2', '0', 0, 0, 0, NULL, NULL, NULL),
(73, '201702070819365657', '201702070819275249', '手机用户2', NULL, 4, 6000, 10, 2, 0, 9, '126.199.72.90', '2017-02-07 12:19:27', '2017-02-27 00:00:00', NULL, '2017-02-07 12:19:36', '2017-02-28 00:00:00', '5', '2', 0, 0, 0, NULL, NULL, NULL),
(74, '201702071031498026', '201702071031458167', '', NULL, 4, 18000, 5, 2, 0, 9, '126.66.63.109', '2017-02-07 14:31:45', '2017-02-12 00:00:00', NULL, '2017-02-07 14:31:49', '2017-02-15 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(85, '201702160104185092', '201702160103593953', NULL, NULL, 0, 2000, 5, 2, 0, 0, '218.221.108.190', '2017-02-16 05:01:54', NULL, NULL, '2017-02-16 05:04:18', NULL, '2', '1', 1, 9, 3, '神户特色一日游', '商务10座', '2017-02-17 00:00:00'),
(86, '201702160104332193', '201702160104318188', '', NULL, 6, 40000, 5, 2, 0, 10, '218.221.108.190', '2017-02-16 05:04:31', '2017-02-16 00:00:00', NULL, '2017-02-16 05:04:33', '2017-02-24 00:00:00', '1', '0', 0, 0, 0, NULL, NULL, NULL),
(87, '201702170515239741', '201702170514569464', NULL, NULL, 0, 1000, 8, 2, 0, 0, '126.218.138.71', '2017-02-16 21:14:56', NULL, NULL, '2017-02-16 21:15:03', NULL, '6', '1', 1, 8, 5, '神户二日游', '豪华七座', '2017-02-19 00:00:00'),
(88, '201702170534275456', '201702170532497347', NULL, '0JF60895TS9800812', 0, 1200, 8, 3, 1, 0, '126.218.138.71', '2017-02-16 21:32:49', NULL, '2017-02-17 06:55:22', NULL, NULL, '3', '1', 1, 9, 1, '神户特色一日游', '舒适五座', '2017-02-20 00:00:00'),
(89, '201702170543244898', '201702170542357097', NULL, NULL, 0, 600, 8, 2, 0, 0, '126.218.138.71', '2017-02-16 21:42:35', NULL, NULL, '2017-02-16 21:42:53', NULL, '5', '1', 1, 7, 2, '神户送迎服务', '舒适七座', '2017-02-20 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_hospital`
--

DROP TABLE IF EXISTS `pm_hospital`;
CREATE TABLE IF NOT EXISTS `pm_hospital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `departments` varchar(250) NOT NULL,
  `beds` varchar(250) NOT NULL,
  `establishmentday` varchar(250) NOT NULL,
  `text` longtext NOT NULL,
  `id_page` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `publish_date` int(11) DEFAULT NULL,
  `unpublish_date` int(11) DEFAULT NULL,
  `comment` int(11) DEFAULT '0',
  `rating` int(11) DEFAULT '0',
  `num` int(11) DEFAULT '0',
  `addres` longtext,
  `phone` longtext,
  `yuan` longtext,
  `mail` longtext,
  PRIMARY KEY (`id`,`lang`),
  KEY `hospital_lang_fkey` (`lang`),
  KEY `hospital_page_fkey` (`id_page`,`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- 挿入前にテーブルを空にする `pm_hospital`
--

TRUNCATE TABLE `pm_hospital`;
--
-- テーブルのデータのダンプ `pm_hospital`
--

INSERT INTO `pm_hospital` (`id`, `lang`, `title`, `departments`, `beds`, `establishmentday`, `text`, `id_page`, `id_user`, `home`, `checked`, `rank`, `add_date`, `edit_date`, `publish_date`, `unpublish_date`, `comment`, `rating`, `num`, `addres`, `phone`, `yuan`, `mail`) VALUES
(7, 2, '順天堂大学医学部附属順天堂医院', '内科、外科、消化器内科、消化器外科、大腸・肛門外科、婦人科、泌尿器科漢方内科、麻酔科、ペインクリニック内科、乳腺外科', '一般病床：600床', '1962年2月1日', '<p>日本顺天堂大学附属顺天堂医院是日本综合排名第一的医院，顺天堂医院在瓣膜疾病、呼吸内科与呼吸外科疾病、肺癌治疗方面是日本最顶级的，肺癌治疗人数全日本第一位，该院在心脏方面仅次于榊原纪念病院，在日本排名第二。日本明仁天皇曾在顺天堂医院实施了心脏手术并获得成功。顺天堂医院已经成立170多年了，在日本等额地位相当于国内的协和医院。</p>\r\n', NULL, 1, 1, 1, 1, 1481685181, 1483964484, NULL, NULL, NULL, NULL, 5, '東京都世田谷区玉川2-15-12', '090-0000-0000', '西田俊朗（中央病院長）', 'mei@163.com'),
(8, 2, '東京女子医科大学医院', '外科，整形外科，内科，妇科，产科', '一般床位：1,432床', '1908年12月', '<p><span style="font-family:SimSun"><span style="color:#333333">东</span></span><span style="font-family:''ＭＳ 明朝''">京女子医科大学由吉冈弥生</span><span style="font-family:''ＭＳ 明朝''">女士始</span><span style="font-family:SimSun">创</span><span style="font-family:''ＭＳ 明朝''">于</span><span style="font-family:''ＭＳ 明朝''">1900年。当初</span><span style="font-family:SimSun">创</span><span style="font-family:''ＭＳ 明朝''">建</span><span style="font-family:SimSun">该</span><span style="font-family:''ＭＳ 明朝''">大学的目的是</span><span style="font-family:SimSun">为</span><span style="font-family:''ＭＳ 明朝''">了提高女性的社会地位，而目前</span><span style="font-family:SimSun">该</span><span style="font-family:''ＭＳ 明朝''">大学凭借在</span><span style="color:red">心血管</span><span style="font-family:''ＭＳ 明朝''">，</span><span style="color:red">糖尿病</span><span style="font-family:''ＭＳ 明朝''">，</span><span style="font-family:SimSun"><span style="color:red">风</span></span><span style="color:red">湿病</span><span style="font-family:''ＭＳ 明朝''">，</span><span style="color:red">生物工程</span><span style="font-family:''ＭＳ 明朝''">和</span><span style="color:red">基因技</span><span style="font-family:SimSun"><span style="color:red">术</span></span><span style="font-family:''ＭＳ 明朝''">等</span><span style="font-family:SimSun">领</span><span style="font-family:''ＭＳ 明朝''">域的出色成就以及独特的医学教育模式，</span><span style="font-family:SimSun">跻</span><span style="font-family:''ＭＳ 明朝''">身日本一流医科大学。</span><span style="font-family:SimSun">该</span><span style="font-family:''ＭＳ 明朝''">大学下属有三个附属医院，一个研究生院，一个</span><span style="font-family:SimSun">护</span><span style="font-family:''ＭＳ 明朝''">理学院以及若干个研究所。其中日本</span><span style="font-family:SimSun">东</span><span style="font-family:''ＭＳ 明朝''">京女子医科大学附属医院是他</span><span style="font-family:SimSun">们</span><span style="font-family:''ＭＳ 明朝''">最大的一所附属医院，共有床位</span><span style="font-family:''ＭＳ 明朝''">1432</span><span style="font-family:SimSun">张</span><span style="font-family:''ＭＳ 明朝''">，并且</span><span style="font-family:SimSun">拥</span><span style="font-family:''ＭＳ 明朝''">有日本心</span><span style="font-family:SimSun">脏</span><span style="font-family:''ＭＳ 明朝''">研究所等</span><span style="font-family:''ＭＳ 明朝''">9个具有一流水准的研究所</span></p>\r\n', NULL, 1, 1, 1, 2, 1484583928, 1485099499, 1484583480, NULL, NULL, NULL, 5, '東京都 新宿区 河田町 8-1 ', '03-3353-8111', '田邉　一成', 'kouhou-wg.bm@twmu.ac.jp'),
(9, 2, '圣路加国际医院', '内科、消化科、循环科、呼吸科、心内科、神経内科、精神科、小儿科、外科、呼吸外科、心脏血管外科、脑神经外科、整形外科、形成外科、小儿外科、眼科、耳鼻喉科、病理诊断科、皮肤科、泌尿科、产妇科、放射线科、麻醉科、齿科口腔外科、临床检测科、乳腺外科', '一般病床：520', '1902年', '<p>1902年成立。初任财团法人董事长是实业家涩泽荣一以外 ，由于得到皇室的重视在战前旧病楼建设时得到了大量的补贴资金。在媒体及出版社活跃的有名的日野原重明出任名誉院长，医院内长期设置医疗社会事业科，有许多的医务社工。作为关联组织，并设了圣路加生命科学研究所。<br />\r\n无论在所谓的医院排行榜常常名列前茅，还是作为实习医的初期临床研修设施为人所知，成为日本医科学生中最热门研修地之一，与有名的虎门医院等并排而座。</p>\r\n', NULL, 1, 1, 1, 3, 1484609332, 1485100140, 1484609100, NULL, NULL, NULL, 5, '〒104-8560 東京都中央区明石町9番1号', '03-3541-5151', '福井次矢', 'human_saiyo@luke.ac.jp'),
(10, 2, '日本红十字医疗中心', '糖尿病内分泌科、血液内科、化学疗法科、感染症科、肾脏内科、 神经内科、呼吸器内科、消化器内科、循环器内科、呼吸器外科、乳腺外科、胃・食道外科、内视镜診断治疗科、肝胆膵・移植外科、大肠肛門外科、心脏血管外科、脊椎整形外科、骨・关节整形外科、脑神经外科、皮肤科、泌尿器科、眼科、耳鼻咽喉科、产科、妇科、新生儿科、小儿科、小儿保健、小儿外科、麻醉科、集中治疗科、放射线特殊治疗科、齿科・口腔外科', '一般　708床', '1886年11月', '<p>日本红十字会医疗中心坐落于東京·广尾和堀田備中守。由其前身日本红十字医院迁移到此，于1891年建院。医院前设有数百米的红瓦围墙。公车站前的银杏树据测有500年的树龄，被认定为涩谷区的天然纪念物。</p>\r\n\r\n<p>1949年起，天皇皇后就任为该院的荣誉院长。</p>\r\n', NULL, 1, 1, 1, 4, 1484752079, 1484862823, 1484751060, NULL, NULL, NULL, 5, '〒150-8935 東京都渋谷区広尾4-1-22', '03-3400-1311', '幕内　雅敏', 'test@med.jrc.or.jp'),
(11, 2, '外苑东医院', '放射线科・内科、癌检测、脑健诊、心脏健诊', '无', '2011年10月', '<p>◆提供通过新检查方法进行的"新世代PET检查"服务。</p>\r\n\r\n<p>◆特点是早期发现肝癌、胆囊癌、胰腺癌，除了PET/CT，还通过MRI追加MRCP检查，同时使用全身背景抑制弥散加权成像（MRI全身癌瘤检查）和PET影像，力争减少假阴性、假阳性诊断。</p>\r\n\r\n<p>◆有各种特色套餐，预约时请确认。</p>\r\n', NULL, 1, 1, 1, 5, 1484753921, 1484862858, 1484753820, NULL, NULL, NULL, 5, '〒160-0017 東京都新宿区左門町20番地 四谷メディカルビル2階', '03-5919-0537', '宇野　公一', '无'),
(12, 2, '辻仲病院柏之葉', '内科、外科、消化器内科、消化器外科、大肠・肛門外科、妇科、泌尿器科、中医内科、麻醉科、乳腺外科', '186床', '2009年6月', '<p>辻仲病院柏之葉的综合体检套餐，以高水准的内窥镜检查技术为优势。院内的环境优雅舒适，在接受高质量体检的同时，使接受体检人身心也可以达到放松的目的。</p>\r\n\r\n<p> 为了您可以更好地享受舒适的健康生活，同时也为了早期发现，早期治疗身体中存在的疾病，请选择符合您自身生活方式的体检套餐。</p>\r\n\r\n<p>接受检查的套餐： 综合体检 ·脑部综合体检 ·妇科检查 ·乳腺癌检查 ·子宫癌检查 ·大肠癌检查 ·胃癌检查 ·肺癌检查 ·女性综合检查</p>\r\n', NULL, 1, 1, 1, 6, 1484754455, 1484862888, 1484754360, NULL, NULL, NULL, 5, '〒277-0871 千葉県柏市若柴178番地2　柏の葉キャンパス148街区6', '04-7137-3737', '浜畑　幸弘', '无'),
(13, 2, '国立国際医療研究中心病院', '综合诊疗科、感染症内科、血液内科、胶原病科、呼吸器科、消化器科、循环器科、肾脏内科、神经内科、精神科、小儿科、外科、心脏血管外科、呼吸器外科、整形外科、脑神经外科、皮肤科、泌尿器科、产妇人科、眼科、耳鼻咽喉科、机能障碍科、放射线科、麻醉科、緩和医疗科、艾滋治疗・研究开发中心、齿科・口腔外科、常规体检、形成外科、救急部、糖尿病・代謝・内分泌科、戒烟治疗', '781床', '1868年10月', '<p>日本最早开始实行个人体检的医院，前身是国立东京第一医院。长年的实绩和经验积累，一直为广大民众提供高精度的体检服务。2016年5月体检中心又更新了新的设备，以预防疾病，健康增进为宗旨，根据新的医疗趋势加入了更为广泛的检查，以及更多领域的精密检查和治疗。</p>\r\n\r\n<p>接受检查的套餐： 综合体检 ·妇科检查 ·乳腺癌检查 ·子宫癌检查 ·大肠癌检查 ·胃癌检查 ·PET检查·肺癌检查 ·女性综合检查</p>\r\n', NULL, 1, 1, 1, 7, 1484755712, 1484862924, 1484754420, NULL, NULL, NULL, 5, '〒162-8655　東京都新宿区戸山1-21-1', '03-3202-7181', '大西 真', 'test@hosp.ncgm.go.jp'),
(14, 2, '国立癌症研究中心', '内科、消化器科、循環器科、呼吸器科、精神科、小児科、外科、呼吸器外科、脳神経外科、整形外科、形成外科、眼科、耳鼻いんこう科、気管食道科、皮膚科、泌尿器科、婦人科、放射線科、麻酔科、歯科、歯科口腔外科', '600床', '1962年2月1日', '<p>国立癌研究中心预防/检查研究中心（东京都 中央区）</p>\r\n\r\n<p>国立癌预防/检查研究中心是 开放了新型癌症检查筛选系统，使用多种精密设备，以[患者、社会与协动进行世界最高医疗研究]为基本理念，以每位患者获得彻底获得健康为目标。</p>\r\n\r\n<p> </p>\r\n\r\n<p>接受检查的套餐： 综合体检 ·妇科检查 ·乳腺癌检查 ·子宫癌检查 ·大肠癌检查 ·胃癌检查 ·PET检查·肺癌检查 ·女性综合检查</p>\r\n', NULL, 1, 1, 1, 8, 1484756140, 1484862978, 1484756040, NULL, NULL, NULL, 5, '〒104-0045 東京都中央区築地五丁目1番1号', '03-3547-5130', '西田俊朗', '无'),
(15, 2, '亀田総合病院', '内科、心疗内科、精神科、神经内科、呼吸器科、消化器科、循环器科、过敏科、风湿科、小儿科、外科、整形外科、形成外科、美容外科、脑神经外科、呼吸器外科、心脏血管外科、消化器外科、小儿外科、皮肤科、泌尿器科、产科、妇科、眼科、耳鼻咽喉科、机能障碍科、放射线科、麻醉科、救急科、齿科、矫正齿科、小儿齿科、齿科口腔外科、病理诊断科', '865床', '1948年1月', '<p>龟田综合医院是以龟田医疗中心为核心机能的医院，在日本千叶先南部的基干医院，本院以优秀的人才，高精度的仪器，导入，驱使，应对紧急治疗，集中于（ICU、CCU、ECU、 NCU、NICU）</p>\r\n\r\n<p>的急性高度医疗提供助力。诊疗部门包含的所有医疗服务是日本第一家获得ISO9001认证和医院机构的评价，更是获得了国际医疗机能评价（JCI）。</p>\r\n\r\n<p> </p>\r\n\r\n<p>1995年以世界为先驱，开始运用电子病例系统，医疗情报彻底的灵活运用推进，被全日本所认可。</p>\r\n', NULL, 1, 1, 1, 9, 1484756714, 1484863003, 1484756100, NULL, NULL, NULL, 5, '〒296-8602 千葉県鴨川市東町929番地', '04-7092-2211', '亀田信介', '无'),
(16, 2, '应庆义塾大学病院', '内科（循环器、呼吸器、消化器、肾脏・内分泌・代谢、神经、血液、风湿）、外科（一般・消化器、心脏血管、呼吸器、脑神经、小儿）、麻醉科、整形外科、形成外科、小儿科、产科、妇科、眼科、皮肤科、泌尿器科、耳鼻咽喉科、精神・神经科、放射线治疗科、放射线诊断科、齿科・口腔外科、机能障碍科、救急科、综合诊疗科', '1044床', '1917年4月', '<p>应庆义塾大学医院是一家被指定为提供高度医疗服务的特定机能医院。秉承以患者为中心的医疗理念，提供值得信赖的高品质医疗服务。以培养高端医疗人才，和为尊重人权的医学事业贡献力量为己任。</p>\r\n\r\n<p>每年为100万患者提供搞治疗的医疗服务。</p>\r\n', NULL, 1, 1, 1, 10, 1484766529, 1484863439, 1484766420, NULL, NULL, NULL, 5, '〒160-8582　東京都新宿区信濃町35', '03-3353-1211', '竹内 勤', '无'),
(17, 2, '東京慈恵会医大病院', '综合诊疗部、救急部、消化器・肝脏内科、神经内科、肾脏･高血压内科、风湿･胶原病内科、循环器内科、糖尿病･代謝･内分泌内科、肿疡・血液内科、呼吸器内科、精神神经科、小儿科、皮肤科、 消化管外科、食道・胃外科、大肠・肛門外科、肝胆膵外科、乳腺・内分泌外科、呼吸器外科、血管外科、小儿外科、整形外科、脑神经外科、形成外科、心脏外科、产妇人科、泌尿器科、眼科、耳鼻咽喉科、机能障碍科、齿科(齿科口腔外科･小儿齿科)、小儿脑神经外科', '1,026床', '1881年5月', '<p>東京慈恵会医科大学以高木兼宽于1881年创立的成医会讲习所为起点的一所医科大学。秉承“治病先治人”的理念，为社会各界所认可。附属大学医院，秉承该理念，为患者提供高品质的医疗服务。</p>\r\n\r\n<p>该院的基本方针如下</p>\r\n\r\n<p>1.为提供患者和家属满意的医疗服务而不断实践</p>\r\n\r\n<p>2.研发，导入先进的医疗技术和手段，为提高医疗水准不懈努力。</p>\r\n\r\n<p>3.培养拥有高度技术，和尊重人权的医师为己任。</p>\r\n\r\n<p>4.和社会各界紧密结合，提供细致的医疗服务。</p>\r\n\r\n<p>5.为职员提供值得骄傲的工作环境而不断实践。</p>\r\n', NULL, 1, 1, 1, 11, 1484766610, 1484863625, 1484766480, NULL, NULL, NULL, 5, '〒105－8471 東京都港区西新橋3－19－18', '03-3433-1111', '丸毛　啓史', '无'),
(18, 2, '東京都立駒込病院', '内科、消化器科、循环器科、呼吸器科、神经科、小儿科、外科、脑神经外科、整形外科、形成外科、眼科、耳鼻咽喉科、皮肤科、泌尿器科、妇科、放射线科、麻醉科、齿科、齿科口腔外科', '833床', '1879年9月', '<p>以癌症和传染病治疗为专长，关联科室齐全。和“癌症研究会有明医院”被指定为东京都的“癌症治疗指定医院”。</p>\r\n\r\n<p>明知初年霍乱流行时期，被指定为传染病专门治疗医院，曾开发出『定量吸管』等医疗器具。</p>\r\n', NULL, 1, 1, 1, 12, 1484766701, 1484863658, 1484766600, NULL, NULL, NULL, 5, '〒113－8677　東京都文京区本駒込三丁目18番22号', '03-3823-2101', '鳶巣賢一', '无'),
(19, 2, '東京大学病院', '综合诊疗部、救急部、消化器・肝脏内科、神经内科、肾脏･高血压内科、风湿･胶原病内科、循环器内科、糖尿病･代謝･内分泌内科、肿疡・血液内科、呼吸器内科、精神神经科、小儿科、皮肤科、 消化管外科、食道・胃外科、大肠・肛門外科、肝胆膵外科、乳腺・内分泌外科、呼吸器外科、血管外科、女性外科、小儿外科、整形外科、脑神经外科、形成外科、心脏外科、产妇人科、泌尿器科、男性科、老年病科、眼科、耳鼻咽喉科、机能障碍科、齿科矫正齿科', '1163床', '1858年5月', '<p>作为日本最高学府的附属医院，以优秀的人才，高精度的仪器，导入，驱使，应对紧急治疗，集中于（ICU、CCU、ECU、 NCU、NICU）的急性高度医疗提供.</p>\r\n', NULL, 1, 1, 1, 13, 1484766793, 1484863718, 1484766660, NULL, NULL, NULL, 5, '〒113-8655　東京都文京区本郷7-3-1', '03-3815-5411', '斉藤　延人', '无'),
(20, 2, '杏林大学病院', '呼吸器内科、血液内科、肿瘤内科、循环器内科、高龄诊疗科、神经内科、感染症科、肾脏内科、糖尿病・内分泌・代謝内科、风湿免疫内科、消化器内科、消化器・一般外科、呼吸器・甲状腺外科、乳腺外科、形成外科・美容外科、脑神经外科、心脏血管外科、整形外科、口腔外科、泌尿器科、眼科、耳鼻咽喉科・头颈科、产科、妇科、救急科、小儿外科、救急综合诊疗科、机能障碍科、精神神经科、皮肤科、麻醉科、放射线科、小儿科、脑中风科', '1153床', '1954年1月', '', NULL, 1, 1, 1, 14, 1484766874, 1484863759, 1484766780, NULL, NULL, NULL, 5, '〒181-8611 東京都三鷹市新川6-20-2', '0422-47-5511', '岩下 光利', '无'),
(21, 2, '東京医大病院', '内科、 血液内科、呼吸器内科、循环器内科、糖尿病内分泌内科、风湿科、过敏科、神经内科、消化器内科、肾脏内科、老年内科、临床检查科、精神科、小儿科、外科、呼吸器外科、心脏外科、血管外科、消化器外科、小儿外科、乳腺外科、眼科、脑圣经外科、耳鼻咽喉科、整形外科、形成外科、麻醉科、皮肤科、齿科口腔外科、产科、妇科、泌尿器科、放射线科、康复科', '1015床', '1931年5月', '', NULL, 1, 1, 1, 15, 1484766980, 1484863792, 1484766840, NULL, NULL, NULL, 5, '〒160-0023　東京都新宿区西新宿６-７-１', '03-3342-6111', '土田明彦', '无'),
(22, 2, '虎門病院　　　　　　　　　', '内科、消化器科、循环器科、呼吸器科、神经内科、精神科、小儿科、外科、呼吸器外科、心脏血管外科、脑神经外科、整形外科、形成外科、眼科、耳鼻咽喉科、皮肤科、泌尿器科、产妇人科、反射线科、麻醉科、齿科', '868床', '1958年5月', '<p>该院作为国家公务员及其家属的定点治疗机构于1958年设立，同时面向公务员以外的各界民众提供高质量的医疗服务。拥有大量优秀人才和高新技术，设备。</p>\r\n', NULL, 1, 1, 1, 16, 1484767070, 1484863956, 1484766960, NULL, NULL, NULL, 5, '〒105-8470 東京都港区虎ﾉ門二丁目2番２号', '03-3588-1111', '大内 尉義', '无'),
(23, 2, '帝京大学病院', '内科、循环器内科、心疗内科、姑息内科、肿瘤内科、神经内科、外科、心脏血管外科、整形外科、产妇人科、小儿科、眼科、耳鼻咽喉科、皮肤科、泌尿器科・前列腺中心、放射线科、脑神经外科、康复科、形成外科、齿科口腔外科、救急科、病理诊断科', '1082床', '1971年', '', NULL, 1, 1, 1, 17, 1484767134, 1484863857, 1484767020, NULL, NULL, NULL, 5, '〒173-8606　東京都板橋区加賀2-11-1', '03-3964-1211', '坂本　哲也', '无');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_hospital_file`
--

DROP TABLE IF EXISTS `pm_hospital_file`;
CREATE TABLE IF NOT EXISTS `pm_hospital_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `hospital_file_fkey` (`id_item`,`lang`),
  KEY `hospital_file_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 挿入前にテーブルを空にする `pm_hospital_file`
--

TRUNCATE TABLE `pm_hospital_file`;
--
-- テーブルのデータのダンプ `pm_hospital_file`
--

INSERT INTO `pm_hospital_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(2, 2, 7, NULL, 1, 1, 'medical-2-11.jpg', '', 'image'),
(3, 2, 8, NULL, 1, 3, '.jpg', '', 'image'),
(4, 2, 9, NULL, 1, 4, '.jpg', '', 'image'),
(5, 2, 10, NULL, 1, 4, '.jpg', NULL, 'image'),
(6, 2, 11, NULL, 1, 5, '.jpg', NULL, 'image'),
(7, 2, 12, NULL, 1, 6, '.jpg', NULL, 'image'),
(8, 2, 13, NULL, 1, 7, '.jpg', NULL, 'image'),
(9, 2, 14, NULL, 1, 8, '.jpg', NULL, 'image'),
(10, 2, 15, NULL, 1, 9, '.jpg', NULL, 'image'),
(11, 2, 16, NULL, 1, 10, 'main-img.jpg', NULL, 'image'),
(12, 2, 16, NULL, 1, 11, 'img-index-01.jpg', NULL, 'image'),
(13, 2, 17, NULL, 1, 12, '1.jpg', NULL, 'image'),
(14, 2, 17, NULL, 1, 13, '2.jpg', NULL, 'image'),
(15, 2, 18, NULL, 1, 14, '.jpg', NULL, 'image'),
(17, 2, 19, NULL, 1, 2, '1.jpg', NULL, 'image'),
(18, 2, 20, NULL, 1, 15, '.jpg', NULL, 'image'),
(19, 2, 21, NULL, 1, 16, '.jpg', NULL, 'image'),
(20, 2, 22, NULL, 1, 17, '.jpg', '', 'image'),
(21, 2, 23, NULL, 1, 18, '.png', NULL, 'image'),
(22, 2, 8, 1, 1, 1, '01-e1402633727950.jpg', '', 'image'),
(23, 2, 8, NULL, 1, 2, '1641014a1-2.jpg', '', 'image'),
(24, 2, 9, NULL, 1, 2, '800px-st-luke-s-college-of-nursing-2006-05-06-1.jpg', '', 'image'),
(25, 2, 9, NULL, 1, 3, 'seiroka-gardens.jpg', '', 'image'),
(26, 2, 9, 1, 1, 1, 'hptop.jpg', '', 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_hotel`
--

DROP TABLE IF EXISTS `pm_hotel`;
CREATE TABLE IF NOT EXISTS `pm_hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `web` varchar(250) DEFAULT NULL,
  `descr` longtext,
  `facilities` varchar(250) DEFAULT NULL,
  `id_destination` int(11) DEFAULT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `lid` int(11) DEFAULT '0',
  `num` int(11) DEFAULT '0',
  `tui` int(11) DEFAULT '0',
  `zhe` int(11) DEFAULT '0',
  `ren` int(11) DEFAULT '0',
  `jiage` int(11) DEFAULT '0',
  `sou` int(11) DEFAULT '0',
  `ont` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `hotel_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 挿入前にテーブルを空にする `pm_hotel`
--

TRUNCATE TABLE `pm_hotel`;
--
-- テーブルのデータのダンプ `pm_hotel`
--

INSERT INTO `pm_hotel` (`id`, `lang`, `id_user`, `title`, `subtitle`, `alias`, `address`, `lat`, `lng`, `email`, `phone`, `web`, `descr`, `facilities`, `id_destination`, `home`, `checked`, `rank`, `lid`, `num`, `tui`, `zhe`, `ren`, `jiage`, `sou`, `ont`) VALUES
(1, 2, 1, '新宿民宿', '新宿民宿', 'royal-hotel', '44444', 35.495397, 139.447806, 'contact@pandao.eu', '+30 1 0xxx xxxx', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquet felis massa, sed condimentum ligula feugiat et. Etiam facilisis euismod dignissim. Vivamus facilisis lorem ut purus pellentesque, nec sollicitudin lorem suscipit. Fusce sed enim ultricies, venenatis nunc ut, pharetra nunc. Quisque sollicitudin egestas varius. Nulla aliquet magna sapien, id malesuada felis lobortis id. Vivamus vulputate sed enim sit amet eleifend. Vivamus sit amet felis id urna vulputate maximus. Nullam fringilla sed turpis non volutpat. Cras ultrices diam velit, ac volutpat odio semper at. Sed pulvinar turpis imperdiet sapien hendrerit pulvinar.</p>\r\n', '42,21,8,38,23,37,12,24', 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, NULL),
(2, 2, 1, '东京酒店', '东京酒店副标题', 'chiba', '44444', 35.658593, 139.745441, 'contact@pandao.eu', '+30 1 0xxx xxxx', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquet felis massa, sed condimentum ligula feugiat et. Etiam facilisis euismod dignissim. Vivamus facilisis lorem ut purus pellentesque, nec sollicitudin lorem suscipit. Fusce sed enim ultricies, venenatis nunc ut, pharetra nunc. Quisque sollicitudin egestas varius. Nulla aliquet magna sapien, id malesuada felis lobortis id. Vivamus vulputate sed enim sit amet eleifend. Vivamus sit amet felis id urna vulputate maximus. Nullam fringilla sed turpis non volutpat. Cras ultrices diam velit, ac volutpat odio semper at. Sed pulvinar turpis imperdiet sapien hendrerit pulvinar.</p>\r\n', '1,11,37,32,20', 2, 1, 1, 2, 0, 0, 0, 0, 0, 0, 0, NULL),
(3, 2, 1, '涩谷民宿', '涩谷民宿副标题', 'test8-hotel', '44444', 35.681298, 139.766247, 'contact@pandao.eu', '+30 1 0xxx xxxx', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquet felis massa, sed condimentum ligula feugiat et. Etiam facilisis euismod dignissim. Vivamus facilisis lorem ut purus pellentesque, nec sollicitudin lorem suscipit. Fusce sed enim ultricies, venenatis nunc ut, pharetra nunc. Quisque sollicitudin egestas varius. Nulla aliquet magna sapien, id malesuada felis lobortis id. Vivamus vulputate sed enim sit amet eleifend. Vivamus sit amet felis id urna vulputate maximus. Nullam fringilla sed turpis non volutpat. Cras ultrices diam velit, ac volutpat odio semper at. Sed pulvinar turpis imperdiet sapien hendrerit pulvinar.</p>\r\n', '1,11,37,32,20', 2, 1, 1, 3, 0, 0, 0, 0, 0, 0, 0, NULL),
(4, 2, 1, '樱花酒店', 'サクラホテル池袋', 'sakura-hotal', '〒171-0014 東京都豊島区池袋 2-40-7', 35.733666, 139.708824, 'info@sakura-hotel-ikebukuro.com', '03-3971-2237', 'https://www.sakura-hotel.co.jp/jp', '<p>JR,地铁［池袋］车站步行6分钟，针对各种商业，观光需求提供各种类型的房间</p>\r\n', '32,8,38,26,12,13,29,30,25,28,27,1', 1, 1, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 1, '新白银庄', 'ニュー白銀荘', 'new-hakuginso', '〒076-0034 北海道富良野市北の峰町26-23', 43.343969, 142.366966, 'info@hakuginso.com', '0167-22-2151', 'http://www.hakuginso.com/index.html', '<p>［富良野］被誉为北国的代表，经常出现在电视剧中，一年四季各有风韵，是观光，美食的圣地。</p>\r\n\r\n<p>新白银庄，和农庄协作，提供新鲜的素材各种美食，和非常人气的温泉，静候光临体验。</p>\r\n', '38,26,12,13,40,30,25,28,27', 1, 1, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 2, 1, '重助旅馆', '重助', 'jyusuke', '〒251-0036 神奈川県藤沢市江の島1-5-6', 35.30097, 139.481767, '无', '0466-23-1932', 'http://jyusuke.com/index.html', '<p>全馆房间为和式房间，馆内温泉富含各种矿物质，可充分缓解各种疲劳。卡拉OK设备完备，可承接各种宴会，家族旅行。</p>\r\n\r\n<p>以提供各种生鲜海鲜料理为主要特色</p>\r\n', '32,8,38,37,13,40,30,25,28,18,1', 1, 1, 1, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 2, 1, '麓庵滝泽旅店', '麓庵　たきざわ', 'takizawa', '〒506-1422　岐阜県高山市奥飛騨温泉郷新穂高温泉中尾261', 36.263104, 137.570468, '无', '0578-89-2705', 'http://www.okuhida.com/index.html', '<p>飞弹高原的原住民旧址改装而成的民宿。和父亲苍老的面庞一样有着岁月感的民宿。装修设计堪比酒店，即使是民宿也能让最重要的人感觉到郑重。</p>\r\n\r\n<p>飞弹高原的原住民旧址，注入了飞弹高原匠人的精力，焕发着新生命的民宿。</p>\r\n', '32,38,37,12,13,40,25,28,27,1', 1, 1, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 2, 1, '四季旅馆 尾之间', '尾之間', 'sikinoaita', '〒891-4404 屋久島町尾之間６４２－１５', 30.242015, 130.566036, 'yasuakim@f8.dion.ne.jp', '0997-47-3377', 'http://www.h3.dion.ne.jp/~yasuakim/index.html', '<p><strong>让我们为尾之间温泉的登山疲惫，为了自制的酱汤和蔬菜，为了本地产的海鲜做成的佳肴干杯。</strong></p>\r\n\r\n<p><strong>眺望雄壮的山丘，感受民宿的温存，愿您在尾之间旅店度过屋久岛愉悦的时光。</strong></p>\r\n', '32,26,23,37,13,40,25,28,18', 2, 1, 1, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 2, 1, '厚岸旅店', 'あっけし', 'akesi', '〒088-1125 北海道厚岸郡厚岸町白浜３丁目109-1', 43.061693, 144.817763, '', '0153-67-8787', 'http://www.marumin.net', '<p>厚岸旅店坐落于厚岸湖和别寒边牛湿原，便利于水利调查，还设有会议室，可用于集会，会议等。</p>\r\n\r\n<p>还有具有治疗效果的温泉设施。</p>\r\n', '32,38,26,23,37,12,40,25,28,1', NULL, 1, 1, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 2, 1, 'YAGURA', '民宿やぐら', 'yagura', '〒379-1721　群馬県利根郡みなかみ町藤原５９５９', 36.861347, 139.062071, 'yagura@po1.kannet.ne.jp　', '0278-75-2077', 'http://www3.kannet.ne.jp/~yagura/ ', '<p>奥利根清新的空气，甘甜的山泉水，以及充满了大自然的恩赐。Yagura旅店提供各种特价的住宿计划，期待您的莅临。</p>\r\n', '42,32,8,26,37,25,28', 1, 1, 1, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_hotel_file`
--

DROP TABLE IF EXISTS `pm_hotel_file`;
CREATE TABLE IF NOT EXISTS `pm_hotel_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `hotel_file_fkey` (`id_item`,`lang`),
  KEY `hotel_file_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- 挿入前にテーブルを空にする `pm_hotel_file`
--

TRUNCATE TABLE `pm_hotel_file`;
--
-- テーブルのデータのダンプ `pm_hotel_file`
--

INSERT INTO `pm_hotel_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(5, 2, 1, NULL, 1, 1, 'article-art001146-7.jpg', '', 'image'),
(6, 2, 2, NULL, 1, 4, 'portfolio-476x476-4.jpg', '', 'image'),
(7, 2, 3, NULL, 1, 5, 'pict-02.jpg', '', 'image'),
(8, 2, 1, NULL, 1, 6, '11-07.png', '', 'image'),
(9, 2, 4, NULL, 1, 7, 'sakurahotel1.jpg', NULL, 'image'),
(10, 2, 4, NULL, 1, 8, 'sakurahotel2.jpg', NULL, 'image'),
(11, 2, 4, NULL, 1, 9, 'sakurahotel3.jpg', NULL, 'image'),
(13, 2, 5, NULL, 1, 1, 'photo-newhakginso1.jpg', '', 'image'),
(16, 2, 5, NULL, 1, 3, 'photo-newhakginso2.jpg', NULL, 'image'),
(17, 2, 5, NULL, 1, 4, 'photo-newhakginso4.jpg', NULL, 'image'),
(19, 2, 6, NULL, 1, 2, 'jyusuke1.jpg', '', 'image'),
(20, 2, 6, NULL, 1, 3, 'jyusuke2.jpg', '', 'image'),
(21, 2, 6, NULL, 1, 4, 'jyusuke4.jpg', '', 'image'),
(22, 2, 6, NULL, 1, 10, 'jyusuke3.jpg', NULL, 'image'),
(23, 2, 7, NULL, 1, 11, 'takizwa6.jpg', NULL, 'image'),
(24, 2, 7, NULL, 1, 12, 'takizawa2.jpg', NULL, 'image'),
(25, 2, 7, NULL, 1, 13, 'takizawa4.jpg', NULL, 'image'),
(26, 2, 7, NULL, 1, 14, 'takizawa5.jpg', NULL, 'image'),
(27, 2, 7, NULL, 1, 15, 'takizawa1.jpg', NULL, 'image'),
(28, 2, 7, NULL, 1, 16, 'takezawa3.jpg', NULL, 'image'),
(29, 2, 8, NULL, 1, 2, 'sikinoaita-hamayuu3.jpg', '', 'image'),
(30, 2, 8, NULL, 1, 3, 'sikinoaita-ohkofuro2.jpg', '', 'image'),
(31, 2, 8, NULL, 1, 4, 'sikinoaita-youall.jpg', '', 'image'),
(32, 2, 8, NULL, 1, 5, 'sikinoaita-condo2.jpg', '', 'image'),
(33, 2, 8, 1, 1, 6, 'sikinoaita-kote.jpg', '', 'image'),
(34, 2, 8, NULL, 1, 1, 'sikinoaita1.jpg', '', 'image'),
(35, 2, 9, NULL, 1, 2, 'main.jpg', '', 'image'),
(36, 2, 9, NULL, 1, 1, 'entrance-lightbox.jpg', '', 'image'),
(37, 2, 9, NULL, 1, 3, 'conference1.jpg', '', 'image'),
(38, 2, 10, NULL, 1, 2, 'gaikan-a.jpg', '', 'image'),
(39, 2, 10, NULL, 1, 3, 'gaikan1.jpg', '', 'image'),
(40, 2, 10, NULL, 1, 1, 'house1.jpg', '', 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_hotel_pl`
--

DROP TABLE IF EXISTS `pm_hotel_pl`;
CREATE TABLE IF NOT EXISTS `pm_hotel_pl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` float(11,2) DEFAULT '0.00',
  `text` longtext,
  `uid` int(11) DEFAULT '0',
  `userip` longtext,
  `dtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 挿入前にテーブルを空にする `pm_hotel_pl`
--

TRUNCATE TABLE `pm_hotel_pl`;
--
-- テーブルのデータのダンプ `pm_hotel_pl`
--

INSERT INTO `pm_hotel_pl` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `text`, `uid`, `userip`, `dtime`) VALUES
(1, 2, 8, 0, 1, 5.00, '特别好的民宿', 5, '106.133.98.62', '2017-01-24 13:22:55'),
(2, 2, 8, 0, 1, 5.00, '我很喜欢', 5, '106.133.98.62', '2017-01-24 13:23:05'),
(3, 2, 8, 0, 1, 4.00, '你不喜欢', 5, '106.133.98.62', '2017-01-24 13:23:16'),
(4, 2, 8, 0, 1, 5.00, '天哪', 5, '106.133.98.62', '2017-01-24 13:23:25'),
(5, 2, 8, 0, 1, 5.00, '人気のeddy-kitの後継ガラス表札lris(イリス）が誕生しました。ガラス本体にはeddyシリーズとの着せ替えとしても併用できる強化ステンドグラスの型板ガラスを採用しました。ガラスの裏面が細かく風に吹かれた水面の様に波打ち光が透過するとその色と陰がステンレス台座に美しく映し出されます。\r\n', 5, '106.133.98.62', '2017-01-24 13:23:44'),
(6, 2, 1, 0, 1, 5.00, '测试', 5, '106.133.89.137', '2017-01-24 23:56:52'),
(7, 2, 7, 0, 1, 4.00, '评价杠杠的', 5, '106.181.80.33', '2017-01-25 03:35:00'),
(8, 2, 9, 0, 1, 4.00, ' 不一样的风景！不一样的感受！', 8, '126.218.138.71', '2017-01-29 22:31:52'),
(9, 2, 9, 0, 1, 5.00, '不错不错', 8, '126.218.138.71', '2017-01-29 22:32:31'),
(10, 2, 9, 0, 1, 4.00, '测试', 5, '218.221.108.190', '2017-01-31 08:20:34'),
(11, 2, 6, 0, 1, 4.00, '天才', 5, '218.221.108.190', '2017-01-31 08:21:21'),
(12, 2, 11, 0, 1, 4.00, '把', 5, '103.5.140.134', '2017-01-31 09:13:55'),
(13, 2, 7, 0, 1, 5.00, '终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！终于还是要上班了！', 8, '126.218.138.71', '2017-01-31 21:51:10'),
(14, 2, 6, 0, 1, 5.00, '鱼很好吃', 8, '126.152.209.143', '2017-02-04 08:46:35'),
(15, 2, 6, 0, 1, 3.00, '环境很不错', 8, '126.152.209.143', '2017-02-04 08:46:59'),
(16, 2, 2, 0, 1, 4.00, '东京塔好酷！', 8, '126.152.209.143', '2017-02-04 08:47:38');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_lang`
--

DROP TABLE IF EXISTS `pm_lang`;
CREATE TABLE IF NOT EXISTS `pm_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL,
  `locale` varchar(20) DEFAULT NULL,
  `main` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `tag` varchar(20) DEFAULT NULL,
  `rtl` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 挿入前にテーブルを空にする `pm_lang`
--

TRUNCATE TABLE `pm_lang`;
--
-- テーブルのデータのダンプ `pm_lang`
--

INSERT INTO `pm_lang` (`id`, `title`, `locale`, `main`, `checked`, `rank`, `tag`, `rtl`) VALUES
(2, 'English', 'en_GB', 1, 1, 1, 'en', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_lang_file`
--

DROP TABLE IF EXISTS `pm_lang_file`;
CREATE TABLE IF NOT EXISTS `pm_lang_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lang_file_fkey` (`id_item`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 挿入前にテーブルを空にする `pm_lang_file`
--

TRUNCATE TABLE `pm_lang_file`;
--
-- テーブルのデータのダンプ `pm_lang_file`
--

INSERT INTO `pm_lang_file` (`id`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(2, 2, 0, 1, 1, 'gb.png', '', 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_level`
--

DROP TABLE IF EXISTS `pm_level`;
CREATE TABLE IF NOT EXISTS `pm_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `value` varchar(250) DEFAULT NULL,
  `level` varchar(250) DEFAULT NULL,
  `pages` varchar(250) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `level_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 挿入前にテーブルを空にする `pm_level`
--

TRUNCATE TABLE `pm_level`;
--
-- テーブルのデータのダンプ `pm_level`
--

INSERT INTO `pm_level` (`id`, `lang`, `value`, `level`, `pages`, `checked`, `rank`) VALUES
(1, 2, '1', '低', NULL, 1, 0),
(2, 2, '2', '普通', NULL, 1, 0),
(3, 2, '3', '高', NULL, 1, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_location`
--

DROP TABLE IF EXISTS `pm_location`;
CREATE TABLE IF NOT EXISTS `pm_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  `pages` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 挿入前にテーブルを空にする `pm_location`
--

TRUNCATE TABLE `pm_location`;
--
-- テーブルのデータのダンプ `pm_location`
--

INSERT INTO `pm_location` (`id`, `name`, `address`, `lat`, `lng`, `checked`, `pages`) VALUES
(1, 'Panda Multi Resorts', 'Maldives Mint, Neeloafaru Magu 20014, Maldives', 4.174411, 73.517851, 1, '2');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_media`
--

DROP TABLE IF EXISTS `pm_media`;
CREATE TABLE IF NOT EXISTS `pm_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 挿入前にテーブルを空にする `pm_media`
--

TRUNCATE TABLE `pm_media`;
--
-- テーブルのデータのダンプ `pm_media`
--

INSERT INTO `pm_media` (`id`) VALUES
(4),
(5);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_media_file`
--

DROP TABLE IF EXISTS `pm_media_file`;
CREATE TABLE IF NOT EXISTS `pm_media_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_file_fkey` (`id_item`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 挿入前にテーブルを空にする `pm_media_file`
--

TRUNCATE TABLE `pm_media_file`;
--
-- テーブルのデータのダンプ `pm_media_file`
--

INSERT INTO `pm_media_file` (`id`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(3, 4, NULL, 1, 2, 'main-visual02-meitu-1.jpg', NULL, 'image'),
(4, 5, NULL, 1, 1, '20090112201856197.jpg', NULL, 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_message`
--

DROP TABLE IF EXISTS `pm_message`;
CREATE TABLE IF NOT EXISTS `pm_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` longtext,
  `phone` varchar(100) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `msg` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 挿入前にテーブルを空にする `pm_message`
--

TRUNCATE TABLE `pm_message`;
-- --------------------------------------------------------

--
-- テーブルの構造 `pm_notice`
--

DROP TABLE IF EXISTS `pm_notice`;
CREATE TABLE IF NOT EXISTS `pm_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `alias` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `category` int(1) DEFAULT '1',
  `level` int(1) DEFAULT '1',
  `authority` int(1) DEFAULT '0',
  `expiration_date` int(11) DEFAULT NULL,
  `id_page` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `publish_date` int(11) DEFAULT NULL,
  `unpublish_date` int(11) DEFAULT NULL,
  `comment` int(11) DEFAULT '0',
  `rating` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `notice_lang_fkey` (`lang`),
  KEY `notice_page_fkey` (`id_page`,`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 挿入前にテーブルを空にする `pm_notice`
--

TRUNCATE TABLE `pm_notice`;
--
-- テーブルのデータのダンプ `pm_notice`
--

INSERT INTO `pm_notice` (`id`, `lang`, `title`, `alias`, `text`, `category`, `level`, `authority`, `expiration_date`, `id_page`, `id_user`, `home`, `checked`, `rank`, `add_date`, `edit_date`, `publish_date`, `unpublish_date`, `comment`, `rating`) VALUES
(7, 2, '测试公告1', 7, '<p>测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试<a href="http://52.199.131.204/mxjapan/medias/media/big/3/main-visual02-meitu-1.jpg" title=""><img alt="" src="http://52.199.131.204/mxjapan/medias/media/big/3/main-visual02-meitu-1.jpg" /> </a>公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。测试公告1的内容，会很长。</p>\r\n', 1, 2, 2, 1483142400, NULL, 1, NULL, 1, NULL, 1480862305, 1481167959, 1480862220, 1483401600, NULL, NULL),
(8, 2, '测试公告2', 8, '<p>测试公告2，不那么长了</p>\r\n', 2, 3, 2, 1482328800, NULL, 1, NULL, 1, NULL, 1480862559, 1480862630, 1480862460, 1568674800, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_notice_file`
--

DROP TABLE IF EXISTS `pm_notice_file`;
CREATE TABLE IF NOT EXISTS `pm_notice_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `notice_file_fkey` (`id_item`,`lang`),
  KEY `notice_file_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 挿入前にテーブルを空にする `pm_notice_file`
--

TRUNCATE TABLE `pm_notice_file`;
--
-- テーブルのデータのダンプ `pm_notice_file`
--

INSERT INTO `pm_notice_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(1, 2, 7, NULL, 1, 1, 'img-5385.jpg', '', 'image'),
(2, 2, 7, NULL, 1, 2, 'img-5386.jpg', '', 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_page`
--

DROP TABLE IF EXISTS `pm_page`;
CREATE TABLE IF NOT EXISTS `pm_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `title_tag` varchar(250) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `descr` longtext,
  `robots` varchar(20) DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `intro` longtext,
  `text` longtext,
  `text2` longtext,
  `id_parent` int(11) DEFAULT NULL,
  `page_model` varchar(50) DEFAULT NULL,
  `article_model` varchar(50) DEFAULT NULL,
  `main` int(11) DEFAULT '1',
  `footer` int(11) DEFAULT '0',
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `comment` int(11) DEFAULT '0',
  `rating` int(11) DEFAULT '0',
  `system` int(11) DEFAULT '0',
  `url` longtext,
  PRIMARY KEY (`id`,`lang`),
  KEY `page_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- 挿入前にテーブルを空にする `pm_page`
--

TRUNCATE TABLE `pm_page`;
--
-- テーブルのデータのダンプ `pm_page`
--

INSERT INTO `pm_page` (`id`, `lang`, `name`, `title`, `subtitle`, `title_tag`, `alias`, `descr`, `robots`, `keywords`, `intro`, `text`, `text2`, `id_parent`, `page_model`, `article_model`, `main`, `footer`, `home`, `checked`, `rank`, `add_date`, `edit_date`, `comment`, `rating`, `system`, `url`) VALUES
(1, 2, '首页', '日本旅行総合服務', '美溪传媒车友俱乐部', '美溪传媒车友俱乐部', '', '', 'index,follow', '', '', '<p class="text-muted" style="text-align: center;">美溪传媒車友倶楽部成立于2016年8月1日，是在日本东京投资注册的独立法人公司。<br />\r\n公司专致于提供日本境内旅游业务，为外国游客提供餐饮和娱乐服务，建设集购物、住宿、交通、娱乐为一体的综合平台。<br />\r\n热烈欢迎 来自祖国和世界各地的贵宾!</p>\r\n\r\n<p style="text-align: center;"> </p>\r\n', '', NULL, 'home', '', 1, 0, 1, 1, 1, 1477450356, 1477465170, 0, 0, 0, 'index.html'),
(2, 2, '关于我们', 'Contact', '', 'Contact', 'contact', '', 'index,follow', '', '', '', '', NULL, 'contact', '', 1, 1, 0, 1, 11, 1477450356, 1477450356, 0, 0, 0, 'about.html'),
(3, 2, 'Legal notices', 'Legal notices', '', 'Legal notices', 'legal-notices', '', 'index,follow', '', '', '', '', NULL, 'page', '', 0, 1, 0, 1, 12, 1477450356, 1477450356, 0, 0, 0, NULL),
(4, 2, 'Sitemap', 'Sitemap', '', 'Sitemap', 'sitemap', '', 'index,follow', '', '', '', '', NULL, 'sitemap', '', 0, 1, 0, 1, 13, 1477450356, 1477450356, 0, 0, 0, NULL),
(5, 2, '车导服务', 'About us', '', 'About us', 'about-us', '', 'index,follow', '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla vel est at rhoncus. Cras porttitor ligula vel magna vehicula accumsan. Mauris eget elit et sem commodo interdum. Aenean dolor sem, tincidunt ac neque tempus, hendrerit blandit lacus. Vivamus placerat nulla in mi tristique, fringilla fermentum nisl vehicula. Nullam quis eros non magna tincidunt interdum ac eu eros. Morbi malesuada pulvinar ultrices. Etiam bibendum efficitur risus, sit amet venenatis urna ullamcorper non. Proin fermentum malesuada tortor, vitae mattis sem scelerisque in. Curabitur rutrum leo at mi efficitur suscipit. Vivamus tristique lorem eros, sit amet malesuada augue sodales sed.</p>\r\n', '<p>Etiam bibendum efficitur risus, sit amet venenatis urna ullamcorper non. Proin fermentum malesuada tortor, vitae mattis sem scelerisque in. Curabitur rutrum leo at mi efficitur.</p>\r\n', NULL, 'page', 'article', 1, 0, 0, 1, 2, 1477450356, 1479133981, 0, 0, 0, 'guide.html'),
(6, 2, 'Search', 'Search', '', 'Search', 'search', '', 'noindex,nofollow', '', '', '', '', NULL, 'search', '', 0, 0, 0, 1, 14, 1477450356, 1477450356, 0, 0, 1, NULL),
(7, 2, '旅游图库', 'Gallery', '', 'Gallery', 'gallery', '', 'index,follow', '', '', '', '', NULL, 'page', 'gallery', 1, 0, 0, 1, 5, 1477450356, 1477450356, 0, 0, 0, 'gallery.html'),
(8, 2, '404', '404 Error: Page not found!', '', '404 Not Found', '404', '', 'noindex,nofollow', '', '', '<p>The wanted URL was not found on this server.<br />\r\nThe page you wish to display does not exist, or is temporarily unavailable.</p>\r\n\r\n<p>Thank you for trying the following actions :</p>\r\n\r\n<ul>\r\n	<li>Be sure the URL in the address bar of your browser is correctly spelt and formated.</li>\r\n	<li>If you reached this page by clicking a link or if you think that it is about an error of the server, contact the administrator to alert him.</li>\r\n</ul>\r\n', '', NULL, '404', '', 0, 0, 0, 1, 15, 1477450356, 1477450356, 0, 0, 1, NULL),
(9, 2, '民宿', 'Hotels', '', 'Hotels', 'hotels', '', 'index,follow', '', '', '', '', NULL, 'hotels', 'hotel', 1, 0, 0, 1, 3, 1477450356, 1479134828, 0, 0, 1, 'list2.html'),
(10, 2, '不动产服务', 'Booking', '', 'Booking', 'booking', '', 'noindex,nofollow', '', '', '', '', NULL, 'booking', 'booking', 1, 0, 0, 1, 6, 1477450356, 1477450356, 0, 0, 1, 'realestate.html'),
(11, 2, 'Details', 'Booking details', '', 'Booking details', 'booking-details', '', 'noindex,nofollow', '', '', '', '', 10, 'details', '', 0, 0, 0, 1, 8, 1477450356, 1477450356, 0, 0, 1, NULL),
(12, 2, 'Payment', 'Payment', '', 'Payment', 'payment', '', 'noindex,nofollow', '', '', '', '', 13, 'payment', '', 0, 0, 0, 1, 10, 1477450356, 1477450356, 0, 0, 1, NULL),
(13, 2, 'Summary', 'Booking summary', '', 'Booking summary', 'booking-summary', '', 'noindex,nofollow', '', '', '', '', 11, 'summary', '', 0, 0, 0, 1, 9, 1477450356, 1477450356, 0, 0, 1, NULL),
(14, 2, 'Account', 'Account', '', 'Account', 'account', '', 'noindex,nofollow', '', '', '', '', NULL, 'account', 'account', 0, 0, 0, 1, 16, 1477450356, 1479134842, 0, 0, 1, NULL),
(15, 2, 'Activities', 'Activities', '', 'Activities', 'booking-activities', '', 'noindex,nofollow', '', '', '', '', 10, 'booking-activities', '', 1, 0, 0, 1, 7, 1477450356, 1477450356, 0, 0, 1, NULL),
(16, 2, '医疗', 'Activities', '', 'Activities', 'activities', '', 'noindex,nofollow', '', '', '', '', NULL, 'activities', 'activity', 1, 0, 0, 1, 4, 1477450356, 1477450356, 0, 0, 1, 'medical.html'),
(17, 2, '包车游玩', '包车游玩', '', 'Charters', 'charters', '', 'noindex,nofollow', '', '', '', '', 0, 'charters', '', 1, 0, 0, 1, 11, 1472477070, 1473658466, 0, 0, 1, NULL),
(18, 2, '包车游玩详情', '包车游玩详情', '', 'Charter Details', 'charter', '', 'noindex,nofollow', '', '', '', '', 0, 'charter', 'charter', 0, 0, 0, 1, 11, 1472477070, 1473658466, 0, 0, 1, NULL),
(19, 2, '预定包车', '预定包车', '', 'Charter Booking', 'charter-booking', '', 'noindex,nofollow', '', '', '', '', 0, 'charter-booking', '', 0, 0, 0, 1, 11, 1472477070, 1473658466, 0, 0, 1, NULL),
(20, 2, 'MyPage', 'Info', 'all info will show in this page', 'MyPage_Pandao', 'mypage', '', '', NULL, 'Intro : all info will show in this page', '', '', NULL, 'mypage', 'notice', 0, 0, 0, 1, 17, 1479135680, 1479135680, 0, NULL, NULL, NULL),
(21, 2, 'Notice', 'NoticeTitle', 'all notice will show in this page under MyPage', 'Notice_Pandao', 'notice', '', '', NULL, 'Intro : all notice will show in this page under MyPage', '', '', 20, 'page', 'notice', 0, 0, 0, 1, 18, 1479135858, 1479135858, 0, NULL, NULL, NULL),
(22, 2, '预定包车支付', '预定包车支付', '', 'Charter Payment', 'charter-payment', '', 'noindex,nofollow', '', '', '', '', 0, 'charter-payment', '', 0, 0, 0, 1, 11, 1472477070, 1473658466, 0, 0, 1, NULL),
(23, 2, '预定包车支付完成', '预定包车支付完成', '', 'Charter Payment Complete', 'charter-payment-complete', '', 'noindex,nofollow', '', '', '', '', 0, 'charter-payment-complete', '', 0, 0, 0, 1, 11, 1472477070, 1473658466, 0, 0, 1, NULL),
(24, 2, '包车接送', '包车接送', '', 'Charter pick up', 'pickup', '', 'noindex,nofollow', '', '', '', '', 0, 'charters', '', 1, 0, 0, 1, 11, 1472477070, 1473658466, 0, 0, 1, NULL),
(25, 2, '商城', '商城', '', 'Charter pick up', 'pickup', '', 'noindex,nofollow', '', '', '', '', 0, 'charters', '', 1, 0, 0, 1, 11, 1472477070, 1473658466, 0, 0, 1, 'mall.html');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_page_file`
--

DROP TABLE IF EXISTS `pm_page_file`;
CREATE TABLE IF NOT EXISTS `pm_page_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `page_file_fkey` (`id_item`,`lang`),
  KEY `page_file_lang_fkey` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 挿入前にテーブルを空にする `pm_page_file`
--

TRUNCATE TABLE `pm_page_file`;
-- --------------------------------------------------------

--
-- テーブルの構造 `pm_rate`
--

DROP TABLE IF EXISTS `pm_rate`;
CREATE TABLE IF NOT EXISTS `pm_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_room` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `price` double DEFAULT '0',
  `child_price` double DEFAULT '0',
  `discount` double DEFAULT '0',
  `people` int(11) DEFAULT NULL,
  `price_sup` double DEFAULT NULL,
  `fixed_sup` double DEFAULT NULL,
  `min_stay` int(11) DEFAULT NULL,
  `vat_rate` double DEFAULT NULL,
  `day_start` int(11) DEFAULT NULL,
  `day_end` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rate_room_fkey` (`id_room`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 挿入前にテーブルを空にする `pm_rate`
--

TRUNCATE TABLE `pm_rate`;
-- --------------------------------------------------------

--
-- テーブルの構造 `pm_realestate`
--

DROP TABLE IF EXISTS `pm_realestate`;
CREATE TABLE IF NOT EXISTS `pm_realestate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `age` varchar(250) NOT NULL,
  `dimension` varchar(250) NOT NULL,
  `level` varchar(250) NOT NULL,
  `transportation` varchar(250) NOT NULL,
  `construction` varchar(250) NOT NULL,
  `managementcost` varchar(250) NOT NULL,
  `maintenancecost` varchar(250) NOT NULL,
  `facility` varchar(250) NOT NULL,
  `adress` varchar(250) NOT NULL,
  `text` longtext NOT NULL,
  `id_page` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `publish_date` int(11) DEFAULT NULL,
  `unpublish_date` int(11) DEFAULT NULL,
  `comment` int(11) DEFAULT '0',
  `rating` int(11) DEFAULT '0',
  `num` longtext,
  `jiage` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `realestate_lang_fkey` (`lang`),
  KEY `realestate_page_fkey` (`id_page`,`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 挿入前にテーブルを空にする `pm_realestate`
--

TRUNCATE TABLE `pm_realestate`;
--
-- テーブルのデータのダンプ `pm_realestate`
--

INSERT INTO `pm_realestate` (`id`, `lang`, `title`, `age`, `dimension`, `level`, `transportation`, `construction`, `managementcost`, `maintenancecost`, `facility`, `adress`, `text`, `id_page`, `id_user`, `home`, `checked`, `rank`, `add_date`, `edit_date`, `publish_date`, `unpublish_date`, `comment`, `rating`, `num`, `jiage`) VALUES
(7, 2, 'ＴＨＥ　ＲＯＰＰＯＮＧＩ　ＴＯＫＹＯ　ＣＬＵＢ　ＲＥＳＩＤＥＮＣＥ', '2011年11月 築（平成23年11月）', '96.06㎡(約29.05坪)', '29階／地上39階 地下1階建', '「六本木」駅徒歩３分　／　東京メトロ日比谷線・都営大江戸線利用可', '鉄筋コンクリート造', '39,710円／月', '10,380円／月', 'テレビモニタ付インターホン|納戸有|風呂追い焚き機能付|全居室フローリング|浴室換気乾燥機|ディスポーザー|シューズインクローゼット|ウォークインクローゼット', '東京都 港区 六本木３丁目', '<p>■　ＴＨＥ　ＲＯＰＰＯＮＧＩ　ＴＯＫＹＯ　ＣＬＵＢ　ＲＥＳＩＤＥＮＣＥ　━━━━━━━━━━━━━━━・・・・・<br />\r\n　<br />\r\n　○ 「六本木」駅徒歩３分　／　東京メトロ日比谷線・都営大江戸線利用可<br />\r\n<br />\r\n　○ 三井不動産レジデンシャル（株）他３社旧分譲×大成建設（株）施工<br />\r\n<br />\r\n　○ 平成２３年１１月築、制震構造を採用した３９階建てタワーマンション<br />\r\n<br />\r\n　○ クラブマスター２４時間常駐体制（夜間警備員）<br />\r\n<br />\r\n　○ ホテルライクなサービス（一部有償）　<br />\r\n　　◆バレーパーキングサービス<br />\r\n　　◆ポーターサービス<br />\r\n　　◆ハウスキーピング<br />\r\n　　◆ミニバーサービス<br />\r\n　　◆クリーニング取次　　等々　<br />\r\n<br />\r\n　○ 都心ならではのアクセス<br />\r\n　　◆東京メトロ南北線『六本木一丁目』駅徒歩７分<br />\r\n　　◆東京ミッドタウンまで徒歩４分<br />\r\n　　◆六本木ヒルズまで徒歩６分<br />\r\n<br />\r\n　○ 高耐久コンクリート・高強度鉄筋を使用<br />\r\n<br />\r\n　○ 逆梁工法／ワイドフロンテージ設計<br />\r\n<br />\r\n<br />\r\n■　充実の共用施設（一部有償）　━━━━━━━━━━━━━━━・・・・・<br />\r\n<br />\r\n　敷地内：もとまちユニオン（スーパー）<br />\r\n　　　　　コンビニ<br />\r\n<br />\r\n　各階　：ダストステーション<br />\r\n<br />\r\n　２階　：フィットネスルーム（２４時間利用可能）<br />\r\n　　　　　クリニック（内科・歯科等）<br />\r\n<br />\r\n　３階　：プライベートラウンジ<br />\r\n　　　　　エントランスラウンジ<br />\r\n<br />\r\n　２０階：スカイラウンジ<br />\r\n　　　　　ゲストスイート</p>\r\n', NULL, 2, 0, 1, 1, 1481705616, 1484911905, NULL, NULL, NULL, NULL, '5', 20000);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_realestate_file`
--

DROP TABLE IF EXISTS `pm_realestate_file`;
CREATE TABLE IF NOT EXISTS `pm_realestate_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `realestate_file_fkey` (`id_item`,`lang`),
  KEY `hrealestate_file_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 挿入前にテーブルを空にする `pm_realestate_file`
--

TRUNCATE TABLE `pm_realestate_file`;
--
-- テーブルのデータのダンプ `pm_realestate_file`
--

INSERT INTO `pm_realestate_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(1, 2, 7, NULL, 1, 1, 'lbf16150331-1701121632.jpg', '', 'image'),
(2, 2, 7, NULL, 1, 2, 'bf16150331-1701121632.jpg', '', 'image'),
(3, 2, 7, NULL, 1, 3, 'mbf16150331-1701121632.jpg', '', 'image'),
(4, 2, 7, NULL, 1, 4, 'abf16150331-1701121637.jpg', '', 'image'),
(5, 2, 7, NULL, 1, 5, 'bf16150331-21-1701121632.jpg', '', 'image'),
(6, 2, 7, NULL, 1, 6, 'bf16150331-1701121632.gif', '', 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_room`
--

DROP TABLE IF EXISTS `pm_room`;
CREATE TABLE IF NOT EXISTS `pm_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `max_children` int(11) DEFAULT '1',
  `max_adults` int(11) DEFAULT '1',
  `max_people` int(11) DEFAULT NULL,
  `min_people` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `descr` longtext,
  `facilities` text,
  `stock` int(11) DEFAULT '1',
  `price` double DEFAULT '0',
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `start_lock` int(11) DEFAULT NULL,
  `end_lock` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `room_lang_fkey` (`lang`),
  KEY `room_hotel_fkey` (`id_hotel`,`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 挿入前にテーブルを空にする `pm_room`
--

TRUNCATE TABLE `pm_room`;
--
-- テーブルのデータのダンプ `pm_room`
--

INSERT INTO `pm_room` (`id`, `lang`, `id_hotel`, `id_user`, `max_children`, `max_adults`, `max_people`, `min_people`, `title`, `subtitle`, `alias`, `descr`, `facilities`, `stock`, `price`, `home`, `checked`, `rank`, `start_lock`, `end_lock`) VALUES
(1, 2, 1, 1, 2, 2, 2, 1, '房间设定', 'Breakfast included', 'deluxe-double-bedroom', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut eleifend diam. Etiam molestie quam at nunc tempus, ac porttitor ante rutrum. Donec ipsum orci, molestie sit amet nibh a, accumsan varius nisl. Suspendisse blandit efficitur interdum. Nulla auctor tortor eu volutpat imperdiet. Nam at tempus sapien, sit amet porttitor neque. Nam lacinia ex libero, vel egestas ante vehicula nec.</p>\r\n\r\n<p>Sed sed dignissim est. Donec egestas nisl eu congue rhoncus. Nulla finibus malesuada mauris, et pellentesque diam scelerisque non. Duis auctor dapibus augue sed malesuada. Nam placerat at libero quis aliquam. Phasellus quam orci, dapibus sit amet finibus a, convallis volutpat arcu. Nullam condimentum quam id urna scelerisque varius. Duis a metus metus.</p>\r\n', '32,21,23,24,13,29,17,25,28,27,18,1', 4, 145, 1, 1, 1, NULL, NULL),
(2, 2, 8, 1, 3, 8, 14, 3, '别墅型', '别墅', 'logic', '<p>别墅式住宅，配有卫生间，浴室。可提供团体入住。</p>\r\n', '42,32,38,23,12,40,25,18', NULL, 400, 0, 1, 2, NULL, NULL),
(3, 2, 5, 1, 2, 4, 6, 1, '6畳間1名利用・1泊2食', '和室', 'baiyinzhuang', '<p>晚餐提供火锅，刺身和其他各种料理。</p>\r\n\r\n<p>以火锅为特色，对连续住宿的旅客尽量提供不同的菜谱，也提供早饭。</p>\r\n', '42,32,38,37,12,13,25', NULL, 300, 1, 1, 3, NULL, NULL),
(4, 2, 9, 1, 2, 5, 5, 1, '特別室', '特別室', 'tebieshi', '<p>特色民家风格,采用原木制作。通常木质地板，坐椅的生活风格，本旅社采用地毯风格，让您在轻松的环境中度过假期。</p>\r\n\r\n<p>特别室单独提供浴室和卫生间。</p>\r\n', '32,38,23,37,40,25,28,27,1', NULL, 6000, 0, 1, 4, NULL, NULL),
(5, 2, 9, 1, 2, 4, 4, 1, '一般室', '一般室', 'yibanshi', '<p>特色民家风格,采用原木制作。通常木质地板，坐椅的生活风格，本旅社采用地毯风格，让您在轻松的环境中度过假期。</p>\r\n', '32,38,23,37,40,25,28,27,1', NULL, 4500, 0, 1, 5, NULL, NULL),
(6, 2, 10, 1, 2, 3, 3, 1, '一般室', '一般室', 'biaozhunshi', '<p>租借式温泉和美味的料理，静候您的光临</p>\r\n', '42,32,8,26,37,12,25,28,27', NULL, 5000, 0, 1, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_room_file`
--

DROP TABLE IF EXISTS `pm_room_file`;
CREATE TABLE IF NOT EXISTS `pm_room_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `room_file_fkey` (`id_item`,`lang`),
  KEY `room_file_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 挿入前にテーブルを空にする `pm_room_file`
--

TRUNCATE TABLE `pm_room_file`;
--
-- テーブルのデータのダンプ `pm_room_file`
--

INSERT INTO `pm_room_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(1, 2, 1, 0, 1, 1, 'deluxe-double-room.jpg', '', 'image'),
(2, 2, 2, NULL, 1, 2, 'img-7143.jpg', NULL, 'image'),
(3, 2, 2, NULL, 1, 3, 'img-7144.jpg', NULL, 'image'),
(4, 2, 2, NULL, 1, 4, 'img-7142.jpg', NULL, 'image'),
(5, 2, 2, NULL, 1, 5, 'img-7145.jpg', NULL, 'image'),
(6, 2, 2, NULL, 1, 6, 'img-7146.jpg', NULL, 'image'),
(7, 2, 3, NULL, 1, 7, 'room-08.jpg', NULL, 'image'),
(8, 2, 4, NULL, 1, 8, 'room-image.jpg', '', 'image'),
(9, 2, 4, NULL, 1, 9, 'washroom-thumb.jpg', '', 'image'),
(10, 2, 4, NULL, 1, 10, 'room-toilet-thumb.jpg', '', 'image'),
(11, 2, 5, NULL, 1, 11, 'room-normal.jpg', NULL, 'image'),
(12, 2, 6, NULL, 1, 12, 'y311315058.jpg', NULL, 'image'),
(13, 2, 6, NULL, 1, 13, 'rotena.jpg', NULL, 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_service`
--

DROP TABLE IF EXISTS `pm_service`;
CREATE TABLE IF NOT EXISTS `pm_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `descr` text,
  `long_descr` text,
  `type` varchar(50) DEFAULT NULL,
  `rooms` varchar(250) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `vat_rate` double DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `service_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 挿入前にテーブルを空にする `pm_service`
--

TRUNCATE TABLE `pm_service`;
--
-- テーブルのデータのダンプ `pm_service`
--

INSERT INTO `pm_service` (`id`, `lang`, `id_user`, `title`, `descr`, `long_descr`, `type`, `rooms`, `price`, `vat_rate`, `checked`, `rank`) VALUES
(1, 2, 1, 'Rent of towel (kit)', '1 hand towel, 1 bath towel, 1 bath mat', '', 'qty-night', '4,1,3,2', 7, 10, 1, 1),
(2, 2, 1, 'Housework', '', '', 'package', '1,3,2', 50, 10, 1, 2),
(3, 2, 1, 'Heating', '', '', 'night', '1,3,2', 8, 10, 1, 3),
(4, 2, 1, 'Pet', 'Specify the breed below', '', 'qty-night', '4,1,3,2', 5, 10, 1, 4);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_slide`
--

DROP TABLE IF EXISTS `pm_slide`;
CREATE TABLE IF NOT EXISTS `pm_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `legend` text,
  `url` varchar(250) DEFAULT NULL,
  `id_page` int(11) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `more` longtext,
  PRIMARY KEY (`id`,`lang`),
  KEY `slide_lang_fkey` (`lang`),
  KEY `slide_page_fkey` (`id_page`,`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 挿入前にテーブルを空にする `pm_slide`
--

TRUNCATE TABLE `pm_slide`;
--
-- テーブルのデータのダンプ `pm_slide`
--

INSERT INTO `pm_slide` (`id`, `lang`, `legend`, `url`, `id_page`, `checked`, `rank`, `more`) VALUES
(4, 2, '<h2>无论走到任何地方您都会觉得在家一样。</h2>\r\n', '', 1, 1, 1, NULL),
(5, 2, '<h2>信赖商家，世界名牌，日式服务。</h2>\r\n', '', 1, 1, 2, NULL),
(6, 2, '<h2>租车随时随地，自驾自由自在。</h2>\r\n', '', 1, 1, 3, NULL),
(7, 2, '<h2>无论走到世界任何地方您都会觉得在家一样</h2>\r\n', '', 1, 1, 4, NULL),
(8, 2, '<h2>租车随时随地，自驾自由自在</h2>\r\n', '', 5, 1, 6, NULL),
(9, 2, '<h2>美溪欢迎您</h2>\r\n', '', 1, 0, 5, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_slide_file`
--

DROP TABLE IF EXISTS `pm_slide_file`;
CREATE TABLE IF NOT EXISTS `pm_slide_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`),
  KEY `slide_file_fkey` (`id_item`,`lang`),
  KEY `slide_file_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 挿入前にテーブルを空にする `pm_slide_file`
--

TRUNCATE TABLE `pm_slide_file`;
--
-- テーブルのデータのダンプ `pm_slide_file`
--

INSERT INTO `pm_slide_file` (`id`, `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES
(12, 2, 4, NULL, 1, 8, 'hoshinoya-kyoto-at-night.jpg', '', 'image'),
(13, 2, 5, NULL, 1, 9, 'ginza1920.jpg', '', 'image'),
(14, 2, 6, NULL, 1, 10, 'car1.jpg', '', 'image'),
(15, 2, 7, NULL, 1, 11, 'banner-1920x1080.jpg', '', 'image'),
(25, 2, 8, NULL, 1, 12, 'guide.jpg', '', 'image'),
(26, 2, 9, NULL, 1, 13, '256570731858227584.jpg', '', 'image');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_tag`
--

DROP TABLE IF EXISTS `pm_tag`;
CREATE TABLE IF NOT EXISTS `pm_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `value` varchar(250) DEFAULT NULL,
  `pages` varchar(250) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `tag_lang_fkey` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 挿入前にテーブルを空にする `pm_tag`
--

TRUNCATE TABLE `pm_tag`;
-- --------------------------------------------------------

--
-- テーブルの構造 `pm_text`
--

DROP TABLE IF EXISTS `pm_text`;
CREATE TABLE IF NOT EXISTS `pm_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`,`lang`),
  KEY `text_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=157 ;

--
-- 挿入前にテーブルを空にする `pm_text`
--

TRUNCATE TABLE `pm_text`;
--
-- テーブルのデータのダンプ `pm_text`
--

INSERT INTO `pm_text` (`id`, `lang`, `name`, `value`) VALUES
(1, 2, 'CREATION', 'Creation'),
(2, 2, 'MESSAGE', 'Message'),
(3, 2, 'EMAIL', 'E-mail'),
(4, 2, 'PHONE', 'Phone'),
(5, 2, 'FAX', 'Fax'),
(6, 2, 'COMPANY', 'Company'),
(7, 2, 'COPY_CODE', 'Copy the code'),
(8, 2, 'SUBJECT', 'Subject'),
(9, 2, 'REQUIRED_FIELD', 'Required field'),
(10, 2, 'INVALID_CAPTCHA_CODE', 'Invalid security code'),
(11, 2, 'INVALID_EMAIL', 'Invalid email address'),
(12, 2, 'FIRSTNAME', 'Firstname'),
(13, 2, 'LASTNAME', 'Lastname'),
(14, 2, 'ADDRESS', 'Address'),
(15, 2, 'POSTCODE', 'Post code'),
(16, 2, 'CITY', 'City'),
(17, 2, 'MOBILE', 'Mobile'),
(18, 2, 'ADD', 'Add'),
(19, 2, 'EDIT', 'Edit'),
(20, 2, 'INVALID_INPUT', 'Invalid input'),
(21, 2, 'MAIL_DELIVERY_FAILURE', 'A failure occurred during the delivery of this message.'),
(22, 2, 'MAIL_DELIVERY_SUCCESS', 'Thank you for your interest, your message has been sent.\nWe will contact you as soon as possible.'),
(23, 2, 'SEND', 'Send'),
(24, 2, 'FORM_ERRORS', 'The following form contains some errors.'),
(25, 2, 'FROM_DATE', 'From'),
(26, 2, 'TO_DATE', 'till'),
(27, 2, 'FROM', 'From'),
(28, 2, 'TO', 'to'),
(29, 2, 'BOOK', 'Book'),
(30, 2, 'READMORE', 'Read more'),
(31, 2, 'BACK', 'Back'),
(32, 2, 'DISCOVER', 'Discover'),
(33, 2, 'ALL', 'All'),
(34, 2, 'ALL_RIGHTS_RESERVED', 'All rights reserved'),
(35, 2, 'FORGOTTEN_PASSWORD', 'Forgotten password?'),
(36, 2, 'LOG_IN', 'Log in'),
(37, 2, 'SIGN_UP', 'Sign up'),
(38, 2, 'LOG_OUT', 'Log out'),
(39, 2, 'SEARCH', 'Search'),
(40, 2, 'RESET_PASS_SUCCESS', 'Your new password was sent to you on your e-mail.'),
(41, 2, 'PASS_TOO_SHORT', 'The password must contain 6 characters at least'),
(42, 2, 'PASS_DONT_MATCH', 'The passwords don''t match'),
(43, 2, 'ACCOUNT_EXISTS', 'An account already exists with this e-mail'),
(44, 2, 'ACCOUNT_CREATED', 'Your account has been created. You will receive an email to confirm your account.'),
(45, 2, 'INCORRECT_LOGIN', 'Incorrect login information.'),
(46, 2, 'I_SIGN_UP', 'I sign up'),
(47, 2, 'ALREADY_HAVE_ACCOUNT', 'I already have an account'),
(48, 2, 'MY_ACCOUNT', 'My account'),
(49, 2, 'COMMENTS', 'Comments'),
(50, 2, 'LET_US_KNOW', 'Let us know what you think'),
(51, 2, 'COMMENT_SUCCESS', 'Thank you for your interest, your comment will be checked.'),
(52, 2, 'NO_SEARCH_RESULT', 'No result. Check the spelling terms of search (> 3 characters) or try other words.'),
(53, 2, 'SEARCH_EXCEEDED', 'Number of researches exceeded.'),
(54, 2, 'SECONDS', 'seconds'),
(55, 2, 'FOR_A_TOTAL_OF', 'for a total of'),
(56, 2, 'COMMENT', 'Comment'),
(57, 2, 'VIEW', 'View'),
(58, 2, 'RECENT_ARTICLES', 'Recent articles'),
(59, 2, 'RSS_FEED', 'RSS feed'),
(60, 2, 'COUNTRY', 'Country'),
(61, 2, 'ROOM', 'Room'),
(62, 2, 'INCL_VAT', 'incl. VAT'),
(63, 2, 'NIGHTS', 'night(s)'),
(64, 2, 'ADULTS', 'Adults'),
(65, 2, 'CHILDREN', 'Children'),
(66, 2, 'PERSONS', 'person(s)'),
(67, 2, 'CONTACT_DETAILS', 'Contact details'),
(68, 2, 'NO_AVAILABILITY', 'No availability'),
(69, 2, 'AVAILABILITIES', 'Availabilities'),
(70, 2, 'CHECK', 'Check'),
(71, 2, 'BOOKING_DETAILS', 'Booking details'),
(72, 2, 'SPECIAL_REQUESTS', 'Special requests'),
(73, 2, 'PREVIOUS_STEP', 'Previous step'),
(74, 2, 'CONFIRM_BOOKING', 'Confirm the booking'),
(75, 2, 'ALSO_DISCOVER', 'Also discover'),
(76, 2, 'CHECK_PEOPLE', 'Please verify the number of people for the chosen accommodation'),
(77, 2, 'BOOKING', 'Booking'),
(78, 2, 'NIGHT', 'night'),
(79, 2, 'WEEK', 'week'),
(80, 2, 'EXTRA_SERVICES', 'Extra services'),
(81, 2, 'BOOKING_TERMS', ''),
(82, 2, 'NEXT_STEP', 'Next step'),
(83, 2, 'TOURIST_TAX', 'Tourist tax'),
(84, 2, 'CHECK_IN', 'Check in'),
(85, 2, 'CHECK_OUT', 'Check out'),
(86, 2, 'TOTAL', 'Total'),
(87, 2, 'CAPACITY', 'Capacity'),
(88, 2, 'FACILITIES', 'Facilities'),
(89, 2, 'PRICE', 'Price'),
(90, 2, 'MORE_DETAILS', 'More details'),
(91, 2, 'FROM_PRICE', 'From'),
(92, 2, 'AMOUNT', 'Amount'),
(93, 2, 'PAY', 'Check out'),
(94, 2, 'PAYMENT_PAYPAL_NOTICE', 'Click on "Check Out" below, you will be redirected towards the secure site of PayPal'),
(95, 2, 'PAYMENT_CANCEL_NOTICE', 'The payment has been cancelled.<br>Thank you for your visit and see you soon.'),
(96, 2, 'PAYMENT_SUCCESS_NOTICE', 'Your payment has been successfully processed.<br>Thank you for your visit and see you soon!'),
(97, 2, 'BILLING_ADDRESS', 'Billing address'),
(98, 2, 'DOWN_PAYMENT', 'Down payment'),
(99, 2, 'PAYMENT_CHECK_NOTICE', 'Thank you for sending a check of {amount} to "Panda Multi Resorts, Neeloafaru Magu, Maldives".<br>Your reservation will be confirmed upon receipt of the payment.<br>Thank you for your visit and see you soon!'),
(100, 2, 'PAYMENT_ARRIVAL_NOTICE', 'Thank you for paying the balance of {amount} for your booking on your arrival.<br>Thank you for your visit and see you soon!'),
(101, 2, 'MAX_PEOPLE', 'Max people'),
(102, 2, 'VAT_AMOUNT', 'VAT amount'),
(103, 2, 'MIN_NIGHTS', 'Min nights'),
(104, 2, 'ROOMS', 'Rooms'),
(105, 2, 'RATINGS', 'Rating(s)'),
(106, 2, 'MIN_PEOPLE', 'Min people'),
(107, 2, 'HOTEL', 'Hotel'),
(108, 2, 'MAKE_A_REQUEST', 'Make a request'),
(109, 2, 'FULLNAME', 'Full Name'),
(110, 2, 'PASSWORD', 'Password'),
(111, 2, 'LOG_IN_WITH_FACEBOOK', 'Log in with Facebook'),
(112, 2, 'OR', 'Or'),
(113, 2, 'NEW_PASSWORD', 'New password'),
(114, 2, 'NEW_PASSWORD_NOTICE', 'Please enter your e-mail address corresponding to your account. A new password will be sent to you by e-mail.'),
(115, 2, 'USERNAME', 'Username'),
(116, 2, 'PASSWORD_CONFIRM', 'Confirm password'),
(117, 2, 'USERNAME_EXISTS', 'An account already exists with this username'),
(118, 2, 'ACCOUNT_EDIT_SUCCESS', 'Your account information have been changed.'),
(119, 2, 'ACCOUNT_EDIT_FAILURE', 'An error occured during the modification of the account information.'),
(120, 2, 'ACCOUNT_CREATE_FAILURE', 'Failed to create account.'),
(121, 2, 'PAYMENT_CHECK', 'By check'),
(122, 2, 'PAYMENT_ARRIVAL', 'On arrival'),
(123, 2, 'CHOOSE_PAYMENT', 'Choose a method of payment'),
(124, 2, 'PAYMENT_CREDIT_CARDS', 'Credit cards'),
(125, 2, 'MAX_ADULTS', 'Max adults'),
(126, 2, 'MAX_CHILDREN', 'Max children'),
(127, 2, 'PAYMENT_CARDS_NOTICE', 'Click on "Check Out" below, you will be redirected towards the secure site of 2Checkout.com'),
(128, 2, 'COOKIES_NOTICE', 'Cookies help us provide better user experience. By using our website, you agree to the use of cookies.'),
(129, 2, 'DURATION', 'Duration'),
(130, 2, 'PERSON', 'Person'),
(131, 2, 'CHOOSE_A_DATE', 'Choose a date'),
(132, 2, 'TIMESLOT', 'Time slot'),
(133, 2, 'ACTIVITIES', 'Activities'),
(134, 2, 'DESTINATION', 'Destination'),
(135, 2, 'NO_HOTEL_FOUND', 'No hotel found'),
(136, 2, 'FOR', 'for'),
(137, 2, 'FIND_ACTIVITIES_AND_TOURS', 'Find out our activities and tours'),
(138, 2, 'CHARTER_ACCESS', 'NO ACCESS'),
(139, 2, 'CHARTER_LOGIN', 'NO LOGIN'),
(140, 2, 'CHARTER_NOT_EXIST', '访问的数据不存在'),
(141, 2, 'CHARTER_BOOKING_DETAILS', '预定'),
(142, 2, 'CHARTER_DESTINATION', '目的地：'),
(143, 2, 'CHARTER_PHONE', '车主电话：'),
(144, 2, 'CHARTER_CAR_INFO', '车辆信息：'),
(145, 2, 'CHARTER_SAFE', '保险：'),
(146, 2, 'CHARTER_DETAILS', '包车信息'),
(147, 2, 'CHARTER_DEPART_DATE', '出行日期'),
(148, 2, 'CHARTER_DEPART_NUM', '游玩人数'),
(149, 2, 'CHECK_REQUIRE_MSG', '{0}必须输入'),
(150, 2, 'CHECK_DATE_MSG', '请输入正确的日期'),
(151, 2, 'CHECK_PAYMENT_COMPLETE_MSG', '您的预定已经成功，还没有支付请尽快完成支付'),
(152, 2, 'BOOKING_STAUTS_WAITING', '等待支付'),
(153, 2, 'BOOKING_STAUTS_CANCEL', '取消'),
(154, 2, 'BOOKING_STAUTS_PAYED', '已支付'),
(155, 2, 'BOOKING_STAUTS_COMPLETE', '服务完成'),
(156, 2, 'BOOKING_STAUTS_UPDATE_MSG', '操作成功');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_user`
--

DROP TABLE IF EXISTS `pm_user`;
CREATE TABLE IF NOT EXISTS `pm_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  `fb_id` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `ico` longtext,
  `xname` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 挿入前にテーブルを空にする `pm_user`
--

TRUNCATE TABLE `pm_user`;
--
-- テーブルのデータのダンプ `pm_user`
--

INSERT INTO `pm_user` (`id`, `name`, `email`, `login`, `pass`, `type`, `add_date`, `edit_date`, `checked`, `fb_id`, `address`, `postcode`, `city`, `company`, `country`, `mobile`, `phone`, `token`, `ico`, `xname`) VALUES
(1, 'Administrator', 'test@livetech.co.jp', 'admin', '25d55ad283aa400af464c76d713c07ad', 'administrator', 1477450356, 1477450356, 1, '', '', '', '', '', '', '', '', '', NULL, NULL),
(2, 'test', 'test@test.com', 'test', 'c4ca4238a0b923820dcc509a6f75849b', 'registered', 1479251005, 1481771369, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'manager', 'manager@gg.com', 'mxjapan', '9468bd95ca9e2dcd73a393544b9bef6a', 'manager', 1481771396, 1486006570, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Administrator', '1511755510@qq.com', 'bbbb', 'dc483e80a7a0bd9ef71d8cf973673924', 'administrator', 1480921630, 1480921630, 1, '', '', '', '', '', '', '', '', '', NULL, NULL),
(5, 'yuefuquanf', 'yuefuquan@gmail.com', NULL, '25d55ad283aa400af464c76d713c07ad', NULL, 1484804688, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '090-9898089', '218.221.108.190', '/uploadFiles/tou/148592612558916eed27cd6.jpg', ''),
(6, '姓名', 'test1@test.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, 1485004123, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123456', '123.198.79.248', NULL, NULL),
(7, '22', '123@qq.com', NULL, 'c4ca4238a0b923820dcc509a6f75849b', NULL, 1485241264, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '175.160.207.17', NULL, NULL),
(8, 'TEST-WK', 'Test-wk1@google.com', NULL, '27ceabd1f93a308044a5bf022a93d5bc', NULL, 1485305412, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13612341234', '126.152.165.60', '/uploadFiles/tou/148619607258958d6881583.jpg', '大王'),
(9, 'TESE2', 'test-wk2@google.com', NULL, '48ee06ce17d0289a24cd573acf64a58f', NULL, 1485962583, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13833445200', '126.218.138.71', '/uploadFiles/tou/14859632365891ffe445227.jpg', '二王'),
(10, '三王', 'test-wk-phone1@google.com', NULL, 'b3d0cec097bd4fd033cfeae3445f3405', NULL, 1486336741, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13835506122', '126.254.193.187', '/uploadFiles/tou/14863369515897b3b78342b.jpg', '三王');

-- --------------------------------------------------------

--
-- テーブルの構造 `pm_widget`
--

DROP TABLE IF EXISTS `pm_widget`;
CREATE TABLE IF NOT EXISTS `pm_widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `showtitle` int(11) DEFAULT NULL,
  `pos` varchar(20) DEFAULT NULL,
  `allpages` int(11) DEFAULT NULL,
  `pages` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `content` longtext,
  `class` varchar(200) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `widget_lang_fkey` (`lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 挿入前にテーブルを空にする `pm_widget`
--

TRUNCATE TABLE `pm_widget`;
--
-- テーブルのデータのダンプ `pm_widget`
--

INSERT INTO `pm_widget` (`id`, `lang`, `title`, `showtitle`, `pos`, `allpages`, `pages`, `type`, `content`, `class`, `checked`, `rank`) VALUES
(1, 2, 'About us', 1, 'footer', 1, '', '', '<p>美溪传媒車友倶楽部成立于2016年8月1日，是在日本东京投资注册的独立法人公司。<br />\r\n公司专致于提供日本境内旅游业务，为外国游客提供餐饮和娱乐服务，建设集购物、住宿、交通、娱乐为一体的综合平台。</p>\r\n', '', 1, 1),
(3, 2, 'Latest articles', 1, 'footer', 1, '', 'latest_articles', '', '', 1, 2),
(4, 2, 'Contact us', 0, 'footer', 1, '', 'contact_informations', '', '', 1, 3),
(5, 2, 'Footer form', 0, 'footer', 1, '', 'footer_form', '', 'footer-form mt10', 2, 4);

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `pm_activity`
--
ALTER TABLE `pm_activity`
  ADD CONSTRAINT `activity_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_activity_file`
--
ALTER TABLE `pm_activity_file`
  ADD CONSTRAINT `activity_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_activity` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `activity_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_activity_session`
--
ALTER TABLE `pm_activity_session`
  ADD CONSTRAINT `activity_session_fkey` FOREIGN KEY (`id_activity`) REFERENCES `pm_activity` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_activity_session_hour`
--
ALTER TABLE `pm_activity_session_hour`
  ADD CONSTRAINT `activity_session_hour_fkey` FOREIGN KEY (`id_activity_session`) REFERENCES `pm_activity_session` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_article`
--
ALTER TABLE `pm_article`
  ADD CONSTRAINT `article_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `article_page_fkey` FOREIGN KEY (`id_page`, `lang`) REFERENCES `pm_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_article_file`
--
ALTER TABLE `pm_article_file`
  ADD CONSTRAINT `article_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_article` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `article_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_booking_activity`
--
ALTER TABLE `pm_booking_activity`
  ADD CONSTRAINT `booking_activity_fkey` FOREIGN KEY (`id_booking`) REFERENCES `pm_booking` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_category`
--
ALTER TABLE `pm_category`
  ADD CONSTRAINT `category_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_charter`
--
ALTER TABLE `pm_charter`
  ADD CONSTRAINT `charter_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_charter_city`
--
ALTER TABLE `pm_charter_city`
  ADD CONSTRAINT `charter_city_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_charter_class`
--
ALTER TABLE `pm_charter_class`
  ADD CONSTRAINT `charter_class_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_charter_cost`
--
ALTER TABLE `pm_charter_cost`
  ADD CONSTRAINT `charter_cost_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_charter_file`
--
ALTER TABLE `pm_charter_file`
  ADD CONSTRAINT `charter_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_charter` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `charter_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_charter_guaranteed`
--
ALTER TABLE `pm_charter_guaranteed`
  ADD CONSTRAINT `charter_guaranteed_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_charter_guaranteed_file`
--
ALTER TABLE `pm_charter_guaranteed_file`
  ADD CONSTRAINT `charter_guaranteed_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_charter_guaranteed` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `charter_guaranteed_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_charter_item`
--
ALTER TABLE `pm_charter_item`
  ADD CONSTRAINT `charter_item_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_charter_item_file`
--
ALTER TABLE `pm_charter_item_file`
  ADD CONSTRAINT `charter_item_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_charter_type` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `charter_item_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_charter_type`
--
ALTER TABLE `pm_charter_type`
  ADD CONSTRAINT `charter_type_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_charter_type_file`
--
ALTER TABLE `pm_charter_type_file`
  ADD CONSTRAINT `charter_type_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_charter_type` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `charter_type_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_facility`
--
ALTER TABLE `pm_facility`
  ADD CONSTRAINT `facility_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_facility_file`
--
ALTER TABLE `pm_facility_file`
  ADD CONSTRAINT `facility_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_facility` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `facility_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_gallery`
--
ALTER TABLE `pm_gallery`
  ADD CONSTRAINT `gallery_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `gallery_page_fkey` FOREIGN KEY (`id_page`, `lang`) REFERENCES `pm_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_gallery_file`
--
ALTER TABLE `pm_gallery_file`
  ADD CONSTRAINT `gallery_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_gallery` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `gallery_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_hospital`
--
ALTER TABLE `pm_hospital`
  ADD CONSTRAINT `hospital_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `hospital_page_fkey` FOREIGN KEY (`id_page`, `lang`) REFERENCES `pm_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_hospital_file`
--
ALTER TABLE `pm_hospital_file`
  ADD CONSTRAINT `hospital_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_hospital` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `hospital_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_hotel`
--
ALTER TABLE `pm_hotel`
  ADD CONSTRAINT `hotel_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_hotel_file`
--
ALTER TABLE `pm_hotel_file`
  ADD CONSTRAINT `hotel_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_hotel` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `hotel_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_lang_file`
--
ALTER TABLE `pm_lang_file`
  ADD CONSTRAINT `lang_file_fkey` FOREIGN KEY (`id_item`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_level`
--
ALTER TABLE `pm_level`
  ADD CONSTRAINT `level_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_media_file`
--
ALTER TABLE `pm_media_file`
  ADD CONSTRAINT `media_file_fkey` FOREIGN KEY (`id_item`) REFERENCES `pm_media` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_notice`
--
ALTER TABLE `pm_notice`
  ADD CONSTRAINT `notice_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `notice_page_fkey` FOREIGN KEY (`id_page`, `lang`) REFERENCES `pm_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_notice_file`
--
ALTER TABLE `pm_notice_file`
  ADD CONSTRAINT `notice_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_notice` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `notice_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_page`
--
ALTER TABLE `pm_page`
  ADD CONSTRAINT `page_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_page_file`
--
ALTER TABLE `pm_page_file`
  ADD CONSTRAINT `page_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `page_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_rate`
--
ALTER TABLE `pm_rate`
  ADD CONSTRAINT `rate_room_fkey` FOREIGN KEY (`id_room`) REFERENCES `pm_room` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_realestate`
--
ALTER TABLE `pm_realestate`
  ADD CONSTRAINT `realestate_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `realestate_page_fkey` FOREIGN KEY (`id_page`, `lang`) REFERENCES `pm_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_realestate_file`
--
ALTER TABLE `pm_realestate_file`
  ADD CONSTRAINT `realestate_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_realestate` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `realestate_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_room`
--
ALTER TABLE `pm_room`
  ADD CONSTRAINT `room_hotel_fkey` FOREIGN KEY (`id_hotel`, `lang`) REFERENCES `pm_hotel` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `room_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_room_file`
--
ALTER TABLE `pm_room_file`
  ADD CONSTRAINT `room_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_room` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `room_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_service`
--
ALTER TABLE `pm_service`
  ADD CONSTRAINT `service_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_slide`
--
ALTER TABLE `pm_slide`
  ADD CONSTRAINT `slide_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `slide_page_fkey` FOREIGN KEY (`id_page`, `lang`) REFERENCES `pm_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_slide_file`
--
ALTER TABLE `pm_slide_file`
  ADD CONSTRAINT `slide_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_slide` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `slide_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_tag`
--
ALTER TABLE `pm_tag`
  ADD CONSTRAINT `tag_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_text`
--
ALTER TABLE `pm_text`
  ADD CONSTRAINT `text_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- テーブルの制約 `pm_widget`
--
ALTER TABLE `pm_widget`
  ADD CONSTRAINT `widget_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
