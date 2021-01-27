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

 Date: 26/01/2021 16:29:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for msads_style
-- ----------------------------
DROP TABLE IF EXISTS `msads_style`;
CREATE TABLE `msads_style`  (
  `style_id` int NOT NULL AUTO_INCREMENT,
  `style_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `container_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `title_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`style_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of msads_style
-- ----------------------------

-- ----------------------------
-- Table structure for mskategori
-- ----------------------------
DROP TABLE IF EXISTS `mskategori`;
CREATE TABLE `mskategori`  (
  `ktg_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Kode Kategori',
  `ktg_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Nama Kategori',
  PRIMARY KEY (`ktg_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mskategori
-- ----------------------------
INSERT INTO `mskategori` VALUES ('AD002', 'Teknologi');

-- ----------------------------
-- Table structure for mssetprog
-- ----------------------------
DROP TABLE IF EXISTS `mssetprog`;
CREATE TABLE `mssetprog`  (
  `setano` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `setchar` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `setket` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`setano`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mssetprog
-- ----------------------------
INSERT INTO `mssetprog` VALUES ('byrdefault', '0002', '');
INSERT INTO `mssetprog` VALUES ('close', '202011', 'POSTING|Closing Periode');
INSERT INTO `mssetprog` VALUES ('date', 'disabled', 'Disable tanggal');
INSERT INTO `mssetprog` VALUES ('fopo', '<table width=\"100%\" style=\"border-collapse: collapse;\">\n    <tr>\n        <td align=\"center\" width=\"20%\">Dibuat Oleh</td>\n        <td align=\"center\" width=\"20%\">Menyetujui</td>\n        <td align=\"center\" width=\"20%\">Menyetujui</td>\n        <td align=\"center\" width=\"20%\"> Mengetahui</td>\n    </tr>\n    <tr>\n        <td align=\"center\" width=\"20%\">\n            <br><br><br>\n            ( ___________________ )<br>\n            Adm\n        </td>\n        <td align=\"center\" width=\"20%\">\n            <br><br><br>\n            ( ___________________ )<br>\n            Head MD\n        </td>\n        <td align=\"center\" width=\"20%\">\n            <br><br><br>\n            ( ___________________ )<br>\n            Supplier\n        </td>\n        <td align=\"center\" width=\"20%\">\n            <br><br><br>\n            ( ___________________ )<br>\n            Direktur\n        </td>\n    </tr>\n</table>', 'PRINT FOOTER|Cetakan PO');
INSERT INTO `mssetprog` VALUES ('foposo', '<table width=\"100%\" style=\"border-collapse: collapse;\">\n    <tbody><tr>\n        <td align=\"center\" width=\"20%\">Dibuat Oleh</td>\n        <td align=\"center\" width=\"20%\">Menyetujui</td>\n        <td align=\"center\" width=\"20%\">Menyetujui</td>\n        <td align=\"center\" width=\"20%\">Menyetujui</td>\n        <td align=\"center\" width=\"20%\">Mengetahui</td>\n    </tr>\n    <tr>\n        <td align=\"center\" width=\"20%\">\n            <br><br><br>\n            ( __________________ )<br>\n            Adm\n        </td>\n        <td align=\"center\" width=\"20%\">\n            <br><br><br>\n            ( __________________ )<br>\n            Head MD\n        </td>\n        <td align=\"center\" width=\"20%\">\n            <br><br><br>\n            ( __________________ )<br>\n            Supplier\n        </td>\n        <td align=\"center\" width=\"20%\">\n            <br><br><br>\n            ( __________________ )<br>\n            Supplier\n        </td>\n        <td align=\"center\" width=\"20%\">\n            <br><br><br>\n            ( __________________ )<br>\n            Direktur\n        </td>\n    </tr>\n</tbody></table>', 'PRINT FOOTER|Cetakan PO by SO');
INSERT INTO `mssetprog` VALUES ('gddefault', 'yk06', '');
INSERT INTO `mssetprog` VALUES ('hris_pass_api', '123456789', 'API>User API untuk HRIS');
INSERT INTO `mssetprog` VALUES ('hris_user_api', 'hris', 'API>User API untuk HRIS');
INSERT INTO `mssetprog` VALUES ('kl0', 'Division', 'Kategori>Kategori Level 1');
INSERT INTO `mssetprog` VALUES ('kl1', 'Department', 'Kategori>Kategori Level 2');
INSERT INTO `mssetprog` VALUES ('kl2', 'Category', 'Kategori>Kategori Level 3');
INSERT INTO `mssetprog` VALUES ('kl3', 'Sub Category', 'Kategori>Kategori Level 4');
INSERT INTO `mssetprog` VALUES ('kota', 'YOGYAKARTA', 'INFORMASI|Kota');
INSERT INTO `mssetprog` VALUES ('lock', '202009', 'POSTING|Kunci Periode');
INSERT INTO `mssetprog` VALUES ('nmpt', 'PT BANGUNAN JAYA MANDIRI', 'INFORMASI|Nama Instansi / PT');
INSERT INTO `mssetprog` VALUES ('notif_expired', '10', 'Berapa Lama notifikasi muncul kembali (Menit)');
INSERT INTO `mssetprog` VALUES ('ntf_email', 'Y', '');
INSERT INTO `mssetprog` VALUES ('ntf_sys', 'Y', '');
INSERT INTO `mssetprog` VALUES ('pos_db', '202009', 'POSTING|Tampilkan di dashboard');
INSERT INTO `mssetprog` VALUES ('pre', 'AD', 'INFORMASI|Prefix Untuk Kode Otomatis');
INSERT INTO `mssetprog` VALUES ('qversi', '3.09.513', 'Versi Qhomepro');
INSERT INTO `mssetprog` VALUES ('tema', 'merah', '');
INSERT INTO `mssetprog` VALUES ('upd', 'Y', 'SQ|update');
INSERT INTO `mssetprog` VALUES ('url_upd', 'http://192.168.50.2/qhome.apk', 'SQ|url_update');
INSERT INTO `mssetprog` VALUES ('versi', 'v-1.1.0', 'SQ|versi');

-- ----------------------------
-- Table structure for mssubkategori
-- ----------------------------
DROP TABLE IF EXISTS `mssubkategori`;
CREATE TABLE `mssubkategori`  (
  `subktg_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Kode Sub Kategori',
  `subktg_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Sub Kategori',
  `ktg_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Kode Kategori',
  PRIMARY KEY (`subktg_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mssubkategori
-- ----------------------------
INSERT INTO `mssubkategori` VALUES ('AD001', '11111', 'AD002');

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
-- Table structure for msuser_admin
-- ----------------------------
DROP TABLE IF EXISTS `msuser_admin`;
CREATE TABLE `msuser_admin`  (
  `admin_username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `admin_pass` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `admin_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `admin_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `admin_foto` longblob NULL,
  PRIMARY KEY (`admin_username`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of msuser_admin
-- ----------------------------
INSERT INTO `msuser_admin` VALUES ('admin', '123', 'admin@gmail.com', 'Admin', NULL);

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
-- Table structure for triklan
-- ----------------------------
DROP TABLE IF EXISTS `triklan`;
CREATE TABLE `triklan`  (
  `ads_id` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Kode Iklan',
  `ads_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Judul',
  `ads_konten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Isi Iklan',
  `ads_user_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Email User',
  `ads_wa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'No. WA',
  `ads_situs` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Situs',
  `ads_status` enum('Aktif','Pending','Suspend') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'Aktif' COMMENT 'Status',
  `ads_draft` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'N' COMMENT 'Draft',
  `ads_style` int NULL DEFAULT NULL,
  PRIMARY KEY (`ads_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of triklan
-- ----------------------------
INSERT INTO `triklan` VALUES ('AD001', 'TEST', 'ajslka lkad akdk k dkakd ayudoaudkl duoaud audoka udoaudoua odu aod', 'arifianto.me@gmail.com', '085444545454', 'www.aaaa.com', '', 'N', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trlog
-- ----------------------------
INSERT INTO `trlog` VALUES (1, '2021-01-15 10:18:24', '000001', 'EDIT User No. arifianto.me@gmail.com ');
INSERT INTO `trlog` VALUES (2, '2021-01-23 10:43:14', '000000', 'CREATE Kategori No. AD001 ');
INSERT INTO `trlog` VALUES (3, '2021-01-23 03:08:35', 'yk0001', 'CREATE Kategori No. AD002 ');
INSERT INTO `trlog` VALUES (4, '2021-01-23 03:20:33', 'yk0001', 'CREATE Subkategori No. AD001 ');
INSERT INTO `trlog` VALUES (5, '2021-01-23 04:34:39', 'yk0001', 'CREATE Iklan No. AD001 ');
INSERT INTO `trlog` VALUES (6, '2021-01-23 04:35:27', 'yk0001', 'EDIT Iklan No. AD001 ');
INSERT INTO `trlog` VALUES (7, '2021-01-23 04:37:41', 'yk0001', 'EDIT Iklan No. AD001 ');
INSERT INTO `trlog` VALUES (8, '2021-01-25 04:18:55', '000000', 'EDIT Iklan No. AD001 ');

SET FOREIGN_KEY_CHECKS = 1;
