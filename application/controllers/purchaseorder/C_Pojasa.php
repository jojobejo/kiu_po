<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Pojasa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PO/M_Pojasa');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->ensure_login(false);

        $data['title'] = 'PO Jasa';
        $data['tables_ready'] = $this->M_Pojasa->tables_ready();
        $data['missing_tables'] = $this->M_Pojasa->missing_tables();
        $data['status_options'] = $this->status_options();

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/po/jasa/body', $data);
        $this->load->view('partial/footer');
        $this->load->view('content/po/jasa/ajax', $data);
    }

    public function vendor_data()
    {
        $this->ensure_login(true);
        if (!$this->tables_ready_json()) {
            return;
        }

        $vendors = $this->M_Pojasa->list_vendor(false);
        $rows = array();
        foreach ($vendors as $vendor) {
            $rows[] = array(
                'id_vendor_jasa' => $vendor->id_vendor_jasa,
                'kd_vendor_jasa' => $vendor->kd_vendor_jasa,
                'nama_vendor' => $vendor->nama_vendor,
                'kategori_jasa' => $vendor->kategori_jasa,
                'alamat_vendor' => $vendor->alamat_vendor,
                'kontak_person' => $vendor->kontak_person,
                'no_telpon' => $vendor->no_telpon,
                'email' => $vendor->email,
                'npwp' => $vendor->npwp,
                'status_vendor' => $vendor->status_vendor
            );
        }

        $this->json_response(array('success' => true, 'data' => $rows));
    }

    public function vendor_save()
    {
        $this->ensure_login(true);
        if (!$this->tables_ready_json()) {
            return;
        }

        $user = $this->current_user();
        if (!$this->can_manage_vendor($user)) {
            $this->json_response(array('success' => false, 'message' => 'Anda tidak memiliki akses mengelola vendor jasa.'), 403);
            return;
        }

        $id = trim((string) $this->input->post('id_vendor_jasa'));
        $nama = trim((string) $this->input->post('nama_vendor'));
        $kategori = trim((string) $this->input->post('kategori_jasa'));

        if ($nama === '' || $kategori === '') {
            $this->json_response(array('success' => false, 'message' => 'Nama vendor dan kategori jasa wajib diisi.'), 422);
            return;
        }

        $data = array(
            'nama_vendor' => $nama,
            'kategori_jasa' => $kategori,
            'alamat_vendor' => trim((string) $this->input->post('alamat_vendor')),
            'kontak_person' => trim((string) $this->input->post('kontak_person')),
            'no_telpon' => trim((string) $this->input->post('no_telpon')),
            'email' => trim((string) $this->input->post('email')),
            'npwp' => trim((string) $this->input->post('npwp')),
            'status_vendor' => 'AKTIF',
            'updated_by' => $user['kode']
        );

        if (!$id) {
            $data['created_by'] = $user['kode'];
        }

        $saved = $this->M_Pojasa->save_vendor($data, $id ? $id : null);
        $this->json_response(array(
            'success' => (bool) $saved,
            'message' => $saved ? 'Vendor jasa berhasil disimpan.' : 'Vendor jasa gagal disimpan.'
        ), $saved ? 200 : 500);
    }

    public function vendor_status()
    {
        $this->ensure_login(true);
        if (!$this->tables_ready_json()) {
            return;
        }

        $user = $this->current_user();
        if (!$this->can_manage_vendor($user)) {
            $this->json_response(array('success' => false, 'message' => 'Anda tidak memiliki akses mengelola vendor jasa.'), 403);
            return;
        }

        $id = (int) $this->input->post('id_vendor_jasa');
        $status = strtoupper(trim((string) $this->input->post('status_vendor')));

        if (!$id || !in_array($status, array('AKTIF', 'NONAKTIF'))) {
            $this->json_response(array('success' => false, 'message' => 'Data status vendor tidak valid.'), 422);
            return;
        }

        $saved = $this->M_Pojasa->set_vendor_status($id, $status, $user['kode']);
        $this->json_response(array(
            'success' => (bool) $saved,
            'message' => $saved ? 'Status vendor berhasil diperbarui.' : 'Status vendor gagal diperbarui.'
        ), $saved ? 200 : 500);
    }

    public function request_data()
    {
        $this->ensure_login(true);
        if (!$this->tables_ready_json()) {
            return;
        }

        $filters = array(
            'status' => trim((string) $this->input->post('status')),
            'tgl_awal' => trim((string) $this->input->post('tgl_awal')),
            'tgl_akhir' => trim((string) $this->input->post('tgl_akhir'))
        );

        $rows = array();
        $requests = $this->M_Pojasa->list_request($filters, $this->current_user());
        foreach ($requests as $request) {
            $rows[] = array(
                'kd_pojasa' => $request->kd_pojasa,
                'tgl_request' => $request->tgl_request,
                'tgl_kebutuhan' => $request->tgl_kebutuhan,
                'judul_jasa' => $request->judul_jasa,
                'nama_vendor' => $request->nama_vendor,
                'departemen' => $request->departemen,
                'nm_user' => $request->nm_user,
                'total_estimasi' => $request->total_estimasi,
                'status_request' => $request->status_request,
                'prioritas' => $request->prioritas
            );
        }

        $this->json_response(array('success' => true, 'data' => $rows));
    }

    public function request_save()
    {
        $this->ensure_login(true);
        if (!$this->tables_ready_json()) {
            return;
        }

        $user = $this->current_user();
        $kdVendor = trim((string) $this->input->post('kd_vendor_jasa'));
        $judul = trim((string) $this->input->post('judul_jasa'));
        $kegiatan = trim((string) $this->input->post('kegiatan_jasa'));
        $tglKebutuhan = trim((string) $this->input->post('tgl_kebutuhan'));
        $biayaJson = (string) $this->input->post('biaya_json');
        $biayaInput = json_decode($biayaJson, true);

        if ($kdVendor === '' || $judul === '' || $kegiatan === '' || $tglKebutuhan === '') {
            $this->json_response(array('success' => false, 'message' => 'Vendor, judul, kegiatan, dan tanggal kebutuhan wajib diisi.'), 422);
            return;
        }

        $vendor = $this->M_Pojasa->get_vendor_by_code($kdVendor);
        if (!$vendor || $vendor->status_vendor != 'AKTIF') {
            $this->json_response(array('success' => false, 'message' => 'Vendor jasa tidak valid atau sedang nonaktif.'), 422);
            return;
        }

        if (!is_array($biayaInput) || count($biayaInput) === 0) {
            $this->json_response(array('success' => false, 'message' => 'Minimal satu rincian biaya wajib diisi.'), 422);
            return;
        }

        $biayaRows = array();
        $total = 0;
        foreach ($biayaInput as $row) {
            $jenis = strtoupper(trim((string) (isset($row['jenis_biaya']) ? $row['jenis_biaya'] : '')));
            $item = trim((string) (isset($row['nama_biaya']) ? $row['nama_biaya'] : ''));
            $qty = $this->normal_number(isset($row['qty']) ? $row['qty'] : 0);
            $nominal = $this->normal_number(isset($row['nominal']) ? $row['nominal'] : 0);

            if ($item === '' || $qty <= 0 || $nominal < 0 || !in_array($jenis, array('JASA', 'OPERASIONAL', 'BAHAN', 'LAIN_LAIN'))) {
                continue;
            }

            $subtotal = $qty * $nominal;
            $total += $subtotal;
            $biayaRows[] = array(
                'jenis_biaya' => $jenis,
                'nama_biaya' => $item,
                'keterangan_biaya' => trim((string) (isset($row['keterangan_biaya']) ? $row['keterangan_biaya'] : '')),
                'qty' => $qty,
                'satuan' => trim((string) (isset($row['satuan']) ? $row['satuan'] : '')),
                'nominal' => $nominal,
                'subtotal' => $subtotal
            );
        }

        if (count($biayaRows) === 0 || $total <= 0) {
            $this->json_response(array('success' => false, 'message' => 'Rincian biaya belum valid.'), 422);
            return;
        }

        $kdPojasa = $this->M_Pojasa->reserve_kd_pojasa();
        if (!$kdPojasa) {
            $this->json_response(array('success' => false, 'message' => 'Nomor PO Jasa gagal dibuat. Silakan ulangi.'), 500);
            return;
        }

        $taxPercent = $this->normal_number($this->input->post('tax_percent'));
        $taxAmount = ($total * $taxPercent) / 100;
        $status = $this->input->post('submit_request') == '1' ? 'DIAJUKAN' : 'DRAFT';
        $prioritas = trim((string) $this->input->post('prioritas'));
        if (!in_array($prioritas, array('RENDAH', 'NORMAL', 'URGENT'))) {
            $prioritas = 'NORMAL';
        }

        $header = array(
            'kd_pojasa' => $kdPojasa,
            'tgl_request' => date('Y-m-d'),
            'tgl_kebutuhan' => $tglKebutuhan,
            'kd_user' => $user['kode'],
            'nm_user' => $user['nama'],
            'departemen' => $user['departemen'],
            'kd_vendor_jasa' => $kdVendor,
            'judul_jasa' => $judul,
            'lokasi_jasa' => trim((string) $this->input->post('lokasi_jasa')),
            'kegiatan_jasa' => $kegiatan,
            'alasan_kebutuhan' => trim((string) $this->input->post('alasan_kebutuhan')),
            'catatan_pengajuan' => trim((string) $this->input->post('catatan_pengajuan')),
            'prioritas' => $prioritas,
            'tax_percent' => $taxPercent,
            'tax_amount' => $taxAmount,
            'total_estimasi' => $total,
            'grand_total' => $total + $taxAmount,
            'status_request' => $status,
            'created_by' => $user['kode'],
            'updated_by' => $user['kode']
        );

        $saved = $this->M_Pojasa->create_request($header, $biayaRows, $user);
        $this->json_response(array(
            'success' => (bool) $saved,
            'message' => $saved ? 'Request PO Jasa berhasil disimpan.' : 'Request PO Jasa gagal disimpan.',
            'kd_pojasa' => $kdPojasa
        ), $saved ? 200 : 500);
    }

    public function request_detail($kdpojasa)
    {
        $this->ensure_login(true);
        if (!$this->tables_ready_json()) {
            return;
        }

        $user = $this->current_user();
        $request = $this->M_Pojasa->get_request($kdpojasa, $user);
        if (!$request) {
            $this->json_response(array('success' => false, 'message' => 'Data PO Jasa tidak ditemukan.'), 404);
            return;
        }

        $this->json_response(array(
            'success' => true,
            'request' => $request,
            'biaya' => $this->M_Pojasa->get_request_biaya($kdpojasa),
            'log' => $this->M_Pojasa->get_request_log($kdpojasa),
            'actions' => $this->available_actions($request, $user)
        ));
    }

    public function request_status()
    {
        $this->ensure_login(true);
        if (!$this->tables_ready_json()) {
            return;
        }

        $user = $this->current_user();
        $kdpojasa = trim((string) $this->input->post('kd_pojasa'));
        $action = trim((string) $this->input->post('action'));
        $catatan = trim((string) $this->input->post('catatan'));
        $request = $this->M_Pojasa->get_request($kdpojasa, $user);

        if (!$request) {
            $this->json_response(array('success' => false, 'message' => 'Data PO Jasa tidak ditemukan.'), 404);
            return;
        }

        $actions = $this->available_actions($request, $user);
        if (!isset($actions[$action])) {
            $this->json_response(array('success' => false, 'message' => 'Aksi status tidak diperbolehkan untuk user atau status saat ini.'), 403);
            return;
        }

        $saved = $this->M_Pojasa->change_status($kdpojasa, $actions[$action]['status'], $catatan, $user);
        $this->json_response(array(
            'success' => (bool) $saved,
            'message' => $saved ? 'Status PO Jasa berhasil diperbarui.' : 'Status PO Jasa gagal diperbarui.'
        ), $saved ? 200 : 500);
    }

    public function summary()
    {
        $this->ensure_login(true);
        if (!$this->tables_ready_json()) {
            return;
        }

        $summary = array(
            'DRAFT' => 0,
            'DIAJUKAN' => 0,
            'APPROVED KADEP' => 0,
            'REVIEW BIAYA' => 0,
            'APPROVED DIREKTUR' => 0,
            'PO TERBIT' => 0,
            'DALAM PELAKSANAAN' => 0,
            'SELESAI PIC' => 0,
            'CLOSED' => 0
        );

        foreach ($this->M_Pojasa->request_summary($this->current_user()) as $row) {
            $summary[$row->status_request] = (int) $row->total;
        }

        $this->json_response(array('success' => true, 'summary' => $summary));
    }

    private function ensure_login($json)
    {
        if ($this->session->userdata('status') == 'is_login') {
            return;
        }

        if ($json) {
            $this->json_response(array('success' => false, 'message' => 'Sesi login sudah berakhir.'), 401);
            exit;
        }

        redirect('login');
    }

    private function tables_ready_json()
    {
        $missing = $this->M_Pojasa->missing_tables();
        if (count($missing) === 0) {
            return true;
        }

        $this->json_response(array(
            'success' => false,
            'message' => 'Tabel PO Jasa belum tersedia. Jalankan SQL migration terlebih dahulu.',
            'missing_tables' => $missing
        ), 503);
        return false;
    }

    private function current_user()
    {
        return array(
            'kode' => (string) $this->session->userdata('kode'),
            'nama' => (string) $this->session->userdata('nama_user'),
            'lv' => (string) $this->session->userdata('lv'),
            'departemen' => (string) $this->session->userdata('departemen')
        );
    }

    private function can_manage_vendor($user)
    {
        return $user['lv'] <= '2' || $user['departemen'] == 'PURCHASING' || $user['departemen'] == 'KEUANGAN';
    }

    private function available_actions($request, $user)
    {
        $actions = array();
        $status = $request->status_request;

        if ($user['lv'] == '4' && $request->kd_user == $user['kode']) {
            if ($status == 'DRAFT') {
                $actions['submit'] = array('label' => 'Ajukan ke KADEP', 'status' => 'DIAJUKAN');
            }
            if ($status == 'DALAM PELAKSANAAN') {
                $actions['finish_pic'] = array('label' => 'Konfirmasi Selesai PIC', 'status' => 'SELESAI PIC');
            }
            if (in_array($status, array('DRAFT', 'DIAJUKAN'))) {
                $actions['cancel'] = array('label' => 'Batalkan Request', 'status' => 'CANCEL');
            }
        }

        if ($user['lv'] == '5' && $request->departemen == $user['departemen'] && $status == 'DIAJUKAN') {
            $actions['kadep_approve'] = array('label' => 'Approve KADEP', 'status' => 'APPROVED KADEP');
            $actions['kadep_reject'] = array('label' => 'Reject KADEP', 'status' => 'REJECT KADEP');
        }

        if ($this->can_manage_vendor($user)) {
            if ($status == 'APPROVED KADEP') {
                $actions['review_biaya'] = array('label' => 'Review Biaya', 'status' => 'REVIEW BIAYA');
            }
            if (in_array($status, array('APPROVED DIREKTUR', 'REVIEW BIAYA'))) {
                $actions['publish_po'] = array('label' => 'Terbitkan PO Jasa', 'status' => 'PO TERBIT');
            }
            if ($status == 'PO TERBIT') {
                $actions['start_work'] = array('label' => 'Mulai Pelaksanaan', 'status' => 'DALAM PELAKSANAAN');
            }
            if ($status == 'SELESAI PIC') {
                $actions['close'] = array('label' => 'Close PO Jasa', 'status' => 'CLOSED');
            }
        }

        if ($user['lv'] == '3' && $status == 'REVIEW BIAYA') {
            $actions['direktur_approve'] = array('label' => 'Approve Direktur', 'status' => 'APPROVED DIREKTUR');
            $actions['direktur_reject'] = array('label' => 'Reject Direktur', 'status' => 'REJECT DIREKTUR');
        }

        return $actions;
    }

    private function status_options()
    {
        return array(
            'DRAFT',
            'DIAJUKAN',
            'APPROVED KADEP',
            'REJECT KADEP',
            'REVIEW BIAYA',
            'APPROVED DIREKTUR',
            'REJECT DIREKTUR',
            'PO TERBIT',
            'DALAM PELAKSANAAN',
            'SELESAI PIC',
            'CLOSED',
            'CANCEL'
        );
    }

    private function normal_number($value)
    {
        $clean = preg_replace('/[^0-9.\-]/', '', (string) $value);
        if ($clean === '' || !is_numeric($clean)) {
            return 0;
        }
        return (float) $clean;
    }

    private function json_response($payload, $status = 200)
    {
        $this->output
            ->set_status_header($status)
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }
}
