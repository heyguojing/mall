<?php
namespace app\common\model;
use think\Db;

Class Region extends Common
{
    protected  $table;
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->table = "region";
    }
    /**
     * 获取子级地区数据
     */
    public function getChildData ($where = array(),$field = "*")
    {
        return Db::name($this->table)->where($where)->field($field)->select();
    }
}