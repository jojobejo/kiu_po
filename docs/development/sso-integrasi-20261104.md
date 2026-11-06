# Integrasi SSO KarismaERP — 4 November 2026

## Acuan dan perubahan

Acuan: halaman admin Portal `https://localhost/karismaerp/admin/api-documentation` pada instalasi KarismaERP lokal. Halaman tersebut memerlukan sesi admin; kontrak dibaca dari view `application/views/content/admin/api_documentation.php` di instalasi Portal lokal.

POERP sudah memiliki route `sso/login` dan `sso/callback`, Authorization Code + PKCE S256, pertukaran token backend, validasi klaim, pencarian akun kerja lokal secara unik, dan konfirmasi histori login. Perubahan ini menyamakan URL callback bawaan dengan path aplikasi yang berjalan, yaitu `https://10.10.10.26/poerp-sftp-portal/sso/callback`, serta menerbitkan sesi lokal hanya setelah `POST /api/sso/login-event` berhasil. Secret klien yang diberikan operator disimpan pada `application/config/portal_sso_local.php` yang diabaikan Git. Konfigurasi lokal memakai Portal `https://localhost/karismaerp/` dan CA lokal untuk verifikasi TLS.

Registry klien `kiu_po` pada Portal lokal diperbarui agar URL peluncuran membuka `https://10.10.10.26/poerp-sftp-portal/sso/login`. Snapshot, SQL perubahan, dan rollback ada di `docs/database/sso-integrasi-20261104.md`.

## Cara menggunakan

1. Admin Portal memberi user izin POERP dan menetapkan tepat satu akun kerja POERP pada aplikasi `kiu_po`.
2. User login ke Portal KarismaERP lalu memilih kartu POERP. Browser membuka `sso/login`, kemudian Portal memverifikasi izin dan mengembalikan browser ke `sso/callback`.
3. POERP memvalidasi state serta klaim token, memakai role dari `tb_user` lokal, meminta konfirmasi histori login, lalu membuka dashboard.
4. Jika akses ditolak, admin memeriksa izin Portal, penetapan akun kerja, dan kecocokan username lokal. Jangan mengirim secret, authorization code, atau verifier untuk diagnosis.

## Kontrak dan batasan

- `sso/login` menyimpan state serta PKCE verifier pada sesi server dan mengarahkan browser ke `GET /sso/authorize`. `sso/callback` mengonsumsi transaksi sekali, memeriksa state, lalu backend menukar code melalui `POST /api/sso/token` dengan secret, callback yang sama persis, dan verifier. Klaim `app_code`, `state`, `sub`, `auth_source`, dan `client_account_username` diperiksa sebelum pencarian `tb_user`.
- Username akun kerja harus menemukan tepat satu baris `tb_user` dengan ejaan persis dan level 1–5. Role berasal dari POERP, bukan Portal. Tidak ada fallback ke username identitas Portal atau pembuatan akun otomatis. Tabel mapping SSO lama tidak menjadi jalur fallback pada alur akun kerja pilihan ini.
- `tb_user` tidak memiliki kolom status aktif. Pemeriksaan akun nonaktif yang disyaratkan panduan Portal belum dapat dilakukan tanpa kebijakan dan perubahan data/skema terpisah. Admin perlu menghapus assignment akun yang tidak boleh dipakai; pencabutan akses Portal menghentikan login baru, bukan sesi POERP yang sudah aktif.
- Logout POERP mengakhiri sesi POERP saja. Pengamanan role, aksi, dan cakupan data tetap tanggung jawab setiap modul POERP.

## Validasi

- Parser PHP konfigurasi lokal: lulus.
- `tests/sso_connection_check.php tb_users:27`: HTTP 200, `portal_ready=true`, seluruh pemeriksaan Portal lulus, termasuk kecocokan callback, izin user, dan penetapan akun. Tes ini baca saja terhadap registry dan tidak membuat sesi klien.
- Route callback HTTPS tersedia dan tanpa transaksi SSO mengarahkan ke halaman Auth, sesuai perilaku penolakan.
- Parser PHP `application/controllers/Sso.php` dan `application/config/portal_sso.php` lulus setelah perubahan urutan sesi.
- UAT browser dengan sesi Portal, callback token, dashboard, dan histori login nyata belum dijalankan. Pengujian role serta cakupan akses modul tetap diperlukan sebelum klaim siap produksi.
- URL publik yang diberikan (`https://portal.karismaerp.com/admin/api-documentation`) gagal pada TLS handshake dari lingkungan ini. Kontrak di atas dicocokkan dengan view dokumentasi Portal lokal; kesamaan versi dengan server publik belum terverifikasi.
