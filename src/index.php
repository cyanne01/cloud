<?php

define('CLOUD9', true);

require "pages/init.php";

switch ($_GET['p']){
    case 'login':
        break;
    default:
        $cloud9->checkAuthMain();
        break;
}

switch ($_GET['p']){
    case 'editor':
        require "pages/cloud9/viewCloud9.php";
        break;
    default:
        require "pages/dashboard.php";
        break;
}

?>