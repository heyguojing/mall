<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\facade\Session;
class Rbac extends Common
{
    protected $node = '';
    protected $role = '';
    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->node = model('Node');
        $this->role = model('Role');
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
    /**
     * 角色列表
     */
    public function role()
    {
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
                return $this->success('当前角色：'.$data['title'].'添加成功','Rbac/node');
            }else{
                return $this->error('角色添加失败');
            }
        }else{
            return $this->fetch();
        }
    }
    /**
     * 节点列表页
     */
    public function node()
    {
        $where['field'] = array('id','name','title','pid');
        $page_data = $this->node->pageData($where,'range');
        $page_data = node_merge($page_data);
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
     * 接收角色post数据
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
}
