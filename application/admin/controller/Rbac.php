<?php
namespace app\admin\controller;
use think\Db;
use think\facade\Request;
use think\facade\Session;
class Rbac extends Common
{
    protected $table = '';
    public function __construct()
    {
        parent::__construct();
        $this->table = model('Node');
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
     * 节点列表页
     */
    public function node()
    {
        $where['field'] = array('id','name','title','pid');
        $page_data = $this->table->pageData($where,'range');
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
            $res = $this->table->addData($data);
            if($res){
                return $this->success('当前节点：'.$data['title'].'添加成功','Rbac/node');
            }else{
                return $this->error('添加失败');
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
        $editdata = $this->table->getOne($where);
        if(empty($editdata)){
            $this->error('节点不存在','Rbac/node');
        }
        // post
        if($this->request->isPost()){
            $data = $this->postNodeData();
            $res = $this->table->saveData($where,$data);
            if($res){
                return $this->success('当前节点：'.$data['title'].'编辑成功',url('rbac/node'));
            }else{
                return $this->error('编辑失败');
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
        $id = input('id',0,'intvel');
        $deldata = $this->table->getOne(array('id' => $id));
        if(empty($deldata)){
            $this->error('删除失败，节点不存在',url('Rbac/node'));
        }
        // 判断是否有子节点
        $where = array('pid'=>$id);
        $data = $this->table->pageData($where,'total');
        if($data > 0){
            print_r($data);
            $this->error('不能删除,该节点包含子节点',url('Rbac/node'));
        }
        $where = array('id' => $id);
        $res = $this->table->delData($where);
        if($res){
            $this->success('删除成功',url('Rbac/node'));
        }else{
            $this->error('删除失败',url('Rbac/node'));
        }
    }
    /**
     * 接收post过来的数据
     */
    public function postNodeData()
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
}
