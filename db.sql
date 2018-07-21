-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ItemTypes`;
CREATE TABLE `ItemTypes` (
  `typeId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`typeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ItemTypes` (`typeId`, `name`) VALUES
(1,	'robot'),
(2,	'coin'),
(3,	'gold'),
(4,	'item'),
(5,	'costume');

DROP TABLE IF EXISTS `Login`;
CREATE TABLE `Login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `code` varchar(255) DEFAULT NULL,
  `link_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Login` (`id`, `email`, `password`, `reg_date`, `code`, `link_time`) VALUES
(2,	'ab123@mail.com',	'$2y$12$ibyhSlrXDhNMBe.EGIYZYOE23u5IWtljv5HhNnWLJCRLk1QOwIh/.',	'0000-00-00 00:00:00',	'0',	NULL),
(3,	'abc123@mail.com',	'$2y$12$RE.W5/tV/L0O8WiXELh/duiQOsisQBIyBNU0qpWNNFqR0Co6LsU0m',	'0000-00-00 00:00:00',	'0',	NULL),
(4,	'abd123@mail.com',	'$2y$12$zHv93pa7rFxnHqbQUFlN7uHqffuxxdFWQJvuixMAsmr1XKMa5Gezm',	'0000-00-00 00:00:00',	'0',	NULL),
(5,	'abe123@mail.com',	'$2y$12$PZnaB/vFmHBFRummPdGkT.2LacQ/BHrMNS0UUnzkZzVXZc.GvUGl.',	'0000-00-00 00:00:00',	'0',	NULL),
(6,	'abf123@mail.com',	'$2y$12$t6FjQ3TNbI/lrWF4tpnHjeAc2wVZNGM836P/WGxrK0slno0CJBwku',	'0000-00-00 00:00:00',	'0',	NULL),
(7,	'abg123@mail.com',	'$2y$12$uRe.HeEQEBfzdEU1A96HLe1x0xBCKLKqVEEIMVSCHvSglNTiXX7tq',	'0000-00-00 00:00:00',	'0',	NULL);

DROP TABLE IF EXISTS `MyGarage`;
CREATE TABLE `MyGarage` (
  `id` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  KEY `id` (`id`),
  KEY `itemId` (`itemId`),
  CONSTRAINT `MyGarage_ibfk_1` FOREIGN KEY (`id`) REFERENCES `Login` (`id`),
  CONSTRAINT `MyGarage_ibfk_2` FOREIGN KEY (`id`) REFERENCES `Login` (`id`),
  CONSTRAINT `MyGarage_ibfk_3` FOREIGN KEY (`itemId`) REFERENCES `shop` (`itemId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Players`;
CREATE TABLE `Players` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `levels` int(11) NOT NULL DEFAULT '0',
  `coins` int(11) NOT NULL DEFAULT '0',
  `gold` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`),
  CONSTRAINT `Players_ibfk_1` FOREIGN KEY (`id`) REFERENCES `Login` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Players` (`id`, `name`, `levels`, `coins`, `gold`) VALUES
(2,	'Alex',	2,	50,	25),
(3,	'zxc',	0,	0,	0);

DROP TABLE IF EXISTS `Shop`;
CREATE TABLE `Shop` (
  `itemId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `coin` int(111) DEFAULT NULL,
  `gold` int(11) DEFAULT NULL,
  `dollar` float DEFAULT NULL,
  `typeId` int(11) NOT NULL,
  PRIMARY KEY (`itemId`),
  KEY `typeId` (`typeId`),
  CONSTRAINT `Shop_ibfk_1` FOREIGN KEY (`typeId`) REFERENCES `ItemTypes` (`typeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Shop` (`itemId`, `name`, `image`, `coin`, `gold`, `dollar`, `typeId`) VALUES
(1,	'robo1',	'',	2000,	NULL,	5,	1),
(2,	'robo2',	'',	NULL,	1500,	7,	1),
(3,	'500 Coins Pack',	'',	NULL,	NULL,	1,	2),
(4,	'400 Gold Pack',	'',	NULL,	NULL,	1,	3);

-- 2018-07-21 11:02:08
