<?php
namespace app\rbac\controller;
use think\Request;

/**
* 权限控制器
*/
class Authority extends Common
{
	protected $db;
	protected function _initialize(){
		parent::_initialize();
		$this->db = new \app\common\model\Authority();
	}
	//authority home page
	public function index(){
		$authorityList = $this->db->authorityList();
		if($authorityList){
			$this->assign('authorityList',$authorityList);
		}
		
		return $this->fetch();
	}

	/**
	 * add authority
	 */
	public function authorityAdd(){
		$authority_id = Request::instance()->param('authority_id');
		if(request()->isPost()){
			$res = $this->db->authorityAdd(Request::instance()->post());
			if($res['valid']){
				//success
				$this->success($res['msg'],'index');exit;	
			}else{
				//fail
				$this->error($res['msg']);exit;
			}
		}

		if($authority_id){
			//说明是修改
			$oldData = $this->db->find($authority_id);
		}else{
			$oldData = ['title'=>'','urls'=>''];
		}
		$this->assign('oldData',$oldData);
		return $this->fetch();
	}
}