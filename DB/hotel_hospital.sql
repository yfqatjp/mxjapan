/*Table structure for table `pm_hospital` */
DROP TABLE IF EXISTS `pm_hospital`;
CREATE TABLE `pm_hospital` (
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
  PRIMARY KEY (`id`,`lang`),
  KEY `hospital_lang_fkey` (`lang`),
  KEY `hospital_page_fkey` (`id_page`,`lang`),
  CONSTRAINT `hospital_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `hospital_page_fkey` FOREIGN KEY (`id_page`, `lang`) REFERENCES `pm_page` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `pm_hospital` */

/*Table structure for table `pm_hospital_file` */

DROP TABLE IF EXISTS `pm_hospital_file`;

CREATE TABLE `pm_hospital_file` (
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
  KEY `hospital_file_lang_fkey` (`lang`),
  CONSTRAINT `hospital_file_fkey` FOREIGN KEY (`id_item`, `lang`) REFERENCES `pm_hospital` (`id`, `lang`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `hospital_file_lang_fkey` FOREIGN KEY (`lang`) REFERENCES `pm_lang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pm_hospital_file` */
