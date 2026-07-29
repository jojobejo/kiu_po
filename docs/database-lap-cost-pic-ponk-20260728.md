# Database - Laporan Cost PO NK Per PIC

## Ringkasan

Tidak ada perubahan struktur database untuk module laporan cost PO NK per PIC.

## Tabel Terkait

Laporan membaca data dari tabel existing:

- `tb_detail_po_nk`
- `tb_po_nk`
- `tb_user`

## Field Utama

Field biaya:

- `tb_detail_po_nk.total_harga`

Field relasi PO:

- `tb_detail_po_nk.kd_po_nk`
- `tb_po_nk.kd_po_nk`

Field PIC:

- `tb_detail_po_nk.kd_user`
- `tb_user.kode_user`
- `tb_user.nama_user`
- `tb_user.departement`

Field filter:

- `tb_detail_po_nk.tgl_transaksi`
- `tb_po_nk.status`
- `tb_detail_po_nk.kd_user`

## Perubahan Database

Tidak ada:

- Tidak ada tabel baru.
- Tidak ada kolom baru.
- Tidak ada perubahan index.
- Tidak ada perubahan view.
- Tidak ada perubahan data master.

Export Excel `export_cost_pic_ponk` memakai query laporan yang sama dan tidak membutuhkan tabel staging atau tabel temporary.

## Catatan Query

Laporan memakai filter:

- `DATE(tb_detail_po_nk.tgl_transaksi) >= tglstart`
- `DATE(tb_detail_po_nk.tgl_transaksi) <= tglend`
- `tb_po_nk.status = DONE`
- `tb_detail_po_nk.kd_user = kdpic` jika user memilih PIC tertentu.

Jika user memilih `Semua PIC`, filter `kd_user` tidak dikirim ke query.

Untuk pengguna PIC (`lv = 4`), aplikasi selalu mengisi `kdpic` dari session login, sehingga query tetap memakai filter:

- `tb_detail_po_nk.kd_user = session kode`

Ringkasan cost per PIC dihitung dari:

- `COUNT(DISTINCT tb_po_nk.kd_po_nk)` sebagai total PO per PIC.
- `COUNT(tb_detail_po_nk.id_det_po_nk)` sebagai total item.
- `SUM(tb_detail_po_nk.qty)` sebagai total qty.
- `SUM(tb_detail_po_nk.total_harga)` sebagai total cost.
