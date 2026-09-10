<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_PojasaWorkflow extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PO/M_PojasaCore');
        $this->load->helper(array('pojasa_authorization', 'pojasa_status'));
    }

    public function schema_ready()
    {
        return $this->M_PojasaCore->tables_ready()
            && $this->db->field_exists('purchasing_note', 'tbpo_jasa_request')
            && $this->db->field_exists('purchasing_revision_saved_at', 'tbpo_jasa_request')
            && $this->db->field_exists('purchasing_revision_status', 'tbpo_jasa_request');
    }

    public function role_allowed($context)
    {
        return in_array($context['role'], array('ADMIN', 'PIC', 'KADEP', 'PURCHASING', 'DIREKTUR_OPERASIONAL', 'DIREKTUR'), true);
    }

    public function work_statuses($context)
    {
        $map = array(
            'KADEP' => array('MENUNGGU_KADEP', 'PENDING_KADEP'),
            'PURCHASING' => array('MENUNGGU_PURCHASING', 'REVISI_PURCHASING_DIROPS', 'REVISI_PURCHASING_DIRUT'),
            'DIREKTUR_OPERASIONAL' => array('MENUNGGU_DIRUT_OPS'),
            'DIREKTUR' => array('MENUNGGU_DIREKTUR'),
            'ADMIN' => array(
                'MENUNGGU_KADEP', 'PENDING_KADEP', 'MENUNGGU_PURCHASING',
                'MENUNGGU_DIRUT_OPS', 'REVISI_PURCHASING_DIROPS',
                'MENUNGGU_DIREKTUR', 'REVISI_PURCHASING_DIRUT',
            ),
        );

        return isset($map[$context['role']]) ? $map[$context['role']] : array();
    }

    public function can_access_request($context, $request)
    {
        if (!$request || !$this->role_allowed($context) || !empty($request->deleted_at)) {
            return false;
        }
        if ($context['role'] === 'ADMIN' || $context['role'] === 'PURCHASING' || $context['role'] === 'DIREKTUR') {
            return true;
        }
        if ($context['role'] === 'PIC') {
            return (string) $request->kd_user === (string) $context['kode_user'];
        }
        if ($context['role'] === 'KADEP') {
            return pojasa_normalize_department($request->departemen) === $context['departemen'];
        }
        if ($context['role'] === 'DIREKTUR_OPERASIONAL') {
            return pojasa_requires_dirut_ops($request->departemen);
        }

        return false;
    }

    public function allowed_actions($context, $request)
    {
        if (!$this->can_access_request($context, $request)) {
            return array();
        }
        $stage = pojasa_workflow_stage($request->status);
        if (!$stage) {
            return array();
        }
        if ($context['role'] !== 'ADMIN' && $context['role'] !== $stage) {
            return array();
        }
        if ($stage === 'DIREKTUR_OPERASIONAL' && !pojasa_requires_dirut_ops($request->departemen)) {
            return array();
        }

        return pojasa_workflow_actions($request->status);
    }

    public function can_edit_purchasing($context, $request)
    {
        return $this->can_access_request($context, $request)
            && in_array($context['role'], array('PURCHASING', 'ADMIN'), true)
            && in_array($request->status, array('MENUNGGU_PURCHASING', 'REVISI_PURCHASING_DIROPS', 'REVISI_PURCHASING_DIRUT'), true);
    }

    public function datatable_requests($context, $params)
    {
        $statuses = $this->work_statuses($context);
        if (!$statuses) {
            return array('total' => 0, 'filtered' => 0, 'rows' => array());
        }
        $columns = array(
            0 => 'r.tgl_request', 1 => 'r.kd_po_jasa', 2 => 'r.nm_user',
            3 => 'r.departemen', 4 => 'COALESCE(v.nama_vendor, r.vendor_usulan)',
            5 => 'r.estimasi_total', 6 => 'r.status',
        );
        $placeholders = implode(',', array_fill(0, count($statuses), '?'));
        $where = array('r.deleted_at IS NULL', 'r.status IN (' . $placeholders . ')');
        $binds = $statuses;
        if ($context['role'] === 'KADEP') {
            $where[] = 'UPPER(TRIM(r.departemen)) = ?';
            $binds[] = $context['departemen'];
        } elseif ($context['role'] === 'DIREKTUR_OPERASIONAL') {
            $where[] = "UPPER(TRIM(r.departemen)) IN ('IT','HRD','GA')";
        }
        $baseWhere = $where;
        $baseBinds = $binds;
        $from = ' FROM tbpo_jasa_request r LEFT JOIN tbpo_jasa_vendor v ON v.kd_vendor_jasa = r.kd_vendor_jasa';
        $total = (int) $this->db->query('SELECT COUNT(*) total' . $from . ' WHERE ' . implode(' AND ', $baseWhere), $baseBinds)->row()->total;

        $filterStatus = strtoupper(trim((string) $params['status']));
        if ($filterStatus !== '' && in_array($filterStatus, $statuses, true)) {
            $where[] = 'r.status = ?';
            $binds[] = $filterStatus;
        }
        if ($params['date_from'] !== '') {
            $where[] = 'r.tgl_request >= ?';
            $binds[] = $params['date_from'];
        }
        if ($params['date_to'] !== '') {
            $where[] = 'r.tgl_request <= ?';
            $binds[] = $params['date_to'];
        }
        if ($params['search'] !== '') {
            $like = '%' . $params['search'] . '%';
            $where[] = '(r.kd_po_jasa LIKE ? OR r.nm_user LIKE ? OR r.departemen LIKE ? OR r.tujuan_pekerjaan LIKE ? OR v.nama_vendor LIKE ? OR r.vendor_usulan LIKE ?)';
            array_push($binds, $like, $like, $like, $like, $like, $like);
        }
        $filtered = (int) $this->db->query('SELECT COUNT(*) total' . $from . ' WHERE ' . implode(' AND ', $where), $binds)->row()->total;
        $order = isset($columns[$params['order_column']]) ? $columns[$params['order_column']] : 'r.id_po_jasa';
        $direction = strtolower($params['order_direction']) === 'asc' ? 'ASC' : 'DESC';
        $sql = 'SELECT r.*, COALESCE(v.nama_vendor, r.vendor_usulan) nama_vendor_tampil' . $from
            . ' WHERE ' . implode(' AND ', $where)
            . ' ORDER BY ' . $order . ' ' . $direction . ', r.id_po_jasa DESC LIMIT ?, ?';
        $rows = $this->db->query($sql, array_merge($binds, array((int) $params['start'], (int) $params['length'])))->result_array();

        return array('total' => $total, 'filtered' => $filtered, 'rows' => $rows);
    }

    public function get_request($requestCode, $context)
    {
        $this->db->select('r.*, v.nama_vendor, v.kategori_jasa');
        $this->db->from('tbpo_jasa_request r');
        $this->db->join('tbpo_jasa_vendor v', 'v.kd_vendor_jasa = r.kd_vendor_jasa', 'left');
        $this->db->where('r.kd_po_jasa', $requestCode);
        $request = $this->db->get()->row();

        return $this->can_access_request($context, $request) ? $request : null;
    }

    public function effective_revision($request)
    {
        return !empty($request->edit_revision_no) ? (int) $request->edit_revision_no : max(1, (int) $request->revision_no);
    }

    public function get_scopes($requestCode, $revisionNo)
    {
        return $this->db->order_by('line_no', 'ASC')->get_where('tbpo_jasa_scope', array(
            'kd_po_jasa' => $requestCode, 'revision_no' => (int) $revisionNo, 'is_active' => 1,
        ))->result_array();
    }

    public function get_materials($requestCode, $revisionNo)
    {
        $rows = $this->db->order_by('line_no', 'ASC')->get_where('tbpo_jasa_material', array(
            'kd_po_jasa' => $requestCode, 'revision_no' => (int) $revisionNo, 'is_active' => 1,
        ))->result_array();
        foreach ($rows as &$row) {
            $reserved = $this->db->query(
                "SELECT COALESCE(SUM(qty_allocation-qty_received-qty_released),0) qty FROM tbpo_jasa_stock_allocation WHERE id_material=? AND status_allocation IN ('ACTIVE','PARTIAL')",
                array((int) $row['id_material'])
            )->row();
            $draft = $this->db->query(
                "SELECT COALESCE(SUM(qty),0) qty FROM tbpo_jasa_draft_pembelian WHERE id_material=? AND status_draft='DRAFT'",
                array((int) $row['id_material'])
            )->row();
            $row['reserved_qty'] = max(0, (float) ($reserved ? $reserved->qty : 0));
            $row['active_draft_qty'] = max(0, (float) ($draft ? $draft->qty : 0));
            $row['remaining_need'] = max(0, round((float) $row['qty_kebutuhan'] - $row['reserved_qty'] - $row['active_draft_qty'], 2));
            $row['fulfillment_status'] = $row['remaining_need'] <= 0.000001
                ? 'TERPENUHI' : (($row['reserved_qty'] + $row['active_draft_qty']) > 0 ? 'SEBAGIAN' : 'BELUM_DIRENCANAKAN');
            $row['computed_source'] = $row['reserved_qty'] > 0 && $row['active_draft_qty'] > 0
                ? 'CAMPURAN' : ($row['reserved_qty'] > 0 ? 'STOK' : ($row['active_draft_qty'] > 0 ? 'PEMBELIAN' : 'BELUM DITENTUKAN'));
            $row['planning_locked'] = ($row['reserved_qty'] + $row['active_draft_qty']) > 0;
        }
        unset($row);
        return $rows;
    }

    public function get_documents($requestCode)
    {
        return $this->db->select('d.*,u.nm_user uploader_name')
            ->from('tbpo_jasa_dokumen d')->join('tbpo_user u', 'u.id_user=d.uploaded_by', 'left')
            ->where(array('d.kd_po_jasa' => $requestCode, 'd.is_active' => 1))
            ->order_by('d.id_dokumen', 'DESC')->get()->result_array();
    }

    public function get_document($documentId, $context)
    {
        $this->db->select('d.*, r.departemen, r.kd_user, r.status, r.deleted_at, u.nm_user uploader_name');
        $this->db->from('tbpo_jasa_dokumen d');
        $this->db->join('tbpo_jasa_request r', 'r.kd_po_jasa = d.kd_po_jasa');
        $this->db->join('tbpo_user u', 'u.id_user = d.uploaded_by', 'left');
        $this->db->where(array('d.id_dokumen' => (int) $documentId, 'd.is_active' => 1));
        $document = $this->db->get()->row();

        return $this->can_access_request($context, $document) ? $document : null;
    }

    public function document_can_preview($document)
    {
        $extension = strtolower(pathinfo((string) $document->file_original, PATHINFO_EXTENSION));
        return in_array($extension, array('jpg', 'jpeg', 'png', 'pdf'), true)
            && (strpos((string) $document->mime_type, 'image/') === 0 || $document->mime_type === 'application/pdf');
    }

    public function get_planning_detail($requestCode, $materialId, $type)
    {
        $material = $this->db->get_where('tbpo_jasa_material', array(
            'kd_po_jasa' => $requestCode, 'id_material' => (int) $materialId, 'is_active' => 1,
        ))->row_array();
        if (!$material) return array();
        if ($type === 'allocation') {
            return $this->db->select('a.*,b.kd_barang,b.nama_barang,u.nm_user created_name')
                ->from('tbpo_jasa_stock_allocation a')->join('tbpo_barang_nk b', 'b.id_brg_nk=a.id_brg_nk', 'left')
                ->join('tbpo_user u', 'u.id_user=a.allocated_by', 'left')
                ->where('a.id_material', (int) $materialId)->order_by('a.id_allocation', 'DESC')->get()->result_array();
        }
        if ($type === 'draft') {
            return $this->db->select('d.*,v.nama_vendor,u.nm_user created_name')
                ->from('tbpo_jasa_draft_pembelian d')->join('tbpo_jasa_vendor v', 'v.id_vendor_jasa=d.id_vendor_jasa', 'left')
                ->join('tbpo_user u', 'u.id_user=d.created_by', 'left')
                ->where('d.id_material', (int) $materialId)->order_by('d.id_draft_pembelian', 'DESC')->get()->result_array();
        }
        return array();
    }

    public function get_history($requestCode)
    {
        return array(
            'approvals' => $this->db->order_by('id_approval', 'DESC')->get_where('tbpo_jasa_approval', array('kd_po_jasa' => $requestCode))->result_array(),
            'revisions' => $this->db->order_by('id_revisi', 'DESC')->get_where('tbpo_jasa_revisi', array('kd_po_jasa' => $requestCode))->result_array(),
            'logs' => $this->db->order_by('id_log_aktivitas', 'DESC')->get_where('tbpo_jasa_log_aktivitas', array('kd_po_jasa' => $requestCode))->result_array(),
        );
    }

    public function get_active_vendors()
    {
        return $this->db->select('kd_vendor_jasa, nama_vendor, kategori_jasa')
            ->order_by('nama_vendor', 'ASC')->get_where('tbpo_jasa_vendor', array('status_vendor' => 'AKTIF', 'deleted_at' => null))->result_array();
    }

    public function save_purchasing_review($context, $requestCode, $payload, $expectedStatus, $expectedVersion)
    {
        $this->db->trans_begin();
        $request = $this->db->query('SELECT * FROM tbpo_jasa_request WHERE kd_po_jasa = ? FOR UPDATE', array($requestCode))->row();
        if (!$this->can_edit_purchasing($context, $request)) {
            $this->db->trans_rollback();
            return array('success' => false, 'code' => 'FORBIDDEN');
        }
        if ($request->status !== $expectedStatus || (int) $request->status_version !== (int) $expectedVersion) {
            $this->db->trans_rollback();
            return array('success' => false, 'code' => 'CONCURRENT_UPDATE');
        }
        $isRevision = in_array($request->status, array('REVISI_PURCHASING_DIROPS', 'REVISI_PURCHASING_DIRUT'), true);
        if ($isRevision && trim((string) $payload['note']) === '') {
            $this->db->trans_rollback();
            return array('success' => false, 'code' => 'NOTE_REQUIRED');
        }
        $sourceRevision = (int) $request->revision_no;
        $targetRevision = $isRevision
            ? (!empty($request->edit_revision_no) ? (int) $request->edit_revision_no : $sourceRevision + 1)
            : $sourceRevision;
        if ($isRevision) {
            $this->copyRevisionRows($requestCode, $sourceRevision, $targetRevision, $context);
        }
        foreach ($payload['scopes'] as $row) {
            $this->db->where(array(
                'kd_po_jasa' => $requestCode, 'revision_no' => $targetRevision,
                'line_no' => (int) $row['line_no'], 'is_active' => 1,
            ));
            $this->db->update('tbpo_jasa_scope', array(
                'nama_scope' => isset($row['nama_scope']) ? $row['nama_scope'] : $this->scopeValue($requestCode, $targetRevision, $row['line_no'], 'nama_scope'),
                'deskripsi' => array_key_exists('deskripsi', $row) ? $row['deskripsi'] : $this->scopeValue($requestCode, $targetRevision, $row['line_no'], 'deskripsi'),
                'qty' => $row['qty'],
                'satuan' => isset($row['satuan']) ? $row['satuan'] : $this->scopeValue($requestCode, $targetRevision, $row['line_no'], 'satuan'),
                'harga_estimasi' => $row['harga_estimasi'],
                'total_estimasi' => round($row['harga_estimasi'] * $row['qty'], 2),
                'keterangan_purchasing' => $row['keterangan_purchasing'],
            ));
        }
        foreach ($payload['materials'] as $row) {
            $this->db->where(array(
                'kd_po_jasa' => $requestCode, 'revision_no' => $targetRevision,
                'line_no' => (int) $row['line_no'], 'is_active' => 1,
            ));
            $materialUpdate = array(
                'nama_material' => isset($row['nama_material']) ? $row['nama_material'] : $this->materialValue($requestCode, $targetRevision, $row['line_no'], 'nama_material'),
                'deskripsi' => array_key_exists('deskripsi', $row) ? $row['deskripsi'] : $this->materialValue($requestCode, $targetRevision, $row['line_no'], 'deskripsi'),
                'qty_kebutuhan' => $row['qty'],
                'satuan' => isset($row['satuan']) ? $row['satuan'] : $this->materialValue($requestCode, $targetRevision, $row['line_no'], 'satuan'),
                'harga_estimasi' => $row['harga_estimasi'],
                'total_estimasi' => round($row['harga_estimasi'] * $row['qty'], 2),
            );
            if (isset($row['sumber_material'])) $materialUpdate['sumber_material'] = $row['sumber_material'];
            $this->db->update('tbpo_jasa_material', $materialUpdate);
        }
        $scopeTotal = (float) $this->db->query(
            'SELECT COALESCE(SUM(total_estimasi),0) total FROM tbpo_jasa_scope WHERE kd_po_jasa=? AND revision_no=? AND is_active=1',
            array($requestCode, $targetRevision)
        )->row()->total;
        $materialTotal = (float) $this->db->query(
            'SELECT COALESCE(SUM(total_estimasi),0) total FROM tbpo_jasa_material WHERE kd_po_jasa=? AND revision_no=? AND is_active=1',
            array($requestCode, $targetRevision)
        )->row()->total;
        $update = array(
            'kd_vendor_jasa' => $payload['kd_vendor_jasa'] !== '' ? $payload['kd_vendor_jasa'] : null,
            'purchasing_note' => $payload['note'] !== '' ? $payload['note'] : null,
            'tgl_mulai_pekerjaan' => isset($payload['tgl_mulai_pekerjaan']) ? $payload['tgl_mulai_pekerjaan'] : $request->tgl_mulai_pekerjaan,
            'tgl_selesai_pekerjaan' => isset($payload['tgl_selesai_pekerjaan']) ? $payload['tgl_selesai_pekerjaan'] : $request->tgl_selesai_pekerjaan,
            'tgl_target' => !empty($payload['tgl_selesai_pekerjaan']) ? $payload['tgl_selesai_pekerjaan'] : $request->tgl_target,
            'reviewed_by_purchasing' => (string) $context['kode_user'],
            'reviewed_at_purchasing' => date('Y-m-d H:i:s'),
            'estimasi_total_jasa' => round($scopeTotal, 2),
            'estimasi_total_bahan' => round($materialTotal, 2),
            'estimasi_total' => round($scopeTotal + $materialTotal, 2),
            'status_version' => (int) $request->status_version + 1,
        );
        if ($isRevision) {
            $update['edit_revision_no'] = $targetRevision;
            $update['purchasing_revision_saved_at'] = date('Y-m-d H:i:s');
            $update['purchasing_revision_status'] = $request->status;
        }
        $this->db->where(array('id_po_jasa' => (int) $request->id_po_jasa, 'status_version' => (int) $request->status_version));
        $this->db->update('tbpo_jasa_request', $update);
        if ($this->db->affected_rows() !== 1) {
            $this->db->trans_rollback();
            return array('success' => false, 'code' => 'CONCURRENT_UPDATE');
        }
        $this->M_PojasaCore->append_activity_log(array(
            'kd_po_jasa' => $requestCode, 'revision_no' => $targetRevision,
            'event_type' => $isRevision ? 'REVISI_PURCHASING_DISIMPAN' : 'REVIEW_PURCHASING_DISIMPAN',
            'from_status' => $request->status, 'to_status' => $request->status,
            'actor_id' => (int) $context['id_user'], 'actor_code' => $context['kode_user'],
            'actor_name' => $context['nama_user'], 'actor_role' => $context['role'],
            'actor_departemen' => $context['departemen'], 'catatan' => $payload['note'],
        ));
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return array('success' => false, 'code' => 'DATABASE_ERROR');
        }
        $this->db->trans_commit();

        return array(
            'success' => true, 'code' => 'SAVED', 'status' => $request->status,
            'status_version' => (int) $request->status_version + 1,
            'revision_no' => $targetRevision,
            'totals' => array('jasa' => $scopeTotal, 'material' => $materialTotal, 'grand_total' => $scopeTotal + $materialTotal),
        );
    }

    private function copyRevisionRows($requestCode, $sourceRevision, $targetRevision, $context)
    {
        $scopeExists = (int) $this->db->where(array('kd_po_jasa' => $requestCode, 'revision_no' => $targetRevision))->count_all_results('tbpo_jasa_scope');
        if ($scopeExists === 0) {
            $this->db->query(
                'INSERT INTO tbpo_jasa_scope (kd_po_jasa,revision_no,line_no,jenis_scope,nama_scope,deskripsi,qty,satuan,harga_estimasi,total_estimasi,harga_nyata,keterangan_purchasing,is_active) '
                . 'SELECT kd_po_jasa,?,line_no,jenis_scope,nama_scope,deskripsi,qty,satuan,harga_estimasi,total_estimasi,harga_nyata,keterangan_purchasing,1 '
                . 'FROM tbpo_jasa_scope WHERE kd_po_jasa=? AND revision_no=? AND is_active=1',
                array($targetRevision, $requestCode, $sourceRevision)
            );
        }
        $materialExists = (int) $this->db->where(array('kd_po_jasa' => $requestCode, 'revision_no' => $targetRevision))->count_all_results('tbpo_jasa_material');
        if ($materialExists === 0) {
            $this->db->query(
                'INSERT INTO tbpo_jasa_material (kd_po_jasa,revision_no,line_no,id_brg_nk,nama_material,deskripsi,qty_kebutuhan,satuan,harga_estimasi,total_estimasi,sumber_material,created_by,is_active) '
                . 'SELECT kd_po_jasa,?,line_no,id_brg_nk,nama_material,deskripsi,qty_kebutuhan,satuan,harga_estimasi,total_estimasi,sumber_material,?,1 '
                . 'FROM tbpo_jasa_material WHERE kd_po_jasa=? AND revision_no=? AND is_active=1',
                array($targetRevision, (int) $context['id_user'], $requestCode, $sourceRevision)
            );
        }
    }

    private function scopeValue($requestCode, $revisionNo, $lineNo, $field)
    {
        $row = $this->db->select($field)->get_where('tbpo_jasa_scope', array('kd_po_jasa' => $requestCode, 'revision_no' => (int) $revisionNo, 'line_no' => (int) $lineNo))->row_array();
        return $row && array_key_exists($field, $row) ? $row[$field] : null;
    }

    private function materialValue($requestCode, $revisionNo, $lineNo, $field)
    {
        $row = $this->db->select($field)->get_where('tbpo_jasa_material', array('kd_po_jasa' => $requestCode, 'revision_no' => (int) $revisionNo, 'line_no' => (int) $lineNo))->row_array();
        return $row && array_key_exists($field, $row) ? $row[$field] : null;
    }
}
