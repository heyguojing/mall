<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use Org\Util\GoodsCart;
use Org\Util\Page;

class Common extends Controller
{
    public function __construct ()
	{
		parent::__construct();
	}
	/**
	 * 文件上传
	 */
	public function upload()
	{
		$type = input('type','store_logo');
		$name = input('name');
		// 设置上传目录
		$upload_dir = "./upload/" . $type . "/" . date('Y-m-d') . '/';
		$file = request()->file($name);
		if($file){
			$info = $file->rule('date')->validate(['ext' => 'jpg,jpeg,png'])->move($upload_dir);
			$src = substr($upload_dir,1) . $info->getSaveName();
			return json(array('code' => 0,'msg' => array('src' => $src,'title' => $src)));
		}else{
			return json(array('code' => 1,'msg' => $file->getError()));
		}
	}
}