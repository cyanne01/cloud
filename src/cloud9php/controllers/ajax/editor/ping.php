<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ping extends CI_Controller {

    public function index(){
        if ($this->c9auth->is_loggedin()){
            echo '1';
        } else {
            echo '0';
        }
    }
    
}

/* End of File */