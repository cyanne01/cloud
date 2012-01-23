<?php

if (!CLOUD9){
    exit();
}

if ($_GET['pid']){
    $sql = "SELECT ID, ProjectName FROM projects WHERE UserID = '" . mysql_real_escape_string($_SESSION['userid']) . "' AND ID = '" . mysql_real_escape_string($_GET['pid']) . "'";
    $query = mysql_query($sql, $cloud9->db->db_conn) or die('MySQL Error');
    $row = mysql_fetch_row($query) or die('Invalid Project ID');
}

$dir = str_replace('<%u%>', $cloud9->func->getCurrentUser(), $cloud9->conf->storage_location);

if (!is_dir($dir . '/' . $row[1])){
    mkdir($dir . '/' . $row[1], 755, true) or die('Project Dir Error');
}

$file = file_get_contents('view/ide.tmpl.html');

$file = str_replace('[%offlineManifest%]', '', $file);

$file = str_replace('[%staticUrl%]', '/static', $file);

if ($_GET['pid'] == 0 || $_GET['pid'] == ""){
    $file = str_replace('[%davPrefix%]', '"/workspace"', $file);
} else {
    // Get project details here and find dir name...
    $file = str_replace('[%davPrefix%]', '"/workspace/' . $row[1] . '"', $file);
}
$file = str_replace('[%workspaceDir%]', '""', $file);
$file = str_replace('[%debug%]', 'false', $file);
$file = str_replace('[%sessionId%]', '"random"', $file);
$file = str_replace('[%workspaceId%]', '"ide"', $file);

if ($_GET['pid'] == 0 || $_GET['pid'] == ""){
    $file = str_replace('[%name%]', "'Home Directory'", $file);
} else {
    $file = str_replace('[%name%]', "'" . $row[1] . "'", $file);
}

$file = str_replace('[%readonly%]', '""', $file);

if ($_GET['pid'] == 0 || $_GET['pid'] == ""){
    $file = str_replace('[%projectName%]', "Home Directory", $file);
} else {
    $file = str_replace('[%projectName%]', $row[1], $file);
}
$file = str_replace('[%version%]', '"0.1.0"', $file);

$file = str_replace('[%requirejsConfig%]', '{"baseUrl":"/static/","paths":{"ace":"/static/support/ace/lib/ace","debug":"/static/support/lib-v8debug/lib/v8debug","apf":"/static/support/apf"},"waitSeconds":30}', $file);

//ToDo - Save and pull this XML to the MySQL DB
$file = str_replace('[%settingsXml%]', '<settings version="0.0.4"></settings>', $file);

$file = str_replace('[%plugins%]', '["ext/filesystem/filesystem","ext/settings/settings","ext/editors/editors","ext/themes/themes","ext/themes_default/themes_default","ext/panels/panels","ext/dockpanel/dockpanel","ext/openfiles/openfiles","ext/tree/tree","ext/save/save","ext/recentfiles/recentfiles","ext/gotofile/gotofile","ext/newresource/newresource","ext/undo/undo","ext/clipboard/clipboard","ext/searchinfiles/searchinfiles","ext/searchreplace/searchreplace","ext/quickwatch/quickwatch","ext/quicksearch/quicksearch","ext/gotoline/gotoline","ext/html/html","ext/code/code","ext/imgview/imgview","ext/extmgr/extmgr","ext/run/run","ext/debugger/debugger","ext/noderunner/noderunner","ext/console/console","ext/tabbehaviors/tabbehaviors","ext/keybindings/keybindings","ext/watcher/watcher","ext/dragdrop/dragdrop","ext/beautify/beautify","ext/offline/offline","ext/stripws/stripws","ext/zen/zen","ext/codecomplete/codecomplete","ext/splitview/splitview"]', $file);

$file = str_replace('[%scripts%]', '<script type="text/javascript" src="/static/support/ace/build/src/ace-uncompressed.js"></script>' . "\n" . '<script type="text/javascript" src="/static/support/ace/build/src/mode-javascript.js"></script>', $file);

echo $file;

?>