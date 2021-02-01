CREATE TABLE `stadiums` (
  `id` int(5) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `capacity` int(6) DEFAULT NULL,
  `location_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
