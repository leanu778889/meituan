<?php
class OrderModel extends ViewModel{
	public $table = 'order';
	public $view = array();
	public function getOrderTotal($where){
		return $this->where($where)->count();
	}
	public function getOrder($where,$limit){
		$this->view = array(
			'goods'=>array(
				'type'=>'inner',
				'on'=>'order.goods_id = goods.gid'
			),
		);
		$field = array(
			'orderid',
			'main_title',
			'price',
			'goods_num',
			'status',
			'total_money'
		);
		return $this->where($where)->limit($limit)->select();
	}
	public function delOrder($oid){
		return $this->where(array('orderid'=>$oid))->del();
	}
}
?>