/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : mall

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-12-17 00:25:04
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
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of mall_access
-- ----------------------------
INSERT INTO `mall_access` VALUES ('25', '3', '21', '3', null);
INSERT INTO `mall_access` VALUES ('24', '3', '20', '3', null);
INSERT INTO `mall_access` VALUES ('23', '3', '19', '3', null);
INSERT INTO `mall_access` VALUES ('22', '3', '18', '3', null);
INSERT INTO `mall_access` VALUES ('21', '3', '16', '3', null);
INSERT INTO `mall_access` VALUES ('20', '3', '15', '3', null);
INSERT INTO `mall_access` VALUES ('19', '3', '14', '3', null);
INSERT INTO `mall_access` VALUES ('18', '3', '13', '3', null);
INSERT INTO `mall_access` VALUES ('17', '3', '12', '3', null);
INSERT INTO `mall_access` VALUES ('16', '3', '11', '3', null);
INSERT INTO `mall_access` VALUES ('15', '3', '2', '2', null);
INSERT INTO `mall_access` VALUES ('14', '3', '1', '1', null);

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_admin
-- ----------------------------
INSERT INTO `mall_admin` VALUES ('1', 'admin', '3d53b999d53504c6c3a4dec950d0deb3', 'cce536', '0', '1576502739', '127.0.0.1', '0', '0');
INSERT INTO `mall_admin` VALUES ('2', '', '68b9675b1a166838d316f71b2b47a3cb', '9d3357', '0', '1576513405', '127.0.0.1', '1576513405', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='节点表';

-- ----------------------------
-- Records of mall_node
-- ----------------------------
INSERT INTO `mall_node` VALUES ('1', 'admin', '', '', '后台管理', '1', null, '1', '0', '1', '1');
INSERT INTO `mall_node` VALUES ('2', 'rbac', '', '', 'Rbac用户权限管理', '1', null, '1', '1', '2', '1');
INSERT INTO `mall_node` VALUES ('6', 'memberMan', null, null, '会员管理', '1', null, '2', '0', '1', '1');
INSERT INTO `mall_node` VALUES ('7', 'memberList', null, null, '会员列表', '1', null, '1', '6', '2', '1');
INSERT INTO `mall_node` VALUES ('8', 'memberLev', null, null, '会员等级', '1', null, '2', '6', '2', '1');
INSERT INTO `mall_node` VALUES ('9', 'memberlist', '', '', '会员列表', '1', null, '1', '7', '3', '1');
INSERT INTO `mall_node` VALUES ('12', 'role', '', '', '角色列表', '1', null, '1', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('11', 'member', '', '', '管理员列表', '1', null, '1', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('13', 'node', '', '', '节点列表', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('14', 'adduser', '', '', '添加管理员', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('15', 'addrole', '', '', '添加角色', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('16', 'addrole', '', '', '添加节点', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('17', 'editrole', '', '', '编辑节点', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('18', 'delnode', '', '', '删除节点', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('19', 'editrole', '', '', '编辑角色', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('20', 'delrole', '', '', '删除角色', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('21', 'access', '', '', '配置权限', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('23', 'editUser', '', '', '管理员编辑', '1', null, '0', '2', '3', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of mall_role
-- ----------------------------
INSERT INTO `mall_role` VALUES ('3', 'Member', null, '1', '普通管理员');
INSERT INTO `mall_role` VALUES ('4', 'user1', null, '1', '普通管理员');
INSERT INTO `mall_role` VALUES ('5', 'user2', null, '1', '编辑');
INSERT INTO `mall_role` VALUES ('6', 'user3', null, '1', '普通管理员');
INSERT INTO `mall_role` VALUES ('7', 'user4', null, '1', '普通管理员');
INSERT INTO `mall_role` VALUES ('8', 'users', null, '1', '管理员');

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
