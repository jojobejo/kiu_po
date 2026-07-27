# Panduan Penggunaan - Request Barang PONK Setelah Fix Merge Akun

Tanggal: 2026-07-27

## Untuk Akun PIC

1. Buka menu `reqpic/`.
2. Klik `Tambah Barang`.
3. Pilih barang dan isi keterangan serta qty seperti biasa.
4. Kembali ke halaman draft.
5. Isi `Tujuan Request`.
6. Klik tombol biru submit draft.
7. Sistem akan membuat nomor PONK resmi secara otomatis saat submit.
8. PIC tidak perlu mencatat atau menginput nomor PONK manual.
9. Setelah submit, request masuk status `ON PROGRESS`.
10. Detail request hanya akan menampilkan item milik akun PIC yang sedang login.

Catatan:
- Jika dua PIC submit pada waktu hampir bersamaan, sistem akan mengantre pembuatan nomor sehingga masing-masing mendapat nomor berbeda.
- Jika halaman draft sudah lama terbuka, tetap aman untuk submit karena nomor hidden lama tidak lagi dipakai sebagai nomor resmi.

## Untuk Admin Keuangan

1. Buka daftar request PONK dari menu admin yang biasa digunakan.
2. Pilih request yang ingin diproses.
3. Cek PIC, departemen, tanggal, tujuan request, dan daftar item.
4. Proses item seperti biasa:
   - centang jika barang tersedia,
   - gunakan aksi tambah/pending jika perlu pembelian atau restock,
   - lanjutkan `ORDER CONFIRMED` sesuai kondisi request.
5. Admin Keuangan tetap dapat melihat lintas akun sesuai hak akses.
6. Untuk request baru setelah fix, item antar PIC tidak akan bercampur dalam nomor yang sama.

## Perubahan Yang Perlu Diketahui User

- Tidak ada perubahan tampilan utama.
- Tombol dan alur kerja tetap sama.
- Nomor PONK sekarang dibuat saat submit, bukan saat halaman draft dibuka.
- PIC tidak perlu refresh halaman untuk mendapatkan nomor baru.
- Jika submit gagal karena gangguan database, ulangi submit dari halaman draft.

## Kontrol Setelah Go Live

Admin Keuangan disarankan mengecek query duplicate harian pada dokumentasi database setelah jam ramai submit request. Jika query kosong, fix berjalan sesuai target.

