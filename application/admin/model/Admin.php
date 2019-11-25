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
}