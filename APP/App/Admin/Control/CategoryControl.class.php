<?php
//测试控制器类
class CategoryControl extends CommonControl{
    private $cid;
	public function __auto(){
		$this->db = K('Category');
        $this->cid = $this->_get('cid','intval',0);
	}
/*
    显示分类列表
*/
    public function index(){
        $data = $this->db->getCategoryAll();
        $data = Data::channel($data,'cid','pid',0,0,2,'--');
        $this->assign('data',$data);
        $this->display();
    }
/*
    显示增加分类模板
*/
    public function addShow(){
        //查找所有分类
    	$data = $this->db->getCategoryAll();
        //查找当前类
        $parent = array('cid'=>$this->cid);
        $this->assign('parent',$parent);
        $level = Data::channel($data,'cid','pid',0,0,2,'--');
    	$this->assign('level',$level);
    	$this->display();
    }
/*
    添加分类
*/
    public function add(){
        $data = $this->getData();
        if($this->db->addCategory($data)){
            $this->success('添加分类成功',__CONTROL__.'/index');
        }else{
            throw_exception('添加分类失败');
        }
    }
/*
    显示修改分类模板
*/
    public function editShow(){
        //查找所有分类
        $data = $this->db->getCategoryAll();
        $level = Data::channel($data,'cid','pid',0,0,2,'--');
        $this->assign('level',$level);
        //查找分类的详细信息
        $category = $this->db->findCategory($this->cid);
        $this->assign('category',$category);
        $this->display();
    }
/*
    修改分类
*/
    public function edit(){
        $data = $this->getData();
        if($this->db->editCategory($data,$this->cid)){
            $this->success('修改分类成功',__CONTROL__.'/index');
        }else{
            throw_exception('修改分类失败');
        }
    }
/*
    删除分类
*/
    public function del(){
        //获得子分类
        $son=$this->db->findSonCategory($this->cid);
        if($son){
            $this->error('请先删除子类');
        }else{
            if($this->db->delCategory($this->cid)){
                $this->success('删除分类成功',__CONTROL__.'/index');
            }else{
                throw_exception('删除分类失败');
            }
        }
    }
/*
    处理数据
*/
    private function getData(){
        $data=array();
        $data['cname']       = $this->_post('cname','strip_tags');
        $data['title']       = $this->_post('title','htmlspecialchars');
        $data['keywords']    = $this->_post('keywords','htmlspecialchars');
        $data['description'] = $this->_post('description','htmlspecialchars');
        $data['sort']        = $this->_post('sort','intval');
        $data['display']     = $this->_post('display','intval');
        $data['pid']         = $this->_post('pid','intval');
        return $data;
    }
}
?>