<?php
namespace app\index\controller;
use think\Controller;

class SellerCommon extends Common
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        // seo
		$this->assign('seo_title', '会员首页-' . config('site.WEB_TITLE'));
		$this->assign('seo_keywords', config('site.WEB_KEYWORDS'));
		$this->assign('seo_desc', config('site.WEB_DESCRIPTION'));
        return $this->fetch();
    }

}