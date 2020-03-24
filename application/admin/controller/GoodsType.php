<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\facade\Session;
use Org\Util\Page;
class GoodsType extends Common
{
    protected $goods_type;
    protected $uid;
    protected $type_id;
    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->goods_type = model('GoodsType');
        $this->uid = session(config('rbac.USER_AUTH_KEY'));
        $this->type_id = input('type_id',0,'intval');
    }
    /**
     * 配置参数列表页
     */
    public function index()
    {
        if($this->request->isPost()){
            $type_name = input('post.type_name','n');
            $type_status = input('post.type_status','-1','intval');
            $page = input('post.page',1,'intval');
        }else{
            $type_name = input('type_name','n');
            $type_status = input('type_status','-1','intval');
            $page = input('page',1,'intval');
        }
        $where = array();
        if($type_status > 0){
            $where['$type_status'] = $type_status;
        }else{
            $where['$type_status'] = 0;
        }
        // 接收判断英文名称
        if($type_name !="" && $type_name != 'n'){
            $where['type_name'] = $this->strSpaceDel($type_name);
        }else{
            $type_name = 'n';
        }
        // 判断状态
        if($type_status > -1){
            $where['type_status'] = $type_status;
        }else{
            $type_status = -1;
        }
        // 求总数
        $page_total = $this->goods_type->pageData($where,'total');//总条数
        $where['page'] = $page;
        $where['field'] = array('type_id','type_name','type_status','add_time');
        $where['order'] = 'type_id asc';
        $where['limit'] = 8;//每页显示条数
        $where['pageRow'] = 4;//显示页码数量
        // 求分页数据
        $page_data = $this->goods_type->pageData($where,'range');
        // 求分页url
        $page_url = url('GoodsType/index',array('type_name' => $type_name,'type_status' => $type_status),'');
        // 载入分页
        $page = new Page($page_total,$where['limit'],$where['pageRow'],$where['page'],$page_url,'{page}');
        // 显示分页
        $show = $page->show(5);
        $this->assign('page',$show);
        // 模板赋值
        $this->assign('page_data',$page_data);
        $this->assign('type_name',$type_name);
        $this->assign('type_status',$type_status);
        $this->assign('page_total', $page_total);
        return $this->fetch();
    }

    /**
     * 添加配置参数
     */
    public function add()
    {
        if($this->request->isPost()){
            // 数据
            $data = $this->postData();
            $data['basic']['add_time'] = time();
            $data['basic']['add_user_id'] = $this->uid;
            // 添加
            $res = $this->goods_type->addData($data);
            if($res){
                save_log('商品类型名称'.$data['type_name'].'添加成功',5);
                $this->success('添加商品类型名称'.$data['type_name'].'成功',url('GoodsType/index',array('type_id' => $this->type_id)));
            }else{
                $this->error('添加商品类型名称失败',url('GoodsType/add'));
            }
        }else{
            return $this->fetch();
        }
    }
    /**
     * 编辑配置参数
     */
    public function edit()
    {
        $type_id_id = input('type_id_id');
        if(empty($type_id_id)){
            $this->error('配置参数id不存在',url('type_id/index'));
        }
        $type_id_one = $this->type_id->getOne(array('type_id_id' => $type_id_id));
        if($this->request->isPost()){
            // 更新user表数据
            $data = $this->postData();
            $res = $this->type_id->saveData(array('type_id_id' => $type_id_id),$data);
            // 结果判断
            if($res){
                save_log('配置参数：'.$data['type_id_title'].'编辑成功',3);
                $this->success('配置参数'.$data['type_id_title'].'编辑成功',url('type_id/index',array('type_id' => $this->type_id)));
            }else{
                $this->error('配置参数'.$data['type_id_title'].'编辑失败',url('type_id/index',array('type_id' => $this->type_id)));
            }
        }else{
            // 渲染编辑页面
            $this->assign('type_id_one',$type_id_one);
            return $this->fetch();
        }        
    }
    /**
     * 删除配置参数
     */
    public function del()
    {
        $type_id_id = input('type_id_id');
        if(is_array($type_id_id)){
            $type_id_arr = $type_id_id;
            $type_id_ids = implode(',',$type_id_id);
        }else{
            $type_id_arr = array($type_id_id);
            $type_id_ids = $type_id_id;
        }
        // 判断用户id是否存在
        foreach($type_id_arr as $v){
            $type_id_one = $this->type_id->getOne(array('type_id_id' => $v));
            if(empty($type_id_one)){
                $this->error('删除失败，配置参数id不存在',url('type_id/index',array('type_id' => $this->type_id)));
            }
        }
        // 删除
        foreach($type_id_arr as $v){
            $where = array('type_id_id' => $v);
            $res = $this->type_id->delData($where);
        }
        if($res){
            save_log('配置参数ID：'.$type_id_ids.'删除成功',3);
            $this->success('配置参数id：'.$type_id_ids.'删除成功',url('type_id/index',array('type_id' => $this->type_id)));
        }else{
            $this->success('配置参数删除失败',url('type_id/index'));
        }
    }
    /**
     * 网站配置
     */
    public function webtype_id()
    {
        if($this->request->isPost()){
            $data = $_POST['type_id'];
            if(!is_array($data)){
                $this->error('错误，数据为空！',url("type_id/webtype_id"));
            }
            foreach($data as $key => $val){
                $this->type_id->saveData(array('type_id_id' => $key),$val);
            }
            $this->success('修改成功');
        }else{
            if(!cache('type_id_page_data')){
                $where = array();
                $where[] = array('group_status','=',1);
                $page_data = $this->type_id->webtype_id($where);
                // cache('type_id_page_data',$page_data,86400);
            }
            $this->assign('page_data',$page_data);
            return $this->fetch();
        }
    }
    /**
     * 配置参数名称是否重复验证
     */
    public function ajaxtypeName()
    {
        $key = input('name');
        $val = input('param');
        $type_id_id = input('type_id_id',0,'intval');
        // 调用model方法
        $res = $this->type_id->ajaxtype_idName($val,$type_id_id);
        if(!$res){
            $data = array(
                'status' => 'y',
                'info' => '英文名验证通过'
            );
        }else{
            $data = array(
                'status' => 'n',
                'info' => '配置参数用户名重复'
            );
        }
        return json($data);
    }
        /**
     * 配置参数名称是否重复验证
     */
    public function ajaxtype_idTitle()
    {
        $key = input('name');
        $val = input('param');
        $type_id_id = input('type_id_id',0,'intval');
        // 调用model方法
        $res = $this->type_id->ajaxtype_idTitle($val,$type_id_id);
        if(!$res){
            $data = array(
                'status' => 'y',
                'info' => '中文名验证通过'
            );
        }else{
            $data = array(
                'status' => 'n',
                'info' => '配置参数用户名重复'
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
        $data = array();
        $data['basic'] = array(
            'type_name' => input('type_name','','htmlspecialchars,strip_tags,strtoupper'),
            'type_status' => input('type_status',0,'intval')
        );
        $data['attr'] = array(
            'attr_name' => input('attr_name'),
            'attr_value' => input('attr_value'),
            'attr_unit' => input('attr_unit'),
            'attr_style' => input('attr_style'),
            'attr_search' => input('attr_search'),
            'attr_type' => input('attr_type'),
            'attr_sort' => input('attr_sort')
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
                'type_id_id' => $this->type_id_id
            );
            $res = $this->type_id->saveData($where,$data);
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
    public function savetype_id()
    {
        $this->type_id->savetype_id();
    }
}