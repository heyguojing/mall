<?php
namespace app\index\controller;

use think\Db;
use think\Controller;

class Index extends Common
{
    public function index()
    {
        return $this->fetch();
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
