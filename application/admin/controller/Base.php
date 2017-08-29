<?php
namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{

	//状态
	public function status(){
		//获取状态
		$data=input('get.');
		if(empty($data['id'])){
			$this->error('id不合法');
		}
		if(!is_numeric($data['status'])){
			$this->error('status不合法');
		}

		//获取控制器
		$model=request()->controller();

		$res=model($model)->save(['status'=>$data['status']],['id'=>$data['id']]);
		if($res){
			$this->success('状态更新成功');
		}else{
			$this->error('状态更新失败');
		}
	}


	//排序
	public function listorder(){
		$data=input('post.');
		if(empty($data['id'])){
			$this->error('id不合法');
		}
		if(!is_numeric($data['listorder'])){
			$this->error('status不合法');
		}
		$model=request()->controller();
		$res=model($model)->save(['listorder'=>$data['listorder']],['id'=>$data['id']]);
		if($res){
			$this->result($_SERVER['HTTP_REFERER'],1,'success');
		}else{
			$this->result($_SERVER['HTTP_REFERER'],1,'更新失败');
		}
	}

}
