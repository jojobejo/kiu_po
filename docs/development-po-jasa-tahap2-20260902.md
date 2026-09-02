# Development Aplikasi - PO Jasa Tahap 2

Tanggal: 2026-09-02

## Modul

- Route utama: `pononkomersiljasa`
- Controller: `application/controllers/purchaseorder/C_Pojasa.php`
- Model: `application/models/PO/M_Pojasa.php`
- View detail: `application/views/content/po/jasa/detail.php`
- AJAX: `application/views/content/po/jasa/ajax.php`

## Scope Tahap 2

Tahap 2 melanjutkan Tahap 1 dengan fungsi operasional setelah PO/SPK Jasa terbit.

Fungsi yang ditambahkan:

- Tracking progress vendor.
- Upload dokumen project jasa.
- Audit biaya project vendor.
- BAST/project completion.

Folder `apps_production` tidak diubah.

## Alur Bisnis

1. Purchasing/Admin menerbitkan PO/SPK Jasa dari Tahap 1.
2. Status menjadi `SPK TERBIT`.
3. User terkait menginput progress vendor.
4. Saat progress di atas 0%, status berubah menjadi `PROGRESS VENDOR`.
5. Dokumen project dapat diupload sebagai penawaran, kontrak, foto progress, invoice, BAST, atau lainnya.
6. Audit biaya mencatat estimasi, realisasi, selisih, dan nomor invoice vendor.
7. Project dapat dibuat `DONE` melalui BAST setelah progress mencapai 100%.

## Status Tambahan

- `PROGRESS VENDOR`: pekerjaan vendor sedang berjalan.
- `DONE`: pekerjaan vendor selesai dan BAST telah dibuat.

## Hak Akses

Aksi Tahap 2 dapat dilakukan oleh:

- `lv=1`: Admin.
- `lv=2`: Purchasing.
- `lv=4`: requester atas request miliknya.
- `lv=5`: KADEP untuk request departemennya.

Direktur tetap berperan pada approval Tahap 1.

## Javascript dan AJAX

AJAX digunakan untuk:

- Simpan progress vendor.
- Upload dokumen memakai `FormData`.
- Simpan audit biaya.
- Selesaikan project melalui BAST.

Javascript digunakan untuk:

- Menghitung selisih biaya realisasi terhadap estimasi secara langsung.
- Menjalankan DataTables untuk progress, dokumen, biaya, dan audit note.
- Menampilkan konfirmasi SweetAlert sebelum BAST membuat status menjadi `DONE`.

## Dampak Javascript dan AJAX

Dampak positif:

- Progress vendor dapat dicatat cepat dari halaman detail tanpa pindah halaman.
- Upload dokumen lebih natural karena user tetap berada di konteks PO Jasa yang sama.
- Selisih biaya terlihat sebelum disimpan, membantu kontrol biaya.
- BAST dibuat dengan konfirmasi agar tidak tidak sengaja mengubah project menjadi `DONE`.

Dampak risiko:

- Validasi tetap dilakukan di controller karena nilai progress dan biaya dari Javascript dapat dimanipulasi.
- Upload file perlu batas ukuran dan tipe file; Tahap 2 membatasi tipe umum dokumen dan gambar.
- Status `DONE` dikunci agar hanya bisa dilakukan setelah progress 100%.
- Jika CSRF aplikasi diaktifkan nanti, endpoint AJAX dan upload FormData perlu ditambah token.

## Tata Cara Penggunaan

1. Jalankan migration database Tahap 2.
2. Login ke aplikasi.
3. Buka `PO Jasa`.
4. Pilih request yang sudah `SPK TERBIT`.
5. Input progress vendor dari panel `Tracking Progress Vendor`.
6. Upload dokumen project dari panel `Dokumen Project Jasa`.
7. Input realisasi biaya dari panel `Audit Biaya Project Vendor`.
8. Setelah progress 100%, isi BAST dan klik `Selesaikan Project`.
9. Pastikan status request berubah menjadi `DONE`.

## Catatan Validasi

- Tahap 2 tidak membuat mutasi stok.
- Tahap 2 tidak mengubah tabel PO Non Komersil.
- Semua aksi progress, dokumen, biaya, dan BAST menambahkan audit note.
- BAST tidak dapat diproses bila progress belum 100%.
- Migration database berhasil dijalankan pada database lokal `kiucoid_karismaerp_local`.
- Folder upload `images/pojasa/` disiapkan untuk dokumen project jasa.
