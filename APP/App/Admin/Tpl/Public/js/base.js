/*******
 * 基础样式扩展
 */
(function($){
	$.fn.extend({
		setOrderByStyle:function(){
			$(this).find('a').addClass('btn btn-large btn-mini');
			$(this).find('.active').addClass('btn-primary disabled');
		},
		setPageStyle1:function(){
			var nodeStr = '';
			nodeStr +='<div class="pagination" style="margin:0px;">';
			nodeStr +='<ul>';
			$(this).children().each(function(){
				var html = $(this).html();
				switch(this.nodeName){
					case 'SPAN':
						if(this.className !='colse'){
						//	nodeStr += '<span>'+html+'</span>';
						}
					break;
					case 'A':
						var href = $(this).attr('href');
						nodeStr +='<li><a href="'+href+'">'+html+'</a></li>';
					break;
					
					case 'STRONG':
						nodeStr +='<li class="active disabled"><a  href="'+href+'">'+html+'</a></li>';
					break;	
				}
				
			})
			nodeStr +='</ul>';
			nodeStr +='</div>';
			$(this).html(nodeStr);
		}
	})
})(jQuery)




$(function(){
	$('.orderBy').setOrderByStyle();
	$('.pageStyle1').setPageStyle1();
})

/******  删除确认  *******/
$('.delAffirm').click(function(){
	if(!confirm('你确定要删除吗?')){
		return false;
	}
})
/******  层级显示切换   ******/
$(function(){
	var aTr = $('#table tbody tr');
	var aUnfold = $('#table tbody tr .unfold');
	aTr.each(function(){
		var level = getLevel($(this));
		if(level>1){
			$(this).addClass('hide');
		}
	})
	/**
	 * @param jqObj  jquery对象
	 */
	function getLevel(jqObj){
		//取得class名称
		var sClass = jqObj.attr('class');
		//查询等级的正则
		var preg = /\d+/;
		//查询tr等级
		var level = sClass.match(preg);
		return level;
	}
	/**** 切换层级显示隐藏  ****/
	aUnfold.click(function(){
		//收起子分类
		if($(this).html() == '-'){
			//获取子分类tr对象
			var aSonList = getSonList.call(this);
			//当前分类的tr对象
			var oParentTr = $(this).parents('tr');
			//获取当前分类的子集
			var level = getLevel(oParentTr);
			//查询后面的所有同辈元素集合，并循环
			
			var aNextAllObj = [];
			//拷贝原生对象
			oParentTr.nextAll().each(function(){
				aNextAllObj.push(this);
			})
			
			for(var i=0;i<aNextAllObj.length;i++){
				//获取循环tr的level值
				 var nextLevel = getLevel($(aNextAllObj[i]));
				 //如果循环tr的level值大于了当前tr的level值，说明是当前的子集，全部隐藏
				 if(nextLevel >level){
					 $(aNextAllObj[i]).find('.unfold').html('+').addClass('btn-info');
					 $(aNextAllObj[i]).addClass('hide');
				 }else{
					break;
				 }
			}
			//改变当前为收起状态
			$(this).html('+').addClass('btn-info');
			aSonList.addClass('hide');
		}else{
			//展开当前的子类
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
		var aSon = $('#table tbody').find(sClass);
		return aSon;
	}
})
/*******
 * 读取cooke
 * @param {Object} name
 */
function getCookie(name){
    var arr = document.cookie.split('; ');
    var i = 0;
    for (i = 0; i < arr.length; i++) {
        var arr2 = arr[i].split('=');           
        if (arr2[0] == name) {
           return arr2[1];
        }
    }
    return '';
}
/**
 * 设置cookie
 * @param name
 * @param value
 * @returns
 */
function setCookie(name,value){
	document.cookie = name+"="+value+"; path=/";
}