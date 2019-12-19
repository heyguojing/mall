<?php
namespace app\admin\controller;
use think\Db;
use Org\Util\Dir;
use think\facade\Env;
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
    /**
     * 删除缓存
     */
    public function delCache()
    {
        if(Dir::del(Env::get('runtime_path').'cache/')){
            $res = array('status' => 1,'msg' => '缓存文件删除成功');
        }else{
            $res = array('status' => 0,'msg' => '缓存文件已经删除过了');
        }
        return json($res);
    }
}
