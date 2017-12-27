<?php
namespace app\common\model;
use think\Model;

/**
* user model
*/
class User extends Model
{
	protected $pk = 'id';
	protected $table = 'user';
	protected $insert = ['created_time'];
	protected $update = ['updated_time'];

	protected function setCreatedTimeAttr($value){
		return date("Y-m-d H:i:s");
	}

	protected function setUpdatedTimeAttr($value){
		return date("Y-m-d H:i:s");
	}

	/**
	 * get all userinfo
	 * @return [type] [description]
	 */
	public function getAllUser(){
		$result = $this->where('status',1)->select();
		return $result;
	}

	/**
	 * add user
	 */
	public function userAdd($data){
		//1.is alread exit?
		$userinfo = $this->validate(true)->where('username',$data['username'])->find();
		if($userinfo){
			return ['valid'=>0,'msg'=>'用户已存在'];
		}
		//2.保存用户信息并且保存用户角色关系表
		$password = md5(md5($data['username']).md5($data['password']).md5('skysue'));
		$saveData = ['username'  => $data['username'],
					 'password' => $password
					];
		$result = $this->validate(true)->save($saveData);
		if($result)
		{
			//说明保存用户信息执行成功
			if(isset($data['role_ids'])){
				//保存用户角色关系表
				$uid = $this->id;//获取自增ID
				foreach($data['role_ids'] as $value){
					$data = ['uid'=>$uid,'role_id'=>$value,'created_time'=>date("Y-m-d H:i:s")];
					( new UserRole() )->save($data);
				}
			}
			return ['valid'=>1,'msg'=>'添加操作成功'];
		}else{
			//验证不通过
			return ['valid'=>0,'msg'=>$this->getError()];
		}
	}

	/**
	 * use edit
	 */
	public function userEdit($data){
		// dump($data);exit;
		//2.保存用户信息并且保存用户角色关系表
		$password = md5(md5($data['username']).md5($data['password']).md5('skyuse'));
		$saveData = ['username'  => $data['username'],
					 'password' => $password
					];
		$result = $this->validate(true)->save([
										 'username'  => $data['username'],
										 'password' => $password
										],['id' => $data['user_id']]);
		$uid = $data['user_id'];
		if($result)
		{
			//说明保存用户信息执行成功
			if(isset($data['role_ids'])){
				//保存用户角色关系表
				//旧角色数组
				// $oldRolesArr = Db::table('user_role')->where('uid',$data['user_id'])->field('role_id')->select();
				$oldRolesArr = ( new UserRole() )->all(['uid'=>$data['user_id']]);
				$oldRoles = [];

				if($oldRolesArr){//if have 旧角色数组
					foreach($oldRolesArr as $value){
						$oldRoles[] = $value['role_id'];
					}
				}

				//新角色数组
				$newRoles = $data['role_ids'];

				//用差集求要删除的数组
				$delRoles = array_diff($oldRoles,$newRoles);
				foreach ($delRoles as $value) {
					// Db::table('user_role')->where('role_id',$value)->delete();
					( new UserRole() )->destroy(['role_id'=>$value]);
				}

				//用差集求要添加的数组
				$addRoles = array_diff($newRoles,$oldRoles);
				foreach($addRoles as $value){
					$data = ['uid'=>$uid,'role_id'=>$value,'created_time'=>date("Y-m-d H:i:s")];
					// Db::table('user_role')->insert($data);
					( new UserRole() )->save($data);
				}
			}else{
				( new UserRole() )->destroy(['uid'=>$uid]);
			}
			return ['valid'=>1,'msg'=>'添加操作成功'];
		}else{
			//验证不通过
			return ['valid'=>0,'msg'=>$this->getError()];
		}
	}

	/**
	 * find one user
	 */
	public function find($data){
		$result = $this->where('status',1)->where('id',$data)->find();
		return $result;	
	}

	/**
	 * get the selected role
	 */
	public function selected($data){
		$result = ( new UserRole() )->all(['uid'=>$data]);
		return $result;	
	}
}