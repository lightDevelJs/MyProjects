/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : town_db

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2015-04-02 21:03:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `citys`
-- ----------------------------
DROP TABLE IF EXISTS `citys`;
CREATE TABLE `citys` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=628 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of citys
-- ----------------------------
INSERT INTO `citys` VALUES ('123', 'Kiev');
INSERT INTO `citys` VALUES ('627', 'Donetsk');

-- ----------------------------
-- Table structure for `firms`
-- ----------------------------
DROP TABLE IF EXISTS `firms`;
CREATE TABLE `firms` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `city_id` int(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_firm` (`city_id`),
  CONSTRAINT `city_firm` FOREIGN KEY (`city_id`) REFERENCES `citys` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of firms
-- ----------------------------
INSERT INTO `firms` VALUES ('3', '627', 'Лаaоста', 'lacosta@gmail.com', '1');
INSERT INTO `firms` VALUES ('4', '627', 'Лаббада', 'qweqwe@gmail.com', '1');
INSERT INTO `firms` VALUES ('5', '123', 'Морковь', 'stol@gmail.com', '0');
INSERT INTO `firms` VALUES ('6', '627', 'Ладья', '2323@gmail.com', '0');
INSERT INTO `firms` VALUES ('7', '627', 'Каравай', '12312@gmail.com', '1');
INSERT INTO `firms` VALUES ('8', '627', 'Макароны', '123123@gmail.com', '1');
INSERT INTO `firms` VALUES ('9', '627', 'Молоко', '12у2323к@gmail.com', '1');

-- ----------------------------
-- Table structure for `houses`
-- ----------------------------
DROP TABLE IF EXISTS `houses`;
CREATE TABLE `houses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT '0',
  `region_id` int(11) DEFAULT NULL,
  `street_id` int(11) DEFAULT NULL,
  `house_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_house` (`city_id`),
  KEY `region_house` (`region_id`),
  KEY `street_house` (`street_id`),
  CONSTRAINT `city_house` FOREIGN KEY (`city_id`) REFERENCES `citys` (`id`),
  CONSTRAINT `region_house` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  CONSTRAINT `street_house` FOREIGN KEY (`street_id`) REFERENCES `streets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of houses
-- ----------------------------
INSERT INTO `houses` VALUES ('1', '627', '89', '789', '13');
INSERT INTO `houses` VALUES ('2', '627', '89', '789', '22');
INSERT INTO `houses` VALUES ('4', '627', '89', '789', '3');

-- ----------------------------
-- Table structure for `regions`
-- ----------------------------
DROP TABLE IF EXISTS `regions`;
CREATE TABLE `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_region` (`city_id`) USING BTREE,
  CONSTRAINT `city_region` FOREIGN KEY (`city_id`) REFERENCES `citys` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of regions
-- ----------------------------
INSERT INTO `regions` VALUES ('89', '627', 'Kievskiy');
INSERT INTO `regions` VALUES ('111', '627', 'Electro');

-- ----------------------------
-- Table structure for `streets`
-- ----------------------------
DROP TABLE IF EXISTS `streets`;
CREATE TABLE `streets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `title` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_streets` (`city_id`) USING BTREE,
  KEY `region_streets` (`region_id`),
  CONSTRAINT `city_streets` FOREIGN KEY (`city_id`) REFERENCES `citys` (`id`),
  CONSTRAINT `region_streets` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=790 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of streets
-- ----------------------------
INSERT INTO `streets` VALUES ('789', '627', '89', 'Artema');
