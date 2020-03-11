/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : mall

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2020-03-12 01:01:27
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
) ENGINE=MyISAM AUTO_INCREMENT=171 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of mall_access
-- ----------------------------
INSERT INTO `mall_access` VALUES ('47', '3', '14', '3', null);
INSERT INTO `mall_access` VALUES ('46', '3', '13', '3', null);
INSERT INTO `mall_access` VALUES ('45', '3', '12', '3', null);
INSERT INTO `mall_access` VALUES ('44', '3', '11', '3', null);
INSERT INTO `mall_access` VALUES ('167', '1', '25', '3', null);
INSERT INTO `mall_access` VALUES ('166', '1', '24', '3', null);
INSERT INTO `mall_access` VALUES ('165', '1', '14', '3', null);
INSERT INTO `mall_access` VALUES ('164', '1', '13', '3', null);
INSERT INTO `mall_access` VALUES ('163', '1', '12', '3', null);
INSERT INTO `mall_access` VALUES ('162', '1', '11', '3', null);
INSERT INTO `mall_access` VALUES ('161', '1', '10', '3', null);
INSERT INTO `mall_access` VALUES ('160', '1', '9', '3', null);
INSERT INTO `mall_access` VALUES ('159', '1', '8', '3', null);
INSERT INTO `mall_access` VALUES ('158', '1', '7', '3', null);
INSERT INTO `mall_access` VALUES ('157', '1', '6', '3', null);
INSERT INTO `mall_access` VALUES ('156', '1', '5', '3', null);
INSERT INTO `mall_access` VALUES ('155', '1', '4', '3', null);
INSERT INTO `mall_access` VALUES ('154', '1', '3', '3', null);
INSERT INTO `mall_access` VALUES ('153', '1', '2', '2', null);
INSERT INTO `mall_access` VALUES ('152', '1', '1', '1', null);
INSERT INTO `mall_access` VALUES ('125', '2', '27', '2', null);
INSERT INTO `mall_access` VALUES ('124', '2', '26', '1', null);
INSERT INTO `mall_access` VALUES ('123', '2', '29', '3', null);
INSERT INTO `mall_access` VALUES ('122', '2', '5', '3', null);
INSERT INTO `mall_access` VALUES ('121', '2', '4', '3', null);
INSERT INTO `mall_access` VALUES ('120', '2', '3', '3', null);
INSERT INTO `mall_access` VALUES ('119', '2', '2', '2', null);
INSERT INTO `mall_access` VALUES ('118', '2', '1', '1', null);
INSERT INTO `mall_access` VALUES ('151', '9', '28', '3', null);
INSERT INTO `mall_access` VALUES ('150', '9', '27', '2', null);
INSERT INTO `mall_access` VALUES ('149', '9', '26', '1', null);
INSERT INTO `mall_access` VALUES ('148', '9', '29', '3', null);
INSERT INTO `mall_access` VALUES ('147', '9', '5', '3', null);
INSERT INTO `mall_access` VALUES ('146', '9', '4', '3', null);
INSERT INTO `mall_access` VALUES ('145', '9', '3', '3', null);
INSERT INTO `mall_access` VALUES ('144', '9', '2', '2', null);
INSERT INTO `mall_access` VALUES ('126', '2', '28', '3', null);
INSERT INTO `mall_access` VALUES ('143', '9', '1', '1', null);
INSERT INTO `mall_access` VALUES ('168', '1', '26', '1', null);
INSERT INTO `mall_access` VALUES ('169', '1', '27', '2', null);
INSERT INTO `mall_access` VALUES ('170', '1', '28', '3', null);

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
INSERT INTO `mall_admin` VALUES ('1', 'admin', 'e14d86bc21c071979bb4f22f18d29696', 'e80adc', '1', '1583934523', '127.0.0.1', '0', '0');
INSERT INTO `mall_admin` VALUES ('5', 'user', '46a2e3c28812367a6d3eea9de9cc3112', '70ee55', '1', '1578882750', '127.0.0.1', '1577777423', '1578364990');

