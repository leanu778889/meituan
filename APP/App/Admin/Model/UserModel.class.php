<?php
class UserModel extends ViewModel{
	public $table = 'user';
	public $view = array();
	public function getUserTotal(){
		return $this->count();
	}
	public function getUser($limit){
		$this->view = array(
			'userinfo'=>array(
				'type'=>'inner',
				'on'=>'userinfo.user_id = user.uid'
			),
		);
		$field = array(
			'user.uid',
			'email',
			'uname',
			'phone',
			'balance'
		);
		return $this->field($field)->limit($limit)->select();
	}
	public function delUser($uid){
		$this->table('cart')->where(array('user_id'=>$uid))->del();
		$this->table('collect')->where(array('user_id'=>$uid))->del();
		$this->table('order')->where(array('user_id'=>$uid))->del();
		$this->table('userinfo')->where(array('user_id'=>$uid))->del();
		$this->table('user_address')->where(array('user_id'=>$uid))->del();
		return $this->where(array('uid'=>$uid))->del();
	}
}
?>