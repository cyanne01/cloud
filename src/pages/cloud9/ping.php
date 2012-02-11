<?php

session_start();

if (!@$_SESSION['loggedin']){
    die('0');
} else {
    die('1');
}

?>