# Development - Perbaikan Export Transaksi Non Komersil

## Ringkasan

Perbaikan dilakukan pada endpoint `exported_tr_allnk` untuk download laporan transaksi non komersil.

Endpoint:

- Route: `exported_tr_allnk`
- Controller: `application/controllers/laporan/C_Laporan.php`
- Method: `C_Laporan::exported_tr_allnk()`

## Masalah

Saat tombol export laporan transaksi non komersil dibuka, browser dapat menampilkan error bahwa halaman `exported_tr_allnk` sementara tidak tersedia atau sudah berpindah. Dari penelusuran kode, route masih terdaftar dan mengarah ke controller yang benar, sehingga perbaikan difokuskan pada proses runtime export Excel.

## Perubahan Aplikasi

1. Menambahkan validasi parameter `tglstart` dan `tglend` dengan format `YYYY-MM-DD`.
2. Mengubah output file dari format lama `.xls` dengan writer `Excel5` menjadi `.xlsx` dengan writer `Excel2007`, mengikuti pola export non komersil lain di controller yang sama.
3. Membersihkan output buffer sebelum `PHPExcel` menulis file ke `php://output`, agar warning/whitespace sebelumnya tidak merusak stream file Excel.
4. Memperbaiki referensi lebar kolom dari `j` menjadi `J`.
5. Menambahkan header download yang lebih konsisten untuk file `.xlsx`.
6. Menghentikan proses setelah file Excel selesai dikirim agar tidak ada output tambahan dari framework.

## Cara Penggunaan

1. Buka menu laporan transaksi non komersil.
2. Isi tanggal awal dan tanggal akhir.
3. Klik tombol export Excel.
4. Sistem akan mengunduh file:

   `Laporan_Transaksi_NonKomersil_<tglstart>_to_<tglend>.xlsx`

Contoh URL langsung:

`/exported_tr_allnk?tglstart=2026-07-01&tglend=2026-07-22`

## Catatan Validasi

Jika salah satu tanggal kosong atau tidak memakai format `YYYY-MM-DD`, endpoint akan mengembalikan error `400` dengan pesan:

`Tanggal harus diisi dengan format YYYY-MM-DD.`
