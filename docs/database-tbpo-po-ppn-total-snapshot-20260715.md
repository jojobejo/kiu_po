# Dokumentasi Database - Snapshot Total PPN Header PO 2026-07-15

## Ringkasan

Perubahan database menambahkan lima kolom baru pada tabel `tbpo_po` untuk menyimpan mode harga PPN dan total Include/Exlude PPN di level header PO.

## File Migration

- `db/2026/add_tbpo_po_ppn_total_snapshot_20260715.sql`

## Tabel Yang Berubah

### `tbpo_po`

Kolom baru:

| Kolom | Tipe | Default | Fungsi |
| --- | --- | --- | --- |
| `keterangan_harga_ppn` | `VARCHAR(20)` | `''` | Mode harga PO: `include` atau `exclude`. |
| `total_harga_include` | `DOUBLE` | `0` | Total PO sebelum diskon dalam perspektif Include PPN. |
| `total_harga_exlude` | `DOUBLE` | `0` | Total PO sebelum diskon dalam perspektif Exlude PPN. |
| `total_harga_diskon_include` | `DOUBLE` | `0` | Total PO setelah diskon dalam perspektif Include PPN. |
| `total_harga_diskon_exlude` | `DOUBLE` | `0` | Total PO setelah diskon dalam perspektif Exlude PPN. |

## Cara Eksekusi Migration

Jalankan pada database aktif aplikasi:

```powershell
Get-Content "db\2026\add_tbpo_po_ppn_total_snapshot_20260715.sql" | C:\xampp\mysql\bin\mysql.exe -u root kiucoid_karismaerp_local
```

Jika database target berbeda, ganti nama database di akhir command.

## Query Verifikasi

```sql
SELECT COLUMN_NAME, COLUMN_TYPE, COLUMN_DEFAULT
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME = 'tbpo_po'
  AND COLUMN_NAME IN (
    'keterangan_harga_ppn',
    'total_harga_include',
    'total_harga_exlude',
    'total_harga_diskon_include',
    'total_harga_diskon_exlude'
  )
ORDER BY ORDINAL_POSITION;
```

## Catatan Data Lama

Migration hanya menambahkan kolom dengan default `0` atau kosong. Data lama tidak di-backfill otomatis agar tidak mengubah histori PO tanpa rekalkulasi eksplisit. PO baru dan PO yang mengalami sinkronisasi detail/diskon akan mengisi snapshot melalui aplikasi.

## Rollback Manual

Rollback hanya dilakukan jika aplikasi dikembalikan ke versi sebelum perubahan ini dan data snapshot belum dipakai:

```sql
ALTER TABLE tbpo_po
  DROP COLUMN keterangan_harga_ppn,
  DROP COLUMN total_harga_include,
  DROP COLUMN total_harga_exlude,
  DROP COLUMN total_harga_diskon_include,
  DROP COLUMN total_harga_diskon_exlude;
```
