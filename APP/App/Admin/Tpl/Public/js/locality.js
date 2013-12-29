$(function(){
	$("#localityFrom").validation({
			lname: {
				rule: {
					maxlen: 12,
 					required: true
 				},
 				error: {
 					maxlen: " 不能大于 12 个字符 ",
 					required: " 不能为空 "
				},
				message: " 地区名长度 1 到 12 位 ",
				success: " 地区名正确 "
			 },
			sort: {
				rule: {
					num: '1,99',
 					required: true
 				},
 				error: {
 					num: " 不能大于 99 ",
 					required: " 不能为空 "
				},
				message: " 请输入 1-99 范围以内的数字 ",
				success: " 地区排序正确 "
			 }
 	})
})