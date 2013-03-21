# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.27)
# Database: bangladivsor
# Generation Time: 2013-03-18 21:48:11 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table advisor_factory_review
# ------------------------------------------------------------

DROP TABLE IF EXISTS `advisor_factory_review`;

CREATE TABLE `advisor_factory_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `factory_id` int(11) DEFAULT NULL,
  `reference_code` varchar(100) DEFAULT NULL,
  `num_reviews` int(11) DEFAULT NULL,
  `average_value` float DEFAULT NULL,
  `detil_rating` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `advisor_factory_review` WRITE;
/*!40000 ALTER TABLE `advisor_factory_review` DISABLE KEYS */;

INSERT INTO `advisor_factory_review` (`id`, `factory_id`, `reference_code`, `num_reviews`, `average_value`, `detil_rating`)
VALUES
	(1,3,'eccbc87e4b5ce2fe28308fd9f2a7baf3',3,3,'{\"3\":3}'),
	(12,10,'d3d9446802a44259755d38e6d163e820',6,3,'{\"5\":4,\"\":2}'),
	(14,7,'8f14e45fceea167a5a36dedd4bea2543',0,0,'[]'),
	(15,25,'8e296a067a37563370ded05f5a3bf3ec',4,3,'{\"4\":2,\"3\":2,\"\":1}'),
	(17,34,'e369853df766fa44e1ed0ff613f563bd',0,0,'[]');

/*!40000 ALTER TABLE `advisor_factory_review` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table advisor_factory_subrating
# ------------------------------------------------------------

DROP TABLE IF EXISTS `advisor_factory_subrating`;

CREATE TABLE `advisor_factory_subrating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_code` varchar(100) DEFAULT NULL,
  `sub_rating_id` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `num_review` int(11) DEFAULT NULL,
  `average` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table advisor_rating
# ------------------------------------------------------------

DROP TABLE IF EXISTS `advisor_rating`;

CREATE TABLE `advisor_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `advisor_rating` WRITE;
/*!40000 ALTER TABLE `advisor_rating` DISABLE KEYS */;

INSERT INTO `advisor_rating` (`id`, `title`)
VALUES
	(1,'Communication'),
	(2,'Sampling'),
	(3,'Follow up of the orders'),
	(4,'Quality of goods'),
	(5,'Delivery'),
	(6,'Documentation');

/*!40000 ALTER TABLE `advisor_rating` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table advisor_review_photo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `advisor_review_photo`;

CREATE TABLE `advisor_review_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) DEFAULT NULL,
  `reference_code` varchar(100) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `advisor_review_photo` WRITE;
/*!40000 ALTER TABLE `advisor_review_photo` DISABLE KEYS */;

INSERT INTO `advisor_review_photo` (`id`, `review_id`, `reference_code`, `filename`, `caption`)
VALUES
	(28,51,'8e296a067a37563370ded05f5a3bf3ec','Boston-Nevado-(Prudential-B.jpg','asdsd'),
	(40,70,'d3d9446802a44259755d38e6d163e820','divelocwhiteisland3-thumb-sml.jpg','asd'),
	(41,71,'d3d9446802a44259755d38e6d163e820','divelocwhiteisland3-thumb-sml.jpg','asd'),
	(42,71,'d3d9446802a44259755d38e6d163e820','divelocgoatisland1.jpg','asd'),
	(43,72,'8e296a067a37563370ded05f5a3bf3ec','diveloccoromandel2.jpg','asd'),
	(44,72,'8e296a067a37563370ded05f5a3bf3ec','divelocgoatisland2.jpg','ds');

/*!40000 ALTER TABLE `advisor_review_photo` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table advisor_reviewrating
# ------------------------------------------------------------

DROP TABLE IF EXISTS `advisor_reviewrating`;

CREATE TABLE `advisor_reviewrating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) DEFAULT NULL,
  `rating_id` int(11) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `advisor_reviewrating` WRITE;
/*!40000 ALTER TABLE `advisor_reviewrating` DISABLE KEYS */;

