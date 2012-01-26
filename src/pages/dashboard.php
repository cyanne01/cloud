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
        <link href='http://fonts.googleapis.com/css?family=Knewave' rel='stylesheet' type='text/css'>
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
										<td class="headblue2" style="font-family: 'Knewave', cursive;" align="center" width="100%" height="30">
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
                                    <?php
                                        require "pages/projects/mainpage.php";
                                    ?>
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