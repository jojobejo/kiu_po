# Development - Perbaikan Export Stock Non Komersil Production

Tanggal: 2026-08-29

## Scope

- Route: `exported_allstock`
- Controller main: `application/controllers/laporan/C_Laporan.php`
- Controller production: `apps_production/controllers/laporan/C_Laporan.php`
- Salinan controller production: `apps_production/controllers/controllers/laporan/C_Laporan.php`

## Masalah

File `lap_stock_po_nonkomersil.xlsx` dari project production tidak dapat dibuka oleh Microsoft Excel dengan pesan format/extension tidak valid.

Penyebab teknis yang ditemukan pada production:

- Export `.xlsx` masih ditulis langsung ke `php://output`.
- Output buffer hanya dibersihkan dengan `ob_end_clean()` sekali, sehingga warning/deprecated/output lain masih berisiko ikut masuk ke file.
- `exported_allstock()` memakai `M_Laporanp->v_stock()` yang sudah tidak selaras dengan data stock non komersil aktif.
- Judul sheet memakai variabel `$vartglexcel1` dan `$vartglexcel2` yang tidak dibuat di method tersebut.
- Lebar kolom lokasi salah set ke kolom `F` dua kali, bukan kolom `G`.

## Perubahan

- Production `C_Laporan` memuat model `stock/M_Stocknonkomersil`.
- Export `exported_allstock()` production memakai `M_Stocknonkomersil->v_stock()` agar sejajar dengan tampilan stock non komersil.
- Kode barang export memakai `kode_barang` bila tersedia, dengan fallback ke `kode_barangs`.
- Sheet title diubah menjadi `lap_stock_nonkomersil`.
- Kolom lokasi diperbaiki ke kolom `G`.
- Export `.xlsx` production diarahkan ke helper `download_excel2007()` yang menulis workbook ke temporary file, membersihkan semua output buffer, mengirim header XLSX termasuk `Content-Length`, lalu `readfile()`.
- Main `application/controllers/laporan/C_Laporan.php` ditambah suppression `E_DEPRECATED` dan `E_USER_DEPRECATED` pada `exported_allstock()` agar warning PHPExcel lama tidak masuk ke binary workbook.

## Cara Pakai

1. Login ke aplikasi production.
2. Buka menu stock non komersil.
3. Klik tombol `Export Stock` yang mengarah ke route `exported_allstock`.
4. File yang terunduh harus bernama `lap_stock_po_nonkomersil.xlsx` dan dapat dibuka langsung di Microsoft Excel.

## Validasi

- PHP lint controller main berhasil.
- PHP lint controller production aktif berhasil.
- PHP lint salinan controller production berhasil.
- Browser download authenticated belum dijalankan pada sesi ini.

