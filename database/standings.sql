CREATE TABLE `standings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(5) NOT NULL,
  `team_id` int(5) NOT NULL,
  `position` int(3) NOT NULL,
  `goals_for` int(3) DEFAULT 0,
  `goals_against` int(3) DEFAULT 0,
  `points` int(3) DEFAULT 0,
  `matches` int(3) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
