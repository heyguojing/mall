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
     * 配置组列表页
     */
    public function index()
    {
        if($this->request->isPost()){
            $group_name = input('post.group_name','n');
            $group_status = input('post.group_status','-1','intval');
            $group_title = input('post.group_title','n');
            $page = input('post.page',1,'intval');
        }else{
            $group_name = input('group_name','n');
            $group_status = input('group_status',-1,'intval');
            $group_title = input('group_title','n');
            $page = input('page',1,'intval');
        }
        $where = array();
        // 接收判断英文名称
        if($group_name !="" && $group_name != 'n'){
            $where['group_name'] = $this->strSpaceDel($group_name);
        }else{
            $group_name = 'n';
        }
        // 接收判断中文名称
        if($group_title !="" && $group_title != 'n'){
            $where['group_title'] = $this->strSpaceDel($group_title);
        }else{
            $group_title = 'n';
        }
        // 判断状态
        if($group_status > -1){
            $where['group_status'] = $group_status;
        }else{
            $group_status = -1;
        }
        // 求总数
        $role_total = $this->config_group->pageData($where,'total');//总条数
        $where['page'] = $page;
        $where['field'] = array('group_id','group_name','group_title','group_sort','group_status','add_time');
        $where['order'] = 'group_id asc';
        $where['limit'] = 10;//每页显示条数
        $where['pageRow'] = 4;//显示页码数量
        // 求分页数据
        $page_data = $this->config_group->pageData($where,'range');
        // 求分页url
        $page_url = url('ConfigGroup/index',array('group_name' => $group_name,'group_title' => $group_title,'group_status' => $group_status),'');
        // 载入分页
        $page = new Page($role_total,$where['limit'],$where['pageRow'],$where['page'],$page_url,'{page}');
        // 显示分页
        $show = $page->show(5);
        $this->assign('page',$show);
        // 模板赋值
        $this->assign('page_data',$page_data);
        $this->assign('group_name',$group_name);
        $this->assign('group_title',$group_title);
        $this->assign('group_status',$group_status);
        $this->assign('page_total', $page_total);
        return $this->fetch();
    }

    /**
     * 添加配置组
     */
    public function add()
    {
        if($this->request->isPost()){
            p(11111);
            // 数据
            $data = $this->postData();
            $data['add_time'] = time();
            $data['add_user_id'] = $this->uid;
            // 添加
            $res = $this->config_group->addData($data);
            if($res){
                save_log('配置组'.$data['group_title'].'添加成功',3);
                $this->success('添加配置组'.$data['group_title'].'成功',url('ConfigGroup/index'));
            }else{
                $this->error('添加配置组失败',url('ConfigGroup/add'));
            }

        }else{
            return $this->fetch();
        }
    }
    /**
     * 编辑配置组
     */
    public function edit()
    {
        $group_id = input('group_id');
        if(empty($group_id)){
            $this->error('配置组id不存在',url('ConfigGroup/index'));
        }
        $group_one = $this->config_group->getOne(array('group_id' => $group_id));
        if($this->request->isPost()){
            // 更新user表数据
            $data = $this->postData();
            $res = $this->config_group->saveData(array('group_id' => $group_id),$data);
            // 结果判断
            if($res){
                save_log('配置组：'.$data['group_title'].'编辑成功',3);
                $this->success('配置组'.$data['group_title'].'编辑成功',url('ConfigGroup/index'));
            }else{
                $this->error('配置组'.$data['group_title'].'编辑失败',url('ConfigGroup/index'));
            }
        }else{
            // 渲染编辑页面
            $this->assign('group_one',$group_one);
            return $this->fetch();
        }        
    }
    /**
     * 删除配置组
     */
    public function del()
    {
        $group_id = input('group_id');
        if(is_array($group_id)){
            $group_arr = $group_id;
            $group_ids = implode(',',$group_id);
        }else{
            $group_arr = array($group_id);
            $group_ids = $group_id;
        }
        // 判断用户id是否存在
        foreach($group_arr as $v){
            $group_one = $this->config_group->getOne(array('group_id' => $v));
            if(empty($group_one)){
                $this->error('删除失败，配置组id不存在',url('ConfigGroup/index'));
            }
        }
        // 删除
        foreach($group_arr as $v){
            $where = array('group_id' => $v);
            $res = $this->config_group->delData($where);
        }
        if($res){
            save_log('配置组ID：'.$group_ids.'删除成功',3);
            $this->success('配置组id：'.$group_ids.'删除成功',url('ConfigGroup/index'));
        }else{
            $this->success('配置组删除失败',url('ConfigGroup/index'));
        }
    }
    /**
     * 配置组名称是否重复验证
     */
    public function ajaxGroupName()
    {
        $key = input('name');
        $val = input('param');
        $group_id = input('group_id',0,'intval');
        // 调用model方法
        $res = $this->config_group->ajaxGroupName($val,$group_id);
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
    public function ajaxGroupTitle()
    {
        $key = input('name');
        $val = input('param');
        $group_id = input('group_id',0,'intval');
        // 调用model方法
        $res = $this->config_group->ajaxGroupTitle($val,$group_id);
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
            'group_name' => input('group_name'),
            'group_title' => input('group_title'),
            'group_sort' => input('group_sort',1,'intval'),
            'group_status' => input('group_status',0,'intval')
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
                'group_id' => $this->group_id
            );
            $res = $this->config_group->saveData($where,$data);
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