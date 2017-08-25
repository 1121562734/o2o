<?php
namespace app\common\model;

use think\Model;

class BisLocation extends BaseModel
{
	public function getNormalLocationByBisId($bis_id){
		$order =[
			'id'=>'desc',
		];
		$data= [
			'bis_id'=>$bis_id,
			'status'=>1,
		];
		$result=$this->where($data)
			->order($order)
			->select();
		return $result;
	}

}