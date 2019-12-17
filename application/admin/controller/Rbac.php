<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\facade\Session;
use Org\Util\Page;
class Rbac extends Common
{
    protected $node;
    protected $role;
    protected $admin;
    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->node = model('Node');
        $this->role = model('Role');
        $this->admin = model('Admin');
    }
    public function index()
    {
        if(Session::has('uid'))
        {
            return $this->redirect(url('index/index'));
        }else{
            return $this->redirect(url('Login/index'));
        }
    }
    public function user()
    {
        $data = '';
        return $this->fetch();
    }
    /**
     * 添加管理员
     */
    public function addUser()
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
                $this->success('添加管理员'.$data['username'].'成功',url('rbac/addUser'));
            }else{
                $this->error('添加管理员失败',url('rbac/addUser'));
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
     * 角色列表
     */
    public function role()
    {
        if($this->request->isPost()){
            $remark = input('post.remark','n');
            $status = input('post.status',-1,'intval');
        }else{
            $remark = input('remark','n');
            $status = input('status',-1,'intval');
        }
        $where = array();
        // 判断名称
        if($remark !="" && $remark != 'n'){
            $where['remark'] = $this->strSpaceDel($remark);
        }else{
            $remark = 'n';
        }
        // 判断状态
        if($status > -1){
            $where['status'] = $status;
        }else{
            $status = -1;
        }
        // 求总数
        $role_total = $this->role->pageData($where,'total');//总条数
        $where['page'] = input('page',1,'intval');
        $where['field'] = array('id','name','remark','status');
        $where['order'] = 'id asc';
        $where['limit'] = 10;//每页显示条数
        $where['pageRow'] = 4;//显示页码数量
        // 求分页数据
        $page_data = $this->role->pageData($where,'range');
        // 求分页url
        $page_url = url('Rbac/role',array('remark' => $remark,'status' => $status,''));
        // 载入分页
        $page = new Page($role_total,$where['limit'],$where['pageRow'],$where['page'],$page_url,'{page}');
        // 显示分页
        $show = $page->show(5);
        $this->assign('page',$show);
        // 模板赋值
        $this->assign('page_data',$page_data);
        $this->assign('remark',$remark);
        $this->assign('status',$status);
        $this->assign('page_total',$role_total);
        return $this->fetch();
    }
    /**
     * 角色添加
     */
    public function addRole()
    {
        if($this->request->isPost()){
            $data = $this->postRoleData();
            $res = $this->role->addData($data);
            if($res){
                return $this->success('当前角色：'.$data['title'].'添加成功','Rbac/role');
            }else{
                return $this->error('角色添加失败');
            }
        }else{
            return $this->fetch();
        }
    }
    /**
     * 角色编辑
     */
    public function editRole()
    {
        $id = input('id',0,'intval');
        $where = array('id' => $id);
        $role_one = $this->role->getOne($where);
        if(empty($role_one)){
            $this->error('角色id不存在','Rbac/role');
        }
        // post
        if($this->request->isPost()){
            $data = $this->postRoleData();
            $res = $this->role->saveData($where,$data);
            if($res){
                return $this->success('当前角色：'.$data['remark'].'编辑成功',url('rbac/role'));
            }else{
                return $this->error('角色编辑失败');
            }
        }else{
            $this->assign('editdata',$role_one);
            return $this->fetch();
        }    
    }
    /**
     * 角色删除
     */
    public function delRole()
    {
        $id = input('id',0,'intval');
        if(is_array($id)){
            $role_one = $id;
            $ids = implode(',',$id);
        }else{
            $role_one = array((int)$id);
            $ids = $id;
        }
        // 判断id是否存在
        foreach($role_one as $v){
            $data = $this->role->getOne(array('id' => $v));
            if(empty($data)){
                $this->error('角色id不存在',url('Rbac/role'));
            }
        }
        // 执行删除
        foreach($role_one as $val){
            $res = $this->role->delData(array($val));
        }
        if($res){
            $this->success('角色删除成功',url('Rbac/role'));
        }else{
            $this->error('角色删除失败',url('Rbac/role'));
        }
    }
    /**
     * 配置用户权限
     */
    public function access()
    {
        //判断id是否存在
        $rid = input('rid',0,'intval');
        $where = array('id' => $rid);
        $editdata = $this->role->getOne($where);
        if(empty($editdata)){
            $this->error('角色id不存在','Rbac/role');
        }
        // 是否post
        if($this->request->isPost()){
            // 删除角色原有权限
            $where = array('role_id' => $rid);
            $this->role->accessDelData($where);
            // 获取access权限
            $data = array();
            $access = input('access');
            foreach($access as $v){
                $tmp = explode("_",$v);
                $data[] = array(
                    //这里roleId唯一，一个角色可以对应多个权限
                    'role_id' => $rid,
                    'node_id' => $tmp[0],
                    'level' => $tmp[1]
                );
            };
            // 设置新权限
            if($this->role->accessAddData($data)){
                // 节点列表
                $node_data = cache('node_data');
                if(empty($node_data)){
                    $where['field'] = array('id','name','title','pid');
                    $node_data = $this->node->pageData($where,'range');
                    cache('node_data',$node_data,86400);
                }   
                // 重新设置当前角色拥有的权限
                $field = 'node_id';
                $where = array('role_id' => $rid);
                $page_data = $this->role->accessGetField($where,$field);
                $page_data = node_merge($node_data,$page_data);
                cache('access_'.$rid,$page_data,86400);
                $this->success('设置权限成功',url('rbac/role'));                 
            }else{
                $this->error('设置权限失败',url('rbac/role'));
            }

        }else{
            // 节点列表
            $node_data = cache('node_data');
            if(empty($node_data)){
                $where['field'] = array('id','name','title','pid');
                $node_data = $this->node->pageData($where,'range');
                cache('node_data',$node_data,86400);
            }
            // 获取角色原有的权限
            if(!$page_data = cache('access_'.$rid)){
                $field = 'node_id';
                $where = array('role_id' => $rid);
                $page_data = $this->role->accessGetField($where,$field);
                $page_data = node_merge($node_data,$page_data);
                cache('access_'.$rid,$page_data,86400);
            }
            $this->assign('page_data',$page_data);
            $this->assign('rid',$rid);
            return $this->fetch();
        }
    }
    /**
     * 节点列表页
     */
    public function node()
    {
        // 生成缓存，如果有缓存就从缓存里面取，否则从数据库拿；
        $page_data = cache('rbac_node');
        if(empty($page_data)){
            $where['field'] = array('id','name','title','pid');
            $page_data = $this->node->pageData($where,'range');
            $page_data = node_merge($page_data);
            cache('rbac_node',$page_data,86400);
        }
        $this->assign('page_data',$page_data);
        return $this->fetch();
    }
    /**
     * 节点添加
     */
    public function addNode()
    {
        if($this->request->isPost()){
            $data = $this->postNodeData();
            $data['pid'] = input('pid',0,'intval');
            $data['level'] = input('level',0,'intval');
            $res = $this->node->addData($data);
            if($res){
                return $this->success('当前节点：'.$data['title'].'添加成功','Rbac/node');
            }else{
                return $this->error('节点添加失败');
            }
        }else{
            $pid = input('pid',0,'intval');
            $level = input('level',1,'intval');
            switch($level){
                case 1:
                $type = "应用";
                $parameter = 0;
                break;
                case 2:
                $type = "控制器";
                $parameter = 0;
                break;
                case 3:
                $type = "方法";
                $parameter = 1;
                break;
            }
            $this->assign('level',$level);
            $this->assign('pid',$pid);
            $this->assign('type',$type);
            $this->assign('parameter',$parameter);
            return $this->fetch();
        }
    }
    /**
     * 节点编辑
     */
    public function editNode()
    {   
        $id = input('id');
        $where = array('id' => $id);
        $editdata = $this->node->getOne($where);
        if(empty($editdata)){
            $this->error('节点不存在','Rbac/node');
        }
        // post
        if($this->request->isPost()){
            $data = $this->postNodeData();
            $res = $this->node->saveData($where,$data);
            if($res){
                return $this->success('当前节点：'.$data['title'].'编辑成功',url('rbac/node'));
            }else{
                return $this->error('节点编辑失败');
            }
        }else{
            $level = input('level',1,'intval');
            switch($level){
                case 1:
                $type = "应用";
                $parameter = 0;
                break;
                case 2:
                $type = "控制器";
                $parameter = 0;
                break;
                case 3:
                $type = "方法";
                $parameter = 1;
                break;
            }
            $this->assign('level',$level);
            $this->assign('pid',$pid);
            $this->assign('type',$type);
            $this->assign('parameter',$parameter);
            $this->assign('editdata',$editdata);
            return $this->fetch();
        }
    }
    /**
     * 节点删除
     */
    public function delNode()
    {
        $id = input('id',0,'intval');
        $deldata = $this->node->getOne(array('id' => $id));
        if(empty($deldata)){
            $this->error('删除失败，节点不存在',url('Rbac/node'));
        }
        // 判断是否有子节点
        $where = array('pid'=>$id);
        $data = $this->node->pageData($where,'total');
        if($data > 0){
            $this->error('不能删除,该节点包含子节点',url('Rbac/node'));
        }
        $where = array('id' => $id);
        $res = $this->node->delData($where);
        if($res){
            $this->success('删除成功',url('Rbac/node'));
        }else{
            $this->error('删除失败',url('Rbac/node'));
        }
    }
    /**
     * 接受管理员user数据
     */
    public function postUserData()
    {
        $data = array(
            'username' => input('username'),
            'password' => input('password'),
            'status' => input('status',0,'intval'),
        );
        return $data;
    }
    /**
     * 接收节点post数据
     */
    private function postNodeData()
    {
        $data = array(
            'name' => input('name'),
            'title' => input('title'),
            'status' => input('status',0,'intval'),
            'is_show' => input('is_show'),
            'sort' => input('sort',0,'intval'),
            'parameter' => input('parameter','','strip_tags'),
            'parameter_title' => input('parameter_title','','strip_tags')
        );
        return $data;
    }
    /**
     * 接收角色role数据
     */
    private function postRoleData()
    {
        $data = array(
            'remark' => input('remark',''),
            'name' => input('name',''),
            'status' => input('status','0','intval')
        );
        return $data;
    }
    /**
     * 过滤字符串中的空格
     */
    function strSpaceDel($str){
        $str = preg_replace("/ /","",$str);
        $str = preg_replace("/&nbsp;/","",$str);
        $str = preg_replace("/　/","",$str);
        $str = preg_replace("/\r\n/","",$str);
        $str = str_replace(chr(13),"",$str);
        $str = str_replace(chr(10),"",$str);
        $str = str_replace(chr(9),"",$str);
        return $str;
    }
}
