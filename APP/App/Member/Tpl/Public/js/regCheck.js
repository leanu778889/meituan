var checkForm={
	'email':{
		'preg':/^[a-z0-9\.]+@[a-z0-9]+\.[a-z]+$/i,
		'focus':'请输入邮箱！',
		'empty':'邮箱不能为空!',
		'error':'邮箱格式不正确!'
	},
	'uname':{
		'preg':/^[a-z]\w{5,15}$/i,
		'focus':'请输入用户名！',
		'empty':'用户名不能为空!',
		'error':'用户名格式不正确!'
	},
	'password':{
		'preg':/^\S{6,32}$/,
		'focus':'请输入密码！',
		'empty':'密码不能为空!',
		'error':'密码格式不正确!'
	},
	'password_d':{
		'focus':'请再次输入密码！',
		'empty':'密码不能为空!',
		'error':'密码不一致!'
	},
	'code':{
		'preg':/^[a-z0-9]{4}$/i,
		'focus':'请输入验证码！',
		'empty':'验证码不能为空!',
		'error':'验证码格式不正确!'
	},
}
$(function(){
	check();
	$('#regForm').submit(function(){
		for(var i=0;i<aEls.length;i++){
			if(aEls[i].status === false){
				return false;
			}
		}
	})

})
aEls=[];
function check(){
	var aMust = $('#regForm .must');
	aMust.each(function(){
		aEls.push(this);
		this.status = false;
	})
	for(var i=0;i<aEls.length;i++){
		aEls[i].onfocus = function(){
			var name = this.name;
			var msg = checkForm[name]['focus'];
			showFocus.call(this,msg);
			this.onblur=function(){
				var val = this.value;
				if(val ==''){
					var msg = checkForm[name]['empty'];
					showError.call(this,msg);
					return;
				}
				if(name =='password_d'){
					if($('#password').val() != val){
						var msg = checkForm[name]['error'];
						showError.call(this,msg);
						return;
					}
				}else{
					var preg = checkForm[name]['preg'];
					if(!preg.test(val)){
						var msg = checkForm[name]['error'];
						showError.call(this,msg);
						return;
					}
				}
				if($(this).attr('ajax') == 1){
					var url = __JSCONTROL__+'/check';
					var self =this;
					$.ajax({
						url:url,
						type:'POST',
						data:name+'='+val,
						dataType:'json',
						success:function(result){
							if(result.status === true){
								showSuccess.call(self,'');
							}else{
								showError.call(self,result.msg);
							}
						}
					})
				}else{
					showSuccess.call(this,'');
				}
			}
		}
	}
}
function showSuccess(msg){
	var parent = $(this).parents('dl');
	var oPrompt = parent.find('.prompt');
	parent.attr('class','success');
	oPrompt.html(msg);
	this.status=true;
}
function showError(msg){
	var parent = $(this).parents('dl');
	var oPrompt = parent.find('.prompt');
	parent.attr('class','error');
	oPrompt.html(msg);
	this.status=false;
}
function showFocus(msg){
	var parent = $(this).parents('dl');
	var oPrompt = parent.find('.prompt');
	parent.attr('class','focus');
	oPrompt.html(msg);
}