<?php
namespace app\bis\controller;

use think\Controller;

class Login extends Controller
{
	public function index(){
		if(request()->isPost()){
			//登录模式
			$data=input('post.');
			//账户的相关信息校验
			$validate =validate('BisAccount');
			if(!$validate->scene('login')->check($data)){
				$this->error($validate->getError());
			}
			//通过用户进行判断
			$ret=model('BisAccount')->get(['username'=>$data['username']]);
			if(!$ret || $ret->status !=1){
				$this->error('用户不存在或者用户未被审核通过');
			}
			if($ret->password != md5($data['password'].$ret->code)){
				$this->error('密码错误');
			}
			model('BisAccount')->updataById(['last_login_time'=>time()],$ret->id);

			//保存登录信息
			session('bisAccount',$ret,'bis');
			$this->success('登录成功','index/index');
		}else{
			$account = session('bisAccount','','bis');
			if($account && $account->id){
				return $this->redirect(url('index/index'));
			}
			return $this->fetch();
		}
	}
	
	public function logout(){
		//清除session
		session(null,'bis');
		$this->redirect(url('login/index'));
	}

}