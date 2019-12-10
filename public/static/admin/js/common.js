/**
 * 角色列表全选
 */
$(function(){
	$('table th input:checkbox').on('click', function () {
		var that = this;
		$(this).closest('table').find('tr > td:first-child input:checkbox').each(function () {
			this.checked = that.checked;
			$(this).closest('tr').toggleClass('selected');
		});
	});
})
/**
 * 删除confirm_msg
 */
function confirm_msg(obj){
	var url = $(obj).attr('url');
	console.log(url);
	layer.confirm('确定删除吗sss?',function(index){
		location.href=url;
	})
	return false;
}
/**
 * 角色全选提交
 */
function formAutoSubmit(id,right_form){
	var tag = 0;
	$("." + id).each(function(){
		if($(this).attr("checked",true)){
			tag = 1;
		}
	});
	if(tag > 0){
		layer.confirm('确认删除吗？',function(index){
			$('.' + right_form).submit();
			return true;
		})
	}
	return false;
}