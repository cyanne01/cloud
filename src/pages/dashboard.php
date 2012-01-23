<?php
if(!CLOUD9){
    exit();
}
?>
<html>
    <head>
    	<title>Cloud9 PHP Project Manager</title>
		<link rel="stylesheet" href="css/1.css" type="text/css">
        <script src="js/jquery-1.6.2.min.js"></script>
		<script src="js/cloud9.js"></script>
	</head>

	<body>
		<table width="925" cellpadding="2" border="0" align="center">
			<tr>
				<td width="100%">
					<table bgcolor="#FFFFFF" width="100%" height="100%">
						<tr>
							<td valign="top">
								<table width="98%" cellspacing="1" cellpadding="1" class="box_blue" style="border-bottom: none;" align="center">
    								<tr>
										<td class="headblue2" align="center" width="100%" height="30">
											Cloud9 PHP Project Manager
										</td>
									</tr>
								</table>
                                <table width="98%" cellspacing="1" cellpadding="1" class="box_ok" align="center">
									<tr>
										<td class="headblues" align="left" width="100%">
											Welcome, <?= $_SESSION['fname'] ?>  (<a onClick="loadContent('ajax.php?p=myaccount')">My Account</a> | <a href="?p=logout">Logout</a>)
										</td>
									</tr>
								</table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <br />
                                <div id="content">
                                    <table width="98%" cellspacing="1" cellpadding="1" class="box_blue" align="center">
    				    				<tr>
					    					<td class="headblue" align="center" style="border-bottom: 1px #cccccc dashed;" width="100%">
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
    				    						<input type="button" class="button" value="New">
					    					</td>
                                            <td class="headblue" align="center" style="border-bottom: 1px #cccccc dashed; padding-bottom: 5px;" width="50%">
					    						My Projects
					    					</td>
                                            <td class="headblue" align="right" style="border-bottom: 1px #cccccc dashed; padding-bottom: 5px;" width="25%">
        								    	<input type="button" class="button" onClick="window.location.href='<?= $cloud9->base_url ?>?p=editor'" value="Main Editor"></form>
										    </td>
									    </tr>
                                        <tr>
    				    					<td class="headblue" colspan="3" style="padding: 10px;" align="left" width="100%">
					    						<?php
                                                $i = 0;
                                                $sql = "SELECT ID, ProjectName, IssueEnable, ToDoEnable FROM projects WHERE UserID = '" . mysql_real_escape_string($_SESSION['userid']) . "'";
                                                $query = mysql_query($sql, $cloud9->db->db_conn) or die('MySQL Error');
                                                while ($row = mysql_fetch_row($query)){
                                                    $i++;
                                                ?>
                                                    <div class="headblue"><?= $row[1] ?></div><div class="headblues"><a href="?p=editor&pid=<?= $row[0] ?>">Editor</a><?= $row[2] ? ' | Bugs / Tickets' : '' ?><?= $row[2] ? ' | To Do' : '' ?> | Settings</div>
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
                                </div>
                                <div id="contentloading" style="display: none;">
    								<table width="98%" cellspacing="1" cellpadding="1" class="box_blue" align="center">

										<tr>
											<td class="headblues" align="center" valign="middle" width="100%" height="25" colspan="2">
												<img src="images/loading.gif" border="0" />
											</td>
										</tr>
									</table>
								</div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <br />
                                <table width="98%" cellspacing="1" cellpadding="1" class="box_blue" align="center">
									<tr>
										<td class="headblues" align="center" valign="middle" width="100%" colspan="2">
											<a href="http://github.com/iamacarpet/cloud9php">Cloud9 PHP Editor Project</a> (by <a href="mailto:sam@infitialis.com">IAmACarpet</a>)
										</td>
									</tr>
								</table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</table>