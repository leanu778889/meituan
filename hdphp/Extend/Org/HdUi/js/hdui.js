// ====================================================================================
// ===================================--|函数库|--======================================
// ====================================================================================
// .-----------------------------------------------------------------------------------
// |  Software: [HDJS framework]
// |   Version: 2013.08
// |      Site: http://www.hdphp.com
// |-----------------------------------------------------------------------------------
// |    Author: 后盾网向军 <houdunwangxj@gmail.com>
// | Copyright (c) 2012-2013, http://www.houdunwang.com. All Rights Reserved.
// |-----------------------------------------------------------------------------------
// |   License: http://www.apache.org/licenses/LICENSE-2.0
// '-----------------------------------------------------------------------------------
//去除超链接虚线
$(function () {
    $("a").click(function () {
        $(this).trigger("blur")
    });
})
/**
 * 获得对象在页面中心的位置
 * @author hdxj
 * @category functions
 * @param obj 对象
 * @returns {Array} 坐标
 */
function center_pos(obj) {
    var pos = [];//位置
    pos[0] = ($(window).width() - obj.width()) / 2
    pos[1] = $(window).scrollTop() + ($(window).height() - obj.height()) / 2
    return pos
}
// ====================================================================================
// =====================================--|UI|--=======================================
// ====================================================================================
// .-----------------------------------------------------------------------------------
// |  Software: [HDJS framework]
// |   Version: 2013.08
// |      Site: http://www.hdphp.com
// |-----------------------------------------------------------------------------------
// |    Author: 向军 <houdunwangxj@gmail.com>
// | Copyright (c) 2012-2013, http://www.houdunwang.com. All Rights Reserved.
// |-----------------------------------------------------------------------------------
// |   License: http://www.apache.org/licenses/LICENSE-2.0
// '-----------------------------------------------------------------------------------
/**
 * tab面板使用
 * @author hdxj
 * @category ui
 */
$(function () {
    //首页加载显示第一1个
    $("div.tab ul.tab_menu li:eq(0) a").addClass("action");
    $("div.tab div.tab_content div:eq(0)").addClass("action");
    //点击切换
    $("div.tab ul.tab_menu li").click(function () {
        //改变标题
        $("div.tab ul.tab_menu li a").removeClass("action");
        $("a", this).addClass("action");
        var _id = $(this).attr("lab");
        $("div.tab_content div").removeClass("action");
        $("div.tab_content div#" + _id).addClass("action");
    })
})
/**
 * dialog对话框
 */
$.extend({
    "dialog": function (options) {
        var _default = {
            "type": "success"//类型 CSS样式
            , "msg": "操作成功"//提示信息
            , "timeout": 3//自动关闭时间
            , "close_handler": function () {
            }//关闭时的回调函数
        };
        var opt = $.extend(_default, options);
        //创建元素
        if ($("div.dialog").length == 0) {
            var div = '';
            div += '<div class="dialog">';
            div += '<div class="close">';
            div += '<a href="#" title="关闭">X</a></div>';
            div += '<h2>提示信息</h2>';
            div += '<div class="con ' + opt.type + '">';
            div += opt.msg;
            div += '</div>';
            div += '</div>';
            $(div).appendTo("body");
        }
        $("div.dialog").show();
        var pos = center_pos($(".dialog"));
        $("div.dialog").css({left: pos[0], top: pos[1] - 50});
        //点击关闭dialog
        $("div.dialog div.close a").click(function () {
            $("div.dialog").fadeOut();
            opt.close_handler();
        })
        //自动关闭
        setTimeout(function () {
            $("div.dialog").fadeOut();
            opt.close_handler();
        }, opt.timeout * 1000);
    }
})
/**
 * 模态对话框
 * @category ui
 */
