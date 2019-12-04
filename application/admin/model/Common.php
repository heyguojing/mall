<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Common extends Model
{
    protected $table;
    public function __construct($data = array())
    {
        parent::__construct($data);
    }
    /**
     * 添加数据
     */
    public function addData($data = array())
    {
        return Db::name($this->table)->data($data)->insert();
    }
    /**
     * 更新数据
     */
    public function saveData($where = array(),$data = array())
    {
        return Db::name($this->table)->where($where)->update($data);
    }
    /**
     * 删除数据
     */
    public function delData($where)
    {
        return Db::name($this->table)->where($where)->delete();
    }
    /**
     * 返回某个字段 value
     */
    public function getValue($where = array(),$filed = "")
    {
        return Db::name($this->table)->where($where)->value($filed);
    }
    /**
     * 返回一条数据 find
     */
    public function getOne($where = array(),$field = "",$order = "")
    {
        return Db::name($this->table)->where($where)->field($field)->order($order)->find();
    }
    /**
     * 获取多个字段，指定键值
     */
    public function getField($where,$field,$key)
    {
        return Db::name($this->table)->where($where)->column($field);
    }
    /**
     * 设置字段递增
     */
    public function setIncData($where = array(),$field = "",$num = 1) 
    {   
        return Db::name($this->table)->where($where)->setInc($field,$num);
    }
    /**
     * 设置字段递减
     */
    public function setDec($where = array(),$field = "",$num = 1)
    {
        return Db::name($this->table)->where($where)->setDec($field,$num);
    }
}