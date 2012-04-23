<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Model {
    public function isUsersProject($projectid, $userid){
        $query = $this->db->query("SELECT ID FROM projects WHERE ID = " . $this->db->escape($projectid) . " AND UserID = " . $this->db->escape($userid));
        
        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function getProjName($projectid){
        $query = $this->db->query("SELECT ProjectName FROM projects WHERE ID = " . $this->db->escape($projectid));
        
        if ($query->num_rows() > 0){
            $row = $query->row_array();
            
            return $row['ProjectName'];
        } else {
            return false;
        }
    }
    
    public function checkProjDir($projectid){
        if ($this->isUsersProject($projectid, $this->c9auth->currUserID())){
            if (is_dir($this->localProjDir($projectid))){
                return true;
            } else {
                if (mkdir($this->localProjDir($projectid))){
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
    
    public function localProjDir($projectid){
        return $this->c9config->currWorkspaceDir() . '/' . $this->getProjName($projectid);
    }
}