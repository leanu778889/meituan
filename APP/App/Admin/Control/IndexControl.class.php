<?php
//测试控制器类
class IndexControl extends CommonControl{
    public function index(){
        $this->display();
    }
    public function welcome(){
    	$this->display('welcome.html');
    }
    public function quit(){
    	session_destroy();
    	session_unset();
    	$this->success('退出成功！');
    }
}
?>