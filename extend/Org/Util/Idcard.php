<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | php验证身份证合法性 计算身份证校验码，根据国家标准GB 11643-1999
// +----------------------------------------------------------------------
// | Author: superman <953369865@qq.com>
// +----------------------------------------------------------------------
namespace Org\Util;
class Idcard
{
	static private function _idcardVerifyNumber ($id_card_base)
	{
		if (strlen($id_card_base) != 17) {
			return false;
		}
		// 加权因子
		$factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
		// 校验码对应值
		$verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
		$check_sum = 0;
		for ($i = 0; $i < strlen($id_card_base); $i++) {
			$check_sum += substr($id_card_base, $i, 1) * $factor[$i];
		}
		$mod = strtoupper($check_sum % 11);
		$verify_number = $verify_number_list[$mod];
		return $verify_number;
	}

	/**将15位身份证升级到18位
	 * @param $id_card
	 * @return int|string
	 */
	static public function idcard15To18 ($id_card)
	{
		if (strlen($id_card) != 15) {
			return 0;
		} else {
			// 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
			if (array_search(substr($id_card, 12, 3), array('996', '997', '998', '999')) !== false) {
				$id_card = substr($id_card, 0, 6) . '18' . substr($id_card, 6, 9);
			} else {
				$id_card = substr($id_card, 0, 6) . '19' . substr($id_card, 6, 9);
			}
		}
		$id_card = $id_card . self::_idcardVerifyNumber($id_card);
		return $id_card;
	}

	/**18位身份证校验码有效性检查
	 * @param $id_card
	 * @return int
	 */
	static public function idcardCheckSum18 ($id_card)
	{
		if (strlen($id_card) != 18) {
			return 0;
		}
		$city_data = array(
			11 => "北京",
			12 => "天津",
			13 => "河北",
			14 => "山西",
			15 => "内蒙古",
			21 => "辽宁",
			22 => "吉林",
			23 => "黑龙江",
			31 => "上海",
			32 => "江苏",
			33 => "浙江",
			34 => "安徽",
			35 => "福建",
			36 => "江西",
			37 => "山东",
			41 => "河南",
			42 => "湖北",
			43 => "湖南",
			44 => "广东",
			45 => "广西",
			46 => "海南",
			50 => "重庆",
			51 => "四川",
			52 => "贵州",
			53 => "云南",
			54 => "西藏",
			61 => "陕西",
			62 => "甘肃",
			63 => "青海",
			64 => "宁夏",
			65 => "新疆",
			71 => "台湾",
			81 => "香港",
			82 => "澳门",
			91 => "国外"
		);
		//非法地区
		if (!array_key_exists(substr($id_card, 0, 2), $city_data)) {
			return 0;
		}
		//验证生日
		if (!checkdate(substr($id_card, 10, 2), substr($id_card, 12, 2), substr($id_card, 6, 4))) {
			return 0;
		}
		$id_card_base = substr($id_card, 0, 17);
		if (self::_idcardVerifyNumber($id_card_base) != strtoupper(substr($id_card, 17, 1))) {
			return 0;
		} else {
			return 1;
		}
	}
}