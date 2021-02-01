CREATE DATABASE `bgresults` /*!40100 DEFAULT CHARACTER SET utf8 */;

use `bgresults`;

CREATE TABLE `locations` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;