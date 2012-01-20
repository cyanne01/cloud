<?php

require "config.php";

class Cloud9DB {
    var $db_conn;
}

class Cloud9 {
    var $conf;
	var $func;
	var $db;
	var $base_url = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
	
	function Cloud9(){
		$this->conf = new Config;
		$this->func = new Functions;
		$this->db = new Cloud9DB;
		
		$this->db->db_conn = mysql_pconnect($this->conf->mysql_host, $this->conf->mysql_user, $this->conf->mysql_pass) or die("<table width=\"98%\" cellspacing=\"1\" cellpadding=\"1\" class=\"box_blue\" align=\"center\"><tr><td class=\"headblue\" align=\"center\" valign=\"middle\" width=\"100%\" height=\"25\" colspan=\"2\">MySQL Connect Error</td></tr></table>");
		mysql_select_db($this->conf->mysql_name, $this->db->db_conn) or die("<table width=\"98%\" cellspacing=\"1\" cellpadding=\"1\" class=\"box_blue\" align=\"center\"><tr><td class=\"headblue\" align=\"center\" valign=\"middle\" width=\"100%\" height=\"25\" colspan=\"2\">MySQL Select DB Error</td></tr></table>");
		
		session_start();
	}
}

$cloud9 = new Cloud9();

?>