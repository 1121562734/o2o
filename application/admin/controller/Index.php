<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
		return $this->fetch();
    }

	public function welcome()
	{
    \phpmailer\Email::send('1121562734@qq.com', 'test', "wqweq<br /> 12313");

		//\phpmailer\Email::send(1, 1, 1);
		return "发送成功";
		//return "欢迎来到o2o主后台首页";
	}

	public function test()
	{
		\Map::getLngLat('北京昌平沙河地铁');
		exit;
		return $this->fetch();
	}
	public function map()
	{
		return \Map::staticimage('北京昌平沙河地铁');
	}
}
