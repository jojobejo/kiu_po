# User Guide - Laporan Cost PO NK Per PIC

## Akses Module

Buka menu laporan non komersil atau akses route:

`lap_nonkomersil`

Untuk pengguna PIC, menu `Laporan Pembelian` tersedia di navigasi kiri setelah menu `Request Master Barang`.

## Cara Menggunakan

1. Isi `Tanggal Start`.
2. Isi `Tanggal End`.
3. Pilih `Nama PIC`.
4. Gunakan pilihan `Semua PIC` jika ingin menampilkan seluruh PIC.
5. Klik tombol `Cari`.
6. Sistem menampilkan ringkasan cost PO NK per PIC dan detail item pada rentang tanggal tersebut.
7. Klik tombol `Export Excel` untuk mengunduh laporan sesuai filter aktif.

Untuk pengguna PIC, pilihan `Nama PIC` tidak ditampilkan karena sistem otomatis memakai PIC dari session login.

## Informasi Yang Ditampilkan

Bagian atas menampilkan:

- Total Cost
- Total PO
- Total Item

Tabel ringkasan menampilkan akumulasi per PIC:

- PIC
- Departemen
- Total PO
- Total Item
- Total Qty
- Total Cost

Tabel detail menampilkan rincian item:

- NOPO
- Tanggal
- PIC
- Departemen
- Tujuan Pembelian
- Nama Barang
- Deskripsi
- Qty
- Harga Satuan
- Total Cost

## Catatan

Jika halaman dibuka tanpa tanggal, sistem otomatis memakai rentang bulan berjalan.

Jika tanggal start lebih besar dari tanggal end, sistem otomatis menukar rentangnya agar pencarian tetap berjalan.

Data laporan hanya mengambil PO NK dengan status `DONE`.

Jika satu PIC dipilih, Total Cost, Total PO, Total Item, tabel ringkasan, dan tabel detail hanya menampilkan data PIC tersebut.

## Export Excel

File Excel berisi dua tabel dalam satu sheet:

1. `Ringkasan Cost - [Nama PIC]` berada di bagian atas.
2. Di akhir tabel ringkasan, baris `Grandtotal` menampilkan jumlah seluruh `Total Cost`.
3. Setelah ringkasan, sistem memberi jarak 3 baris kosong.
4. `Detail Cost - [Nama PIC]` berada di bawah tabel ringkasan.

Jika filter memakai `Semua PIC`, judul export menjadi `Ringkasan Cost - Semua PIC` dan `Detail Cost - Semua PIC`.
