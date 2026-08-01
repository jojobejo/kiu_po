# Database - Perbaikan Export Route tr_allstock

## Ringkasan

Tidak ada perubahan struktur database untuk perbaikan export dari route `tr_allstock`.

## Tabel Terkait

Export tetap memakai model:

- `application/models/laporan/M_Laporanp.php`
- Method: `M_Laporanp::getdaterangelaptr($tgl1, $tgl2)`

Query tetap membaca data dari:

- `tb_transaksi`
- `tb_barang_nk`
- `tb_user`

## Perubahan Database

Tidak ada:

- Tidak ada tabel baru.
- Tidak ada kolom baru.
- Tidak ada perubahan index.
- Tidak ada perubahan view.
- Tidak ada perubahan data master.

## Dampak Data

Perubahan hanya memperbaiki proses generate dan download file Excel. Isi data laporan tetap mengikuti query existing berdasarkan rentang `tgl_transaksi` dan filter akun transaksi non komersil.
