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

    public function getAllstocknk()
    {
        return $this->db->query("SELECT * FROM tb_barang_nk a
        JOIN tb_kat_br b ON b.kd_kat = a.kat_barang
        JOIN tb_satuan c ON c.id_satuan = a.satuan   
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
