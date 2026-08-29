# Database - Update isi dan kemasan tbpo_barang dari Excel

Tanggal: 2026-08-20
Database: `kiucoid_karismaerp_local`
Tabel: `tbpo_barang`

## Status Perubahan Database

Perubahan yang dilakukan adalah data update, bukan perubahan struktur tabel.

Tidak ada:

- `ALTER TABLE`
- `CREATE TABLE` permanen
- `DROP TABLE`
- perubahan index
- perubahan tipe data
- perubahan stored procedure atau trigger

Kolom yang diubah:

```text
tbpo_barang.isi
tbpo_barang.kemasan
```

Key update:

```text
tbpo_barang.kode_barang
```

## Struktur Kolom Terkait

Kolom live database:

```text
kode_barang varchar(25) NOT NULL
isi         decimal(15,2) NOT NULL DEFAULT 0.00
kemasan     decimal(15,2) NOT NULL DEFAULT 0.00
```

## Ringkasan Eksekusi

Sumber data Excel:

```text
tbpo_barang_csv.xlsx
Sheet1
Header baris 2
```

Jumlah data:

```text
Baris Excel valid       : 7.962
Baris tbpo_barang live  : 7.962
Kode match              : 7.962
Kode missing            : 0
Baris berubah           : 2.845
Baris sudah sama        : 5.117
```

Hasil setelah commit:

```text
remaining_diff_rows : 0
will_change_rows    : 0
```

## File Backup dan Rollback

Backup penuh tabel sebelum update:

```text
database/backups/tbpo_barang_before_isi_kemasan_20260820_1530.sql
```

Audit nilai Excel vs database sebelum update:

```text
database/backups/tbpo_barang_isi_kemasan_update_source_20260820.tsv
```

SQL rollback nilai `isi` dan `kemasan` ke kondisi sebelum update:

```text
database/sql/tbpo_barang_rollback_isi_kemasan_20260820.sql
```

## SQL Update

File update yang dijalankan:

```text
database/sql/tbpo_barang_update_isi_kemasan_20260820.sql
```

Metode update:

1. Membuat temporary table `_tmp_tbpo_barang_isi_kemasan_20260820`.
2. Memasukkan 7.962 baris dari Excel ke temporary table.
3. Join temporary table ke `tbpo_barang` berdasarkan `kode_barang`.
4. Update hanya baris yang nilai `isi` atau `kemasan` berbeda.
5. Commit transaksi setelah `remaining_diff_rows = 0`.

## Sample Validasi

Sample hasil setelah update:

```text
AABAC01  isi 10.00  kemasan 1000.00
AABAC07  isi 50.00  kemasan 100.00
AABAC08  isi 1.00   kemasan 100.00
ZZZENT01  isi 1.00   kemasan 1000.00
QPUPU160  isi 1.00   kemasan 10000.00
QCHAM04   isi 14.00  kemasan 1000.00
QSPON081  isi 10.00  kemasan 1000.00
QROUN011  isi 12.00  kemasan 1000.00
```

## Perintah Rollback

Jika harus kembali ke nilai sebelum update:

```powershell
Get-Content database\sql\tbpo_barang_rollback_isi_kemasan_20260820.sql | C:\xampp\mysql\bin\mysql.exe -uroot --table
```

Jika perlu restore penuh tabel dari backup dump:

```powershell
Get-Content database\backups\tbpo_barang_before_isi_kemasan_20260820_1530.sql | C:\xampp\mysql\bin\mysql.exe -uroot kiucoid_karismaerp_local
```

