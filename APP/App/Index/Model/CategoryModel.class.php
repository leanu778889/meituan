<?php
class CategoryModel extends Model{
	public $table = 'category';
/*
	按等级来查询分类
*/
	public function getCategoryLevel($pid){
		return $this->field('cid,cname')->where(array('pid'=>$pid,'display'=>1))->order('sort asc')->select();
	}
/*
	获取分类分父ID
*/
	public function getCategoryPid($cid){
		$result = $this->field('pid')->where(array('cid'=>$cid))->find();
		return $result['pid'];
	}
/*
	获取所有的子类
*/
	public function getSonCategory($cid){
		$result = $this->field('cid')->where(array('pid'=>$cid))->select();
		if(is_null($result)){
			$result = array(array('cid'=>$cid));
		}
		return $result;
	}
}
?>