$(function () {
	$('table th input:checkbox').on('click', function () {
		var that = this;
		$(this).closest('table').find('tr > td:first-child input:checkbox').each(function () {
			this.checked = that.checked;
			$(this).closest('tr').toggleClass('selected');
		});
	});
})

function confirm_msg (obj) {
	var url = $(obj).attr('url');
	layer.confirm('确认要删除吗?', function (index) {
		location.href = url;
	})
	return false;
}

//触发表单删除提交功能
function formAutoSubmit (input_class, right_form) {
	var data_tag = 0;
	//判断checkbox是否选中
	$("." + input_class).each(function () {
		if (this.checked) {
			data_tag = 1;
		}
	});
	//如果选中我们进行删除提交
	if (data_tag > 0) {
		layer.confirm('确认要删除吗?', function (index) {
			$("." + right_form).submit();
			return true;
		})
	}
	return false;
}
/**
 * ajax获取店铺地区
 * @param region_id
 * @param region_type
 */
function load_region (region_id, region_type) {
	$.post('/common/ajaxCity', {'region_pid': region_id}, function (data) {
		if (data.status == 1) {
			if (region_type == "store_city") {
				$("#" + region_type).html('<option value="0">请选择城市</option>');
				$("#store_district").html('<option value="0">请选择地区</option>');
			} else if (region_type == "store_district") {
				$("#store_district").html('<option value="0">请选择地区</option>');
			}
			if (region_type != "null") {
				$.each(data.region_data, function (k, vo) {
					$("#" + region_type).append('<option value="' + vo.region_id + '">' + vo.region_name + '</option>')
				})
			}
		} else {

		}
	}, 'json');
}

/**
 * 倒计时
 * @param _boolean
 * @param _this
 */
function count_down(_boolean, _this) {
	var sh = [];
	_this.each(function(index, el) {

		var thisObj = $(this);
		sh[index] = setInterval(function() {
			var endtime = thisObj.attr("data-times"); //获得timeBox的data值，即结束时间
			nowtime = new Date(); //获得当前时间
			nowtime = parseInt(nowtime.getTime() / 1000);
			lefttime = parseInt(endtime - nowtime); //结束时间-当前时间得到毫秒数，再除以1000得到两个时间相差的秒数

			if (_boolean) {
				d = parseInt(lefttime / 3600 / 24);
				h = parseInt((lefttime / 3600) % 24);
			} else {
				d = parseInt(lefttime / 3600 / 24) * 24;
				h = parseInt((lefttime / 3600) % 24) + d;
			}

			m = parseInt((lefttime / 60) % 60);
			s = parseInt(lefttime % 60);
			if (endtime <= nowtime) {
				d = h = m = s = "0";
				clearInterval(sh[index]);
			}
			// 三目运算符
			d = d < 10 ? "0" + d : d;
			h = h < 10 ? "0" + h : h;
			m = m < 10 ? "0" + m : m;
			s = s < 10 ? "0" + s : s;

			if (_boolean) {
				thisObj.find(".date").text(d);
			}

			thisObj.find(".hour").text(h);
			thisObj.find(".minutes").text(m);
			thisObj.find(".seconds").text(s);

			if (lefttime <= 0) {
				d = h = m = s = "00";
				clearInterval(sh[index]);
			}
		}, 1000);
	});
}