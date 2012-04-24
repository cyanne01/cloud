<div class="row" align="center">
    <div class="span8" align="center">
        <h1>Add New User</h1>
        <form class="well" id="auser">
            <input type="text" class="input-xlarge" id="fname" placeholder="First Name...">
            <input type="text" class="input-xlarge" id="lname" placeholder="Last Name...">
            <input type="text" class="input-xlarge" id="email" placeholder="Email Address...">
            <input type="text" class="input-xlarge" id="username" placeholder="Username...">
            <input type="password" class="input-xlarge" id="password" placeholder="Password...">
            <input type="password" class="input-xlarge" id="cpassword" placeholder="Confirm Password...">
        </form>
        <button class="btn btn-primary" onClick="loadContentPost('/ajax/admin/users/create', $('#auser').serialize());">Create User</button>
        <button class="btn">Cancel</button>
        <br /><br />
        <?php echo validation_errors(); ?>
    </div>
    <div class="span4">
        <h2>Help</h2><br />
        Please note that all fields except the email field are mandatory.<br />
        <br />
        The password required is the users pass phrase, an option to add Yubikeys to the account will be presented once the account has been created.<br />
</div>