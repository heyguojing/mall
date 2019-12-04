/**
 * 删除confirm_msg
 */
function confirm_msg(obj){
	var url = $(obj).attr('url');
	console.log(url);
	layer.confirm('确定删除吗?',function(index){
		location.href=url;
	})
	return false;
}