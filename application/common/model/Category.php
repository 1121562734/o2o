<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
	protected $autoWriteTimestamp = true;//时间戳自动添加
	public function add($data){
		$data['status']=1;
		//$data['create_time']=time();
		return $this->save($data);
	}
	
	public function getNormalFirstCategory(){
		$data = [
			'status'=>1,
		    'parent_id'=>0,
		];
		$order = [
			'id'=>'desc',
		];
		return $this->where($data)
			->order($order)
			->select();
	}
	//查询分类
	public function getFirstCategory($parent_id = 0){
	$data = [
		'parent_id' => $parent_id,
		'status'=> ['neq',-1]
	];
	$order = [
		'listorder' => 'desc',
		'id'=>'desc',
	];
	$result=$this->where($data)
		->order($order)
		->paginate();
		//->select();

	return $result;
	}

	public function getNormalCategoryByParentId($parentId=0){
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
}