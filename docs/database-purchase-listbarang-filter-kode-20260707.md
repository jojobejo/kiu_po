# Database - Filter Kode Barang purchase/listBarang

Tanggal: 2026-07-07

## Hasil Scanning Struktur

Database lokal yang dicek: `kiucoid_po`

Struktur aktif `tb_barang` pada database lokal:

- `id_barang` int primary key auto increment
- `kode_barang` varchar(25)
- `kd_suplier` varchar(25)
- `nama_barang` text
- `satuan` varchar(50)
- `panjang` int
- `lebar` int
- `tinggi` int
- `berat` decimal(15,2)
- `isi` decimal(15,2)
- `kemasan` decimal(15,2)
- `stock_minimum` int
- `merk_barang` text
- `kelompok_barang` text
- `kategori_barang` text
- `bhn_aktif` text
- `produk_fokus` text
- `is_active` enum('T','F')
- `is_lot` enum('T','F')

## Hasil Scanning Data Prefix

Jumlah data berdasarkan awalan `kode_barang` pada database lokal:

- `A`: 2975
- `C`: 260
- `Q`: 3879
- `S`: 1
- `X`: 19
- `Z`: 824

Filter module hanya membuka pilihan `Q`, `A`, `Z`, `C`, dan `X` sesuai request. Data awalan `S` tidak dimasukkan ke pilihan filter.

## Data Nama Sama Dengan Kode Berbeda

Scanning menemukan beberapa nama barang yang sama tetapi kode berbeda, misalnya:

- `Lannate 25 WP 10 X 10 X 100 gr`: `ALANN02`, `ALANN08`, `CLANN02`, `QLANN04`
- `Lannate 40 SP 10 X 10 X 100 gr`: `ALANN07`, `ALANN09`, `CLANN01`, `QLANN01`
- `Liding 240 EC 48 X 200 ml*`: `ALIDI01`, `ALIDI04`, `QLID01`, `QLIDI03`

Karena kondisi ini, filter dan tampilan list menggunakan `kode_barang` sebagai pembeda utama.

## Dampak Database

Tidak ada perubahan schema database.

Tidak ada migration baru.

Query list barang berubah secara aplikasi menjadi:

- Filter supplier tetap menggunakan `kd_suplier`.
- Filter kode baru menggunakan `kode_barang LIKE '{prefix}%'`.
- Default prefix adalah `Q`.
- Sort menggunakan `kode_barang ASC`, lalu `nama_barang ASC`.

## Catatan Tabel PO Komersil

Tabel PO komersil yang tetap dipakai:

- `tb_tmp_item`
- `tb_detail_po`
- `tb_barang`

Kolom penting untuk keamanan kode barang:

- `tb_tmp_item.kode_barang`
- `tb_tmp_item.kode_suplier`
- `tb_detail_po.kd_barang`
- `tb_detail_po.kd_suplier`
- `tb_barang.kode_barang`
- `tb_barang.kd_suplier`

Kontrak ini aman untuk nama barang yang sama selama pemilihan dan proses simpan tetap memakai kode barang.

