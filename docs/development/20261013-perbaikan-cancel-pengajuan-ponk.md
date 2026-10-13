# Perbaikan Cancel Pengajuan PO Nonkomersil

## Gejala

Pada halaman `postatusnk`, tindakan **Cancel Pengajuan** menampilkan pesan umum “Terjadi kesalahan saat memproses data”.

## Penyebab

Tombol pada daftar dan detail mengirim permintaan AJAX POST ke URL `cancel_pengajuan_ponk` dan mengharapkan balasan JSON. Controller `C_PoStatus::cancel_pengajuan_ponk()` serta model `M_Postatus::cancel_pengajuan_ponk()` sudah tersedia, tetapi URL tersebut belum terdaftar sebagai route. CodeIgniter tidak menjalankan handler yang benar sehingga responsnya bukan JSON yang diharapkan browser.

## Perubahan

- Mendaftarkan route `cancel_pengajuan_ponk` ke `postatus/C_PoStatus/cancel_pengajuan_ponk` pada konfigurasi route aplikasi.
- Menyamakan deklarasi pada salinan konfigurasi route di `application/core/config` dan `application/helpers/config`.
- Tidak mengubah tabel, kolom, atau skema database.

## Cara menggunakan

1. Buka menu **PO Status Nonkomersil** (`postatusnk`).
2. Pilih **Cancel Pengajuan** pada baris daftar atau halaman detail pengajuan.
3. Konfirmasi pembatalan. Status pengajuan akan diubah menjadi `PENGAJUAN DIBATALKAN`; pengajuan berstatus `DONE`, `REJECT`, atau sudah dibatalkan tetap ditolak oleh validasi.
4. Halaman dimuat ulang setelah server mengembalikan respons sukses.

## Pemeriksaan

Validasi sumber dilakukan dengan lint PHP pada controller/model dan pemeriksaan sintaks konfigurasi route. Uji browser dengan sesi login dan data PO nyata belum dilakukan.
