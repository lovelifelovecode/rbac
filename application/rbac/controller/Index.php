<?php
namespace app\rbac\controller;
use think\Request;
/**
* home page
*/
class Index extends Common
{
	public function testGetData(){
		$res = Request::instance()->param('userid');
		dump($res);
		return 'The url date is :'.$res;
	}

	/**
	 * Home page
	 * @return [type] [description]
	 */
	public function index(){
		return $this->fetch();
	}

	/**
	 * page1
	 */
	public function page1(){
		$this->assign('content','This is the first page.11');
		return $this->fetch('testpage');
	}

	/**
	 * page2
	 */
	public function page2(){
		$this->assign('content','This is the second page.2222');
		return $this->fetch('testpage');
	}

	/**
	 * page3
	 */
	public function page3(){
		$this->assign('content','This is the third page.333333');
		return $this->fetch('testpage');
	}

	/**
	 * page4
	 */
	public function page4(){
		$this->assign('content','This is the fourth page.4444444');
		return $this->fetch('testpage');
	}
}