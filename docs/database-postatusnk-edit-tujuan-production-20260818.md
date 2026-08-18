# Database - Fix 404 Edit Tujuan Pembelian postatusnk Production

Tanggal: 2026-08-18
Module: `postatusnk`
Folder target: `apps_production`

## Status Perubahan Database

Tidak ada perubahan database.

Perbaikan hanya menambahkan mapping route di aplikasi production agar request AJAX dari modal Edit Tujuan Pembelian dapat mencapai method controller yang sudah tersedia.

## Tabel Terkait Alur Existing

Alur existing yang tetap digunakan:

- `tb_po_nk`
- `tb_req_nk`
- tabel note/status yang digunakan oleh `M_Postatus->addNote()`

## Kolom Terkait Alur Existing

Kolom existing yang tetap digunakan:

- `tb_po_nk.tj_pembelian`
- `tb_req_nk.tj_pembelian`
- key relasi existing berdasarkan `kd_po_req` / `kd_po_nk`

## Migration

Tidak diperlukan migration SQL.

Tidak ada:

- `ALTER TABLE`
- `CREATE TABLE`
- `DROP TABLE`
- perubahan index
- perubahan tipe data
- perubahan stored procedure atau trigger

## Catatan Deploy

Deploy cukup mengganti file:

```text
apps_production/config/routes.php
```

Setelah deploy, lakukan test submit Edit Tujuan Pembelian dari module `postatusnk` dan pastikan response bukan 404.

