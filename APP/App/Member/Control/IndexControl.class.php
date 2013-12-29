<?php

class IndexControl extends CommonControl{
	public $uid;
	public function __auto(){
		$this->db = K('goods');
		if(!isset($_SESSION[C('RBAC_AUTH_KEY')])){
			go('Member/Login/index');
			exit();
		}else{
			$this->uid = $_SESSION[C('RBAC_AUTH_KEY')];
		}
	}

    /**
     * 用户收藏
     */
    public function collect(){
    	$db = K('user');
    	$status =$this->_get('status','intval',null);
    	if(is_null($status)){
    		$where = array('uid'=>$this->uid);
    	}else{
    		if($status ==1){
    			$where = array('uid'=>$this->uid,'and','end_time >'.time());
    		}else{
    			$where = array('uid'=>$this->uid,'and','end_time <'.time());
    		}
    	}
    	$data = $db->getCollect($where);
    	$collect = $this->disCollect($data);
    	$this->assign('collect',$collect);
    	$this->display();
    }
/*
	处理收藏数据
*/
	private function disCollect($data){
		if(!is_array($data)) return false;
		foreach($data as $k=>$v){
			$pathinfo =pathinfo($v['goods_img']);
        	$data[$k]['goods_img']=__ROOT__.'/'.$pathinfo['dirname'].'/'.$pathinfo['filename'].'_92x54.'.$pathinfo['extension'];
        	$data[$k]['end_time'] = $v['end_time']>time()?'进行中':'已结束';
		}
		return $data;
	}
/*
	删除收藏
*/
	public function delCollect(){
		$where = array(
			'user_id' =>$this->uid,
			'goods_id'=>$this->_get('gid','intval')
		);
		$db = K('user');
		if($db->delCollect($where)){
			$this->success('删除成功','collect');
		}else{
			$this->error('删除失败','collect');
		}
	}
/*
	添加收藏
*/
	public function addCollect(){
		if(IS_AJAX === false) return false;
		$db = K('user');
		$data = array(
			'user_id'=>$this->uid,
			'goods_id'=>$this->_get('gid','intval')
		);
		$result = array();
		if($db->checkCollect($data)){
			$result['status'] = true;
		}else{
			if($db->addCollect($data)){
				$result['status'] = true;
			}else{
				$result['status'] = false;
			}
		}
		exit(json_encode($result));
	}
/*
	获得最近浏览
*/
	public function getRecentView(){
		if(IS_AJAX === false) return false;
		$key = encrypt('recent-view');
		$result = array();
		if(!isset($_COOKIE[$key])){
			$result['status'] = false;
			exit(json_encode($result));
		}
		$value = unserialize(decrypt($_COOKIE[$key]));
		$data = $this->db->getGoods($value);
		if($data){
			$data = $this->disData($data);
			$result['status'] = true;
			$result['data'] = $data;
		}else{
			$result['status'] = false;
		}
		exit(json_encode($result));
	}
/*
	处理数据
*/
	private function disData($data){
		foreach($data as $k=>$v){
			$pathinfo =pathinfo($v['goods_img']);
        	$data[$k]['goods_img']=__ROOT__.'/'.$pathinfo['dirname'].'/'.$pathinfo['filename'].'_92x54.'.$pathinfo['extension'];
		}
		return $data;
	}
/*
	清空最近浏览
*/
	public function clearRecentView(){
		if(IS_AJAX === false) return false;
		$key = encrypt('recent-view');
		if(isset($_COOKIE[$key])){
			unset($_COOKIE[$key]);
		}
		setcookie($key,'',1,'/');
	}
}
?>