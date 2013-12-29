<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?>	<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="http://localhost/meituan/Public/css/reset.css" type="text/css" rel="stylesheet" >
<link href="http://localhost/meituan/Public/css/common.css" type="text/css" rel="stylesheet" >
<script type='text/javascript' src='http://localhost/meituan/hdphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
<script type="text/javascript" src="http://localhost/meituan/Public/js/common.js"></script>
<meta name="keywords" content="" />
<meta name="description" content="" />
<title><?php echo $webInfo['title'];?></title>

</head>
<body>
	<!-- 顶部开始 -->
	<div id="top">
		<div class='position'>
			<div class='left'>
				后盾网，人人做后盾!
			</div>
			<div class='right'>
				<a href="javascript:addFavorite2();">收藏</a>
			</div>
		</div>
	</div>
	<!-- 顶部结束 -->
	<!-- 头部开始 -->
	<div id="header">
		<div class='position'>
			<div class='logo'>
				<a style="line-height:60px;" href="http://localhost/meituan">后盾团购</a>
				<a style="font-size:16px;" href="http://localhost/meituan">www.houdunwang.com</a>
			</div>
			<div class='search'>
				<div class='item'>
					<a href="<?php echo U('Index/Index/index');?>/keywords/小时代">小时代</a>
					<a href="<?php echo U('Index/Index/index');?>/keywords/KTV">KTV</a>
					<a href="<?php echo U('Index/Index/index');?>/keywords/电影">电影</a>
					<a href="<?php echo U('Index/Index/index');?>/keywords/全聚德">全聚德</a>
				</div>
				<div class='search-bar'>
					<form action="<?php echo U('Index/Index/index');?>" method="post">
						<input class='s-text' type="text" name="keywords" onfocus="if(value=='请输入商品名称，地址等'){value=''}" onblur="if(value==''){value='请输入商品名称，地址等'}"  value="请输入商品名称，地址等">
						<input class='s-submit' type="submit" value='搜索'>
					</form>
				</div>
			</div>
			<div class='commitment'>

			</div>
		</div>
	</div>
	<!-- 头部结束 -->
	<!-- 导航开始-->
	<div id="nav">
		<div class='position'>
			<!-- 分类相关 -->
			<div class='category'>
				<?php if(is_array($topNav)):?><?php  foreach($topNav as $k=>$v){ ?>
					<?php echo $v;?>
				<?php }?><?php endif;?>
			</div>
			<script>
				/*$('.category a').click(function(){
					var category = $(this).attr('category');
					document.cookie ='category='+category+';path=/';
				})
				var category = getCookie(' category');
				if((typeof category) != 'string'){
					category ="-1";
				}
				$('.category a').each(function(){
					if($(this).attr('category') == category){
						$(this).addClass('active');
					}else{
						$(this).removeClass('active');
					}
				})
				function getCookie(name){
					var arr = document.cookie.split(';');
					for(var i=0;i<arr.length;i++){
						var arr2 = arr[i].split('=');
						if(arr2[0]==name){
							return arr2[1];
						}
					}
				}*/
			</script>
			<!-- 用户相关 -->
			<div id="user-relevance" class='user-relevance'>
				<?php if($isLogin){?>
					<div class='user-nav login-reg'>
						<a class='title' href="<?php echo U('Member/Login/quit');?>">退出</a>
					</div>
					<!--我的团购 -->
					<div class='user-nav my-hdtg '>
						<a class='title' href="javascript:void(0)">我的团购</a>
						<ul class="menu">
							<li id="1"><a href="<?php echo U('Member/Order/index');?>">我的订单</a></li>
							<li id="2"><a href="<?php echo U('Member/Index/collect');?>">我的收藏</a></li>
							<li id="3"><a href="<?php echo U('Member/Account/index');?>">账户余额</a></li>
							<li id="4"><a href="<?php echo U('Member/Account/setting');?>">账户设置</a></li>
						</ul>
					</div>
				<script>
				$('.my-hdtg .menu li').click(function(){
					var id = $(this).attr('id');
					document.cookie = "userHomeNav="+id+';path=/';
				})
			</script>
				<?php  }else{ ?>
					<!--登录注册-->
					<div class='user-nav login-reg'>
						<a class='title' href="<?php echo U('Member/Reg/index');?>">注册</a>
					</div>
					<div class='user-nav login-reg'>
						<a class='title' href="<?php echo U('Member/Login/index');?>">登录</a>
					</div>
				<?php }?>

				<!-- 最近浏览 -->
					<div  class='user-nav recent-view ' url="<?php echo U('Member/Index/getRecentView');?>" goodsUrl ="<?php echo U('Index/Detail/index');?>" clearUrl="<?php echo U('Member/Index/clearRecentView');?>">
						<a class='title' href="javascript:void(0)">最近浏览</a>
						<ul class="menu">
						</ul>
					</div>
					<!-- 我的购物车 -->
					<div id='my-cart'  class='user-nav my-cart ' url="<?php echo U('Member/Cart/index');?>" goodsUrl="<?php echo U('Index/Detail/index');?>" delUrl="<?php echo U('Member/Cart/delCart');?>">
						<a class='title' href="javascript:void(0)" ><i>&nbsp;</i>购物车</a>
						<ul class="menu">
							<p class='clear'>正在加载。。</p>
						</ul>
					</div>
			</div>
		</div>
	</div>
	<!-- 导航结束 -->

