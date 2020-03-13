<?php
namespace app\admin\model;
use think\Db;

class ConfigGroup extends Common
{
    protected $table;
    public function __construct($data = array()){
        parent::__construct($data);
        $this->table = "config_group";
    }
    /**
     * 节点分页 求总数
     * 
     */
    public function pageData($param = array(),$range = 'total')
    {
        $where = array();
        // 状态判断是否展示
        if(isset($param['group_status']) && $param['group_status'] > -1){
            $where[] = array('group_status','=',$param['group_status']);
        }
        // 根据角色中文名查询
        if(isset($param['group_name']) && $param['group_name'] != ''){
            $where[] = array('group_name','like','%'.$param['group_name'].'%');
        }
        // 根据title名查询
        if(isset($param['group_title']) && $param['group_title'] != ''){
            $where[] = array('group_title','like','%'.$param['group_title'].'%');
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
            $order = isset($param['order'])?$param['order']:'group_id desc';
            return Db::name($this->table)->where($where)->field($field)->limit($limit)->order($order)->select();
        }
    }
    /**
     * 配置组验证英文名称
     */
    public function ajaxGroupName($group_name,$group_id = 0)
    {
        if(empty($group_name)){
            return true;
        }
        $where = array();
        $where[] = array('group_name','=',$group_name);
        if($group_id > 0){ 
            $where[] = array('group_id','<>',$group_id);
        }
        return Db::name($this->table)->where($where)->find();
    }
    /**
     * 配置组验证中文名称
     */
    public function ajaxGroupTitle($group_title,$group_id = 0)
    {
        if(empty($group_title)){
            return true;
        }
        $where = array();
        $where[] = array('group_title','=',$group_title);
        if($group_id > 0){ 
            $where[] = array('group_id','<>',$group_id);
        }
        return Db::name($this->table)->where($where)->find();
    }
}