use `bgresults`;

CREATE TABLE `results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `team1_id` int(6) NOT NULL,
  `team2_id` int(6) NOT NULL,
  `team1_goals` int(2) NOT NULL,
  `team2_goals` int(2) NOT NULL,
  `stadium_id` int(5) NOT NULL,
  `tournament_id` int(6) NOT NULL,
  `attendance` int(6) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
