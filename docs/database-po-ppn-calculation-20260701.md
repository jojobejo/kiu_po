# Dokumentasi Database - Perubahan PO PPN 2026-07-01

## Ringkasan

Perubahan database hari ini menambahkan field untuk menyimpan basis perhitungan harga PPN pada temporary item PO dan detail PO. Tujuannya adalah memisahkan harga input user dari harga exclude/DPP yang dipakai perhitungan internal.

## File SQL Terkait

Migration yang sudah ada dari pekerjaan sebelumnya hari ini:

- `db/2026/add_keterangan_harga_ppn_po_20260630.sql`

Migration baru pada pekerjaan aktif:

- `database/archive/db/2026/add_tmp_item_ppn_calculation_fields_20260701.sql`
- `database/archive/db/2026/add_detail_po_ppn_calculation_fields_20260701.sql`

## Tabel Yang Berubah

### 1. `tbpo_tmp_item`

File migration:

- `database/archive/db/2026/add_tmp_item_ppn_calculation_fields_20260701.sql`

Kolom yang ditambahkan:

| Kolom | Tipe | Default | Fungsi |
| --- | --- | --- | --- |
| `harga_satuan_exclude` | `DECIMAL(18,4)` | `0` | Menyimpan harga satuan exclude/DPP. Untuk mode Include, nilai ini hasil konversi dari harga input. |
| `harga_satuan_kecil_exclude` | `DECIMAL(18,4)` | `0` | Menyimpan harga satuan kecil exclude/DPP. Dipakai untuk diskon dan total berbasis qty kecil. |
| `keterangan_harga_ppn` | `VARCHAR(20)` | `''` | Menyimpan mode harga item: `include` atau `exclude`. |

Backfill data lama:

- `harga_satuan_exclude` diisi dari `harga_satuan` jika masih `0`.
- `harga_satuan_kecil_exclude` diisi dari `harga_satuan_kecil` jika masih `0`.

### 2. `tbpo_detail_po`

File migration:

- `database/archive/db/2026/add_detail_po_ppn_calculation_fields_20260701.sql`

Kolom yang ditambahkan:

| Kolom | Tipe | Default | Fungsi |
| --- | --- | --- | --- |
| `harga_satuan_exclude` | `DECIMAL(18,4)` | `0` | Menyimpan harga satuan exclude/DPP pada detail PO permanen. |
| `harga_satuan_kecil_exclude` | `DECIMAL(18,4)` | `0` | Menyimpan harga satuan kecil exclude/DPP pada detail PO permanen. |
| `keterangan_harga_ppn` | `VARCHAR(20)` | `''` | Menyimpan mode harga item pada detail PO: `include` atau `exclude`. |

Backfill data lama:

- `harga_satuan_exclude` diisi dari `hrg_satuan` jika masih `0`.
- `harga_satuan_kecil_exclude` diisi dari `harga_satuan_kecil` jika masih `0`.

## Urutan Eksekusi Migration

Jalankan migration dengan urutan berikut:

1. `db/2026/add_keterangan_harga_ppn_po_20260630.sql`
2. `database/archive/db/2026/add_tmp_item_ppn_calculation_fields_20260701.sql`
3. `database/archive/db/2026/add_detail_po_ppn_calculation_fields_20260701.sql`

Catatan:

- Migration memakai `INFORMATION_SCHEMA.COLUMNS`, sehingga aman dijalankan ulang.
- Jika kolom sudah ada, script akan mengembalikan pesan bahwa kolom sudah tersedia.
- Jalankan pada database aktif aplikasi, karena script memakai `DATABASE()` sebagai schema target.

## Contoh Command Import Di Windows/XAMPP

Sesuaikan nama database, user, dan password dengan environment yang dipakai.

