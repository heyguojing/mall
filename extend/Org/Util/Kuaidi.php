<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: superman <953369865@qq.com>
// +----------------------------------------------------------------------
namespace Org\Util;
class Kuaidi
{
	protected $key = '6cb4071a68abf951';
	protected $url = 'http://www.kuaidi100.com/query?';
	protected $par = array();
	protected $error = '';

	public function __construct ()
	{
		$this->par = array(
			'type' => '',
			'postid' => '',
			'id' => 1,
			'valicode' => '',
			'temp' => $this->_random(10),
		);
	}

	public function query ($delivery_enname, $delivery_sn, $show = '0', $muti = 1)
	{
		if (empty($delivery_enname) || empty($delivery_sn)) return FALSE;
		$this->par['type'] = $delivery_enname;
		$this->par['postid'] = $delivery_sn;
		$result = http_post_data($this->url . http_build_query($this->par));
		if ($result) {
			$result = json_decode($result, TRUE);
			if ($result['status'] == 0) {
				$this->error = '物流单暂无结果';
				return FALSE;
			} elseif ($result['status'] == 2) {
				$this->error = '接口出现异常';
				return FALSE;
			} else {
				unset($result['status']);
				switch ($result['state']) {
					case '0':
						$result['message'] = '在途';
						break;
					case '1':
						$result['message'] = '揽件';
						break;
					case '2':
						$result['message'] = '疑难';
						break;
					case '3':
						$result['message'] = '签收';
						break;
					case '4':
						$result['message'] = '退签';
						break;
					case '5':
						$result['message'] = '派件';
						break;
					case '6':
						$result['message'] = '退回';
						break;
					default:
						$result['message'] = '其他';
						break;
				}
				return $result;
			}
		} else {
			$this->error = '查询失败，请稍候重试';
			return FALSE;
		}
	}

	/**
	 * 随机字符串
	 *
	 * @return bool
	 **/

	private function _random ($length, $numeric = 0)
	{
		$seed = base_convert(md5(microtime() . $_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
		$seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
		if ($numeric) {
			$hash = '';
		} else {
			$hash = chr(rand(1, 26) + rand(0, 1) * 32 + 64);
			$length--;
		}
		$max = strlen($seed) - 1;
		for ($i = 0; $i < $length; $i++) {
			$hash .= $seed{mt_rand(0, $max)};
		}
		return $hash;
	}
	public
	function getError ()
	{
		return $this->error;
	}
}