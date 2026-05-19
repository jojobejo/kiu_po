<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Api/M_Api');
    }

    public function get_po()
    {
        return $this->get_data_pre_po_erp();
    }

    public function get_data_pre_po_erp()
    {
        if (strtoupper($this->input->method()) !== 'GET') {
            return $this->_json_response([
                'status'  => false,
                'message' => 'method not allowed',
                'data'    => [],
            ], 405);
        }

        try {
            $data = $this->M_Api->get_data_pre_po_erp();

            if (empty($data)) {
                return $this->_json_response([
                    'status'  => false,
                    'message' => 'data kosong',
                    'data'    => [],
                ], 200);
            }

            return $this->_json_response([
                'status'     => true,
                'message'    => 'success',
                'total_data' => count($data),
                'data'       => $data,
            ], 200);
        } catch (Throwable $th) {
            log_message('error', 'API get_data_pre_po_erp error: ' . $th->getMessage());

            return $this->_json_response([
                'status'  => false,
                'message' => 'terjadi kesalahan pada server',
                'data'    => [],
            ], 500);
        }
    }

    private function _json_response($response, $http_code = 200)
    {
        return $this->output
            ->set_status_header($http_code)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}
