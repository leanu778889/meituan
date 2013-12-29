<?php
class CategoryModel extends Model{
	public $table = 'category';
/*
	查找所有分类信息
*/
	public function getCategoryAll(){
		return $this->select();
	}
/*
	增加分类
*/
	public function addCategory($data){
		return $this->add($data);
	}
/*
	查找单条分类的详细信息
*/
	public function findCategory($cid){
		return $this->where(array('cid'=>$cid))->find();
	}
/*
	修改分类
*/
	public function editCategory($data,$cid){
		$this->where(array('cid'=>$cid))->save($data);
		return $this->getAffectedRows();
	}
/*
	查找子类
*/
	public function findSonCategory($cid){
		return $this->where(array('pid'=>$cid))->count();
	}
/*
	删除分类
*/
	public function delCategory($cid){
		return $this->where(array('cid'=>$cid))->del();
	}
}
?>