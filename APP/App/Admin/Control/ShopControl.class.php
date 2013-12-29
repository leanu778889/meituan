<?php
class ShopControl extends CommonControl{
	private $shopid;
	public function __auto(){
		$this->db = K('shop');
		$this->shopid = $this->_get('shopid','intval',0);
	}
	public function index(){
		$total = $this->db->getShopCount();
		$page = new page($total,5);
		$data = $this->db->getShopLimit($page->limit());
		$this->assign('data',$data);
		$this->assign('page',$page->show());
		$this->display();
	}
	public function add(){
		$data = $this->getData();
		if($this->db->addShop($data)){
			$this->success('添加商铺成功',__CONTROL__.'/index');
		}else{
			throw new Exception("添加商铺失败");
		}
	}
	public function addShow(){
		$this->display();
	}
	public function edit(){
		$data = $this->getData();
		if($this->db->editShop($data,$this->shopid)){
			$this->success('修改成功','index');
		}else{
			throw new Exception("修改失败");
		}
	}
	public function editShow(){
		$data = $this->db->findShop($this->shopid);
		$this->assign('data',$data);
		$this->display();
	}
	public function del(){
		if($this->db->delShop($this->shopid)){
			$this->success('删除成功','index');
		}else{
			throw new Exception('删除失败');

		}
	}
	public function getData(){
		$data = array();
		$data['shopname']     = $this->_post('shopname','strip_tags');
		$data['shopaddress']  = $this->_post('shopaddress','strip_tags');
		$data['metroaddress'] = $this->_post('metroaddress','strip_tags');
		$data['shoptel']      = $this->_post('shoptel','strip_tags');
		$data['shopcoord']    = $this->_post('shopcoord','strip_tags');
		return $data;
	}
}
?>