<?php

define('CLOUD9', true);

require "pages/init.php";

$cloud9->func->checkAuthAJAX();
 
switch (@$_GET['p']){
    case 'newproject':
        require "pages/projects/new.php";
        break;
    case 'donewproject':
        require "pages/projects/donew.php";
        break;
    default:
        die("<table width=\"98%\" cellspacing=\"1\" cellpadding=\"1\" class=\"box_blue\" align=\"center\"><tr><td class=\"headblue\" align=\"center\" valign=\"middle\" width=\"100%\" height=\"25\" colspan=\"2\"><b>Feature Disabled</b></td></tr></table>");
        break;
}

?>