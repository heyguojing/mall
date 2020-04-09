<?php
// [ 应用入口文件 ]
namespace think;
define('ROOT_PATH',dirname(str_replace("\\",'/',$_SERVER['SCRIPT_FILENAME']))."/");
define('TMPLATE_PATH',ROOT_PATH."../template/");
// 加载基础文件
require __DIR__ . '/../thinkphp/base.php';

// 支持事先使用静态方法设置Request对象和Config对象

// 执行应用并响应
Container::get('app')->run()->send();
