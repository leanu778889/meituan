<?php
class BuyControl extends CommonControl{
	public $uid;
	public $gid;
	public function __auto(){
		if(!isset($_SESSION[C('RBAC_AUTH_KEY')])){
			go('Member/Login/index');
			exit();
		}else{
			$this->uid = $_SESSION[C('RBAC_AUTH_KEY')];
		}
		$this->gid = $this->_get('gid','intval');
	}
	/**
	 * 订单提交页
	 */
	public function index(){
		$db = K('user');
		$address = $db->getAddress($this->uid);
		$db = K('goods');
		$data = $db->getGoodsFind($this->gid);
		$goods = $this->disGoodsData($data);
		$this->assign('goods',$goods);
		$this->assign('address',$address);
		$this->display();
	}
/*
	处理商品数据
*/
	private function disGoodsData($data){
		if(!is_array($data)) return false;
			$pathinfo =pathinfo($data['goods_img']);
        	$data['goods_img']=__ROOT__.'/'.$pathinfo['dirname'].'/'.$pathinfo['filename'].'_92x54.'.$pathinfo['extension'];
		return $data;
	}
	/**
	 * 付款页
	 */
	public function payment(){
		if(IS_POST === true){
			if(!isset($_POST['addressid'])){
				$_COOKIE['userHomeNav'] = 4;
				$this->error('请填写收货地址',U('Member/Account/setAddress'));
			}
			//如果从购物车提交订单 就循环添加订单
			if(is_array($_POST['gid'])){
				$data = $_POST;
				foreach($data['gid'] as $k=>$v){
					$_POST['gid'] = $v;
					$_POST['price'] = $data['price'][$k];
					$_POST['goods_num'] = $data['goods_num'][$k];
					$_POST['addressid'] = $data['addressid'];
					if(!$this->addOrder()) throw new Exception('订单提交失败');
			}
			}else{
				//从抢购添加订单 直接添加到数据库
				if(!$this->addOrder()) throw new Exception('订单提交失败');
			}
		}
		//订单显示页  显示模板的数据分配
		$order = $this->getOrderData();
		$this->assign('order',$order);
		$sumArr = array();
		foreach($order as $v){
			$sumArr[] = $v['goods_num']*$v['price'];
		}
		$this->assign('sumPrice',array_sum($sumArr));
		$db = K('user');
		$balance = $db->getBalance($this->uid);
		$this->assign('balance',$balance);
		$this->display();
	}
/*
	获取订单的数据
*/
	private function getOrderData(){
		$db = K('order');
		$oid = $this->_get('oid','intval',null);
		if(is_null($oid)){
			$where = array('user_id'=>$this->uid,'status'=>1);
		}else{
			$where = array('orderid'=>$oid,'status'=>1);
		}
		return $db->getOrderData($where);
	}
/*
	添加订单，并处理数据
*/
	private function addOrder(){
		$data = array();
		$data['user_id'] = $this->uid;
		$data['goods_id'] = $this->_post('gid','intval');
		$data['goods_num'] = $this->_post('goods_num','intval');
		$data['addressid'] = $this->_post('addressid','intval');
		$data['total_money'] = $data['goods_num']*$this->_post('price','intval');
		$db = K('Order');
		$where =array('user_id'=>$data['user_id'],'goods_id'=>$data['goods_id'],'status'=>1);
		//检查订单是否存在 不存在 就添加到数据库
		if(!$db->checkOrder($where)){
			$db->addOrder($data);
		}
		return true;
	}
	/**
	 * 购买成功
	 */
	public function buysuccess($orderIds,$sumPrice){
		$db = K('order');
		if(!$db->updateOrder($orderIds)){
			$this->error('付款失败','Index/Index/index');
		}else{
			//订单提交成功后修改用户余额并删除购物车
			$db = K('user');
			$db->updateBalance($this->uid,$sumPrice);
			$db = K('cart');
			$db->delCart(array('user_id'=>$this->uid,''));
			$this->display('buysuccess');
		}

	}
/*
	检查余额是否大于总额
*/
	public function checkBuy(){
		if(IS_POST === false) exit('非法请求');
		$orderIds = $_POST['orderid'];
		$db = K('order');
		$data = $db->getOrder($orderIds);
		$sumArr = array();
		foreach($data as $v){
			$sumArr[] = $v['goods_num']*$v['price'];
		}
		//获得总额
		$sumPrice = array_sum($sumArr);
		$db = K('user');
		//获得余额
		$balance = $db->getBalance($this->uid);
		if($balance<$sumPrice){
			$this->error('余额不足，请充值！',U('Member/Account/index'));
		}else{
			//余额大于订单总额
			$this->buysuccess($orderIds,$sumPrice);
		}
	}
}













?>