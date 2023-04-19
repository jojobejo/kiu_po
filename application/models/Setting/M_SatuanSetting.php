<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_SatuanSetting extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('tb_satuan');
        $query = $this->db->get();
        return $query;
    }

    public function addSatuan($data)
    {
        return $this->db->insert('tb_satuan', $data);
    }

    public function editSatuan($idpajak, $data)
    {
        $this->db->where('id_satuan', $idpajak);
        return $this->db->update('tb_satuan', $data);
    }

    public function hapusSatuan($id)
    {
        $this->db->where('id_satuan', $id);
        return $this->db->delete('tb_satuan');
    }
}
