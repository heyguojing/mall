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
    public function columnTest()
    {
        $arr1 = Array(
            1 => 1,
            2 => 2
        );
        $arr2 = Array(
            0 => 1,
            1 => 2,
            2 => 3
        );
        $res = in_array(array_keys($arr1),$arr2);
        var_dump($res);
    }
    public function api()
    {
        // 美洽
        $url = "http://api.meiqia.com/v1/conversations/26016288";

        $arr = $this->curl_get($url);
        // var_dump($arr);
        // die;
        $res = json_decode($arr,true);
        return json_encode($res);
    }
    public function curl_get($url)
    {
        $info = curl_init();
        curl_setopt($info,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($info,CURLOPT_HEADER,0);
        curl_setopt($info,CURLOPT_NOBODY,0);
        curl_setopt($info,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($info,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($info,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($info,CURLOPT_URL,$url);
        $output = curl_exec($info);
        curl_close($info);
        return $output;
    }
}