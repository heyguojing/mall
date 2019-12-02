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