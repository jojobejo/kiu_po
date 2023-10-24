<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_PoStatus extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('tb_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        $this->db->order_by('a.id_po', 'DESC');
        return $this->db->get()->result();
    }
    public function ntformat()
    {
        return $this->db->get('tb_notetemplate')->result();
    }
    public function getpotoday()
    {
        return $this->db->query("SELECT *,
        a.status
        FROM tb_po a
        JOIN tb_suplier b ON b.kd_suplier = a.kd_suplier
        WHERE SUBSTR(a.tgl_transaksi,1,10)=DATE(NOW())
        ORDER BY a.id_po DESC
            ");
    }

    public function getOnProgress()
    {
        $this->db->select('*');
        $this->db->from('tb_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        $this->db->where('a.status', 'ON PROGRESS');
        $this->db->or_where('a.status', 'NOTE KEUANGAN');
        $this->db->or_where('a.status', 'NOTE DIREKTUR');
        $this->db->or_where('a.status', 'PO REVISI');
        $this->db->order_by('a.id_po', 'DESC');
        return $this->db->get()->result();
    }
    public function getDoneToday()
    {
        return $this->db->query("SELECT *,
        a.status
        FROM tb_po a
        JOIN tb_suplier b ON b.kd_suplier = a.kd_suplier
        WHERE SUBSTR(a.tgl_transaksi,1,10)=DATE(NOW()) AND a.status = 'DONE'
        ORDER BY a.id_po DESC
            ");
    }
    public function getOnProgressToday()
    {
        return $this->db->query("SELECT *,
        a.status
        FROM tb_po a
        JOIN tb_suplier b ON b.kd_suplier = a.kd_suplier
        WHERE SUBSTR(a.tgl_transaksi,1,10)=DATE(NOW()) AND a.status = 'ON PROGRESS' OR a.status = 'PO REVISI'
        ORDER BY a.id_po DESC
            ");
    }
    public function getRejectToday()
    {
        return $this->db->query("SELECT *,
        a.status
        FROM tb_po a
        JOIN tb_suplier b ON b.kd_suplier = a.kd_suplier
        WHERE SUBSTR(a.tgl_transaksi,1,10)=DATE(NOW()) AND a.status = 'REJECT'
        ORDER BY a.id_po DESC
            ");
    }
    public function getdone()
    {
        $this->db->select('*');
        $this->db->from('tb_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        $this->db->where('a.status', 'DONE');
        $this->db->order_by('a.id_po', 'DESC');
        return $this->db->get()->result();
    }

    public function getReject()
    {
        $this->db->select('*');
        $this->db->from('tb_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        $this->db->where('a.status', 'REJECT');
        $this->db->order_by('a.id_po', 'DESC');
        return $this->db->get()->result();
    }

    public function getDetail($kdpo)
    {
        $this->db->select('*');
        $this->db->from('tb_detail_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }
    function sumTransaksiPenjualan($kdpo)
    {
        $this->db->select("SUM(hrg_total) as total_harga");
        $this->db->select("COUNT(id_det_po) as total_item");
        $this->db->from('tb_detail_po');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }
    function sumTransaksiPenjualanAll($kdpo)
    {
        $this->db->select("SUM(hrg_total) as total_harga");
        $this->db->from('tb_detail_po');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }
    function totalDiskon($kdpo)
    {
        $this->db->select("SUM(nominal) as total_diskon");
        $this->db->select("count(id_diskon) as total_item");
        $this->db->from('tb_diskon');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }
    function totalnote($kdpo)
    {
        $this->db->select("SUM(id_nt_barang) as total_note");
        $this->db->select("count(id_nt_barang) as total_nt_item");
        $this->db->from('tb_note_barang');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }

    function getdataStatus($kdpo)
    {
        $this->db->select('*');
        $this->db->from('tb_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }
    function getDataStatuss($kdpo)
    {
        $this->db->select('*');
        $this->db->from('tb_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        $this->db->join('tb_user c', 'c.kode_user = a.acc_with');
        $this->db->join('tb_notetemplate d', 'd.kd_nt_template = a.kd_printout_note');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }
    function getDataStatussnk($kdpo)
    {
        $this->db->select('*');
        $this->db->from('tb_po_nk a');
        $this->db->join('tb_user c', 'c.kode_user = a.acc_with');
        $this->db->where('kd_po_nk', $kdpo);
        return $this->db->get()->result();
    }
    function CountItem($kdpo)
    {
        return $this->db->query("SELECT 
        COUNT(a.id_det_po) AS total_item
        FROM tb_detail_po a
        WHERE kd_po = '$kdpo'
        ");
    }
    function CountItemnk($kdpo)
    {
        return $this->db->query("SELECT 
        COUNT(a.id_det_po_nk) AS total_item
        FROM tb_detail_po_nk a
        WHERE kd_po_nk = '$kdpo'
        ");
    }

    function konfirmPo($kdpo, $data)
    {
        $this->db->where('kd_po', $kdpo);
        return $this->db->update('tb_po', $data);
    }

    function tolakPo($kdpo, $data)
    {
        $this->db->where('kd_po', $kdpo);
        return $this->db->update('tb_po', $data);
    }
    function konfirmPonk($kdpo, $data)
    {
        $this->db->where('kd_po_nk', $kdpo);
        return $this->db->update('tb_po_nk', $data);
    }

    function tolakPonk($kdpo, $data)
    {
        $this->db->where('kd_po_nk', $kdpo);
        return $this->db->update('tb_po_nk', $data);
    }

    function addNote($data)
    {
        $this->db->insert('tb_note_direktur', $data);
    }
    function addnotesuplier($data)
    {
        $this->db->insert('tb_note_barang', $data);
    }
    function insertDiskon($data)
    {
        $this->db->insert('tb_diskon', $data);
    }
    function editDiskon($id_diskon, $data)
    {
        $this->db->where('id_diskon', $id_diskon);
        return $this->db->update('tb_diskon', $data);
    }
    function updateStatus($kdpo, $status)
    {
        $this->db->where('kd_po', $kdpo);
        return $this->db->update('tb_po', $status);
    }
    function updateStatusnk($kdpo, $status)
    {
        $this->db->where('kd_po_nk', $kdpo);
        return $this->db->update('tb_po_nk', $status);
    }
    function updateTax($kdpo, $updateTax)
    {
        $this->db->where('kd_po', $kdpo);
        return $this->db->update('tb_po', $updateTax);
    }

    function getDiskon($kdpo)
    {
        $this->db->select('*');
        $this->db->from('tb_diskon');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }
    function getDiskonnk($kdpo)
    {
        $this->db->select('*');
        $this->db->from('tb_diskon');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }

    function hapusDiskon($id)
    {
        $this->db->where('id_diskon', $id);
        return $this->db->delete('tb_diskon');
    }

    function getNoted($kdpo)
    {
        $this->db->select('*');
        $this->db->from('tb_note_direktur');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }

    public function getTax()
    {
        return $this->db->get('tb_set_tax')->result();
    }
    public function getSatuan()
    {
        return $this->db->get('tb_satuan')->result();
    }
    public function addRevisiChart($data)
    {
        $this->db->insert('tb_detail_po', $data);
    }

    function revisiPO($id, $data)
    {
        $this->db->where('id_det_po', $id);
        return $this->db->update('tb_detail_po', $data);
    }
    function updateLog($data)
    {
        $this->db->insert('tb_tracking_po', $data);
    }
    function getLog($kdpo)
    {
        $this->db->select('*');
        $this->db->from('tb_tracking_po');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }
    function hapusBarang($id)
    {
        $this->db->where('id_det_po', $id);
        return $this->db->delete('tb_detail_po');
    }
    function deletepodet($kdpo)
    {
        $this->db->where('kd_po', $kdpo);
        return $this->db->delete('tb_detail_po');
    }
    function deletepo($kdpo)
    {
        $this->db->where('kd_po', $kdpo);
        return $this->db->delete('tb_po');
    }

    public function getAllNK()
    {
        $this->db->select('*');
        $this->db->from('tb_po_nk a');
        $this->db->join('tb_user b', 'b.kode_user = a.kd_user');
        return $this->db->get()->result();
    }
    public function getDetailnk($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_detail_po_nk a');
        $this->db->join('tb_user b', 'b.kode_user = a.kd_user');
        $this->db->where('kd_po_nk', $kd);
        return $this->db->get()->result();
    }
    function getdataStatusnk($kdpo)
    {
        $this->db->select('*');
        $this->db->from('tb_po_nk a');
        $this->db->join('tb_user b', 'b.kode_user = a.kd_user');
        $this->db->where('kd_po_nk', $kdpo);
        return $this->db->get()->result();
    }
    function sumTransaksiPenjualannk($kdpo)
    {
        $this->db->select("SUM(total_harga) as total_harga");
        $this->db->select("COUNT(id_det_po_nk) as total_item");
        $this->db->from('tb_detail_po_nk');
        $this->db->where('kd_po_nk', $kdpo);
        return $this->db->get()->result();
    }
    function edit_faktur_item_nk($id, $kdpo)
    {
        $this->db->where('id_det_po_nk', $id);
        return $this->db->update('tb_detail_po_nk', $kdpo);
    }
    function hapus_faktur_item_nk($id)
    {
        $this->db->where('id_det_po_nk', $id);
        return $this->db->delete('tb_detail_po_nk');
    }
    public function get_note_barang($kdpo)
    {
        $this->db->select('*');
        $this->db->from('tb_note_barang');
        $this->db->where('kd_po', $kdpo);
        return $this->db->get()->result();
    }
    function editnotesuplier($id, $data)
    {
        $this->db->where('id_nt_barang', $id);
        return $this->db->update('tb_note_barang', $data);
    }
    function hapusnotesuplier($id)
    {
        return $this->db->delete('tb_note_barang', array('id_nt_barang' => $id));
    }
    function srcdatepo($dt1, $dt2)
    {
        $this->db->select("*");
        $this->db->where("a.tgl_transaksi >='$dt1'");
        $this->db->where("a.tgl_transaksi <='$dt2'");
        $this->db->from('tb_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        $query = $this->db->get();
        return $query->result();
    }

    function kdpo($kdpo)
    {
        $cd = $this->db->query("SELECT MAX(RIGHT(kd_po,4)) AS kd_max FROM tb_po WHERE DATE(create_at)=CURDATE() ");
        $kd = "";
        if ($cd->num_rows() > 0) {
            foreach ($cd->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'KPO' . 'REV' . date('dmy') . $kd;
    }

    public function get_ori_po($id_tmp)
    {
        $this->db->from('tb_detail_po');
        $this->db->where('kd_po', $id_tmp);
        return $this->db->get()->result();
    }
    public function get_note_pembelian($kd)
    {
        $this->db->from('tb_note_pembelian');
        $this->db->where('kd_po', $kd);
        return $this->db->get()->result();
    }
    public function inputRevisi($data)
    {
        $this->db->insert('tb_po', $data);
    }
    public function inputDetailPO($data)
    {
        $this->db->insert('tb_detail_po', $data);
    }
    public function input_diskon($data)
    {
        $this->db->insert('tb_diskon', $data);
    }
    public function input_note($data)
    {
        $this->db->insert('tb_note_barang', $data);
    }
    function editnopo($id, $kdpo)
    {
        $this->db->where('id_po', $id);
        return $this->db->update('tb_po', $kdpo);
    }
    function editnopodet($id, $kdpo)
    {
        $this->db->where('kd_po', $id);
        return $this->db->update('tb_detail_po', $kdpo);
    }
    function generatekd()
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
    function insertkd($data)
    {
        $this->db->insert('tb_generate_kd', $data);
    }
    function add_faktur_nk($data)
    {
        $this->db->insert('tb_detail_po_nk', $data);
    }
    function add_note_pembelian_nk($data)
    {
        $this->db->insert('tb_note_pembelian', $data);
    }
    function add_tax_nk($id, $data)
    {
        $this->db->where('kd_po_nk', $id);
        return $this->db->update('tb_po_nk', $data);
    }
    function edit_note_pembelian_nk($id, $data)
    {
        $this->db->where('id_nt_pembelian', $id);
        return $this->db->update('tb_note_pembelian', $data);
    }
    function editedponk($id, $data)
    {
        $this->db->where('kd_po_nk', $id);
        return $this->db->update('tb_po_nk', $data);
    }
    function hapus_note_pembelian_nk($kdpo)
    {
        $this->db->where('id_nt_pembelian', $kdpo);
        return $this->db->delete('tb_note_pembelian');
    }
    function deletepodetnk($kdpo)
    {
        $this->db->where('kd_po_nk', $kdpo);
        return $this->db->delete('tb_detail_po_nk');
    }
    function deleteponk($kdpo)
    {
        $this->db->where('kd_po_nk', $kdpo);
        return $this->db->delete('tb_po_nk');
    }
    function deletediskonk($kdpo)
    {
        $this->db->where('kd_po', $kdpo);
        return $this->db->delete('tb_diskon');
    }
    function deletenotenk($kdpo)
    {
        $this->db->where('kd_po', $kdpo);
        return $this->db->delete('tb_note_direktur');
    }
    function insert_setting_note($id, $data)
    {
        $this->db->where('kd_po', $id);
        return $this->db->update('tb_po', $data);
    }
    function update_pr_po($id, $data)
    {
        $this->db->where('kd_po', $id);
        return $this->db->update('tb_po', $data);
    }
    function get_format($kdpo)
    {
    }
}
