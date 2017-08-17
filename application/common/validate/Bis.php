<?php
namespace app\common\validate;

use think\Validate;

class Bis extends Validate
{
  protected $rule =[
	  'name'=>'require|max:25',//不能为空 长度不能超过25
      'email'=>'email', //邮箱
	 // 'logo'=>'require',//缩略图
	  //'licence_logo'=>'require',//营业执照
      'bank_info'=>'require', //银行卡账号
	  'bank_name'=>'require', //开户行名称
	  'bank_user'=>'require', //开户行姓名
	  'faren'=>'require', //法人
	  'faren_tel'=>'require', //法人电话


  ];

  /**场景设置**/
  protected $scene=[
  	'add'=>['name','email','logo','bank_info','bank_name', 'bank_user','faren', 'faren_tel'],//添加 没有是不会走某个值的
  ];
}
