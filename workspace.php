<?php

$path = 'inc/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once "inc/HTTP/WebDAV/Server/Filesystem.php";

$server = new HTTP_WebDAV_Server_Filesystem();

$server->ServeRequest('workspace/');

?>
