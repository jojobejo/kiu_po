<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class C_Appsrated extends CI_Controller

{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Setting/M_Appsrated');
        $this->load->library('form_validation');
    }

    public function index()
    {

        if ($this->session->userdata('lv') == '2') {

            $data['title']          = 'Module List';
            $data['getallmodule']   = $this->M_Appsrated->getAllModule();
            $data['genkdmod']       = $this->M_Appsrated->genkdmodnew();

            $this->load->view('partial/header', $data);
            $this->load->view('partial/sidebar');
            $this->load->view('content/setting/bodyappsrated', $data);
            $this->load->view('partial/footer');
        } elseif ($this->session->userdata('lv') == '4') {

            $data['title'] = 'Module List';
            $data['getallmodule'] = $this->M_Appsrated->getAllModule();

            $this->load->view('partial/header', $data);
            $this->load->view('partial/sidebar');
            $this->load->view('content/setting/bodyappsrated', $data);
            $this->load->view('partial/footer');
        }
    }
    public function addnewmodule()
    {
        $kdmod      = $this->input->post('genkd');
        $typemod    = $this->input->post('slectapps');
        $nmmod      = $this->input->post('nmbarang');
        $sts        = $this->input->post('jnismod');
        $createat   = $this->input->post('dtinput');
        $inptby     = $this->input->post('inputer');

        $datainpt   = array(
            'kdq_rate'      => $kdmod,
            'type_m'        => $typemod,
            'nm_module'     => $nmmod,
            'm_status'      => $sts,
            'create_at'     => $createat,
            'lastupdated'   => $inptby
        );
        $this->M_Appsrated->inputnew($datainpt);
        redirect('reviewapps');
    }
}
