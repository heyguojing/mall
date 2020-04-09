<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: superman <953369865@qq.com> 2015-06-30 10:30
// +----------------------------------------------------------------------
namespace Org\Util;

use Org\Util\XmlT;

class Theme
{
	/**
	 * 获取插件目录信息
	 * @param unknown_type $code
	 */
	public function get_theme ($type = "pc")
	{
		$theme_info = array();
		$modules = $this->read_theme(TMPLATE_PATH . $type . "/");
		foreach ($modules as $directory => $theme) {
			if ($type == "pc") {
				$theme['is_default'] = ($directory == config('site.WEB_STYLE')) ? 1 : 0;
			} else {
				$theme['is_default'] = ($directory == config('site.MOBILE_STYLE')) ? 1 : 0;
			}
			$theme_info[$directory] = $theme;
		}
		return $theme_info;
	}

	/**
	 * 读取插件目录中插件列表
	 * @param unknown_type $directory
	 */
	public function read_theme ($directory = ".")
	{
		$dir = @opendir($directory);
		$set_modules = true;
		$modules = array();
		$xmlT = new xmlT();
		while (($file = @readdir($dir)) !== false) {

			if ($file == '.' || $file == '..' || !is_dir($directory . $file)) continue;
			if (file_exists($directory . $file . DIRECTORY_SEPARATOR . 'config.xml')) {
				$config = @file_get_contents($directory . $file . DIRECTORY_SEPARATOR . 'config.xml');
				$xml = $xmlT->xml2array($config);
				/*if (file_exists($directory.$file.DIRECTORY_SEPARATOR.'thumb.png')) {
					$thumb_dir = $directory.$file.'/';
				} else {
					$thumb_dir = $directory.'/';
				}*/
				$thumb_dir = $directory . $file . '/';
				$xml['thumb'] = str_replace(ROOT_PATH . "..", '/static/admin', $thumb_dir . 'thumb.png');
				$xml['thumb_big'] = str_replace(ROOT_PATH . "..", '/static/admin', $thumb_dir . 'thumb_big.png');
				$modules[$file] = $xml;
			}
		}
		@closedir($dir);
		foreach ($modules as $key => $value) {
			asort($modules[$key]);
		}
		asort($modules);
		return $modules;
	}

	/**
	 * 获取店铺主题
	 */
	public function get_store_theme ($type = "pc", $pc_store_dir = 'default', $mobile_store_dir = 'default')
	{
		$theme_info = array();
		if ($type == "pc") {
			$dir = config('site.WEB_STYLE');
		} else {
			$dir = config('site.MOBILE_STYLE');
		}
		$modules = $this->read_store_theme(TMPLATE_PATH . $type . "/" . $dir . '/' . config('site.WEB_STORE_DIR') . '/');
		if (!empty($modules)) {
			foreach ($modules as $directory => $theme) {
				if ($type == "pc") {
					$theme['is_default'] = ($directory == $pc_store_dir) ? 1 : 0;
				} else {
					$theme['is_default'] = ($directory == $mobile_store_dir) ? 1 : 0;
				}
				$theme_info[$directory] = $theme;
			}
		}

		return $theme_info;
	}

	/**
	 * 读取插件目录中插件列表
	 * @param unknown_type $directory
	 */
	public function read_store_theme ($directory = ".")
	{
		$dir = @opendir($directory);
		$set_modules = true;
		$modules = array();
		$xmlT = new xmlT();
		while (($file = @readdir($dir)) !== false) {
			if ($file == '.' || $file == '..' || !is_dir($directory . $file)) continue;
			if (file_exists($directory . $file . DIRECTORY_SEPARATOR . 'config.xml')) {
				$config = @file_get_contents($directory . $file . DIRECTORY_SEPARATOR . 'config.xml');
				$xml = $xmlT->xml2array($config);
				/*if (file_exists($directory.$file.DIRECTORY_SEPARATOR.'thumb.png')) {
					$thumb_dir = $directory.$file.'/';
				} else {
					$thumb_dir = $directory.'/';
				}*/
				$thumb_dir = $directory . $file . '/';
				$xml['thumb'] = str_replace(ROOT_PATH . "..", '/static/index', $thumb_dir . 'thumb.png');
				$xml['thumb_big'] = str_replace(ROOT_PATH . "..", '/static/index', $thumb_dir . 'thumb_big.png');
				$modules[$file] = $xml;
			}
		}
		@closedir($dir);
		foreach ($modules as $key => $value) {
			asort($modules[$key]);
		}
		asort($modules);
		return $modules;
	}
}

?>