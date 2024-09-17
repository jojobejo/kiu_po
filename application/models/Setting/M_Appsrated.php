<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_Appsrated extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getAllModule()
    {
        return $this->db->get('tbq_module')->result();
    }
    public function inputnew($data)
    {
        return $this->db->insert('tbq_module', $data);
    }
    function genkdmodnew()
    {
        $cd1 = $this->db->query("SELECT MAX(RIGHT(kdq_rate,4)) AS kd_max FROM tbq_module WHERE DATE(create_at)=CURDATE()");
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
        $kdnk1 = 'QMODNK' . date('dmy') . $kd1;
        return $kdnk1;
    }
}
