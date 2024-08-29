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
    public function get_data_item($kd)
    {
        return $this->db->query("SELECT
        a.kd_barang AS kode_sistem ,
        a.kd_br_adm AS kode_barang,
        a.nama_barang AS nama_barang,
        a.descnk AS deskripsi,
        d.qty_ready AS qty_ready,
        b.nm_satuan AS satuan
        FROM tb_barang_nk a
        JOIN tb_satuan b ON b.id_satuan = a.satuan
        JOIN tb_kat_br c ON c.kd_kat = a.kat_barang
        JOIN v_stockbarangnk d ON d.kode_barangs = a.kd_barang
        WHERE a.kd_barang = '$kd'
        ");
    }
    public function get_detail_transaksi_itm($kd)
    {
        return $this->db->query("SELECT
        a.kd_po_nk AS kd_transaksi,
        a.kd_akun AS kd_akun,
        a.tgl_transaksi AS tgl_transaksi,
        a.tr_qty AS qty,
        b.nm_satuan AS nm_satuan,
        a.kd_barangsys AS kd_barang,
        COALESCE(c.nm_user,0) AS nm_1,
        COALESCE(d.nm_user,0) AS nm_2,
        COALESCE(e.departement,0) AS dep_1,
        COALESCE(f.departement,0) AS dep_2
        FROM tb_transaksi a 
        JOIN tb_satuan b ON b.id_satuan = a.satuan
        LEFT JOIN tb_req_nk c ON c.kd_po_nk = a.kd_po_nk 
        LEFT JOIN tb_po_nk d ON d.kd_po_nk = a.kd_po_nk
        LEFT JOIN tb_user e ON e.kode_user = c.kd_user
        LEFT JOIN tb_user f ON f.kode_user = d.kd_user
        WHERE a.kd_barangsys = '$kd'

        ");
    }
    public function qtyready($kd)
    {
        $cd1 = $this->db->query("SELECT a.qty_ready FROM v_stockbarangnk a WHERE a.kode_barangs = '$kd'");
        return $cd1;
    }
    public function get_detail_br_rev_buy($kdponk, $kdbr)
    {
        return $this->db->query("SELECT
        a.id_transnk AS id_tr,
        b.id_det_po_nk AS id_po,
        b.kd_po_nk AS kd_po,
        b.kd_barang as kd_barang,
        b.nama_barang AS nm_barang,
        a.tr_qty AS qty_tr,
        b.qty AS qty_det
        FROM tb_transaksi a
        JOIN tb_detail_po_nk b ON b.kd_po_nk = a.kd_po_nk
        WHERE b.kd_po_nk = '$kdponk' AND b.kd_bsys = '$kdbr'
        GROUP BY b.kd_po_nk
        ");
    }
    public function get_detail_br_rev_req($kdponk, $kdbr)
    {
        return $this->db->query("SELECT
        a.id_transnk AS id_tr,
        b.id_det_po_nk AS id_po,
        b.kd_po_nk AS kd_po,
        b.kd_barang as kd_barang,
        b.nama_barang AS nm_barang,
        a.tr_qty AS qty_tr,
        b.qty AS qty_det
        FROM tb_transaksi a
        JOIN tb_detail_req b ON b.kd_po_nk = a.kd_po_nk
        WHERE b.kd_po_nk = '$kdponk' AND b.kd_bsys = '$kdbr'
        ");
    }
    public function getlistnkreq()
    {
        return $this->db->query("SELECT 
        a.kode_barang AS kode_adm,
        a.kode_barangs AS kode_sys,
        a.nama_barang,
        a.deskripsi AS descnk,
        b.nm_satuan,
        a.gbr_barang,
        a.id_brg_nk,
        a.kat_barang,
        a.qty_ready
        FROM v_stockbarangnk a
        JOIN tb_satuan b ON b.id_satuan = a.id_satuan
    ");
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
