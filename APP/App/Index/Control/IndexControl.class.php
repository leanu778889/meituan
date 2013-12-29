<?php
//测试控制器类
class IndexControl extends CommonControl{
	private $lid;
    private $price;
    private $order;
	public function __auto(){
        $this->db = K('Goods');
		$this->lid = $this->_get('lid','intval',null);
        $this->price = $this->_get('price','',null);
        $this->order = $this->_get('order','','d-desc');
        $this->setCategory();
        $this->setLocality();
        $this->setPrice();
        $this->setOrderTpl();
	}
    public function index(){
        $this->setSearchWhere();
        $this->setOrder();
        $total=$this->db->getGoodsTotal();
        $page = new Page($total,10);
        $data = $this->db->getGoods($page->limit());
        $goods=$this->disGoods($data);
        $this->assignHotGoods();
        $this->assignHotCategory();
        $this->assign('goods',$goods);
        $this->assign('page',$page->show());
        $this->display();
    }
/*
    处理排序
*/
    private function setOrder(){
        $arr = explode('-', $this->order);
        switch ($arr[0]) {
            case 'd':
                $this->db->order = 'begin_time '.$arr[1];
            break;
            case 'b':
                $this->db->order = 'buy '.$arr[1];
            break;
            case 'p':
                $this->db->order = 'price '.$arr[1];
            break;
            case 't':
                $this->db->order = 'begin_time '.$arr[1];
            break;
        }
    }
/*
    处理查询出来的商品数据
*/
    private function disGoods($data){
        if(!is_array($data)) return;
        foreach($data as $k=>$v){
            $pathinfo =pathinfo($v['goods_img']);
            $data[$k]['goods_img']=$pathinfo['dirname'].'/'.$pathinfo['filename'].'_310x190.'.$pathinfo['extension'];
            $data[$k]['sub_title']=mb_substr($v['sub_title'], 0,30,'utf8');
        }
        return $data;
    }
/*
    设置商品搜索条件
*/
    private function setSearchWhere(){
        if(isset($_POST['keywords'])){
            $_GET['keywords'] = $_POST['keywords'];
        }
        if(isset($_GET['keywords'])){
            $this->db->keywords = $_GET['keywords'];
        }
        //商品分类的检索
        if(!is_null($this->cid)){
            $db = K('Category');
            $sonCategory = $db->getSonCategory($this->cid);
            foreach($sonCategory as $v){
                $this->db->cids['goods.cid'][]=$v['cid'];
            }
        }
        //商品地区的检索
        if(!is_null($this->lid)){
            $db = K('Locality');
            $sonLocality = $db->getSonLocality($this->lid);
            foreach($sonLocality as $v){
                $this->db->lids['goods.lid'][]=$v['lid'];
            }
        }
        if(!is_null($this->price)){
            $arr = explode('-', $this->price);
            if(isset($arr[1])){
                $this->db->price = 'price>'.$arr[0].' and price<'.$arr[1];
            }else{
                $this->db->price = 'price>'.$arr[0];
            }
        }
    }
/*
    设置价格的方法
*/
    private function setPrice(){
        $url = url_param_remove('price',$this->url);
        $db = K('Category');
        $key = '';
        if(is_null($this->cid)){
            $key = 'all';
        }else{
            $pid = $db->getCategoryPid($this->cid);
            $key = $pid?$pid:$this->cid;
        }
        $prices = C('PRICE');
        $price = $prices[$key];
        $tmpArr = array();
        if(is_null($this->price)){
            $tmpArr[] = '<a class="active" href="'.$url.'">全部</a>';
        }else{
             $tmpArr[] = '<a  href="'.$url.'">全部</a>';
        }
        foreach($price as $v){
            if($v[1] ==$this->price){
                $tmpArr[] = '<a class="active" href="'.$url.'/price/'.$v[1].'">'.$v[0].'</a>';
            }else{
                $tmpArr[] = '<a href="'.$url.'/price/'.$v[1].'">'.$v[0].'</a>';
            }
        }
        $this->assign('price',$tmpArr);
    }
/*
    设置地区的方法
*/
    private function setLocality(){
    	$url = url_param_remove('lid',$this->url);
    	$db = K('Locality');
    	//没有传lid的情况
    	if(is_null($this->lid)){
    		$topLocality = $db->getLocalityLevel(0);
    		$tmpArr=array();
    		$tmpArr[]='<a class="active" href="'.$url.'">全部</a>';
    		foreach($topLocality as $v){
    			$tmpArr[] = '<a href="'.$url.'/lid/'.$v["lid"].'">'.$v["lname"].'</a>';
    		}
    		$this->assign('topLocality',$tmpArr);
    		return ;
    	}
    	//传了lid的情况，父类处理
    	$pid = $db->getLocalityPid($this->lid);
    	$topLocality = $db->getLocalityLevel(0);
    	$tmpArr=array();
    	$tmpArr[]='<a href="'.$url.'">全部</a>';
    	foreach($topLocality as $v){
    		if($pid == $v['lid'] || $this->lid ==$v['lid']){
    			$tmpArr[] = '<a class="active" href="'.$url.'/lid/'.$v["lid"].'">'.$v["lname"].'</a>';
    		}else{
    			$tmpArr[] = '<a href="'.$url.'/lid/'.$v["lid"].'">'.$v["lname"].'</a>';
    		}
    	}
    	$this->assign('topLocality',$tmpArr);
    	//子类处理
    	if($pid == 0){
    		$sonLocality = $db->getLocalityLevel($this->lid);
    	}else{
    		$sonLocality = $db->getLocalityLevel($pid);
    	}
    	if(is_null($sonLocality)) return;
    	$tmpArr = array();
    	if($pid == 0){
    		$tmpArr[] ='<a class="active" href="'.$url.'/lid/'.$this->lid.'">全部</a>';
    	}else{
    		$tmpArr[] ='<a href="'.$url.'/lid/'.$pid.'">全部</a>';
    	}
    	foreach($sonLocality as $v){
    		if($this->lid ==$v['lid']){
    			$tmpArr[] = '<a class="active" href="'.$url.'/lid/'.$v["lid"].'">'.$v["lname"].'</a>';
    		}else{
    			$tmpArr[] = '<a href="'.$url.'/lid/'.$v["lid"].'">'.$v["lname"].'</a>';
    		}
    	}
    	$this->assign('sonLocality',$tmpArr);
    }
/*
    设置分类的方法
*/
    private function setCategory(){
    	$url = url_param_remove('cid',$this->url);
    	$db = K('Category');
    	//没有传cid的情况
    	if(is_null($this->cid)){
    		$topCategory = $db->getCategoryLevel(0);
    		$tmpArr=array();
    		$tmpArr[]='<a class="active" href="'.$url.'">全部</a>';
    		foreach($topCategory as $v){
    			$tmpArr[] = '<a href="'.$url.'/cid/'.$v["cid"].'">'.$v["cname"].'</a>';
    		}
    		$this->assign('topCategory',$tmpArr);
    		return ;
    	}
    	//传了cid的情况，父类处理
    	$pid = $db->getCategoryPid($this->cid);
    	$topCategory = $db->getCategoryLevel(0);
    	$tmpArr=array();
    	$tmpArr[]='<a href="'.$url.'">全部</a>';
    	foreach($topCategory as $v){
    		if($pid == $v['cid'] || $this->cid ==$v['cid']){
    			$tmpArr[] = '<a class="active" href="'.$url.'/cid/'.$v["cid"].'">'.$v["cname"].'</a>';
    		}else{
    			$tmpArr[] = '<a href="'.$url.'/cid/'.$v["cid"].'">'.$v["cname"].'</a>';
    		}
    	}
    	$this->assign('topCategory',$tmpArr);
    	//子类处理
    	if($pid == 0){
    		$sonCategory = $db->getCategoryLevel($this->cid);
    	}else{
    		$sonCategory = $db->getCategoryLevel($pid);
    	}
    	if(is_null($sonCategory)) return;
    	$tmpArr = array();
    	if($pid == 0){
    		$tmpArr[] ='<a class="active" href="'.$url.'/cid/'.$this->cid.'">全部</a>';
    	}else{
    		$tmpArr[] ='<a href="'.$url.'/cid/'.$pid.'">全部</a>';
    	}
    	foreach($sonCategory as $v){
    		if($this->cid ==$v['cid']){
    			$tmpArr[] = '<a class="active" href="'.$url.'/cid/'.$v["cid"].'">'.$v["cname"].'</a>';
    		}else{
    			$tmpArr[] = '<a href="'.$url.'/cid/'.$v["cid"].'">'.$v["cname"].'</a>';
    		}
    	}
    	$this->assign('sonCategory',$tmpArr);
    }
/*
    设置排序规则
*/
    private function setOrderTpl(){
        $url = url_param_remove('order',$this->url);
        $order =array();
        //default 默认排序
        $order['d'] = $url.'/order/d-desc';
        //buy 销量降序
        $order['b'] = $url.'/order/b-desc';
        //price 价格降序
        $order['p_d'] = $url.'/order/p-desc';
        //price 价格升序
        $order['p_a'] = $url.'/order/p-asc';
        //time 时间降序
        $order['t'] = $url.'/order/t-desc';
        $this->assign('orderUrl',$order);
    }
/*
    分配热卖商品
*/
    private function assignHotGoods(){
        $hotGoods = $this->db->getHotGoods();
        $data=array();
        foreach($hotGoods as $k=>$v){
            $data[$k+1] = $v;
            $pathinfo =pathinfo($v['goods_img']);
            $data[$k+1]['goods_img']=__ROOT__.'/'.$pathinfo['dirname'].'/'.$pathinfo['filename'].'_92x54.'.$pathinfo['extension'];
        }
        $this->assign('hotGoods',$data);
    }
/*
    分配热门分类
*/
    private function assignHotCategory(){
        $hotCategory = $this->db->getHotCategory();
        $this->assign('hotCategory',$hotCategory);
    }
}
?>