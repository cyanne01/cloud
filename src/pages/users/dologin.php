<?php

$sql    =    "SELECT ID, Username, Password, PasswordSalt FROM users WHERE Username = '".mysql_real_escape_string($_POST['username'])."'";

$query	=	mysql_query($sql, $cloud9->db->db_conn) or die ("<b>MySQL Error</b>");

if ( $row	=	mysql_fetch_row($query) ){
	if ($row[2] == ( md5( md5($row[3]) . md5($_POST['password']) ) ) ){
		$sql3	=	"SELECT ID, FirstName, LastName, EmailAddress, Admin FROM users WHERE Username = '".mysql_real_escape_string($_POST['username'])."' AND Disabled = 0";
		$query3	=	mysql_query($sql3, $cloud9->db->db_conn);
		if (!$row2 = mysql_fetch_row($query3)){
			header('Location: ' . $cloud9->base_url . '?p=login&msg=notadmin');
			exit();
		}
		// Define session variables...
		$_SESSION['loggedin']	=	true;
		$_SESSION['userid']		=	$row[0];
		$_SESSION['username']	=	$row[1];
		$_SESSION['fname']	    =	$row2[1];
		$_SESSION['lname']	    =	$row2[2];
		$_SESSION['email']		=	$row2[3];
		$_SESSION['admin']		=	$row2[4];
		// Update last login time...
		$sql2	=	"UPDATE users SET LastLogin = NOW() WHERE ID = '".$row[0]."';";
		$query2	=	mysql_query($sql2, $cloud9->db->db_conn);
		// Refresh to Dashboard
		header('Location: ' . $cloud9->base_url);
	} else {
		header('Location: ' . $cloud9->base_url . '?p=login&msg=password');
	}
} else {
	header('Location: ' . $cloud9->base_url . '?p=login&msg=username');
}

?>