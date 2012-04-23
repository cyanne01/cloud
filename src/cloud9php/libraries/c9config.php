<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C9config {
    var $CI;
    
    public function __construct(){
        $this->CI =& get_instance();
        
        $this->CI->config->load('c9config', true);
    }
    
    public function getWorkspaceDir($username){
        return str_replace('<username>', $username, $this->CI->config->item('workspace_dir', 'c9config'));
    }
    
    public function currWorkspaceDir(){
        return $this->getWorkspaceDir($this->CI->c9auth->currUsername());
    }
    
}

/* End of file */