<?php
class DetailControl extends CommonControl{
	public $gid;
	public function __auto(){
		$this->db = K('Goods');
		$this->gid = $this->_get('gid','intval',0);
		$this->setRecentView();
	}
	public function index(){
		$data = $this->db->getGoodsDetail($this->gid);
		$detail = $this->disGoodsDetail($data);
		$this->assignRelatedGoods($detail['cid']);
		$this->assign('detail',$detail);
		$this->display();
	}
/*
	处理商品详细页数据
*/
	public function disGoodsDetail($data){
		$data['zhekou'] = round(($data['price']/$data['old_price']*10),1);
		$pathinfo =pathinfo($data['goods_img']);
        $data['goods_img']=$pathinfo['dirname'].'/'.$pathinfo['filename'].'_460x280.'.$pathinfo['extension'];
        if($data['end_time']-time()>(pow(60,2)*24*3)){
        	$data['end_time'] = '剩余<span>3</span>天以上';
        }else{
        	$data['end_time'] = date('Y-m-d H:i:s',$data['end_time']).'下架';
        }
        $goodserve=array_slice(unserialize($data['goods_server']),0,2);
        $serve = C('goods_server');
        $data['serve'] = array(
        	$serve[$goodserve[0]],
        	$serve[$goodserve[1]]
        );
        return $data;
	}
	public function setRecentView(){
		$key = encrypt('recent-view');
		$value = isset($_COOKIE[$key])?unserialize(decrypt($_COOKIE[$key])):array();
		if(!in_array($this->gid,$value)){
			array_unshift($value,$this->gid);
		}
		setcookie($key,encrypt(serialize($value)),time()+86400,'/');

	}
	private function assignRelatedGoods($cid){
		$relatedGoods = $this->db->getRelatedGoods($cid);
		foreach($relatedGoods as $k=>$v){
            $pathinfo =pathinfo($v['goods_img']);
            $relatedGoods[$k]['goods_img']=__ROOT__.'/'.$pathinfo['dirname'].'/'.$pathinfo['filename'].'_200x100.'.$pathinfo['extension'];
        }
        $this->assign('relatedGoods',$relatedGoods);
	}
}