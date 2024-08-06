<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_MasterBarang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    // 
    // 
    // MASTER BARANG KOMERSIL
    // 
    // 

    public function insertBarang($data)
    {
        $this->db->insert('tb_barang', $data);
    }

    public function editBarang($id, $data)
    {
        $this->db->where('id_barang', $id);
        return $this->db->update('tb_barang', $data);
    }


    public function hapusBarang($id)
    {
        $this->db->where('id_barang', $id);
        return $this->db->delete('tb_barang');
    }

    // 
    // 
    // MASTER BARANG NON KOMERSIL
    // 
    // 

    public function get_all_masterbarang()
    {
        return $this->db->query("SELECT * FROM tb_barang_nk a JOIN tb_satuan b ON b.id_satuan = a.satuan JOIN tb_kat_br c ON c.kd_kat = a.kat_barang");
    }
    public function get_all_req_barang()
    {
        return $this->db->query("SELECT * FROM tb_req_masterbarang a 
        JOIN tb_satuan b ON b.id_satuan = a.satuan 
        JOIN tb_user c ON c.kode_user = a.req_by");
    }
    public function getTax()
    {
        return $this->db->get('tb_set_tax')->result();
    }

    public function getSatuan()
    {
        return $this->db->get('tb_satuan')->result();
    }
    public function getkatbarang()
    {
        return $this->db->get('tb_kat_br')->result();
    }
    public function getsatuanbr()
    {
        return $this->db->get('tb_satuan')->result();
    }
    function generatekdbrnk()
    {
        $cd1 = $this->db->query("SELECT MAX(RIGHT(kd_barang,4)) AS kd_max FROM tb_generate_kd WHERE DATE(create_at)=CURDATE()");
        $kd1 = "";
        if ($cd1->num_rows() > 0) {
            foreach ($cd1->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd1 = sprintf("%04s", $tmp);
            }
        } else {
            $kd1 = "0001";
        }

        date_default_timezone_set('Asia/Jakarta');
        $kdnk1 = 'PONK' . date('dmy') . $kd1;
        return $kdnk1;
    }
    function generate_qrcode()
    {
        $cd1 = $this->db->query("SELECT MAX(RIGHT(kd_qrcode,4)) AS kd_max FROM tb_generateqrcode WHERE DATE(create_at)=CURDATE()");
        $kd1 = "";
        if ($cd1->num_rows() > 0) {
            foreach ($cd1->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd1 = sprintf("%04s", $tmp);
            }
        } else {
            $kd1 = "0001";
        }

        date_default_timezone_set('Asia/Jakarta');
        $kdnk1 = 'QRC' . date('dmy') . $kd1;
        return $kdnk1;
    }
    public function delreqbarangnk($id)
    {
        $this->db->where('id_reqmbarang', $id);
        return $this->db->delete('tb_req_masterbarang');
    }
    public function input_qrcode($id, $data)
    {
        $this->db->where('id_brg_nk', $id);
        return $this->db->update('tb_barang_nk', $data);
    }
    function generatekd($data)
    {
        $this->db->insert('tb_generate_kd', $data);
    }
    function generate_qrc($data)
    {
        $this->db->insert('tb_generateqrcode', $data);
    }
    function insertTmpmbarang($data)
    {
        $this->db->insert('tb_req_masterbarang', $data);
    }
    function inputmbarangnk($data)
    {
        $this->db->insert('tb_barang_nk', $data);
    }
    function edit_mbarangnk($id, $data)
    {
        $this->db->where('id_brg_nk', $id);
        return $this->db->update('tb_barang_nk', $data);
    }
    public function hapus_mbarangnk($id)
    {
        $this->db->where('id_brg_nk', $id);
        return $this->db->delete('tb_barang_nk');
    }
    function uploadfile($id, $data)
    {
        $this->db->where('id_brg_nk', $id);
        return $this->db->update('tb_barang_nk', $data);
    }

    // Generate - QRCode

    public function _generate_qrcode($fullname, $data_code)
    {
        $this->load->library('ciqrcode');
        $directory = "./images/qrcodebr";
        $file_name = str_replace(" ", "", strtolower($fullname)) . rand(pow(10, 2), pow(10, 3) - 1);

        if (!is_dir($directory)) {
            mkdir($directory, 0777, TRUE);
        }

        $config['cacheable']    = true;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = array(224, 255, 255);
        $config['white']        = array(70, 130, 180);
        $this->ciqrcode->initialize($config);

        $image_name = $file_name . '.png';

        $params['data'] = $data_code;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = $directory . '/' . $image_name;

        $this->ciqrcode->generate($params);

        return  $image_name;
    }
}
