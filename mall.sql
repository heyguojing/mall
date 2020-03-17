/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : mall

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2020-03-18 00:00:45
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
) ENGINE=MyISAM AUTO_INCREMENT=234 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of mall_access
-- ----------------------------
INSERT INTO `mall_access` VALUES ('47', '3', '14', '3', null);
INSERT INTO `mall_access` VALUES ('46', '3', '13', '3', null);
INSERT INTO `mall_access` VALUES ('45', '3', '12', '3', null);
INSERT INTO `mall_access` VALUES ('44', '3', '11', '3', null);
INSERT INTO `mall_access` VALUES ('189', '1', '34', '2', null);
INSERT INTO `mall_access` VALUES ('188', '1', '32', '1', null);
INSERT INTO `mall_access` VALUES ('187', '1', '26', '1', null);
INSERT INTO `mall_access` VALUES ('186', '1', '25', '3', null);
INSERT INTO `mall_access` VALUES ('185', '1', '24', '3', null);
INSERT INTO `mall_access` VALUES ('184', '1', '14', '3', null);
INSERT INTO `mall_access` VALUES ('183', '1', '13', '3', null);
INSERT INTO `mall_access` VALUES ('182', '1', '12', '3', null);
INSERT INTO `mall_access` VALUES ('181', '1', '11', '3', null);
INSERT INTO `mall_access` VALUES ('180', '1', '10', '3', null);
INSERT INTO `mall_access` VALUES ('179', '1', '9', '3', null);
INSERT INTO `mall_access` VALUES ('178', '1', '8', '3', null);
INSERT INTO `mall_access` VALUES ('177', '1', '7', '3', null);
INSERT INTO `mall_access` VALUES ('176', '1', '6', '3', null);
INSERT INTO `mall_access` VALUES ('175', '1', '5', '3', null);
INSERT INTO `mall_access` VALUES ('174', '1', '4', '3', null);
INSERT INTO `mall_access` VALUES ('228', '2', '34', '2', null);
INSERT INTO `mall_access` VALUES ('227', '2', '32', '1', null);
INSERT INTO `mall_access` VALUES ('226', '2', '26', '1', null);
INSERT INTO `mall_access` VALUES ('225', '2', '29', '3', null);
INSERT INTO `mall_access` VALUES ('224', '2', '5', '3', null);
INSERT INTO `mall_access` VALUES ('223', '2', '4', '3', null);
INSERT INTO `mall_access` VALUES ('222', '2', '3', '3', null);
INSERT INTO `mall_access` VALUES ('221', '2', '2', '2', null);
INSERT INTO `mall_access` VALUES ('216', '9', '34', '2', null);
INSERT INTO `mall_access` VALUES ('215', '9', '32', '1', null);
INSERT INTO `mall_access` VALUES ('214', '9', '26', '1', null);
INSERT INTO `mall_access` VALUES ('213', '9', '29', '3', null);
INSERT INTO `mall_access` VALUES ('212', '9', '5', '3', null);
INSERT INTO `mall_access` VALUES ('211', '9', '4', '3', null);
INSERT INTO `mall_access` VALUES ('210', '9', '3', '3', null);
INSERT INTO `mall_access` VALUES ('209', '9', '2', '2', null);
INSERT INTO `mall_access` VALUES ('220', '2', '1', '1', null);
INSERT INTO `mall_access` VALUES ('208', '9', '1', '1', null);
INSERT INTO `mall_access` VALUES ('173', '1', '3', '3', null);
INSERT INTO `mall_access` VALUES ('172', '1', '2', '2', null);
INSERT INTO `mall_access` VALUES ('171', '1', '1', '1', null);
INSERT INTO `mall_access` VALUES ('190', '1', '37', '3', null);
INSERT INTO `mall_access` VALUES ('191', '1', '38', '3', null);
INSERT INTO `mall_access` VALUES ('192', '1', '39', '3', null);
INSERT INTO `mall_access` VALUES ('193', '1', '40', '3', null);
INSERT INTO `mall_access` VALUES ('194', '1', '45', '3', null);
INSERT INTO `mall_access` VALUES ('195', '1', '46', '3', null);
INSERT INTO `mall_access` VALUES ('196', '1', '47', '3', null);
INSERT INTO `mall_access` VALUES ('197', '1', '35', '2', null);
INSERT INTO `mall_access` VALUES ('198', '1', '41', '3', null);
INSERT INTO `mall_access` VALUES ('199', '1', '42', '3', null);
INSERT INTO `mall_access` VALUES ('200', '1', '43', '3', null);
INSERT INTO `mall_access` VALUES ('201', '1', '44', '3', null);
INSERT INTO `mall_access` VALUES ('202', '1', '48', '3', null);
INSERT INTO `mall_access` VALUES ('203', '1', '49', '3', null);
INSERT INTO `mall_access` VALUES ('204', '1', '50', '3', null);
INSERT INTO `mall_access` VALUES ('205', '1', '51', '3', null);
INSERT INTO `mall_access` VALUES ('206', '1', '36', '2', null);
INSERT INTO `mall_access` VALUES ('207', '1', '33', '1', null);
INSERT INTO `mall_access` VALUES ('217', '9', '35', '2', null);
INSERT INTO `mall_access` VALUES ('218', '9', '36', '2', null);
INSERT INTO `mall_access` VALUES ('219', '9', '33', '1', null);
INSERT INTO `mall_access` VALUES ('229', '2', '37', '3', null);
INSERT INTO `mall_access` VALUES ('230', '2', '35', '2', null);
INSERT INTO `mall_access` VALUES ('231', '2', '41', '3', null);
INSERT INTO `mall_access` VALUES ('232', '2', '36', '2', null);
INSERT INTO `mall_access` VALUES ('233', '2', '33', '1', null);

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
INSERT INTO `mall_admin` VALUES ('1', 'admin', 'e14d86bc21c071979bb4f22f18d29696', 'e80adc', '1', '1584351742', '127.0.0.1', '0', '0');
INSERT INTO `mall_admin` VALUES ('5', 'user', '46a2e3c28812367a6d3eea9de9cc3112', '70ee55', '1', '1584351721', '127.0.0.1', '1577777423', '1578364990');

