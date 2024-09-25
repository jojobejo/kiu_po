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
    public function modulereview($kd)
    {
        //INIT
        $user   = $this->session->userdata('kode');

        $data['title']          = 'Module Review';
        if ($this->session->userdata('lv') == '2') {
            $data['getallreview']   = $this->M_Appsrated->getallreviewmd($kd)->result();
            $data['kdreview']       = $this->M_Appsrated->generatekdreview($kd);
            $data['judul']          = $this->M_Appsrated->getjdl($kd)->result();
            $data['question']       = $this->M_Appsrated->getquestion($kd)->result();
        } elseif ($this->session->userdata('lv') == '4') {
            $data['getallreviewpic']   = $this->M_Appsrated->getallreviewmdpic($kd, $user)->result();
        }

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/setting/bodyreviewquest', $data);
        $this->load->view('partial/footer');
    }
    function addqbaru()
    {
        date_default_timezone_set("Asia/Jakarta");
        $kdreview   = $this->input->post('kdreview');
        $kdmodule   = $this->input->post('kdmodule');
        $question   = $this->input->post('question');
        $user       = $this->session->userdata('kode');
        $now = date("Y-m-d H:i:s");

        $inputdtquestion = array(
            'kd_reviewq'    => $kdreview,
            'kd_module'     => $kdmodule,
            'question'      => $question,
            'inputer'       => $user,
            'create_at'     => $now
        );

        $this->M_Appsrated->inputquestion($inputdtquestion);
        redirect('detailreview/' . $kdmodule);
    }
}
