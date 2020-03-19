<?php
namespace app\admin\controller;
use think\Controller;
use think\captcha\Captcha;
use think\facade\Session;
use Org\Util\Rbac;
use think\facade\Env;
class Tests extends Controller
{
    protected $admin = '';
    public function __construct(){
        parent::__construct();
        $this->admin = model('Admin');
    }
    public function index()
    {
        p(Env::get('runtime_path'));
        p(Env::get('module_path'));
    }
    
}