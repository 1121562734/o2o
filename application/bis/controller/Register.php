<?php
namespace app\bis\controller;

use think\Controller;

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
}