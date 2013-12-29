<?php
class LoginControl extends Control{
	public function index(){
		$this->display();
	}
	public function Login(){
		if(IS_POST === false) throw new Exception("非法请求");
		$username = $this->_post('username','addslashes','');
		$password = $this->_post('password','md5');
		$db = M('admin');
		$info = $db->where(array('adminName'=>$username))->find();
		if(!$info['adminPass'] ==$password){
			$this->error('用户名或密码错误！','index');
		}else{
			$_SESSION['RBAC_SUPER_ADMIN'] = $info['adminId'];
			$this->success('登陆成功',U('Admin/Index/index'));
		}

	}
	public function showCode(){
		$code = new Code();
		$code->Show();
	}
	public function checkcode(){
		if(IS_AJAX === false) throw new Exception("非法请求");
		$code = $this->_post('code','addslashes','');
		$result = array('status'=>false);
		if($_SESSION['code'] == strtoupper($code)){
			$result['status'] = true;
		}
		exit(json_encode($result));
	}
}
?>