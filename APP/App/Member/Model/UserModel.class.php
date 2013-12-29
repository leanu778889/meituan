<?php
class UserModel extends ViewModel{
	public $table = 'user';
	public $view =array();
/*
	检测用户名  邮箱是否存在
*/
	public function check($field,$value){
		return $this->where(array($field=>$value))->count();
	}
/*
	添加用户
*/
	public function addUser($data){
		$uid = $this->add($data);
		$data = array('user_id'=>$uid);
		$this->table('userinfo')->add($data);
		return $uid;
	}
/*
	获得一个用户的详细信息
*/
	public function getUser($where){
		return $this->where($where)->find();
	}
/*
	充值
*/
	public function addBalance($uid){
		return $this->table('userinfo')->inc("balance","user_id=".$uid."",1000);
	}
/*
	获得账户余额
*/
	public function getBalance($uid){
		$result = $this->table('userinfo')->where(array('user_id'=>$uid))->find();
		return $result['balance'];
	}
/*
	修改余额
*/
	public function updateBalance($uid,$num){
		$this->table('userinfo')->dec('balance','user_id='.$uid,$num);
	}
/*
	添加收货地址
*/
	public function addAddress($data){
		return $this->table('user_address')->add($data);
	}
/*
	获取收货地址
*/
	public function getAddress($uid){
		return $this->table('user_address')->where(array('user_id'=>$uid))->select();
	}
/*
	删除收货地址
*/
	public function delAddress($addressid){
		return $this->table('user_address')->where(array('addressid'=>$addressid))->del();
	}
/*
	检查收藏是否存在
*/
	public function checkCollect($where){
		return $this->table('collect')->where($where)->count();
	}
/*
	添加收藏
*/
	public function addCollect($data){
		return $this->table('collect')->add($data);
	}
/*
	获取收藏的详细信息
*/
	public function getCollect($where){
		$this->view = array(
			'collect'=>array(
				'type'=>'inner',
				'on'=>'user.uid = collect.user_id'
			),
			'goods'=>array(
				'type'=>'inner',
				'on'=>'goods.gid = collect.goods_id'
			)
		);
		$field = array(
			'main_title',
			'goods_img',
			'price',
			'end_time',
			'gid',

		);
		return $this->field($field)->where($where)->select();
	}
/*
	删除收藏
*/
	public function delCollect($where){
		return $this->table('collect')->where($where)->del();
	}
}
?>