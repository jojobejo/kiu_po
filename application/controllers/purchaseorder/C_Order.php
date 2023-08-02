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

        $data['kode_suplier'] = $this->M_Purchase->Suplier($kdsuplier)->result();
        $data["barang"] = $this->M_Purchase->getBarangSup($kdsuplier)->result();
        $data['tmp']    = $this->M_Purchase->getTmpOrder($kdsuplier);
        $data['total']  = $this->M_Purchase->sumTransaksiPenjualan($kdsuplier);
        $data['kdpo']   = $this->M_Purchase->kdpo($kduser, $kdsuplier);

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
        $kdpo       = $this->input->post('kdpo');
        $jml        = $this->input->post('jml');
        $harga      = $this->input->post('harga');
        $tmp        = $this->M_Purchase->get_tmp($suplier);

        $rekamData = array(
            'no_po'         => $nopo,
            'kd_po'         => $kdpo,
            'tgl_transaksi' => $tgl,
            'kd_suplier'    => $suplier,
            'jml_item'      => $jml,
            'total_harga'   => $harga,
            'status'        => 'ON PROGRESS'
        );
        $this->M_Purchase->inputOrder($rekamData);

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
            $this->M_Purchase->hapusTmp($suplier);
            $msg = "success";
            $data = array('msg' => $msg, 'nopo' => $nopo);
            echo json_encode($data);
        }
    }

    public function pononkomersil()
    {
        $data['title'] = 'Purchase Order Non Komersil';
        $user = $this->session->userdata('kode');
        $data['kdbarang'] = $this->M_Purchase->kdnonkomersial();
        $data['tmp']    = $this->M_Purchase->get_tmp_non_komersil($user);
        $data['total'] = $this->M_Purchase->sumtransaksink();
        $data['nopo'] = $this->M_Purchase->getkdnoponk();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/nonkomersil', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/datatables');
        $this->load->view('content/po/ajaxPO');
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
            'kd_user'       => $kduser
        );
        $this->M_Purchase->input_tmp_nk($dataBarang);

        redirect('pononkomersil');
    }
    public function rekam_po_nk()
    {
        date_default_timezone_set("Asia/Jakarta");
        $kdnk       = $this->input->post('nopo');
        $tgl        = $this->input->post('tgl');
        $departemen = $this->input->post('departemen');
        $tjuan      = $this->input->post('tujuan');
        $jml        = $this->input->post('jml');
        $hrg        = $this->input->post('harga');
        $kduser     = $this->session->userdata('kode');
        $tmp        = $this->M_Purchase->get_tmp_non_komersil($kduser);

        $rekamData = array(
            'kd_po_nk'      => $kdnk,
            'kd_user'       => $kduser,
            'tgl_transaksi' => $tgl,
            'jml_item'      => $jml,
            'total_harga'   => $hrg,
            'status'        => 'ON PROGRESS',
            'departemen'    => $departemen,
            'tj_pembelian'  => $tjuan
        );
        $this->M_Purchase->input_po_nk($rekamData);

        if ($tmp) {
            foreach ($tmp as $chart) {
                $listTransaksi = array(
                    'kd_po_nk'          => $kdnk,
                    'kd_user'           => $kduser,
                    'tgl_transaksi'     => $tgl,
                    'kd_barang'         => $chart->kd_barang,
                    'nama_barang'       => $chart->nama_barang,
                    'deskripsi'         => $chart->deskripsi,
                    'keterangan'        => $chart->keterangan,
                    'qty'               => $chart->qty,
                    'hrg_satuan'        => $chart->hrg_satuan,
                    'total_harga'         => $chart->total_harga,
                );

                $this->M_Purchase->input_detail_po_nk($listTransaksi);
            }
            $this->M_Purchase->hapus_tmp_nk($kduser);
            $msg = "success";
            $data = array('msg' => $msg, 'nopo' => $kdnk);
            echo json_encode($data);
        }
    }
}
