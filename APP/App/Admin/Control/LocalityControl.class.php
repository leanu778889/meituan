<?php
	class LocalityControl extends CommonControl{
		public function __auto(){
			$this->db = K('Locality');
			$this->lid = $this->_get('lid','intval',0);
		}
/*
		显示地区列表
*/
		public function index(){
			$data = $this->db->getLocalityAll();
			//对地区进行层级处理
			$data = Data::channel($data,'lid','pid',0,0,2,'--');
			$this->assign('data',$data);
			$this->display();
		}
/*
		添加
*/
		public function add(){
			$data = $this->getData();
			if($this->db->addLocality($data)){
				$this->success('添加地区成功',__CONTROL__.'/index');
			}else{
				throw_exception('添加地区失败');
			}
		}
/*
		显示添加模板
*/
		public function addShow(){
			$data = $this->db->getLocalityAll();
			//对地区进行层级处理
			$level = Data::channel($data,'lid','pid',0,0,2,'--');
			//获得当前地区  为父级
			$parent = array('lid'=>$this->lid);
			$this->assign('parent',$parent);
			$this->assign('level',$level);
			$this->display();
		}
/*
		修改
*/
		public function edit(){
			$data= $this->getData();
			if($this->db->editLocality($data,$this->lid)){
				$this->success('修改地区成功',__CONTROL__.'/index');
			}else{
				throw_exception('修改地区失败');
			}
		}
/*
		显示修改模板
*/
		public function editShow(){
			// 获取所有地区信息
			$data = $this->db->getLocalityAll();
			$level = Data::channel($data,'lid','pid',0,0,2,'--');
			//获取单条地区的详细信息
			$locality = $this->db->findLocality($this->lid);
			$this->assign('locality',$locality);
			$this->assign('level',$level);
			$this->display();
		}
/*
		删除地区
*/
		public function del(){
			//获得子地区
			$son = $this->db->findSonLocality($this->lid);
			if($son){
				$this->error('请先删除子地区');
			}else{
				if($this->db->delLocality($this->lid)){
					$this->success('删除地区成功',__CONTROL__.'/index');
				}else{
					throw_exception('删除地区失败');
				}
			}
		}
/*
		处理POST数据
*/
		public function getData(){
			$data = array();
			$data['lname'] = $this->_post('lname','strip_tags');
			$data['sort'] = $this->_post('sort','intval');
			$data['display'] = $this->_post('display','intval');
			$data['pid'] = $this->_post('pid','intval');
			return $data;
 		}
	}
?>