-- ----------------------------
-- Table structure for mall_config
-- ----------------------------
DROP TABLE IF EXISTS `mall_config`;
CREATE TABLE `mall_config` (
  `config_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) NOT NULL COMMENT '配置组id',
  `config_name` varchar(100) NOT NULL DEFAULT '' COMMENT '配置组英文名称',
  `config_title` varchar(100) NOT NULL DEFAULT '' COMMENT '配置组中文名称',
  `config_message` varchar(200) NOT NULL DEFAULT '' COMMENT '配置参数提示信息',
  `config_value` text COMMENT '配置参数值',
  `config_type` enum('text','radio','textarea','file','select') NOT NULL DEFAULT 'text' COMMENT '配置参数类型',
  `config_info` varchar(200) NOT NULL DEFAULT '' COMMENT '配置参数',
  `config_sort` smallint(6) NOT NULL DEFAULT '1' COMMENT '配置参数排序',
  `config_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '开启状态0表示关闭1表示开启',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `add_user_id` int(10) NOT NULL DEFAULT '0' COMMENT '添加者id',
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_config
-- ----------------------------
INSERT INTO `mall_config` VALUES ('1', '1', 'WEB_TITLE', '网站名称', '网站名称', '多店铺商城', 'text', '', '1', '1', '1584454819', '1');
INSERT INTO `mall_config` VALUES ('2', '1', 'WEB_COMPANY', '公司名称', '公司名称', '公司名称', 'text', '', '1', '1', '1584454820', '1');
INSERT INTO `mall_config` VALUES ('3', '1', 'DOMAIN_NAME', '网站域名', '网站域名', 'https://www.phpdecode.cn', 'text', '', '1', '1', '1584454821', '1');
INSERT INTO `mall_config` VALUES ('4', '1', 'RECORD', '技术支持', '技术支持', 'qq：994743720  新月  php web', 'text', '', '1', '1', '1584454822', '1');
INSERT INTO `mall_config` VALUES ('5', '1', 'ICP', 'ICP备案号', 'ICP备案号', '备案号：蜀ICP备19023826号', 'text', '', '1', '1', '1584454823', '1');
INSERT INTO `mall_config` VALUES ('6', '1', 'COPY', '网站版权信息', '网站版权信息', '郭靖  https://www.phpdecode.cn ', 'text', '', '1', '1', '1584454824', '1');
INSERT INTO `mall_config` VALUES ('7', '1', 'WEB_ON', '是否开启网站', '是否开启网站', '1', 'radio', '1|开启,0|关闭', '1', '1', '1584454836', '1');
INSERT INTO `mall_config` VALUES ('8', '1', 'WEB_COUNTCODE', '网站第三方统计代码', '网站第三方统计代码', '                    <div class=\"copyright-txt\">\r\n                        备案号：蜀ICP备19023826号   \r\n                    </div>\r', 'textarea', '', '1', '1', '1584454837', '1');
INSERT INTO `mall_config` VALUES ('9', '1', 'VERSION', '系统版本', '系统版本', 'beta 1.0', 'text', '', '1', '1', '1584454840', '1');
INSERT INTO `mall_config` VALUES ('10', '2', 'WEB_KEYWORDS', '网站关键字', '网站关键字', 'php开发，web', 'text', '', '1', '1', '1584454841', '1');
INSERT INTO `mall_config` VALUES ('11', '2', 'WEB_DESCRIPTION', '网站描述', '网站描述', 'php thinkphp web html js bootstrap', 'text', '', '1', '1', '1584454842', '1');
INSERT INTO `mall_config` VALUES ('12', '2', 'REG_ON', '是否开启注册', '是否开启注册', '1', 'radio', '1|开启,0|关闭', '1', '1', '1584454843', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_config_group
-- ----------------------------
INSERT INTO `mall_config_group` VALUES ('1', 'WEB_SITE', '站点信息', '1', '1', '1584114299', '1');
INSERT INTO `mall_config_group` VALUES ('2', 'BASIC_SITE', '基本设置', '2', '1', '1584153749', '1');
INSERT INTO `mall_config_group` VALUES ('3', 'WEB_CODE', '验证码设置', '3', '1', '1584153770', '1');
INSERT INTO `mall_config_group` VALUES ('4', 'WEB_UPLOAD', '上传设置', '4', '1', '1584153922', '1');
INSERT INTO `mall_config_group` VALUES ('5', 'WEB_SHOW', '显示设置', '5', '1', '1584153946', '1');
INSERT INTO `mall_config_group` VALUES ('6', 'WEB_MOBILE_API', '网站手机验证接口', '6', '1', '1584154041', '1');
INSERT INTO `mall_config_group` VALUES ('7', 'WEB_EMAIL', '邮箱设置', '7', '1', '1584154080', '1');
INSERT INTO `mall_config_group` VALUES ('8', 'WEB_ORDER', '订单设置', '8', '1', '1584154107', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

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
INSERT INTO `mall_log` VALUES ('26', '1', 'admin登录成功', '1584082381', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('27', '1', '配置组站点信息添加成功', '1584114299', '127.0.0.1', '3', 'ConfigGroup', 'add', '');
INSERT INTO `mall_log` VALUES ('28', '1', 'admin登录成功', '1584153086', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('29', '1', '配置组基本设置添加成功', '1584153749', '127.0.0.1', '3', 'ConfigGroup', 'add', '');
INSERT INTO `mall_log` VALUES ('30', '1', '配置组验证码设置添加成功', '1584153770', '127.0.0.1', '3', 'ConfigGroup', 'add', '');
INSERT INTO `mall_log` VALUES ('31', '1', '配置组上传设置添加成功', '1584153922', '127.0.0.1', '3', 'ConfigGroup', 'add', '');
INSERT INTO `mall_log` VALUES ('32', '1', '配置组显示设置添加成功', '1584153946', '127.0.0.1', '3', 'ConfigGroup', 'add', '');
INSERT INTO `mall_log` VALUES ('33', '1', '配置组网站手机验证接口添加成功', '1584154041', '127.0.0.1', '3', 'ConfigGroup', 'add', '');
INSERT INTO `mall_log` VALUES ('34', '1', '配置组邮箱设置添加成功', '1584154080', '127.0.0.1', '3', 'ConfigGroup', 'add', '');
INSERT INTO `mall_log` VALUES ('35', '1', '配置组订单设置添加成功', '1584154107', '127.0.0.1', '3', 'ConfigGroup', 'add', '');
INSERT INTO `mall_log` VALUES ('36', '1', 'admin登录成功', '1584321948', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('37', '1', '配置组：站点信息编辑成功', '1584321962', '127.0.0.1', '3', 'ConfigGroup', 'edit', '');
INSERT INTO `mall_log` VALUES ('38', '1', '配置组：站点信息编辑成功', '1584343418', '127.0.0.1', '3', 'ConfigGroup', 'edit', '');
INSERT INTO `mall_log` VALUES ('39', '1', '配置组：站点信息编辑成功', '1584343429', '127.0.0.1', '3', 'ConfigGroup', 'edit', '');
INSERT INTO `mall_log` VALUES ('40', '1', '角色名称：超级管理员编辑成功', '1584351385', '127.0.0.1', '2', 'Rbac', 'access', '');
INSERT INTO `mall_log` VALUES ('41', '1', 'admin注销成功', '1584351406', '127.0.0.1', '1', 'Index', 'logout', '');
INSERT INTO `mall_log` VALUES ('42', '5', 'user登录成功', '1584351421', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('43', '5', 'user注销成功', '1584351453', '127.0.0.1', '1', 'Index', 'logout', '');
INSERT INTO `mall_log` VALUES ('44', '1', 'admin登录成功', '1584351463', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('45', '1', '角色名称：普通管理员编辑成功', '1584351492', '127.0.0.1', '2', 'Rbac', 'access', '');
INSERT INTO `mall_log` VALUES ('46', '1', '角色名称：编辑编辑成功', '1584351515', '127.0.0.1', '2', 'Rbac', 'access', '');
INSERT INTO `mall_log` VALUES ('47', '1', 'admin注销成功', '1584351714', '127.0.0.1', '1', 'Index', 'logout', '');
INSERT INTO `mall_log` VALUES ('48', '5', 'user登录成功', '1584351721', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('49', '5', 'user注销成功', '1584351734', '127.0.0.1', '1', 'Index', 'logout', '');
INSERT INTO `mall_log` VALUES ('50', '1', 'admin登录成功', '1584351742', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('51', '1', '配置组公司名称添加成功', '1584454820', '127.0.0.1', '3', 'Config', 'add', '');

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
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='节点表';

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
INSERT INTO `mall_node` VALUES ('45', 'ajaxGroupName', null, null, 'ajax更新组英文', '1', null, '0', '34', '3', '0');
INSERT INTO `mall_node` VALUES ('46', 'ajaxGroupTitle', null, null, 'ajax更新组中文', '1', null, '0', '34', '3', '0');
INSERT INTO `mall_node` VALUES ('47', 'ajaxRecommand', null, null, 'ajax异步更新相关属性', '1', null, '0', '34', '3', '0');
INSERT INTO `mall_node` VALUES ('48', 'ajaxConfigName', null, null, 'ajax验证参数英文名称', '1', null, '0', '35', '3', '0');
INSERT INTO `mall_node` VALUES ('49', 'ajaxGroupTitle', null, null, 'ajax验证参数中文名称', '1', null, '0', '35', '3', '0');
INSERT INTO `mall_node` VALUES ('50', 'ajaxRecommand', null, null, 'ajax异步更新相关属性', '1', null, '0', '35', '3', '0');
INSERT INTO `mall_node` VALUES ('51', 'webConfig', null, null, '网站配置', '1', null, '0', '35', '3', '1');

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
