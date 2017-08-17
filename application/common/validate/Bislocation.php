<?php
namespace app\common\validate;

use think\Validate;

class Bislocation extends Validate
{
  protected $rule =[
	  'tel'=> 'require|tel|unique:bis_location',
	  'contact'=>'require|max:25',//不能为空 长度不能超过25
      'category_id'=>'require', //所属分类
	  'api_address'=>'require',//地址
  ];
	//反馈的消息
    protected $message = [
	    'tel.require'  => '电话号码必须',
	    'tel.tel'  => '电话号码格式错误',
	    'tel.unique'  => '电话号码已经存在',
	    'contact.require'  =>'联系人不能为空',
	    'contact.max' =>'联系人长度不能超过25',
    ];
	//正则表达式
	protected $regex = [
		'tel'    => '^(0\\d{2}-\\d{8}(-\\d{1,4})?)|(0\\d{3}-\\d{7,8}(-\\d{1,4})?)$', //这里的tel是验证后面的tel
	];

  /**场景设置**/
  protected $scene=[
  	'add'=>['tel','contact','category_id','address'],//添加 没有是不会走某个值的
  ];
}
