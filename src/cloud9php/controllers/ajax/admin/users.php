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
            $this->load->view('ajax/admin/users/new_user');
    	} else {
            $u = $this->c9auth->create(@$_POST['username'], @$_POST['password'], @$_POST['email'], @$_POST['fname'], @$_POST['lname']);
            if ($u != false){
                $this->manage($u);
            } else {
                $this->load->view('ajax/admin/users/new_user_fail');
            }
    	}
    }
    
    public function manage($id = 0){
        // User management page goes here..
        if ($id > 0){
            // We have a valid user ID to manage, well, one has been passed anyway..
            $this->load->view('ajax/admin/users/manage', array('uid' => $id, 'chpwd' => false, 'yubienabled' => 1));
        } else {
            // It's using the default for the function, so we got squat.
            // Display an error, or possibly in the future, show a page to help the admin pick a user.
        }
    }
    
    public function yubienable($uid = 0, $enable = 1){
        if ($uid > 0){
            if ($enable == 1){
                $this->c9auth->enableYubiAuth($uid);
            } else {
                $this->c9auth->disableYubiAuth($uid);
            }
        } else {
            // Invalid User ID - We'd better display and error here.
        }
    }
}