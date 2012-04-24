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
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]');
        $this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');

    	if ($this->form_validation->run() == FALSE){
            print_r($_POST);
            $this->load->view('ajax/admin/users/new_user');
    	} else {
            if ($this->c9auth->create(@$_POST['username'], @$_POST['password'], @$_POST['email'], @$_POST['fname'], @$_POST['lname'])){
                $this->load->view('ajax/admin/users/new_user_success');
            } else {
                $this->load->view('ajax/admin/users/new_user_fail');
            }
    	}
    }
}