<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Session;

class Common extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function initialize()
    {
        if(!Session::has('uid')){
            $this->error('您还未登录，请登录','Login/index');
        }
    }
}