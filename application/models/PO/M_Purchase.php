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
}