INSERT INTO `advisor_reviewrating` (`id`, `review_id`, `rating_id`, `value`)
VALUES
	(22,15,1,'4'),
	(23,15,5,'3'),
	(24,16,1,'4'),
	(25,16,5,'3'),
	(43,30,1,'4'),
	(44,30,2,'4'),
	(45,30,3,'4'),
	(46,30,4,'2'),
	(47,30,5,'3'),
	(48,30,6,'3'),
	(49,31,1,'3'),
	(50,31,2,'5'),
	(51,31,3,'3'),
	(52,31,4,'4'),
	(53,31,5,'2'),
	(54,31,6,'3'),
	(55,32,1,'3'),
	(56,32,2,'5'),
	(57,32,3,'3'),
	(58,32,4,'4'),
	(59,32,5,'2'),
	(60,32,6,'3'),
	(97,43,2,'3'),
	(98,44,2,'3'),
	(99,45,2,'3'),
	(100,46,2,'3'),
	(120,51,1,'2'),
	(121,51,2,'3'),
	(122,51,3,'3'),
	(123,51,4,'5'),
	(124,51,5,'3'),
	(125,51,6,'3'),
	(209,71,1,'2'),
	(210,71,2,'4'),
	(211,71,3,'3'),
	(212,71,4,'4'),
	(213,71,5,'3'),
	(214,71,6,'5');

/*!40000 ALTER TABLE `advisor_reviewrating` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table advisor_reviews
# ------------------------------------------------------------

DROP TABLE IF EXISTS `advisor_reviews`;

CREATE TABLE `advisor_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_code` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `review` text,
  `rating` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `advice` text,
  `create_date` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `advisor_reviews` WRITE;
/*!40000 ALTER TABLE `advisor_reviews` DISABLE KEYS */;

INSERT INTO `advisor_reviews` (`id`, `reference_code`, `title`, `review`, `rating`, `user_id`, `advice`, `create_date`, `status`)
VALUES
	(14,'eccbc87e4b5ce2fe28308fd9f2a7baf3','love Great communication','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','3',2,NULL,'1324832609','published'),
	(15,'eccbc87e4b5ce2fe28308fd9f2a7baf3','love Great communication','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','3',2,NULL,'1324832748','published'),
	(16,'eccbc87e4b5ce2fe28308fd9f2a7baf3','love Great communication','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','3',2,NULL,'1324832803','published'),
	(30,'d3d9446802a44259755d38e6d163e820','Great communication','asdasdasd','5',2,NULL,'1330262221','published'),
	(31,'d3d9446802a44259755d38e6d163e820','Truly beautiful street in Gion. Even better atmosphere at night','I love Shimbashi-dori! It\'s a beautiful little street in the heart of Gion. I think it\'s a must see. It\'s a beautifully quaint cobblestone road lined with trees and a beautiful stream. Ryokans and tea houses straddle the stream and its stunning during all times of the year (see photos attached. They are from different visits to Kyoto to show how it can look at different times of the year). It\'s a few streets north of Shijo-dori, the main street in Gion and easy to find.','5',2,NULL,'1330264909','published'),
	(32,'d3d9446802a44259755d38e6d163e820','Truly beautiful street in Gion. Even better atmosphere at night','I love Shimbashi-dori! It\'s a beautiful little street in the heart of Gion. I think it\'s a must see. It\'s a beautifully quaint cobblestone road lined with trees and a beautiful stream. Ryokans and tea houses straddle the stream and its stunning during all times of the year (see photos attached. They are from different visits to Kyoto to show how it can look at different times of the year). It\'s a few streets north of Shijo-dori, the main street in Gion and easy to find.','5',2,NULL,'1330264976','published'),
	(33,'d3d9446802a44259755d38e6d163e820','Truly beautiful street in Gion. Even better atmosphere at night','I love Shimbashi-dori! It\'s a beautiful little street in the heart of Gion. I think it\'s a must see. It\'s a beautifully quaint cobblestone road lined with trees and a beautiful stream. Ryokans and tea houses straddle the stream and its stunning during all times of the year (see photos attached. They are from different visits to Kyoto to show how it can look at different times of the year). It\'s a few streets north of Shijo-dori, the main street in Gion and easy to find.','5',2,NULL,'1330265040','published'),
	(51,'8e296a067a37563370ded05f5a3bf3ec','sad','sadasd','4',2,NULL,'1331735970','published'),
	(70,'d3d9446802a44259755d38e6d163e820','mantasp','jalan masih panjang, coba tanya pada penduduk kampung di sana ada sebuah pohon besar yang memiliki rongga besar di batang pohonnya.',NULL,2,'','1363641692','pending'),
	(71,'d3d9446802a44259755d38e6d163e820','mantasp','jalan masih panjang, coba tanya pada penduduk kampung di sana ada sebuah pohon besar yang memiliki rongga besar di batang pohonnya.',NULL,2,'','1363641748','pending'),
	(72,'8e296a067a37563370ded05f5a3bf3ec','rules',' I am the owner of these photos, and my posting them on Bangladvisor does not infringe upon the rights of any third party. I accept Bangladvisor\'s Terms of Use.\r\n',NULL,2,'asdsad','1363641975','pending');

