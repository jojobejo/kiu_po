# Database - Export Transaksi Non Komersil Production

Tanggal: 2026-09-03

## Scope

- Route aplikasi: `exported_tr_allnk?tglstart=2026-09-01&tglend=2026-09-03`
- Query laporan: `M_Laporanp::getdaterangelaptr()`
- Tabel production: `tb_transaksi`, `tb_barang_nk`, `tb_user`
- Tabel development/local: `tbpo_transaksi`, `tbpo_barang_nk`, `tbpo_user`

## Hasil Cek

Tidak ada perubahan struktur database.

Kolom tanggal transaksi pada mirror lokal production:

```text
tb_transaksi.tgl_transaksi: text
```

Pada mirror lokal `kiucoid_po.tb_transaksi`, periode `2026-09-01` sampai `2026-09-03` tidak memiliki data. Data tanggal terakhir yang terlihat pada mirror lokal adalah `2026-07-29`.

## Perubahan Query

Filter tanggal export diubah dari perbandingan langsung:

```sql
a.tgl_transaksi >= :tglstart
a.tgl_transaksi <= :tglend
```

menjadi filter berbasis tanggal:

```sql
DATE(a.tgl_transaksi) >= :tglstart
DATE(a.tgl_transaksi) <= :tglend
```

Tujuannya agar request dengan `tglend=2026-09-03` tetap mengambil semua transaksi pada tanggal 3 September bila nilai production menyimpan waktu/jam.

## Kesimpulan Database

Tidak ada migrasi, tidak ada ALTER TABLE, dan tidak ada perubahan data yang perlu dijalankan di database.

Jika hasil export production tetap kosong, validasi data dengan query baca-saja pada database production aktif:

```sql
SELECT COUNT(*) AS total
FROM tb_transaksi
WHERE DATE(tgl_transaksi) >= '2026-09-01'
  AND DATE(tgl_transaksi) <= '2026-09-03'
  AND kd_akun != 11411;
```
