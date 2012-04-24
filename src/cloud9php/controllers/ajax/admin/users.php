<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->c9auth->checkLoginAdminAJAX();
    }

    public function index(){
        $this->load->view('ajax/admin/users/users');
    }
    
    public function create(){
        $this->load->view('ajax/admin/users/new_user.php');
    }
}