<?php
class CommonControl extends Control{
	protected $db;
	protected $url;
	protected $cid;
	public function __init(){
		if(strlen(U('Index/Index/index'))>strlen(__URL__)){
			$this->url = U('Index/Index/index');
		}else{
			$this->url =url_param_remove('keywords',__URL__);
		}
		$this->cid = $this->_get('cid','intval',null);
		if(method_exists($this, '__auto')){
			$this->__auto();
		}
		$this->setNav();
		$this->assign('isLogin',isset($_SESSION[C('RBAC_AUTH_KEY')]));
	}
	/*public function setNav(){
		$db = K('Category');
		$nav = $db->getCategoryLevel(0);
		$this->assign('nav',$nav);
	}*/
	public function setNav(){
		$this->url = U('Index/Index/index');
		$url = url_param_remove('cid',$this->url);
		$db = K('category');
		//没有传cid的情况
    	if(is_null($this->cid)){
    		$topCategory = $db->getCategoryLevel(0);
    		$tmpArr=array();
    		$tmpArr[]='<a class="active" href="'.$url.'">首页</a>';
    		foreach($topCategory as $v){
    			$tmpArr[] = '<a href="'.$url.'/cid/'.$v["cid"].'">'.$v["cname"].'</a>';
    		}
    		$this->assign('topNav',$tmpArr);
    		return ;
    	}
    	//传了cid的情况，父类处理
		$pid = $db->getCategoryPid($this->cid);
    	$topCategory = $db->getCategoryLevel(0);
    	$tmpArr=array();
    	$tmpArr[]='<a href="'.$url.'">首页</a>';
    	foreach($topCategory as $v){
    		if($pid == $v['cid'] || $this->cid ==$v['cid']){
    			$tmpArr[] = '<a class="active" href="'.$url.'/cid/'.$v["cid"].'">'.$v["cname"].'</a>';
    		}else{
    			$tmpArr[] = '<a href="'.$url.'/cid/'.$v["cid"].'">'.$v["cname"].'</a>';
    		}
    	}
    	$this->assign('topNav',$tmpArr);
	}
}
?>