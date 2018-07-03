-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `h_runningrobots_dev`;
CREATE DATABASE `h_runningrobots_dev` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `h_runningrobots_dev`;

DROP TABLE IF EXISTS `ItemTypes`;
CREATE TABLE `ItemTypes` (
  `typeId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`typeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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


DROP TABLE IF EXISTS `MyGarage`;
CREATE TABLE `MyGarage` (
  `id` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  KEY `id` (`id`),
  KEY `itemId` (`itemId`),
  CONSTRAINT `MyGarage_ibfk_2` FOREIGN KEY (`id`) REFERENCES `Login` (`id`),
  CONSTRAINT `MyGarage_ibfk_3` FOREIGN KEY (`itemId`) REFERENCES `shop` (`itemId`),
  CONSTRAINT `MyGarage_ibfk_1` FOREIGN KEY (`id`) REFERENCES `Login` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Players`;
CREATE TABLE `Players` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `levels` int(11) NOT NULL DEFAULT '0',
  `coins` int(11) NOT NULL DEFAULT '0',
  `gold` int(11) NOT NULL DEFAULT '0',
  KEY `id` (`id`),
  CONSTRAINT `Players_ibfk_1` FOREIGN KEY (`id`) REFERENCES `Login` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Shop`;
CREATE TABLE `Shop` (
  `itemId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `coin` int(111) NOT NULL,
  `gold` int(11) NOT NULL,
  `typeId` int(11) NOT NULL,
  PRIMARY KEY (`itemId`),
  KEY `typeId` (`typeId`),
  CONSTRAINT `Shop_ibfk_1` FOREIGN KEY (`typeId`) REFERENCES `ItemTypes` (`typeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2018-07-03 09:24:24
