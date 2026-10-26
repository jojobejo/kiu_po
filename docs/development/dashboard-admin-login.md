# Dashboard Admin setelah Login

Tanggal: 26 Oktober 2026

## Perubahan

- Akun dengan `aksess_lv = 1` sekarang mendapat halaman Dashboard Admin setelah login.
- Dashboard menampilkan konfirmasi login dan nama pengguna dari sesi yang sudah terautentikasi.
- Akses ke route `dashboard` tanpa status sesi `is_login` diarahkan kembali ke halaman login.
- Sesi dengan level yang tidak didukung oleh dashboard diakhiri dan diarahkan ke login.

## Cara menggunakan

1. Login menggunakan akun administrator yang aktif.
2. Setelah login berhasil, aplikasi membuka route `dashboard` dan menampilkan Dashboard Admin.
3. Jika sesi login tidak tersedia atau level akses tidak dikenali, aplikasi mengarahkan pengguna ke halaman login.

## Validasi

Perubahan ini ditujukan untuk memperbaiki respons halaman kosong pada akun level 1. Uji login browser dengan akun admin dan uji autentikasi tiap peran masih perlu dilakukan pada lingkungan aplikasi yang terhubung ke database.
