$(function () {
	//ajax更新相关信息
	$(".ajax_get").on('click', function () {
		var type = $(this).attr('type');
		var value = $(this).attr('value');
		var class_id = $(this).attr('class_id');
		var obj = $(this);
		var _html = obj.attr('txt');
		layer.confirm('确认' + _html + '吗？', function (index) {
			layer.close(index);
			$.post(ajax_url, {type: type, value: value, class_id: class_id}, function (data) {
				if (data.status == 1) {
					value = parseInt(value);
					if (value == 1) {
						if (type == "class_status") {
							obj.attr('title', '点我停用').html('已启用').attr('txt', '停用');
							window.location.reload();
						}else if(type == "class_is_nav"){
							obj.attr('title', '点我关闭导航栏').html('已显示').attr('txt', '关闭');
							window.location.reload();
						}
						obj.addClass('label-success').removeClass('label-default');
						obj.attr('value', 0);
						window.location.reload();
					} else {
						if (type == "class_status") {
							obj.attr('title', '点我启用').html('停用').attr('txt', '启用');
						}else if(type == "class_is_nav"){
							obj.attr('title', '点我显示导航栏').html('关闭').attr('txt', '显示');
						}
						obj.addClass('label-default').removeClass('label-success');
						obj.attr('value', 1);
					}
				} else {
					layer.msg(data.info, {icon: 2});
					location.reload();
				}
			}, 'json')
		});
	});
	//ajax排序
	$(".class_sort").on("change",function(){
		var value = $(this).val();
		var type = $(this).attr('name');
		var class_id = $(this).attr('class_id');
		$.post(ajax_url, {type:type, value: value, class_id: class_id}, function (data) {
			if (data.status == 1) {
				layer.msg(data.info, {icon: 1});
				window.location.reload();
			} else {
				layer.msg(data.info, {icon: 2});
				window.location.reload();
			}
		}, 'json');
	})
})