<script language="javascript">
function submitNewP(){
    loadContentPost("ajax.php?p=donewproject", $("#newproject").serialize());
};
$(document).ready(function() {

   $("input").bind("keydown", function(event) {
      // track enter key
      var keycode = (event.keyCode ? event.keyCode : (event.which ? event.which : event.charCode));
      if (keycode == 13) { // keycode for enter key
         // force the 'Enter Key' to implicitly click the Update button
         document.getElementById('submit').click();
         return false;
      } else  {
         return true;
      }
   }); // end of function

}); // end of document ready
</script>


<table width="98%" cellspacing="1" cellpadding="1" class="box_blue" align="center">
    <tr>
		<td class="headblue" align="center" style="border-bottom: 1px #cccccc dashed; padding-bottom: 5px;" width="100%">
	    	New Project
		</td>
	</tr>
    <tr>
        <td class="headblue" align="left" width="100%">
			<form id="newproject" style="padding-top: 8px; margin-bottom:0;">
                <div align="center">
                    Project Name: <input type="text" class="normalformbox" id="pname" name="pname" size="35" />
                </div>
                <div align="center" style="padding-top: 8px;">
                    <input type="button" class="button" id="submit" onClick="submitNewP()" value="Create Project!" />&nbsp;&nbsp;<input type="reset" class="button" value="Reset" />
                </div>
            </form>
    	</td>
	</tr>
</table>