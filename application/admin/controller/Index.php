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
			'order' => 'sort asc,id asc',
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
