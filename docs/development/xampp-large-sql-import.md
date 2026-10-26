# Konfigurasi XAMPP untuk Import SQL Besar

Tanggal: 26 Oktober 2026

## Perubahan pengembangan

Konfigurasi PHP di `C:\xampp\php\php.ini` dan MySQL di `C:\xampp\mysql\bin\my.ini` disesuaikan untuk import SQL melalui phpMyAdmin:

- PHP `upload_max_filesize` dan `post_max_size`: `512M`.
- PHP `max_execution_time` dan `max_input_time`: `600` detik.
- PHP `memory_limit` dipertahankan `512M`, sesuai kapasitas RAM yang tersedia pada saat perubahan.
- MySQL `max_allowed_packet`: `512M` untuk server, `mysqldump`, dan client `mysql`.

Salinan konfigurasi sebelum perubahan dibuat sebagai `php.ini.bak-large-sql-20261026-143514` dan `my.ini.bak-large-sql-20261026-143514` di direktori masing-masing.

## Cara menggunakan

1. Restart **Apache** dan **MySQL** melalui XAMPP Control Panel agar konfigurasi baru dibaca.
2. Buka phpMyAdmin, pilih database tujuan, lalu buka tab **Import**.
3. Pilih berkas `.sql` dan jalankan import. Batas unggah web sekarang 512 MB.
4. Untuk arsip SQL yang lebih besar dari batas web atau import yang terputus, gunakan command line MySQL; sesuaikan nama database dan kredensial dengan lingkungan lokal.

Jika proses gagal karena ruang disk, pastikan drive yang menampung `C:\xampp\tmp` dan `C:\xampp\mysql\data` masih memiliki ruang cukup. Waktu 600 detik adalah batas PHP; phpMyAdmin atau operasi SQL tertentu masih dapat memiliki batas lain.

## Validasi

File konfigurasi telah diperbarui dan nilainya diperiksa dari file. Efek runtime baru berlaku setelah Apache dan MySQL direstart; import SQL aktual belum dijalankan.
