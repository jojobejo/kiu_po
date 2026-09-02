# Development Aplikasi - PO Jasa Tahap 1

Tanggal: 2026-09-02

## Modul

- Route utama: `pononkomersiljasa`
- Controller: `application/controllers/purchaseorder/C_Pojasa.php`
- Model: `application/models/PO/M_Pojasa.php`
- View utama: `application/views/content/po/jasa/index.php`
- View detail: `application/views/content/po/jasa/detail.php`
- View form vendor: `application/views/content/po/jasa/vendor_form.php`
- AJAX: `application/views/content/po/jasa/ajax.php`

## Scope Tahap 1

Tahap 1 memakai opsi Hybrid: domain PO Jasa dibuat terpisah dari PO Non Komersil, tetapi tetap mengikuti pola CodeIgniter, AdminLTE, DataTables, SweetAlert, session user, dan level akses existing.

Fungsi yang dibuat:

- Master Vendor Jasa.
- Request pekerjaan menggunakan vendor.
- Approval berdasarkan level akses.
- Generate nomor PO/SPK Jasa setelah approval Direktur.

Folder `apps_production` tidak diubah.

## Alur Bisnis

1. User membuka menu `PO Jasa`.
2. Purchasing/Admin mengisi Master Vendor Jasa.
3. User membuat Request Pekerjaan Jasa dengan vendor, tanggal target, lokasi, tujuan, dan scope biaya.
4. Status awal request adalah `ON PROGRESS`.
5. KADEP melakukan approval menjadi `ACC-KADEP`, atau memberi status `PENDING`/`REJECT`.
6. Direktur melakukan approval menjadi `ACC DIREKTUR`, atau memberi status `PENDING`/`REJECT`.
7. Purchasing/Admin melakukan Generate PO/SPK.
8. Sistem menerbitkan nomor SPK dan mengubah status menjadi `SPK TERBIT`.

## Status

- `ON PROGRESS`: request baru menunggu approval KADEP.
- `ACC-KADEP`: sudah disetujui KADEP, menunggu Direktur.
- `ACC DIREKTUR`: sudah disetujui Direktur, siap diterbitkan PO/SPK.
- `SPK TERBIT`: nomor PO/SPK Jasa sudah diterbitkan Purchasing/Admin.
- `PENDING`: request dikembalikan untuk ditindaklanjuti.
- `REJECT`: request ditolak.

## Level Akses

- `lv=4`: membuat dan melihat request sendiri.
- `lv=5`: melihat request departemennya dan approval KADEP.
- `lv=3`: approval Direktur.
- `lv=2`: mengelola vendor dan generate PO/SPK.
- `lv=1`: akses admin untuk mengelola vendor dan generate PO/SPK.

## Javascript dan AJAX

AJAX digunakan untuk:

- Simpan Vendor Jasa.
- Update Vendor Jasa.
- Hapus Vendor Jasa.
- Rekam Request Pekerjaan Jasa.
- Approval KADEP/Direktur, Pending, dan Reject.
- Generate PO/SPK Jasa.

Javascript digunakan untuk:

- Menambah/menghapus baris scope pekerjaan secara dinamis.
- Menghitung subtotal scope dan estimasi total secara langsung.
- Konfirmasi aksi penting memakai SweetAlert.
- Menampilkan DataTables pada list request, list vendor, dan audit approval.

## Dampak Javascript dan AJAX

Dampak positif:

- Input scope pekerjaan lebih cepat karena tidak perlu reload halaman setiap menambah baris.
- Estimasi total langsung terlihat sehingga requester dapat mengoreksi biaya sebelum submit.
- Approval dan generate SPK lebih efisien dengan konfirmasi modal.
- Data list tetap familiar karena menggunakan DataTables existing.

Dampak risiko:

- Validasi tetap wajib dilakukan di controller karena Javascript dapat dimanipulasi dari browser.
- Submit AJAX perlu dijaga dari double click; pada tahap berikutnya dapat ditambah lock tombol saat request berjalan.
- Bila server error tidak mengembalikan JSON, user akan menerima pesan gangguan koneksi.
- CSRF saat ini mengikuti konfigurasi aplikasi existing yang masih `FALSE`; jika CSRF diaktifkan di masa depan, AJAX perlu mengirim token.

## Tata Cara Penggunaan

1. Jalankan migration database dari `docs/database/2026-09-02-po-jasa-tahap1.sql`.
2. Login ke aplikasi.
3. Buka menu `PO Jasa`.
4. Purchasing/Admin masuk tab `Vendor Jasa`, lalu tambah vendor.
5. User masuk tab `Request Pekerjaan`, pilih vendor, isi tanggal target, lokasi, tujuan, dan scope biaya.
6. Klik `Rekam Request`.
7. KADEP membuka detail request dan klik `ACC KADEP`, `Pending`, atau `Reject`.
8. Direktur membuka detail request yang sudah `ACC-KADEP`, lalu klik `ACC DIREKTUR`, `Pending`, atau `Reject`.
9. Purchasing/Admin membuka detail request yang sudah `ACC DIREKTUR`, lalu klik `Generate PO/SPK`.

## Catatan Validasi

- Controller PO Jasa sebelumnya kosong, sekarang diisi dengan domain PO Jasa Tahap 1.
- Route lama yang mengarah ke subfolder `purchaseorder/pojasa/C_Pojasa` disesuaikan ke file controller existing `purchaseorder/C_Pojasa`.
- Modul memiliki guard tabel agar halaman tidak fatal bila migration belum dijalankan.
- Migration database berhasil dijalankan pada database lokal `kiucoid_karismaerp_local`.
- Folder `apps_production` tidak diubah.

## Batasan Tahap 1

- Belum ada tracking progress vendor.
- Belum ada upload dokumen/BAST.
- Belum ada audit biaya realisasi project.
- Belum ada report histori vendor project done.
- Belum ada print template SPK formal.
