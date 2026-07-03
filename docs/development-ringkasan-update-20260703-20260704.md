# Dokumentasi Development - Ringkasan Update 3-4 Juli 2026

Tanggal dokumentasi: 2026-07-04

## Cakupan

Dokumen ini merangkum perubahan development pada tanggal 3 Juli 2026 dan 4 Juli 2026.

## 1. Update 3 Juli 2026

### A. Kompatibilitas PHP 8.3 CodeIgniter

Perubahan dilakukan untuk mengurangi warning dynamic property pada CodeIgniter saat aplikasi berjalan di PHP 8.2/8.3.

Area yang terdampak:

- `system/core/Controller.php`
- `system/core/Loader.php`
- `system/core/URI.php`
- `system/core/Router.php`
- `system/database/DB_driver.php`

Yang diperbarui:

- Deklarasi properti core CodeIgniter ditambahkan secara eksplisit.
- Bootstrap aplikasi dibuat lebih aman untuk PHP 8.3.
- Tidak ada perubahan flow bisnis aplikasi.

### B. Edit Tujuan Pembelian PO Non Komersil

Perubahan dilakukan pada modul PO Status Non Komersil agar proses edit tujuan pembelian memakai route yang lebih jelas.

Area yang terdampak:

- `application/config/routes.php`
- `application/views/content/postatus/nonkomersilstatus.php`
- `application/views/content/postatus/detailponk.php`

Yang diperbarui:

- Route baru: `postatusnk/update-tujuan-pembelian`
- AJAX pada halaman list dan detail PO NK diarahkan ke route tersebut.
- Route lama tetap dipertahankan untuk kompatibilitas.

## 2. Update 4 Juli 2026

### A. Perbaikan Perhitungan Print PO Internal Include/Exclude PPN

Perubahan dilakukan pada view cetak PO agar angka Include PPN dan Exclude PPN tidak saling tercampur.

Area yang terdampak:

- `application/views/content/po/_po_summary_helpers.php`
- `application/views/content/postatus/detailpo.php`
- `application/views/content/postatus/print_po_internal.php`
- `application/views/content/postatus/printorder.php`

Yang diperbarui:

- Mode Include PPN menampilkan harga input include apa adanya.
- Mode Exclude PPN mengonversi harga include ke exclude dengan rumus `harga_include / 1.11`.
- PPN pada mode Include ditampilkan sebagai `0` atau sudah termasuk.
- PPN pada mode Exclude dihitung dari total setelah diskon.
- Grand total dibulatkan dengan helper rounding existing agar konsisten dengan halaman utama.
- Kolom item `Total Harga Setelah Diskon` pada mode Exclude tidak lagi mengambil nilai grand total include.

### B. Penyelarasan Summary Detail PO

Perhitungan summary detail PO diperbarui agar total diskon berasal dari daftar diskon yang aktif, lalu dikonversi sesuai mode tampilan.

Yang diperbarui:

- Total diskon dihitung dari `poDetailDiscountRows`.
- Jika data asal include tetapi tab yang dibuka exclude, diskon dikonversi ke exclude.
- Jika data asal exclude tetapi tab yang dibuka include, diskon dikonversi ke include.
- Grand total memakai pembulatan final.

## Prinsip Perhitungan Baru

### Include PPN

- Harga display = harga include yang diinput user.
- Total harga = harga include x qty kecil.
- Total diskon = persentase diskon x total include.
- Total setelah diskon = total include - total diskon.
- PPN = 0 karena sudah termasuk.
- Grand total = total setelah diskon.

### Exclude PPN

- Harga exclude = harga include / 1.11.
- Total harga exclude = harga exclude x qty kecil.
- Total diskon exclude = persentase diskon x total exclude.
- Total setelah diskon exclude = total exclude - total diskon exclude.
- PPN = total setelah diskon exclude x 11%.
- Grand total = total setelah diskon exclude + PPN.

## Catatan Validasi

Case validasi utama:

- Harga include: `435000`
- Qty kecil: `400`
- Diskon: `3%`
- PPN: `11%`

Hasil Include PPN:

- Total harga: `174000000`
- Total diskon: `5220000`
- Total setelah diskon: `168780000`
- PPN: `0`
- Grand total: `168780000`

Hasil Exclude PPN:

- Harga satuan exclude: `391891.891891`
- Total harga exclude: `156756756.756`
- Total diskon exclude: `4702702.703`
- Total setelah diskon exclude: `152054054.054`
- PPN: `16725945.946`
- Grand total: `168780000`

