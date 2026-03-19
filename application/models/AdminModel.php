<?php

class AdminModel extends CI_Model
{
    //public $tableName;
    protected $correct_auth_key; 
    public function __construct(){
        parent::__construct();
        //$this->tableName = "admin";
        $this->load->helper('url');

        $this->correct_auth_key = "gWZCzk6AJ7cHQ4TLBosGZoolAtHMerAk==";
    }
    
    public function checkAdminToken(){
        if (empty($this->session->userdata('session_admin_login'))) {
            redirect('/admin');
        }
    }
    //set a uniqid in to session everytime the form load in controller
    public function setAdminFormSubmitToken()
    {
        $token = "admin_".uniqid();
        $this->session->set_userdata($token, true);
        return $token;
    }
    //check the uniqid in post and session to avaoid duplicate submit
    public function checkAdminFormSubmitToken($token)
    {
        if ($this->session->userdata($token)) {
            $this->session->unset_userdata($token);
            return true;
        }
        return false;
    }
    public function authorisation(){
        if (!isset($_SERVER['HTTP_MW_X_API_KEY']) || empty($_SERVER['HTTP_MW_X_API_KEY'])) {
            http_response_code(401); // Unauthorized
            exit('Unauthorized access: API key is missing or empty');
        }
        $auth_key = $_SERVER['HTTP_MW_X_API_KEY'];

        $correct_auth_key = $this->correct_auth_key;
 

        if (!($auth_key === $correct_auth_key)) {
            http_response_code(401); // Unauthorized
            header('HTTP/1.1 401 Unauthorized');
            exit('Invalid credentials');
        }
    }//end of authorisation
}//end of class AdminModel

?>