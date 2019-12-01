$(function () {
	//ajax更新相关信息
	$(".ajax_get").live('click', function () {
		var type = $(this).attr('type');
		var value = $(this).attr('value');
		var group_id = $(this).attr('group_id');
		var obj = $(this);
		var _html = obj.attr('txt');
		layer.confirm('确认' + _html + '吗？', function (index) {
			layer.closeAll();
			$.post(ajax_url, {type: type, value: value, group_id: group_id}, function (data) {
				if (data.status == 1) {
					value = parseInt(value);
					if (value == 1) {
						if (type == "group_status") {
							obj.attr('title', '点我停用').html('已启用').attr('txt', '停用');
						}
						obj.addClass('label-success').removeClass('label-default');
						obj.attr('value', 0);
					} else {
						if (type == "group_status") {
							obj.attr('title', '点我启用').html('停用').attr('txt', '启用');
						}
						obj.addClass('label-default').removeClass('label-success');
						obj.attr('value', 1);
					}
				} else {
					layer.msg(data.info, {icon: 2});
				}
			}, 'json')
		})
	});
	//ajax排序
	$(".group_sort").on("change",function(){
		var value = $(this).val();
		var type = $(this).attr('name');
		var group_id = $(this).attr('group_id');
		$.post(ajax_url, {type:type, value: value, group_id: group_id}, function (data) {
			if (data.status == 1) {
				//layer.msg(data.info, {icon: 1});
			} else {
				layer.msg(data.info, {icon: 2});
			}
		}, 'json');
	})
})