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
        $data['kode_suplier'] = $this->M_Purchase->Suplier($kdsuplier)->result();
        $data["barang"] = $this->M_Purchase->getBarangSup($kdsuplier)->result();
        $data['tmp']    = $this->M_Purchase->getTmpOrder($kdsuplier);
        $data['total']  = $this->M_Purchase->sumTransaksiPenjualan($kdsuplier);

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/purchase', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/datatables');
        $this->load->view('content/po/ajaxPO');
    }

    public function listBarang($kdsuplier)
    {
        $data['title'] = 'Add Item List';
        $data['kode_suplier'] = $this->M_Purchase->Suplier($kdsuplier)->result();
        $data['barang'] = $this->M_Purchase->getBarangSup($kdsuplier)->result();
        $data['tmp']    = $this->M_Purchase->getTmpOrder($kdsuplier);

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/listbarang', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/datatables');
        $this->load->view('content/po/ajaxPO');
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
        $kemasan    = $this->input->post('kemasan_isi');
        $kdbarang   = $this->input->post('kd_isi');
        $nmbarang   = $this->input->post('nama_isi');
        $satuan     = $this->input->post('satuan_isi');
        $qty        = $this->input->post('qty_isi');
        $tax        = $this->input->post('tax_isi');
        $hasilPPn   = $this->input->post('hasil_ppn');
        $hargaQty   = $this->input->post('hrg_isi');
        $hargaTax   = $hargaQty * $hasilPPn;
        $hasiltax   = $hargaTax + $hargaQty;
        $hargahasil = $hasiltax * $qty;

        $data = array(
            'kode_barang'   => $kdbarang,
            'nama_barang'   => $nmbarang,
            'kode_suplier'  => $suplier,
            'kemasan'       => $kemasan,
            'satuan'        => $satuan,
            'qty'           => $qty,
            'harga_satuan'  => $hasiltax,
            'total_harga'   => $hargahasil,
            'tax'           => $tax
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
        $jml        = $this->input->post('jml');
        $harga      = $this->input->post('harga');
        $tmp        = $this->M_Purchase->get_tmp($suplier);

        $rekamData = array(
            'no_po'         => $nopo,
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
                    'tgl_transaksi' => $tgl,
                    'kd_barang'     => $chart->kode_barang,
                    'nama_barang'   => $chart->nama_barang,
                    'kd_suplier'    => $chart->kode_suplier,
                    'kemasan'       => $chart->kemasan,
                    'satuan'        => $chart->satuan,
                    'qty'           => $chart->qty,
                    'hrg_satuan'    => $chart->harga_satuan,
                    'hrg_total'     => $chart->total_harga,
                    'tax'           => $chart->tax
                );

                $this->M_Purchase->inputDetailPO($listTransaksi);
            }
            $this->M_Purchase->hapusTmp($suplier);
            $msg = "success";
            $data = array('msg' => $msg, 'nopo' => $nopo);
            echo json_encode($data);
        }
    }
}
