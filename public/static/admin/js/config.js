$(function () {
	//ajax更新相关信息
	$(".ajax_get").live('click', function () {
		var type = $(this).attr('type');
		var value = $(this).attr('value');
		var config_id = $(this).attr('config_id');
		var obj = $(this);
		var _html = obj.attr('txt');
		layer.confirm('确认' + _html + '吗？', function (index) {
			layer.closeAll();
			$.post(ajax_url, {type: type, value: value, config_id: config_id}, function (data) {
				if (data.status == 1) {
					value = parseInt(value);
					if (value == 1) {
						if (type == "config_status") {
							obj.attr('title', '点我停用').html('已启用').attr('txt', '停用');
						}
						obj.addClass('label-success').removeClass('label-default');
						obj.attr('value', 0);
					} else {
						if (type == "config_status") {
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
	$(".config_sort").on("change",function(){
		var value = $(this).val();
		var type = $(this).attr('name');
		var config_id = $(this).attr('config_id');
		$.post(ajax_url, {type:type, value: value, config_id: config_id}, function (data) {
			if (data.status == 1) {
				//layer.msg(data.info, {icon: 1});
			} else {
				layer.msg(data.info, {icon: 2});
			}
		}, 'json');
	})
})