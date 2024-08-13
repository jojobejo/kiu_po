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

    public function countRequser($lv, $kd)
    {

        $cd1 = $this->db->query("SELECT 
        COUNT(a.id_tmp_nk) as tot
        FROM tb_tmp_item_nk a
        WHERE a.jnis_po = '$lv' AND a.kd_user = '$kd' ");

        foreach ($cd1->result() as $d) {
            $jml = $d->tot;
            if ($jml == 0) {
                $sts = '0';
                return $sts;
            } else if ($jml >= 1) {
                $sts = '1';
                return $sts;
            }
        }
    }

    public function getalltmpreq($kd)
    {
        return $this->db->query("SELECT 
        a.id_tmp_nk , b.nama_barang , b.descnk , a.keterangan , a.qty , c.nm_satuan
        FROM tb_tmp_item_nk a
        JOIN tb_barang_nk b ON b.kd_barang = a.kd_bsys
        JOIN tb_satuan c ON c.id_satuan = b.satuan 
        WHERE a.jnis_po = '2' AND a.kd_user = '$kd'
        ");
    }
    public function getallreq($kd)
    {
        return $this->db->query("SELECT 
        a.*
        FROM tb_req_nk a
        WHERE a.kd_user = '$kd'
        ");
    }

    public function countjmltmpbr($kd)
    {
        $this->db->select('id_tmp_nk');
        $this->db->from('tb_tmp_item_nk');
        $this->db->where('jnis_po', '2');
        $this->db->where('kd_user', $kd);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    function get_tmp_non_komersil($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_tmp_item_nk');
        $this->db->where('jnis_po', '2');
        $this->db->where('kd_user', $kd);
        $query = $this->db->get()->result();
        return $query;
    }

    public function inputreqbr($data)
    {
        $this->db->insert('tb_tmp_item_nk', $data);
    }
    public function inputreq($data)
    {
        $this->db->insert('tb_req_nk', $data);
    }
}
