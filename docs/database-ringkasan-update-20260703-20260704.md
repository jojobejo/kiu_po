# Dokumentasi Database - Ringkasan Update 3-4 Juli 2026

Tanggal dokumentasi: 2026-07-04

## Cakupan

Dokumen ini menjelaskan dampak database dari update development tanggal 3 Juli 2026 dan 4 Juli 2026.

## 1. Update 3 Juli 2026

### A. Kompatibilitas PHP 8.3 CodeIgniter

Tidak ada perubahan struktur database.

Tidak ada perubahan pada:

- Tabel
- Kolom
- Index
- Constraint
- Stored procedure
- View database
- Data existing

Catatan:

- Perubahan hanya berada di file core CodeIgniter.
- Deklarasi properti `$failover` pada driver database hanya untuk kompatibilitas PHP 8.3.
- Koneksi database tetap mengikuti `application/config/database.php`.

### B. Edit Tujuan Pembelian PO Non Komersil

Tidak ada perubahan struktur database.

Operasi data tetap memakai tabel existing:

- Tabel: `tbpo_po_nk`
- Kolom yang diperbarui: `tj_pembelian`
- Parameter kunci: `kd_po_req`

Representasi operasi:

```sql
UPDATE tbpo_po_nk
SET tj_pembelian = :tujuan_pembelian
WHERE kd_po_req = :kd_po_req;
```

Audit note tetap memakai mekanisme existing dengan catatan:

```text
EDIT DATA TUJUAN PEMBELIAN
```

## 2. Update 4 Juli 2026

### A. Perhitungan Print PO Internal Include/Exclude PPN

Tidak ada perubahan struktur database.

Perubahan hanya berada pada layer view/helper untuk membaca dan menghitung data yang sudah tersedia.

Field data yang dipakai:

- `harga_satuan`
- `harga_satuan_kecil`
- `harga_satuan_exclude`
- `harga_satuan_kecil_exclude`
- `keterangan_harga_ppn`
- `tax`
- Data diskon PO existing

Tidak ada tabel baru, kolom baru, index baru, atau migrasi SQL yang perlu dijalankan.

### B. Konfigurasi Database Lokal

Konfigurasi database lokal pada `application/config/database.php` diarahkan dari:

```php
'database' => 'kiucoid_po'
```

menjadi:

```php
'database' => 'kiucoid_kiupo'
```

Catatan penting:

- Ini adalah perubahan target koneksi database, bukan perubahan struktur database.
- Pastikan database `kiucoid_kiupo` tersedia pada environment lokal/development.
- Untuk production, sesuaikan kembali konfigurasi database dengan database production yang benar.

## Kesimpulan Database

Update 3-4 Juli 2026 tidak membutuhkan query migrasi struktur.

Yang perlu diperhatikan hanya:

- Database lokal yang digunakan aplikasi.
- Ketersediaan data PO, item, diskon, dan field PPN existing.
- Konsistensi data `keterangan_harga_ppn` agar perhitungan Include/Exclude PPN akurat.

