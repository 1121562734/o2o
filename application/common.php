<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
	function status($status){
		if($status==1){
			$str = "<span class='label label-success radius'>正常</span>";
		}elseif($status==0){
			$str = "<span class='label label-danger radius'>待审</span>";
		}else{
			$str = "<span class='label label-danger radius'>删除</span>";
		}
		return $str;
}

	/**
	 * 封装curl类
	 * @param       $url
	 * @param int   $type 0 get 1post
	 * @param array $data
	 */
function doCurl($url,$type=0,$data=[]){
	$ch=Curl_init();//初始化
	//设置选项
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);//输出header偷的  0不需要
	if($type == 1){
		//post
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	}
	//执行并获取内容
	$output=curl_exec($ch);
	//释放curl句柄
	curl_close($ch);
	return $output;
}
//商户入驻申请状态
function bisRegister($status){
	if($status == 1){
		$str= '入驻申请成功';
	}elseif($status == 0){
		$str= '待审核,平台方会发送邮件通知,请关注';
	}elseif($status == 2){
		$str='你提交的条件不符合条件请重新提交';
	}else{
		$str="该申请已被删除";
	}
	return $str;
}