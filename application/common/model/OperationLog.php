<?php
namespace app\common\model;
use think\Model;
use think\Db;
/**
* 后台操作日志
*/
class OperationLog extends Model
{
	protected $pk = 'id';
	protected $table = 'app_access_log';
	protected $insert = ['created_time'];

	protected function setCreatedTimeAttr($value){
		return date("Y-m-d H:i:s");
	}

	public function operationList(){


		$result = $this->alias('a')->join('__USER__ u','a.uid=u.id','LEFT')
			->field( 'a.target_url,a.query_params,a.ip,a.created_time,u.username' )
			->order('created_time desc')
			->paginate(50);

		$search  = [
			'/index.php/rbac/index/page1.html',
			'/index.php/rbac/index/page2.html',
			'/index.php/rbac/index/page3.html',
			'/index.php/rbac/index/page4.html',
			'/index.php/rbac/user/index.html',
			'/index.php/rbac/user/useradd.html',
			'/index.php/rbac/operation_log/index.html',
		];
		$replace =[
			'page1',
			'page2',
			'page3',
			'page4',
			'查看用户list',
			'用户添加',
			'用户操作日志列表'
		];

		foreach ($result as $key => &$value) {
			$value['target_url'] = str_replace($search, $replace, $value['target_url']);
		}
		return $result;
	}
}