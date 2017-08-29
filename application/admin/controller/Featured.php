<?php
namespace app\admin\controller;

use think\Controller;

class Featured extends Base
{
	private $obj;

	public function _initialize(){
		$this->obj=model('Featured');
	}


	public function index(){
		$types =config('featured.featured_type');
		$type = input('get.type',0,'intval');
		//获取列表数据
		$results=$this->obj->getFeaturedsByType($type);

		return $this->fetch('',
			[
				'types'=>$types,
			    'results'=>$results,
			    'type'=>empty($type)?0:$type,
			]
		);
	}
	public function add(){
		if(request()->isPost()){
			//提交数据
			$data=input('post.');
			//数据效验

			//存储数据
			$id=model('featured')->add($data);
			if($id){
				$this->success('提交成功');
			}else{
				$this->error('提交失败');
			}
		}else{
		//获取推荐位类型
		$types = config('featured.featured_type');
		return $this->fetch('',
			[
				'types'=>$types,
			]
		);
		}
	}
	
	//public function status(){
	//	//获取状态
	//	$data=input('get.');
	//	//$validate=validate('Featured');
	//	//if(!$validate->scene('status')->check($data)){
	//	//	$this->error($validate->getError());
	//	//}
	//
	//	$res=$this->obj->save(['status'=>$data['status']],['id'=>$data['id']]);
	//	if($res){
	//		$this->success('状态更新成功');
	//	}else{
	//		$this->error('状态更新失败');
	//	}
	//}

}
