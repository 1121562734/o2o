<?php
namespace app\api\controller;

use think\Controller;
use think\Request;
use think\File;
class Image extends Controller
{

	//上传图片
 public function upload(){
		$file =Request::instance()->file('file');
		//给一个指定的目录
	    $info = $file->move('upload');
	    print_r($info);
	    if($info && $info->getPathname()){
	    	return show(1,'success','/'.$info->getPathname());
	    }
	 return show(0,'error');

 }
}