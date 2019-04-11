/*
 Navicat Premium Data Transfer

 Source Server         : johnny_3306
 Source Server Type    : MySQL
 Source Server Version : 80012
 Source Host           : localhost:3306
 Source Schema         : xh_order_food

 Target Server Type    : MySQL
 Target Server Version : 80012
 File Encoding         : 65001

 Date: 03/01/2019 00:30:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for food_cart
-- ----------------------------
DROP TABLE IF EXISTS `food_cart`;
CREATE TABLE `food_cart`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL COMMENT '用户ID',
  `fm_id` int(11) NOT NULL COMMENT '菜品ID',
  `desk_id` int(11) NULL DEFAULT NULL COMMENT '餐桌ID',
  `fm_number` int(11) NOT NULL COMMENT '订餐数量',
  `state` int(1) NULL DEFAULT 0 COMMENT '信息状态：0=默认显示；1=删除',
  `creation_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '购物车表；2018' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for food_class
-- ----------------------------
DROP TABLE IF EXISTS `food_class`;
CREATE TABLE `food_class`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_name` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类名称',
  `fc_order` int(11) NULL DEFAULT 0 COMMENT '显示顺序：倒序显示',
  `state` int(1) NULL DEFAULT 0 COMMENT '信息状态：0=默认显示；1=删除',
  `creation_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '菜品分类表；2018' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for food_desk
-- ----------------------------
DROP TABLE IF EXISTS `food_desk`;
CREATE TABLE `food_desk`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fd_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '餐桌名称',
  `fd_order` int(11) NULL DEFAULT NULL COMMENT '显示顺序；顺序显示',
  `state` int(1) NULL DEFAULT 0 COMMENT '信息状态：0=默认显示；1=删除',
  `creation_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '餐桌表；2018' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for food_image
-- ----------------------------
DROP TABLE IF EXISTS `food_image`;
CREATE TABLE `food_image`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_id` int(11) NULL DEFAULT NULL COMMENT '菜品ID',
  `fm_pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图片地址',
  `fm_order` int(11) NULL DEFAULT NULL COMMENT '图片显示顺序，顺序显示',
  `state` int(1) NULL DEFAULT 0 COMMENT '信息状态：0=默认显示；1=删除',
  `creation_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '菜品图片表；2018' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for food_menu
-- ----------------------------
DROP TABLE IF EXISTS `food_menu`;
CREATE TABLE `food_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fm_class` int(11) NOT NULL COMMENT '分类ID',
  `fm_name` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '菜品名称',
  `fm_bazaar` decimal(10, 2) UNSIGNED NULL DEFAULT NULL COMMENT '市场价格',
  `fm_price` decimal(10, 2) NOT NULL COMMENT '销售价格',
  `fm_details` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '详情介绍',
  `state` int(1) NULL DEFAULT 0 COMMENT '信息状态：0=默认显示；1=删除',
  `creation_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '菜品信息表；2018' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for food_order
-- ----------------------------
DROP TABLE IF EXISTS `food_order`;
CREATE TABLE `food_order`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '订单编号',
  `desk_id` int(11) NULL DEFAULT NULL COMMENT '桌号',
  `state` int(1) NOT NULL DEFAULT 0 COMMENT '信息状态：0=默认显示；1=取消订单',
  `notes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '订单信息备注',
  `creation_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '订单表；2018' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for food_order_list
-- ----------------------------
DROP TABLE IF EXISTS `food_order_list`;
CREATE TABLE `food_order_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `order_id` int(11) NULL DEFAULT NULL COMMENT '订单ID',
  `goods_id` int(11) NOT NULL COMMENT '菜品ID',
  `fo_number` int(11) NOT NULL COMMENT '订餐数量',
  `good_price` decimal(10, 2) NULL DEFAULT NULL COMMENT '小菜单价',
  `creation_time` datetime(0) NOT NULL COMMENT '创建时间',
  `update_time` datetime(0) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '定单详情列表；2018' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for food_user
-- ----------------------------
DROP TABLE IF EXISTS `food_user`;
CREATE TABLE `food_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '帐号',
  `passwords` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '密码',
  `user_name` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '姓名',
  `user_code` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '工号',
  `desk_id` int(11) NULL DEFAULT NULL COMMENT '桌号ID',
  `user_phone` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '手机号码',
  `wechat_id` int(11) NULL DEFAULT NULL COMMENT '微信用户ID',
  `add_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for food_wechat_user
-- ----------------------------
DROP TABLE IF EXISTS `food_wechat_user`;
CREATE TABLE `food_wechat_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '普通用户的标识，对当前开发者帐号唯一',
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '普通用户昵称,base64加密（因特殊符号保存出错问题）',
  `sex` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '普通用户性别，1为男性，2为女性',
  `province` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '普通用户个人资料填写的省份',
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '普通用户个人资料填写的城市',
  `country` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '国家，如中国为CN',
  `headimgurl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户头像',
  `privilege` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户特权信息，json数组，如微信沃卡用户为（chinaunicom）',
  `unionid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户统一标识。针对一个微信开放平台帐号下的应用，同一用户的unionid是唯一的。',
  `add_time` datetime(0) NULL DEFAULT NULL COMMENT '添加时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '食堂微信登录；2018' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
