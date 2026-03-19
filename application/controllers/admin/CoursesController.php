<?php
//test002
class CoursesController extends CI_Controller
{
    private $uploadConfig = "";
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('admin/AdminModel');
        $this->load->model('CoursesModel');

        $this->uploadConfig = [
            'upload_path' => 'application/',
            'file_name' => 'none',
            'allowed_types' => '*',
            'max_size' => 10000
        ];

        if ($this->session->userdata('session_admin_login') !== 1) {
            redirect('/admin');
        }
    }

    public function index()
    {
        $this->load->helper('url');
        $data['title'] = 'Courses';
        $userSession =  $this->session->all_userdata();

        $coursesList = $this->CoursesModel->list([], true, false, "ASC", "sort_order");
        $data['coursesList'] = $coursesList;
        $this->load->library("pagination");
        $total_records = count($coursesList);
        if ($total_records > 0) {
            $data['results'] = $coursesList;
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }
        $this->load->view('admin/header-admin.php');
        if ($total_records > 0) {
            $this->load->view('admin/courses', $data);
        }
    }

    public function addCourse()
    {
        $this->load->helper('url');

        $post = $this->input->post();
        if ($post) {
            $duplicate_submit = $this->AdminModel->checkAdminFormSubmitToken($post['admin_form_submit_token']);
            if (empty($duplicate_submit)) {
                exit("duplicate submit detect, admin please check the submited result.");
            }
            $this->uploadConfig['upload_path'] = 'uploads/courses/';
            if (!file_exists($this->uploadConfig['upload_path'])) {
                mkdir($this->uploadConfig['upload_path'], 0755, true);
            }
            $this->uploadConfig['file_name'] = "course_" . rand() . "_" . time();
            if ($this->upload_file('course_image')) {
                if (!empty($this->uploadConfig['file_name'])) {
                    $post['course_image'] = $this->uploadConfig['file_name'];
                }
            }
            if (empty($post['course_image'])) {
                exit("empty file");
            }
            $courseData = array(
                'image' => $post['course_image'],
                'name' => $post['name'],
                'description' => $post['description'],
                'duration' => $post['duration'],
                'text_message' => $post['text_message'],
                'sort_order' => $this->CoursesModel->getNextSortOrder(),
            );
            $storeSuccess = $this->CoursesModel->store($courseData);
            if ($storeSuccess) {
                redirect(base_url("admin/courses"));
            }
        } //end if($post)

        $data['admin_form_submit_token'] = $this->AdminModel->setAdminFormSubmitToken();

        $this->load->view('admin/header-admin.php');
        $this->load->view('admin/add-course', $data);
    }

    public function upload_file($post_file_name)
    {
        $this->load->library('upload', $this->uploadConfig);
        if (!$this->upload->do_upload($post_file_name)) {
            $error = array('error' => $this->upload->display_errors());
            exit(var_dump($error));
            $status = false;
        } else {
            $data = array('upload_data' => $this->upload->data());
            $this->uploadConfig['file_name'] = $data['upload_data']['file_name'];
            $status = true;
        }
        unset($this->upload);
        return $status;
    }

    public function deleteCourse($id, $fileName)
    {
        $isDeleted = $this->CoursesModel->deleteCourseById($id);
        if ($isDeleted == true) {
            $ftp_file = "uploads/blog/{$fileName}";
            if (unlink($ftp_file) == true) {
                redirect(base_url("admin/courses"));
            } else {
                exit('Delete failed.');
            }
        } else {
            exit('Delete failed.');
        }
    }

    public function editCourse($id)
    {
        $this->load->helper('url');
        $course = $this->CoursesModel->getCourseById($id)[0];
        $data['results'] = $course;

        $post = $this->input->post();
        if ($post) {
            $duplicate_submit = $this->AdminModel->checkAdminFormSubmitToken($post['admin_form_submit_token']);
            if (empty($duplicate_submit)) {
                exit("duplicate submit detect, admin please check the submited result.");
            }
            $postData = array(
                'id' => $id,
                'name' => $post['name'],
                'description' => $post['description'],
                'duration' => $post['duration'],
                'text_message' => $post['text_message']
            );

            $this->uploadConfig['upload_path'] = 'uploads/courses/';
            if (!file_exists($this->uploadConfig['upload_path'])) {
                mkdir($this->uploadConfig['upload_path'], 0755, true);
            }
            if (!empty($_FILES['course_image']['name'])) {
                $this->uploadConfig['file_name'] = "course_" . rand() . "_" . time();
                if ($this->upload_file('course_image')) {
                    if (!empty($this->uploadConfig['file_name'])) {
                        $postData['image'] = $this->uploadConfig['file_name'];
                    }
                }
            }
            $editSuccess = $this->CoursesModel->edit($postData, ['id']);
            if ($editSuccess == true) {
                redirect(base_url("admin/courses"));
            } else {
                exit("Edit failed");
            }
        }


        $data['admin_form_submit_token'] = $this->AdminModel->setAdminFormSubmitToken();

        $this->load->view('admin/header-admin.php');
        $this->load->view('admin/edit-course', $data);
    }

    public function reorderCourses()
    {
        $order = $this->input->post('order');
        if (empty($order) || !is_array($order)) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Invalid order payload.']));
            return;
        }

        $updated = $this->CoursesModel->updateSortOrder($order);
        if ($updated === false) {
            $this->output
                ->set_status_header(500)
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Failed to save order.']));
            return;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['success' => true]));
    }

}
