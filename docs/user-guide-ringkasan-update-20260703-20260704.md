# User Guide - Fitur Baru dan Cara Penggunaan 3-4 Juli 2026

Tanggal dokumentasi: 2026-07-04

## Ringkasan Fitur Baru

Update terbaru berisi:

- Perbaikan print PO Internal untuk mode Include PPN dan Exclude PPN.
- Perbaikan print PO Supplier agar total dan PPN lebih konsisten.
- Perbaikan tampilan summary detail PO.
- Route edit tujuan pembelian PO Non Komersil yang lebih stabil.
- Penyesuaian aplikasi agar lebih aman berjalan di PHP 8.3.

## 1. Print PO Internal Include PPN

Gunakan fitur ini jika harga barang yang diinput sudah termasuk PPN.

Cara penggunaan:

1. Login ke aplikasi.
2. Buka menu PO Status.
3. Pilih PO yang ingin dicek.
4. Buka detail PO.
5. Klik pilihan print `Print PO Internal - Include`.
6. Cek bagian harga dan grand total.

Yang sekarang tampil:

- Harga satuan kecil tetap memakai harga include yang diinput.
- Total harga mengikuti harga include x qty.
- Diskon dihitung dari total include.
- PPN ditampilkan `0` atau sudah termasuk.
- Grand total sama dengan total setelah diskon.

Contoh:

- Harga include: Rp 435.000,00
- Qty kecil: 400
- Diskon: 3%
- Total harga: Rp 174.000.000,00
- Total diskon: Rp 5.220.000,00
- Grand total: Rp 168.780.000,00

## 2. Print PO Internal Exclude PPN

Gunakan fitur ini jika user perlu melihat dasar harga sebelum PPN.

Cara penggunaan:

1. Login ke aplikasi.
2. Buka menu PO Status.
3. Pilih PO yang ingin dicek.
4. Buka detail PO.
5. Klik pilihan print `Print PO Internal - Exclude`.
6. Cek harga exclude, diskon, PPN, dan grand total.

Yang sekarang tampil:

- Harga include dikonversi menjadi harga exclude.
- Total harga exclude dihitung dari harga exclude x qty.
- Diskon dihitung dari nilai exclude.
- PPN 11% dihitung setelah diskon.
- Grand total kembali ke nilai final include PPN.

Contoh:

- Harga include: Rp 435.000,00
- Harga exclude: sekitar Rp 391.891,89
- Qty kecil: 400
- Total exclude: sekitar Rp 156.756.757,00
- Diskon exclude: sekitar Rp 4.702.703,00
- PPN: sekitar Rp 16.725.946,00
- Grand total: Rp 168.780.000,00

## 3. Print PO Supplier

Gunakan print supplier untuk dokumen yang akan diberikan ke supplier.

Cara penggunaan:

1. Buka detail PO.
2. Pilih print supplier sesuai kebutuhan.
3. Gunakan mode Include jika harga yang ingin ditampilkan sudah termasuk PPN.
4. Gunakan mode Exclude jika harga yang ingin ditampilkan adalah dasar sebelum PPN.
5. Cek kembali total harga, total diskon, PPN, dan grand total sebelum dokumen dikirim.

Yang diperbarui:

- Label harga dibuat lebih rapi.
- Perhitungan diskon mengikuti mode PPN yang dipilih.
- Mode Exclude menampilkan PPN secara terpisah.
- Grand total dibulatkan agar konsisten dengan detail PO.

## 4. Detail PO

Detail PO sekarang lebih konsisten saat menampilkan summary Include dan Exclude PPN.

Cara penggunaan:

1. Buka detail PO.
2. Pilih tab Include PPN untuk melihat nilai final yang sudah termasuk PPN.
3. Pilih tab Exclude PPN untuk melihat dasar harga sebelum PPN.
4. Cocokkan total diskon dan grand total dengan dokumen print.

Yang perlu diperhatikan:

- Tab Include PPN tidak boleh menampilkan harga exclude.
- Tab Exclude PPN menampilkan PPN secara terpisah.
- Selisih kecil karena pembulatan dapat terjadi pada tampilan, tetapi grand total final dibuat konsisten.

## 5. Edit Tujuan Pembelian PO Non Komersil

Fitur edit tujuan pembelian PO Non Komersil dibuat lebih stabil.

Cara penggunaan:

1. Login ke aplikasi.
2. Buka menu PO Status Non Komersil.
3. Cari PO NK yang ingin diperbarui.
4. Klik tombol edit tujuan pembelian.
5. Isi tujuan pembelian baru.
6. Klik `Simpan`.
7. Pastikan pesan sukses muncul dan tujuan pembelian berubah.

Yang baru:

- Proses simpan memakai route `postatusnk/update-tujuan-pembelian`.
- Halaman list dan detail PO NK memakai route yang sama.
- Risiko error 404 saat menyimpan tujuan pembelian berkurang.

## Catatan Untuk User

- Pilih Include PPN jika harga supplier sudah termasuk PPN.
- Pilih Exclude PPN jika harga supplier belum termasuk PPN.
- Jangan mencampur mode harga dalam satu PO.
- Sebelum print final, cek total harga, total diskon, PPN, dan grand total.
- Jika angka di print berbeda dari detail PO, refresh halaman lalu print ulang.

