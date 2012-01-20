<?php

define('CLOUD9', true);

require "pages/init.php";

$cloud9->func->checkAuthWebDAV();

$path = 'inc/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

require_once "inc/HTTP/WebDAV/Server/Filesystem.php";

$server = new HTTP_WebDAV_Server_Filesystem();

$server->ServeRequest(str_replace('<%u%>', $cloud9->func->getCurrentUser(), $cloud9->conf->storage_location));

?>