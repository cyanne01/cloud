<?php

class Functions {
    function checkAuthMain(){
        global $cloud9;
        if (!@$_SESSION['loggedin']){
            header('Location: ' . $cloud9->base_url . '?p=login');
            exit();
        }
    }
    
    function checkAuthAJAX(){
        global $cloud9;
        if (!@$_SESSION['loggedin']){
            die('<b>Session Invalid</b>');
        }
    }
    
    function checkAuthCloudAJAX(){
        global $cloud9;
        if (!@$_SESSION['loggedin']){
            die('Session Invalid');
        }
    }
    
    function checkAuthWebDAV(){
        global $cloud9;
        if (!@$_SESSION['loggedin']){
            die('Session Invalid');
        }
    }
    
    function getCurrentUser(){
        global $cloud9;
        return $_SESSION['username'];
    }
}

?>