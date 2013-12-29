<?php
class RegControl extends CommonControl{
	public function __auto(){
		$this->db = K('user');
	}
/**
 * 显示注册界面
 */
	public function index(){
		$this->display();
	}
/*
	添加用户
*/
	public function addUser(){
		if(IS_POST === false) throw new Exception('非法请求');
		$data=array();
		$data['email'] = $this->_post('email');
		$data['uname'] = $this->_post('uname');
		$data['password'] = md5($this->_post('password'));
		$uid = $this->db->addUser($data);
		if($uid){
			$_SESSION[C('RBAC_AUTH_KEY')] = $uid;
			setcookie(session_name(),session_id(),time()+C('COOKIE_LIFT_TIME'),'/');
			$this->success('注册成功',U('Index/Index/index'));
		}else{
			$this->error('注册失败',U('Index/Index/index'));
		}
	}
/*
	表单验证
*/
	public function check(){
		if(IS_AJAX === false) throw new Exception("非法请求");
		$key = key($_POST);
		$value = $this->_post($key);
		if($key == 'code'){
			if($_SESSION['code'] != strtoupper($value)){
				$result=array('status'=>false,'msg'=>'验证码错误');
			}else{
				$result=array('status'=>true);
			}
		}else{
			if($this->db->check($key,$value)){
				$result=array('status'=>false,'msg'=>$value.'已存在');
			}else{
				$result=array('status'=>true);
			}
		}
		exit(json_encode($result));
	}
/*
	展示验证码
*/
	public function showCode(){
		$code = new Code();
		$code->Show();
	}









}















?>