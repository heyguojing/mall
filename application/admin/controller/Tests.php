<?php
namespace app\admin\controller;
use think\Controller;
use think\captcha\Captcha;
use think\facade\Session;
use Org\Util\Rbac;
use think\facade\Env;
use think\Db;
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
    public function arrTest1()
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
    }
    public function strTest1()
    {
        $str = "<a href='test'>Test &,$</a>";
        print_r(htmlentities($str));;
        echo("</br>");
        print_r(htmlspecialchars($str));
    }
    public function colValue()
    {
        $res = Db::name('attr')->where('attr_id',1)->value('attr_value');
        $res2 = Db::name('attr')->where('attr_id',1)->column('attr_value');
        p($res);
        p($res2);
    }
}