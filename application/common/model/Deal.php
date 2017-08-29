<?php
namespace app\common\model;

use think\Model;

class Deal extends BaseModel
{
	public function getNormalDeals($data =array()){
		$data['status']=1;
		$oredr=['id'=>'desc'];
		return $this->where($data)
			->order($oredr)
			->paginate();
	}
}