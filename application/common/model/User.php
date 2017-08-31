<?php
namespace app\common\model;

use Symfony\Component\DomCrawler\Field\InputFormField;
use think\Model;

class User extends BaseModel
{


	protected $autoWriteTimestamp = true;//时间戳自动添加

	/**
	 * 通过状态获取商家数据
	 * @param $status
	 */
	public function add($data=[]){
		if(!is_array($data)){
			exception('传递的数据不是数组');//抛出异常用try接收
		}
		$data['status']=1;
		return $this->allowField(true)->save($data);//保存
	}

	/**
	 * 根据用户名获取用户信息
	 * @param $username
	 */
	public function getUserByUsername($username){
		if(!$username){
			exception('用户名不合法');
		}
		$data=['username'=>$username];
		return $this->where($data)->find();
	}
}