# Development - Laporan Cost PO NK Per PIC

## Ringkasan

Module `lap_nonkomersil` dikembangkan menjadi laporan cost Purchase Order Non Komersil per PIC.

Endpoint:

- Route: `lap_nonkomersil`
- Route export: `export_cost_pic_ponk`
- Controller: `application/controllers/laporan/C_Laporan.php`
- Method: `C_Laporan::index()`
- Method export: `C_Laporan::export_cost_pic_ponk()`
- Model: `application/models/Laporan/M_Laporanp.php`
- View baru: `application/views/content/laporan/lap_cost_pic_ponk.php`

## Konsep Laporan

Laporan menyajikan biaya PO NK berdasarkan PIC dalam rentang tanggal tertentu. Nilai cost diambil dari detail PO NK agar pembagian per PIC mengikuti item yang direkam pada `tb_detail_po_nk`.

Data yang ditampilkan:

- Total cost seluruh PIC.
- Total PO unik pada rentang tanggal.
- Total item detail PO NK.
- Ringkasan per PIC: PIC, departemen, total PO, total item, total qty, total cost.
- Detail item: NOPO, tanggal, PIC, departemen, tujuan pembelian, nama barang, deskripsi, qty, harga satuan, total cost.

## Perubahan Aplikasi

1. Mengubah tampilan route `lap_nonkomersil` agar memakai view baru `lap_cost_pic_ponk.php`.
2. Menambahkan filter `tglstart` dan `tglend` di route yang sama menggunakan method `GET`.
3. Menambahkan filter `kdpic` untuk memilih nama PIC atau `Semua PIC`.
4. Menambahkan default filter bulan berjalan saat halaman dibuka tanpa parameter.
5. Menambahkan validasi format tanggal `YYYY-MM-DD`.
6. Menambahkan penyesuaian otomatis jika tanggal start lebih besar dari tanggal end.
7. Menambahkan sumber dropdown PIC melalui `M_Laporanp::getpicfiltercostponk()`.
8. Menambahkan query ringkasan cost per PIC melalui `M_Laporanp::getcostpicponk($tgl1, $tgl2, $kdpic)`.
9. Menambahkan query detail cost per item melalui `M_Laporanp::getdetailcostpicponk($tgl1, $tgl2, $kdpic)`.
10. Menampilkan tabel dengan DataTables, default 25 baris per halaman, searchable, sortable, dan responsive.
11. Menambahkan export Excel `export_cost_pic_ponk` dengan parameter `tglstart`, `tglend`, dan `kdpic`.
12. Menambahkan tombol `Export Excel` pada view, mengikuti filter yang sedang aktif.
13. Menambahkan akses menu `Laporan Pembelian` untuk pengguna PIC (`lv = 4`) pada sidebar setelah `Request Master Barang`.
14. Menambahkan helper `get_cost_pic_filter()` di controller agar pengguna PIC selalu difilter berdasarkan `session kode`, termasuk saat export Excel.
15. Menyembunyikan dropdown `Nama PIC` untuk pengguna PIC karena filter PIC ditentukan otomatis dari session login.

## Akses Pengguna PIC

Pengguna PIC memakai route dan view laporan yang sama dengan user lain, yaitu `lap_nonkomersil` dan `lap_cost_pic_ponk.php`.

Perbedaannya:

- User PIC tidak melihat filter dropdown `Nama PIC`.
- Nilai `kdpic` dipaksa dari `$this->session->userdata('kode')`.
- Export Excel `export_cost_pic_ponk` juga memakai session PIC, sehingga parameter `kdpic` dari URL tidak bisa dipakai untuk membuka data PIC lain.

## Layout Export Excel

File export `.xlsx` dibuat dalam satu sheet:

1. Tabel pertama berada di bagian paling atas dengan judul `Ringkasan Cost - [Nama PIC]`.
2. Tabel ringkasan berisi PIC, departemen, total PO, total item, total qty, dan total cost.
3. Setelah data ringkasan terakhir, terdapat baris `Grandtotal` yang menjumlahkan seluruh nilai `Total Cost`.
4. Setelah tabel ringkasan, terdapat jarak 3 baris kosong.
5. Tabel kedua berjudul `Detail Cost - [Nama PIC]`.
6. Tabel detail berisi NOPO, tanggal, PIC, departemen, tujuan pembelian, nama barang, deskripsi, qty, harga satuan, dan total cost.

## Batasan Scope

Route export lama `export_laporan_pembelian_nk` dan flow lama `srclapbeli` tidak dihapus agar laporan pembelian existing tidak putus.

Laporan cost PIC hanya membaca PO NK dengan status `DONE`, mengikuti pola laporan pembelian non komersil existing yang juga memakai status final `DONE`.
