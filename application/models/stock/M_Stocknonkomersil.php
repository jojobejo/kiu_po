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
    public function v_stock()
    {
        return $this->db->get('v_stockbarangnk')->result();
    }

    public function getallbarang()
    {
        return $this->db->query("SELECT 
            * FROM tb_barang_nk a
            JOIN tb_kat_br b ON b.kd_kat = a.kat_barang
            JOIN tb_satuan c ON c.id_satuan = a.satuan
        ");
    }
    public function getAllstocknk()
    {
        return $this->db->query("SELECT 
            a.kd_br_adm AS kode_adm, 
            a.kd_barang as kode_sys, 
            a.nama_barang, 
            a.descnk,
            COALESCE(SUM(c.tr_qty),0) AS qty,
            b.nm_satuan,
            a.gbr_barang,
            a.id_brg_nk
            FROM tb_barang_nk a
            JOIN tb_satuan b ON b.id_satuan = a.satuan
            LEFT JOIN tb_transaksi c ON c.kd_barangsys = a.kd_barang
            GROUP BY a.kd_barang  
        ");
    }
    public function getreqpic($lv)
    {
        return $this->db->query("SELECT * 
            FROM tb_req_masterbarang a
            JOIN tb_satuan b ON b.id_satuan = a.satuan
            JOIN tb_user c ON c.kode_user = a.req_by
            WHERE a.req_by = '$lv'
        ");
    }

    public function getSatuan()
    {
        return $this->db->get('tb_satuan')->result();
    }

    function kdnonkomersial()
    {
        $cd1 = $this->db->query("SELECT MAX(RIGHT(kd_barang,4)) AS kd_max FROM tb_generate_kd WHERE DATE(create_at)=CURDATE()");
        $kd1 = "";
        if ($cd1->num_rows() > 0) {
            foreach ($cd1->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd1 = sprintf("%04s", $tmp);
            }
        } else {
            $kd1 = "0001";
        }

        date_default_timezone_set('Asia/Jakarta');
        $kdnk1 = 'PONK' . date('dmy') . $kd1;
        return $kdnk1;
    }
    function generatekd($data)
    {
        $this->db->insert('tb_generate_kd', $data);
    }
}

// CREATE VIEW STOCK

// CREATE VIEW v_stockbarangnk AS
// SELECT
// x.kode_barang,
// x.nama_barang,
// x.deskripsi,
// COALESCE(x.qty_in,0) AS qty_in,
// COALESCE(x.qty_out,0) AS qty_out,
// (COALESCE(x.qty_in,0)-COALESCE(x.qty_out,0)) AS qty_ready
// FROM
// (	
//     SELECT
//     a.kd_br_adm AS kode_barang,
//     a.nama_barang AS nama_barang,
//     a.descnk AS deskripsi,
//     (SELECT SUM(d.tr_qty) FROM tb_transaksi d WHERE d.kd_barang = a.kd_br_adm AND d.kd_akun = '11512' GROUP BY d.kd_barang)AS qty_out,
//     (SELECT SUM(e.tr_qty) FROM tb_transaksi e WHERE e.kd_barang = a.kd_br_adm AND e.kd_akun = '11511' GROUP BY e.kd_barang ) AS qty_in
//     FROM tb_barang_nk a
//     JOIN tb_satuan b ON b.id_satuan = a.satuan
//     JOIN tb_kat_br c ON c.kd_kat = a.kat_barang
//     GROUP BY a.kd_br_adm
// ) AS x
