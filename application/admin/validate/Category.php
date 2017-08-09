<?php
namespace app\admin\validate;

use think\Validate;

class Category extends Validate
{
  protected $rule =[
	  ['name','require|max:10','分类名必须传递|分类名不能超过10个字符'],//不能为空 长度不能超过10
      ['parent_id','number'],
	  ['id','number'],
	  ['status','number|in:-1,0,1','状态必须是数字|状态范围不合法'],
      ['listorder','number'],
  ];

  /**场景设置**/
  protected $scene=[
  	'add'=>['name','parent_id','id'],//添加 没有是不会走某个值的
    'listorder'=> ['id','listorder'],//排序
    'status'=> ['id','status'],//状态
  ];
}
