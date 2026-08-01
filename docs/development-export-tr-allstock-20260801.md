# Development - Perbaikan Export Route tr_allstock

## Ringkasan

Perbaikan dilakukan pada fungsi export Excel dari halaman `tr_allstock`.

Alur aplikasi:

- Route halaman: `tr_allstock`
- View: `application/views/content/laporan/histori_stock_all_ponk.php`
- Tombol export: `#btnExportExcel`
- Route export: `exported_tr_allnk`
- Controller: `application/controllers/laporan/C_Laporan.php`
- Method export: `C_Laporan::exported_tr_allnk()`

## Masalah

File hasil export dapat rusak walaupun browser menerima response dengan header `.xlsx`.

Dari validasi lokal, byte awal file download adalah HTML error dari warning legacy `PHPExcel`, bukan signature file Excel `.xlsx`. Signature `.xlsx` valid harus diawali `504B0304`.

Warning yang bocor berasal dari kompatibilitas `PHPExcel` lama terhadap PHP yang lebih baru:

`Array and string offset access syntax with curly braces is deprecated`

Karena warning tersebut masuk ke stream download, Excel membaca file sebagai konten rusak.

## Perubahan Aplikasi

1. Menambahkan suppress khusus `E_DEPRECATED` dan `E_USER_DEPRECATED` pada method `exported_tr_allnk()` sebelum `PHPExcel` digunakan.
2. Menambahkan helper private `download_excel2007()` di `C_Laporan`.
3. Helper tersebut membuat workbook ke temporary file lebih dulu.
4. Output buffer dibersihkan sebelum header download dikirim.
5. Header download sekarang menyertakan `Content-Length` berdasarkan ukuran temporary file.
6. File dikirim dengan `readfile()` lalu temporary file dihapus.

## Cara Penggunaan

1. Buka menu laporan transaksi all barang non komersil melalui route `tr_allstock`.
2. Isi `Tanggal Start` dan `Tanggal End`.
3. Klik `Export Excel`.
4. Sistem mengunduh file:

   `Laporan_Transaksi_NonKomersil_<tglstart>_to_<tglend>.xlsx`

Contoh URL langsung:

`/exported_tr_allnk?tglstart=2026-07-01&tglend=2026-07-31`

## Catatan Validasi

Validasi lokal setelah perbaikan:

- Syntax controller valid dengan `php -l`.
- Endpoint export menghasilkan file dengan signature `504B0304`.
- Arsip `.xlsx` dapat dibaca sebagai ZIP Office Open XML.

Jika file masih terbuka sebagai halaman login atau HTML, pastikan user sudah login sebelum menekan tombol export.
