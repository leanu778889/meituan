<?php if(!defined('HDPHP_PATH'))exit;
return array (
  'gid' => 
  array (
    'field' => 'gid',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => true,
    'default' => NULL,
    'extra' => 'auto_increment',
  ),
  'shopid' => 
  array (
    'field' => 'shopid',
    'type' => 'smallint(5) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'cid' => 
  array (
    'field' => 'cid',
    'type' => 'smallint(5) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'lid' => 
  array (
    'field' => 'lid',
    'type' => 'smallint(5) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'main_title' => 
  array (
    'field' => 'main_title',
    'type' => 'varchar(30)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'sub_title' => 
  array (
    'field' => 'sub_title',
    'type' => 'varchar(255)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'price' => 
  array (
    'field' => 'price',
    'type' => 'decimal(7,1)',
    'null' => 'NO',
    'key' => false,
    'default' => '0.0',
    'extra' => '',
  ),
  'old_price' => 
  array (
    'field' => 'old_price',
    'type' => 'decimal(7,1)',
    'null' => 'NO',
    'key' => false,
    'default' => '0.0',
    'extra' => '',
  ),
  'buy' => 
  array (
    'field' => 'buy',
    'type' => 'smallint(6)',
    'null' => 'NO',
    'key' => false,
    'default' => '0',
    'extra' => '',
  ),
  'goods_img' => 
  array (
    'field' => 'goods_img',
    'type' => 'varchar(60)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'end_time' => 
  array (
    'field' => 'end_time',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'begin_time' => 
  array (
    'field' => 'begin_time',
    'type' => 'int(10) unsigned',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
);
?>