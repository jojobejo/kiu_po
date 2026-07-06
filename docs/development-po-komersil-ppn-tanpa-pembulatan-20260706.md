# Development PO Komersil PPN Tanpa Pembulatan - 2026-07-06

## Tujuan

Menyesuaikan seluruh tampilan data PO komersil agar nilai `Total Harga Setelah Diskon` dan `PPN/Tax` tidak dibulatkan pada header/print dan card summary.

## Perubahan Aplikasi

- `application/views/content/postatus/detailpo.php`
  - Kolom `Total Harga Setelah Diskon` pada tabel detail PO komersil memakai `po_money()` agar nilai desimal tetap tampil.
  - Card summary `Total Harga Setelah Diskon` memakai `po_money()`.
  - Card summary `Tax ...%` memakai `po_money()`.

- `application/views/content/postatus/print_po_internal.php`
  - Kolom print internal `Total Harga Setelah Diskon` memakai `po_money()`.
  - Bagian grand total print internal untuk `Total Harga Setelah Diskon` dan `PPN` memakai `po_money()`.

- `application/views/content/postatus/printorder.php`
  - Bagian supplier print untuk `Total Harga Setelah Diskon` dan `PPN` memakai `po_money()`.
  - Grand total tetap mengikuti formatter pembulatan existing karena permintaan bisnis hanya menyebut nilai setelah diskon dan PPN/pajak.

- `application/models/Api/M_Api.php`
  - Payload API komersil tidak lagi membulatkan komponen pajak dan grand total berbasis pajak dengan `ROUND()`.

## Cara Penggunaan

1. Buka halaman PO komersil atau detail PO.
2. Pastikan data memiliki diskon dan tax/PPN, misalnya 11%.
3. Lihat kolom atau card:
   - `Total Harga Setelah Diskon`
   - `Tax ...%` atau `PPN ...%`
4. Nilai akan ditampilkan sampai 2 digit desimal tanpa pembulatan ke atas atau pembulatan integer.

## Catatan Bisnis

Perubahan ini menjaga angka PPN mengikuti hasil kalkulasi aktual dari data diskon. Ini penting untuk validasi finance karena selisih kecil akibat pembulatan dapat memicu ketidaksamaan antara layar, print, API, dan pengecekan manual.
