# Registry Portal untuk SSO POERP — 4 November 2026

Lingkungan: database Portal lokal `kiucoid_karismaerp_dev`, klien `kiu_po`.

## Snapshot sebelum perubahan

- `redirect_uri`: `https://10.10.10.26/poerp-sftp-portal/sso/callback`
- `launch_uri`: `https://10.10.10.26/poerp-sftp-portal/`

Callback pada registry sudah sesuai route `sso/callback`. Perubahan data yang diperlukan hanya mengarahkan kartu Portal ke route awal SSO:

Pembacaan ulang registry lokal pada 4 November 2026 menunjukkan `launch_uri` sudah menuju `/sso/login` dan `redirect_uri` sudah menuju `/sso/callback`. Tidak ada `UPDATE` database yang dijalankan pada pemeriksaan ini. SQL berikut mencatat perubahan data dan dapat dipakai pada lingkungan yang masih memakai URL peluncuran lama:

```sql
UPDATE tb_portal_sso_client
SET launch_uri = 'https://10.10.10.26/poerp-sftp-portal/sso/login'
WHERE app_code = 'kiu_po'
  AND launch_uri = 'https://10.10.10.26/poerp-sftp-portal/'
  AND redirect_uri = 'https://10.10.10.26/poerp-sftp-portal/sso/callback';
```

Verifikasi `ROW_COUNT() = 1`, kemudian baca ulang `launch_uri` dan `redirect_uri`. Secret disimpan pada konfigurasi backend yang diabaikan Git; tidak ditulis ke database POERP atau dokumen.

## Rollback

```sql
UPDATE tb_portal_sso_client
SET launch_uri = 'https://10.10.10.26/poerp-sftp-portal/'
WHERE app_code = 'kiu_po'
  AND launch_uri = 'https://10.10.10.26/poerp-sftp-portal/sso/login'
  AND redirect_uri = 'https://10.10.10.26/poerp-sftp-portal/sso/callback';
```

Tidak ada perubahan skema database POERP atau Portal (no schema change). Tidak ada perubahan data `tb_user`, izin aplikasi, maupun penetapan akun kerja.

Skema `tb_user` yang tersedia tidak memiliki penanda akun aktif. Karena itu validasi status aktif lokal yang dianjurkan dokumentasi Portal belum dapat diklaim; desain status dan migrasi harus ditetapkan terpisah jika kebutuhan ini akan diberlakukan.
