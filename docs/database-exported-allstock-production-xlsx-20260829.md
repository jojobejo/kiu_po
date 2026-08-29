# Database - Perbaikan Export Stock Non Komersil Production

Tanggal: 2026-08-29

## Scope

- Route: `exported_allstock`
- Data export stock non komersil.

## Perubahan Database

Tidak ada perubahan struktur database.

Tidak ada migrasi, ALTER TABLE, perubahan index, trigger, view, stored procedure, atau seed data pada pekerjaan ini.

## Dampak Data

Perubahan hanya pada cara aplikasi membaca dan mengirim file Excel:

- Export production memakai query stock aktif dari `M_Stocknonkomersil->v_stock()`.
- Kolom yang dipakai tetap data stock non komersil: kode barang, nama barang, deskripsi, stock, satuan, dan lokasi.

## Catatan

Karena tidak ada perubahan schema, tidak diperlukan rollback database. Rollback cukup dilakukan pada file controller bila diperlukan.

