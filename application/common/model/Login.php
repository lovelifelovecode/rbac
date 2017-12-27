<?php
namespace app\common\model;
use think\Model;
use think\Loader;

/**
* home page
*/
class Login extends Model
{
	protected $userID = 'id';
	protected $table = 'user';
	public function login($data){
		//1.执行验证
		$validate = Loader::validate('login');
		if(!$validate->check($data)){
			return ['valid'=>0,'msg'=>$validate->getError()];
		}

		//2.比对用户名和密码是否正确
		$password = md5(md5($data['password']).md5('skyuse'));
		$userInfo = $this->where('username',$data['username'])->where('password',$password)->find();
		if(!$userInfo){
			return ['valid'=>0,'msg'=>'用户名或者密码不正确'];
		}

		//3.将用户信息存入到session中
		session('user.user_id',$userInfo['id']);
		session('user.user_name',$userInfo['username']);
		return ['valid'=>1,'msg'=>'登录成功'];
	}
}