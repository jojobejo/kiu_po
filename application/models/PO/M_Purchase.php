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
    public function Suplier($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_suplier');
        $this->db->where('kd_suplier', $kd);
        $query = $this->db->get();
        return $query;
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
        }
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
    public function delete_tmp_diskon($id_tmp)
    {
        $this->db->where('kd_suplier', $id_tmp);
        return $this->db->delete('tb_tmp_diskon');
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
}
