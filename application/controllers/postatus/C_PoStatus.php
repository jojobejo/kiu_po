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
        $this->load->model('PO/M_Purchase');
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
        $this->load->view('content/postatus/datatables');
    }
    public function getOnProgress()
    {

        $data['title'] = 'PO Status On Progress';
        $data['po']    = $this->M_Postatus->getOnProgress();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/bodyOnProgress', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/postatus/datatables');
    }
    public function getDone()
    {

        $data['title'] = 'PO Status Done';
        $data['po']    = $this->M_Postatus->getDone();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/bodyDone', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/postatus/datatables');
    }
    public function getReject()
    {

        $data['title'] = 'PO Status Reject';
        $data['po']    = $this->M_Postatus->getReject();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/bodyReject', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/postatus/datatables');
    }

    public function detailPO($kdpo)
    {
        $data['title'] = 'PO Status';
        $data['detail'] = $this->M_Postatus->getDetail($kdpo);
        $data['status'] = $this->M_Postatus->getdataStatus($kdpo);
        $data['noted']  = $this->M_Postatus->getNoted($kdpo);
        $data['tax']    = $this->M_Postatus->getTax();
        $data['satuan'] = $this->M_Postatus->getSatuan();
        $data['log']    = $this->M_Postatus->getLog($kdpo);
        $data['total']  = $this->M_Postatus->sumTransaksiPenjualan($kdpo);
        $data['diskon'] = $this->M_Postatus->getDiskon($kdpo);
        $data['totalDiskon'] = $this->M_Postatus->totalDiskon($kdpo);
        $data['notebarang'] = $this->M_Postatus->get_note_barang($kdpo);

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/detailpo', $data);
        $this->load->view('partial/footer');
    }

    public function printOrder($kdpo)
    {
        $data['title'] = 'PRINT ORDER';
        $data['detail'] = $this->M_Postatus->getDetail($kdpo);
        $data['status'] = $this->M_Postatus->getDataStatuss($kdpo);
        $data['total']  = $this->M_Postatus->sumTransaksiPenjualan($kdpo);
        $data['CountItem'] = $this->M_Postatus->CountItem($kdpo)->result();
        $data['diskon'] = $this->M_Postatus->getDiskon($kdpo);
        $data['totalDiskon'] = $this->M_Postatus->totalDiskon($kdpo);
        $data['totalnote'] = $this->M_Postatus->totalnote($kdpo);
        $data['notesuplier'] = $this->M_Postatus->get_note_barang($kdpo);

        $this->load->view('partial/header', $data);
        $this->load->view('content/postatus/printorder', $data);
        $this->load->view('partial/footerprint');
    }

    public function printOrderBaru($kdpo)
    {
        $data['title'] = 'PRINT ORDER';
        $data['detail'] = $this->M_Postatus->getDetail($kdpo);
        $data['status'] = $this->M_Postatus->getdataStatus($kdpo);
        $data['total']  = $this->M_Postatus->sumTransaksiPenjualan($kdpo);
        $data['diskon'] = $this->M_Postatus->getDiskon($kdpo);
        $data['totalDiskon'] = $this->M_Postatus->totalDiskon($kdpo);

        $this->load->view('partial/headerprint', $data);
        $this->load->view('content/postatus/printorderBaru', $data);
        $this->load->view('partial/footerPrint');
    }

    public function konfirmasiOrder($kdpo, $kddirektur)
    {
        $dataKonfirm = array(
            'kd_po' => $kdpo,
            'acc_with' => $kddirektur,
            'status' => 'DONE'
        );

        $this->M_Postatus->konfirmPo($kdpo, $dataKonfirm);
        redirect('postatus');
    }

    public function tolakOrder($kdpo, $kddirektur)
    {
        $dataKonfirm = array(
            'kd_po' => $kdpo,
            'acc_with' => $kddirektur,
            'status' => 'REJECT'
        );

        $this->M_Postatus->tolakPo($kdpo, $dataKonfirm);
        redirect('postatus');
    }

    public function addNote()
    {
        $kdpo           = $this->input->post('kdpo');
        $note           = $this->input->post('noteDitektur');
        $stslogin       = $this->session->userdata('lv');
        $departement    = $this->session->userdata('kode');
        $namauser       = $this->session->userdata('nama_user');

        if ($stslogin == '1') {
            $addNoteKeuangan = array(
                'kd_po'     => $kdpo,
                'isi_note'  => $note,
                'kd_user'   => $departement,
                'nama_user'   => $namauser,
                'note_for'  => '1',
                'update_status' => '1'
            );

            $noteUpdateKeuangan = array(
                'status'    => 'NOTE KEUANGAN'
            );
            $this->M_Postatus->addNote($addNoteKeuangan);
            $this->M_Postatus->updateStatus($kdpo, $noteUpdateKeuangan);
        } else if ($stslogin == '3') {
            $addnoteDirektur = array(
                'kd_po'     => $kdpo,
                'isi_note'  => $note,
                'kd_user'   => $departement,
                'nama_user'   => $namauser,
                'note_for'  => '2',
                'update_status' => '1'
            );
            $noteUpdateDirektur = array(
                'status'    => 'NOTE DIREKTUR'
            );
            $this->M_Postatus->addNote($addnoteDirektur);
            $this->M_Postatus->updateStatus($kdpo, $noteUpdateDirektur);
        }
        redirect('detailPO/' . $kdpo);
    }

    public function revisiPO()
    {
        $idpo       = $this->input->post('idpo');
        $kdpo       = $this->input->post('kdpo');
        $satuan     = $this->input->post('satuan_isi');
        $qty        = $this->input->post('qty_isi');
        $hargaQty   = $this->input->post('hrg_isi');
        $hargahasil = $hargaQty * $qty;


        $data = array(
            'satuan'        => $satuan,
            'qty'           => $qty,
            'hrg_satuan'    => $hargaQty,
            'hrg_total'     => $hargahasil,
        );

        $this->M_Postatus->revisiPO($idpo, $data);
        redirect('detailPO/' . $kdpo);
    }

    public function listBarangRevisi($kdsuplier, $kdpo)
    {
        $data['title']          = 'Add Item List';
        $data['status']         = $this->M_Postatus->getdataStatus($kdpo);
        $data['kode_suplier']   = $this->M_Purchase->Suplier($kdsuplier)->result();
        $data['barang']         = $this->M_Purchase->getBarangSup($kdsuplier)->result();
        $data['tax']            = $this->M_Purchase->getTax();
        $data['satuan']         = $this->M_Purchase->getSatuan();
        $data['tmp']            = $this->M_Purchase->getTmpOrder($kdsuplier);

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/listbarangRevisi', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/datatables');
        $this->load->view('content/postatus/ajaxstatus');
    }

    public function tambahBarangRevisi()
    {
        $kdpo       = $this->input->post('kd_po');
        $nopo       = $this->input->post('no_po');
        $tgl        = $this->input->post('tgl_transaksi');
        $suplier    = $this->input->post('kd_sup');
        $kdbarang   = $this->input->post('kd_isi');
        $nmbarang   = $this->input->post('nama_isi');
        $satuan     = $this->input->post('satuan_isi');
        $qty        = $this->input->post('qty_isi');
        $hargaQty   = $this->input->post('hrg_isi');
        $hargahasil = $hargaQty * $qty;

        $data = array(
            'kd_po'         => $kdpo,
            'no_po'         => $nopo,
            'tgl_transaksi' => $tgl,
            'kd_suplier'    => $suplier,
            'kd_barang'     => $kdbarang,
            'nama_barang'   => $nmbarang,
            'satuan'        => $satuan,
            'qty'           => $qty,
            'hrg_satuan'    => $hargaQty,
            'hrg_total'     => $hargahasil,

        );
        $this->M_Postatus->addRevisiChart($data);
        redirect('detailPO/' . $kdpo);
    }

    public function NoteUpdateKeuangan()
    {
        $kdpo   = $this->input->post('kdpo');
        $note   = $this->input->post('noteDitektur');
        $nama   = $this->session->userdata('nama_user');

        $addNote = array(
            'kd_po'     => $kdpo,
            'kd_user'   => $nama,
            'isi_note'  => $note
        );

        $updateStatus = array(
            'status'    => 'UPDATE'
        );

        $updateLog = array(
            'kd_po'     => $kdpo,
            'status'    => 'UPDATE'
        );

        $this->M_Postatus->updateLog($updateLog);
        $this->M_Postatus->addNote($addNote);
        $this->M_Postatus->updateStatus($kdpo, $updateStatus);

        redirect('detailPO/' . $kdpo);
    }

    public function hapusBarangPO($id, $kdpo)
    {
        $this->M_Postatus->hapusBarang($id);
        redirect('detailPO/' . $kdpo);
    }

    public function tambahTax()
    {
        $kdpo       = $this->input->post('kdpo');
        $tax        = $this->input->post('tax_isi_status');
        $hargaA     = $this->input->post('total_harga');
        $hasiltax   = $tax / 100;
        $nominalTax = $hargaA * $hasiltax;

        $updateHarga = array(
            'kd_po' => $kdpo,
            'tax'   => $tax,
            'hrg_pajak' => $nominalTax

        );

        $this->M_Postatus->updateTax($kdpo, $updateHarga);

        redirect('detailPO/' . $kdpo);
    }

    public function tempoPembayaran()
    {
        $kdpo       = $this->input->post('kdpo');
        $hari        = $this->input->post('tempo_isi');

        $updateTempo = array(
            'kd_po' => $kdpo,
            'tmpo_pembayaran'   => $hari
        );

        $this->M_Postatus->updateTax($kdpo, $updateTempo);

        redirect('detailPO/' . $kdpo);
    }

    public function frankoPengiriman()
    {
        $kdpo       = $this->input->post('kdpo');
        $gdg        = $this->input->post('gdg_isi');

        $updateFranko = array(
            'kd_po' => $kdpo,
            'gdg_pengiriman'   => $gdg
        );

        $this->M_Postatus->updateTax($kdpo, $updateFranko);

        redirect('detailPO/' . $kdpo);
    }

    public function tambahDiskon()
    {
        $kdpo = $this->input->post('kdpo');
        $keterangan = $this->input->post('keterangan_isi');
        $nominal = $this->input->post('nominal_isi');

        $addDiskon = array(
            'kd_po'         => $kdpo,
            'keterangan'    => $keterangan,
            'nominal'       => $nominal
        );

        $this->M_Postatus->insertDiskon($addDiskon);

        redirect('detailPO/' . $kdpo);
    }

    public function editDiskon()
    {
        $iddiskon  = $this->input->post('id_diskon');
        $kdpo = $this->input->post('kdpo');
        $keterangan = $this->input->post('keterangan_isi');
        $nominal = $this->input->post('nominal_isi');

        $editDiskon = array(
            'keterangan'    => $keterangan,
            'nominal'       => $nominal
        );

        $this->M_Postatus->editDiskon($iddiskon, $editDiskon);

        redirect('detailPO/' . $kdpo);
    }

    public function hapusDiskon($id, $kdpo)
    {
        $this->M_Postatus->hapusDiskon($id);
        redirect('detailPO/' . $kdpo);
    }

    public function postatusnk()
    {
        $data['title'] = 'PO Status';
        $kd = $this->session->userdata('departemen');
        $data['po']    = $this->M_Postatus->getAllNK($kd);

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/nonkomersilstatus', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/postatus/datatables');
    }
    public function detailponk($kd)
    {
        $data['title'] = 'PO Status';
        $data['detail'] = $this->M_Postatus->getDetailnk($kd);
        $data['status'] = $this->M_Postatus->getdataStatusnk($kd);
        $data['log']    = $this->M_Postatus->getNoted($kd);
        $data['total']  = $this->M_Postatus->sumTransaksiPenjualannk($kd);

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/detailponk', $data);
        $this->load->view('partial/footer');
    }
    public function edit_faktur_item_nk()
    {
        $id         = $this->input->post('idisi');
        $kd         = $this->input->post('kdponk');
        $namabarang = $this->input->post('nama_isi');
        $descbarang  = $this->input->post('desc_isi');
        $ketbarang  = $this->input->post('ket_isi');
        $qtybarang  = $this->input->post('qty_isi');
        $hrgsatuan  = $this->input->post('hrg_isi');
        $totalharga = $qtybarang * $hrgsatuan;

        $dataBarang = array(
            'nama_barang'   => $namabarang,
            'deskripsi'     => $descbarang,
            'keterangan'    => $ketbarang,
            'qty'           => $qtybarang,
            'hrg_satuan'    => $hrgsatuan,
            'total_harga'   => $totalharga,
        );
        $this->M_Postatus->edit_faktur_item_nk($id, $dataBarang);

        redirect('detailponk/' . $kd);
    }
    public function hapus_faktur_item_nk()
    {
        $id         = $this->input->post('idisi');
        $kd         = $this->input->post('kdponk');

        $this->M_Postatus->hapus_faktur_item_nk($id);

        redirect('detailponk/' . $kd);
    }
    public function addnotenk()
    {
        $kdpo           = $this->input->post('kdpo');
        $note           = $this->input->post('noteDitektur');
        $stslogin       = $this->session->userdata('lv');
        $departement    = $this->session->userdata('kode');
        $namauser       = $this->session->userdata('nama_user');

        if ($stslogin == '1') {
            $addNoteKeuangan = array(
                'kd_po'     => $kdpo,
                'isi_note'  => $note,
                'kd_user'   => $departement,
                'nama_user'   => $namauser,
                'note_for'  => '1',
                'update_status' => '1'
            );

            $noteUpdateKeuangan = array(
                'status'    => 'NOTE KEUANGAN'
            );
            $this->M_Postatus->addNote($addNoteKeuangan);
            $this->M_Postatus->updateStatus($kdpo, $noteUpdateKeuangan);
        } else if ($stslogin == '2') {
            $addnoteuser = array(
                'kd_po'     => $kdpo,
                'isi_note'  => $note,
                'kd_user'   => $departement,
                'nama_user'   => $namauser,
                'note_for'  => '1',
                'update_status' => '1'
            );

            $noteupdateuser = array(
                'status'    => 'NOTE PENGAJUAN'
            );
            $this->M_Postatus->addNote($addnoteuser);
            $this->M_Postatus->updateStatus($kdpo, $noteupdateuser);
        } else if ($stslogin == '3') {
            $addnoteDirektur = array(
                'kd_po'     => $kdpo,
                'isi_note'  => $note,
                'kd_user'   => $departement,
                'nama_user'   => $namauser,
                'note_for'  => '2',
                'update_status' => '1'
            );
            $noteUpdateDirektur = array(
                'status'    => 'NOTE DIREKTUR'
            );
            $this->M_Postatus->addNote($addnoteDirektur);
            $this->M_Postatus->updateStatus($kdpo, $noteUpdateDirektur);
        }
        redirect('detailponk/' . $kdpo);
    }
    public function note_barang_suplier()
    {
        $kdpo       = $this->input->post('kdpo');
        $isinote    = $this->input->post('isi_note');

        $datanote = array(
            'kd_po' => $kdpo,
            'isi_note' => $isinote
        );
        $this->M_Postatus->addnotesuplier($datanote);
        redirect('detailPO/' . $kdpo);
    }
    public function note_barang_suplier_edit()
    {
        $id         = $this->input->post('idnote');
        $kdpo       = $this->input->post('kdpo');
        $isinote    = $this->input->post('isi_note');

        $datanote = array(
            'kd_po' => $kdpo,
            'isi_note' => $isinote
        );
        $this->M_Postatus->editnotesuplier($id, $datanote);
        redirect('detailPO/' . $kdpo);
    }
    public function note_barang_suplier_hapus()
    {
        $id         = $this->input->post('idnote');
        $kdpo       = $this->input->post('kdpo');

        $this->M_Postatus->hapusnotesuplier($id);
        redirect('detailPO/' . $kdpo);
    }
    public function add_diskon_barang()
    {
        $kdsup       = $this->input->post('kdsup');
        $kdpo       = $this->input->post('kdpo');
        $nmbarang       = $this->input->post('nmbarang');
        $tax        = $this->input->post('disc_isi');
        $hargaA     = $this->input->post('tot_harga');
        $hasiltax   = $tax / 100;
        $nominalTax = $hargaA * $hasiltax;

        $tambahDiskon = array(
            'kd_po' => $kdpo,
            'kd_suplier' => $kdsup,
            'keterangan' => 'Diskon Barang' . '-' . $nmbarang . '(' . $tax . '%' . ')',
            'nominal' => $nominalTax
        );

        $this->M_Postatus->insertDiskon($tambahDiskon);

        redirect('detailPO/' . $kdpo);
    }

    public function add_diskon_barangs()
    {
        $kdsup      = $this->input->post('kdsup');
        $kdpo       = $this->input->post('kdpo');
        $nmbarang   = $this->input->post('nmbarang');
        $desc       = $this->input->post('desc_isi');
        $nominal    = $this->input->post('disc_isi');

        $tambahDiskon = array(
            'kd_po' => $kdpo,
            'kd_suplier' => $kdsup,
            'keterangan' => $nmbarang . ' ' . '-' . ' ' . $desc,
            'nominal' => $nominal
        );

        $this->M_Postatus->insertDiskon($tambahDiskon);

        redirect('detailPO/' . $kdpo);
    }
}
