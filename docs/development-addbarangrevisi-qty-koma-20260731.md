# Development - Qty Koma Add Barang Revisi PO

Tanggal: 2026-07-31
Route: `addBarangRevisi/(:any)/(:any)` -> `postatus/C_PoStatus/listBarangRevisi/$1/$2`
Submit: `tambahBarangRevisi` -> `postatus/C_PoStatus/tambahBarangRevisi`

## Tujuan

Modal Tambah Barang pada flow revisi PO dapat menerima Qty dengan pemisah desimal koma, misalnya `1,5` atau `0,25`, lalu total harga dihitung berdasarkan angka desimal tersebut.

## Perubahan Aplikasi

1. `application/views/content/postatus/modalAddBarang.php`
   - Kolom `qty_isi` pada modal Tambah Barang diubah dari `type="number"` menjadi `type="text"` dengan `inputmode="decimal"`.
   - Ditambahkan pattern HTML `[0-9]+([,.][0-9]+)?` agar input menerima bilangan bulat, desimal titik, dan desimal koma.

2. `application/controllers/postatus/C_PoStatus.php`
   - Ditambahkan helper private `normalize_decimal_input()`.
   - `tambahBarangRevisi()` menormalisasi `qty_isi` dan `hrg_isi` sebelum menghitung `hrg_total`.
   - Jika user input Qty `1,5` dan Harga Satuan `10000`, nilai yang dihitung menjadi `1.5 * 10000 = 15000`.

## Tata Cara Penggunaan

1. Buka detail PO.
2. Klik tombol Tambah Barang dari route `addBarangRevisi/{kode_supplier}/{kode_po}`.
3. Pilih barang yang ingin ditambahkan.
4. Isi Qty menggunakan bilangan bulat atau desimal koma, contoh `1,5`.
5. Isi Harga Satuan seperti biasa.
6. Klik Simpan.
7. Sistem kembali ke detail PO dan total item mengikuti Qty desimal yang diinput.

## Catatan Validasi

- Perubahan hanya menyasar flow tambah barang revisi PO komersil.
- Perhitungan dilakukan server-side, sehingga hasil tidak bergantung pada validasi browser saja.
