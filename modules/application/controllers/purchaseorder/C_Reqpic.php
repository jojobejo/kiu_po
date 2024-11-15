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
        $this->load->model('PO/M_Postatus');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $kduser = $this->session->userdata('kode');

        $data['title']      = 'PO Request By PIC ';
        $data['tmpreq']     = $this->M_Reqpic->getalltmpreq($kduser)->result();
        $data['getallreq']  = $this->M_Reqpic->getallreq($kduser)->result();
        $data['countreq']   = $this->M_Reqpic->countRequser('1', $kduser);
        $data['generatekd'] = $this->M_Reqpic->kdnonkomersial();
        $data['jumlahbr']   = $this->M_Reqpic->countjmltmpbr($kduser);
        $data['getlistpic'] = $this->M_Reqpic->getlistpic()->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/Reqpic/body', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/Reqpic/datatablesreq');
    }
    public function historireqpic()
    {
        $kduser = $this->session->userdata('kode');

        $data['title']      = 'PO Request By PIC ';
        $data['getallreq']  = $this->M_Reqpic->getallreqdone($kduser)->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/Reqpic/historipodonepic', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/Reqpic/datatablesreq');
    }

    public function index_brsedia()
    {
        $kduser = $this->session->userdata('kode');

        $data['title']      = 'PO Request By PIC ';
        $data['tmpreq']     = $this->M_Reqpic->getalltmpreq($kduser)->result();
        $data['getallreq']  = $this->M_Reqpic->getallreq($kduser)->result();
        $data['countreq']   = $this->M_Reqpic->countRequser('1', $kduser);
        $data['generatekd'] = $this->M_Purchase->kdnonkomersial();
        $data['jumlahbr']   = $this->M_Reqpic->countjmltmpbr($kduser);
        $data['getlistpic'] = $this->M_Reqpic->getlistready()->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/Reqpic/view_req/vreq2', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/Reqpic/datatablesreq');
    }

    public function index_done()
    {
        $kduser = $this->session->userdata('kode');

        $data['title']      = 'PO Request By PIC ';
        $data['tmpreq']     = $this->M_Reqpic->getalltmpreq($kduser)->result();
        $data['getallreq']  = $this->M_Reqpic->getallreq($kduser)->result();
        $data['countreq']   = $this->M_Reqpic->countRequser('1', $kduser);
        $data['generatekd'] = $this->M_Purchase->kdnonkomersial();
        $data['jumlahbr']   = $this->M_Reqpic->countjmltmpbr($kduser);
        $data['getlistpic'] = $this->M_Reqpic->getlistdone()->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/Reqpic/view_req/vreq3', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/Reqpic/datatablesreq');
    }

    public function index_accreq()
    {
        $kduser = $this->session->userdata('kode');

        $data['title']      = 'PO Request By PIC ';
        $data['tmpreq']     = $this->M_Reqpic->getalltmpreq($kduser)->result();
        $data['getallreq']  = $this->M_Reqpic->getallreq($kduser)->result();
        $data['countreq']   = $this->M_Reqpic->countRequser('1', $kduser);
        $data['generatekd'] = $this->M_Purchase->kdnonkomersial();
        $data['jumlahbr']   = $this->M_Reqpic->countjmltmpbr($kduser);
        $data['getlistpic'] = $this->M_Reqpic->getlistpicreqacc()->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/Reqpic/view_req/vreq1', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/Reqpic/datatablesreq');
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
        $kdbarang   = $this->input->post('kdbys');
        $kdsys      = $this->input->post('kdbr');
        $katbarang  = $this->input->post('katbr');
        $idsat  = $this->input->post('idsat');

        $inputtmp = array(
            'jnis_po'       => '1',
            'nama_barang'   => $nmbarang,
            'deskripsi'     => $desc,
            'keterangan'    => $ket,
            'qty'           => $qty,
            'satuan'        => $idsat,
            'hrg_satuan'    => '0',
            'total_harga'   => '0',
            'kd_bsys'       => $kdsys,
            'kd_barang'     => $kdbarang,
            'kat_barang'    => $katbarang,
            'kd_user'       => $kduser
        );
        $this->M_Reqpic->inputreqbr($inputtmp);
        redirect('listbarangready');
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
        $this->M_Reqpic->generatekdponk($generatekd);

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
                    'satuan'            => $t->satuan,
                    'kat_barang'        => $t->kat_barang,
                    'status'            => '0'
                );
                $this->M_Reqpic->input_detail_po_nk($listdetreq);
            }
        }
        $this->M_Reqpic->hapus_tmp_nk($kduser);
        redirect('reqpic');
    }

    public function detreqbarangpic($kdpo)
    {
        $kduser = $this->session->userdata('kode');
        $sts1   = '1';
        $sts2   = '3';
        $sts0   = '0';

        // FUNGSI PIC 
        if ($this->session->userdata('lv') == '4') {
            $data['title']              = 'PO Detail Req PIC';
            $data['status']             = $this->M_Reqpic->getrequestbypic($kdpo);
            $data['stspo']              = $this->M_Reqpic->getbuystsponk($kdpo)->result();
            $data['stspo1']             = $this->M_Reqpic->getbuystsponks($kdpo)->result();
            $data['datereqpic']         = $this->M_Reqpic->getreqpicnosts($kduser, $kdpo)->result();
            $data['getitmlistpicreq']   = $this->M_Reqpic->getitmlistpicreq($kdpo)->result();
            $data['detreqpic1']         = $this->M_Reqpic->getreqwherepic($kduser, $kdpo, $sts1)->result();
            $data['detreqpic2']         = $this->M_Reqpic->getreqwherepic($kduser, $kdpo, $sts2)->result();
            $data['detreqpic0']         = $this->M_Reqpic->getreqwherepic($kduser, $kdpo, $sts0)->result();
            $data['listtr']             = $this->M_Reqpic->getlisttmptr($kdpo)->result();
            $data['totsts']             = $this->M_Reqpic->gettotsts($kdpo)->result();
            $data['detreq']             = $this->M_Reqpic->getreqwheres($kdpo)->result();
            $data['log']                = $this->M_Reqpic->getNoted($kdpo);

            $this->load->view('partial/header', $data);
            $this->load->view('partial/sidebar');
            $this->load->view('content/po/Reqpic/detreq', $data);
            $this->load->view('partial/footer');
        }

        // FUNGSI ADM PURCHASING
        elseif ($this->session->userdata('lv') == '2') {
            $data['title']      = 'PO Detail Req PIC';
            $data['stspo']      = $this->M_Reqpic->getbuystsponk($kdpo)->result();

            $data['status']          = $this->M_Reqpic->getrequestbypic($kdpo);
            $data['kdponks']         = $this->M_Purchase->getkdnoponk();
            $data['detreq']          = $this->M_Reqpic->getreqwheres($kdpo)->result();
            $data['detreq1']         = $this->M_Reqpic->getreqwhere($kdpo, $sts1)->result();
            $data['detreq2']         = $this->M_Reqpic->getreqwhere($kdpo, $sts2)->result();
            $data['detreq0']         = $this->M_Reqpic->getreqwhere($kdpo, $sts0)->result();
            $data['listtr']          = $this->M_Reqpic->getlisttmptr($kdpo)->result();
            $data['totsts']          = $this->M_Reqpic->gettotsts($kdpo)->result();
            $data['countitm']        = $this->M_Reqpic->count_acc_req($kdpo)->result();
            $data['countjmlharga']   = $this->M_Reqpic->countjmlharga($kdpo)->result();
            $data['log']             = $this->M_Reqpic->getNoted($kdpo);
            $data['gettrs']          = $this->M_Reqpic->gettr($kdpo)->result();
            $data['gettr']           = $this->M_Reqpic->getdetailreq($kdpo)->result();

            $this->load->view('partial/header', $data);
            $this->load->view('partial/sidebar');
            $this->load->view('content/po/Reqpic/detreq', $data);
            $this->load->view('partial/footer');
        }
    }
    public function confirmreq()
    {
        date_default_timezone_set("Asia/Jakarta");
        $idponkss        = $this->input->post('idponkss');
        $kd_user        = $this->input->post('kduserss');
        $itemconfirm    = $this->M_Reqpic->getitemreq($idponkss)->result();
        $now            = date('Y-m-d');

        if ($itemconfirm) {
            foreach ($itemconfirm as $i) {

                $updatedpostmp = array(
                    'kd_akun'           => '11512',
                    'kd_po_nk'          => $i->kd_po_nk,
                    'kd_barang'         => $i->kd_barang,
                    'kd_barangsys'      => $i->kd_bsys,
                    'keterangan'        => $i->ket,
                    'kat_barang'        => $i->kat_barang,
                    'tr_qty'            => $i->qty,
                    'satuan'            => $i->satuan,
                    'status'            => 'confirm',
                    'inputer'           => $kd_user,
                    'create_at'         => $now,
                    'last_updated_by'   => $kd_user
                );
                $detitmreq = array(
                    'status'    => '1'
                );
            }
            $this->M_Reqpic->updatestsitem($idponkss, $detitmreq);
            $this->M_Reqpic->inpt_tr_tmp($updatedpostmp);

            redirect('reqpic/detreqbarangpic/' . $i->kd_po_nk);
        }
    }
    public function actconfirm($id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $itempnd        = $this->M_Reqpic->getitemreq($id)->result();
        $now            = date('Y-m-d h:m:s');
        $now1           = date('Y-m-d');

        if ($itempnd) {
            foreach ($itempnd as $i) {
                $updatedpostmp = array(
                    'kd_akun'           => '11512',
                    'kd_po_nk'          => $i->kd_po_nk,
                    'kd_barang'         => $i->kd_barang,
                    'kd_barangsys'      => $i->kd_bsys,
                    'keterangan'        => $i->ket,
                    'kat_barang'        => $i->kat_barang,
                    'tr_qty'            => $i->qty,
                    'satuan'            => $i->satuan,
                    'inputer'           => $this->session->userdata('kode'),
                    'req_by'            => $i->kduser,
                    'tgl_transaksi'     => $now1,
                    'create_at'         => $now,
                    'last_updated_by'   => $this->session->userdata('kode')
                );
                $updtstatus = array(
                    'status'    => '1'
                );
                $kode_po    = $i->kd_po_nk;
                $this->M_Reqpic->insert_transaksi($updatedpostmp);
                $this->M_Reqpic->updatedetreqitm($id, $updtstatus);
                redirect('reqpic/detreqbarangpic/' . $kode_po);
            }
        }
    }
    public function actpending($id, $kd)
    {
        date_default_timezone_set("Asia/Jakarta");
        $qty        = $this->input->post('qty_isi');
        $hrgsatuan  = $this->input->post('hrg_isi');
        $itempnd    = $this->M_Reqpic->getitemreq($id)->result();
        $now        = date('Y-m-d h:m:s');

        if ($itempnd) {
            foreach ($itempnd as $i) {
                $updatedpostmp = array(
                    'kd_akun'           => '11512',
                    'kd_po_nk'          => $i->kd_po_nk,
                    'kd_barang'         => $i->kd_barang,
                    'kd_barangsys'      => $i->kd_bsys,
                    'kat_barang'        => $i->kat_barang,
                    'tr_qty'            => $qty,
                    'satuan'            => $i->satuan,
                    'hrg_satuan'        => $hrgsatuan,
                    'status'            => 'pending',
                    'keterangan'        => $i->ket,
                    'inputer'           => $this->session->userdata('kode'),
                    'create_at'         => $now,
                    'last_updated_by'   => $this->session->userdata('kode')
                );

                $updtstatus = array(
                    'status'    => '4'
                );

                $this->M_Reqpic->insert_tmp_transaksi($updatedpostmp);
                $this->M_Reqpic->updatedetreqitm($id, $updtstatus);
                redirect('reqpic/detreqbarangpic/' . $kd);
            }
        }
    }

    public function pendingreq()
    {
        date_default_timezone_set("Asia/Jakarta");

        $idponks        = $this->input->post('pndidponks');
        $kdponk         = $this->input->post('pndkdponk');
        $kdponks        = $this->input->post('pndkdponks');
        $jml            = $this->input->post('pndjmls');
        $kd_user        = $this->input->post('pndkduser');
        $nm_user        = $this->input->post('pndnmuser');
        $departemen     = $this->input->post('pnddep');
        $tjbeli         = $this->input->post('pndtjbeli');
        $totn           = $this->input->post('pndtotn');
        $itemconfirm    = $this->M_Reqpic->getitemreq($idponks)->result();
        $now            = date('Y-m-d');

        if ($totn == '0') {

            $newponk = array(
                'jns_po'            => '2',
                'kd_po_nk'          => $kdponks,
                'kd_po_req'         => $kdponk,
                'nopo'              => '-',
                'kd_user'           => $kd_user,
                'nm_user'           => $nm_user,
                'tgl_transaksi'     => $now,
                'jml_item'          => $jml,
                'total_harga'       => '0',
                'status'            => 'ON PROGRESS - KADEP',
                'departemen'        => $departemen,
                'tj_pembelian'      => $tjbeli,
                'tax'               => '0',
                'hrg_pajak'         => '0',
                'hrg_nyata'         => '0',
                'status_hrg_nyata'  => '0',
                'acc_with'          => '',
                'acc_with_kadep'    => ''
            );

            if ($itemconfirm) {
                foreach ($itemconfirm as $i) {
                    $updatedpostmp = array(
                        'kd_akun'           => '11512',
                        'kd_po_nk'          => $i->kd_po_nk,
                        'kd_barang'         => $i->kd_barang,
                        'kd_barangsys'      => $i->kd_bsys,
                        'kat_barang'        => $i->kat_barang,
                        'tr_qty'            => $i->qty,
                        'satuan'            => $i->satuan,
                        'status'            => 'pending',
                        'keterangan'        => $i->ket,
                        'inputer'           => $kd_user,
                        'create_at'         => $now,
                        'last_updated_by'   => $kd_user
                    );
                    $dataitm = array(
                        'kd_po_nk'      => $kdponks,
                        'kd_po_req'     => $kdponk,
                        'kd_user'       => $kd_user,
                        'tgl_transaksi' => $now,
                        'kd_bsys'       => $i->kd_bsys,
                        'kd_barang'     => $i->kd_barang,
                        'nama_barang'   => $i->nm_barang,
                        'deskripsi'     => $i->descnk,
                        'keterangan'    => $i->ket,
                        'qty'           => $i->qty,
                        'hrg_satuan'    => '0',
                        'hrg_nyata'     => '0',
                        'total_harga'   => '0',
                        'total_nyata'   => '0',
                        'gbr_produk'    => 'Karisma.png',
                    );
                    $this->M_Reqpic->insert_tmp_transaksi($updatedpostmp);
                    $this->M_Reqpic->insertbrponkpending($dataitm);
                }
            }
            $detitmreq = array(
                'status'    => '3'
            );
            $this->M_Reqpic->insertpobaru($newponk);
            $this->M_Reqpic->updatestsitem($idponks, $detitmreq);
            redirect('reqpic/detreqbarangpic/' . $kdponk);
        } else {
            if ($itemconfirm) {
                foreach ($itemconfirm as $i) {
                    $updatedpostmps = array(
                        'kd_akun'           => '11512',
                        'kd_po_nk'          => $i->kd_po_nk,
                        'kd_barang'         => $i->kd_barang,
                        'kd_barangsys'      => $i->kd_bsys,
                        'keterangan'        => $i->ket,
                        'kat_barang'        => $i->kat_barang,
                        'tr_qty'            => $i->qty,
                        'satuan'            => $i->satuan,
                        'status'            => 'pending',
                        'inputer'           => $kd_user,
                        'create_at'         => $now,
                        'last_updated_by'   => $kd_user
                    );
                    $dataitms = array(
                        'kd_po_nk'      => $kdponks,
                        'kd_po_req'     => $kdponk,
                        'kd_user'       => $kd_user,
                        'tgl_transaksi' => $now,
                        'kd_bsys'       => $i->kd_bsys,
                        'kd_barang'     => $i->kd_barang,
                        'nama_barang'   => $i->nm_barang,
                        'deskripsi'     => $i->descnk,
                        'keterangan'    => $i->ket,
                        'qty'           => $i->qty,
                        'hrg_satuan'    => '0',
                        'hrg_nyata'     => '0',
                        'total_harga'   => '0',
                        'total_nyata'   => '0',
                        'gbr_produk'    => 'Karisma.png',
                    );
                    $this->M_Reqpic->insert_tmp_transaksi($updatedpostmps);
                    $this->M_Reqpic->insertbrponkpending($dataitms);
                }
            }
            $detitmreq = array(
                'status'    => '3'
            );

            $this->M_Reqpic->updatestsitem($idponks, $detitmreq);
            redirect('reqpic/detreqbarangpic/' . $kdponk);
        }
    }
    public function pendingreq1()
    {
        date_default_timezone_set("Asia/Jakarta");

        $idponks        = $this->input->post('idpnd');
        $kdponk         = $this->input->post('kdponkpnd');
        $kdponks        = $this->input->post('kdponkspnd');
        $jml            = $this->input->post('jmlspnd');
        $kd_user        = $this->input->post('kduserpnd');
        $nm_user        = $this->input->post('nmuserpnd');
        $departemen     = $this->input->post('deppnd');
        $tjbeli         = $this->input->post('tjbelipnd');
        $totn           = $this->input->post('totnpnd');
        $itemconfirm    = $this->M_Reqpic->getitemreq($idponks)->result();
        $now            = date('Y-m-d');

        if ($totn == '0') {

            $newponk = array(
                'jns_po'            => '2',
                'kd_po_nk'          => $kdponks,
                'kd_po_req'         => $kdponk,
                'nopo'              => '-',
                'kd_user'           => $kd_user,
                'nm_user'           => $nm_user,
                'tgl_transaksi'     => $now,
                'jml_item'          => $jml,
                'total_harga'       => '0',
                'status'            => 'ON PROGRESS - KADEP',
                'departemen'        => $departemen,
                'tj_pembelian'      => $tjbeli,
                'tax'               => '0',
                'hrg_pajak'         => '0',
                'hrg_nyata'         => '0',
                'status_hrg_nyata'  => '0',
                'acc_with'          => '',
                'acc_with_kadep'    => ''
            );

            if ($itemconfirm) {
                foreach ($itemconfirm as $i) {
                    $updatedpostmp = array(
                        'kd_akun'           => '11512',
                        'kd_po_nk'          => $i->kd_po_nk,
                        'kd_barang'         => $i->kd_barang,
                        'kd_barangsys'      => $i->kd_bsys,
                        'keterangan'        => $i->ket,
                        'kat_barang'        => $i->kat_barang,
                        'tr_qty'            => $i->qty,
                        'satuan'            => $i->satuan,
                        'status'            => 'pending',
                        'inputer'           => $kd_user,
                        'create_at'         => $now,
                        'last_updated_by'   => $kd_user
                    );
                    $dataitm = array(
                        'kd_po_nk'      => $kdponks,
                        'kd_po_req'     => $kdponk,
                        'kd_user'       => $kd_user,
                        'tgl_transaksi' => $now,
                        'kd_bsys'       => $i->kd_bsys,
                        'kd_barang'     => $i->kd_barang,
                        'nama_barang'   => $i->nm_barang,
                        'deskripsi'     => $i->descnk,
                        'keterangan'    => $i->ket,
                        'qty'           => $i->qty,
                        'hrg_satuan'    => '0',
                        'hrg_nyata'     => '0',
                        'total_harga'   => '0',
                        'total_nyata'   => '0',
                        'gbr_produk'    => 'Karisma.png',
                    );
                    $this->M_Reqpic->insert_tmp_transaksi($updatedpostmp);
                    $this->M_Reqpic->insertbrponkpending($dataitm);
                }
            }
            $detitmreq = array(
                'status'    => '3'
            );
            $this->M_Reqpic->insertpobaru($newponk);
            $this->M_Reqpic->updatestsitem($idponks, $detitmreq);
            redirect('reqpic/detreqbarangpic/' . $kdponk);
        } else {
            if ($itemconfirm) {
                foreach ($itemconfirm as $i) {
                    $updatedpostmps = array(
                        'kd_akun'           => '11512',
                        'kd_po_nk'          => $i->kd_po_nk,
                        'kd_barang'         => $i->kd_barang,
                        'kd_barangsys'      => $i->kd_bsys,
                        'keterangan'        => $i->ket,
                        'kat_barang'        => $i->kat_barang,
                        'tr_qty'            => $i->qty,
                        'satuan'            => $i->satuan,
                        'status'            => 'pending',
                        'inputer'           => $kd_user,
                        'create_at'         => $now,
                        'last_updated_by'   => $kd_user
                    );
                    $dataitms = array(
                        'kd_po_nk'      => $kdponks,
                        'kd_po_req'     => $kdponk,
                        'kd_user'       => $kd_user,
                        'tgl_transaksi' => $now,
                        'kd_bsys'       => $i->kd_bsys,
                        'kd_barang'     => $i->kd_barang,
                        'nama_barang'   => $i->nm_barang,
                        'deskripsi'     => $i->descnk,
                        'keterangan'    => $i->ket,
                        'qty'           => $i->qty,
                        'hrg_satuan'    => '0',
                        'hrg_nyata'     => '0',
                        'total_harga'   => '0',
                        'total_nyata'   => '0',
                        'gbr_produk'    => 'Karisma.png',
                    );
                    $this->M_Reqpic->insert_tmp_transaksi($updatedpostmps);
                    $this->M_Reqpic->insertbrponkpending($dataitms);
                }
            }
            $detitmreq = array(
                'status'    => '3'
            );

            $this->M_Reqpic->updatestsitem($idponks, $detitmreq);
            redirect('reqpic/detreqbarangpic/' . $kdponk);
        }
    }
    public function acc_req_admin_plus()
    {
        //PIC ADMIN
        $kdreqpo    = $this->input->post('kdreqpo');
        $updatests  = array(
            'status'    => 'REQUEST ACC',
            'acc_with'  => $this->session->userdata('kode')
        );

        $inputnt    = array(
            'kd_po'         => $kdreqpo,
            'isi_note'      => 'PENGAJUAN DITERIMA',
            'kd_user'       => $this->session->userdata('kode'),
            'nama_user'     => $this->session->userdata('nama_user'),
            'note_for'      => '2',
            'update_status' => '2',
        );
        $this->M_Reqpic->updatereqnk($kdreqpo, $updatests);
        $this->M_Purchase->addNote($inputnt);
        $this->M_Reqpic->deletetmptrreq($kdreqpo);
        redirect('reqpic/detreqbarangpic/' . $kdreqpo);
    }

    public function acc_req_admin()
    {
        //PIC ADMIN
        $useradmin  =  $this->session->userdata('nama_user');
        $kdadmin  =  $this->session->userdata('kode');

        $kdponk     = $this->input->post('kdponk');
        $kdreqpo    = $this->input->post('kdreqpo');
        $kduser     = $this->input->post('kdpic');
        $nmuser     = $this->input->post('pic');
        $jmlitm     = $this->input->post('jml');
        $dep        = $this->input->post('dep');
        $jmltot     = $this->input->post('jmltot');
        $tjpem      = $this->input->post('tjbuy');
        $trtmp      = $this->M_Reqpic->getlisttmptr($kdreqpo)->result();
        $now        = date('Y-m-d h:m:s');
        $now1       = date('Y-m-d');

        $insrtpembelianpo = array(
            'jns_po'            => '2',
            'kd_po_nk'          => $kdponk,
            'kd_po_req'         => $kdreqpo,
            'nopo'              => '-',
            'kd_user'           => $kdadmin,
            'nm_user'           => $useradmin,
            'tgl_transaksi'     => $now1,
            'jml_item'          => $jmlitm,
            'total_harga'       => $jmltot,
            'status'            => 'ON PROGRESS - KADEP',
            'departemen'        => $dep,
            'tj_pembelian'      => $tjpem,
            'tax'               => '0',
            'hrg_pajak'         => '0',
            'hrg_nyata'         => '0',
            'status_hrg_nyata'  => '0',
            'acc_with'          => $this->session->userdata('kode'),
            'acc_with_kadep'    => ''
        );
        $this->M_Reqpic->inputponew($insrtpembelianpo);

        $updatests  = array(
            'status'    => 'REQUEST ACC',
            'acc_with'  => $this->session->userdata('kode')
        );

        $this->M_Reqpic->updatereqnk($kdreqpo, $updatests);
        // ==================================================================================
        $inputnt    = array(
            'kd_po'         => $kdreqpo,
            'isi_note'      => 'PENGAJUAN DITERIMA',
            'kd_user'       => $this->session->userdata('kode'),
            'nama_user'     => $this->session->userdata('nama_user'),
            'note_for'      => '2',
            'update_status' => '2',
        );
        $this->M_Purchase->addNote($inputnt);

        $inputntpobaru    = array(
            'kd_po'         => $kdponk,
            'isi_note'      => 'PO Re-Stock Barang Kebutuhan',
            'kd_user'       => $this->session->userdata('kode'),
            'nama_user'     => $this->session->userdata('nama_user'),
            'note_for'      => '2',
            'update_status' => '2',
        );

        $updatests = array(
            'kd_po_nk'  => $kdreqpo,
            'status'    => '4'
        );

        $this->M_Purchase->addNote($inputntpobaru);
        $this->M_Reqpic->updatereqnk_stsbr($kdreqpo, $updatests);

        if ($trtmp) {
            foreach ($trtmp as $i) {

                $qty    = $i->tr_qty;
                $hrgs   = $i->hrg_satuan;
                $tothrg = ($qty * $hrgs);

                $datainputdetailpo = array(
                    'kd_po_nk'      => $kdponk,
                    'kd_po_req'     => $kdreqpo,
                    'kd_user'       => $kduser,
                    'tgl_transaksi' => $now1,
                    'kd_bsys'       => $i->kd_barangsys,
                    'kd_barang'     => $i->kd_barang,
                    'nama_barang'   => $i->nama_barang,
                    'deskripsi'     => $i->descnk,
                    'keterangan'    => $i->keterangan,
                    'qty'           => $i->tr_qty,
                    'satuan'        => $i->satuan,
                    'kat_barang'    => $i->kat_barang,
                    'hrg_satuan'    => $i->hrg_satuan,
                    'hrg_nyata'     => '0',
                    'total_harga'   => $tothrg,
                    'total_nyata'   => '0',
                    'gbr_produk'    => 'Karisma.png',
                );
                $this->M_Reqpic->insertbrponkpending($datainputdetailpo);
                $this->M_Reqpic->deletetmptrreq($kdreqpo);
            }
            redirect('reqpic');
        }

        redirect('reqpic/detreqbarangpic/' . $kdreqpo);
    }
    public function accreqpic()
    {
        $kdponk     = $this->input->post('kdponk');
        $kdponks    = $this->input->post('kdponks');
        $jml        = $this->input->post('jmls');
        $tgl        = $this->input->post('tgl');
        $kd_user    = $this->input->post('kduser');
        $nm_user    = $this->input->post('nmuser');
        $departemen = $this->input->post('dep');
        $tjbeli     = $this->input->post('tjbeli');
        $kduser     = $this->session->userdata('kode');
        $nmuser     = $this->session->userdata('nama_user');
        $totn     = $this->input->post('totn');
        $trtmp      = $this->M_Reqpic->getlisttmptr($kdponk)->result();
        $now        = date('Y-m-d');

        $updatests  = array(
            'status'    => 'REQUEST ACC',
            'acc_with'  => $kduser
        );
        $this->M_Reqpic->updatereqnk($kdponk, $updatests);
        // ==================================================================================
        $inputnt    = array(
            'kd_po'         => $kdponk,
            'isi_note'      => 'PENGAJUAN DITERIMA',
            'kd_user'       => $kduser,
            'nama_user'     => $nmuser,
            'note_for'      => '2',
            'update_status' => '2',
        );
        $this->M_Purchase->addNote($inputnt);
        // ==================================================================================

        if ($totn > 1) {
            $inrtponk = array(
                'jns_po'            => '2',
                'kd_po_nk'          => $kdponks,
                'kd_po_req'         => $kdponk,
                'nopo'              => '-',
                'kd_user'           => $kd_user,
                'nm_user'           => $nm_user,
                'tgl_transaksi'     => $now,
                'jml_item'          => $jml,
                'total_harga'       => '0',
                'status'            => 'ON PROGRESS - KADEP',
                'departemen'        => $departemen,
                'tj_pembelian'      => $tjbeli,
                'tax'               => '0',
                'hrg_pajak'         => '0',
                'hrg_nyata'         => '0',
                'status_hrg_nyata'  => '0',
                'acc_with'          => '',
                'acc_with_kadep'    => ''
            );
            $inputnknote    = array(
                'kd_po'         => $kdponks,
                'isi_note'      => 'PO-PERSEDIAAN BARANG',
                'kd_user'       => $kduser,
                'nama_user'     => $nmuser,
                'note_for'      => '2',
                'update_status' => '2',
            );

            $this->M_Reqpic->inputponew($inrtponk);
            $this->M_Purchase->addNote($inputnknote);

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
                    } else {
                        $dtinsrtponk = array(
                            'kd_po_nk'      => $kdponks,
                            'kd_po_req'     => $kdponk,
                            'kd_user'       => $t->kd_user,
                            'tgl_transaksi' => $now,
                            'kd_bsys'       => $t->kd_barangsys,
                            'kd_barang'     => $t->kd_barang,
                            'nama_barang'   => $t->nama_barang,
                            'deskripsi'     => $t->descnk,
                            'keterangan'    => $t->keterangan,
                            'qty'           => $t->tr_qty,
                            'hrg_satuan'    => '0',
                            'hrg_nyata'     => '0',
                            'total_harga'   => '0',
                            'total_nyata'   => '0',
                            'gbr_produk'    => $t->gbr_barang,
                        );
                        $this->M_Reqpic->insert_tmp_po_persediaan($dtinsrtponk);
                        $this->M_Reqpic->deletetmptrreq($kdponk);
                    }
                }
            }
        } else {
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
                    } else {
                        $dtinsrtponk = array(
                            'kd_po_nk'      => $kdponks,
                            'kd_po_req'     => $kdponk,
                            'kd_user'       => $t->kd_user,
                            'tgl_transaksi' => $now,
                            'kd_bsys'       => $t->kd_barangsys,
                            'kd_barang'     => $t->kd_barang,
                            'nama_barang'   => $t->nama_barang,
                            'deskripsi'     => $t->descnk,
                            'keterangan'    => $t->keterangan,
                            'qty'           => $t->tr_qty,
                            'hrg_satuan'    => '0',
                            'hrg_nyata'     => '0',
                            'total_harga'   => '0',
                            'total_nyata'   => '0',
                            'gbr_produk'    => $t->gbr_barang,
                        );
                        $this->M_Reqpic->insert_tmp_po_persediaan($dtinsrtponk);
                        $this->M_Reqpic->deletetmptrreq($kdponk);
                    }
                }
            }
        }
        redirect('reqpic');
    }

    public function reqpicconfirmed()
    {
        $kdadmin    = $this->session->userdata('kode');
        $nmadmin    = $this->session->userdata('nama_user');
        $kdporeq    = $this->input->post('kdreqpo');
        $kdponk     = $this->input->post('kdponk');
        $now        = date('Y-m-d h:m:s');
        $now1       = date('Y-m-d');
        $tmp        = $this->M_Reqpic->getdatapobaru($kdponk)->result();

        $updatests  = array(
            'status'    => 'BARANG TERSEDIA',
            'acc_with'  => $kdadmin
        );
        $this->M_Reqpic->updatereqnk($kdporeq, $updatests);

        $updatepobeli = array(
            'status'    => 'DONE'
        );
        $this->M_Reqpic->updatestsponk($kdponk, $updatepobeli);

        $addnoteuser = array(
            'kd_po'         => $kdponk,
            'isi_note'      => 'BARANG DI TERIMA - ADMIN',
            'kd_user'       => $kdadmin,
            'nama_user'     => $nmadmin,
            'note_for'      => '1',
            'update_status' => '1'
        );
        $addnoteuser1 = array(
            'kd_po'         => $kdporeq,
            'isi_note'      => 'BARANG DI TERIMA - ADMIN',
            'kd_user'       => $kdadmin,
            'nama_user'     => $nmadmin,
            'note_for'      => '2',
            'update_status' => '2'
        );
        $this->M_Purchase->addNote($addnoteuser);
        $this->M_Purchase->addNote($addnoteuser1);

        if ($tmp) {
            foreach ($tmp as $t) {
                $databelink = array(
                    'kd_akun'           => '11511',
                    'kd_po_nk'          => $t->kdporeq,
                    'kd_barang'         => $t->kdbr,
                    'kd_barangsys'      => $t->kdbsys,
                    'keterangan'        => $t->ket,
                    'kat_barang'        => $t->kat,
                    'tr_qty'            => $t->trqty,
                    'satuan'            => $t->satuan,
                    'tgl_transaksi'     => $now1,
                    'inputer'           => $this->session->userdata('kode'),
                    'req_by'            => $t->kduser,
                    'create_at'         => $now,
                    'last_updated_by'   => $this->session->userdata('kode')
                );
                $this->M_Reqpic->input_tr($databelink);
            }
            redirect('reqpic/detreqbarangpic/' . $kdporeq);
        }
    }
    public function reqpicconfirmed_plus()
    {
        $kdadmin    = $this->session->userdata('kode');
        $nmadmin    = $this->session->userdata('nama_user');
        $kdporeq    = $this->input->post('kdreqpo');

        $updatests  = array(
            'status'    => 'BARANG TERSEDIA',
            'acc_with'  => $kdadmin
        );
        $this->M_Reqpic->updatereqnk($kdporeq, $updatests);

        $addnoteuser1 = array(
            'kd_po'         => $kdporeq,
            'isi_note'      => 'BARANG DI TERIMA - ADMIN',
            'kd_user'       => $kdadmin,
            'nama_user'     => $nmadmin,
            'note_for'      => '2',
            'update_status' => '2'
        );
        $this->M_Purchase->addNote($addnoteuser1);

        redirect('reqpic/detreqbarangpic/' . $kdporeq);
    }

    public function reqpicdone()
    {
        $kdponk     = $this->input->post('kdponk');
        $pic        = $this->input->post('kd_user');
        $actdone    = $this->input->post('actdone');
        $now        = date('Y-m-d');
        $kduser     = $this->session->userdata('kode');
        $nmuser     = $this->session->userdata('nama_user');
        $tmp        = $this->M_Reqpic->getdatapobarureq($kdponk)->result();

        if ($actdone == '1') {
            $updatests  = array(
                'tgl_ambil' => $now,
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

            if ($tmp) {
                foreach ($tmp as $t) {
                    $dataconfirm = array(
                        'kd_akun'           => '11512',
                        'kd_po_nk'          => $t->kdporeq,
                        'kd_barang'         => $t->kdbr,
                        'kd_barangsys'      => $t->kdbsys,
                        'keterangan'        => $t->ket,
                        'kat_barang'        => $t->kat,
                        'tr_qty'            => $t->trqty,
                        'satuan'            => $t->satuan,
                        'tgl_transaksi'     => $now,
                        'inputer'           => $this->session->userdata('kode'),
                        'req_by'            => $t->kduser,
                        'create_at'         => $now,
                        'last_updated_by'   => $this->session->userdata('kode')
                    );
                    $this->M_Reqpic->input_tr($dataconfirm);
                }
                redirect('reqpic/detreqbarangpic/' . $kdponk);
            }
        } elseif ($actdone == '2') {
            $updatests  = array(
                'tgl_ambil' => $now,
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

            if ($tmp) {
                foreach ($tmp as $t) {
                    $dataconfirm = array(
                        'kd_akun'           => '11512',
                        'kd_po_nk'          => $t->kdporeq,
                        'kd_barang'         => $t->kdbr,
                        'kd_barangsys'      => $t->kdbsys,
                        'keterangan'        => $t->ket,
                        'kat_barang'        => $t->kat,
                        'tr_qty'            => $t->trqty,
                        'satuan'            => $t->satuan,
                        'tgl_transaksi'     => $now,
                        'inputer'           => $this->session->userdata('kode'),
                        'req_by'            => $t->kduser,
                        'create_at'         => $now,
                        'last_updated_by'   => $this->session->userdata('kode')
                    );
                    $this->M_Reqpic->input_tr($dataconfirm);
                }
                redirect('reqpic/detreqbarangpic/' . $kdponk);
            }
        }
    }
}
