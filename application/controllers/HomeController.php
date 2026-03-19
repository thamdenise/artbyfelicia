<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('CoursesModel');
    }

    public function index()
    {
        $data['title'] = 'Art by Felicia';
        $data['courses'] = $this->CoursesModel->list();
        $this->load->view('header', $data);
        $this->load->view('HomeView', $data);
        $this->load->view('footer', $data);
    }
}
