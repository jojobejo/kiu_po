<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_MasterBarang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    // 
    // 
    // MASTER BARANG KOMERSIL
    // 
    // 

    public function insertBarang($data)
    {
        $this->db->insert('tb_barang', $data);
    }

    public function editBarang($id, $data)
    {
        $this->db->where('id_barang', $id);
        return $this->db->update('tb_barang', $data);
    }

    public function hapusBarang($id)
    {
        $this->db->where('id_barang', $id);
        return $this->db->delete('tb_barang');
    }

    // 
    // 
    // MASTER BARANG NON KOMERSIL
    // 
    // 

    public function get_all_masterbarang()
    {
        return $this->db->query("SELECT * FROM tb_barang_nk a JOIN tb_satuan b ON b.id_satuan = a.satuan");
    }

    public function getTax()
    {
        return $this->db->get('tb_set_tax')->result();
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
