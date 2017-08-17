<?php
namespace app\common\model;

use think\Model;

class BaseModel extends Model
{
	protected $autoWriteTimestamp = true;//时间戳自动添加
	public function add($data){
		$data['status']=0;
		$this->save($data);
		return $this->id;

	}

}