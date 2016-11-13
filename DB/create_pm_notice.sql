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
  `category` int(1) DEFAULT '0',--0(default),1,2...
  `level` int(1) DEFAULT '1',--0(low),1(normal),2(high)
  `authority` int(1) DEFAULT '0',--0(all),1,2,3
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
