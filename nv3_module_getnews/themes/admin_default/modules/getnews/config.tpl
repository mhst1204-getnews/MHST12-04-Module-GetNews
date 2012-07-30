<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="quote" style="width:780px;">
    <blockquote class="error"><span>{ERROR}</span></blockquote>
</div>
<div class="clear"></div>
<!-- END: error -->

<!-- BEGIN: sendLink -->
<form enctype="multipart/form-data" action="{NV_BASE_SITEURL}admin/index.php?nv=getnews&op=getcontent" method="post">
	<table summary="" class="tab1">
		<caption>{LANG.config_auto_article}</caption>
		<tbody>
			<tr>
				<td align="right"><strong>{LANG.link_article}: </strong></td>
				<td><input style="width: 550px" name="link_article" id="link_article" type="text" value="" maxlength="255" /></td>
                <td>
                    <input name="submit" type="submit" id="getLink" value="{LANG.autoconfig}" />
                    <input  name="config" type="button" id="config" value="{LANG.choseconfig}"/>    
                </td>
			</tr>
		</tbody>
	</table>
	<br /><center></center>
</form>
<!-- END: sendLink -->

<script type="text/javascript">
    $(document).ready(function(){
        $("#config").click(function(){
            var link=$("#link_article").val();
            window.location.href= nv_siteroot+"admin/index.php?"+nv_name_variable+"="+nv_module_name+"&"+nv_fc_variable+"=getarea&link="+link;
        })
    })
</script>
 <!--END: main -->
