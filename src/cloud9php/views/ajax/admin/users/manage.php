<h1>Account Settings</h1>
<div class="row" align="center">
    <div class="span8" align="center">
        <?php if ($chpwd){ echo validation_errors(); } ?>
        <form class="well" id="cpwd">
            <input type="password" class="input-xlarge" name="opassword" placeholder="Old Password..."><br />
            <input type="password" class="input-xlarge" name="password" placeholder="New Password..."><br />
            <input type="password" class="input-xlarge" name="cpassword" placeholder="Confirm New Password...">
        </form>
        <button class="btn btn-primary" onClick="loadContentPost('/ajax/admin/users/chpasswd/<?= $uid ?>', $('#cpwd').serialize());">Change Password</button>
        <button class="btn">Cancel</button>
        <br /><br />
    </div>
</div>
<div class="row" align="center">
    <div class="span2" align="center">
        YubiKey Enabled
    </div>
    <div class="span6" align="left">
        <script type="text/javascript">
            $('#1').iphoneSwitch("on", function() { $('#ajax').load('on.html'); }, function() { $('#ajax').load('off.html'); }, {});
        </script>
        <div id="l" style="float:left; width:120px;"></div>
    </div>
</div>