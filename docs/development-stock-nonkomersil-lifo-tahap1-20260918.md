# Tahap 1 — Fondasi LIFO Stok Non-Komersil

Tahap ini menyediakan tabel batch dan alokasi LIFO yang dapat diaudit, tanpa mengubah tabel transaksi sumber.

## Instalasi

1. Backup database target.
2. Jalankan `database/sql/stock_nonkomersil_lifo_foundation_20260918.sql`.
3. Jalankan rekonstruksi eksplisit:

   `php index.php cli/StockLifoRebuild --confirm`

Rekonstruksi hanya mengosongkan lalu membangun ulang tabel bantu `tbpo_stock_lifo_*`; tabel PO dan `tbpo_transaksi` tidak diubah.

## Aturan harga

- Harga realisasi dipakai bila approval detail sudah final.
- Harga nyata legacy pada PO `DONE` dipakai sebagai realisasi.
- Selain itu sistem memakai `hrg_satuan`.
- Saldo awal dan adjustment masuk yang tidak memiliki harga PO ditandai `PERLU_HARGA` dan dicatat pada `tbpo_stock_lifo_rebuild_issue`.

## Tahap selanjutnya

- Form harga manual dan audit perubahan harga batch.
- Menampilkan ringkasan serta lapisan LIFO pada `stocknonkomersil` dan `detailtransaksi`.
- Mengintegrasikan seluruh jalur transaksi keluar agar transaksi baru diblokir bila batch berharga tidak cukup.
