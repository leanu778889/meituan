<?php
class GoodsControl extends CommonControl{
	public function __auto(){
		$this->db = K('goods');
		$this->gid = $this->_get('gid','intval');
	}
/*
	商品列表
*/
	public function index(){
		$total = $this->db->getGoodsTotal();
		$page = new Page($total,10);
		$data = $this->db->getGoodsAll($page->limit());
		$this->assign('data',$data);
		$this->assign('page',$page->show());
		$this->display();
	}
/*
	添加商品模板
*/
	public function addshow(){
		$shop = $this->setShop();
		$category = $this->setCategory();
		$locality = $this->setLocality();
		$this->assign('goods_server',C('GOODS_SERVER'));
		$this->assign('locality',$locality);
		$this->assign('category',$category);
		$this->assign('shop',$shop);
		$this->display();
	}
/*
	添加商品
*/
	public function add(){
		$data = $this->setData();
		if($this->db->addGoods($data)){
			$this->success('添加商品成功','index');
		}else{
			throw new Exception('商品添加失败');
		}
	}
/*
	修改商品模板
*/
	public function editShow(){
		$shop = $this->setShop();
		$category = $this->setCategory();
		$locality = $this->setLocality();
		$this->assign('goods_server',C('GOODS_SERVER'));
		$this->assign('locality',$locality);
		$this->assign('category',$category);
		$this->assign('shop',$shop);
		$data = $this->db->findGoods($this->gid);
		$data['goods_server'] = unserialize($data['goods_server']);
		$this->assign('data',$data);
		$this->display();
	}
/*
	修改商品
*/
	public function edit(){
		$data = $this->setData();
		if($this->db->editGoods($data,$this->gid)){
			$this->success('编辑成功','index');
		}else{
			throw new Exception('编辑失败');
		}
	}
/*
	删除商品
*/
	public function del(){
		if($this->db->delGoods($this->gid)){
			$this->success('删除成功','index');
		}else{
			throw new Exception('删除失败');
		}
	}
/*
	删除旧的图片
*/
	private function delOldFile($img){
		$pathInfo = pathinfo($img);
		$oldFiles=array(
			ROOT_PATH.'/'.$img,
			ROOT_PATH.'/'.$pathInfo['dirname'].'/'.$pathInfo['filename'].'_460x280.'.$pathInfo['extension'],
			ROOT_PATH.'/'.$pathInfo['dirname'].'/'.$pathInfo['filename'].'_200x100.'.$pathInfo['extension'],
			ROOT_PATH.'/'.$pathInfo['dirname'].'/'.$pathInfo['filename'].'_310x185.'.$pathInfo['extension'],
			ROOT_PATH.'/'.$pathInfo['dirname'].'/'.$pathInfo['filename'].'_90x55.'.$pathInfo['extension']
		);
		foreach ($oldFiles as $v) {
			if(file_exists($v)) unlink($v);
		}
	}
/*
	处理数据
*/
	private function setData(){
		$data = array();
		$data['goods']['shopid'] = $this->_post('shopid','intval');
		$data['goods']['cid'] = $this->_post('cid','intval');
		$data['goods']['lid'] = $this->_post('lid','intval');
		$data['goods']['main_title'] = $this->_post('main_title','strip_tags');
		$data['goods']['sub_title'] = $this->_post('sub_title','strip_tags');
		$data['goods']['price'] = $this->_post('price','intval');
		$data['goods']['old_price'] = $this->_post('old_price','intval');
		$data['goods']['begin_time'] = $this->_post('begin_time','strtotime');
		$data['goods']['end_time'] = $this->_post('end_time','strtotime');
		if(isset($_POST['goods_img'])){
			if(isset($_POST['old_img'])){
				$this->delOldFile($_POST['old_img']);
			}
			$data['goods']['goods_img'] = $_POST['goods_img'][1]['path'];
		}
		$data['goods_detail']['goods_server'] = serialize($_POST['goods_server']);
		$data['goods_detail']['detail'] = $_POST['detail'];
		return $data;
	}
/*
	获取商品所属商铺
*/
	private function setShop(){
		$shopid = $this->_get('shopid','intval');
		$db = K('Shop');
		return $db->findShop($shopid);
	}
/*
	获取商品分类
*/
	private function setCategory(){
		$db = K('Category');
		$data = $db->getCategoryAll();
		return Data::channel($data,'cid','pid',0,0,2,'--');
	}
/*
	获取商品地区
*/
	private function setLocality(){
		$db = K('Locality');
		$data = $db->getLocalityAll();
		return Data::channel($data,'lid','pid',0,0,2,'--');
	}
}
?>