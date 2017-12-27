<?php
namespace app\rbac\validate;
use think\Validate;

/**
* Role validate
*/
class Role extends Validate
{
	protected $rule = [
		'name' => 'require',
	];

	protected $message = [
		'name.require' => 'Please enter role!',
	];
}