/*!40000 ALTER TABLE `advisor_reviews` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table factory
# ------------------------------------------------------------

DROP TABLE IF EXISTS `factory`;

CREATE TABLE `factory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_person` varchar(255) DEFAULT NULL,
  `pre_contact` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `telp_number` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `distric` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `user_created` varchar(100) DEFAULT NULL,
  `date_created` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `factory` WRITE;
/*!40000 ALTER TABLE `factory` DISABLE KEYS */;

INSERT INTO `factory` (`id`, `contact_person`, `pre_contact`, `company_name`, `telp_number`, `mobile`, `fax`, `email`, `address`, `distric`, `city`, `status`, `user_created`, `date_created`)
VALUES
	(1,'Omar Quader Khan','M.D.','Desh Garments Ltd','02-9894241, 02-8828505','01819-219777','02-8826049','desh@deshgroup.com','Awal Centre (7th Floor), 34, Kemal Ataturk Avenue','Banani','Dhaka-1213','published',NULL,NULL),
	(2,'Naveed Hashmet','Director','Youngones (Bangladesh) Ltd.','031-715100, 031-716235','','031-710061','yobctg@globalctg.net','24, Agrabad C/A, Jahan Building # 2','','Chittagong','published',NULL,NULL),
	(3,'Mohammad Mosharraf Hossain','M.D.','York Garments Inds. Ltd.',', ','','02-8823702','','11, Mohakhali C/A (1st floor), ','Gulshan','Dhaka-1212','published',NULL,NULL),
	(5,'Shamsun Nahar Ahmed','M.D.','Baishaki Garments Ltd.','02-9669404, 02-8617236','01911750362','02-8313523','','87, New Elephant Road, ','Dhanmondi','Dhaka-1205','published',NULL,NULL),
	(7,'Mohd. Giasuddin','M.D.','Reaz Garments Ltd.','02-9136346, 9124634-6','01711530860','02-9123010','gias@reazbd.com','BTMC Bhaban (3rd Floor), 7-9, Kawran Bazar','Kawran Bazar','Dhaka-1215','published',NULL,NULL),
	(9,'Mohammed Nasir','M.D.','Ashraf Garments (Pvt.) Ltd.','02-8828183, ','01819-311196','02-8811478','masudapp@bol-online.com','House # 79 (4th Floor), Block-D, New Airport Road','Banani','Dhaka-1213','published',NULL,NULL),
	(10,'Muneer Hussain','M.D.','Continental Garments Inds. (Pvt) Ltd.','02-7792376-7, 02-7792410','01711-541443','02-7792413','delwar@continental-bd.com','8, Dewan Idris Road, Bora Rangamatia, Ashulia','Savar','Dhaka','published',NULL,NULL),
	(11,'Mahbubur Rahman','M.D.','Shapla Garments Ltd.','02-8827982, 02-8827605','','02-8826093','','103, Mohakhali C/A,, ','Mohakhali','Dhaka-1212','published',NULL,NULL),
	(12,'Md. Humayun','Chairman','Paris Garments (Pvt). Ltd.','02-9139589, ','01727-496072','02-8189193','zaman@parisgarments.com','1, DIT Market (2nd Floor), ','Kawran Bazar','Dhaka-1215','published',NULL,NULL),
	(15,'Maizuddin Ahmed Chowdhury','Director','Beauty Garments (Pvt) Ltd.','02-8850473, 02-8852751','01711305697','02-8852751','beautygm@bijoy.net','Holland Center (7th Floor), Cha-72/1-B, Middle Badda','Badda','Dhaka-1212','published',NULL,NULL),
	(16,'Mahmud Hasan Nur','M.D.','Central Garments Industry Ltd.','02-9358780, 01715-228200','01715228200','02-8318015','neptune@bttb.net.bd','Flat A-2, Property Mention, 1, Noa Ratan Colony','New Baily Road','Dhaka','published',NULL,NULL),
	(17,'Sayeeful Islam','M.D.','Concorde Garments Ltd.','02-8118151, 02-8118139','01711527439','02-8113678','cgl@concorde.bangla.net','Jahangir Tower (4th floor), 10, Kawran Bazar','Kawran Bazar','Dhaka-1215','published',NULL,NULL),
	(18,'Ferdous Amin','Director','Smart Apparels (Pte) Limited','02-981316, 02-9813377','01712843549','02-9800581','smart@eltechco.net','239 Auchpara, ','Tongi','Gazipur','published',NULL,NULL),
	(20,'Ramzul Seraj','M.D.','Elite Garments Inds. Ltd.','02-8859998, 02-8857884','01711-526555','02-9883681','elite@citechco.net','South Avenue Tower (2nd Floor), House # 50, Road # 3, 7 Gulshan Avenue','Gulshan-1','Dhaka-1212','published',NULL,NULL),
	(23,'Nasrat Khalil Choudhury','Director','Khalil Garments Ltd.','02-8313442, 02-9331139','01711526759','02-8313943','khalilg@siriusbb.com','KRC Bhaban (2nd Floor), 1/1, North Kamalapur','Kamalapur','Dhaka-1000','published',NULL,NULL),
	(24,'R.A. Khan','M.D.','Jupiter Readymade Garments Ltd.','02-8012022, 02-8015311','01711523846','02-8013367','jupiter@dekko.net.bd','Plot # I/2, Road # 6, Section # 7','Mirpur','Dhaka','published',NULL,NULL),
	(25,'nakos',NULL,'Good project','sadasd',NULL,NULL,NULL,'saasdas','','','published','2',NULL),
	(34,'dasdasd',NULL,'testing yaasdsa','',NULL,NULL,NULL,'','','','published','1',NULL),
	(36,'asdasdasd',NULL,'asdsadsad','',NULL,NULL,NULL,'to rani','','','published','2',NULL),
	(37,'try this',NULL,'Uji coba saya','',NULL,NULL,NULL,'','','','published','2',NULL),
	(39,'sadasd',NULL,'budis','',NULL,NULL,NULL,'asdasdasd','','','published','2','1334262393');

