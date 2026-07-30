# Database - Lap Nonkomersil Qty Nyata dan Harga Nyata

## Ringkasan

Tidak ada perubahan struktur database untuk penambahan `Qty Nyata` dan `Harga Nyata` pada route `lap_nonkomersil`.

## Tabel Dibaca

Laporan membaca tabel existing:

- `tb_detail_po_nk`
- `tb_po_nk`
- `tb_user`
- `tb_penerimaan_po_nk_detail` jika tabel tersedia

## Field Dibaca

Nilai PO:

- `tb_detail_po_nk.qty`
- `tb_detail_po_nk.hrg_satuan`
- `tb_detail_po_nk.total_harga`

Nilai nyata dari detail PO NK:

- `tb_detail_po_nk.hrg_nyata`
- `tb_detail_po_nk.total_nyata`

Nilai nyata dari realisasi penerimaan:

- `tb_penerimaan_po_nk_detail.id_det_po_nk`
- `tb_penerimaan_po_nk_detail.qty_real`
- `tb_penerimaan_po_nk_detail.harga_satuan_real`
- `tb_penerimaan_po_nk_detail.total_real`

## Perubahan Database

Tidak ada:

- Tidak ada tabel baru.
- Tidak ada kolom baru.
- Tidak ada perubahan index.
- Tidak ada perubahan data master.
- Tidak ada migration SQL baru.

## Catatan Query

Join realisasi dilakukan dengan:

- `tb_penerimaan_po_nk_detail.id_det_po_nk = tb_detail_po_nk.id_det_po_nk`

Jika tabel realisasi belum tersedia di environment tertentu, laporan tetap berjalan memakai nilai dari `tb_detail_po_nk`.
