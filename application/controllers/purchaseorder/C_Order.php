<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class C_Order extends CI_Controller

{
    function __construct()
    {
        parent::__construct();
        $this->load->model('PO/M_Purchase');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['title'] = 'Purchase Order';
        $data["suplier"] = $this->M_Purchase->getSuplier();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/body', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/datatables');
    }

    public function purchaseSuplier($kdsuplier)
    {
        $data['title'] = 'Purchase Order';
        $data['kode_suplier'] = $this->M_Purchase->Suplier($kdsuplier)->result();
        $data["barang"] = $this->M_Purchase->getBarangSup($kdsuplier)->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/purchase', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/datatables');
    }

    public function addBarangSup($kdsuplier)
    {
        $data['title'] = 'Add Item List';
        $data['kode_suplier'] = $this->M_Purchase->Suplier($kdsuplier)->result();
        $data['barang'] = $this->M_Purchase->getBarangSup($kdsuplier)->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/listbarang', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/datatables');
    }

    public function addChart()
    {
        $kdbarang   = $this->input->post('kd_isi');
        $nmbarang   = $this->input->post('nama_isi');
        $satuan     = $this->input->post('satuan_isi');
        $qty        = $this->input->post('qty_isi');
        $tax        = $this->input->post('tax_isi');
        $hargaQty   = $this->input->post('hrg_isi');
        $hargaTax   = $hargaQty * $tax;
        $hasiltax   = $hargaTax + $hargaQty;
        $hargahasil = $hasiltax * $qty;

        $data = array(
            
        );
    }
}