/*!40000 ALTER TABLE `factory` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_reset_password
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_reset_password`;

CREATE TABLE `tbl_reset_password` (
  `user_id` int(11) NOT NULL,
  `temp_forget_password` varchar(100) DEFAULT NULL,
  `start_time` varchar(50) DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table tbl_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `profile` text COLLATE utf8_unicode_ci,
  `first_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;

INSERT INTO `tbl_user` (`id`, `username`, `password`, `salt`, `email`, `profile`, `first_name`, `last_name`, `date_created`)
VALUES
	(1,'demo','2e5c7db760a33498023813489cfadc0b','28b206548469ce62182048fd9cf91760','webmaster@example.com',NULL,NULL,NULL,NULL),
	(2,'nakos','bba99b601c28ab80308951cda62c7eba','4ef6c197490601.61954109','budi@sunarko.com',NULL,'budi',NULL,NULL),
	(9,'bunas','2562f15bccf89cf738cc11e9279c1c37','4f5636bdb80a74.86606685','budidemo@localhost.com',NULL,'budi','sunarko',NULL);

/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_user_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_user_options`;

CREATE TABLE `tbl_user_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `option` varchar(255) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_user_options` WRITE;
/*!40000 ALTER TABLE `tbl_user_options` DISABLE KEYS */;

