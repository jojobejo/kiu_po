<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class C_Laporan extends CI_Controller

{


    function __construct()
    {
        parent::__construct();
        $this->load->model('laporan/M_Laporanp');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['title'] = 'Laporan Pembelian';

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/laporan/laporan_p', $data);
        $this->load->view('partial/footer');
    }
    public function srclapbeli()
    {
        $data['title']  = 'Laporan Pembelian';
        $tglstart   = $this->input->post('');
        $tglend     = $this->input->post('');

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/laporan/srclaporan', $data);
        $this->load->view('partial/footer');
    }
}
