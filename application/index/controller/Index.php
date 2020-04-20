<?php
namespace app\index\controller;

use think\Db;
use think\Controller;

class Index extends Common
{
    public function index()
    {
        $this->assign('seo_title', '会员首页-' . config('site.WEB_TITLE'));
        $this->assign('seo_keywords', config('site.WEB_KEYWORDS'));
        $this->assign('seo_desc', config('site.WEB_DESCRIPTION'));
        return $this->fetch();
    }
}
