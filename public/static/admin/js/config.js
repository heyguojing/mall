$(function(){
	// ajax 异步更新config_group状态
	$('.ajax_get').on('click',function(){
		var type = $(this).attr('type');
		var value = $(this).attr('value');
		var config_id = $(this).attr('config_id');
		var html = $(this).attr('txt');
		layer.confirm('确定'+html+'吗?',{icon:3,title:'提示',btn2:function(index){
			layer.close(index);
		}},function(index){
			layer.close(index);
			$.post(ajax_url,{type:type,config_id:config_id,value:value},function(data){
				if(data.status == 1){
					if(parseInt(value) == 1){
						if(type == 'config_status'){
							$(this).attr('title','点我停用').html('已启用').attr('txt','停用');
						}
						$(this).removeClass('label-default').addClass('label-success');
						$(this).attr('value',0);
						window.location.reload();
					}else{
						if(type == 'config_status'){
							$(this).attr('title','点我启用').html('停用').attr('txt','启用');
						}
						$(this).removeClass('label-success').addClass('label-default');
						$(this).attr('value',1);
						window.location.reload();
					}
				}else{
					layer.msg(data.info,{icon:2});
				}
			},'json');
			layer.close(index);
		});
	});
	// ajax 异步更新config_group排序
	$(".config_sort").on("blur",function(){
		var type = $(this).attr('name');
		var value = $(this).val();
		var config_id = $(this).attr('config_id');
		$.post(ajax_url,{type:type,config_id:config_id,value:value},function(data){
			if(data.status == 1){
				layer.msg(data.info,{icon:1});
			}else{
				layer.msg(data.info,{icon:5});
			}
		},'json')
	});
})