# SSO Portal untuk POERP

## Ringkasan

Saat pengguna membuka halaman awal POERP, aplikasi otomatis memulai login Portal
di `/sso/login`; callback terdaftar di `/sso/callback`. Form login lokal tetap
tersedia melalui `/?local=1` untuk pemulihan operator. Alur mengikuti panduan klien KarismaERP: Authorization Code,
PKCE S256, `state` acak yang terikat pada session, serta POST form dari server
POERP ke `/api/sso/token`. POERP memvalidasi respons token dan `app_code`, lalu
mengambil role serta hak akses dari akun lokal yang ditetapkan atau dipetakan.

Jika Portal menyertakan `client_account_username` karena admin telah menetapkan
akun kerja untuk user, POERP mencari tepat satu akun lokal `tb_user` dengan
username tersebut dan membuat session memakai role lokalnya. Setelah itu POERP
mengirim event login server-ke-server ke Portal dan hanya melanjutkan jika event
terkonfirmasi. Untuk klien/user yang belum memakai penetapan akun kerja, jalur
pemetaan manual `auth_source` + `sub` ke `tb_user.id_user` tetap tersedia. Sistem
tidak membuat akun otomatis atau memakai role Portal sebagai hak akses POERP.

## Pengaturan

1. Pastikan registrasi Portal menggunakan URL peluncuran
   `https://10.10.10.26/poerp/sso/login` dan URL callback
   `https://10.10.10.26/poerp/sso/callback` secara persis.
2. Nilai `app_code` pada registrasi Portal adalah `kiu_po` dan sudah dipasang
   pada `application/config/portal_sso.php`.
3. Client secret disimpan di file lokal yang diabaikan Git:
   `application/config/portal_sso_local.php`. Batasi izin akses file tersebut.
   Jangan commit, mencatat ke log, atau membagikan secret. Rotasi secret melalui
   Portal jika pernah terungkap di luar operator yang berwenang.
4. Atur URL dasar Portal ke host HTTPS KarismaERP yang dapat dijangkau server
   POERP. Konfigurasi saat ini memakai `https://10.10.10.26/karismaerp/`.
   Pastikan PHP cURL mempercayai rantai sertifikat TLS Portal.
5. Jalur akun kerja pilihan menggunakan penetapan akun Portal dan tidak
   memerlukan tabel mapping POERP. Jika suatu user memakai fallback identitas
   lama tanpa penetapan akun kerja, terapkan migration
   `docs/database/portal-sso-identity-map-20261029.md` dan minta administrator
   memetakan identitas yang sudah diverifikasi.

## Cara menggunakan

1. Login ke Portal dan buka aplikasi POERP dari kartu Portal.
2. Portal memeriksa izin aplikasi dan penetapan akun kerja; browser langsung
   melanjutkan ke POERP tanpa meminta kredensial lokal.
3. POERP membuat session untuk username lokal yang ditetapkan admin, menggunakan
   role dan hak akses dari database POERP.
4. Jika penetapan belum tersedia atau akun lokal tidak cocok, minta admin Portal
   memperbaiki akses/akun.

## Keamanan dan operasional

- `state` kedaluwarsa setelah lima menit dan dihapus setelah callback berhasil
  maupun gagal.
- PKCE membuat verifier dan challenge acak baru untuk setiap proses masuk.
- Verifikasi peer dan host TLS tetap aktif saat meminta token.
- Cookie session Portal dan POERP memakai atribut Secure dan HttpOnly; seluruh alur harus memakai HTTPS.
- Memulai SSO menghapus identitas lokal sebelumnya agar pergantian user Portal tidak mewarisi session akun lama.
- Callback tidak mencatat authorization code, verifier, respons token, atau
  client secret ke log.
- Logout Portal tidak mengakhiri session POERP; logout POERP hanya mengakhiri
  session lokal.
- Jika verifikasi TLS gagal, pasang atau konfigurasi rantai CA tepercaya. Jangan
  menonaktifkan verifikasi sertifikat.

## Validasi dan catatan penerapan

Pemindaian lokal 2026-10-30 menemukan klien `kiu_po` aktif, URL Portal dan POERP
terdaftar, 36 akun pada katalog Portal, satu penetapan akun yang resolve tepat
ke satu akun POERP, dan 36 username katalog cocok persis dengan akun lokal POERP.
Tabel assignment dan histori tersedia pada database Portal lokal. Secret klien lokal cocok dengan hash registrasi Portal;
nilainya tidak ditampilkan. Histori login masih kosong. Tabel mapping identitas
opsional untuk jalur fallback belum tersedia di database POERP lokal; jalur akun
kerja pilihan tidak bergantung pada tabel tersebut.

Parser PHP telah diperiksa untuk controller SSO, Auth, dan konfigurasi session.
UAT browser dengan akun pilot, validasi event histori, uji akun tanpa akses,
pergantian user aktif, serta uji TLS masih harus dijalankan sebelum rilis.
