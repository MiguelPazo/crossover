/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.24-MariaDB : Database - events
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_companies_users1_idx` (`user_id`),
  CONSTRAINT `fk_companies_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `companies` */

/*Table structure for table `documents` */

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_documents_companies1_idx` (`company_id`),
  CONSTRAINT `fk_documents_companies1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `documents` */

/*Table structure for table `events` */

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stands` tinyint(4) NOT NULL DEFAULT '0',
  `stands_reserved` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `events` */

insert  into `events`(`id`,`name`,`description`,`address`,`latitude`,`longitude`,`start_date`,`end_date`,`stands`,`stands_reserved`) values (1,'Event 1','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dapibus, nunc sed vestibulum tincid','Calle Las Begonias 450. San Isidro, Cercado de Lima 15001, Perú','-12.091494','-77.024803','2017-07-09 20:52:24','2017-07-11 20:52:28',7,0),(2,'Event 2','Nam orci eros, congue eget ultricies id, fermentum a mi. Vestibulum ante ipsum primis in faucibus or','\r\nAv. Javier Prado Este 390, San Isidro 15046, Perú','-12.092217','-77.030611','2017-07-09 20:52:24','2017-07-11 20:52:28',7,0),(3,'Event 3','Aenean vel mi est. Duis ut lectus ante. Quisque sollicitudin orci quis mollis pharetra. Duis hendrer','\r\nAv. Paz Soldan 190, San Isidro 15073, Perú','-12.096932','-77.033691','2017-07-09 20:52:24','2017-07-11 20:52:28',8,0);

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`)
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2017_07_11_020647_create_jobs_table',1);

/*Table structure for table `stands` */

DROP TABLE IF EXISTS `stands`;

CREATE TABLE `stands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` tinyint(4) NOT NULL,
  `status` enum('free','reserved') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'free',
  `photo` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `event_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stands_events1_idx` (`event_id`),
  KEY `fk_stands_companies1_idx` (`company_id`),
  CONSTRAINT `fk_stands_companies1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stands_events1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `stands` */

insert  into `stands`(`id`,`number`,`status`,`photo`,`price`,`event_id`,`company_id`) values (1,1,'free','1.jpg',1500,1,NULL),(2,2,'free','2.jpg',1200,1,NULL),(3,3,'free','3.jpg',598,1,NULL),(4,4,'free','4.jpg',1326,1,NULL),(5,5,'free','5.jpg',546,1,NULL),(6,6,'free','6.jpg',136,1,NULL),(7,7,'free','7.jpg',789,1,NULL),(8,1,'free','8.jpg',456,2,NULL),(9,2,'free','8.jpg',132,2,NULL),(10,3,'free','9.jpg',1569,2,NULL),(11,4,'free','10.jpg',1475,2,NULL),(12,5,'free','11.jpg',1200,2,NULL),(13,6,'free','12.jpg',369,2,NULL),(14,7,'free','13.jpg',456,2,NULL),(15,1,'free','14.jpg',654,3,NULL),(16,2,'free','15.jpg',1582,3,NULL),(17,3,'free','16.jpg',1600,3,NULL),(18,4,'free','17.jpg',1396,3,NULL),(19,5,'free','18.jpg',1625,3,NULL),(20,6,'free','19.jpg',1500,3,NULL),(21,7,'free','20.jpg',1200,3,NULL),(22,8,'free','21.jpg',1965,3,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
