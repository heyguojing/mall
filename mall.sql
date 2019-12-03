/*
Navicat MySQL Data Transfer

Source Server         : php
Source Server Version : 50721
Source Host           : localhost:3306
Source Database       : mall

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2019-12-03 18:04:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mall_admin
-- ----------------------------
DROP TABLE IF EXISTS `mall_admin`;
CREATE TABLE `mall_admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` varchar(6) DEFAULT '',
  `status` tinyint(6) unsigned DEFAULT '0' COMMENT '管理员状态，0表示关闭，1表示开启',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0',
  `login_ip` varchar(40) NOT NULL DEFAULT '0.0.0.0' COMMENT '登陆ip',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `用户名` (`username`),
  KEY `用户状态` (`status`) COMMENT '用户状态\r\n'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_admin
-- ----------------------------
INSERT INTO `mall_admin` VALUES ('1', 'admin', '3d53b999d53504c6c3a4dec950d0deb3', 'cce536', '0', '1575355136', '127.0.0.1', '0', '0');

-- ----------------------------
-- Table structure for mall_node
-- ----------------------------
DROP TABLE IF EXISTS `mall_node`;
CREATE TABLE `mall_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '模块 控制器 方法 英文名称',
  `parameter` varchar(20) DEFAULT NULL COMMENT '方法中的带有参数名称',
  `parameter_title` varchar(50) DEFAULT NULL COMMENT '方法中的带有参数值',
  `title` varchar(50) DEFAULT NULL COMMENT '模块 控制器 方法 中文名称',
  `status` tinyint(1) DEFAULT '0' COMMENT '节点状态 0表示关闭 1表示开启',
  `remark` varchar(255) DEFAULT NULL COMMENT '描述',
  `sort` smallint(6) unsigned DEFAULT NULL COMMENT '节点排序',
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父级id 这个用来无限极分类',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '等级',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '导航栏是否显示',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='节点表';

-- ----------------------------
-- Records of mall_node
-- ----------------------------
INSERT INTO `mall_node` VALUES ('1', 'admin', null, null, 'RBAC用户权限管理', '1', null, '1', '0', '0', '1');
INSERT INTO `mall_node` VALUES ('2', 'node', null, null, '节点列表', '1', null, '1', '1', '2', '1');
INSERT INTO `mall_node` VALUES ('3', 'addNode', null, null, '节点添加', '1', null, '1', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('4', 'editNode', null, null, '节点编辑', '1', null, '2', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('5', 'delNode', null, null, '节点删除', '1', null, '1', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('6', 'memberMan', null, null, '会员管理', '1', null, '2', '0', '0', '1');
INSERT INTO `mall_node` VALUES ('7', 'memberList', null, null, '会员列表', '1', null, '1', '6', '2', '1');
INSERT INTO `mall_node` VALUES ('8', 'memberLev', null, null, '会员等级', '1', null, '2', '6', '2', '1');
