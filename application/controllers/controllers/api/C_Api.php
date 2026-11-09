<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Api/M_Api');

        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
    }

    public function get_po()
    {
        $data = $this->M_Api->get_detail_po();

        echo json_encode([
            'status' => $data ? true : false,
            'data'   => $data
        ]);
    }

    private function _bad_request($message)
    {
        http_response_code(400);
        echo json_encode([
            'status'  => false,
            'message' => $message
        ]);
    }
}
