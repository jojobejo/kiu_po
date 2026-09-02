# Database PO Jasa Vendor Workflow 2026-09-02

## Scope Database

SQL migration:

- `docs/database/2026-09-02-po-jasa-vendor-workflow.sql`

Patch ini melengkapi tabel PO Jasa yang sudah dibuat pada tahap 1 sampai tahap 3.

## Tabel Terdampak

### `tbpo_jasa_vendor`

Kolom tambahan:

- `created_name`: nama user yang membuat vendor atau request vendor.
- `requested_by`: kode user PIC yang mengajukan vendor.
- `requested_name`: nama PIC yang mengajukan vendor.
- `requested_departemen`: departemen PIC pemohon vendor.
- `approved_by`: kode user Purchasing/Admin yang memproses vendor.
- `approved_name`: nama user Purchasing/Admin yang memproses vendor.
- `approved_at`: waktu vendor di-ACC atau diproses.

Nilai `status_vendor` yang digunakan modul:

- `REQUEST`: vendor diajukan PIC dan menunggu ACC.
- `AKTIF`: vendor dapat dipakai pada request pekerjaan jasa.
- `NONAKTIF`: vendor master dinonaktifkan.
- `REJECT`: request vendor ditolak.

### `tbpo_jasa_request`

Kolom tambahan:

- `reviewed_by_purchasing`: kode user Purchasing/Admin terakhir yang menyimpan review scope.
- `reviewed_at_purchasing`: waktu review scope disimpan.
- `submitted_by_purchasing`: kode user Purchasing/Admin yang mengajukan ke direktur.
- `submitted_at_purchasing`: waktu pengajuan ke direktur.

Nilai `status` tambahan yang digunakan modul:

- `REVIEW PURCHASING`
- `PENGAJUAN DIREKTUR`

## Cara Eksekusi Lokal

Jalankan dari PowerShell:

```powershell
Get-Content docs\database\2026-09-02-po-jasa-vendor-workflow.sql | C:\xampp\mysql\bin\mysql.exe -u root kiucoid_karismaerp_local
```

Sesuaikan nama database untuk production atau mirror deployment.

## Validasi Lokal

Pada 2026-09-02, migration tambahan sudah dijalankan di database lokal `kiucoid_karismaerp_local`.

Kolom yang terverifikasi:

- `tbpo_jasa_vendor.created_name`
- `tbpo_jasa_vendor.requested_by`
- `tbpo_jasa_vendor.requested_name`
- `tbpo_jasa_vendor.requested_departemen`
- `tbpo_jasa_vendor.approved_by`
- `tbpo_jasa_vendor.approved_name`
- `tbpo_jasa_vendor.approved_at`
- `tbpo_jasa_request.reviewed_by_purchasing`
- `tbpo_jasa_request.reviewed_at_purchasing`
- `tbpo_jasa_request.submitted_by_purchasing`
- `tbpo_jasa_request.submitted_at_purchasing`

## Rollback

Rollback kolom audit hanya boleh dilakukan bila fitur workflow ini belum dipakai di production.

```sql
ALTER TABLE tbpo_jasa_request
  DROP COLUMN submitted_at_purchasing,
  DROP COLUMN submitted_by_purchasing,
  DROP COLUMN reviewed_at_purchasing,
  DROP COLUMN reviewed_by_purchasing;

ALTER TABLE tbpo_jasa_vendor
  DROP COLUMN approved_at,
  DROP COLUMN approved_name,
  DROP COLUMN approved_by,
  DROP COLUMN requested_departemen,
  DROP COLUMN requested_name,
  DROP COLUMN requested_by,
  DROP COLUMN created_name;
```

## Kesimpulan

Ada perubahan schema database. Patch ini menambah kolom audit vendor request dan review purchasing agar alur PIC, KADEP, Purchasing, dan Direktur dapat ditelusuri secara historis.
