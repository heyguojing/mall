<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use Org\Util\GoodsCart;
use Org\Util\Page;

class Common extends Controller
{
	protected $region;
    public function __construct ()
	{
		parent::__construct();
		$this->region = Model('region');
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
	/**
	 * ajax删除图片
	 */
	public function delImg()
	{
		if ($this->request->isPost() && $this->request->isAjax()) {
			$img_url = input('img_url');
			if (!empty($img_url)) {
				$old_img = array(
					ROOT_PATH . $img_url	
				);
				foreach ($old_img as $v) {
					if (file_exists($v)) {
						@unlink($v);
					}
				}
			}
			return json(array('status' => 1, 'info' => '图片成功'));
		} else {
			halt('页面不存在');
		}
	}
	/**
	 * ajax获取省份
	 */
	public function ajaxCity()
	{
		if($this->request->isPost() && $this->request->isAjax()){
			$region_pid = input('region_pid');
			$region_data = $this->region->getChildData(array('region_pid' => $region_pid),array('region_id','region_name','region_pid'));
			return json(array('status' => 1,'region_data' => $region_data));
		}else{
			halt('页面不存在');
		}
	}
}