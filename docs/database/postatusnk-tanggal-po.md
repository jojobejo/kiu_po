# Catatan Database: Format Tanggal PO

Tanggal: 26 Oktober 2026

## Dampak database

Tidak ada perubahan skema maupun data database. Perbaikan hanya mengubah pemformatan tanggal pada helper aplikasi agar mendukung nilai `tgl_transaksi` yang sudah ada dalam format ISO dan `DD/MM/YYYY`.

Filter departemen DIROP dan pengurutan tanggal terbaru ke terlama juga memakai kolom `tb_po_nk.departemen` dan `tb_po_nk.tgl_transaksi` yang sudah ada. Tidak diperlukan migrasi atau perubahan data.
