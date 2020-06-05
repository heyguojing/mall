<?php
namespace app\common\model;
use think\Db;

class Store extends Common{
    protected $table;
    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->table = "store";
    }
    /**
     * ajaxStoreName
     */
	public function ajaxStoreName ($store_name, $store_id = 0)
	{
		if (empty($store_name)) {
			return 1;
		}
		//组装where条件
		$where = array();
		$where[] = array('store_name', '=', $store_name);
		if ($store_id > 0) {
			$where[] = array('store_id', '<>', $store_id);
		}
		return Db::name($this->table)->where($where)->find();
	}
}