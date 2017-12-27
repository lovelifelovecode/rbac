<?php
namespace app\rbac\controller;
use think\Request;
use app\common\model\Authority;

/**
* 角色控制器
*/
class Role extends Common
{
	protected $db;
	protected $roleAuthority;
	protected function _initialize(){
		parent::_initialize();
		$this->db = new \app\common\model\Role();
		$this->roleAuthority = new \app\common\model\RoleAuthority();
	}
	/**
	 * List
	 */
	public function index(){
		$res = $this->db->roleGetAll();
		$this->assign('list',$res);
		return $this->fetch();
	}

	/**
	 * addRole
	 */
	public function roleAdd(){
		if(request()->isPost()){
			$res = $this->db->roleAdd(Request::instance()->post());
			if($res['valid'])
			{
				//执行成功
				$this->success($res['msg'],'index');exit;
			}else{
				//执行失败
				$this->error($res['msg']);exit;
			}
		}
		return $this->fetch();
	}

	/**
	 * 设置权限
	 */
	public function authoritySet(){
		if(request()->isPost()){
			$res = $this->db->authoritySet(Request::instance()->post());
			if($res['valid']){
				//success
				$this->success($res['msg'],'index');exit;
			}else{
				$this->error($res['msg']);exit;
			}
		}
		//获取角色信息
		$role_id = Request::instance()->param('role_id');
		$role_info = $this->db->find($role_id);
		$this->assign('role_info',$role_info);

		//获取权限列表
		$authorityList = ( new Authority() )->authorityList();
		$this->assign('authorityList',$authorityList);

		// //获取已选取的权限
		$authoritySelected = $this->roleAuthority->authoritySelected($role_id);
		$this->assign('authoritySelected',$authoritySelected);
		return $this->fetch();
	}
}