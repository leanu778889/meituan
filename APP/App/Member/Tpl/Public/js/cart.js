$(function(){
	$('.reduceCart').click(function(){
		var oGoodsNum = $(this).parent().find('.goodsNum');
		var goodsNum = Number(oGoodsNum.val())-1;
		ajaxUpdateGoodsNum(goodsNum,oGoodsNum);
	})
	$('.addCart').click(function(){
		var oGoodsNum = $(this).parent().find('.goodsNum');
		var goodsNum = Number(oGoodsNum.val())+1;
		ajaxUpdateGoodsNum(goodsNum,oGoodsNum);
	})
	$('.cart-table .delCart').live('click',function(){
		var url = $(this).attr('url');
		var self = this;
		var total = 0;
		$.ajax({
			url:url,
			dataType:'json',
			success:function(result){
				if(result.status === true){
					$(self).parents('tr').remove();
				}else{
					alert('删除失败');
				}
				$('.xiaoji').each(function(){
					total +=Number($(this).text());
				})
				$('#total').html(total);
			}
		})
	})
})
function ajaxUpdateGoodsNum(goodsNum,oGoodsNum){
	if(goodsNum<=0) return false;
	var gid = oGoodsNum.attr('gid');
	var url = oGoodsNum.attr('url');
	var total = 0;
	$.ajax({
		url:url,
		type:"POST",
		data:"gid="+gid+"&num="+goodsNum,
		dataType:"JSON",
		success:function(result){
			if(result.status === true){
				oGoodsNum.val(result['num']);
				var parent = oGoodsNum.parents('tr')
				var price = Number(parent.find('.price').text());
				parent.find('.xiaoji').text(result['num']*price);
				$('.xiaoji').each(function(){
					total +=Number($(this).text());
				})
				$('#total').html(total);
			}
		}
	})
}