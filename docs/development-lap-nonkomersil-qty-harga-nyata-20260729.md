# Development - Lap Nonkomersil Qty Nyata dan Harga Nyata

## Ringkasan

Route `lap_nonkomersil` ditambahkan informasi pembanding antara nilai PO dan nilai nyata pada laporan cost PO NK per PIC.

Endpoint terkait:

- Route: `lap_nonkomersil`
- Route export: `export_cost_pic_ponk`
- Controller: `application/controllers/laporan/C_Laporan.php`
- Model: `application/models/Laporan/M_Laporanp.php`
- View: `application/views/content/laporan/lap_cost_pic_ponk.php`

## Perubahan Aplikasi

1. Menambahkan field `total_qty_nyata` dan `total_cost_nyata` pada query ringkasan `M_Laporanp::getcostpicponk()`.
2. Mengembalikan field `qty`, `hrg_satuan`, dan `total_harga` pada detail sebagai nilai PO asli.
3. Menambahkan field `qty_nyata`, `hrg_nyata`, dan `total_nyata` pada query detail `M_Laporanp::getdetailcostpicponk()`.
4. Menambahkan kartu `Total Cost Nyata` pada halaman laporan.
5. Menambahkan kolom `Total Qty Nyata` dan `Total Cost Nyata` pada tabel ringkasan.
6. Menambahkan kolom `Qty Nyata`, `Harga Nyata`, dan `Total Nyata` pada tabel detail.
7. Menyesuaikan export Excel `export_cost_pic_ponk` agar kolom nyata ikut terunduh.

## Sumber Nilai Nyata

Prioritas nilai nyata:

1. Jika tabel `tb_penerimaan_po_nk_detail` tersedia dan mempunyai baris sesuai `id_det_po_nk`, sistem memakai:
   - `qty_real`
   - `harga_satuan_real`
   - `total_real`
2. Jika belum ada baris realisasi penerimaan, harga dan total nyata fallback ke field existing di `tb_detail_po_nk`:
   - `hrg_nyata`
   - `total_nyata`
3. Jika field nyata di `tb_detail_po_nk` masih `0` atau tidak tersedia, sistem fallback ke nilai PO:
   - `qty`
   - `hrg_satuan`
   - `total_harga`

## Batasan Scope

Perubahan hanya membaca data existing. Tidak ada perubahan proses input PO, proses penerimaan, approval, status PO, atau posting stock.
