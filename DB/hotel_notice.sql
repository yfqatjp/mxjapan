/*Table structure for table `pm_level` */

DROP TABLE IF EXISTS `pm_level`;

CREATE TABLE `pm_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `value` varchar(250) DEFAULT NULL,
  `level` varchar(250) DEFAULT NULL,
  `pages` varchar(250) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `level_lang_fkey` (`lang`),
  CONSTRAINT `level_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pm_level` */

insert  into `pm_level`(`id`,`lang`,`value`,`level`) values (1,2,'1','低'),(2,2,'2','普通'),(3,2,'3','高');

/*Table structure for table `pm_category` */

DROP TABLE IF EXISTS `pm_category`;

CREATE TABLE `pm_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `value` varchar(250) DEFAULT NULL,
  `category` varchar(250) DEFAULT NULL,
  `pages` varchar(250) DEFAULT NULL,
  `checked` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  PRIMARY KEY (`id`,`lang`),
  KEY `category_lang_fkey` (`lang`),
  CONSTRAINT `category_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pm_category` */

insert  into `pm_category`(`id`,`lang`,`value`,`category`) values (1,2,'1','通知'),(2,2,'2','提醒'),(3,2,'3','优惠');

/*Table structure for table `pm_notice` */
DROP TABLE IF EXISTS `pm_notice`;
CREATE TABLE `pm_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
--  `subtitle` varchar(250) DEFAULT NULL,
  `alias` int(11) NOT NULL,
  `text` longtext NOT NULL,
--  `url` varchar(250) DEFAULT NULL,
--  `tags` varchar(250) DEFAULT NULL,
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
  KEY `notice_page_fkey` (`id_page`,`lang`),
  CONSTRAINT `notice_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `notice_page_fkey` FOREIGN KEY (`id_page`, `lang`) REFERENCES `pm_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `pm_notice` */

/*Table structure for table `pm_notice_file` */

DROP TABLE IF EXISTS `pm_notice_file`;

CREATE TABLE `pm_notice_file` (
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
  KEY `notice_file_lang_fkey` (`lang`),
  CONSTRAINT `notice_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_notice` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `notice_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pm_notice_file` */
