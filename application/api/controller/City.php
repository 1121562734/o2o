<?php
namespace app\api\controller;

use think\Controller;

class City extends Controller
{
	private $obj;
	public function _initialize(){
		$this->obj=model('City');
	}
    public function getCitysByParentId()
    {
    	$id =input('post.id',0,'intval');
    	if(!$id){
    		$this->error('id不合法');
	    }
	    //通过id获取二级城市

	    $citys=$this->obj->getNormalCitysByParentId($id);//函数是model下面的city模型
		if(!$citys){
			return show(0,'error');
		}
	    return show(1,'success',$citys);
    }
}
