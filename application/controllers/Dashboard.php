<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class Dashboard extends CI_Controller

{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Dashboard');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['title']  = 'Dashboard';
        $data['all']    = $this->M_Dashboard->totalAll()->result();
        $data['done']   = $this->M_Dashboard->totalDone()->result();
        $data['progress'] = $this->M_Dashboard->totalOnProgress()->result();
        $data['reject'] = $this->M_Dashboard->totalReject()->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/dashboard', $data);
        $this->load->view('partial/footer');
    }
}
