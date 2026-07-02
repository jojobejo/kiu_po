# Development Aplikasi - PO Status Non Komersil

Tanggal: 2026-07-02

## Modul

- Route: `postatusnk/`
- Controller: `application/controllers/postatus/C_PoStatus.php`
- Model: `application/models/PO/M_Postatus.php`
- View: `application/views/content/postatus/nonkomersilstatus.php`

## Tujuan Perubahan

Data pada halaman PO Status Non Komersil tidak lagi dibatasi berdasarkan pembuat PO (`kd_user` / nama pembuat). Halaman tetap menampilkan kolom nama pembuat sebagai informasi, tetapi filter data tidak lagi menjadikan pembuat sebagai dasar pembatasan utama.

## Perubahan Teknis

### 1. Purchasing / Keuangan

Fungsi `ponkgetAllNK_keu_purchasing($kd)` sebelumnya membatasi data berdasarkan `a.kd_user`.

Perubahan:

- Menghapus filter `a.kd_user = ...`.
- Menghapus kondisi khusus user `KEU111`.
- Data yang ditampilkan sekarang berdasarkan status aktif PO Non Komersil:
  - `status != 'DONE'`
  - `status != 'REJECT'`

### 2. Karyawan

Fungsi `getAllNK_kar($kduser)` sebelumnya hanya mengambil data milik user login berdasarkan `a.kd_user = '$kduser'`.

Perubahan:

- Menghapus filter `a.kd_user = '$kduser'`.
- Data yang ditampilkan sekarang berdasarkan status aktif:
  - `status != 'DONE'`
  - `status != 'REJECT'`

## Dampak Bisnis

Dengan perubahan ini, halaman `postatusnk/` menjadi alat monitoring yang lebih terbuka untuk melihat status PO Non Komersil secara menyeluruh, bukan hanya data berdasarkan pembuat. Ini membantu kontrol proses, follow-up approval, dan transparansi operasional antar user yang berwenang.

## Tata Cara Penggunaan

1. Login ke aplikasi.
2. Buka menu PO Status Non Komersil atau akses route `postatusnk/`.
3. Data aktif akan tampil tanpa dibatasi nama pembuat.
4. Kolom `Nama Pembuat` tetap bisa digunakan sebagai informasi identitas pembuat PO.
5. Gunakan tombol detail untuk membuka rincian PO Non Komersil.

## Catatan Validasi

- View yang digunakan tetap `content/postatus/nonkomersilstatus`.
- Tabel sumber data tetap `tb_po_nk` dengan join ke `tb_user`.
- Tidak ada perubahan pada struktur tampilan utama.
