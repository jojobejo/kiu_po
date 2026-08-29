# Development Aplikasi - Update isi dan kemasan tbpo_barang dari Excel

Tanggal: 2026-08-20
Module: master barang PO
Database aktif: `kiucoid_karismaerp_local`

## Latar Belakang

File Excel `tbpo_barang_csv.xlsx` digunakan sebagai sumber nilai baru untuk kolom:

- `isi`
- `kemasan`

Update dilakukan berdasarkan key bisnis:

```text
tbpo_barang.kode_barang = Excel.kode_barang
```

Tidak ada perubahan controller, model, view, route, atau library aplikasi.

## File Sumber

File input yang digunakan:

```text
tbpo_barang_compare.sql
tbpo_barang_csv.xlsx
```

Struktur Excel yang dibaca:

- Sheet: `Sheet1`
- Header: baris 2
- Kolom data: `kode_barang`, `isi`, `kemasan`
- Total baris valid: 7.962
- Duplikasi `kode_barang`: 0
- Nilai invalid: 0

## Artefak Development

File SQL dan audit yang dibuat:

```text
database/sql/tbpo_barang_update_isi_kemasan_20260820_precheck.sql
database/sql/tbpo_barang_update_isi_kemasan_20260820.sql
database/sql/tbpo_barang_rollback_isi_kemasan_20260820.sql
database/backups/tbpo_barang_isi_kemasan_update_source_20260820.tsv
database/backups/tbpo_barang_before_isi_kemasan_20260820_1530.sql
```

## Proses Teknis

1. Membaca konfigurasi database CodeIgniter dari `application/config/database.php`.
2. Memastikan database lokal aktif adalah `kiucoid_karismaerp_local`.
3. Membaca struktur `tbpo_barang` dari dump dan database live.
4. Memvalidasi Excel:
   - header ditemukan pada baris 2
   - semua baris memiliki `kode_barang`
   - tidak ada `kode_barang` duplikat
   - `isi` dan `kemasan` valid sebagai decimal
5. Membuat backup penuh tabel sebelum update.
6. Membuat SQL precheck, update, dan rollback.
7. Menjalankan update dalam transaksi MySQL.
8. Menjalankan verifikasi ulang setelah commit.

## Cara Menjalankan Ulang

Precheck:

```powershell
Get-Content database\sql\tbpo_barang_update_isi_kemasan_20260820_precheck.sql | C:\xampp\mysql\bin\mysql.exe -uroot --table
```

Update:

```powershell
Get-Content database\sql\tbpo_barang_update_isi_kemasan_20260820.sql | C:\xampp\mysql\bin\mysql.exe -uroot --table
```

Rollback ke nilai sebelum update:

```powershell
Get-Content database\sql\tbpo_barang_rollback_isi_kemasan_20260820.sql | C:\xampp\mysql\bin\mysql.exe -uroot --table
```

## Validasi Hasil

Hasil precheck sebelum update:

```text
excel_rows       : 7.962
matched_rows     : 7.962
missing_rows     : 0
will_change_rows : 2.845
```

Hasil update:

```text
updated_rows        : 2.845
remaining_diff_rows : 0
```

Hasil precheck ulang setelah update:

```text
excel_rows       : 7.962
matched_rows     : 7.962
missing_rows     : 0
will_change_rows : 0
```

