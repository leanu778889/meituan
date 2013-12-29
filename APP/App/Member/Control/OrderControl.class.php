<?php
class OrderControl extends CommonControl{
   	public $uid;
   	public $oid;
   	public $status;
   	public function __auto(){
		if(!isset($_SESSION[C('RBAC_AUTH_KEY')])){
            go('Member/Login/index');
            exit();
        }else{
            $this->uid = $_SESSION[C('RBAC_AUTH_KEY')];
        }
		$this->db = K('order');
		$this->status = $this->_get('status','intval',null);
		$this->oid = $this->_get('oid','intval');
	}
    public function index(){
    	if(is_null($this->status)){
    		$where = array('user_id'=>$this->uid);
    	}else{
    		$where = array('user_id'=>$this->uid,'status'=>$this->status);
    	}
    	$data = $this->db->getOrderData($where);
    	$order = $this->disData($data);
    	$this->assign('order',$order);
        $this->display();
    }
    public function delOrder(){
    	if($this->db->delOrder($this->oid)){
    		$this->success('删除成功','index');
    	}else{
    		$this->error('删除失败','index');
    	}
    }
    private function disData($data){
    	if(!is_array($data)) return false;
    	foreach($data as $k=>$v){
			$pathinfo =pathinfo($v['goods_img']);
        	$data[$k]['goods_img']=__ROOT__.'/'.$pathinfo['dirname'].'/'.$pathinfo['filename'].'_92x54.'.$pathinfo['extension'];
        	$data[$k]['sumPrice'] = $v['goods_num']*$v['price'];
    	}
    	return $data;
    }
}
?>