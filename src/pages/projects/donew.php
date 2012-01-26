<?php

if(!CLOUD9){
    exit();
}

if ($_POST['pname'] != ""){
    $sql = "INSERT INTO projects (UserID, ProjectName, IssueEnable, TodoEnable) VALUES ('" . mysql_real_escape_string($_SESSION['userid']) . "', '" . mysql_real_escape_string($_POST['pname']) . "', 1, 0);";
    $query = mysql_query($sql, $cloud9->db->db_conn) or die('MySQL Error');
    header('Location: ' . $cloud9->base_url . 'ajax.php?p=mainpage');
} else {
    die('Invalid Project Name');
}

?>