$(function(){
	var oGoodsNum = $('.goodsNum');
	$('.reduceBuy').click(function(){
		var goodsNum = Number(oGoodsNum.val())-1;
		ajaxUpdateGoodsNum(goodsNum,oGoodsNum);
	})
	$('.addBuy').click(function(){
		var goodsNum = Number(oGoodsNum.val())+1;
		ajaxUpdateGoodsNum(goodsNum,oGoodsNum);
	})
})
function ajaxUpdateGoodsNum(goodsNum,oGoodsNum){
	if(goodsNum<=0) return false;
	var total = 0;
	oGoodsNum.val(goodsNum);
	var price = Number($('#price').html());
	total = price*goodsNum;
	$('#total').html(total);

}