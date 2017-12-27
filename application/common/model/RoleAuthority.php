<?php
namespace app\common\model;
use think\Model;

/**
* 角色与权限的关系模型
*/
class RoleAuthority extends Model
{
	protected $pk = 'id';
	protected $table = 'role_access';
	protected $insert = ['created_time'];

	protected function setCreatedTimeAttr($value){
		return date("Y-m-d H:i:s");
	}

	/**
	 * 获取已选取的权限
	 */
	public function authoritySelected($data){
		$result = $this->where('role_id',$data)->select();
		$selecteds = [];
		foreach($result as $value){
			$selecteds[] = $value['access_id'];		
		}
		return $selecteds;	
	}
}