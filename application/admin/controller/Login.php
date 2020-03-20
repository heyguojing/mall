<?php
namespace app\admin\controller;
use think\Controller;
use think\captcha\Captcha;
use think\facade\Session;
use Org\Util\Rbac;
class Login extends Controller
{
    protected $admin = '';
    public function __construct(){
        parent::__construct();
        $this->admin = model('Admin');
    }
    public function index()
    {
        if(Session::has('uid')){
            return $this->redirect(url('index/index'));
        }else{
            if(config('site.SHOW_VERIFY') == 1){
                $this->assign('show_verify',1);
            }else{
                $this->assign('show_verify',0);
            }
            return $this->fetch();
        }
    }
    public function verify()
    {
        ob_clean();//清楚缓存
        $captcha = new Captcha();
        $captcha->codeSet = '123456789';
        $captcha->fontSize = config('site.CODE_FONT_SIZE');
        $captcha->length = config('site.CODE_LEN');
        $captcha->useCurve = config('site.CODE_CURVE');
        $captcha->useNoise = config('site.CODE_NOISE');
        return $captcha->entry();
    }
    public function login()
    {
        $username = input('username');
        $password = input('password');
        $code = input('code');
        if(empty($code) && config('site.SHOW_VERIFY') == 1){
            return json(array('status' => 0,'msg' => '验证码为空!'));
        }
        // 判断用户名和密码是否为空
        if((empty($username) || empty($password))){
            return json(array('status' => 0,'msg' => '用户名或密码不能为空!!!'));
        }

        // 判断验证码
        if(config('site.SHOW_VERIFY') == 1){
            $captcha = new captcha();
            if(!$captcha->check($code)){
                return json(array('status' => 0,'msg' => '验证码输入错误'));
            }
        }
        // 密码判断以及设置session
        $get_one = $this->admin->getOne(array('username' => $username));
        if(!empty($get_one) && $get_one['password'] == md5(md5($password).$get_one['salt'])){
            // 设置session
            session::set('uid',$get_one['admin_id']);
            session::set('username',$username);
            session::set('login_time',date('Y-m-d H:i:s',time()));
            session::set('login_ip',get_client_ip());
            // 判断是否是超级管理员
            if($username == config('rbac.RBAC_SUPERADMIN')){
                session(config('rbac.ADMIN_AUTH_KEY'),true);
            }
            // 读取用户权限
            Rbac::saveAccessList();
            save_log($username."登录成功",1);
            // 更新登陆数据
            $data = array(
                'login_time' => time(),
                'login_ip' => get_client_ip()
            );
            $this->admin->saveData(array("admin_id" => $get_one['admin_id']),$data);
            return json(array('status' => 1,'msg' => '登陆成功！'));
        }else{
            return json(array('status' => 0,'msg' => '用户名或者密码错误！'));
        }
    }
}