<?php
namespace app\rbac\controller;

/**
* 操作日志 controller
*/
class OperationLog extends Common
{
	protected $db;
	protected function _initialize(){
		parent::_initialize();
		$this->db = new \app\common\model\OperationLog();
	}

	public function index(){
		$operation_list = $this->db->operationList();
		$this->assign('list',$operation_list);
		return $this->fetch();
	}
}