<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_Dashboard extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function totalAll()
    {
        return $this->db->query("SELECT COUNT(a.id_po)AS total
        FROM tb_po a 
        ");
    }
    function totalDone()
    {
        return $this->db->query("SELECT COUNT(a.id_po)as tdone
        FROM tb_po a
        WHERE a.status = 'DONE'
        ");
    }
    function totalOnProgress()
    {
        return $this->db->query("SELECT COUNT(a.id_po) as tprogress
        FROM tb_po a
        WHERE a.status = 'ON PROGRESS'
        ");
    }
    function totalReject()
    {
        return $this->db->query("SELECT COUNT(a.id_po) as treject
        FROM tb_po a
        WHERE a.status = 'REJECT'
        ");
    }
}
