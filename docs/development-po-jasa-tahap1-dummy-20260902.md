# Development Aplikasi - Data Dummy PO Jasa Tahap 1

Tanggal: 2026-09-02

## Modul

- Route utama: `pononkomersiljasa`
- SQL seed: `docs/database/2026-09-02-po-jasa-tahap1-dummy.sql`
- Tabel target: `tbpo_jasa_vendor`, `tbpo_jasa_request`, `tbpo_jasa_request_detail`, `tbpo_jasa_note`

## Tujuan

Menambahkan data dummy agar hasil development PO Jasa Tahap 1 dapat diuji melalui UI tanpa membuat data manual satu per satu.

## Data Dummy

Vendor dummy:

- `[DUMMY] Hostinger Indonesia`
- `[DUMMY] Paramita Ban Service`
- `[DUMMY] Wahyu CCTV Maintenance`
- `[DUMMY] Udy Teknik Genset`
- `[DUMMY] Untung Bangun Renovasi`

Request dummy:

- `PJASA0209260001`: status `ON PROGRESS`
- `PJASA0209260002`: status `ACC-KADEP`
- `PJASA0209260003`: status `ACC DIREKTUR`
- `PJASA0209260004`: status `SPK TERBIT`
- `PJASA0209260005`: status `REJECT`

## Cara Penggunaan

1. Pastikan migration Tahap 1 sudah dijalankan.
2. Login ke aplikasi.
3. Buka menu `PO Jasa`.
4. Lihat tab `List Request` untuk mengecek variasi status.
5. Buka detail masing-masing request untuk menguji tampilan scope dan audit approval.
6. Login dengan level akses yang sesuai untuk menguji approval atau generate SPK.

## Catatan Teknis

- Seed dibuat idempotent untuk request/detail/note dummy: data dengan kode `PJASA0209260001` sampai `PJASA0209260005` dihapus dahulu lalu dibuat ulang.
- Master vendor memakai `ON DUPLICATE KEY UPDATE`, sehingga seed bisa dijalankan ulang.
- Data dummy diberi label `[DUMMY]` agar mudah dibedakan dari data operasional.
- Tidak ada perubahan kode aplikasi pada penambahan data dummy ini.
- Folder `apps_production` tidak diubah.
