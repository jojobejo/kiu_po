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
        $data['po']    = $this->M_Postatus->getpotoday()->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/bodytoday', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/postatus/datatables');
    }

    public function postatus()
    {
        $data['title'] = 'PO Status';
        $data['po']    = $this->M_Postatus->getAll();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/body', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/postatus/datatables');
    }

    public function searchdatepo()
    {

        $date1  = $this->input->post('dt1');
        $date2  = $this->input->post('dt2');

        $data['title'] = 'PO Status';
        $data['response1'] = $date1;
        $data['response2'] = $date2;
        $data['po']    = $this->M_Postatus->srcdatepo($date1, $date2);

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/bodysearchdate', $data);
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
    public function getDoneToday()
    {
        $data['title'] = 'PO Status Done Today';
        $data['po']    = $this->M_Postatus->getDoneToday()->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/bodytodaydone', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/postatus/datatables');
    }
    public function getOnProgresToday()
    {
        $data['title'] = 'PO Status Done Today';
        $data['po']    = $this->M_Postatus->getOnProgressToday()->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/bodytodayonprogress', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/postatus/datatables');
    }
    public function getRejectToday()
    {
        $data['title'] = 'PO Status Done Today';
        $data['po']    = $this->M_Postatus->getRejectToday()->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/bodytodayreject', $data);
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
        $data['kdpo'] = $this->M_Postatus->kdpo($kdpo);
        $data['ntformat'] = $this->M_Postatus->ntformat();


        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/detailpo', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/postatus/ajaxstatus');
    }
    public function update_printout_po()
    {
        $kdpo   = $this->input->post('kdpo');
        $kdnt   = $this->input->post('frmt_option');

        $datanote = array(
            'kd_printout_note' => $kdnt
        );
        $this->M_Postatus->update_pr_po($kdpo, $datanote);

        redirect('detailPO/' . $kdpo);
    }
    public function unpostpo($kdpo)
    {
        $departement    = $this->session->userdata('kode');
        $namauser       = $this->session->userdata('nama_user');

        $addNoteKeuangan = array(
            'kd_po'     => $kdpo,
            'isi_note'  => 'UNPOST - PO',
            'kd_user'   => $departement,
            'nama_user'   => $namauser,
            'note_for'  => '1',
            'update_status' => '1'
        );

        $noteUpdateKeuangan = array(
            'status'    => 'ON PROGRESS'
        );
        $this->M_Postatus->addNote($addNoteKeuangan);
        $this->M_Postatus->updateStatus($kdpo, $noteUpdateKeuangan);

        redirect('detailPO/' . $kdpo);
    }


    public function repostpo()
    {
        date_default_timezone_set("Asia/Jakarta");
        $kdpolama   = $this->input->post('kd_lama');
        $suplier    = $this->input->post('suplier');
        $nopo       = $this->input->post('nopo');
        $tgl        = $this->input->post('tgl');
        $tmpo       = $this->input->post('tmpo');
        $gdg        = $this->input->post('gdg');
        $kdpo       = $this->input->post('kdpo');
        $jml        = $this->input->post('jml');
        $harga      = $this->input->post('harga');
        $tax        = $this->input->post('tax');
        $nmuser     = $this->session->userdata('nama_user');
        $user       = $this->session->userdata('kode');
        $tmp        = $this->M_Postatus->get_ori_po($kdpolama);
        $tmpdiskon  = $this->M_Postatus->getDiskon($kdpolama);
        $note    = $this->M_Postatus->getNoted($suplier);
        $tmpnotebr  = $this->M_Postatus->get_note_barang($kdpolama);

        $rekamData = array(
            'kd_po'         => $kdpo,
            'no_po'         => $nopo,
            'tgl_transaksi' => $tgl,
            'kd_suplier'    => $suplier,
            'jml_item'      => $jml,
            'total_harga'   => $harga,
            'tmpo_pembayaran' => $tmpo,
            'gdg_pengiriman'  => $gdg,
            'tax'           => $tax,
            'status'        => 'PO REVISI'
        );
        $this->M_Postatus->inputRevisi($rekamData);

        // UPDATE NOTE - REKAM BARU
        $updatenote = array(
            'kd_po' => $kdpo,
            'isi_note' => 'Revisi PO',
            'kd_user' => $user,
            'nama_user' => $nmuser,
            'note_for' => '1',
            'update_status' => '1'
        );
        $this->M_Postatus->addNote($updatenote);
        if ($tmp) {
            foreach ($tmp as $chart) {
                $listTransaksi = array(
                    'no_po'         => $nopo,
                    'kd_po'         => $kdpo,
                    'tgl_transaksi' => $tgl,
                    'kd_barang'     => $chart->kd_barang,
                    'nama_barang'   => $chart->nama_barang,
                    'kd_suplier'    => $chart->kd_suplier,
                    'satuan'        => $chart->satuan,
                    'qty'           => $chart->qty,
                    'hrg_satuan'    => $chart->hrg_satuan,
                    'hrg_total'     => $chart->hrg_total,
                );

                $this->M_Postatus->inputDetailPO($listTransaksi);
            }
            foreach ($tmpdiskon as $diskon) {
                $listdiskon = array(
                    'kd_po' => $kdpo,
                    'kd_suplier' => $diskon->kd_suplier,
                    'keterangan' => $diskon->keterangan,
                    'nominal'    => $diskon->nominal
                );
                $this->M_Postatus->input_diskon($listdiskon);
            }
            foreach ($note as $nt) {
                $listnote = array(
                    'kd_po' => $kdpo,
                    'isi_note' => $nt->isi_note,
                    'kd_user' => $user,
                    'nama_user' => $nmuser,
                    'note_for' => '1',
                    'update_status' => '1'
                );
                $this->M_Postatus->addNote($listnote);
            }
            foreach ($tmpnotebr as $ntbr) {
                $listnotebr = array(
                    'kd_po' => $kdpo,
                    'kd_suplier' => $ntbr->kd_suplier,
                    'isi_note'  => $ntbr->isi_note
                );
                $this->M_Postatus->input_note($listnotebr);
            }
            $msg = "success";
            $data = array('msg' => $msg, 'nopo' => $nopo);
            echo json_encode($data);
        }
    }
    public function edit_no_po()
    {
        $idpo = $this->input->post('id_po');
        $kdpo = $this->input->post('kdpo');
        $nopo = $this->input->post('nopo');

        $dataedited = array(
            'no_po' => $nopo
        );

        $this->M_Postatus->editnopo($idpo, $dataedited);
        $this->M_Postatus->editnopodet($kdpo, $dataedited);
        redirect('detailPO/' . $kdpo);
    }
    public function hapuspo($kdpo)
    {
        $this->M_Postatus->deletepo($kdpo);
        $this->M_Postatus->deletepodet($kdpo);
        redirect('postatus');
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

    public function printOrdernk($kdpo)
    {
        $data['title'] = 'PRINT ORDER';
        $data['detail'] = $this->M_Postatus->getDetailnk($kdpo);
        $data['status'] = $this->M_Postatus->getDataStatussnk($kdpo)->result();
        $data['total']  = $this->M_Postatus->sumTransaksiPenjualannk($kdpo);
        $data['CountItem'] = $this->M_Postatus->CountItem($kdpo)->result();
        $data['diskon'] = $this->M_Postatus->getDiskonnk($kdpo);
        $data['totalDiskon'] = $this->M_Postatus->totalDiskon($kdpo);
        $data['notepm'] = $this->M_Postatus->get_note_pembelian($kdpo);

        $this->load->view('partial/header', $data);
        $this->load->view('content/postatus/printordernk', $data);
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
        $departement    = $this->session->userdata('kode');
        $namauser       = $this->session->userdata('nama_user');

        $dataKonfirm = array(
            'kd_po' => $kdpo,
            'acc_with' => $kddirektur,
            'status' => 'DONE'
        );

        $notedirektur = array(
            'kd_po'     => $kdpo,
            'isi_note'  => 'PO ACCEPT',
            'kd_user'   => $departement,
            'nama_user'   => $namauser,
            'note_for'  => '1',
            'update_status' => '1'
        );

        $this->M_Postatus->konfirmPo($kdpo, $dataKonfirm);
        $this->M_Postatus->addNote($notedirektur);
        redirect('postatus');
    }

    public function tolakOrder($kdpo, $kddirektur)
    {
        $departement    = $this->session->userdata('kode');
        $namauser       = $this->session->userdata('nama_user');

        $dataKonfirm = array(
            'kd_po' => $kdpo,
            'acc_with' => $kddirektur,
            'status' => 'REJECT'
        );
        $notedirektur = array(
            'kd_po'     => $kdpo,
            'isi_note'  => 'PO REJECT',
            'kd_user'   => $departement,
            'nama_user'   => $namauser,
            'note_for'  => '1',
            'update_status' => '1'
        );

        $this->M_Postatus->tolakPo($kdpo, $dataKonfirm);
        $this->M_Postatus->addNote($notedirektur);
        redirect('postatus');
    }

    public function cancel_po()
    {
        $kdpo           = $this->input->post('kdpo');
        $kddirektur     = $this->session->userdata('kode');
        $namauser       = $this->session->userdata('nama_user');
        $nt_cancel      = $this->input->post('nt_cancel');

        $dataKonfirm = array(
            'kd_po' => $kdpo,
            'acc_with' => $kddirektur,
            'status' => 'CANCEL'
        );
        $notedirektur = array(
            'kd_po'     => $kdpo,
            'isi_note'  => 'PO CANCEL - ' . $nt_cancel,
            'kd_user'   => $kddirektur,
            'nama_user'   => $namauser,
            'note_for'  => '1',
            'update_status' => '1'
        );

        $this->M_Postatus->tolakPo($kdpo, $dataKonfirm);
        $this->M_Postatus->addNote($notedirektur);
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
    public function hapusDiskonNK($id, $kdponk)
    {
        $this->M_Postatus->hapusDiskonNK($id);
        redirect('detailponk/' . $kdponk);
    }

    public function postatusnk()
    {
        //VIEW-PURCHASING
        if ($this->session->userdata('lv') == '2') {

            $data['title'] = 'PO Status';
            $dp = $this->session->userdata('departemen');
            $lv = $this->session->userdata('level');

            $data['po']    = $this->M_Postatus->getAllNK_keu()->result();

            $this->load->view('partial/header', $data);
            $this->load->view('partial/sidebar');
            $this->load->view('content/postatus/nonkomersilstatus', $data);
            $this->load->view('partial/footer');
            $this->load->view('content/postatus/datatables');
        }
        //VIEW-DIREKTUR
        elseif ($this->session->userdata('lv') == '3') {

            $data['title'] = 'PO Status';
            $dp = $this->session->userdata('departemen');
            $lv = $this->session->userdata('level');

            $data['po']    = $this->M_Postatus->getAllNK_direktur()->result();

            $this->load->view('partial/header', $data);
            $this->load->view('partial/sidebar');
            $this->load->view('content/postatus/nonkomersilstatus', $data);
            $this->load->view('partial/footer');
            $this->load->view('content/postatus/datatables');
        }
        //VIEW-KARYAWAN 
        elseif ($this->session->userdata('lv') == '4') {

            $data['title'] = 'PO Status';
            $dp = $this->session->userdata('departemen');
            $lv = $this->session->userdata('level');
            $kd = $this->session->userdata('kode');

            $data['po']    = $this->M_Postatus->getAllNK_kar($kd)->result();

            $this->load->view('partial/header', $data);
            $this->load->view('partial/sidebar');
            $this->load->view('content/postatus/nonkomersilstatus', $data);
            $this->load->view('partial/footer');
            $this->load->view('content/postatus/datatables');
        }
        //VIEW-KADEP
        elseif ($this->session->userdata('lv') == '5') {

            $data['title'] = 'PO Status';
            $dp = $this->session->userdata('departemen');
            $lv = $this->session->userdata('level');

            $data['po']    = $this->M_Postatus->getAllNK_kadep($dp)->result();

            $this->load->view('partial/header', $data);
            $this->load->view('partial/sidebar');
            $this->load->view('content/postatus/nonkomersilstatus', $data);
            $this->load->view('partial/footer');
            $this->load->view('content/postatus/datatables');
        }
    }
    public function detailponk($kd)
    {
        $data['title'] = 'PO Status';
        $data['detail'] = $this->M_Postatus->getDetailnk($kd);
        $data['status'] = $this->M_Postatus->getdataStatusnk($kd);
        $data['log']    = $this->M_Postatus->getNoted($kd);
        $data['total']  = $this->M_Postatus->sumTransaksiPenjualannk($kd);
        $data['kdbarang']  = $this->M_Postatus->generatekd();
        $data['tax']    = $this->M_Postatus->getTax();
        $data['diskon'] = $this->M_Postatus->getDiskon($kd);
        $data['totalDiskon'] = $this->M_Postatus->totalDiskon($kd);
        $data['ntpembelian'] = $this->M_Postatus->get_note_pembelian($kd);

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/postatus/detailponk', $data);
        $this->load->view('partial/footer');
    }
    public function edited_fk_nk()
    {
        $kdponk = $this->input->post('kdponk');
        $nmuser = $this->input->post('nm_pengaju');
        $dep    = $this->input->post('dep_isi');
        $tjpem  = $this->input->post('tj_pem');

        $dataedit = array(
            'nm_user'       => $nmuser,
            'departemen'    => $dep,
            'tj_pembelian'  => $tjpem
        );

        $this->M_Postatus->editedponk($kdponk, $dataedit);
        redirect('detailponk/' . $kdponk);
    }
    public function add_item_faktur_nk()
    {
        $kdponk     = $this->input->post('kdponk');
        $kduser     = $this->session->userdata('kode');
        $tgltrsk    = $this->input->post('tgltr');
        $kdbarang   = $this->input->post('kdbrponk');
        $nmbarang   = $this->input->post('nama_isi');
        $descbarang = $this->input->post('desc_isi');
        $ketbarang  = $this->input->post('ket_isi');
        $qtybr      = $this->input->post('qty_isi');
        $hrgsatuan  = $this->input->post('hrg_isi');
        $totalhrg   = $qtybr * $hrgsatuan;

        $addbarang = array(
            'kd_po_nk'      => $kdponk,
            'kd_user'       => $kduser,
            'tgl_transaksi' => $tgltrsk,
            'kd_barang'     => $kdbarang,
            'nama_barang'   => $nmbarang,
            'deskripsi'     => $descbarang,
            'keterangan'    => $ketbarang,
            'qty'           => $qtybr,
            'hrg_satuan'    => $hrgsatuan,
            'total_harga'   => $totalhrg
        );

        $this->M_Postatus->add_faktur_nk($addbarang);
        redirect('detailponk/' . $kdponk);
    }
    public function add_tax_fk_nk()
    {
        $kdponk = $this->input->post('kdponk');
        $tax    = $this->input->post('tax_isi');

        $data_tax = array(
            'tax'   => $tax
        );
        $this->M_Postatus->add_tax_nk($kdponk, $data_tax);
        redirect('detailponk/' . $kdponk);
    }
    public function add_note_pembelian_nk()
    {
        $kdponk = $this->input->post('kdponk');
        $ket    = $this->input->post('ket_isi');

        $data_tax = array(
            'kd_po' => $kdponk,
            'keterangan' => $ket
        );
        $this->M_Postatus->add_note_pembelian_nk($data_tax);
        redirect('detailponk/' . $kdponk);
    }
    public function edit_note_pembelian_nk()
    {
        $id     = $this->input->post('id_isi');
        $kdponk = $this->input->post('kdponk');
        $ket    = $this->input->post('ket_isi');

        $data_tax = array(
            'keterangan' => $ket
        );
        $this->M_Postatus->edit_note_pembelian_nk($id, $data_tax);
        redirect('detailponk/' . $kdponk);
    }
    public function hapus_note_pembelian_nk()
    {
        $id     = $this->input->post('id_isi');
        $kdponk = $this->input->post('kdponk');

        $this->M_Postatus->hapus_note_pembelian_nk($id);

        redirect('detailponk/' . $kdponk);
    }
    public function add_diskon_nk()
    {
        $kdponk = $this->input->post('kdponk');
        $disc   = $this->input->post('desc_isi');
        $nominal = $this->input->post('nominal_isi');

        $datadisc = array(
            'kd_po' => $kdponk,
            'keterangan' => $disc,
            'nominal'   => $nominal
        );

        $this->M_Postatus->insertDiskon($datadisc);
        redirect('detailponk/' . $kdponk);
    }
    public function edit_faktur_item_nk()
    {
        $id         = $this->input->post('idisi');
        $kd         = $this->input->post('kdponk');
        $namabarang = $this->input->post('nama_isi');
        $descbarang = $this->input->post('desc_isi');
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

    public function addnopo()
    {

        $kdponk = $this->input->post('kdponk');
        $nopo   = $this->input->post('nopo');

        $dataedit = array(
            'nopo'  => $nopo
        );

        $this->M_Postatus->addnopo($kdponk, $dataedit);
        redirect('detailponk/' . $kdponk);
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
                'isi_note'  => 'SEDANG DIAJUKAN',
                'kd_user'   => $departement,
                'nama_user'   => $namauser,
                'note_for'  => '1',
                'update_status' => '1'
            );

            $noteupdateuser = array(
                'status'    => 'SEDANG DIAJUKAN'
            );
            $this->M_Postatus->addNote($addnoteuser);
            $this->M_Postatus->updateStatusnk($kdpo, $noteupdateuser);
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
            $this->M_Postatus->updateStatusnk($kdpo, $noteUpdateDirektur);
        } else if ($stslogin == '4') {
            $addnoteuser = array(
                'kd_po'     => $kdpo,
                'isi_note'  => 'SEDANG DIAJUKAN - KADEP',
                'kd_user'   => $departement,
                'nama_user'   => $namauser,
                'note_for'  => '1',
                'update_status' => '1'
            );

            $noteupdateuser = array(
                'status'    => 'ON PROGRESS - KADEP'
            );
            $this->M_Postatus->addNote($addnoteuser);
            $this->M_Postatus->updateStatusnk($kdpo, $noteupdateuser);
        }
        redirect('detailponk/' . $kdpo);
    }

    public function unpostponk($kdpo)
    {
        $departement    = $this->session->userdata('kode');
        $namauser       = $this->session->userdata('nama_user');

        $addNoteKeuangan = array(
            'kd_po'     => $kdpo,
            'isi_note'  => 'UNPOST - PO',
            'kd_user'   => $departement,
            'nama_user'   => $namauser,
            'note_for'  => '1',
            'update_status' => '1'
        );

        $noteUpdateKeuangan = array(
            'status'    => 'ON PROGRESS'
        );
        $this->M_Postatus->addNote($addNoteKeuangan);
        $this->M_Postatus->updateStatusnk($kdpo, $noteUpdateKeuangan);

        redirect('detailponk/' . $kdpo);
    }
    public function hapusponk($kdpo)
    {
        $this->M_Postatus->deleteponk($kdpo);
        $this->M_Postatus->deletepodetnk($kdpo);
        $this->M_Postatus->deletediskonk($kdpo);
        $this->M_Postatus->deletenotenk($kdpo);
        redirect('postatusnk');
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

    public function get_server_all_po()
    {
        $list = $this->M_Postatus->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $row = array();
            $row[]  = $l->id_po;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordTotal" => $this->M_Postatus->count_all(),
            "recordsFiltered" => $this->M_Postatus->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function konfirmasiOrderNK($kdpo, $kddirektur)
    {
        $departement    = $this->session->userdata('kode');
        $namauser       = $this->session->userdata('nama_user');

        $dataKonfirm = array(
            'kd_po_nk' => $kdpo,
            'acc_with_kadep' => $kddirektur,
            'status' => 'ACC-KADEP'
        );

        $notedirektur = array(
            'kd_po'     => $kdpo,
            'isi_note'  => 'PO ACCEPT KADEP',
            'kd_user'   => $departement,
            'nama_user'   => $namauser,
            'note_for'  => '1',
            'update_status' => '1'
        );

        $this->M_Postatus->konfirmPonk($kdpo, $dataKonfirm);
        $this->M_Postatus->addNote($notedirektur);
        redirect('postatusnk');
    }
    public function konfirmasiOrderdirNK($kdpo, $kddirektur)
    {
        $departement    = $this->session->userdata('kode');
        $namauser       = $this->session->userdata('nama_user');

        $dataKonfirm = array(
            'kd_po_nk' => $kdpo,
            'acc_with' => $kddirektur,
            'status' => 'DONE'
        );

        $notedirektur = array(
            'kd_po'     => $kdpo,
            'isi_note'  => 'PO ACCEPT DIREKTUR',
            'kd_user'   => $departement,
            'nama_user'   => $namauser,
            'note_for'  => '1',
            'update_status' => '1'
        );

        $this->M_Postatus->konfirmPonk($kdpo, $dataKonfirm);
        $this->M_Postatus->addNote($notedirektur);
        redirect('postatusnk');
    }

    public function tolakOrderNK()
    {
        $kdpo           = $this->input->post('kdpo');
        $note           = $this->input->post('noteDitektur');
        $departement    = $this->session->userdata('kode');
        $namauser       = $this->session->userdata('nama_user');

        $dataKonfirm = array(
            'kd_po_nk' => $kdpo,
            'status' => 'REJECT'
        );
        $notedirektur = array(
            'kd_po'     => $kdpo,
            'isi_note'  => 'PO REJECT - ' . $note,
            'kd_user'   => $departement,
            'nama_user'   => $namauser,
            'note_for'  => '1',
            'update_status' => '1'
        );

        $this->M_Postatus->tolakPonk($kdpo, $dataKonfirm);
        $this->M_Postatus->addNote($notedirektur);
        redirect('detailponk/' . $kdpo);
    }

    public function pendingordernk()
    {
        $kdpo           = $this->input->post('kdpo');
        $note           = $this->input->post('noteDitektur');
        $departement    = $this->session->userdata('kode');
        $namauser       = $this->session->userdata('nama_user');

        $dataKonfirm = array(
            'kd_po_nk' => $kdpo,
            'status' => 'PENDING'
        );
        $notedirektur = array(
            'kd_po'     => $kdpo,
            'isi_note'  => 'PO PENDING - ' . $note,
            'kd_user'   => $departement,
            'nama_user'   => $namauser,
            'note_for'  => '1',
            'update_status' => '1'
        );

        $this->M_Postatus->pendingordernk($kdpo, $dataKonfirm);
        $this->M_Postatus->addNote($notedirektur);
        redirect('detailponk/' . $kdpo);
    }

    public function insert_note_setting()
    {
        $kdpo           = $this->input->post('kdpo');
        $shipment_to    = $this->input->post('shipment_to');
        $alamat_ship    = $this->input->post('alamat_ship');
        $cp_shipment    = $this->input->post('cp_shipment');
        $no_cp          = $this->input->post('no_cp');

        $note_printout = array(
            'shipment_to'   => $shipment_to,
            'alamat_ship'   => $alamat_ship,
            'cp_shipment'   => $cp_shipment,
            'no_cp'         => $no_cp
        );

        $this->M_Postatus->insert_setting_note($kdpo, $note_printout);

        redirect('detailPO/' . $kdpo);
    }
}
