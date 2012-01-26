<html>
    <head>
    	<title>Cloud9 PHP Project Manager - Login</title>
		<link rel="stylesheet" href="css/1.css" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Knewave' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<form action="<?= $cloud9->base_url ?>?p=dologin" method="post">
		<table width="100%" height="100%" cellpadding="2" border="0">
			<tr>
				<td width="100%" height="100%" class="noprint" valign="middle">
					<table width="500" height="250" cellspacing="1" cellpadding="1" class="box_blue" align="center">
						<tr>
							<td class="headblue2" style="font-family: 'Knewave', cursive;" align="center" width="5%" colspan="2">&nbsp;
								<b>Cloud9 PHP Editor Login</b>
							</td>
						</tr>
						<tr>
							<td class="headblue" width="40%" align="center" valign="middle">
								<div align="right">Username:&nbsp;&nbsp;</div>
							</td>
							<td class="headblue" align="center" valign="middle">
								<div align="left"><input type="text" name="username" size="35" class="normalformbox" /></div>
							</td>
						</tr>
						<tr>
							<td class="headblue" align="center" valign="middle">
								<div align="right">Password:&nbsp;&nbsp;</div>
							</td>
							<td class="headblue" align="center" valign="middle">
								<div align="left"><input type="password" name="password" size="35" class="normalformbox" /></div>
							</td>
						</tr>
						<tr>
							<td class="headblue" align="center" colspan="2">
								<input type="submit" value="Log In" class="button" />&nbsp;&nbsp;<input type="reset" class="button" />
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>