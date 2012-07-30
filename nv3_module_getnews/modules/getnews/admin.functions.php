<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate Mon, 23 Jul 2012 02:56:18 GMT
 */

if ( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) ) die( 'Stop!!!' );

$submenu['main'] = $lang_module['main'];
$submenu['add_news'] = $lang_module['addnews'];
$submenu['config'] = $lang_module['config'];
$allow_func = array( 'main', 'config','getcontent','saveconfig','getarea','add_news');

define( 'NV_IS_FILE_ADMIN', true );

?>