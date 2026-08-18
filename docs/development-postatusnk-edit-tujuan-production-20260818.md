# Development Aplikasi - Fix 404 Edit Tujuan Pembelian postatusnk Production

Tanggal: 2026-08-18
Module: `postatusnk`
Folder target: `apps_production`

## Latar Belakang

Pada lokal, fitur Edit Tujuan Pembelian di route `postatusnk` berjalan normal.
Pada file production yang dilampirkan di folder `apps_production`, proses submit modal mengarah ke:

```text
postatusnk/update-tujuan-pembelian
```

Namun route tersebut belum terdaftar di `apps_production/config/routes.php`, sehingga CodeIgniter mengembalikan:

```html
<h1>404 Page Not Found</h1>
<p>The page you requested was not found.</p>
```

## Hasil Trace

Alur production:

```text
apps_production/config/routes.php
postatusnk -> postatus/C_PoStatus/postatusnk

apps_production/views/content/postatus/nonkomersilstatus.php
AJAX submit -> site_url('postatusnk/update-tujuan-pembelian')

apps_production/views/content/postatus/detailponk.php
AJAX submit -> site_url('postatusnk/update-tujuan-pembelian')

apps_production/controllers/postatus/C_PoStatus.php
method -> update_tujuan_pembelian_ponk()

apps_production/models/PO/M_Postatus.php
method -> update_tujuan_pembelian_ponk()
```

Controller dan model production sudah memiliki method update. Bug berada pada route production yang belum mendaftarkan endpoint AJAX tersebut.

## Perubahan Aplikasi

File yang diubah:

```text
apps_production/config/routes.php
```

Route yang ditambahkan:

```php
$route['postatusnk/update-tujuan-pembelian'] = 'postatus/C_PoStatus/update_tujuan_pembelian_ponk';
$route['update_tujuan_pembelian_ponk']       = 'postatus/C_PoStatus/update_tujuan_pembelian_ponk';
```

Route pertama adalah endpoint utama yang dipakai view saat ini.
Route kedua adalah kompatibilitas untuk akses langsung ke endpoint lama apabila masih ada browser/cache/custom script yang memanggil `update_tujuan_pembelian_ponk`.

## Cara Penggunaan

1. Buka module `postatusnk`.
2. Klik tombol Edit Tujuan Pembelian pada data PO Non Komersil.
3. Isi atau ubah nilai Tujuan Pembelian.
4. Klik simpan.
5. Sistem akan POST ke `postatusnk/update-tujuan-pembelian`.
6. Jika valid, data `tj_pembelian` diperbarui dan sistem menulis note `EDIT DATA TUJUAN PEMBELIAN`.

## Validasi Teknis

Validasi yang dilakukan:

- Membandingkan route lokal yang berjalan dengan route production.
- Memastikan view production memang menggunakan `site_url('postatusnk/update-tujuan-pembelian')`.
- Memastikan controller production memiliki method `update_tujuan_pembelian_ponk()`.
- Memastikan model production memiliki method `update_tujuan_pembelian_ponk()`.
- Menjalankan pengecekan syntax PHP pada file route production.

## Dampak

- Bug 404 pada submit Edit Tujuan Pembelian production diperbaiki.
- Tidak ada perubahan UI.
- Tidak ada perubahan controller.
- Tidak ada perubahan model.
- Tidak ada perubahan database.

