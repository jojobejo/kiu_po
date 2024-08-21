<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_Purchase extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getSuplier()
    {
        return $this->db->get('tb_suplier')->result();
    }
    public function getTax()
    {
        return $this->db->get('tb_set_tax')->result();
    }
    public function gettmptax($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_tmp_tax a');
        $this->db->where('kd_suplier', $kd);
        $query = $this->db->get();
        return $query;
    }
    public function getSatuan()
    {
        return $this->db->get('tb_satuan')->result();
    }
    public function getBarangSup($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->where('kd_suplier', $kd);
        $query = $this->db->get();
        return $query;
    }
    public function gettaxposup($kd)
    {
        $this->db->select('COUNT(a.id_tmp_tax) as tot');
        $this->db->select('a.tax');
        $this->db->select('a.kd_suplier');
        $this->db->from('tb_tmp_tax a');
        $this->db->where('kd_suplier', $kd);
        $query = $this->db->get();
        return $query;
    }
    public function Suplier($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_suplier');
        $this->db->where('kd_suplier', $kd);
        $query = $this->db->get();
        return $query;
    }
    public function addSuplier($data)
    {
        $this->db->insert('tb_suplier', $data);
    }
    function editSuplier($kd, $data)
    {
        $this->db->where('kd_suplier', $kd);
        return $this->db->update('tb_suplier', $data);
    }
    public function addChart($data)
    {
        $this->db->insert('tb_tmp_item', $data);
    }
    public function update_tax_tmp($kd, $data)
    {
        $this->db->where('kd_suplier', $kd);
        return $this->db->update('tb_tmp_tax', $data);
    }
    public function add_tax_tmp($data)
    {
        $this->db->insert('tb_tmp_tax', $data);
    }
    public function getTmpOrder($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_tmp_item');
        $this->db->where('kode_suplier', $kd);
        $query = $this->db->get()->result();
        return $query;
    }
    function sumTransaksiPenjualan($id_tmp)
    {
        $this->db->select("SUM(total_harga) as total_harga");
        $this->db->select("COUNT(id_tmp) as total_item");
        $this->db->from('tb_tmp_item');
        $this->db->where('kode_suplier', $id_tmp);
        return $this->db->get()->result();
    }

    public function hapusChart($id)
    {
        $this->db->where('id_tmp', $id);
        return $this->db->delete('tb_tmp_item');
    }

    public function get_tmp($id_tmp)
    {
        $this->db->from('tb_tmp_item');
        $this->db->where('kode_suplier', $id_tmp);
        return $this->db->get()->result();
    }

    public function inputOrder($data)
    {
        $this->db->insert('tb_po', $data);
    }
    public function inputDetailPO($data)
    {
        $this->db->insert('tb_detail_po', $data);
    }
    public function hapusTmp($id_tmp)
    {
        $this->db->where('kode_suplier', $id_tmp);
        return $this->db->delete('tb_tmp_item');
    }
    function kdpo($kduser, $kdsuplier)
    {
        if ($kduser == 'KIUADMIN') {
            $cd = $this->db->query("SELECT MAX(RIGHT(kd_po,4)) AS kd_max FROM tb_po WHERE DATE(create_at)=CURDATE()");
            $kd = "";
            if ($cd->num_rows() > 0) {
                foreach ($cd->result() as $k) {
                    $tmp = ((int)$k->kd_max) + 1;
                    $kd = sprintf("%04s", $tmp);
                }
            } else {
                $kd = "0001";
            }
            date_default_timezone_set('Asia/Jakarta');
            return 'KPO' . date('dmy') . $kdsuplier . $kd;
        } else if ($kduser == 'KEU01') {
            $cd = $this->db->query("SELECT MAX(RIGHT(kd_po,4)) AS kd_max FROM tb_po WHERE DATE(create_at)=CURDATE()");
            $kd = "";
            if ($cd->num_rows() > 0) {
                foreach ($cd->result() as $k) {
                    $tmp = ((int)$k->kd_max) + 1;
                    $kd = sprintf("%04s", $tmp);
                }
            } else {
                $kd = "0001";
            }
            date_default_timezone_set('Asia/Jakarta');
            return 'SKPO' . date('dmy') . $kdsuplier . $kd;
        } else if ($kduser == 'KEU02') {
            $cd = $this->db->query("SELECT MAX(RIGHT(kd_po,4)) AS kd_max FROM tb_po WHERE DATE(create_at)=CURDATE()");
            $kd = "";
            if ($cd->num_rows() > 0) {
                foreach ($cd->result() as $k) {
                    $tmp = ((int)$k->kd_max) + 1;
                    $kd = sprintf("%04s", $tmp);
                }
            } else {
                $kd = "0001";
            }
            date_default_timezone_set('Asia/Jakarta');
            return 'AKPO' . date('dmy') . $kdsuplier . $kd;
        } else if ($kduser == 'KEU03') {
            $cd = $this->db->query("SELECT MAX(RIGHT(kd_po,4)) AS kd_max FROM tb_po WHERE DATE(create_at)=CURDATE()");
            $kd = "";
            if ($cd->num_rows() > 0) {
                foreach ($cd->result() as $k) {
                    $tmp = ((int)$k->kd_max) + 1;
                    $kd = sprintf("%04s", $tmp);
                }
            } else {
                $kd = "0001";
            }
            date_default_timezone_set('Asia/Jakarta');
            return 'NKPO' . date('dmy') . $kdsuplier . $kd;
        } else if ($kduser == 'KEU04') {
            $cd = $this->db->query("SELECT MAX(RIGHT(kd_po,4)) AS kd_max FROM tb_po WHERE DATE(create_at)=CURDATE()");
            $kd = "";
            if ($cd->num_rows() > 0) {
                foreach ($cd->result() as $k) {
                    $tmp = ((int)$k->kd_max) + 1;
                    $kd = sprintf("%04s", $tmp);
                }
            } else {
                $kd = "0001";
            }
            date_default_timezone_set('Asia/Jakarta');
            return 'MKPO' . date('dmy') . $kdsuplier . $kd;
        }
    }

    // NON KOMERSIL
    function kdnonkomersial()
    {
        $cd1 = $this->db->query("SELECT MAX(RIGHT(kd_barang,4)) AS kd_max FROM tb_generate_kd WHERE DATE(create_at)=CURDATE()");
        $kd1 = "";
        if ($cd1->num_rows() > 0) {
            foreach ($cd1->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd1 = sprintf("%04s", $tmp);
            }
        } else {
            $kd1 = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        $kdnk1 = 'PONK' . date('dmy') . $kd1;
        return $kdnk1;
    }
    function generatekd($data)
    {
        $this->db->insert('tb_generate_kd', $data);
    }
    function getkdnoponk()
    {
        $cd = $this->db->query("SELECT MAX(RIGHT(kd_po_nk,4)) AS kd_max FROM tb_detail_po_nk WHERE DATE(create_at)=CURDATE()");
        $kd = "";
        if ($cd->num_rows() > 0) {
            foreach ($cd->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }

        date_default_timezone_set('Asia/Jakarta');
        $kdnk1 = 'NKPO' . date('dmy') . $kd;
        return $kdnk1;
    }
    function get_tmp_non_komersil($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_tmp_item_nk');
        $this->db->where('kd_user', $kd);
        $this->db->where('jnis_po', '0');
        $query = $this->db->get()->result();
        return $query;
    }
    function get_gbrbarang($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_barang_nk');
        $this->db->where('', $kd);
        $query = $this->db->get()->result();
        return $query;
    }
    function input_tmp_nk($data)
    {
        $this->db->insert('tb_tmp_item_nk', $data);
    }
    function editimgbarang($kdbarang, $data)
    {
        $this->db->where('id_tmp_nk', $kdbarang);
        return $this->db->update('tb_tmp_item_nk', $data);
    }
    function input_note_pembelian_nt($data)
    {
        $this->db->insert('tb_nt_tmp_pembelian', $data);
    }
    function input_detail_nt_pembelian($data)
    {
        $this->db->insert('tb_note_pembelian', $data);
    }
    function delete_detail_nt_pembelian($kduser)
    {
        $this->db->where('kd_user', $kduser);
        return $this->db->delete('tb_nt_tmp_pembelian');
    }
    function gettmp_note_pembelian($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_nt_tmp_pembelian');
        $this->db->where('kd_user', $kd);
        $query = $this->db->get()->result();
        return $query;
    }

    function edit_input_nk($kd, $data)
    {
        $this->db->where('id_tmp_nk', $kd);
        return $this->db->update('tb_tmp_item_nk', $data);
    }
    public function hapus_item_nk($id)
    {
        $this->db->where('id_tmp_nk', $id);
        return $this->db->delete('tb_tmp_item_nk');
    }
    public function hapus_tmp_nk_nt_pembelian($id)
    {
        $this->db->where('id_tmp_nt_pembelian ', $id);
        return $this->db->delete('tb_nt_tmp_pembelian');
    }

    function sumtransaksink()
    {
        $this->db->select("SUM(total_harga) as total_harga");
        $this->db->select("COUNT(id_tmp_nk) as total_item");
        $this->db->from('tb_tmp_item_nk');
        return $this->db->get()->result();
    }
    function input_po_nk($data)
    {
        $this->db->insert('tb_po_nk', $data);
    }
    function input_detail_po_nk($data)
    {
        $this->db->insert('tb_detail_po_nk', $data);
    }
    function hapus_tmp_nk($id)
    {
        $this->db->where('kd_user', $id);
        return $this->db->delete('tb_tmp_item_nk');
    }
    function edit_chart_tmp($kd, $data)
    {
        $this->db->where('id_tmp', $kd);
        return $this->db->update('tb_tmp_item', $data);
    }
    function addNote($data)
    {
        $this->db->insert('tb_note_direktur', $data);
    }
    function editNoteNk($kd, $data)
    {
        $this->db->where('id_tmp_nt_pembelian ', $kd);
        return $this->db->update('tb_nt_tmp_pembelian', $data);
    }
    function getTmpDiskonOrder($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_tmp_diskon');
        $this->db->where('kd_suplier', $kd);
        $query = $this->db->get()->result();
        return $query;
    }
    public function add_tmp_note_suplier($data)
    {
        $this->db->insert('tb_tmp_note_barang', $data);
    }
    function edit_tmp_note_suplier($kd, $data)
    {
        $this->db->where('id_nt_tmp_barang', $kd);
        return $this->db->update('tb_tmp_note_barang', $data);
    }
    function delete_tmp_note_suplier($id)
    {
        return $this->db->delete('tb_tmp_note_barang', array('id_nt_tmp_barang' => $id));
    }
    function getTmpNoteOrder($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_tmp_note_barang');
        $this->db->where('kd_suplier', $kd);
        $query = $this->db->get()->result();
        return $query;
    }
    public function add_diskon_po($data)
    {
        $this->db->insert('tb_tmp_diskon', $data);
    }
    public function add_diskons_po($data)
    {
        $this->db->insert('tb_tmp_diskon', $data);
    }
    public function delete_tmp_diskon($id_tmp)
    {
        $this->db->where('kd_suplier', $id_tmp);
        return $this->db->delete('tb_tmp_diskon');
    }
    public function delete_tmp_tax($id_tmp)
    {
        $this->db->where('kd_suplier', $id_tmp);
        return $this->db->delete('tb_tmp_tax');
    }
    public function delete_tmp_note_sp_i($id_tmp)
    {
        $this->db->where('kd_suplier', $id_tmp);
        return $this->db->delete('tb_tmp_note_barang');
    }
    public function input_note($data)
    {
        $this->db->insert('tb_note_barang', $data);
    }
    public function edit_note_tmp_barang($id_tmp, $data)
    {
        $this->db->where('id_nt_tmp_barang', $id_tmp);
        return $this->db->update('tb_tmp_note_barang', $data);
    }
    public function hapus_note_tmp_barang($id_tmp)
    {
        $this->db->where('id_nt_tmp_barang', $id_tmp);
        return $this->db->delete('tb_tmp_note_barang');
    }
    public function input_diskon($data)
    {
        $this->db->insert('tb_diskon', $data);
    }
    public function edit_diskon_po($id_tmp, $data)
    {
        $this->db->where('id_tmp_diskon', $id_tmp);
        return $this->db->update('tb_tmp_diskon', $data);
    }
    public function hapus_tmp_diskon($id_tmp)
    {
        $this->db->where('id_tmp_diskon', $id_tmp);
        return $this->db->delete('tb_tmp_diskon');
    }
    public function input_diskon_tmp_nk($data)
    {
        $this->db->insert('tb_tmp_diskon_nk', $data);
    }
    public function get_diskon_tmp($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_tmp_diskon_nk a');
        $this->db->where('kd_user', $kd);
        $query = $this->db->get();
        return $query;
    }
}
