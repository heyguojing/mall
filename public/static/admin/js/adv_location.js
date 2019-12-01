var adv_location = {
	is_lock: false,
};
//请求前
adv_location.ajax_before = function () {
	adv_location.is_lock = true;
}
//请求完成
adv_location.ajax_complete = function () {
	adv_location.is_lock = false;
}

/**
 * 添加广告位
 */
function add_adv_location () {
	open_adv_location('add', 0);
}

/**
 * 编辑广告位
 * @param obj
 * @param location_id
 */
function edit_adv_location (obj, location_id) {
	open_adv_location('this', location_id);
}

function open_adv_location (type, location_id) {
	if (type == 'add') {
		var title = '添加广告位';
	} else {
		var title = '编辑广告位';
	}
	if (location_id > 0) {
		var url = '/adv_location/edit';
		$.ajax({
			beforeSend: adv_location.ajax_before,
			type: "POST",
			url: "/adv_location/editAdvLocation",
			data: {
				location_id: location_id
			},
			dataType: 'json',
			success: function (data) {
				if (data.status == 1) {
					$("[name=location_name]").val(data.adv_location_one.location_name);
					$("[name=location_title]").val(data.adv_location_one.location_title);
					$("[name=location_desc]").val(data.adv_location_one.location_desc);
					$("[name=location_width]").val(data.adv_location_one.location_width);
					$("[name=location_height]").val(data.adv_location_one.location_height);
					if (data.adv_location_one.location_status == 1) {
						$("[name=location_status]:eq(0)").attr('checked', 'checked');
					} else {
						$("[name=location_status]:eq(1)").attr('checked', 'checked');
					}
					if (data.adv_location_one.location_type == 1) {
						$("[name=location_type]:eq(0)").attr('checked', 'checked');
					} else {
						$("[name=location_type]:eq(1)").attr('checked', 'checked');
					}

					ajax_adv_location(title, url, location_id)
				} else {
					layer.msg(data.info, {icon: 2});
				}
			},
			complete: adv_location.ajax_complete
		});
	} else {
		var url = '/adv_location/add';
		$("[name=location_name]").val('');
		$("[name=location_title]").val('');
		$("[name=location_desc]").val('');
		$("[name=location_width]").val('');
		$("[name=location_height]").val('');
		$("[name=location_status]:eq(0)").attr('checked', 'checked');
		$("[name=location_type]:eq(0)").attr('checked', 'checked');
		ajax_adv_location(title, url, location_id);
	}

}

function ajax_adv_location (title, url, location_id) {
	layer.open({
		type: 1,
		title: title,
		maxmin: true,
		shadeClose: false, //点击遮罩关闭层
		area: ['750px', ''],
		content: $('#sort_style_add'),
		btn: ['确定', '取消'],
		yes: function () {
			//英文名称
			var location_name = $.trim($("[name=location_name]").val());
			if (location_name == "") {
				layer.msg("请输入广告位英文名称", {icon: 2});
				return false;
			}
			//中文名称
			var location_title = $.trim($("[name=location_title]").val());
			if (location_title == "") {
				layer.msg("请输入广告位中文名称", {icon: 2});
				return false;
			}
			//描述
			var location_desc = $.trim($("[name=location_desc]").val());
			if (location_desc == "") {
				layer.msg("请输入广告位说明", {icon: 2});
				return false;
			}
			//宽度
			var location_width = $.trim($("[name=location_width]").val());
			if (location_width == "") {
				layer.msg("请输入广告位图宽度", {icon: 2});
				return false;
			}
			//高度
			var location_height = $.trim($("[name=location_height]").val());
			if (location_height == "") {
				layer.msg("请输入广告位图高度", {icon: 2});
				return false;
			}
			//状态
			var location_status = $("[name=location_status]:checked").val();
			//类型
			var location_type = $("[name=location_type]:checked").val();
			if (adv_location.is_lock == true) {
				layer.msg('正在处理中请稍后', {icon: 2});
				return false;
			}
			$.ajax({
				beforeSend: adv_location.ajax_before,
				type: "POST",
				url: url,
				data: {
					location_name: location_name,
					location_title: location_title,
					location_desc: location_desc,
					location_width: location_width,
					location_height: location_height,
					location_status: location_status,
					location_type: location_type,
					location_id: location_id
				},
				dataType: 'json',
				success: function (data) {
					if (data.status == 1) {
						layer.msg(data.info, {icon: 1});
						setTimeout(function () {
							location.href = '';
						}, 1000)
					} else {
						layer.msg(data.info, {icon: 2});
					}
				},
				complete: adv_location.ajax_complete
			});
		}
	});
}

/**
 * 统计字数
 * @param which
 * @returns {boolean}
 */
function check_length (which) {
	var maxChars = 200; //
	if (which.value.length > maxChars) {
		layer.open({
			icon: 2,
			title: '提示框',
			content: '您出入的字数超多限制!',
		});
		// 超过限制的字数了就将 文本框中的内容按规定的字数 截取
		which.value = which.value.substring(0, maxChars);
		return false;
	} else {
		var curr = maxChars - which.value.length; //250 减去 当前输入的
		document.getElementById("sy").innerHTML = curr.toString();
		return true;
	}
};
