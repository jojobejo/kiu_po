# Development - Perbaikan Export Stock Non Komersil

Tanggal: 2026-07-31

## Modul

- Route: `exported_allstock`
- Controller: `application/controllers/laporan/C_Laporan.php`
- File download: `lap_stock_po_nonkomersil.xlsx`

## Masalah

Saat pengguna melakukan export stock non komersil, Microsoft Excel menolak membuka file dengan pesan format atau extension tidak valid.

Penyebab yang ditemukan pada controller:

- `exported_allstock()` memakai variabel `$vartglexcel1` dan `$vartglexcel2` untuk nama sheet, tetapi kedua variabel tersebut tidak pernah dibuat pada fungsi ini.
- Jika warning/notice PHP tampil, teks warning dapat ikut terkirim di awal file `.xlsx`, sehingga struktur ZIP Office Open XML menjadi rusak.
- Streaming langsung ke `php://output` lebih rentan tercampur output buffer lama.

## Perubahan

- Nama sheet export stock dibuat tetap menjadi `lap_stock_nonkomersil`.
- Data export sekarang memakai `M_Stocknonkomersil::v_stock()` agar angka stock sama dengan query terbaru pada route `stocknonkomersil`.
- Kolom `Kode Barang` mengikuti nilai yang tampil pada tabel stock, yaitu `kode_barang`, dengan fallback ke `kode_barangs`.
- Output `.xlsx` dibuat dahulu ke temporary file, lalu buffer dibersihkan sebelum header dan isi file dikirim.
- Header download menambahkan `Content-Length` agar ukuran file yang diterima Excel lebih konsisten.
- Typo lebar kolom lokasi diperbaiki dari kolom `F` kedua menjadi kolom `G`.

## Cara Penggunaan

1. Buka menu `Stock Non Komersil`.
2. Klik tombol `Export Stock`.
3. Sistem akan mengunduh file `lap_stock_po_nonkomersil.xlsx`.
4. File dapat langsung dibuka di Microsoft Excel.

## Catatan Verifikasi

- Perubahan difokuskan pada endpoint export stock non komersil.
- Tidak ada perubahan tampilan menu atau alur input pengguna.
- `C:\xampp\php\php.exe -l application\controllers\laporan\C_Laporan.php` berhasil tanpa syntax error.
- `C:\xampp\php\php.exe -l application\models\stock\M_Stocknonkomersil.php` berhasil tanpa syntax error.
- Probe PHPExcel `Excel2007` lokal berhasil membuat file `.xlsx` valid dengan signature awal ZIP `50 4B 03 04` dan entry `[Content_Types].xml`, `_rels/.rels`, serta `xl/workbook.xml`.
- Request langsung ke `exported_allstock` tanpa session login akan diarahkan ke halaman `Auth`; jika response HTML ini disimpan dengan ekstensi `.xlsx`, Excel tetap akan menolak file karena isinya bukan workbook.
