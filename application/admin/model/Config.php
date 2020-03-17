<?php
namespace app\admin\model;
use think\Db;

class Config extends Common
{
    protected $table;
    public function __construct($data = array()){
        parent::__construct($data);
        $this->table = "config";
    }
    /**
     * 节点分页 求总数
     * 
     */
    public function pageData($param = array(),$range = 'total')
    {
        $where = array();
        // 判断组id是否大于0
        if(isset($param['group_id']) && $param['group_id'] > -1){
            $where[] = array('group_id','=',$param['group_id']);
        }
        // 状态判断是否展示
        if(isset($param['config_status']) && $param['config_status'] > -1){
            $where[] = array('config_status','=',$param['config_status']);
        }
        // 根据角色中文名查询
        if(isset($param['config_name']) && $param['config_name'] != ''){
            $where[] = array('config_name','like','%'.$param['config_name'].'%');
        }
        // 根据title名查询
        if(isset($param['config_title']) && $param['config_title'] != ''){
            $where[] = array('config_title','like','%'.$param['config_title'].'%');
        }
        if($range == 'total'){
            // 求总数
            return Db::name($this->table)->where($where)->count();
        }else{
            // 分页
            $limit = isset($param['limit'])?(int)$param['limit']:0;
            if($limit > 0){
                $page = isset($param['page'])?(int)$param['page']:1;
                $limit_start = ($page-1)*$limit;
                $limit = $limit_start.','.$limit;
            }else{
                $limit = 0;
            }
            // 字段
            $field = isset($param['field'])?$param['field']:"";
            // 排序
            $order = isset($param['order'])?$param['order']:'config_id desc';
            return Db::name($this->table)->where($where)->field($field)->limit($limit)->order($order)->select();
        }
    }
    /**
     * 配置组验证英文名称
     */
    public function ajaxConfigName($config_name,$config_id = 0)
    {
        if(empty($config_name)){
            return 1;
        }
        $where = array();
        $where[] = array('config_name','=',$config_name);
        if($config_id > 0){ 
            $where[] = array('config_id','<>',$config_id);
        }
        return Db::name($this->table)->where($where)->find();
    }
    /**
     * 配置组验证中文名称
     */
    public function ajaxConfigTitle($config_title,$config_id = 0)
    {
        if(empty($config_title)){
            return 1;
        }
        $where = array();
        $where[] = array('config_title','=',$config_title);
        if($config_id > 0){ 
            $where[] = array('config_id','<>',$config_id);
        }
        return Db::name($this->table)->where($where)->find();
    }
}