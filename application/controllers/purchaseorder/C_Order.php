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
        $this->load->model('Master_barang/M_MasterBarang');
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

        $kduser = $this->session->userdata('kode');

        $data['kdsuplier'] = $kdsuplier;
        $data['kode_suplier'] = $this->M_Purchase->Suplier($kdsuplier)->result();
        $data["barang"] = $this->M_Purchase->getBarangSup($kdsuplier)->result();
        $data['tmp']    = $this->M_Purchase->getTmpOrder($kdsuplier);
        $data['tmpdiskon'] = $this->M_Purchase->getTmpDiskonOrder($kdsuplier);
        $data['tmpnote'] = $this->M_Purchase->getTmpNoteOrder($kdsuplier);
        $data['total']  = $this->M_Purchase->sumTransaksiPenjualan($kdsuplier);
        $data['kdpo']   = $this->M_Purchase->kdpo($kduser, $kdsuplier);
        $data['satuan']         = $this->M_Purchase->getSatuan();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/purchase', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/datatables');
        $this->load->view('content/po/ajaxPO');
    }
    public function listBarang($kdsuplier)
    {
        $data['title']          = 'Add Item List';
        $data['kode_suplier']   = $this->M_Purchase->Suplier($kdsuplier)->result();
        $data['barang']         = $this->M_Purchase->getBarangSup($kdsuplier)->result();
        $data['tax']            = $this->M_Purchase->getTax();
        $data['satuan']         = $this->M_Purchase->getSatuan();
        $data['tmp']            = $this->M_Purchase->getTmpOrder($kdsuplier);

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/listbarang', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/datatables');
        $this->load->view('content/po/ajaxPO');
    }

    public function editSuplier()
    {
        $kdsup       = $this->input->post('kd_sup');
        $namasup     = $this->input->post('nama_isi');
        $alamatsup   = $this->input->post('alamat_isi');
        $nosup       = $this->input->post('telp_isi');
        $faxsup      = $this->input->post('fax_isi');
        $emailsup    = $this->input->post('email_isi');

        $dataSup = array(
            'kd_suplier'    => $kdsup,
            'nama_suplier'  => $namasup,
            'alamat_suplier' => $alamatsup,
            'no_telpon'     => $nosup,
            'no_fax'        => $faxsup,
            'email'         => $emailsup
        );

        $this->M_Purchase->editSuplier($kdsup, $dataSup);
        redirect('purchase/sup/' . $kdsup);
    }

    public function addBarang()
    {
        $data['title'] = 'Add Item List';

        $kdbarang   = $this->input->post('kd_isi');
        $namabarang = $this->input->post('nama_isi');
        $kdsuplier  = $this->input->post('kd_sup_isi');

        $dataBarang = array(
            'kode_barang'   => $kdbarang,
            'kd_suplier'    => $kdsuplier,
            'nama_barang'   => $namabarang
        );

        $this->M_MasterBarang->insertBarang($dataBarang);
        redirect('purchase/listBarang/' . $kdsuplier);
    }

    public function editBarang()
    {
        $idbarang   = $this->input->post('id_isi');
        $kdbarang   = $this->input->post('kd_isi');
        $namabarang = $this->input->post('nama_isi');
        $kdsuplier  = $this->input->post('kd_sup_isi');

        $dataBarang = array(
            'id_barang'     => $idbarang,
            'kode_barang'   => $kdbarang,
            'kd_suplier'    => $kdsuplier,
            'nama_barang'   => $namabarang
        );

        $this->M_MasterBarang->editBarang($idbarang, $dataBarang);
        redirect('purchase/listBarang/' . $kdsuplier);
    }
    public function hapusBarang($id, $kdsuplier)
    {
        $this->M_MasterBarang->hapusBarang($id);
        redirect('purchase/listBarang/' . $kdsuplier);
    }

    public function addChart()
    {
        $suplier    = $this->input->post('kd_sup');
        $kdbarang   = $this->input->post('kd_isi');
        $nmbarang   = $this->input->post('nama_isi');
        $satuan     = $this->input->post('satuan_isi');
        $qty        = $this->input->post('qty_isi');
        $hargaQty   = $this->input->post('hrg_isi');
        $hargahasil = $hargaQty * $qty;

        $data = array(
            'kode_barang'   => $kdbarang,
            'nama_barang'   => $nmbarang,
            'kode_suplier'  => $suplier,
            'satuan'        => $satuan,
            'qty'           => $qty,
            'harga_satuan'  => $hargaQty,
            'total_harga'   => $hargahasil,
        );
        $this->M_Purchase->addChart($data);
        redirect('purchase/sup/' . $suplier);
    }

    public function hapusChart($id, $kdsuplier)
    {
        $this->M_Purchase->hapusChart($id);
        redirect('purchase/sup/' . $kdsuplier);
    }

    public function rekam_po()
    {
        date_default_timezone_set("Asia/Jakarta");
        $suplier    = $this->input->post('suplier');
        $nopo       = $this->input->post('nopo');
        $tgl        = $this->input->post('tgl');
        $tmpo        = $this->input->post('tmpo');
        $gdg        = $this->input->post('gdg');
        $kdpo       = $this->input->post('kdpo');
        $jml        = $this->input->post('jml');
        $harga      = $this->input->post('harga');
        $nmuser     = $this->session->userdata('nama_user');
        $user       = $this->session->userdata('kode');
        $tmp        = $this->M_Purchase->get_tmp($suplier);
        $tmpdiskon  = $this->M_Purchase->getTmpDiskonOrder($suplier);
        $tmpnote    = $this->M_Purchase->getTmpNoteOrder($suplier);


        $rekamData = array(
            'kd_po'         => $kdpo,
            'no_po'         => $nopo,
            'tgl_transaksi' => $tgl,
            'kd_suplier'    => $suplier,
            'jml_item'      => $jml,
            'total_harga'   => $harga,
            'tmpo_pembayaran' => $tmpo,
            'gdg_pengiriman'  => $gdg,
            'status'        => 'ON PROGRESS'
        );
        $this->M_Purchase->inputOrder($rekamData);
        // UPDATE NOTE - REKAM BARU
        $updatenote = array(
            'kd_po' => $kdpo,
            'isi_note' => 'Purchase Order Baru',
            'kd_user' => $user,
            'nama_user' => $nmuser,
            'note_for' => '1',
            'update_status' => '1'
        );
        $this->M_Purchase->addNote($updatenote);
        if ($tmp) {
            foreach ($tmp as $chart) {
                $listTransaksi = array(
                    'no_po'         => $nopo,
                    'kd_po'         => $kdpo,
                    'tgl_transaksi' => $tgl,
                    'kd_barang'     => $chart->kode_barang,
                    'nama_barang'   => $chart->nama_barang,
                    'kd_suplier'    => $chart->kode_suplier,
                    'satuan'        => $chart->satuan,
                    'qty'           => $chart->qty,
                    'hrg_satuan'    => $chart->harga_satuan,
                    'hrg_total'     => $chart->total_harga,
                );

                $this->M_Purchase->inputDetailPO($listTransaksi);
            }
            foreach ($tmpdiskon as $diskon) {
                $listdiskon = array(
                    'kd_po' => $kdpo,
                    'kd_suplier' => $diskon->kd_suplier,
                    'keterangan' => $diskon->nama_diskon,
                    'nominal'    => $diskon->nominal
                );
                $this->M_Purchase->input_diskon($listdiskon);
            }
            foreach ($tmpnote as $note) {
                $listnote = array(
                    'kd_po' => $kdpo,
                    'kd_suplier' => $note->kd_suplier,
                    'isi_note'  => $note->isi_note
                );
                $this->M_Purchase->input_note($listnote);
            }
            $this->M_Purchase->delete_tmp_diskon($suplier);
            $this->M_Purchase->delete_tmp_note_sp_i($suplier);
            $this->M_Purchase->hapusTmp($suplier);
            $msg = "success";
            $data = array('msg' => $msg, 'nopo' => $nopo);
            echo json_encode($data);
        }
    }
    public function edit_barang_tmp()
    {
        $id         = $this->input->post('id_isi');
        $supp       = $this->input->post('kd_sup_isi');
        $satuan     = $this->input->post('satuan_isi');
        $qty        = $this->input->post('qty_isi');
        $hrg_satuan = $this->input->post('hrg_isi');
        $total      = $qty * $hrg_satuan;

        $dataedit = array(
            'satuan'    => $satuan,
            'qty'       => $qty,
            'harga_satuan' => $hrg_satuan,
            'total_harga' => $total
        );
        $this->M_Purchase->edit_chart_tmp($id, $dataedit);
        redirect('purchase/sup/' . $supp);
    }
    public function addnotebarangsupliertmp()
    {
        $supp       = $this->input->post('kd_sup');
        $isi        = $this->input->post('isi');

        $addnote = array(
            'kd_suplier'    => $supp,
            'isi_note'       => $isi
        );
        $this->M_Purchase->add_tmp_note_suplier($addnote);
        redirect('purchase/sup/' . $supp);
    }
    public function edit_note_tmp_barang()
    {
        $id         = $this->input->post('id_isi');
        $supp       = $this->input->post('kd_sup');
        $isi        = $this->input->post('isi');

        $note = array(
            'kd_suplier'    => $supp,
            'isi_note'       => $isi
        );
        $this->M_Purchase->edit_note_tmp_barang($id, $note);
        redirect('purchase/sup/' . $supp);
    }
    public function hapus_note_tmp_barang()
    {
        $id = $this->input->post('id_isi');
        $supp       = $this->input->post('kd_sup');
        $this->M_Purchase->hapus_note_tmp_barang($id);
        redirect('purchase/sup/' . $supp);
    }
    public function add_diskon_po()
    {
        $supp       = $this->input->post('kd_sup');
        $deskripsi  = $this->input->post('deskripsi_isi');
        $nominal    = $this->input->post('nominal_isi');

        $addnote = array(
            'kd_suplier'    => $supp,
            'nama_diskon'   => $deskripsi,
            'nominal'       => $nominal
        );
        $this->M_Purchase->add_diskon_po($addnote);
        redirect('purchase/sup/' . $supp);
    }
    public function edit_diskon_po()
    {
        $id         = $this->input->post('id_isi');
        $supp       = $this->input->post('kd_sup');
        $deskripsi  = $this->input->post('deskripsi_isi');
        $nominal    = $this->input->post('nominal_isi');

        $addnote = array(
            'kd_suplier'    => $supp,
            'nama_diskon'   => $deskripsi,
            'nominal'       => $nominal
        );
        $this->M_Purchase->edit_diskon_po($id, $addnote);
        redirect('purchase/sup/' . $supp);
    }
    public function hapus_diskon_po()
    {
        $id = $this->input->post('id_isi');
        $supp       = $this->input->post('kd_sup');
        $this->M_Purchase->hapus_tmp_diskon($id);
        redirect('purchase/sup/' . $supp);
    }
    public function add_diskon_barang_tmp()
    {
        $kdsup      = $this->input->post('kdsup');
        $nmbarang   = $this->input->post('nmbarang');
        $tax        = $this->input->post('disc_isi');
        $hargaA     = $this->input->post('tot_harga');
        $hasiltax   = $tax / 100;
        $nominalTax = $hargaA * $hasiltax;

        $tambahDiskon = array(
            'kd_suplier' => $kdsup,
            'nama_diskon' => 'Diskon Barang' . '-' . $nmbarang . '(' . $tax . '%' . ')',
            'nominal' => $nominalTax
        );

        $this->M_Purchase->add_diskon_po($tambahDiskon);
        redirect('purchase/sup/' . $kdsup);
    }
}
