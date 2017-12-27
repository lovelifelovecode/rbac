<?php
namespace app\rbac\controller;
use think\Request;
use think\Controller;

/**
* rbac>>common controller
*/
class Common extends Controller
{
	public function __construct(Request $request=null){
		parent::__construct($request);

		//执行登录验证
		//$_SESSION['admin']['admin_id'];
		if(!session('user.user_id')){
			//如果没有登陆，则跳到登陆页面
			$this->redirect('app/rbac/login/index');
		}else{
			//判断是否为超级管理员
			$is_admin = (new \app\common\model\User())->get(session('user.user_id'));
			if(empty($is_admin['is_admin'])){
				$this->authority();
			}

			//记录操作日志
			$this->operationLog();
		}
	}

	//判断是否有权限
	protected function authority(){
		/**
		 * 判断权限的逻辑是
		 * 取出当前登录用户的所属角色，
		 * 在通过角色 取出 所属 权限关系
		 * 在权限表中取出所有的权限链接
		 * 判断当前访问的链接 是否在 所拥有的权限列表中
		 */
		/**
		 * 具体步骤如下:
		 * 1.通过用户id在用户角色表中查出所属的所有角色
		 * 2.用角色通过角色权限表查出所属的所有权限
		 * 3.用权限通过权限表查出所属的所有权限的url
		 * 4.判断当前的url是否有所属的所有权限的url中
		 */
		//step1.通过用户id在用户角色表中查出所属的所有角色
		$user_id = session('user.user_id');
		$roles = (new \app\common\model\UserRole())->all(['uid' => $user_id]);
		if(!$roles){
			$this->redirect('app/rbac/login/noAuthority', ['msg' => '您不属于任何角色，请与管理员联系。']);
			exit;
		}

		// //测试有多少个角色
		// foreach ($roles as $key => $value) {
		// 	dump($value->toArray());
		// }
		// exit;

		//step2.用角色通过角色权限表查出所属的所有权限
		$authoritysArr = [];
		foreach ($roles as $value) {
			$authoritysArr[] = (new \app\common\model\RoleAuthority())->all(['role_id'=>$value['role_id']]);
		}

		//合并成权限数组
		$authoritys = [];
		foreach ($authoritysArr as $value) {
			foreach ($value as $home) {
				$authoritys[] = $home['access_id'];
			}
		}
		// dump($authoritys);
		if(empty($authoritys)){
			$this->redirect('app/rbac/login/noAuthority',['msg'=>'您没有任何权限，请与管理员联系。']);
		}

		//step3.用权限通过权限表查出所属的所有权限的url
		$urlJsonArr = [];
		foreach ($authoritys as $key => $value) {
			// dump($value['access_id']);
			$urlJsonArr[] = (new \app\common\model\Authority())->all(['id'=>$value]);
		}

		// // //测试有多少个urls json 组
		// foreach ($urlJsonArr as $key => $value) {
		// 	dump($value[0]->toArray());
		// }
		// exit;

		//step4.用json_decode()遍历所有权限的url
		$urlsArr = [];
		foreach ($urlJsonArr as $value) {
			// dump($value['urls']);	
			$urlsArr[] = json_decode($value[0]['urls']);
		}

		//step5.合并成urls数组
		$urls = [];
		foreach ($urlsArr as $value) {
			foreach ($value as $home) {
				$urls[] = $home;
			}
		}

		//step6.判断当前的url是否有所属的所有权限的url中	
		// echo Request::instance()->url() . '<br/>';
		if(!in_array(Request::instance()->url(), $urls)){
			$this->redirect('app/rbac/login/noAuthority',['msg'=>'您没有权限，请与管理员联系。']);
		}
		// exit;
	}

	//记录操作日志
	protected function operationLog(){
		$saveData = [
			'uid' => session('user.user_id'),
			'target_url' => Request::instance()->url(),
			'query_params' => Request::instance()->param(),
			'ua' => '',
			'ip' => Request::instance()->ip(),
		];
		(new \app\common\model\OperationLog())->save($saveData);
	}
}