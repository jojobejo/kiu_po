# Development - Purchase List Barang Rumus Kg

Tanggal: 2026-07-06
Route: `purchase/listBarang`

## Ringkasan

Perubahan ini menambahkan pilihan penggunaan rumus Kg pada modal tambah barang dan modal edit item PO komersil. Tujuannya sederhana: tim purchasing bisa memilih apakah satuan `Kg` dihitung dengan rumus kemasan atau diperlakukan seperti satuan pcs untuk kebutuhan `qty_kecil` dan `harga_satuan_kecil`.

## File Aplikasi

- `application/controllers/purchaseorder/C_Order.php`
- `application/views/content/po/modal/modalList.php`
- `application/views/content/po/modalpo.php`

## Perilaku Baru

1. Saat user memilih satuan `Kg`, aplikasi menampilkan checkbox `Gunakan rumus Kg`.
2. Jika checkbox dicentang, perhitungan tetap memakai rumus Kg yang sudah berjalan:
   - `qty_kecil = qty / (kemasan / 1000)`
   - `harga_satuan_kecil = harga_satuan * (kemasan / 1000)`
3. Jika checkbox tidak dicentang, perhitungan mengikuti satuan pcs:
   - `qty_kecil = qty`
   - `harga_satuan_kecil = harga_satuan`
4. Untuk satuan selain `Kg`, checkbox disembunyikan dan perilaku lama tetap dipertahankan.
5. Satuan `Ltr` tetap memakai rumus kemasan seperti sebelumnya.

## Cara Penggunaan

1. Buka `purchase/listBarang/{kode_supplier}`.
2. Klik tambah barang pada item yang akan dibeli.
3. Pilih satuan `Kg`.
4. Gunakan checkbox `Gunakan rumus Kg` sesuai kebutuhan:
   - Dicentang untuk barang Kg yang harus dikonversi berdasarkan kemasan master barang.
   - Tidak dicentang untuk barang Kg yang ingin dihitung seperti pcs pada nilai satuan kecil.
5. Isi qty, harga satuan, keterangan harga PPN, lalu simpan.

## Catatan Teknis

Backend menerima field `use_rumus_kg`. Nilai `1` berarti rumus Kg aktif, nilai `0` berarti menggunakan hitungan pcs. Jika field tidak dikirim dari form lama, sistem memakai default lama yaitu rumus Kg aktif agar kompatibilitas tetap aman.
