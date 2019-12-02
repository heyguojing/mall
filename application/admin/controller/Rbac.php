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
                return $this->error('添加失败','Rbac/addNode');
            }
        }else{
            $level = input('level',0,'intval');
            $pid = input('pid',0,'intval');
            $this->assign('level',$level);
            $this->assign('pid',$pid);
            return $this->fetch();
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
            'status' => input('status',0,intval),
            'is_show' => input('is_show'),
            'sort' => input('sort',0,intval)
        );
        return $data;
    }
}
