<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Session;
use Org\Util\Rbac;
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
        // 定义模块，控制器，方法
        define('MODULE_NAME',$this->request->module());
        define('CONTROLLER_NAME',$this->request->controller());
        define('ACTION_NAME',$this->request->action());
        // 判断无需验证的模块方法
        $notAuth = in_array(CONTROLLER_NAME,explode(',',config('rbac.NOT_AUTH_MODULE'))) || in_array(ACTION_NAME,explode(',','rbac.NOT_AUTH_ACTION'));
        // 验证权限
        if(config('rbac.USER_AUTH_ON') && !$notAuth){
            $res = Rbac::AccessDecision();
            if($res == 0){
                $this->error('亲，你没有操作权限');
            }
        }
    }
}