<?php
class GoodsModel extends ViewModel{
	public $table='goods';
	public $cids = array();
	public $lids = array();
	public $price = '';
	public $order = '';
	public $keywords = null;
/*
	关联多表
*/
	public $view = array(
		'category'=>array(
			'type'=>'inner',
			'on' => 'category.cid=goods.cid'
		),
		'locality'=>array(
			'type'=>'inner',
			'on' => 'locality.lid=goods.lid'
		),
		'shop'=>array(
			'type'=>'inner',
			'on' => 'shop.shopid=goods.shopid'
		)
	);
	//统计筛选商品的总数
	public function getGoodsTotal(){
		$count = '';
		if(is_null($this->keywords)){
			$where = rtrim('end_time>'.time().' and '.$this->price,' and ');
		}else{
			$where = 'sub_title like "%'.$this->keywords.'%"';
		}
		if(!empty($this->cids) && !empty($this->lids)){
			$count = $this->where($where)->in($this->cids)->in($this->lids)->count();
		}else{
			if(!empty($this->cids)){
				$count = $this->where($where)->in($this->cids)->count();
			}
			if(!empty($this->lids)){
				$count = $this->where($where)->in($this->lids)->count();
			}
		}
		if(empty($this->cids) && empty($this->lids)){
			$count = $this->where($where)->count();
		}
		return $count;
	}
	//筛选商品
	public function getGoods($limit){
		$result = '';
		$fields = array(
			'goods.gid',
			'goods.main_title',
			'goods.sub_title',
			'goods.price',
			'goods.old_price',
			'goods.buy',
			'goods.goods_img',
		);
		if(is_null($this->keywords)){
			$where = rtrim('end_time>'.time().' and '.$this->price,' and ');
		}else{
			$where = 'sub_title like "%'.$this->keywords.'%"';
		}
		if(!empty($this->cids) && !empty($this->lids)){
			$result = $this->field($fields)->where($where)->in($this->cids)->in($this->lids)->order($this->order)->limit($limit)->select();
		}else{
			if(!empty($this->cids)){
				$result = $this->field($fields)->where($where)->in($this->cids)->order($this->order)->limit($limit)->select();
			}
			if(!empty($this->lids)){
				$result = $this->field($fields)->where($where)->in($this->lids)->order($this->order)->limit($limit)->select();
			}
		}
		if(empty($this->cids) && empty($this->lids)){
			$result = $this->field($fields)->where($where)->order($this->order)->limit($limit)->select();
		}
		return $result;
	}
/*
	显示商品单页
*/
	public function getGoodsDetail($gid){
		$this->view['goods_detail'] = array(
			'type'=>'inner',
			'on' => 'goods_detail.goods_id=goods.gid'
		);
		return $this->where(array('gid'=>$gid))->find();
	}
/*
	获得热卖商品
*/
	public function getHotGoods(){
		$field =array(
			'main_title',
			'price',
			'buy',
			'goods_img',
			'gid',
		);
		return $this->field($field)->order('buy desc')->limit(5)->select();
	}
/*
	获得热门分类
*/
	public function getHotCategory(){
		$field = array('goods.cid','cname');
		return $this->field($field)->group('goods.cid')->order('buy desc')->limit(8)->select();
	}
/*
	获得相关商品
*/
	public function getRelatedGoods($cid){
		unset($this->view['goods_detail']);
		$field =array(
			'main_title',
			'price',
			'old_price',
			'buy',
			'goods_img',
			'gid',
		);
		return $this->field($field)->where(array('cid'=>$cid))->order('buy desc')->limit(5)->select();
	}
}
?>