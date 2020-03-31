<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\facade\Session;
use Org\Util\Page;
class GoodsClass extends Common
{
    protected $goods_class;
    protected $uid;
    protected $class_id;
    protected $goods_type;
    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->goods_class = model('GoodsClass');
        $this->goods_type = model('GoodsType');
        $this->class_id = input('calss_id',0,'intval');
        $this->uid = session(config('rbac.USER_AUTH_KEY'));
    }
    /**
     * 商品分类列表页
     */
    public function index()
    {
        if($this->request->isPost()){
            $class_name = input('post.class_name','n');
            $class_status = input('post.class_status','-1');
            $page = input('post.page',1,'intval');
        }else{
            $class_name = input('class_name','n');
            $class_status = input('class_status','-1','intval');
            $page = input('page',1,'intval');
        }
        $where = array();
        // 接收判断名称
        if($class_name !="" && $class_name != 'n'){
            $where['class_name'] = $this->strSpaceDel($class_name);
        }else{
            $class_name = 'n';
        }
        // 判断状态
        if($class_status > -1){
            $where['class_status'] = $class_status;
        }else{
            $class_status = -1;
        }
        if($class_name == 'n'){
            $where['class_pid'] = 0;
        }
        // 总条数
        $page_total = $this->goods_class->pageData($where,'total');//总条数
        $where['page'] = $page;
        $where['field'] = array('class_id','class_name','class_status','add_time','class_sort','class_is_nav','class_pid');
        $where['order'] = 'class_id asc';
        $where['limit'] = 8;//每页显示条数
        $where['pageRow'] = 4;//显示页码数量
        // 求分页数据
        $page_data = $this->goods_class->pageData($where,'range');
        // 无限级分类
        if(!empty($page_data)){
            foreach($page_data as $key => $val){
                $arr[] = $this->_childClass($val);
            }
            $page_data = $arr;
        }
        // 求分页url
        $page_url = url('GoodsClass/index',array('class_name' => $class_name,'class_status' => $class_status),'');
        // 载入分页
        $page = new Page($page_total,$where['limit'],$where['pageRow'],$where['page'],$page_url,'{page}');
        // 显示分页
        $show = $page->show(5);
        $this->assign('page',$show);
        // 模板赋值
        $this->assign('page_data',$page_data);
        $this->assign('class_name',$class_name);
        $this->assign('class_status',$class_status);
        $this->assign('page_total', $page_total);
        return $this->fetch();
    }
    public function _childClass($class_one){
        $arr = array();
        $arr['class_id'] = $class_one['class_id'];
        $arr['class_name'] = $class_one['class_name'];
        $arr['class_status'] = $class_one['class_status'];
        $arr['add_time'] = $class_one['add_time'];
        $arr['class_sort'] = $class_one['class_sort'];
        $arr['class_is_nav'] = $class_one['class_is_nav'];
        $arr['class_pid'] = $class_one['class_pid'];
        $child_data = $this->goods_class->getField(array('class_pid' => $arr['class_id']),'class_id,class_name,class_status,add_time,class_sort,class_is_nav,class_pid','class_id');
        if(!empty($child_data)){
            foreach($child_data as $key => $val){
                $arr['child'][] = $this->_childClass($val);
            }
        }
        return $arr;
    }
    /**
     * 添加商品分类
     */
    public function add()
    {
        if($this->request->isPost()){
            // 数据
            $data = $this->postData();
            $data['add_time'] = time();
            $data['add_user_id'] = $this->uid;
            // 添加
            $res = $this->goods_class->addData($data);
            if($res){
                save_log('商品分类名称'.$data['class_name'].'添加成功',6);
                $this->success('添加商品分类名称'.$data['class_name'].'成功',url('GoodsClass/index'));
            }else{
                $this->error('添加商品分类名称失败',url('GoodsClass/index'));
            }
        }else{
            $class_id = input('class_id',0,'intval');
            $this->assign('class_id',$class_id);
            // 求goodsType类型名称
            $goods_type_data = $this->goods_type->getField(array('type_status' => 1),'type_id,type_name','type_id');
            $this->assign('goods_type_data',$goods_type_data);
            return $this->fetch();
        }
    }
    /**
     * 编辑商品分类
     */
    public function edit()
    {
        $class_id = input('class_id');
        if(empty($class_id)){
            $this->error('商品分类id不存在',url('GoodsType/index'));
        }
        $class_one = $this->goods_class->getOne(array('class_id' => $class_id));
        if($this->request->isPost()){
            // 更新表数据
            $data = $this->postData();
            $res = $this->goods_class->saveData(array('class_id' => $this->class_id),$data,$this->class_id);
            // 结果判断
            if($res){
                save_log('商品分类：'.$data['class_name'].'编辑成功',3);
                $this->success('商品分类'.$data['class_name'].'编辑成功',url('GoodsType/edit',array('class_id' => $this->class_id)));
            }else{
                $this->error('商品分类'.$data['class_name'].'编辑失败',url('GoodsType/edit',array('class_id' => $this->class_id)));
            }
        }else{
            // 渲染编辑页面
            $this->assign('class_one',$class_one);
            $attr_data = $this->goods_class->getAttrData(array('class_id' => $this->class_id));
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
     * 删除商品分类
     */
    public function del()
    {
        $class_id = input('class_id');
        if(is_array($class_id)){
            $class_arr = $class_id;
            $class_ids = implode(',',$class_id);
        }else{
            $class_arr = array($class_id);
            $class_ids = $class_id;
        }
        // 判断用户id是否存在
        foreach($class_arr as $v){
            $class_one = $this->goods_class->getOne(array('class_id' => $v));
            if(empty($class_one)){
                $this->error('删除失败，商品分类id不存在',url('GoodsType/index'));
            }
        }
        // 删除
        foreach($class_arr as $v){
            $where = array('class_id' => $v);
            $res = $this->goods_class->delData($where);
        }
        if($res){
            save_log('商品分类ID：'.$class_ids.'删除成功',3);
            $this->success('商品分类id：'.$class_ids.'删除成功',url('GoodsType/index'));
        }else{
            $this->success('商品分类删除失败',url('GoodsType/index'));
        }
    }
    /**
     * 接收post数据
     */
    public function postData()
    {   
        $data = array();
        $data['basic'] = array(
            'class_name' => input('class_name','','htmlspecialchars,strip_tags,strtoupper'),
            'class_keywords' => input('class_keywords','','htmlspecialchars,strip_tags'),
            'class_desc' => input('class_desc','','htmlspecialchars,strip_tags'),
            'class_url' => input('class_url','','htmlspecialchars,strip_tags'),
            'class_is_nav' => input('class_is_nva',0,'intval'),
            'class_status' => input('class_status',0,'intval'),
            'class_srot' => input('class_sort',1,'intval'),
            'class_pid' => input('class_pid',0,'intval'),
            'type_id' => input('type_id',0,'intval')
        );
        return $data;
    }
	/**
	 * ajax更新相关属性
	 */
	public function ajaxRecommand ()
	{
		if ($this->request->isPost()) {
			$data = array(
				input('type') => input('value')
			);
			$where = array(
				'class_id' => $this->class_id,
			);
			$res = $this->goods_class->saveData($where, $data);
			if ($res) {
				$data = array(
					'info' => '更新成功',
					'status' => 1,
				);
			} else {
				$data = array(
					'info' => '更新失败',
					'status' => 0,
				);
			}
			return json($data);
		} else {
			halt('页面不存在');
		}
	}
    /**
     * 商品分类名称是否重复验证
     */
    public function ajaxClassName()
    {
        $key = input('name');
        $val = input('param');
        $class_id = input('class_id',0,'intval');
        $class_pid = input('class_pid',0,'intval');
        // 调用model方法
        $res = $this->goods_class->ajaxClassName($val,$class_pid,$class_id);
        if(!$res){
            $data = array(
                'status' => 'y',
                'info' => '中文名验证通过'
            );
        }else{
            $data = array(
                'status' => 'n',
                'info' => '商品分类用户名重复'
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
}