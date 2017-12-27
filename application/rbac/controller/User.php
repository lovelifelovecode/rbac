<?php
namespace app\rbac\controller;
use think\Db;
use think\Request;
use app\common\model\Role;

/**
* 用户表控制器
*/
class User extends Common
{
	protected $db;
	protected function _initialize(){
		parent::_initialize();
		$this->db = new \app\common\model\User();
	}

	//Home page -> list
	public function index(){
		$res = $this->db->getAllUser();
		$this->assign('list',$res);
		return $this->fetch();
	}

	/**
	 * userAdd
	 */
	public function userAdd(){
		$user_id = Request::instance()->param('user_id');
		if(request()->isPost()){
			if(empty($user_id)){
				$res = $this->db->userAdd(Request::instance()->post());
			}else{
				$res = $this->db->userEdit(Request::instance()->post());
			}

			if($res['valid'])
			{
				//执行成功
				$this->success($res['msg'],'index');exit;
			}else{
				//执行失败
				$this->error($res['msg']);exit;
			}
			dump($_POST);exit;
		}

		if($user_id){
			//说明是编辑请求
			$oldRoleData = $this->db->find($user_id);
			$oldSelectData = $this->db->selected($user_id);
			$this->assign('oldSelectData',$oldSelectData);
		}else{
			//添加
			$oldRoleData = ['username'=>'','password'=>''];
		}
		$this->assign('oldRoleData',$oldRoleData);
		$res = (new Role())->roleGetAll();
		$this->assign('roleList',$res);
		return $this->fetch();
	}
}