$(function() {
	//表单验证
	$("form").Validform({
		tiptype:function(msg,o,cssctl){
			if(!o.obj.is("form")){
				//默认表单
				var objtip=o.obj.parents(".formControls").find(".Validform_checktip");
				var objtip_1=o.obj.parents("td").find(".Validform_checktip");
				objtip = objtip_1.length == 1?objtip_1:objtip;
				cssctl(objtip,o.type);
				objtip.text(msg);
			}
		},
		showAllError:true
	});
	//ajax更新相关信息
	$(".ajax_get").live('click', function () {
		var type = $(this).attr('type');
		var value = $(this).attr('value');
		var type_id = $(this).attr('type_id');
		var obj = $(this);
		var _html = obj.attr('txt');
		layer.confirm('确认' + _html + '吗？', function (index) {
			layer.closeAll();
			$.post(ajax_url, {type: type, value: value, type_id: type_id}, function (data) {
				if (data.status == 1) {
					value = parseInt(value);
					if (value == 1) {
						if (type == "type_status") {
							obj.attr('title', '点我停用').html('已启用').attr('txt', '停用');
						}
						obj.addClass('label-success').removeClass('label-default');
						obj.attr('value', 0);
					} else {
						if (type == "type_status") {
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
});
function add_attr () {
	var _html = "";
	_html+='<tr>';
	_html+='	<td>';
	_html+='	    <input type="text" name="attr_name[]" placeholder="输入参数名称" datatype="*" nullmsg="参数名称不能为空！">';
	_html+='	    <span class="Validform_checktip"></span>';
	_html+='	</td>';
	_html+='	<td>';
	_html+='	    <select class="form-control" name="attr_style[]">';
	_html+='		<option value="0">参数</option>';
	_html+='		<option value="1">规格</option>';
	_html+='	    </select>';
	_html+='	</td>';
	_html+='	<td>';
	_html+='	    <select class="form-control" name="attr_type[]">';
	_html+='		<option value="1">单选框</option>';
	_html+='		<option value="2">复选框</option>';
	_html+='		<option value="3">输入框</option>';
	_html+='		<option value="4">下拉框</option>';
	_html+='	    </select>';
	_html+='	</td>';
	_html+='	<td>';
	_html+='	    <input type="text" name="attr_value[]" placeholder="多个值巩逗号区分" datatype="*" nullmsg="参数值不能为空！">';
	_html+='	    <span class="Validform_checktip"></span>';
	_html+='	</td>';
	_html+='	<td>';
	_html+='	    <input type="text" name="attr_unit[]" placeholder="单位" value="">';
	_html+='	</td>';
	_html+='	<td>';
	_html+='	    <input type="checkbox" name="attr_search[]" value="1">';
	_html+='	</td>';
	_html+='	<td>';
	_html+='	    <input type="number" name="attr_sort[]" value="'+i+'" datatype="n" nullmsg="参数排序不能为空！">';
	_html+='	    <span class="Validform_checktip"></span>';
	_html+='	</td>';
	_html+='	<td>';
	_html+='        <input type="hidden" name="attr_id[]" value="'+i+'" />';
	_html+='	    <a title="删除" href="javascript:;" onclick="del_attr(this)"  class="btn btn-xs btn-warning">';
	_html+='		<i class="fa fa-trash  bigger-120"></i>';
	_html+='	    </a>';
	_html+='	</td>';
	_html+='</tr>';
	$("tbody").append(_html);
	i++;
}
function del_attr (obj) {
	$(obj).parents("tr").remove();
}