<!-- 载入公共头部文件结束 -->
	<link href="http://localhost/meituan/APP/App/Index/Tpl/Public/css/detail.css" type="text/css" rel="stylesheet" >
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=F175492a12ccf0e92d3b53ee04255a94"></script>
	<div id="map" class='position'>
		<a href="<?php echo U('Index/Index/index');?>/cid/<?php echo $detail['cid'];?>"><?php echo $detail['lname'];?></a><span>»</span><a href="<?php echo U('Index/Index/index');?>/lid/<?php echo $detail['lid'];?>"><?php echo $detail['cname'];?></a><span>»</span><span><?php echo $detail['shopname'];?></span>
	</div>
	<div id="content" class='position'>
		<div class='content-left'>
			<div class="goods-intro">
				<div class='goods-title'>
					<h1><?php echo $detail['main_title'];?></h1>
					<h3><?php echo $detail['sub_title'];?></h3>
				</div>
				<div class='deal-intro'>
					<div class='buy-intro'>
						<div class='price'>
							<div class='discount-price'>
								<span>¥</span><?php echo $detail['price'];?>
							</div>
							<div class='cost-price'>
								<span class='discount'><?php echo $detail['zhekou'];?>折</span>
								门店价<b>¥<?php echo $detail['old_price'];?></b>
							</div>
						</div>
						<div class='deal-buy-cart'>
							<a href="<?php echo U('Member/Buy/index');?>/gid/<?php echo $detail['gid'];?>" class='buy'></a>
							<a href="javascript:void(0)" url="<?php echo U('Member/Cart/add');?>/gid/<?php echo $detail['gid'];?>" id='addCart' class='cart'></a>
						</div>
						<div class='purchased'>
							<p class='people'>
								<span><?php echo $detail['buy'];?></span>人已团购
							</p>
							<p class='time'>
								<?php echo $detail['end_time'];?>
							</p>
						</div>
						<ul class='refund-intro'>
							<?php if(is_array($detail['serve'])):?><?php  foreach($detail['serve'] as $v){ ?>
								<li>
									<?php echo $v['img'];?>
									<span class='text'><?php echo $v['name'];?></span>
								</li>
							<?php }?><?php endif;?>
						</ul>
					</div>
					<div class='image-intro'>
						<img src="http://localhost/meituan/<?php echo $detail['goods_img'];?>"/>
					</div>
				</div>
				<div class='collect'>
					<a class='collect-link' url="<?php echo U('Member/Index/addCollect');?>/gid/<?php echo $detail['gid'];?>" id='addCollect' href='javascript:void(0)'><i></i>收藏本单</a>

					<div class='share'>

					</div>

				</div>
			</div>
			<div class='detail'>
				<ul class='plot-points'>
					<li class='active'><a href="#shop-site">商家位置</a></li>
					<li><a href="#details">本单详情</a></li>
					<li><a href="#comment">消费评价</a></li>
				</ul>
				<div id="shop-site" class='shop-site'>
					<p class='site-title'>商家位置</p>
					<div class='box'>
						<div id="bMap" class='map'>

						</div>
						<div class='info'>
							<h3><?php echo $detail['shopname'];?></h3>
							<dl>
								<dt>地址:</dt>
								<dd><?php echo $detail['shopaddress'];?></dd>
							</dl>
							<dl>
								<dt>地铁:</dt>
								<dd><?php echo $detail['metroaddress'];?></dd>
							</dl>
							<dl>
								<dt>电话:</dt>
								<dd><?php echo $detail['shoptel'];?></dd>
							</dl>
						</div>
					</div>
				</div>
				<div id="details"  class='details'>
					<?php echo $detail['detail'];?>
				</div>
				<div id="comment" class='comment'>
					<div class='comment-list-title'>
						<span>全部评价</span>
						<a class='order-time' href="">按时间<i></i></a>
					</div>
					<div class='comment-list'>
						<div class='list-con'>
							<div class='con-top'>
								<span class='username'>sdas</span>
								<span class='time'>评价于:<em>2013-08-04</em></span>
							</div>
							<p>
								说是香草拿铁不是很苦，结果根本不是想象中的味道！像速溶冲调！还要另加五元？有此一说吗？银座店环境一般！
							</p>
						</div>

					</div>
					<div class='comment-page'>
						<a href="">1</a>
						<a href="">1</a>
						<a href="">1</a>
						<a href="">1</a>
						<a href="">1</a>
						<a href="">1</a>
					</div>
				</div>
			</div>

		</div>
		<div class='content-right'>
			<div class='recommend'>
				<h3 class='recommend-title'>
					看过本团购的用户还看了
				</h3>
				<?php if(is_array($relatedGoods)):?><?php  foreach($relatedGoods as $v){ ?>
					<div class='recommend-goods'>
						<a class='goods-image' href="<?php echo U('Index/Detail/index');?>/gid/<?php echo $v['gid'];?>">
							<img alt="图像加载失败.." src="<?php echo $v['goods_img'];?>">
						</a>
						<h4>
							<a href="<?php echo U('Index/Detail/index');?>/gid/<?php echo $v['gid'];?>"><?php echo $v['main_title'];?></a>
						</h4>
						<p>
							<strong>¥<?php echo $v['price'];?></strong>
							<span class='cost-price'>门店价<del><?php echo $v['old_price'];?></del></span>
							<span class='num'>
								<span><?php echo $v['buy'];?></span>
								 人已团购
							</span>
						</p>
					</div>
				<?php }?><?php endif;?>
			</div>
		</div>
	</div>

	<script>
		var shopcoord = <?php echo $detail['shopcoord'];?>;
		var map = new BMap.Map("bMap");            // 创建Map实例
		var point = new BMap.Point(shopcoord.lng, shopcoord.lat);    // 创建点坐标
		map.centerAndZoom(point,15);            // 初始化地图,设置中心点坐标和地图级别。
		map.enableScrollWheelZoom();                            //启用滚轮放大缩小
		var marker1 = new BMap.Marker(point);  // 创建标注
		map.addOverlay(marker1);              // 将标注添加到地图中
		map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}));  //右上角，仅包含平移和缩放按钮
	</script>
		<script>
		var cartSucc = "<div class='colse'><a href='javascript:hideInfoWindow();'></a></div>\
			<ul class='status'>\
			<li class='ico'></li>\
			<li class='msg'>\
				<h3>添加成功!</h3>\
				<p>购物车内共有<span id='total'></span>种商品</p>\
			</li>\
		</ul>\
		<div class='goBtn'>\
			<a href='javascript:hideInfoWindow();'>继续浏览</a>\
			<a href='<?php echo U('Member/Cart/index');?>'>查看购物车</a>\
		</div>";
		var collectSucc = "<div class='colse'><a href='javascript:hideInfoWindow();'></a></div>\
			<ul class='status'>\
			<li class='ico'></li>\
			<li class='msg'>\
				<h3>收藏成功!</h3>\
			</li>\
		</ul>\
		<div class='goBtn'>\
			<a href='javascript:hideInfoWindow();'>继续浏览</a>\
			<a href='<?php echo U('Member/Index/collect');?>'>查看我的收藏</a>\
		</div>";
		var userIsLogin = false;
		<?php if($isLogin){?>
			userIsLogin = true;
		<?php }?>
	</script>
	<script src='http://localhost/meituan/APP/App/Index/Tpl/Public/js/detail.js'></script>

	<div class="c"></div>
	<div id="cover"></div>
	<div id="infoWindow">

	</div>













<!-- 载入公共头部文件开始 -->
	<?php if(!defined("HDPHP_PATH"))exit;C("SHOW_WARNING",false);?>
	<div id="footer">
		<p>本demo不用于任何商业目的，仅供学习与交流</p>
	</div>
	</body>
</html>
<!-- 载入公共头部文件结束 -->