-- ----------------------------
-- Table structure for mall_config_group
-- ----------------------------
DROP TABLE IF EXISTS `mall_config_group`;
CREATE TABLE `mall_config_group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL DEFAULT '' COMMENT '配置组英文名',
  `group_title` varchar(200) NOT NULL DEFAULT '' COMMENT '配置组中文名',
  `group_sort` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '排序',
  `group_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0表示关闭，1表示开启',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `add_user_id` int(10) NOT NULL DEFAULT '0' COMMENT '添加用户',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_config_group
-- ----------------------------

-- ----------------------------
-- Table structure for mall_log
-- ----------------------------
DROP TABLE IF EXISTS `mall_log`;
CREATE TABLE `mall_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `log_user` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `log_info` varchar(4000) NOT NULL DEFAULT '' COMMENT '日志内容',
  `log_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '日志时间',
  `log_ip` varchar(50) NOT NULL DEFAULT '0.0.0.0' COMMENT '日志ip',
  `log_type` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '日志类型',
  `log_controller` varchar(20) DEFAULT '' COMMENT '日志控制器',
  `log_action` varchar(20) DEFAULT '' COMMENT '日志方法',
  `param` varchar(4000) DEFAULT '' COMMENT '日志参数',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_log
-- ----------------------------
INSERT INTO `mall_log` VALUES ('1', '1', 'admin记录日志成功', '1578886383', '127.0.0.1', '1', 'Index', 'logout', '');
INSERT INTO `mall_log` VALUES ('2', '5', 'user注销成功', '1578886381', '127.0.0.1', '1', 'Index', 'logout', '');
INSERT INTO `mall_log` VALUES ('3', '1', 'admin记录日志成功', '1578886391', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('4', '1', 'admin登录成功', '1583848314', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('5', '1', '角色名称：超级管理员编辑成功', '1583848491', '127.0.0.1', '2', 'Rbac', 'access', '');
INSERT INTO `mall_log` VALUES ('6', '1', '节点日志列表添加成功', '1583851554', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('7', '1', '节点日志列表添加成功', '1583851569', '127.0.0.1', '2', 'Rbac', 'delnode', '');
INSERT INTO `mall_log` VALUES ('8', '1', '节点日志列表添加成功', '1583851595', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('9', '1', 'admin登录成功', '1583934523', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('10', '1', '节点商品管理配置成功', '1583940455', '127.0.0.1', '2', 'Rbac', 'editnode', '');
INSERT INTO `mall_log` VALUES ('11', '1', '节点系统设置添加成功', '1583940484', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('12', '1', '节点内容管理添加成功', '1583940507', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('13', '1', '节点配置组管理添加成功', '1583940756', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('14', '1', '节点网站配置添加成功', '1583940802', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('15', '1', '节点扩展配置添加成功', '1583940822', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('16', '1', '节点配置组列表添加成功', '1583941092', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('17', '1', '节点添加配置组添加成功', '1583941109', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('18', '1', '节点编辑配置组添加成功', '1583941133', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('19', '1', '节点删除配置组添加成功', '1583941154', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('20', '1', '节点添加添加成功', '1583941462', '127.0.0.1', '2', 'Rbac', 'delnode', '');
INSERT INTO `mall_log` VALUES ('21', '1', '节点特殊添加成功', '1583941467', '127.0.0.1', '2', 'Rbac', 'delnode', '');
INSERT INTO `mall_log` VALUES ('22', '1', '节点参数列表添加成功', '1583941534', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('23', '1', '节点添加参数添加成功', '1583941564', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('24', '1', '节点编辑参数添加成功', '1583941580', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('25', '1', '节点删除参数添加成功', '1583941620', '127.0.0.1', '2', 'Rbac', 'addnode', '');

-- ----------------------------
-- Table structure for mall_log_type
-- ----------------------------
DROP TABLE IF EXISTS `mall_log_type`;
CREATE TABLE `mall_log_type` (
  `type_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `type_name` varchar(50) NOT NULL DEFAULT '' COMMENT '类型名称',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_log_type
-- ----------------------------
INSERT INTO `mall_log_type` VALUES ('1', '登陆登出', '1578886391');
INSERT INTO `mall_log_type` VALUES ('2', 'Rbac权限管理', '1578886391');

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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='节点表';

-- ----------------------------
-- Records of mall_node
-- ----------------------------
INSERT INTO `mall_node` VALUES ('1', 'admin', '', '', '后台管理', '1', null, '1', '0', '1', '1');
INSERT INTO `mall_node` VALUES ('2', 'rbac', '', '', 'Rbac用户权限管理', '1', null, '1', '1', '2', '1');
INSERT INTO `mall_node` VALUES ('24', 'delUser', '', '', '删除管理员', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('25', 'editPass', '', '', '管理员重置密码', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('26', 'Home', '', '', '前台信息管理', '1', null, '2', '0', '1', '1');
INSERT INTO `mall_node` VALUES ('3', 'role', '', '', '角色列表', '1', null, '1', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('4', 'user', '', '', '管理员列表', '1', null, '1', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('5', 'node', '', '', '节点列表', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('6', 'addUser', '', '', '添加管理员', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('7', 'addRole', '', '', '添加角色', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('8', 'addNode', '', '', '添加节点', '1', null, '0', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('9', 'editNode', '', '', '编辑节点', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('10', 'delNode', '', '', '删除节点', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('11', 'editRole', '', '', '编辑角色', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('12', 'delRole', '', '', '删除角色', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('13', 'access', '', '', '配置权限', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('14', 'editUser', '', '', '编辑管理员', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('41', 'index', '', '', '参数列表', '1', null, '1', '35', '3', '0');
INSERT INTO `mall_node` VALUES ('29', 'userPass', '', '', '用户修改密码', '1', null, '0', '2', '3', '0');
INSERT INTO `mall_node` VALUES ('31', 'log', '', '', '日志列表', '1', null, '1', '2', '3', '1');
INSERT INTO `mall_node` VALUES ('32', 'System', '', '', '系统设置', '1', null, '3', '0', '1', '1');
INSERT INTO `mall_node` VALUES ('33', 'Content', '', '', '内容管理', '1', null, '4', '0', '1', '1');
INSERT INTO `mall_node` VALUES ('34', 'ConfigGroup', '', '', '配置组管理', '1', null, '1', '32', '2', '1');
INSERT INTO `mall_node` VALUES ('35', 'Config', '', '', '网站配置', '1', null, '1', '32', '2', '1');
INSERT INTO `mall_node` VALUES ('36', 'System', '', '', '扩展配置', '1', null, '1', '32', '2', '1');
INSERT INTO `mall_node` VALUES ('37', 'index', '', '', '配置组列表', '1', null, '1', '34', '3', '1');
INSERT INTO `mall_node` VALUES ('38', 'add', '', '', '添加配置组', '1', null, '1', '34', '3', '1');
INSERT INTO `mall_node` VALUES ('39', 'edit', '', '', '编辑配置组', '1', null, '0', '34', '3', '0');
INSERT INTO `mall_node` VALUES ('40', 'del', '', '', '删除配置组', '1', null, '0', '34', '3', '0');
INSERT INTO `mall_node` VALUES ('42', 'add', '', '', '添加参数', '1', null, '0', '35', '3', '0');
INSERT INTO `mall_node` VALUES ('43', 'edit', '', '', '编辑参数', '1', null, '0', '35', '3', '0');
INSERT INTO `mall_node` VALUES ('44', 'del', '', '', '删除参数', '1', null, '0', '35', '3', '0');

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
INSERT INTO `mall_role` VALUES ('9', 'manager', null, '1', '普通管理员');

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
INSERT INTO `mall_role_user` VALUES ('9', '5');
