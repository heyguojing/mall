$(function () {
	if ($("#store_time_start").length > 0) {
		laydate({
			elem: '#store_time_start',
			event: 'focus'
		});
		laydate({
			elem: '#store_time_end',
			event: 'focus'
		});
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
		showAllError: true
	});
	//ajax更新相关信息
	$(".ajax_get").live('click', function () {
		var type = $(this).attr('type');
		var value = $(this).attr('value');
		var store_id = $(this).attr('store_id');
		var obj = $(this);
		var _html = obj.attr('txt');
		layer.confirm('确认' + _html + '吗？', function (index) {
			layer.closeAll();
			$.post(ajax_url, {type: type, value: value, store_id: store_id}, function (data) {
				if (data.status == 1) {
					value = parseInt(value);
					if (value == 1) {
						if (type == "store_status") {
							obj.attr('title', '点我禁用').html('已启用').attr('txt', '禁用');
						} else if (type == "store_is_domain") {
							obj.attr('title', '点我未通过').html('已通过').attr('txt', '未通过');
						}
						obj.addClass('label-success').removeClass('label-default');
						obj.attr('value', 0);
					} else {
						if (type == "store_status") {
							obj.attr('title', '点我启用').html('禁用').attr('txt', '启用');
						} else if (type == "store_is_domain") {
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
	if($("#store_logo").length > 0){
		layui.use(['form', 'upload'], function () {
			var upload = layui.upload;
			upload_img('store_logo');
			upload_img('store_card_front');
			upload_img('store_card_side');
			function upload_img (id) {
				//选完文件后自动上传
				upload.render({
					elem: '#'+id,
					url: "/common/upload",
					auto: true,
					accept: 'file', //普通文件
					data :{type:id,name:'file'},
					before: function (obj) {
						var img_url = $('input[name='+id+']').val();
						// 删除老数据
						if (img_url != '') {
							$.ajax({
								url: "/common/delImg",
								type: 'POST',
								data: {
									img_url: img_url
								},
							});
						}
						//本地本地预览示例
						obj.preview(function(index,file,result){
							$("#"+id+"_thumb").attr('src',result).show();
						});
					},
					done: function (res) {
						//上传完毕回调
						if (res.code > 0) {
							return layer.msg('上传失败');
						} else {
							$("#"+id+"_thumb").attr('src',res.data.src).show();
							$('input[name='+id+']').val(res.data.src);
						}
					}
				});
			}
		});
	}
});
