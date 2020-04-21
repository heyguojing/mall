<?php
namespace app\index\controller;
use think\Controller;

class Seller extends SellerCommon
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        // seo
		$this->assign('seo_title', '销售首页-' . config('site.WEB_TITLE'));
		$this->assign('seo_keywords', config('site.WEB_KEYWORDS'));
		$this->assign('seo_desc', config('site.WEB_DESCRIPTION'));
        return $this->fetch();
    }

}