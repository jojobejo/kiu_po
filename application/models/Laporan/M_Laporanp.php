<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_Laporanp extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        return $this->db->get('tb_user')->result();
    }

    public function addUser($data)
    {
        return $this->db->insert('tb_user', $data);
    }

    public function editUser($iduser, $data)
    {
        $this->db->where('id_user', $iduser);
        return $this->db->update('tb_user', $data);
    }
    public function getdaterangelap($d1, $d2)
    {
        $this->db->select('c.nopo , a.tgl_transaksi , b.nama_user , b.departement , a.nama_barang , a.qty , a.hrg_satuan , a.total_harga ,a.kd_po_nk,c.status,a.deskripsi');
        $this->db->from('tb_detail_po_nk a');
        $this->db->join('tb_user b', 'b.kode_user = a.kd_user');
        $this->db->join('tb_po_nk c', 'c.kd_po_nk = a.kd_po_nk');
        $this->db->where('a.tgl_transaksi >=', $d1);
        $this->db->where('a.tgl_transaksi <=', $d2);
        $this->db->where('c.status =', 'DONE');
        $this->db->where('c.status =', 'DONE');
        $query = $this->db->get();
        return $query;
    }
}
