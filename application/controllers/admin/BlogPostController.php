<?php
//test002
class BlogPostController extends CI_Controller
{
    private $uploadConfig = "";
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('admin/AdminModel');
        $this->load->model('BlogPostModel');

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
        $data['title'] = 'BlogPost';
        $userSession =  $this->session->all_userdata();

        $blogpostLists = $this->BlogPostModel->getBlogPostLists();
        $data['blogpostLists'] = $blogpostLists;
        $this->load->library("pagination");
        $total_records = $this->BlogPostModel->getTotalBlog();
        if ($total_records > 0) {
            $data['results'] = $blogpostLists;
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }
        $this->load->view('admin/header-admin.php');
        if ($total_records > 0) {
            $this->load->view('admin/blogs', $data);
        }
    }

    public function addBlogPost()
    {
        $this->load->helper('url');

        $post = $this->input->post();
        if ($post) {
            $duplicate_submit = $this->AdminModel->checkAdminFormSubmitToken($post['admin_form_submit_token']);
            if (empty($duplicate_submit)) {
                exit("duplicate submit detect, admin please check the submited result.");
            }
            $this->uploadConfig['upload_path'] = 'uploads/blog/';
            if (!file_exists($this->uploadConfig['upload_path'])) {
                mkdir($this->uploadConfig['upload_path'], 0755, true);
            }
            $this->uploadConfig['file_name'] = "blogpost_" . rand() . "_" . time();
            if ($this->upload_file('blogpost_image')) {
                if (!empty($this->uploadConfig['file_name'])) {
                    $post['blogpost_image'] = $this->uploadConfig['file_name'];
                }
            }
            if (empty($post['blogpost_image'])) {
                exit("empty file");
            }
            $blogpostData = array(
                'image' => $post['blogpost_image'],
                'title' => $post['blogpost_title'],
                'image_alt' => $post['blogpost_image_alt'],
                'meta_title' => $post['blogpost_meta_title'],
                'meta_desc' => $post['blogpost_meta_desc'],
                'content' => $post['blogpost_content'],
                'published_at' => strtotime($post['publish_date'])
            );
            $storeSuccess = $this->BlogPostModel->store($blogpostData);
            if ($storeSuccess) {
                redirect(base_url("admin/blogs"));
            }
        } //end if($post)

        $data['admin_form_submit_token'] = $this->AdminModel->setAdminFormSubmitToken();

        $this->load->view('admin/header-admin.php');
        $this->load->view('admin/add-blog', $data);
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

    public function deleteBlog($id, $fileName)
    {
        $isDeleted = $this->BlogPostModel->deleteBlogPostById($id);
        if ($isDeleted == true) {
            $ftp_file = "uploads/blog/{$fileName}";
            if (unlink($ftp_file) == true) {
                redirect(base_url("admin/blogs"));
            } else {
                exit('Delete failed.');
            }
        } else {
            exit('Delete failed.');
        }
    }

    public function editBlogPost($id)
    {
        $this->load->helper('url');
        $blogpost = $this->BlogPostModel->getBlogPostById($id)[0];
        $data['results'] = $blogpost;

        $post = $this->input->post();
        if ($post) {
            $duplicate_submit = $this->AdminModel->checkAdminFormSubmitToken($post['admin_form_submit_token']);
            if (empty($duplicate_submit)) {
                exit("duplicate submit detect, admin please check the submited result.");
            }
            $postData = array(
                'id' => $id,
                'title' => $post['blogpost_title'],
                'image_alt' => $post['blogpost_image_alt'],
                'meta_title' => $post['blogpost_meta_title'],
                'meta_desc' => $post['blogpost_meta_desc'],
                'content' => $post['blogpost_content'],
                'published_at' => strtotime($post['publish_date'])
            );

            $this->uploadConfig['upload_path'] = 'uploads/blog/';
            if (!file_exists($this->uploadConfig['upload_path'])) {
                mkdir($this->uploadConfig['upload_path'], 0755, true);
            }
            if (!empty($_FILES['blogpost_image']['name'])) {
                $this->uploadConfig['file_name'] = "blogpost_" . rand() . "_" . time();
                if ($this->upload_file('blogpost_image')) {
                    if (!empty($this->uploadConfig['file_name'])) {
                        $postData['image'] = $this->uploadConfig['file_name'];
                    }
                }
            }
            if (!empty($_FILES['blogpost_author_image']['name'])) {
                $this->uploadConfig['file_name'] = "blogpost_" . rand() . "_" . time();
                if ($this->upload_file('blogpost_author_image')) {
                    if (!empty($this->uploadConfig['file_name'])) {
                        $postData['author_image'] = $this->uploadConfig['file_name'];
                    }
                }
            }
            $editSuccess = $this->BlogPostModel->edit($postData, ['id']);
            if ($editSuccess == true) {
                redirect(base_url("admin/blogs"));
            } else {
                exit("Edit failed");
            }
        }


        $data['admin_form_submit_token'] = $this->AdminModel->setAdminFormSubmitToken();

        $this->load->view('admin/header-admin.php');
        $this->load->view('admin/edit-blog', $data);
    }

}
