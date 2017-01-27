ALTER TABLE `pm_page` ADD url LONGTEXT NULL;#中文导航链接
ALTER TABLE `pm_slide` ADD more LONGTEXT NULL; #幻灯片 链接
ALTER TABLE `pm_hospital` ADD num INT(11) DEFAULT 0 NULL; #医疗 推荐
ALTER TABLE `pm_hospital` ADD addres LONGTEXT NULL; #医疗 地址
ALTER TABLE `pm_hospital` ADD phone LONGTEXT NULL; #医疗 电话
ALTER TABLE `pm_hospital` ADD yuan LONGTEXT NULL; #医疗 院长
ALTER TABLE `pm_hospital` ADD mail LONGTEXT NULL; #医疗 邮箱
ALTER TABLE `pm_hotel` ADD lid INT(11) DEFAULT 0 NULL; #民宿 类型
ALTER TABLE `pm_hotel` ADD num INT(11) DEFAULT 0 NULL; #民宿 推荐星星
ALTER TABLE `pm_hotel` ADD tui INT(11) DEFAULT 0 NULL; #民宿 推荐标签
ALTER TABLE `pm_hotel` ADD zhe INT(11) DEFAULT 0 NULL; #民宿 折扣标签
ALTER TABLE `pm_hotel` ADD ren INT(11) DEFAULT 0 NULL; #民宿 人气
ALTER TABLE `pm_hotel` ADD jiage INT(11) DEFAULT 0 NULL; #民宿 价格
ALTER TABLE `pm_hotel` ADD sou INT(11) DEFAULT 0 NULL; #民宿 销量
ALTER TABLE `pm_user` ADD ico LONGTEXT NULL; #用户中心 头像
ALTER TABLE `pm_user` ADD xname LONGTEXT NULL; #用户中心 真实姓名
ALTER TABLE `pm_realestate` ADD num LONGTEXT NULL; #不动产 推荐星星
ALTER TABLE `pm_realestate` ADD jiage INT(11) DEFAULT 0 NULL; #不动产 标价

#导航中文化
UPDATE `pm_page` SET `name`='首页',url = 'index.html' WHERE `id`='1' AND (`lang`='2');
UPDATE `pm_page` SET `name`='车导服务',url = 'guide.html' WHERE `id`='5' AND (`lang`='2');
UPDATE `pm_page` SET `name`='民宿',url = 'list2.html' WHERE `id`='9' AND (`lang`='2');
UPDATE `pm_page` SET `name`='医疗',url = 'medical.html' WHERE `id`='16' AND (`lang`='2');
UPDATE `pm_page` SET `name`='旅游图库',url = 'gallery.html' WHERE `id`='7' AND (`lang`='2');
UPDATE `pm_page` SET `name`='不动产服务',url = 'realestate.html' WHERE `id`='10' AND (`lang`='2');
UPDATE `pm_page` SET `name`='关于我们',url = 'about.html' WHERE `id`='2' AND (`lang`='2');

#幻灯片中文化
UPDATE `pm_slide` SET `legend`='无论走到世界任何地方您都会觉得在家一样' WHERE (`id`='1') AND (`lang`='2');
UPDATE `pm_slide` SET `legend`='无论走到世界任何地方您都会觉得在家一样' WHERE (`id`='3') AND (`lang`='2');
UPDATE `pm_slide` SET `legend`='无论走到世界任何地方您都会觉得在家一样' WHERE (`id`='2') AND (`lang`='2');

#幻灯片图片
INSERT INTO `pm_slide_file` (`lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES ( '1', '1', '0', '1', '4', 'sehun_1.jpg', '', 'image');
INSERT INTO `pm_slide_file` (`lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES ('2', '1', '0', '1', '4', 'sehun_1.jpg', '', 'image');
INSERT INTO `pm_slide_file` ( `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES ('3', '1', '0', '1', '4', 'sehun_1.jpg', '', 'image');
INSERT INTO `pm_slide_file` (`lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES ( '1', '2', '0', '1', '4', 'sehun_1.jpg', '', 'image');
INSERT INTO `pm_slide_file` (`lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES ('2', '2', '0', '1', '4', 'sehun_1.jpg', '', 'image');
INSERT INTO `pm_slide_file` ( `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES ('3', '2', '0', '1', '4', 'sehun_1.jpg', '', 'image');
INSERT INTO `pm_slide_file` (`lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES ( '1', '3', '0', '1', '4', 'sehun_1.jpg', '', 'image');
INSERT INTO `pm_slide_file` (`lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES ('2', '3', '0', '1', '4', 'sehun_1.jpg', '', 'image');
INSERT INTO `pm_slide_file` ( `lang`, `id_item`, `home`, `checked`, `rank`, `file`, `label`, `type`) VALUES ('3', '3', '0', '1', '4', 'sehun_1.jpg', '', 'image');

#后台测试用户
INSERT INTO `pm_user` ( `name`, `email`, `login`, `pass`, `type`, `add_date`, `edit_date`, `checked`, `fb_id`, `address`, `postcode`, `city`, `company`, `country`, `mobile`, `phone`, `token`) VALUES  ( 'Administrator', '1511755510@qq.com', 'bbbb', 'dc483e80a7a0bd9ef71d8cf973673924', 'administrator', '1480921630', '1480921630', '1', '', '', '', '', '', '', '', '', '');

#民宿 类型
CREATE TABLE `pm_destination2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `pm_destination2` (`id`, `name`, `checked`) VALUES ('1', '民宿', '1');

INSERT INTO `pm_destination2` (`id`, `name`, `checked`) VALUES ('2', '酒店', '1');

#评论
CREATE TABLE `pm_hotel_pl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `home` int(11) DEFAULT '0',
  `checked` int(11) DEFAULT '1',
  `rank` FLOAT(11,2) DEFAULT '0',
  `text` LONGTEXT NULL,
  `uid` int(11) DEFAULT '0',
  `userip` LONGTEXT NULL,
  `dtime` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

#购物车
CREATE TABLE `pm_gwc` (
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
  `ont` datetime DEFAULT NULL ,
  `paytime` datetime DEFAULT NULL ,
  `yytime` datetime DEFAULT NULL ,
  `offt` datetime DEFAULT NULL ,
  `adults` varchar(255) DEFAULT NULL,
  `children` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8