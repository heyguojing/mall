<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\facade\Session;
use Org\Util\Page;
class Config extends Common
{
    protected $config;
    protected $config_id;
    protected $uid;
    protected $config_group;
    protected $group_id;
    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->config = model('Config');
        $this->config_id = input('config_id',0,'intval');
        $this->config_group = model('ConfigGroup');
        $this->group_id = input('group_id',0,'intval');
        $this->uid = session(config('rbac.USER_AUTH_KEY'));
    }
    /**
     * 配置组列表页
     */
    public function index()
    {
        if($this->request->isPost()){
            $group_id = input('post.group_id',0,'intval');
            $config_name = input('post.config_name','n');
            $config_status = input('post.config_status','-1','intval');
            $config_title = input('post.config_title','n');
            $page = input('post.page',1,'intval');
        }else{
            $group_id = input('group_id',0,'intval');
            $config_name = input('config_name','n');
            $config_status = input('config_status',-1,'intval');
            $config_title = input('config_title','n');
            $page = input('page',1,'intval');
        }
        $where = array();
        if($group_id > 0){
            $where['group_id'] = $group_id;
        }else{
            $where['group_id'] = 0;
        }
        // 接收判断英文名称
        if($config_name !="" && $config_name != 'n'){
            $where['config_name'] = $this->strSpaceDel($config_name);
        }else{
            $config_name = 'n';
        }
        // 接收判断中文名称
        if($config_title !="" && $config_title != 'n'){
            $where['config_title'] = $this->strSpaceDel($config_title);
        }else{
            $config_title = 'n';
        }
        // 判断状态
        if($config_status > -1){
            $where['config_status'] = $config_status;
        }else{
            $config_status = -1;
        }
        // 求总数
        $page_total = $this->config->pageData($where,'total');//总条数
        $where['page'] = $page;
        $where['field'] = array('group_id','config_id','config_name','config_title','config_sort','config_status','add_time');
        $where['order'] = 'config_id asc';
        $where['limit'] = 8;//每页显示条数
        $where['pageRow'] = 4;//显示页码数量
        // 求分页数据
        $page_data = $this->config->pageData($where,'range');
        // 求分页url
        $page_url = url('Config/index',array('config_name' => $config_name,'config_title' => $config_title,'config_status' => $config_status),'');
        // 载入分页
        $page = new Page($page_total,$where['limit'],$where['pageRow'],$where['page'],$page_url,'{page}');
        // 显示分页
        $show = $page->show(5);
        $this->assign('page',$show);
        // 模板赋值
        $this->assign('page_data',$page_data);
        $this->assign('config_name',$config_name);
        $this->assign('config_title',$config_title);
        $this->assign('config_status',$config_status);
        $this->assign('page_total', $page_total);
        $this->assign('group_id',$group_id);
        return $this->fetch();
    }

    /**
     * 添加配置组
     */
    public function add()
    {
        $group_one = $this->config_group->getOne(array('group_id' => $this->group_id));
        if(empty($group_one)){
            $this->error('该配置组id不存在',url('ConfigGroup/index'));
        }
        if($this->request->isPost()){
            // 数据
            $data = $this->postData();
            $data['add_time'] = time();
            $data['add_user_id'] = $this->uid;
            // 添加
            $res = $this->config->addData($data);
            if($res){
                save_log('配置组'.$data['config_title'].'添加成功',3);
                $this->success('添加配置组'.$data['config_title'].'成功',url('Config/index'));
            }else{
                $this->error('添加配置组失败',url('Config/add'));
            }

        }else{
            $this->assign('group_id',$this->group_id);
            return $this->fetch();
        }
    }
    /**
     * 编辑配置组
     */
    public function edit()
    {
        $config_id = input('config_id');
        if(empty($config_id)){
            $this->error('配置组id不存在',url('Config/index'));
        }
        $config_one = $this->config->getOne(array('config_id' => $config_id));
        if($this->request->isPost()){
            // 更新user表数据
            $data = $this->postData();
            $res = $this->config->saveData(array('config_id' => $config_id),$data);
            // 结果判断
            if($res){
                save_log('配置组：'.$data['config_title'].'编辑成功',3);
                $this->success('配置组'.$data['config_title'].'编辑成功',url('Config/index'));
            }else{
                $this->error('配置组'.$data['config_title'].'编辑失败',url('Config/index'));
            }
        }else{
            // 渲染编辑页面
            $this->assign('config_one',$config_one);
            return $this->fetch();
        }        
    }
    /**
     * 删除配置组
     */
    public function del()
    {
        $config_id = input('config_id');
        if(is_array($config_id)){
            $config_arr = $config_id;
            $config_ids = implode(',',$config_id);
        }else{
            $config_arr = array($config_id);
            $config_ids = $config_id;
        }
        // 判断用户id是否存在
        foreach($config_arr as $v){
            $config_one = $this->config->getOne(array('config_id' => $v));
            if(empty($config_one)){
                $this->error('删除失败，配置组id不存在',url('Config/index'));
            }
        }
        // 删除
        foreach($config_arr as $v){
            $where = array('config_id' => $v);
            $res = $this->config->delData($where);
        }
        if($res){
            save_log('配置组ID：'.$config_ids.'删除成功',3);
            $this->success('配置组id：'.$config_ids.'删除成功',url('Config/index'));
        }else{
            $this->success('配置组删除失败',url('Config/index'));
        }
    }
    /**
     * 配置组名称是否重复验证
     */
    public function ajaxConfigName()
    {
        $key = input('name');
        $val = input('param');
        $config_id = input('config_id',0,'intval');
        // 调用model方法
        $res = $this->config->ajaxConfigName($val,$config_id);
        if(!$res){
            $data = array(
                'status' => 'y',
                'info' => '英文名验证通过'
            );
        }else{
            $data = array(
                'status' => 'n',
                'info' => '配置组用户名重复'
            );
        }
        return json($data);
    }
        /**
     * 配置组名称是否重复验证
     */
    public function ajaxConfigTitle()
    {
        $key = input('name');
        $val = input('param');
        $config_id = input('config_id',0,'intval');
        // 调用model方法
        $res = $this->config->ajaxConfigTitle($val,$config_id);
        if(!$res){
            $data = array(
                'status' => 'y',
                'info' => '中文名验证通过'
            );
        }else{
            $data = array(
                'status' => 'n',
                'info' => '配置组用户名重复'
            );
        }
        return json($data);
    }
    /**
     * 过滤搜索框字符串中的空格
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
    /**
     * 接收post数据
     */
    public function postData()
    {
        $data = array(
            'config_name' => input('config_name','','htmlspecialchars,strip_tags,strtoupper'),
            'config_title' => input('config_title','','htmlspecialchars,strip_tags'),
            'config_value' => input('config_value',0,'htmlspecialchars,strip_tags'),
            'config_type' => input('config_type','txt','htmlspecialchars,strip_tags'),
            'config_message' => input('config_message',0,'htmlspecialchars,strip_tags'),
            'config_info' => input('config_info',0,'htmlspecialchars,strip_tags'),
            'config_sort' => input('config_sort',0,'intval'),
            'config_status' => input('config_status',0,'intval'),
            'group_id' => $this->group_id
        );
        return $data;
    }
    /**
     * ajax更新状态
     */
    public function ajaxRecommand()
    {
        if($this->request->isPost()){
            $data = array(
                input('type') => input('value')
            );
            $where = array(
                'config_id' => $this->config_id
            );
            $res = $this->config->saveData($where,$data);
            if($res){
                $data = array(
                    'status' => 1,
                    'info' => '修改成功'
                );
            }else{
                $data = array(
                    'status' => 0,
                    'info' => '修改失败'
                );
            }
            return json($data);
        }else{
            halt('页面不存在');
        }
    }
}