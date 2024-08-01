<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class C_Stocknonkomersil extends CI_Controller

{

    function __construct()
    {
        parent::__construct();
        $this->load->model('stock/M_Stocknonkomersil');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['title'] = 'List Stock Non Komersil';
        $data['stocknk'] = $this->M_Stocknonkomersil->getAll();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/stock/nonkomersil/body.php', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/stock/nonkomersil/datatables');
    }

    public function list_stock_non_komersil_po()
    {
        $data['title'] = 'list stock tersedia';
        $data['stocknk'] = $this->M_Stocknonkomersil->getAll();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content\stock\nonkomersil\list_stock_po_nonkomersil.php', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/stock/nonkomersil/datatables');
    }
}
