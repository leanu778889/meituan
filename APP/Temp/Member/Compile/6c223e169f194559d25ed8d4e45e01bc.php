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

	<!-- 载入公共头部文件-->
	<link href="http://localhost/meituan/APP/App/Member/Tpl/Public/css/login.css" type="text/css" rel="stylesheet" >
	<!-- 页面主体开始 -->
	<div id="login-box">
		<h3>会员登录</h3>
		<div class='left'>
			<form action="<?php echo U('Member/Login/login');?>" method='POST'>
			<div class='form'>
				<dl>
					<dt>账号:</dt>
					<dd class='text'>
						<input name='uname' type="text"/>
					</dd>
				</dl>
				<dl>
					<dt>密码:</dt>
					<dd class='text'>
						<input name='password' type="password"/>
					</dd>
					<dd><a style="color:#11bbbb;" href="">忘记密码</a></dd>
				</dl>
				<dl>
					<dt></dt>
					<dd>
						<!--
						<label>
							<input type="checkbox"/> 记住账号
						</label>
						&nbsp;&nbsp;	-->
						<label>
							<input name='auto_login' type="checkbox"/> 下次自动登录
						</label>
					</dd>
				</dl>
				<dl>
					<dt></dt>
					<dd class='submit'>
						<input type="submit" value="登录">
					</dd>
				</dl>
			</div>
			</form>
		</div>
		<div class='right'>
			<p class='right-title'>尚未注册？</p>
			<a class='reg-link' href="">免费注册</a>
			<p class='open-title'>用合作网站账号登录</p>
			<div class='open'>
				<a class='open-login-link sina' href=""><img src="http://study.houdunwang.com/hdlearn/config/img/weibo_login.png"></a>
				<a class='open-login-link qq' href=""><img src="http://study.houdunwang.com/hdlearn/config/img/qq_login.png"></a>
			</div>
		</div>
	</div>
</body>
</html>