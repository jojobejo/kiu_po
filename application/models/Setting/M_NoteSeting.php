<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_NoteSeting extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('tb_set_note');
        $query = $this->db->get();
        return $query;
    }

    public function addPajak($data)
    {
        return $this->db->insert('tb_set_note', $data);
    }

    public function editPajak($idpajak, $data)
    {
        $this->db->where('id_set_note', $idpajak);
        return $this->db->update('tb_set_note', $data);
    }

    public function hapusPajak($id)
    {
        $this->db->where('id_set_note', $id);
        return $this->db->delete('tb_set_note');
    }
}
