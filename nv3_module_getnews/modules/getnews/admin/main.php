<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate Mon, 23 Jul 2012 02:56:18 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );
//$data[]=array("class"=>$class,"id"=>$id,"link"=>$link,"title"=>$title,"publtime"=>$publtime,"status"=>$status,"author"=>$author);
global $db;


$xtpl = new XTemplate( "main.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign('GLANG',$lang_global);
$xtpl->assign( 'OP', $op );

$sql="select id,title,publtime,status,author,alias from nv3_vi_news_rows limit 0,10";
$temp=$db->sql_query($sql);
while($row=$db->sql_fetchrow($temp))
{
    $row['publtime']=$publtime=nv_date("H:i d/m/y",$row['publtime']);
    $row['status']='1'?"Xuất bản":"Chờ đăng";
    $row['link']=NV_BASE_SITEURL."index.php/vi/news/Tin-tuc/".$row['alias']."-".$row['id']."/";
    $xtpl->assign('ROW',$row);
    $xtpl->parse('main.loop');
}


$xtpl->parse('main');
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['main'];
include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );

?>