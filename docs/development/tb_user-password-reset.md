# Perubahan Pengembangan: Password Default Akun

Tanggal: 26 Oktober 2026

## Perubahan

Password semua akun yang telah ada di tabel `tb_user` pada database lokal project diseragamkan menjadi `karisma`. Mekanisme login aplikasi memeriksa password dengan `password_verify()`, sehingga nilai disimpan sebagai hash PHP `PASSWORD_DEFAULT`, bukan teks password biasa.

Tidak ada perubahan source aplikasi atau alur pembuatan akun. Tidak ada perubahan skema database. Perubahan ini hanya mereset kredensial 35 akun yang ada saat tindakan dilakukan.

## Cara menggunakan

1. Login dengan username masing-masing dan password `karisma`.
2. Setelah berhasil masuk, ubah password dari pengaturan akun agar setiap akun memakai kredensial unik.
3. Untuk mengulang reset seluruh akun yang ada, skrip tersedia di `db/MIGRASI/20261026_reset_tb_user_password_karisma.sql`. Skrip tersebut sengaja mengubah password setiap baris `tb_user`.

## Validasi

Koneksi ke database `kiucoid_po` berhasil. Sebelum perubahan terdapat 35 akun dengan hash bcrypt. Setelah update, pemeriksaan `password_verify('karisma', ...)` berhasil pada 35 dari 35 baris dan transaksi di-commit. Uji login melalui browser belum dilakukan.
