<?php
class CommonControl extends Control{
	protected $db;
	public function __init(){
		if(!isset($_SESSION['RBAC_SUPER_ADMIN'])){
			go('Admin/Login/index');
			exit();
		}
		if(method_exists($this, '__auto')){
			$this->__auto();
		}
	}
}
?>