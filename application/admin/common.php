<?php
if(!function_exists('node_merge')){
    function node_merge($node,$access = null,$pid = 0){
        $arr = array();
        foreach($node as $val){
            if(is_array($access)){
                $val['access'] = in_array($val['id'],$access)?1:0;
            }
            if($val['pid'] == $pid){
                $val['child'] = node_merge($node,$access,$val['id']);
                $arr[] = $val;
            }
        }
        return $arr;
    }
}
if(!function_exists('save_log')){
    function save_log($msg,$type = 0,$param = 0)
    {
        $data = array(
            'log_info' => $msg,
            'log_user' => session(config('rbac.USER_AUTH_KEY')),
            'log_time' => time(),
            'log_ip' => get_client_ip(),
            'log_type' => $type,
            'log_controller' => defined('CONTROLLER_NAME')?CONTROLLER_NAME:'Login',
            'log_action' => defined('ACTION_NAME')?ACTION_NAME:'Login',
        );
        if($param){
            $data['param'] = serialize($_REQUEST);
        }
        Db::name('log')->data($data)->insert();
    }
}
if (!function_exists('show_child_class')) {
	function show_child_class ($class, $level = 2)
	{
		//分类级别
		//字符初始个数
		$str_init = 1;
		//保存空格
		$str = "";
		if (isset($class['child']) && !empty($class['child'])) {
			$str_num = $level * $str_init;//字符个数
			for ($i = 0; $i < $str_num; $i++) {
				$str .= "&nbsp;";
			}
			foreach ($class['child'] as $key => $vo) {
				//判断是否最后一个子类
				$str_tag = (($key + 1)) == count($class['child']) ? '└───&nbsp;' : '├───&nbsp;';
				$_html = '';
				$_html .= '<tr>';
				$_html .= '	<td>';
				$_html .= '		<label>';
				$_html .= '			<input type="checkbox" class="ace class_id" name="class_id[]"';
				$_html .= '			       value="' . $vo['class_id'] . '">';
				$_html .= '			<span class="lbl"></span>';
				$_html .= '		</label>';
				$_html .= '';
				$_html .= '	</td>';
				$_html .= '	<td>' . $vo['class_id'] . '</td>';
				$_html .= '	<td class="class_name">' . $str . $str_tag . $vo['class_name'] . '</td>';
				$_html .= '	<td>';
				$_html .= '		<input type="number" value="' . $vo['class_sort'] . '" class="class_sort" min="1" name="class_sort" class_id="' . $vo['class_sort'] . '">';
				$_html .= '	</td>';
				$_html .= '	<td>';
				if ($vo['class_status'] == 1):
					$_html .= '			<span class="label label-success radius ajax_get" value="0" title="点我停用"';
					$_html .= '			      type="class_status" class_id="' . $vo['class_id'] . '" txt="停用">已启用</span>';
				else:
					$_html .= '			<span class="label label-default radius ajax_get" value="1" title="点我启用"';
					$_html .= '			      type="class_status" class_id="' . $vo['class_id'] . '" txt="启用">停用</span>';
				endif;
				$_html .= '	</td>';
				$_html .= '	<td>';
				if ($vo['class_is_nav'] == 1):
					$_html .= '			<span class="label label-success radius ajax_get" value="0" title="点我关闭导航栏"';
					$_html .= '			      type="class_is_nav" class_id="' . $vo['class_id'] . '" txt="关闭">已显示</span>';
				else:
					$_html .= '			<span class="label label-default radius ajax_get" value="1" title="点我显示导航栏"';
					$_html .= '			      type="class_is_nav" class_id="' . $vo['class_id'] . '" txt="显示">关闭</span>';
				endif;
				$_html .= '	</td>';
				$_html .= '	<td>' . date('Y-m-d H:i:s', $vo['add_time']) . '</td>';
				$_html .= '	<td>';
				$_html .= '';
				$_html .= '		<a title="编辑"';
				$_html .= '		   href="' . url('GoodsClass/edit', array('class_id' => $vo['class_id'])) . '"';
				$_html .= '		   class="btn btn-xs btn-info">';
				$_html .= '			<i class="fa fa-edit bigger-120"></i>编辑';
				$_html .= '		</a>';
				$_html .= '		<a title="删除" href="javascript:;" onclick="confirm_msg(this)"';
				$_html .= '		   url="' . url('GoodsClass/del', array('class_id' => $vo['class_id'])) . '"';
				$_html .= '		   class="btn btn-xs btn-warning">';
				$_html .= '			<i class="fa fa-trash  bigger-120"></i>删除';
				$_html .= '		</a>';
				$_html .= '		<a title="添加子级"  href="' . url('GoodsClass/add', array('class_pid' => $vo['class_id'])) . '" class="btn btn-xs btn-danger">';
				$_html .= '			添加子级';
				$_html .= '		</a>';
				$_html .= '	</td>';
				$_html .= '</tr>';
				echo $_html;
				show_child_class($vo, $level + 1);
			}
		}
	}
}