INSERT INTO `tbl_user_options` (`id`, `user_id`, `option`, `value`)
VALUES
	(1,2,'reviews_num','8'),
	(2,2,'factories_num','4');

/*!40000 ALTER TABLE `tbl_user_options` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_useradmin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_useradmin`;

CREATE TABLE `tbl_useradmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `profile` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tbl_useradmin` WRITE;
/*!40000 ALTER TABLE `tbl_useradmin` DISABLE KEYS */;

INSERT INTO `tbl_useradmin` (`id`, `username`, `password`, `salt`, `email`, `profile`)
VALUES
	(1,'admin','2e5c7db760a33498023813489cfadc0b','28b206548469ce62182048fd9cf91760','webmaster@example.com',NULL);

/*!40000 ALTER TABLE `tbl_useradmin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_usergroups_access
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_usergroups_access`;

CREATE TABLE `tbl_usergroups_access` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `element` int(3) NOT NULL,
  `element_id` bigint(20) NOT NULL,
  `module` varchar(140) NOT NULL,
  `controller` varchar(140) NOT NULL,
  `permission` varchar(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table tbl_usergroups_configuration
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_usergroups_configuration`;

CREATE TABLE `tbl_usergroups_configuration` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rule` varchar(40) DEFAULT NULL,
  `value` varchar(20) DEFAULT NULL,
  `options` text,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_usergroups_configuration` WRITE;
/*!40000 ALTER TABLE `tbl_usergroups_configuration` DISABLE KEYS */;

INSERT INTO `tbl_usergroups_configuration` (`id`, `rule`, `value`, `options`, `description`)
VALUES
	(1,'version','1.8','CONST','userGroups version'),
	(2,'password_strength','0','a:3:{i:0;s:4:\"weak\";i:1;s:6:\"medium\";i:2;s:6:\"strong\";}','password strength:<br/>weak: password of at least 5 characters, any character allowed.<br/>\r\n			medium: password of at least 5 characters, must contain at least 2 digits and 2 letters.<br/>\r\n			strong: password of at least 5 characters, must contain at least 2 digits, 2 letters and a special character.'),
	(3,'registration','FALSE','BOOL','allow user registration'),
	(4,'public_user_list','FALSE','BOOL','logged users can see the complete user list'),
	(5,'public_profiles','FALSE','BOOL','allow everyone, even guests, to see user profiles'),
	(6,'profile_privacy','TRUE','BOOL','logged user can see other users profiles'),
	(7,'personal_home','FALSE','BOOL','users can set their own home'),
	(8,'simple_password_reset','FALSE','BOOL','if true users just have to provide user and email to reset their password.<br/>Otherwise they will have to answer their custom question'),
	(9,'user_need_activation','TRUE','BOOL','if true when a user creates an account a mail with an activation code will be sent to his email address'),
	(10,'user_need_approval','FALSE','BOOL','if true when a user creates an account a user with user admin rights will have to approve the registration.<br/>If both this setting and user_need_activation are true the user will need to activate is account first and then will need the approval'),
	(11,'user_registration_group','2','GROUP_LIST','the group new users automatically belong to'),
	(12,'dumb_admin','TRUE','BOOL','users with just admin write permissions won\'t see the Main Configuration and Cron Jobs panels'),
	(13,'super_admin','FALSE','BOOL','users with userGroups admin admin permission will have access to everything, just like root'),
	(14,'permission_cascade','TRUE','BOOL','if a user has on a controller admin permissions will have access to write and read pages. If he has write permissions will also have access to read pages'),
	(15,'server_executed_crons','FALSE','BOOL','if true crons must be executed from the server using a crontab');

