<?php

/**
 * @Project NUKEVIET 3.4
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 - 2012 VINADES.,JSC. All rights reserved
 * @Createdate Sun, 08 Apr 2012 00:00:00 GMT GMT
 */

if(!defined('NV_IS_FILE_MODULES'))die('Stop!!!');

$sql_drop_module=array();
$sql_drop_module[]='DROP TABLE IF EXISTS `nv_xpath_new`';

$sql_create_module=$sql_drop_module;
$sql_create_module[]='CREATE TABLE IF NOT EXISTS `nv_xpath_new` (
                      `site` varchar(100) NOT NULL,
                      `title` varchar(20) NOT NULL,
                      `head` varchar(20) NOT NULL,
                      `content` varchar(20) NOT NULL,
                      PRIMARY KEY  (`site`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;';

?>