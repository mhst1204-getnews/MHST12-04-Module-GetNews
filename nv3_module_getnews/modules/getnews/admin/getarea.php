<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate Mon, 23 Jul 2012 02:56:18 GMT
 */

 
if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );
include(NV_ROOTDIR."/modules/".$module_name."/admin/Library/Loc_Noi_Dung.php");
$my_head.="<link type=\"text/css\" href=\"/nukeviet/modules/getnews/css/chose-area.css\" rel=\"Stylesheet\">";
$link=$_GET['link'];
if($link!="" && $link!=null && nv_is_url ( $link ))
{
    $error="";
    $noidung=GetArea::GetContent($link);
    if($noidung!="" && !is_null($noidung))
    {
        $my_head.="<script type=\"text/javascript\" src=\"".NV_BASE_SITEURL."modules/".$module_name."/js/chose-area.js"."\"></script>";
        $xtpl = new XTemplate( "area.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
        $xtpl->assign( 'LANG', $lang_module );
        $xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
        $xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
        $xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
        $xtpl->assign( 'MODULE_NAME', $module_name );
        $xtpl->assign( 'OP', $op );
        
        $xtpl->assign('noidung',$noidung['noidung']);
       // $xtpl->assign('xpath',$noidung['xpath']);
        $xtpl->assign('site',$link);
        $xtpl->parse('main.receive');
        $xtpl->parse( 'main' );
        $page_title = $lang_module['config'];
        $contents=$xtpl->text('main');
    }
    else
    {
       $contents="LOI";
    }
}

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );
 ?>