	<body>
        <div class="modal">
            <div align="center" class="modal-header">
                <h3>Cloud9 PHP Editor - Force Login</h3>
            </div>
            <form class="form-horizontal" style="margin-bottom: 0;" action="<?= base_url('login/force') ?>" method="post">
            <div class="modal-body">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="username"><b>Username :</b></label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="username" id="username">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="ausername"><b>Admin Username :</b></label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="ausername" id="ausername">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="apassword"><b>Password :</b></label>
                            <div class="controls">
                                <input type="password" class="input-xlarge" name="apassword" id="apassword">
                                <p class="help-block"><b>Note:</b> Yubikey OTP (<img style="vertical-align:text-bottom;" src="/images/yubiright_16x16.gif" border="0" />) Required</p>
                            </div>
                        </div>
                    </fieldset>
            </div>
            <div align="center" class="modal-footer">
                <button type="submit" class="btn btn-warning" style="float:none;">Force Login</button>
                <a href="http://www.google.co.uk/" class="btn btn-" style="float:none;">Cancel</a>
            </div>
            </form>
        </div>
	</body>