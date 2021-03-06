<?php
namespace app\admin\model;
use think\Db;
use think\facade\Env;
use Org\Util\Dir;
class GoodsType extends Common
{
    protected $table;
    public function __construct($data = array()){
        parent::__construct($data);
        $this->table = "goods_type";
    }
    /**
     * 节点分页 求总数
     * 
     */
    public function pageData($param = array(),$range = 'total')
    {
        $where = array();
        // 状态判断是否展示
        if(isset($param['type_status']) && $param['type_status'] > -1){
            $where[] = array('type_status','=',$param['type_status']);
        }
        // 根据角色中文名查询
        if(isset($param['type_name']) && $param['type_name'] != ''){
            $where[] = array('type_name','like','%'.$param['type_name'].'%');
        }
        if($range == 'total'){
            // 求总数
            return Db::name($this->table)->where($where)->count();
        }else{
            // 分页
            $limit = isset($param['limit'])?(int)$param['limit']:0;
            if($limit > 0){
                $page = isset($param['page'])?(int)$param['page']:1;
                $limit_start = ($page-1)*$limit;
                $limit = $limit_start.','.$limit;
            }else{
                $limit = 0;
            }
            // 字段
            $field = isset($param['field'])?$param['field']:"";
            // 排序
            $order = isset($param['order'])?$param['order']:'type_id desc';
            return Db::name($this->table)->where($where)->field($field)->limit($limit)->order($order)->select();
        }
    }
    /**
     * 配置组验证英文名称
     */
    public function ajaxTypeName($type_name,$type_id = 0)
    {
        if(empty($type_name)){
            return 1;
        }
        $where = array();
        $where[] = array('type_name','=',$type_name);
        //$where = array('type_name' => $type_name);等价
        if($type_id > 0){ 
            $where[] = array('type_id','<>',$type_id);
        }
        return Db::name($this->table)->where($where)->find();
    }
    /**
     * 获取网站配置数据
     */
    public function webConfig($where)
    {
        $page_data = Db::name('config_group')->where($where)->order('type_id asc')->select();
        if($page_data){
            foreach($page_data as $key => $val){
                $where = array();
                $where['type_status'] = 1;
                $where['type_id'] = $val['type_id'];
                $config = Db::name($this->table)->where($where)->order('config_sort asc,type_id asc')->select();
                if($config){
                    foreach($config as $k => $v){
                        $func = '_'.$v['config_type'];
                        $config[$k]['html'] = $this->$func($v);
                    }
                }
                $page_data[$key]['config'] = $config;
            }
        }
        return $page_data;
    }

    /**
	 * 添加数据
	 */
	public function addData ($data = array())
	{
        $res = Db::name($this->table)->insert($data['basic'],0,1);
        if($res){
            $attr_name = $data['attr']['attr_name'];
            $attr_value = $data['attr']['attr_value'];
            $attr_unit = $data['attr']['attr_unit'];
            $attr_style = $data['attr']['attr_style'];
            $attr_search = $data['attr']['atr_search'];
            $attr_type = $data['attr']['attr_type'];
            $attr_sort = $data['attr']['attr_sort'];
            if($attr_name){
                $arr = array();
                foreach($attr_name as $key => $val){
                    $arr['type_id'] = $res;
                    $arr['attr_name'] = $attr_name[$key];
                    $arr['attr_value'] = $attr_value[$key];
                    $arr['attr_unit'] = $attr_unit[$key];
                    $arr['attr_style'] = $attr_style[$key];
                    $arr['attr_type'] = $attr_type[$key];
                    $arr['attr_sort'] = $attr_sort[$key];
                    $arr['attr_search'] = isset($attr_search[$key])?$attr_search[$key]:0;
                    $arr['attr_status'] = 1;
                    Db::name('attr')->insert($arr,0,1);
                }
            }
        }
        return true;
    }
    /**
     * 更新数据
     */
    public function saveData($where = array(),$data = "",$type_id = 0)
    {
        // 商品基本表
        $res = Db::name($this->table)->where($where)->update($data['basic']);
        $attr_id = input('attr_id');
        //p($attr_id);die;
        $attr_name = $data['attr']['attr_name'];
        $attr_value = $data['attr']['attr_value'];
        $attr_unit = $data['attr']['attr_unit'];
        $attr_style = $data['attr']['attr_style'];
        $attr_search = $data['attr']['attr_search'];
        $attr_type = $data['attr']['attr_type'];
        $attr_sort = $data['attr']['attr_sort'];
      
        // 获取原有的规格id
        $exist = Db::name('attr')->where($where)->column('attr_id','attr_id');
        // 商品属性表
        $arr = array();
        if($attr_id){
            foreach($attr_id as $key => $val){
                $arr['type_id'] = $type_id;
                $arr['attr_name'] = $attr_name[$key];
                $arr['attr_value'] = $attr_value[$key];
                $arr['attr_unit'] = $attr_unit[$key];
                $arr['attr_style'] = $attr_style[$key];
                $arr['attr_search'] = isset($attr_search[$key])?$attr_search[$key]:0;
                $arr['attr_status'] = 1;
                $arr['attr_sort'] = $attr_sort[$key];
                if(in_array($key,$exist)){
                    Db::name('attr')->where(array('attr_id' => $key))->update($arr);
                }else{
                    Db::name('attr')->insert($arr,0,1);
                }
            } 
        }
        if(empty($attr_name)){
            //$where = array('type_id' => $type_id);
            Db::name('attr')->where($where)->delete();
        }else{
            $attr_id_str = array_diff($exist,array_keys($attr_id));
            if(!empty($attr_id_str)){
                $where = array();
                $where[] = array('attr_id','IN',$attr_id_str);
                Db::name('attr')->where($where)->delete();
            }
        }
        return true;
    }
    /**
     * getAttrData非post编辑数据查询
     */
    public function getAttrData($where = array(),$field = "*")
    {
        return Db::name('attr')->where($where)->field($field)->select();
    }
    /**
     * 删除数据
     */
    public function delData ($where)
	{
        Db::name('goods_type')->where($where)->delete();
		Db::name('attr')->where($where)->delete();
		return true;
    }
    /**
     * ajax更新开启关闭
     */
    public function ajaxSaveData($where = array(),$data = array())
    {
        Db::name($this->table)->where($where)->update($data);
        return true;
    }
}