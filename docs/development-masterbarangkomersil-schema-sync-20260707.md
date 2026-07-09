# Development - Master Barang Komersil Schema Sync

Tanggal: 2026-07-07

## Modul

- Route: `masterbarangkomersil/`
- Controller: `application/controllers/master_barang/C_MasterBarang.php`
- Model: `application/models/Master_barang/M_MasterBarang.php`
- View: `application/views/content/mbarang/mbodyk.php`

## Latar Belakang

Halaman `masterbarangkomersil/` gagal dibuka karena query model masih memilih kolom `a.bahan_aktif`, sedangkan struktur `tbpo_barang` aktif saat ini memakai kolom `bhn_aktif`.

Saat schema dicek pada database lokal `kiucoid_po`, tabel `tbpo_barang` juga memakai:

- `id` sebagai primary key, bukan `id_barang`
- `satuan` sebagai teks satuan, bukan relasi `satuan_qty`
- `bhn_aktif` sebagai bahan aktif

## Perubahan Aplikasi

Perubahan dilakukan pada method `M_MasterBarang::allmasterbarang()`.

Query tidak lagi hard-code semua nama kolom lama. Model sekarang:

1. Mengecek apakah primary key memakai `id_barang` atau `id`.
2. Mengecek apakah bahan aktif memakai `bahan_aktif` atau `bhn_aktif`.
3. Mengecek apakah satuan memakai relasi `satuan_qty` ke `tbpo_satuan` atau kolom teks `satuan`.
4. Mengecek apakah `hasil_dimensi` tersedia; jika tidak tersedia, nilai dihitung dari `panjang * lebar * tinggi`.
5. Menggunakan `LEFT JOIN` ke `tbpo_suplier` agar data barang tetap tampil meskipun master supplier belum lengkap.

View `mbodyk.php` tetap memakai properti yang sama (`bahan_aktif`, `nm_satuan`, `panjang`, `lebar`, `tinggi`) karena model sudah menormalisasi alias field.

## Update Performance dan CRUD Detail

Tanggal update: 2026-07-07

Route `masterbarangkomersil/` sekarang tidak lagi memuat seluruh isi `tbpo_barang` ke HTML awal. Halaman memakai DataTables AJAX server-side melalui endpoint:

- `masterbarangkomersil/data`
- `masterbarangkomersil/detail/{id}`
- `masterbarangkomersil/get/{id}`
- `masterbarangkomersil/save`
- `masterbarangkomersil/delete`

Perubahan ini mengurangi beban load awal karena browser hanya menerima struktur halaman, modal, dan data halaman pertama dari DataTables. Search, paging, dan sort diproses dari server.

Update alur terbaru:

1. Halaman list tidak lagi menampilkan modal tambah, modal edit, atau tombol tambah/edit/delete.
2. Kolom `#` pada list hanya menampilkan tombol detail.
3. Tombol detail membuka halaman baru `masterbarangkomersil/detail/{id}`.
4. Halaman detail menyajikan data barang dan data supplier.
5. Modifikasi data dilakukan dari halaman detail memakai SweetAlert2.
6. Tombol `Edit Data` membuka form SweetAlert2 dan menyimpan via AJAX tanpa reload penuh.
7. Tombol `Hapus Data` membuka konfirmasi SweetAlert2, lalu kembali ke list setelah berhasil.

Update edit data:

- Field supplier tidak dapat diedit dari SweetAlert2. Supplier tetap ditampilkan sebagai informasi pada halaman detail.
- Field satuan memakai opsi dari `tbpo_satuan`.
- Nilai satuan yang dikirim dan disimpan tetap nama satuan (`nm_satuan`) ke kolom `tbpo_barang.satuan`.

Field yang dapat diedit dari SweetAlert2 pada halaman detail:

- Kode barang
- Nama barang
- Bahan aktif
- Satuan
- Merk
- Stock minimum
- Panjang, lebar, tinggi, berat
- Isi dan kemasan
- Status aktif
- Lot
- Kelompok, kategori, produk fokus

## Tata Cara Penggunaan Detail dan Modifikasi

1. Login sebagai user level admin/purchasing yang memiliki `lv` 1 atau 2.
2. Buka `masterbarangkomersil/`.
3. Gunakan search DataTables untuk mencari kode, nama barang, bahan aktif, satuan, atau supplier.
4. Klik icon mata pada kolom `#` untuk masuk ke halaman detail barang.
5. Lihat panel `Data Barang` dan `Data Supplier`.
6. Klik `Edit Data` untuk memodifikasi data melalui SweetAlert2.
7. Klik `Hapus Data` untuk menghapus data melalui konfirmasi SweetAlert2.

## Tata Cara Penggunaan

1. Buka menu Master Barang Komersil atau akses route `masterbarangkomersil/`.
2. Sistem menampilkan daftar barang komersil dari `tbpo_barang`.
3. Kolom Bahan Aktif mengambil data dari `tbpo_barang.bhn_aktif` pada schema sekarang.
4. Kolom Nama Satuan mengambil data dari `tbpo_barang.satuan` pada schema sekarang.

## Dampak Bisnis

Perubahan ini menjaga halaman master barang komersil tetap berjalan mengikuti struktur database aktif. Tim purchasing dan admin dapat melihat data barang komersil tanpa perlu menunggu perubahan struktur database tambahan.

## Validasi

- Syntax check model berhasil menggunakan `C:\xampp\php\php.exe -l`.
- Struktur live `tbpo_barang` divalidasi dari database `kiucoid_po`.
- Syntax check controller, model, view `mbodyk.php`, dan JS partial `datatables.php` berhasil.
- Syntax check view detail `detailbarangkomersil.php` berhasil.
- Query server-side DataTables divalidasi langsung ke database live.
- HTTP route lokal terproteksi session login, sehingga pengecekan dari shell tanpa session diarahkan ke halaman login.
