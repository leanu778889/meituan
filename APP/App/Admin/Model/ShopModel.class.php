<?php
class ShopModel extends Model{
	public $table='shop';
	//添加商铺
	public function addShop($data){
		return $this->add($data);
	}
	//统计商铺数量
	public function getShopCount(){
		return $this->count();
	}
	//获得每页的商铺
	public function getShopLimit($limit){
		return $this->limit($limit)->select();
	}
	//获得单个店铺的详细信息
	public function findShop($shopid){
		return $this->where(array('shopid'=>$shopid))->find();
	}
	//修改店铺信息
	public function editShop($data,$shopid){
		$this->where(array('shopid'=>$shopid))->save($data);
		return $this->getAffectedRows();
	}
	//删除店铺
	public function delShop($shopid){
		return $this->where(array('shopid'=>$shopid))->del();
	}
}
?>