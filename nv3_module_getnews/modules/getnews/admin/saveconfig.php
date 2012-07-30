<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate Mon, 23 Jul 2012 02:56:18 GMT
 */

$mess="";
$title=$_POST['tpath'];
$head=$_POST['hpath'];
$content=$_POST['cpath'];
$site=$_POST['site'];
$temp=parse_url($site);
$site=$temp['host'];
if($title!="" && $head!="" && $content!="")
{
    $query="select title from nv_xpath_new where site='".$site."'";
    if($db->sql_numrows($db->sql_query($query))>0)
    {
        $update="update nv_xpath_new set title='".$title."',head='".$head."',content='".$content."' where site='".$site."'";
        $db->sql_query($update);
        if($db->sql_affectedrows()>0)
        {
            $mess.="Cập nhật dữ liệu thành công!";
        }
        else
        {
            $mess.="Có lỗi xảy ra1!!!";
        }
    }
    else
    {
        $insert="insert into nv_xpath_new(site,title,head,content) values('".$site."','".$title."','".$head."','".$content."')";
        $db->sql_query($insert);
        if($db->sql_affectedrows()>0)
        {
            $mess.="Thêm dữ liệu thành công!";
        }
        else
        {
            $mess.="Có lỗi xảy ra!!!";
        }
    }
}
echo json_encode($mess);
die;
 
 ?>