/*
Navicat MySQL Data Transfer

Source Server         : php
Source Server Version : 50721
Source Host           : localhost:3306
Source Database       : mall

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2020-01-06 18:01:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mall_access
-- ----------------------------
DROP TABLE IF EXISTS `mall_access`;
CREATE TABLE `mall_access` (
  `access_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` smallint(6) unsigned NOT NULL COMMENT '角色id',
  `node_id` smallint(6) unsigned NOT NULL COMMENT '节点id',
  `level` tinyint(1) NOT NULL COMMENT '节点等级',
  `module` varchar(50) DEFAULT NULL COMMENT '模块',
  PRIMARY KEY (`access_id`),
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of mall_access
-- ----------------------------
INSERT INTO `mall_access` VALUES ('52', '9', '25', '3', null);
INSERT INTO `mall_access` VALUES ('51', '9', '5', '3', null);
INSERT INTO `mall_access` VALUES ('50', '9', '4', '3', null);
INSERT INTO `mall_access` VALUES ('47', '3', '14', '3', null);
INSERT INTO `mall_access` VALUES ('46', '3', '13', '3', null);
INSERT INTO `mall_access` VALUES ('45', '3', '12', '3', null);
INSERT INTO `mall_access` VALUES ('44', '3', '11', '3', null);
INSERT INTO `mall_access` VALUES ('26', '1', '1', '1', null);
INSERT INTO `mall_access` VALUES ('27', '1', '2', '2', null);
INSERT INTO `mall_access` VALUES ('28', '1', '3', '3', null);
INSERT INTO `mall_access` VALUES ('29', '1', '4', '3', null);
INSERT INTO `mall_access` VALUES ('30', '1', '5', '3', null);
INSERT INTO `mall_access` VALUES ('31', '1', '6', '3', null);
INSERT INTO `mall_access` VALUES ('32', '1', '7', '3', null);
INSERT INTO `mall_access` VALUES ('33', '1', '8', '3', null);
INSERT INTO `mall_access` VALUES ('34', '1', '9', '3', null);
INSERT INTO `mall_access` VALUES ('35', '1', '10', '3', null);
INSERT INTO `mall_access` VALUES ('36', '1', '11', '3', null);
INSERT INTO `mall_access` VALUES ('37', '1', '12', '3', null);
INSERT INTO `mall_access` VALUES ('38', '1', '13', '3', null);
INSERT INTO `mall_access` VALUES ('39', '1', '14', '3', null);
INSERT INTO `mall_access` VALUES ('40', '1', '24', '3', null);
INSERT INTO `mall_access` VALUES ('41', '1', '25', '3', null);
INSERT INTO `mall_access` VALUES ('49', '9', '3', '3', null);
INSERT INTO `mall_access` VALUES ('102', '2', '28', '3', null);
INSERT INTO `mall_access` VALUES ('101', '2', '27', '2', null);
INSERT INTO `mall_access` VALUES ('100', '2', '26', '1', null);
INSERT INTO `mall_access` VALUES ('99', '2', '5', '3', null);
INSERT INTO `mall_access` VALUES ('98', '2', '4', '3', null);
INSERT INTO `mall_access` VALUES ('97', '2', '3', '3', null);
INSERT INTO `mall_access` VALUES ('96', '2', '2', '2', null);
INSERT INTO `mall_access` VALUES ('95', '2', '1', '1', null);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_admin
-- ----------------------------
INSERT INTO `mall_admin` VALUES ('1', 'admin', 'e14d86bc21c071979bb4f22f18d29696', 'e80adc', '1', '1578304843', '127.0.0.1', '0', '0');
INSERT INTO `mall_admin` VALUES ('5', 'user', '46a2e3c28812367a6d3eea9de9cc3112', '70ee55', '1', '1578304815', '127.0.0.1', '1577777423', '1578281385');

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
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='节点表';

-- ----------------------------
-- Records of mall_node
-- ----------------------------
INSERT INTO `mall_node` VALUES ('1', 'admin', '', '', '后台管理', '1', null, '1', '0', '1', '1');
INSERT INTO `mall_node` VALUES ('2', 'rbac', '', '', 'Rbac用户权限管理', '1', null, '1', '1', '2', '1');
INSERT INTO `mall_node` VALUES ('24', 'delUser', '', '', '删除管理员', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('25', 'editPass', '', '', '重置密码', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('26', 'test', '', '', '商品管理', '1', null, '0', '0', '1', '1');
INSERT INTO `mall_node` VALUES ('3', 'role', '', '', '角色列表', '1', null, '1', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('4', 'user', '', '', '管理员列表', '1', null, '1', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('5', 'node', '', '', '节点列表', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('6', 'addUser', '', '', '添加管理员', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('7', 'addRole', '', '', '添加角色', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('8', 'addNode', '', '', '添加节点', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('9', 'editNode', '', '', '编辑节点', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('10', 'delNode', '', '', '删除节点', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('11', 'editRole', '', '', '编辑角色', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('12', 'delRole', '', '', '删除角色', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('13', 'access', '', '', '配置权限', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('14', 'editUser', '', '', '编辑管理员', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('27', 'sdfs', '', '', '特殊', '1', null, '0', '26', '2', '1');
INSERT INTO `mall_node` VALUES ('28', 'add', '', '', '添加', '1', null, '0', '27', '3', '1');

-- ----------------------------
-- Table structure for mall_role
-- ----------------------------
DROP TABLE IF EXISTS `mall_role`;
CREATE TABLE `mall_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(20) NOT NULL COMMENT '角色英文名称',
  `pid` smallint(6) DEFAULT NULL COMMENT '父级id',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '开启状态0表示关闭1表示开启',
  `remark` varchar(255) DEFAULT NULL COMMENT '角色中文名称',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of mall_role
-- ----------------------------
INSERT INTO `mall_role` VALUES ('1', 'admin', null, '1', '超级管理员');
INSERT INTO `mall_role` VALUES ('2', 'user', null, '1', '编辑');
INSERT INTO `mall_role` VALUES ('9', 'manager', null, '1', '后台管理员');

-- ----------------------------
-- Table structure for mall_role_user
-- ----------------------------
DROP TABLE IF EXISTS `mall_role_user`;
CREATE TABLE `mall_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL COMMENT '角色id',
  `user_id` char(32) DEFAULT NULL COMMENT '用户id',
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户与角色中间表';

-- ----------------------------
-- Records of mall_role_user
-- ----------------------------
INSERT INTO `mall_role_user` VALUES ('1', '1');
INSERT INTO `mall_role_user` VALUES ('2', '5');
