# Dokumentasi Database Stock Non Komersil

Tanggal dokumentasi: 2 Juli 2026

## File Migrasi

- `db/2026/stocknonkomersil_defaults_indexes_20260702.sql`

## Tujuan Migrasi

Migrasi ini disiapkan untuk production agar modul `stocknonkomersil` memiliki default data dan index pendukung performa.

## Perubahan Database

1. Memastikan kolom `tb_barang_nk.minimum_stock` tersedia.
2. Jika kolom sudah ada, struktur kolom dinormalisasi menjadi:
   - `DECIMAL(18,2)`
   - `NOT NULL`
   - `DEFAULT 0`
3. Data `minimum_stock` yang `NULL` dinormalisasi menjadi `0`.
4. Menambahkan index idempotent:
   - `tb_barang_nk.idx_barang_nk_kd_barang` pada `kd_barang`
   - `tb_barang_nk.idx_barang_nk_kd_lokasi` pada `kd_lokasi`
   - `tb_transaksi.idx_transaksi_barang_akun` pada `kd_barang`, `kd_akun`
   - `tb_transaksi.idx_transaksi_barang_tanggal` pada `kd_barang`, `tgl_transaksi(10)`

## Catatan Saran PO

`Saran PO` pada route `stocknonkomersil` bukan kolom fisik database. Nilai ini dihitung aplikasi dari:

- `minimum_stock`
- `qty_ready`

Default `Saran PO` dibuat menjadi `0` di layer aplikasi selama `minimum_stock` masih `0`. Keputusan ini menjaga satu sumber kebenaran: user cukup mengatur `minimum_stock`, lalu sistem menghitung saran PO dari data stock berjalan.

## Cara Jalankan di Production

1. Backup database production terlebih dahulu.
2. Upload file `db/2026/stocknonkomersil_defaults_indexes_20260702.sql`.
3. Jalankan SQL pada database production yang aktif.
4. Setelah migrasi, cek struktur:
   - `SHOW COLUMNS FROM tb_barang_nk LIKE 'minimum_stock';`
   - `SHOW INDEX FROM tb_barang_nk;`
   - `SHOW INDEX FROM tb_transaksi;`
5. Buka route `stocknonkomersil` dan pastikan tabel/filter memuat data.

## Perintah Lokal yang Dipakai

```powershell
Get-Content db\2026\stocknonkomersil_defaults_indexes_20260702.sql | C:\xampp\mysql\bin\mysql.exe -uroot kiucoid_po
```

## Verifikasi Lokal

- Migrasi berhasil dijalankan ulang secara idempotent di database lokal `kiucoid_po`.
- Index berhasil terbentuk:
  - `idx_barang_nk_kd_barang`
  - `idx_barang_nk_kd_lokasi`
  - `idx_transaksi_barang_akun`
  - `idx_transaksi_barang_tanggal`
- Karena `tb_transaksi.tgl_transaksi` bertipe `text`, index tanggal memakai prefix `tgl_transaksi(10)` agar kompatibel dengan batas panjang key MySQL/MariaDB.

