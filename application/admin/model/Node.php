<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Node extends Common
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'node';
    }
    /**
     * 节点分页 求总数
     * 
     */
    public function pageData($param = array(),$range = 'total')
    {
        $where = array();
        // 父级id
        if(isset($param['pid']) && $param['pid'] > 0){
            $where[] = array('pid' => $param['pid']);
        }
        // 是否展示
        if(isset($param['is_show']) && $param['is_show'] > -1){
            $where[] = array('is_show' => $param['is_show']);
        }
        // 等级
        if(isset($param['level']) &&$param['level'] > 0){
            $where = array('level' => $param['level']);
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
}