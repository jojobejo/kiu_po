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
        $cd1 = $this->db->query("SELECT MAX(RIGHT(kd_module,4)) AS kd_max FROM tbq_module WHERE DATE(create_at)=CURDATE()");
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
    function generatekdreview()
    {
        $cd1 = $this->db->query("SELECT MAX(RIGHT(kd_reviewq,4)) AS kd_max FROM tbq_review_q WHERE DATE(create_at)=CURDATE()");
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
        $kdnk1 = 'QRVM' . date('dmy') . $kd1;
        return $kdnk1;
    }
    function getquestion($kd)
    {
        return $this->db->query("SELECT 
        a.kd_module AS kode,
        a.kd_reviewq AS kode_r,
        a.question AS qeustion
        FROM tbq_review_q a
        WHERE a.kd_module = '$kd'
        ");
    }
    function getjdl($kd)
    {
        return $this->db->query("SELECT
        a.kd_module AS kode,
        a.nm_module AS nm_module,
        a.type_m AS type
        FROM tbq_module a
        WHERE a.kd_module = '$kd'
        ");
    }
    function getallreviewmd($kd)
    {
        return $this->db->query("SELECT a.*
        FROM tbq_review_q a
        WHERE a.kd_module = '$kd'
        ");
    }
    function getallreviewmdpic($kd, $usr)
    {
        return $this->db->query("SELECT a.*
        FROM tbq_review_q a
        WHERE a.kd_module = '$kd' AND a.inputer = '$usr'
        ");
    }
}
