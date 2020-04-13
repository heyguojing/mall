<?php

namespace app\index\controller;
use think\captcha\Captcha;
use think\Db;

class Login extends Common
{
    public function __construct()
    {
        parent::construct();
    }
    public function reg()
    {
        if($this->request->isPost && $this->request->isAjax){

        }else{
            return $this->fetch();
        }
    }
}