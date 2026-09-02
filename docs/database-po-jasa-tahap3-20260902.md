# Dokumentasi Database - PO Jasa Tahap 3

Tanggal: 2026-09-02

## Modul

- SQL migration: `docs/database/2026-09-02-po-jasa-tahap3.sql`

## Perubahan Struktur Database

Tahap 3 menambahkan dua tabel baru:

- `tbpo_jasa_payment`
- `tbpo_jasa_evaluation`

Tidak ada perubahan pada tabel PO Non Komersil.

## Tabel `tbpo_jasa_payment`

Menyimpan payment tracking vendor.

Kolom utama:

- `kd_po_jasa`
- `tgl_invoice`
- `jatuh_tempo`
- `no_invoice`
- `nominal_tagihan`
- `nominal_bayar`
- `status_bayar`
- `catatan_payment`
- `created_by`, `created_name`

## Tabel `tbpo_jasa_evaluation`

Menyimpan evaluasi vendor untuk project yang sudah `DONE`.

Kolom utama:

- `kd_po_jasa`
- `kd_vendor_jasa`
- `kualitas_score`
- `ketepatan_waktu_score`
- `biaya_score`
- `total_score`
- `catatan_evaluasi`
- `evaluated_by`, `evaluated_name`

Tabel ini memiliki unique key pada `kd_po_jasa` agar satu project hanya memiliki satu evaluasi aktif. Jika evaluasi disimpan ulang, data diperbarui.

## Cara Menjalankan Migration

```powershell
Get-Content docs\database\2026-09-02-po-jasa-tahap3.sql | C:\xampp\mysql\bin\mysql.exe -u root kiucoid_karismaerp_local
```

## Rollback Struktur

Rollback hanya boleh dilakukan bila data Tahap 3 belum diperlukan.

```sql
DROP TABLE IF EXISTS tbpo_jasa_evaluation;
DROP TABLE IF EXISTS tbpo_jasa_payment;
```

## Dampak Data

- Data payment tracking tersimpan di `tbpo_jasa_payment`.
- Data evaluasi vendor tersimpan di `tbpo_jasa_evaluation`.
- Report histori project done membaca data dari tabel PO Jasa Tahap 1, 2, dan 3.
- Tidak ada mutasi stok barang.
- Tidak ada jurnal/accounting otomatis.

## Validasi Lokal

Migration sudah dijalankan pada database lokal `kiucoid_karismaerp_local` dan berhasil dijalankan ulang.

Tabel yang terverifikasi:

- `tbpo_jasa_payment`
- `tbpo_jasa_evaluation`
