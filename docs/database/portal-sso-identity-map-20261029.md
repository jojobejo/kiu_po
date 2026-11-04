# Database: Pemetaan identitas SSO Portal

File migration: `docs/database/portal-sso-identity-map-20261029.sql`

Migration ini menambahkan tabel `tb_portal_sso_identity_map` untuk menghubungkan
identitas Portal yang sudah diverifikasi (`auth_source` + `sub`) ke akun POERP
yang sudah ada melalui `tb_user.id_user`. Aplikasi menyimpan kunci identitas
SHA-256 agar pencarian persis dapat menggunakan indeks. Tabel ini tidak membuat
akun, menggabungkan akun, atau menetapkan role.

## Penerapan

1. Buat cadangan database tujuan dan pastikan database POERP yang dipilih benar.
2. Terapkan migration SQL satu kali menggunakan prosedur deployment database.
3. Administrator POERP yang berwenang hanya boleh menghubungkan akun setelah
   identitas Portal diverifikasi secara independen. Jangan mencocokkan akun
   hanya berdasarkan username.
4. Gunakan perintah pemetaan di bawah dengan mengganti seluruh nilai contoh.
   Masukan hash harus berupa `auth_source` persis, pemisah NUL, lalu nilai `sub`
   persis.

```sql
INSERT INTO tb_portal_sso_identity_map
    (identity_hash, auth_source, sub, id_user)
VALUES
    (SHA2(CONCAT('portal-auth-source', CHAR(0), 'verified-portal-sub'), 256),
     'portal-auth-source', 'verified-portal-sub', 123);
```

Pilih `id_user` yang benar dari `tb_user` setelah pemilik akun diverifikasi.
Aplikasi tidak menjalankan perintah pemetaan ini secara otomatis.

## Pemulihan

Cadangkan baris pemetaan terlebih dahulu. Untuk menghapus tabel mapping fitur
ini, jalankan:

```sql
DROP TABLE IF EXISTS tb_portal_sso_identity_map;
```

Perintah ini hanya menghapus tautan SSO dan tidak menghapus akun POERP.
