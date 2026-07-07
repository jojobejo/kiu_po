# Development - Filter Kode Barang purchase/listBarang

Tanggal: 2026-07-07

## Ruang Lingkup

Route yang di-upgrade:

- `purchase/listBarang/(:any)`
- Controller: `application/controllers/purchaseorder/C_Order.php`
- Model: `application/models/PO/M_Purchase.php`
- View: `application/views/content/po/listbarang.php`

## Hasil Scanning Aplikasi

Alur route aktual:

1. `application/config/routes.php` mengarahkan `purchase/listBarang/(:any)` ke `purchaseorder/C_Order/listBarang/$1`.
2. `C_Order::listBarang()` mengambil supplier, barang, tax, satuan, dan temporary item.
3. Data barang komersil diambil melalui `M_Purchase::getBarangSup()`.
4. Item yang dipilih masuk ke chart lewat `C_Order::addChart()`.
5. Simpan PO komersil memakai `C_Order::rekam_po()` dan menyalin data dari `tb_tmp_item` ke `tb_detail_po`.

## Perubahan Development

1. `C_Order::listBarang()` sekarang membaca query string `kode_awal`.
2. Nilai filter yang diperbolehkan hanya `Q`, `A`, `Z`, `C`, dan `X`.
3. Jika filter kosong atau tidak valid, sistem otomatis memakai default `Q`.
4. `M_Purchase::getBarangSup()` sekarang memfilter `tb_barang.kode_barang` berdasarkan awalan kode aktif.
5. Daftar barang diurutkan berdasarkan `kode_barang`, lalu `nama_barang`.
6. View `listbarang.php` menampilkan select filter kode barang.
7. Tabel list barang sekarang menampilkan kolom `Kode Barang` sebelum `Nama Barang`.
8. Struktur `<tr>` pada table body dirapikan agar setiap barang berada pada baris HTML sendiri.

## Tata Cara Penggunaan

1. Buka halaman `purchase/listBarang/{kode_supplier}`.
2. Secara default sistem menampilkan barang dengan kode awalan `Q`.
3. Gunakan select `Filter Kode Barang` untuk memilih awalan `Q`, `A`, `Z`, `C`, atau `X`.
4. Setelah filter berubah, halaman otomatis reload dan menampilkan barang sesuai awalan kode.
5. Pilih barang berdasarkan kolom `Kode Barang`, bukan hanya `Nama Barang`, karena satu nama dapat memiliki beberapa kode berbeda.
6. Klik `Tambah Barang Ke Chart` atau `Barang Bonus` pada kode barang yang tepat.

## Catatan Keamanan Proses PO Komersil

Proses PO komersil tetap aman terhadap struktur `tb_barang` baru karena:

- Temporary item menyimpan kode barang pada `tb_tmp_item.kode_barang`.
- Final PO menyimpan kode barang pada `tb_detail_po.kd_barang`.
- Validasi konversi barang menggunakan `M_Purchase::getBarangByKode($kodeBarang, $kodeSuplier)`, sehingga lookup memakai kombinasi kode barang dan supplier.
- Join temporary/final PO ke master barang memakai pasangan kode barang dan supplier, bukan nama barang.
- Filter baru hanya membatasi daftar pilihan di halaman list, tidak mengubah kontrak penyimpanan PO.

## File Yang Diubah

- `application/controllers/purchaseorder/C_Order.php`
- `application/models/PO/M_Purchase.php`
- `application/views/content/po/listbarang.php`

