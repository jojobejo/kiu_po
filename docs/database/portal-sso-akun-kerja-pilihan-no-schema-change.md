# Dampak Database: Login SSO dengan Akun Kerja Pilihan

Perubahan integrasi ini tidak mengubah schema database POERP. Tidak ada tabel, kolom, indeks, atau migration baru.

POERP membaca username klaim `client_account_username` dan mencari satu akun pada tabel `tb_user` yang sudah ada. Role tetap dibaca dari akun lokal POERP. Pemetaan `tb_portal_sso_identity_map` yang telah ada tetap digunakan sebagai jalur kompatibilitas untuk login yang tidak membawa klaim akun pilihan.

Konfirmasi event histori ditulis ke database Portal melalui API server-ke-server; tidak menambah objek database POERP. Perubahan session cookie Secure/HttpOnly juga hanya konfigurasi aplikasi.
