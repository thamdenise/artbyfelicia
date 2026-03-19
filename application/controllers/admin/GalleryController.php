<?php
//test002
class GalleryController extends CI_Controller
{
    private $uploadConfig = "";
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('admin/AdminModel');
        $this->load->model('GalleryModel');

        $this->uploadConfig = [
            'upload_path' => 'application/',
            'file_name' => 'none',
            'allowed_types' => 'gif|jpg|jpeg|png|webp',
            'max_size' => 10000
        ];

        if ($this->session->userdata('session_admin_login') !== 1) {
            redirect('/admin');
        }
    }

    public function index()
    {
        $this->load->helper('url');
        $data['title'] = 'Gallery';
        $userSession =  $this->session->all_userdata();

        $images = $this->GalleryModel->list([], true, false, "ASC", "sort_order");
        $data['results'] = $images;
        $data['total_records'] = count($images);
        $this->load->view('admin/header-admin.php');
        $this->load->view('admin/gallery.php', $data);
    }

    public function addImage()
    {
        $this->load->helper('url');

        $post = $this->input->post();
        if ($post) {
            $duplicate_submit = $this->AdminModel->checkAdminFormSubmitToken($post['admin_form_submit_token']);
            if (empty($duplicate_submit)) {
                exit("duplicate submit detect, admin please check the submited result.");
            }
            $this->uploadConfig['upload_path'] = 'uploads/gallery/';
            if (!file_exists($this->uploadConfig['upload_path'])) {
                mkdir($this->uploadConfig['upload_path'], 0755, true);
            }
            $this->uploadConfig['file_name'] = "gallery_" . rand() . "_" . time();
            if ($this->upload_file('gallery_image')) {
                if (!empty($this->uploadConfig['file_name'])) {
                    $post['gallery_image'] = $this->uploadConfig['file_name'];
                }
            }
            if (empty($post['gallery_image'])) {
                exit("empty file");
            }
            $caption = isset($post['image_caption']) ? trim($post['image_caption']) : '';
            if (empty($caption)) {
                exit("caption required");
            }

            $imageData = array(
                'image' => $post['gallery_image'],
                'name' => $caption,
                'sort_order' => $this->GalleryModel->getNextSortOrder(),
            );
            $storeSuccess = $this->GalleryModel->store($imageData);
            if ($storeSuccess) {
                redirect(base_url("admin/gallery"));
            }
        } //end if($post)

        $data['admin_form_submit_token'] = $this->AdminModel->setAdminFormSubmitToken();

        $this->load->view('admin/header-admin.php');
        $this->load->view('admin/add-image', $data);
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

    public function deleteImage($id)
    {
        $imageData = $this->GalleryModel->list(['id' => $id], true, true);
        if (empty($imageData)) {
            exit('Image not found.');
        }
        $image = $imageData['image'];
        $isDeleted = $this->GalleryModel->remove(['id' => $id]);
        if ($isDeleted > 0) {
            $ftp_file = "uploads/gallery/{$image}";
            if (file_exists($ftp_file)) {
                unlink($ftp_file);
            }
            redirect(base_url("admin/gallery"));
        } else {
            exit('Delete failed.');
        }
    }

    public function editImage($id)
    {
        $this->load->helper('url');
        $this->load->helper('form');

        $imageData = $this->GalleryModel->list(['id' => $id], true, true);
        if (empty($imageData)) {
            exit('Image not found.');
        }

        $post = $this->input->post();
        if ($post) {
            $duplicate_submit = $this->AdminModel->checkAdminFormSubmitToken($post['admin_form_submit_token']);
            if (empty($duplicate_submit)) {
                exit("duplicate submit detect, admin please check the submited result.");
            }

            $caption = isset($post['image_caption']) ? trim($post['image_caption']) : '';
            if (empty($caption)) {
                exit("caption required");
            }

            $updateData = array(
                'id' => $id,
                'name' => $caption,
            );

            $this->uploadConfig['upload_path'] = 'uploads/gallery/';
            if (!file_exists($this->uploadConfig['upload_path'])) {
                mkdir($this->uploadConfig['upload_path'], 0755, true);
            }

            if (!empty($_FILES['gallery_image']['name'])) {
                $this->uploadConfig['file_name'] = "gallery_" . rand() . "_" . time();
                if ($this->upload_file('gallery_image')) {
                    if (!empty($this->uploadConfig['file_name'])) {
                        $updateData['image'] = $this->uploadConfig['file_name'];
                    }
                }
            }

            $editSuccess = $this->GalleryModel->edit($updateData, ['id']);
            if ($editSuccess >= 0) {
                if (!empty($updateData['image']) && !empty($imageData['image'])) {
                    $oldFile = "uploads/gallery/{$imageData['image']}";
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }
                redirect(base_url("admin/gallery"));
            } else {
                exit("Edit failed");
            }
        }

        $data['imageData'] = $imageData;
        $data['admin_form_submit_token'] = $this->AdminModel->setAdminFormSubmitToken();

        $this->load->view('admin/header-admin.php');
        $this->load->view('admin/edit-image', $data);
    }

    public function reorderImages()
    {
        $order = $this->input->post('order');
        if (empty($order) || !is_array($order)) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Invalid order payload.']));
            return;
        }

        $updated = $this->GalleryModel->updateSortOrder($order);
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
