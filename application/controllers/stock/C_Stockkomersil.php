<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class C_Stockkomersil extends CI_Controller

{

    function __construct()
    {
        parent::__construct();
        $this->load->model('stock/M_Stockkomersil');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'User';


        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/stock/komersil/bodystock.php', $data);
        $this->load->view('partial/footer');
    }
}
