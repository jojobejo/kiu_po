# Database - Master Barang Komersil Schema Sync

Tanggal: 2026-07-07

## Tabel Utama

- Database lokal: `kiucoid_po`
- Tabel: `tbpo_barang`
- Route pengguna: `masterbarangkomersil/`

## Struktur Kolom yang Dipakai

Berdasarkan pengecekan live database, kolom `tbpo_barang` yang dipakai halaman ini adalah:

- `id`
- `kode_barang`
- `kd_suplier`
- `nama_barang`
- `satuan`
- `panjang`
- `lebar`
- `tinggi`
- `bhn_aktif`

Kolom pendukung:

- `tbpo_suplier.kd_suplier`
- `tbpo_suplier.nama_suplier`

## Catatan Perbedaan Schema

Schema lama pada beberapa dump masih memiliki:

- `id_barang`
- `bahan_aktif`
- `satuan_qty`
- `hasil_dimensi`

Schema aktif sekarang memiliki:

- `id`
- `bhn_aktif`
- `satuan`
- Tidak memiliki `hasil_dimensi`; nilai dimensi bisa dihitung dari `panjang * lebar * tinggi`.

## Perubahan Database

Tidak ada perubahan DDL atau migrasi database pada pekerjaan ini.

Alasan: permintaan adalah menyesuaikan aplikasi dengan database tabel sekarang. Karena tabel aktif sudah menyediakan data yang dibutuhkan melalui kolom `bhn_aktif` dan `satuan`, solusi yang paling aman adalah menyesuaikan query aplikasi.

## Update Database untuk CRUD Detail

Tanggal update: 2026-07-07

Tidak ada perubahan struktur database untuk fitur CRUD detail. Fitur baru memakai tabel aktif `tbpo_barang`, relasi baca ke `tbpo_suplier`, dan relasi baca ke `tbpo_satuan`.

Kolom yang ditulis saat tambah/edit, jika tersedia pada schema aktif:

- `kode_barang`
- `kd_suplier`
- `nama_barang`
- `bhn_aktif`
- `satuan`
- `panjang`
- `lebar`
- `tinggi`
- `berat`
- `isi`
- `kemasan`
- `stock_minimum`
- `merk_barang`
- `kelompok_barang`
- `kategori_barang`
- `produk_fokus`
- `is_active`
- `is_lot`

Primary key yang dipakai untuk halaman detail, update, dan delete adalah `tbpo_barang.id_barang` pada database aktif.

Catatan satuan:

- `tbpo_barang.satuan` tetap menyimpan teks nama satuan.
- Opsi edit satuan dibaca dari `tbpo_satuan.nm_satuan`.
- Query list/detail melakukan `LEFT JOIN tbpo_satuan ON tbpo_satuan.nm_satuan = tbpo_barang.satuan`.
- Nilai yang dikirim saat edit tetap `nm_satuan`, bukan `id_satuan`.

## Catatan Performance Query

Endpoint DataTables server-side membaca data dengan pola:

1. `COUNT(*)` dari `tbpo_barang` untuk total data.
2. Query halaman aktif dengan `LIMIT start, length`.
3. Search pada `kode_barang`, `nama_barang`, bahan aktif, satuan, dan nama supplier.
4. Join ke `tbpo_suplier` memakai `tbpo_suplier.kd_suplier = tbpo_barang.kd_suplier`.

Index yang sudah ada dan relevan:

- `tbpo_barang.idx_kode_barang`
- `tbpo_barang.idx_kd_suplier`

## Query Validasi

Gunakan query berikut jika perlu memvalidasi struktur:

```sql
SHOW COLUMNS FROM tbpo_barang;
SHOW COLUMNS FROM tbpo_suplier;
```

Contoh query data yang setara dengan halaman:

```sql
SELECT
    a.id AS id_barang,
    a.kode_barang,
    c.nama_suplier,
    a.nama_barang,
    a.bhn_aktif AS bahan_aktif,
    a.satuan AS nm_satuan,
    a.panjang,
    a.lebar,
    a.tinggi,
    (a.panjang * a.lebar * a.tinggi) AS hasil_dimensi
FROM tbpo_barang a
LEFT JOIN tbpo_suplier c ON c.kd_suplier = a.kd_suplier;
```
