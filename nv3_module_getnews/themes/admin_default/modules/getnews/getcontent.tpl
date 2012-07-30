<!-- BEGIN: main -->

<!-- BEGIN: error -->
<div class="quote" style="width:780px;">
    <blockquote class="error"><span>{ERROR}</span></blockquote>
</div>
<div class="clear"></div>
<!-- END: error -->

<form enctype="multipart/form-data" action="" method="post">
	<table summary="" class="tab1">
		<caption>{LANG.config_auto_receive_article}</caption>
		<tbody>
			<tr>
				<td align="right"><strong>{LANG.title}: </strong></td>
				<td><input style="width: 650px" name="title" type="text" value="{DATA.tieude}" maxlength="255" /></td>
			</tr>
            <tr>
                <td align="right"><strong>{LANG.head}</strong></td>
                <td>
                    <textarea name="head" rows="5" cols="75" style="font-size:12px; width: 98%; height:100px;">{DATA.mota}</textarea>
                </td>
            </tr>
            <tr>
                <td align="right" style="width:60px;"><strong>{LANG.content}</strong></td>
                <td>
                    
                    <div style="padding:2px; background:#CCCCCC; margin:0; display:block; position:relative; width:98%;">
						{edit_bodytext}
					</div>
                </td>
            </tr>
		</tbody>
	</table>
	<br />
    <div align="center">
    <input  type="hidden" value="{DATA.titlepath}" name="titlepath" id="titlepath"/>
    <input  type="hidden" value="{DATA.headpath}" name="headpath" id="headpath"/>
    <input  type="hidden" value="{DATA.contentpath}" name="contentpath" id="contentpath"/>
    <input  type="hidden" value="{site}" name="site" id="site"/>
    <input name="saveConfig" id="saveConfig" type="button" value="{LANG.saveconfig}" />
    <input name="redirect" type="submit" value="{LANG.redirect}" />
    <input name="exit" type="button" value="{LANG.exitconfig}" onclick="javascript:history.go(-1)" />
    </div>
</form>

<script type="text/javascript">
    
    

    $(document).ready(function(){
        
        
        
        $("#saveConfig").click(function(){
            var titlepath=$("#titlepath").val();
            var headpath=$("#headpath").val();
            var contentpath=$("#contentpath").val();
            var site=$("#site").val();
            $.ajax(
                {
                    type : 'POST',
                    url : nv_siteroot+"admin/index.php?"+nv_name_variable+"="+nv_module_name+"&"+nv_fc_variable+"=saveconfig",
                    data : 'tpath='+titlepath.substring(0,titlepath.length -1)+'&hpath='+headpath.substring(0,headpath.length -1)+'&cpath='+contentpath.substring(0,contentpath.length -1)+'&site='+site,
                    success : function(data)
                    {
                        var getData = $.parseJSON(data);
                        alert(getData);
                    }
                });
            
        })
    })
    
    
</script>
<!--END: main -->