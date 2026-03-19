<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GalleryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('GalleryModel');
    }

    public function index()
    {
        $data['title'] = 'Art Gallery';
        $data['images'] = $this->GalleryModel->list([], true, false, "ASC", "sort_order");

        $this->load->view('header', $data);
        $this->load->view('gallery', $data);
        $this->load->view('footer', $data);
    }
}
