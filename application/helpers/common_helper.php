 <?php 

    function test()
    {
        $CI =&get_instance();
        $CI->load->model('UserModel');
        $result = $CI->UserModel->list();
        return $result;

    }

    function asset_url(){
        return base_url().'assets/';
     }
