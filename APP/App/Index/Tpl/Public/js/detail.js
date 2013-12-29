$(function(){

	$('#addCart').click(function(){
		var url = $(this).attr('url');
		$.ajax({
			url:url,
			dataType:'json',
			success:function(result){
				if(result.status === true){
					showInfoWindow(cartSucc);
					$('#total').html(result.total);
				}else{
					alert('添加购物车失败！')
				}
			}
		})
	})

	$('#addCollect').click(function(){
		if(userIsLogin === false){
			alert('请先登录！');
			return false;
		}
		var url = $(this).attr('url');
		$.ajax({
			url:url,
			dataType:'json',
			success:function(result){
				if(result.status === true){
					showInfoWindow(collectSucc);
				}else{
					alert('添加收藏失败！')
				}
			}
		})

	})


})
/**
 * 显示信息提示框
 * @param html
 */
function showInfoWindow(html){
	$('#infoWindow').show().css({
		top:$(window).scrollTop()+Math.floor(($(window).height()-$('#infoWindow').innerHeight())/2)
	})
	$('#cover').show().css({
		width:$(window).width(),
		height:$(document).height(),
		position:'absolute',
		left:0,
		top:0,
		background:'#333',
		opacity:0.3,
		zIndex:10000
	})
	$('#infoWindow').html(html);
}
/**
 * 隐藏信息提示框
 */
function hideInfoWindow(){
	$('#infoWindow').hide();
	$('#cover').hide();
}