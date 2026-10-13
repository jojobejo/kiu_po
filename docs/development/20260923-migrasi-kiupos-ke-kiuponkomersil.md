# Migrasi kiupos ke kiuponkomersil

## Tujuan

Memindahkan data dari database lama `kiupos` ke database baru `kiuponkomersil` tanpa menghapus data yang sudah ada di target.

## Hasil analisis struktur

- 44 tabel lama mempunyai pasangan di database baru melalui perubahan prefix `tb_` menjadi `tbpo_`.
- Database baru memiliki tabel tambahan untuk PO Jasa, dokumen/evidence, stok LIFO, realisasi, dan modul pendukung. Tabel tambahan tersebut tidak memiliki sumber data di database lama sehingga tidak diisi oleh migrasi ini.
- `v_stockbarangnk` adalah view, bukan tabel data, sehingga tidak dimigrasikan. View target harus dibuat dari dump struktur baru.
- Kolom baru pada target yang tidak tersedia di sumber dibiarkan memakai nilai default atau NULL.

## Perilaku migrasi

Skrip database menggunakan `INSERT IGNORE`. Artinya:

- data lama yang belum ada di target akan ditambahkan;
- jika primary key/unique key sudah ada di target, baris tersebut dilewati;
- data target yang sudah ada tidak ditimpa;
- skrip dapat dijalankan ulang, tetapi hasil tetap perlu divalidasi.

Jika tujuan bisnisnya adalah menjadikan data lama sebagai sumber kebenaran dan menimpa baris target yang konflik, diperlukan persetujuan terpisah karena itu berpotensi mengganti data baru.

## Prosedur aman

1. Backup database target dan sumber.
2. Pastikan kedua database berada pada server MySQL/MariaDB yang sama dan user memiliki hak baca sumber serta tulis target.
3. Import struktur dump baru terlebih dahulu bila target belum tersedia.
4. Jalankan file migrasi dari dokumentasi database.
5. Jalankan query validasi jumlah baris dan cek orphan pada tabel detail.
6. Lakukan UAT aplikasi untuk login, daftar PO, detail PO, transaksi, laporan, dan modul PO Jasa.
7. Hanya setelah validasi bisnis disetujui, jadikan `kiuponkomersil` sebagai database aktif.

## Catatan

Eksekusi database belum dilakukan oleh pekerjaan ini. File yang dibuat adalah skrip migrasi dan dokumentasi yang dapat diaudit serta dijalankan ulang.

