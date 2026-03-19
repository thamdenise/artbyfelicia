<?php
class AdminController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/AdminModel');
        $this->load->helper('url');
    }
    public function index()
    {

        $data['result'] = 1;
        $password = 'YTABF08';
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        // echo $hashed_password;
        // die;
        $prms = $this->input->post();
        if ($prms) {

            $factory = new JeffOchoa\ValidatorFactory();
            $rules = [
                "adminusername" => "required|alpha",
                "adminpassword" => "required|alpha_dash",
            ];
            $validator = $factory->make($prms, $rules);
            //   echo $validator->passes();
            //   echo var_dump($this->response($validator->errors(), true, false));
            //   die;
            if (!$validator->passes()) {
                die;
                return $this->response($validator->errors(), true, false);
            }
            $username = $prms['adminusername'];
            $password = $prms['adminpassword'];

            if (!empty($username) && !empty($password)) {

                $resultLoginAdmin = $this->AdminModel->list(['username' => $username], false, true);
                if (!empty($resultLoginAdmin)) {
                    $hash = $resultLoginAdmin->password;
                    if (password_verify($password, $hash)) {
                        $this->session->set_userdata('session_admin_login', 1);
                        $this->session->set_userdata('admin_id', $resultLoginAdmin->id);
                        redirect(base_url('/admin/blogs'));
                    } else {
                        //$this->session->set_userdata('session_admin_login', '0');
                        $this->session->sess_destroy();
                        $data['result'] = 0;
                    }
                } else {
                    //$this->session->set_userdata('session_admin_login', 0);
                    $this->session->sess_destroy();
                    $data['result'] = 0;
                }
            }
        }

        $data['title'] = 'Admin Dashboard';
        $this->load->view('admin/login', $data);
    }

    public function logout()
    {
        $this->load->helper('url');
        $data['title'] = 'Admin Logout';
        $this->session->set_userdata('session_admin_login', '0');
        redirect(base_url('/admin'));
    }
}
