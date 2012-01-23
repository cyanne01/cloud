<?php

define('CLOUD9', true);

require "pages/init.php";

switch (@$_GET['p']){
    case 'login':
    case 'dologin':
    case 'logout':
        break;
    default:
        $cloud9->func->checkAuthMain();
        break;
}

switch (@$_GET['p']){
    case 'editor':
        require "pages/cloud9/viewCloud9.php";
        break;
    case 'login':
        require "pages/users/login.php";
        break;
    case 'dologin':
        require "pages/users/dologin.php";
        break;
    case 'logout':
        require "pages/users/logout.php";
        break;
    default:
        require "pages/dashboard.php";
        break;
}

?>