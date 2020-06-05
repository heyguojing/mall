$(function () {
	//表单验证
	$("form").Validform({
		tiptype: function (msg, o, cssctl) {
			if (!o.obj.is("form")) {
				//默认表单
				var objtip = o.obj.parents(".layui-form-item").find(".Validform_checktip");
				cssctl(objtip, o.type);
				objtip.text(msg);
			}
		},
		showAllError: true
	});
});
function load_region (region_id,region_type)
{
	$.post('/index/Common/ajaxCity',{'region_pid':region_id},function(data){
		if(data.status == 1){
			if(region_type == "store_city"){
				$('#' + region_type).html('<option value="0">请选择城市</option>');
				$('#store_district').html('<option value="0">请选择地区</option>');
			}else if(region_type == "store_district"){
				$('#' + region_type).html('<option value="0">请选择地区</option>');
			}if(region_type != "null"){
				$.each(data.region_data,function(key,val){
					$('#' + region_type).append('<option value="'+val.region_id+'">'+val.region_name+'</option>')
				});
			}
		}else{
			console.log('选择错误');
		}
	},'json')
}