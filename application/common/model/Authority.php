<?php
namespace app\common\model;
use think\Model;

/**
* 权限模型
*/
class Authority extends Model
{
	protected $pk = 'id';
	protected $table = 'access';
	protected $insert = ['created_time'];
	protected $update = ['updated_time'];

	protected function setCreatedTimeAttr($value){
		return date("Y-m-d H:i:s");
	}

	protected function setUpdatedTimeAttr($value){
		return date("Y-m-d H:i:s");
	}

	/**
	 * authority list
	 */
	public function authorityList(){
		$data = $this->where('status',1)->select();
		foreach($data as &$value){
			$value['urls'] = json_decode($value['urls']);
			$value['urls'] = implode('<br>', $value['urls']);
		}	
		return $data;	
	}

	//add authority
	public function authorityAdd($data){
		//1.验证
		$urls = explode("\n",$data['urls']);
		$urlsJson = json_encode($urls);
		$saveData = ['title'=>$data['title'],'urls'=>$urlsJson,'id'=>$data['authority_id']];
		$result = $this->validate(true)->save($saveData,$data['authority_id']);
/*		$result = $this->validate(true)->save([
										    'title'  => $data['title'],
										    'urls' => $urlsJson
										],['id' => $data['authority_id']]);*/
		if($result){
			return ['valid'=>1,'msg'=>'权限操作成功'];
		}else{
			return ['valid'=>0,'msg'=>$this->getError()];	
		}
	}

	/**
	 * find the one authority
	 */
	public function find($data){
		$result = $this->where('status',1)->where('id',$data)->find();
		$result['urls'] = json_decode($result['urls']);
		$result['urls'] = implode('',$result['urls']);
		return $result;
	}
}