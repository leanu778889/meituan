/**
 * 添加收藏
 */
function addFavorite2() {
    var url = window.location;
    var title = document.title;
    var ua = navigator.userAgent.toLowerCase();
    if (ua.indexOf("360se") > -1) {
        alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！");
    }
    else if (ua.indexOf("msie 8") > -1) {
        window.external.AddToFavoritesBar(url, title); //IE8
    }
    else if (document.all) {
    	try{
    		window.external.addFavorite(url, title);
    	}catch(e){
    		alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
    	}
    }
    else if (window.sidebar) {
        window.sidebar.addPanel(title, url, "");
    }
    else {
    	alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
    }
}
/**
 * 导航字菜单
 */

$(function(){
	$('.delAffirm').click(function(){
		if(!confirm('你确定要删除吗?')){
			return false;
		}
	})
	//导航样式切换
	$('#nav .user-nav').hover(function(){
		$(this).addClass('active');
	},function(){
		$(this).removeClass('active');
	})
	//我的团购菜单切换
	$('#nav .my-hdtg').hover(function(){
		$(this).find('.menu').show();
	},function(){
		$(this).find('.menu').hide();
	})
	//最近浏览菜单切换
	var t1;
	var requestFlag1 = true;
	$('#nav .recent-view').hover(function(){
		clearTimeout(t1);
		$(this).find('.menu').show();
		if(requestFlag1 === false){
			return false;
		}
		requestFlag1 = false;
		var url=$(this).attr('url');
		var goodsUrl = $(this).attr('goodsUrl');
		var oBox = $(this).find('.menu');
		$.ajax({
			url:url,
			dataType:'json',
			success:function(result){
				if(result.status === true){
					var data = result.data;
					for(var i in data){
						var nodeStr = '<li>\
								<a class="image" href="'+goodsUrl+"/gid/"+data[i].gid+'">\
									<img width="80" height="50" src="'+data[i].goods_img+'" />\
								</a>\
								<div>\
									<h4>\
										<a href="'+goodsUrl+"/gid/"+data[i].gid+'">'+data[i].main_title+'</a>\
									</h4>\
									<span><strong>¥'+data[i].price+'</strong><del>'+data[i].old_price+'</del></span>\
								</div>\
							</li>';
						oBox.append(nodeStr);
					}
					oBox.append('<p id="clearRecentView" class="clear"><a href="javascript:void(0)">清空最近浏览记录</a></p>')
				}else{
					oBox.html('无最近浏览记录！');
				}
			}
		})

	},function(){
		t1=setTimeout(function(){
			requestFlag1 = true;
		},8000)
		$(this).find('.menu').hide();
	})
	$('#clearRecentView').live('click',function(){
		var url = $('#nav .recent-view').attr('clearUrl');
		$.ajax({
			url:url,
			dataType:'json',
			success:function(){
				$('#nav .recent-view .menu').html('无最近浏览记录！');
			}

		})
	})










	//购物车菜单切换
	var t;
	var requestFlag = true;
	$('#nav .my-cart').hover(function(){
		clearTimeout(t);
		$(this).find('.menu').show();
		if(requestFlag === false){
			return false;
		}
		requestFlag = false;
		var url = $(this).attr('url');
		var goodsUrl = $(this).attr('goodsUrl');
		var delUrl = $(this).attr('delUrl');
		$.ajax({
			url:url,
			dataType:'json',
			success:function(result){
				if(result.status ===true){
					var data = result.data;
					$('#my-cart .menu p').remove();
					$('#my-cart .menu li').remove();
					for(var i in data){
						var nodeStr = '<li>\
								<a class="image" href="'+goodsUrl+"/gid/"+data[i]["gid"]+'">\
									<img height=50 width=80 src="'+data[i]["goods_img"]+'" />\
								</a>\
								<div>\
									<h4>\
										<a href="'+goodsUrl+"/gid/"+data[i]["gid"]+'">'+data[i]["main_title"]+'</a>\
									</h4>\
									<span><strong>¥'+data[i]["price"]+'</strong><a class="delCart" href="javascript:void(0)" url="'+delUrl+"/gid/"+data[i]["gid"]+'">删除</a></span>\
								</div>\
							</li>';
						$('#my-cart .menu').append(nodeStr);
					}
					$('#my-cart .menu').append('<p class="clear"><a href="'+url+'">查看我的购物车</a></p>');
				}
			}
		})
	},function(){
		t=setTimeout(function(){
			requestFlag = true;
		},8000)
		$(this).find('.menu').hide();
	})
	$('#my-cart .delCart').live('click',function(){
		var url = $(this).attr('url');
		var self = this;
		$.ajax({
			url:url,
			dataType:'json',
			success:function(result){
				if(result.status === true){
					$(self).parents('li').remove();
				}else{
					alert('删除失败')
				}
			}
		})
	})
})




