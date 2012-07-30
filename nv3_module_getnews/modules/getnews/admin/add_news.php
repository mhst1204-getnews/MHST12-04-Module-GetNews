<?php

if(!defined('NV_IS_FILE_ADMIN'))die('Stop!!!');
if(defined('NV_EDITOR')){require_once(NV_ROOTDIR.'/'.NV_EDITORSDIR.'/'.NV_EDITOR.'/nv.php');}

$id=0;
if(isset($_GET['id'])){$id=$_GET['id'];}
if($id>0)
{
    $xtpl = new XTemplate( "content.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
    $xtpl->assign( 'LANG', $lang_module );
    $xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
    $xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
    $xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
    $xtpl->assign( 'MODULE_NAME', $module_name );
    $xtpl->assign( 'OP', $op );
    
    
    
    $sql="select nv3_vi_news_rows.title as tieude,alias,catid,homeimgthumb,homeimgalt,hometext,bodyhtml,author,nv3_vi_news_sources.title from nv3_vi_news_sources,nv3_vi_news_rows,nv3_vi_news_bodyhtml_1 where nv3_vi_news_sources.sourceid=nv3_vi_news_rows.sourceid and nv3_vi_news_bodyhtml_1.id=nv3_vi_news_rows.id and nv3_vi_news_rows.id='".$id."'";
    $temp=$db->sql_query($sql);
    while($rowcontent=$db->sql_fetchrow($temp))
    {
        $xtpl->assign('rowcontent',$rowcontent);
        if(defined('NV_EDITOR')and nv_function_exists('nv_aleditor'))
        {
            $edits = nv_aleditor( 'bodytext', '100%', '300px',$rowcontent['bodyhtml']);
        }
        else
        {
            $edits="<textarea style=\"width: 100%\" name=\"bodytext\" id=\"bodyhtml\" cols=\"20\" rows=\"15\"></textarea>";
        }
        $xtpl->assign('edit_bodytext',$edits);
        $xtpl->parse('main.status');
        $xtpl->parse('main');
    }
    $contents=$xtpl->text('main');
}
else
{
    $xtpl = new XTemplate( "content.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
    $xtpl->assign( 'LANG', $lang_module );
    $xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
    $xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
    $xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
    $xtpl->assign( 'MODULE_NAME', $module_name );
    $xtpl->assign( 'OP', $op );
    
    if(defined('NV_EDITOR')and nv_function_exists('nv_aleditor'))
    {
        $edits = nv_aleditor( 'bodytext', '100%', '300px',"");
    }
    else
    {
        $edits="<textarea style=\"width: 100%\" name=\"bodytext\" id=\"bodyhtml\" cols=\"20\" rows=\"15\"></textarea>";
    }
    $xtpl->assign('edit_bodytext',$edits);
    $xtpl->parse('main.status0');
    $xtpl->parse('main');
    $contents=$xtpl->text('main');
}

include(NV_ROOTDIR."/includes/header.php");echo nv_admin_theme($contents);include(NV_ROOTDIR."/includes/footer.php"); ?>
?>