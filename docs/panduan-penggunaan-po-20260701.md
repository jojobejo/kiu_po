# Panduan Penggunaan Aplikasi PO

Tanggal dokumentasi: 1 Juli 2026

## Tujuan Dokumen

Dokumen ini menjelaskan cara penggunaan halaman:

- `purchase/listBarang/{kd_suplier}`
- `purchase/sup/{kd_suplier}`
- `detailPO/{kd_po}`

Penjelasan dibuat dengan bahasa yang lebih mudah dipahami oleh pengguna operasional, purchasing, dan approver.

## Gambaran Alur Singkat

Alur kerja yang disarankan:

1. Buka halaman `purchase`.
2. Pilih supplier.
3. Masuk ke halaman `purchase/sup/{kd_suplier}`.
4. Klik `Tambah Barang` untuk masuk ke `purchase/listBarang/{kd_suplier}`.
5. Tambahkan item ke list order.
6. Kembali ke halaman supplier untuk cek total, diskon, note, dan data PO.
7. Simpan atau proses PO.
8. Setelah PO terbentuk, buka `detailPO/{kd_po}` untuk melihat detail, approval, revisi, dan print.

## 1. Halaman `purchase/listBarang/{kd_suplier}`

Halaman ini dipakai untuk memilih barang milik supplier, lalu memasukkannya ke daftar order sementara.

### Fungsi utama

- Menampilkan daftar barang milik supplier.
- Menambah barang ke list order.
- Menambah barang bonus.
- Mengubah data barang supplier.
- Menghapus barang dari master list supplier jika diperlukan.

### Tombol yang tersedia

- `Tambah Produk Barang`
  Untuk menambahkan master barang baru ke supplier tersebut.

- `Tambah Barang Ke Chart`
  Untuk memasukkan barang ke list order sementara.

- `Barang Bonus`
  Untuk menambahkan barang bonus tanpa nilai harga utama.

- `Edit Barang`
  Untuk memperbaiki nama barang, isi, atau kemasan.

- `Hapus Barang`
  Untuk menghapus barang dari daftar supplier.

### Cara menambah barang ke list order

Saat klik `Tambah Barang Ke Chart`, pengguna akan mengisi:

- `Satuan`
- `Qty`
- `Harga Satuan`
- `Keterangan Harga`

Pilihan `Keterangan Harga` sekarang ada 2:

- `Exclude PPN`
  Dipakai jika harga yang diinput belum termasuk PPN.

- `Include PPN`
  Dipakai jika harga yang diinput sudah termasuk PPN.

### Perilaku sistem yang perlu dipahami user

- Jika memilih `Include PPN`, sistem akan menampilkan `Harga Satuan Exclude PPN` secara otomatis.
- Nilai exclude ini hanya dipakai sebagai dasar hitung internal.
- Harga yang diketik user tetap disimpan sesuai input.
- Dalam satu list order, mode harga harus sama.
  Jika item pertama memakai `Include PPN`, item berikutnya juga harus `Include PPN`.
  Jika item pertama memakai `Exclude PPN`, item berikutnya juga harus `Exclude PPN`.
- Jika ingin mengganti mode harga, user harus menghapus item lama dulu agar list order kembali kosong.

### Manfaat perubahan terbaru untuk user

- User jadi lebih jelas membedakan harga vendor dan harga dasar perhitungan.
- Risiko salah hitung karena harga include dianggap exclude jadi lebih kecil.
- Barang bonus tetap bisa dicatat tanpa memengaruhi total harga utama.

## 2. Halaman `purchase/sup/{kd_suplier}`

Halaman ini adalah pusat penyusunan PO per supplier.

### Fungsi utama

- Menampilkan semua item yang sudah dimasukkan ke list order.
- Menampilkan data supplier.
- Mengisi informasi PO seperti nomor PO, tanggal, tempo pembayaran, dan franko pengiriman.
- Menambahkan note barang.
- Menambahkan diskon PO.
- Menambahkan diskon per merk.
- Mengedit item yang sudah masuk ke list order.
- Menghapus item dari list order.

### Informasi penting yang sekarang tampil lebih jelas

Di halaman ini sistem sekarang menampilkan perhitungan PO dalam 2 tampilan:

- `Include PPN`
- `Exclude PPN`

Tujuannya agar user bisa melihat:

- harga input vendor,
- harga dasar sebelum PPN,
- harga setelah diskon,
- total sebelum dan sesudah diskon,
- tax,
- grand total.

### Penjelasan sederhana tampilan harga

- `Harga Input Tersimpan`
  Adalah harga yang benar-benar diketik user saat input.

- `Harga Satuan`
  Adalah harga yang dipakai sesuai mode tampilan tab.

- `Harga Satuan Kecil`
  Adalah harga hasil konversi ke satuan kecil.

