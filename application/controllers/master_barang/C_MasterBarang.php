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
        $this->load->model('Master_barang/M_MasterBarang');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title']      = 'Master Barang';
        $data['barangnk']   = $this->M_MasterBarang->get_all_masterbarang()->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/mbarang/mbody', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/mbarang/datatables');
    }
}
