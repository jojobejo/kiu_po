<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pojasa extends CI_Model
{
    private $tableVendor = 'tb_pojasa_vendor';
    private $tableRequest = 'tb_pojasa_request';
    private $tableBiaya = 'tb_pojasa_biaya';
    private $tableLog = 'tb_pojasa_log';
    private $tableGenerate = 'tb_pojasa_generate';

    public function __construct()
    {
        parent::__construct();
    }

    public function required_tables()
    {
        return array(
            $this->tableVendor,
            $this->tableRequest,
            $this->tableBiaya,
            $this->tableLog,
            $this->tableGenerate
        );
    }

    public function missing_tables()
    {
        $missing = array();
        foreach ($this->required_tables() as $table) {
            if (!$this->db->table_exists($table)) {
                $missing[] = $table;
            }
        }
        return $missing;
    }

    public function tables_ready()
    {
        return count($this->missing_tables()) === 0;
    }

    public function list_vendor($activeOnly = false)
    {
        $this->db->select('*');
        $this->db->from($this->tableVendor);
        if ($activeOnly) {
            $this->db->where('status_vendor', 'AKTIF');
        }
        $this->db->order_by('nama_vendor', 'ASC');
        return $this->db->get()->result();
    }

    public function get_vendor($id)
    {
        return $this->db
            ->where('id_vendor_jasa', $id)
            ->get($this->tableVendor)
            ->row();
    }

    public function get_vendor_by_code($code)
    {
        return $this->db
            ->where('kd_vendor_jasa', $code)
            ->get($this->tableVendor)
            ->row();
    }

    public function save_vendor($data, $id = null)
    {
        if ($id) {
            $this->db->where('id_vendor_jasa', $id);
            return $this->db->update($this->tableVendor, $data);
        }

        $data['kd_vendor_jasa'] = $this->generate_vendor_code();
        return $this->db->insert($this->tableVendor, $data);
    }

    public function set_vendor_status($id, $status, $updatedBy)
    {
        $data = array(
            'status_vendor' => $status,
            'updated_by' => $updatedBy
        );

        $this->db->where('id_vendor_jasa', $id);
        return $this->db->update($this->tableVendor, $data);
    }

    public function generate_vendor_code()
    {
        $prefix = 'VJ' . date('ymd');
        $row = $this->db
            ->select('MAX(CAST(RIGHT(kd_vendor_jasa,4) AS UNSIGNED)) AS kd_max', false)
            ->like('kd_vendor_jasa', $prefix, 'after')
            ->get($this->tableVendor)
            ->row();

        $next = $row && $row->kd_max ? ((int) $row->kd_max) + 1 : 1;
        return $prefix . sprintf('%04d', $next);
    }

    public function reserve_kd_pojasa()
    {
        date_default_timezone_set('Asia/Jakarta');
        $lockName = 'kiu_po_pojasa_' . date('Ymd');
        $locked = $this->db->query('SELECT GET_LOCK(?, 10) AS is_locked', array($lockName))->row();

        if (!$locked || $locked->is_locked != '1') {
            return false;
        }

        try {
            $prefix = 'POJ' . date('dmy');
            $row = $this->db
                ->select('MAX(CAST(RIGHT(kd_pojasa,4) AS UNSIGNED)) AS kd_max', false)
                ->like('kd_pojasa', $prefix, 'after')
                ->get($this->tableGenerate)
                ->row();

            $next = $row && $row->kd_max ? ((int) $row->kd_max) + 1 : 1;
            for ($i = 0; $i < 10; $i++) {
                $candidate = $prefix . sprintf('%04d', $next + $i);
                $exists = $this->db
                    ->where('kd_pojasa', $candidate)
                    ->count_all_results($this->tableRequest);

                $reserved = $this->db
                    ->where('kd_pojasa', $candidate)
                    ->count_all_results($this->tableGenerate);

                if (!$exists && !$reserved) {
                    $this->db->insert($this->tableGenerate, array('kd_pojasa' => $candidate));
                    if ($this->db->affected_rows() > 0) {
                        return $candidate;
                    }
                }
            }
        } finally {
            $this->db->query('SELECT RELEASE_LOCK(?)', array($lockName));
        }

        return false;
    }

    public function create_request($header, $biayaRows, $user)
    {
        $this->db->trans_begin();

        $this->db->insert($this->tableRequest, $header);

        foreach ($biayaRows as $row) {
            $row['kd_pojasa'] = $header['kd_pojasa'];
            $this->db->insert($this->tableBiaya, $row);
        }

        $this->insert_log(array(
            'kd_pojasa' => $header['kd_pojasa'],
            'aktivitas' => 'Request PO Jasa dibuat',
            'status_dari' => '',
            'status_ke' => $header['status_request'],
            'catatan' => $header['catatan_pengajuan'],
            'kd_user' => $user['kode'],
            'nama_user' => $user['nama']
        ));

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return true;
    }

    public function list_request($filters, $user)
    {
        $this->db->select('r.*, v.nama_vendor, v.kategori_jasa');
        $this->db->from($this->tableRequest . ' r');
        $this->db->join($this->tableVendor . ' v', 'v.kd_vendor_jasa = r.kd_vendor_jasa', 'left');

        if ($user['lv'] == '4') {
            $this->db->where('r.kd_user', $user['kode']);
        } elseif ($user['lv'] == '5') {
            $this->db->where('r.departemen', $user['departemen']);
        }

        if (!empty($filters['status'])) {
            $this->db->where('r.status_request', $filters['status']);
        }
        if (!empty($filters['tgl_awal'])) {
            $this->db->where('r.tgl_request >=', $filters['tgl_awal']);
        }
        if (!empty($filters['tgl_akhir'])) {
            $this->db->where('r.tgl_request <=', $filters['tgl_akhir']);
        }

        $this->db->order_by('r.id_pojasa', 'DESC');
        return $this->db->get()->result();
    }

    public function request_summary($user)
    {
        $this->db->select('status_request, COUNT(*) AS total', false);
        $this->db->from($this->tableRequest);

        if ($user['lv'] == '4') {
            $this->db->where('kd_user', $user['kode']);
        } elseif ($user['lv'] == '5') {
            $this->db->where('departemen', $user['departemen']);
        }

        $this->db->group_by('status_request');
        return $this->db->get()->result();
    }

    public function get_request($kdpojasa, $user)
    {
        $this->db->select('r.*, v.nama_vendor, v.kategori_jasa, v.no_telpon, v.email');
        $this->db->from($this->tableRequest . ' r');
        $this->db->join($this->tableVendor . ' v', 'v.kd_vendor_jasa = r.kd_vendor_jasa', 'left');
        $this->db->where('r.kd_pojasa', $kdpojasa);

        if ($user['lv'] == '4') {
            $this->db->where('r.kd_user', $user['kode']);
        } elseif ($user['lv'] == '5') {
            $this->db->where('r.departemen', $user['departemen']);
        }

        return $this->db->get()->row();
    }

    public function get_request_biaya($kdpojasa)
    {
        $this->db->from($this->tableBiaya);
        $this->db->where('kd_pojasa', $kdpojasa);
        $this->db->order_by('id_biaya_jasa', 'ASC');
        return $this->db->get()->result();
    }

    public function get_request_log($kdpojasa)
    {
        $this->db->from($this->tableLog);
        $this->db->where('kd_pojasa', $kdpojasa);
        $this->db->order_by('id_log_jasa', 'DESC');
        return $this->db->get()->result();
    }

    public function change_status($kdpojasa, $newStatus, $catatan, $user)
    {
        $request = $this->db
            ->where('kd_pojasa', $kdpojasa)
            ->get($this->tableRequest)
            ->row();

        if (!$request) {
            return false;
        }

        $data = array(
            'status_request' => $newStatus,
            'updated_by' => $user['kode']
        );

        if ($newStatus == 'APPROVED KADEP') {
            $data['approved_kadep_by'] = $user['kode'];
            $data['approved_kadep_at'] = date('Y-m-d H:i:s');
        } elseif ($newStatus == 'APPROVED DIREKTUR') {
            $data['approved_direktur_by'] = $user['kode'];
            $data['approved_direktur_at'] = date('Y-m-d H:i:s');
        } elseif ($newStatus == 'CLOSED') {
            $data['closed_at'] = date('Y-m-d H:i:s');
        }

        $this->db->trans_begin();
        $this->db->where('kd_pojasa', $kdpojasa);
        $this->db->update($this->tableRequest, $data);

        $this->insert_log(array(
            'kd_pojasa' => $kdpojasa,
            'aktivitas' => 'Update status PO Jasa',
            'status_dari' => $request->status_request,
            'status_ke' => $newStatus,
            'catatan' => $catatan,
            'kd_user' => $user['kode'],
            'nama_user' => $user['nama']
        ));

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return true;
    }

    public function insert_log($data)
    {
        return $this->db->insert($this->tableLog, $data);
    }
}
