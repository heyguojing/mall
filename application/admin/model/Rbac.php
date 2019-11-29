<?php
namespace app\admin\model;
use think\Model;
class Rbac extends Common
{
    protected $table;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'node';
    }
}