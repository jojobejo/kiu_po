# Database - Purchase List Barang Rumus Kg

Tanggal: 2026-07-06
Route: `purchase/listBarang`

## Ringkasan

Tidak ada perubahan struktur database untuk fitur pilihan rumus Kg.

## Alasan Tidak Ada Migrasi

Pilihan `Gunakan rumus Kg` hanya memengaruhi hasil perhitungan saat item disimpan atau diedit. Data hasil akhirnya tetap memakai kolom existing:

- `tb_tmp_item.qty_kecil`
- `tb_tmp_item.harga_satuan_kecil`
- `tb_tmp_item.harga_satuan_kecil_exclude`
- `tb_detail_po.qty_kecil`
- `tb_detail_po.harga_satuan_kecil`
- `tb_detail_po.harga_satuan_kecil_exclude`

Tidak diperlukan kolom baru karena module downstream sudah membaca nilai hasil konversi tersebut, bukan membaca jenis rumus secara terpisah.

## Dampak Data

1. Item baru dengan satuan `Kg` dan checkbox dicentang akan menyimpan hasil seperti perilaku lama.
2. Item baru dengan satuan `Kg` dan checkbox tidak dicentang akan menyimpan `qty_kecil` dan `harga_satuan_kecil` sama seperti satuan pcs.
3. Data lama tidak berubah otomatis.
4. Jika item lama diedit, hasil konversi akan mengikuti pilihan checkbox pada saat edit disimpan.
