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
            $theme = input('theme','');
            $res = $this->config->saveData(array('config_name' => 'WEB_STYLE'),array('config_value' => $theme));
            if($res){
                $arr = [
                    // 模板引擎类型 支持 php think 支持扩展
                    'type'         => 'Think',
                    // 默认模板渲染规则 1 解析为小写+下划线 2 全部转换小写 3 保持操作方法
                    'auto_rule'    => 1,
                    // 模板路径
                    'view_path'    => '../template/pc/'.$theme.'/',
                    // 模板后缀
                    'view_suffix'  => 'html',
                    // 模板文件名分隔符
                    'view_depr'    => DIRECTORY_SEPARATOR,
                    // 模板引擎普通标签开始标记
                    'tpl_begin'    => '{',
                    // 模板引擎普通标签结束标记
                    'tpl_end'      => '}',
                    // 标签库标签开始标记
                    'taglib_begin' => '{',
                    // 标签库标签结束标记
                    'taglib_end'   => '}',
                    // 模板标签替换
                    'tpl_replace_string' => [
                        "__ADMIN__" => "/static/admin",
                        "__INDEX__" => "/static/index"
                    ]
                ];
                //写入配置文件
                $content = "<?php return ".var_export($arr,true)."\n?>";
                return file_put_contents("../config/index/template.php",$content);
                $data = array(
                    'info' => '模板替换成功',
                    'status' => 1
                );
            }else{
                $data = array(
                    'info' => '模板替换失败',
                    'status' => 0
                );
            }
            return json($data);
		}else{  
            $theme = new Theme();
            $page_data = $theme->get_theme("pc");
            $this->assign('page_data',$page_data);
			return $this->fetch();
		}
	}
}
