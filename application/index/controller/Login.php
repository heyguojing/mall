<?php

namespace app\index\controller;
use think\captcha\Captcha;
use think\facade\Session;
use think\facade\Request;
use phpmailer\Email;
use think\Db;

class Login extends Common
{
    protected $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = Model('user');
    }
    /**
     * 用户登陆
     */
    public function index()
    {
        // 检测用户是否已经登陆
        $this->checkLogin();
        if($this->request->isPost() && $this->request->isAjax()){
            $data = $this->_login_common();
            return json($data);
        }else{
            $username = cookie('username');
            $skip_url = session('redirect_url')?session('redirect_url'):url('User/index');
            $this->assign('seo_title', '用户登陆-' . config('site.WEB_TITLE'));
            $this->assign('seo_keywords', config('site.WEB_KEYWORDS'));
            $this->assign('seo_desc', config('site.WEB_DESCRIPTION'));
            $this->assign('skip_url',$skip_url);
            $this->assign('username',$username);
            return $this->fetch();
        }
    }
    /**
     * jsonp登陆
     */
    public function login()
    {
        $this->checkLogin();
        $res = $this->_login_common();
        return jsonp($res);
    }
    /**
     * 用户登陆公共部分
     */
    public function _login_common()
    {
        $code = input('code');
        $username = input('username');
        $password = input('password');
        // 判断验证码是否为空
        if(empty($code) && config('site.HOME_SHOW_VERIFY') == 1){
            $data = array('status' => 0,'info' => '参数不正确');
            return $data;
        }
        // 判断用户名和密码是否为空
        if(empty($username) || empty($password)){
            $data = array('status' => 0,'info' => '用户名和密码为空');
            return $data;
        }
        // 判断图形验证码
        if(config('site.HOME_SHOW_VERIFY') == 1){
            $captcha = new Captcha();
            if(!$captcha->check($code)){
                return array('status' => 0,'info' => '验证码错误');
            }
        }
        // 判断手机号，邮箱
        $where = array();
        $where[] = array("","EXP",Db::raw("(user_name = '".$username."' and user_name != '') or (user_mobile = '".$username."' and user_mobile != '') or (user_email ='".$username."' and user_email != '')"));
        $user_one = $this->user->getOne($where);
        if(!empty($user_one) && $user_one['user_password'] == md5(md5($password).$user_one['user_salt'])){
            // 登陆成功存入session
            session('home_uid',$user_one['uid']);
            session('login_time',date('Y-m-d H:i:s',time()));
            session('login_ip',get_client_ip());
            if(!empty($user_one['mobile'])){
                session('user_mobile',$user_one['user_mobile']);
                $user_mobile = $user_one['user_mobile'];
            }elseif(!empty($user_one['email'])){
                session('user_email',$user_one['user_email']);
                $user_emial = $user_one['user_email'];
            }
            // 更新用户登陆信息
            $data = array(
                'user_login_time' => time(),
                'user_login_ip' => get_client_ip()
            );
            $data = $this->user->saveData(array('uid' => $user_one['uid']),$data);
            if(input('remember_me') == 1){
                cookie('username',$username,86400*7);
            }else{
                cookie('username',null);
            }
            $data = array('status' => 1,'info' => '登录成功');
            return $data;
        }else{
            $data = array('status' => 0,'info' => '账号或者密码错误');
            return $data;
        }
    }
    public function reg()
    {
        if($this->request->isPost() && $this->request->isAjax()){
            $mobile = input('mobile');
            $email = input('email');
            $code = input('code');
            $type = input('type');
            $password = input('password');
            // 判断验证码
            if($type == "mobile"){
                if(session('mobile') == $mobile && session('mobile_time') >= time()){
                    if(session('mobile_code') != $code){
                        return json(array('status' => 0,'info' => '手机验证码不正确！'));
                    }
                }else{
                    return json(array('status' => 0,'info' => '手机验证码不正确！'));
                }
            }else{
                if(session('email') == $email && session('email_time') >= time()){
                    if(session('email_code') != $code){
                        return json(array('status' => 0,'info' => '邮箱验证码不正确'));
                    }
                }else{
                    return json(array('status' => 0,'info' => '邮箱验证码不正确'));
                }
            }
            // 注册
            session('mobile',null);
            session('mobile_code',null);
            session('mobile_time',null);
            session('email',null);
            session('email_code',null);
            session('email_time',null);
            $data = array(
                'user_mobile' => $mobile,
                'user_email' => $email,
                'user_password' => $password,
                'user_status' => 1,
                'update_time' => time(),
                'user_point' => config('site.REG_POINT'),
                'user_salt' => getRandKey(),
                'user_reg_time' => time(),
                'user_reg_ip' => get_client_ip(),
                'user_login_time' => time(),
                'user_login_ip' => get_client_ip()
            );
            $data['user_password'] = md5(md5($data['user_password']).$data['user_salt']);
            $res = $this->user->addData($data);
            if($res){
                // checkLogin
                session('home_uid',$res);
                return json(array('status' => 1,'info' => '注册成功!'));
            }else{
                return json(array('status' => 0,'info' => '注册失败'));
            }
        }else{
			$this->assign('seo_title', '用户注册-' . config('site.WEB_TITLE'));
			$this->assign('seo_keywords', config('site.WEB_KEYWORDS'));
			$this->assign('seo_desc', config('site.WEB_DESCRIPTION'));
            return $this->fetch();
        }
    }
    /**
     * 检测用户是否已经登陆
     */
    public function checkLogin()
    {
        if(session('home_uid') > 0){
            $this->redirect('User/index');
        }
    }
    /*
     *发送手机验证码或邮箱验证码
     */
    public function sendCode()
    {
        //判断验证码是否正确
        $verify = input('verify');
        $captcha = new Captcha();
        if(!$captcha->check($verify)){
            return json(array('status' => 0,'info' => '验证码输入错误'));
        }
        //判断手机号和邮箱
        $type = input('type');
        $code = rand(100000,999999);
        if($type == "mobile"){
            // mobile
            $mobile = input('mobile');
            $user_one = $this->user->getOne(array('user_mobile' => $mobile));
            if(!empty($user_one)){
                return json(array('status' => 0,'info' => '该手机号已经注册，请换一个试试'));
            }
            // 判断session
            if(session('mobile') == $mobile && session('mobile_time') > time()){
                return json(array('status' => 0,'info' => '请于1分钟之后再试'));
            }
            // 发送验证码
            $res = send_sms($mobile,$code);
            session('mobile_code',$code);
            if($res['code'] == '000000'){
                session('mobile',$mobile);
                session('mobile_time',time()+60);
                return json(array('status' => 1,'info' => "发送成功，请注意查收"));
            }else{
                return json(array('status' => 0,'info' => "发送失败，请重试"));
            }
        }else{
            // email
            $email = input('email');
            $user_one = $this->user->getOne(array('user_email' => $email));
            if(!empty($user_one)){
                return json(array('status' => 0,'info' => '该邮箱已经注册，请更换一个试试'));
            }
            // 判断session
            if(session('email') == $email && session('email_time') > time()){
                return json(array('status' => 0,'info' => '请于一分钟之后再试'));
            }
            // 发送验证码
            $res = Email::send($email,'【靖多鱼科技】：','【靖多鱼科技】您的验证码是：'.$code.'，请于1分钟内输入验证，如非本人操作，可不用理会！');
            session('email_code',$code);
            if($res){
                session('email',$email);
                session('email_time',time()+60);
                return json(array('status' => 1,'info' => '发送成功,请注意邮箱查收'));
            }else{
                return json(array('status' => 0,'info' => '发送失败，请重试'));
            }
        }
    }
    /**
     * 用户注销
     */
    public function logOut()
    {
        session('home_uid',null);
        // $this->skipUrl($_SERVER['HTTP_REFERER']);
        $this->success('退出成功',url('Login/index'));
    }
    /**
     * 生成验证码
     */
    public function verify()
    {
        ob_clean();
		$captcha = new Captcha();
		$captcha->fontSize = config('site.CODE_FONT_SIZE');
		$captcha->length = config('site.CODE_LEN');
		$captcha->useNoise = config('site.CODE_NOISE');
		$captcha->useCurve = config('site.CODE_CURVE');
		return $captcha->entry();
    }
}   