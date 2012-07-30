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
				<td><input style="width: 750px" name="link_article" id="link_article" type="text" value="" maxlength="255" /></td>
                <td><input name="submit" type="submit" id="getLink" value="{LANG.save}" /></td>
			</tr>
		</tbody>
	</table>
	<br /><center></center>
</form>
<!-- END: sendLink -->
<!--
<form enctype="multipart/form-data" action="" method="post">
	<table summary="" class="tab1">
		<caption>{LANG.config_auto_receive_article}</caption>
		<tbody>
			<tr>
				<td align="right"><strong>{LANG.title}: </strong></td>
				<td><input style="width: 650px" name="title" type="text" value="{DATA.title}" maxlength="255" /></td>
			</tr>
            <tr>
                <td align="right"><strong>{LANG.head}</strong></td>
                <td>
                    <textarea name="head" rows="5" cols="75" style="font-size:12px; width: 98%; height:100px;">{DATA.head}</textarea>
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
    <input name="ok" type="submit" value="{LANG.saveconfig}" />
    <input name="redirect" type="submit" value="{LANG.redirect}" />
    <input name="exit" type="submit" value="{LANG.exitconfig}" />
    </div>
</form>
-->
<!-- BEGIN: receiveContent -->

<!-- END: receiveContent -->
<!--


 <!--END: main -->
