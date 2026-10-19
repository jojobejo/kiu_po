# Pemeriksaan sesi pada semua module

## Perubahan pengembangan

Hook `Session_guard` berjalan setelah controller dibuat dan memeriksa status session `is_login`. Semua route aplikasi yang bukan endpoint Auth (login/logout) dan bukan permintaan CLI akan dialihkan ke halaman login jika session tidak valid. Flag notifikasi disimpan sebagai flashdata sehingga hanya tampil sekali.

Session berlaku selama **15 menit tanpa aktivitas** (`sess_expiration = 900` detik). Aktivitas aplikasi yang memperbarui session memperpanjang batas waktu; setelah melewati batas tersebut, akses berikutnya dialihkan ke login dan memunculkan notifikasi sesi berakhir.

Halaman login menampilkan modal dengan pesan **sesi telah berakhir**. Setelah pengguna menutup modal, halaman login tetap menjadi tampilan awal untuk masuk kembali.

## Cara kerja dan pemeliharaan

`application/config/config.php` mengatur waktu session. `application/config/hooks.php` mendaftarkan hook pusat dan `application/hooks/Session_guard.php` berisi logika pemeriksaan. Untuk mengubah durasi, sesuaikan `sess_expiration` dalam detik. Untuk menambahkan pengecualian publik, evaluasi route/controller secara spesifik pada hook; jangan menonaktifkan pemeriksaan untuk seluruh module. Pemeriksaan berjalan juga untuk route detail PO, termasuk `detailPO/{kode}`.

## Validasi

Link lokal yang diberikan mengarah ke route detail PO. Pemeriksaan kode memastikan route tersebut dilindungi oleh hook yang sama. Pengujian browser dengan session login/logout tidak dijalankan pada perubahan ini.

## Dampak database

Tidak ada perubahan skema atau data database.
