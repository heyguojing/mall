<?php
namespace app\admin\controller;
use think\Db;
use think\facade\Session;
class Index extends Common
{
    /**
     * 后台首页渲染
     */
    public function index()
    {
        return $this->fetch();
    }
    /**
     * 中间内容
     */
    public function copy()
    {
        return $this->fetch();
    }
    /**
     * 登出
     */
    public function logout()
    {
        Session::clear();
        session_unset();
        $this->success('退出成功',url('Login/index'));
    }
}
