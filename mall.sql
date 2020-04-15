/*
Navicat MySQL Data Transfer

Source Server         : php
Source Server Version : 50721
Source Host           : localhost:3306
Source Database       : mall

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2020-04-15 17:08:52
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
INSERT INTO `mall_admin` VALUES ('1', 'admin', 'e14d86bc21c071979bb4f22f18d29696', 'e80adc', '1', '1586914967', '127.0.0.1', '0', '0');
INSERT INTO `mall_admin` VALUES ('5', 'user', '46a2e3c28812367a6d3eea9de9cc3112', '70ee55', '1', '1584351721', '127.0.0.1', '1577777423', '1578364990');

-- ----------------------------
-- Table structure for mall_attr
-- ----------------------------
DROP TABLE IF EXISTS `mall_attr`;
CREATE TABLE `mall_attr` (
  `attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性id',
  `type_id` int(10) NOT NULL DEFAULT '0' COMMENT '类型id',
  `attr_name` varchar(50) NOT NULL DEFAULT '' COMMENT '属性名称',
  `attr_value` varchar(255) NOT NULL DEFAULT '' COMMENT '属性值',
  `attr_unit` varchar(10) NOT NULL DEFAULT '' COMMENT '属性单位',
  `attr_search` tinyint(1) DEFAULT '0' COMMENT '是否支持搜索0表示支持1表示支持',
  `attr_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '控件类型1单选2多选3下拉4复选框',
  `attr_sort` int(10) NOT NULL DEFAULT '1' COMMENT '控件排序',
  `attr_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开启状态0表示关闭1表示开启',
  `attr_style` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0表示参数1表示规格',
  PRIMARY KEY (`attr_id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商品属性/规格表';

-- ----------------------------
-- Records of mall_attr
-- ----------------------------
INSERT INTO `mall_attr` VALUES ('1', '1', '颜色', '银色，黑色，金色', '', '0', '1', '1', '1', '1');
INSERT INTO `mall_attr` VALUES ('2', '1', '版本', '国产，美国进口', '', '0', '2', '2', '1', '1');
INSERT INTO `mall_attr` VALUES ('3', '2', '品牌', '菊乐，新希望', '', '0', '1', '1', '1', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_config
-- ----------------------------
INSERT INTO `mall_config` VALUES ('1', '1', 'WEB_TITLE', '网站名称', '网站名称', '王多鱼科技有限公司', 'text', '', '1', '1', '1584454819', '1');
INSERT INTO `mall_config` VALUES ('2', '1', 'WEB_COMPANY', '公司名称', '公司名称', '王多鱼科技有限公司', 'text', '', '1', '1', '1584454820', '1');
INSERT INTO `mall_config` VALUES ('3', '1', 'DOMAIN_NAME', '网站域名', '网站域名', 'https://www.phpdecode.cn', 'text', '', '1', '1', '1584454821', '1');
INSERT INTO `mall_config` VALUES ('4', '1', 'RECORD', '技术支持', '技术支持', 'qq：994743720  新月  php web', 'text', '', '1', '1', '1584454822', '1');
INSERT INTO `mall_config` VALUES ('5', '1', 'ICP', 'ICP备案号', 'ICP备案号', '蜀ICP备19023826号', 'text', '', '1', '1', '1584454823', '1');
INSERT INTO `mall_config` VALUES ('6', '1', 'COPY', '网站版权信息', '网站版权信息', '郭靖', 'text', '', '1', '1', '1584454824', '1');
INSERT INTO `mall_config` VALUES ('7', '1', 'WEB_ON', '是否开启网站', '是否开启网站', '1', 'radio', '1|开启,0|关闭', '1', '1', '1584454836', '1');
INSERT INTO `mall_config` VALUES ('8', '1', 'WEB_COUNTCODE', '网站第三方统计代码', '网站第三方统计代码', '                    <div class=\"copyright-txt\">\r\n                        备案号：蜀ICP备19023826号   \r\n                    </div>\r\n', 'textarea', '', '1', '1', '1584454837', '1');
INSERT INTO `mall_config` VALUES ('9', '1', 'VERSION', '系统版本', '系统版本', '1.0版', 'text', '', '1', '1', '1584454840', '1');
INSERT INTO `mall_config` VALUES ('10', '2', 'WEB_KEYWORDS', '网站关键字', '网站关键字', 'php开发，web', 'text', '', '1', '1', '1584454841', '1');
INSERT INTO `mall_config` VALUES ('11', '2', 'WEB_DESCRIPTION', '网站描述', '网站描述', 'php thinkphp web html js bootstrap', 'text', '', '1', '1', '1584454842', '1');
INSERT INTO `mall_config` VALUES ('12', '2', 'REG_ON', '是否开启注册', '是否开启注册', '1', 'radio', '1|开启,0|关闭', '1', '1', '1584454843', '1');
INSERT INTO `mall_config` VALUES ('13', '2', 'WEB_IP_STATE', '是否限制用户登录ip', '是否限制用户登录ip', '0', 'radio', '1|开启,0|关闭', '1', '1', '1584495105', '1');
INSERT INTO `mall_config` VALUES ('14', '2', 'REG_POINT', '注册积分', '注册积分', '10', 'text', '', '1', '1', '1584495379', '1');
INSERT INTO `mall_config` VALUES ('15', '2', 'WEB_MAIN_DOMAIN', '网站主域名前缀', '网站主域名前缀', 'mall', 'text', '', '1', '1', '1584495380', '1');
INSERT INTO `mall_config` VALUES ('16', '3', 'CODE_CURVE', '是否画混淆曲线', '是否画混淆曲线', '1', 'radio', '1|开启,0|关闭', '1', '1', '1584495381', '1');
INSERT INTO `mall_config` VALUES ('17', '3', 'CODE_LEN', '验证码长度', '验证码长度', '4', 'text', '', '1', '1', '1584495382', '1');
INSERT INTO `mall_config` VALUES ('18', '3', 'SHOW_VERIFY', '后台是否开启验证码', '后台是否开启验证码', '1', 'radio', '1|开启,0|关闭', '1', '1', '1584495383', '1');
INSERT INTO `mall_config` VALUES ('19', '3', 'CODE_NOISE', '是否添加杂点', '是否添加杂点', '1', 'radio', '1|开启,0|关闭', '1', '1', '1584495384', '1');
INSERT INTO `mall_config` VALUES ('20', '3', 'HOME_SHOW_VERIFY', '前台是否开启验证码', '前台是否开启验证码', '1', 'radio', '1|开启,0|关闭', '1', '1', '1584495390', '1');
INSERT INTO `mall_config` VALUES ('21', '3', 'CODE_FONT_SIZE', '验证码字体大小', '验证码字体大小', '30', 'text', '', '1', '1', '1584495391', '1');
INSERT INTO `mall_config` VALUES ('22', '4', 'UPLOAD_PATH', '上传路径', '上传路径', './upload/', 'text', '', '1', '1', '1584495392', '1');
INSERT INTO `mall_config` VALUES ('23', '4', 'UPLOAD_TYPE', '上传类型', '上传类型', 'jpg,png,jpeg', 'text', '', '1', '1', '1584495393', '1');
INSERT INTO `mall_config` VALUES ('24', '5', 'WEB_STYLE', '网站主题模板', '主题设置中修改生效', 'default', 'text', '', '1', '1', '1584495394', '1');
INSERT INTO `mall_config` VALUES ('25', '5', 'WEB_STORE_DIR', '店铺目录', '店铺目录', 'store', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('26', '6', 'SMS_ACCOUNT_SID', '短信账号id', '短信账号id', 'a1979e260cf49cbec7ad31f99734ed93', 'text', '', '1', '1', '1584495396', '1');
INSERT INTO `mall_config` VALUES ('27', '6', 'SMS_TOKEN', '短信token认证', '短信token认证', '25798be441257d1ea1a6b105664c3840', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('28', '6', 'SMS_APP_ID', '短信appid', '短信appid', '9e72c6afaa5748d09cf2035258f613ed', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('29', '7', 'EMAIL_SMTP_DEBUG', '启用SMTP调试', '0 = 关闭 (生产使用) 1 = 客户端的消息 2 = 客户端和服务端的消息', '0', 'radio', '0|关闭,1|客户端的消息,2|客户端和服务端的消息', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('30', '7', 'EMAIL_DEBUG_OUTPUT', '请求HTML友好的调试输出', '请求HTML友好的调试输出', 'html', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('31', '7', 'EMAIL_HOST', '邮箱主机', '设置邮件服务器的主机名', 'smtp.qq.com', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('32', '7', 'EMAIL_SMTP_SECURE', 'SMTP客户端链接方式', 'SMTP客户端链接方式', 'ssl', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('33', '7', 'EMAIL_PORT', '远程服务器端口号', '远程服务器端口号', '465', 'text', '465', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('34', '7', 'EMAIL_SMTP_AUTH', '是否使用SMTP认证', '是否使用SMTP认证', '1', 'radio', '1|开启,0|关闭', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('35', '7', 'EMAIL_USERNAME', '用于SMTP身份验证的用户名', '用于SMTP身份验证的用户名', '994743720@qq.com', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('36', '7', 'EMAIL_PASSWORD', 'SMTP身份验证的密码', '用于SMTP身份验证的密码 (非登陆密码哟)', 'bdrufxdqjreybceb', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('37', '7', 'EMAIL_SETFROM_ADDRESS', '消息是从谁发送', '设置消息是从谁发送 (填写SMTP身份验证的用户名)', '994743720@qq.com', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('38', '7', 'EMAIL_SETFROM_NAME', '设置消息是从谁发送 ', '设置消息是从谁发送 (填写SMTP身份验证的名称)', 'phpdecode.cn', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('39', '7', 'EMAIL_ADDREPLY_TO_ADDRESS', '设置回复邮箱地址', '设置回复邮箱地址', '994743720@qq.com', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('40', '7', 'EMAIL_ADDREPLY_TO_NAME', '设置回复邮箱用户名', '设置回复邮箱用户名', 'jinggithub', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('41', '8', 'ORDER_OVER_PAY', '订单超时付款时间', '订单超时付款时间', '86400*30', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('42', '8', 'ORDER_CONFIRM_PAY', '订单确认收货时间', '订单确认收货时间', '86400*30', 'text', '', '1', '1', '1584495395', '1');
INSERT INTO `mall_config` VALUES ('43', '8', 'ORDER_RETURN_TIME', '订单退款时间', '订单退款时间', '86400*30', 'text', '', '1', '1', '1584495395', '1');

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
  PRIMARY KEY (`group_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

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
INSERT INTO `mall_config_group` VALUES ('9', 'WEB_STYLE', '网站主题', '9', '1', '1584154180', '1');

-- ----------------------------
-- Table structure for mall_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `mall_goods_attr`;
CREATE TABLE `mall_goods_attr` (
  `goods_attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `goods_id` int(10) NOT NULL DEFAULT '0' COMMENT '商品id',
  `attr_id` int(10) DEFAULT '0' COMMENT '属性id/规格id',
  `attr_value` varchar(255) NOT NULL DEFAULT '' COMMENT '属性值/规格值',
  `attr_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0表示参数1表示规格',
  `attr_pic` varchar(255) DEFAULT '' COMMENT '规格图片',
  `attr_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1正常0删除',
  PRIMARY KEY (`goods_attr_id`),
  KEY `type_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COMMENT='商品属性表';

-- ----------------------------
-- Records of mall_goods_attr
-- ----------------------------

-- ----------------------------
-- Table structure for mall_goods_class
-- ----------------------------
DROP TABLE IF EXISTS `mall_goods_class`;
CREATE TABLE `mall_goods_class` (
  `class_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_name` varchar(100) NOT NULL DEFAULT '' COMMENT '分类名称',
  `class_keywords` varchar(200) NOT NULL DEFAULT '' COMMENT '分类关键词',
  `class_desc` varchar(200) NOT NULL DEFAULT '' COMMENT '分类描述',
  `class_pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `class_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0表示关闭1表示开启',
  `class_is_nav` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0表示不显示1表示显示',
  `class_letter` varchar(10) NOT NULL DEFAULT '' COMMENT '首字母',
  `add_user_id` int(10) NOT NULL DEFAULT '0' COMMENT '添加者',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `type_id` int(10) NOT NULL DEFAULT '0' COMMENT '类型id',
  `class_sort` int(10) NOT NULL DEFAULT '1' COMMENT '分类排序',
  `class_url` varchar(200) DEFAULT '' COMMENT '链接地址',
  PRIMARY KEY (`class_id`),
  KEY `class_pid` (`class_pid`),
  KEY `type_id` (`type_id`),
  KEY `class_sort` (`class_sort`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COMMENT='商品分类表';

-- ----------------------------
-- Records of mall_goods_class
-- ----------------------------
INSERT INTO `mall_goods_class` VALUES ('1', '手机/运营商/数码', 'sdfsss', 'sdfs', '0', '1', '0', '', '1', '1543931305', '1', '3', 'sdfsd');
INSERT INTO `mall_goods_class` VALUES ('2', '手机通讯', '', '', '1', '1', '1', '', '1', '1543932245', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('3', '手机', '手机', 'ss', '2', '1', '1', '', '1', '1543935607', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('4', '游戏手机', '游戏手机', '', '2', '1', '1', '', '1', '1543935976', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('5', '运营商', '运营商', '', '1', '1', '1', '', '1', '1543935995', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('6', '手机配件', '', '', '1', '1', '1', '', '1', '1543936036', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('7', '家用电器', '', '', '0', '1', '1', '', '1', '1547910463', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('8', '电视', '', '', '7', '1', '1', '', '1', '1547910491', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('9', '超薄电视', '超薄电视', '', '8', '1', '1', '', '1', '1547910516', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('10', '空调', '', '', '7', '1', '1', '', '1', '1552748834', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('11', 'OLED电视', '', '', '8', '1', '1', '', '1', '1552748901', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('12', '曲面电视', '', '', '8', '1', '1', '', '1', '1552748935', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('13', '4K超清电视', '4K超清电视', '', '8', '1', '1', '', '1', '1552749233', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('14', '55英寸', '', '', '8', '1', '1', '', '1', '1552749259', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('15', '65英寸', '65英寸', '', '8', '1', '1', '', '1', '1552749275', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('16', '电视配件', '', '', '8', '1', '1', '', '1', '1552749293', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('17', '壁挂式空调', '壁挂式空调', '', '10', '1', '1', '', '1', '1552750015', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('18', '柜式空调', '柜式空调', '', '10', '1', '1', '', '1', '1552750053', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('19', '中央空调', '中央空调', '', '10', '1', '1', '', '1', '1552750076', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('20', '一级能效空调', '一级能效空调', '', '10', '1', '1', '', '1', '1552750089', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('21', '变频空调', '变频空调', '', '10', '1', '1', '', '1', '1552750106', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('22', '1.5匹空调', '1.5匹空调', '', '10', '1', '1', '', '1', '1552750124', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('23', '洗衣机', '洗衣机', '', '7', '1', '1', '', '1', '1552750196', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('24', '滚筒洗衣机', '滚筒洗衣机', '', '23', '1', '1', '', '1', '1552750236', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('25', '洗烘一体机', '洗烘一体机', '', '23', '1', '1', '', '1', '1552750270', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('26', '波轮洗衣机', '波轮洗衣机', '', '23', '1', '1', '', '1', '1552750301', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('27', '迷你洗衣机', '迷你洗衣机', '', '23', '1', '1', '', '1', '1552750316', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('28', '烘干机', '烘干机', '', '23', '1', '1', '', '1', '1552750334', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('29', '洗衣机配件', '洗衣机配件', '', '23', '1', '1', '', '1', '1552750353', '2', '1', '');
INSERT INTO `mall_goods_class` VALUES ('30', '老人机', '老人机', '', '2', '1', '1', '', '1', '1552750518', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('31', '对讲机', '对讲机', '', '2', '1', '1', '', '1', '1552750529', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('32', '合约机', '合约机', '', '5', '1', '1', '', '1', '1552750607', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('33', '中国电信', '中国电信', '', '5', '1', '1', '', '1', '1552750640', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('34', '中国移动', '中国移动', '', '5', '1', '1', '', '1', '1552750657', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('35', '中国联通', '中国联通', '', '5', '1', '1', '', '1', '1552750668', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('36', '手机壳', '手机壳', '', '6', '1', '1', '', '1', '1552750745', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('37', '贴膜', '贴膜', '', '6', '1', '1', '', '1', '1552750759', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('38', '手机存储卡', '手机存储卡', '', '6', '1', '1', '', '1', '1552750771', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('39', '数据线', '数据线', '', '6', '1', '1', '', '1', '1552750855', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('40', '电脑/办公', '电脑/办公', '', '0', '1', '1', '', '1', '1552751248', '3', '1', '');
INSERT INTO `mall_goods_class` VALUES ('41', '电脑整机', '电脑整机', '', '40', '1', '1', '', '1', '1552751394', '3', '1', '');
INSERT INTO `mall_goods_class` VALUES ('42', '笔记本', '笔记本', '', '41', '1', '1', '', '1', '1552751418', '3', '1', '');
INSERT INTO `mall_goods_class` VALUES ('43', '游戏本', '游戏本', '', '41', '1', '1', '', '1', '1552751446', '3', '1', '');
INSERT INTO `mall_goods_class` VALUES ('44', '平板电脑', '平板电脑', '', '41', '1', '1', '', '1', '1552751554', '3', '1', '');
INSERT INTO `mall_goods_class` VALUES ('45', '电脑配件', '电脑配件', '', '40', '1', '1', '', '1', '1552751568', '3', '1', '');
INSERT INTO `mall_goods_class` VALUES ('46', '显示器', '显示器', '', '45', '1', '1', '', '1', '1552751598', '3', '1', '');
INSERT INTO `mall_goods_class` VALUES ('47', 'CPU', 'CPU', '', '45', '1', '1', '', '1', '1552751663', '3', '1', '');
INSERT INTO `mall_goods_class` VALUES ('48', '主板', '主板', '', '45', '1', '1', '', '1', '1552751681', '3', '1', '');
INSERT INTO `mall_goods_class` VALUES ('49', '显卡', '显卡', '', '45', '1', '1', '', '1', '1552751707', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('50', '外设产品', '外设产品', '', '40', '1', '1', '', '1', '1552751749', '3', '1', '');
INSERT INTO `mall_goods_class` VALUES ('51', '鼠标', '鼠标', '', '50', '1', '1', '', '1', '1552751767', '3', '1', '');
INSERT INTO `mall_goods_class` VALUES ('52', '键盘', '键盘', '', '50', '1', '1', '', '1', '1552751784', '3', '1', '');
INSERT INTO `mall_goods_class` VALUES ('53', '键鼠', '键鼠', '', '50', '1', '1', '', '1', '1552751799', '1', '1', '');
INSERT INTO `mall_goods_class` VALUES ('54', '家居/家具/家装/厨具', '', '', '0', '1', '1', '', '1', '1552751862', '4', '1', '');
INSERT INTO `mall_goods_class` VALUES ('55', '厨具', '厨具', '', '54', '1', '1', '', '1', '1552752563', '4', '1', '');
INSERT INTO `mall_goods_class` VALUES ('56', '水具', '水具', '', '55', '1', '1', '', '1', '1552752577', '4', '1', '');
INSERT INTO `mall_goods_class` VALUES ('57', '酒具', '酒具', '', '55', '1', '1', '', '1', '1552752605', '4', '1', '');
INSERT INTO `mall_goods_class` VALUES ('58', '烹饪锅具', '烹饪锅具', '', '55', '1', '1', '', '1', '1552752646', '4', '1', '');
INSERT INTO `mall_goods_class` VALUES ('59', '家纺', '家纺', '', '54', '1', '1', '', '1', '1552752775', '4', '1', '');
INSERT INTO `mall_goods_class` VALUES ('60', '四件套', '四件套', '', '59', '1', '1', '', '1', '1552752788', '4', '1', '');
INSERT INTO `mall_goods_class` VALUES ('61', '被子', '被子', '', '59', '1', '1', '', '1', '1552752805', '4', '1', '');
INSERT INTO `mall_goods_class` VALUES ('62', '枕芯', '枕芯', '', '59', '1', '1', '', '1', '1552752836', '4', '1', '');
INSERT INTO `mall_goods_class` VALUES ('63', '生活日用', '', '', '54', '1', '1', '', '1', '1552752947', '4', '1', '');
INSERT INTO `mall_goods_class` VALUES ('64', '收纳用品', '收纳用品', '', '63', '1', '1', '', '1', '1552752959', '4', '1', '');
INSERT INTO `mall_goods_class` VALUES ('65', '雨伞雨具', '雨伞雨具', '', '63', '1', '1', '', '1', '1552752978', '4', '1', '');
INSERT INTO `mall_goods_class` VALUES ('66', '净化除味', '净化除味', '', '63', '1', '1', '', '1', '1552753004', '4', '1', '');
INSERT INTO `mall_goods_class` VALUES ('67', '服装服饰', '', '', '0', '1', '1', '', '1', '1552753243', '5', '1', '');
INSERT INTO `mall_goods_class` VALUES ('68', '女装', '女装', '', '67', '1', '1', '', '1', '1552753367', '5', '1', '');
INSERT INTO `mall_goods_class` VALUES ('69', '商场同款', '商场同款', '', '68', '1', '1', '', '1', '1552753388', '5', '1', '');
INSERT INTO `mall_goods_class` VALUES ('70', '时尚套装', '时尚套装', '', '68', '1', '1', '', '1', '1552753402', '5', '1', '');
INSERT INTO `mall_goods_class` VALUES ('71', '连衣裙', '连衣裙', '', '68', '1', '1', '', '1', '1552753429', '5', '1', '');
INSERT INTO `mall_goods_class` VALUES ('72', '半身裙', '半身裙', '', '68', '1', '1', '', '1', '1552753448', '5', '1', '');
INSERT INTO `mall_goods_class` VALUES ('73', 'T恤', 'T恤', '', '68', '1', '1', '', '1', '1552753462', '5', '1', '');
INSERT INTO `mall_goods_class` VALUES ('74', '男装', '男装', '', '67', '1', '1', '', '1', '1552753496', '5', '1', '');
INSERT INTO `mall_goods_class` VALUES ('75', 'T恤', 'T恤', '', '74', '1', '1', '', '1', '1552753510', '5', '1', '');
INSERT INTO `mall_goods_class` VALUES ('76', '牛仔裤', '牛仔裤', '', '74', '1', '1', '', '1', '1552753525', '5', '1', '');
INSERT INTO `mall_goods_class` VALUES ('77', '休闲裤', '休闲裤', '', '74', '1', '1', '', '1', '1552753539', '5', '1', '');
INSERT INTO `mall_goods_class` VALUES ('78', '手机', 'sdfsdfsdf', 'sdfsdfs', '0', '1', '1', '', '1', '1585663137', '1', '1', 'www.baidu.com');
INSERT INTO `mall_goods_class` VALUES ('79', '手机通讯测试', '', '', '2', '1', '1', '', '1', '1586272382', '1', '1', '');

-- ----------------------------
-- Table structure for mall_goods_type
-- ----------------------------
DROP TABLE IF EXISTS `mall_goods_type`;
CREATE TABLE `mall_goods_type` (
  `type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) NOT NULL DEFAULT '' COMMENT '类型名称',
  `type_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开启状态0表示关闭1表示开启',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `add_user_id` int(10) NOT NULL DEFAULT '0' COMMENT '添加者id',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='商品类型表';

-- ----------------------------
-- Records of mall_goods_type
-- ----------------------------
INSERT INTO `mall_goods_type` VALUES ('1', '手机', '1', '1585058633', '1');
INSERT INTO `mall_goods_type` VALUES ('2', '牛奶', '1', '1585058750', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

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
INSERT INTO `mall_log` VALUES ('52', '1', '配置组是否限制用户登录ip添加成功', '1584495105', '127.0.0.1', '3', 'Config', 'add', '');
INSERT INTO `mall_log` VALUES ('53', '1', '配置参数注册积分添加成功', '1584495379', '127.0.0.1', '3', 'Config', 'add', '');
INSERT INTO `mall_log` VALUES ('54', '1', '配置参数：网站名称编辑成功', '1584503891', '127.0.0.1', '3', 'Config', 'edit', '');
INSERT INTO `mall_log` VALUES ('55', '1', '配置参数：网站名称编辑成功', '1584503943', '127.0.0.1', '3', 'Config', 'edit', '');
INSERT INTO `mall_log` VALUES ('56', '1', '配置参数ID：17删除成功', '1584503993', '127.0.0.1', '3', 'Config', 'del', '');
INSERT INTO `mall_log` VALUES ('57', '1', '配置参数ID：17删除成功', '1584504189', '127.0.0.1', '3', 'Config', 'del', '');
INSERT INTO `mall_log` VALUES ('58', '1', '配置参数ID：17删除成功', '1584504278', '127.0.0.1', '3', 'Config', 'del', '');
INSERT INTO `mall_log` VALUES ('59', '1', '配置参数：网站名称编辑成功', '1584514048', '127.0.0.1', '3', 'Config', 'edit', '');
INSERT INTO `mall_log` VALUES ('60', '1', '节点网站配置配置成功', '1584524276', '127.0.0.1', '2', 'Rbac', 'editnode', '');
INSERT INTO `mall_log` VALUES ('61', '1', '节点12312添加成功', '1584524303', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('62', '1', 'admin登录成功', '1584667308', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('63', '1', 'admin注销成功', '1584673727', '127.0.0.1', '1', 'Index', 'logout', '');
INSERT INTO `mall_log` VALUES ('64', '1', 'admin登录成功', '1584673963', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('65', '1', 'admin注销成功', '1584674008', '127.0.0.1', '1', 'Index', 'logout', '');
INSERT INTO `mall_log` VALUES ('66', '1', 'admin登录成功', '1584674017', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('67', '1', 'admin注销成功', '1584674056', '127.0.0.1', '1', 'Index', 'logout', '');
INSERT INTO `mall_log` VALUES ('68', '1', 'admin登录成功', '1584674066', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('69', '1', '节点12312添加成功', '1584695052', '127.0.0.1', '2', 'Rbac', 'delnode', '');
INSERT INTO `mall_log` VALUES ('70', '1', 'admin登录成功', '1585049862', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('71', '1', '商品类型名称添加成功', '1585052374', '127.0.0.1', '5', 'GoodsType', 'add', '');
INSERT INTO `mall_log` VALUES ('72', '1', '商品类型名称添加成功', '1585058633', '127.0.0.1', '5', 'GoodsType', 'add', '');
INSERT INTO `mall_log` VALUES ('73', '1', '商品类型名称添加成功', '1585058750', '127.0.0.1', '5', 'GoodsType', 'add', '');
INSERT INTO `mall_log` VALUES ('74', '1', 'admin登录成功', '1585146398', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('75', '1', 'admin登录成功', '1585486360', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('76', '1', 'admin登录成功', '1585572580', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('77', '1', '商品分类名称手机添加成功', '1585663137', '127.0.0.1', '6', 'GoodsClass', 'add', '');
INSERT INTO `mall_log` VALUES ('78', '1', 'admin登录成功', '1585665740', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('79', '1', '商品分类名称手机通讯测试添加成功', '1586272382', '127.0.0.1', '6', 'GoodsClass', 'add', '');
INSERT INTO `mall_log` VALUES ('80', '1', '商品分类：手机/运营商/数码编辑成功', '1586357369', '127.0.0.1', '3', 'GoodsClass', 'edit', '');
INSERT INTO `mall_log` VALUES ('81', '1', '商品分类：手机/运营商/数码编辑成功', '1586357434', '127.0.0.1', '3', 'GoodsClass', 'edit', '');
INSERT INTO `mall_log` VALUES ('82', '1', '商品分类：手机/运营商/数码编辑成功', '1586357574', '127.0.0.1', '3', 'GoodsClass', 'edit', '');
INSERT INTO `mall_log` VALUES ('83', '1', '商品分类：手机编辑成功', '1586357715', '127.0.0.1', '3', 'GoodsClass', 'edit', '');
INSERT INTO `mall_log` VALUES ('84', '1', '节点主题配置添加成功', '1586417724', '127.0.0.1', '2', 'Rbac', 'addnode', '');
INSERT INTO `mall_log` VALUES ('85', '1', '配置组：网站主题编辑成功', '1586420291', '127.0.0.1', '3', 'ConfigGroup', 'edit', '');
INSERT INTO `mall_log` VALUES ('86', '1', 'admin登录成功', '1586482894', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('87', '1', 'admin登录成功', '1586739498', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('88', '1', 'admin登录成功', '1586765543', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('89', '1', 'admin登录成功', '1586828550', '127.0.0.1', '1', 'Login', 'Login', '');
INSERT INTO `mall_log` VALUES ('90', '1', 'admin登录成功', '1586914967', '127.0.0.1', '1', 'Login', 'Login', '');

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
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COMMENT='节点表';

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
INSERT INTO `mall_node` VALUES ('51', 'webConfig', '', '', '网站配置', '1', null, '0', '35', '3', '1');
INSERT INTO `mall_node` VALUES ('52', 'GoodsType', null, null, '商品类型', '1', null, '1', '26', '2', '1');
INSERT INTO `mall_node` VALUES ('53', 'GoodsClass', null, null, '商品分类管理', '1', null, '1', '26', '2', '1');
INSERT INTO `mall_node` VALUES ('54', 'User', null, null, '会员管理', '1', null, '1', '26', '2', '1');
INSERT INTO `mall_node` VALUES ('55', 'Store', null, null, '店铺管理', '1', null, '1', '26', '2', '1');
INSERT INTO `mall_node` VALUES ('56', 'Order', null, null, '订单管理', '1', null, '1', '26', '2', '1');
INSERT INTO `mall_node` VALUES ('57', 'Goods', null, null, '商品管理', '1', null, '1', '26', '2', '1');
INSERT INTO `mall_node` VALUES ('58', 'Stat', null, null, '统计管理', '1', null, '1', '26', '2', '1');
INSERT INTO `mall_node` VALUES ('59', 'index', null, null, '商品类型列表', '1', null, '1', '52', '3', '1');
INSERT INTO `mall_node` VALUES ('60', 'add', null, null, '添加商品类型', '1', null, '1', '52', '3', '1');
INSERT INTO `mall_node` VALUES ('61', 'edit', null, null, '编辑商品类型', '1', null, '1', '52', '3', '0');
INSERT INTO `mall_node` VALUES ('62', 'del', null, null, '删除商品类型', '1', null, '1', '52', '3', '0');
INSERT INTO `mall_node` VALUES ('63', 'ajaxTypeName', null, null, 'ajax验证商品类型', '1', null, '1', '52', '3', '0');
INSERT INTO `mall_node` VALUES ('64', 'ajaxRecommand', null, null, 'ajax异步更新相关属性', '1', null, '1', '52', '3', '0');
INSERT INTO `mall_node` VALUES ('65', 'index', null, null, '商品分类列表', '1', null, '1', '53', '3', '1');
INSERT INTO `mall_node` VALUES ('66', 'add', null, null, '添加商品分类', '1', null, '1', '53', '3', '1');
INSERT INTO `mall_node` VALUES ('67', 'edit', null, null, '编辑商品分类', '1', null, '1', '53', '3', '0');
INSERT INTO `mall_node` VALUES ('68', 'del', null, null, '删除商品分类', '1', null, '1', '53', '3', '0');
INSERT INTO `mall_node` VALUES ('69', 'theme', '', '', '主题配置', '1', null, '1', '36', '3', '1');

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

-- ----------------------------
-- Table structure for mall_user
-- ----------------------------
DROP TABLE IF EXISTS `mall_user`;
CREATE TABLE `mall_user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(60) DEFAULT '' COMMENT '用户名',
  `user_truename` varchar(50) DEFAULT NULL COMMENT '用户真实姓名',
  `user_mobile` varchar(20) DEFAULT '' COMMENT '手机号码',
  `user_id_card_truename` varchar(50) DEFAULT '' COMMENT '身份证真实姓名',
  `user_id_card` varchar(30) DEFAULT '' COMMENT '身份证',
  `user_card_status` tinyint(1) DEFAULT NULL COMMENT '实名状态0否1是',
  `user_email` varchar(60) DEFAULT '' COMMENT '邮箱',
  `user_password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `user_payword` varchar(32) DEFAULT '' COMMENT '支付密码',
  `user_question_1` tinyint(1) DEFAULT '0' COMMENT '问题1',
  `user_question_2` tinyint(1) DEFAULT '0' COMMENT '问题2',
  `user_answer_1` varchar(200) DEFAULT '' COMMENT '答案1',
  `user_answer_2` varchar(200) DEFAULT '' COMMENT '答案2',
  `user_salt` char(10) DEFAULT '' COMMENT '秘钥',
  `user_reg_time` int(10) DEFAULT '0' COMMENT '注册时间',
  `user_reg_ip` varchar(50) DEFAULT '0.0.0.0' COMMENT '注册ip',
  `user_login_time` int(10) DEFAULT '0' COMMENT '登录时间',
  `user_login_ip` varchar(50) DEFAULT '0.0.0.0' COMMENT '登录ip',
  `user_point` int(10) DEFAULT '0' COMMENT '用户积分',
  `user_sex` tinyint(1) DEFAULT '0' COMMENT '性别0保密1男2女',
  `user_avatar` varchar(200) DEFAULT '' COMMENT '用户头像',
  `user_birthday` int(10) DEFAULT '0' COMMENT '用户生日',
  `address_id` int(10) DEFAULT '0' COMMENT '用户默认地址',
  `user_status` tinyint(1) DEFAULT '0' COMMENT '用户状态',
  `update_time` int(10) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`uid`),
  KEY `user_status` (`user_status`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of mall_user
-- ----------------------------
