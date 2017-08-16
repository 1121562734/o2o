<?php
namespace app\api\controller;

use think\Controller;

class Category extends Controller
{
	private $obj;
	public function _initialize(){
		$this->obj=model('Category');
	}
    public function getCategoryByParentId()
    {
    	$id =input('post.id',0,'intval');
    	if(!$id){
    		$this->error('id不合法');
	    }
	    //通过id获取二级分类
	    $category=$this->obj->getNormalCategoryByParentId($id);//函数是model下面的Category模型
		if(!$category){
			return show(0,'error');
		}
	    return show(1,'success',$category);
    }
}
