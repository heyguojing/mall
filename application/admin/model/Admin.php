<?php
namespace app\admin\model;
use think\Db;

class Admin extends Common
{
    protected $table;
    public function __construct($data = array()){
        parent::__construct($data);
        $this->table = "admin";
    }
        /**
     * 节点分页 求总数
     * 
     */
    public function pageData($param = array(),$range = 'total')
    {
        $where = array();
        // 状态判断是否展示
        if(isset($param['status']) && $param['status'] > -1){
            $where[] = array('status','=',$param['status']);
        }
        // 根据角色中文名查询
        if(isset($param['username']) && $param['username'] != ''){
            $where[] = array('username','like','%'.$param['username'].'%');
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
            $order = isset($param['order'])?$param['order']:'id asc';
            return Db::name($this->table)->where($where)->field($field)->limit($limit)->order($order)->select();
        }
    }
    /**
     * 验证用户名是否重复
     */
    public function ajaxValidate($val,$admin_id = 0)
    {
        if(empty($val)){
            return true;
        }
        $where = array();
        $where[] = array('username','=',$val);
        if($admin_id > 0){ 
            $where[] = array('admin_id','!=',$admin_id);
        }
        return Db::name($this->table)->where($where)->find();
    }
}