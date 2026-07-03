# Alur Data LPB dari PO Komersil

Tanggal: 2026-07-01

## Fokus

Dokumen ini menjelaskan sumber data untuk module LPB (Laporan Penerimaan Barang) KarismaERP dari module PO komersil di aplikasi KIU PO.

Sumber data yang dipakai adalah PO komersil, bukan PO non-komersil.

## Tabel sumber di KIU PO

1. `tb_po`
   - Header PO komersil.
   - Menyimpan `kd_po`, `no_po`, `tgl_transaksi`, `kd_suplier`, `status`, dan informasi transaksi header lain.
   - Untuk sinkronisasi LPB, API hanya mengambil PO dengan status default `DONE`.

2. `tb_detail_po`
   - Detail barang PO komersil.
   - Menyimpan `kd_po`, `no_po`, `kd_barang`, `nama_barang`, `satuan`, `qty`, `isi`, `kemasan`, `qty_kecil`, `is_bonus`, dan `keterangan_bonus`.
   - Kolom harga sengaja tidak dikirim ke API LPB.

3. `tb_suplier`
   - Master supplier PO komersil.
   - Dipakai untuk mengambil `nama_suplier` berdasarkan `kd_suplier`.

4. `tb_barang`
   - Master barang komersil per supplier.
   - Detail LPB saat ini cukup memakai snapshot barang dari `tb_detail_po`, karena nama barang dan satuan sudah tersimpan di detail PO.

## Alur bisnis yang ditemukan

1. User membuat PO komersil dari menu `purchase`.
2. Data sementara dari supplier/barang direkam oleh `purchaseorder/C_Order::rekam_po()`.
3. Header masuk ke `tb_po`.
4. Detail item masuk ke `tb_detail_po`.
5. Approval dan perubahan status dikelola di `postatus/C_PoStatus`.
6. PO yang sudah final memiliki status `DONE`.
7. ERP menarik data PO komersil `DONE` lewat API LPB.
8. ERP membuat dokumen LPB dan mengisi nomor invoice/kode faktur penerimaan di database ERP.

## Catatan faktur dan invoice

Di database KIU PO aktif tidak ditemukan kolom khusus nomor invoice atau kode faktur untuk PO komersil.

Karena itu:

- `nomor_po` berasal dari `tb_po.no_po`.
- `kode_faktur` pada API diisi dari `tb_po.kd_po` sebagai kode dokumen sumber PO.
- `nomor_invoice` dikirim `null`.
- Nomor invoice dan kode faktur asli penerimaan sebaiknya disimpan di module LPB KarismaERP saat barang diterima.

## Field harga

API LPB tidak mengirim:

- `hrg_satuan`
- `harga_satuan_exclude`
- `harga_satuan_kecil`
- `harga_satuan_kecil_exclude`
- `hrg_diskon`
- `hrg_total`
- `hrg_total_diskon`
- `total_harga`
- `total_harga_diskon`
- `tax`
- `hrg_pajak`

Tujuannya agar LPB ERP fokus ke penerimaan fisik barang, bukan nilai pembelian.
