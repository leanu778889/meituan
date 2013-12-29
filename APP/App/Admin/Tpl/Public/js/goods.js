$(function(){
	$("#goodsFrom").validation({
			main_title: {
				rule: {
					maxlen: 30,
 					required: true
 				},
 				error: {
 					maxlen: " 不能大于 30 个字符 ",
 					required: " 不能为空 "
				},
				message: " 商品主标题长度 1 到 30 位 ",
				success: " 商品主标题正确 "
			 },
			 sub_title: {
				rule: {
					maxlen: 100,
 					required: true
 				},
 				error: {
 					maxlen: " 不能大于 100 个字符 ",
 					required: " 不能为空 "
				},
				message: " 商品副标题长度 1 到 100 位 ",
				success: " 商品副标题正确 "
			 },
			 price: {
				rule: {
					num: "1,100000",
 					required: true
 				},
 				error: {
 					num: " 商品价格不再范围内 ",
 					required: " 不能为空 "
				},
				message: " 商品价格为1-100000的数字",
				success: " 商品价格正确 "
			 },
			 old_price: {
				rule: {
					num: "1,100000",
 					required: true
 				},
 				error: {
 					num: " 商品价格不再范围内 ",
 					required: " 不能为空 "
				},
				message: " 商品价格为1-100000的数字 ",
				success: " 商品价格正确 "
			 }
 	})
 	var dateFormat = {
 		dateFormat: "yy-mm-dd",
 		monthNames: [ " 一月 ", " 二月 ", " 三月 ", " 四月 ", " 五月 ", " 六月 ", " 七月 "," 八月 ", " 九月 ", " 十月 ", " 十一月 ", " 十二月 " ],
 		dayNamesMin: [ " 日 ", " 一 ", " 二 ", " 三 ", " 四 ", " 五 ", " 六 " ]
 	};
  	// 为 ID 为 begin_time 的 input 设置日历
 	$("#begin_time").datepicker(dateFormat);
 	$("#end_time").datepicker(dateFormat);
})