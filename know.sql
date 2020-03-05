/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80012
 Source Host           : localhost:3306
 Source Schema         : know

 Target Server Type    : MySQL
 Target Server Version : 80012
 File Encoding         : 65001

 Date: 05/03/2020 17:40:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ik_article
-- ----------------------------
DROP TABLE IF EXISTS `ik_article`;
CREATE TABLE `ik_article`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '具体内容',
  `real` int(5) NOT NULL DEFAULT 0,
  `fake` int(5) NOT NULL DEFAULT 0,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '发布人名字',
  `create_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '内容表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ik_article
-- ----------------------------
INSERT INTO `ik_article` VALUES (1, '猫没有锁骨，所以它们的身体柔软又具有弹性，以至于能做出很多让人瞠目结舌的事情', 0, 0, NULL, '2020-03-05 16:54:12');
INSERT INTO `ik_article` VALUES (2, '猫可以用最快30英里/小时（50公里/小时）的速度奔跑，可以跳上5倍于自身高度的距离', 0, 0, NULL, '2020-03-05 16:54:27');
INSERT INTO `ik_article` VALUES (3, '香菜的学名是芫荽[yán sui]', 0, 0, NULL, '2020-03-05 16:54:39');

-- ----------------------------
-- Table structure for ik_member
-- ----------------------------
DROP TABLE IF EXISTS `ik_member`;
CREATE TABLE `ik_member`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0,
  `last_day` int(11) NOT NULL COMMENT '上次浏览时间',
  `create_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'ip统计表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ik_member
-- ----------------------------
INSERT INTO `ik_member` VALUES (1, '127.0.0.1', 2, 1583396209, '2020-03-05 16:10:57');

-- ----------------------------
-- Table structure for ik_read
-- ----------------------------
DROP TABLE IF EXISTS `ik_read`;
CREATE TABLE `ik_read`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of ik_read
-- ----------------------------
INSERT INTO `ik_read` VALUES (1, 1, 2);
INSERT INTO `ik_read` VALUES (2, 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
