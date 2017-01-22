/*Table structure for table `pm_realestate` */
DROP TABLE IF EXISTS `pm_realestate`;
CREATE TABLE `pm_realestate` (
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
  PRIMARY KEY (`id`,`lang`),
  KEY `realestate_lang_fkey` (`lang`),
  KEY `realestate_page_fkey` (`id_page`,`lang`),
  CONSTRAINT `realestate_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `realestate_page_fkey` FOREIGN KEY (`id_page`, `lang`) REFERENCES `pm_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `pm_realestate` */

/*Table structure for table `pm_realestate_file` */

DROP TABLE IF EXISTS `pm_realestate_file`;

CREATE TABLE `pm_realestate_file` (
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
  KEY `hrealestate_file_lang_fkey` (`lang`),
  CONSTRAINT `realestate_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_realestate` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `realestate_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pm_realestate_file` */
