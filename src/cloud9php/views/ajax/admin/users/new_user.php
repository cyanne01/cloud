<div class="row">
    <div class="span12">
        <form class="form-horizontal" id="auser" align="center">
            <fieldset>
                <legend><div align="center">Add New User</div></legend>
                <div class="control-group">
                    <label class="control-label" for="fname">First Name</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="fname" name="fname">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="lname">Last Name</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="lname" name="lname">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="email">Email Address</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="email" name="email">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="username">Username</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="username" name="username">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password">Password</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="password" name="password">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="cpassword">Confirm Password</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="cpassword">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" onClick="loadContentPost('/ajax/admin/users/create', $("#auser").serialize());">Create User</button>
                    <button class="btn">Cancel</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>