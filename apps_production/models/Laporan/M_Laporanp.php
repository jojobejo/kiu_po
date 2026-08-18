<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_Laporanp extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        return $this->db->get('tb_user')->result();
    }

    public function addUser($data)
    {
        return $this->db->insert('tb_user', $data);
    }

    public function editUser($iduser, $data)
    {
        $this->db->where('id_user', $iduser);
        return $this->db->update('tb_user', $data);
    }
    public function getdaterangelap($d1, $d2)
    {
        $this->db->select('c.nopo , a.tgl_transaksi , b.nama_user , b.departement , a.nama_barang , a.qty , a.hrg_satuan , a.total_harga ,a.kd_po_nk,c.status,a.deskripsi');
        $this->db->from('tb_detail_po_nk a');
        $this->db->join('tb_user b', 'b.kode_user = a.kd_user');
        $this->db->join('tb_po_nk c', 'c.kd_po_nk = a.kd_po_nk');
        $this->db->where('a.tgl_transaksi >=', $d1);
        $this->db->where('a.tgl_transaksi <=', $d2);
        $this->db->where('c.status =', 'DONE');
        $this->db->where('c.status =', 'DONE');
        $query = $this->db->get();
        return $query;
    }

    public function getpicfiltercostponk()
    {
        $this->db->select('
            a.kd_user,
            COALESCE(MAX(b.nama_user), MAX(c.nm_user), a.kd_user) AS nama_user,
            COALESCE(MAX(b.departement), MAX(c.departemen), "-") AS departement
        ', false);
        $this->db->from('tb_detail_po_nk a');
        $this->db->join('tb_po_nk c', 'c.kd_po_nk = a.kd_po_nk');
        $this->db->join('tb_user b', 'b.kode_user = a.kd_user', 'left');
        $this->db->where('c.status', 'DONE');
        $this->db->group_by('a.kd_user');
        $this->db->order_by('nama_user', 'ASC');

        return $this->db->get();
    }

    public function getcostpicponk($tgl1, $tgl2, $kdpic = '')
    {
        $hasRealisasi = $this->db->table_exists('tb_penerimaan_po_nk_detail');
        $hasTotalNyata = $this->db->field_exists('total_nyata', 'tb_detail_po_nk');
        $detailTotalNyataExpr = $hasTotalNyata ? 'CASE WHEN a.total_nyata > 0 THEN a.total_nyata ELSE a.total_harga END' : 'a.total_harga';
        $qtyNyataExpr = $hasRealisasi ? 'COALESCE(r.qty_real, a.qty)' : 'a.qty';
        $totalNyataExpr = $hasRealisasi ? 'COALESCE(r.total_real, ' . $detailTotalNyataExpr . ')' : $detailTotalNyataExpr;

        $this->db->select('
            a.kd_user,
            COALESCE(MAX(b.nama_user), MAX(c.nm_user), a.kd_user) AS nama_user,
            COALESCE(MAX(b.departement), MAX(c.departemen), "-") AS departement,
            COUNT(DISTINCT c.kd_po_nk) AS total_po,
            COUNT(a.id_det_po_nk) AS total_item,
            SUM(a.qty) AS total_qty,
            SUM(a.total_harga) AS total_cost,
            SUM(' . $qtyNyataExpr . ') AS total_qty_nyata,
            SUM(' . $totalNyataExpr . ') AS total_cost_nyata
        ', false);
        $this->db->from('tb_detail_po_nk a');
        $this->db->join('tb_po_nk c', 'c.kd_po_nk = a.kd_po_nk');
        $this->db->join('tb_user b', 'b.kode_user = a.kd_user', 'left');
        if ($hasRealisasi) {
            $this->db->join('tb_penerimaan_po_nk_detail r', 'r.id_det_po_nk = a.id_det_po_nk', 'left');
        }
        $this->db->where('DATE(a.tgl_transaksi) >= ' . $this->db->escape($tgl1), null, false);
        $this->db->where('DATE(a.tgl_transaksi) <= ' . $this->db->escape($tgl2), null, false);
        $this->db->where('c.status', 'DONE');

        if ($kdpic !== '') {
            $this->db->where('a.kd_user', $kdpic);
        }

        $this->db->group_by('a.kd_user');
        $this->db->order_by('total_cost', 'DESC');

        return $this->db->get();
    }

    public function getdetailcostpicponk($tgl1, $tgl2, $kdpic = '')
    {
        $hasRealisasi = $this->db->table_exists('tb_penerimaan_po_nk_detail');
        $hasHargaNyata = $this->db->field_exists('hrg_nyata', 'tb_detail_po_nk');
        $hasTotalNyata = $this->db->field_exists('total_nyata', 'tb_detail_po_nk');
        $detailHargaNyataExpr = $hasHargaNyata ? 'CASE WHEN a.hrg_nyata > 0 THEN a.hrg_nyata ELSE a.hrg_satuan END' : 'a.hrg_satuan';
        $detailTotalNyataExpr = $hasTotalNyata ? 'CASE WHEN a.total_nyata > 0 THEN a.total_nyata ELSE a.total_harga END' : 'a.total_harga';
        $qtyNyataExpr = $hasRealisasi ? 'COALESCE(r.qty_real, a.qty)' : 'a.qty';
        $hargaNyataExpr = $hasRealisasi ? 'COALESCE(r.harga_satuan_real, ' . $detailHargaNyataExpr . ')' : $detailHargaNyataExpr;
        $totalNyataExpr = $hasRealisasi ? 'COALESCE(r.total_real, ' . $detailTotalNyataExpr . ')' : $detailTotalNyataExpr;

        $this->db->select('
            c.nopo,
            c.kd_po_nk,
            a.tgl_transaksi,
            COALESCE(b.nama_user, c.nm_user, a.kd_user) AS nama_user,
            COALESCE(b.departement, c.departemen, "-") AS departement,
            c.tj_pembelian,
            a.nama_barang,
            a.deskripsi,
            a.qty,
            a.hrg_satuan,
            a.total_harga,
            ' . $qtyNyataExpr . ' AS qty_nyata,
            ' . $hargaNyataExpr . ' AS hrg_nyata,
            ' . $totalNyataExpr . ' AS total_nyata
        ', false);
        $this->db->from('tb_detail_po_nk a');
        $this->db->join('tb_po_nk c', 'c.kd_po_nk = a.kd_po_nk');
        $this->db->join('tb_user b', 'b.kode_user = a.kd_user', 'left');
        if ($hasRealisasi) {
            $this->db->join('tb_penerimaan_po_nk_detail r', 'r.id_det_po_nk = a.id_det_po_nk', 'left');
        }
        $this->db->where('DATE(a.tgl_transaksi) >= ' . $this->db->escape($tgl1), null, false);
        $this->db->where('DATE(a.tgl_transaksi) <= ' . $this->db->escape($tgl2), null, false);
        $this->db->where('c.status', 'DONE');

        if ($kdpic !== '') {
            $this->db->where('a.kd_user', $kdpic);
        }

        $this->db->order_by('a.tgl_transaksi', 'DESC');
        $this->db->order_by('c.kd_po_nk', 'DESC');

        return $this->db->get();
    }

    public function getdaterangelaptr($tgl1, $tgl2)
    {
        $this->db->select('a.kd_po_nk AS kdpo,d.nama_user AS inputer,a.kd_akun AS jn_transaksi, a.tgl_transaksi, c.departement, c.nama_user, b.nama_barang, a.keterangan, a.tr_qty AS qty');
        $this->db->from('tb_transaksi a');
        $this->db->join('tb_barang_nk b', 'b.kd_barang = a.kd_barang', 'left');
        $this->db->join('tb_user c', 'c.kode_user = a.req_by', 'left');
        $this->db->join('tb_user d', 'd.kode_user = a.inputer', 'left');
        $this->db->where('a.tgl_transaksi >=', $tgl1);
        $this->db->where('a.tgl_transaksi <=', $tgl2);
        $this->db->where('a.kd_akun != 11411');
        $query = $this->db->get();
        return $query;
    }


    public function v_stock()
    {
        return $this->db->get('v_stockbarangnk')->result();
    }
}
