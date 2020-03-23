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
    public function ajaxGoodsTypeName($type_name,$type_id = 0)
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
     * 输入框
     */
    public function _text($v)
    {
        // config_value 配置值
        return '<input type="text" name="config['.$v['type_id'].'][config_value]" value="'.$v['config_value'].'" class="col-xs-10 ">';
    }
    /**
     * 单选框
     */
    public function _radio($v)
    {
        $html = '';
        $info = explode(',',$v['config_info']);//array('1|开启','0|关闭')
        foreach($info as $key => $val){
            $data = explode('|',$val);//array('1','开启')
            $checked = $data[0] == $v['config_value']?'checked="checked"':'';
            $key = $key + 1;
            if($key%3 == 0){
                $html.='<label><input name="config['.$v['type_id'].'][config_value]" type="radio" value="'.$data[0].'" class="ace"'.$checked.'><span class="lbl">'.$data[1].'</span></label>';
            }else{
                $html.='<label style="margin-left:10px;"><input name="config['.$v['type_id'].'][config_value]" type="radio" value="'.$data[0].'" class="ace"'.$checked.'><span class="lbl">'.$data[1].'</span></label>';
            }
        }
        return $html;
    }
    /**
     * 下拉框
     */
    public function _select($v)
    {
        $html = '<select name="config['.$v['type_id'].'][config_value]" id="" class="col-xs-10">';
        $info = explode(',',$v['config_info']);
        foreach($info as $key => $val){
            $data = explode('|',$val);
            $checked = $data[0] == $v['config_value']?'checked = "checked"':'';
            $html.='<option value="'.$data[0].'" '.$checked.'>'.$data[1].'</option>';
        }
        return $html;
    }
    /**
     * 文本域
     */
    public function _textarea($v)
    {
        return '<textarea class="col-xs-10 " style="height: 60px;" name="config[' . $v['type_id'] . '][config_value]" style="height:100px;border:1px solid #ccc;margin-left:8px;">' . $v['config_value'] . '</textarea>';
    }
    /**
     * 文件上传
     */
    public function _file($v)
    {

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
                    $type_id = $res;
                    $arr['attr_name'] = $attr_name[$key];
                    $arr['attr_value'] = $attr_value[$key];
                    $arr['attr_unit'] = $attr_unit[$key];
                    $arr['attr_style'] = $attr_style[$key];
                    $arr['attr_search'] = $attr_search[$key];
                    $arr['attr_type'] = $attr_type[$key];
                    $arr['attr_sort'] = $attr_sort[$key];
                    Db::name('goods_attr')->insert($arr,0,1);
                }
            }
        }
        return true;
    }
    /**
     * 删除数据
     */
    public function delData ($where)
	{
		 Db::name($this->table)->where($where)->delete();
		 $this->saveConfig();
		 return true;
    }
    /**
     * 更新数据
     */
    public function saveData($where = array(),$data = array())
    {
        Db::name($this->table)->where($where)->update($data);
        $res = $this->saveConfig();
        return true;
    }
    public function saveConfig()
    {
        // 删除缓存目录
        Dir::del(Env::get('runtime_path').'cache/');
        $page_data = Db::name($this->table)->where(array('type_status' => 1))->order('type_id asc')->select();
        $arr = array();
        if(!empty($page_data)){
            foreach($page_data as $key => $val){
                $name = strtoupper($val['type_name']);
                if(strtoupper($val['config_value']) == "TRUE"){
                    $val['config_value'] = true;
                }
                if(strtoupper($val['config_value']) == "FALSE"){
                    $val['config_value'] = FALSE;
                }
                $arr[$name] = htmlspecialchars_decode($val['config_value']);
            }
        }
        //写入配置文件
        $content = "<?php return ".var_export($arr,true)."\n?>";
        return file_put_contents("../config/site.php",$content);
    }
}