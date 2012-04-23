<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C9auth {
    var $CI;
    
    public function __construct(){
        $this->CI =& get_instance();
        
        $this->CI->load->helper('url');
    }
    
    //-------------------------
    // Check functions
    //-------------------------
    
    /**
     * Check for a valid login.
     *
     * @access public
     * @return void
    **/
    public function checkLogin(){
        if (!$this->is_loggedin()){
            redirect('/login');
        } else {
            if ($this->CI->session->userdata('last_activity') < (time() - 300)){
                if ($this->CI->session->userdata('yubikey')){
                    $this->CI->session->set_userdata('yubikey', false);
                }
            }
        }
    }
    
    public function checkLoginAJAX(){
        if (!$this->is_loggedin()){
            $this->CI->load->view('login/ajax_sess');
            exit();
        } else {
            if ($this->CI->session->userdata('last_activity') < (time() - 300)){
                if ($this->CI->session->userdata('yubikey')){
                    $this->CI->session->set_userdata('yubikey', false);
                }
            }
            return true;
        }
    }
    
    public function checkYubikey(){
        if ($this->CI->session->userdata('yubikey')){
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Check for a valid admin login.
     *
     * @access public
     * @return void
    **/
    public function checkAdminLogin(){
        if (!$this->is_admin()){
            redirect('/admin/login');
        } else {
            if ($this->CI->session->userdata('yubikey')){
                if ($this->CI->session->userdata('last_activity') < (time() - 300)){
                    $this->CI->session->set_userdata('yubikey', false);
                    redirect('/admin/login');
                }
            } else {
                redirect('/admin/login');
            }
        }
    }
    
    /**
     * Check if a user is logged in.
     *
     * @access public
     * @return bool
    **/
    public function is_loggedin(){
        if ($this->CI->session->userdata('logged_in')){
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Check if current user is an admin.
     *
     * @access public
     * @return bool
    **/
    public function is_admin(){
        if ($this->is_loggedin()){
            if ($this->CI->session->userdata('admin') == 1){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    //-------------------------
    // Get user details
    //-------------------------
    
    public function getUsers($orderby = 'ID ASC', $limit = false, $start = 0, $nlimit = 0){
        if ($limit){
            $query = $this->CI->db->query("SELECT * FROM users ORDER BY " . $orderby . " LIMIT " . $start . ", " . $nlimit);
        } else {
            $query = $this->CI->db->query("SELECT * FROM users ORDER BY " . $orderby);
        }
        
        return $query->result_array();
    }
    
    public function getUser($user_id){
        $this->CI->db->select('ID')->from('users')->where(array('id' => $user_id));
        $query = $this->CI->db->get();
        
        if ($query->num_rows() > 0){
            return $query->row_array();
        } else {
            return false;
        }
    }
    
    public function getUserID($username){
        $query = $this->CI->db->get_where('users', array('Username' => $username));
        
        if ($query->num_rows() > 0){
            $row = $query->row_array();
            
            return $row['ID'];
        } else {
            return false;
        }
    }
    
    public function currUserID(){
        if ($this->is_loggedin()){
            return $this->CI->session->userdata('userid');
        } else {
            return false;
        }
    }
    
    public function currFullName(){
        if ($this->is_loggedin()){
            return $this->CI->session->userdata('fname') . ' ' . $this->CI->session->userdata('lname');
        } else {
            return false;
        }
    }
    
    public function currFirstName(){
        if ($this->is_loggedin()){
            return $this->CI->session->userdata('fname');
        } else {
            return false;
        }
    }
    
    public function currUsername(){
        if ($this->is_loggedin()){
            return $this->CI->session->userdata('username');
        } else {
            return false;
        }
    }
    
    //-------------------------
    // YubiKey Functions
    //-------------------------
    
    // Enable Yubikey Auth for a user.
    public function enableYubiAuth($user_id){
        $this->CI->db->where(array('ID' => $user_id));
        $this->CI->db->update('users', array('YubiKey' => 1));
        
        if ($this->CI->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    // Disable Yubikey Auth for a user.
    public function disabledYubiAuth($user_id){
        $this->CI->db->where(array('ID' => $user_id));
        $this->CI->db->update('users', array('YubiKey' => 0));
        
        if ($this->CI->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function isYubikeyEnabled($user_id){
        $query = $this->CI->db->query("SELECT ID FROM users WHERE ID = " . $this->CI->db->escape($user_id) . " AND YubiKey = 1");
        
        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function isYubikeyRequired($user_id){
        $query = $this->CI->db->query("SELECT ID FROM users WHERE ID = " . $this->CI->db->escape($user_id) . " AND YubiKeyRequired = 1");
        
        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    // Make a Yubikey OTP required for this user to login.
    public function setYubiKeyRequired($user_id){
        $this->CI->db->where(array('ID' => $user_id));
        $this->CI->db->update('users', array('YubiKeyRequired' => 1));
        
        if ($this->CI->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    // Make a Yubikey OTP not required for this user to login.
    public function setYubiKeyNotRequired($user_id){
        $this->CI->db->where(array('ID' => $user_id));
        $this->CI->db->update('users', array('YubiKeyRequired' => 0));
        
        if ($this->CI->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    // Add Yubikey to users account without checking its validity.
    public function addYubikey($user_id, $keyid, $server_id){
        if ($this->CI->db->insert('yubikey_authkeys', array('UserID' => $user_id, 'ServerID' => $server_id, 'KeyID' => $keyid, 'Enabled' => 1))){
            return true;
        } else {
            return false;
        }
    }
    
    // Add Yubikey but take an OTP and authenticate it first to check its validity.
    public function addYubikeyAuth($user_id, $otp, $server_id){
        if ($this->_authYubikeyOTP($otp, $server_id)){
            $this->addYubikey($user_id, $this->getYubikeyID($otp), $server_id);
        } else {
            return false;
        }
    }
    
    // Remove Yubikey from users account.
    public function removeYubikey($user_id, $keyid){
        if ($this->CI->db->delete('yubikey_authkeys', array('KeyID' => $keyid, 'UserID' => $user_id))){
            return true;
        } else {
            return false;
        }
    }
    
    public function enableYubikey($user_id, $keyid){
        $this->CI->db->where(array('UserID' => $user_id, 'KeyID' => $keyid));
        $this->CI->db->update('yubikey_authkeys', array('Enabled' => 1));
        
        if ($this->CI->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function disableYubikey($user_id, $keyid){
        $this->CI->db->where(array('UserID' => $user_id, 'KeyID' => $keyid));
        $this->CI->db->update('yubikey_authkeys', array('Enabled' => 0));
        
        if ($this->CI->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    // Get list of Yubikey Servers in the DB
    public function getYubikeyServers(){
        $query = $this->CI->db->select('yubikey_servers');
        
        if ($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    public function addYubikeyServer($url, $api_id, $key){
        if ($this->CI->db->insert('yubikey_servers', array('ServerURL' => $url, 'ClientID' => $api_id, 'ClientKey' => $key, 'Enabled' => 1))){
            return $this->CI->db->insert_id();
        } else {
            return false;
        }
    }
    
    public function removeYubikeyServer($id){
        if ($this->CI->db->delete('yubikey_servers', array('ID' => $id))){
            return true;
        } else {
            return false;
        }
    }
    
    // Return the Yubikey ID from an OTP.
    public function getYubikeyID($otp){
        return substr($otp, 0, 12);
    }
    
    // Check an OTP for a specified user ID.
    public function checkUserYubikeyOTP($user_id, $otp){
        $keyid = $this->getYubikeyID($otp);
        
        // Get details of YubiKey server here from the database to init the YubiAuth class.
        $yubiquery = $this->CI->db->query("SELECT b.ID FROM yubikey_authkeys a JOIN yubikey_servers b ON a.ServerID = b.ID WHERE a.KeyID = " . $this->CI->db->escape($keyid) . " AND a.UserID = " . $this->CI->db->escape($user_id) . " AND a.Enabled = 1");
        if ($yubiquery->num_rows() > 0){
                $yrow = $yubiquery->row_array();
                
                return $this->_authYubikeyOTP($otp, $yrow['ID']);
        } else {
            return false;
        }
    }
    
    // Check an OTP for the user who owns the current session.
    public function checkYubikeyOTP($otp){
        $keyid = $this->getYubikeyID($otp);
        
        // Get details of YubiKey server here from the database to init the YubiAuth class.
        $yubiquery = $this->CI->db->query("SELECT b.ID FROM yubikey_authkeys a JOIN yubikey_servers b ON a.ServerID = b.ID WHERE a.KeyID = " . $this->CI->db->escape($keyid) . " AND a.UserID = " . $this->CI->db->escape($this->currUserID()) . " AND a.Enabled = 1");
        if ($yubiquery->num_rows() > 0){
                $yrow = $yubiquery->row_array();
                
                if ($this->_authYubikeyOTP($otp, $yrow['ID'])){
                    $this->_setLastOTP();
                    return true;
                } else {
                    return false;
                }
        } else {
            return false;
        }
    }
    
    // Function to check an OTP against a server.
    private function _authYubikeyOTP($otp, $server_id){
        // Get details of YubiKey server here from the database to init the YubiAuth class.
        $yubiquery = $this->CI->db->query("SELECT ServerURL, ClientID, ClientKey FROM yubikey_servers WHERE ID = " . $this->CI->db->escape($server_id));
        if ($yubiquery->num_rows() > 0){
                $yrow = $yubiquery->row_array();
        } else {
            return false;
        }
                
        $this->CI->load->library('yubiAuth');
        $this->CI->yubiauth->init($yrow['ClientID'], $yrow['ClientKey']);
        $this->CI->yubiauth->addURLpart($yrow['ServerURL']);
                
        $auth = $this->CI->yubiauth->verify($otp);
                    
        if ((!$auth) || $this->CI->yubiauth->isError){
            return false;
        } else {
            return true;
        }
    }
    
    // Set session data for last time OTP was given by current user.
    private function _setLastOTP(){
        $this->CI->session->set_userdata('lastotp', time());
    }
    
    //-------------------------
    // User provisioning functions.
    //-------------------------

    /**
     * Create a user account
     *
     * @access    public
     * @param    string
     * @param    string
     * @return    bool
    **/
    public function create($user = '', $password = '', $email = '', $firstname = '', $lastname = ''){
        // Make sure we have atleast the basic details.
        if($user == '' || $password == '') {
            return false;
        }
        
        // Check if the user already exists.
        $query = $this->CI->db->get_where('users', array('Username' => $user));
        
        if ($query->num_rows() > 0) {
            // Username already exists
            return false;
        } else {
            if ($this->CI->db->insert('users', array('Username' => $user, 'Password' => 'temp', 'PasswordSalt' => 'temp', 'FirstName' => $firstname, 'LastName' => $lastname, 'EmailAddress' => $email, 'Enabled' => 1))){
                // Ok, we've created the user - Grab the UserID and set the password.
                
                $user_id = $this->CI->db->insert_id();
                
                if ($this->dopasswd($user, $password)){
                    return $user_id;
                } else {
                    $this->delete($user_id);
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    /**
     * Delete user
     *
     * @access    public
     * @param integer
     * @return    bool
    **/
    public function delete($user_id) {
        if($this->CI->db->delete("users", array('id' => $user_id))){
            // Database call was successful, user is deleted.
            return true;
        } else {
            // There was a problem.
            return false;
        }
    }
    
    public function makeAdmin($user_id){
        $this->CI->db->where(array('ID' => $user_id));
        $this->CI->db->update('users', array('Admin' => 1));
        
        if ($this->CI->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function removeAdmin($user_id){
        $this->CI->db->where(array('ID' => $user_id));
        $this->CI->db->update('users', array('Admin' => 0));
        
        if ($this->CI->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function disableUser($user_id){
        $this->CI->db->where(array('ID' => $user_id));
        $this->CI->db->update('users', array('Enabled' => 0));
        
        if ($this->CI->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function enableUser($user_id){
        $this->CI->db->where(array('ID' => $user_id));
        $this->CI->db->update('users', array('Enabled' => 1));
        
        if ($this->CI->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function passwd($username, $password, $newpassword){
        $query = $this->CI->db->query("SELECT Password, PasswordSalt FROM users WHERE Username = " . $this->CI->db->escape($username));
        
        if ($query->num_rows() > 0){
            $row = $query->row_array();
        
            if (( md5( md5($row['PasswordSalt']) . md5($password) ) ) == $row['Password']){
                return $this->dopasswd($username, $newpassword);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function dopasswd($username, $newpassword){
        $newsalt = $this->_genSalt();
        $npw = md5( md5($newsalt) . md5($newpassword) );
        
        $this->CI->db->update('users', array('Password' => $npw, 'PasswordSalt' => $newsalt), array('Username' => $username));
        
        if ($this->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    private function _genSalt(){
        $salt_chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'Z', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
        $rand_keys = array_rand($salt_chars, 5);

        return $salt_chars[$rand_keys[0]] . $salt_chars[$rand_keys[1]] . $salt_chars[$rand_keys[2]] . $salt_chars[$rand_keys[3]] . $salt_chars[$rand_keys[4]];
    }
    
    //-------------------------
    // Login functions
    //-------------------------

    /**
     * Login and sets session variables
     *
     * @access    public
     * @param     string    Username
     * @param     string    Password
     * @param     bool      YubiKey Required
     * @param     bool      Authentication
     * @param     bool      Admin Authentication
     * @return    bool
    **/
    public function login($user = '', $password = '', $yreq = false, $auth = false, $adminAuth = false){
        // Check the login info is present.
        if($user == '' || $password == ''){
            return false;
        }

        // Check if already logged in.
        if($this->CI->session->userdata('username') == $user){
            // This user is already logged in.
            return false;
        }
        
        // Grab the users details from the table.
        $query = $this->CI->db->query("SELECT ID, Username, Password, PasswordSalt, YubiKey, YubiKeyRequired FROM users WHERE Username = " . $this->CI->db->escape($user) . " AND Disabled = 0");
        
        if ($query->num_rows() > 0){
            $row = $query->row_array();
            
            $yubikey = true;
            if ($row['YubiKey'] == 1){
                $yubikey = false;
                if ($yreq || $row['YubiKeyRequired']){
                    if (strlen($password) < 44){
                        return false;
                    }
                
                    $pw = $password;
                    $password = substr($pw, 0, (strlen($pw) - 44));
                    $otp = substr($pw, -44);
                    
                    if ($this->checkUserYubikeyOTP($row['ID'], $otp)){
                        $yubikey = true;
                    } else {
                        return false;
                    }
                }
            }
            
            //Check against password
            if( md5(md5($row['PasswordSalt']) . md5($password)) != $row['Password'] ){
                return false;
            }
            
            if ((!$auth) && (!$adminAuth)){
                // Destroy old session.
                $this->CI->session->sess_destroy();
            
                // Create a fresh, brand new session.
                $this->CI->session->sess_create();
            
                $query2 = $this->CI->db->query("SELECT FirstName, LastName, EmailAddress, Admin FROM users WHERE ID = " . $this->CI->db->escape($row['ID']));
                if ($query2->num_rows() > 0){
                    $row2 = $query2->row_array();
                    $sessiondata = array( 'logged_in' => true, 'userid' => $row['ID'], 'username' => $row['Username'], 'fname' => $row2['FirstName'], 'lname' => $row2['LastName'], 'email' => $row2['EmailAddress'], 'admin' => $row2['Admin'], 'yubikey' => $yubikey );
                    
                    if ($yubikey){
                        $this->_setLastOTP();
                    }
                } else {
                    return false;
                }
            
                // Set session data
                $this->CI->session->set_userdata($sessiondata);
            }
            
            // Login was successful
            if ($adminAuth){
                $query2 = $this->CI->db->query("SELECT ID FROM users WHERE ID = " . $this->CI->db->escape($row['ID']) . " AND Admin = 1");
                if ($query2->num_rows() > 0){
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            // No results found in DB for user.
            return false;
        }
    }
    
    
    /**
     * Create a forced login session as a username.
     *
     * @access  public
     * @param   string  Username
     * @return  bool
    **/
    public function createSession($username){
        // Destroy old session.
        $this->CI->session->sess_destroy();
            
        // Create a fresh, brand new session.
        $this->CI->session->sess_create();
        
        $yubikey = true;
        
        $query2 = $this->CI->db->query("SELECT ID, Username, FirstName, LastName, EmailAddress, Admin FROM users WHERE ID = " . $this->CI->db->escape($row['ID']));
        if ($query2->num_rows() > 0){
            $row2 = $query2->row_array();
            $sessiondata = array( 'logged_in' => true, 'userid' => $row2['ID'], 'username' => $row2['Username'], 'fname' => $row2['FirstName'], 'lname' => $row2['LastName'], 'email' => $row2['EmailAddress'], 'admin' => $row2['Admin'], 'yubikey' => $yubikey );
        } else {
            return false;
        }
            
        // Set session data
        $this->CI->session->set_userdata($sessiondata);
        
        return true;
    }
    
    /**
     * Authenticate without altering session.
     *
     * @access  public
     * @param   string  Username
     * @param   string  Password
     * @param   bool    YubiKey Required
     * @return  bool
    **/
    public function auth($username = '', $password = '', $yreq = false){
        return $this->login($username, $password, $yreq, true);
    }
    
    /**
     * Admin Login
     *
     * @access  public
     * @param   string  Username
     * @param   string  Password
     * @param   bool    YubiKey Required
     * @return  bool
    **/
    public function adminLogin($username = '', $password = '', $yreq = false){
        if ($this->login($username, $password, $yreq)){
            if ($this->is_admin()){
                return true;
            } else {
                $this->logout();
                return false;
            }
        } else {
            return false;
        }
    }
    
    /**
     * Admin authentication without altering session.
     *
     * @access  public
     * @param   string  Username
     * @param   string  Password
     * @param   bool    YubiKey Required
     * @return  bool
    **/
    public function adminAuth($username = '', $password = '', $yreq = false){
        return $this->login($username, $password, $yreq, false, true);
    }

    /**
     * Logout user
     *
     * @access    public
     * @return    void
    **/
    public function logout() {
        //Destroy session
        $this->CI->session->sess_destroy();
        
        redirect('/login');
    }
}

/* End of File */