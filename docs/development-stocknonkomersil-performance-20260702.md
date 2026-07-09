# Dokumentasi Development Stock Non Komersil

Tanggal dokumentasi: 2 Juli 2026

## Modul

- Route utama: `stocknonkomersil`
- Endpoint data: `stocknonkomersil/data`
- Controller: `application/controllers/stock/C_Stocknonkomersil.php`
- Model: `application/models/stock/M_Stocknonkomersil.php`
- View tabel/filter: `application/views/content/stock/nonkomersil/body.php`
- Script DataTables: `application/views/content/stock/nonkomersil/datatables.php`

## Masalah

Halaman `stocknonkomersil` terasa lambat saat load data dan saat filter dijalankan. Penyebab teknis yang ditemukan:

- Endpoint lama mengirim seluruh data stock ke browser setiap reload.
- Browser lalu membangun ulang semua row DataTables secara manual lewat JavaScript.
- Query model memakai view `v_stockbarangnk` yang di database lokal berisi correlated subquery ke `tbpo_transaksi` berulang per barang.
- Tabel lokal saat dicek berisi 875 barang dan 10.252 transaksi, sementara index pendukung pada `tbpo_transaksi.kd_barang` belum lengkap sebelum migrasi dijalankan.

## Perubahan Development

1. Endpoint `stocknonkomersil/data` sekarang mendukung format server-side DataTables:
   - `draw`
   - `start`
   - `length`
   - `search[value]`
   - `order[0][column]`
   - `order[0][dir]`
2. DataTables di browser memakai `serverSide: true`, sehingga initial load dan filter hanya mengambil data per halaman.
3. Filter lokasi dan status stock sekarang memanggil ulang AJAX DataTables, bukan membangun ulang semua row manual.
4. Model menambahkan query stock berbasis agregasi `tbpo_transaksi` satu kali per request:
   - transaksi masuk: akun `11511`, `11513`
   - transaksi keluar: akun `11512`, `11514`
5. Query halaman utama tidak lagi bergantung pada view `v_stockbarangnk`, karena view tersebut memakai subquery berulang.
6. `Saran PO` tetap dihitung aplikasi dari `minimum_stock` dan `qty_ready`.
7. Saat `minimum_stock` masih `0`, nilai `Saran PO` default ditampilkan `0`.
8. Endpoint lama tanpa parameter DataTables tetap didukung melalui method `v_stock()`.

## Cara Penggunaan

1. Buka menu `Stock Non Komersil` atau route `stocknonkomersil`.
2. Tabel akan memuat data otomatis per halaman.
3. Gunakan search DataTables untuk mencari kode barang, nama barang, deskripsi, satuan, atau lokasi.
4. Gunakan filter `Filter Lokasi` untuk membatasi data berdasarkan lokasi barang.
5. Gunakan filter `Status Stock`:
   - `Harus Di-PO`
   - `Hampir Habis`
   - `Habis`
   - `Aman`
6. Klik `Reload Cepat` untuk memuat ulang data dengan filter aktif.
7. Untuk admin/purchasing, tombol aksi per row tetap tersedia:
   - detail transaksi,
   - update lokasi,
   - atur minimum stock.

## Dampak

- Browser tidak lagi menerima seluruh dataset saat halaman dibuka.
- Filter dan pencarian berpindah ke database sehingga beban DOM lebih rendah.
- Query stock lebih terkontrol karena transaksi diagregasi sekali, bukan subquery berulang per barang.
- Default `Saran PO` menjadi 0 selama `minimum_stock` belum diatur.

## Verifikasi

- Syntax PHP controller dicek dengan `C:\xampp\php\php.exe -l application\controllers\stock\C_Stocknonkomersil.php`.
- Syntax PHP model dicek dengan `C:\xampp\php\php.exe -l application\models\stock\M_Stocknonkomersil.php`.
- Syntax PHP view dicek dengan `C:\xampp\php\php.exe -l application\views\content\stock\nonkomersil\datatables.php`.
- Query baru diuji langsung ke database lokal `kiucoid_po` dan mengambil 10 baris sekitar `0.01365640` detik.
- HTTP check endpoint lokal diarahkan ke halaman login, sehingga uji JSON perlu dilakukan dari browser yang sudah login.

