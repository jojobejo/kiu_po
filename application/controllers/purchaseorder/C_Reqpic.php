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

        $generatekd = array(
            'kd_barang' => $kdponk
        );
        $this->M_Purchase->generatekd($generatekd);

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
        $kduser = $this->session->userdata('kode');

        // FUNGSI PIC 
        if ($this->session->userdata('lv') == '4') {
            $data['title']      = 'PO Detail Req PIC';
            $data['status']     = $this->M_Reqpic->getrequestbypic($kdpo);
            $data['detreq']     = $this->M_Reqpic->getdetailreqpic($kduser, $kdpo)->result();
            $data['listtr']     = $this->M_Reqpic->getlisttmptr($kdpo)->result();

            $this->load->view('partial/header', $data);
            $this->load->view('partial/sidebar');
            $this->load->view('content/po/Reqpic/detreq', $data);
            $this->load->view('partial/footer');
        }

        // FUNGSI ADM PURCHASING
        elseif ($this->session->userdata('lv') == '2') {
            $data['title']      = 'PO Detail Req PIC';
            $data['status']     = $this->M_Reqpic->getrequestbypic($kdpo);
            $data['detreq']     = $this->M_Reqpic->getdetailreqpic($kduser, $kdpo)->result();
            $data['listtr']     = $this->M_Reqpic->getlisttmptr($kdpo)->result();
 
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
                    'kd_akun'           => '1151',
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
                $this->M_Reqpic->insert_tmp_transaksi($dataitm);
                // DELETE DATA DETAIL
                $this->M_Reqpic->deletedetailponk($kd);

                redirect('reqpic/detreqbarangpic/' . $i->kd_po_nk);
            }
        }
    }
}
