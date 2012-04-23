<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workspace extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->c9auth->checkLogin();
    }
    
    public function _remap(){
        $this->davServer();
    }
    
    public function davServer(){
        require dirname(__FILE__) . "/../third_party/Sabre/autoload.php";
        
        // Create the root node
        $root = new Sabre_DAV_FS_Directory($this->c9config->currWorkspaceDir());

        // The rootnode needs in turn to be passed to the server class
        $server = new Sabre_DAV_Server($root);

        $server->setBaseUri('/workspace/');
        
        $server->exec();
    }
}