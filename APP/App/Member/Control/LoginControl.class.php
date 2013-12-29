<?php
class LoginControl extends CommonControl{
	public function __auto(){
		$this->db = K('user');
	}
	/**
	 * 显示登录界面
	 */
	public function index(){

		$this->display();
	}
/*
	登陆
*/
	public function login(){
		if(IS_POST ===false) throw new Exception("非法请求");
		$uname = $this->_post('uname');
		$password = $this->_post('password','md5');
		$where = array('uname'=>$uname,'or','email'=>$uname);
		$userinfo = $this->db->getUser($where);
		if(isset($userinfo)){
			if($userinfo['password'] == $password){
				$_SESSION[C('RBAC_AUTH_KEY')] = $userinfo['uid'];
				//下次自动登陆  保存时间为C('COOKIE_LIFT_TIME')
				if(isset($_POST['auto_login'])){
					setcookie(session_name(),session_id(),time()+C('COOKIE_LIFT_TIME'),'/');
				}
				$this->success('登陆成功',U('Index/Index/index'));
			}else{
				$this->error('密码错误',U('Member/Login/index'));
			}
		}else{
			$this->error('用户名不存在',U('Member/Login/index'));
		}
	}
/*
	退出   清楚cookie 和session
*/
	public function quit(){
		setcookie(session_name(),session_id(),1,'/');
		session_unset();
		session_destroy();
		$this->success('退出成功',U('Index/Index/index'));
	}




}














?>