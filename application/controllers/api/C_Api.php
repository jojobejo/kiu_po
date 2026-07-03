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

    public function get_lpb_po_komersil_erp()
    {
        return $this->get_data_lpb_po_komersil_erp();
    }

    public function get_data_lpb_po_komersil_erp()
    {
        if (strtoupper($this->input->method()) !== 'GET') {
            return $this->_json_response([
                'status'  => false,
                'message' => 'method not allowed',
                'data'    => [],
            ], 405);
        }

        $filters = [
            'limit'         => $this->input->get('limit', true),
            'status'        => $this->input->get('status', true),
            'kd_po'         => $this->input->get('kd_po', true),
            'no_po'         => $this->input->get('no_po', true),
            'kd_suplier'    => $this->input->get('kd_suplier', true),
            'date_from'     => $this->input->get('date_from', true),
            'date_to'       => $this->input->get('date_to', true),
            'updated_since' => $this->input->get('updated_since', true),
        ];

        try {
            $data = $this->M_Api->get_data_lpb_po_komersil_erp($filters);

            if (empty($data)) {
                return $this->_json_response([
                    'status'  => false,
                    'message' => 'data kosong',
                    'source'  => 'po_komersil',
                    'data'    => [],
                ], 200);
            }

            return $this->_json_response([
                'status'     => true,
                'message'    => 'success',
                'source'     => 'po_komersil',
                'total_data' => count($data),
                'data'       => $data,
            ], 200);
        } catch (Throwable $th) {
            log_message('error', 'API get_data_lpb_po_komersil_erp error: ' . $th->getMessage());

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
