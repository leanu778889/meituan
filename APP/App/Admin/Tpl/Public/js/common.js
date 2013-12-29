$(function(){
	/******  删除确认  *******/
	$('.delAffirm').click(function(){
		if(!confirm('你确定要删除吗?')){
			return false;
		}
	})
	//分页按钮样式
	$('#page a').addClass('btn');
	$('#page strong').addClass('btn btn-info').css({marginRight:'5px'});
	/******  层级显示切换   ******/
	(function(){
		var aTr = $('#table tbody tr');
		var aUnfold = $('#table tbody tr .unfold');
		aTr.each(function(){
			var level = $(this).attr('level');
			if(level>1){
				$(this).addClass('hide');
			}
		})
		/**** 切换层级显示隐藏  ****/
		aUnfold.click(function(){
			if($(this).html() == '-'){
				var aSonList = getSonList.call(this);
				var oParentTr = $(this).parents('tr');
				var level = oParentTr.attr('level');
				var aNextAllObj = [];
				oParentTr.nextAll().each(function(){
					aNextAllObj.push(this);
				});
				for(var i=0;i<aNextAllObj.length;i++){
					var nextLevel = $(aNextAllObj[i]).attr('level');
					if(nextLevel >level){
						$(aNextAllObj[i]).find('.unfold').html('+').addClass('btn-info');
					    $(aNextAllObj[i]).addClass('hide');
					}else{
						break;
					}
				}
				$(this).html('+').addClass('btn-info');
			}else{
				var aSonList = getSonList.call(this);
				if(aSonList.size()){
					$(this).html('-').removeClass('btn-info');
					aSonList.removeClass('hide');
				}
			}
		})
		/**** 获取子集列表  ****/
		function getSonList(){
			var oParent = $(this).parents('tr');
			var pid = oParent.attr('cid');
			var sClass = '.pid_'+pid;
			return $('#table tbody').find(sClass);
		}
	}())
})
