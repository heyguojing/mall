<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Role extends Common
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'role';
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
        if(isset($param['remark']) && $param['remark'] != ''){
            $where[] = array('remark','like','%'.$param['remark'].'%');
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
     * 删除数据
     */
    public function delData($role_id)
    {
        // 删除权限
        Db::name('access')->where(array('role_id' => $role_id))->delete();
        // 删除角色
        return Db::name($this->table)->where(array('id' => $role_id))->delete();
    }
    /**
     * 获取当前角色的权限
     */
    public function accessGetField($where,$field)
    {
        return Db::name('access')->where($where)->column($field);
    }
    /**
     * 删除角色原有权限
     */
    public function accessDelData($where)
    {
        return Db::name('access')->where($where)->delete();
    }
    /**
     * 设置新的权限
     */
    public function accessAddData($data)
    {
        $res =  Db::name('access')->insertAll($data);
        return $res;
    }
    /**
     *  添加用户与角色中间表
     */
    public function userRoleAddData($data)
    {
        return Db::name('role_user')->insertAll($data);
    }
    /**
     * 删除原有角色
     */
    public function delUserRole($where = array()){
        return Db::name('role_user')->where($where)->delete();
    }
    /**
     * 添加新角色
     */
    public function addUserRole($data)
    {
        return DB::name('role_user')->insertAll($data);
    }
}