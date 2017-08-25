<?php
namespace app\bis\controller;

use think\Controller;

class Location extends Base
{
		/*
		 * 列表页开发
		 */
    public function index()
    {
      return  $this->fetch();
    }

	public function add()
	{
		if(request()->isPost()){
			//校验数据
			//总店的相关信息校验
			$data=input('post.');
			$validate =validate('Bislocation');
			if(!$validate->scene('add')->check($data)){
				$this->error($validate->getError());
			}
			$bisId=$this->getLoginUser()->bis_id;

			//标注 获取经纬度
			$lnglat=\Map::getLngLat($data['address']);

			if(empty($lnglat) || $lnglat['status'] != 0 || $lnglat['result']['precise'] != 1){
				$this->error('地址信息错误');
			}

			//获取二级栏目的id
			$data['cat']='';
			if(!empty($data['se_category_id'])){
				$data['cat']=implode('|',$data['se_category_id']);
			}
			//总店信息入库
			$locationData= [
				'bis_id'=>$bisId,
				'name'=>$data['name'],
				'tel'=>$data['tel'],
				'logo'=>$data['logo'],
				'contact'=>$data['contact'],
				'category_id'=>$data['category_id'],
				'category_path'=>empty($data['cat'])?'':$data['category_id'].','.$data['cat'],
				'city_id'=>$data['city_id'],
				'city_path'=>empty($data['se_city_id']) ? $data['city_id']:$data['city_id'].','.$data['se_city_id'],
				'api_address'=>$data['address'],
				'open_time'=>$data['open_time'],
				'content'=>empty($data['content'])?'':$data['content'],
				'is_main'=>0,//分店
				'xpoint'=>empty($lnglat['result']['location']['lng']) ? '' : $lnglat['result']['location']['lng'],
				'ypoint'=>empty($lnglat['result']['location']['lat']) ? '' : $lnglat['result']['location']['lat'],

			];
			$LocationId=Model('BisLocation')->add($locationData);
			if($LocationId){
				return $this->success('门店申请成功');
			}else{
				return $this->error('门店申请失败');
			}
		}
		//获取一级城市栏目
		$citys=model('City')->getNormalCitysByParentId();
		//获取分类栏目的数据
		$categorys=model('category')->getNormalCategoryByParentId();
		return  $this->fetch('',[
			'citys'=>$citys,
			'categorys'=>$categorys,
		]);
	}
}
