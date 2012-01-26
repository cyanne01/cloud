<?php
if (!CLOUD9){
    exit();
}
?>
<table width="98%" cellspacing="1" cellpadding="1" class="box_blue" align="center">
    <tr>
		<td class="headblue" align="center" style="border-bottom: 1px #cccccc dashed; padding-bottom: 5px;" width="100%">
			Announcements
		</td>
	</tr>
    <tr>
    	<td class="headblue" align="left" width="100%">
			Welcome to Cloud9 PHP Editor.
		</td>
	</tr>
</table>
<br />
<table width="98%" cellspacing="1" cellpadding="1" class="box_blue" align="center">
	<tr>
    	<td class="headblue" align="left" style="border-bottom: 1px #cccccc dashed; padding-bottom: 5px;" width="25%">
			<input type="button" class="button" onClick="loadContent('ajax.php?p=newproject');" value="New">
		</td>
        <td class="headblue" align="center" style="border-bottom: 1px #cccccc dashed; padding-bottom: 5px;" width="50%">
			My Projects
		</td>
        <td class="headblue" align="right" style="border-bottom: 1px #cccccc dashed; padding-bottom: 5px;" width="25%">
	    	<input type="button" class="button" onClick="window.location.href='<?= $cloud9->base_url ?>?p=editor'" value="Main Editor"></form>
	    </td>
    </tr>
    <tr>
		<td class="headbluesnu" colspan="3" style="padding: 10px;" align="left" width="100%">
			<?php
            $i = 0;
            $sql = "SELECT ID, ProjectName, IssueEnable, ToDoEnable FROM projects WHERE UserID = '" . mysql_real_escape_string($_SESSION['userid']) . "'";
            $query = mysql_query($sql, $cloud9->db->db_conn) or die('MySQL Error');
            while ($row = mysql_fetch_row($query)){
                $i++;
            ?>
                <div<?= $i == mysql_num_rows($query) ? '' : ' style="padding-bottom: 8px;"' ?>><div class="headblue"><?= $row[1] ?></div><div class="headbluesnu"><a href="?p=editor&pid=<?= $row[0] ?>">Editor</a><?= $row[2] ? ' | Bugs / Tickets' : '' ?><?= $row[3] ? ' | To Do' : '' ?> | Settings</div></div>
            <?php
            }
            if ($i < 1){
            ?>
                <div class="headblue" align="center">You don't currently have any projects, please create one.</div>
            <?php
            }
            ?>
        </td>
    </tr>
</table>