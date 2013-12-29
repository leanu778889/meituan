<?php
class CartControl extends CommonControl{
	private $uid=null;
	private $gid;
	public function __auto(){
		$this->gid = $this->_get('gid','intval');
		$this->db = K('Cart');
		if(isset($_SESSION[C('RBAC_AUTH_KEY')])){
			$this->uid = $_SESSION[C('RBAC_AUTH_KEY')];
			$this->writeCart();
		}
	}
	/**
	 * 显示购物车页
	 */
	public function index(){
		$data = $this->getCartData();
		$goods = $this->disCartData($data);
		if(IS_AJAX === false){
			$db = K('user');
			$address = $db->getAddress($this->uid);
			$this->assign('address',$address);
			$this->assign('goods',$goods[0]);
			$this->assign('total',$goods[1]);
			$this->display();
		}else{
			exit(json_encode(array('status'=>true,'data'=>$goods[0])));
		}

	}
/*
	获取购物车的数据
*/
	private function getCartData(){
		$result = array();
		if(is_null($this->uid)){
			if(!isset($_SESSION['cart']['goods'])) return;
			$cart = $_SESSION['cart']['goods'];
			foreach($cart as $k=>$v){
				$data=	$this->db->getGoods(array('gid'=>$k));
				$data['goods_num'] = $v['num'];
				$result[] = $data;
			}
		}else{
			$where = array(
				'user_id'=>$this->uid,
			);
			$result = $this->db->getCart($where);
		}
		return $result;
	}
/*
	处理商品数据
*/
	private function disCartData($data){
		if(!is_array($data)) return;
		$total = 0;
		foreach($data as $k=>$v){
			$data[$k]['xiaoji'] = $v['goods_num']*$v['price'];
			$data[$k]['status'] = $v['end_time']<time()?'已下架':'可购买';
			$pathinfo =pathinfo($v['goods_img']);
        	$data[$k]['goods_img']=__ROOT__.'/'.$pathinfo['dirname'].'/'.$pathinfo['filename'].'_92x54.'.$pathinfo['extension'];
			$total +=$data[$k]['xiaoji'];
		}
		return array($data,$total);
	}
/*
	处理购物车商品数量的更改
*/
	public function updateGoodsNum(){
		if(IS_AJAX === false) return false;
		$gid = $this->_post('gid','intval');
		$num = $this->_post('num','intval');
		$result = array();
		if(is_null($this->uid)){
			foreach($_SESSION['cart']['goods'] as $k=>$v){
				if($k == $gid){
					$_SESSION['cart']['goods'][$k]['num'] = $num;
					$result = array(
						'status'=>true,
						'num'=>$num
					);
				}
			}
		}else{
			$where = array(
				'goods_id'=>$gid,
				'user_id'=>$this->uid
			);
			if($this->db->updateCartNum($where,$num)){
				$result = array(
					'status'=>true,
					'num'=>$num
				);
			}
		}
		exit(json_encode($result));
	}
/*
	删除购物车
*/
	public function delCart(){
		if(IS_AJAX ===false) exit;
		$result =  array();
		$result['status'] = false;
		if(is_null($this->uid)){
			foreach($_SESSION['cart']['goods'] as $k=>$v){
				if($k == $this->gid){
					unset($_SESSION['cart']['goods'][$k]);
					$result['status'] = true;
				}
				continue;
			}
		}else{
			$where = array(
				'user_id'=>$this->uid,
				'goods_id'=>$this->gid
			);
			if($this->db->delCart($where)){
				$result['status'] = true;
			}
		}
		exit(json_encode($result));
	}
/*
	添加到购物车
*/
	public function add(){
		if(IS_AJAX === false) throw new Exception('非法请求');
		$result= array();
		if(is_null($this->uid)){
			if(isset($_SESSION['cart']['goods'])&&array_key_exists($this->gid, $_SESSION['cart']['goods'])){
				$_SESSION['cart']['goods'][$this->gid]['num'] = $_SESSION['cart']['goods'][$this->gid]['num']+1;
			}else{
				$_SESSION['cart']['goods'][$this->gid]=array('num'=>1);
			}
			$_SESSION['cart']['total'] = count($_SESSION['cart']['goods']);
			$result = array('status'=>true,'total'=>$_SESSION['cart']['total']);
		}else{
			$data = array();
			$data['user_id'] = $this->uid;
			$data['goods_id'] = $this->gid;
			$data['goods_num'] = 1;
			$total = $this->checkAdd($data);
			if($total){
				$result = array('status'=>true,'total'=>$total);
			}
		}
		exit(json_encode($result));
	}
/*
	把session中的值插入数据库
*/
	private function writeCart(){
		if(!isset($_SESSION['cart']['goods'])) return;
		$carts = $_SESSION['cart']['goods'];
		foreach($carts as $k=>$v){
			$data = array();
			$data['user_id'] = $this->uid;
			$data['goods_id'] = $k;
			$data['goods_num'] =$v['num'];
			$this->checkAdd($data);
			}
		unset($_SESSION['cart']);
	}
/*
	验证添加
	存在goods_num自增
	不存在 就添加
*/
	private function checkAdd($data){
		$where = array('user_id'=>$data['user_id'],'goods_id'=>$data['goods_id']);
		//查询  购物车中是否存在一样的信息
		$count = $this->db->checkCart($where);
		if($count){
			return $this->db->incCart($where,$data);
		}else{
			return $this->db->addCart($data);
		}
	}
}
?>