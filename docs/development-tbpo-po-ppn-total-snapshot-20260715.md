# Dokumentasi Development - Snapshot Total PPN Header PO 2026-07-15

## Ringkasan

Perubahan ini menambahkan penyimpanan snapshot mode harga PPN dan total Include/Exlude PPN pada header PO komersil (`tbpo_po`). Tujuannya agar data header PO tidak hanya menyimpan total aktif yang dipakai proses lama, tetapi juga menyimpan pasangan nilai yang bisa dipakai kembali oleh laporan, integrasi, atau analisis harga.

## File Aplikasi Yang Diubah

- `application/controllers/purchaseorder/C_Order.php`
- `application/controllers/postatus/C_PoStatus.php`
- `application/models/PO/M_Purchase.php`
- `application/models/PO/M_Postatus.php`

## Perubahan Alur

1. Saat `rekam_po()` membuat PO baru, sistem membaca mode `keterangan_harga_ppn` dari item temporary.
2. Sistem menghitung dan menyimpan snapshot berikut ke header `tbpo_po` jika kolomnya tersedia:
   - `keterangan_harga_ppn`
   - `total_harga_include`
   - `total_harga_exlude`
   - `total_harga_diskon_include`
   - `total_harga_diskon_exlude`
3. Saat detail PO berubah melalui edit item, tambah item revisi, atau perubahan diskon, `syncDiskonDetailPO()` ikut menyegarkan snapshot header.
4. Insert dan update header PO difilter berdasarkan kolom yang benar-benar ada di database, sehingga aplikasi tetap berjalan jika migration belum dijalankan.

## Catatan Perhitungan

- Untuk mode `include`, nilai include memakai harga input yang tersimpan, sedangkan nilai exlude dihitung dari basis DPP yang sudah ada di detail.
- Untuk mode `exclude`, nilai exlude memakai basis DPP/detail, sedangkan nilai include dihitung dengan tax aktif.
- Jika mode `include` tidak memiliki tax aktif, snapshot include/exlude memakai fallback PPN 11% mengikuti pola perhitungan PPN yang sudah ada di modul ini.
- Penamaan kolom `exlude` mengikuti permintaan field database yang diberikan.

## Dampak Bisnis

Header PO sekarang lebih siap untuk kebutuhan reporting dan integrasi karena menyimpan dua perspektif total: harga Include PPN dan harga Exlude PPN, baik sebelum maupun setelah diskon. Ini mengurangi ketergantungan laporan pada kalkulasi ulang detail item setiap kali data PO dibaca.
