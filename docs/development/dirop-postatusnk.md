# Pengembangan: Akses DIROP ke Status PO Nonkomersil

Tanggal: 26 Oktober 2026

## Perubahan

- Akun level 5 dengan `kode_user = DIROP` diarahkan melalui route `postatusnk` ke daftar status PO nonkomersil untuk seluruh departemen.
- Daftar menggunakan data tanpa filter departemen dan menampilkan seluruh status yang tersedia.
- DIROP memakai modul filter status seperti akun `kadepkeusales` (kode `KADEP08`), ditambah tombol filter untuk setiap departemen dan tombol **Semua Departemen**.
- Tombol filter diterapkan pada kedua salinan view `nonkomersilstatus.php` agar tetap tersedia pada jalur pemuatan view project.
- Urutan awal daftar memakai tanggal PO terbaru ke terlama. Kunci urut menormalkan format tanggal ISO dan `DD/MM/YYYY` agar pencampuran format tidak mengacaukan urutan.
- Kolom departemen pada tampilan daftar menampilkan departemen PO (`tb_po_nk.departemen`) agar asal PO terbaca dengan benar.
- Menu PO Pembelian untuk level 5 yang sudah ada mengarah ke route `postatusnk`.

## Cara menggunakan

1. Login dengan username `dirop` dan password awal `karisma`.
2. Buka menu **PO Pembelian** atau route `postatusnk`.
3. Gunakan tombol status dan tombol pada **Filter Departemen** untuk menyaring daftar. Kedua filter dapat dipakai bersamaan.
4. Urutan awal menempatkan tanggal PO terbaru di atas; pencarian DataTables tetap tersedia.
5. Daftar menampilkan PO nonkomersil dari seluruh departemen dan status, termasuk tautan detail PO.
6. Ganti password awal dengan password pribadi setelah login.

## Validasi dan batasan

Akun sudah dibuat di database lokal dan password berhasil diverifikasi melalui `password_verify()`. Pemeriksaan autentikasi melalui browser belum dilakukan.
