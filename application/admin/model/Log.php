<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Log extends Common
{
    protected $log;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'log';
    }
    /**
     * 节点分页 求总数
     * 
     */
    public function pageData($param = array(),$range = 'total')
    {
        $where = array();
        // 状态判断是否展示
        if(isset($param['logType']) && $param['logType'] > -1){
            $where[] = array('logType','=',$param['logType']);
        }
        // 根据角色中文名查询
        if(isset($param['username']) && $param['username'] != ''){
            $where[] = array('username','like','%'.$param['username'].'%');
        }
        if($range == 'total'){
            // 求总数
            return Db::name($this->table)->alias('L')->join(config('database.prex').'admin A','L.log_user = A.admin_id','LEFT')->where($where)->count();
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
            $order = isset($param['order'])?$param['order']:'logid desc';
            return Db::name($this->table)->alias('L')->join(config('database.prefix').'admin A','L.log_user = A.admin_id','LEFT')->where($where)->field($field)->limit($limit)->order($order)->select();
        }
    }
   
}