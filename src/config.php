<?php

class Config {
        //------------------------
        // MySQL Database Details
        //------------------------
        // MySQL Server Address
        var $mysql_host         = 'localhost';
        // Database username
        var $mysql_user         = 'cloud9';
        // Database password
        var $mysql_pass         = ' ';
        // Database name
        var $mysql_name         = 'cloud9';
        //------------------------
        // YubiKey Details
        //------------------------
        // Enable YubiKey auth
        var $yubikey_enabled    = true;
        // Require YubiKey for admin access
        var $yubikey_admin      = true;
        // URL of YubiKey Validation Server
        var $yubikey_server     = 'http://yubi.mydomain.com/wsapi/2.0/verify';
        // YubiKey API ID
        var $yubi_id            = '3';
        // YubiKey API Secret Key
        var $yubi_key           = 'Foo=';
        //------------------------
        // Storage Details
        // Note: "<%u%>" is replaced with the current users username.
        //------------------------
        var $storage_location   =   '/home/workspace/<%u%>/';
}

?>