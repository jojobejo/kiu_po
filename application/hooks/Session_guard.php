<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Session_guard
{
    public function require_login()
    {
        $CI = &get_instance();
        $controller = strtolower((string) $CI->router->fetch_class());

        // Authentication endpoints must remain available to logged-out users.
        if ($controller === 'auth' || $CI->input->is_cli_request()) {
            return;
        }

        if ($CI->session->userdata('status') === 'is_login') {
            return;
        }

        $CI->session->set_flashdata('session_expired', 'sesi telah berakhir');
        redirect('Auth');
        exit;
    }
}
