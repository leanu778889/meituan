<?php
class UserControl extends CommonControl{
	public function __auto(){
		$this->db = K('user');
	}
	public function index(){
		$total = $this->db->getUserTotal();
		$page = new Page($total);
		$user = $this->db->getUser($page->limit());
		$this->assign('page',$page->show());
		$this->assign('user',$user);
		$this->display();
	}
	public function del(){
		$uid = $this->_get('uid','intval',0);
		if($this->db->delUser($uid)){
			$this->success('删除成功','index');
		}else{
			$this->error('删除失败','index');
		}
	}
}
?>