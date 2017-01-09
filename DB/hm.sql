ALTER TABLE `pm_page` ADD url LONGTEXT NULL;
ALTER TABLE `pm_slide` ADD more LONGTEXT NULL;

UPDATE `pm_page` SET `name`='首页',url = '/' WHERE `id`='1' AND (`lang`='2');
UPDATE `pm_page` SET `name`='车导服务',url = 'guide.html' WHERE `id`='5' AND (`lang`='2');
UPDATE `pm_page` SET `name`='民宿',url = 'list_list.html' WHERE `id`='9' AND (`lang`='2');
UPDATE `pm_page` SET `name`='医疗',url = 'medical.html' WHERE `id`='16' AND (`lang`='2');
UPDATE `pm_page` SET `name`='旅游图库',url = 'gallery.html' WHERE `id`='7' AND (`lang`='2');
UPDATE `pm_page` SET `name`='不动产服务',url = 'realestate.html' WHERE `id`='10' AND (`lang`='2');
UPDATE `pm_page` SET `name`='关于我们',url = 'about.html' WHERE `id`='2' AND (`lang`='2');

UPDATE `pm_slide` SET `legend`='无论走到世界任何地方您都会觉得在家一样' WHERE (`id`='1') AND (`lang`='2');
UPDATE `pm_slide` SET `legend`='无论走到世界任何地方您都会觉得在家一样' WHERE (`id`='3') AND (`lang`='2');
UPDATE `pm_slide` SET `legend`='无论走到世界任何地方您都会觉得在家一样' WHERE (`id`='2') AND (`lang`='2');
UPDATE `pm_slide_file` SET `file`='sehun_1.jpg' WHERE (`id`='3') order by id desc limit 1;
UPDATE `pm_slide_file` SET `file`='sehun_1.jpg' WHERE (`id`='4') order by id desc limit 1;
UPDATE `pm_slide_file` SET `file`='sehun_1.jpg' WHERE (`id`='6') order by id desc limit 1;