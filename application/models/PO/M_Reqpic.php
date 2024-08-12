<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_Reqpic extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getlistnkreq()
    {
        return $this->db->query("SELECT 
        a.kd_br_adm AS kode_adm, 
        a.kd_barang as kode_sys, 
        a.nama_barang, 
        a.descnk,
        COALESCE(SUM(c.tr_qty),0) AS qty,
        b.nm_satuan,
        a.gbr_barang,
        a.id_brg_nk,
        a.kat_barang,
        a.gbr_barang
        FROM tb_barang_nk a
        JOIN tb_satuan b ON b.id_satuan = a.satuan
        LEFT JOIN tb_transaksi c ON c.kd_barangsys = a.kd_barang
        JOIN tb_po_nk d ON d.kd_po_nk = c.kd_po_nk
        GROUP BY c.kd_barangsys
    ");
    }
}
