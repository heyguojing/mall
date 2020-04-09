<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use Org\Util\Theme;
class System extends Common
{

	protected $uid;
	protected $config;
	public function __construct ()
	{
		parent::__construct();

		$this->uid = session(config('rbac.USER_AUTH_KEY'));
		$this->config = model('Config');
		
	}

	/**设置网站主题
	 * @return mixed
	 */
	public function  theme(){
		if($this->request->isPost()){
			
		}else{  
            $theme = new Theme();
            // $page_data = $theme->get_theme('pc');
            // p($page_data);die;
			return $this->fetch();
		}
	}
}
