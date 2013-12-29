<?php
class OrderModel extends ViewModel{
	public $table = 'order';
	public $view = array();
/*
	添加订单
*/
	public function addOrder($data){
		return $this->add($data);
	}
/*
	获得用户的所有订单
*/
	public function getOrderData($where){
		$this->view = array(
			'goods'=>array(
				'type'=>'inner',
				'on'=>'goods.gid=order.goods_id'
			)
		);
		$field = array(
			'main_title',
			'price',
			'goods_num',
			'gid',
			'orderid',
			'goods_img',
			'status'
		);
		return $this->field($field)->where($where)->select();
	}
/*
	获得所需订单的总额
*/
	public function getOrder($in){
		$this->view = array(
			'goods'=>array(
				'type'=>'inner',
				'on'=>'goods.gid=order.goods_id'
			)
		);
		return $this->field('goods_num','price')->in(array('orderid'=>$in))->select();
	}
/*
	更新订单状态
*/
	public function updateOrder($in){
		return $this->in(array('orderid'=>$in))->save(array('status'=>2));
	}
/*
	检查订单是否存在
*/
	public function checkOrder($where){
		return $this->where($where)->find();
	}
/*
	删除订单
*/
	public function delOrder($oid){
		return $this->where(array('orderid'=>$oid))->del();
	}
}
?>