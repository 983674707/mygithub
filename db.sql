/*
Navicat MySQL Data Transfer

Source Server         : 127.0.01
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : mxs

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-05 00:20:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `lasttime` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `createtime` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'admin', '13888888888');
INSERT INTO `users` VALUES ('2', 'root', 'root123', '1388888888888');
INSERT INTO `users` VALUES ('3', 'ssh@', 'port', '138888888888');
INSERT INTO `users` VALUES ('4', 'runtime', 'exec', '1388888888888');
INSERT INTO `users` VALUES ('5', 'Thread', 'runRun', '138888888888');
INSERT INTO `users` VALUES ('6', 'grep', 'vim', '13888888888');
INSERT INTO `users` VALUES ('7', 'sed', '##', '13888888888');
INSERT INTO `users` VALUES ('8', 'selinux', 'disable', '133');
INSERT INTO `users` VALUES ('9', 'StringBuild', 'toString', '122');
INSERT INTO `users` VALUES ('10', 'Runable', 'run', '133');
INSERT INTO `users` VALUES ('11', 'awk', 'awk', '100');
