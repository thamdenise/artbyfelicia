<?php

class AdminModel extends CI_Model
{
    public $admin_user, $tableName;
    public function __construct()
    {
        $this->tableName = "admin_user";
        $this->load->helper('url');
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

    public function LoginCheck($userName, $password)
    {

        $userSession =  $this->session->all_userdata();

        $query = $this->db->query("SELECT * FROM _admin_user WHERE username='$userName'");
        $resultLoginAdmin = $query->result();


        if (count($resultLoginAdmin) > 0) {
            $hashed_password = $resultLoginAdmin[0]->password;
            if (password_verify($password, $hashed_password)) {
                $this->session->set_userdata('session_admin_login', '1');
                $this->session->set_userdata('admin_id', $resultLoginAdmin[0]->id);
                redirect(base_url('/admin/blogs'));
            } else {
                $this->session->set_userdata('session_admin_login', '0');
                return 0;
            }
        } else {
            $this->session->set_userdata('session_admin_login', '0');
            return 0;
        }
    }
    public function verifyPass($password)
    {
        $admin_id = $this->session->userdata("admin_id");
        $result = $this->db->where(["id" => $admin_id])->get($this->tableName)->row();
        if (empty($result)) {
            return false;
        } else {
            $hashed_password = $result->password;
            return password_verify($password, $hashed_password);
        }
    }

    public function getStatistics()
    {
        $statsArray = array();

        $userQuery = $this->db->query("SELECT count(*) as count from sw_users");
        $users =  $userQuery->result();

        $orderQuery = $this->db->query("SELECT count(*) as count from sw_stripe_invoice");
        $orders =  $orderQuery->result();

        $subQuery = $this->db->query("SELECT count(*) as count from sw_subscriptions WHERE is_deleted = 0");
        $subscriptions =  $subQuery->result();

        $failedQuery = $this->db->query("SELECT sum(c) as s   FROM (SELECT count(*) as c FROM sw_stripe_invoice_error
                                         group by customer_token ) as foo");
        $failedPayment =  $failedQuery->result();

        array_push($statsArray, $users[0]->count);
        array_push($statsArray, $orders[0]->count);
        array_push($statsArray, $subscriptions[0]->count);
        array_push($statsArray, $failedPayment[0]->s);

        return $statsArray;
    }

    public function checkAdminLoggedIn()
    {
        $userSession =  $this->session->all_userdata();
        if ($userSession['session_admin_login'] == 0) {
            redirect(base_url('/admin'));
        }
    }
}
