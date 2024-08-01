<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_Stocknonkomersil  extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function getAll()
    {
        return $this->db->get('tb_barang_nk')->result();
    }
}