```powershell
Get-Content "db\2026\add_keterangan_harga_ppn_po_20260630.sql" | C:\xampp\mysql\bin\mysql.exe -u root kiucoid_po
Get-Content "database\archive\db\2026\add_tmp_item_ppn_calculation_fields_20260701.sql" | C:\xampp\mysql\bin\mysql.exe -u root kiucoid_po
Get-Content "database\archive\db\2026\add_detail_po_ppn_calculation_fields_20260701.sql" | C:\xampp\mysql\bin\mysql.exe -u root kiucoid_po
```

Jika MySQL memakai password:

```powershell
Get-Content "database\archive\db\2026\add_tmp_item_ppn_calculation_fields_20260701.sql" | C:\xampp\mysql\bin\mysql.exe -u root -p kiucoid_po
Get-Content "database\archive\db\2026\add_detail_po_ppn_calculation_fields_20260701.sql" | C:\xampp\mysql\bin\mysql.exe -u root -p kiucoid_po
```

## Query Verifikasi Kolom

```sql
SELECT TABLE_NAME, COLUMN_NAME, COLUMN_TYPE, COLUMN_DEFAULT
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME IN ('tbpo_tmp_item', 'tbpo_detail_po')
  AND COLUMN_NAME IN (
    'harga_satuan_exclude',
    'harga_satuan_kecil_exclude',
    'keterangan_harga_ppn'
  )
ORDER BY TABLE_NAME, COLUMN_NAME;
```

## Query Verifikasi Data

Temporary item:

```sql
SELECT id_tmp, kode_barang, harga_satuan, harga_satuan_exclude,
       harga_satuan_kecil, harga_satuan_kecil_exclude,
       keterangan_harga_ppn
FROM tbpo_tmp_item
ORDER BY id_tmp DESC
LIMIT 20;
```

Detail PO:

```sql
SELECT id_det_po, kd_po, kd_barang, hrg_satuan, harga_satuan_exclude,
       harga_satuan_kecil, harga_satuan_kecil_exclude,
       keterangan_harga_ppn
FROM tbpo_detail_po
ORDER BY id_det_po DESC
LIMIT 20;
```

## Relasi Dengan Logic Aplikasi

- `tbpo_tmp_item` dipakai saat user menyusun list item PO.
- `tbpo_detail_po` dipakai setelah PO menjadi detail permanen atau masuk proses approval/status.
- Saat finalisasi, aplikasi membawa nilai PPN dari `tbpo_tmp_item` ke `tbpo_detail_po`.
- Field `harga_satuan_exclude` dan `harga_satuan_kecil_exclude` menjadi sumber nilai DPP untuk perhitungan diskon dan total.
- Field `keterangan_harga_ppn` menjadi penentu tampilan tab Include/Exclude dan validasi konsistensi mode harga.

## Catatan Deploy

- Backup database sebelum menjalankan migration di production.
- Jalankan migration pada jam rendah transaksi karena tabel PO dipakai operasional.
- Setelah migration, lakukan test input PO baru dengan mode Include dan Exclude.
- Pastikan user purchasing tidak mencampur mode harga dalam satu PO.
- Jika ada data lama tanpa `keterangan_harga_ppn`, tampilan aplikasi akan memakai fallback Exclude PPN.

## Rollback Manual

Rollback tidak disarankan jika aplikasi sudah memakai field baru. Jika benar-benar harus rollback sebelum data production dipakai, kolom dapat dihapus dengan risiko kehilangan data kalkulasi PPN:

```sql
ALTER TABLE tbpo_tmp_item
  DROP COLUMN harga_satuan_exclude,
  DROP COLUMN harga_satuan_kecil_exclude,
  DROP COLUMN keterangan_harga_ppn;

ALTER TABLE tbpo_detail_po
  DROP COLUMN harga_satuan_exclude,
  DROP COLUMN harga_satuan_kecil_exclude,
  DROP COLUMN keterangan_harga_ppn;
```

Gunakan rollback hanya setelah backup tersedia dan aplikasi sudah dikembalikan ke versi sebelum perubahan PPN.
