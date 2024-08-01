<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_Stockcontroller  extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function getAllTransaksi()
    {
        return $this->db->get('tb_transaksi')->result();
    }
}
