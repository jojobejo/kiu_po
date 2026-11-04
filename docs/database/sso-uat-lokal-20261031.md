# Database UAT SSO lokal — 31 Oktober 2026

Tidak ada perubahan skema database (no schema change) pada `kiucoid_po`. Akun existing `picit` (id_user 13, level 4) dipakai untuk assignment Portal `tb_users:27`. Password, izin, dan assignment tidak diubah.

Perubahan data terbatas pada registry Portal: launch_uri `kiu_po` menuju `/poerp/sso/login`. Bukti, snapshot sebelum perubahan, dan SQL rollback tersedia pada `C:\xampp\htdocs\karismaerp\docs\database\sso-kiupo-uat-lokal-20261031.md`.

`tb_user` tidak mempunyai kolom status aktif. Klien memeriksa keunikan akun, username persis, kode user, dan level 1–5; pemeriksaan status aktif terpisah memerlukan desain tambahan. Login normal dapat menambah code/histori di Portal, bukan perubahan schema.
