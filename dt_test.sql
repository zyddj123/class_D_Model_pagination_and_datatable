/*
Navicat MySQL Data Transfer

Source Server         : Eric
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : dt_test

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-12-20 11:25:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for class
-- ----------------------------
DROP TABLE IF EXISTS `class`;
CREATE TABLE `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of class
-- ----------------------------
INSERT INTO `class` VALUES ('1', '1班', '1');
INSERT INTO `class` VALUES ('2', '3班', '1');
INSERT INTO `class` VALUES ('3', '5班', '1');
INSERT INTO `class` VALUES ('4', '7班', '1');
INSERT INTO `class` VALUES ('5', '9班', '1');
INSERT INTO `class` VALUES ('6', '10班', '1');

-- ----------------------------
-- Table structure for fk_stu_sub
-- ----------------------------
DROP TABLE IF EXISTS `fk_stu_sub`;
CREATE TABLE `fk_stu_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fk_stu_sub
-- ----------------------------
INSERT INTO `fk_stu_sub` VALUES ('1', '1', '1');
INSERT INTO `fk_stu_sub` VALUES ('2', '1', '2');
INSERT INTO `fk_stu_sub` VALUES ('3', '1', '3');
INSERT INTO `fk_stu_sub` VALUES ('4', '1', '4');
INSERT INTO `fk_stu_sub` VALUES ('5', '2', '1');
INSERT INTO `fk_stu_sub` VALUES ('6', '2', '2');
INSERT INTO `fk_stu_sub` VALUES ('7', '3', '3');
INSERT INTO `fk_stu_sub` VALUES ('8', '3', '4');
INSERT INTO `fk_stu_sub` VALUES ('9', '3', '7');
INSERT INTO `fk_stu_sub` VALUES ('10', '3', '8');
INSERT INTO `fk_stu_sub` VALUES ('11', '1', '8');
INSERT INTO `fk_stu_sub` VALUES ('12', '1', '9');
INSERT INTO `fk_stu_sub` VALUES ('13', '2', '5');
INSERT INTO `fk_stu_sub` VALUES ('14', '2', '9');
INSERT INTO `fk_stu_sub` VALUES ('15', '4', '8');
INSERT INTO `fk_stu_sub` VALUES ('16', '4', '9');
INSERT INTO `fk_stu_sub` VALUES ('17', '4', '10');
INSERT INTO `fk_stu_sub` VALUES ('18', '5', '1');
INSERT INTO `fk_stu_sub` VALUES ('19', '5', '2');
INSERT INTO `fk_stu_sub` VALUES ('20', '5', '3');
INSERT INTO `fk_stu_sub` VALUES ('21', '6', '7');
INSERT INTO `fk_stu_sub` VALUES ('22', '6', '8');
INSERT INTO `fk_stu_sub` VALUES ('23', '6', '9');
INSERT INTO `fk_stu_sub` VALUES ('24', '7', '1');
INSERT INTO `fk_stu_sub` VALUES ('25', '7', '2');
INSERT INTO `fk_stu_sub` VALUES ('26', '7', '3');
INSERT INTO `fk_stu_sub` VALUES ('27', '7', '4');
INSERT INTO `fk_stu_sub` VALUES ('28', '7', '5');
INSERT INTO `fk_stu_sub` VALUES ('29', '7', '6');
INSERT INTO `fk_stu_sub` VALUES ('30', '8', '9');
INSERT INTO `fk_stu_sub` VALUES ('31', '8', '7');
INSERT INTO `fk_stu_sub` VALUES ('32', '8', '5');
INSERT INTO `fk_stu_sub` VALUES ('33', '8', '8');

-- ----------------------------
-- Table structure for sex
-- ----------------------------
DROP TABLE IF EXISTS `sex`;
CREATE TABLE `sex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sex` varchar(255) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sex
-- ----------------------------
INSERT INTO `sex` VALUES ('1', '男');
INSERT INTO `sex` VALUES ('2', '女');

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sex_id` tinyint(4) NOT NULL DEFAULT '1',
  `class_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `mm` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('1', '张三', '1', '1', '0', '1');
INSERT INTO `student` VALUES ('2', '李四', '1', '1', '0', '0');
INSERT INTO `student` VALUES ('3', '王五', '2', '2', '0', '0');
INSERT INTO `student` VALUES ('4', '赵六', '2', '2', '0', '0');
INSERT INTO `student` VALUES ('5', '钱七', '2', '2', '0', '0');
INSERT INTO `student` VALUES ('6', '周八', '2', '3', '0', '0');
INSERT INTO `student` VALUES ('7', '吴九', '2', '3', '1', '0');
INSERT INTO `student` VALUES ('8', '冯十', '1', '4', '1', '0');
INSERT INTO `student` VALUES ('9', '陈十一', '2', '4', '1', '0');
INSERT INTO `student` VALUES ('10', '楚十二', '1', '5', '1', '0');
INSERT INTO `student` VALUES ('11', '魏十三', '1', '5', '1', '1');
INSERT INTO `student` VALUES ('12', '蒋十四', '1', '1', '1', '1');
INSERT INTO `student` VALUES ('13', '沈十五', '1', '1', '1', '1');
INSERT INTO `student` VALUES ('14', '韩十六', '1', '1', '1', '1');
INSERT INTO `student` VALUES ('15', '杨十七', '1', '2', '1', '1');
INSERT INTO `student` VALUES ('16', '朱十八', '1', '3', '1', '1');
INSERT INTO `student` VALUES ('17', '秦十九', '1', '3', '1', '1');
INSERT INTO `student` VALUES ('18', '尤二十', '2', '1', '1', '1');
INSERT INTO `student` VALUES ('19', '许二十一', '2', '1', '1', '1');
INSERT INTO `student` VALUES ('20', '何二十二', '2', '2', '1', '1');
INSERT INTO `student` VALUES ('21', '吕二十三', '1', '1', '1', '1');
INSERT INTO `student` VALUES ('22', '施二十四', '2', '1', '1', '1');
INSERT INTO `student` VALUES ('23', '张二十五', '1', '1', '1', '1');
INSERT INTO `student` VALUES ('24', '孔二十六', '2', '1', '1', '1');
INSERT INTO `student` VALUES ('25', '曹二十七', '1', '1', '1', '1');
INSERT INTO `student` VALUES ('26', '严二十八', '2', '1', '1', '1');
INSERT INTO `student` VALUES ('27', '华二十九', '2', '1', '1', '1');
INSERT INTO `student` VALUES ('28', '金三十', '1', '1', '1', '1');
INSERT INTO `student` VALUES ('29', '卫三十一', '2', '2', '1', '1');
INSERT INTO `student` VALUES ('30', '陶三十二', '1', '2', '1', '1');
INSERT INTO `student` VALUES ('31', '江三十三', '2', '2', '1', '1');

-- ----------------------------
-- Table structure for subject
-- ----------------------------
DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of subject
-- ----------------------------
INSERT INTO `subject` VALUES ('1', '数学', '1');
INSERT INTO `subject` VALUES ('2', '语文', '1');
INSERT INTO `subject` VALUES ('3', '英文', '1');
INSERT INTO `subject` VALUES ('4', '物理', '1');
INSERT INTO `subject` VALUES ('5', '化学', '1');
INSERT INTO `subject` VALUES ('6', '生物', '1');
INSERT INTO `subject` VALUES ('7', '历史', '1');
INSERT INTO `subject` VALUES ('8', '政治', '1');
INSERT INTO `subject` VALUES ('9', '体育', '1');
INSERT INTO `subject` VALUES ('10', '美术', '1');
