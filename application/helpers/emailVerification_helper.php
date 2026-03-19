 <?php 




    function emailVerification()
    {
        $CI =&get_instance();
        $CI->load->model('UserModel');
        $result = $CI->UserModel->list();
        return $result;

    }


?>