/*!40000 ALTER TABLE `tbl_usergroups_configuration` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_usergroups_cron
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_usergroups_cron`;

CREATE TABLE `tbl_usergroups_cron` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `lapse` int(6) DEFAULT NULL,
  `last_occurrence` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_usergroups_cron` WRITE;
/*!40000 ALTER TABLE `tbl_usergroups_cron` DISABLE KEYS */;

INSERT INTO `tbl_usergroups_cron` (`id`, `name`, `lapse`, `last_occurrence`)
VALUES
	(1,'garbage_collection',7,'2012-04-08 00:00:00'),
	(2,'unban',1,'2012-04-12 00:00:00');

/*!40000 ALTER TABLE `tbl_usergroups_cron` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_usergroups_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_usergroups_group`;

CREATE TABLE `tbl_usergroups_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(120) NOT NULL,
  `level` int(6) DEFAULT NULL,
  `home` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groupname` (`groupname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_usergroups_group` WRITE;
/*!40000 ALTER TABLE `tbl_usergroups_group` DISABLE KEYS */;

INSERT INTO `tbl_usergroups_group` (`id`, `groupname`, `level`, `home`)
VALUES
	(1,'root',100,NULL),
	(2,'user',1,'/userGroups');

/*!40000 ALTER TABLE `tbl_usergroups_group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_usergroups_lookup
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_usergroups_lookup`;

CREATE TABLE `tbl_usergroups_lookup` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `element` varchar(20) DEFAULT NULL,
  `value` int(5) DEFAULT NULL,
  `text` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_usergroups_lookup` WRITE;
/*!40000 ALTER TABLE `tbl_usergroups_lookup` DISABLE KEYS */;

INSERT INTO `tbl_usergroups_lookup` (`id`, `element`, `value`, `text`)
VALUES
	(1,'status',0,'banned'),
	(2,'status',1,'waiting activation'),
	(3,'status',2,'waiting approval'),
	(4,'status',3,'password change request'),
	(5,'status',4,'active');

/*!40000 ALTER TABLE `tbl_usergroups_lookup` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_usergroups_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_usergroups_user`;

CREATE TABLE `tbl_usergroups_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) DEFAULT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `home` varchar(120) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `question` text,
  `answer` text,
  `creation_date` datetime DEFAULT NULL,
  `activation_code` varchar(30) DEFAULT NULL,
  `activation_time` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `ban` datetime DEFAULT NULL,
  `ban_reason` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `group_id_idxfk` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `tbl_usergroups_user` WRITE;
/*!40000 ALTER TABLE `tbl_usergroups_user` DISABLE KEYS */;

INSERT INTO `tbl_usergroups_user` (`id`, `group_id`, `username`, `password`, `email`, `home`, `status`, `question`, `answer`, `creation_date`, `activation_code`, `activation_time`, `last_login`, `ban`, `ban_reason`)
VALUES
	(1,1,'admin','da964977e2498fa2289e5916e4b01997','budidemo@localhost.com','/userGroups/admin/documentation',4,'test','test','2012-01-07 21:00:32',NULL,'2012-04-11 13:05:14','2012-04-12 20:27:13',NULL,NULL);

/*!40000 ALTER TABLE `tbl_usergroups_user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
