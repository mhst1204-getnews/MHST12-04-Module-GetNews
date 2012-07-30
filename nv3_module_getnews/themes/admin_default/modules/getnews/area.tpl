<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="quote" style="width:780px;">
    <blockquote class="error"><span>{ERROR}</span></blockquote>
</div>
<div class="clear"></div>
<!-- END: error -->

<div style="width:100%; height:400px; overflow: auto;" id="div_contents">
    {noidung}
</div>
<input  type="hidden" value="{xpath}" id="xpath" name="xpath"/>
<!-- BEGIN: receive -->
<form id="form1" action="" method="post">
    <table summary="" class="tab1">
		<caption>{LANG.config_receive_article}</caption>
		<tbody>
			<tr>
				<td align="right"><strong>{LANG.title}: </strong></td>
				<td><input style="width: 650px" name="title" type="text" value="" id="tieude" maxlength="255" /></td>
			</tr>
            <tr>
                <td align="right"><strong>{LANG.head}</strong></td>
                <td>
                    <input style="width: 650px" name="title" type="text" value="" id="mota" maxlength="255" />
                </td>
            </tr>
            <tr>
                <td align="right" style="width:60px;"><strong>{LANG.content}</strong></td>
                <td>
                    
                    <input style="width: 650px" name="title" type="text" value="" id="noidung" maxlength="255" />
                </td>
            </tr>
		</tbody>
	</table>
</form>
<!-- END: receive -->

<script type="text/javascript">
$(document).ready(function(){
    var arr=new Array("tieude","mota","noidung");var i=0;
    $("#div_contents").bind('mouseout mouseover',function(event){
      var $tgt = $(event.target);
      var $z=$tgt.nodeName;
      if (!$tgt.closest($z).length) {
          $tgt.toggleClass('outline-element');
      }
      else
      {
        $tgt.parent($z).toggleClass('outline-element');
      }
    }).click(function(event){
          $('#mark').removeAttr("id");
          $(event.target).attr("id", "mark");
          var a = $(event.target).attr("id");
          var b = getXPath(document.getElementById(a));
          $('#'+a).html("");
          $("#"+arr[i]).val(b);
          i=i+1;
          
    })
    
    function getXPath(node, path) {
      path = path || [];
      if (node.parentNode) {
          path = getXPath(node.parentNode, path);
      }

      if (node.previousSibling) {
          var count = 1;
          var sibling = node.previousSibling
          do {
              if (sibling.nodeType == 1 && sibling.nodeName == node.nodeName) { count++; }
              sibling = sibling.previousSibling;
          } while (sibling);
          if (count == 1) { count = null; }
      } else if (node.nextSibling) {
          var sibling = node.nextSibling;
          do {
              if (sibling.nodeType == 1 && sibling.nodeName == node.nodeName) {
                  var count = 1;
                  sibling = null;
              } else {
                  var count = null;
                  sibling = sibling.previousSibling;
              }
          } while (sibling);
      }

      if (node.nodeType == 1) {
          path.push(node.nodeName.toLowerCase() + (node.id ? "[@id='" + node.id + "']" : count > 0 ? "[" + count + "]" : ''));
      }
      return path;
  };
})
</script>
 <!--END: main -->