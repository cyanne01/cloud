<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index(){
        if (@$_POST['username'] == ""){
            $this->load->view('login/header', array('title' => 'Login'));
            $this->load->view('login/login_form');
            $this->load->view('login/footer');
        } else {
            if ($this->c9auth->login(@$_POST['username'], @$_POST['password'])){
                redirect('/');
            } else {
                redirect('/login');
            }
        }
	}
    
    public function logout(){
        $this->c9auth->logout();
    }
    
    public function force($flogin = 0, $fsess = 0){
        if (@$_POST['username'] == ""){
            $this->load->view('login/header', array('title' => 'Force Login'));
            $this->load->view('login/force_login', array('flogin' => $flogin, 'fsess' => $fsess));
            $this->load->view('login/footer');
        } else {
            if ($this->c9auth->login(@$_POST['ausername'], @$_POST['apassword'], false, false, true)){
                if ($this->c9auth->createSession(@$_POST['username'])){
                    redirect('/');
                } else {
                    redirect('/login/force/0/1');
                }
            } else {
                redirect('/login/force/1/0');
            }
        }
    }
    
    public function pwreset($success = 0, $fcpw = 0, $fcmp = 0, $flogin = 0){
        if (@$_POST['username'] == ""){
            $this->load->view('login/header', array('title' => 'Password Reset'));
            $this->load->view('login/pwreset');
            $this->load->view('login/footer');
        } else {
            if ($this->c9auth->adminAuth(@$_POST['ausername'], @$_POST['apassword'], true)){
                if (@$_POST['pw1'] == @$_POST['pw2']){
                    if ($this->c9auth->dopasswd(@$_POST['username'], @$_POST['pw1'])){
                        redirect('/login/pwreset/1');
                    } else {
                        redirect('/login/pwreset/0/1');
                    }
                } else {
                    redirect('/login/pwreset/0/0/1');
                }
            } else {
                redirect('/login/pwreset/0/0/0/1');
            }
        }
    }
}