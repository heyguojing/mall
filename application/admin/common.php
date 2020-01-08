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