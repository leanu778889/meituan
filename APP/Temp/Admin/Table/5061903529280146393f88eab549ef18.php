<?php if(!defined('HDPHP_PATH'))exit;
return array (
  'adminId' => 
  array (
    'field' => 'adminId',
    'type' => 'smallint(5) unsigned',
    'null' => 'NO',
    'key' => true,
    'default' => NULL,
    'extra' => 'auto_increment',
  ),
  'adminName' => 
  array (
    'field' => 'adminName',
    'type' => 'char(20)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'adminPass' => 
  array (
    'field' => 'adminPass',
    'type' => 'char(32)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
);
?>