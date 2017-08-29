<?php
namespace app\common\model;


use think\Model;

class Featured extends BaseModel{
	/**
	 * 根据类型获取推荐位列表数据
	 * @param int $type
	 */
	public function getFeaturedsByType($type=0){
		$data= [
			'type' =>$type,
		    'status' => ['neq',-1]
		];

		$order= ['id'=>'desc'];
		return $this->where($data)
			->order($order)
			->paginate();

	}
}