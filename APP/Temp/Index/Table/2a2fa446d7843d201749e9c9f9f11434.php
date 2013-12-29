<?php if(!defined('HDPHP_PATH'))exit;
return array (
  'goods_id' => 
  array (
    'field' => 'goods_id',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'detail' => 
  array (
    'field' => 'detail',
    'type' => 'text',
    'null' => 'YES',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'goods_server' => 
  array (
    'field' => 'goods_server',
    'type' => 'varchar(255)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
);
?>