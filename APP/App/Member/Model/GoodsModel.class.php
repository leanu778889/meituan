<?php
class GoodsModel extends Model{
	public $table = 'goods';
	public function getGoods($in){
		$field = array(
			'gid',
			'main_title',
			'end_time',
			'price',
			'old_price',
			'goods_img'
		);
		return $this->field($field)->in(array('gid'=>$in))->select();
	}
	public function getGoodsFind($gid){
		$field = array(
			'gid',
			'main_title',
			'price',
			'goods_img'
		);
		return $this->field($field)->where(array('gid'=>$gid))->find();
	}
}
?>