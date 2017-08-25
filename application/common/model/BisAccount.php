<?php
namespace app\common\model;

use think\Model;

class BisAccount extends BaseModel
{
	public function updataById($data,$id){

		//过滤post数组
		return $this->save($data,['id'=>$id]);
	}

}