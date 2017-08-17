<?php
namespace app\bis\controller;

use think\Controller;
use think\Model;

class Register extends Controller
{
	public function index(){
		//获取一级城市的数据
		$citys = model('city')->getNormalCitysByParentId();
		//获取分类栏目的数据
		$categorys=model('category')->getNormalCategoryByParentId();
		return $this->fetch('',[
			'citys'=>$citys,
			'categorys'=>$categorys
		]);
	}
	
	public function add(){
		if(!request()->isPost()){
			$this->error('请求错误');
		}
		//获取值
		$data=input('post.');
		//校验数据
		$validate=validate('Bis');//获取校验文件
		if(!$validate->scene('add')->check($data)){
			$this->error($validate->getError());
		}

		//总店的相关信息校验
		$validate =validate('Bislocation');
		if(!$validate->scene('add')->check($data)){
			$this->error($validate->getError());
		}
		//账户的相关信息校验
		$validate =validate('BisAccount');
		if(!$validate->scene('add')->check($data)){
			$this->error($validate->getError());
		}
		//标注 获取经纬度
		$lnglat=\Map::getLngLat($data['address']);

		if(empty($lnglat) || $lnglat['status'] != 0 || $lnglat['result']['precise'] != 1){
			$this->error('地址信息错误');
		}

		//商户信息入库
		$bisData= [
			'name'=>$data['name'],
		    'city_id'=>$data['city_id'],
		    'city_path'=>empty($data['se_city_id']) ? $data['city_id']:$data['city_id'].','.$data['se_city_id'],
			'logo'=>$data['logo'],
			'licence_logo'=>$data['licence_logo'],
			'description'=>empty($data['description'])?'':$data['description'],
			'bank_info'=>$data['bank_info'],
			'bank_name'=>$data['bank_name'],
			'bank_user'=>$data['bank_user'],
			'faren'=>$data['faren'],
			'faren_tel'=>$data['faren_tel'],
			'email'=>$data['email'],
		];
		$bisId=model('Bis')->add($bisData);

		if(!empty($data['se_category_id'])){
			$data['cat']=implode('|',$data['se_category_id']);
		}
		//总店信息入库
		$locationData= [
			'bis_id'=>$bisId,
			'tel'=>$data['name'],
		    'contact'=>$data['contact'],
			'category_id'=>$data['category_id'],
			'category_path'=>empty($data['cat'])?'':$data['category_id'].','.$data['cat'],
			'city_id'=>$data['city_id'],
			'city_path'=>empty($data['se_city_id']) ? $data['city_id']:$data['city_id'].','.$data['se_city_id'],
			'api_address'=>$data['address'],
			'open_time'=>$data['open_time'],
			'content'=>empty($data['content'])?'':$data['content'],
			'is_main'=>1,
		    'xpoint'=>empty($lnglat['result']['location']['lng']) ? '' : $lnglat['result']['location']['lng'],
			'ypoint'=>empty($lnglat['result']['location']['lat']) ? '' : $lnglat['result']['location']['lat'],

		];
		$LocationId=Model('BisLocation')->add($locationData);
		$data['code']=mt_rand(1000,9999);
		//账号相关信息
		$accounData = [
			'bis_id'=>$bisId,
			'username'=> $data['username'],
			'code'=>$data['code'],
			'password' =>md5($data['password'].$data['code']),
			'is_main'=>1,
		];
		$acconutId=model('BisAccount')->add($accounData);
		if(!$acconutId){
			$this->error('申请失败');
		}
		//发送邮件
		$url=request()->domain().url('bis/register/waiting',['id'=>$bisId]);//全局链接
		$title="o2o入住申请通知";
		$content="您提交的入驻申请需等待平台方审核,您可以通过点击链接<a href='".$url."' target='_blank'>查看链接</a>查看审核状态";
		\phpmailer\Email::send($data['email'], $title, $content);
		$this->success('申请成功',url('register/waiting',['id'=>$bisId]));

	}
	
	public function waiting($id){
		if(empty($id)){
			$this->error('参数错误');
		}
		$detail=model('Bis')->get($id);
		return $this->fetch('',
			[
				'detail'=>$detail,
				]
		);
	}
}