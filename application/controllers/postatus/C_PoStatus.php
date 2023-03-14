<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class C_PoStatus extends CI_Controller

{


    function __construct()
    {
        parent::__construct();
        $this->load->model('PO/M_Postatus');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['title'] = 'PO Status';
        $data['po']    = $this->M_Postatus->getAll();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/body', $data);
        $this->load->view('partial/footer');
    }

    public function detailPO($kdpo)
    {
        $data['title'] = 'PO Status';
        $data['detail'] = $this->M_Postatus->getDetail($kdpo);
        $data['status'] = $this->M_Postatus->getdataStatus($kdpo);
        $data['total']  = $this->M_Postatus->sumTransaksiPenjualan($kdpo);

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/detailpo', $data);
        $this->load->view('partial/footer');
    }

    public function printOrder($kdpo)
    {
        $data['title'] = 'PRINT ORDER';
        $data['detail'] = $this->M_Postatus->getDetail($kdpo);
        $data['status'] = $this->M_Postatus->getdataStatus($kdpo);
        $data['total']  = $this->M_Postatus->sumTransaksiPenjualan($kdpo);

        $this->load->view('partial/header', $data);
        $this->load->view('content/postatus/printorder', $data);
        $this->load->view('partial/footerPrint');
    }
}
