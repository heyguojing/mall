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
// | 消息规则
// +----------------------------------------------------------------------
namespace Org\Util;
final class Rule
{
	/**订单规则
	 * @return array
	 */
	static public function order ()
	{
		return array(
			'1000' => array('title' => '系统消息', 'rule' => ''),
			'1001' => array('title' => '买家已付款等发货订单', 'rule' => '用户[:user_mobile:]购买了【[:goods_name:]】，请及时发货，订单编号 [:order_sn:]', 'audio' => '100001.mp3'),
			'1002' => array('title' => '买家申请仅退款', 'rule' => '用户[:user_mobile:]申请了【[:goods_name:]】仅退款，退款编号 [:return_sn:]', 'audio' => '100002.mp3'),
			'1003' => array('title' => '买家申请退款退货', 'rule' => '用户[:user_mobile:]申请了【[:goods_name:]】退款退货，退款编号 [:return_sn:]', 'audio' => '100002.mp3'),
			'1004' => array('title' => '买家投诉', 'rule' => '用户[:user_mobile:]投诉【[:goods_name:]】[:tousu_cause:]，订单编号 [:order_sn:]。'),
			'1005' => array('title' => '买家评价', 'rule' => '用户[:user_mobile:]对【[:store_name:]】做出了评价，订单号：[:order_sn:]。'),
			'1006' => array('title' => '买家取消', 'rule' => '用户[:user_mobile:] 取消了订单，订单编号:[:order_sn:]。'),
			'1007' => array('title' => '提醒发货', 'rule' => '用户[:user_mobile:] 提醒你发货，订单编号:[:order_sn:]。'),
			'1008' => array('title' => '确认发货', 'rule' => '用户[:user_mobile:] 确认发货吃饭，订单编号:[:order_sn:]。'),

			'1101' => array('title' => '卖家发货', 'rule' => '您购买的【[:goods_name:]】已发货，<a class="viewMessage" href="javascript:;" data-href="[:href:]" data-info_id="[:info_id:]">查看详情</a>'),
			'1102' => array('title' => '超时未付款', 'rule' => '您的订单[:order_sn:]即将付款超时，请<a class="viewMessage" href="javascript:;" data-href="[:href:]" data-info_id="[:info_id:]">点击这里</a>进行付款。'),
			'1103' => array('title' => '自动确认收货', 'rule' => '您购买的【[:goods_name:]】即将自动确认收货，请注意查收，<a class="viewMessage" href="javascript:;" data-href="[:href:]" data-info_id="[:info_id:]">查看详情</a>。'),
			'1104' => array('title' => '供应商已修改价格', 'rule' => '您有订单已改价,订单编号 [:order_sn:]<a class="viewMessage" href="javascript:;" data-href="[:href:]" data-info_id="[:info_id:]">查看详情</a>。'),
			'1105' => array('title' => '卖家操作仅退款', 'rule' => '您的【[:goods_name:]】仅退款已处理,<a class="viewMessage" href="javascript:;" data-href="[:href:]" data-info_id="[:info_id:]">查看详情</a>'),
			'1106' => array('title' => '卖家操作退货退款', 'rule' => '您的【[:goods_name:]】退款退货已处理,<a class="viewMessage" href="javascript:;" data-href="[:href:]" data-info_id="[:info_id:]">查看详情</a>'),
			'1107' => array('title' => '优惠活动', 'rule' => '[:title:]'),
		);
	}

}