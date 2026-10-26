# Akun DIROP untuk Status PO Nonkomersil

Tanggal: 26 Oktober 2026

## Perubahan database

Satu akun ditambahkan ke database lokal `kiucoid_po`:

- `kode_user`: `DIROP`
- `nama_user`: `Direktorat Operasional`
- `username`: `dirop`
- Password login: `karisma` (disimpan sebagai hash PHP `PASSWORD_DEFAULT`)
- `aksess_lv`: `5`
- `departement`: `DIREKTORAT OPERASIONAL`

Pembuatan akun berhasil dan diverifikasi terhadap username, kode, level, departemen, dan `password_verify()`. Tidak ada perubahan skema database.

## Rollback

Untuk menghapus akun yang dibuat oleh perubahan ini, jalankan pada database `kiucoid_po`:

```sql
DELETE FROM tb_user WHERE username = 'dirop' AND kode_user = 'DIROP';
```

Skrip insert tersimpan di `db/MIGRASI/20261026_add_user_dirop.sql`.
