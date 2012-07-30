<!-- BEGIN: main -->
<form name="block_list" action="">
	<table summary="" class="tab1">
		<thead>
			<tr>
				<td align="center"><input name="check_all[]" type="checkbox" value="yes" onclick="nv_checkAll(this.form, 'idcheck[]', 'check_all[]',this.checked);" /></td>
				<td><a href="{base_url_name}">{LANG.title}</a></td>
				<td align="center"><a href="{base_url_publtime}">{LANG.timepublish}</a></td>
				<td align="center">{LANG.status}</td>
				<td>{LANG.creator}</td>
				<td></td>
			</tr>
		</thead>
		<!-- BEGIN: loop -->
	   <tbody {ROW.class}>
			<tr align="center">
				<td align="center"><input type="checkbox" onclick="nv_UncheckAll(this.form, 'idcheck[]', 'check_all[]', this.checked);" value="{ROW.id}" name="idcheck[]" /></td>
				<td align="left"><a target="_blank" href="{ROW.link}">{ROW.title}</a></td>
				<td>{ROW.publtime}</td>
				<td>{ROW.status}</td>
				<td>{ROW.author}</td>
				<td class="center">
    				<span class="edit_icon"><a href="{ROW.url_edit}">{GLANG.edit}</a></span>
    				&nbsp;&nbsp;
    				<span class="delete_icon"><a href="javascript:void(0);" onclick="nv_module_del({ROW.id});">{GLANG.delete}</a></span>
                </td>
			</tr>
		</tbody>
		<!-- END: loop -->
		<!-- <tbody>
			<tr align="left" class="tfoot_box">
				<td colspan="7">
					<select name="action" id="action">
						<!-- BEGIN: action -->
						<option value="{ACTION.value}">{ACTION.title}</option>
						<!-- END: action 
					</select>
					<input type="button" onclick="nv_main_action(this.form, '{SITEKEY}', '{LANG.msgnocheck}')" value="{LANG.action}" />
				</td>
			</tr>
		</tbody>-->
	</table>
</form>
<!-- BEGIN: generate_page -->
<br />
<p align="center">{GENERATE_PAGE}</p>
<!-- END: generate_page -->
<!-- END: main -->