<?php
namespace app\rbac\validate;
use think\Validate;

/**
* Authority validate
*/
class Authority extends Validate
{
	
	protected $rule = [
		'title' => 'require',
	];

	protected $message = [
		'title.require'=>'请输入权限标题',
	];
}