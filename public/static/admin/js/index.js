$(function () {
	$.each($(".submenu"), function () {
		var $aobjs = $(this).children("li");
		var rowCount = $aobjs.size();
		var divHeigth = $(this).height();
		$aobjs.height(divHeigth / rowCount);
	});
	//初始化宽度、高度

	$("#main-container").height($(window).height() - 132);
	$("#iframe").height($(window).height() - 196);

	$(".sidebar").height($(window).height() - 155);
	var thisHeight = $("#nav_list").height($(window).outerHeight() - 229);
	$(".submenu").height();
	$("#nav_list").children(".submenu").css("height", thisHeight);

	//当文档窗口发生改变时 触发  
	$(window).resize(function () {
		$("#main-container").height($(window).height() - 132);
		$("#iframe").height($(window).height() - 196);
		$(".sidebar").height($(window).height() - 155);

		var thisHeight = $("#nav_list").height($(window).outerHeight() - 229);
		$(".submenu").height();
		$("#nav_list").children(".submenu").css("height", thisHeight);
	});

	$(".menu .menu-nav li").click(function () {
		$(this).addClass('active').siblings().removeClass('active');
	});
	//ajax 异步加载菜单
	$(".menu .menu-nav li").click(function () {
		$(this).addClass('active').siblings().removeClass('active');
		var menu_id = $(this).find("a").attr('menu_id');
		$.post(ajax_menu_url, { menu_id: menu_id }, function (data) {
			$("#nav_list").html(data);
		}, 'html')
	});
	//页面加载读取菜单
	var menu_id = $(".menu .menu-nav a:eq(0)").attr('menu_id');
	$.post(ajax_menu_url,{menu_id:menu_id},function (data) {
		$("#nav_list").html(data);
	},'html')
	//时间设置
	function currentTime() {
		var d = new Date(),
			str = '';
		str += d.getFullYear() + '年';
		str += d.getMonth() + 1 + '月';
		str += d.getDate() + '日';
		str += d.getHours() + '时';
		str += d.getMinutes() + '分';
		str += d.getSeconds() + '秒';
		return str;
	}

	setInterval(function () {
		$('#time').html(currentTime)
	}, 1000);
	$('#Exit_system').on('click', function () {
		layer.confirm('是否确定退出系统？', {
			btn: ['是', '否'], //按钮
			icon: 2,
		},
			function () {
				location.href = "login.html";

			});
	});
	// 首页删除缓存
	$('.delCache').on("click", function () {
		var url = $(this).attr('url');
		layer.confirm('确定清楚缓存?', { icon: 3, title: '删除缓存' }, function (index) {
			$.ajax({
				type: 'post',
				url: url,
				data: '',
				dataType: 'json',
				success: function (data) {
					if (data.status == 1) {
						layer.msg(data.msg, { 'icon': 1 });
					} else {
						layer.msg(data.msg, { 'icon': 5 });
					}
				}
			})
		});
	});
})