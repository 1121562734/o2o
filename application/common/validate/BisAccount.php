<?php
namespace app\common\validate;

use think\Validate;

class bisAccount extends Validate
{
  protected $rule =[
	  'username'=> 'require|unique:bis_account',//用户
	  'password'=>'require|password',//密码

  ];
	//反馈的消息
    protected $message = [
	    'username.require'  => '用户名不能为空',
	    'username.unique'  => '用户名已经存在,请重新分配',
	    'password.require'  => '密码不能为空',
	    'password.password'  =>'密码格式错误',
    ];
	//正则表达式
	protected $regex = [
		'password'    => '/^[\w]{6,15}$/',
	];

  /**场景设置**/
  protected $scene=[
  	'add'=>['username','password'],//添加 没有是不会走某个值的
  ];
}
