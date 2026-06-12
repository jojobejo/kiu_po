<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthGuard
{
	private $allowedRoutes = array(
		'auth/index',
		'auth/process',
		'auth/logout',
		'c_api/get_po',
		'c_api/get_data_pre_po_erp',
	);

	public function checkLogin()
	{
		if (is_cli()) {
			return;
		}

		$CI =& get_instance();
		$route = strtolower($CI->router->class . '/' . $CI->router->method);

		if (in_array($route, $this->allowedRoutes, true)) {
			return;
		}

		if ($CI->session->userdata('status') === 'is_login' && $CI->session->userdata('id')) {
			return;
		}

		if ($this->isAjaxRequest($CI)) {
			$CI->output
				->set_status_header(401)
				->set_content_type('application/json')
				->set_output(json_encode(array(
					'status' => false,
					'success' => false,
					'message' => 'Session login sudah habis. Silakan login kembali.',
					'redirect' => base_url('Auth'),
				)));
			$CI->output->_display();
			exit;
		}

		$CI->session->set_flashdata('gagal', 'Silakan login terlebih dahulu.');
		redirect('Auth');
	}

	private function isAjaxRequest($CI)
	{
		return $CI->input->is_ajax_request()
			|| strpos((string) $CI->input->server('HTTP_ACCEPT'), 'application/json') !== false;
	}
}
