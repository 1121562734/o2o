<?php
namespace app\index\controller;
use think\Controller;

	class User extends Controller
{


	//登录
	public function login(){
		if(request()->isPost()){
			$data=input('post.');
			if(!$data['username']){
				$this->error('用户名不能为空');
			}
			if(!$data['password']){
				$this->error('密码不能为空');
			}
			try{
				$user=model('user')->getUserByUsername($data['username']);
			}catch(\Exception $e){
				$this->error($e->getMessage());
			}
			if(!$user || $user->status!=1){
				$this->error('该用户不存在');
			}
			if(md5($data['password'].$user->code) != $user->password){
				$this->error('密码错误');
			}
			//登录成功
			model('User')->updateById(['last_login_time'=>time(),'last_login_ip'=>$_SERVER["REMOTE_ADDR"]],$user->id);
			//把用户的信息保存session
			session('o2o_user',$user,'o2o');
			$this->success('登录成功',url('index/index'));
		}else{
			$user =session('o2o_user','','o2o');
			if($user && $user->id){
				$this->redirect('index/index');
			}
			return $this->fetch();
		}
	}

	//注册
    public function register()
    {
	    if(request()->isPost()){
	    	$data=input('post.');

		    if(!$data['username']){
			    $this->error('用户名不能为空');
		    }
		    if(!$data['pwd'] || !$data['pwd2']){
			    $this->error('密码不能为空');
		    }
		    if(!$data['email'] || !preg_match('/^\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}$/', $data['email'])){
	    		$this->error('邮箱格式错误或者不存在');
		    }
		    if($data['pwd']!=$data['pwd2']){
			    $this->error('两次密码不一样');
		    }
		    if(!captcha_check($data['code'])){
			    $this->error('验证码不正确');
		    }
		    $user=model('User')->get(array('username'=>$data['username']));
		    if($user){
			    $this->error('用户已存在');
		    }
		    $email=model('User')->get(array('email'=>$data['email']));
		    if($email){
			    $this->error('邮箱已经存在');
		    }
		    $data['code']=mt_rand(1000,9999);
		    $data['password']=md5($data['pwd'].$data['code']);
		    try{
			    $res=model('User')->add($data);

		    }catch(\Exception $e){
				$this->error($e->getMessage());
		    }

		    if($res){
			    $this->success('注册成功',url('user/login'));
		    }else{
			    $this->error('注册失败');
		    }

	    }else{
		    return $this->fetch();
		    //return $this->fetch();
	    }

    }


    public function loginout(){
		session('null','o2o');//清空session的值
	    $this->redirect('user/login');
    }
}
