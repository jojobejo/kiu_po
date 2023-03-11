<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_MasterBarang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function insertBarang($data)
    {
        $this->db->insert('tb_barang', $data);
    }
    public function editBarang($id, $data)
    {
        $this->db->where('id_barang', $id);
        return $this->db->update('tb_barang', $data);
    }
    public function hapusBarang($id)
    {
        $this->db->where('id_barang', $id);
        return $this->db->delete('tb_barang');
    }
}
