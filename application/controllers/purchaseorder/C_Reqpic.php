<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class C_Reqpic extends CI_Controller

{

    function __construct()
    {
        parent::__construct();
        $this->load->model('PO/M_Reqpic');
        $this->load->model('PO/M_Purchase');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $kduser = $this->session->userdata('kode');

        $data['title']      = 'PO Request By PIC ';
        $data['tmpreq']     = $this->M_Reqpic->getalltmpreq($kduser)->result();
        $data['getallreq']  = $this->M_Reqpic->getallreq($kduser)->result();
        $data['countreq']   = $this->M_Reqpic->countRequser('2', $kduser);
        $data['generatekd'] = $this->M_Purchase->kdnonkomersial();
        $data['jumlahbr']   = $this->M_Reqpic->countjmltmpbr($kduser);

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/Reqpic/body', $data);
        $this->load->view('partial/footer');
    }
    public function list_barang_ready()
    {
        $data['title']  = 'List Barang PO';
        $data['lstock'] = $this->M_Reqpic->getlistnkreq()->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/Reqpic/listbarang', $data);
        $this->load->view('partial/footer');
    }
    public function addtmpreqbarang()
    {
        $kduser     = $this->session->userdata('kode');
        $nmbarang   = $this->input->post('nm_barang');
        $desc       = $this->input->post('descnk_isi');
        $ket        = $this->input->post('ket_isi');
        $qty        = $this->input->post('qty_isi');
        $kdbarang   = $this->input->post('kdbr');
        $kdsys      = $this->input->post('kdbys');
        $katbarang  = $this->input->post('katbr');

        $inputtmp = array(
            'jnis_po'       => '2',
            'nama_barang'   => $nmbarang,
            'deskripsi'     => $desc,
            'keterangan'    => $ket,
            'qty'           => $qty,
            'hrg_satuan'    => '0',
            'total_harga'   => '0',
            'kd_bsys'       => $kdsys,
            'kd_barang'     => $kdbarang,
            'kat_barang'    => $katbarang,
            'kd_user'       => $kduser
        );
        $this->M_Reqpic->inputreqbr($inputtmp);
        redirect('reqpic');
    }

    public function addnewreq($kduser)
    {
        date_default_timezone_set("Asia/Jakarta");
        $nmuser = $this->session->userdata('nama_user');
        $dep    = $this->session->userdata('departemen');
        $kdponk = $this->input->post('kdponk');
        $totbr  = $this->input->post('totbr');
        $nopo   = $kduser . 'NK';
        $now    = date('Y-m-d');

        $tmp    = $this->M_Reqpic->get_tmp_non_komersil($kduser);

        $inpdataponk = array(
            'jns_po'        => '2',
            'kd_po_nk'      => $kdponk,
            'nopo'          => $nopo,
            'kd_user'       => $kduser,
            'nm_user'       => $nmuser,
            'tgl_transaksi' => $now,
            'jml_item'      => $totbr,
            'total_harga'   => '0',
            'status'        => 'ON PROGRESS',
            'departemen'    => $dep,
            'tj_pembelian'  => 'REQUEST PIC'
        );
        $this->M_Reqpic->inputreq($inpdataponk);

        if ($tmp) {
            foreach ($tmp as $t) {
                $listdetreq = array(
                    'kd_po_nk'          => $kdponk,
                    'kd_user'           => $kduser,
                    'tgl_transaksi'     => $now,
                    'kd_bsys'           => $t->kd_bsys,
                    'kd_barang'         => $t->kd_barang,
                    'nama_barang'       => $t->nama_barang,
                    'deskripsi'         => $t->deskripsi,
                    'keterangan'        => $t->keterangan,
                    'qty'               => $t->qty,
                    'hrg_satuan'        => $t->hrg_satuan,
                    'hrg_nyata'         => '0',
                    'total_harga'       => $t->total_harga,
                    'total_nyata'       => '0',
                );
                $this->M_Purchase->input_detail_po_nk($listdetreq);
            }
            $this->M_Purchase->hapus_tmp_nk($kduser);
            redirect('reqpic');
        }
    }

    public function detreqbarangpic($kdpo)
    {
        $data['title']      = 'PO Detail Req PIC';

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/Reqpic/detreq', $data);
        $this->load->view('partial/footer');
    }
}
