$(function(){
	$("#categoryFrom").validation({
			cname: {
				rule: {
					maxlen: 12,
 					required: true
 				},
 				error: {
 					maxlen: " 不能大于 12 个字符 ",
 					required: " 不能为空 "
				},
				message: " 分类名长度 1 到 12 位 ",
				success: " 分类名正确 "
			 },
			title: {
				rule: {
					maxlen: 60,
 					required: true
 				},
 				error: {
 					maxlen: " 不能大于 60 个字符 ",
 					required: " 不能为空 "
				},
				message: " 分类标题长度 1 到 60 位 ",
				success: " 分类标题正确 "
			 },
			keywords: {
				rule: {
					maxlen: 80,
 					required: true
 				},
 				error: {
 					maxlen: " 不能大于 80 个字符 ",
 					required: " 不能为空 "
				},
				message: " 分类关键字长度 1 到 80 位 ",
				success: " 分类关键字正确 "
			 },
			description: {
				rule: {
					maxlen: 120,
 					required: true
 				},
 				error: {
 					maxlen: " 不能大于 120 个字符 ",
 					required: " 不能为空 "
				},
				message: " 分类描述长度 1 到 120 位 ",
				success: " 分类描述正确 "
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
				success: " 分类排序正确 "
			 }
 	})
})