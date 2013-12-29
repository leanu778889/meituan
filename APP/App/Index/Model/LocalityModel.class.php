<?php
class LocalityModel extends Model{
	public $table = 'locality';
/*
	按等级来查询分类
*/
	public function getLocalityLevel($pid){
		return $this->field('lid,lname')->where(array('pid'=>$pid,'display'=>1))->order('sort asc')->select();
	}
/*
	获取分类分父ID
*/
	public function getLocalityPid($lid){
		$result = $this->field('pid')->where(array('lid'=>$lid))->find();
		return $result['pid'];
	}
/*
	获取所有的子类
*/
	public function getSonLocality($lid){
		$result = $this->field('lid')->where(array('pid'=>$lid))->select();
		if(is_null($result)){
			$result = array(array('lid'=>$lid));
		}
		return $result;
	}
}
?>