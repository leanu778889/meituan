$(function(){
	$("#shopFrom").validation({
			shopname: {
				rule: {
					maxlen: 20,
 					required: true
 				},
 				error: {
 					maxlen: " 不能大于 20 个字符 ",
 					required: " 不能为空 "
				},
				message: " 商铺名长度 1 到 20 位 ",
				success: " 商铺名正确 "
			 },
			 shopaddress: {
				rule: {
					maxlen: 40,
 					required: true
 				},
 				error: {
 					maxlen: " 不能大于 40 个字符 ",
 					required: " 不能为空 "
				},
				message: " 商铺地址长度 1 到 40 位 ",
				success: " 商铺地址正确 "
			 },
			 metroaddress: {
				rule: {
					maxlen: 40,
 					required: true
 				},
 				error: {
 					maxlen: " 不能大于 40 个字符 ",
 					required: " 不能为空 "
				},
				message: " 地铁地址长度 1 到 40 位 ",
				success: " 地铁地址正确 "
			 },
			 shoptel: {
				rule: {
					tel: true,
 					required: true
 				},
 				error: {
 					tel: " 电话不符合规则 ",
 					required: " 不能为空 "
				},
				message: " 请填写一个固定电话 ",
				success: " 固定电话填写正确 "
			 }
 	})
	$('#getAddBtn').click(function(){
		if($('#shopcoord').val()==''){
			alert('请填写地址')
		}else{
			getAddress($('#shopcoord').val());
		}
	})
	function getAddress(addresss){
		var myGeo = new BMap.Geocoder();
		// 将地址解析结果显示在地图上,并调整地图视野
		myGeo.getPoint(addresss, function(point){
			$('#shopcoord').val(JSON.stringify(point));
		}, "北京市");
	}
})