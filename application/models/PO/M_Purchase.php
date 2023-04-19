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
    function kdpo($kdsuplier)
    {
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
    }
}
