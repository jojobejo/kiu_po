# Dokumentasi Database - Data Dummy PO Jasa Tahap 1

Tanggal: 2026-09-02

## Modul

- SQL seed: `docs/database/2026-09-02-po-jasa-tahap1-dummy.sql`
- Database lokal: `kiucoid_karismaerp_local`

## Perubahan Data

Seed menambahkan data dummy untuk menguji modul PO Jasa Tahap 1.

Data yang dibuat:

- 5 vendor jasa dummy.
- 5 request PO Jasa dummy.
- 8 detail scope pekerjaan.
- 12 audit note approval.

## Tabel Yang Terpengaruh

- `tbpo_jasa_vendor`
- `tbpo_jasa_request`
- `tbpo_jasa_request_detail`
- `tbpo_jasa_note`

Tidak ada perubahan struktur database.

Tidak ada perubahan pada tabel PO Non Komersil existing dan tidak ada mutasi stok.

## Cara Menjalankan Seed

```powershell
Get-Content docs\database\2026-09-02-po-jasa-tahap1-dummy.sql | C:\xampp\mysql\bin\mysql.exe -u root kiucoid_karismaerp_local
```

## Rollback Data Dummy

```sql
DELETE FROM tbpo_jasa_note
WHERE kd_po_jasa IN ('PJASA0209260001', 'PJASA0209260002', 'PJASA0209260003', 'PJASA0209260004', 'PJASA0209260005');

DELETE FROM tbpo_jasa_request_detail
WHERE kd_po_jasa IN ('PJASA0209260001', 'PJASA0209260002', 'PJASA0209260003', 'PJASA0209260004', 'PJASA0209260005');

DELETE FROM tbpo_jasa_request
WHERE kd_po_jasa IN ('PJASA0209260001', 'PJASA0209260002', 'PJASA0209260003', 'PJASA0209260004', 'PJASA0209260005');

DELETE FROM tbpo_jasa_vendor
WHERE kd_vendor_jasa IN ('VJ0001', 'VJ0002', 'VJ0003', 'VJ0004', 'VJ0005');
```

## Dampak Data

- Data dummy muncul pada list PO Jasa.
- Data dummy dapat digunakan untuk UAT approval dan generate SPK.
- Karena memakai kode tetap, seed bisa dijalankan ulang tanpa menggandakan request/detail/note dummy.
