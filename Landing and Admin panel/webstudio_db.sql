/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : webstudio_db

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2015-03-02 14:49:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `entity_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `email` varchar(158) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('1', 'Sasha', 'Sasha', 'mycranny1@gmail.com', '5710630ccdcf829d14cbb0986464075c', '2014-11-30 18:13:04', '2015-01-19 12:12:51');
INSERT INTO `admin_user` VALUES ('16', 'lalka', 'lalka', 'lalka@gmail.com', '5710630ccdcf829d14cbb0986464075c', '2015-01-02 07:01:21', '2015-01-03 05:01:53');

-- ----------------------------
-- Table structure for `notification`
-- ----------------------------
DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id_notification` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `email` varchar(255) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `flag` varchar(10) NOT NULL DEFAULT 'Unread',
  PRIMARY KEY (`id_notification`,`flag`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notification
-- ----------------------------
INSERT INTO `notification` VALUES ('21', 'Sasha', 'hello', 'sdsdsd@gmail.com', 'asdsdsd', '2015-01-19 10:01:04', 'Read');
INSERT INTO `notification` VALUES ('22', 'second', 'Hello dear', 'lalal@gmail.com', 'sdsdsds', '2015-01-19 11:01:19', 'Unread');
INSERT INTO `notification` VALUES ('23', 'Next', 'Hello dear', 'next@gmail.com', 'next', '2015-01-19 11:01:39', 'Read');
INSERT INTO `notification` VALUES ('24', 'New Costumer', 'Hello i wont to create bussines web site for my dog', 'ololo@gmail.com', 'zalupa', '2015-01-20 11:01:07', 'Read');
INSERT INTO `notification` VALUES ('25', 'Big Boss', 'Hello', 'bigboss@gmail.com', 'sdsdsd', '2015-01-20 11:01:00', 'Read');

-- ----------------------------
-- Table structure for `portfolio`
-- ----------------------------
DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE `portfolio` (
  `entity_id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `discription` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of portfolio
-- ----------------------------
INSERT INTO `portfolio` VALUES ('57', 'sdsdsds                    sdsds    sdsdsdd                                                                                                                                                                                                                    ', 'ss', 'images/portfolio/decision_ua_14215937.jpg', '2015-01-07 06:01:06', '2015-01-18 07:09:03');
INSERT INTO `portfolio` VALUES ('59', 'My New PF', 'My New PF                                                                                                                                ', 'images/portfolio/decision_ua_142135592.jpg', '2015-01-08 01:01:21', '2015-01-16 01:12:17');
