# Reset Password Default `tb_user`

Tanggal: 26 Oktober 2026

## Hasil perubahan

- Database aktif project: `kiucoid_po` pada MySQL/MariaDB lokal.
- Password seluruh 35 akun yang ada di `tb_user` direset menjadi `karisma`.
- Nilai kolom `password` tetap berupa hash `PASSWORD_DEFAULT` agar kompatibel dengan `password_verify()` pada proses login.
- Perubahan hanya pada data password. Tidak ada perubahan skema/tabel.
- Reset telah diverifikasi dalam transaksi: 35 dari 35 akun menerima password `karisma` dan transaksi berhasil di-commit.

## Rollback

Cadangan hash sebelum perubahan tersimpan di luar repository: `C:\xampp\mysql\backup\poerp\tb_user_password_reset_20261026_rollback.sql`. Jalankan file tersebut pada database `kiucoid_po` bila perlu memulihkan password sebelumnya. File ini berisi hash kredensial dan harus tetap privat.

## SQL perubahan

Skrip reset yang digunakan tercatat di `db/MIGRASI/20261026_reset_tb_user_password_karisma.sql`. Menjalankannya kembali akan mereset password semua akun yang ada di `tb_user` ke `karisma`.
