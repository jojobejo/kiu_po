# Catatan Database: Konfigurasi Import SQL Besar di XAMPP

Tanggal: 26 Oktober 2026

## Dampak database

Tidak ada perubahan skema database dan tidak ada perubahan data.

Konfigurasi server MySQL `max_allowed_packet` dinaikkan dari `64M` menjadi `512M` agar server dapat menerima statement atau paket yang lebih besar. Nilai pada bagian `mysqldump` dan client `mysql` juga disamakan menjadi `512M`. Perubahan berlaku setelah service MySQL direstart.

Import tetap harus dijalankan ke database yang benar. Pengaturan ini menaikkan batas teknis; pengaturan ini tidak menjamin bahwa setiap dump kompatibel atau memiliki ruang disk dan waktu eksekusi yang cukup.