$.extend({
    "modal": function (options) {
        var _default = {
            content: '', width: 650, height: 400, button: true
        };
        var opt = $.extend(_default, options);

        if ($("div.modal").length == 0) {
            var div = '';
            div += '<div class="modal" style="width:' + opt['width'] + 'px;height:' + opt['height'] + 'px">';
            div += '<div class="content" style="height:' + (opt['height'] - (opt.button ? 62 : 0)) + 'px;">';
            div += opt.content;
            div += '</div>';
            if (opt.button) {
                div += '<div class="modal_footer">';
                div += '<a href="javascript:;" class="btn">关闭</a>';
                div += '</div>';
            }
            div += '</div>';
            $(div).appendTo("body");
        }
        var pos = center_pos($(".modal"));
        $("div.modal").css({left: pos[0], top: pos[1] - 50});
        //点击关闭modal
        $("div.modal_footer a.btn").click(function () {
            $("div.modal").fadeOut();
        })
    }
});
// ====================================================================================
// ===================================--|表单验证|--=====================================
// ====================================================================================
// .-----------------------------------------------------------------------------------
// |  Software: [HDJS framework]
// |   Version: 2013.08
// |      Site: http://www.hdphp.com
// |-----------------------------------------------------------------------------------
// |    Author: 后盾网向军 <houdunwangxj@gmail.com>
// | Copyright (c) 2012-2013, http://www.houdunwang.com. All Rights Reserved.
// |-----------------------------------------------------------------------------------
// |   License: http://www.apache.org/licenses/LICENSE-2.0
// '-----------------------------------------------------------------------------------
/**
 * 表单验证
 * @category validation
 */
