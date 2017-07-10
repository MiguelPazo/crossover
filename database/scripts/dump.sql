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
  `stands_hired` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `events` */

insert  into `events`(`id`,`name`,`description`,`address`,`latitude`,`longitude`,`start_date`,`end_date`,`stands`,`stands_hired`) values (1,'Event 1','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dapibus, nunc sed vestibulum tincid','Calle Las Begonias 450. San Isidro, Cercado de Lima 15001, Perú','-12.091494','-77.024803','2017-07-09 20:52:24','2017-07-11 20:52:28',7,0),(2,'Event 2','Nam orci eros, congue eget ultricies id, fermentum a mi. Vestibulum ante ipsum primis in faucibus or','\r\nAv. Javier Prado Este 390, San Isidro 15046, Perú','-12.092217','-77.030611','2017-07-09 20:52:24','2017-07-11 20:52:28',7,0),(3,'Event 3','Aenean vel mi est. Duis ut lectus ante. Quisque sollicitudin orci quis mollis pharetra. Duis hendrer','\r\nAv. Paz Soldan 190, San Isidro 15073, Perú','-12.096932','-77.033691','2017-07-09 20:52:24','2017-07-11 20:52:28',8,0);

/*Table structure for table `stands` */

DROP TABLE IF EXISTS `stands`;

CREATE TABLE `stands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` tinyint(4) NOT NULL,
  `status` enum('free','reserved') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'free',
  `photo` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `company` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documents` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stands_events1_idx` (`event_id`),
  KEY `fk_stands_users1_idx` (`user_id`),
  CONSTRAINT `fk_stands_events1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stands_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `stands` */

insert  into `stands`(`id`,`number`,`status`,`photo`,`price`,`company`,`phone`,`email`,`address`,`logo`,`documents`,`event_id`,`user_id`) values (1,1,'free','1.jpg',1500,NULL,NULL,NULL,NULL,NULL,NULL,1,0),(2,2,'free','2.jpg',1200,NULL,NULL,NULL,NULL,NULL,NULL,1,0),(3,3,'reserved','3.jpg',598,NULL,NULL,NULL,NULL,NULL,NULL,1,0),(4,4,'free','4.jpg',1326,NULL,NULL,NULL,NULL,NULL,NULL,1,0),(5,5,'free','5.jpg',546,NULL,NULL,NULL,NULL,NULL,NULL,1,0),(6,6,'free','6.jpg',136,NULL,NULL,NULL,NULL,NULL,NULL,1,0),(7,7,'free','7.jpg',789,NULL,NULL,NULL,NULL,NULL,NULL,1,0),(8,1,'free','8.jpg',456,NULL,NULL,NULL,NULL,NULL,NULL,2,0),(9,2,'free','8.jpg',132,NULL,NULL,NULL,NULL,NULL,NULL,2,0),(10,3,'free','9.jpg',1569,NULL,NULL,NULL,NULL,NULL,NULL,2,0),(11,4,'free','10.jpg',1475,NULL,NULL,NULL,NULL,NULL,NULL,2,0),(12,5,'free','11.jpg',1200,NULL,NULL,NULL,NULL,NULL,NULL,2,0),(13,6,'free','12.jpg',369,NULL,NULL,NULL,NULL,NULL,NULL,2,0),(14,7,'free','13.jpg',456,NULL,NULL,NULL,NULL,NULL,NULL,2,0),(15,1,'free','14.jpg',654,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(16,2,'free','15.jpg',1582,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(17,3,'free','16.jpg',1600,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(18,4,'free','17.jpg',1396,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(19,5,'free','18.jpg',1625,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(20,6,'free','19.jpg',1500,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(21,7,'free','20.jpg',1200,NULL,NULL,NULL,NULL,NULL,NULL,3,0),(22,8,'free','21.jpg',1965,NULL,NULL,NULL,NULL,NULL,NULL,3,0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
