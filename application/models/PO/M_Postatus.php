<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_PoStatus extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('tb_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        return $this->db->get()->result();
    }

    public function getDetail($kdpo)
    {
        $this->db->select('*');
        $this->db->from('tb_detail_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }
    function sumTransaksiPenjualan($kdpo)
    {
        $this->db->select("SUM(hrg_total) as total_harga");
        $this->db->select("COUNT(id_det_po) as total_item");
        $this->db->from('tb_detail_po');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }
    function getdataStatus($kdpo)
    {
        $this->db->select('*');
        $this->db->from('tb_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }
}
