<?php
namespace app\index\controller;
use think\Controller;

	class Base extends Controller
{
    public function _initialize()
    {
        //城市数据
		model('City')->getNormalCitys();
	    //用户数据
    }
}
