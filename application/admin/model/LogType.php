<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class LogType extends Common
{
    protected $logType;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'logType';
    }
}