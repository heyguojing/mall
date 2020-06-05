<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class User extends Common
{
    protected $store;
    protected $region;
    protected $uid;
    protected $user;
    public function __construct()
    {
        parent::__construct();
        $this->store = Model('Store');
        $this->region = Model('Region');
        $this->uid = session('home_uid');
        $this->user = Model('User');
    }
    public function index()
    {
        // seo
		$this->assign('seo_title', '会员中心首页-' . config('site.WEB_TITLE'));
		$this->assign('seo_keywords', config('site.WEB_KEYWORDS'));
		$this->assign('seo_desc', config('site.WEB_DESCRIPTION'));
        return $this->fetch();
    }
    public function enter()
    {
        if($this->request->isPost()){

        }else{
            $uid = session('home_uid');
            return $this->fetch();
        }
    }
    public function enterSecond()
    {
        // 检查店铺状态
        $this->checkStore();
        if($this->request->isPost()){
            $data = array(
                'store_uid' => $this->uid,
                'store_name' => input('store_name',''),
                'store_logo' => input('store_logo',''),
                'store_desc' => input('store_desc',''),
                'store_province' => input('store_province',0,'intval'),
                'store_city' => input('store_city',0,'intval'),
                'store_district' => input('store_district',0,'intval'),
                'store_user_address' => input('store_user_address', ''),
                'store_card_front' => input('store_card_front'),
                'store_card_side' => input('store_card_side'),
                'store_people' => input('store_people', ''),
				'store_mobile' => input('store_mobile', ''),
				'store_status' => 0,
                'store_time' => time(),
                'update_time' => time()
            );
            $res = $this->store->addData($data);
            if($res){
                $this->statStore();
                $this->redirect('User/enterThird');
            }else{
                $this->error('入驻失败');
            }
        }else{
            $province_data = $this->region->getChildData(array('region_pid' => 1),array('region_id','region_pid','region_name'));
            $this->assign('province_data',$province_data);
            $this->assign('seo_title','商家入驻-第二步'.config('site.WEB_TITLE'));
            $this->assign('seo_keywords',config('site.WEB_KEYWORDS'));
            $this->assign('seo_desc',config('site.WEB_DESCRIPTION'));   
            return $this->fetch();
        }
    }
    /**
     * 统计下单量
     */
    public function statStore()
    {
        $stat_time_start = strtotime(Date('Y-m-d 00:00:00'));
    }
    /**
     * 商家入驻第三步
     */
    public function enterThird()
    {
        $store_one = $this->store->getOne(array('store_uid' => $this->uid));
        if(!empty($store_one)){
            $store_status = "";
            if($store_one['store_status'] == 0){
                $store_status = '未审核';
            }elseif($store_one['store_status'] == 1){
                $store_status = '已审核';
            }else{
                $store_status = '审核不通过';
            }
        }else{
            $this->redirect(url('User/enter'));
        }
        //载入seo
        $this->assign('seo_title','商家入驻-第三步'.config('site.WEB_TITLE'));
        $this->assign('seo_keywords',config('site.WEB_KEYWORDS'));
        $this->assign('seo_desc',config('site.WEB_DESCRIPTION'));   
        $this->assign('store_status',$store_status);
        $this->assign('store_one',$store_one);
        return $this->fetch();
    }
    /**
     * 审核未通过编辑
     */
    public function enterSecondEdit()
    {
        // 判断店铺状态
        $store_one = $this->store->getOne(array('store_id' => $this->uid));
        if(!empty($store)){
            if($store_one['store_status'] != 2){
                $this->redirect(url('User/enterThird'));
                die;
            }else{
                $this->redirect(url('User/enter'));
            }
        }
        if($this->request->isPost()){
            $data = array(
                'store_name' => input('store_name',''),
                'store_log0' => input('store_logo',''),
                'store_desc' => input('store_desc',''),
                'store_province' => input('store_province',0,'intval'),
                'store_city' => input('store_city',0,'intval'),
                'store_district' => input('store_district',0,'intval'),
                'store_user_address' => input('store_user_address',''),
                'store_card_front' => input('store_card_front',''),
                'store_card_side' => input('store_card_side',''),
                'store_people' => input('store_people',''),
                'store_mobile' => input('store_mobile',''),
                'store_time' => time()
            );
            $res = $this->store->saveDada($data);
            if($res){
                $this->redirect(url('User/enterThird'));
            }else{
                $this->error('编辑失败');
            }
        }else{
            // 获取province
            $province_data = $this->region->getChildData(array('region_pid' => 1),array('region_id','region_name','region_pid'));
            // 获取city
            $city_data = $this->region->getChildData(array('region_pid' => $store_one['store_province']),array('region_id','region_name','region_pid'));
            // 获取district
            $district_data = $this->region->getChildData(array('region_pid' => $store_one['store_city']),array('region_id','region_name','region_pid'));
            $this->assign('province_data',$province_data);
            $this->assign('city_data',$city_data);
            $this->assign('district_data',$district_data);
            $this->assign('store_one', $store_one);
            //载入seo
            $this->assign('seo_title','商家入驻-重新编辑 '.config('site.WEB_TITLE'));
            $this->assign('seo_keywords',config('site.WEB_KEYWORDS'));
            $this->assign('seo_desc',config('site.WEB_DESCRIPTION'));   
            return $this->fetch();
        }
    }
    /**
     * ajaxStoreName
     */
    public function ajaxStoreName()
    {
        $key = input('key');
        $value = input('param');
        $store_id = input('store_id',0,'intval');
        $res = $this->store->ajaxStoreName($value, $store_id);
		if ($res) {
			$data = array(
				'status' => 'n',
				'info' => '店铺名称已经重复，请一个试试'
			);
		} else {
			$data = array(
				'status' => 'y',
				'info' => '验证通过'
			);
		}
		return json($data);
    }
    /**
     * 检查店铺状态
     */
    protected function checkStore()
    {
        $store_one = $this->store->getOne(array('store_id' => $this->uid));
        if($store_one){
            if($store_one['store_status'] == 0){
                $this->redirect('User/enterThird');
                die;
            }elseif($store_one['store_status'] == 1){
                $this->redirect('Seller/index');
                die;
            }else{
                $this->redirect('User/enterThird');
                die;
            }
        }
    }
}