<?php
namespace app\common\model;
use think\Db;

Class User extends Common{
    protected  $table;
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->table = "user";
    }
}