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
    public function getrequestbypic($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_req_nk');
        $this->db->where('kd_po_nk', $kd);
        $query = $this->db->get()->result();
        return $query;
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
            c.nm_satuan AS nm_satuan
            FROM tb_detail_po_nk a
            JOIN tb_barang_nk b ON b.kd_barang = a.kd_bsys
            JOIN tb_satuan c ON c.id_satuan = b.satuan 
            WHERE a.kd_user = '$usr' AND a.kd_po_nk = '$kd'
            ");
        }
        // FUNGSI ADMIN
        elseif ($lv == '2') {
            return $this->db->query("SELECT 
            a.id_det_po_nk AS id,
            b.nama_barang AS nama_barang,
            b.descnk AS deskripsi,
            a.keterangan AS keterangan,
            a.qty AS qtykebutuhan,
            COALESCE(SUM(e.tr_qty),0) AS qty_tmp,
            COALESCE(SUM(d.tr_qty),0) AS qty_transaksi,
            (COALESCE(SUM(d.tr_qty),0))-(COALESCE(SUM(e.tr_qty),0)) AS qtyready,
            c.nm_satuan AS nm_satuan
            FROM tb_detail_po_nk a
            JOIN tb_barang_nk b ON b.kd_barang = a.kd_bsys
            JOIN tb_satuan c ON c.id_satuan = b.satuan 
            LEFT JOIN tb_transaksi d ON d.kd_barangsys = a.kd_bsys
            LEFT JOIN tb_transaksi_tmp e ON e.kd_barangsys = a.kd_bsys
            WHERE a.kd_po_nk = '$kd'
            GROUP BY a.kd_bsys
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
        FROM tb_detail_po_nk a
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
    public function getlisttmptr($kd)
    {
        return $this->db->query("SELECT
        a.kd_po_nk,
        a.kd_barangsys,
        b.nama_barang,
        b.descnk,
        a.keterangan,
        a.tr_qty,
        a.status,
        c.nm_satuan
        FROM tb_transaksi_tmp a
        JOIN tb_barang_nk b ON b.kd_barang = a.kd_barangsys
        JOIN tb_satuan c ON c.id_satuan = b.satuan
        WHERE a.kd_po_nk = '$kd'
        ");
    }
}
