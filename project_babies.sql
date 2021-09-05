-- Adminer 4.7.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';


DROP TABLE IF EXISTS `resources`;
CREATE TABLE `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(80) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date_created` date NOT NULL,
  `contact_name` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `resources` (`id`, `type`, `title`, `description`, `date_created`, `contact_name`, `email`) VALUES
(17,	'Requesting',	'need clothes',	'size 18t',	'2020-05-16',	'kate',	'popcorn@kettle.com'),
(19,	'Offering',	'I have a bassinet',	'Gently used',	'2020-05-17',	'frank beel',	'freank@gords.com')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `type` = VALUES(`type`), `title` = VALUES(`title`), `description` = VALUES(`description`), `date_created` = VALUES(`date_created`), `contact_name` = VALUES(`contact_name`), `email` = VALUES(`email`);

-- 2020-05-03 20:55:12
