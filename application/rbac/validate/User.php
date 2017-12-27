<?php
namespace app\rbac\validate;
use think\Validate;

/**
* User validate
*/
class User extends Validate
{
	protected $rule = [
		'username' => 'require',
		'password' => 'require'
	];

	protected $message = [
		'username.require' => 'Please input username',
		'password.require' => 'Please input password',
	];
}