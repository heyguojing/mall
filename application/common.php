<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
error_reporting(E_ERROR | E_WARNING | E_PARSE);

use Org\Util\File;
use think\Db;
use Org\Util\Rule;

//打印数据
if (!function_exists('p')) {
	function p ($arr)
	{
		header("Content-type:text/html; charset=utf-8");
		echo "<pre style='position:relative;z-index:1000;padding:10px;border-radius:5px;background:#F5F5F5;border:1px solid #aaa;font-size:14px;line-height:18px;opacity:0.9;'>" . print_r($arr, true) . "</pre>";
	}
}
//生成混合字符串
if (!function_exists('getRandKey')) {
	/** 根据随机数生成6位密钥 */
	function getRandKey($num = false)
	{
		if ($num) {
			$randStr = str_shuffle('1234567890');
			return substr($randStr, 0, 6);
		} else {
			return substr(md5(mt_rand(0, 32) . '0905' . md5(mt_rand(0, 32)) . '0123'), 10, 6);
		}
	}
}
/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装）
 * @return mixed
 */
if (!function_exists('get_client_ip')) {
	function get_client_ip ($type = 0, $adv = false)
	{
		$type = $type ? 1 : 0;
		static $ip = NULL;
		if ($ip !== NULL) return $ip[$type];
		if ($adv) {
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				$pos = array_search('unknown', $arr);
				if (false !== $pos) unset($arr[$pos]);
				$ip = trim($arr[0]);
			} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (isset($_SERVER['REMOTE_ADDR'])) {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
		} elseif (isset($_SERVER['REMOTE_ADDR'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		// IP地址合法验证
		$long = sprintf("%u", ip2long($ip));
		$ip = $long ? array($ip, $long) : array('0.0.0.0', 0);
		return $ip[$type];
	}
}