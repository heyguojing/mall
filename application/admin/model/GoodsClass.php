<?php
namespace app\admin\model;
use think\Db;
use think\facade\Env;
use Org\Util\Dir;
class GoodsClass extends Common
{
    protected $table;
    public function __construct($data = array()){
        parent::__construct($data);
        $this->table = "goods_class";
    }
    /**
     * 节点分页 求总数
     * 
     */
    public function pageData($param = array(),$range = 'total')
    {
        $where = array();
        // 状态判断是否展示
        if(isset($param['class_status']) && $param['class_status'] > -1){
            $where[] = array('class_status','=',$param['class_status']);
        }
        // 根据角色中文名查询
        if(isset($param['class_name']) && $param['class_name'] != ''){
            $where[] = array('class_name','like','%'.$param['class_name'].'%');
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
            $order = isset($param['order'])?$param['order']:'class_id desc';
            return Db::name($this->table)->where($where)->field($field)->limit($limit)->order($order)->select();
        }
    }
    /**
     * 配置组验证名称
     */
    public function ajaxClassName($class_name,$class_pid = 0,$class_id = 0)
    {
        if(empty($class_name)){
            return 1;
        }
        $where = array();
        $where[] = array('class_name','=',$class_name);
        $where[] = array('class_pid','=',$class_pid);
        //$where = array('class_name' => $class_name);等价
        if($class_id > 0){ 
            $where[] = array('class_id','<>',$class_id);
        } 
        return Db::name($this->table)->where($where)->find();
    }
   
}