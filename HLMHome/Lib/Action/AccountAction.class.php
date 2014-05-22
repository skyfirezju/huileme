<?php
/**
 *  账户相关Action
 *  @author xiefei
 *  update: 2014-05-04
**/
class AccountAction extends Action {

	public function _empty(){
		$this->display("Public:404");
	}

	// 显示登录页面
	public function login(){
		$this->display("login");
	}

	// 登录检测
	public function checkLogin() {
		$account = I('param.account');
		$password = I('param.password');
		$rememberme = I('param.rememberme');
		if(empty($account)) {
			$this->error('账号错误!');
		} else if(empty($password)) {
			$this->error('密码为空!');
		}
		$user = M('User');
		$map['email'] = $account;
		$result = $user->where($map)->find();
		if($result === false){
			$this->ajaxReturn('', '查询数据库出错!', 0);
		}
		elseif($result === null){
			$this->ajaxReturn('', '帐号错误!', 0);
		}
		elseif($result['status'] == 0){
			$this->ajaxReturn('', '帐号未激活!', 0);
		}
		elseif($result['pwd'] != md5($password)){
			$this->ajaxReturn('', '密码错误!', 0);
		}
		else{
			//将用户ID存入session
			if($rememberme){
				cookie('account',$result['email'],864000);
				cookie('password',$result['pwd'],864000);
			}
			session('rememberme', $rememberme);
			session('userId',$result['id']);
			session('account',$result['email']);
			session('userName',$result['name']);
			session('icon',$result['icon']);
			$this->ajaxReturn('', '', 1);
		}
	}

	// 登出
	public function logout()
    {
		$id = session('userId');
        if(isset($id)) {
			unset($_SESSION);
			session(null);
			session_destroy();
			cookie('account',null);
			cookie('password',null);
			$this -> redirect('/index');
        }
    }

    // 显示注册页面
    public function register(){
    	$this->display("register");
    }

    // 生成验证码
    public function verifycode(){
    	import('ORG.Util.Image');
	    Image::buildImageVerify();
    }

    // 显示开始修改密码页面
    public function startChangePassword(){
		$this->display('startchangepassword');
	}

	public function checkRegister() {
		$account = I('param.account');
		$pwd = I('param.password');
		$verify = I('param.verify');
		//二次验证
		if(session('verify') != md5($verify)) {
			$this->ajaxReturn('', '验证码错误！', 0);
		}	
		$User = M('User');
		$getUser =  $User->where(array('email' => $account))->find();
		if($getUser) {

		} else {
			$data['email'] = $account;
			$data['pwd'] = md5($pwd);
			$data['active_code'] = createKey(32);
			$activeCode = $data['active_code'];
			$result = $User->add($data);
			$body = "请点击此<a href='http://localhost/huileme/account/active_user/$result/$activeCode' target='_blank'>链接</a>来激活用户";

			$info = think_send_mail($account, 'user', '激活账户', $body);
			if($info === true) {
				$this->ajaxReturn($info, '', 1);
			} else {
				$this->ajaxReturn($info, '注册失败', 0);
			}
		}
	}

	//检查验证码是否正确
	public function checkVerify(){
		$verify = I('param.verify');
		if(session('verify') != md5($verify)) {
			$this->ajaxReturn('', '验证码错误！', 0);
		}else{
			$this->ajaxReturn('', '', 1);
		}
	}

	public function startActiveUser(){
    	$userAccount = session('account');
    	$this->assign('account', $userAccount);
    	$this->display('startactive');
    }

     public function activeUser(){
		$id = I('param.id');
		$code = I('param.code');
		$User = M('User');
		$map['id'] = $id ;
		$result = $User->field('active_code')->where($map)->find();
		if($result === false){
			$this->error('激活时查询数据库出错！');
		}
		elseif($result === null){
			$this->error('激活时用户不存在！');
		}
		elseif($result['active_code'] == $code){
			$result = $User->find($id);
			session('userId',$id);
			session('account',$result['account']);
			session('userName',$result['name']);
			$data['id'] = $id;
			$data['status'] = 1;
			$User->save($data);			
			//$this->redirect('User/profile', array('id' => $id));
			$this->assign('name', $result['name']);
			$this->assign('id', $id);
			$this->display('finishactive');
		}
		else{
			$this->error('激活码不正确！');
		}
	}
}