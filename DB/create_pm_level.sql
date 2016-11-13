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
