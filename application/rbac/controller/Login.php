<?php
namespace app\rbac\controller;
use think\Request;
use think\Controller;

/**
* AdminUser controller
*/
class Login extends Controller
{
	protected $db;
	protected function _initialize ()
	{
		parent::_initialize(); // TODO: Change the autogenerated stub
		$this->db = new \app\common\model\Login();
	}

	//login home page
	public function index(){
		if(request()->isPost()){
			$res = $this->db->login(Request::instance()->post());		
			if($res['valid']){
				//success
				$this->success($res['msg'],'app/rbac/index/index');exit;
			}else{
				//fail
				$this->error($res['msg']);exit;
			}
		}
		return $this->fetch();
	}

	//no authority
	public function noAuthority(){
		$title = Request::instance()->param('msg');
		$this->assign('title',$title);
		return $this->fetch();
	}
}