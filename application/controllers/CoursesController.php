<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CoursesController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('CoursesModel');
    }

    public function index()
    {
        $data['title'] = 'Courses by Felicia';
        $data['courses'] = $this->CoursesModel->list([], true, false, "ASC", "sort_order");
        $this->load->view('header', $data);
        $this->load->view('courses', $data);
        $this->load->view('footer', $data);
    }
}
