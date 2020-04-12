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

	public function __construct ()
	{
		parent::__construct();
		$this->admin = model('Admin');
	}

	public function index ()
	{
		p(Env::get('runtime_path'));
		p(Env::get('module_path'));
	}

	public function arrTest1 ()
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
		$res = array_diff($arr1, $arr2);//array('name' => ming1', [0] => 19,'other' => 'wathing')
		p($res);
	}

	public function strTest1 ()
	{
		$str = "<a href='test'>Test &,$</a>";
		print_r(htmlentities($str));;
		echo("</br>");
		print_r(htmlspecialchars($str));
	}

	public function colValue ()
	{
		$res = Db::name('attr')->where('attr_id', 1)->value('attr_value');
		$res2 = Db::name('attr')->where('attr_id', 1)->column('attr_value');
		p($res);
		p($res2);
	}

	public function columnTest ()
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
		$res = in_array(array_keys($arr1), $arr2);
		p($res);
	} 
	public function api ()
	{
		// 美洽
		$url = "https://api.apiopen.top/getAllUrl";
		$arr = $this->curl_get($url);
		p($arr);die;
		$res = json_decode($arr, true);
		return json_encode($res);
	}

	public function curl_get ($url)
	{
        $info = curl_init();
		curl_setopt($info, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($info, CURLOPT_HEADER, 0);
		curl_setopt($info, CURLOPT_NOBODY, 0);
		curl_setopt($info, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($info, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($info, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($info, CURLOPT_URL, $url);
		$output = curl_exec($info);
		curl_close($info);
		echo($output);
		return $output;
	}
	/**
	 * 请求接口返回内容
	 * @param  string $url [请求的URL地址]
	 * @param  string $params [请求的参数]
	 * @param  int $ipost [是否采用POST形式]
	 * @return  string
	 */
	function juhecurl($url,$params=false,$ispost=0){
		$httpInfo = array();
		$ch = curl_init();
	
		curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
		curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
		curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		if( $ispost )
		{
			curl_setopt( $ch , CURLOPT_POST , true );
			curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
			curl_setopt( $ch , CURLOPT_URL , $url );
		}
		else
		{
			if($params){
				curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
			}else{
				curl_setopt( $ch , CURLOPT_URL , $url);
			}
		}
		$response = curl_exec( $ch );
		if ($response === FALSE) {
			//echo "cURL Error: " . curl_error($ch);
			return false;
		}
		$httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
		$httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
		curl_close( $ch );
		return $response;
	}
	function http_post_data ($url, $data = array(), $header = array())
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1');
		//请求地址
		curl_setopt($ch, CURLOPT_URL, $url);
		//https协议不验证证书
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		//返回结果 不直接输出
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//追踪内部跳转
		curl_setopt($ch, CURLOPT_MAXREDIRS, 100);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		//上一页
		curl_setopt($ch, CURLOPT_REFERER, 'https://www.baidu.com/');
		$header = array(
			':authority: api.meiqia.com',
			':method: GET',
			':path: /v1/tickets?ticket_start_from_tm=2020-03-01%2000:00:00&ticket_start_to_tm=2020-03-31%2023:59:59&offset=0&limit=20&app_id=f5e2f6be71704a13e938371f94aaae01&sign=75946d4afa08677a96579911bd673442&enterprise_id=9041',
			':scheme: https',
			'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
			'accept-encoding: gzip, deflate, br',
			'accept-language: zh-CN,zh;q=0.9,en;q=0.8',
			'cache-control: no-cache',
			'pragma: no-cache',
			'upgrade-insecure-requests: 1',
			'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36',
		);
		//设置头部信息
		if ($header) {
			//设置头部信息
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			// 设置响应信息的编码
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
		}
		//判断是否post提交
		if ($data) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		$ret = curl_exec($ch);
		var_dump($ret);
		die;
		curl_close($ch);
		//返回结果
		if ($ret) {
			return $ret;
		} else {
			return false;
		}
	}

	public function apishow ()
	{
		if($this->request->isPost()){
			$offset = input('offset',0,'intval');
			$offset = input('offset',0,'intval');
			ini_set('user_agent', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; GreenBrowser)');
			$data = array(
				'ticket_start_from_tm' => '2020-03-01 00:00:00',
				'ticket_start_to_tm' => '2020-03-31 23:59:59',
				'offset' => $offset,
				'limit' => '20',
				'app_id' => 'f5e2f6be71704a13e938371f94aaae01',
				'sign' => '75946d4afa08677a96579911bd673442',
				'enterprise_id' => '9041'
			);
			$res = file_get_contents("http://api.meiqia.com/v1/tickets?" . http_build_query($data,"\n"));
			//$url = file_get_contents("http://api.meiqia.com/v1/tickets?ticket_start_from_tm=2020-03-01 00:00:00&ticket_start_to_tm=2020-03-31 23:59:59&offset=0&limit=20&app_id=f5e2f6be71704a13e938371f94aaae01&sign=75946d4afa08677a96579911bd673442&enterprise_id=9041");
			//$res = $this->http_post_data($url);
			$res = json_decode($res,true);
			unset($res['errno']);
			unset($res['errmsg']);
			return $res;
		}else{
			$offset = input('offset',0,'intval');
			ini_set('user_agent', 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; GreenBrowser)');
			$data = array(
				'ticket_start_from_tm' => '2020-03-01 00:00:00',
				'ticket_start_to_tm' => '2020-03-31 23:59:59',
				'offset' => $offset,
				'limit' => '20',
				'app_id' => 'f5e2f6be71704a13e938371f94aaae01',
				'sign' => '75946d4afa08677a96579911bd673442',
				'enterprise_id' => '9041'
			);
			$res = file_get_contents("http://api.meiqia.com/v1/tickets?" . http_build_query($data,"\n"));
			//$url = file_get_contents("http://api.meiqia.com/v1/tickets?ticket_start_from_tm=2020-03-01 00:00:00&ticket_start_to_tm=2020-03-31 23:59:59&offset=0&limit=20&app_id=f5e2f6be71704a13e938371f94aaae01&sign=75946d4afa08677a96579911bd673442&enterprise_id=9041");
			//$res = $this->http_post_data($url);
			$res = json_decode($res,true);
			unset($res['errno']);
			unset($res['errmsg']);
			$this->assign('res',$res);
			return $this->fetch();
		}
    }
}












