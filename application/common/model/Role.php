<?php
namespace app\common\model;
use think\Model;

/**
* 角色Model
*/
class Role extends Model
{
	protected $pk = 'id';
	protected $table = 'role';
	protected $insert = ['created_time'];
	protected $update = ['updated_time'];

	protected function setCreatedTimeAttr($value){
		return date("Y-m-d H:i:s");
	}

	protected function setUpdatedTimeAttr($value){
		return date("Y-m-d H:i:s");
	}

	//role add
	public function roleAdd($data){
		//1.验证
		$result = $this->validate(true)->where('name',$data['name'])->find();
		if($result){
			//角色名已存在
			return ['valid'=>0,'msg'=>'角色名已存在'];
		}
		//2.执行添加
		$result = $this->validate(true)->save($data,$data['id']);
		if($result)
		{
			//说明执行成功
			return ['valid'=>1,'msg'=>'操作成功'];
		}else{
			//验证不通过
			return ['valid'=>0,'msg'=>$this->getError()];
		}
	}

	//get All roles
	public function roleGetAll(){
		$result = $this->where('status',1)->select();
		return $result;
	}

	/**
	 * find the one data
	 */
	public function find($data){
		$result = $this->where('id',$data)->field('name')->find();
		return $result;	
	}

	/**
	 * 设置权限
	 */
	public function authoritySet($data){
		if(!empty($data['authority_ids'])){
			//1.查找原有的权限
			$oldAuthority = ( new RoleAuthority() )->all(['role_id'=>3]);
			$old_authority_ids = [];
			foreach ($oldAuthority as $value) {
				$old_authority_ids[] = $value['access_id'];
			}

			//新的权限
			$new_authority_ids = $data['authority_ids'];

			//删除不再选中的
			$delete_authority_ids = array_diff($old_authority_ids,$new_authority_ids);
			foreach($delete_authority_ids as $value){
				( new RoleAuthority() )->destroy(['access_id'=>$value]);
			}

			//添加新选中的
			$save_authority_ids = array_diff($new_authority_ids, $old_authority_ids);
			foreach ($save_authority_ids as $value) {
				$saveData = ['role_id'=>$data['role_id'],'access_id'=>$value,'created_time'=>date("Y-m-d H:i:s")];
				( new RoleAuthority() )->save( $saveData );
			}
			return ['valid'=>1,'msg'=>'操作成功'];
		}else{
			// 如果一个权限都没选中，则删除原有的权限
			$result = ( new RoleAuthority() )->destroy(['role_id'=>$data['role_id']]);
			if($result){
				return ['valid'=>1,'msg'=>'操作成功'];
			}else{
				return ['valid'=>0,'msg'=>'操作失败'];
			}
		}
	}}