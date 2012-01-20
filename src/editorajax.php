<?php

define('CLOUD9', true);

require "pages/init.php";

$cloud9->checkAuthCloudAJAX();
 
switch ($_GET['p']){
    default:
        // ToDo - Error out here to say feature not implemented.
        break;
}

?>