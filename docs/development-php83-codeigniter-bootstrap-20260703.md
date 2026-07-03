# Development Note - PHP 8.3 CodeIgniter Bootstrap

Tanggal: 2026-07-03

## Latar Belakang

Hosting menampilkan stack trace dari:

- `/public_html/kiu_po/index.php`
- line `325`
- `require_once BASEPATH.'core/CodeIgniter.php'`

Line tersebut adalah titik bootstrap utama CodeIgniter 3. Pada kasus PHP 8.2/8.3, baris ini sering muncul sebagai bagian bawah stack trace karena warning dari core framework terjadi saat bootstrap berjalan.

## Perubahan Aplikasi

Perbaikan dilakukan pada deklarasi properti core CodeIgniter agar tidak memicu dynamic property warning di PHP 8.2+.

File yang diperbarui:

- `system/core/Controller.php`
- `system/core/Loader.php`
- `system/core/URI.php`
- `system/core/Router.php`
- `system/database/DB_driver.php`

Detail teknis:

- Menambahkan deklarasi properti core bootstrap pada `CI_Controller`.
- Menambahkan deklarasi properti core bootstrap pada `CI_Loader`.
- Menambahkan properti `$config` pada `CI_URI`.
- Menambahkan properti `$uri` pada `CI_Router`.
- Menambahkan properti `$failover` pada `CI_DB_driver`.

Pendekatan ini dipilih agar kompatibel dengan PHP 8.3 tanpa memakai atribut `#[AllowDynamicProperties]`, sehingga file tetap dapat di-parse oleh PHP 7.4 di lingkungan lokal.

## Cara Penggunaan / Deploy

1. Upload file core yang berubah ke hosting pada path project `kiu_po`.
2. Pastikan folder berikut ikut tersedia di hosting:
   - `system/core`
   - `system/database`
3. Refresh halaman yang sebelumnya menampilkan error.
4. Jika masih muncul stack trace baru, ambil pesan error paling atas, bukan hanya bagian `index.php line 325`, karena line 325 hanya bootstrap.

## Validasi

Validasi lokal dilakukan dengan PHP CLI XAMPP:

```bash
C:\xampp\php\php.exe -l system/core/Controller.php
C:\xampp\php\php.exe -l system/core/Loader.php
C:\xampp\php\php.exe -l system/core/URI.php
C:\xampp\php\php.exe -l system/core/Router.php
C:\xampp\php\php.exe -l system/database/DB_driver.php
```

