<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->c9auth->checkAdminLogin();
    }

    public function index(){
        $this->load->model('system/systemdata');
        
		$this->load->view('admin/dashboard', array('fullname' => $this->c9auth->currFullName(), 'loadavg' => $this->systemdata->getLoad()));
	}
}

/* End of File */