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
        return $this->db->get()->result();
    }
    
    public function getOnProgress()
    {
        $this->db->select('*');
        $this->db->from('tb_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        $this->db->where('a.status', 'ON PROGRESS');
        return $this->db->get()->result();
    }
    public function getDone()
    {
        $this->db->select('*');
        $this->db->from('tb_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        $this->db->where('a.status', 'DONE');
        return $this->db->get()->result();
    }
    public function getReject()
    {
        $this->db->select('*');
        $this->db->from('tb_po a');
        $this->db->join('tb_suplier b', 'b.kd_suplier = a.kd_suplier');
        $this->db->where('a.status', 'REJECT');
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
        $this->db->from('tb_diskon');
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

    function addNote($data)
    {
        $this->db->insert('tb_note_direktur', $data);
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
}
