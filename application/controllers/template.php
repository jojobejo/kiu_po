<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class nama_controller extends CI_Controller

{


    function __construct()
    {
        parent::__construct();
        $this->load->model('User/M_User');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('status') != "is_login" || $this->session->userdata('lv') != "1") {
            redirect("login");
        }

        $data['page_title'] = 'User';

        $this->load->view('partial/user/head', $data);
        $this->load->view('partial/menu.php');
        $this->load->view('content/user/body', $data);
        $this->load->view('partial/user/footer');
    }

}
