<?php if(!defined('HDPHP_PATH'))exit;
return array (
  'shopid' => 
  array (
    'field' => 'shopid',
    'type' => 'smallint(5) unsigned',
    'null' => 'NO',
    'key' => true,
    'default' => NULL,
    'extra' => 'auto_increment',
  ),
  'shopname' => 
  array (
    'field' => 'shopname',
    'type' => 'varchar(30)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'shopaddress' => 
  array (
    'field' => 'shopaddress',
    'type' => 'varchar(120)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'metroaddress' => 
  array (
    'field' => 'metroaddress',
    'type' => 'varchar(120)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
  'shoptel' => 
  array (
    'field' => 'shoptel',
    'type' => 'char(12)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'shopcoord' => 
  array (
    'field' => 'shopcoord',
    'type' => 'varchar(60)',
    'null' => 'NO',
    'key' => false,
    'default' => '',
    'extra' => '',
  ),
);
?>