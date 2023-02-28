<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Auth/M_Auth');
    }

    function index()
    {
        $this->load->view('partial/Auth/head');
        $this->load->view('content/Auth/body');
        $this->load->view('partial/Auth/footer');
    }

    function process()
    {
        $username = $this->input->post('user_isi');
        $password = $this->input->post('pass_isi');

        $check_username = $this->M_Auth->cek_username($username)->num_rows();

        if ($check_username > 0) {

            $check_password = $this->M_Auth->cek_password($username);

            foreach ($check_password as $key) {
                if ($key->username == $username && password_verify($password, $key->password) && $key->departemen == "Admin") {
                    $data_session = array(
                        'id'            => $key->id_user,
                        'kode'          => $key->kode_user,
                        'username'      => $key->username,
                        'nama_user'     => $key->nama_user,
                        'departemen'    => $key->departemen,
                        'lv'            => $key->user_lv,
                        'status'        => "is_login"
                    );

                    $this->session->set_userdata($data_session);
                    redirect('dashboard');
                } else if ($key->username == $username && password_verify($password, $key->password) && $key->departemen == "Kasir") {
                    $data_session = array(
                        'id'            => $key->id_user,
                        'kode'          => $key->kode_user,
                        'username'      => $key->username,
                        'nama_user'     => $key->nama_user,
                        'departemen'    => $key->departemen,
                        'lv'            => $key->user_lv,
                        'status'        => "is_login"
                    );

                    $this->session->set_userdata($data_session);
                    redirect('dashboardKasir');
                } else {
                    $this->session->set_flashdata("gagal", "username / password salah!!!");
                    redirect('Auth');
                }
            }
        } else {
            $this->session->set_flashdata("gagal", "username salah");
            redirect('Auth');
        }
    }

    function logout()
    {
        // $id_tmp = $this->session->userdata("id_tmp");
        // $this->Loginmodel->hapus_tmp($id_tmp);
        $this->session->sess_destroy();
        redirect("login");
    }
}
