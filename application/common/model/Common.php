<?php

namespace app\common\model;

use think\Model;
use think\Db;

Class Common extends Model
{
	protected $table;

	public function __construct ($data = [])
	{
		parent::__construct($data);
	}

	/**
	 * 添加数据
	 */
	public function addData ($data = array())
	{
		return Db::name($this->table)->insert($data, 0, 1);
	}

	/**编辑数据
	 * @param array $where
	 * @param array $data
	 */
	public function saveData ($where = array(), $data = array())
	{
		return Db::name($this->table)->where($where)->update($data);
	}

	/**删除数据
	 * @param $where
	 * @return int
	 * @throws \think\Exception
	 * @throws \think\exception\PDOException
	 */
	public function delData ($where)
	{
		return Db::name($this->table)->where($where)->delete();
	}

	/**取出一个字段
	 * @param $where
	 * @param string $field
	 */
	public function getValue ($where, $field = "*")
	{
		return Db::name($this->table)->where($where)->value($field);
	}

	/**取出多个字段 指定数组键值
	 * @param $where
	 * @param $field
	 * @param $key
	 * @return array
	 */
	public function getField ($where, $field, $key)
	{
		return Db::name($this->table)->where($where)->column($field, $key);
	}

	/**取出一条数据
	 * @param array $where
	 * @param string $field
	 * @param string $order
	 * @return array|null|\PDOStatement|string|Model
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public function getOne ($where = array(), $field = "*", $order = "")
	{
		return Db::name($this->table)->where($where)->field($field)->order($order)->find();
	}

	/**设置字段自增
	 * @param array $where
	 * @param string $field
	 * @param int $num
	 * @return int|true
	 * @throws \think\Exception
	 */
	public function setIncData ($where = array(), $field = "", $num = 1)
	{
		return Db::name($this->table)->where($where)->setInc($field, $num);
	}

	/**设置字段自减
	 * @param array $where
	 * @param string $field
	 * @param int $num
	 * @return int|true
	 * @throws \think\Exception
	 */
	public function setDecData ($where = array(), $field = "", $num = 1)
	{
		return Db::name($this->table)->where($where)->setDec($field, $num);
	}

	/**插入数据
	 * @param $table
	 * @param $data
	 * @return int|string
	 */
	public function tableAddData ($table, $data)
	{
		return Db::name($table)->insert($data, 0, 1);
	}

	/**编辑数据
	 * @param array $where
	 * @param array $data
	 */
	public function tableSaveData ($table, $where = array(), $data = array())
	{
		return Db::name($table)->where($where)->update($data);
	}

	/**取出一条数据 根据表名
	 * @param array $where
	 * @param string $field
	 * @param string $order
	 * @return array|null|\PDOStatement|string|Model
	 */
	public function tableGetOne ($table, $where = array(), $field = "*", $order = "")
	{
		return Db::name($table)->where($where)->field($field)->order($order)->find();
	}

	/**取出多个字段 指定数组键值
	 * @param $where
	 * @param $field
	 * @param $key
	 * @return array
	 */
	public function tableGetField ($table, $where, $field, $key)
	{
		return Db::name($table)->where($where)->column($field, $key);
	}

	/**根据表取出数据
	 * @param $table
	 * @param $where
	 * @param string $field
	 */
	public function tableGetData ($table, $where, $field = "*")
	{
		return Db::name($table)->where($where)->field($field)->select();
	}

	/**根据表删除数据
	 * @param $table
	 * @param $where
	 * @return int
	 */
	public function tableDelData ($table, $where)
	{
		return Db::name($table)->where($where)->delete();
	}

	/**取出全部数据
	 * @param null|string $where
	 * @param string $field
	 * @param string $order
	 * @return array|mixed|\PDOStatement|string|\think\Collection
	 */
	public function getData ($where=array(), $field = "*", $order = "")
	{
		return Db::name($this->table)->where($where)->field($field)->order($order)->select();
	}

	/**取出一个字段
	 * @param $where
	 * @param string $field
	 */
	public function getTableValue ($table, $where, $field = "*")
	{
		return Db::name($table)->where($where)->value($field);
	}
	/**设置字段自增
	 * @param array $where
	 * @param string $field
	 * @param int $num
	 * @return int|true
	 * @throws \think\Exception
	 */
	public function tableSetIncData ($table, $where = array(), $field = "", $num = 1)
	{
		return Db::name($table)->where($where)->setInc($field, $num);
	}
	/**设置字段自减
	 * @param array $where
	 * @param string $field
	 * @param int $num
	 * @return int|true
	 * @throws \think\Exception
	 */
	public function tableSetDecData ($table, $where = array(), $field = "", $num = 1)
	{
		return Db::name($table)->where($where)->setDec($field, $num);
	}
}