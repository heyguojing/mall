$(function () {
	if ($("#user_birthday").length > 0) {
		laydate({
			elem: '#user_birthday',
			event: 'focus'
		})
	}
	//表单验证
	$("form").Validform({
		tiptype: function (msg, o, cssctl) {
			if (!o.obj.is("form")) {
				//默认表单
				var objtip = o.obj.parents(".formControls").find(".Validform_checktip");
				cssctl(objtip, o.type);
				objtip.text(msg);
			}
		},
		//自定义类型
		datatype: {
			"email": function (gets, obj, curform, regxp) {
				/*参数gets是获取到的表单元素值，
				  obj为当前表单元素，
				  curform为当前验证的表单，
				  regxp为内置的一些正则表达式的引用。*/

				var reg1 = regxp["m"];
				var reg2 = regxp["e"];
				var user_mobile = curform.find("[name=user_mobile]");
				//验证手机号码
				if (reg1.test(user_mobile.val())) {
					return true;
				}
				//验证邮箱
				if (reg2.test(gets)) {
					return true;
				}
				return false;
			}
		},
		showAllError: true
	});
	//ajax更新相关信息
	$(".ajax_get").live('click', function () {
		var type = $(this).attr('type');
		var value = $(this).attr('value');
		var uid = $(this).attr('uid');
		var obj = $(this);
		var _html = obj.attr('txt');
		layer.confirm('确认' + _html + '吗？', function (index) {
			layer.closeAll();
			$.post(ajax_url, {type: type, value: value, uid: uid}, function (data) {
				if (data.status == 1) {
					value = parseInt(value);
					if (value == 1) {
						if (type == "user_status") {
							obj.attr('title', '点我禁用').html('已启用').attr('txt', '禁用');
						} else if (type == "user_card_status") {
							obj.attr('title', '点我未通过').html('已通过').attr('txt', '未通过');
						}
						obj.addClass('label-success').removeClass('label-default');
						obj.attr('value', 0);
					} else {
						if (type == "user_status") {
							obj.attr('title', '点我启用').html('禁用').attr('txt', '启用');
						} else if (type == "user_card_status") {
							obj.attr('title', '点我通过').html('未通过').attr('txt', '通过');
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
});
