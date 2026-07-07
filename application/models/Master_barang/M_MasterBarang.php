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
        $idColumn = $this->get_barang_id_column();
        $this->db->where($idColumn, $id);
        return $this->db->delete('tb_barang');
    }

    private function get_barang_id_column()
    {
        return $this->db->field_exists('id_barang', 'tb_barang') ? 'id_barang' : 'id';
    }

    private function get_barang_bahan_aktif_column()
    {
        return $this->db->field_exists('bahan_aktif', 'tb_barang') ? 'bahan_aktif' : 'bhn_aktif';
    }

    private function get_barang_select_sql()
    {
        $idColumn = $this->get_barang_id_column();
        $bahanAktifColumn = $this->get_barang_bahan_aktif_column();
        $hasSatuanQty = $this->db->field_exists('satuan_qty', 'tb_barang');
        $hasHasilDimensi = $this->db->field_exists('hasil_dimensi', 'tb_barang');

        $select = array(
            "a.$idColumn AS id_barang",
            'a.kode_barang',
            'a.kd_suplier',
            'c.nama_suplier',
            'a.nama_barang',
            "a.$bahanAktifColumn AS bahan_aktif",
            $hasSatuanQty ? 'a.satuan_qty' : 'NULL AS satuan_qty',
            $hasSatuanQty ? 'b.nm_satuan' : 'COALESCE(b.nm_satuan, a.satuan) AS nm_satuan',
            $this->db->field_exists('satuan', 'tb_barang') ? 'a.satuan' : 'NULL AS satuan',
            'a.panjang',
            'a.lebar',
            'a.tinggi',
            $hasHasilDimensi ? 'a.hasil_dimensi' : '(a.panjang * a.lebar * a.tinggi) AS hasil_dimensi',
            $this->db->field_exists('berat', 'tb_barang') ? 'a.berat' : '0 AS berat',
            $this->db->field_exists('isi', 'tb_barang') ? 'a.isi' : '0 AS isi',
            $this->db->field_exists('kemasan', 'tb_barang') ? 'a.kemasan' : '0 AS kemasan',
            $this->db->field_exists('stock_minimum', 'tb_barang') ? 'a.stock_minimum' : '0 AS stock_minimum',
            $this->db->field_exists('merk_barang', 'tb_barang') ? 'a.merk_barang' : "'' AS merk_barang",
            $this->db->field_exists('kelompok_barang', 'tb_barang') ? 'a.kelompok_barang' : "'' AS kelompok_barang",
            $this->db->field_exists('kategori_barang', 'tb_barang') ? 'a.kategori_barang' : "'' AS kategori_barang",
            $this->db->field_exists('produk_fokus', 'tb_barang') ? 'a.produk_fokus' : "'' AS produk_fokus",
            $this->db->field_exists('is_active', 'tb_barang') ? 'a.is_active' : "'T' AS is_active",
            $this->db->field_exists('is_lot', 'tb_barang') ? 'a.is_lot' : "'F' AS is_lot"
        );

        return implode(",\n", $select);
    }

    private function barang_komersil_base_sql()
    {
        $hasSatuanQty = $this->db->field_exists('satuan_qty', 'tb_barang');
        $joinSatuan = $hasSatuanQty
            ? 'LEFT JOIN tb_satuan b ON b.id_satuan = a.satuan_qty'
            : 'LEFT JOIN tb_satuan b ON b.nm_satuan = a.satuan';

        return "SELECT
            {$this->get_barang_select_sql()}
        FROM tb_barang a
        {$joinSatuan}
        LEFT JOIN tb_suplier c ON c.kd_suplier = a.kd_suplier";
    }

    private function barang_komersil_filter_sql($search, &$binds)
    {
        $search = trim((string)$search);
        if ($search === '') {
            return '';
        }

        $like = '%' . $search . '%';
        $where = '(barang.kode_barang LIKE ? OR barang.nama_barang LIKE ? OR barang.bahan_aktif LIKE ? OR barang.nm_satuan LIKE ? OR barang.nama_suplier LIKE ?)';
        array_push($binds, $like, $like, $like, $like, $like);

        return ' WHERE ' . $where;
    }

    private function barang_komersil_order_sql($column, $direction)
    {
        $columns = array(
            0 => 'barang.kode_barang',
            1 => 'barang.nama_barang',
            2 => 'barang.bahan_aktif',
            3 => 'barang.nm_satuan',
            4 => 'barang.nama_suplier',
            5 => 'barang.panjang',
            6 => 'barang.lebar',
            7 => 'barang.tinggi',
            8 => 'barang.stock_minimum'
        );

        $orderColumn = isset($columns[$column]) ? $columns[$column] : $columns[0];
        $orderDir = strtolower((string)$direction) === 'desc' ? 'DESC' : 'ASC';

        return " ORDER BY {$orderColumn} {$orderDir}";
    }

    public function get_masterbarang_komersil_datatable($params)
    {
        $binds = array();
        $baseSql = $this->barang_komersil_base_sql();
        $filterSql = $this->barang_komersil_filter_sql(isset($params['search']) ? $params['search'] : '', $binds);
        $orderSql = $this->barang_komersil_order_sql(
            isset($params['order_column']) ? (int)$params['order_column'] : 0,
            isset($params['order_dir']) ? $params['order_dir'] : 'asc'
        );
        $start = isset($params['start']) ? max(0, (int)$params['start']) : 0;
        $length = isset($params['length']) ? (int)$params['length'] : 10;
        $length = ($length > 0 && $length <= 100) ? $length : 10;

        $dataSql = "SELECT barang.* FROM ({$baseSql}) barang{$filterSql}{$orderSql} LIMIT ?, ?";
        $dataBinds = array_merge($binds, array($start, $length));
        $countSql = "SELECT COUNT(*) AS total FROM ({$baseSql}) barang{$filterSql}";
        $totalSql = 'SELECT COUNT(*) AS total FROM tb_barang';

        $recordsTotal = (int)$this->db->query($totalSql)->row()->total;
        $recordsFiltered = trim((string)(isset($params['search']) ? $params['search'] : '')) !== ''
            ? (int)$this->db->query($countSql, $binds)->row()->total
            : $recordsTotal;

        return array(
            'records_total' => $recordsTotal,
            'records_filtered' => $recordsFiltered,
            'data' => $this->db->query($dataSql, $dataBinds)->result()
        );
    }

    public function get_masterbarang_komersil_by_id($id)
    {
        $baseSql = $this->barang_komersil_base_sql();
        $id = (int)$id;

        return $this->db
            ->query("SELECT barang.* FROM ({$baseSql}) barang WHERE barang.id_barang = ? LIMIT 1", array($id))
            ->row();
    }

    public function get_masterbarang_komersil_by_kode($kodeBarang, $excludeId = null)
    {
        $idColumn = $this->get_barang_id_column();
        $this->db->from('tb_barang');
        $this->db->where('kode_barang', trim((string)$kodeBarang));
        if ($excludeId !== null) {
            $this->db->where($idColumn . ' !=', (int)$excludeId);
        }

        return $this->db->limit(1)->get()->row();
    }

    private function filter_barang_komersil_payload($data)
    {
        $allowed = array(
            'kode_barang',
            'kd_suplier',
            'nama_barang',
            'satuan',
            'satuan_qty',
            'panjang',
            'lebar',
            'tinggi',
            'hasil_dimensi',
            'berat',
            'isi',
            'kemasan',
            'stock_minimum',
            'merk_barang',
            'kelompok_barang',
            'kategori_barang',
            'produk_fokus',
            'is_active',
            'is_lot',
            'bahan_aktif',
            'bhn_aktif'
        );

        $payload = array();
        foreach ($allowed as $column) {
            if (array_key_exists($column, $data) && $this->db->field_exists($column, 'tb_barang')) {
                $payload[$column] = $data[$column];
            }
        }

        return $payload;
    }

    public function insert_masterbarang_komersil($data)
    {
        $payload = $this->filter_barang_komersil_payload($data);
        if (!$payload) {
            return false;
        }

        return $this->db->insert('tb_barang', $payload);
    }

    public function update_masterbarang_komersil($id, $data)
    {
        $payload = $this->filter_barang_komersil_payload($data);
        if (!$payload) {
            return false;
        }

        $idColumn = $this->get_barang_id_column();
        $this->db->where($idColumn, (int)$id);
        return $this->db->update('tb_barang', $payload);
    }

    // 
    // 
    // MASTER BARANG NON KOMERSIL
    // 
    // 

    public function get_all_masterbarang()
    {
        return $this->db->query("SELECT
            a.id_brg_nk,
            a.kd_barang,
            a.kd_br_adm,
            a.kat_barang,
            a.nama_barang,
            a.descnk,
            a.satuan,
            a.minimum_stock,
            a.gbr_barang,
            a.qrcode_path,
            a.qrcode_data,
            b.id_satuan,
            b.nm_satuan,
            c.nama_kategori
        FROM tb_barang_nk a
        JOIN tb_satuan b ON b.id_satuan = a.satuan
        JOIN tb_kat_br c ON c.kd_kat = a.kat_barang");
    }

    public function get_masterbarangnk_by_kd_barang($kode_barang)
    {
        $kode_barang = trim((string) $kode_barang);

        if ($kode_barang === '') {
            return null;
        }

        return $this->db
            ->select('id_brg_nk, kd_barang, kd_br_adm, nama_barang')
            ->from('tb_barang_nk')
            ->where('kd_barang', $kode_barang)
            ->limit(1)
            ->get()
            ->row();
    }
    public function get_all_req_barang()
    {
        return $this->db->query("SELECT * FROM tb_req_masterbarang a 
        JOIN tb_satuan b ON b.id_satuan = a.satuan 
        JOIN tb_user c ON c.kode_user = a.req_by");
    }
    public function get_all_req_barang_pic($kdu)
    {
        return $this->db->query("SELECT a.id_reqmbarang,c.nama_user , a.nama_barang , a.deskripsi , b.nm_satuan , c.departement
        FROM tb_req_masterbarang a 
        JOIN tb_satuan b ON b.id_satuan = a.satuan
        JOIN tb_user c ON c.kode_user = a.req_by
        WHERE a.req_by = '$kdu'
        ");
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

    public function allmasterbarang()
    {
        $idColumn = $this->db->field_exists('id_barang', 'tb_barang') ? 'id_barang' : 'id';
        $bahanAktifColumn = $this->db->field_exists('bahan_aktif', 'tb_barang') ? 'bahan_aktif' : 'bhn_aktif';
        $hasSatuanQty = $this->db->field_exists('satuan_qty', 'tb_barang');
        $hasHasilDimensi = $this->db->field_exists('hasil_dimensi', 'tb_barang');

        $select = array(
            "a.$idColumn AS id_barang",
            'a.kode_barang',
            'c.nama_suplier',
            'a.nama_barang',
            "a.$bahanAktifColumn AS bahan_aktif",
            $hasSatuanQty ? 'b.nm_satuan' : 'COALESCE(b.nm_satuan, a.satuan) AS nm_satuan',
            'a.panjang',
            'a.lebar',
            'a.tinggi',
            $hasHasilDimensi ? 'a.hasil_dimensi' : '(a.panjang * a.lebar * a.tinggi) AS hasil_dimensi'
        );

        $this->db->select(implode(",\n", $select), false);
        $this->db->from('tb_barang a');
        if ($hasSatuanQty) {
            $this->db->join('tb_satuan b', 'b.id_satuan = a.satuan_qty', 'left');
        } else {
            $this->db->join('tb_satuan b', 'b.nm_satuan = a.satuan', 'left');
        }
        $this->db->join('tb_suplier c', 'c.kd_suplier = a.kd_suplier', 'left');

        return $this->db->get();
    }

    public function getsuplierall()
    {
        return $this->db->query("SELECT 
        a.id_suplier AS idsup,
        a.kd_suplier AS kdsup,
        a.nama_suplier AS namasup
        FROM tb_suplier a
        ");
    }
}
