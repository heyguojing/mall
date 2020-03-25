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
     * 商品类型列表页
     */
    public function index()
    {
        if($this->request->isPost()){
            $type_name = input('post.type_name','n');
            $type_status = input('post.type_status','-1');
            $page = input('post.page',1,'intval');
        }else{
            $type_name = input('type_name','n');
            $type_status = input('type_status','-1','intval');
            $page = input('page',1,'intval');
        }
        $where = array();
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
        if(!empty($page_data)){
            foreach($page_data as $key => $val){
                $page_data[$key]['attr_data'] =$this->goods_type->getAttrData(array('type_id' => $val['type_id']),'attr_name,attr_value,attr_style,attr_type');
            }
        }
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
     * 添加商品类型
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
                $this->success('添加商品类型名称'.$data['type_name'].'成功',url('GoodsType/index'));
            }else{
                $this->error('添加商品类型名称失败',url('GoodsType/add'));
            }
        }else{
            return $this->fetch();
        }
    }
    /**
     * 编辑商品类型
     */
    public function edit()
    {
        $type_id = input('type_id');
        if(empty($type_id)){
            $this->error('商品类型id不存在',url('GoodsType/index'));
        }
        $type_one = $this->goods_type->getOne(array('type_id' => $type_id));
        if($this->request->isPost()){
            // 更新表数据
            $data = $this->postData();
            $res = $this->goods_type->saveData(array('type_id' => $this->type_id),$data,$this->type_id);
            // 结果判断
            if($res){
                save_log('商品类型：'.$data['type_name'].'编辑成功',3);
                $this->success('商品类型'.$data['type_name'].'编辑成功',url('GoodsType/edit',array('type_id' => $this->type_id)));
            }else{
                $this->error('商品类型'.$data['type_name'].'编辑失败',url('GoodsType/edit',array('type_id' => $this->type_id)));
            }
        }else{
            // 渲染编辑页面
            $this->assign('type_one',$type_one);
            $attr_data = $this->goods_type->getAttrData(array('type_id' => $this->type_id));
            $att_sort_temp = array();
            if(!empty($attr_data)){
                foreach($attr_data as $key => $val){
                    $att_sort_temp[] = $val['attr_sort'];
                }
            }
            if(!empty($att_sort_temp)){
                $attr_sort = max($att_sort_temp) + 1;
            }else{
                $attr_sort = 1;
            }
            $this->assign('attr_sort',$attr_sort);
            $this->assign('attr_data',$attr_data);
            return $this->fetch();
        }        
    }
    /**
     * 删除商品类型
     */
    public function del()
    {
        $type_id = input('type_id');
        if(is_array($type_id)){
            $type_arr = $type_id;
            $type_ids = implode(',',$type_id);
        }else{
            $type_arr = array($type_id);
            $type_ids = $type_id;
        }
        // 判断用户id是否存在
        foreach($type_arr as $v){
            $type_one = $this->goods_type->getOne(array('type_id' => $v));
            if(empty($type_one)){
                $this->error('删除失败，商品类型id不存在',url('GoodsType/index'));
            }
        }
        // 删除
        foreach($type_arr as $v){
            $where = array('type_id' => $v);
            $res = $this->goods_type->delData($where);
        }
        if($res){
            save_log('商品类型ID：'.$type_ids.'删除成功',3);
            $this->success('商品类型id：'.$type_ids.'删除成功',url('GoodsType/index'));
        }else{
            $this->success('商品类型删除失败',url('GoodsType/index'));
        }
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
     * 商品类型名称是否重复验证
     */
    public function ajaxTypeName()
    {
        $key = input('name');
        $val = input('param');
        $type_id = input('type_id',0,'intval');
        // 调用model方法
        $res = $this->goods_type->ajaxTypeName($val,$type_id);
        if(!$res){
            $data = array(
                'status' => 'y',
                'info' => '中文名验证通过'
            );
        }else{
            $data = array(
                'status' => 'n',
                'info' => '商品类型用户名重复'
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
     * ajax更新状态
     */
    public function ajaxRecommand()
    {
        if($this->request->isPost()){
            $data = array(
                input('type') => input('value')
            );
            $where = array(
                'type_id' => $this->type_id
            );
            $res = $this->goods_type->ajaxSaveData($where,$data);
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