# Catatan Database: Pemilihan Kadep Approval pada Detail Request PIC

## Perubahan skema

Tidak ada perubahan skema database dan tidak diperlukan migrasi.

## Pemakaian kolom yang sudah tersedia

Departemen pilihan disimpan pada kolom `tb_po_nk.departemen` saat PO baru berstatus `ON PROGRESS - KADEP` dibuat. Kolom ini sudah dipakai oleh query approval Kadep untuk memilah PO menurut departemen. Tabel `tb_req_nk` dan struktur tabel lainnya tidak diubah.
