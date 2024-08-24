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
        $this->load->model('PO/M_Postatus');
        $this->load->model('PO/M_Purchase');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'List Stock Non Komersil';
        $data['stocknk'] = $this->M_Stocknonkomersil->v_stock();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/stock/nonkomersil/body.php', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/stock/nonkomersil/datatables');
    }

    public function list_stock_non_komersil_po()
    {
        $data['title'] = 'list stock tersedia';
        $data['stocknk'] = $this->M_Stocknonkomersil->getallbarang()->result();
        $data['satuan'] = $this->M_Stocknonkomersil->getSatuan();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content\stock\nonkomersil\list_stock_po_nonkomersil.php', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/stock/nonkomersil/datatables');
    }

    public function tmp_add_barang_komersil()
    {
        $kdbarang   = $this->input->post('kd_isi');
        $namabarang = $this->input->post('nama_isi');
        $descbarang  = $this->input->post('desc_isi');
        $ketbarang  = $this->input->post('ket_isi');
        $qtybarang  = $this->input->post('qty_isi');
        $hrgsatuan  = $this->input->post('hrg_isi');
        $kduser     = $this->session->userdata('kode');
        $totalharga = $qtybarang * $hrgsatuan;

        $dataBarang = array(
            'nama_barang'   => $namabarang,
            'deskripsi'     => $descbarang,
            'keterangan'    => $ketbarang,
            'qty'           => $qtybarang,
            'hrg_satuan'    => $hrgsatuan,
            'total_harga'   => $totalharga,
            'kd_barang'     => $kdbarang,
            'kd_user'       => $kduser,
            'gbr_produk'    => 'Karisma.png'
        );
        $kdgenerate = array(
            'kd_barang' => $kdbarang
        );

        $this->M_Purchase->generatekd($kdgenerate);
        $this->M_Purchase->input_tmp_nk($dataBarang);

        redirect('pononkomersil');
    }
    public function detailtransaksi($kdbarang)
    {
        $data['title']  = 'Detail Stock Barang';
        $data['item']   = $this->M_Stocknonkomersil->get_data_item($kdbarang)->result();
        $data['stock'] = $this->M_Stocknonkomersil->get_detail_transaksi_itm($kdbarang)->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/stock/nonkomersil/detail_itm_tr.php', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/stock/nonkomersil/datatables');
    }
}
