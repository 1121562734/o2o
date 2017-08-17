<?php

	/**
	 * Class Map 百度地图相关业务封装
	 * 根据地址获取经纬度
	 * 返回数组
	 */
class Map {
	public static function  getLngLat($address){
  //http://api.map.baidu.com/geocoder/v2/?address=北京市海淀区上地十街10号&output=json&ak=E4805d16520de693a3fe707cdc962045&callback=showLocation说
		if(!$address){
			return '';
		}

		$data = [
			'address' => $address,
		    'ak'=> config('map.ak'),
		    'output'=>'json',
		];

		$url= config('map.baidu_map_url').config('map.geocoder').'?'.http_build_query($data);//将数组转换成地址形式;
		//1. file_get_contents($url);
		//2. curl
		$result=doCurl($url);
		if($result){
			return json_decode($result,true);
		}else{
			return [];
		}

}

  public static function staticimage($center){

	  //http://api.map.baidu.com/staticimage/v2?ak=E4805d16520de693a3fe707cdc962045&mcode=666666&center=116.403874,39.914888&width=300&height=200&zoom=11
	  //请将AK替换为您的AK
	  if(!$center){
		  return '';
	  }
		$data = [
		  'ak'=> config('map.ak'),
		  'width'=>config('map.width'),
		  'height'=>config('map.height'),
		  'center'=>$center,//参数可以为经纬度坐标或名称
		  'markers'=>$center,
		];

	  $url= config('map.baidu_map_url').config('map.staticimage').'?'.http_build_query($data);//将数组转换成地址形式;
	  //1. file_get_contents($url);
	  //2. curl

	  $result=doCurl($url);
	  return $result;
  }

}