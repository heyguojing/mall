$(function () {
	laydate({
		elem: '#goods_time_start',
		event: 'focus'
	});
	laydate({
		elem: '#goods_time_end',
		event: 'focus'
	});
});

/**
 * 多级联动 商品分类
 */
function change_class (obj, type) {
	var class_id = $(obj).val().trim();
	$(obj).nextAll().remove();
	if (class_id == "") {
		return false;
	}
	if (type == 1) {
		var url = ajax_goods_class;
		var name = "class_id[]";
	}

	$.post(url, {class_id: class_id}, function (data) {
		if (data.status == 1) {
			if (data.class_data.length > 0) {
				var _html = ' <select lay-ignore name="' + name + '"  Onchange="change_class(this,' + type + ')">';
				_html += '<option value="">请选择分类</option>';
				$.each(data.class_data, function (k, v) {
					_html += '<option value="' + v.class_id + '">--' + v.class_name + '--</option>';
				});
				_html += '</select>';
				$(obj).after(_html);
			}
		}
	}, 'json');
}

/**
 * 异步审核商品
 * @param obj
 * @param goods_id
 */
function ajax_status (obj, goods_id) {
	$("#examine .layui-btn:eq(0)").attr('onclick', 'ajax_status_confirm(' + goods_id + ',1)');
	$("#examine .layui-btn:eq(1)").attr('onclick', 'ajax_status_confirm(' + goods_id + ',2)');
	layer.open({
		type: 1,
		title: '产品审核',
		area: ['550px', '300px'],
		content: $('#examine')
	});
}

function ajax_status_confirm (goods_id, goods_status) {
	var obj = $("#goods_" + goods_id);
	var goods_status_content = "";
	if (goods_status == 2) {
		goods_status_content = $.trim($("[name=goods_status_content]").val());
		if (goods_status_content == "") {
			layer.msg('请填写拒绝理由', {icon: 2});
			return false;
		}
	}
	$.post('/Goods/ajaxStatus', {
		goods_status_content: goods_status_content,
		goods_id: goods_id,
		goods_status: goods_status,
	}, function (data) {
		if (data.status == 1) {
			if (goods_status == 1) {
				status = '<span class="btn btn-success btn-xs">审核通过</span>';
			} else {
				status = '<span class="btn btn-default btn-xs">审核拒绝</span>';
			}
			obj.parents("td").prev().html(status);
			layer.msg(data.info, {icon: 1});
		} else {
			layer.msg(data.info, {icon: 2});
		}

	}, 'json');
	layer.closeAll();
}

function all_status (obj, goods_status) {
	//组装发送的数组
	var _length = $("input[name='goods_id[]']:checked").length;
	if (_length == 0) {
		layer.msg('请勾选要处理的商品id', {icon: 2});
		return false;
	}
	if(goods_status == 1){
		var str ='通过';
	}else{
		var str = '拒绝';
	}
	layer.confirm('您确定要审核'+str+'吗?',function (index) {
		var goods_id = new Array();
		$("input[name='goods_id[]']:checked").each(function () {
			goods_id.push($(this).val());
		})
		$.post('/Goods/ajaxStatus', {
			goods_id: goods_id,
			goods_status: goods_status,
		}, function (data) {
			if (data.status == 1) {
				if (goods_status == 1) {
					status = '<span class="btn btn-success btn-xs">审核通过</span>';
				} else {
					status = '<span class="btn btn-default btn-xs">审核拒绝</span>';
				}
				$.each(goods_id,function (k,v) {
					$("#goods_" + v).parents("td").prev().html(status);
				})
				layer.msg(data.info, {icon: 1});
			} else {
				layer.msg(data.info, {icon: 2});
			}

		}, 'json');
		layer.closeAll();
	})

}