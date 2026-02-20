<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Api extends CI_Model
{

    public function get_all($limit = 100, $offset = 0)
    {
        return $this->db
            ->limit($limit, $offset)
            ->order_by('id', 'DESC')
            ->get($this->table)
            ->result_array();
    }

    public function get_detail_po($limit = 50)
    {
        return $this->db
            ->select('a.*')
            ->from('tb_detail_po a')
            ->join('tb_user b', 'b.kode_user = a.kd_user', 'left')
            ->limit($limit)
            ->get()
            ->result_array();
    }

    public function get_by_kode_faktur($kode_faktur)
    {
        return $this->db
            ->where('kode_faktur', $kode_faktur)
            ->get($this->table)
            ->row_array();
    }

    public function get_by_kdupdate($kdupdate)
    {
        return $this->db
            ->where('tb_detail_po', $kdupdate)
            ->get($this->table)
            ->result_array();
    }

    public function getDetailnk($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_detail_po a');
        $this->db->join('tb_user b', 'b.kode_user = a.kd_user');
        $this->db->join('tb_barang_nk c', 'c.kd_barang = a.kd_barang');
        $this->db->where('kd_po_nk', $kd);
        return $this->db->get()->result();
    }
}
