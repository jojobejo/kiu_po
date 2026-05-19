<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Api extends CI_Model
{
    public function get_data_pre_po_erp()
    {
        return $this->db
            ->select('
                a.no_po,
                a.kd_po,
                a.tgl_transaksi,
                a.kd_suplier,
                a.kd_barang,
                a.satuan,
                a.qty,
                a.hrg_satuan,
                a.hrg_total
            ')
            ->from('tb_detail_po a')
            ->where('a.tgl_transaksi IS NOT NULL', null, false)
            ->where("a.tgl_transaksi <>", '0000-00-00')
            ->order_by('a.tgl_transaksi', 'DESC')
            ->order_by('a.kd_po', 'DESC')
            ->get()
            ->result_array();
    }
}
