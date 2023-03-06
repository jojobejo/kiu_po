<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class C_MasterBarang extends CI_Controller

{


    function __construct()
    {
        parent::__construct();
        $this->load->model('/');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['title'] = 'Master Barang';
        $data["user"] = $this->M_User->getAll();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/', $data);
        $this->load->view('partial/footer');
    }
}
