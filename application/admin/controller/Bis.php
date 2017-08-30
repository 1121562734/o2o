<?php
namespace app\admin\controller;

use think\Controller;

class Bis extends Controller
{
	private $obj;

	public function _initialize(){
		$base = new app\admin\controller\Base();
		$base->status();


		$this->obj=model('Bis');

	}
    
	//商户首页
	public function index(){
		$bis=$this->obj->getBisByStatus(1);
		return $this->fetch('',[
			'bis'=>$bis,
		]);
	}
	//入驻申请
	public function apply(){
		$bis=$this->obj->getBisByStatus();
		return $this->fetch('',[
			'bis'=>$bis,
		]);
	}

	/**
	 * 编辑
	 */
	public function detail($id=0){
		if(intval($id)<1){
			$this->error('参数不合法');
		}
		$bis=$this->obj->get($id);
		$accountData=model('Bis_account')->where(['bis_id'=>$id,'is_main'=>1])->find();
		$locationData=model('Bis_location')->where(['bis_id'=>$id,'is_main'=>1])->find();
		//获取一级城市的数据
		$citys = model('city')->getNormalCitysByParentId();
		//获取分类栏目的数据
		$categorys=model('category')->getNormalCategoryByParentId();
		return $this->fetch('',[
			'citys'=>$citys,
			'categorys'=>$categorys,
		    'bisData'=>$bis,
		    'accountData'=>$accountData,
		    'locationData'=>$locationData
		]);
	}

	//修改状态
	public function status(){
		$data=input('get.');
		//$validate=validate('Bis');
		//if(!$validate->scene('status')->check($data)){
		//	$this->error($validate->getError());
		//}
		$res=$this->obj->save(['status'=>$data['status']],['id'=>$data['id']]);
		$location=model('BisLocation')->save(['status'=>$data['status']],['bis_id'=>$data['id'],'is_main'=>1]);
		$account=model('BisAccount')->save(['status'=>$data['status']],['bis_id'=>$data['id'],'is_main'=>1]);
		if($res && $location && $account){
			//发送邮件
			//status 1 status 2
			$bis=$this->obj->get($data['id']);
			sendemail($data['status'],$bis['email'],$data['id']);
			$this->success('状态更新成功');
		}else{
			$this->error('状态更新失败');
		}
	}
}
