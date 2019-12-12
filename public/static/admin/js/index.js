$(function () {
	// 首页删除缓存
	$('.delCache').on("click", function () {
		var url = $(this).attr('url');
		layer.confirm('确定清楚缓存?', { icon: 3, title: '删除缓存' }, function (index) {
			$.ajax({
				type: 'post',
				url: url,
				data: '',
				dataType:'json',
				success: function (data) {
					if (data.status == 1) {
						layer.msg(data.msg, { 'icon': 1});
					} else {
						layer.msg(data.msg, { 'icon': 5});
					}
				}
			})
		});
	});
})