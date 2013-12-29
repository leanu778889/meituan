<?php
class LocalityModel extends Model{
	public $table = 'locality';
/*
	获取所有地区信息
*/
	public function getLocalityALL(){
		return $this->select();
	}
/*
	添加地区
*/
	public function addLocality($data){
		return $this->add($data);
	}
/*
	获取单条地区的详细信息
*/
	public function findLocality($lid){
		return $this->where(array('lid'=>$lid))->find();
	}
/*
	修改地区
*/
	public function editLocality($data,$lid){
		$this->where(array('lid'=>$lid))->save($data);
		return $this->getAffectedRows();
	}
/*
	查找子地区
*/
	public function findSonLocality($lid){
		return $this->where(array('pid'=>$lid))->count();
	}
/*
	删除地区
*/
	public function delLocality($lid){
		return $this->where(array('lid'=>$lid))->del();
	}
}
?>