# Cara Menggunakan Login Portal dan Akun Kerja POERP

## Pemeriksaan akses SSO (2026-10-30)

- Akses HTTPS ke `/poerp/` menghasilkan redirect ke `/poerp/sso/login`.
- Endpoint SSO menghasilkan redirect ke Portal `/karismaerp/sso/authorize` dengan `client_id=kiu_po`, callback POERP yang terdaftar di konfigurasi, serta `state` dan PKCE challenge.
- Server POERP dapat menjangkau HTTPS Portal; halaman Portal merespons HTTP 200.
- Uji tanpa session Portal berakhir di halaman login Portal (`/karismaerp/Auth`), sesuai perilaku yang diharapkan. Uji ini tidak mengautentikasi akun dan belum membuktikan callback sampai dashboard.

Jika browser tetap berhenti di halaman login Portal setelah user memasukkan kredensial, catat pesan yang tampil dan waktu kejadian untuk pemeriksaan callback/token oleh admin. Jangan mengirimkan client secret, authorization code, atau token.

Perubahan ini hanya dokumentasi dan tidak mengubah skema database.

## User

1. Login ke Portal KarismaERP.
2. Buka kartu **POERP** pada Portal. Kartu langsung membuka endpoint awal SSO POERP; Portal memeriksa izin dan akun kerja yang ditetapkan admin.
3. Jika akses dan akun kerja tersedia, POERP terbuka otomatis dengan session akun lokal yang ditetapkan. User tidak perlu memasukkan ulang username atau password POERP.
4. Jika Portal menampilkan akun belum tersedia atau POERP menolak akun lokal, hubungi admin Portal untuk memperbaiki izin atau penetapan. User tidak dapat mengganti akun kerja sendiri.
5. Gunakan logout POERP untuk mengakhiri session POERP. Logout ini belum mengakhiri session Portal.

## Admin Portal

1. Beri user akses ke aplikasi POERP pada halaman **Akses Aplikasi**.
2. Buka pengaturan akun aplikasi untuk user itu dan pilih akun POERP yang sudah tersedia di katalog akun klien.
3. Pastikan satu akun hanya ditetapkan kepada satu user Portal untuk aplikasi tersebut.
4. User dapat mulai bekerja setelah status akun kerja tampil tersedia.

## Admin POERP

- Pastikan username yang ada pada katalog akun Portal cocok dengan tepat satu akun `tb_user` POERP.
- Pastikan role dan hak akses akun lokal sudah benar. Role tidak berasal dari Portal.
- Rahasiakan `application/config/portal_sso_local.php`; file ini harus berisi client secret dan tidak boleh masuk Git.
- Untuk pemulihan lokal terkontrol, buka `/?local=1`. Jangan gunakan login lokal sebagai pengganti pengaturan akun Portal untuk user biasa.

Password tidak dikirim melalui redirect atau token SSO. Portal dan POERP wajib diakses melalui HTTPS.
