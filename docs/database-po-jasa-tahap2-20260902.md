# Dokumentasi Database - PO Jasa Tahap 2

Tanggal: 2026-09-02

## Modul

- SQL migration: `docs/database/2026-09-02-po-jasa-tahap2.sql`
- Tabel existing Tahap 1: `tbpo_jasa_request`

## Perubahan Struktur Database

Tahap 2 menambahkan tabel operasional untuk progress, dokumen, biaya, dan BAST.

Tabel baru:

- `tbpo_jasa_progress`
- `tbpo_jasa_file`
- `tbpo_jasa_biaya`
- `tbpo_jasa_bast`

Kolom baru pada `tbpo_jasa_request`:

- `completed_at`: waktu saat project diselesaikan melalui BAST.

## Tabel `tbpo_jasa_progress`

Menyimpan histori progress vendor.

Kolom utama:

- `kd_po_jasa`
- `tgl_progress`
- `milestone`
- `progress_persen`
- `status_progress`
- `catatan`
- `created_by`, `created_name`

## Tabel `tbpo_jasa_file`

Menyimpan metadata dokumen project jasa. File fisik disimpan di folder `images/pojasa/`.

Kolom utama:

- `kd_po_jasa`
- `jenis_dokumen`
- `keterangan`
- `file_name`
- `file_original`
- `file_ext`
- `file_size`
- `uploaded_by`, `uploaded_name`

## Tabel `tbpo_jasa_biaya`

Menyimpan audit biaya estimasi dan realisasi.

Kolom utama:

- `kd_po_jasa`
- `tgl_biaya`
- `jenis_biaya`
- `deskripsi_biaya`
- `nominal_estimasi`
- `nominal_realisasi`
- `selisih`
- `no_invoice_vendor`

## Tabel `tbpo_jasa_bast`

Menyimpan penyelesaian pekerjaan jasa.

Kolom utama:

- `kd_po_jasa`
- `no_bast`
- `tgl_bast`
- `penerima_pekerjaan`
- `catatan_bast`

Tabel ini memiliki unique key pada `kd_po_jasa` agar satu PO Jasa hanya memiliki satu BAST completion.

## Cara Menjalankan Migration

```powershell
Get-Content docs\database\2026-09-02-po-jasa-tahap2.sql | C:\xampp\mysql\bin\mysql.exe -u root kiucoid_karismaerp_local
```

## Rollback Struktur

Rollback hanya boleh dilakukan bila data Tahap 2 belum diperlukan.

```sql
DROP TABLE IF EXISTS tbpo_jasa_bast;
DROP TABLE IF EXISTS tbpo_jasa_biaya;
DROP TABLE IF EXISTS tbpo_jasa_file;
DROP TABLE IF EXISTS tbpo_jasa_progress;
ALTER TABLE tbpo_jasa_request DROP COLUMN completed_at;
```

## Dampak Data

- Data progress, dokumen, realisasi biaya, dan BAST tersimpan terpisah.
- Status `tbpo_jasa_request.status` dapat berubah menjadi `PROGRESS VENDOR` atau `DONE`.
- Tidak ada perubahan pada tabel PO Non Komersil.
- Tidak ada mutasi stok barang.

## Validasi Lokal

Migration sudah dijalankan pada database lokal `kiucoid_karismaerp_local`.

Tabel dan kolom yang terverifikasi:

- `tbpo_jasa_progress`
- `tbpo_jasa_file`
- `tbpo_jasa_biaya`
- `tbpo_jasa_bast`
- `tbpo_jasa_request.completed_at`
