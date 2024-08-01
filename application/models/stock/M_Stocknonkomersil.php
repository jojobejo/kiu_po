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
    public function getAllstockbaran()
    {
        return $this->db->get('')->result();
    }

    // return $this->db->query("SELECT *,
    //     a.status
    //     FROM tb_po a
    //     JOIN tb_suplier b ON b.kd_suplier = a.kd_suplier
    //     WHERE SUBSTR(a.tgl_transaksi,1,10)=DATE(NOW())
    //     ORDER BY a.id_po DESC
    //         ");
    public function getAllstocknk()
    {
        return $this->db->query("SELECT * FROM tb_barang_nk a
        JOIN tb_kat_br b ON b.kd_kat = a.kat_barang
        JOIN tb_satuan c ON c.id_satuan = a.satuan   
        ");
    }
}
