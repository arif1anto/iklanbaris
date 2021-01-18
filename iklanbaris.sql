/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : iklanbaris

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 18/01/2021 16:33:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for msuser
-- ----------------------------
DROP TABLE IF EXISTS `msuser`;
CREATE TABLE `msuser`  (
  `user_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Email',
  `user_firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Nama Depan',
  `user_lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Nama Belakang',
  `user_pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Password',
  `user_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'No. HP',
  `user_last_login` datetime(0) NULL DEFAULT NULL COMMENT 'Last Login',
  `user_status` enum('Aktif','Suspend') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'Aktif' COMMENT 'Status',
  `user_email_verified` tinyint(1) NULL DEFAULT 0 COMMENT 'Email Verified',
  PRIMARY KEY (`user_email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of msuser
-- ----------------------------
INSERT INTO `msuser` VALUES ('arifianto.me@gmail.com', 'Arifianto', '-', '123', '08545412544', '2021-01-15 14:22:56', 'Aktif', 1);
INSERT INTO `msuser` VALUES ('arifianto1.me@gmail.com', 'Arifianto', '-', '12345678', '82136461938', NULL, 'Aktif', 0);

-- ----------------------------
-- Table structure for notif
-- ----------------------------
DROP TABLE IF EXISTS `notif`;
CREATE TABLE `notif`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `waktu` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `pesan` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `read_time` datetime(0) NULL DEFAULT NULL,
  `read` int NULL DEFAULT 0,
  `click_time` datetime(0) NULL DEFAULT NULL,
  `click` int NULL DEFAULT 0,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '#',
  `penerima` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pengirim` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notif
-- ----------------------------

-- ----------------------------
-- Table structure for trlog
-- ----------------------------
DROP TABLE IF EXISTS `trlog`;
CREATE TABLE `trlog`  (
  `LogSeq` int NOT NULL AUTO_INCREMENT,
  `LogLsUpd` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `LogLsUsr` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LogKet` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`LogSeq`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trlog
-- ----------------------------
INSERT INTO `trlog` VALUES (1, '2021-01-15 10:18:24', '000001', 'EDIT User No. arifianto.me@gmail.com ');

SET FOREIGN_KEY_CHECKS = 1;
