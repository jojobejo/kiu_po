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
        b.nm_satuan,
        a.gbr_barang,
        a.id_brg_nk,
        a.kat_barang,
        a.gbr_barang
        FROM tb_barang_nk a
        JOIN tb_satuan b ON b.id_satuan = a.satuan
    ");
    }
    public function getsatuan()
    {
        return $this->db->query("SELECT
        a.id_satuan AS id,
        a.nm_satuan AS nm_satuan
        FROM tb_satuan a
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
        a.id_tmp_nk , b.nama_barang , b.descnk , a.keterangan , a.qty , c.nm_satuan , a.kd_bsys
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
    function input_detail_po_nk($data)
    {
        $this->db->insert('tb_detail_req', $data);
    }
    public function getrequestbypic($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_req_nk');
        $this->db->where('kd_po_nk', $kd);
        $query = $this->db->get()->result();
        return $query;
    }

    public function count_acc_req($kd)
    {
        return $this->db->query("SELECT
        COUNT(a.id_det_po_nk) AS total,
        SUM(CASE WHEN a.status = '1' THEN 1 ELSE 0 END) tot_yes,
        SUM(CASE WHEN a.status = '3' THEN 1 ELSE 0 END) tot_no
        FROM tb_detail_req a
        WHERE a.kd_po_nk = '$kd'
        ");
    }

    public function getreqwhere($kd,$sts)
    {
        return $this->db->query("SELECT
            x.id_det_po_nk AS id,
            x.kd_po_nk AS kode_po,
            x.kd_barang AS kode_barang,
            x.nama_barang AS nama_barang,
            x.deskripsi AS deskripsi,
            x.keterangan AS keterangan,
            x.status AS sts,
            x.nm_satuan as nm_satuan,
            COALESCE(x.qty_tmp,0) AS qty_tmp,
            (COALESCE(x.qty_transaksi_p,0) - COALESCE(x.qty_transaksi_m,0)) AS qty_transaksi,
            COALESCE(x.qty,0) AS qty_req,
            IF(x.status = '1',(COALESCE(x.qty_transaksi_p,0) - COALESCE(x.qty_transaksi_m,0)) - COALESCE(x.qty_tmp,0),(COALESCE(x.qty_transaksi_p,0) - COALESCE(x.qty_transaksi_m,0))) AS qty_ready
            FROM
            (   SELECT 
                a.id_det_po_nk,
                a.kd_po_nk,
                a.kd_barang,
                a.nama_barang,
                a.deskripsi,
                a.keterangan,
                a.qty,
                a.status,
                f.nm_satuan,
                (SELECT SUM(c.tr_qty) FROM tb_transaksi_tmp c WHERE c.kd_barangsys = a.kd_bsys GROUP BY a.kd_bsys) AS qty_tmp,
                (SELECT SUM(d.tr_qty) FROM tb_transaksi d WHERE d.kd_barangsys = a.kd_bsys GROUP BY a.kd_bsys) AS qty_transaksi,
                (SELECT SUM(g.tr_qty) FROM tb_transaksi g WHERE g.kd_barangsys = a.kd_bsys AND g.kd_akun = '11511' GROUP BY a.kd_bsys) AS qty_transaksi_p,
                (SELECT SUM(h.tr_qty) FROM tb_transaksi h WHERE h.kd_barangsys = a.kd_bsys AND h.kd_akun = '11512' GROUP BY a.kd_bsys) AS qty_transaksi_m
                FROM tb_detail_req a 
                JOIN tb_barang_nk e ON e.kd_barang = a.kd_bsys
                JOIN tb_satuan f ON f.id_satuan = e.satuan 
            ) AS x 
            WHERE x.kd_po_nk = '$kd' AND x.status = '$sts'
            ");
    }

    public function getdetailreqpic($usr, $kd)
    {
        $lv = $this->session->userdata('lv');

        // FUNGSI PIC 
        if ($lv == '4') {
            return $this->db->query("SELECT 
            a.id_det_po_nk AS id,
            b.nama_barang AS nama_barang,
            b.descnk AS deskripsi,
            a.keterangan AS keterangan,
            a.qty AS qtykebutuhan,
            c.nm_satuan AS nm_satuan,
            a.status as sts
            FROM tb_detail_req a
            JOIN tb_barang_nk b ON b.kd_barang = a.kd_bsys
            JOIN tb_satuan c ON c.id_satuan = b.satuan 
            WHERE a.kd_user = '$usr' AND a.kd_po_nk = '$kd'
            ");
        }
        // FUNGSI ADMIN
        elseif ($lv == '2') {
            return $this->db->query("SELECT
            x.id_det_po_nk AS id,
            x.kd_po_nk AS kode_po,
            x.kd_barang AS kode_barang,
            x.nama_barang AS nama_barang,
            x.deskripsi AS deskripsi,
            x.keterangan AS keterangan,
            x.status AS sts,
            x.nm_satuan as nm_satuan,
            COALESCE(x.qty_tmp,0) AS qty_tmp,
            (COALESCE(x.qty_transaksi_p,0) - COALESCE(x.qty_transaksi_m,0)) AS qty_transaksi,
            COALESCE(x.qty,0) AS qty_req,
            IF(x.status = '1',(COALESCE(x.qty_transaksi_p,0) - COALESCE(x.qty_transaksi_m,0)) - COALESCE(x.qty_tmp,0),(COALESCE(x.qty_transaksi_p,0) - COALESCE(x.qty_transaksi_m,0))) AS qty_ready
            FROM
            (   SELECT 
                a.id_det_po_nk,
                a.kd_po_nk,
                a.kd_barang,
                a.nama_barang,
                a.deskripsi,
                a.keterangan,
                a.qty,
                a.status,
                f.nm_satuan,
                (SELECT SUM(c.tr_qty) FROM tb_transaksi_tmp c WHERE c.kd_barangsys = a.kd_bsys GROUP BY a.kd_bsys) AS qty_tmp,
                (SELECT SUM(d.tr_qty) FROM tb_transaksi d WHERE d.kd_barangsys = a.kd_bsys GROUP BY a.kd_bsys) AS qty_transaksi,
                (SELECT SUM(g.tr_qty) FROM tb_transaksi g WHERE g.kd_barangsys = a.kd_bsys AND g.kd_akun = '11511' GROUP BY a.kd_bsys) AS qty_transaksi_p,
                (SELECT SUM(h.tr_qty) FROM tb_transaksi h WHERE h.kd_barangsys = a.kd_bsys AND h.kd_akun = '11512' GROUP BY a.kd_bsys) AS qty_transaksi_m
                FROM tb_detail_req a 
                JOIN tb_barang_nk e ON e.kd_barang = a.kd_bsys
                JOIN tb_satuan f ON f.id_satuan = e.satuan 
            ) AS x 
            WHERE x.kd_po_nk = '$kd'
            ");
        }
    }

    public function getlistpic()
    {
        return $this->db->get('tb_req_nk')->result();
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
    public function editedreqpic($id, $data)
    {
        $this->db->where('id_tmp_nk', $id);
        return $this->db->update('tb_tmp_item_nk', $data);
    }
    public function updatestsitem($id, $data)
    {
        $this->db->where('id_det_po_nk', $id);
        return $this->db->update('tb_detail_req', $data);
    }
    public function deletedtmpnkreq($id)
    {
        $this->db->where('id_tmp_nk', $id);
        return $this->db->delete('tb_tmp_item_nk');
    }
    public function getitemreq($id)
    {
        return $this->db->query("SELECT 
        a.kd_po_nk as kd_po_nk,
        a.kd_barang as kd_barang,
        a.kd_bsys as kd_bsys,
        a.keterangan as ket,
        b.kat_barang as kat_barang,
        a.qty as qty,
        b.satuan as satuan
        FROM tb_detail_req a
        JOIN tb_barang_nk b ON b.kd_barang = a.kd_bsys
        WHERE a.id_det_po_nk = '$id'
            ");
    }
    public function deletedetailponk($id)
    {
        $this->db->where('id_det_po_nk', $id);
        return $this->db->delete('tb_detail_po_nk');
    }
    public function insert_tmp_transaksi($data)
    {
        $this->db->insert('tb_transaksi_tmp', $data);
    }
    public function insert_transaksi($data)
    {
        $this->db->insert('tb_transaksi', $data);
    }
    public function getlisttmptr($kd)
    {
        return $this->db->query("SELECT
        a.kd_akun,
        a.kd_po_nk,
        a.kd_barang,
        a.kd_barangsys,
        b.nama_barang,
        b.descnk,
        a.keterangan,
        a.tr_qty,
        a.status,
        a.satuan,
        c.nm_satuan,
        b.kat_barang
        FROM tb_transaksi_tmp a
        JOIN tb_barang_nk b ON b.kd_barang = a.kd_barangsys
        JOIN tb_satuan c ON c.id_satuan = b.satuan
        WHERE a.kd_po_nk = '$kd'
        ");
    }

    function updatedetreqitm($kd, $data)
    {
        $this->db->where('id_det_po_nk', $kd);
        return $this->db->update('tb_detail_req', $data);
    }
    function updatereqnk($kd, $data)
    {
        $this->db->where('kd_po_nk', $kd);
        return $this->db->update('tb_req_nk', $data);
    }
    function input_new_po_req($data)
    {
        $this->db->insert('tb_tmp_item_nk', $data);
    }
    public function deletedtmpnkreqkd($id)
    {
        $this->db->where('kd_po_nk', $id);
        return $this->db->delete('tb_tmp_item_nk');
    }
    public function deletetmptrreq($id)
    {
        $this->db->where('kd_po_nk', $id);
        return $this->db->delete('tb_transaksi_tmp');
    }
    function getNoted($kdpo)
    {
        $this->db->select('*');
        $this->db->from('tb_note_direktur');
        $this->db->where('kd_po', $kdpo);
        $this->db->where('note_for', '2');
        return $this->db->get()->result();
    }
    function insertTmpmbarang($data)
    {
        $this->db->insert('tb_req_masterbarang', $data);
    }
    public function gettotsts($kd)
    {
        return $this->db->query("SELECT
        x.totalbr,
        x.sts1,
        x.sts2,
        x.sts0,
        x.sts3
        FROM
        (
            SELECT
            a.kd_po_nk,
            (SELECT COUNT(b.id_det_po_nk) FROM tb_detail_req b WHERE b.kd_po_nk = a.kd_po_nk) as totalbr,
            (SELECT COUNT(c.status) FROM tb_detail_req c WHERE c.kd_po_nk = a.kd_po_nk AND c.status = '1') AS sts1,
            (SELECT COUNT(d.status) FROM tb_detail_req d WHERE d.kd_po_nk = a.kd_po_nk AND d.status = '2') AS sts2,
            (SELECT COUNT(e.status) FROM tb_detail_req e WHERE e.kd_po_nk = a.kd_po_nk AND e.status = '0') AS sts0,
            (SELECT COUNT(f.status) FROM tb_detail_req f WHERE f.kd_po_nk = a.kd_po_nk AND f.status = '3') AS sts3
            FROM tb_detail_req a
        ) AS x 
        WHERE x.kd_po_nk = '$kd' 
        GROUP BY x.kd_po_nk
        ");
    }
}


// QUERY SQL 

// SELECT
// x.kd_po_nk AS kode_po,
// x.kd_barang AS kode_barang,
// x.nama_barang AS nama_barang,
// x.deskripsi AS deskripsi,
// COALESCE(x.qty_minus,0) AS qty_minus,
// COALESCE(x.qty_plus,0) AS qty_plus,
// COALESCE(x.qty,0) AS qty_req,
// COALESCE(x.qty_plus,0) - COALESCE(x.qty_minus,0) AS qty_ready
// FROM
// (
//     SELECT 
// 	a.kd_po_nk,
//     a.kd_barang,
//     a.nama_barang,
//     a.deskripsi,
//     a.keterangan,
//     a.qty,
//     a.status,
//     (SELECT SUM(c.tr_qty) FROM tb_transaksi_tmp c WHERE c.kd_barangsys = a.kd_bsys GROUP BY a.kd_bsys) AS qty_minus,
//     (SELECT SUM(d.tr_qty) FROM tb_transaksi d WHERE d.kd_barangsys = a.kd_bsys GROUP BY a.kd_bsys) AS qty_plus
//     FROM tb_detail_req a 
//     JOIN tb_barang_nk e ON e.kd_barang = a.kd_bsys
//     GROUP BY a.kd_barang
// ) AS x 
// WHERE x.kd_po_nk = 'PONK2108240002'

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
