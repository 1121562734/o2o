<?php
namespace app\admin\validate;

use think\Validate;

class Bis extends Validate
{
  protected $rule =[

	  ['id','number|require'],
	  ['status','number|in:-1,0,1','状态必须是数字|状态范围不合法'],

  ];

  /**场景设置**/
  protected $scene=[
  	'add'=>['name','parent_id','id'],//添加 没有是不会走某个值的
    'listorder'=> ['id','listorder'],//排序
    'status'=> ['id','status'],//状态
  ];
}
