<?php
class CommonControl extends Control{
	protected $db;
	public function __init(){
		if(method_exists($this, '__auto')){
			$this->__auto();
		}
		$this->setNav();
		$this->assign('isLogin',isset($_SESSION[C('RBAC_AUTH_KEY')]));
	}
	public function setNav(){
		$url = U('Index/Index/index');
		$db = K('Category');
		$nav = $db->getCategoryLevel(0);
		$tmpArr=array();
    	$tmpArr[]='<a class="active" href="'.$url.'">首页</a>';
    	foreach($nav as $v){
    		$tmpArr[] = '<a href="'.$url.'/cid/'.$v["cid"].'">'.$v["cname"].'</a>';
    	}
    	$this->assign('topNav',$tmpArr);
	}
}
?>