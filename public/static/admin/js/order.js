$(function () {
	//倒计时
	count_down(true, $(".timeBox")); //参数一：开启天数 参数二：倒计时时间选择
	if ($("#create_time_start").length > 0) {
		//日历
		laydate({
			elem: '#create_time_start',
			event: 'focus'
		});
		laydate({
			elem: '#create_time_end',
			event: 'focus'
		});
	}
	if ($("#return_time_start").length > 0) {
		//日历
		laydate({
			elem: '#return_time_start',
			event: 'focus'
		});
		laydate({
			elem: '#return_time_end',
			event: 'focus'
		});
	}
	if ($(".layer-photos").length > 0) {
		layer.photos({
			photos: '.layer-photos',
			anim: 0 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
		});
	}
	//评论
	if ($(".e-img").length > 0) {
		layer.photos({
			photos: '.e-img',
			anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
		});
		laydate({
			elem: '#comment_time_start',
			event: 'focus'
		});
		laydate({
			elem: '#comment_time_end',
			event: 'focus'
		});
	}

});

//物流查看
function view_logistics (lid) {
	layer.open({
		type: 1,
		title: '查看物流信息',
		area: ['500px', '400px'],
		content: $('#logistics')
	});
}

//评价查看
function view_comment (gid) {
	layer.open({
		type: 1,
		title: '评介管理',
		area: ['550px', '300px'],
		content: $('#assess')
	});
}

//售后管理
function refund (return_id, return_type) {
	$("#refuseFrame .btn:eq(0)").attr("onclick", 'refund_confirm(' + return_id + ',' + return_type + ',1)');
	$("#refuseFrame .btn:eq(1)").attr("onclick", 'refund_confirm('+ return_id + ',' + return_type + ',2)');
	layer.open({
		type: 1,
		title: '售后处理',
		area: ['400px', '280px'],
		content: $('#refuseFrame'),
		cancel: function () {
			$("#refuseFrame").hide();
		},
	});
}

/**
 * 退款处理
 * @param obj
 * @param return_id
 * @param refund_type
 * @param refund_status
 */
function refund_confirm (return_id, refund_type, refund_status) {
	var msg = '';
	if (refund_status == 1) {
		msg = "同意";
	} else {
		msg = "拒绝";
	}
	layer.confirm('您确定要' + msg + '退款!', function () {
		refund_do(return_id, refund_type, refund_status);
	}, function () {
		layer.closeAll();
	});
}

/**
 * 提交数据给后台
 * @param return_id
 * @param refund_type
 * @param refund_status
 * @param obj
 */
function refund_do (return_id, refund_type, refund_status) {
	var obj = $("#refund_"+return_id);
	var return_text = $.trim($("[name=return_text]").val());
	if (return_text == "") {
		layer.msg('请输入处理理由', {icon: 2});
		return false;
	}
	$.post('/Order/refundDo', {
		refund_status: refund_status,
		return_id: return_id,
		refund_type: refund_type,
		return_text: return_text
	}, function (data) {
		if (data.status == 1) {
			if (refund_type == 1) {
				var type = "退款";
				var type = "退货退款";
			}
			var status = refund_status == 1 ? type + "成功" : "已拒绝" + type;
			if (refund_status == 1) {
				status = '<span class="label label-success radius">' + status + '</span>';
			} else {
				status = '<span class="label label-default radius">' + status + '</span>';
			}
			obj.parents("td").prev().prev().prev().html(status);
			obj.remove();
			layer.msg(data.info, {icon: 1});
		} else {
			layer.msg(data.info, {icon: 2});
		}
	}, 'json')

	layer.closeAll();
}


