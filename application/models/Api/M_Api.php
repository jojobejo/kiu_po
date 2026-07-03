<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Api extends CI_Model
{
    const LPB_PONK_DEFAULT_LIMIT = 500;
    const LPB_PONK_MAX_LIMIT = 1000;
    const LPB_PO_KOMERSIL_DEFAULT_LIMIT = 500;
    const LPB_PO_KOMERSIL_MAX_LIMIT = 1000;

    public function get_data_pre_po_erp()
    {
        $rows = $this->db
            ->select('
                a.no_po,
                a.kd_po,
                a.tgl_transaksi,
                a.kd_suplier,
                a.kd_barang,
                a.satuan,
                a.qty,
                a.hrg_satuan,
                a.hrg_satuan AS harga_satuan,
                a.hrg_satuan AS harga,
                a.hrg_diskon AS harga_diskon,
                a.hrg_total,
                a.hrg_total AS total_harga,
                a.hrg_total_diskon AS total_harga_diskon,
                COALESCE(p.tax, 0) AS tax,
                ROUND((COALESCE(p.tax, 0) / 100) * COALESCE(a.hrg_total_diskon, 0), 0) AS tax_diskon,
                ROUND(COALESCE(a.hrg_total, 0) + ((COALESCE(p.tax, 0) / 100) * COALESCE(a.hrg_total, 0)), 0) AS grand_total,
                ROUND(COALESCE(a.hrg_total_diskon, 0) + ((COALESCE(p.tax, 0) / 100) * COALESCE(a.hrg_total_diskon, 0)), 0) AS grand_total_diskon
            ')
            ->from('tb_detail_po a')
            ->join('tb_po p', 'p.kd_po = a.kd_po', 'left')
            ->where('a.tgl_transaksi IS NOT NULL', null, false)
            ->where("a.tgl_transaksi <>", '0000-00-00')
            ->order_by('a.tgl_transaksi', 'DESC')
            ->order_by('a.kd_po', 'DESC')
            ->get()
            ->result_array();

        if (empty($rows)) {
            return $rows;
        }

        $kdPoList = array_values(array_unique(array_filter(array_column($rows, 'kd_po'))));
        $discountMap = $this->get_discount_history_map($kdPoList);

        foreach ($rows as &$row) {
            $kdPo = $row['kd_po'] ?? '';
            $row['histori_diskon'] = $discountMap[$kdPo] ?? [];
        }
        unset($row);

        return $rows;
    }

    private function get_discount_history_map(array $kdPoList)
    {
        if (empty($kdPoList)) {
            return [];
        }

        $map = [];

        foreach (array_chunk($kdPoList, 500) as $chunk) {
            $rows = $this->db
                ->select('
                    d.id_diskon,
                    d.kd_po,
                    d.kd_suplier,
                    p.no_po,
                    p.tgl_transaksi,
                    s.nama_suplier,
                    d.keterangan,
                    d.nominal
                ')
                ->from('tb_diskon d')
                ->join('tb_po p', 'p.kd_po = d.kd_po', 'left')
                ->join('tb_suplier s', 's.kd_suplier = d.kd_suplier', 'left')
                ->where_in('d.kd_po', $chunk)
                ->order_by('d.kd_po', 'ASC')
                ->order_by('d.id_diskon', 'ASC')
                ->get()
                ->result_array();

            foreach ($rows as $row) {
                $map[$row['kd_po']][] = $row;
            }
        }

        return $map;
    }

    public function get_data_lpb_po_komersil_erp(array $filters = array())
    {
        $limit = isset($filters['limit']) ? (int) $filters['limit'] : self::LPB_PO_KOMERSIL_DEFAULT_LIMIT;
        if ($limit <= 0) {
            $limit = self::LPB_PO_KOMERSIL_DEFAULT_LIMIT;
        }
        $limit = min($limit, self::LPB_PO_KOMERSIL_MAX_LIMIT);

        $status = isset($filters['status']) ? strtoupper(trim((string) $filters['status'])) : 'DONE';

        $this->db
            ->select("
                'PO_KOMERSIL' AS sumber_data,
                CONCAT(p.kd_po, '-', d.id_det_po) AS kode_sync,
                p.kd_po AS kode_faktur,
                p.kd_po,
                NULLIF(p.no_po, '-') AS nomor_po,
                NULL AS nomor_invoice,
                p.tgl_transaksi AS tanggal_po,
                p.status,
                p.kd_suplier AS kode_suplier,
                sp.nama_suplier,
                d.id_det_po AS id_detail_source,
                d.kd_barang AS kode_barang,
                d.nama_barang,
                d.satuan,
                d.qty,
                d.isi,
                d.kemasan,
                d.qty_kecil,
                d.is_bonus,
                d.keterangan_bonus,
                d.kd_user AS kode_user_input,
                d.create_at AS detail_updated_at,
                p.create_at AS po_updated_at
            ", false)
            ->from('tb_detail_po d')
            ->join('tb_po p', 'p.kd_po = d.kd_po', 'inner')
            ->join('tb_suplier sp', 'sp.kd_suplier = p.kd_suplier', 'left')
            ->where('p.kd_po IS NOT NULL', null, false)
            ->where("TRIM(p.kd_po) <>", '')
            ->order_by('p.create_at', 'DESC')
            ->order_by('d.id_det_po', 'ASC')
            ->limit($limit);

        if ($status !== '' && $status !== 'ALL') {
            $this->db->where('p.status', $status);
        }

        if (!empty($filters['kd_po'])) {
            $this->db->where('p.kd_po', $filters['kd_po']);
        }

        if (!empty($filters['no_po'])) {
            $this->db->where('p.no_po', $filters['no_po']);
        }

        if (!empty($filters['kd_suplier'])) {
            $this->db->where('p.kd_suplier', $filters['kd_suplier']);
        }

        if (!empty($filters['date_from'])) {
            $this->db->where('p.tgl_transaksi >=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $this->db->where('p.tgl_transaksi <=', $filters['date_to']);
        }

        if (!empty($filters['updated_since'])) {
            $this->db->group_start();
            $this->db->where('p.create_at >=', $filters['updated_since']);
            $this->db->or_where('d.create_at >=', $filters['updated_since']);
            $this->db->group_end();
        }

        return $this->db->get()->result_array();
    }

    public function get_data_lpb_ponk_erp(array $filters = array())
    {
        return $this->get_data_lpb_po_komersil_erp($filters);
    }
}
