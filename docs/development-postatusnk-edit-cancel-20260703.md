# Development Postatus NK Edit dan Cancel Pengajuan

Tanggal: 2026-07-03
Module: `postatusnk/`

## Tujuan

Memperbaiki kesiapan production launch untuk fitur:

- Edit Tujuan Pembelian pada daftar dan detail PO Non Komersil.
- Cancel Pengajuan pada daftar dan detail PO Non Komersil.

## Route Terkait

- `postatusnk` -> `postatus/C_PoStatus/postatusnk`
- `cancel_pengajuan_ponk` -> `postatus/C_PoStatus/cancel_pengajuan_ponk`
- `postatusnk/update-tujuan-pembelian` -> `postatus/C_PoStatus/update_tujuan_pembelian_ponk`
- `update_tujuan_pembelian_ponk` -> alias endpoint lama untuk update tujuan pembelian.

## Perubahan Aplikasi

### Controller

File: `application/controllers/postatus/C_PoStatus.php`

- Menambahkan helper `validatePonkForAjax()` untuk validasi request AJAX.
- Menambahkan helper `responseJson()` untuk response JSON yang konsisten.
- Validasi menolak data kosong, sesi login yang sudah habis, data tidak ditemukan, dan status final:
  - `DONE`
  - `REJECT`
  - `PENGAJUAN DIBATALKAN`
- Endpoint cancel tetap menulis note histori: `PO CANCEL - PENGAJUAN DIBATALKAN`.
- Endpoint edit tujuan tetap menulis note histori: `EDIT DATA TUJUAN PEMBELIAN`.

### Model

File: `application/models/PO/M_Postatus.php`

- `get_ponk_by_req()` sekarang mengurutkan data terbaru berdasarkan `id_po_nk DESC`.
- `cancel_pengajuan_ponk()` dibungkus transaksi database dan hanya mengubah data yang belum final.
- `update_tujuan_pembelian_ponk()` dibungkus transaksi database, hanya mengubah data yang belum final, dan menyinkronkan `tj_pembelian` ke `tb_req_nk` berdasarkan kode request asal.

### View

File: `application/views/content/postatus/nonkomersilstatus.php`

- Kolom utama yang berasal dari database di-escape dengan `htmlspecialchars()`.
- Perlindungan ini terutama penting karena fitur edit tujuan pembelian menyimpan input user dan menampilkannya kembali di tabel.

## Tata Cara Penggunaan

### Edit Tujuan Pembelian

1. Buka menu `postatusnk/`.
2. Pada baris PO Non Komersil yang belum final, klik tombol edit berikon pensil.
3. Ubah isi tujuan pembelian.
4. Klik `Simpan`.
5. Sistem menampilkan pesan berhasil dan reload halaman.

Validasi:

- Tujuan pembelian tidak boleh kosong.
- Data dengan status `DONE`, `REJECT`, atau `PENGAJUAN DIBATALKAN` tidak dapat diedit.

### Cancel Pengajuan

1. Buka menu `postatusnk/`.
2. Pada baris PO Non Komersil yang belum final, klik tombol cancel berikon lingkaran silang.
3. Konfirmasi popup cancel.
4. Status berubah menjadi `PENGAJUAN DIBATALKAN`.
5. Sistem menampilkan pesan berhasil dan reload halaman.

Validasi:

- Kode request wajib tersedia.
- Data dengan status final tidak bisa dibatalkan ulang.

## Catatan Production Launch

- Fitur list dan detail menggunakan endpoint yang sama, sehingga perbaikan controller berlaku untuk dua halaman sekaligus.
- Jika user mendapat pesan sesi login berakhir, user harus login ulang sebelum melakukan edit atau cancel.
