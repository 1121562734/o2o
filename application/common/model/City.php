<?php

namespace app\Common\model;

use think\Model;

class City extends Model
{
    //获取二级分类模型
	public function getNormalCitysByParentId($parentId=0){
		$data = [
			'status'=> 1,
			'parent_id'=> $parentId,
		];
		$order = [
			'id'=>'desc'
		];
		return $this->where($data)
			->order($order)
			->select();
	}

	//获取城市的信息
	public function getNormalCitys(){
		$data = [
			'status'=> 1,
			'parent_id'=> ['gt',0],
		];

		$order = [
			'id'=>'desc'
		];

		return $this->where($data)
			->order($order)
			->select();
	}
}
