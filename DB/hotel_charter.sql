/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50621
Source Host           : localhost:3306
Source Database       : hotel

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2016-10-23 21:08:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `pm_charter`
-- ----------------------------
DROP TABLE IF EXISTS `pm_charter`;
CREATE TABLE `pm_charter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charter_type` int(11) NOT NULL DEFAULT '1',
  `lang` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `subtitle` varchar(250) DEFAULT NULL,
  `alias` varchar(100) DEFAULT NULL,
  `destination` varchar(250) DEFAULT NULL COMMENT '目的地',
  `phone` varchar(50) DEFAULT NULL,
  `lat`  double NULL COMMENT '纬度',
  `lng`  double NULL COMMENT '经度',
  `descr` longtext,
  `facilities` varchar(250) DEFAULT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `add_date` int(11) DEFAULT NULL COMMENT '作成时间',
  `edit_date` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_lang_fkey` (`lang`),
  CONSTRAINT `charter_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pm_charter
-- ----------------------------

-- ----------------------------
-- Table structure for `pm_charter_cost`
-- ----------------------------
DROP TABLE IF EXISTS `pm_charter_cost`;
CREATE TABLE `pm_charter_cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_cost_fkey` (`lang`),
  CONSTRAINT `charter_cost_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pm_charter_cost
-- ----------------------------
INSERT INTO `pm_charter_cost` VALUES ('1', '2', 'WIFI', '1');
INSERT INTO `pm_charter_cost` VALUES ('2', '2', '小费', '2');
INSERT INTO `pm_charter_cost` VALUES ('3', '2', '停车费', '3');
INSERT INTO `pm_charter_cost` VALUES ('4', '2', '燃油费', '4');
INSERT INTO `pm_charter_cost` VALUES ('5', '2', '门票', '5');
INSERT INTO `pm_charter_cost` VALUES ('6', '2', '过路费', '6');
INSERT INTO `pm_charter_cost` VALUES ('7', '2', '伙食费', '7');
INSERT INTO `pm_charter_cost` VALUES ('8', '2', '雨伞', '8');
INSERT INTO `pm_charter_cost` VALUES ('9', '2', '举牌迎接', '9');

-- ----------------------------
-- Table structure for `pm_charter_file`
-- ----------------------------
DROP TABLE IF EXISTS `pm_charter_file`;
CREATE TABLE `pm_charter_file` (
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
  KEY `charter_file_lang_fkey` (`lang`),
  CONSTRAINT `charter_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_charter` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `charter_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pm_charter_file
-- ----------------------------

-- ----------------------------
-- Table structure for `pm_charter_info`
-- ----------------------------
DROP TABLE IF EXISTS `pm_charter_info`;
CREATE TABLE `pm_charter_info` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pm_charter_info
-- ----------------------------

-- ----------------------------
-- Table structure for `pm_charter_item`
-- ----------------------------
DROP TABLE IF EXISTS `pm_charter_item`;
CREATE TABLE `pm_charter_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL COMMENT '项目名称',
  `rank` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_item_lang_fkey` (`lang`),
  CONSTRAINT `charter_item_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pm_charter_item
-- ----------------------------
INSERT INTO `pm_charter_item` VALUES ('1', '2', '服务明细', '0', '1');
INSERT INTO `pm_charter_item` VALUES ('2', '2', '费用设置', '0', '1');
INSERT INTO `pm_charter_item` VALUES ('3', '2', '注意事项', '0', '1');

-- ----------------------------
-- Table structure for `pm_charter_item_file`
-- ----------------------------
DROP TABLE IF EXISTS `pm_charter_item_file`;
CREATE TABLE `pm_charter_item_file` (
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
  KEY `charter_item_file_lang_fkey` (`lang`),
  CONSTRAINT `charter_item_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_charter_type` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `charter_item_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pm_charter_item_file
-- ----------------------------

-- ----------------------------
-- Table structure for `pm_charter_line`
-- ----------------------------
DROP TABLE IF EXISTS `pm_charter_line`;
CREATE TABLE `pm_charter_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_charter` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `line_name` varchar(250) DEFAULT NULL COMMENT '行程名称',
  `arrive_time` varchar(250) DEFAULT NULL COMMENT '到达时间',
  `line_detail` longtext COMMENT '景点/餐饮/交通',
  `hotel` longtext COMMENT '酒店',
  `note` longtext COMMENT '注意事项',
  `self_comment` longtext COMMENT '个人评价',
  `add_date` int(11) DEFAULT NULL COMMENT '作成时间',
  `edit_date` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pm_charter_line
-- ----------------------------

-- ----------------------------
-- Table structure for `pm_charter_line_file`
-- ----------------------------
DROP TABLE IF EXISTS `pm_charter_line_file`;
CREATE TABLE `pm_charter_line_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` int(11) DEFAULT '0',
  `file` varchar(250) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pm_charter_line_file
-- ----------------------------

-- ----------------------------
-- Table structure for `pm_charter_type`
-- ----------------------------
DROP TABLE IF EXISTS `pm_charter_type`;
CREATE TABLE `pm_charter_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL COMMENT '名称',
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `charter_type_lang_fkey` (`lang`),
  CONSTRAINT `charter_type_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pm_charter_type