$.fn.extend({
    validation: function (options) {
        //验证规则
        var method = {
            "ajax": function (data) {
                var stat = true;
                //内容不为空时验证
                if (data.obj.val()) {
                    //默认为失败，Ajax后再处理
                    data.obj.attr("ajax_validation", 0);
                    //清除提示信息span
                    data.spanObj.removeClass("success").removeClass("error").html("");
                    var stat = true;
                    //内容不为空时验证
                    if (data.obj.val()) {
                        var url = options[data.name].rule["ajax"];//异步请求的url
                        var name = data.name;
                        form_obj = $(data.obj.parents("form"));
                        var param = {};
                        param[name] = data.obj.val();
                        //发送异步
                        $.post(url, param, function (result) {
                            //成功时，如果是提交暂停状态则再次提交
                            if (result == 1) {
                                //移除表单属性ajax_validation
                                data.obj.removeAttr("ajax_validation");
                                //验证结果处理，提示信息等
                                method.call_handler(1, data);
                                //如果是通过submit调用，则提交
                                if (data.send) {
                                    form_obj.trigger("submit", ['send']);
                                }
                            } else {
                                method.call_handler(0, data);
                            }
                        });
                        //验证结果处理，提示信息等
                    }
                }
                return stat;
            },
            //比较两个表单
            "confirm": function (data) {
                var stat = true;
                //内容不为空时验证
                if (data.obj.val()) {
                    //比较表单内容是否相等
                    stat = data.obj.val() == $("[name='" + options[data.name].rule["confirm"] + "']").val();
                    //验证结果处理，提示信息等
                    method.call_handler(stat, data);
                }
                return stat;
            },
            //数字
            "num": function (data) {
                var stat = true;
                //内容不为空时验证
                if (data.obj.val()) {
                    var opt = options[data.name].rule["num"].split(/\s*,\s*/);
                    var val = data.obj.val() * 1;
                    //验证表单
                    stat = val >= opt[0] * 1 && val <= opt[1] * 1;
                    //验证结果处理，提示信息等
                    method.call_handler(stat, data);
                }
                return stat;
            },
            //验证手机
            "phone": function (data) {
                var stat = true;
                //内容不为空时验证
                if (data.obj.val()) {
                    //验证表单
                    stat = /^\d{11}$/.test(data.obj.val());
                    //验证结果处理，提示信息等
                    method.call_handler(stat, data);
                }
                return stat;
            },
            //QQ号
            "qq": function (data) {
                var stat = true;
                //内容不为空时验证
                if (data.obj.val()) {
                    //验证表单
                    stat = /^\d{5,10}$/.test(data.obj.val());
                    //验证结果处理，提示信息等
                    method.call_handler(stat, data);
                }
                return stat;
            },
            //验证固定电话
            "tel": function (data) {
                var stat = true;
                //内容不为空时验证
                if (data.obj.val()) {
                    //验证表单
                    stat = /(?:\(\d{3,4}\)|\d{3,4}-?)\d{8}/.test(data.obj.val());
                    //验证结果处理，提示信息等
                    method.call_handler(stat, data);
                }
                return stat;
            },
            //验证身份证
            "identity": function (data) {
                var stat = true;
                //内容不为空时验证
                if (data.obj.val()) {
                    //验证表单
                    stat = /^(\d{15}|\d{18})$/.test(data.obj.val());
                    //验证结果处理，提示信息等
                    method.call_handler(stat, data);
                }
                return stat;
            },
            //网址
            "http": function (data) {
                var stat = true;
                //内容不为空时验证
                if (data.obj.val()) {
                    //验证表单
                    stat = /^(http[s]?:)?(\/{2})?([a-z0-9]+\.)?[a-z0-9]+(\.(com|cn|cc|org|net|com.cn))$/i.test(data.obj.val());
                    //验证结果处理，提示信息等
                    method.call_handler(stat, data);
                }
                return stat;
            },
            //中文
            "china": function (data) {
                var stat = true;
                //内容不为空时验证
                if (data.obj.val()) {
                    //验证表单
                    stat = /^[^u4e00-u9fa5]+$/i.test(data.obj.val());
                    //验证结果处理，提示信息等
                    method.call_handler(stat, data);
                }
                return stat;
            },
            //最小长度
            "minlen": function (data) {
                var stat = true;
                //内容不为空时验证
                if (data.obj.val()) {
                    //验证表单
                    stat = data.obj.val().length >= options[data.name].rule["minlen"];
                    //验证结果处理，提示信息等
                    method.call_handler(stat, data);
                }
                return stat;
            },
            //最大长度
            "maxlen": function (data) {
                var stat = true;
                //内容不为空时验证
                if (data.obj.val()) {
                    //验证表单
                    stat = data.obj.val().length <= options[data.name].rule["maxlen"];
                    //验证结果处理，提示信息等
                    method.call_handler(stat, data);
                }
                return stat;
            },
            //正则验证处理
            "regexp": function (data) {
                var stat = true;
                if (data.obj.val()) {
                    //是否正则对象
                    if (options[data.name].rule["regexp"] instanceof  RegExp) {
                        //是否必须验证
                        var reg = options[data.name].rule["regexp"];
                        stat = reg.test(data.obj.val());
                        //验证结果处理，提示信息等
                        method.call_handler(stat, data);
                    }
                }
                return stat;
            },
            //验证邮箱
            "email": function (data) {
                var stat = true;
                //内容不为空时验证
                if (data.obj.val()) {
                    //验证表单
                    stat = /^([a-zA-Z0-9_\-\.])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/i.test(data.obj.val());
                    //验证结果处理，提示信息等
                    method.call_handler(stat, data);
                }
                return stat;
            },
            //验证用户名
            "user": function (data) {
                var stat = true;
                if (data.obj.val()) {
                    //user: "6,20"  opt为拆分"6,20"
                    var opt = options[data.name].rule["user"].split(/\s*,\s*/);
                    var reg = new RegExp("^[a-z]\\\w{" + (opt[0] - 1) + "," + (opt[1] - 1) + "}$", "i");
                    //验证表单
                    stat = reg.test(data.obj.val());
                    //验证结果处理，提示信息等
                    method.call_handler(stat, data);
                }
                return stat;
            },
            //验证表单是否必须添写
            "required": function (data) {
                var required = options[data.name].rule["required"];
                var stat = true;
                //是否必须验证
                if (required) {
                    //不为空
                    stat = $.trim(data.obj.val()) != "";
                    //验证结果处理，提示信息等
                    method.call_handler(stat, data);
                } else if (data.obj.val() == '') {//非必填项，当表单内容为空时，清除提示信息
                    var msg = options[name].message || "";
                    $(data.spanObj).removeClass("error").removeClass("success").html(msg);
                    data.obj.removeAttr("validation").removeAttr("ajax_validation");

                }
                return stat;
            },
            //调用事件处理程序
            call_handler: function (stat, data) {
                var name = data.name;//元素的ID值
                var obj = data.obj;//表单对象
                var rule = data.rule;//规则
                var spanObj = data.spanObj;//提示信息表单
                if (stat) {//验证通过
                    //添加表单属性validation
                    obj.removeAttr("validation");
                    //设置正确提示信息
                    var msg = (options[data.name].success && options[data.name].success) || "输入正确";
                    $(data.spanObj).removeClass("error").addClass("success").html(msg);
                } else {//验证失败
                    obj.attr("validation", 0);//添加表单属性validation
                    //设置错误提示信息
                    var msg = (options[data.name].error && options[data.name].error[data.rule]) || "输入错误";
                    $(data.spanObj).removeClass("success").addClass("error").html(msg);
                }
            },
            /**
             * 添加验证设置
             * @param name 表单名
             * @param spanObj 提示信息span
             */
            set: function (name, spanObj) {
                var obj = $("[name='" + name + "']");
                var nodeType = obj[0].nodeName;
                //事件处理类型
                var event = '';
                switch (nodeType) {
                    case "SELECT":
                    case "RADIO":
                    case "CHECKBOX":
                        event = "change";
                        break;
                    default:
                        event = "blur";
                }
                obj.bind(event, function (event, send) {
                    //没有设置required必须验证时，默认为不用验证
                    options[name].rule.required || (options[name].rule.required = false);
                    for (var rule in options[name].rule) {
                        //验证方法存在
                        if (method[rule]) {
                            /**
                             * 验证失败 终止验证
                             * 参数说明：
                             * name 表单name属性
                             * obj 表单对象
                             * rule 规则的具体值
                             * send 是否为submit激活的
                             */
                            if (!method[rule]({name: name, obj: obj, rule: rule, spanObj: spanObj, send: send}))break;
                        }
                    }
                });

            },
            /**
             * 设置默认提示信息
             * @param name 表单名
             * @param spanObj 提示信息span
             */
            setDefaultMessage: function (name, spanObj) {
                var defaultMessage = options[name].message;
                if (defaultMessage) {
                    spanObj.html(defaultMessage);
                }
            },
            //获得span提示信息表单
            getSpanElement: function (name) {
                var spanId = "hd_" + name;//span提示信息表单的id
                if ($("#" + spanId).length == 0) {
                    var fieldObj = $("*[name='" + name + "']");
                    $(fieldObj).after("<span id='" + spanId + "' class='validation'></span>");
                } else {//如果span已经存在，添加validation类
                    $("#" + spanId).removeClass("validation").addClass("validation");
                }
                return $("#" + spanId);
            }
        };
        //处理事件
        for (var name in options) {
            //表单对象存在
            if ($("[name='" + name + "']").length > 0) {
                //获得span提示信息表单
                spanObj = method.getSpanElement(name);
                //设置默认提示信息
                method.setDefaultMessage(name, spanObj);
                //验证表单规则
                method.set(name, spanObj);
            }
        }
        //处理form
        $(this).bind("submit", function (event, action) {
            //action 表示是否是onsubmit提交,
            //主要是异步验证时使用，异步时action为真
            if (action) {
                return true;
            }
            //触发所有表单验证
            $(this).find("[name]").trigger("blur", ["post"]);
            if ($(this).find("*[validation='0']").length > 0 || $("*[ajax_validation='0']").length > 0) {
                return false;
            }
            return true;
        })
    }
});



























