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
     * 获取客户端IP地址
     * @access public
     * @param  integer   $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @param  boolean   $adv 是否进行高级模式获取（有可能被伪装）
     * @return mixed
     */
	public function server($name = '', $default = null)
    {
        if (empty($name)) {
            return $this->server;
        } else {
            $name = strtoupper($name);
        }

        return isset($this->server[$name]) ? $this->server[$name] : $default;
    }
	public function getip($type = 0, $adv = true)
    {
        $type      = $type ? 1 : 0;
        static $ip = null;

        if (null !== $ip) {
            return $ip[$type];
        }

        $httpAgentIp = $this->config['http_agent_ip'];

        if ($httpAgentIp && $this->server($httpAgentIp)) {
            $ip = $this->server($httpAgentIp);
        } elseif ($adv) {
            if ($this->server('HTTP_X_FORWARDED_FOR')) {
                $arr = explode(',', $this->server('HTTP_X_FORWARDED_FOR'));
                $pos = array_search('unknown', $arr);
                if (false !== $pos) {
                    unset($arr[$pos]);
                }
                $ip = trim(current($arr));
            } elseif ($this->server('HTTP_CLIENT_IP')) {
                $ip = $this->server('HTTP_CLIENT_IP');
            } elseif ($this->server('REMOTE_ADDR')) {
                $ip = $this->server('REMOTE_ADDR');
            }
        } elseif ($this->server('REMOTE_ADDR')) {
            $ip = $this->server('REMOTE_ADDR');
        }

        // IP地址类型
        $ip_mode = (strpos($ip, ':') === false) ? 'ipv4' : 'ipv6';

        // IP地址合法验证
        if (filter_var($ip, FILTER_VALIDATE_IP) !== $ip) {
            $ip = ('ipv4' === $ip_mode) ? '0.0.0.0' : '::';
        }

        // 如果是ipv4地址，则直接使用ip2long返回int类型ip；如果是ipv6地址，暂时不支持，直接返回0
        $long_ip = ('ipv4' === $ip_mode) ? sprintf("%u", ip2long($ip)) : 0;

        $ip = [$ip, $long_ip];

        return $ip[$type];
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
		// 获取当前用户信息
		$user_one = $this->admin->getOne(array('admin_id' => $this->uid));
		// 获取当前用户角色
		$user_one['role'] = $this->admin->getUserRole(array('user_id' => $this->uid),'remark');
		if(empty($user_one['role'])){
			$user_one['remark'] = '超级管理员';
		}else{
			$tmp = count(array_keys($user_one['role']));
			foreach($user_one['role'] as $key => $val){
				$k = $key + 1;
				if($k != count($user_one['role'])){
					$user_one['remark'] .= $val['remark'].",";
				}else{
					$user_one['remark'] .= $val['remark'];
				}
			}
		}
		unset($user_one['role']);
		$this->assign("node", $node);
		$this->assign("user_one",$user_one);
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
			'order' => 'id asc,sort asc',
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
					'order' => 'id asc,sort asc',
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
				'order' => 'id asc,sort asc',
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
