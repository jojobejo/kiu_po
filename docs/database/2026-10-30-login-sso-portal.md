# Catatan Database Login SSO Portal (2026-10-30)

Tidak ada perubahan skema atau data database untuk pemeriksaan login SSO ini.

Alur akun kerja pilihan menggunakan pengaturan akun di Portal dan pemetaan ke username `tb_user` POERP yang sudah ada. Jalur fallback identitas Portal lama tetap membutuhkan tabel mapping yang didokumentasikan terpisah di `portal-sso-identity-map-20261029.md`.

Pemeriksaan yang dilakukan terbatas pada redirect HTTPS dari POERP ke endpoint authorize Portal. Tidak ada query perubahan data, migrasi, atau uji autentikasi akun yang dijalankan.