- `Harga Setelah Diskon`
  Adalah harga setelah diskon diterapkan.

- `Total Harga`
  Adalah jumlah harga sebelum diskon.

- `Total Harga Setelah Diskon`
  Adalah jumlah akhir per item sesudah diskon.

### Perubahan perilaku yang penting

- Pengaturan tax tidak lagi diinput manual dari halaman ini seperti sebelumnya.
- Tax PO sekarang mengikuti mode harga item:
  - jika PO memakai `Exclude PPN`, tax aktif mengikuti PPN,
  - jika PO memakai `Include PPN`, tax internal untuk tampilan summary menjadi `0` karena harga vendor sudah termasuk PPN.
- Sistem akan menjaga agar list order tetap konsisten dan tidak mencampur mode harga.

### Fitur yang bisa dipakai user di halaman ini

- `Tambah Barang`
  Untuk menambah item baru dari daftar barang supplier.

- `Tambah Note Barang`
  Untuk memberi catatan pembelian atau catatan khusus per supplier.

- `Tambah Diskon`
  Untuk menambahkan diskon umum pada PO.

- `Diskon Merk`
  Untuk menambahkan diskon berdasarkan merk barang tertentu.

- `Edit Supplier`
  Untuk memperbarui data supplier.

### Kapan user sebaiknya memakai Include atau Exclude

- Pakai `Include PPN` jika harga dari supplier sudah final termasuk PPN.
- Pakai `Exclude PPN` jika harga dari supplier masih harga dasar sebelum PPN.

## 3. Halaman `detailPO/{kd_po}`

Halaman ini dipakai setelah PO sudah direkam dan masuk ke proses status/approval.

### Fungsi utama

- Melihat detail lengkap PO.
- Melihat status order.
- Melihat item, diskon, note, dan log perubahan.
- Melakukan approval atau reject sesuai hak akses.
- Menambahkan revisi item jika diperlukan.
- Mencetak dokumen PO.

### Informasi yang ditampilkan

- Nomor PO
- Nama supplier
- Tanggal transaksi
- Status order
- Daftar item PO
- Diskon
- Note
- Riwayat/log

### Perubahan penting yang sekarang ada di halaman ini

- Detail PO sekarang mengikuti tampilan harga seperti di halaman supplier.
- User bisa melihat tab `Include PPN` dan `Exclude PPN`.
- Mode harga per item lebih mudah dibaca.
- Perhitungan total dibuat lebih konsisten antara input PO dan detail PO.

### Fitur print baru

Pada PO dengan status `DONE`, sekarang tersedia pilihan print lebih lengkap:

- `Print PO`
- `Print PO Internal - Include`
- `Print PO Internal - Exclude`
- `Print PO - Supplier`
- `Print PO Supplier - Include`
- `Print PO Supplier - Exclude`

Manfaatnya:

- Tim internal bisa mencetak berdasarkan kebutuhan tampilan harga.
- Dokumen supplier bisa dipilih sesuai format yang ingin ditunjukkan.

### Aturan revisi yang perlu diketahui user

- Jika PO sudah memakai mode `Include PPN`, maka barang revisi juga harus `Include PPN`.
- Jika PO sudah memakai mode `Exclude PPN`, maka barang revisi juga harus `Exclude PPN`.
- Sistem akan menolak revisi yang mencampur mode harga agar hasil perhitungan tetap benar.

## Ringkasan Perubahan Modul Untuk Pengguna

### Modul `purchase/listBarang`

Perubahan yang dirasakan user:

- Ada pilihan `Keterangan Harga`.
- Ada tampilan otomatis `Harga Satuan Exclude PPN`.
- Ada peringatan jika mode harga dicampur.
- Input bonus tetap dipisahkan dari item harga normal.

### Modul `purchase/sup`

Perubahan yang dirasakan user:

- Ringkasan harga lebih jelas.
- Perhitungan include dan exclude bisa dilihat terpisah.
- Diskon total lebih rapi.
- Pengaturan tax manual di halaman ini sudah tidak menjadi langkah utama seperti sebelumnya.

### Modul `detailPO`

Perubahan yang dirasakan user:

- Tampilan detail mengikuti pola hitung halaman input.
- Tombol print lebih lengkap.
- Revisi item lebih aman karena mode harga dijaga tetap sama.

## Catatan Penggunaan

- Sebelum input banyak item, tentukan dulu apakah harga supplier menggunakan `Include PPN` atau `Exclude PPN`.
- Jangan mencampur 2 mode harga dalam satu PO.
- Jika salah pilih mode di awal, hapus item yang sudah terlanjur masuk lalu input ulang dengan mode yang benar.
- Untuk pengecekan akhir, gunakan halaman `detailPO` sebelum PO dicetak atau diproses lebih lanjut.
