<?php

namespace app\index\controller;
use think\captcha\Captcha;
use think\Db;

class Login extends Common
{
    public function __construct()
    {
        parent::__construct();
    }
    public function reg()
    {
        if($this->request->isPost && $this->request->isAjax){

        }else{
            return $this->fetch();
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