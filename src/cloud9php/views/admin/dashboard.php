<!DOCTYPE html>
<html>
    <head>
		<title>Cloud9 PHP Editor - Admin</title>
        
		<link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="/css/engage.itoggle.css" type="text/css">
        <script src="/js/jquery-1.7.1.min.js"></script>
        <script src="/js/engage.itoggle-min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
		<script src="/js/cloud9.js"></script>
        
        <link rel="stylesheet" href="/css/my.css" type="text/css">
        
        <style type="text/css">
            html, body {
                height: 100%;
            }
            footer {
                padding: 17px 0 18px 0;
            }
            .wrapper {
                min-height: 100%;
                min-width: 940px;
                height: auto !important;
                height: 100%;
                margin: 0 auto -130px;
            }
        </style>
	</head>
	<body onLoad="cloud9AdminLoad();">
	    <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="#">Cloud9 PHP Admin</a>
                    <ul class="nav">
                        <li><a href="javascript:loadContent('/ajax/admin/home');">Home</a></li>
                        <li><a href="javascript:loadContent('/ajax/admin/users');">Users</a></li>
                        <li><a href="javascript:loadContent('/ajax/admin/settings');">Settings</a></li>
                    </ul>
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $fullname ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:loadContent('/ajax/account');">Account Settings</a></li>
                                <li><a href="javascript:loadContent('/ajax/account/security');">Security Settings</a></li>
                                <li><a href="<?= base_url('admin/login/logout') ?>">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="container">
                <div id="contentloading" style="position: fixed; top: 50%; left: 50%; margin-top: -130px; margin-left: -42.5px;" align="center">
                    <img src="/images/icons/loading.png" border="0" />
                </div>
                <div id="content" style="display: none; padding-top: 60px; margin-bottom: 100px">
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <hr />
                <div class="pull-right"><a href="#">Back to top</a></div>
                Designed and Developed by <a href="mailto:sam@infitialis.com">IAmACarpetLicker</a> with help from a few open source components (<a href="https://github.com/iamacarpet/cloud9php/blob/master/README.md">see here</a>).<br />
                <a href="https://github.com/iamacarpet/cloud9php">Cloud9 PHP Editor</a> is Copyright&copy; <a href="http://www.infitialis.com/">Infitialis Web Services</a> <?= date('Y') ?>.<br />
                <div id="serverload"><span class="label <?= $loadavg['label'] ?>">Server Load: <?= $loadavg['load'][0] ?>, <?= $loadavg['load'][1] ?>, <?= $loadavg['load'][2] ?></span></div>
            </div>
        </footer>
	</body>
</html>