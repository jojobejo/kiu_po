<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class C_MasterBarang extends CI_Controller

{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Master_barang/M_MasterBarang');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title']      = 'Master Barang';
        $data['barangnk']   = $this->M_MasterBarang->get_all_masterbarang()->result();
        $data['kdbarang']   = $this->M_MasterBarang->generatekdbrnk();
        $data['kdqrcode']   = $this->M_MasterBarang->generate_qrcode();
        $data['katbarang']   = $this->M_MasterBarang->getkatbarang();
        $data['satuan']   = $this->M_MasterBarang->getsatuanbr();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/mbarang/mbody', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/mbarang/datatables');
    }

    public function addrequestmasterbarang()
    {
        $inputby    = $this->session->userdata('kode');
        $nmbarang   = $this->input->post('nmbarang');
        $descnk     = $this->input->post('descisi');
        $satuan     = $this->input->post('stuanbr');

        $tmpreqbarang = array(
            'nama_barang'   => $nmbarang,
            'deskripsi'     => $descnk,
            'satuan'        => $satuan,
            'req_by'        => $inputby
        );

        $this->M_MasterBarang->insertTmpmbarang($tmpreqbarang);

        redirect('pononkomersil/list_stocknkpo');
    }

    public function vrequestmbarang()
    {
        $data['title']          = 'list request add master barang';
        $data['lreqmbarang']    = $this->M_MasterBarang->get_all_req_barang()->result();
        $data['satuan']         = $this->M_MasterBarang->getsatuanbr();
        $data['katbarang']      = $this->M_MasterBarang->getkatbarang();
        $data['kdbarang']       = $this->M_MasterBarang->generatekdbrnk();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('conten/mbarang/vreqmbarang', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/mbarang/datatables');
    }

    public function add_mbarang()
    {

        date_default_timezone_set("Asia/Jakarta");

        $kdbarang   = $this->input->post('kd_isi');
        $kdbarang1  = $this->input->post('kd_adm');
        $kdqrcode   = $this->input->post('qrc_isi');
        $katbarang  = $this->input->post('skatbr');
        $nmbarang   = $this->input->post('nmbarang');
        $descnk     = $this->input->post('descisi');
        $satuan     = $this->input->post('stuanbr');
        $inputer    = $this->session->userdata('kode');

        $qrcpath    = $this->M_MasterBarang->_generate_qrcode($nmbarang, $kdqrcode);

        $now = date('Y-m-d H:i:s');

        $dtinputbr = array(
            'kd_barang'     => $kdbarang,
            'kd_br_adm'     => $kdbarang1,
            'kat_barang'    => $katbarang,
            'nama_barang'   => $nmbarang,
            'descnk'        => $descnk,
            'satuan'        => $satuan,
            'gbr_barang'    => "Karisma.png",
            'qrcode_data'   => $kdqrcode,
            'qrcode_path'   => $qrcpath,
            'inputer'       => $inputer,
            'create_at'     => $now,
            'last_updated'  => $inputer
        );

        $kdgenerate = array(
            'kd_barang'     => $kdbarang
        );
        $qrcgeneratekd = array(
            'kd_qrcode'     => $kdqrcode
        );

        $this->M_MasterBarang->inputmbarangnk($dtinputbr);
        $this->M_MasterBarang->generatekd($kdgenerate);
        $this->M_MasterBarang->generate_qrc($qrcgeneratekd);


        redirect('masterbarangnk');
    }

    public function inputqrcbrnk($id, $kdqrcode, $nmbarang)
    {
        $qrcpath    = $this->M_MasterBarang->_generate_qrcode($nmbarang, $kdqrcode);
        $actionby   = $this->session->userdata('kode');

        $upqrcode = array(
            'qrcode_path'   => $qrcpath,
            'qrcode_data'   => $kdqrcode,
            'last_updated'  => $actionby
        );
        $qrcgeneratekd = array(
            'kd_qrcode'     => $kdqrcode
        );
        $this->M_MasterBarang->input_qrcode($id, $upqrcode);
        $this->M_MasterBarang->generate_qrc($qrcgeneratekd);

        redirect('masterbarangnk');
    }


    public function edit_mbarangnk()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id         = $this->input->post('id_isi');
        $kdbarang1  = $this->input->post('kd_adm');
        $katbarang  = $this->input->post('skatbr');
        $nmbarang   = $this->input->post('nmbarang');
        $descnk     = $this->input->post('descisi');
        $satuan     = $this->input->post('stuanbr');
        $inputer    = $this->session->userdata('kode');
        $dtinputbr = array(
            'kd_br_adm'     => $kdbarang1,
            'kat_barang'    => $katbarang,
            'nama_barang'   => $nmbarang,
            'descnk'        => $descnk,
            'satuan'        => $satuan,
            'inputer'       => $inputer,
        );
        $this->M_MasterBarang->edit_mbarangnk($id, $dtinputbr);
        redirect('masterbarangnk');
    }

    public function delmbarangnk()
    {
        $id     = $this->input->post('id_isi');

        $this->M_MasterBarang->hapus_mbarangnk($id);

        redirect('masterbarangnk');
    }

    public function uploadgbrbarang()
    {
        $this->load->helper("file");
        $idisi      = $this->input->post('id_isi');
        $flnm       = $this->input->post('file_nm');

        if ($flnm == 'Karisma.png') {
            if (!empty($_FILES['gambar_1'])) {
                $config['upload_path'] = './images/gbrbarang/masterbr/';
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = '2000';
                $config['max_width'] = '6000';
                $config['max_height'] = '6000';
                $config['overwrite'] = TRUE;
                $config['file_name'] = date('Y') . date('m') . date('U');
                $this->load->library('upload', $config);
                $this->upload->initialize($config);;

                if (!$this->upload->do_upload('gambar_1')) {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    die;
                } else {
                    if ($this->upload->do_upload('gambar_1')) {
                        $image_data1 = $this->upload->data();
                        $full_path1 = $config['file_name'];
                        $data["gbr_produk"] = $full_path1;
                    }
                }
            }

            $dataBarang = array(
                'gbr_barang'    => $image_data1['file_name']
            );

            $this->M_MasterBarang->uploadfile($idisi, $dataBarang);
            redirect('masterbarangnk');
        } elseif ($flnm != 'Karisma.png') {
            if (!empty($_FILES['gambar_1'])) {
                $config['upload_path'] = './images/gbrbarang/masterbr/';
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = '2000';
                $config['max_width'] = '6000';
                $config['max_height'] = '6000';
                $config['overwrite'] = TRUE;
                $config['file_name'] = date('Y') . date('m') . date('U');
                $this->load->library('upload', $config);
                $this->upload->initialize($config);;

                if (!$this->upload->do_upload('gambar_1')) {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    die;
                } else {
                    if ($this->upload->do_upload('gambar_1')) {
                        $image_data1 = $this->upload->data();
                        $full_path1 = $config['file_name'];
                        $data["gbr_produk"] = $full_path1;
                    }
                }
            }

            $dataBarang = array(
                'gbr_barang'    => $image_data1['file_name']
            );

            unlink(FCPATH . "/images/gbrbarang/masterbr/" . $flnm);
            $this->M_MasterBarang->uploadfile($idisi, $dataBarang);
            redirect('masterbarangnk');
        }
    }
}
