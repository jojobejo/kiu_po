<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class C_Stockkomersil extends CI_Controller

{

    function __construct()
    {
        parent::__construct();
        $this->load->model('stock/M_Stockkomersil');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'User';

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/stock/komersil/bodystock.php', $data);
        $this->load->view('content/stock/komersil/footer.php', $data);
    }
    public function servergetallkomersil()
    {
        $list = $this->M_Stockkomersil->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $row = array();
            $row[] = $field->kdbarang;
            $row[] = $field->nm_barang;
            $row[] = $field->satuan;
            $row[] = $field->qty;
            $row[] = $field->qty_min;
            $row[] =
                '<a href="' . base_url('brgdetkomersil/' . $field->idbrg . '') . '" id="confirms" class="btn btn-info btn-sm d-flex justify-content-center"><i class="fas fa-eye"></i></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_Stockkomersil->count_all(),
            "recordsFiltered" => $this->M_Stockkomersil->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function brgdetkomersil($id)
    {
        $data['title']          = 'Detail Product';
        $data['lbarangdet']     = $this->M_Stockkomersil->getdetbr($id)->result();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/stock/komersil/detstock.php', $data);
        $this->load->view('content/stock/komersil/footer.php', $data);
    }
}
