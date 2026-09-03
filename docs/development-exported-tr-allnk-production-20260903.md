# Development Aplikasi - Cek dan Perbaikan Export Transaksi Non Komersil Production

Tanggal: 2026-09-03

## Scope

- Route: `exported_tr_allnk?tglstart=2026-09-01&tglend=2026-09-03`
- Controller main: `application/controllers/laporan/C_Laporan.php`
- Controller production: `apps_production/controllers/laporan/C_Laporan.php`
- Salinan controller production: `apps_production/controllers/controllers/laporan/C_Laporan.php`
- Model main: `application/models/Laporan/M_Laporanp.php`
- Model production: `apps_production/models/Laporan/M_Laporanp.php`
- Salinan model production: `apps_production/controllers/models/Laporan/M_Laporanp.php`

## Temuan

Mapping route production sudah ada:

```php
$route['exported_tr_allnk'] = 'laporan/C_Laporan/exported_tr_allnk';
```

Bug tidak berada pada mapping route, melainkan pada handler export dan filter tanggal.

Temuan teknis:

- Main controller masih mengirim file sebagai `Excel5` dengan ekstensi `.xls` langsung ke `php://output`.
- Salah satu salinan controller production sudah memakai `.xlsx`, tetapi masih menulis langsung ke `php://output`.
- Salinan production aktif `apps_production/controllers/laporan/C_Laporan.php` sudah memakai helper temporary file, tetapi source/salinan lain belum konsisten.
- Query memakai batas `a.tgl_transaksi <= $tglend`. Jika data production menyimpan jam pada tanggal transaksi, nilai seperti `2026-09-03 10:00:00` berisiko tidak ikut saat request memakai `tglend=2026-09-03`.
- Local mirror database `kiucoid_po.tb_transaksi` tidak memiliki data pada periode `2026-09-01` sampai `2026-09-03`; data terakhir mirror lokal saat pengecekan adalah `2026-07-29`. Jadi file kosong pada mirror lokal bukan bukti error route.

## Perbaikan

- `exported_tr_allnk()` pada main controller memakai validasi format tanggal `YYYY-MM-DD`.
- Export route memakai format `.xlsx` dan helper `download_excel2007()` yang menulis workbook ke file temporary, membersihkan output buffer, mengirim header XLSX, `Content-Length`, lalu `readfile()`.
- Salinan production `apps_production/controllers/controllers/laporan/C_Laporan.php` diselaraskan agar memakai helper `download_excel2007()` dan suppress warning deprecated PHPExcel.
- Filter tanggal `getdaterangelaptr()` di main dan production model memakai `DATE(a.tgl_transaksi)` agar tanggal akhir mencakup seluruh hari.

## Cara Uji

1. Login ke aplikasi production.
2. Buka halaman Histori All Stock Non Komersil.
3. Pilih tanggal `2026-09-01` sampai `2026-09-03`.
4. Klik export yang membentuk URL:

```text
exported_tr_allnk?tglstart=2026-09-01&tglend=2026-09-03
```

5. Pastikan browser mengunduh file `.xlsx`.
6. Pastikan file bisa dibuka di Microsoft Excel tanpa pesan format/extension invalid.
7. Bila file terbuka tetapi kosong, cek data production pada `tb_transaksi` untuk periode tersebut karena local mirror tidak punya baris pada periode itu.

## Validasi Lokal

- PHP lint controller dan model terkait berhasil sebelum perubahan.
- Struktur local mirror menunjukkan `tb_transaksi.tgl_transaksi` bertipe `text`.
- Query local mirror untuk `2026-09-01` sampai `2026-09-03` mengembalikan `0` baris karena data mirror terakhir `2026-07-29`.

## Catatan Deployment

Upload hanya file yang berubah sesuai lokasi aplikasi production yang benar. Jangan bulk replace folder production karena terdapat beberapa salinan controller/model dengan isi berbeda.
