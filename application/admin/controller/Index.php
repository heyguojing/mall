<?php
namespace app\admin\controller;
use think\Db;
use Org\Util\Dir;
use think\facade\Env;
use think\facade\Session;
class Index extends Common
{
    protected $node;
	protected $admin;
    protected $uid;
    public function __construct ()
	{
		parent::__construct();
		$this->node = model("Node");
		$this->admin = model("Admin");
		$this->uid = session('uid');
	}
    /**
     * 后台首页渲染
     */
    public function index()
    {
		$where = array(
			'is_show' => 1,
			'level' => 1,
			'order' => 'id asc,sort asc',
			'field' => 'id,name,title'
		);
		$node = $this->node->pageData($where, 'range');
		if (session(config('rbac.ADMIN_AUTH_KEY'))) {

		} else {
			//定义当前模块
			$module = array();
			//当前用户的权限
			$accessList = session('_ACCESS_LIST');
			if (!empty($accessList)) {
				foreach ($accessList as $key => $value) {
					$module[] = $key;
				}
				//去除一些没有权限的模块
				foreach ($node as $key => $value) {
					if (!in_array(strtoupper($value['name']), $module)) {
						unset($node[$key]);
					}
				}
			}
		}
        $this->assign("node", $node);
        return $this->fetch();
    }
    /**
     * 中间内容
     */
    public function copy()
    {
        
        return $this->fetch();
    }
    public function menu()
    {
		$id = input('menu_id', 1, 'intval');
		//获取第二级数据
		$where = array(
			'is_show' => 1,
			'level' => 2,
			'order' => 'sort asc,id asc',
			'field' => 'id,name,title',
			'pid' => $id,
		);
		$menu = $this->node->pageData($where, 'range');
		//获取第三级数据
		if (!empty($menu)) {
			foreach ($menu as $k => $v) {
				$where = array(
					'is_show' => 1,
					'level' => 3,
					'order' => 'sort asc',
					'field' => 'id,name,title,parameter,parameter_title',
					'pid' => $menu[$k]['id'],
				);
				$menu[$k]['node'] = $this->node->pageData($where, 'range');
			}
		}
		if (session(config('rbac.ADMIN_AUTH_KEY'))) {
		} else {
			$where = array(
				'is_show' => 1,
				'level' => 1,
				'order' => 'sort asc,id desc',
				'field' => 'id,name,title'
			);
			$node = $this->node->pageData($where, 'range');
			//模块
			$app = array();
			//当前用户的权限
			$accessList = session('_ACCESS_LIST');
			//控制器
			$controller = "";
			//方法
			$action = "";
			if (!empty($accessList)) {
				foreach ($accessList as $key => $value) {
					$app[] = $key;
				}
				//去除一些没有权限的模块
				foreach ($node as $key => $value) {
					if (!in_array(strtoupper($value['name']), $app)) {
						unset($node[$key]);
					} else {
						if ($value['id'] != $id) {
							unset($node[$key]);
						}
					}
				}
				//去除没有权限的模块
				foreach ($accessList as $key => $value) {
					foreach ($node as $k => $v) {
						if ($key != strtoupper($v['name'])) {
							unset($accessList[$key]);
						}
					}
				}
				//获取控制器和方法
				foreach ($accessList as $key => $value) {
					foreach ($value as $key1 => $value1) {
						$controller = $controller . "," . $key1;
						foreach ($value1 as $key2 => $value2) {
							$action = $action . "," . $value2;
						}
					}
				}
				//去除没有权限的控制器
				foreach ($menu as $key => $value) {
					if (!in_array(strtoupper($value['name']), explode(",", $controller))) {
						unset($menu[$key]);
					} else {
						foreach ($value['node'] as $key1 => $value1) {
							if (!in_array($value1['id'], explode(",", $action))) {
								unset($menu[$key]['node'][$key1]);
							}
						}
					}

				}
			}

		}
		$this->assign('menu', $menu);
		return view();
	}
    /**
     * 登出
     */
    public function logout()
    {
        Session::clear();
        session_unset();
        $this->success('退出成功',url('Login/index'));
    }
    /**
     * 删除缓存
     */
    public function delCache()
    {
        if(Dir::del(Env::get('runtime_path').'cache/')){
            $res = array('status' => 1,'msg' => '缓存文件删除成功');
        }else{
            $res = array('status' => 0,'msg' => '缓存文件已经删除过了');
        }
        return json($res);
    }
}
