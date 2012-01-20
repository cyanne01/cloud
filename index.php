<?php

$file = file_get_contents('view/ide.tmpl.html');

$file = str_replace('[%offlineManifest%]', '', $file);

$file = str_replace('[%staticUrl%]', '/static', $file);

$file = str_replace('[%davPrefix%]', '"/workspace"', $file);
$file = str_replace('[%workspaceDir%]', '"/home/workspace"', $file);
$file = str_replace('[%debug%]', 'false', $file);
$file = str_replace('[%sessionId%]', '"random"', $file);
$file = str_replace('[%workspaceId%]', '"ide"', $file);
$file = str_replace('[%name%]', "'My Project'", $file);
$file = str_replace('[%readonly%]', '""', $file);
$file = str_replace('[%projectName%]', "My Project", $file);
$file = str_replace('[%version%]', '"0.1.0"', $file);

$file = str_replace('[%requirejsConfig%]', '{"baseUrl":"/static/","paths":{"ace":"/static/support/ace/lib/ace","debug":"/static/support/lib-v8debug/lib/v8debug","apf":"/static/support/apf"},"waitSeconds":30}', $file);
$file = str_replace('[%settingsXml%]', '<settings version="0.0.4"></settings>', $file);
$file = str_replace('[%plugins%]', '["ext/filesystem/filesystem","ext/settings/settings","ext/editors/editors","ext/themes/themes","ext/themes_default/themes_default","ext/panels/panels","ext/dockpanel/dockpanel","ext/openfiles/openfiles","ext/tree/tree","ext/save/save","ext/recentfiles/recentfiles","ext/gotofile/gotofile","ext/newresource/newresource","ext/undo/undo","ext/clipboard/clipboard","ext/searchinfiles/searchinfiles","ext/searchreplace/searchreplace","ext/quickwatch/quickwatch","ext/quicksearch/quicksearch","ext/gotoline/gotoline","ext/html/html","ext/code/code","ext/imgview/imgview","ext/extmgr/extmgr","ext/run/run","ext/debugger/debugger","ext/noderunner/noderunner","ext/console/console","ext/tabbehaviors/tabbehaviors","ext/keybindings/keybindings","ext/watcher/watcher","ext/dragdrop/dragdrop","ext/beautify/beautify","ext/offline/offline","ext/stripws/stripws","ext/zen/zen","ext/codecomplete/codecomplete","ext/splitview/splitview"]', $file);

$file = str_replace('[%scripts%]', '<script type="text/javascript" src="/static/support/ace/build/src/ace-uncompressed.js"></script>' . "\n" . '<script type="text/javascript" src="/static/support/ace/build/src/mode-javascript.js"></script>', $file);

echo $file;

?>