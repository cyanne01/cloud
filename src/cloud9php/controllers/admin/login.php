<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index(){
        if (@$_POST['username'] == ""){
            $this->load->view('admin/login/header', array('title' => ' Admin Login'));
            $this->load->view('admin/login/login_form');
            $this->load->view('admin/login/footer');
        } else {
            if ($this->c9auth->adminLogin(@$_POST['username'], @$_POST['password'], true)){
                redirect('/admin/');
            } else {
                redirect('/admin/login');
            }
        }
	}
    
    public function logout(){
        $this->c9auth->logout();
    }
}