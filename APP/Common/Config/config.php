<?php
if (!defined("HDPHP_PATH"))exit('No direct script access allowed');
//更多配置请查看hdphp/Config/config.php
return array(
/********************************数据库********************************/
    "DB_DRIVER"                     => "mysqli",    //数据库驱动
    "DB_HOST"                       => "127.0.0.1", //数据库连接主机  如127.0.0.1
    "DB_PORT"                       => 3306,        //数据库连接端口
    "DB_USER"                       => "root",      //数据库用户名
    "DB_PASSWORD"                   => "123456",          //数据库密码
    "DB_DATABASE"                   => "meituan",          //数据库名称
    "DB_PREFIX"                     => "group_",          //表前缀
//    "DB_FIELD_CACHE"                => 1,           //字段缓存  新版将废弃
    "DB_BACKUP"                     => ROOT_PATH . "backup/".time(), //数据库备份目录

 /*****************************商品服务***********************************/
 	"GOODS_SERVER"					=>array(
 			1=>array(
 				'name'=>'假一赔十',
 				'img'=>'<span class="ico" style="background-position:0 -92px;"></span>'
 			),
 			2=>array(
 				'name'=>'支持随时退款',
 				'img'=>'<span class="ico" style="background-position:0 0;"></span>'
 			),
 			3=>array(
 				'name'=>'7天无理由退换货',
 				'img'=>'<span class="ico" style="background-position:0 -62px;"></span>'
 			),
 			4=>array(
 				'name'=>'不支持随时退款',
 				'img'=>'<span class="ico" style="background-position:0 -121px;"></span>'
 			),
 			5=>array(
 				'name'=>'不支持7天无理由退换货',
 				'img'=>'<span class="ico" style="background-position:0 -182px;"></span>'
 			),
 	),
 	/**************************上传路径**********************************/
 	 "UPLOAD_PATH"                   => ROOT_PATH . "/upload/".date('Y-m',time()), //上传路径
 	/**************************价格区间设置*********************************/
 	'PRICE'=>array(
		'ALL'=>array(
			array('100元以下','0-100'),
			array('100元到200元','100-200'),
			array('200元到500元','200-500'),
			array('500元以上','500'),
		),
		'1'=>array(
			array('50元以下','0-50'),
			array('50元到100元','50-100'),
			array('100元到200元','100-200'),
			array('200元以上','200'),
		),
		'6'=>array(
			array('50元以下','0-50'),
			array('50元到100元','50-100'),
			array('100元到200元','100-200'),
			array('200元以上','200'),
		),
		'7'=>array(
			array('50元以下','0-50'),
			array('50元到100元','50-100'),
			array('100元到200元','100-200'),
			array('200元以上','200'),
		),
		'8'=>array(
			array('50元以下','0-50'),
			array('50元到100元','50-100'),
			array('100元到200元','100-200'),
			array('200元以上','200'),
		),
		'9'=>array(
			array('50元以下','0-50'),
			array('50元到100元','50-100'),
			array('100元到200元','100-200'),
			array('200元以上','200'),
		),
	),
	/**********************RABC******************************/
	"RBAC_AUTH_KEY"                 => "uid",      //用户SESSION名
	"COOKIE_LIFT_TIME"=>864000,
);
?>