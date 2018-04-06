/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : clouthes

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-04-06 17:41:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', '帽子');
INSERT INTO `categories` VALUES ('2', '上衣');
INSERT INTO `categories` VALUES ('3', '裤子');
INSERT INTO `categories` VALUES ('4', '鞋子');

-- ----------------------------
-- Table structure for `clouthes`
-- ----------------------------
DROP TABLE IF EXISTS `clouthes`;
CREATE TABLE `clouthes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `season` tinyint(4) DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sex` tinyint(4) NOT NULL DEFAULT '1',
  `profession_id` int(11) unsigned NOT NULL,
  `age` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `desc` varchar(255) NOT NULL,
  `img_uri` varchar(255) NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `1` (`category_id`),
  KEY `2` (`user_id`),
  KEY `213` (`profession_id`),
  CONSTRAINT `1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `213` FOREIGN KEY (`profession_id`) REFERENCES `professions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clouthes
-- ----------------------------
INSERT INTO `clouthes` VALUES ('30', '1', '第二件衣服', 'http://www.360doc.com/content/16/0201/08/7863900_532017077.shtml', '1', '1', '20', '9', '第十件衣服', 'images/da9bd6a1474ac425f35acc8cc2ca5283.jpeg', '1', '2018-04-06 09:32:30', '2018-04-06 09:07:08');
INSERT INTO `clouthes` VALUES ('31', '1', 'Epic ', 'http://www.360doc.com/content/14/1015/15/471722_417174918.shtml', '1', '1', '20', '9', '第十件衣服的描述', 'images/da9bd6a1474ac425f35acc8cc2ca5283.jpeg', '1', '2018-04-06 09:07:20', '2018-04-06 09:07:20');

-- ----------------------------
-- Table structure for `clouthes_user`
-- ----------------------------
DROP TABLE IF EXISTS `clouthes_user`;
CREATE TABLE `clouthes_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `clouthes_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `11` (`user_id`),
  KEY `22` (`clouthes_id`),
  CONSTRAINT `11` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `22` FOREIGN KEY (`clouthes_id`) REFERENCES `clouthes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clouthes_user
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `professions`
-- ----------------------------
DROP TABLE IF EXISTS `professions`;
CREATE TABLE `professions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of professions
-- ----------------------------
INSERT INTO `professions` VALUES ('1', '学生');
INSERT INTO `professions` VALUES ('2', '白领');
INSERT INTO `professions` VALUES ('3', '孕妈');
INSERT INTO `professions` VALUES ('4', '教师');
INSERT INTO `professions` VALUES ('5', '家庭主妇');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `age` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar_uri` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sex` tinyint(4) NOT NULL,
  `identity` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('5', '20', 'xiasdona', '10983123@qq.com', 'aada', '$2y$10$MaqZv5xbdJzm7FwB14arJOUh2Q5pEkT1LHQtUJCwePJHNA4PxDLRO', null, null, '2018-04-06 01:01:34', '2018-04-05 17:01:34', '1', '10', '0');
INSERT INTO `users` VALUES ('9', '20', 'test1', '1098030258@qq.com', 'asdad', '$2y$10$95eD43pi0H8z5/GX/qSYwe7N/NKteacZJeInON.MYGCxw0VM9XqjK', null, null, '2018-04-05 18:14:45', '2018-04-05 18:14:45', '1', '10', '0');
INSERT INTO `users` VALUES ('11', '20', 'adasda', '123232@qq.com', 'adadasd', '$2y$10$vV962YFVYra6470nBRwOheh7jAiQ6JsLTgBfzxu8HLps0Nr6K6oQO', null, null, '2018-04-06 17:32:15', '2018-04-06 09:32:15', '2', '0', '1');