-- ----------------------------
INSERT INTO `pm_charter_type` VALUES ('1', '2', '包车接送', '0');
INSERT INTO `pm_charter_type` VALUES ('2', '2', '包车游玩', '0');

-- ----------------------------
-- Table structure for `pm_charter_type_file`
-- ----------------------------
DROP TABLE IF EXISTS `pm_charter_type_file`;
CREATE TABLE `pm_charter_type_file` (
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
  KEY `charter_type_file_lang_fkey` (`lang`),
  CONSTRAINT `charter_type_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_charter_type` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `charter_type_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


-- ----------------------------
-- 包车游玩
INSERT INTO `pm_page` VALUES ('17', '2', '包车游玩', '包车游玩', '', 'Charters', 'charters', '', 'noindex,nofollow', '', '', '', '', '0', 'charters', '', '1', '0', '0', '1', '11', '1472477070', '1473658466', '0', '0', '1');

-- 包车游玩详细画面
INSERT INTO `pm_page` VALUES ('18', '2', '包车游玩详情', '包车游玩详情', '', 'Charter Details', 'charter', '', 'noindex,nofollow', '', '', '', '', '0', 'charter', 'charter', '0', '0', '0', '1', '11', '1472477070', '1473658466', '0', '0', '1');

-- 预定包车
INSERT INTO `pm_page` VALUES ('19', '2', '预定包车', '预定包车', '', 'Charter Booking', 'charter-booking', '', 'noindex,nofollow', '', '', '', '', '0', 'charter-booking', '', '0', '0', '0', '1', '11', '1472477070', '1473658466', '0', '0', '1');

-- 2016/11/20 追加  Start
CREATE TABLE `pm_charter_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_code` varchar(64) NOT NULL,
  `charter_id` int(11) NOT NULL,
  `charter_type` int(11) DEFAULT '1',
  `lang` int(11) DEFAULT NULL,
  `charter_owner` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `alias` varchar(250) DEFAULT NULL,
  `car_brand` varchar(250) DEFAULT NULL,
  `car_model` varchar(250) DEFAULT NULL,
  `car_no` varchar(250) DEFAULT NULL,
  `safe` varchar(250) DEFAULT NULL,
  `add_date` int(11) DEFAULT NULL,
  `edit_date` int(11) DEFAULT NULL,
  `depart_date` int(11) DEFAULT NULL,
  `depart_num` int(11) DEFAULT '1',
  `price` float DEFAULT NULL,
  `tourist_tax` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `booking_user_id` int(11) DEFAULT NULL,
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
  `payment_date` int(11) DEFAULT NULL,
  `payment_method` varchar(250) DEFAULT NULL,
  `payment_total` float DEFAULT NULL,
  `session_data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- 预定包车
INSERT INTO `pm_page` VALUES ('22', '2', '预定包车支付', '预定包车支付', '', 'Charter Payment', 'charter-payment', '', 'noindex,nofollow', '', '', '', '', '0', 'charter-payment', '', '0', '0', '0', '1', '11', '1472477070', '1473658466', '0', '0', '1');

-- 预定包车
INSERT INTO `pm_page` VALUES ('23', '2', '预定包车支付完成', '预定包车支付完成', '', 'Charter Payment Complete', 'charter-payment-complete', '', 'noindex,nofollow', '', '', '', '', '0', 'charter-payment-complete', '', '0', '0', '0', '1', '11', '1472477070', '1473658466', '0', '0', '1');

-------------------------------------------------------------------------------------------
INSERT INTO `pm_text` VALUES ('138', '2', 'CHARTER_ACCESS', 'NO ACCESS');
INSERT INTO `pm_text` VALUES ('139', '2', 'CHARTER_LOGIN', 'NO LOGIN');
INSERT INTO `pm_text` VALUES ('140', '2', 'CHARTER_NOT_EXIST', '访问的数据不存在');
INSERT INTO `pm_text` VALUES ('141', '2', 'CHARTER_BOOKING_DETAILS', '预定');
INSERT INTO `pm_text` VALUES ('142', '2', 'CHARTER_DESTINATION', '目的地：');
INSERT INTO `pm_text` VALUES ('143', '2', 'CHARTER_PHONE', '车主电话：');
INSERT INTO `pm_text` VALUES ('144', '2', 'CHARTER_CAR_INFO', '车辆信息：');
INSERT INTO `pm_text` VALUES ('145', '2', 'CHARTER_SAFE', '保险：');
INSERT INTO `pm_text` VALUES ('146', '2', 'CHARTER_DETAILS', '包车信息');

INSERT INTO `pm_text` VALUES ('147', '2', 'CHARTER_DEPART_DATE', '出行日期');
INSERT INTO `pm_text` VALUES ('148', '2', 'CHARTER_DEPART_NUM', '游玩人数');
INSERT INTO `pm_text` VALUES ('149', '2', 'CHECK_REQUIRE_MSG', '{0}必须输入');
INSERT INTO `pm_text` VALUES ('150', '2', 'CHECK_DATE_MSG', '请输入正确的日期');
INSERT INTO `pm_text` VALUES ('151', '2', 'CHECK_PAYMENT_COMPLETE_MSG', '您的预定已经成功，还没有支付请尽快完成支付');
-- 2016/11/20 追加  End
