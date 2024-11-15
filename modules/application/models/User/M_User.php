<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_User extends CI_Model
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
    public function getInfoUser($kduser)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('kode_user', $kduser);
        $query = $this->db->get();
        return $query;
    }
    public function editPassword($kd_user, $data)
    {
        $this->db->where('kode_user', $kd_user);
        return $this->db->update('tb_user', $data);
    }
}
