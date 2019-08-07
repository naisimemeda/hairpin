/*
 Navicat Premium Data Transfer

 Source Server         : homestead
 Source Server Type    : MySQL
 Source Server Version : 50722
 Source Host           : 127.0.0.1:33060
 Source Schema         : hairpin

 Target Server Type    : MySQL
 Target Server Version : 50722
 File Encoding         : 65001

 Date: 07/08/2019 11:53:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `permission` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES (1, 0, 1, 'Index', 'fa-bar-chart', '/', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (2, 0, 2, 'Admin', 'fa-tasks', '', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (3, 2, 3, 'Users', 'fa-users', 'auth/users', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (4, 2, 4, 'Roles', 'fa-user', 'auth/roles', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (5, 2, 5, 'Permission', 'fa-ban', 'auth/permissions', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (6, 2, 6, 'Menu', 'fa-bars', 'auth/menu', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (7, 2, 7, 'Operation log', 'fa-history', 'auth/logs', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (8, 0, 0, '商品管理', 'fa-cubes', '/products', NULL, '2019-08-05 15:50:28', '2019-08-05 15:50:43');

-- ----------------------------
-- Table structure for admin_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `admin_operation_log`;
CREATE TABLE `admin_operation_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_operation_log_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 154 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_operation_log
-- ----------------------------
INSERT INTO `admin_operation_log` VALUES (1, 1, 'admin', 'GET', '192.168.10.1', '[]', '2019-08-05 07:45:57', '2019-08-05 07:45:57');
INSERT INTO `admin_operation_log` VALUES (2, 1, 'admin/auth/logout', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 15:48:01', '2019-08-05 15:48:01');
INSERT INTO `admin_operation_log` VALUES (3, 1, 'admin', 'GET', '192.168.10.1', '[]', '2019-08-05 15:48:08', '2019-08-05 15:48:08');
INSERT INTO `admin_operation_log` VALUES (4, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 15:48:13', '2019-08-05 15:48:13');
INSERT INTO `admin_operation_log` VALUES (5, 1, 'admin', 'GET', '192.168.10.1', '[]', '2019-08-05 15:50:13', '2019-08-05 15:50:13');
INSERT INTO `admin_operation_log` VALUES (6, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 15:50:15', '2019-08-05 15:50:15');
INSERT INTO `admin_operation_log` VALUES (7, 1, 'admin/auth/menu', 'POST', '192.168.10.1', '{\"parent_id\":\"0\",\"title\":\"\\u5546\\u54c1\\u7ba1\\u7406\",\"icon\":\"fa-cube\",\"uri\":null,\"roles\":[null],\"permission\":null,\"_token\":\"CopgDUo5gWkHjGnPoHQ76RY7Xr0yZdBdB8ETB1XT\"}', '2019-08-05 15:50:28', '2019-08-05 15:50:28');
INSERT INTO `admin_operation_log` VALUES (8, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2019-08-05 15:50:28', '2019-08-05 15:50:28');
INSERT INTO `admin_operation_log` VALUES (9, 1, 'admin/auth/menu/8/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 15:50:33', '2019-08-05 15:50:33');
INSERT INTO `admin_operation_log` VALUES (10, 1, 'admin/auth/menu/8', 'PUT', '192.168.10.1', '{\"parent_id\":\"0\",\"title\":\"\\u5546\\u54c1\\u7ba1\\u7406\",\"icon\":\"fa-cubes\",\"uri\":\"\\/products\",\"roles\":[null],\"permission\":null,\"_token\":\"CopgDUo5gWkHjGnPoHQ76RY7Xr0yZdBdB8ETB1XT\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/hairpin.test\\/admin\\/auth\\/menu\"}', '2019-08-05 15:50:43', '2019-08-05 15:50:43');
INSERT INTO `admin_operation_log` VALUES (11, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2019-08-05 15:50:43', '2019-08-05 15:50:43');
INSERT INTO `admin_operation_log` VALUES (12, 1, 'admin/auth/menu', 'GET', '192.168.10.1', '[]', '2019-08-05 15:50:45', '2019-08-05 15:50:45');
INSERT INTO `admin_operation_log` VALUES (13, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 15:50:46', '2019-08-05 15:50:46');
INSERT INTO `admin_operation_log` VALUES (14, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 15:52:03', '2019-08-05 15:52:03');
INSERT INTO `admin_operation_log` VALUES (15, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 15:52:06', '2019-08-05 15:52:06');
INSERT INTO `admin_operation_log` VALUES (16, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 15:52:10', '2019-08-05 15:52:10');
INSERT INTO `admin_operation_log` VALUES (17, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 15:52:50', '2019-08-05 15:52:50');
INSERT INTO `admin_operation_log` VALUES (18, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 15:53:06', '2019-08-05 15:53:06');
INSERT INTO `admin_operation_log` VALUES (19, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 15:53:18', '2019-08-05 15:53:18');
INSERT INTO `admin_operation_log` VALUES (20, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 15:53:20', '2019-08-05 15:53:20');
INSERT INTO `admin_operation_log` VALUES (21, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 15:53:22', '2019-08-05 15:53:22');
INSERT INTO `admin_operation_log` VALUES (22, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 15:53:31', '2019-08-05 15:53:31');
INSERT INTO `admin_operation_log` VALUES (23, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 15:54:57', '2019-08-05 15:54:57');
INSERT INTO `admin_operation_log` VALUES (24, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 15:55:07', '2019-08-05 15:55:07');
INSERT INTO `admin_operation_log` VALUES (25, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 15:55:10', '2019-08-05 15:55:10');
INSERT INTO `admin_operation_log` VALUES (26, 1, 'admin/products/create', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 15:55:11', '2019-08-05 15:55:11');
INSERT INTO `admin_operation_log` VALUES (27, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 15:56:18', '2019-08-05 15:56:18');
INSERT INTO `admin_operation_log` VALUES (28, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 15:56:21', '2019-08-05 15:56:21');
INSERT INTO `admin_operation_log` VALUES (29, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 15:56:23', '2019-08-05 15:56:23');
INSERT INTO `admin_operation_log` VALUES (30, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 15:56:27', '2019-08-05 15:56:27');
INSERT INTO `admin_operation_log` VALUES (31, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 15:56:29', '2019-08-05 15:56:29');
INSERT INTO `admin_operation_log` VALUES (32, 1, 'admin/products/create', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 15:56:31', '2019-08-05 15:56:31');
INSERT INTO `admin_operation_log` VALUES (33, 1, 'admin/products', 'POST', '192.168.10.1', '{\"title\":\"312313\",\"description\":\"<p>123123<\\/p>\",\"on_sale\":\"1\",\"skus\":{\"new_1\":{\"title\":\"IPhone X  \\u4e00\\u53f0\",\"description\":\"\\u4f18\\u60e0\\u4ef7\",\"price\":\"10000\",\"stock\":\"10\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"CopgDUo5gWkHjGnPoHQ76RY7Xr0yZdBdB8ETB1XT\",\"_previous_\":\"http:\\/\\/hairpin.test\\/admin\\/products\"}', '2019-08-05 15:56:48', '2019-08-05 15:56:48');
INSERT INTO `admin_operation_log` VALUES (34, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 15:56:48', '2019-08-05 15:56:48');
INSERT INTO `admin_operation_log` VALUES (35, 1, 'admin/products', 'POST', '192.168.10.1', '{\"title\":\"312313\",\"description\":\"<p>123123<\\/p>\",\"on_sale\":\"1\",\"skus\":{\"new___LA_KEY__\":{\"title\":\"IPhone X  \\u4e00\\u53f0\",\"description\":\"\\u4f18\\u60e0\\u4ef7\",\"price\":\"10000\",\"stock\":\"10\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"CopgDUo5gWkHjGnPoHQ76RY7Xr0yZdBdB8ETB1XT\"}', '2019-08-05 15:57:33', '2019-08-05 15:57:33');
INSERT INTO `admin_operation_log` VALUES (36, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 15:57:33', '2019-08-05 15:57:33');
INSERT INTO `admin_operation_log` VALUES (37, 1, 'admin/products', 'POST', '192.168.10.1', '{\"table\":\"112\",\"description\":\"<p>123123<\\/p>\",\"on_sale\":\"1\",\"skus\":{\"new___LA_KEY__\":{\"title\":\"IPhone X  \\u4e00\\u53f0\",\"description\":\"\\u4f18\\u60e0\\u4ef7\",\"price\":\"10000\",\"stock\":\"10\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"CopgDUo5gWkHjGnPoHQ76RY7Xr0yZdBdB8ETB1XT\"}', '2019-08-05 15:57:40', '2019-08-05 15:57:40');
INSERT INTO `admin_operation_log` VALUES (38, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 15:57:40', '2019-08-05 15:57:40');
INSERT INTO `admin_operation_log` VALUES (39, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 15:57:46', '2019-08-05 15:57:46');
INSERT INTO `admin_operation_log` VALUES (40, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:01:01', '2019-08-05 16:01:01');
INSERT INTO `admin_operation_log` VALUES (41, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:01:10', '2019-08-05 16:01:10');
INSERT INTO `admin_operation_log` VALUES (42, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:01:49', '2019-08-05 16:01:49');
INSERT INTO `admin_operation_log` VALUES (43, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:02:31', '2019-08-05 16:02:31');
INSERT INTO `admin_operation_log` VALUES (44, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:02:32', '2019-08-05 16:02:32');
INSERT INTO `admin_operation_log` VALUES (45, 1, 'admin/products/create', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:02:33', '2019-08-05 16:02:33');
INSERT INTO `admin_operation_log` VALUES (46, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 16:02:49', '2019-08-05 16:02:49');
INSERT INTO `admin_operation_log` VALUES (47, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:02:53', '2019-08-05 16:02:53');
INSERT INTO `admin_operation_log` VALUES (48, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:02:54', '2019-08-05 16:02:54');
INSERT INTO `admin_operation_log` VALUES (49, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:03:05', '2019-08-05 16:03:05');
INSERT INTO `admin_operation_log` VALUES (50, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:03:06', '2019-08-05 16:03:06');
INSERT INTO `admin_operation_log` VALUES (51, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:04:04', '2019-08-05 16:04:04');
INSERT INTO `admin_operation_log` VALUES (52, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:04:06', '2019-08-05 16:04:06');
INSERT INTO `admin_operation_log` VALUES (53, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:04:15', '2019-08-05 16:04:15');
INSERT INTO `admin_operation_log` VALUES (54, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:04:16', '2019-08-05 16:04:16');
INSERT INTO `admin_operation_log` VALUES (55, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:04:37', '2019-08-05 16:04:37');
INSERT INTO `admin_operation_log` VALUES (56, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:07:57', '2019-08-05 16:07:57');
INSERT INTO `admin_operation_log` VALUES (57, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:08:39', '2019-08-05 16:08:39');
INSERT INTO `admin_operation_log` VALUES (58, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:09:01', '2019-08-05 16:09:01');
INSERT INTO `admin_operation_log` VALUES (59, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:09:02', '2019-08-05 16:09:02');
INSERT INTO `admin_operation_log` VALUES (60, 1, 'admin/products/1', 'GET', '192.168.10.1', '[]', '2019-08-05 16:10:31', '2019-08-05 16:10:31');
INSERT INTO `admin_operation_log` VALUES (61, 1, 'admin/products/1', 'GET', '192.168.10.1', '[]', '2019-08-05 16:10:40', '2019-08-05 16:10:40');
INSERT INTO `admin_operation_log` VALUES (62, 1, 'admin/products/1', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:10:42', '2019-08-05 16:10:42');
INSERT INTO `admin_operation_log` VALUES (63, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:12:37', '2019-08-05 16:12:37');
INSERT INTO `admin_operation_log` VALUES (64, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:12:39', '2019-08-05 16:12:39');
INSERT INTO `admin_operation_log` VALUES (65, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:12:58', '2019-08-05 16:12:58');
INSERT INTO `admin_operation_log` VALUES (66, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:13:22', '2019-08-05 16:13:22');
INSERT INTO `admin_operation_log` VALUES (67, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:13:26', '2019-08-05 16:13:26');
INSERT INTO `admin_operation_log` VALUES (68, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:13:31', '2019-08-05 16:13:31');
INSERT INTO `admin_operation_log` VALUES (69, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:14:09', '2019-08-05 16:14:09');
INSERT INTO `admin_operation_log` VALUES (70, 1, 'admin/products/create', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:14:10', '2019-08-05 16:14:10');
INSERT INTO `admin_operation_log` VALUES (71, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 16:14:44', '2019-08-05 16:14:44');
INSERT INTO `admin_operation_log` VALUES (72, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 16:14:47', '2019-08-05 16:14:47');
INSERT INTO `admin_operation_log` VALUES (73, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:14:48', '2019-08-05 16:14:48');
INSERT INTO `admin_operation_log` VALUES (74, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:14:49', '2019-08-05 16:14:49');
INSERT INTO `admin_operation_log` VALUES (75, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:14:51', '2019-08-05 16:14:51');
INSERT INTO `admin_operation_log` VALUES (76, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:21:32', '2019-08-05 16:21:32');
INSERT INTO `admin_operation_log` VALUES (77, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:21:34', '2019-08-05 16:21:34');
INSERT INTO `admin_operation_log` VALUES (78, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:21:40', '2019-08-05 16:21:40');
INSERT INTO `admin_operation_log` VALUES (79, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:21:46', '2019-08-05 16:21:46');
INSERT INTO `admin_operation_log` VALUES (80, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:21:50', '2019-08-05 16:21:50');
INSERT INTO `admin_operation_log` VALUES (81, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:22:15', '2019-08-05 16:22:15');
INSERT INTO `admin_operation_log` VALUES (82, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:22:20', '2019-08-05 16:22:20');
INSERT INTO `admin_operation_log` VALUES (83, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:22:28', '2019-08-05 16:22:28');
INSERT INTO `admin_operation_log` VALUES (84, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:22:51', '2019-08-05 16:22:51');
INSERT INTO `admin_operation_log` VALUES (85, 1, 'admin/products/create', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:23:55', '2019-08-05 16:23:55');
INSERT INTO `admin_operation_log` VALUES (86, 1, 'admin/products', 'POST', '192.168.10.1', '{\"table\":\"3123\",\"description\":\"<p>3123<\\/p>\",\"on_sale\":\"1\",\"skus\":{\"new_1\":{\"title\":\"IPhone X  \\u4e00\\u53f0\",\"description\":\"\\u65b0\\u54c1\",\"price\":\"10\",\"stock\":\"1\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"CopgDUo5gWkHjGnPoHQ76RY7Xr0yZdBdB8ETB1XT\",\"_previous_\":\"http:\\/\\/hairpin.test\\/admin\\/products\"}', '2019-08-05 16:24:07', '2019-08-05 16:24:07');
INSERT INTO `admin_operation_log` VALUES (87, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 16:24:07', '2019-08-05 16:24:07');
INSERT INTO `admin_operation_log` VALUES (88, 1, 'admin/products', 'POST', '192.168.10.1', '{\"table\":\"3123\",\"description\":\"<p>3123<\\/p>\",\"on_sale\":\"1\",\"skus\":{\"new___LA_KEY__\":{\"title\":\"IPhone X  \\u4e00\\u53f0\",\"description\":\"\\u65b0\\u54c1\",\"price\":\"10\",\"stock\":\"1\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"CopgDUo5gWkHjGnPoHQ76RY7Xr0yZdBdB8ETB1XT\"}', '2019-08-05 16:24:15', '2019-08-05 16:24:15');
INSERT INTO `admin_operation_log` VALUES (89, 1, 'admin/products/create', 'GET', '192.168.10.1', '[]', '2019-08-05 16:24:15', '2019-08-05 16:24:15');
INSERT INTO `admin_operation_log` VALUES (90, 1, 'admin/products', 'POST', '192.168.10.1', '{\"table\":\"3123\",\"description\":\"<p>3123<\\/p>\",\"on_sale\":\"1\",\"skus\":{\"new___LA_KEY__\":{\"title\":\"IPhone X  \\u4e00\\u53f0\",\"description\":\"\\u65b0\\u54c1\",\"price\":\"10\",\"stock\":\"1\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"CopgDUo5gWkHjGnPoHQ76RY7Xr0yZdBdB8ETB1XT\"}', '2019-08-05 16:24:19', '2019-08-05 16:24:19');
INSERT INTO `admin_operation_log` VALUES (91, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:24:19', '2019-08-05 16:24:19');
INSERT INTO `admin_operation_log` VALUES (92, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:25:53', '2019-08-05 16:25:53');
INSERT INTO `admin_operation_log` VALUES (93, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:25:57', '2019-08-05 16:25:57');
INSERT INTO `admin_operation_log` VALUES (94, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:26:23', '2019-08-05 16:26:23');
INSERT INTO `admin_operation_log` VALUES (95, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:29:35', '2019-08-05 16:29:35');
INSERT INTO `admin_operation_log` VALUES (96, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:31:44', '2019-08-05 16:31:44');
INSERT INTO `admin_operation_log` VALUES (97, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:31:47', '2019-08-05 16:31:47');
INSERT INTO `admin_operation_log` VALUES (98, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:32:54', '2019-08-05 16:32:54');
INSERT INTO `admin_operation_log` VALUES (99, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:33:03', '2019-08-05 16:33:03');
INSERT INTO `admin_operation_log` VALUES (100, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:33:06', '2019-08-05 16:33:06');
INSERT INTO `admin_operation_log` VALUES (101, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:33:09', '2019-08-05 16:33:09');
INSERT INTO `admin_operation_log` VALUES (102, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:33:10', '2019-08-05 16:33:10');
INSERT INTO `admin_operation_log` VALUES (103, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:33:12', '2019-08-05 16:33:12');
INSERT INTO `admin_operation_log` VALUES (104, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:33:23', '2019-08-05 16:33:23');
INSERT INTO `admin_operation_log` VALUES (105, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:33:26', '2019-08-05 16:33:26');
INSERT INTO `admin_operation_log` VALUES (106, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:33:35', '2019-08-05 16:33:35');
INSERT INTO `admin_operation_log` VALUES (107, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:33:39', '2019-08-05 16:33:39');
INSERT INTO `admin_operation_log` VALUES (108, 1, 'admin/products/create', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:33:40', '2019-08-05 16:33:40');
INSERT INTO `admin_operation_log` VALUES (109, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:33:49', '2019-08-05 16:33:49');
INSERT INTO `admin_operation_log` VALUES (110, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:35:10', '2019-08-05 16:35:10');
INSERT INTO `admin_operation_log` VALUES (111, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:35:11', '2019-08-05 16:35:11');
INSERT INTO `admin_operation_log` VALUES (112, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:35:14', '2019-08-05 16:35:14');
INSERT INTO `admin_operation_log` VALUES (113, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:35:21', '2019-08-05 16:35:21');
INSERT INTO `admin_operation_log` VALUES (114, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:35:37', '2019-08-05 16:35:37');
INSERT INTO `admin_operation_log` VALUES (115, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:35:50', '2019-08-05 16:35:50');
INSERT INTO `admin_operation_log` VALUES (116, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:36:06', '2019-08-05 16:36:06');
INSERT INTO `admin_operation_log` VALUES (117, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:36:11', '2019-08-05 16:36:11');
INSERT INTO `admin_operation_log` VALUES (118, 1, 'admin/products/2/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:40:07', '2019-08-05 16:40:07');
INSERT INTO `admin_operation_log` VALUES (119, 1, 'admin/products/2/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:40:31', '2019-08-05 16:40:31');
INSERT INTO `admin_operation_log` VALUES (120, 1, 'admin/products/2/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:40:33', '2019-08-05 16:40:33');
INSERT INTO `admin_operation_log` VALUES (121, 1, 'admin/products/2', 'PUT', '192.168.10.1', '{\"table\":\"312323\",\"description\":\"<p>3123<\\/p>\",\"on_sale\":\"1\",\"skus\":{\"2\":{\"title\":\"IPhone X  \\u4e00\\u53f0\",\"description\":\"\\u65b0\\u54c1\",\"price\":\"10.00\",\"stock\":\"1\",\"id\":\"2\",\"_remove_\":\"0\"}},\"_token\":\"CopgDUo5gWkHjGnPoHQ76RY7Xr0yZdBdB8ETB1XT\",\"_method\":\"PUT\"}', '2019-08-05 16:40:39', '2019-08-05 16:40:39');
INSERT INTO `admin_operation_log` VALUES (122, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:40:39', '2019-08-05 16:40:39');
INSERT INTO `admin_operation_log` VALUES (123, 1, 'admin/products/2/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:40:42', '2019-08-05 16:40:42');
INSERT INTO `admin_operation_log` VALUES (124, 1, 'admin/products/2/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:42:14', '2019-08-05 16:42:14');
INSERT INTO `admin_operation_log` VALUES (125, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:42:16', '2019-08-05 16:42:16');
INSERT INTO `admin_operation_log` VALUES (126, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:42:17', '2019-08-05 16:42:17');
INSERT INTO `admin_operation_log` VALUES (127, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:42:19', '2019-08-05 16:42:19');
INSERT INTO `admin_operation_log` VALUES (128, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:42:26', '2019-08-05 16:42:26');
INSERT INTO `admin_operation_log` VALUES (129, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:42:36', '2019-08-05 16:42:36');
INSERT INTO `admin_operation_log` VALUES (130, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:42:41', '2019-08-05 16:42:41');
INSERT INTO `admin_operation_log` VALUES (131, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:42:46', '2019-08-05 16:42:46');
INSERT INTO `admin_operation_log` VALUES (132, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:42:54', '2019-08-05 16:42:54');
INSERT INTO `admin_operation_log` VALUES (133, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:43:43', '2019-08-05 16:43:43');
INSERT INTO `admin_operation_log` VALUES (134, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:44:27', '2019-08-05 16:44:27');
INSERT INTO `admin_operation_log` VALUES (135, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:45:14', '2019-08-05 16:45:14');
INSERT INTO `admin_operation_log` VALUES (136, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:45:18', '2019-08-05 16:45:18');
INSERT INTO `admin_operation_log` VALUES (137, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:45:22', '2019-08-05 16:45:22');
INSERT INTO `admin_operation_log` VALUES (138, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:45:24', '2019-08-05 16:45:24');
INSERT INTO `admin_operation_log` VALUES (139, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:46:14', '2019-08-05 16:46:14');
INSERT INTO `admin_operation_log` VALUES (140, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:46:15', '2019-08-05 16:46:15');
INSERT INTO `admin_operation_log` VALUES (141, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:46:20', '2019-08-05 16:46:20');
INSERT INTO `admin_operation_log` VALUES (142, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:46:23', '2019-08-05 16:46:23');
INSERT INTO `admin_operation_log` VALUES (143, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:46:29', '2019-08-05 16:46:29');
INSERT INTO `admin_operation_log` VALUES (144, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:48:40', '2019-08-05 16:48:40');
INSERT INTO `admin_operation_log` VALUES (145, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:50:05', '2019-08-05 16:50:05');
INSERT INTO `admin_operation_log` VALUES (146, 1, 'admin/products', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:50:45', '2019-08-05 16:50:45');
INSERT INTO `admin_operation_log` VALUES (147, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '{\"_pjax\":\"#pjax-container\"}', '2019-08-05 16:50:48', '2019-08-05 16:50:48');
INSERT INTO `admin_operation_log` VALUES (148, 1, 'admin/products/1', 'PUT', '192.168.10.1', '{\"table\":\"images\\/IMG_7112.JPG\",\"description\":\"<p>123123<\\/p>\",\"on_sale\":\"1\",\"skus\":{\"1\":{\"title\":\"IPhone X  \\u4e00\\u53f0\",\"description\":\"\\u4f18\\u60e0\\u4ef7\",\"price\":\"10000.00\",\"stock\":\"10\",\"id\":\"1\",\"_remove_\":\"0\"},\"new_1\":{\"title\":\"iPhone Xs\",\"description\":\"\\u4f18\\u60e0\\u4ef7\",\"price\":\"10000\",\"stock\":\"123\",\"id\":null,\"_remove_\":\"0\"},\"new_2\":{\"title\":null,\"description\":null,\"price\":null,\"stock\":null,\"id\":null,\"_remove_\":\"1\"}},\"_token\":\"CopgDUo5gWkHjGnPoHQ76RY7Xr0yZdBdB8ETB1XT\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/hairpin.test\\/admin\\/products\"}', '2019-08-05 16:51:01', '2019-08-05 16:51:01');
INSERT INTO `admin_operation_log` VALUES (149, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:51:01', '2019-08-05 16:51:01');
INSERT INTO `admin_operation_log` VALUES (150, 1, 'admin/products/1/edit', 'GET', '192.168.10.1', '[]', '2019-08-05 16:51:13', '2019-08-05 16:51:13');
INSERT INTO `admin_operation_log` VALUES (151, 1, 'admin/products/1', 'PUT', '192.168.10.1', '{\"table\":\"images\\/IMG_7112.JPG\",\"description\":\"<p>123123<\\/p>\",\"on_sale\":\"1\",\"skus\":{\"1\":{\"title\":\"IPhone X  \\u4e00\\u53f0\",\"description\":\"\\u4f18\\u60e0\\u4ef7\",\"price\":\"10000.00\",\"stock\":\"10\",\"id\":\"1\",\"_remove_\":\"0\"},\"new_1\":{\"title\":\"iPhone Xs\",\"description\":\"123123\",\"price\":\"10000\",\"stock\":\"123\",\"id\":null,\"_remove_\":\"0\"}},\"_token\":\"CopgDUo5gWkHjGnPoHQ76RY7Xr0yZdBdB8ETB1XT\",\"_method\":\"PUT\"}', '2019-08-05 16:51:23', '2019-08-05 16:51:23');
INSERT INTO `admin_operation_log` VALUES (152, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:51:23', '2019-08-05 16:51:23');
INSERT INTO `admin_operation_log` VALUES (153, 1, 'admin/products', 'GET', '192.168.10.1', '[]', '2019-08-05 16:51:25', '2019-08-05 16:51:25');

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `http_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_permissions_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES (1, 'All permission', '*', '', '*', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu`  (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_role_menu_role_id_menu_id_index`(`role_id`, `menu_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------
INSERT INTO `admin_role_menu` VALUES (1, 2, NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_permissions`;
CREATE TABLE `admin_role_permissions`  (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_role_permissions_role_id_permission_id_index`(`role_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_permissions
-- ----------------------------
INSERT INTO `admin_role_permissions` VALUES (1, 1, NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_users`;
CREATE TABLE `admin_role_users`  (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_role_users_role_id_user_id_index`(`role_id`, `user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_users
-- ----------------------------
INSERT INTO `admin_role_users` VALUES (1, 1, NULL, NULL);

-- ----------------------------
-- Table structure for admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_roles_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_roles
-- ----------------------------
INSERT INTO `admin_roles` VALUES (1, 'Administrator', 'administrator', '2019-08-05 07:44:35', '2019-08-05 07:44:35');

-- ----------------------------
-- Table structure for admin_user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_permissions`;
CREATE TABLE `admin_user_permissions`  (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_user_permissions_user_id_permission_id_index`(`user_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_users_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES (1, 'admin', '$2y$10$SrOJT90gZKxiFHkn1n1WyexqAg/BYn.E8ZnWbZePHbMEDX4DGWD3q', 'Administrator', NULL, '4xUG2K7dIGWR5lcYTBZoZ8ljhvRcwem7LT1zUt52vRRkoIKxwbAOac2HMfrl', '2019-08-05 07:44:35', '2019-08-05 07:44:35');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_05_073653_create_products_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_05_074056_create_product_skus_table', 1);
INSERT INTO `migrations` VALUES (5, '2016_01_04_173148_create_admin_tables', 2);
INSERT INTO `migrations` VALUES (7, '2019_08_05_165213_create_orders_table', 3);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单号',
  `product_id` bigint(20) UNSIGNED NOT NULL COMMENT '商品id',
  `product_sku_id` bigint(20) UNSIGNED NOT NULL COMMENT 'sku',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `amount` int(10) UNSIGNED NOT NULL COMMENT '数量',
  `total_amount` decimal(10, 2) NOT NULL,
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单备注',
  `paid_at` datetime(0) NULL DEFAULT NULL COMMENT '支付时间',
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '支付方式',
  `payment_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '支付平台订单号',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `orders_no_unique`(`no`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, '20190805173215223387', 1, 1, '2514430140@qq.com', '18584864076', 1, 10000.00, '123123备注', NULL, NULL, NULL, '2019-08-05 17:32:15', '2019-08-05 17:32:15');
INSERT INTO `orders` VALUES (2, '20190805175318129319', 1, 1, '2514430140@qq.com', '18584864076', 1, 10000.00, '123123备注', NULL, NULL, NULL, '2019-08-05 17:53:18', '2019-08-05 17:53:18');
INSERT INTO `orders` VALUES (3, '20190805181154872462', 2, 2, '2514430140@qq.com', '18584864076', 1, 10.00, '123123备注', NULL, NULL, NULL, '2019-08-05 18:11:54', '2019-08-05 18:11:54');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for product_skus
-- ----------------------------
DROP TABLE IF EXISTS `product_skus`;
CREATE TABLE `product_skus`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '详情',
  `price` decimal(10, 2) NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL COMMENT '库存',
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_skus_product_id_foreign`(`product_id`) USING BTREE,
  CONSTRAINT `product_skus_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_skus
-- ----------------------------
INSERT INTO `product_skus` VALUES (1, 'IPhone X  一台', '优惠价', 10000.00, 0, 1, '2019-08-05 15:57:40', '2019-08-05 17:53:18');
INSERT INTO `product_skus` VALUES (2, 'IPhone X  一台', '新品', 10.00, 49, 2, '2019-08-05 16:24:19', '2019-08-05 18:11:54');
INSERT INTO `product_skus` VALUES (3, 'iPhone Xs', '123123', 10000.00, 0, 1, '2019-08-05 16:51:23', '2019-08-05 18:02:13');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `table` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品详情',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '封面图片',
  `on_sale` tinyint(1) NOT NULL DEFAULT 1 COMMENT '商品是否正在售卖',
  `price` decimal(10, 2) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'images/IMG_7112.JPG', '<p>123123</p>', 'images/IMG_7112.JPG', 1, 10000.00, '2019-08-05 15:57:40', '2019-08-05 15:57:40');
INSERT INTO `products` VALUES (2, '312323', '<p>3123</p>', 'images/05d5c2ec8ce1dd268459a8ed0550ed42.JPG', 1, 10.00, '2019-08-05 16:24:19', '2019-08-05 16:40:39');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
