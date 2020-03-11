<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\facade\Session;
use Org\Util\Page;
class ConfigGroup extends Common
{
    protected $config_group;
    protected $group_id;
    protected $uid;
    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->config_group = model('ConfigGroup');
        $this->group_id = input('group_id',0,'intval');
        $this->uid = session(config('rbac.USER_AUTH_KEY'));
    }
    /**
     * 管理员列表页
     */
    public function index()
    {
        if($this->request->isPost()){
            $username = input('post.username','n');
            $status = input('post.status',-1,'intval');
            $page = input('post.page',1,'intval');
        }else{
            $username = input('username','n');
            $status = input('status',-1,'intval');
            $page = input('page',1,'intval');
        }
        $where = array();
        // 判断名称
        if($username !="" && $username != 'n'){
            $where['username'] = $this->strSpaceDel($username);
        }else{
            $username = 'n';
        }
        // 判断状态
        if($status > -1){
            $where['status'] = $status;
        }else{
            $status = -1;
        }
        // 求总数
        $role_total = $this->role->pageData($where,'total');//总条数
        $where['page'] = $page;
        $where['field'] = array('admin_id','username','login_time','login_ip','status');
        $where['order'] = 'admin_id asc';
        $where['limit'] = 10;//每页显示条数
        $where['pageRow'] = 4;//显示页码数量
        // 求分页数据
        $page_data = $this->admin->pageData($where,'range');
        // 求用户所属角色组
       if(!empty($page_data)){
           foreach($page_data as $k => $v){ 
               $page_data[$k]['role'] = $this->admin->getUserRole(array('user_id' => $page_data[$k]['admin_id']),array('id','name','remark'));
           }
       }
        // 求分页url
        $page_url = url('Rbac/role',array('username' => $username,'status' => $status),'');
        // 载入分页
        $page = new Page($role_total,$where['limit'],$where['pageRow'],$where['page'],$page_url,'{page}');
        // 显示分页
        $show = $page->show(5);
        $this->assign('page',$show);
        // 模板赋值
        $this->assign('page_data',$page_data);
        $this->assign('username',$username);
        $this->assign('status',$status);
        $this->assign('page_total',$role_total);
        return $this->fetch();
    }

    /**
     * 添加管理员
     */
    public function add()
    {
        if($this->request->isPost()){
            // 数据
            $data = $this->postUserData();
            $data['login_ip'] = get_client_ip();
            $data['login_time'] = time();
            $data['add_time'] = time();
            $data['salt'] = getRandKey();
            $data['password'] = md5(md5($data['password']).$data['salt']);
            // 添加
            $res = $this->admin->addData($data);
            if($res){
                $role_id = input('role_id');
                $role_data = array();
                if(!empty($role_id)){
                    foreach($role_id as $v){
                        $role_data[] = array(
                            'role_id' => $v,
                            'user_id' => $res
                        );
                    }
                    $this->role->userRoleAddData($role_data);
                }
                save_log('管理员'.$data['username'].'添加成功',2);
                $this->success('添加管理员'.$data['username'].'成功',url('rbac/user'));
            }else{
                $this->error('添加管理员失败',url('rbac/user'));
            }

        }else{
            // 载入角色组
            $where['status'] = 1;
            $where['order'] = 'id asc';
            $role_data = $this->role->pageData($where,'range');
            $this->assign('role_data',$role_data);
            return $this->fetch();
        }
    }
    /**
     * 编辑管理员
     */
    public function edit()
    {
        $admin_id = input('admin_id');
        if(empty($admin_id)){
            $this->error('管理员id不存在',url('rbac/user'));
        }
        $admin_one = $this->admin->getOne(array('admin_id' => $admin_id));
        if($this->request->isPost()){
            // 更新user表数据
            $data = $this->postUserData();
            // $data['login_ip'] = get_client_ip();  //编辑数据不需要login_time
            // $data['login_time'] = time();
            // $data['add_time'] = time();
            $res = $this->admin->saveData(array('admin_id' => $admin_id),$data);
            // 删除原有角色
            $this->role->delUserRole(array('user_id' => $admin_id));
            // 添加新角色
            $role_id = input('role_id');
            $role_data = array();
            if(!empty($role_id)){
                foreach($role_id as $k=>$v){
                    $role_data[] = array(
                        'user_id' => $admin_id,
                        'role_id' => $v
                    );
                }
                $addRoleRes = $this->role->addUserRole($role_data);
            }
            // 结果判断
            if($addRoleRes || $res){
                save_log('管理员：'.$data['username'].'编辑成功',2);
                $this->success('用户角色'.$data['username'].'编辑成功',url('Rbac/user'));
            }else{
                $this->error('用户角色'.$data['username'].'编辑失败',url('Rbac/user'));
            }
        }else{
            // 查询数据
            $this->assign('admin_one',$admin_one);
            $where['status'] = 1;
            $where['order'] = 'id asc';
            // 查询角色组
            $role_data = $this->role->pageData($where,'range');
            $this->assign('role_data',$role_data);
            $role_one = $this->admin->getUserRole(array('user_id' => $admin_id),'id');
            $roleId_arr = array();
            if(!empty($role_one)){
                foreach($role_one as $k=>$v){
                    $roleId_arr[] = $v['id'];
                }
            }
            $role_one = $roleId_arr;
            $this->assign('role_one',$role_one);
            return $this->fetch();
        }        
    }
    /**
     * 删除管理员
     */
    public function del()
    {
        $admin_id = input('admin_id');
        if(is_array($admin_id)){
            $admin_arr = $admin_id;
            $admin_ids = implode(',',$admin_id);
        }else{
            $admin_arr = array($admin_id);
            $admin_ids = $admin_id;
        }
        // 判断用户id是否存在
        foreach($admin_arr as $v){
            $admin_one = $this->admin->getOne(array('admin_id' => $v));
            if(empty($admin_one)){
                $this->error('删除失败，用户不存在',url('Rbac/user'));
            }
        }
        // 删除用户
        foreach($admin_arr as $v){
            $res = $this->admin->delData(array('admin_id' => $v));
        }
        if($res){
            save_log('管理员ID：'.$admin_ids.'删除成功',2);
            $this->success('用户id：'.$admin_ids.'删除成功',url('Rbac/user'));
        }else{
            $this->success('用户删除失败',url('Rbac/uesr'));
        }
    }
    /**
     * 管理员名称是否重复验证
     */
    public function ajaxUsername()
    {
        $key = input('name');
        $val = input('param');
        $admin_id = input('admin_id',0,'intval');
        $res = $this->admin->ajaxValidate($val,$admin_id);
        if(!$res){
            $data = array(
                'status' => 'y',
                'info' => '用户名验证通过'
            );
        }else{
            $data = array(
                'status' => 'n',
                'info' => '管理员用户名重复'
            );
        }
        return json($data);
    }
}