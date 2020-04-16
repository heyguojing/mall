<?php

namespace app\index\controller;
use think\captcha\Captcha;
use think\facade\Session;
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
                        return json(array('status' => 0,'info' => '手机验证码不正确！1'));
                    }
                }else{
                    return json(array('status' => 0,'info' => '手机验证码不正确！2'));
                }
            }else{
                if(session('email') == $email && session('email_time') >= time()){
                    if(session('email_code') != $code){
                        return json(array('status' => 0,'info' => '邮箱验证码不正确1'));
                    }
                }else{
                    return json(array('status' => 0,'info' => '邮箱验证码不正确2'));
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
                session('home_id',$res);
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