<?php
class CartModel extends ViewModel{
	public $view = array();
/*
	添加购物车
*/
	public function addCart($data){
		$this->add($data);
		return $this->where(array('user_id'=>$data['user_id']))->count();
	}
/*
	验证购物车中信息是否存在
*/
	public function checkCart($where){
		return $this->where($where)->count();
	}
/*
	购物车中goods_num自增
*/
	public function incCart($where,$data){
		$this->inc('goods_num',$where,$data['goods_num']);
		return $this->where(array('user_id'=>$data['user_id']))->count();
	}
/*
	购物车中商品信息
*/
	public function getGoods($where){
		$field = array(
			'gid',
			'main_title',
			'end_time',
			'price',
			'goods_img'
		);
		return $this->table('goods')->field($field)->where($where)->find();
	}
/*
	更新购物车中的商品数量
*/
	public function updateCartNum($where,$num){
		$this->where($where)->save(array('goods_num'=>$num));
		return $this->getAffectedRows();
	}
/*
	获取购物车中信息
*/
	public function getCart($where){
		$this->view = array(
			'goods'=>array(
				'type'=>'inner',
				'on'=>'goods.gid = cart.goods_id'
			),
		);
		$field = array(
			'gid',
			'main_title',
			'end_time',
			'price',
			'goods_img',
			'goods_num'
		);
		return $this->field($field)->where($where)->select();
	}
/*
	删除购物车
*/
	public function delCart($where){
		return $this->where($where)->del();
	}
}
?>