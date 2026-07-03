# Development Aplikasi - Edit Tujuan Pembelian PO Non Komersil

Tanggal: 2026-07-03

## Modul

- Route utama: `postatusnk`
- Route aksi baru: `postatusnk/update-tujuan-pembelian`
- Controller: `application/controllers/postatus/C_PoStatus.php`
- View list: `application/views/content/postatus/nonkomersilstatus.php`
- View detail: `application/views/content/postatus/detailponk.php`
- Model: `application/models/PO/M_Postatus.php`

## Masalah

Modal edit tujuan pembelian pada modul `postatusnk` dapat memunculkan halaman 404 saat menyimpan perubahan.

Secara fungsi bisnis, aksi ini milik modul PO Status Non Komersil. Endpoint lama `update_tujuan_pembelian_ponk` sudah ada, tetapi URL yang dipanggil dari view berada di top-level route sehingga lebih rentan salah baca saat routing atau konfigurasi rewrite berbeda antar environment.

## Perubahan Teknis

### 1. Route Modul

Menambahkan route yang lebih eksplisit di bawah modul `postatusnk`:

```php
$route['postatusnk/update-tujuan-pembelian'] = 'postatus/C_PoStatus/update_tujuan_pembelian_ponk';
```

Route lama tetap dipertahankan untuk kompatibilitas:

```php
$route['update_tujuan_pembelian_ponk'] = 'postatus/C_PoStatus/update_tujuan_pembelian_ponk';
```

### 2. View List PO NK

File:

- `application/views/content/postatus/nonkomersilstatus.php`

URL AJAX modal edit tujuan pembelian diarahkan ke route modul:

```php
site_url('postatusnk/update-tujuan-pembelian')
```

### 3. View Detail PO NK

File:

- `application/views/content/postatus/detailponk.php`

URL AJAX modal edit tujuan pembelian juga diarahkan ke route modul yang sama agar perilaku list dan detail konsisten.

## Alur Setelah Perubahan

1. User membuka halaman `postatusnk`.
2. User klik tombol edit pada kolom aksi PO Non Komersil.
3. Modal `Edit Tujuan Pembelian` terbuka.
4. User mengubah isi tujuan pembelian.
5. Tombol `Simpan` mengirim POST ke `postatusnk/update-tujuan-pembelian`.
6. Controller `C_PoStatus::update_tujuan_pembelian_ponk()` memvalidasi session, kode PO request, status PO, dan isi tujuan pembelian.
7. Model `M_Postatus::update_tujuan_pembelian_ponk()` memperbarui data.
8. Sistem menambahkan note `EDIT DATA TUJUAN PEMBELIAN`.
9. Halaman reload setelah response sukses.

## Tata Cara Penggunaan

1. Login ke aplikasi.
2. Buka menu PO Status Non Komersil atau akses `postatusnk`.
3. Cari PO NK yang masih dapat diedit.
4. Klik tombol edit tujuan pembelian.
5. Isi tujuan pembelian baru.
6. Klik `Simpan`.
7. Pastikan pesan sukses muncul dan halaman menampilkan tujuan pembelian yang sudah diperbarui.

## Dampak Bisnis

Perubahan ini memperkuat kontrol proses PO Non Komersil. Tim purchasing, keuangan, dan user terkait dapat memperbaiki narasi tujuan pembelian tanpa membuka risiko salah endpoint. Route yang berada di bawah `postatusnk` juga membuat ownership modul lebih jelas untuk maintenance berikutnya.

## Catatan Validasi

- Endpoint controller lama tidak dihapus.
- Logic validasi dan update data tetap memakai controller dan model yang sudah ada.
- Perubahan view dilakukan pada halaman list dan detail agar pengalaman pengguna konsisten.
