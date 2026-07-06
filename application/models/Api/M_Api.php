<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Api extends CI_Model
{
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
                ((COALESCE(p.tax, 0) / 100) * COALESCE(a.hrg_total_diskon, 0)) AS tax_diskon,
                (COALESCE(a.hrg_total, 0) + ((COALESCE(p.tax, 0) / 100) * COALESCE(a.hrg_total, 0))) AS grand_total,
                (COALESCE(a.hrg_total_diskon, 0) + ((COALESCE(p.tax, 0) / 100) * COALESCE(a.hrg_total_diskon, 0))) AS grand_total_diskon
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
}
