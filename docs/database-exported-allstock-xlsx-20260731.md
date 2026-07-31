# Database - Perbaikan Export Stock Non Komersil

Tanggal: 2026-07-31

## Dampak Database

Tidak ada perubahan struktur database.

## Objek Data Yang Dibaca

Export membaca data dari model `M_Stocknonkomersil::v_stock()` agar sama dengan route `stocknonkomersil`.

Query tersebut memakai master `tbpo_barang_nk`, satuan `tbpo_satuan`, lokasi `tbpo_barang_nk_lokasi`, dan agregasi transaksi `tbpo_transaksi`.

Perhitungan stock mengikuti query terbaru:

- stock masuk: `kd_akun` `11511` dan `11513`
- stock keluar: `kd_akun` `11512` dan `11514`
- `qty_ready` = total stock masuk - total stock keluar

Kolom yang dipakai oleh file export:

- `kode_barangs`
- `kode_barang`
- `nama_barang`
- `deskripsi`
- `qty_ready`
- `satuan`
- `nama_lokasi`

## Migrasi

Tidak diperlukan script migrasi database.

## Catatan Verifikasi

- Tidak ada perubahan struktur database.
- Tidak ada perubahan view/table `v_stockbarangnk`.
- Perbaikan memakai query stock terbaru yang sudah berjalan pada model `M_Stocknonkomersil`.
