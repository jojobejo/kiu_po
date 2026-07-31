# Database - Qty Koma Add Barang Revisi PO

Tanggal: 2026-07-31

## Status Perubahan Database

Tidak ada perubahan struktur database yang perlu dijalankan untuk perubahan ini.

## Hasil Pengecekan Lokal

Database aktif pada `application/config/database.php` menggunakan database lokal `kiucoid_po`.

Pengecekan kolom:

```sql
SHOW COLUMNS FROM tb_detail_po LIKE 'qty';
SHOW COLUMNS FROM tb_detail_po LIKE 'hrg_total';
```

Hasil lokal:

- `tb_detail_po.qty` bertipe `double`
- `tb_detail_po.hrg_total` bertipe `double`
- Data lokal sudah memiliki beberapa baris dengan Qty desimal, sehingga penyimpanan Qty koma tidak membutuhkan migration baru.

## Dampak Data

- Input `1,5` dinormalisasi aplikasi menjadi `1.5` sebelum insert ke `tb_detail_po.qty`.
- `hrg_total` tetap disimpan sebagai hasil `qty * hrg_satuan`.
- Tidak ada tabel baru.
- Tidak ada kolom baru.
- Tidak ada migration SQL yang perlu dieksekusi.
