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
        if($this->request->isPost && $this->request->isAjax){

        }else{
            return $this->fetch();
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