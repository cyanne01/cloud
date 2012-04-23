<!DOCTYPE html>
<html<?= $offlineManifest ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:a="http://ajax.org/2005/aml">
    <head profile="http://www.w3.org/2005/10/profile">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title><?= $projectName ?> - Cloud9 PHP Editor</title>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>

        <link rel="icon" type="image/gif" href="/static/favicon.ico" />

        <link rel="stylesheet" type="text/css" href="/static/style/style.css" />

        <script type="text/javascript" src="/static/require.js"></script>
        <?= $scripts ?>
        <script type="text/javascript">
        //<![CDATA[

            window.cloud9config = {
                davPrefix: <?= $davPrefix ?>,
                workspaceDir: <?= $workspaceDir ?>,
                debug: <?= $debug ?>,
                sessionId: <?= $sessionId ?>,
                workspaceId: <?= $workspaceId ?>,                
                name: <?= $name ?>,
                readonly: <?= $readonly ?>,
                projectName: '<?= $projectName ?>',
                version: <?= $version ?>,
                staticUrl: "/static/"
            };
            
            // prevent console messages crash our app!
            if (typeof window["console"] == "undefined") {
                var K = function() {};
                window.console = {log:K,debug:K,dir:K,trace:K,error:K,warn:K,profileStart:K,profileEnd:K};
            }

            var RELEASE = "release";
            var DEBUG   = "debug";
            var FILES   = "files";
            
            var VERSION = window.cloud9config.debug ? DEBUG : RELEASE;

            var apfLoc = VERSION == FILES
                ? "/static/support/apf/apf.js"
                : "/static/js/apf_" + VERSION + ".js";

            var config = <?= $requirejsConfig ?>;
            require(config, [apfLoc], function(){
                apf.addEventListener("load", function(){
                    var list = ["core/ide", "core/ext", "core/util", "ext/editors/editors"];
                    if (VERSION == RELEASE)
                        list.push("ace/editor");

                    require(list, function(ide, ext, util){
                        ide.settings = <?= $settingsXml ?>;

                        var plugins = <?= $plugins ?>;
                        apf.addEventListener("load", function(){
                            //Load extensions
                            require(plugins, function(){
                                ide.dispatchEvent("extload", {modules: plugins});
                                ide.addEventListener("$event.extload", function(cb){
                                    cb();
                                });
                            });
                        });
                    });
                });
                //if (apf.started)
                //    apf.onstart();
            });
        //]]>
        </script>
    </head>
    <body>
        <div id="noscript">
            <div class="noscript">
                <div id="hp_header">
                    <div id="logo"></div>
                </div>
                <div class="oldbro_middle_panel">
                    <div class="content">
                        <p>Your browser is not supported by ajax.org. Please upgrade your browser to one of these modern browsers.</p>
                        <span class="browser_option">
                            <a href="http://www.mozilla.com/firefox" target="_blank">
                                <img src="/static/style/images/browsers/ff_32x32.png" alt="" />
                                <div>Mozilla Firefox</div>
                            </a>
                        </span>
                        <span class="browser_option" style="width:50px;">
                            <a href="http://www.apple.com/safari" target="_blank">
                                <img src="/static/style/images/browsers/safari_32x32.png" alt="" />
                                <div>Safari</div>
                            </a>
                        </span>
                        <span class="browser_option">
                            <a href="http://www.google.com/chrome" target="_blank">
                                <img src="/static/style/images/browsers/chrome_32x32.png" alt="" />
                                <div>Google Chrome</div>
                            </a>
                        </span>
                        <span class="browser_option">
                            <a href="http://www.microsoft.com/windows/internet-explorer" target="_blank">
                                <img src="/static/style/images/browsers/ie_32x32.png" alt="" />
                                <div>Internet Explorer</div>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="wn_main_section_rounded">
                    <div class="wnmsr_left"></div>
                    <div class="wnmsr_middle"></div>
                    <div class="wnmsr_right"></div>
                </div>
            </div>
        </div>

        <a:skin
          src        = "/static/style/skins.xml"
          media-path = "/static/style/images/"
          icon-path  = "/static/style/icons/" />

        <a:appsettings name="ide" debug="false"
          disable-space       = "true"
          auto-hide-loading   = "true"
          allow-select        = "false"
          allow-blur          = "true"
          initdelay           = "false"
          storage             = "cookie"
          baseurl             = "{apf.host ? apf.host : ''}" />

        <!-- default model -->
        <a:model />

        <a:loader id="loader">
            <div id="loadscreen" class="loader">
                <div>Loading...</div>
            </div>
        </a:loader>

        <a:state id="stServerConnected" active="false" />
        <a:state id="stProcessRunning" active="false" />

        <a:include src="/static/include/models.xml" />
        <a:include src="/static/include/menus.xml" />
        <a:include src="/static/include/windows.xml" />
        
        <a:vbox anchors="0 0 0 0" id="vbMain">
            <a:bar skin="c9-menu-bar" id="logobar">
                <a:hbox>
                    <a:hbox id="barMenu" edge="8 5 0 5" padding="3" align="center">
                        <a:button skin="c9-menu-btn" submenu="mnuFile" margin="1 0 0 0">File</a:button>
                        <a:button skin="c9-menu-btn" submenu="mnuEdit" margin="1 0 0 0">Edit</a:button>
                        <a:button skin="c9-menu-btn" submenu="mnuView" margin="1 0 0 0">View</a:button>
                    </a:hbox>
                    <a:hbox id="barTools" edge="8 0 0 0" padding="3" align="center">
                        <a:divider skin="c9-divider-double" />
                    </a:hbox>
                    <a:filler />
                    <a:hbox id="barExtras" edge="8 0 0 0" padding="3" align="center"> 
                        <a:divider skin="c9-divider" visible="false" />
                    </a:hbox>
                </a:hbox>
            </a:bar>

            <a:vbox id="mainRow" padding="0" flex="1" splitters="true">
                <a:hbox id="hboxMain" padding="0" edge="0" flex="1">
                    <a:vbox id="navbar" class="black-menu-bar unselectable">
                        <a:filler />
                        <a:bar skin="basic">
                            <div class="c9menulogo">
                                <span></span>
                            </div>
                            <div id="c9version" class="c9version">Version <?= $version ?></div>
                        </a:bar>
                    </a:vbox>
                    <a:vbox id="colLeft" padding="3" width="200" />
                    <a:splitter width="0" id="splitterPanelLeft" />
                    <a:vbox id="colMiddle" flex="1" padding="3" />
                    <a:vbox id="colRight" padding="0">
                        <a:hbox id="hboxDockPanel" flex="1">
                            <a:bar skin="basic" flex="1" />
                        </a:hbox>
                    </a:vbox>
                </a:hbox>
            </a:vbox>
            
            <a:statusbar id="sbMain" visible="false">
                <a:section />
            </a:statusbar>
        </a:vbox>
    </body>
</html>
