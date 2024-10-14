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
        $data['title']      = 'Detail Stock Barang';
        $data['kdgenerate'] = $this->M_Stocknonkomersil->getgeneratekd();
        $data['item']       = $this->M_Stocknonkomersil->get_data_item($kdbarang)->result();
        $data['stock']      = $this->M_Stocknonkomersil->get_detail_transaksi_itm($kdbarang)->result();
        $data['note']       = $this->M_Stocknonkomersil->get_note($kdbarang);

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/stock/nonkomersil/detail_itm_tr.php', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/stock/nonkomersil/datatables');
    }
    public function revisitr($akun, $kdpo, $kdbr)
    {
        $data['title']      = 'Revisi Qty Persedian';
        if ($akun == '11511') {
            $data['stockdet']   = $this->M_Stocknonkomersil->get_detail_br_rev_buy($kdpo, $kdbr)->result();
        } else {
            $data['stockdet']   = $this->M_Stocknonkomersil->get_detail_br_rev_req($kdpo, $kdbr)->result();
        }


        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/stock/nonkomersil/revisitr', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/stock/nonkomersil/datatables');
    }
    public function adjustmenqty()
    {
        date_default_timezone_set("Asia/Jakarta");
        $adjustmentkd   = $this->input->post('adjustmentkd');
        $kdbrsistem     = $this->input->post('kdbrsistem');
        $kdbarang       = $this->input->post('kdbarang');
        $katbarang      = $this->input->post('katbarang');
        $kdakun         = $this->input->post('kdakun');
        $satuanid       = $this->input->post('satuanid');
        $adjqty         = $this->input->post('adjqty');
        $ket            = $this->input->post('ket_isi');
        $now            = date('Y-m-d H:i:s');
        $now1           = date('Y-m-d');

        $generatekd         = array(
            'kd_barang'     => $adjustmentkd
        );

        $insrtadjustment    = array(
            'kd_akun'           => $kdakun,
            'kd_po_nk'          => $adjustmentkd,
            'kd_barang'         => $kdbarang,
            'kd_barangsys'      => $kdbrsistem,
            'keterangan'        => $ket,
            'kat_barang'        => $katbarang,
            'tr_qty'            => $adjqty,
            'satuan'            => $satuanid,
            'inputer'           => $this->session->userdata('kode'),
            'req_by'            => '-',
            'tgl_transaksi'     => $now1,
            'create_at'         => $now,
            'last_updated_by'   => $this->session->userdata('kode'),
            'update_at'         => $now
        );

        $this->M_Stocknonkomersil->generatekd($generatekd);
        $this->M_Stocknonkomersil->insttransaksi($insrtadjustment);

        if ($kdakun == '11513') {
            $inputnote = array(
                'kd_po'         => $kdbrsistem,
                'isi_note'      => 'ADJUSTMENT PENAMBAHAN QTY - ' . $ket,
                'kd_user'       => $this->session->userdata('kode'),
                'nama_user'     => $this->session->userdata('nama_user'),
                'note_for'      => '3',
                'update_status' => '3',
                'create_at'     => $now
            );
            $this->M_Stocknonkomersil->insrt_note($inputnote);
            redirect('detailtransaksi/' . $kdbrsistem);
        } else if ($kdakun == '11514') {
            $inputnote = array(
                'kd_po'         => $kdbrsistem,
                'isi_note'      => 'ADJUSTMENT PENGURANGAN QTY - ' . $ket,
                'kd_user'       => $this->session->userdata('kode'),
                'nama_user'     => $this->session->userdata('nama_user'),
                'note_for'      => '3',
                'update_status' => '3',
                'create_at'     => $now
            );
            $this->M_Stocknonkomersil->insrt_note($inputnote);
            redirect('detailtransaksi/' . $kdbrsistem);
        }
    }
    public function nkrestok()
    {
        $data['title']      = 'List Stock Non Komersil';
        $data['vstock']     = $this->M_Stocknonkomersil->v_stockzero()->result();
        $data['draftpo']    = $this->M_Stocknonkomersil->draftpo()->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/stock/nonkomersil/listnostock.php', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/stock/nonkomersil/datatables');
    }
    public function indraftrestock()
    {
        $kduser     = $this->session->userdata('kode');
        $kdbsys     = $this->input->post('kdbys');
        $kdbr       = $this->input->post('kdbr');
        $katbarang  = $this->input->post('katbr');
        $nmbarang   = $this->input->post('nm_barang');
        $descnk     = $this->input->post('descnk_isi');
        $ket        = $this->input->post('ket_isi');
        $qty        = $this->input->post('qty_isi');
        $satuan     = $this->input->post('satqty');
        $hrgsatuan  = $this->input->post('hrgsat');

        $hrgtot     = $qty * $hrgsatuan;

        $inputdt    = array(
            'jnis_po'       => '3',
            'nama_barang'   => $nmbarang,
            'deskripsi'     => $descnk,
            'keterangan'    => $ket,
            'qty'           => $qty,
            'satuan'        => $satuan,
            'hrg_satuan'    => $hrgsatuan,
            'total_harga'   => $hrgtot,
            'kd_bsys'       => $kdbsys,
            'kd_barang'     => $kdbr,
            'kat_barang'    => $katbarang,
            'kd_user'       => $kduser
        );
        $this->M_Stocknonkomersil->inputtmprestock($inputdt);
        redirect('nkrestok');
    }
}
