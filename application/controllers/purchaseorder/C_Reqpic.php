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
        $data['getlistpic'] = $this->M_Reqpic->getlistpic();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/Reqpic/body', $data);
        $this->load->view('partial/footer');
    }
    public function list_barang_ready()
    {
        $data['title']      = 'List Barang PO';
        $data['lstock']     = $this->M_Reqpic->getlistnkreq()->result();
        $data['satuan']     = $this->M_Reqpic->getsatuan()->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/Reqpic/listbarang', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/datatables');
    }
    public function addrequestmasterbarangready()
    {
        $inputby    = $this->session->userdata('kode');
        $nmbarang   = $this->input->post('nmbarang');
        $descnk     = $this->input->post('descisi');
        $satuan     = $this->input->post('stuanbr');

        $tmpreqbarang = array(
            'nama_barang'   => $nmbarang,
            'deskripsi'     => $descnk,
            'satuan'        => $satuan,
            'req_by'        => $inputby
        );

        $this->M_Reqpic->insertTmpmbarang($tmpreqbarang);

        redirect('listbarangready');
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
    public function editedreqpic()
    {
        $idnk   = $this->input->post('id_isi');
        $ket    = $this->input->post('ket_isi');
        $qty    = $this->input->post('qty_isi');

        $tmpedited = array(
            'keterangan'    => $ket,
            'qty'           => $qty
        );

        $this->M_Reqpic->editedreqpic($idnk, $tmpedited);
        redirect('reqpic');
    }
    public function deletedtmpnkreq()
    {
        $idnk   = $this->input->post('id_isi');
        $this->M_Reqpic->deletedtmpnkreq($idnk);

        redirect('reqpic');
    }

    public function addnewreq($kduser)
    {
        date_default_timezone_set("Asia/Jakarta");
        $nmuser = $this->session->userdata('nama_user');
        $dep    = $this->session->userdata('departemen');
        $kdus   = $this->session->userdata('kode');
        $kdponk = $this->input->post('kdponk');
        $totbr  = $this->input->post('totbr');
        $tjuan  = $this->input->post('intj');
        $now    = date('Y-m-d');

        $tmp    = $this->M_Reqpic->get_tmp_non_komersil($kduser);

        $inpdataponk = array(
            'jns_po'        => '2',
            'kd_po_nk'      => $kdponk,
            'kd_user'       => $kduser,
            'nm_user'       => $nmuser,
            'tgl_transaksi' => $now,
            'jml_item'      => $totbr,
            'status'        => 'ON PROGRESS',
            'departemen'    => $dep,
            'tj_pembelian'  => $tjuan
        );
        $this->M_Reqpic->inputreq($inpdataponk);

        $generatekd = array(
            'kd_barang' => $kdponk
        );
        $this->M_Purchase->generatekd($generatekd);
        // NOTE FOR 2 == NOTE TRACKING REQUEST PIC

        $inputnt    = array(
            'kd_po'         => $kdponk,
            'isi_note'      => 'REQUEST BARU',
            'kd_user'       => $kdus,
            'nama_user'     => $nmuser,
            'note_for'      => '2',
            'update_status' => '2',

        );
        $this->M_Purchase->addNote($inputnt);

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
                    'status'            => '0'
                );
                $this->M_Reqpic->input_detail_po_nk($listdetreq);
            }

            $this->M_Purchase->hapus_tmp_nk($kduser);
            redirect('reqpic');
        }
    }

    public function detreqbarangpic($kdpo)
    {
        $kduser = $this->session->userdata('kode');
        $sts1   = '1';
        $sts2   = '3';
        $sts0   = '0';

        // FUNGSI PIC 
        if ($this->session->userdata('lv') == '4') {
            $data['title']      = 'PO Detail Req PIC';
            $data['status']     = $this->M_Reqpic->getrequestbypic($kdpo);
            $data['detreqpic']  = $this->M_Reqpic->getreqwherepic($kduser, $kdpo, $sts1)->result();
            $data['detreqpic1']  = $this->M_Reqpic->getreqwherepic($kduser, $kdpo, $sts2)->result();
            $data['detreqpic0']  = $this->M_Reqpic->getreqwherepic($kduser, $kdpo, $sts0)->result();
            $data['listtr']     = $this->M_Reqpic->getlisttmptr($kdpo)->result();
            $data['totsts']     = $this->M_Reqpic->gettotsts($kdpo)->result();
            $data['log']        = $this->M_Reqpic->getNoted($kdpo);

            $this->load->view('partial/header', $data);
            $this->load->view('partial/sidebar');
            $this->load->view('content/po/Reqpic/detreq', $data);
            $this->load->view('partial/footer');
        }

        // FUNGSI ADM PURCHASING
        elseif ($this->session->userdata('lv') == '2') {
            $data['title']      = 'PO Detail Req PIC';
            $data['status']     = $this->M_Reqpic->getrequestbypic($kdpo);
            $data['detreq']     = $this->M_Reqpic->getreqwhere($kdpo, $sts1)->result();
            $data['detreq2']     = $this->M_Reqpic->getreqwhere($kdpo, $sts2)->result();
            $data['detreq0']     = $this->M_Reqpic->getreqwhere($kdpo, $sts0)->result();
            $data['listtr']     = $this->M_Reqpic->getlisttmptr($kdpo)->result();
            $data['totsts']     = $this->M_Reqpic->gettotsts($kdpo)->result();
            $data['countitm']   = $this->M_Reqpic->count_acc_req($kdpo)->result();
            $data['log']        = $this->M_Reqpic->getNoted($kdpo);

            $this->load->view('partial/header', $data);
            $this->load->view('partial/sidebar');
            $this->load->view('content/po/Reqpic/detreq', $data);
            $this->load->view('partial/footer');
        }
    }
    public function confirmreq($kd)
    {
        date_default_timezone_set("Asia/Jakarta");
        $itemconfirm    = $this->M_Reqpic->getitemreq($kd)->result();
        $kduser         = $this->session->userdata('kode');
        $now            = date('Y-m-d');

        if ($itemconfirm) {
            foreach ($itemconfirm as $i) {
                $dataitm = array(
                    'kd_akun'           => '11512',
                    'kd_po_nk'          => $i->kd_po_nk,
                    'kd_barang'         => $i->kd_barang,
                    'kd_barangsys'      => $i->kd_bsys,
                    'keterangan'        => $i->ket,
                    'kat_barang'        => $i->kat_barang,
                    'tr_qty'            => $i->qty,
                    'satuan'            => $i->satuan,
                    'status'            => 'confirm',
                    'inputer'           => $kduser,
                    'create_at'         => $now,
                    'last_updated_by'   => $kduser
                );
            }
            $detitmreq = array(
                'status'    => '1'
            );
            $this->M_Reqpic->updatestsitem($kd, $detitmreq);
            $this->M_Reqpic->insert_tmp_transaksi($dataitm);
            redirect('reqpic/detreqbarangpic/' . $i->kd_po_nk);
        }
    }
    public function pendingreq($kd)
    {
        date_default_timezone_set("Asia/Jakarta");
        $itemconfirm    = $this->M_Reqpic->getitemreq($kd)->result();
        $kduser         = $this->session->userdata('kode');
        $now            = date('Y-m-d');

        if ($itemconfirm) {
            foreach ($itemconfirm as $i) {
                $dataitm = array(
                    'kd_akun'           => '11512',
                    'kd_po_nk'          => $i->kd_po_nk,
                    'kd_barang'         => $i->kd_barang,
                    'kd_barangsys'      => $i->kd_bsys,
                    'keterangan'        => $i->ket,
                    'kat_barang'        => $i->kat_barang,
                    'tr_qty'            => $i->qty,
                    'satuan'            => $i->satuan,
                    'status'            => 'pending',
                    'inputer'           => $kduser,
                    'create_at'         => $now,
                    'last_updated_by'   => $kduser
                );
                $this->M_Reqpic->insert_tmp_transaksi($dataitm);
                // DELETE DATA DETAIL
                $detitmreq = array(
                    'status'    => '3'
                );
                $this->M_Reqpic->updatestsitem($kd, $detitmreq);
                $this->M_Reqpic->deletedetailponk($kd);

                redirect('reqpic/detreqbarangpic/' . $i->kd_po_nk);
            }
        }
    }
    public function accreqpic()
    {
        $kdponk = $this->input->post('kdponk');
        $tgl    = $this->input->post('tgl');
        $kduser = $this->session->userdata('kode');
        $nmuser = $this->session->userdata('nama_user');

        $trtmp  = $this->M_Reqpic->getlisttmptr($kdponk)->result();
        $now    = date('Y-m-d');

        $updatests  = array(
            'status'    => 'REQUEST ACC',
            'acc_with'  => $kduser
        );
        $this->M_Reqpic->updatereqnk($kdponk, $updatests);

        $inputnt    = array(
            'kd_po'         => $kdponk,
            'isi_note'      => 'PENGAJUAN DITERIMA',
            'kd_user'       => $kduser,
            'nama_user'     => $nmuser,
            'note_for'      => '2',
            'update_status' => '2',
        );

        $this->M_Purchase->addNote($inputnt);

        if ($trtmp) {
            foreach ($trtmp as $t) {
                if ($t->status == 'confirm') {
                    $dtitm  = array(
                        'kd_akun'           => '11512',
                        'kd_po_nk'          => $t->kd_po_nk,
                        'kd_barang'         => $t->kd_barang,
                        'kd_barangsys'      => $t->kd_barangsys,
                        'keterangan'        => $t->keterangan,
                        'kat_barang'        => $t->kat_barang,
                        'tr_qty'            => $t->tr_qty,
                        'satuan'            => $t->satuan,
                        'inputer'           => $kduser,
                        'tgl_transaksi'     => $tgl,
                        'create_at'         => $now,
                        'last_updated_by'   => $kduser
                    );
                    $this->M_Reqpic->insert_transaksi($dtitm);
                    $this->M_Reqpic->deletetmptrreq($kdponk);
                } else {
                    $this->M_Reqpic->deletetmptrreq($kdponk);
                }
            }
            redirect('reqpic');
        }
    }
    public function reqpicdone()
    {
        $kdponk     = $this->input->post('kdponk');
        $tglambil   = $this->input->post('tgl');
        $pic        = $this->input->post('pic');
        $kduser     = $this->session->userdata('kode');
        $nmuser     = $this->session->userdata('nama_user');
        $brpending  = $this->M_Reqpic->ls_del_itm_det_req_ponk($kdponk)->result();


        $updatests  = array(
            'tgl_ambil' => $tglambil,
            'status'    => 'DONE',
            'acc_with'  => $kduser
        );
        $this->M_Reqpic->updatereqnk($kdponk, $updatests);

        $inputnt    = array(
            'kd_po'         => $kdponk,
            'isi_note'      => 'ON HAND - ' . $pic,
            'kd_user'       => $kduser,
            'nama_user'     => $nmuser,
            'note_for'      => '2',
            'update_status' => '2',
        );
        $this->M_Purchase->addNote($inputnt);

        if ($brpending) {
            foreach ($brpending as $b) {
                $additm = array(
                    'jnis_po'       => '2',
                    'nama_barang'   => $b->nama_barang,
                    'deskripsi'     => $b->descnk,
                    'keterangan'    => $b->keterangan,
                    'qty'           => $b->tr_qty,
                    'hrg_satuan'    => '0',
                    'total_harga'   => '0',
                    'kd_bsys'       => $b->kd_barangsys,
                    'kd_barang'     => $b->kd_barang,
                    'kat_barang'    => $b->kat_barang,
                    'kd_user'       => $kduser
                );

                $id = $b->id_det_po_nk;

                $this->M_Reqpic->input_new_po_req($additm);
                $this->M_Reqpic->del_itm_det_req_ponk($id);
                redirect('reqpic');
            }
        }
    }
}
