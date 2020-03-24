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
    public function arrTest()
    {
        $arr1 = array(
            'name' => 'ming1',
            'like' => 'drving',
            19,
            'other' => 'wathing'
        );
        $arr2 = array(
            'name' => 'ming2',
            21,
            'like2' => 'drving'
        );
        $res = array_diff($arr1,$arr2);//array('name' => ming1', [0] => 19,'other' => 'wathing')
        p($res);
        return $res;
    }
    
}