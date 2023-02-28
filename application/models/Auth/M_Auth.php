<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_Auth extends CI_Model
{


    function cek_username($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('tb_user');
    }

    function cek_password($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('tb_user')->result();
    }

    function cek_tmp($username)
    {
        $this->db->select('id_tmp');
        $this->db->from('tmp a');
        $this->db->join('tb_user b', 'b.id_user = a.id_user', 'left');
        $this->db->where('username', $username);
        return $this->db->get()->result();
    }
}
