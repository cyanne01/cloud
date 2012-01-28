<?php

$password = $_POST['password'];

$salt_chars    	=	array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'Z', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0');

$rand_keys		=	array_rand($salt_chars, 5);

$salt_string	=	$salt_chars[$rand_keys[0]] . $salt_chars[$rand_keys[1]] . $salt_chars[$rand_keys[2]] . $salt_chars[$rand_keys[3]] . $salt_chars[$rand_keys[4]];

echo "<b>Salt String:</b>&nbsp; " . $salt_string . "<br />";

echo "<b>MD5 of Salt</b>&nbsp; " . md5($salt_string) . "<br />";

echo "<b>MD5 of Password</b>&nbsp; " . md5($password) . "<br />";

echo "<b>MD5 of Salt + Password:</b>&nbsp; " . md5( md5($salt_string) . md5($password) ) . "<br />";

?>