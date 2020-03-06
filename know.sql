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

 Date: 06/03/2020 13:10:47
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
  `link` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '联系方式',
  `create_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `content`(`content`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '内容表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ik_article
-- ----------------------------
INSERT INTO `ik_article` VALUES (1, '猫没有锁骨，所以它们的身体柔软又具有弹性，以至于能做出很多让人瞠目结舌的事情', 0, 0, NULL, NULL, '2020-03-05 16:54:12');
INSERT INTO `ik_article` VALUES (2, '猫可以用最快30英里/小时（50公里/小时）的速度奔跑，可以跳上5倍于自身高度的距离', 0, 0, NULL, NULL, '2020-03-05 16:54:27');
INSERT INTO `ik_article` VALUES (3, '香菜的学名是芫荽[yán sui]', 0, 0, NULL, NULL, '2020-03-05 16:54:39');
INSERT INTO `ik_article` VALUES (5, '公交车的限载人数是8人/平方米，也就是说一台普通的公交车（12米*2.5米）面积是30平方米，载人数可达240人！所以公交车基本不会超载。注意：不涵盖印度', 0, 0, '利姆鲁大人', '', '2020-03-06 13:05:34');
INSERT INTO `ik_article` VALUES (6, '日本没有法定首都', 0, 0, '利姆鲁大人', '', '2020-03-06 13:06:08');
INSERT INTO `ik_article` VALUES (7, '美国没有法定官方语言，英语只是美国51个州中32个的法定官方语言', 0, 0, '利姆鲁大人', '', '2020-03-06 13:06:20');
INSERT INTO `ik_article` VALUES (8, '鲸鱼呼吸时不是往外喷水，是喷出体内湿度很高的空气，与外界冷空气接触时冷凝成水雾。这个现象有个专有名词叫“潮吹”', 0, 0, '利姆鲁大人', '', '2020-03-06 13:06:35');
INSERT INTO `ik_article` VALUES (9, '中国历史上，最大的李姓皇朝被姓朱的人灭掉，最大的朱姓皇朝被姓李的人灭掉', 0, 0, '', '', '2020-03-06 13:06:58');
INSERT INTO `ik_article` VALUES (10, '有极少部分人类，能舔到自己的胳膊肘', 0, 0, '', '', '2020-03-06 13:07:05');
INSERT INTO `ik_article` VALUES (11, '伽利略并没有真的做从比萨斜塔上往下扔轻重两个铁球的实验', 0, 0, '', '', '2020-03-06 13:07:12');
INSERT INTO `ik_article` VALUES (12, '在中国，有一种叫成华猪的家猪，其濒危程度超过大熊猫', 0, 0, '', '', '2020-03-06 13:07:21');
INSERT INTO `ik_article` VALUES (13, '人的两个鼻孔是不会同时工作的', 0, 0, '', '', '2020-03-06 13:07:29');
INSERT INTO `ik_article` VALUES (14, '在陆地上的哺乳动物，马的眼睛是最大的', 0, 0, '', '', '2020-03-06 13:07:36');
INSERT INTO `ik_article` VALUES (15, '人类的大腿骨比水泥还要坚硬', 0, 0, '', '', '2020-03-06 13:07:42');
INSERT INTO `ik_article` VALUES (16, '如果你持续放屁6年零9个月，屁所产生的气体能量足够媲美原子弹', 0, 0, '', '', '2020-03-06 13:07:49');
INSERT INTO `ik_article` VALUES (17, '丝袜开始也是为男士发明的', 0, 0, '', '', '2020-03-06 13:07:57');
INSERT INTO `ik_article` VALUES (18, '冰岛是世界上唯一没有蚊子的国家', 0, 0, '', '', '2020-03-06 13:08:03');
INSERT INTO `ik_article` VALUES (19, '人类做爱的平均持续时间为两分钟', 0, 0, '', '', '2020-03-06 13:08:15');
INSERT INTO `ik_article` VALUES (20, '理论上，男人的乳房也可以产奶', 0, 0, '', '', '2020-03-06 13:08:22');
INSERT INTO `ik_article` VALUES (21, '裸睡比穿着衣服睡更加温暖', 0, 0, '', '', '2020-03-06 13:08:27');
INSERT INTO `ik_article` VALUES (22, '橘子皮可以引爆气球', 0, 0, '', '', '2020-03-06 13:08:33');
INSERT INTO `ik_article` VALUES (23, '男装的扣子都是在右边，女装的扣子都是在左边', 0, 0, '', '', '2020-03-06 13:08:39');
INSERT INTO `ik_article` VALUES (24, '我国历史上发行过的最大体积的货币是太平天国时候的“花钱”', 0, 0, '', '', '2020-03-06 13:08:46');
INSERT INTO `ik_article` VALUES (25, '牛顿在26岁以前就几乎完成了他在物理界的所有发现，剩下的人生都玩命的在炼金，还有膜拜上帝', 0, 0, '', '', '2020-03-06 13:08:53');
INSERT INTO `ik_article` VALUES (26, '直系亲属之间不能输血，电视剧里都是假的', 0, 0, '', '', '2020-03-06 13:08:59');
INSERT INTO `ik_article` VALUES (27, '黑猩猩有时会在冲突之后和对方接吻，表示重归于好,但多发于雄性黑猩猩之间进行', 0, 0, '', '', '2020-03-06 13:09:12');
INSERT INTO `ik_article` VALUES (28, '历史上连续接吻时间最长的记录为58小时35分钟58秒，约为两天半', 0, 0, '', '', '2020-03-06 13:09:18');
INSERT INTO `ik_article` VALUES (29, '在古埃及，仆人会在身上涂满蜂蜜，这样苍蝇就不会去骚扰法老王了', 0, 0, '', '', '2020-03-06 13:09:27');
INSERT INTO `ik_article` VALUES (30, '中国拥有世界上所有的熊猫', 0, 0, '', '', '2020-03-06 13:09:33');
INSERT INTO `ik_article` VALUES (31, '我国初吻的平均年龄为23岁,日本人为17.7岁,美国人为15岁,巴西人为13岁', 0, 0, '', '', '2020-03-06 13:09:39');
INSERT INTO `ik_article` VALUES (32, '高跟鞋最初由意大利人发明，是为了骑马的男士发明的', 0, 0, '', '', '2020-03-06 13:09:45');
INSERT INTO `ik_article` VALUES (33, '在19世纪之前，假牙都是取自那些不幸战死的士兵', 0, 0, '', '', '2020-03-06 13:09:52');
INSERT INTO `ik_article` VALUES (34, '胡子多更容易秃头', 0, 0, '', '', '2020-03-06 13:09:57');

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
INSERT INTO `ik_read` VALUES (28, 1, 2);
INSERT INTO `ik_read` VALUES (27, 1, 1);
INSERT INTO `ik_read` VALUES (26, 1, 3);

SET FOREIGN_KEY_CHECKS = 1;
