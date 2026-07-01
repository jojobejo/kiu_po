# Dokumentasi Perubahan Database

Tanggal perubahan database: 1 Juli 2026

## Tujuan Perubahan

Perubahan database hari ini dibuat agar aplikasi bisa menyimpan:

- harga input asli dari user,
- harga dasar sebelum PPN,
- keterangan apakah item memakai `Include PPN` atau `Exclude PPN`.

Dengan begitu, perhitungan aplikasi menjadi lebih konsisten di halaman input PO, detail PO, revisi, dan print.

## File SQL Yang Perlu Dijalankan

Urutan yang disarankan:

1. `db/2026/add_keterangan_harga_ppn_po_20260630.sql`
2. `database/archive/db/2026/add_tmp_item_ppn_calculation_fields_20260701.sql`
3. `database/archive/db/2026/add_detail_po_ppn_calculation_fields_20260701.sql`

## Perubahan Tabel

### 1. Tabel `tb_tmp_item`

Tabel ini dipakai saat item masih berada di daftar order sementara.

Kolom baru:

- `harga_satuan_exclude`
  Menyimpan harga satuan sebelum PPN.

- `harga_satuan_kecil_exclude`
  Menyimpan harga satuan kecil sebelum PPN.

- `keterangan_harga_ppn`
  Menyimpan mode harga item:
  - `include`
  - `exclude`

Backfill data:

- Jika `harga_satuan_exclude` masih `0`, sistem mengisi dari `harga_satuan`.
- Jika `harga_satuan_kecil_exclude` masih `0`, sistem mengisi dari `harga_satuan_kecil`.

### 2. Tabel `tb_detail_po`

Tabel ini dipakai saat PO sudah direkam sebagai detail permanen.

Kolom baru:

- `harga_satuan_exclude`
  Menyimpan harga satuan sebelum PPN pada detail PO.

- `harga_satuan_kecil_exclude`
  Menyimpan harga satuan kecil sebelum PPN pada detail PO.

- `keterangan_harga_ppn`
  Menyimpan mode harga item pada detail PO.

Backfill data:

- Jika `harga_satuan_exclude` masih `0`, sistem mengisi dari `hrg_satuan`.
- Jika `harga_satuan_kecil_exclude` masih `0`, sistem mengisi dari `harga_satuan_kecil`.

## Fungsi Masing-Masing Script

### `add_keterangan_harga_ppn_po_20260630.sql`

Menambahkan kolom `keterangan_harga_ppn` ke:

- `tb_tmp_item`
- `tb_detail_po`

### `add_tmp_item_ppn_calculation_fields_20260701.sql`

Menambahkan kolom:

- `harga_satuan_exclude`
- `harga_satuan_kecil_exclude`
- `keterangan_harga_ppn`

ke tabel `tb_tmp_item`.

### `add_detail_po_ppn_calculation_fields_20260701.sql`

Menambahkan kolom:

- `harga_satuan_exclude`
- `harga_satuan_kecil_exclude`
- `keterangan_harga_ppn`

ke tabel `tb_detail_po`.

## Catatan Teknis Penting

- Script dibuat dengan pengecekan `INFORMATION_SCHEMA.COLUMNS`.
- Artinya, script relatif aman dijalankan ulang karena akan mengecek dulu apakah kolom sudah ada.
- Script menggunakan `DATABASE()` sehingga dijalankan pada database yang sedang aktif.

## Dampak Ke Aplikasi

Setelah script database dijalankan:

- aplikasi bisa menyimpan mode harga per item,
- aplikasi bisa menyimpan harga dasar exclude secara permanen,
- revisi dan detail PO bisa membaca dasar perhitungan yang sama,
- hasil print include dan exclude menjadi lebih konsisten.

## Saran Sebelum Deploy

- Backup database terlebih dahulu.
- Jalankan script di waktu transaksi rendah.
- Setelah selesai, test:
  - input PO mode `Include PPN`,
  - input PO mode `Exclude PPN`,
  - revisi item,
  - halaman `detailPO`,
  - print PO internal dan supplier.
