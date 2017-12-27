<?php
namespace app\common\model;
use think\Model;

/**
* 角色与权限的关系模型
*/
class UserRole extends Model
{
	protected $pk = 'id';
	protected $table = 'user_role';

}