<?php
namespace app\admin\controller;
use think\Db;
class Index
{
    public function index()
    {
        $data = model("Admin")->getOne(array("admin_id" => 1),"username");
        var_dump($data);
    }
}
