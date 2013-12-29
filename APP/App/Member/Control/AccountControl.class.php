<?php
/**
 * 用户账户管理控制器
 * @author zhengyin
 */
class AccountControl extends CommonControl{
	public $uid;
	public $addressid;
	public function __auto(){
		$this->db = K('user');
		if(!isset($_SESSION[C('RBAC_AUTH_KEY')])){
			go('Member/Login/index');
			exit();
		}else{
			$this->uid = $_SESSION[C('RBAC_AUTH_KEY')];
		}
		$this->addressid = $this->_get('addressid','intval');
	}
	/**
	 * 显示账户余额
	 */
	public function index(){
		$balance = $this->db->getBalance($this->uid);
		$this->assign('balance',$balance);
		$this->display();
	}
/*
	充值
*/
	public function addBalance(){
		$data = $this->db->addBalance($this->uid);
		if($data){
			$this->success('充值成功',U('Member/Account/index'));
		}else{
			$this->error('充值失败',U('Member/Account/index'));
		}
	}
	/**
	 * 用户账户设置
	 */
	public function setting(){
		$this->display();
	}
	/**
	 * 设置收货地址
	 */
	public function setAddress(){
		$data = $this->db->getAddress($this->uid);
		$this->assign('address',$data);
		$this->display();
	}
/*
	删除收货地址
*/
	public function delAddress(){
		if($this->db->delAddress($this->addressid)){
			$this->success('删除成功','setAddress');
		}else{
			$this->error('删除失败','setAddress');
		}
	}
/*
	添加收货地址
*/
	public function addAddress(){
		$data = $this->disAddressData();
		if($this->db->addAddress($data)){
			$this->success('添加地址成功','setAddress');
		}else{
			$this->error('添加地址失败','setAddress');
		}
	}
/*
	处理添加地址数据
*/
	private function disAddressData(){
		$data = array();
		$data['province'] = $_POST['s_province'];
		$data['city'] = $_POST['s_city'];
		$data['county'] = $_POST['s_county'];
		$data['street'] = $this->_post('street','strip_tags');
		$data['postcode'] = $this->_post('postcode','intval');
		$data['consignee'] = $this->_post('consignee','strip_tags');
		$data['tel'] = $this->_post('tel','strip_tags');
		$data['user_id'] = $this->uid;
		return $data;
	}
}
?>