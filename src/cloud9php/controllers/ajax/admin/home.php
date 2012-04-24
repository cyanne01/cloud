<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->c9auth->checkLoginAdminAJAX();
    }

    public function index(){
        $this->load->view('ajax/admin/home', array('fname' => $this->c9auth->currFirstName()));
	}
}