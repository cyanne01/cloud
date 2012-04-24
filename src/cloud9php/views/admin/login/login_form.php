	<body>
        <div class="modal">
            <div align="center" class="modal-header">
                <h3>Cloud9 PHP Editor - Admin Login</h3>
            </div>
            <form class="form-horizontal" style="margin-bottom: 0;" action="<?= base_url('admin/login'); ?>" method="post">
            <div class="modal-body">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="username"><b>Username :</b></label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="username" id="username">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="password"><b>Password :</b></label>
                            <div class="controls">
                                <input type="password" class="input-xlarge" name="password" id="password">
                                <p class="help-block"><b>Note:</b> Yubikey OTP (<img style="vertical-align:text-bottom;" src="/images/yubiright_16x16.gif" border="0" />) Required</p>
                            </div>
                        </div>
                    </fieldset>
                    <p align="center" class="help-block">Please be aware that all activity is monitored<br />You may only use this service with expressed permission from the owner.</p>
            </div>
            <div align="center" class="modal-footer">
                <button type="submit" class="btn btn-success" style="float:none;">Login</button>
                <a href="http://www.google.co.uk/" class="btn btn-" style="float:none;">Cancel</a>
            </div>
            </form>
        </div>
	</body>